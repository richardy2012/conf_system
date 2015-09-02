<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 上传需要验证！
 */

class File extends MY_Controller {
	private $allow_ext = array(
		'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
		'flash' => array('swf', 'flv'),
		'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
		'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
	);
	private $base_path;
	private $save_path;
	private $save_url;
	private $utype = 'image';		//默认为上传图
	public $_config;
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('admin');
		
		is_login();//?登陆
		
		//暂时只有后台使用，验证是否允许上传权限
		$this->_config = get_config();
		$this->base_path = str_replace('\\', '/', FCPATH).'public/';
		$this->root_url  = $this->_config['base_url'].'public/';
		
		//设置上传路径
		if(isset($_REQUEST['up'])){
			//可接受的dir参数值为 <dir>/<dir1>/***
			$dir = isset($_GET['dir'])?trim($_GET['dir']):'default';
			$this->save_path = 'image/'.$dir;
		}else{
			if(isset($_GET['dir']) && isset($this->allow_ext[$_GET['dir']])){
				$this->utype = $_GET['dir'];
			}else{
				$this->utype = 'image';
			}
			$this->save_path = $this->utype.'/'.date('Y/m/d');
		}
		$this->save_url	 = $this->_config['base_url'].'public/'.$this->save_path;
	}
	
	public function index(){
		//获取一个列表
		$path=$this->input->get('path');
		$current_path = $this->base_path.$this->utype.'/';
		if(!empty($path)){
			$current_path .= $path;
		}
		
		//遍历目录取得文件信息
		$file_list = array();
		//$handle=dir('');
		if ($handle = opendir($current_path)) {
			$i = 0;
			while (false !== ($filename = readdir($handle))) {
				if ($filename{0} == '.') continue;
				$file = $current_path . $filename;
				if (is_dir($file)) {
					$file_list[$i]['is_dir'] = true; //是否文件夹
					$file_list[$i]['has_file'] = (count(scandir($file)) > 2); //文件夹是否包含文件
					$file_list[$i]['filesize'] = 0; //文件大小
					$file_list[$i]['is_photo'] = false; //是否图片
					$file_list[$i]['filetype'] = ''; //文件类别，用扩展名判断
				} else {
					$file_list[$i]['is_dir'] = false;
					$file_list[$i]['has_file'] = false;
					$file_list[$i]['filesize'] = filesize($file);
					$file_list[$i]['dir_path'] = '';
					$file_ext = strtolower(array_pop(explode('.', trim($file))));
					$file_list[$i]['is_photo'] = in_array($file_ext, $this->allow_ext[$this->utype]);
					$file_list[$i]['filetype'] = $file_ext;
				}
				$file_list[$i]['filename'] = $filename; //文件名，包含扩展名
				$file_list[$i]['datetime'] = date('Y-m-d H:i:s', filemtime($file)); //文件最后修改时间
				$i++;
			}
			closedir($handle);
		}
		$result = array();
		//相对于根目录的上一级目录
		$result['moveup_dir_path'] = preg_replace('/(.*?)[^\/]+\/$/', '$1', empty($path)?'':$path);
		//相对于根目录的当前目录
		$result['current_dir_path'] = empty($path)?'':$path;
		//当前目录的URL
		$result['current_url'] = empty($path)?$this->root_url.$this->utype:$this->root_url.$this->utype.'/'.$path;
		//文件数
		$result['total_count'] = count($file_list);
		//文件列表数组
		$result['file_list'] = $file_list;
		
		$this->putmsg($result);
	}
	
	/**
	 * 后台图片上传专用，压缩到200*150
	 */
	public function img_upload(){
		if(isset($_POST['submit']) && isset($_FILES['fileField'])){
			//最大文件大小
			$files=array();
			$files['upload_path'] = $this->create_dir($this->save_path);
			$files['allowed_types'] = implode('|', $this->allow_ext[$this->utype]);
			$files['overwrite']=false;
			$files['encrypt_name']=true;
			$files['max_size'] = '1024';
			$this->load->library('upload', $files);
			if(!$this->upload->do_upload('fileField')){
				die('<script>alert("'.$this->MyLang['upload_failed'].'");history.back(-1);</script>');
			}
			$cdata=$this->upload->data();
			//压缩图
			//$this->save_url.'/'.$cdata['file_name'];
			$config = array();
			$config['image_library'] = 'gd2';
			$config['source_image'] = $this->base_path.$this->save_path.'/'.$cdata['file_name'];
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 200;
			$config['height'] = 150;
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			die("<script>
				  alert('".$this->MyLang['upload_success']."');
				  window.opener.document.getElementById('{$_GET['htmlid']}').value = '{$this->save_path}/{$cdata['file_name']}';
				  window.close();
				</script>");
		}

		$data = array(
			'form_url'	=> "index.php?app=file&act=img_upload&up=true&htmlid={$_GET['htmlid']}&dir={$_GET['dir']}",
			//upfile.html
			'upload_avatar' => $this->MyLang['upload_avatar'],
			'file' => $this->MyLang['file'],
			
		);
		$this->ci_smarty->view('admin/file/upfile.html', $data);exit;
	}
	
	public function img_list(){
		//获取一个列表
		$path=$this->input->get('dir');
		$current_path = $this->base_path.'image/';
		if(!empty($path)){
			$current_path .= $path;
		}
		if(!is_dir($current_path)){
			$link[0]['link_url']  = "index.php?app=file&act=img_list&up=true&htmlid={$_GET['htmlid']}";
			$link[0]['link_name'] = $this->MyLang['master_directory'];
			showmsg($this->MyLang['not_exist_directory'], $link, 1);
		}
		//遍历目录取得文件信息
		$file_list = array();
		if ($handle = opendir($current_path)) {
			$i = 0;
			while (false !== ($filename = readdir($handle))) {
				if ($filename{0} == '.') continue;
				$file = $current_path.'/'.$filename;
				if (is_dir($file)) {
					$file_list[$i]['is_dir'] = true; //是否文件夹
					$file_list[$i]['has_file'] = (count(scandir($file)) > 2); //文件夹是否包含文件
					$file_list[$i]['filesize'] = 0; //文件大小
					$file_list[$i]['is_photo'] = false; //是否图片
					$file_list[$i]['filetype'] = ''; //文件类别，用扩展名判断
				} else {
					$file_list[$i]['is_dir'] = false;
					$file_list[$i]['has_file'] = false;
					$file_list[$i]['filesize'] = filesize($file);
					$file_list[$i]['dir_path'] = '';
					$file_ext = strtolower(array_pop(explode('.', trim($file))));
					$file_list[$i]['is_photo'] = in_array($file_ext, $this->allow_ext[$this->utype]);
					$file_list[$i]['filetype'] = $file_ext;
				}
				$file_list[$i]['filename'] = $filename; //文件名，包含扩展名
				$file_list[$i]['datetime'] = date('Y-m-d H:i:s', filemtime($file)); //文件最后修改时间
				$i++;
			}
			closedir($handle);
		}
		$data = array(
			'total'	=> count($file_list),
			'list'	=> json_encode($file_list),
			'path'	=> $path,
			'updir'	=> array(),
			//list.html
			'pos' => $this->MyLang['pos'],
			'root_irectory' => $this->MyLang['root_irectory'],
			'amount' => $this->MyLang['amount'],
			'firstPage' => $this->MyLang['firstPage'],
			'prePage' => $this->MyLang['prePage'],
			'nextPage' => $this->MyLang['nextPage'],
			'lastPage' => $this->MyLang['lastPage'],
		);
		if(!empty($path)){
			$dirs = '';
			foreach (explode('/', $path) as $dir){
				$dirs .= empty($dirs)?$dir:'/'.$dir;
				$data['updir'][$dir] = $dirs;
			}
		}
		
		$this->ci_smarty->view('admin/file/list.html', $data);
	}
	
	/**
	 * 编辑器上传，可支持swf，视频等上传
	 */
	public function upload(){
		//最大文件大小
		$files=array();
		$files['upload_path'] = $this->create_dir($this->save_path);
		$files['allowed_types'] = implode('|', $this->allow_ext[$this->utype]);
		$files['overwrite']=false;
		$files['encrypt_name']=true;
		$files['max_size'] = '1024';
		$this->load->library('upload', $files);
		if(!$this->upload->do_upload('imgFile')){
			$this->putmsg($this->MyLang['upload_failed']);
		}
		$cdata=$this->upload->data();
		//生成缩略图
		$this->putmsg(array('error'=>0,'url'=>$this->save_url.'/'.$cdata['file_name']));
	}
	
	/**
	 * 建立目录
	 * @param unknown_type $path
	 * @return string
	 */
	public function create_dir($path){
	
		// 取配制文件
		$dir = $this->base_path;
		if(empty($dir)) return $dir;
	
		$dir_arr=explode('/', $this->save_path);
		foreach ($dir_arr as $val) {
			$dir.="{$val}/";
			if(!is_dir($dir)){
				mkdir($dir,0766);
				chmod($dir, 0766);
			}
		}
		return $dir;
	}
	/**
	 * 输出编辑器所需要的值
	 * @param string|array $msg
	 */
	private function putmsg($msg){
		if(!is_array($msg))
			echo json_encode(array('error'=>1, 'message'=>$msg));
		else
			echo json_encode($msg);
		die;
	}
	
}