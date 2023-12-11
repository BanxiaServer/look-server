<?php
error_reporting(0);
define("APP_PATH",'../'.dirname(__FILE__));
define("DOYO_PATH",dirname(__FILE__));
$GLOBALS['G_DY']['sp_session']=DOYO_PATH.'/cache/ses';
require('ext/sysession.php');
new sysession();
		$length=4;
		$width=48;
		$height=25;
		$chars='ABCDEFGHIJKMNPQRSTUVWXYZ23456789';
		for($i=0;$i<$length;$i++){
		  $str.= mb_substr($chars, floor(mt_rand(0,mb_strlen($chars)-1)),1);
		}
		$randval = $str;
		$_SESSION['doyo_verify']= md5(strtolower($randval));
		$width = ($length*10+10)>$width?$length*10+10:$width;
		if (function_exists('imagecreatetruecolor')) {
			$im = @imagecreatetruecolor($width,$height);
		}else {
			$im = @imagecreate($width,$height);
		}
		$r = Array(225,255,255,223);
		$g = Array(225,236,237,255);
		$b = Array(225,236,166,125);
		$key = mt_rand(0,3);
		
		$backColor = imagecolorallocate($im, $r[$key],$g[$key],$b[$key]);
		$pointColor = imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
		
		@imagefilledrectangle($im, 0, 0, $width - 1, $height - 1, $backColor);
		@imagerectangle($im, 0, 0, $width-1, $height-1);
		$stringColor = imagecolorallocate($im,mt_rand(0,200),mt_rand(0,120),mt_rand(0,120));
		
		for($i=0;$i<10;$i++){
			$fontcolor=imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
			imagearc($im,mt_rand(-10,$width),mt_rand(-10,$height),mt_rand(80,300),mt_rand(80,200),55,44,$fontcolor);
		}
		for($i=0;$i<25;$i++){
			$fontcolor=imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
			imagesetpixel($im,mt_rand(0,$width),mt_rand(0,$height),$pointColor);
		}
		for($i=0;$i<$length;$i++) {
			imagestring($im,5,$i*10+5,mt_rand(1,8),$randval{$i}, $stringColor);
		}
		header("Content-type: image/png");
		ImagePNG($im);
		ImageDestroy($im);