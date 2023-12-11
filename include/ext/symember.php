<?php
if(!defined('APP_PATH')||!defined('DOYO_PATH')){exit('Access Denied');}
class symember{
	private $users;
	private $userserr;
	private $c;
	public function __construct(){	
		GLOBAL $__controller, $__action;
		if(!empty($_SESSION['member'])){$this->users = $_SESSION['user'];}else{
			if($__action!='login'&&$__action!='out'&&$__action!='reg'&&$__action!='rules'){
				echo "<script>parent.location.href='?c=member&a=login';</script>";exit;
			}
		}
	}
}