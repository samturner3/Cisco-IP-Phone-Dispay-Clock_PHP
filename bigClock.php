<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$t=time();


function drawClock($time) { 
	$font = 88;
    $string = $time;
    $im = @imagecreatetruecolor(strlen($string) * $font / 1.5, $font);
    imagesavealpha($im, true);
    imagealphablending($im, false);
    $white = imagecolorallocatealpha($im, 255, 255, 255, 127);
    imagefill($im, 0, 0, $white);
    $lime = imagecolorallocate($im, 0, 0, 0);
    imagettftext($im, $font, 0, 0, $font - 3, $lime, "Arial.ttf", $string);
    //header("Content-type: image/png");
    imagepng($im,'bigtime.png');
    //return $im;
    imagedestroy($im); 
    } 
drawClock(date("g:i",$t));
//drawClock("12:59");


 header("Content-type: text/xml; charset=iso-8859-1");
 header("Connection: Keep-Alive");
 header("Cache-Control: private");
 header("Refresh: 15"); 
?>
<CiscoIPPhoneImageFile>
<Title>bla</Title>
<LocationX>0</LocationX>
<LocationY>0</LocationY>
<URL>http://192.168.1.7/ciscoServices/clock/bigtime.png</URL>
</CiscoIPPhoneImageFile>