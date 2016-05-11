<?php
/**
 * Created by PhpStorm.
 * User: FRESHIELD
 * Date: 2016/5/11
 * Time: 15:48
 */

define('CAPTCHA_NUMCHARS',6);
define('CAPTCHA_WIDTH',100);
define('CAPTCHA_HEIGHT',25);

$pass_phrase = "";

for($i = 0;$i<CAPTCHA_NUMCHARS;$i++){
    $pass_phrase .= chr(rand(97,122));
}

//create image
$img = imagecreatetruecolor(CAPTCHA_WIDTH,CAPTCHA_HEIGHT);

//set white background with black text and gray graphics
$bg_color = imagecolorallocate($img,255,255,255);
$text_color = imagecolorallocate($img,0,0,0);
$graphic_color = imagecolorallocate($img,64,64,64);

//fill the background

imagefilledrectangle($img,0,0,CAPTCHA_WIDTH,CAPTCHA_HEIGHT,$bg_color);

//draw some random lines

for($i = 0;$i<5;$i++){
    imageline($img,0,rand()%CAPTCHA_HEIGHT,CAPTCHA_WIDTH,rand()%CAPTCHA_HEIGHT,$graphic_color);
}

//sprikle in some random dots

for($i=0;$i<50;$i++){
    imagesetpixel($img,rand()%CAPTCHA_WIDTH,rand()%CAPTCHA_HEIGHT,$graphic_color);
}

//draw the pass-pharase string

imagettftext($img,18,0,5,CAPTCHA_HEIGHT-5,$text_color,'Courier New Bold.ttf',$pass_phrase);

header("Content-type: image/png");
imagepng($img);
imagedestroy($img);

?>