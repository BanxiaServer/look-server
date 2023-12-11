<?php
if(!defined('APP_PATH')||!defined('DOYO_PATH')){exit('Access Denied');}
class message extends syController
{	
	function __construct(){
		parent::__construct();
		if(moldsinfo('message','isshow')!=1)message("留言功能已关闭");
		$this->Class=syClass('c_message');
		$this->dbl=$GLOBALS['G_DY']['db']['prefix'];
		$this->db=$this->dbl.'message';
		$this->sy_class_type=syClass('syclasstype');
		if(!empty($_SESSION['member'])){
			$this->member_g=syDB('member_group')->find(array('gid'=>$_SESSION['member']['gid']));
		}
	}
	function index(){
		$this->display("member/index.html");
	}
	function type(){
		if($this->syArgs('file',1)!=''){
			$this->type=syDB('classtype')->find(' htmlfile="'.$this->syArgs('file',1).'" or tid='.$this->syArgs('file').' ');
			$tid = $this->type['tid'];
		}else{
			$tid = $this->syArgs('tid');
			$this->type=syDB('classtype')->find(" molds='message' and tid=".$tid." ");
		}
		if(!$this->type){message("指定栏目不存在");}

		if($this->type['mrank']>0){
			if(empty($_SESSION['member']))message('本内容需要登录才可访问');
			if(membergroup($this->type['mrank'],'weight')>$this->member_g['weight'])message('本内容需要['.membergroup($this->type['mrank'],'name').']及以上用户才可访问');
		}

		$a=array(
			array('name'=>'标题','input'=>'<input name="title" id="title" type="text" class="inp" value="'.$c['title'].'" style="width:300px;" />','fields'=>'title'),
			array('name'=>'内容','input'=>'<textarea name="body" id="body" class="inp" style="width:400px;">'.$c['body'].'</textarea>','fields'=>'body'),
		);
		$this->fields_r=$this->fields_info($this->type['molds'],$tid);
		$this->fields=array_merge($a,$this->fields_r);
		
		$t=$this->type['t_index'];
		$w.=" where isshow=1 ";
		$w.="and tid=$tid ";
		$order=' order by orders desc,addtime desc,id desc';
		$f=syDB('fields')->findAll(" molds='message' and types like '%|".$tid."|%' and lists=1 ");
		if($f){
			foreach($f as $v){$fields.=','.$v['fields'];}
			$sql='select id,tid,title,addtime,orders,isshow,user,body,retime,reply'.$fields.' from '.$this->db.' a left join '.$this->db.'_field b on (a.id=b.aid)'.$w.$order;
		}else{
			$sql='select id,tid,title,addtime,orders,isshow,user,body,retime,reply from '.$this->db.$w.$order;
		}
		$this->lists = $this->Class->syPager($this->syArgs('page',0,1),$this->type['listnum'])->findSql($sql);
		$pages=$this->Class->syPager()->getPager();
		$this->pages=html_url('classtype',$this->type,$pages,$this->syArgs('page',0,1));

		$this->positions='<a href="'.$GLOBALS["WWW"].'">首页</a>';
		foreach($this->sy_class_type->navi($this->syArgs('tid')) as $v){
			$this->positions.='  &gt;  '.$v['classname'];
		}
		$this->display('message/'.$t);
	}
	function vercode(){
		if(md5(strtolower($this->syArgs("vercode",1)))!=$_SESSION['doyo_verify']){echo 'false';}else{echo 'true';}
	}
	function add(){
		if($GLOBALS['G_DY']['vercode']==1){
		if(!$this->syArgs("vercode",1)||md5(strtolower($this->syArgs("vercode",1)))!=$_SESSION['doyo_verify'])message("验证码错误");
		}
		if(!$this->syArgs('tid'))message("请选择栏目");
		$tid=$this->syArgs('tid');
		$this->type=syDB('classtype')->find(array('tid'=>$tid),null,'molds,classname,msubmit');
		if($this->type['msubmit']!=-1){
		if($this->member_g['submit']==0||$this->type['msubmit']==0||membergroup($this->type['msubmit'],'weight')>$this->member_g['weight'])message("本栏目无权发布");
		}
		$isshow = ($this->member_g['audit']==1) ? 1 : 0;
		$user = (!empty($_SESSION['member'])) ? $_SESSION['member']['user'] : '游客';
		$row1 = array('tid' => $tid,'title' => $this->syArgs('title',1),'addtime' => time(),'orders' => 0,'isshow' => $isshow,'user' => $user,'body' => $this->syArgs('body',1),'reply'=>'');
		$row2=$this->fields_args('message',$tid);
		$add = syClass('c_message');$newv=$add->syVerifier($row1);
		if(false == $newv){
			$a=$add->create($row1);$row2=array_merge($row2,array('aid' => $a));
			syDB('message_field')->create($row2);
			message('留言发布成功',$_SERVER['HTTP_REFERER']);
		}else{message_err($newv);}
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
			if($f['fieldstype']=='checkbox'){if($this->syArgs($f['fields'],2)){$ns='|'.implode('|',$this->syArgs($f['fields'],2)).'|';}else{$ns='';}}
			if($molds=='member'&&$lists==1){if($ns=='')message("请输入".$f['fieldsname']);}
			$n=array($f['fields'] => $ns);
			$fa=array_merge($fa,$n);
		}
		return $fa;
	}
	private function fields_info($molds,$tid=0,$c=array(),$lists=0){
		$allfields=array();
		$fieldswhere=" fieldshow=1 and issubmit=1 and molds='".$molds."'";
		if($tid){$fieldswhere.=" and types like '%|".$tid."|%' ";}
		if($lists){$fieldswhere.=" and lists=1 ";}
		$v=syDB('fields')->findAll($fieldswhere,' fieldorder DESC,fid ');
		foreach($v as $f){
			$m='';
			switch ($f['fieldstype']){
				case 'varchar':
					if($f['fieldslong']>255){
						$t='<textarea name="'.$f['fields'].'" style="width:300px; height:50px;" class="inp">'.$c[$f['fields']].'</textarea>';
					}else{
						$t='<input name="'.$f['fields'].'" type="text" class="inp" value="'.$c[$f['fields']].'" />';
					}
					$m='最多'.$f['fieldslong'].'个字';
				break;
				case 'text':
					$t='<script type="text/javascript">$("#'.$f['fields'].'").xheditor({tools:"mini",forcePtag:false,cleanPaste:3,internalStyle:false,inlineStyle:false})</script>';
					$t.='<textarea name="'.$f['fields'].'" id="'.$f['fields'].'" style="width:100%;">'.$c[$f['fields']].'</textarea>';
				break;
				case 'int':
					$t='<input name="'.$f['fields'].'" type="text" class="inp" value="'.$c[$f['fields']].'" />';
					$m='请输入整数格式，可为负数';
				break;
				case 'decimal':
					$t='<input name="'.$f['fields'].'" type="text" class="inp" value="'.$c[$f['fields']].'" />';
					$m='请输入货币格式，如2.03';
				break;
				case 'time':
					if($c[$f['fields']]!=''){$time=date('Y-m-d H:i',$c[$f['fields']]);}else{$time=date('Y-m-d H:i');}
					$t='<input name="'.$f['fields'].'" type="text" class="inp" value="'.$time.'" onClick="WdatePicker({dateFmt:';$t.="'yyyy-MM-dd HH:mm'";$t.='})" />';
				break;
				case 'select':
					$t='<select name="'.$f['fields'].'">';
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
						$t.='<input type="checkbox" name="'.$f['fields'].'[]" value="'.$s[1].'" ';
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