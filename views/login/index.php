<?php
    session_start();
    require_once "../../controller/process.php";
?>
<?php
    if(isset($_POST["login"])){
		$error;
		$error = checkPass();
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>News Portal - Login</title>
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
    <script src="./assets/login.js" type="text/javascript"></script>

    <!-- External CSS -->
    <link href="./assets/login.css" rel="stylesheet" />

    <!-- Re-Captcha -->
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
    function onSubmit(token) {
        document.getElementById("demo-form").submit();
    }
    </script>
</head>

<body>
    <a href="../home/" class="mobile-logo logo">
        <img src="../../assets/logo-text.png" alt="News Portal Logo" data-aos="fade-down" data-aos-delay="1000"
            data-aos-duration="500" />
    </a>
    <div class="login-card" data-aos="slide-left" data-aos-duration="1000" data-aos-delay="200">
        <a href="../home/" class="a-logo">
            <img class="logo" src="../../assets/logo-text.png" alt="News Portal Logo" data-aos="fade-down"
                data-aos-delay="1000" data-aos-duration="500" />
        </a>
        <div class="inner-container" data-aos="fade-up" data-aos-delay="1000" data-aos-duration="500">
            <h1>Login</h1>
            <form method="POST">
                <input type="email" placeholder="Email" name="email" />
                <input type="password" placeholder="Password" name="pass" />
                <br>
                <label>Captcha (Sensitive Case)</label>
                <img class="captcha" src="captcha.php" alt="gambar">
                <input id="captcha" type="text" name="captcha" placeholder="Masukkan Captcha..." required>
                <button type="submit" name="login">Login</button>
                <?php if(isset($error) && $error === "datasalah") : ?>
                <p style="color: red;">Email tidak terdaftar atau password salah, silakan coba lagi</p>
                <?php endif; ?>
                <?php if(isset($error) && $error === "datakosong") : ?>
                <p style="color: red;">Email atau password tidak terisi, silakan coba lagi</p>
                <?php endif; ?>
                <?php if(isset($error) && $error === "salahcaptcha") : ?>
                <p style="color: red;">Captcha tidak sesuai, silakan coba lagi</p>
                <?php endif; ?>
            </form>
            <h5>
                Don't have an account?
                <a href="../register/">Create new account</a>
            </h5>
        </div>
    </div>

    <script>
    AOS.init();
    </script>
</body>

</html>