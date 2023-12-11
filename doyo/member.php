<?php
if(!defined('APP_PATH')||!defined('DOYO_PATH')){exit('Access Denied');}
class member extends syController
{	
	function __construct(){
		parent::__construct();
		syClass('symember');
		$this->cu=syClass('c_member');
		$this->dbl=$GLOBALS['G_DY']['db']['prefix'];
		$this->db=$this->dbl.'member';
		$this->sy_class_type=syClass('syclasstype');
		$this->molds_message=syDB('molds')->find(array('molds'=>'message'));
		$this->fun_comment=syDB('funs')->find(array('funs'=>'comment'));
		if(!empty($_SESSION['member'])){
			$this->member_g=syDB('member_group')->find(array('gid'=>$_SESSION['member']['gid']));
			if($this->member_g['submit']==1){
			$weight=syDB('member_group')->findAll(' weight<'.$this->member_g['weight'].' ',null,'gid');
			foreach($weight as $v){$w.=$v['gid'].',';}
			$w.=$_SESSION['member']['gid'];
			$this->typemenu=syDB('classtype')->findAll(' msubmit>0 and msubmit in('.$w.') ',' orders desc,tid ','tid,molds,classname,orders,msubmit');
			}
		}
	}
	function index(){
		$this->display("member/index.html");
	}
	function login(){
		if($this->syArgs("go")==1){
			if($this->syArgs("user",1) && $this->syArgs("pass",1)){
				if($GLOBALS['G_DY']['vercode']==1){
				if(!$this->syArgs("vercode",1)||md5(strtolower($this->syArgs("vercode",1)))!=$_SESSION['doyo_verify'])message("验证码错误");
				}
				$conditions = array('user' => $this->syArgs("user",1),'pass' => md5(md5($this->syArgs("pass",1)).$this->syArgs("user",1)));
				$r = syDB('member')->find($conditions);
				if(!$r){
					message("用户名或密码错误");
				}else{
					$weight=syDB('member_group')->find(array('gid'=>$r['gid']));
					$_SESSION['member'] = array(
						'user' => $r['user'],
						'id' => $r['id'],
						'gid' => $r['gid'],
					);
					$this->jump("?c=member");
				}
			}else{
				message("请输入用户名和密码");
			}
		}
		$this->display("member/login.html");
	}
	function out(){
		$_SESSION['member'] = array();
		if (isset($_COOKIE[session_name()])) {setcookie(session_name(), '', time()-42000, '/');}
		session_destroy();
		$this->jump($GLOBALS['WWW']);
	}
	function rules(){
		if($this->syArgs("r")==1){
			if(syDB('member')->find(array('user'=>$this->syArgs('user',1)))){echo 'false';}else{echo 'true';}
		}
		if($this->syArgs("r")==2){
			if(md5(strtolower($this->syArgs("vercode",1)))!=$_SESSION['doyo_verify']){echo 'false';}else{echo 'true';}
		}
	}
	function reg(){
		$this->fields=$this->fields_info('member',0,array(),1);
		if($this->syArgs("go")==1){
			if(!$this->syArgs('user',1))message("请输入用户名");
			if(syDB('member')->find(array('user'=>$this->syArgs('user',1))))message("用户名已被注册，请更换");
			if(!$this->syArgs('pass1',1))message("请输入密码");
			if(!$this->syArgs('pass2',1))message("请输入确认密码");
			if(!$this->syArgs('email',1))message("请输入Email");
			if($this->syArgs('pass1',1)!=$this->syArgs('pass2',1))message("两次密码输入不一致");
			if($GLOBALS['G_DY']['vercode']==1){
			if(md5(strtolower($this->syArgs("vercode",1)))!=$_SESSION['doyo_verify']){message("验证码错误");}
			}
			$newrow1 = array(
				'user' => $this->syArgs('user',1),
				'pass' => md5(md5($this->syArgs("pass1",1)).$this->syArgs("user",1)),
				'email' => $this->syArgs('email',1),
				'gid' => 1,
				'money' => 0,
				'regtime' => time(),
			);
			$newrow2 = array();
			$newrow2=array_merge($newrow2,$this->fields_args('member',0,1));
			$newVerifier=$this->cu->syVerifier($newrow1);
			if(false == $newVerifier){
				$addnewrow=$this->cu->create($newrow1);
				if($addnewrow==FALSE){message("注册失败，请重新注册");}
				$arrays = array(
					'aid' => $addnewrow,
				);
				$newrow2=array_merge($newrow2,$arrays);
				syDB('member_field')->create($newrow2);
				$_SESSION['member'] = array(
					'user' => $newrow1['user'],
					'id' => $addnewrow,
					'gid' => 1,
				);
				message("恭喜您，注册成功","?c=member");
			}else{message_err($newVerifier);}
		}
		$this->display("member/reg.html");
	}
	function myinfo(){
		if($this->syArgs("go")==1){
			if(!$this->syArgs('email',1))message("请输入Email");
			$newrow1 = array('email' => $this->syArgs('email',1));
			if($this->syArgs('pass',1)||$this->syArgs('pass1',1)||$this->syArgs('pass2',1)){
				if(!$this->syArgs('pass',1))message("请输入原密码");
				if(!syDB('member')->find(array('user'=>$_SESSION['member']['user'],'pass'=>md5(md5($this->syArgs("pass",1)).$_SESSION['member']['user']))))message("原密码错误");
				if(!$this->syArgs('pass1',1))message("请输入新密码");
				if(!$this->syArgs('pass2',1))message("请输入确认新密码");
				if($this->syArgs('pass1',1)!=$this->syArgs('pass2',1))message("两次密码输入不一致");
				$newrow1=array_merge($newrow1,array('pass' => md5(md5($this->syArgs("pass1",1)).$_SESSION['member']['user'])));
			}
			$newrow2=array();
			$newrow2=array_merge($newrow2,$this->fields_args('member'));
			syDB('member')->update(array('id'=>$_SESSION['member']['id']),$newrow1);
			syDB('member_field')->update(array('aid'=>$_SESSION['member']['id']),$newrow2);
			message("资料修改成功");
		}
		$user=syDB('member')->findSql('select * from '.$this->db.' a left join '.$this->db.'_field b on (a.id=b.aid) where id='.$_SESSION['member']['id']);
		$this->my=$user[0];
		$this->fields=$this->fields_info('member',0,$this->my,0);
		$this->display("member/myinfo.html");
	}
	function mylist(){
		if(!$this->syArgs('tid'))message("请指定内容tid","?c=member");
		$tid = $this->syArgs('tid');
		$this->type=syDB('classtype')->find(array('tid'=>$tid),null,'tid,molds,classname,msubmit');
		$c=syClass('c_'.$this->type['molds']);
		if($this->member_g['submit']==0||membergroup($this->type['msubmit'],'weight')>$this->member_g['submit'])message("本栏目无权投稿","?c=member");
		$db=$GLOBALS['G_DY']['db']['prefix'].$this->type['molds'];
		$tid_leafid=$this->sy_class_type->leafid($tid);
			$w=" where tid in(".$tid_leafid.") and user='".$_SESSION['member']['user']."' and usertype=1 ";
			$order=' order by orders desc,id desc';
			$f=syDB('fields')->findAll(" molds='".$this->type['molds']."' and types like '%|".$tid."|%' and lists=1 ");
			if($f){
				foreach($f as $v){$fields.=','.$v['fields'];}
				$sql='select a.*'.$fields.' from '.$db.' a left join '.$db.'_field b on (a.id=b.aid)'.$w.$order;
			}else{
				$sql='select * from '.$db.$w.$order;
			}
		$this->lists = $c->syPager($this->syArgs('page',0,1),20)->findSql($sql);
		$pages=$c->syPager()->getPager();
		$this->pages=pagetxt($pages,$GLOBALS['G_DY']['url']["url_path_base"].'?c=member&a=mylist&tid='.$tid);
		$this->display("member/mylist.html");
	}
	function mymessage(){
		$this->lists=syDB('message')->findAll(" user='".$_SESSION['member']['user']."' ",'addtime desc,id desc');
		$c=syClass('c_message');
		$this->lists=$c->syPager($this->syArgs('page',0,1),10)->findAll(array('user'=>$_SESSION['member']['user']),' addtime desc ');
		$c_page=$c->syPager()->getPager();
		$this->pages=pagetxt($c_page,$GLOBALS['G_DY']['url']["url_path_base"].'?c=member&a=mymessage');
		$this->display("member/mymessage.html");
	}
	function mycomment(){
		$c=syClass('c_comment');
		$this->lists=$c->syPager($this->syArgs('page',0,1),10)->findAll(array('user'=>$_SESSION['member']['user']),' addtime desc ');
		$c_page=$c->syPager()->getPager();
		$this->pages=pagetxt($c_page,$GLOBALS['G_DY']['url']["url_path_base"].'?c=member&a=mycomment');
		$this->display("member/mycomment.html");
	}
	function mydel(){
		$molds=$this->syArgs('molds',1);
		$id=$this->syArgs('id');
		switch ($molds){
			case 'comment':
				if(!syDB('comment')->delete(array('cid'=>$id))){
					message("删除失败,请重新提交");
				}
			break;
			default:
				$c=syDB($molds)->find(array('id'=>$id),null,'id,isshow');
				if($c['isshow']==1)message("此内容已经审核，不能删除。");
				if(!syDB($molds)->delete(array('id'=>$id))&&!syDB($molds.'_field')->delete(array('aid'=>$id))){
					message("删除失败,请重新提交");
				}
			break;
		}
		message("删除成功");
	}
	function release(){
		if(!$this->syArgs('tid'))message("请选择栏目","?c=member");
		$this->id=$this->syArgs('id');
		$tid=$this->syArgs('tid');
		$this->type=syDB('classtype')->find(array('tid'=>$tid),null,'tid,molds,classname,msubmit');
		if($this->type['msubmit']!=-1){
		if($this->member_g['submit']==0||$this->type['msubmit']==0||membergroup($this->type['msubmit'],'weight')>$this->member_g['weight'])message("无权发布","?c=member");
		}
		if($this->syArgs("go")==1){
			if($GLOBALS['G_DY']['vercode']==1){
			if(!$this->syArgs("vercode",1)||md5(strtolower($this->syArgs("vercode",1)))!=$_SESSION['doyo_verify'])message("验证码错误");
			}
			$isshow = ($this->member_g['audit']==1) ? 1 : 0;
			//按频道投稿入库
			  $row1 = array('tid' => $tid,'sid' => 0,'title' => $this->syArgs('title',1),'style' => '','trait' => '','gourl' => '','htmlfile' => '','htmlurl' => '','addtime' => time(),'hits' => 0,'litpic' => '','orders' => 0,'mrank' => 0,'mgold' => 0,'isshow' => $isshow,'keywords' => '','description' => '','user' => $_SESSION['member']['user'],'usertype' => 1);
			  if($this->type['molds']=='product')$row1=array_merge(array('price' => $this->syArgs('price',3),'photo' => ''),$row1);
			  $row2=array_merge(array('body' => $this->syArgs('body',1)),$this->fields_args($this->type['molds'],$tid));
			  $add = syClass('c_'.$this->type['molds']);$newv=$add->syVerifier($row1);
			  if(false == $newv){
				  if($this->id){
					  if(syDB($this->type['molds'])->find(array('tid'=>$tid,'id'=>$this->id,'user'=>$_SESSION['member']['user'],'usertype'=>1))){
						  syDB($this->type['molds'])->update(array('id' => $this->id),$row1);
						  syDB($this->type['molds'].'_field')->update(array('aid' => $this->id),$row2);
					  }else{message('无权操作');}
				  }else{
					  $a=$add->create($row1);$row2=array_merge($row2,array('aid' => $a));
					  syDB($this->type['molds'].'_field')->create($row2);
				  }
				  syDB('member_file')->update(array('hand'=>$this->syArgs('hand'),'uid'=>$_SESSION['member']['id']),array('hand'=>0,'aid'=>$a,'molds' => $this->type['molds']));
				  message('内容更新成功','?c=member&a=mylist&tid='.$tid);
			  }else{message_err($newv);}
			//--------------
		}
		$this->hand=date('His').mt_rand(100,999);
		if($this->id){
		$c=syDB($this->type['molds'])->findSql('select * from '.$this->dbl.$this->type['molds'].' a left join '.$this->dbl.$this->type['molds'].'_field b on (a.id=b.aid) where user="'.$_SESSION['member']['user'].'" and usertype=1 and id='.$this->id);
		$c=$c[0];
		}
		
		$this->fields=array();
		//按频道显示投稿字段
		switch ($this->type['molds']){
			case 'article':
				$a=array(
					array('name'=>'游戏名称','input'=>'<input name="title" id="title" type="text" class="inp" value="'.$c['title'].'" style="width:300px;" />','fields'=>'title'),
					array('name'=>'游戏设置','input'=>'<textarea name="body" id="body1" class="xheditor-mini" style="width:550px;height:260px;">'.$c['body'].'</textarea>','fields'=>'body'),
				);
				$this->fields=array_merge($this->fields,$a);
			break;
			case 'product':
				$a=array(
					array('name'=>'标题','input'=>'<input name="title" id="title" type="text" class="inp" value="'.$c['title'].'" style="width:300px;" />','fields'=>'title'),
					array('name'=>'价格','input'=>'<input name="price" id="price" type="text" class="inp" value="'.$c['price'].'" style="width:300px;" />','fields'=>'price'),
					array('name'=>'内容','input'=>'<textarea name="body" id="body1" class="inp" style="width:550px;height:200px;">'.$c['body'].'</textarea>','fields'=>'body'),
				);
				$this->fields=array_merge($this->fields,$a);
			break;
		}
		//--------------
		if($c){$this->fields=array_merge($this->fields,$this->fields_info($this->type['molds'],$tid,$c,0,$this->hand));}
		else{$this->fields=array_merge($this->fields,$this->fields_info($this->type['molds'],$tid,array(),0,$this->hand));}
		$this->display("member/release.html");
	}
	function m_upload(){
		$ufm=syDB('member_file')->findSql('SELECT sum(size) FROM '.$this->db.'_file where uid='.$_SESSION['member']['id']);
		if($ufm[0]['sum(size)']>$this->member_g['fileallsize']*1024){echo '您的上传空间已满';exit;}
		$fileClass=syClass('syupload',array($this->member_g['filetype'],$this->member_g['filesize']*1024));
		if (!empty($_FILES)){
			$fileinfos = $fileClass->upload_file($_FILES[$this->syArgs('isfiles',1)]);
			if(is_array($fileinfos)){
				$finfo=array(
					'uid' => $_SESSION['member']['id'],
					'url' => $fileinfos['fn'],
					'size' => $fileinfos['si'],
					'fields' => $this->syArgs('inputid',1),
					'hand' => $this->syArgs('hand'),
				);
				$w=' (hand='.$this->syArgs('hand').' and uid='.$_SESSION['member']['id'].' and fields="'.$this->syArgs('inputid',1).'") or (hand!='.$this->syArgs('hand').' and hand!=0 and uid='.$_SESSION['member']['id'].') ';
				foreach(syDB('member_file')->findAll($w,null,'hand,fields,uid,url') as $v){@unlink($v['url']);}
				syDB('member_file')->delete($w);
				syDB('member_file')->create($finfo);
				echo '0';
					$f=explode('.',$fileinfos['fn']);
					echo ','.$fileinfos['fn'];
					echo ','.preg_replace('/.*\/.*\//si','',$f[0]);
					if(stripos($fileinfos['fn'],'jpg') || stripos($fileinfos['fn'],'gif') || stripos($fileinfos['fn'],'png') || stripos($fileinfos['fn'],'jpeg')){
						echo ',1';
					}else{
						echo ','.$f[1];
					}
			}else{
				echo $fileClass->errmsg;
			}
		}
	}
	function m_upload_load(){
		$this->hand=$this->syArgs('hand');
		$this->inputid=$this->syArgs('inputid',1);
		if(!$this->hand||$this->inputid=='')message("no hand or inputid");
		$this->multi=$this->syArgs('multi') ? 'true':'false';
		if($this->syArgs('fileExt',1)){$this->fileExt=$this->syArgs('fileExt',1);}else{
			foreach(explode(',',$this->member_g['filetype']) as $v){
				$fileExt.=';*.'.$v;
			}$this->fileExt=substr($fileExt,1);
		}
		$this->sizeLimit=$this->syArgs('sizeLimit') ? $this->syArgs('sizeLimit'):$this->member_g['filesize']*1024;
		$this->fileover=$this->syArgs('fileover') ? $this->syArgs('fileover'):1;
		$this->display("member/uploads.html");
	}
	private function fields_args($molds,$tid=0,$lists=0){
		$fa=array();
		$fieldswhere=" fieldshow=1 and issubmit=1 and molds='".$molds."'";
		if($tid){$fieldswhere.=" and types like '%|".$tid."|%' ";}
		if($lists){$fieldswhere.=" and lists=1 ";}
		$v=syDB('fields')->findAll($fieldswhere,' fieldorder DESC,fid ');
		foreach($v as $f){
			if($f['fieldstype']=='varchar' || $f['fieldstype']=='files' || $f['fieldstype']=='select' || $f['fieldstype']=='text'){$ns=$this->syArgs($f['fields'],1);}
			if($f['fieldstype']=='int'){$ns=$this->syArgs($f['fields']);}
			if($f['fieldstype']=='decimal'){$ns=$this->syArgs($f['fields'],3);}
			if($f['fieldstype']=='time'){$ns=strtotime($this->syArgs($f['fields'],1));}
			if($f['fieldstype']=='fileall'){
				$fieldsall=$this->syArgs($f['fields'].'file',2);
				if($fieldsall){
					$txt=$this->syArgs($f['fields'].'txt',2);$ns='';
					foreach($fieldsall as $k=>$v){
						$ns.='|-|'.$v.'|,|'.$txt[$k];
					}
					$ns=substr($ns,3);
				}
			}
			if($f['fieldstype']=='checkbox'){if($this->syArgs($f['fields'],2)){$ns='|'.implode('|',$this->syArgs($f['fields'],2)).'|';}else{$ns='';}}
			if($molds=='member'&&$lists==1){if($ns=='')message("请输入".$f['fieldsname']);}
			$n=array($f['fields'] => $ns);
			$fa=array_merge($fa,$n);
		}
		return $fa;
	}
	private function fields_info($molds,$tid=0,$c=array(),$lists=0,$hand=0){
		$allfields=array();
		$fieldswhere=" fieldshow=1 and issubmit=1 and molds='".$molds."'";
		if($tid!=0)$fieldswhere.=" and types like '%|".$tid."|%' ";
		if($lists!=0)$fieldswhere.=" and lists=1 ";
		$v=syDB('fields')->findAll($fieldswhere,' fieldorder DESC,fid ');
		foreach($v as $f){
			$m='';
			switch ($f['fieldstype']){
				case 'varchar':
					if($f['fieldslong']>255){
						$t='<textarea name="'.$f['fields'].'" id="'.$f['fields'].'" style="width:300px; height:50px;" class="inp">'.$c[$f['fields']].'</textarea>';
					}else{
						$t='<input name="'.$f['fields'].'" id="'.$f['fields'].'" type="text" class="inp" value="'.$c[$f['fields']].'" />';
					}
					$m='最多'.$f['fieldslong'].'个字';
				break;
				case 'text':
					$t.='<textarea name="'.$f['fields'].'" id="'.$f['fields'].'" style="width:320px;height:80px;" class="inp">'.$c[$f['fields']].'</textarea>';
				break;
				case 'int':
					$t='<input name="'.$f['fields'].'" id="'.$f['fields'].'" type="text" class="inp" value="'.$c[$f['fields']].'" />';
					$m='请输入整数格式，可为负数';
				break;
				case 'decimal':
					$t='<input name="'.$f['fields'].'" id="'.$f['fields'].'" type="text" class="inp" value="'.$c[$f['fields']].'" />';
					$m='请输入货币格式，如2.03';
				break;
				case 'time':
					if($c[$f['fields']]!=''){$time=date('Y-m-d H:i',$c[$f['fields']]);}else{$time=date('Y-m-d H:i');}
					$t='<input name="'.$f['fields'].'" id="'.$f['fields'].'" type="text" class="inp" value="'.$time.'" onClick="WdatePicker({dateFmt:';$t.="'yyyy-MM-dd HH:mm'";$t.='})" />';
				break;
				case 'files':
				$t='<table border="0" cellspacing="0" cellpadding="0"><tr><td><input name="'.$f['fields'].'" id="'.$f['fields'].'" type="text" class="inp" value="'.$c[$f['fields']].'" /></td><td width="5"></td><td><iframe frameborder="0" width="300" height="26" scrolling="No" id="flitpic" name="flitpic" src="?c=member&a=m_upload_load&inputid='.$f['fields'].'&hand='.$hand.'" style="float:left;"></iframe></td></tr></table>';
				break;
				case 'fileall':
				$t='<table border="0" cellspacing="0" cellpadding="0"><tr><td><input name="'.$f['fields'].'" id="'.$f['fields'].'" type="text" class="inp" value="'.$c[$f['fields']].'" /></td><td width="5"></td><td><iframe frameborder="0" width="300" height="26" scrolling="No" id="flitpic" name="flitpic" src="?c=member&a=m_upload_load&inputid='.$f['fields'].'&hand='.$hand.'" style="float:left;"></iframe></td></tr></table>';
				break;
				case 'select':
					$t='<select name="'.$f['fields'].'" id="'.$f['fields'].'">';
					foreach(explode(',',$f['selects']) as $v){
						$s=explode('=',$v);
						$t.='<option value="'.$s[1].'" ';
						if($c[$f['fields']]==$s[1])$t.='selected="selected"';
						$t.='>'.$s[0].'</option>';
					}
					$t.='</select>';
				break;
				case 'checkbox':
					$t='';
					foreach(explode(',',$f['selects']) as $v){
						$s=explode('=',$v);
						$t.='<input type="checkbox" id="'.$f['fields'].'" name="'.$f['fields'].'[]" value="'.$s[1].'" ';
						if(stristr($c[$f['fields']],'|'.$s[1].'|')!=FALSE)$t.='checked="checked"';
						$t.='>'.$s[0];
					}
				break;
			}
			$allfields=array_merge($allfields,array(array('name'=>$f['fieldsname'],'input'=>$t,'fields'=>$f['fields'],'m'=>$m)));
		}
		return $allfields;
	}
}	