<?php
if(!defined('APP_PATH')||!defined('DOYO_PATH')){exit('Access Denied');}

class a_molds extends syController
{
	function __construct(){
		parent::__construct();
		$this->Get_c='a_molds';
		$this->a=$this->syArgs('a',1);
		$this->db=$GLOBALS['G_DY']['db']['prefix'];
		$this->newrow = array(
			'moldname' => $this->syArgs('moldname',1),
			'isshow' => $this->syArgs('isshow'),
			'orders' => $this->syArgs('orders'),
			't_index' => $this->syArgs('t_index',1),
			't_list' => $this->syArgs('t_list',1),
			't_listimg' => $this->syArgs('t_listimg',1),
			't_listb' => $this->syArgs('t_listb',1),
			't_content' => $this->syArgs('t_content',1),
		);
	}
	function index(){
		$this->toptxt='频道管理';
		$this->lists = syDB('molds')->findAll(array('isshow'=>1));
		$this->lists_no = syDB('molds')->findAll(array('isshow'=>0));
		$this->display("molds.html");
	}
	function edit(){
		$this->d=syDB('molds')->find(array('mid'=>$this->syArgs('mid')));
		if ($this->syArgs('run')==1){
			if(syDB('molds')->update(array('mid'=>$this->d['mid']),$this->newrow)){
				message_a("频道修改成功","?c=".$this->Get_c);
			}else{message_a("频道修改失败,请重新提交");}
		}
		$this->toptxt='修改频道';
		$this->postgo='edit';
		$this->display("molds.html");
	}

}	