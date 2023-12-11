<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $article['title'] ?>-<?php echo $GLOBALS['S']['title'] ?></title>
<meta name="keywords" content="<?php echo $article['keywords'] ?>" />
<meta name="description" content="<?php echo $article['description'] ?>" />
<link href="<?php echo $GLOBALS['TURL'] ?>style/tablecloth.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $GLOBALS['TURL'] ?>style/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $GLOBALS['TURL'] ?>js/pptBox.js"></script>
</head>

<body>
<div id="container">
<style type="text/css">
<!--
#top {
	background-image: url(/template/Release/images/top_11.gif);
	background-repeat: repeat-x;
	height: 26px;
	width: 100%;
}
#top .h{
	height: 26px;
	width: 1000px;
	margin-right: auto;
	margin-left: auto;
	line-height: 26px;
}
#top .h .info{
	float: left;
	line-height: 24px;
	height: 24px;
}
#top .h .release-btn{
	float: right;
	font-size: 12px;
}
#top .h a{
	font-size: 12px;
	text-decoration: none;
	padding-right: 10px;
}
-->
</style>
<div id="top">
	<div class="h">
	<div class="info">
	<script>
	var marqueeContent=new Array();   //滚动新闻
	marqueeContent[0]='<img src="<?php echo $GLOBALS['TURL'] ?>images/info.gif" /><a><?php echo labelcus(5,'body') ?></a><br>';
	marqueeContent[1]='<img src="<?php echo $GLOBALS['TURL'] ?>images/info.gif" /><a><?php echo labelcus(6,'body') ?></a><br>';
	marqueeContent[2]='<img src="<?php echo $GLOBALS['TURL'] ?>images/info.gif" /><a><?php echo labelcus(7,'body') ?></a><br>';
	marqueeContent[3]='<img src="<?php echo $GLOBALS['TURL'] ?>images/info.gif" /><a><?php echo labelcus(8,'body') ?></a><br>';	
	var marqueeInterval=new Array();  //定义一些常用而且要经常用到的变量
	var marqueeId=0;
	var marqueeDelay=10000;
	var marqueeHeight=24;
	//接下来的是定义一些要使用到的函数
	function initMarquee() {
		var str=marqueeContent[0];
		document.write('<div id=marqueeBox style="overflow:hidden;height:'+marqueeHeight+'px" onmouseover="clearInterval(marqueeInterval[0])" onmouseout="marqueeInterval[0]=setInterval(\'startMarquee()\',marqueeDelay)"><div>'+str+'</div></div>');
		marqueeId++;
		marqueeInterval[0]=setInterval("startMarquee()",marqueeDelay);
		}
	function startMarquee() {
		var str=marqueeContent[marqueeId];
			marqueeId++;
		if(marqueeId>=marqueeContent.length) marqueeId=0;
		if(marqueeBox.childNodes.length==1) {
			var nextLine=document.createElement('DIV');
			nextLine.innerHTML=str;
			marqueeBox.appendChild(nextLine);
			}
		else {
			marqueeBox.childNodes[0].innerHTML=str;
			marqueeBox.appendChild(marqueeBox.childNodes[0]);
			marqueeBox.scrollTop=0;
			}
		clearInterval(marqueeInterval[1]);
		marqueeInterval[1]=setInterval("scrollMarquee()",24);
		}
	function scrollMarquee() {
		marqueeBox.scrollTop++;
		if(marqueeBox.scrollTop%marqueeHeight==(marqueeHeight-1)){
			clearInterval(marqueeInterval[1]);
			}
		}
	initMarquee();
	</script>
	</div>		
	 <div class="release-btn">
      <?php if(empty($_SESSION['member'])){ ?>
      <img src="<?php echo $GLOBALS['TURL'] ?>images/home.gif" /><a href="<?php echo $GLOBALS['WWW'] ?>index.php?c=member&a=reg">注册发布</a><img src="<?php echo $GLOBALS['TURL'] ?>images/icon_2.gif" /><a href="<?php echo $GLOBALS['WWW'] ?>index.php?c=member&a=login">自助免费发布</a>
      <?php }else{ ?>
      欢迎您:<?php echo $_SESSION['member']['user'] ?>
      <img src="<?php echo $GLOBALS['TURL'] ?>images/icon_2.gif" /><a href="<?php echo $GLOBALS['WWW'] ?>index.php?c=member">发布中心</a><img src="<?php echo $GLOBALS['TURL'] ?>images/home.gif" /><a href="<?php echo $GLOBALS['WWW'] ?>index.php?c=member&a=out">退出登录</a>
      <?php } ?>
	  </div>
	</div>
</div>
	<div class="banner">
	<script>
     var box =new PPTBox();
     box.width = 1000; //宽度
     box.height = 208;//高度
     box.autoplayer = 3;//自动播放间隔时间

     //box.add({"url":"图片地址","title":"悬浮标题","href":"链接地址"})
     <?php $vn=0;$tablev=syClass("syModel")->syCache(3600)->findSql("select * from dy_ads where isshow=1 and taid='1'  order by orders desc,id desc limit 6");foreach($tablev as $v){ $v["n"]=$vn=$vn+1; $v["name"]=stripslashes($v["name"]); ?>
	 box.add({"url":"<?php echo $v['adfile'] ?>","href":"<?php echo $v['gourl'] ?>","title":"<?php echo $v['name'] ?>"})
	 <?php } ?>
     box.show();
    </script>
	</div>
<div class="contentheader"></div>
<div class="contentcontainer">
<div class="text">
<div><h1><?php echo $article['title'] ?></h1></div>
<div class="t">发布时间：<?php echo date('Y-m-d H:i:s',$article['addtime']) ?> 点击：<script src="<?php echo $GLOBALS['WWW'] ?>index.php?c=article&a=hits&id=<?php echo $article['id'] ?>" type="text/javascript"></script></div>
<div class="f2"><?php echo $article['body'] ?></div>
<table class="home_qq" width="300" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><a href="http://<?php echo $article['link'] ?>"><img src="<?php echo $GLOBALS['TURL'] ?>images/home_icos.png" width="82" height="62" border="0" /></a></td>
    <td><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $article['qq'] ?>&site=qq&menu=yes"><img src="<?php echo $GLOBALS['TURL'] ?>images/qq_icos.png" width="82" height="71" border="0" /></a></td>
  </tr>
  <tr>
    <td><a href="http://<?php echo $article['link'] ?>">进入<?php echo newstr($article['title'],17) ?></a></td>
    <td><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $article['qq'] ?>&site=qq&menu=yes">游戏客服交谈</a></td>
  </tr>
</table>
</div>
</div>
<div class="contentfooter"></div>
<div class="bottom">
<strong>投诉邮箱:<a href="mailto:<?php echo labelcus(9,'body') ?>"><?php echo labelcus(9,'body') ?></a></strong>
</br>
<strong>免责声明:奇迹汇所有内容来自互联网,版权归业主所有,如无意中侵犯了您的权益,请来信告之,本网站将在规定时间内给予删除.</strong>
</div>
</div>
</body>
</html>