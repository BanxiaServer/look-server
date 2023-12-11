<?php
if(!defined('APP_PATH')||!defined('DOYO_PATH')){exit('Access Denied');}
class article extends syController
{
	function __construct(){
		parent::__construct();
		$this->moldname=moldsinfo('article','moldname');
		$this->sy_class_type=syClass('syclasstype');
		$this->Class=syClass('c_article');
		$this->db=$GLOBALS['G_DY']['db']['prefix'].'article';
		if(!empty($_SESSION['member'])){
			$this->member_g=syDB('member_group')->find(array('gid'=>$_SESSION['member']['gid']));
		}
	}
	function index(){
		if($this->syArgs('file',1)!=''){
			$this->article=syDB('article')->findSql('select * from '.$this->db.' a left join '.$this->db.'_field b on (a.id=b.aid) where (htmlfile="'.$this->syArgs('file',1).'" or id='.$this->syArgs('file').') and isshow=1 limit 1');
			$id = $this->article['id'];
		}else{
			$id = $this->syArgs('id');
			$this->article=syDB('article')->findSql('select * from '.$this->db.' a left join '.$this->db.'_field b on (a.id=b.aid) where id='.$id.' and isshow=1 limit 1');
		}
		if(!$this->article){message("指定内容不存在或未审核");}
		$this->article=$this->article[0];
		$this->article=array_merge($this->article,array('tid_leafid'=>$this->sy_class_type->leafid($this->article['tid'])));
		if($this->article['mrank']>0){
			if(empty($_SESSION['member']))message('本内容需要登录才可访问');
			if(membergroup($this->article['mrank'],'weight')>$this->member_g['weight'])message('本内容需要['.membergroup($this->article['mrank'],'name').']及以上用户才可访问');
		}
		if($this->article['mgold']>0){
			//扣除金币操作
			message('本内容需要消费['.$this->article['mgold'].']金币');
		}
		
		$prev_next_w=' and tid in('.$this->sy_class_type->leafid($this->article['tid']).') ';
		$prev_next_f='id,litpic,style,mrank,mgold,title,addtime,htmlurl,htmlfile';
		$prev=syDB('article')->find(' addtime<'.$this->article['addtime'].$prev_next_w,'addtime desc',$prev_next_f);
		if($prev){
			$prev['url']=html_url('article',$prev);
			$this->aprev=$prev;
		}
		$next=syDB('article')->find(' addtime>'.$this->article['addtime'].$prev_next_w,'addtime',$prev_next_f);
		if($next){
			$next['url']=html_url('article',$next);
			$this->anext=$next;
		}
		
		$body=array_filter(explode("[doyo|page]",$this->article['body']));
		if(count($body)>1){
			$pages=array(
						'total_page' => count($body),    // 总页数
						'prev_page' => $this->syArgs('page',0,1)-1,     // 上一页的页码
						'next_page' => $this->syArgs('page',0,1)+1,     // 下一页的页码
						'last_page' => count($body),      // 最后一页的页码
						'current_page' => $this->syArgs('page',0,1),   // 当前页码
					);
			$this->article=array_merge($this->article,array('body'=>$body[$this->syArgs('page',0,1)-1]));
			if($this->syArgs('page')>1){
				$this->article=array_merge($this->article,array('title'=>$this->article['title'].'&nbsp;&nbsp;('.$this->syArgs('page').')'));
			}
			$this->pages=html_url('article',$this->article,$pages,$this->syArgs('page',0,1));
		}
		$this->type=syDB('classtype')->find(" molds='article' and tid=".$this->article['tid']." ",null,'tid,classname,litpic,keywords,description,t_content,htmldir,htmlfile,mrank,msubmit');
		$this->type=array_merge($this->type,array('tid_leafid'=>$this->sy_class_type->leafid($this->article['tid'])));
		$this->positions='<a href="'.$GLOBALS["WWW"].'">首页</a>';
		foreach($this->sy_class_type->navi($this->article['tid']) as $v){
			$d_pos=syDB('classtype')->find(array('tid'=>$v['tid']),null,'tid,molds,htmldir,htmlfile,mrank');
			$this->positions.='  &gt;  <a href="'.html_url('classtype',$d_pos).'">'.$v['classname'].'</a>';
		}
		if(funsinfo('comment','isshow')==1){
			$comment_c=syClass('c_comment');
			$this->comments=$comment_c->syPager($this->syArgs('comment_page',0,1),10)->findAll(array('isshow'=>1,'aid'=>$id,'molds'=>'article'),' addtime desc ');
			$c_page=$comment_c->syPager()->getPager();
			$this->comment_page=pagetxt_comment($c_page,$GLOBALS['G_DY']['url']["url_path_base"].'?c=article&id='.$id);
		}
		$this->display('article/'.$this->type['t_content']);
	}
	function type(){
		if($this->syArgs('file',1)!=''){
			$this->type=syDB('classtype')->find(' htmlfile="'.$this->syArgs('file',1).'" or tid='.$this->syArgs('file').' ');
			$tid = $this->type['tid'];
		}else{
			$tid = $this->syArgs('tid');
			$this->type=syDB('classtype')->find(" molds='article' and tid=".$tid." ");
		}
		if(!$this->type){message("指定栏目不存在");}
		if($this->type['mrank']>0){
			if(empty($_SESSION['member']))message('本内容需要登录才可访问');
			if(membergroup($this->type['mrank'],'weight')>$this->member_g['weight'])message('本内容需要['.membergroup($this->type['mrank'],'name').']及以上用户才可访问');
		}
		$this->type=array_merge($this->type,array('tid_leafid'=>$this->sy_class_type->leafid($tid)));
		if($this->type['isindex']==0)$t=$this->type['t_index'];
		if($this->type['isindex']==3)$t=$this->type['t_listb'];
		if($this->type['isindex']==2)$t=$this->type['t_listimg'];
		if($this->type['isindex']==1)$t=$this->type['t_list'];
		if($this->type['isindex']==1||$this->type['isindex']==2){
			$w.=" where isshow=1 ";
			$w.="and tid in(".$this->type['tid_leafid'].") ";
			if($this->syArgs('trait'))$w.="and trait like '%,".$this->syArgs('trait').",%' ";
			$order=' order by orders desc,addtime desc,id desc';
			$f=syDB('fields')->findAll(" molds='article' and types like '%|".$tid."|%' and lists=1 ");
			if($f){
				foreach($f as $v){$fields.=','.$v['fields'];}
				$sql='select id,tid,title,style,trait,gourl,addtime,hits,litpic,orders,mrank,mgold,isshow,description,htmlurl,htmlfile,user'.$fields.' from '.$this->db.' a left join '.$this->db.'_field b on (a.id=b.aid)'.$w.$order;
			}else{
				$sql='select id,tid,title,style,trait,gourl,addtime,hits,litpic,orders,mrank,mgold,isshow,description,htmlurl,htmlfile,user from '.$this->db.$w.$order;
			}
			$this->lists = $this->Class->syPager($this->syArgs('page',0,1),$this->type['listnum'])->findSql($sql);
			$pages=$this->Class->syPager()->getPager();
			$this->pages=html_url('classtype',$this->type,$pages,$this->syArgs('page',0,1));
			$list_c=$this->lists;
			foreach($list_c as $k=>$v){
				$list_c[$k]['url']=html_url('article',$v);
			}
			$this->lists=$list_c;
		}
		$this->positions='<a href="'.$GLOBALS["WWW"].'">首页</a>';
		$type_pos=$this->sy_class_type->navi($tid);
		foreach($type_pos as $v){
			$d_pos=syDB('classtype')->find(array('tid'=>$v['tid']),null,'tid,molds,htmldir,htmlfile,mrank');
			$this->positions.='  &gt;  <a href="'.html_url('classtype',$d_pos).'">'.$v['classname'].'</a>';
		}
		$this->display('article/'.$t);
	}
	function hits(){
		if($this->syArgs('id')){
			syDB('article')->incrField(array('id'=>$this->syArgs('id')), 'hits');
			$hits=syDB('article')->find(array('id'=>$this->syArgs('id')),null,'hits');
			echo 'document.write("'.$hits['hits'].'");';
		}
	}
	function search(){
		$this->type=array('title'=>'站内搜索','keywords'=>$GLOBALS['S']['keywords'],'description'=>$GLOBALS['S']['description'],'classname'=>'全部',);
		$this->type=array_merge($this->type,array('tid_leafid'=>$this->sy_class_type->leafid()));
		$w.=" where isshow=1 ";
		if($this->syArgs('word',1))$w.="and (title like '%".$this->syArgs('word',1)."%' or body like '%".$this->syArgs('word',1)."%') ";
		$order=' order by orders desc,addtime desc,id desc';
		$sql='select id,tid,title,style,trait,gourl,addtime,hits,litpic,orders,mrank,mgold,isshow,htmlurl,htmlfile,description,user,body from '.$this->db.' a left join '.$this->db.'_field b on (a.id=b.aid)'.$w.$order;
		$this->lists = $this->Class->syPager($this->syArgs('page',0,1),30)->findSql($sql); 
		$pages=$this->Class->syPager()->getPager();
		$this->pages=pagetxt($pages);
		$list_c=$this->lists;
		foreach($list_c as $k=>$v){
			$list_c[$k]['title']=str_ireplace($this->syArgs('word',1),'<b style="color:red;">'.$this->syArgs('word',1).'</b>',$v['title']);
			$list_c[$k]['url']=html_url('article',$v);
		}		
		$this->lists=$list_c;
		$this->positions='<a href="'.$GLOBALS["WWW"].'">首页</a>  &gt;  '.$this->moldname.'搜索“'.$this->syArgs('word',1).'”';
		$this->display('article/search.html');
	}
}	