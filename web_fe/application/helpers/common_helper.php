<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

function str_nr($str){
	return str_replace(array("\r\n", "\n"), '<br />', $str);
}

/**
 * 使用curl获取网页值
 * @param string $url
 * @param data $data
 * @return mixed
 */
function curl($url, $data = ''){
	$ch=curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	if(!empty($data)){
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	}
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
	
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;
}

function read_file($dir, $prefix = ''){
	$files = array();
	$len = strlen($prefix);
	if ($handle = opendir($dir)) {
	    while (false !== ($file = readdir($handle))) {
	    	if(in_array($file, array('.', '..'))){
	    		continue;
	    	}
	    	if(is_dir($file)){
	        	continue;
	        }
	        if(!empty($prefix) && substr($file, 0, $len)!=$prefix){
	        	continue;
	        }
	        $files[] = $file;
	    }
	    closedir($handle);
	    return $files;
	}
}

/**
 * 信息提示
 * @param string $msg
 * @param array $link
 * @param int $second
 */
function showmsg($msg , $link=array(), $second=6){
	//直接包含退出文件
	include APPPATH.'errors/showmsg.php';die;
}

/**
 * 读取缓存信息
 * @param string $cache
 * @return boolean
 */
function read_cache($cache){
	$cache_file = APPPATH."data/{$cache}_cache.php";
	if(is_file($cache_file)){
		return include $cache_file;
	}
	return false;
}

/**
 * 创建缓存
 * @param string $cache
 * @param array $data
 * @return boolean
 */
function create_cache($cache, $data){
	$cache_file = APPPATH."data/{$cache}_cache.php";
	$fp = fopen($cache_file, 'wb');
	if(!$fp){
		return false;
	}
	fwrite($fp, "<?php\ndefined('BASEPATH') or die('No direct script access allowed');\nreturn ");
	fwrite($fp, var_export($data, true));
	fwrite($fp, ";\n?>");
	fclose($fp);
	return true;
}

/**
 * 获取缩略图
 * @param string $pic
 * @param string $thumb
 * @return string|mixed
 */
function thumb($pic, $thumb=true){
	if(!$thumb){
		return '/public/'.$pic;
	}
	return preg_replace('/(.*?)\.([a-z0-9]+)$/i', "\$1_thumb.\$2", '/public/'.$pic);
}

function create_dir($dirname){
	$dir = str_replace('\\', '/', FCPATH);
	if(empty($dirname)){
		return false;
	}
	$dir_arr=explode('/', $dirname);
	foreach ($dir_arr as $val) {
		$dir.="{$val}/";
		if(!is_dir($dir)){
			mkdir($dir,0766);
			chmod($dir, 0766);
		}
	}
	return true;
}

function clear_dir($dirname){
	$dir = APPPATH.'data/'.$dirname;
	if ($handle = opendir($dir)) {
		while (false !== ($file = readdir($handle))) {
			if(in_array($file, array('.', '..')) || is_dir($file)){
				continue;
			}
			@unlink($dir.'/'.$file);
		}
		closedir($handle);
		return true;
	}
}

function md532($str, $salt=''){
	return md5(strrev(md5($salt.$str)).$salt);
}

function salt($len = 8){
	$str = 'qwertyuiopasdfghjklzxcvbnm1234567890QWERTYUIOPASDFGHJKLZXCVBNM';
	$length = strlen($str)-1;
	$salt = '';
	for($i = 0; $i<$len; $i++){
		$salt .= $str[rand(0, $length)];
	}
	return $salt;
}

/**
 * SEO自动结合
 * @param array $data
 * $data 需要值
 * title or name	标题或者名字
 * seo_title	设置的SEO标题
 * seo_keywords	设置的SEO关键字 
 * seo_description 设置的SEO描述
 * 
 * 结合规则
 * 如果seo_title存在，title无效 + 网站名
 * seo_keywords 不存在，返回主站
 * seo_description 不存在，返回主站
 * 
 * @return array(
 * 	'webname','webtitle','title','keywords','description'
 * );
 */
function seo($data = array()){
	
	$config = read_cache('config');
	$header = array();
	$header['webname']		= $config['webname'];
	$header['webtitle']		= $config['webtitle'];
	$header['keywords']		= '';
	$header['title']		= '';
	$header['description']	= '';
	//标题
	if(isset($data['seo_title']) && !empty($data['seo_title'])){
		$header['title'] = $data['seo_title'].'|'.$header['webtitle'];
	}else{
		if(isset($data['title'])){
			$header['title'] .= "{$data['title']}|";
		}
		if(isset($data['name'])){
			$header['title'] .= "{$data['name']}|";
		}
		$header['title'] .= $header['webtitle'];
	}
	//关键词
	if(isset($data['seo_keywords']) && !empty($data['seo_keywords'])){
		$header['keywords'] = $data['seo_keywords'];
	}else{
		$header['keywords'] = $config['keywords'];
	}
	//描述
	if(isset($data['seo_description']) && !empty($data['seo_description'])){
		$header['description'] = $data['seo_description'];
	}else{
		$header['description'] = $config['description'];
	}
	return $header;
}


function tags($table = 'scenic', $field = '*',$condition = '', $order_by = '', $offset = 0, $limit=10){
	$CI		= get_instance();
	$status = '1';
	if($table != 'help'){
		$status = 'status=1';
	}
	$table	= $CI->db->dbprefix($table);
	$sql	= "SELECT {$field} FROM {$table} WHERE {$status}";
	if(!empty($condition)){
		$sql .= " AND {$condition}";
	}
	if(!empty($order_by)){
		$sql .= " ORDER BY {$order_by}";
	}
	$sql .= " LIMIT {$offset}, {$limit}";
	return $CI->db->query($sql)->result_array();
}


function email_templates($name, $data = array()){
	$seo_config=read_cache('config');
	$config=get_config();
	$search=array('{$webname}','{$base_url}','{$nowdate}');
	$replace=array($seo_config['webname'], $config['base_url'], date('Y-m-d H:i'));
	if(is_array($data)){
		foreach($data as $key=>$val){
			$search[]	= "{\${$key}}";
			$replace[]	= $val;
		}
	}
	
	$htmldata = read_cache('email/'.$name);
	if(empty($htmldata)){
		return false;
	}
	$htmldata['title']	= str_replace($search, $replace, $htmldata['title']);
	$htmldata['content']	= str_replace($search, $replace, $htmldata['content']);
	return $htmldata;
}

/**
 * 发送邮件
 * @param string $email
 * @param string $title
 * @param string $content
 * @return boolean
 */
function send_email($email, $name, $data = array()){
	$config = read_cache('email');
	if(empty($config)){
		return false;
	}
	$_ = email_templates($name, $data);
	if(empty($_)){
		return false;
	}
	$CI		= get_instance();
	$CI->load->library('smtp');
	$CI->smtp->set('smtp_port', $config['port']);
	$CI->smtp->set('relay_host',$config['host']);
	$CI->smtp->set('time_out',	$config['timeout']);
	$CI->smtp->set('user',		$config['user']);
	$CI->smtp->set('pass',		$config['pass']);
	$CI->smtp->set('auth',		true);//
	$CI->smtp->set('debug',		false);
	return $CI->smtp->sendmail($email, $config['from'], $_['title'], $_['content'], 'HTML');
}

/**
 * 验证卡
 * @param string $card
 * @return boolean
 */
function is_card($card){
	//13位具体卡号
	if(!preg_match('/^\d{15}$/', $card)){
		return false;
	}
	//一些变量保存
	$c = $v = $s = $t = array();
	$_card = str_split($card, 1);
	foreach ($_card as $key=>$val){
		if(in_array($key, array(5, 6))){
			$v[] = $val;
		}else{
			$c[] = $val;
		}
	}
	//2的平方计算
	for ($i = 1; $i<=13; $i++) {
		$s[] = pow(2, $i-1)%100;
	}
	//卡号的验证
	foreach ($c as $key=>$val) {
		$t[] = $val*$s[$key];
	}
	
	$verify = (pow(array_sum($c), 2)*array_sum($t))%100;
	if($verify == 44){
		$verify = $verify + 11;
	}else if($verify>=40 && $verify<=49){
		$verify = $val+10;
	}else if($verify%10==4){
		$verify = $verify + 1;
	}
	return $verify == implode('', $v);
}

/**
 * 生成验证码
 * @return image tag
 */
function get_captcha(){
	$CI		= get_instance();
	$CI->load->library('session');
	$CI->load->helper('url');
	$CI->load->helper('captcha');
	$vals = array(
			'word' => '',
			'img_path' => './public/captcha/',
			'img_url' => './public/captcha/',
			//'font_path' => '/public/font/font.ttf',
 			'img_width' => 60,
 			'img_height' => 25,
			'expiration' => 10
	);
	
	$cap = create_captcha($vals);
	//放入session中
	$newdata = array('vcode'  => $cap['word']);
	$CI->session->set_userdata($newdata);
	return $cap['image'];
	
}

/**
 * 以下是smarty 相关查询处理
 */

function article($params, $smarty){
	//print_r($params);
	if(!isset($params['name']) || empty($params['name'])){
		$params['name'] = 'list';
	}
	$CI = &get_instance();
	$CI->load->database();
	
	//条件组合
	$sql = "SELECT";
	if(!isset($params['field']) || empty($params['field'])){
		$sql .= " *";
	}else{
		$sql .= " {$params['field']}";
	}
	$sql .= " FROM @article WHERE 1";
	if(isset($params['id']) && $params['id']){
		$sql .= " AND article_id IN({$params['id']})";
	}
	
	if(isset($params['picture'])){
		$sql .= " AND article_path!=''";
	}
	
	if(isset($params['orderby']) && !empty($params['orderby'])){
		$sql .= " ORDER BY {$params['orderby']}";
	}
	//SQL组合end
	//如果参数 act 存在，就是多条数据调用
	if(isset($params['act'])){
		if(isset($params['limit'])){
			$sql .= " LIMIT {$params['limit']}";
		}
		$data = $CI->db->query($sql)->result_array();
		$smarty->assign($params['name'], $data);
	}else{		//act == show
		
		$sql .= ' LIMIT 1';
		$data = $CI->db->query($sql)->row_array();
		$smarty->assign($params['name'], $data);
	}
}

function product($params, $smarty){
	//print_r($params);
}

function single($params, $smarty){
	if(!isset($params['name']) || empty($params['name'])){
		$params['name'] = 'list';
	}
	$CI = &get_instance();
	$CI->load->database();
	
	$sql = "SELECT ";
	if(!isset($params['field']) || empty($params['field'])){
		$sql .= " *";
	}else{
		$sql .= " {$params['field']}";
	}
	$sql .= " FROM @single WHERE 1";
	if(isset($params['id']) && $params['id']){
		$sql .= " AND id IN({$params['id']})";
	}
	if(isset($params['pid']) && $params['pid']){
		$sql .= " AND pid IN({$params['pid']})";
	}
	if(isset($params['orderby']) && !empty($params['orderby'])){
		$sql .= " ORDER BY {$params['orderby']}";
	}
	if(isset($params['pid'])){
		$data = $CI->db->query($sql)->result_array();
		$smarty->assign($params['name'], $data);
	}else{
		$sql .= ' LIMIT 1';
		$data = $CI->db->query($sql)->row_array();
		$smarty->assign($params['name'], $data);
	}
}

function register_smarty(){
	// smarty标签名 => 原函数
	return array(
		'article'	=> 'article',
		'product'	=> 'product',
		'single'	=> 'single'
	);
}


/**
 * 字符截取 支持UTF8/GBK
 * @param $string
 * @param $length
 * @param $dot
 */
function str_cut($string, $length, $dot = '...') {
    $strlen = strlen($string);
    if($strlen <= $length) return $string;
    $string = str_replace(array(' ',' ', '&amp;', '"', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '<', '>', '&middot;', '&hellip;'), array('∵',' ',
        '&', '"', "'", '&ldquo;', '&rdquo;', '&mdash;', '<', '>', '&middot;', '&hellip;'), $string);
    $strcut = '';
    if( 'utf-8' == 'utf-8') {
        $length = intval($length-strlen($dot)-$length/3);
        $n = $tn = $noc = 0;
        while($n < strlen($string)) {
            $t = ord($string[$n]);
            if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
                $tn = 1; $n++; $noc++;
            } elseif(194 <= $t && $t <= 223) {
                $tn = 2; $n += 2; $noc += 2;
            } elseif(224 <= $t && $t <= 239) {
                $tn = 3; $n += 3; $noc += 2;
            } elseif(240 <= $t && $t <= 247) {
                $tn = 4; $n += 4; $noc += 2;
            } elseif(248 <= $t && $t <= 251) {
                $tn = 5; $n += 5; $noc += 2;
            } elseif($t == 252 || $t == 253) {
                $tn = 6; $n += 6; $noc += 2;
            } else {
                $n++;
            }
            if($noc >= $length) {
                break;
            }
        }
        if($noc > $length) {
            $n -= $tn;
        }
        $strcut = substr($string, 0, $n);
        $strcut = str_replace(array('∵', '&', '"', "'", '&ldquo;', '&rdquo;', '&mdash;', '<', '>', '&middot;', '&hellip;'), array(' ', '&amp;', '"',
            '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '<', '>', '&middot;', '&hellip;'), $strcut);
    } else {
        $dotlen = strlen($dot);
        $maxi = $length - $dotlen - 1;
        $current_str = '';
        $search_arr = array('&',' ', '"', "'", '&ldquo;', '&rdquo;', '&mdash;', '<', '>', '&middot;', '&hellip;','∵');
        $replace_arr = array('&amp;',' ', '"', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '<', '>', '&middot;', '&hellip;',' ');
        $search_flip = array_flip($search_arr);
        for ($i = 0; $i < $maxi; $i++) {
            $current_str = ord($string[$i]) > 127 ? $string[$i].$string[++$i] : $string[$i];
            if (in_array($current_str, $search_arr)) {
                $key = $search_flip[$current_str];
                $current_str = str_replace($search_arr[$key], $replace_arr[$key], $current_str);
            }
            $strcut .= $current_str;
        }
    }
    return $strcut.$dot;
}




/**
 * 创建像这样的查询: "IN('a','b')";
 *
 * @access   public
 * @param    mix      $item_list      列表数组或字符串,如果为字符串时,字符串只接受数字串
 * @param    string   $field_name     字段名称
 * @author   wj
 *
 * @return   void
 */
function db_create_in($item_list, $field_name = '')
{
    if (empty($item_list))
    {
        return $field_name . " IN ('') ";
    }
    else
    {
        if (!is_array($item_list))
        {
            $item_list = explode(',', $item_list);
            foreach ($item_list as $k=>$v)
            {
                $item_list[$k] = intval($v);
            }
        }

        $item_list = array_unique($item_list);
        $item_list_tmp = '';
        foreach ($item_list AS $item)
        {
            if ($item !== '')
            {
                $item_list_tmp .= $item_list_tmp ? ",'$item'" : "'$item'";
            }
        }
        if (empty($item_list_tmp))
        {

            return $field_name . " IN ('') ";
        }
        else
        {
            return $field_name . ' IN (' . $item_list_tmp . ') ';
        }
    }
}



