<?php
  // Define application constants
  define('MM_UPLOADPATH', 'images/');
  define('MM_MAXFILESIZE', 32768000);      // 32 KB
  define('MM_MAXIMGWIDTH', 1200);        // 120 pixels
  define('MM_MAXIMGHEIGHT', 1200);       // 120 pixels

function draw_bar_graph($width,$height,$data,$max_value,$filename){
  $img = imagecreatetruecolor($width,$height);

  $bg_color = imagecolorallocate($img,255,255,255);
  $text_color = imagecolorallocate($img,255,255,255);
  $bar_color = imagecolorallocate($img,0,0,0);
  $border_color = imagecolorallocate($img,192,192,192);

  imagefilledrectangle($img,0,0,$width,$height,$bg_color);

  $bar_width = $width/((count($data)*2)+1);
  for($i = 0;$i<count($data);$i++){
    imagefilledrectangle($img,($i*$bar_width*2)+$bar_width,$height,($i*$bar_width*2)+($bar_width*2),$height-(($height/$max_value)*$data[$i][1]),$bar_color);
    imagestringup($img,5,($i*$bar_width*2)+$bar_width,$height-5,$data[$i][0],$text_color);
  }
  imagerectangle($img,0,0,$width-1,$height-1,$border_color);
  for($i=1;$i<=$max_value;$i++){
    imagestring($img,5,0,$height-($i*($height/$max_value)),$i,$bar_color);
  }
  imagepng($img,$filename,5);
  imagedestroy($img);
}
?>
