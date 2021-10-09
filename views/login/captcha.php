<?php

// $captcha_code = '';
// $captcha_dist = '';
// $total_characters_on_image = 7;

// $possible_captcha_letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

// $count = 0;
// while ($count < $total_characters_on_image) { 
// $captcha_code .= substr(
// 	$possible_captcha_letters,
// 	mt_rand(0, strlen($possible_captcha_letters)-1),
// 	1);
// $count++;
// }

// $count = 0;
// while ($count < $total_characters_on_image) { 
// $captcha_dist .= substr(
// 	$possible_captcha_letters,
// 	mt_rand(0, strlen($possible_captcha_letters)-1),
// 	1);
// $count++;
// }

// $_SESSION['captcha'] = $captcha_code;

// untuk mengacak captcha
session_start();
function acakCaptcha()
{
  $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";

  //untuk menyatakan $pass sebagai array
  $pass = array();

  //masukkan -2 dalam string length
  $panjangAlpha = strlen($alphabet) - 2;
  for ($i = 0; $i < 7; $i++) {
    $n = rand(0, $panjangAlpha);
    $pass[] = $alphabet[$n];
  }
  //ubah array menjadi string
    return implode($pass);  
}

$code = acakCaptcha();
$_SESSION['captcha'] = $code;

//lebar dan tinggi captcha
$wh = imagecreatetruecolor(300, 50);

//background color biru
$bgc = imagecolorallocate($wh, 158, 183, 167);

//text color abu-abu
$fc = imagecolorallocate($wh, 0, 0, 0);
imagefill($wh, 0, 0, $bgc);

//( $image , $fontsize , $string , $fontcolor )
imagestring($wh, 100, 125, 15,  $code, $fc);

//buat gambar
header('content-type: image/jpg');
imagejpeg($wh);
imagedestroy($wh);
?>