<?php
if(!defined('APP_PATH')||!defined('DOYO_PATH')){exit('Access Denied');}
function spRun(){
	GLOBAL $__controller, $__action;
	syClass('sysession');
	spLaunch("router_prefilter");
	$handle_controller = syClass($__controller, null, $GLOBALS['G_DY']["controller_path"].'/'.$__controller.".php");
	if(!is_object($handle_controller) || !method_exists($handle_controller, $__action)){
		syError('route Error');
		exit;
	}
	$handle_controller->$__action();
	if(FALSE != $GLOBALS['G_DY']['view']['auto_display']){
		$__tplname = $__controller.$GLOBALS['G_DY']['view']['auto_display_sep'].
				$__action.$GLOBALS['G_DY']['view']['auto_display_suffix']; 
		$handle_controller->auto_display($__tplname);
	}
	spLaunch("router_postfilter");
}

function dump($vars, $output = TRUE, $show_trace = FALSE){
	if(TRUE != SP_DEBUG && TRUE != $GLOBALS['G_DY']['allow_trace_onrelease'])return;
	if( TRUE == $show_trace ){ 
		$content = syError(htmlspecialchars(print_r($vars, true)), TRUE, FALSE);
	}else{
		$content = "<div align=left><pre>\n" . htmlspecialchars(print_r($vars, true)) . "\n</pre></div>\n";
	}
    if(TRUE != $output) { return $content; } 
       echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"></head><body>{$content}</body></html>"; 
	   return;
}

function import($sfilename, $auto_search = TRUE, $auto_error = FALSE){
	if(isset($GLOBALS['G_DY']["import_file"][md5($sfilename)]))return TRUE;
	if( TRUE == @is_readable($sfilename) ){
		require($sfilename); 
		$GLOBALS['G_DY']['import_file'][md5($sfilename)] = TRUE; 
		return TRUE;
	}else{
		if(TRUE == $auto_search){
			foreach(array_merge( $GLOBALS['G_DY']['include_path'], array($GLOBALS['G_DY']['model_path']), $GLOBALS['G_DY']['sp_include_path'] ) as $sp_include_path){
				if(isset($GLOBALS['G_DY']["import_file"][md5($sp_include_path.'/'.$sfilename)]))return TRUE;
				if( is_readable( $sp_include_path.'/'.$sfilename ) ){
					require($sp_include_path.'/'.$sfilename);
					$GLOBALS['G_DY']['import_file'][md5($sp_include_path.'/'.$sfilename)] = TRUE;
					return TRUE;
				}
			}
		}
	}
	if( TRUE == $auto_error )syError("未能找到名为：{$sfilename}的文件");
	return FALSE;
}

function syAccess($method, $name, $value = NULL, $life_time = -1){
	if( $launch = spLaunch("function_access", array('method'=>$method, 'name'=>$name, 'value'=>$value, 'life_time'=>$life_time), TRUE) )return $launch;
	if(!is_dir($GLOBALS['G_DY']['sp_cache']))__mkdirs($GLOBALS['G_DY']['sp_cache']);
	$sfile = $GLOBALS['G_DY']['sp_cache'].'/'.$GLOBALS['G_DY']['sp_app_id'].md5($name).".php";
	if('w' == $method){ 
		$life_time = ( -1 == $life_time ) ? '300000000' : $life_time;
		$value = '<?php die();?>'.( time() + $life_time ).serialize($value);
		return file_put_contents($sfile, $value);
	}elseif('c' == $method){
		return @unlink($sfile);
	}else{
		if( !is_readable($sfile) )return FALSE;
		$arg_data = file_get_contents($sfile);
		if( substr($arg_data, 14, 10) < time() ){
			@unlink($sfile); 
			return FALSE;
		}
		return unserialize(substr($arg_data, 24)); 
	}
}

function syClass($class_name, $args = null, $sdir = null, $force_inst = FALSE){
	if(preg_match("/^[a-zA-Z0-9_\-]*$/",$class_name)==0)syError("类定义不存在，请检查。");
	if(TRUE != $force_inst)if(isset($GLOBALS['G_DY']["inst_class"][$class_name]))return $GLOBALS['G_DY']["inst_class"][$class_name];
	if(null != $sdir && !import($sdir) && !import($sdir.'/'.$class_name.'.php'))return FALSE;
	$has_define = FALSE;
	if(class_exists($class_name, false) || interface_exists($class_name, false)){
		$has_define = TRUE;
	}else{
		if( TRUE == import($class_name.'.php')){
			$has_define = TRUE;
		}
	}
	if(FALSE != $has_define){
		$argString = '';$comma = ''; 
		if(null != $args)for ($i = 0; $i < count($args); $i ++) { $argString .= $comma . "\$args[$i]"; $comma = ', ';}
		eval("\$GLOBALS['G_DY']['inst_class'][\$class_name]= new \$class_name($argString);"); 
		return $GLOBALS['G_DY']["inst_class"][$class_name];
	}
	syError($class_name."类定义不存在，请检查。");
}

function syError($msg, $output = TRUE, $stop = TRUE){
	if($GLOBALS['G_DY']['sp_error_throw_exception'])throw new Exception($msg);
	if(TRUE != SP_DEBUG){
		error_log($msg);
		echo '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>';
		echo "<body>程序出错！<br><br>出现此情况可能为：1、模板标签书写错误。2、修改过程序代码，代码修改有误。<br><br>请在后台系统设置中开启PHP错误调试，或者修改include\inc.php第一行'mode' => 'debug'后查看信息错误记录<br><br>您可以购买官方商业服务，为您提供全程服务http://wdoyo.com</body></html>";
		if(TRUE == $stop)exit;
	}
	$traces = debug_backtrace();
	$bufferabove = ob_get_clean();
	require_once($GLOBALS['G_DY']['notice_php']);
	if(TRUE == $stop)exit;
}

function spLaunch($configname, $launchargs = null, $returns = FALSE ){
	if( isset($GLOBALS['G_DY']['launch'][$configname]) && is_array($GLOBALS['G_DY']['launch'][$configname]) ){
		foreach( $GLOBALS['G_DY']['launch'][$configname] as $launch ){
			if( is_array($launch) ){
				$reval = syClass($launch[0])->{$launch[1]}($launchargs);
			}else{
				$reval = call_user_func_array($launch, $launchargs);
			}
			if( TRUE == $returns )return $reval;
		}
	}
	return false;
}

function spUrl($geturl = null, $controller = null, $action = null, $args = null, $anchor = null, $no_sphtml = FALSE) {
	if(TRUE == $GLOBALS['G_DY']['html']["enabled"] && TRUE != $no_sphtml){
		$realhtml = syhtml::getUrl($geturl, $controller, $action, $args, $anchor);if(isset($realhtml[0]))return $realhtml[0];
	}
	$geturl = ( null != $geturl ) ? $geturl :  basename(__FILE__);
	$controller = ( null != $controller ) ? $controller : $GLOBALS['G_DY']["default_controller"];
	$action = ( null != $action ) ? $action : $GLOBALS['G_DY']["default_action"];
	if( $launch = spLaunch("function_url", array('controller'=>$controller, 'action'=>$action, 'args'=>$args, 'anchor'=>$anchor, 'no_sphtml'=>$no_sphtml), TRUE ))return $launch;
	if( TRUE == $GLOBALS['G_DY']['url']["url_path_info"] ){
		$url = "{$controller}/{$controller}/{$action}";
		if(null != $args)foreach($args as $key => $arg) $url .= "/{$key}/{$arg}";
	}else{
		$url = $geturl."?". $GLOBALS['G_DY']["url_controller"]. "={$controller}&";
		$url .= $GLOBALS['G_DY']["url_action"]. "={$action}";
		if(null != $args)foreach($args as $key => $arg) $url .= "&{$key}={$arg}";
	}
	if(null != $anchor) $url .= "#".$anchor;
	return $url;
}

function __mkdirs($dir, $mode = 0755)
{
	if (!is_dir($dir)) {
		__mkdirs(dirname($dir), $mode);
		return @mkdir($dir, $mode);
	}
	return true;
}
function syExt($ext_node_name)
{
	return (empty($GLOBALS['G_DY']['ext'][$ext_node_name])) ? FALSE : $GLOBALS['G_DY']['ext'][$ext_node_name];
}
function syCus($ext_node_name)
{
	return (empty($GLOBALS['G_DY']['cus'][$ext_node_name])) ? FALSE : $GLOBALS['G_DY']['cus'][$ext_node_name];
}
function spAddViewFunction($alias, $callback_function)
{
	return $GLOBALS['G_DY']["view_registered_functions"][$alias] = $callback_function;
}

function syDB($tbl_name, $pk = null){
	$modelObj = syClass("syModel");
	$modelObj->tbl_name = (TRUE == $GLOBALS['G_DY']["db_spdb_full_tblname"]) ? $tbl_name :	$GLOBALS['G_DY']['db']['prefix'] . $tbl_name;
	if( !$pk ){
		@list($pk) = $modelObj->_db->getTable($modelObj->tbl_name);$pk = $pk['Field'];
	}
	$modelObj->pk = $pk;
	return $modelObj;
}

function spConfigReady( $preconfig, $useconfig = null){
	$nowconfig = $preconfig;
	if (is_array($useconfig)){
		foreach ($useconfig as $key => $val){
			if (is_array($useconfig[$key])){
				@$nowconfig[$key] = is_array($nowconfig[$key]) ? spConfigReady($nowconfig[$key], $useconfig[$key]) : $useconfig[$key];
			}else{
				@$nowconfig[$key] = $val;
			}
		}
	}
	return $nowconfig;
}
//提示信息
function message($info,$gurl){
	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
	if ($gurl==''){echo "<script>alert('".$info."');javascript:history.go(-1);</script>";}
	else{echo "<script>alert('".$info."');window.location.href='".$gurl."';</script>";}
	exit;
}
function message_err($newerrors){
	foreach($newerrors as $errortxt){
		$error_txt1=$errortxt;
		foreach($error_txt1 as $msg){ 
			$error_txt=$msg;
		}
	}
	message($error_txt);
}
//获取IP
function GetIP(){ 
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) 
	$ip = getenv("HTTP_CLIENT_IP"); 
	else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) 
	$ip = getenv("HTTP_X_FORWARDED_FOR"); 
	else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) 
	$ip = getenv("REMOTE_ADDR"); 
	else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) 
	$ip = $_SERVER['REMOTE_ADDR']; 
	else 
	$ip = "unknown"; 
	return($ip); 
} 
//字符截断,中文算2个字符
function newstr($string, $length, $dot="...") {
	if(strlen($string) <= $length) {return $string;}
	$string = str_replace(array('&amp;', '&quot;', '&lt;', '&gt;'), array('&','"','<','>'), $string);
	$strcut = '';$n = $tn = $noc = $noct = $nc = $tnc =0;
	while($n < strlen($string)) {
		$t = ord($string[$n]);
		if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
			$tn = 1; $n++; $noct++;
		} elseif(194 <= $t && $t <= 223) {
			$tn = 2; $n += 2; $noct += 2;
		} elseif(224 <= $t && $t <= 239) {
			$tn = 3; $n += 3; $noct += 2;
		} elseif(240 <= $t && $t <= 247) {
			$tn = 4; $n += 4; $noct += 2;
		} elseif(248 <= $t && $t <= 251) {
			$tn = 5; $n += 5; $noct += 2;
		} elseif($t == 252 || $t == 253) {
			$tn = 6; $n += 6; $noct += 2;
		} else {$n++;}
		if($noct >= $length){if($noct==0)$noc=$noct;if($nc==0)$nc=$n;if($tnc==0)$tnc=$tn;}
	}
	if($noct<=$length){return str_replace(array('&','"','<','>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $string);}
	if($noc > $length) {$nc -= $tnc;}
	$strcut = substr($string, 0, $nc);
	$strcut = str_replace(array('&','"','<','>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $strcut);
	return $strcut.$dot;
}

//数据操作过滤
function is_escape($value) {
	if(is_null($value))return 'NULL';
	if(is_bool($value))return $value ? 1 : 0;
	if(is_int($value))return (int)$value;
	if(is_float($value))return (float)$value;
	$value=htmlspecialchars(trim($value));
	if(!get_magic_quotes_gpc())$value = addslashes($value);
	return $value;
}
//替换url参数
function url_set_value($url,$key,$value) 
{ 
	parse_str($url,$arr); 
	$arr[$key]=$value;
	return '?'.http_build_query($arr); 
}
//内容推荐名称
function traitinfo($traitid){
	$traitid=trim($traitid, ',');
	$traitinfo=syDB('traits')->findAll(' id in ('.$traitid.') ',null,'id,name');
	foreach($traitinfo as $v){
		$trait.=' '.$v['name'];
	}
	return $trait;
}
//栏目名称
function typename($tid){
	$t=syDB('classtype')->find(array('tid' => $tid),null,'classname');
	return $t['classname'];
}
//栏目信息
function typeinfo($tid,$q){
	$t=syDB('classtype')->find(array('tid' => $tid),null,$q);
	return $t[$q];
}
//自定义标签
function labelcus($id,$q){
	$l=syClass('c_labelcus')->syCache(3600*240)->find(array('id' => $id));
	return $l[$q];
}
//自定义页面
function custom_html($file){
	$c=syDB('custom')->find(array('file' => $file));
	return $c;
}
//频道信息获取
function moldsinfo($molds,$q){
	$m=syDB('molds')->find(array('molds' => $molds),null,$q);
	return $m[$q];
}
//内容信息获取
function contentinfo($molds,$id,$q){
	$c=syDB($molds)->find(array('id' => $id),null,$q);
	return $c[$q];
}
//会员信息获取
function memberinfo($id,$q){
	$m=syDB('member')->find(array('id' => $id),null,$q);
	return $m[$q];
}
//会员组信息获取
function membergroup($gid,$q){
	$m=syDB('member_group')->find(array('gid ' => $gid),null,$q);
	return $m[$q];
}
//插件信息获取
function funsinfo($funs,$q){
	$f=syDB('funs')->find(array('funs' => $funs),null,$q);
	return $f[$q];
}
//自定义字段，单选多选项名获取
function fieldsinfo($fields,$key,$molds='article'){
	$f=syDB('fields')->find(array('fields' => $fields,'molds' => $molds),null,'selects');
	$fields=explode(',',$f['selects']);
	$k=array_search('='.$key, $fields);
	$fields=explode('=',$fields[$k]);
	return $fields[0];
}
//返回多附件字段数组
function fileall($fileall){
	if($fileall!=''){
		$fileall=explode('|-|',$fileall);
		$f=array();
		foreach($fileall as $v){
			$v=explode('|,|',$v);
			$f=array_merge($f,array(array($v[0],$v[1])));
		}
		return $f;
	}
}
//时间比较
function newest($t,$h){
	$t=(time()-$t)/3600;
	if($t < $h){return true;}else{return false;}
}
//替换内容静态规则
function html_rules($mold,$d,$id='',$f=''){
	if($f=='')$f=$id;
	$u=syExt('site_html_dir').'/'.str_replace(array('[y]','[m]','[d]','[id]','[file]','[mold]'),array(date('Y',$d),date('m',$d),date('d',$d),$id,$f,$mold),syExt('site_html_rules'));
	return str_replace(array('///','//'),'/',$u);
}
//页面URL判断
function html_url($type,$c,$pages=0,$ispage){
	if($c['gourl']!='')return $c['gourl'];
	$sh=syExt("site_html");
	$sr=$GLOBALS['G_DY']['url']["url_path_base"];
	$sg=$GLOBALS["WWW"];
	$re=$GLOBALS['G_DY']['rewrite']["rewrite_open"];
	switch($type){
		case 'article':
			if($re==1){
				$re_url=$sg.$GLOBALS['G_DY']['rewrite']["rewrite_article"];
				if($c['htmlfile']=='')$c['htmlfile']=$c['id'];
				$go_url=str_replace(array('{id}','{file}'),array($c['id'],$c['htmlfile']),$re_url);
				$go_url=str_replace(array('{article}'),'article',$go_url);
				if($pages!==0){
					$go_url=str_replace('{page}','[p]',$go_url);
					$go_url=pagetxt_html($go_url,$pages['total_page'],$ispage);
				}else{$go_url=str_replace('{page}',1,$go_url);}
			}else if($sh==1&&$c['mrank']==0&&$c['mgold']==0&&$c['htmlurl']!=''){
				$go_url=$sg.$c['htmlurl'];
				$go_url=str_replace(array("///","//"),"/",$go_url);
				if($pages!==0){
					$go_url=str_replace('.','[p].',$go_url);
					$go_url=pagetxt_html($go_url,$pages['total_page'],$ispage);
				}
			}else{
				$go_url=$sr.'?c=article&id='.$c['id'];
				if($pages!==0)$go_url=pagetxt($pages);
			}
		break;
		case 'product':
			if($re==1){
				$re_url=$sg.$GLOBALS['G_DY']['rewrite']["rewrite_product"];
				if($c['htmlfile']=='')$c['htmlfile']=$c['id'];
				$go_url=str_replace(array('{id}','{file}'),array($c['id'],$c['htmlfile']),$re_url);
				$go_url=str_replace(array('{product}'),'product',$go_url);
				if($pages!==0){
					$go_url=str_replace('{page}','[p]',$go_url);
					$go_url=pagetxt_html($go_url,$pages['total_page'],$ispage);
				}else{$go_url=str_replace('{page}',1,$go_url);}
			}else if($sh==1&&$c['mrank']==0&&$c['mgold']==0&&$c['htmlurl']!=''){
				$go_url=$sg.$c['htmlurl'];
				$go_url=str_replace(array("///","//"),"/",$go_url);
				if($pages!==0){
					$go_url=str_replace('.','[p].',$go_url);
					$go_url=pagetxt_html($go_url,$pages['total_page'],$ispage);
				}
			}else{
				$go_url=$sr.'?c=product&id='.$c['id'];
				if($pages!==0)$go_url=pagetxt($pages);
			}
		break;
		case 'classtype':
			if($re==1){
				$re_url=$sg.$GLOBALS['G_DY']['rewrite']['rewrite_'.$c['molds'].'_type'];
				$go_url=str_replace(array('{tid}','{file}'),array($c['tid'],$c['htmlfile']),$re_url);
				$go_url=str_replace(array('{'.$c['molds'].'}','{type}'),array($c['molds'],type),$go_url);
				if($pages!==0){
					$go_url=str_replace('{page}','[p]',$go_url);
					$go_url=pagetxt_html($go_url,$pages['total_page'],$ispage);
				}else{$go_url=str_replace('{page}',1,$go_url);}
			}else if($sh==1&&$c['mrank']==0){
				if($c["htmlfile"]!=''){$html_file=$c["htmlfile"].syExt("site_html_suffix");}
				else{$html_file='index'.syExt("site_html_suffix");}
				if($c["htmldir"]==''){ 
					$go_url=$sg.syExt("site_html_dir")."/c/".$c["tid"]."/".$html_file;
				}else{ 
					$go_url=$sg.$c["htmldir"]."/".$html_file;
				}
				$go_url=str_replace(array("///","//"),"/",$go_url);
				if($pages!==0){
					$go_url=str_replace('.','[p].',$go_url);
					$go_url=pagetxt_html($go_url,$pages['total_page'],$ispage);
				}
			}else{ 
				$go_url=$sr."?c=".$c["molds"]."&a=type&tid=".$c["tid"];
				if($pages!==0)$go_url=pagetxt($pages);
			}
		break;
		case 'special':
			if($re==1){
				$re_url=$sg.$GLOBALS['G_DY']['rewrite']["rewrite_special"];
				$go_url=str_replace(array('{sid}','{file}'),array($c['sid'],$c['htmlfile']),$re_url);
				$go_url=str_replace(array('{special}'),'special',$go_url);
				if($pages!==0){
					$go_url=str_replace('{page}','[p]',$go_url);
					$go_url=pagetxt_html($go_url,$pages['total_page'],$ispage);
				}else{$go_url=str_replace('{page}',1,$go_url);}
			}else if($sh==1){ 
				if($c["htmlfile"]!=''){$html_file=$c["htmlfile"].syExt("site_html_suffix");}
				else{$html_file='index'.syExt("site_html_suffix");}
				if($c["htmldir"]==''){ 
					$go_url=$sg.syExt("site_html_dir")."/s/".$c["sid"]."/".$html_file;
				}else{
					$go_url=$sg.$c["htmldir"]."/".$html_file;
				}
				$go_url=str_replace(array("///","//"),"/",$go_url);
				if($pages!==0){
					$go_url=str_replace('.','[p].',$go_url);
					$go_url=pagetxt_html($go_url,$pages['total_page'],$ispage);
				}
			}else{ 
				$go_url=$sr."?c=special&sid=".$c["sid"];
				if($pages!==0)$go_url=pagetxt($pages);
			}
		break;
		case 'labelcus_custom':
			if($re==1){
				$re_url=$sg.$GLOBALS['G_DY']['rewrite']["rewrite_labelcus_custom"];
				$go_url=str_replace(array('{file}'),array($c['file']),$re_url);
				if($pages!==0){
					$go_url=str_replace('{page}','[p]',$go_url);
					$go_url=pagetxt_html($go_url,$pages['total_page'],$ispage);
				}else{$go_url=str_replace('{page}',1,$go_url);}
			}else if($sh==1||$c["html"]){ 
				$html_file=$c["file"];
				if($c["dir"]==''){ 
					$go_url=$sg.syExt("site_html_dir")."/".$html_file;
				}else{
					$go_url=$sg.$c["dir"]."/".$html_file;
				}
				$go_url=str_replace(array("///","//"),"/",$go_url);
				if($pages!==0){
					$go_url=str_replace('.','[p].',$go_url);
					$go_url=pagetxt_html($go_url,$pages['total_page'],$ispage);
				}
			}else{
				$go_url="index.php?file=".$c["file"];
				if($pages!==0)$go_url=pagetxt($pages);
			}
		break;
	}
	return $go_url;
}
//分页代码
function pagetxt($pagearray,$pageno=3){
	$pagetxt='';$pageurl=$_SERVER["QUERY_STRING"];
	if($pagearray['current_page']>1){
		$pagetxt.='<li><a href="'.url_set_value($pageurl,'page',1).'">首页</a></li><li><a href="'.url_set_value($pageurl,'page',$pagearray['prev_page']).'">上一页</a></li>';
	}
	$pageno1=$pagearray['current_page']-$pageno;if($pageno1<1)$pageno1=1;
	$pageno2=$pagearray['current_page']+$pageno;if($pageno2>$pagearray['total_page']){$pageno2=$pagearray['total_page'];}
	while($pageno1<=$pageno2){
		if($pagearray['current_page']==$pageno1){$pagetxt.='<li class="c">'.$pageno1.'</li>';}else{$pagetxt.='<li><a href="'.url_set_value($pageurl,'page',$pageno1).'">'.$pageno1.'</a></li>';}
		$pageno1++;
	}
	if($pagearray['current_page'] < $pagearray['last_page']){
		$pagetxt.='<li><a href="'.url_set_value($pageurl,'page',$pagearray['next_page']).'">下一页</a></li><li><a href="'.url_set_value($pageurl,'page',$pagearray['last_page']).'">尾页</a></li>';
	}
	return $pagetxt;
}
//静态html分页代码
function pagetxt_html($url,$total_page,$current_page,$pageno=3){
	if($GLOBALS['G_DY']['rewrite']["rewrite_open"]==1){$is_p=1;}else{$is_p='';}
	$pagetxt='';$n=$current_page+1;$p=$current_page-1;
	if($current_page>1){
		$pagetxt.='<li><a href="'.str_replace('[p]',$is_p,$url).'">首页</a></li>';
		if($current_page==2){$pagetxt.='<li><a href="'.str_replace('[p]',$is_p,$url).'">上一页</a></li>';
		}else{$pagetxt.='<li><a href="'.str_replace('[p]',$p,$url).'">上一页</a></li>';}
	}
	$pageno1=$current_page-$pageno;if($pageno1<1)$pageno1=1;
	$pageno2=$current_page+$pageno;if($pageno2>$total_page)$pageno2=$total_page;
	while($pageno1<=$pageno2){
		if($current_page==$pageno1){$pagetxt.='<li class="c">'.$pageno1.'</li>';}else{
			if($pageno1==1){$pagetxt.='<li><a href="'.str_replace('[p]',$is_p,$url).'">'.$pageno1.'</a></li>';
			}else{$pagetxt.='<li><a href="'.str_replace('[p]',$pageno1,$url).'">'.$pageno1.'</a></li>';}
		}
		$pageno1++;
	}
	if($current_page < $total_page){
		$pagetxt.='<li><a href="'.str_replace('[p]',$n,$url).'">下一页</a></li><li><a href="'.str_replace('[p]',$total_page,$url).'">尾页</a></li>';
	}
	return $pagetxt;
}
//评论分页
function pagetxt_comment($pagearray,$url,$pageno=3){
	$pagetxt='';
	if($pagearray['current_page']>1){
		$pagetxt.='<li><a href="'.$url.'&comment_page=1">首页</a></li><li><a href="'.$url.'&comment_page='.$pagearray['prev_page'].'">上一页</a></li>';
	}
	$pageno1=$pagearray['current_page']-$pageno;if($pageno1<1){$pageno1=1;}
	$pageno2=$pagearray['current_page']+$pageno;if($pageno2>$pagearray['total_page']){$pageno2=$pagearray['total_page'];}
	while($pageno1<=$pageno2){
		if($pagearray['current_page']==$pageno1){$pagetxt.='<li class="c">'.$pageno1.'</li>';}else{$pagetxt.='<li><a href="'.$url.'&comment_page='.$pageno1.'">'.$pageno1.'</a></li>';}
		$pageno1++;
	}
	if($pagearray['current_page'] < $pagearray['last_page']){
		$pagetxt.='<li><a href="'.$url.'&comment_page='.$pagearray['next_page'].'">下一页</a></li><li><a href="'.$url.'&comment_page='.$pagearray['last_page'].'">尾页</a></li>';
	}
	return $pagetxt;
}