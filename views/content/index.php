<?php
    session_start();
    require_once '../../controller/process.php';
?>

<!DOCTYPE html>
<html lang="en">

<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Portal Berita - Content</title>
    <link rel="News Portal Icon" href="../../assets/logo.ico" type="image/x-icon" />
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Footer -->
    <link href="../../assets/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <!-- Widget -->
    <script src="https://cdn.logwork.com/widget/clock.js"></script>

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

    <!-- External CSS -->
    <link href="./assets/content.css" rel="stylesheet" />

    <!-- External JS -->
    <script src="./assets/content.js" type="text/javascript"></script>
</head>


<body>
    <?php
    
    ob_start();
    $id = $_GET['id'];
    $object = new Posting($id, '', '', '', '', '', '');
    $object->searchData();
    $userLikes = [];

    if(!isset($_GET['id']) || $object->getJudul() === NULL){
        header("location: ../home/");
    }

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
      $userLikes = searchLikebyUser();
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
                <img src="../../assets/logo-text.png" alt="News Portal" class="logo"
                    onclick="window.location.href = '../home/'" />
                <img src="../../assets/logo-mobile.png" alt="News Portal" class="logo-mobile"
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
            <div class="col-sm-9 no-padd" style="padding-top: 2rem;">
                <h5 class="detail">
                    <?php echo $object->getPenulis() . " / " . date("d M Y", strtotime($object->getTanggal())); ?></h5>
                <h1 class="judulBerita"><?php echo $object->getJudul(); ?></h1>
                <h5 class="detail" style="text-transform: capitalize;">Category: <?php echo $object->getKategori() ?>
                </h5>
                <img class="foto-konten" src="../../upload/content/<?php echo $object->getPath() ?>" />
                <div class="isi"><?php echo $object->getKonten() ?></div>
            </div>
            <div class="col-sm-3 no-padd" style="padding: 0">


                <h3 id="iklan">Widget</h3>

                <div data-aos='fade-up' data-aos-delay='50' class="DPDC" cityid="26447" lang="en"
                    id="dayspedia_widget_4e0358ae39861de5" host="https://dayspedia.com" ampm="true" nightsign="true"
                    sun="true" style="margin-top: 20px;" load="lazy">
                    <style media="screen" id="dayspedia_widget_4e0358ae39861de5_style">
                    .DPDC {
                        display: table;
                        position: relative;
                        box-sizing: border-box;
                        font-size: 100.01%;
                        font-style: normal;
                        font-family: Arial;
                        background-position: 50% 50%;
                        background-repeat: no-repeat;
                        background-size: cover;
                        overflow: hidden;
                        user-select: none
                    }

                    .DPDCh,
                    .DPDCd {
                        width: fit-content;
                        line-height: 1.4
                    }

                    .DPDCh {
                        margin-bottom: 1em
                    }

                    .DPDCd {
                        margin-top: .24em
                    }

                    .DPDCt {
                        line-height: 1
                    }

                    .DPDCth,
                    .DPDCtm,
                    .DPDCts {
                        display: inline-block;
                        vertical-align: text-top;
                        white-space: nowrap
                    }

                    .DPDCth {
                        min-width: 1.15em
                    }

                    .DPDCtm,
                    .DPDCts {
                        min-width: 1.44em
                    }

                    .DPDCtm::before,
                    .DPDCts::before {
                        display: inline-block;
                        content: ':';
                        vertical-align: middle;
                        margin: -.34em 0 0 -.07em;
                        width: .32em;
                        text-align: center;
                        opacity: .72;
                        filter: alpha(opacity=72)
                    }

                    .DPDCt12 {
                        display: inline-block;
                        vertical-align: text-top;
                        font-size: 40%
                    }

                    .DPDCdm::after {
                        content: ' '
                    }

                    .DPDCda::after {
                        content: ', '
                    }

                    .DPDCdt {
                        margin-right: .48em
                    }

                    .DPDCtn {
                        display: inline-block;
                        position: relative;
                        width: 13px;
                        height: 13px;
                        border: 2px solid;
                        border-radius: 50%;
                        overflow: hidden
                    }

                    .DPDCtn>i {
                        display: block;
                        content: '';
                        position: absolute;
                        right: 33%;
                        top: -5%;
                        width: 85%;
                        height: 85%;
                        border-radius: 50%
                    }

                    .DPDCs {
                        margin: .96em 0 0 -3px;
                        font-size: 90%;
                        line-height: 1;
                        white-space: nowrap
                    }

                    .DPDCs sup {
                        padding-left: .24em;
                        font-size: 65%
                    }

                    .DPDCsl::before,
                    .DPDCsl::after {
                        display: inline-block;
                        opacity: .4
                    }

                    .DPDCsl::before {
                        content: '~';
                        margin: 0 .12em
                    }

                    .DPDCsl::after {
                        content: '~';
                        margin: 0 .24em
                    }

                    .DPDCs svg {
                        display: inline-block;
                        vertical-align: bottom;
                        width: 1.2em;
                        height: 1.2em;
                        opacity: .48
                    }

                    .DPDC {
                        background-image: url("//cdn.dayspedia.com/img/widgets/bg-2.png")
                    }

                    .DPDC {
                        width: auto;
                        padding: 24px;
                        background-color: #ffffff;
                        border: 1px solid #343434;
                        border-radius: 8px
                    }

                    .DPDCt,
                    .DPDCd {
                        color: #343434;
                        font-weight: bold
                    }

                    .DPDCtn {
                        border-color: #343434
                    }

                    .DPDCtn>i {
                        background-color: #343434
                    }

                    .DPDCt {
                        font-size: 48px
                    }

                    .DPDCh,
                    .DPDCd {
                        font-size: 16px
                    }

                    @media (min-width: 991px) {
                        .DPDC {
                            width: 100% !important;
                            background-color: #ffffff;
                            border: 1px solid #343434;
                            border-radius: 8px
                        }
                    }

                    @media (min-width:768px) and (max-width:992px) {
                        .DPDC {
                            width: auto;
                            padding: 10px !important;
                            background-color: #ffffff;
                            border: 1px solid #343434;
                            border-radius: 8px
                        }

                        .DPDCt {
                            font-size: 25px
                        }
                    }
                    </style>

                    <a class="DPl" href="https://dayspedia.com/time/id/South_Tangerang/" target="_blank"
                        style="display:block!important;text-decoration:none!important;border:none!important;cursor:pointer!important;background:transparent!important;line-height:0!important;text-shadow:none!important;position:absolute;z-index:1;top:0;right:0;bottom:0;left:0">
                    </a>
                    <div class="DPDCh">Current Time in South Tangerang</div>
                    <div class="DPDCt">
                        <span class="DPDCth">02</span><span class="DPDCtm">52</span><span class="DPDCts">56</span><span
                            class="DPDCt12">pm</span>
                    </div>
                    <div class="DPDCd">
                        <span class="DPDCdt">Sun, October 10</span><span class="DPDCtn"
                            style="display: none;"><i></i></span>
                    </div>

                    <div class="DPDCs" style="display: block;">
                        <span class="DPDCsr">
                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24">
                                <path
                                    d="M12,4L7.8,8.2l1.4,1.4c0,0,0.9-0.9,1.8-1.8V14h2c0,0,0-3.3,0-6.2l1.8,1.8l1.4-1.4L12,4z">
                                </path>
                                <path
                                    d="M6.8,15.3L5,13.5l-1.4,1.4l1.8,1.8L6.8,15.3z M4,21H1v2h3V21z M20.5,14.9L19,13.5l-1.8,1.8l1.4,1.4L20.5,14.9z M20,21v2h3 v-2H20z M6.1,23C6,22.7,6,22.3,6,22c0-3.3,2.7-6,6-6s6,2.7,6,6c0,0.3,0,0.7-0.1,1H6.1z">
                                </path>
                            </svg>05:33<sup style="display: inline;">am</sup>
                        </span>
                        <span class="DPDCsl">12:13</span>
                        <span class="DPDCss">
                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24">
                                <path
                                    d="M12,14L7.8,9.8l1.4-1.4c0,0,0.9,0.9,1.8,1.8V4h2c0,0,0,3.3,0,6.2l1.8-1.8l1.4,1.4L12,14z">
                                </path>
                                <path
                                    d="M6.8,15.3L5,13.5l-1.4,1.4l1.8,1.8L6.8,15.3z M4,21H1v2h3V21z M20.5,14.9L19,13.5l-1.8,1.8l1.4,1.4L20.5,14.9z M20,21v2h3 v-2H20z M6.1,23C6,22.7,6,22.3,6,22c0-3.3,2.7-6,6-6s6,2.7,6,6c0,0.3,0,0.7-0.1,1H6.1z">
                                </path>
                            </svg>05:46<sup style="display: inline;">pm</sup>
                        </span>
                    </div>
                    <script>
                    var s, t;
                    s = document.createElement("script");
                    s.type = "text/javascript";
                    s.src = "//cdn.dayspedia.com/js/dwidget.min.v7c6abcf8.js";
                    t = document.getElementsByTagName('script')[0];
                    t.parentNode.insertBefore(s, t);
                    s.onload = function() {
                        window.dwidget = new window.DigitClock();
                        window.dwidget.init("dayspedia_widget_4e0358ae39861de5");
                    };
                    </script>
                </div>

                <a data-aos='fade-up' data-aos-delay='100' class="weatherwidget-io"
                    href="https://forecast7.com/en/n6d20106d65/tangerang/" data-label_1="TANGERANG"
                    data-label_2="WEATHER" data-theme="original" style="margin-top: 20px;" load="lazy">TANGERANG
                    WEATHER</a>
                <script>
                ! function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (!d.getElementById(id)) {
                        js = d.createElement(s);
                        js.id = id;
                        js.src = 'https://weatherwidget.io/js/widget.min.js';
                        fjs.parentNode.insertBefore(js, fjs);
                    }
                }
                (document, 'script', 'weatherwidget-io-js');
                </script>
                <h3 id="iklan">Sponsored Content</h3>
                <div class="iklan">
                    <a target="blank" data-aos='fade-up' data-aos-delay='150'
                        href="https://gofood.co.id/bahasa/balikpapan/restaurant/pastel-kilo-ku-11d9427b-0f09-48de-b708-8bdfec348830"><img
                            src="../../assets/iklan/iklan1.jpg" alt="" id="img-iklan1" load="lazy" /></a>
                </div>
                <div class="iklan">
                    <a target="blank" data-aos='fade-up' data-aos-delay='200'
                        href="https://gofood.co.id/bahasa/balikpapan/restaurant/pastel-kilo-ku-11d9427b-0f09-48de-b708-8bdfec348830"><img
                            src="../../assets/iklan/iklan2.jpg" alt="" id="img-iklan1" load="lazy" /></a>
                </div>
                <div class="iklan">
                    <a target="blank" data-aos='fade-up' data-aos-delay='250'
                        href="https://gofood.co.id/bahasa/balikpapan/restaurant/pastel-kilo-ku-11d9427b-0f09-48de-b708-8bdfec348830"><img
                            src="../../assets/iklan/iklan3.jpg" alt="" id="img-iklan1" load="lazy" /></a>
                </div>
            </div>
        </div>
        <div class="row">
            <form method="post">
                <p class="line">Comments</p>
                <textarea maxlength='256' rows="5" cols="100" name="comment" placeholder="Enter your comment here..."
                    required></textarea>
                <br />
                <input type="submit" id="submit" name="submit1" value="Post">

                <?php
                
                if(isset($_POST["submit1"])) {
                    if(checkSession()) {
                        handleComment($_GET['id']);
                    } else {
                        header("location: ../login/");
                    }
                }
                ?>
            </form>
        </div>
        <div class="row">
            <div class="daftar-komentar">
                <p class="line">All Comments</p>

                <?php
                    insertLike();
                    handleUnlike();
                    $data = getAllComments();
                    
                    while($row = $data->fetch_assoc()){
                        if($row['jumlahLike'] !== null) $jumlahLike = $row['jumlahLike'];
                        else $jumlahLike = 0;
                        
                        $inputName = 'like';
                        $src = "like-icon.png";
                        foreach($userLikes as $secrow){
                            if($secrow["idKomentar"] === $row["idKomentar"]) {
                                $inputName = 'unlike';
                            }
                        }
                        if($inputName === "unlike") $src = "like-icon1.png";
                        echo "
                        <form action='' method='POST' class='isi-daftar-komentar'>
                            <div class='comment-img-text'>
                                <div class='comment-img'>
                                    <div class='photo-placeholder'>
                                        <img src='../../upload/profile/". $row['profilepath'] ."' alt='Profile' load='lazy'>
                                    </div>
                                </div>
                                <div class='comment-text'>
                                    <h4>" . $row['fullName'] . "</h4>
                                    <h6><b>". $row['tanggal']. "</b></h6>
                                    <p>" . $row['komentar'] . "</p>
                                </div>
                            </div>
                            <button class='like-icon' type='submit'>
                                <img src='../../assets/". $src ."' alt='button'>
                                <h6>". $jumlahLike . "</h6>
                            </button>
                            <input type='text' value='" . $row['idKomentar'] ."' name='$inputName' hidden />
                        </form>
                        ";
                    }
                ?>
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