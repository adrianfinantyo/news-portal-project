<?php
    // REQUIRED
    require_once "../../model/model.php";
    // REQUIRED

    function checkPass() {
        if(isset($_POST['email']) && strlen($_POST['email']) != 0)
        {
            if(isset($_POST['email']) && strlen($_POST['email']) != 0)
            {
                $pengguna = new User('','',htmlspecialchars($_POST['email']),'','','','','');
                $hsl = $pengguna->getData();
                if(mysqli_num_rows($hsl) === 1) {
                    $row = mysqli_fetch_assoc($hsl);
                    $pass = $_POST['pass'];
                    if(password_verify($pass, $row['pass'])){
                        if(strcmp($_SESSION['captcha'], $_POST["captcha"]) != 0){
                            $error = "salahcaptcha";
                        }
                        else
                        {
                            createSession($_POST["email"], $row["firstname"], $row["lv"]);
                            if($row['lv'] == "U")
                            {
                                header('Location: ../../views/home/');
                            }
                            else if($row['lv'] == "A")
                            {
                                header('Location: ../../views/dashboard/');
                            }
                        }
                    }
                    else
                    {
                        $error = "datasalah";
                    }
                }
                else
                {
                    $error = "datasalah";
                }
            } 
            else
            {
                $error = "datakosong";
            }
        }
        else
        {
            $error = "datakosong";
        }
        return $error;
    }

    function saveUser() {
        if(isset($_POST['fName']) && strlen($_POST['fName']) != 0)
        {
            if(isset($_POST['lName']) && strlen($_POST['lName']) != 0)
            {
                if(isset($_POST['birth']) && strlen($_POST['birth']) != 0)
                {
                    if(isset($_POST['gender']) && strlen($_POST['gender']) != 0)
                    {
                        if(isset($_POST['email']) && strlen($_POST['email']) != 0)
                        {
                            if(isset($_POST['password']) && strlen($_POST['password']) != 0)
                            {
                                if(file_exists($_FILES["profile"]["tmp_name"]))
                                {   
                                    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
                                    $targetDir = "../../upload/profile/";
                                    $temp = explode(".", $_FILES["profile"]["name"]);
                                    $newfilename = 'user_' . round(microtime(true)) . '.' . end($temp);
                                    $targetFile = $targetDir . $newfilename;

                                    $objSave = new User(htmlspecialchars($_POST['fName']), htmlspecialchars($_POST['lName']), htmlspecialchars($_POST['email']), $pass, htmlspecialchars($_POST['birth']), htmlspecialchars($_POST['gender']), $newfilename, "U");
                                }
                                else
                                {
                                    $error = "dataint";
                                    return $error;
                                }
                            }
                            else
                            {
                                $error = "dataint";
                                return $error;
                            } 
                        }
                        else
                        {
                            $error = "dataint";
                            return $error;
                        } 
                    }
                    else
                    {
                        $error = "dataint";
                        return $error;
                    } 
                }
                else
                {
                    $error = "dataint";
                    return $error;
                } 
            }
            else
            {
                $error = "dataint";
                return $error;
            } 
        }
        else
        {
            $error = "dataint";
            return $error;
        } 
        $success = $objSave->insertData();
        if($success === true)
        {
            if (!move_uploaded_file($_FILES["profile"]["tmp_name"], $targetFile)) {
                echo "There was an error uploading file";   
            }
            createSession($_POST["email"], $_POST["fName"], 'U');
            header('Location: ../../views/home/');     
        }    
        else
        {
            $error = "datadep";
            return $error;
        }
    }

    function handleCreatePost() {
        if(isset($_POST["headline"]) && isset($_POST["content"])  && isset($_POST["kategori"]) &&  file_exists($_FILES["photo"]["tmp_name"])){
            $target_dir = "../../upload/content/";
            $temp = explode(".", $_FILES["photo"]["name"]);
            $newfilename = 'article_' . round(microtime(true)) . '.' . end($temp);
            $target_file = $target_dir . $newfilename;

            $id = null;
            $judul = $_POST["headline"];
            $kategori = $_POST["kategori"];
            $penulis = $_SESSION["userName"];
            $tanggal = date('Y-m-d');
            $path = $newfilename;
            $konten = $_POST["content"];

            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                $data = new Posting($id, $judul, $kategori, $penulis, $tanggal, $path, $konten);
                $data->insertData();
            }
            header("location: ../dashboard");
        }
    }

    function handleComment($idPosting) {
        if (isset($_POST["comment"]) && $_POST["comment"] != '') {
            $tanggal = date('Y-m-d');
            $idComment = null;
            $newcom = new Komentar ($_SESSION["userEmail"], $idPosting, $_POST["comment"], $tanggal, $idComment);
            $newcom->newComment();
        }
    }

    function getAllComments(){
        $komen = new Komentar(null, $_GET["id"], null, null, null);
        $datas = $komen->getCommentsByPost();
        return $datas;
    }

    function insertLike(){
        if(isset($_POST["like"])){
            $likes = new Likes($_SESSION["userEmail"], $_POST["like"]);
            $likes->addLikes();
            $postID = "location: ../content/?id=" . $_GET["id"];
            header($postID);
        }
    }

    function handleUnlike(){
        if(isset($_POST['unlike'])){
            $likes = new Likes($_SESSION["userEmail"], $_POST["unlike"]);
            $likes->deleteLikes();
            $postID = "location: ../content/?id=" . $_GET["id"];
            header($postID);
        }
    }

    function searchLikebyUser(){
        $like = new Likes($_SESSION["userEmail"], null);
        $arrayLikes = $like->searchForLike();
        $newArr = [];
        while($row = $arrayLikes->fetch_assoc()){
            array_push($newArr, $row);
        }
        return $newArr;
    }

    function handleEditPost($obj) {
        if(isset($_POST["headline"]) && isset($_POST["content"]) && isset($_POST["kategori"])){
            $id = $obj->getId();
            $judul = $_POST["headline"];
            $kategori = $_POST["kategori"];
            $penulis = $_SESSION["userName"];
            $tanggal = date('Y-m-d');
            $path = $obj->getPath();
            $konten = $_POST["content"];
            $error = false;
            
            if (file_exists($_FILES["photo"]["tmp_name"])){
                unlink("../../upload/content/". $path);
                
                $target_dir = "../../upload/content/";
                $temp = explode(".", $_FILES["photo"]["name"]);
                $newfilename = 'article_' . round(microtime(true)) . '.' . end($temp);
                $target_file = $target_dir . $newfilename;
                $path = $newfilename;
                if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                    $error = true;
                }
            }
            if(!$error){
                $data = new Posting($id, $judul, $kategori, $penulis, $tanggal, $path, $konten);
                $data->updateData();
                header("location: ../dashboard/");
            }         
        }
    }

    function handleInitPost(){
        $obj = new Posting($_GET["postId"], '', '', '', '', '', '');
        $obj->searchData();
        return $obj;
    }

    function getAllPost() {
        $posting = new Posting(null, null, null, null, null, null, null);
        $data = $posting->tableData();
        return $data;
    }

    function getPostbyQuery($search){
        $posting = new Posting(null, null, null, null, null, null, null);
        $data = $posting->searchPostByQuery($search);
        return $data;
    }

    function handleLogOut() {
        session_unset();
        header("location: ../login");
    }

    function deletePost() {
        $objDel = new Posting($_POST["postID"], '', '', '', '', '', '');
        $objDel->searchData();
        unlink("../../upload/content/" . $objDel->getPath());
        $objDel->deleteData();
        
    }

    function getDisplayPost($category) {
        $posting = new Posting(null, null, null, null, null, null, null);
        $data = $posting->getLatestPost($category);
        return $data;
    }

    function getDataLen($category) {
        $posting = new Posting(null, null, null, null, null, null, null);
        $data = $posting->getLatestPost($category);
        $ctr = 0;
        while ($data->fetch_assoc()){
            $ctr += 1;
        }
        return $ctr;
    }

    function getProfilePath($email){
        $user = new User(null, null, $email, null, null, null, null, null);
        $res = $user->getProfilePath();
        $res = $res->fetch_assoc();

        return $res;
    }

    function checkSession(){
        if(isset($_SESSION["userEmail"]) && isset($_SESSION["userName"]) && isset($_SESSION["startSession"])){
            if(time() - $_SESSION['startSession'] > 3600){
                session_unset();
                return false; 
            } else {
                $_SESSION["startSession"] = time();
                return true;
            };
        }
        return false;
    }

    function createSession($email, $fname, $level){
        $_SESSION["userEmail"] = $email;
        $_SESSION["userName"] = $fname;
        $_SESSION["userLevel"] = $level;
        $_SESSION["startSession"] = time();
    }
    
?>