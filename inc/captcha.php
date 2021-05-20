<?php

    session_start();
    
    //$text = rand(000000, 999999);       // create a random numbers..
    
	$text = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';
	$text = substr(str_shuffle($text), 0, 6);
    
	$_SESSION['captcha_code'] = $text;      // saving the random code on the session
    
    
    $image = imagecreate(140,40);
    $bg = imagecolorallocate($image, 96, 125, 139);
    $font = imagecolorallocate($image, 255, 255, 255);

    
    imagestring($image, 5, 40, 10, $text, $font);      // adding the text to image     ( 40 => margin-right  |   10 => margin-top   )
    
    imagepng($image);
    
    ob_end_flush();

?>