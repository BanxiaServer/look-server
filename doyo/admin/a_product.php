<?php
if(!defined('APP_PATH')||!defined('DOYO_PATH')){exit('Access Denied');}

class a_product extends syController
{
	function __construct(){
		parent::__construct();
		$this->gopage=$this->syArgs('page',0,1);
		$this->molds = 'product';
		$this->sqldb=$GLOBALS['G_DY']['db']['prefix'].$this->molds;
		$this->moldname=moldsinfo($this->molds,'moldname');
		$this->ClassADD = syClass('c_'.$this->molds);
		$this->chtml = syClass("syhtml");
		$this->ClassT=syClass('c_classtype');
		$this->ClassF=syClass('c_fields');
		$this->auser=syClass('syauser');
		$classtype=syDB('classtype')->findAll(array('molds'=>$this->molds),null,'tid,classname,pid,molds');
		$this->types=syClass('syclasstype');
		$this->typesdb=$this->types->type_txt();
		if(funsinfo('member','isshow')==1){
		$this->member_group = syDB('member_group')->findAll(null,'weight');
		}
		$this->traits=syDB('traits')->findAll(array('molds'=>$this->molds));
		if(funsinfo('special','isshow')==1){
			$this->specials=syDB('special')->findAll(array('molds'=>$this->molds,'isshow'=>1));
		}
		$this->gocid=$this->syArgs('cid');
		if(($this->syArgs('a',1)=='add'||$this->syArgs('a',1)=='edit')&&$this->syArgs('run')==1){
			$addtime=strtotime($this->syArgs('addtime',1));
			$style=$this->syArgs('style1',1).$this->syArgs('style2',1);
			if($this->syArgs('trait',2)){$trait=','.implode(',',$this->syArgs('trait',2)).',';}else{$trait='';}
			if($this->syArgs('tid')){$tid=$this->syArgs('tid');}
			if($this->syArgs('photofile',2)){
				$phototxt=$this->syArgs('phototxt',2);$ns='';
				foreach($this->syArgs('photofile',2) as $k=>$v){
					$ns.='|-|'.$v.'|,|'.$phototxt[$k];
				}
				$photo=substr($ns,3);
			}
			$this->newrow1 = array(
				'tid' => $tid,
				'sid' => $this->syArgs('sid'),
				'title' => $this->syArgs('title',1),
				'style' => $style,
				'trait' => $trait,
				'gourl' => $this->syArgs('gourl',1),
				'htmlfile' => strtolower($this->syArgs('htmlfile',1)),
				'htmlurl' => '',
				'addtime' => $addtime,
				'hits' => $this->syArgs('hits'),
				'litpic' => $this->syArgs('litpic',1),
				'photo' => $photo,
				'orders' => $this->syArgs('orders'),
				'price' => $this->syArgs('price',3),
				'mrank' => $this->syArgs('mrank'),
				'mgold' => $this->syArgs('mgold',3),
				'isshow' => $this->syArgs('isshow'),
				'keywords' => $this->syArgs('keywords',1),
				'description' => $this->syArgs('description',1),
			);
			if($this->syArgs('a',1)=='add'){$this->newrow1=array_merge($this->newrow1,array('user' => $_SESSION['auser']['auser']));}
			$this->newrow2 = array(
				'body' => $this->syArgs('body',4),
			);
			$v=$this->ClassF->findAll(" molds='".$this->molds."' and types like '%|".$this->syArgs('tid')."|%' ");
			foreach($v as $f){
				if($f['fieldstype']=='varchar' || $f['fieldstype']=='files' || $f['fieldstype']=='select'){$ns=$this->syArgs($f['fields'],1);}
				if($f['fieldstype']=='int'){$ns=$this->syArgs($f['fields']);}
				if($f['fieldstype']=='decimal'){$ns=$this->syArgs($f['fields'],3);}
				if($f['fieldstype']=='text'){$ns=$this->syArgs($f['fields'],4);}
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
				$n=array($f['fields'] => $ns);
				$this->newrow2=array_merge($this->newrow2,$n);
			}
		}
	}
	function index(){
		$this->toptxt=$this->moldname.'列表';
		$this->isshow=$this->syArgs('isshow',1);
		if($this->isshow==1){
			$this->toptxt='已审'.$this->toptxt;
			$conditions.="and isshow=1 ";
		}
		if($this->isshow==2){
			$this->toptxt='待审'.$this->toptxt;
			$conditions.="and isshow=0 ";
		}
		if($_SESSION['auser']['level']==1){
			if($this->syArgs("tid")){$conditions.= "and tid in(".$this->types->leafid($this->syArgs('tid')).") ";}
		}else{
			if($this->syArgs("tid") && $this->auser->checkclass($this->syArgs("tid"))){$conditions.= "and tid in(".$this->types->leafid($this->syArgs('tid')).") and tid in(".trim($_SESSION['auser']['pclasstype'],',').") ";}
			else{if($this->auser->checkclass()==false)message_a("您没有栏目权限");$conditions.= "and tid in(".trim($_SESSION['auser']['pclasstype'],',').") ";}
		}
		if($this->syArgs("sid")){$conditions.= "and sid=".$this->syArgs('sid')." ";}
		if($this->syArgs("trait")){$conditions.= "and trait like '%,".$this->syArgs('trait').",%' ";}
		if($this->syArgs("litpic")){
			if($this->syArgs("litpic")==1){$conditions.="and litpic!='' ";}else{$conditions.= "and litpic='' ";}
		}
		if($this->syArgs("title",1)){$conditions.= "and title like '%".$this->syArgs('title',1)."%' ";}
		if($conditions!=''){$conditions=' where '.substr($conditions,3);}
		$sql='select * from '.$this->sqldb.$conditions.' order by orders desc,addtime desc,id desc';
		$this->listarray = $this->ClassADD->syPager($this->gopage,15)->findSql($sql); 
		$this->pages = pagetxt($this->ClassADD->syPager()->getPager());
		$this->display($this->molds.".html");
	}
	function add(){
		$this->itid=$this->syArgs('tid');
		if ($this->syArgs('run')==1){
			if(!$this->auser->checkclass($this->newrow1['tid'])){message_a("无权操作本栏目内容");}
			$newVerifier=$this->ClassADD->syVerifier($this->newrow1);
				if(false == $newVerifier){
					$addnewrow1=$this->ClassADD->create($this->newrow1);
					if($addnewrow1==FALSE){message_a("主表数据写入失败，请重新提交");}
					$arrays = array(
						'aid' => $addnewrow1,
					);
					if($this->syArgs('all_down_images')==1){
						$upall=syClass('syupload');
						if(!get_magic_quotes_gpc()){$bodynew=$this->newrow2['body'];}else{$bodynew=stripslashes($this->newrow2['body']);}
						preg_match_all('/<img.*?src=[\'|\"](.*?)[\'|\"].*?\/>/si',$bodynew,$pic);
						$pic=array_unique($pic[1]);
						foreach($pic as $v){
							$localUrl=$upall->saveRemoteImg(trim($v));
							if($localUrl){$bodynew=str_ireplace($v,$GLOBALS['WWW'].$localUrl,$bodynew);}
						}
						$arrays=array_merge($arrays,array('body'=>addslashes($bodynew)));
					}
					$this->newrow2=array_merge($this->newrow2,$arrays);
					if(syDB($this->molds.'_field')->create($this->newrow2)){
						if($GLOBALS['G_DY']['rewrite']["rewrite_open"]!=1&&syExt('site_html')==1&&$this->newrow1['isshow']==1&&$this->newrow1['mrank']==0&&$this->newrow1['mgold']==0){
							$c_html_f=html_rules($this->molds,$this->newrow1['addtime'],$addnewrow1,$this->newrow1['htmlfile']);
							syDB($this->molds)->updateField(array('id'=>$addnewrow1),'htmlurl',$c_html_f);
							$this->chtml->c_molds('product',array('id'=>$addnewrow1),$c_html_f);
							$body=array_filter(explode("[doyo|page]",$this->newrow2['body']));
							$allb=count($body);
							if($allb>1){
								for ($i = 1; $i <= $allb; $i++) {
									if($i>1){
									$this->chtml->c_molds('product',array('id'=>$addnewrow1,'page'=>$i),str_replace('.',$i.'.',$c_html_f));
									}
								}
							}
						}
						deleteDir($GLOBALS['G_DY']['sp_cache']);
						message_a($this->moldname.'添加成功','?c=a_'.$this->molds,'<a href="?c=a_'.$this->molds.'">返回列表</a><a href="?c=a_'.$this->molds.'&a=add&tid='.$this->newrow1['tid'].'">继续添加</a>',"8");
					}else{
						syDB($this->molds)->delete(array('id'=>$addnewrow1));
						message_a("附表数据写入失败，请重新提交");
					}
				}else{message_b($newVerifier);}
		}
		$this->toptxt='添加'.$this->moldname;
		$this->postgo='add';
		$this->display($this->molds."_edit.html");
	}
	function edit(){
		$this->carray=$this->ClassADD->findSql('select * from '.$this->sqldb.' a left join '.$this->sqldb.'_field b on (a.id=b.aid) where id='.$this->syArgs('id').' limit 0,1');
		$this->carray=$this->carray[0];
		if(!$this->auser->checkclass($this->carray['tid'])){message_a("无权操作本栏目内容");}
		if ($this->syArgs('run')==1){
			$newVerifier=$this->ClassADD->syVerifier($this->newrow1);
				if(false == $newVerifier){
					if($this->ClassADD->update(array('id'=>$this->syArgs('id')),$this->newrow1)==FALSE)
					{message_a("主表数据修改失败，请重新提交");}
					if($this->syArgs('all_down_images')==1){
						$upall=syClass('syupload');
						if(!get_magic_quotes_gpc()){$bodynew=$this->newrow2['body'];}else{$bodynew=stripslashes($this->newrow2['body']);}
						preg_match_all('/<img.*?src=[\'|\"](.*?)[\'|\"].*?\/>/si',$bodynew,$pic);
						$pic=array_unique($pic[1]);
						foreach($pic as $v){
							$localUrl=$upall->saveRemoteImg(trim($v));
							if($localUrl){$bodynew=str_ireplace($v,$GLOBALS['WWW'].$localUrl,$bodynew);}
						}
						$this->newrow2=array_merge($this->newrow2,array('body'=>addslashes($bodynew)));
					}
					if(!syDB($this->molds.'_field')->find(array('aid'=>$this->syArgs('id')))){
						$this->newrow2=array_merge($this->newrow2,array('aid'=>$this->syArgs('id')));
						$edit_field=syDB($this->molds.'_field')->create($this->newrow2);
					}else{
						$edit_field=syDB($this->molds.'_field')->update(array('aid'=>$this->syArgs('id')),$this->newrow2);
					}
					if($edit_field){
						if($GLOBALS['G_DY']['rewrite']["rewrite_open"]!=1&&syExt('site_html')==1&&$this->newrow1['isshow']==1&&$this->newrow1['mrank']==0&&$this->newrow1['mgold']==0){
							$c_html_f=html_rules($this->molds,$this->newrow1['addtime'],$this->syArgs('id'),$this->newrow1['htmlfile']);
							syDB($this->molds)->updateField(array('id'=>$this->syArgs('id')),'htmlurl',$c_html_f);
							$this->chtml->c_molds('product',array('id'=>$this->syArgs('id')),$c_html_f);
							$body=array_filter(explode("[doyo|page]",$this->newrow2['body']));
							$allb=count($body);
							if($allb>1){
								for ($i = 1; $i <= $allb; $i++) {
									if($i>1){
									$this->chtml->c_molds('product',array('id'=>$this->syArgs('id'),'page'=>$i),str_replace('.',$i.'.',$c_html_f));
									}
								}
							}
						}
						deleteDir($GLOBALS['G_DY']['sp_cache']);
						message_a($this->moldname."修改成功","?c=a_".$this->molds);
					}else{message_a("附表数据修改失败，请重新提交");}
				}else{message_b($newVerifier);}
		}
		$this->traits=syDB('traits')->findAll(array('molds'=>$this->molds));
		$this->toptxt=$this->moldname.'修改内容';
		$this->postgo='edit';
		$this->display($this->molds."_edit.html");
	}
	function del(){
		$this->toptxt=$this->moldname.'删除内容';
		$this->del=$this->ClassADD->find(array('id'=>$this->syArgs('id')));
		if(!$this->auser->checkclass($this->del['tid'])){message_a("无权操作本栏目内容");}
		$id=$this->del['id'];
		if ($this->syArgs('run')==1){
			if(syDB($this->molds)->delete(array('id'=>$id))&&syDB($this->molds.'_field')->delete(array('aid'=>$id))){
				deleteDir($GLOBALS['G_DY']['sp_cache']);
				message_a("删除成功","?c=a_".$this->molds);
			}else{message_a("删除失败,请重新提交");}
		}
		$this->msgtitle='确定要删除 <strong>['.$this->del['title'].']</strong> 吗？';
		$this->msg='';
		$this->msggo='<a href="?c=a_'.$this->molds.'&a=del&run=1&id='.$id.'">确定删除</a><a href="?c=a_'.$this->molds.'">取消操作</a>';
		$this->display("msg.html");
	}
	function alledit(){
		if($this->syArgs('ids',2)===NULL || $this->syArgs('go')===NULL){message_a("请选择操作对象");}
		if($this->syArgs('run')==1){
			$ids=explode(',',$this->syArgs('ids',1));
			switch ($this->syArgs('go')) {
				case 0:
					foreach($ids as $tp){
						$a=$this->ClassADD->find(array('id'=>$tp), null, " id,tid ");
						if($this->auser->checkclass($a['tid']))$this->ClassADD->update(array('id'=>$tp),array('isshow'=>1));
					}
					$this->jump("?c=a_".$this->molds);
					break;
				case 1:
					foreach($ids as $tp){
						$a=$this->ClassADD->find(array('id'=>$tp), null, " id,tid ");
						if($this->auser->checkclass($a['tid']))$this->ClassADD->update(array('id'=>$tp),array('isshow'=>0));
					}
					$this->jump("?c=a_".$this->molds);
					break;
				case 2:
					foreach($ids as $tp){
						$a=$this->ClassADD->find(array('id'=>$tp), null, " id,tid ");
						if($this->auser->checkclass($a['tid'])){
							syDB($this->molds)->delete(array('id'=>$tp));
							syDB($this->molds.'_field')->delete(array('aid'=>$tp));
						}
					}
					$this->jump("?c=a_".$this->molds);
					break;
				case 3:
					foreach($ids as $tp){
						$a=$this->ClassADD->find(array('id'=>$tp), null, " id,tid ");
						if($this->auser->checkclass($a['tid']))$this->ClassADD->update(array('id'=>$tp),array('tid'=>$this->syArgs('tid')));
					}
					$this->jump("?c=a_".$this->molds);
					break;
			}
			deleteDir($GLOBALS['G_DY']['sp_cache']);
		}
		if($this->syArgs('go')==0)$txt='审核';
		if($this->syArgs('go')==1)$txt='取消审核';
		if($this->syArgs('go')==2)$txt='删除';
		if($this->syArgs('go')==3)$txt='移动';
		$this->toptxt='批量'.$txt.$this->moldname.'内容';
		$ids=implode(',',$this->syArgs('ids',2));
		$this->msgtitle='确定要'.$txt.'这些'.$this->moldname.'内容吗？';
		$this->msg='本操作将批量'.$txt.'ID为['.$ids.']的内容<br>';
		$this->msggo='<a href="?c=a_'.$this->molds.'&a=alledit&run=1&ids='.$ids.'&go='.$this->syArgs('go').'&tid='.$this->syArgs('tid').'">确定'.$toptxt.'</a><a href="?c=a_'.$this->molds.'">取消操作</a>';
		$this->display("msg.html");
	}
}	