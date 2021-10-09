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

    <!-- External JS -->
    <script src="./assets/dashboard.js" type="text/javascript"></script>

    <!-- External CSS -->
    <link href="./assets/dashboard.css" rel="stylesheet" />
</head>

<body>
    <!-- Navbar -->
    <?php
    require_once "../../controller/process.php";
      if(isset($_SESSION["userEmail"]) && isset($_SESSION["userName"])){
        echo "
          <script>
            $(document).ready(() => {
              $('.login').hide();
              $('.logout').show();
            });
          </script>
        ";
      } else {
        header("location: ../home/");
      }
    ?>
    <nav>
        <div class="navbar-header">
            <div class="navbar-brand">
                <img src="../../assets/logoblack-text.png" alt="News Portal" class="logo"
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
            <a href="../logout/" class="logout">
                <li id="login">Logout</li>
            </a>
        </ul>
    </nav>
    <div class="container">
        <?php
          $data = getAllPost();
          while($post = $data->fetch_assoc()){
            echo "
            <div class='article-container'>
              <div class='img-wrapper'>
                <img src='../../upload/content/" . $post["pictpath"] . "' alt='Article Image' />
              </div>
              <div class='inner-container'>
                  <h3>" . $post["judul"] . "</h3>
                  <h5>" . $post["penulis"] . " - " . date("d M Y", strtotime($post["tanggalPublikasi"])) . "</h5>
                  <div class='p-container'>" . substr($post["isikonten"], 0, 450) . "..." . "</div>
                  <div class='tag-container'>
                      <span>" . $post["kategori"]  . "</span>
                  </div>
              </div>
              <div class='button-container'>
                  <form action='../edit/'>
                      <input type='text' name='postId' value='' hidden />
                      <button><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>
                  </form>
                  <form action=''>
                      <input type='text' name='postId' value='' hidden />
                      <button><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>
                  </form>
              </div>
            </div>
            ";
          }
        ?>
    </div>
</body>

</html>