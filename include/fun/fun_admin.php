<?php
if(!defined('APP_PATH')||!defined('DOYO_PATH')){exit('Access Denied');}
function message_a($info,$gurl,$msggo='',$time=5){
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><script src="include/js/jquery.js" type="text/javascript"></script><link href="doyo/admin/template/style/admin.css" rel="stylesheet" type="text/css" />';
	if($gurl==''){echo "<script>alert('".$info."');javascript:history.go(-1);</script>";exit;}
	if($time!=0){echo '<meta http-equiv="refresh" content="'.$time.';url='.$gurl.'"><script type="text/javascript">function time(){$("#time").html(parseInt($("#time").text())-1);}setInterval("time()",1000);</script>';}
	echo "</head><body><div class='main' style='padding-top:89px;'><div class='tabmsg' style='width:400px;margin: 0 auto;'><div class='t'>".$info."</div><div class='g'>".$msggo."</div>";
	if($time!=0){echo "<div class='z'><a href='".$gurl."'><span id='time'>".$time."</span> 秒后自动跳转，如未跳转请点击此处手工跳转。</a></div>";}
	echo "</div></div></body></html>";
	exit;
}
function message_b($newerrors){
	foreach($newerrors as $errortxt){
		$error_txt1=$errortxt;
		foreach($error_txt1 as $msg){ 
			$error_txt=$msg;
		}
	}
	message_a($error_txt);
}
function admin_group($gid){
	$ginfo=syDB('admin_group')->find(array('gid' => $gid),null,'name');
	return $ginfo['name'];
}
function perinfo($pid){
	$perinfo=syDB('admin_per')->findAll(array('up' => $pid),null,'pid');
	foreach($perinfo as $v){
		$t.=','.$v['pid'];
	}$t=$pid.$t;
	return $t;
}
function adstype($taid){
	$adstype=syDB('adstype')->find(array('taid' => $taid));
	return $adstype['name'];
}
function linktype($taid){
	$linktype=syDB('linkstype')->find(array('taid' => $taid));
	return $linktype['name'];
}
function deleteDir($dir){
	if(is_file($dir)){@unlink($dir);return true;}
	$dir=rtrim($dir,'/').'/';
	if(@rmdir($dir)==false && is_dir($dir)) {
		if($dp=@opendir($dir)) {
			while(false!==($file = readdir($dp))) {
				if($file!='.' && $file!='..') {
					if(is_dir($file)) {
						deleteDir($file);
					}else{
						@unlink($dir.$file);
					}
				}
			}
			@closedir($dp);
		}else{
			return false;
		}
	} 
	return true;
}
