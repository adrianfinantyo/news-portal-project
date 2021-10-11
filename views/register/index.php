<?php
    session_start();
    require_once "../../controller/process.php";
?>
<?php
    if(isset($_POST["sign"])){
      $error;
		  if($_POST["password"] === $_POST["cPass"]){
        $error = saveUser();
      }
      else
      {
        $error = "dataint";
      }
	  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>News Portal - Register</title>
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

    <!-- AOS  -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

    <!-- External JS -->
    <script src="./assets/register.js" type="text/javascript"></script>

    <!-- External CSS -->
    <link href="./assets/register.css" rel="stylesheet" />
</head>

<body>
    <div class="main" data-aos="slide-right" data-aos-duration="1000" data-aos-delay="200">
        <div class="inner-container tes1">
            <a href="../home/">
                <img src="../../assets/logo-text.png" alt="News Portal Logo" data-aos="fade-down" data-aos-delay="1000"
                    data-aos-duration="500" class="logo" />
            </a>
            <h1 data-aos="fade-up" data-aos-delay="1000" data-aos-duration="500">
                Register
            </h1>
            <form id="regForm" method="POST" data-aos="fade-up" data-aos-delay="1000" data-aos-duration="500"
                enctype="multipart/form-data">
                <div id="pictHolder">
                    <label for="photoPict">
                        <img id="tempPict" src="../../assets/photo-placeholder.png" alt="LOGO" />
                    </label>
                    <input type="file" accept="image/*" id="photoPict" name="profile" />
                </div>
                <input type="text" placeholder="First Name" name="fName" />
                <input type="text" placeholder="Last Name" name="lName" />
                <input type="date" placeholder="Birth Date" name="birth" />
                <select name="gender">
                    <option value="" hidden>Gender</option>
                    <option value="F">Female</option>
                    <option value="M">Male</option>
                </select>
                <input type="email" placeholder="Email" name="email" />
                <input type="password" placeholder="Password" name="password" />
                <input type="password" placeholder="Confirm Password" name="cPass" />
                <div class="link">
                    <h5 data-aos="zoom-out" data-aos-delay="1500" data-aos-duration="500">
                        Have an account?
                        <a href="../login/">Login Here</a>
                    </h5>
                    <button type="submit" data-aos="zoom-out" data-aos-delay="2000" data-aos-duration="500" name="sign">
                        Register
                    </button>
                </div>
            </form>
            <?php if(isset($error) && $error === "dataint") : ?>
            <p style="color: red; margin-top: 3rem; text-align:center;">Terdapat data yang kosong atau password yang
                diinputkan tidak sama. Coba lagi!</p>
            <?php endif; ?>
            <?php if(isset($error) && $error === "datadep") : ?>
            <p style="color: red; margin-top: 3rem; text-align:center;">Email yang Anda masukkan telah terdaftar!</p>
            <?php endif; ?>
        </div>
    </div>
    <script>
    AOS.init();
    </script>
</body>

</html>