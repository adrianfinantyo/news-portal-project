<?php
    require_once '../../model/model.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Portal Berita - Home</title>
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
    <script src="./assets/home.js" type="text/javascript"></script>

    <!-- External CSS -->
    <link href="./assets/home.css" rel="stylesheet" />
    <link href="../../assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" />
</head>

<body>
    <?php
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
        echo "
        <script>
          $(document).ready(() => {
            $('.login').show();
            $('.logout').hide();
          });
        </script>
      ";
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

    <div class="container" style="margin-top: 10rem">
        <div class="logo-wrapper center">
            <img src="../../assets/logoblack-text.png" alt="News Portal" />
        </div>
        <div class="jb-container">
          <img id='jb-img' src='' alt='' />
          <div class='hero left'>
            <h2>WELCOME</h2>
            <p>something</p>
          </div>
        </div>
        <nav class="littlenav navbar-default">
            <ul class="nav navbar">
                <li><a href="#">Home</a></li>
                <li><a href="#">International</a></li>
                <li><a href="#">Sports</a></li>
                <li><a href="#">Opinion</a></li>
                <li><a href="#">Business</a></li>
                <li><a href="#">Youth</a></li>
            </ul>
        </nav>

        <div class="row">
            <div class="col-sm-9 no-padd">
                <h2 id="newsLate">Latest News</h2>

                <!-- INI BAGIAN KIRI -->
                <div class="col-sm-6 no-padd">

                    <?php 
                    $object = new Posting('', '', '', '', '', '', '', '');
                    $result = $object->latestKiri();

                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='row'>";
                        echo "<a href='#'>";
                        echo "<div class='container-img'>";
                        echo "<img src='../../upload/content/" . $row['pictpath'] . "' />";
                        echo "</div>";
                        echo "<h4>" . $row['judul'] . "</h4>";
                        echo "</a>";
                        echo "<div class='isi'>" . $row['isikonten'] . "</div>";
                        echo "</div>";
                    } 
                  ?>
                </div>

                <!-- INI BAGIAN KANAN -->
                <?php

                $object = new Posting('', '', '', '', '', '', '', '');
                $result = $object->latestKanan();

                while ($row = $result->fetch_assoc()) {
                  echo "<div class='col-sm-6 no-padd' id='bagian-kanan'>";
                  echo "<div class='row'>";
                  echo "<div class='col-sm-3 no-padd'>";
                  echo "<a href='#'><img class='img-kanan' src='../../upload/content/" . $row['pictpath'] . "' /></a>";
                  echo "</div>";
                  echo "<div class='col-sm-9 no-padd'>";
                  echo "<div class='row'>";
                  echo "<p>" . $row['tanggalPublikasi'] . " [" . $row['kategori'] . "]</p>";
                  echo "</div>";
                  echo "<div class='row'>";
                  echo "<a href='#'>";
                  echo "<h4 class='h4-kanan'>" . $row['judul'] . "</h4>";
                  echo "</a>";
                  echo "</div></div></div></div>";
                }
                ?>
              
            <div class="col-sm-3 no-padd" style="padding: 0">
                <h3 id="iklan">Sponsored Content</h3>
                <div class="iklan">
                    <a
                        href="https://gofood.co.id/bahasa/balikpapan/restaurant/pastel-kilo-ku-11d9427b-0f09-48de-b708-8bdfec348830"><img
                            src="../../assets/iklan/iklan1.jpg" alt="" id="img-iklan1" /></a>
                </div>
                <div class="iklan">
                    <a
                        href="https://gofood.co.id/bahasa/balikpapan/restaurant/pastel-kilo-ku-11d9427b-0f09-48de-b708-8bdfec348830"><img
                            src="../../assets/iklan/iklan2.jpg" alt="" id="img-iklan1" /></a>
                </div>
                <div class="iklan">
                    <a
                        href="https://gofood.co.id/bahasa/balikpapan/restaurant/pastel-kilo-ku-11d9427b-0f09-48de-b708-8bdfec348830"><img
                            src="../../assets/iklan/iklan3.jpg" alt="" id="img-iklan1" /></a>
                </div>
            </div>
        </div>
    </div>


    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h6>About</h6>
                    <p class="text-justify">
                        Newsportal.my.id <i>WEBSITE BERITA TERPERCAYA </i> Lorem ipsum
                        dolor sit amet, consectetur adipiscing elit. Nullam et nulla quis
                        magna varius finibus. Nam vitae congue ante. Proin sapien elit,
                        sagittis at ligula in, ornare aliquam augue. Vestibulum eget
                        viverra quam. Quisque vehicula, massa et dictum lobortis, nunc
                        purus feugiat purus, tempor faucibus magna erat id magna. Nunc nec
                        ultricies lectus. Vestibulum in dui aliquam, maximus nulla in,
                        elementum diam. Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit.
                    </p>
                </div>

                <div class="col-xs-6 col-md-3 categories">
                    <h6>Categories</h6>
                    <ul class="footer-links">
                        <li>
                            <a href="http://scanfcode.com/category/c-language/">Home</a>
                        </li>
                        <li>
                            <a href="http://scanfcode.com/category/front-end-development/">International</a>
                        </li>
                        <li>
                            <a href="http://scanfcode.com/category/back-end-development/">Sports</a>
                        </li>
                        <li>
                            <a href="http://scanfcode.com/category/java-programming-language/">Opinion</a>
                        </li>
                        <li>
                            <a href="http://scanfcode.com/category/android/">Business</a>
                        </li>
                        <li>
                            <a href="http://scanfcode.com/category/templates/">Youth</a>
                        </li>
                    </ul>
                </div>

                <!-- <div class="col-xs-6 col-md-3">
            <h6>Categories</h6>
            <ul class="footer-links">
              <li><a href="http://scanfcode.com/about/">Home</a></li>
              <li><a href="http://scanfcode.com/contact/">International</a></li>
              <li>
                <a href="http://scanfcode.com/contribute-at-scanfcode/"
                  >Sports</a
                >
              </li>
              <li>
                <a href="http://scanfcode.com/privacy-policy/">Opinion</a>
              </li>
              <li><a href="http://scanfcode.com/sitemap/">Youth</a></li>
            </ul>
          </div> -->
            </div>
            <hr />
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <p class="copyright-text">
                        Copyright &copy; 2021 All Rights Reserved by
                        <a href="#">Rey, Hansen, Boni, Kezia</a>.
                    </p>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12">
                    <ul class="social-icons">
                        <li>
                            <a class="facebook" href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a class="twitter" href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a class="instagram" href="http://instagram.com/hansendhrma" onclick="window.open('http://instagram.com/kezia.ivena_/', 'http://instagram.com/reynard.rmy/');
                  window.open('http://instagram.com/kezia.ivena_/');
                  return true;"><i class="fa fa-instagram"></i></a>
                        </li>
                        <li>
                            <a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>