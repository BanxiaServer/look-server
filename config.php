<?php
define("APP_PATH",dirname(__FILE__));
define("DOYO_PATH",APP_PATH."/include");
@date_default_timezone_set('PRC');
$doyoConfig = array(

'db' => array(
'host' => 'localhost',			//数据库地址
'port' => 3306,					//数据库端口
'database' => 'wvickx',		//数据库名
'login' => 'wvickx',				//数据库帐号
'password' => 'ctKZGgIbAShj',			//数据库密码
'prefix' => 'dy_',				//数据库表前缀
),

'ext' => array(
'version' => '2.2',
'update' => '20120928',
'auto_update' => 1,
'http_path' => 'http://server.bxgov.cn',
'site_title' => '私服发布网站系统',
'site_keywords' => '私服发布网站系统',
'site_description' => '私服发布网站系统',
'view_themes' => 'Release',
'site_html' => 0,
'site_html_dir' => 'html',
'site_html_rules' => '[mold]/[file].html',
'site_html_suffix' => '.html',
'cache_auto' => 0,
'cache_time' => 3600,
'filetype' => 'jpg,gif,jpeg,bmp,png,swf,flv,wmv,wma,mp3,mp4,rar,zip,7z,txt,doc,docx,xls,xlsx',
'filesize' => 104857600,
'imgwater' => 0,
'imgwater_t' => 2,
'imgcaling' => 1,
'img_w' => 800,
'img_h' => 800,
'comment_audit' => 0,
'comment_user' => 0,
),
);
