<?php
    // REQUIRED
    session_start();
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
                            $_SESSION["userEmail"] = $_POST["email"];
                            $_SESSION["userName"] = $row["firstname"] . $row["lastname"];
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
                                    $temp = explode(".", $_FILES["photo"]["name"]);
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
            $_SESSION["userEmail"] = $_POST["email"];
            $_SESSION["userName"] = $_POST["fName"] . $_POST["lName"];
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
            $likecount = null;

            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                $data = new Posting($id, $judul, $kategori, $penulis, $tanggal, $path, $konten, $likecount);
                $data->insertData();
            }
        }
    }

    function handleEditPost() {
    }

    function getAllPost() {
        $posting = new Posting(null, null, null, null, null, null, null, null);
        $data = $posting->tableData();
        return $data;
    }

    function handleLogOut() {
        unset($_SESSION["userEmail"]);
        unset($_SESSION["userName"]);
        header("location: ../login");
    }
?>