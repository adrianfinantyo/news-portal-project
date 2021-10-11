<?php
    session_start();
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

    <!-- Footer -->
    <link href="../../assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" />

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
    <script src="./assets/home.js" type="text/javascript"></script>

    <!-- External CSS -->
    <link href="./assets/home.css" rel="stylesheet" />
</head>

<body>
    <?php
        require_once '../../controller/process.php';
        $category = null;

      if(checkSession()){
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
        echo "
        <script>
          $(document).ready(() => {
            $('.login').show();
            $('.logout').hide();
          });
        </script>
      ";
      }
      

      if(isset($_GET["cat"])){
          $category = $_GET["cat"];
      }
      $data = getDisplayPost($category);
      $dataLen = getDataLen($category);
      $index = 0;
      $leftData = []; $rightData = [];
      while($row = $data->fetch_assoc()){
          if($index < $dataLen/5){
              array_push($leftData, $row);
          } else {
              array_push($rightData, $row);
          }
          $index += 1;
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
            <a href="../dashboard" class="logout" title="Go to Dashboard (Admin Only)">
                <li class="active">
                    <div class="profile-p">
                        <div class="p-wrapper"><img id="ppict" alt="Profile Picture"></div>
                        <span id="pname"></span>
                    </div>
                </li>
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
            <img id='jb-img' src='http://lorempixel.com/400/200/' alt='' />
            <div class='hero left'>
                <h2>WELCOME TO NEWS PORTAL</h2>
                <p>Website berita terpercaya, terakurat, dan sudah teruji di ITB dan IPB</p>
            </div>
        </div>
        <nav class="littlenav navbar-default">
            <ul class="nav navbar">
                <li><a href="../home/">Home</a></li>
                <li><a href="../home/?cat=international">International</a></li>
                <li><a href="../home/?cat=sports">Sports</a></li>
                <li><a href="../home/?cat=opinion">Opinion</a></li>
                <li><a href="../home/?cat=business">Business</a></li>
                <li><a href="../home/?cat=entertainment">Entertainment</a></li>
                <li><a href="../home/?cat=education">Education</a></li>
                <li><a href="../home/?cat=lifestyle">Lifestyle</a></li>
            </ul>
        </nav>

        <div class="row">
            <div class="col-sm-9 no-padd">
                <h2 id="newsLate">Latest News</h2>

                <!-- INI BAGIAN KIRI -->
                <div class="col-sm-6 no-padd kiri">
                    <?php 
                    foreach($leftData as $row){
                        echo "<div class='row'>";
                        echo "<a href='../../views/content/index.php?id=" . $row['id'] . "'>";
                        echo "<div class='container-img'>";
                        echo "<img src='../../upload/content/" . $row['pictpath'] . "' load='lazy' />";
                        echo "</div>";
                        echo "<h4>" . $row['judul'] . "</h4>";
                        echo "</a>";
                        echo "<p>" . date("d M Y", strtotime($row['tanggalPublikasi'])) . " | <span style='text-transform: capitalize;'>" . $row['kategori'] . "</span></p>";
                        echo "<div class='isi'>" . $row['isikonten'] . "</div>";
                        echo "</div>";
                    } 
                  ?>
                </div>

                <!-- INI BAGIAN KANAN -->
                <div class='col-sm-6 no-padd' id='bagian-kanan'>
                    <?php
                    foreach($rightData as $row){    
                    echo "<div class='row'>";
                    echo "<div class='col-sm-3 no-padd'>";
                    echo "<a href='../../views/content/index.php?id=" . $row['id'] . "'><img class='img-kanan' src='../../upload/content/" . $row['pictpath'] . "' load='lazy' /></a>";
                    echo "</div>";
                    echo "<div class='col-sm-9 no-padd'>";
                    echo "<div class='row'>";
                    echo "<p>" . date("d M Y", strtotime($row['tanggalPublikasi'])) . " | <span style='text-transform: capitalize;'>" . $row['kategori'] . "</span></p>";
                    echo "</div>";
                    echo "<div class='row'>";
                    echo "<a href='../../views/content/index.php?id=" . $row['id'] . "'>";
                    echo "<h4 class='h4-kanan'>" . $row['judul'] . "</h4>";
                    echo "</a>";
                    echo "</div></div></div>";
                    }
                    ?>
                </div>
            </div>



            <div class="col-sm-3 no-padd kanan" style="padding: 0">
                <h3 id="iklan">Sponsored Content</h3>
                <div class="iklan">
                    <a target="blank"
                        href="https://gofood.co.id/bahasa/balikpapan/restaurant/pastel-kilo-ku-11d9427b-0f09-48de-b708-8bdfec348830"><img
                            src="../../assets/iklan/iklan1.jpg" alt="" id="img-iklan1" data-aos="fade-up"
                            data-aos-delay="50" load="lazy" /></a>
                </div>
                <div class="iklan">
                    <a target="blank"
                        href="https://gofood.co.id/bahasa/balikpapan/restaurant/pastel-kilo-ku-11d9427b-0f09-48de-b708-8bdfec348830"><img
                            src="../../assets/iklan/iklan2.jpg" alt="" id="img-iklan1" data-aos="fade-up"
                            data-aos-delay="100" load="lazy" /></a>
                </div>
                <div class="iklan">
                    <a target="blank"
                        href="https://gofood.co.id/bahasa/balikpapan/restaurant/pastel-kilo-ku-11d9427b-0f09-48de-b708-8bdfec348830"><img
                            src="../../assets/iklan/iklan3.jpg" alt="" id="img-iklan1" data-aos="fade-up"
                            data-aos-delay="150" load="lazy" /></a>
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
                        Newsportal.my.id <i>WEBSITE BERITA TERPERCAYA </i> <br> News Portal
                        adalah website berita karya anak bangsa yang menyediakan berita dari
                        berbagai macam kategori. Berita pada News Portal adalah berita yang
                        terpercaya dan akurat, terjamin No HOAX 101%. Website ini dibuat oleh
                        4 mahasiswa Universitas Multimedia Nusantara prodi Informatika 2020.
                        Dalam jangka waktu kurang dari 1 bulan, 4 mahasiswa tersebut mampu
                        untuk membuat website ini dari nol untuk memenuhi kebutuhan ujian
                        mid-term nya.

                    </p>
                </div>

                <div class="col-xs-6 col-md-3 categories">
                    <h6>Categories</h6>
                    <ul class="footer-links">
                        <li>
                            <a href="../home/">Home</a>
                        </li>
                        <li>
                            <a href="../home/?cat=international">International</a>
                        </li>
                        <li>
                            <a href="../home/?cat=sports">Sports</a>
                        </li>
                        <li>
                            <a href="../home/?cat=opinion">Opinion</a>
                        </li>
                        <li>
                            <a href="../home/?cat=business">Business</a>
                        </li>
                        <li>
                            <a href="../home/?cat=entertainment">Entertainment</a>
                        </li>
                        <li>
                            <a href="../home/?cat=education">Education</a>
                        </li>
                        <li>
                            <a href="../home/?cat=lifestyle">Lifestyle</a>
                        </li>
                    </ul>
                </div>
            </div>
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
                            <a class="facebook" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"><i
                                    class="fa fa-youtube"></i></a>
                        </li>
                        <li>
                            <a class="twitter" href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a class="instagram" href="https://www.instagram.com/newsportal.my.id/"><i
                                    class="fa fa-instagram"></i></a>
                        </li>
                        <li>
                            <a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
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