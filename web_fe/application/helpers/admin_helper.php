<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 创建html生成文件
 * @param string $html
 * @param string $content
 * @return boolean
 */
function create_html($html, $content){
	//分析dir
	$dirname = dirname($html);
	$path = str_replace('\\', '/', FCPATH).'html/';
	if(!create_dir('html/'.$dirname)) return false;
	$fp = fopen($path.$html, 'w');
	if(!$fp) return false;
	fwrite($fp, $content);
	fclose($fp);
	return true;
}

function verify_html_path($path, $sub=true){
	//规则不允许现现../目录功能，后缀只能以html,htm,shtml 三种格式结尾
	if(!$sub){
		if(strpos($path, '/')!==false){ //只支持一级
			return false;//直接返回失败
		}
	}else{
		if(strpos($path, '../')!==false){
			return false;	//不支持上级
		}
	}
	if(!preg_match('/^[A-Za-z0-9_][A-Za-z0-9_ \/\.]{0,}\.(html|htm|shtml)$/', $path)){
		return false;
	}
	return true;
}

/**
 * 删除生成html文件
 * @param string $html
 * @return boolean
 */
function delete_html($html){
	$path = str_replace('\\', '/', FCPATH).'html/';
	@unlink($path.$html);
	return true;
}

/**
 * 生成详细页静态
 * @param string $mod
 * @param unknown $id
 * @param unknown $newhtml
 * @param string $old_html
 * @return boolean
 */
function _html_view($mod = 'scenic/view', $id, $newhtml, $old_html=''){
	if(!empty($old_html) && $newhtml!=$old_html){
		delete_html($old_html);
	}
	$config = get_config();
	$content = curl("{$config['base_url']}index.php/{$mod}/{$id}");
	if(empty($content)){
		return false;
	}
	return create_html($newhtml, $content);
}

function _html_list($mod = 'scenic/index', $page, $newhtml){
	$config = get_config();
	$content = curl("{$config['base_url']}index.php/{$mod}/{$page}");
	if(empty($content)){
		return false;
	}
	return create_html($newhtml, $content);
}

function is_login(){
	$CI = &get_instance();
	if(!$CI->session->userdata('user_id')){
//        redirect("app=index&act=login");exit;
		$link[0]['link_url'] = 'index.php?app=welcome&act=login';
		$link[0]['link_name']= '用户登陆';
		showmsg('请先登录', $link, 2);
	}
}
function sortarray($classification,$pid='0'){
	$arr=array();
	foreach($classification as $val){
		if($val['pid']==$pid){
			$drr=$val['id'];
			$arr[]=$val;		
			$arr=array_merge($arr,sortarray($classification,$drr));			
		}	
	}
	return $arr;
}



function _week($num)
{
    $res = '';
    switch($num){
        case 1:
            $res = '星期天';
            break;
        case 2:
            $res = '星期一';
            break;
        case 3:
            $res = '星期二';
            break;
        case 4:
            $res = '星期三';
            break;
        case 5:
            $res = '星期四';
            break;
        case 6:
            $res = '星期五';
            break;
        case 7:
            $res = '星期六';
            break;
    }
    return $res;
}



function randColor(){
    $colors = array();
    for($i = 0;$i<6;$i++){
        $colors[] = dechex(rand(0,15));
    }
    return implode('',$colors);
}