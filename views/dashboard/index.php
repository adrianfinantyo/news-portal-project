<?php
    session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Portal Berita - Dashboard</title>
    <link rel="News Portal Icon" href="../../assets/logo.ico" type="image/x-icon" />
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"
        integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>

    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- External JS -->
    <script src="./assets/dashboard.js" type="text/javascript"></script>

    <!-- External CSS -->
    <link href="./assets/dashboard.css" rel="stylesheet" />
</head>

<body>
    <!-- Navbar -->
    <?php
    require_once "../../controller/process.php";
    if(checkSession() && $_SESSION["userLevel"] === "A"){
        $userName = $_SESSION["userName"];
        $path = "../../upload/profile/" . getProfilePath($_SESSION["userEmail"])["profilepath"];
      echo "
        <script>
          $(document).ready(() => {
            $('.login').hide();
            $('.logout').show();
            document.getElementById('ppict').setAttribute('src', '$path');
            document.getElementById('pname').innerHTML = '$userName';
          });
        </script>
      ";
    } else {
      header("location: ../home/");
    }
    

      if(isset($_GET["search"])){
        $data = getPostByQuery($_GET["search"]);
      }else {
        $data = getAllPost();
      }

      if(isset($_POST["yes"]))
      {
        deletePost();
        echo "
        <script>
          $(document).ready(() => {
              $('[postid=". $_POST["postID"] ."]').remove();
            alertDone();
          });
        </script>
      ";
      }
    ?>
    <nav>
        <div class="navbar-header">
            <div class="navbar-brand">
                <img src="../../assets/logo-text.png" alt="News Portal" class="logo"
                    onclick="window.location.href = '../home/'" />
            </div>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <a href="../register/" class="login">
                <li class="active" id="signup">Sign Up</li>
            </a>
            <a href="../login/" class="login">
                <li id="login">Login</li>
            </a>
            <li class="logout">
                <div class="profile-p">
                    <div class="p-wrapper"><img id="ppict" alt="Profile Picture"></div>
                    <span id="pname"></span>
                </div>
            </li>
            <a href="../logout/" class="logout">
                <li id="login">Logout</li>
            </a>
        </ul>
    </nav>
    <div class="container">
        <div class="control-btn">
            <form action="" data-aos="fade-right" data-aos-delay='500'>
                <input type="text" name="search" placeholder="Search article...">
                <button init="search">
                    <span class='glyphicon glyphicon-search' aria-hidden='true'></span>
                </button>
            </form>
            <a href="../edit" data-aos="fade-left" data-aos-delay='500'>
                <button type="button" name="add"><span class='glyphicon glyphicon-plus-sign'
                        aria-hidden='true'></span>Add
                    Post</button>
            </a>
        </div>
        <div>
            <h1 data-aos="fade-up" data-aos-delay='100'>Dashboard</h1>
        </div>
        <div class="right">
        </div>
        <?php
            $i = 0;
          while($post = $data->fetch_assoc()){
              $i += 100;
              if($i/100 >= 5 && $i % 5 === 0) $i = 100;
            echo "
            <div postid='" . $post["id"] . "' class='article-container' data-aos='fade-up' data-aos-delay='$i'>
              <div class='img-wrapper'>
                <img src='../../upload/content/" . $post["pictpath"] . "' alt='Article Image' load='lazy' />
              </div>
              <div class='inner-container'>
                  <h3>" . $post["id"] . " - " . $post["judul"] . "</h3>
                  <h5>" . $post["penulis"] . " - " . date("d M Y", strtotime($post["tanggalPublikasi"])) . "</h5>
                  <div class='p-container'>" . substr($post["isikonten"], 0, 450) . "..." . "</div>
                  <div class='tag-container'>
                      <span>" . $post["kategori"]  . "</span>
                  </div>
              </div>
              <div class='button-container'>
                  <form action='../edit/'>
                      <input type='text' name='postId' value='" . $post["id"] . "' hidden />
                      <button init='edit'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>
                  </form>
                  <button type='button' init='delete' onclick='confirmDelete(" . $post["id"] . ")'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>
                  
              </div>
            </div>
            ";
          }
        ?>
    </div>
    <div id="warnModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="font-size: 3rem;">Warning</h4>
                </div>
                <div class="modal-body">
                    <p style="font-size: 1.8rem;">Are you sure want to delete the data?</p>
                </div>
                <div class="modal-footer">
                    <form method="POST">
                        <input type="text" name="postID" id="postID" hidden>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger" name="yes">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="succModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="font-size: 3rem;">Success!</h4>
                </div>
                <div class="modal-body">
                    <p style="font-size: 1.8rem;">You're data has been deleted</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
    AOS.init({
        offset: 80,
        duration: 500,
        easing: 'ease',
        once: true
    });
    </script>
</body>

</html>