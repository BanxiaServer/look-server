<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $GLOBALS['S']['title'] ?></title>
<meta name="keywords" content="<?php echo $GLOBALS['S']['keywords'] ?> " />
<meta name="description" content="<?php echo $GLOBALS['S']['description'] ?> " />
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
<script type="text/javascript" src="<?php echo $GLOBALS['TURL'] ?>js/tablecloth.js"></script>
	<div id="content">
		<table cellspacing="0" cellpadding="0">
			<tr>
				<th>游戏名称</th>
				<th>开区时间</th>
				<th>游戏版本特色介绍</th>
				<th>版本</th>
				<th>经验</th>
				<th>网络线路</th>
				<th>客服QQ</th>
				<th>游戏主页</th>
			</tr>
		<?php $vn=0;$tablev=syClass("syModel")->syCache(3600)->findSql("select id,tid,sid,title,style,trait,gourl,addtime,hits,htmlurl,htmlfile,litpic,orders,mrank,mgold,isshow,keywords,description,summary,date,empiric,ver,line,qq,link from dy_article a left join dy_article_field b on (a.id=b.aid) where isshow=1 and tid in(1)  order by orders desc,addtime desc,id desc limit 10");foreach($tablev as $v){ $v["tid_leafid"]=$sy_class_type->leafid($v["tid"]);$v["n"]=$vn=$vn+1; $v["url"]=html_url("article",$v); $v["title"]=stripslashes($v["title"]); $v["description"]=stripslashes($v["description"]); ?>			
			<tr id="h">
				<td id="t" width="96"><a href="http://<?php echo $v['link'] ?>" target="_blank"><?php echo newstr($v['title'],17) ?></a></td>
				<td width="130"><?php echo date('Y-m-d',$v['date']) ?> 品牌推荐</td>
				<td width="420"><a href="<?php echo $v['url'] ?>" title="进入查看<?php echo $v['title'] ?>游戏设置" target="_blank"><?php echo newstr($v['summary'],60) ?></a></td>
				<td width="52"><?php echo $v['empiric'] ?></td>
				<td width="66"><?php echo $v['ver'] ?></td>
				<td width="60"><?php echo $v['line'] ?></td>
				<td width="76"><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $v['qq'] ?>&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo $v['qq'] ?>:46" alt="点击这里给我发消息" title="点击这里给我发消息"/></a></td>
				<td><a href="http://<?php echo $v['link'] ?>" target="_blank"><img border="0" src="<?php echo $GLOBALS['TURL'] ?>images/link.gif" alt="进入游戏" title="进入游戏" /></a></td>
			</tr>
		<?php } ?>
		</table>
		<div class="mark"><a>↑本站强烈推荐以上10家品牌商业奇迹mu服↑【长久 稳定 公平】</a></div>
		<table cellspacing="0" cellpadding="0">		
		<?php $vn=0;$tablev=syClass("syModel")->syCache(3600)->findSql("select id,tid,sid,title,style,trait,gourl,addtime,hits,htmlurl,htmlfile,litpic,orders,mrank,mgold,isshow,keywords,description,summary,date,empiric,ver,line,qq,link from dy_article a left join dy_article_field b on (a.id=b.aid) where isshow=1 and tid in(2)  order by orders desc,addtime desc,id desc limit 60");foreach($tablev as $v){ $v["tid_leafid"]=$sy_class_type->leafid($v["tid"]);$v["n"]=$vn=$vn+1; $v["url"]=html_url("article",$v); $v["title"]=stripslashes($v["title"]); $v["description"]=stripslashes($v["description"]); ?>			
			<tr id="bai">
				<td width="96"><a href="http://<?php echo $v['link'] ?>" target="_blank"><?php echo newstr($v['title'],17) ?></a><img src="<?php echo $GLOBALS['TURL'] ?>images/r.gif" width="16" height="15" align="absbottom" /></td>
				<td width="130"><?php echo date('Y-m-d',$v['date']) ?> 普通推荐</td>
				<td width="420"><a href="<?php echo $v['url'] ?>" title="进入查看<?php echo $v['title'] ?>游戏设置" target="_blank"><?php echo newstr($v['summary'],60) ?></a></td>
				<td width="52"><?php echo $v['empiric'] ?></td>
				<td width="66"><?php echo $v['ver'] ?></td>
				<td width="60"><?php echo $v['line'] ?></td>
				<td width="76"><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $v['qq'] ?>&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo $v['qq'] ?>:46" alt="点击这里给我发消息" title="点击这里给我发消息"/></a></td>
				<td><a href="http://<?php echo $v['link'] ?>" target="_blank"><img border="0" src="<?php echo $GLOBALS['TURL'] ?>images/link.gif" alt="进入游戏" title="进入游戏" /></a></td>
			</tr>
		<?php } ?>
		</table>
		<div class="mark"><a>奇迹mu ↓以下本站新服预告↓【长久 稳定 公平】</a></div>
		<table cellspacing="0" cellpadding="0">		
		<?php $vn=0;$tablev=syClass("syModel")->syCache(3600)->findSql("select id,tid,sid,title,style,trait,gourl,addtime,hits,htmlurl,htmlfile,litpic,orders,mrank,mgold,isshow,keywords,description,summary,date,empiric,ver,line,qq,link from dy_article a left join dy_article_field b on (a.id=b.aid) where isshow=1 and tid in(3)  order by orders desc,addtime desc,id desc limit 50");foreach($tablev as $v){ $v["tid_leafid"]=$sy_class_type->leafid($v["tid"]);$v["n"]=$vn=$vn+1; $v["url"]=html_url("article",$v); $v["title"]=stripslashes($v["title"]); $v["description"]=stripslashes($v["description"]); ?>			
			<tr id="bai">
				<td width="96"><a href="http://<?php echo $v['link'] ?>" target="_blank"><?php echo newstr($v['title'],17) ?></a><img src="<?php echo $GLOBALS['TURL'] ?>images/new.gif" width="16" height="15" align="absbottom" /></td>
				<td width="130">开服时间 <?php echo date('Y-m-d',$v['date']) ?></td>
				<td width="420"><a href="<?php echo $v['url'] ?>" title="进入查看<?php echo $v['title'] ?>游戏设置" target="_blank"><?php echo newstr($v['summary'],60) ?></a></td>
				<td width="52"><?php echo $v['empiric'] ?></td>
				<td width="66"><?php echo $v['ver'] ?></td>
				<td width="60"><?php echo $v['line'] ?></td>
				<td width="76"><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $v['qq'] ?>&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo $v['qq'] ?>:46" alt="点击这里给我发消息" title="点击这里给我发消息"/></a></td>
				<td><a href="http://<?php echo $v['link'] ?>" target="_blank"><img border="0" src="<?php echo $GLOBALS['TURL'] ?>images/link.gif" alt="进入游戏" title="进入游戏" /></a></td>
			</tr>
		<?php } ?>
		</table>	  
	</div>
	<div id="content">
		<div id="index_news">
			<table cellspacing="0" cellpadding="0">
				<tr>
					<th>站内新闻</th>
					<th>行业动态</th>
					<th>相关文章</th>
				</tr>		
				<tr id="bai">
					<td width="333">
				<?php $vn=0;$tablev=syClass("syModel")->syCache(3600)->findSql("select id,tid,sid,title,style,trait,gourl,addtime,hits,htmlurl,htmlfile,litpic,orders,mrank,mgold,isshow,keywords,description,summary,date,empiric,ver,line,qq,link from dy_article a left join dy_article_field b on (a.id=b.aid) where isshow=1 and tid in(4)  order by orders desc,addtime desc,id desc limit 10");foreach($tablev as $v){ $v["tid_leafid"]=$sy_class_type->leafid($v["tid"]);$v["n"]=$vn=$vn+1; $v["url"]=html_url("article",$v); $v["title"]=stripslashes($v["title"]); $v["description"]=stripslashes($v["description"]); ?>
					<li><a href="<?php echo $v['url'] ?>" target="_blank"><span>[<?php echo date('Y-m-d',$v['addtime']) ?>]</span><span><?php echo newstr($v['title'],50) ?></span></a></li>
				<?php } ?>
					</td>
					<td width="333">
				<?php $vn=0;$tablev=syClass("syModel")->syCache(3600)->findSql("select id,tid,sid,title,style,trait,gourl,addtime,hits,htmlurl,htmlfile,litpic,orders,mrank,mgold,isshow,keywords,description,summary,date,empiric,ver,line,qq,link from dy_article a left join dy_article_field b on (a.id=b.aid) where isshow=1 and tid in(5)  order by orders desc,addtime desc,id desc limit 10");foreach($tablev as $v){ $v["tid_leafid"]=$sy_class_type->leafid($v["tid"]);$v["n"]=$vn=$vn+1; $v["url"]=html_url("article",$v); $v["title"]=stripslashes($v["title"]); $v["description"]=stripslashes($v["description"]); ?>
					<li><a href="<?php echo $v['url'] ?>" target="_blank"><span>[<?php echo date('Y-m-d',$v['addtime']) ?>]</span><span><?php echo newstr($v['title'],50) ?></span></a></li>
				<?php } ?>
					</td>
					<td width="333">
				<?php $vn=0;$tablev=syClass("syModel")->syCache(3600)->findSql("select id,tid,sid,title,style,trait,gourl,addtime,hits,htmlurl,htmlfile,litpic,orders,mrank,mgold,isshow,keywords,description,summary,date,empiric,ver,line,qq,link from dy_article a left join dy_article_field b on (a.id=b.aid) where isshow=1 and tid in(6)  order by orders desc,addtime desc,id desc limit 10");foreach($tablev as $v){ $v["tid_leafid"]=$sy_class_type->leafid($v["tid"]);$v["n"]=$vn=$vn+1; $v["url"]=html_url("article",$v); $v["title"]=stripslashes($v["title"]); $v["description"]=stripslashes($v["description"]); ?>
					<li><a href="<?php echo $v['url'] ?>" target="_blank"><span>[<?php echo date('Y-m-d',$v['addtime']) ?>]</span><span><?php echo newstr($v['title'],50) ?></span></a></li>
				<?php } ?>
					</td>
				</tr>
			</table>
		</div>
	</div>		
<div class="bottom">
<strong>投诉邮箱:<a href="mailto:<?php echo labelcus(9,'body') ?>"><?php echo labelcus(9,'body') ?></a></strong>
</br>
<strong>免责声明:奇迹汇所有内容来自互联网,版权归业主所有,如无意中侵犯了您的权益,请来信告之,本网站将在规定时间内给予删除.</strong>
</div>
</div>
</body>
</html>
