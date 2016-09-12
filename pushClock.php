<?php

$t=time();

function drawClock($time) { 
	$font = 50;
    $string = $time;
    $im = @imagecreatetruecolor(strlen($string) * $font / 1.5, $font);
    imagesavealpha($im, true);
    imagealphablending($im, false);
    $white = imagecolorallocatealpha($im, 255, 255, 255, 127);
    imagefill($im, 0, 0, $white);
    $lime = imagecolorallocate($im, 0, 0, 255);
    imagettftext($im, $font, 0, 0, $font - 1, $lime, "Arial.ttf", $string); //DS-DIGI Arial
    //header("Content-type: image/png");
    imagepng($im,'time.png');
    //return $im;
    imagedestroy($im); 
    } 
drawClock(date("g:i",$t));
//drawClock("Sam");

$addresses = array('21','22','23','24','25','26','27'); //Define each IP address of phone for clock to display

$data='<CiscoIPPhoneStatusFile><Text></Text><Timer></Timer><LocationX>0</LocationX><LocationY>0</LocationY><URL>http://192.168.1.7/ciscoServices/clock/time.png</URL></CiscoIPPhoneStatusFile>';
//URL of clock image to be pushed

  
  //$number2dial="301";
  //$data='<CiscoIPPhoneExecute><ExecuteItem Priority="0" URL="Dial:'.$number2dial.'"/></CiscoIPPhoneExecute>';
  //$ipv4="192.168.1.21";
  
 // echo $data;
 
     foreach ($addresses as $ip) { //For each ip, push the data packet 
     	$ipv4="192.168.1.$ip";
	 	//echo $ipv4;


  $response=cisco_voip_phone_xml_push($ipv4,$data);
  
  
}

return;


  // push xml-like packet to cisco voip phone...
  function cisco_voip_phone_xml_push($ipv4,$data,$uid="root",$pwd="test1") //Enter user ID and password for each phone. (This example assumes the same for every phone)
  {
     $auth=base64_encode($uid.":".$pwd);
     $xml="XML=".urlencode($data);

     $post="POST /CGI/Execute HTTP/1.0\r\n";
     $post.="Host: $ipv4\r\n";
     $post.="Authorization: Basic $auth\r\n";
     $post.="Connection: close\r\n";
     $post.="Content-Type: application/x-www-form-urlencoded\r\n";
     $post.="Content-Length: ".strlen($xml)."\r\n\r\n";

     $response="";
     $fp=fsockopen($ipv4,80,$errno,$errstr,30);
     if(!$fp) return false;

     fputs($fp,$post.$xml);
     while(!feof($fp))
     {
        $response=fgets($fp,128);
     }
     fclose($fp);
     return $response;
     echo $response;
  }
echo $response;

?>