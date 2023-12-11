<?php
if(!defined('APP_PATH')||!defined('DOYO_PATH')){exit('Access Denied');}
class uploads extends syController
{
	function __construct(){
		parent::__construct();
	}
	function index(){
		$allow = $this->syArgs('allow',1)!='' ? $this->syArgs('allow',1) : syExt('filetype');
		$size = $this->syArgs('size',1)!='' ? $this->syArgs('size',1) : syExt('filesize');
		$water = $this->syArgs('water',1)!='' ? $this->syArgs('water',1) : syExt('imgwater');
		$caling = $this->syArgs('caling',1)!='' ? $this->syArgs('caling',1) : syExt('imgcaling');
		$w = $this->syArgs('w',1)!='' ? $this->syArgs('w',1) : syExt('img_w');
		$h = $this->syArgs('h',1)!='' ? $this->syArgs('h',1) : syExt('img_h');
		$fileClass=syClass('syupload',array($allow,$size,$water,$caling,$w,$h));
		if (!empty($_FILES)){
			$fileinfos = $fileClass->upload_file($_FILES[$this->syArgs('isfiles',1)]);
			if (is_array($fileinfos)){
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
	function loadup(){
		$this->inputid=$this->syArgs('inputid',1);
		$this->multi=$this->syArgs('multi') ? 'true':'false';
		if($this->syArgs('fileExt',1)){$this->fileExt=$this->syArgs('fileExt',1);}else{
			foreach(explode(',',syExt('filetype')) as $v){
				$fileExt.=';*.'.$v;
			}$this->fileExt=substr($fileExt,1);
		}
		$this->sizeLimit=$this->syArgs('sizeLimit') ? $this->syArgs('sizeLimit'):syExt('filesize');
		$this->fileover=$this->syArgs('fileover') ? $this->syArgs('fileover'):1;
		$this->display("uploads.html");
	}
}