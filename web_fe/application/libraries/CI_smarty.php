<?php
if (!defined('APPPATH')) exit('No direct script access allowed');
require_once(APPPATH.'libraries/smarty/Smarty.class.php');
class CI_Smarty extends Smarty{

	function __construct() {
		parent::__construct();
		$this->template_dir =  APPPATH."views"; 
		$this->compile_dir = APPPATH."data/templates_c";
		$this->cache_dir = APPPATH."data/cache";
		$this->caching = 0;
		//$this->cache_lifetime = 120; //缓存更新时间
		//$this->debugging = true;
		//$this->compile_check = true; //检查当前的模板是否自上次编译后被更改；如果被更改了，它将重新编译该模板。
		//$this->force_compile = true; //强制重新编译模板
		$this->allow_php_templates= true; //开启PHP模板
		$this->left_delimiter = "{{"; //左定界符
		$this->right_delimiter = "}}"; //右定界符
	}
	
	function view($tpl, $data = array()){
		if(!empty($data)){
			$this->assign('data', $data);
		}
		$this->display($tpl);
	}
}