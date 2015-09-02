<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public $currentUserHavePlatforms;
    public $currentUserHaveServers_str;
    public $currentUserHaveSIDS;
    public $powerCodeBinary;
    public $MyLang;

    public function __construct(){
		parent::__construct();
        $this->load->library('chinese');
        $this->checkAction();
        $this->load->model('server_mod');
        $this->__currentUserHaveServers();//获取当前用户可控制的服务器ID
        $this->__setLang();//语言
    }

    private function __currentUserHaveServers(){
        $currentUserRole = $this->session->userdata('currentUserRole');
        $this->currentUserHavePlatforms = isset($currentUserRole['role_info']['platform_id']) ? $currentUserRole['role_info']['platform_id'] : '';
        $server = $this->getPlatformsUnderServer($this->currentUserHavePlatforms);
//        $this->currentUserHaveServers_str = isset($currentUserRole['role_info']['server_ids']) ? $currentUserRole['role_info']['server_ids'] : '';
//        $this->currentUserHaveSIDS = isset($currentUserRole['role_info']['sIDs']) ? $currentUserRole['role_info']['sIDs'] : '';
        $this->currentUserHaveServers_str = !empty($server) ? implode(',',array_values($server)) : '';
        $this->currentUserHaveSIDS = !empty($server) ? implode(',',array_keys($server)) : '';
        $this->powerCodeBinary= isset($currentUserRole['role_info']['power_code_binary']) ? $currentUserRole['role_info']['power_code_binary'] : 0;
    }


    public function getPlatformsUnderServer($platform_ids){
        $server = array();
        if(empty($platform_ids)) return $server;
        $servers = $this->server_mod->getServersInPlatformId($platform_ids);
        if (!empty($servers)) {
            foreach ($servers as $key => $val) {
                $server[$val['id']] = $val['server_id'];
            }
        }
        return $server;
    }

    /**
     * @param $start_time
     * @param $end_time
     * @return array
     */
    public function DayList($start_time, $end_time)
    {
        $day_str_arr = array();
        if ($start_time < $end_time) {
            $start_time = date('Y-m-d',strtotime($start_time));
            $end_time = date('Y-m-d',strtotime($end_time));
            $day_str_arr = array($start_time);
            $start_time = strtotime($start_time);
            $end_time = strtotime($end_time);
            while ($start_time != $end_time) {
                $start_time = mktime(0, 0, 0, date('m', $start_time), date('d', $start_time) + 1, date('Y', $start_time));
                $day_str_arr[] = date('Y-m-d', $start_time);
            }
        }
        return $day_str_arr;
    }

    private function __setLang(){
    	$lang = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : '';
    	if( !$lang ){
            if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
                $lang = preg_match( "/zh-c/i", substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 4) ) ? 'Chinese' : 'English';
            }else{
                $lang = 'Chinese';
            }
    	}
    	define('LANG', $lang);
    	MY_Lang::load(lang_file('controller'));
    	MY_Lang::load(lang_file('common'));
    	MY_Lang::load(lang_file(APP));
    	$this->MyLang = getLang();
    }

	public function _error($data, $error = 1){
		$data['error'] = $error;
		die(json_encode($data));
	}

    public function view($view,$vars = array(),$return = FALSE)
    {
    	/* 转换语言项  */
    	$vars['lang'] = MY_Lang::get();
        $vars['refreshLink'] = $this->session->userdata('refreshLink');
        $this->load->view($view,$vars,$return = FALSE);
    }

    public function checkAction(){
        $currentUserRole = $this->session->userdata('currentUserRole');
        $role_id = $currentUserRole['role_id'] ? intval($currentUserRole['role_id']) : 0;
        $this->load->model('admin_role_action_mod');
        $controller = $this->router->class;
        $action = $this->router->method;
        $flag = true;
        if(in_array($controller,array('welcome','file','DataCollect','DataInterface'))){
            return $flag;
        }
        if(in_array($action,
            array(
                'ajax_col',
                'wsdl',
                'getServersByPlatformId',
//                'ajaxCheckLoadBalanceHostId',
                'ajaxCheckServerSingle',
                'approveProperty',
                'ajaxCheckBattleBalanceServerSingle',
//                'ajaxCheckBattleBalanceHostId',
//                'ajaxCheckImServerHostId',
                'ajaxCheckImServerSingle',
//                'ajaxCheckGameServerHostId',
                'ajaxCheckHostId',
                'showGameSet'
            ))){
            return $flag;
        }

        if(!$this->admin_role_action_mod->getUserCanActions($role_id,$controller,$action)){
            $flag = false;
            showmsg('您未被赋予相应权限');die();
        }
        return $flag;
    }

    /**
     *    获取分页信息
     *    @return    array
     */
    function _get_page($page_per = 9)
    {
        $page = empty($_REQUEST['page']) ? 1 : intval($_REQUEST['page']);
        $start = ($page -1) * $page_per;

        return array('limit' => "{$start},{$page_per}", 'curr_page' => $page, 'pageper' => $page_per);
    }

    function _format_page(&$page, $num = 7)
    {
        $page['page_count'] = ceil($page['item_count'] / $page['pageper']);
        $mid = ceil($num / 2) - 1;

        if ($page['page_count'] <= $num)
        {
            $from = 1;
            $to   = $page['page_count'];
        }
        else
        {
            $from = $page['curr_page'] <= $mid ? 1 : $page['curr_page'] - $mid + 1;
            $to   = $from + $num - 1;
            $to > $page['page_count'] && $to = $page['page_count'];
        }

        /*
         if (preg_match('/[&|\?]?page=\w+/i', $_SERVER['REQUEST_URI']) > 0)
         {
        $url_format = preg_replace('/[&|\?]?page=\w+/i', '', $_SERVER['REQUEST_URI']);
        }
        else
        {
        $url_format = $_SERVER['REQUEST_URI'];
        }
        */

        /* 生成app=goods&act=view之类的URL */


        if (preg_match('/[&|\?]?page=\w+/i', $_SERVER['QUERY_STRING']) > 0)
        {
            $url_format = preg_replace('/[&|\?]?page=\w+/i', '', $_SERVER['QUERY_STRING']);
            $url_format = 'index.php?'.$url_format;
        }
        else
        {
            $url_format = 'index.php?'.$_SERVER['QUERY_STRING'];
        }

        $page['page_links'] = array();
        $page['first_link'] = ''; // 首页链接
        $page['first_suspen'] = ''; // 首页省略号
        $page['last_link'] = ''; // 尾页链接
        $page['last_suspen'] = ''; // 尾页省略号
        for ($i = $from; $i <= $to; $i++)
        {
            $page['page_links'][$i] = "{$url_format}&page={$i}";
        }
        if (($page['curr_page'] - $from) < ($page['curr_page'] -1) && $page['page_count'] > $num)
        {
            $page['first_link'] = "{$url_format}&page=1";
            if (($page['curr_page'] -1) - ($page['curr_page'] - $from) != 1)
            {
                $page['first_suspen'] = '..';
            }
        }
        if (($to - $page['curr_page']) < ($page['page_count'] - $page['curr_page']) && $page['page_count'] > $num)
        {
            $page['last_link'] = "{$url_format}&page=" . $page['page_count'];
            if (($page['page_count'] - $page['curr_page']) - ($to - $page['curr_page']) != 1)
            {
                $page['last_suspen'] = '..';
            }
        }

        $page['prev_link'] = $page['curr_page'] > $from ? "{$url_format}&page=" . ($page['curr_page'] - 1) : "";
        $page['next_link'] = $page['curr_page'] < $to ? "{$url_format}&page=" . ($page['curr_page'] + 1) : "";
    }


    /* ------------------------------------------------------------------phpExcel 导入导出csv------------------------------------------------------------------ */
    /**
     * 从csv文件导入
     *
     * @param string $filename 文件名
     * @param bool $header 是否有标题行，如果有标题行，从第二行开始读数据
     * @param string $from_charset 源编码
     * @param string $to_charset 目标编码
     * @param string $delimiter 分隔符
     * @return array
     */
    function import_from_csv($filename, $header = true, $from_charset = '', $to_charset = '', $delimiter= ',', $line_max_len = 0/*一行的最大长度*/)
    {
        if ($from_charset && $to_charset && $from_charset != $to_charset)
        {
            $need_convert = true;
            //$iconv = new Chinese(ROOT_PATH . '/');
            $iconv = new Chinese( '/');
        }
        else
        {
            $need_convert = false;
        }

        $data = array();
        setlocale (LC_ALL, array ('zh_CN.gbk', 'zh_CN.gb2312', 'zh_CN.gb18030')); // 解决linux系统fgetcsv解析GBK文件时可能产生乱码的bug
        $handle = fopen($filename, "r");
        while (($row = fgetcsv($handle, 100000, $delimiter)) !== FALSE) {
            if ($need_convert)
            {
                foreach ($row as $key => $col)
                {
                    $row[$key] = $iconv->Convert($from_charset, $to_charset, $col);
                }
            }

            if ($line_max_len && count($row) > $line_max_len)
            {
                return false;
            }
            $data[] = $row;
        }
        fclose($handle);

        if ($header && $data)
        {
            array_shift($data);
        }

        return addslashes_deep($data);
    }

    /**
     * 导出csv文件
     *
     * @param array $data 数据（如果需要，列标题也包含在这里）
     * @param string $filename 文件名（不含扩展名）
     * @param string $to_charset 目标编码
     */
    function export_to_csv($data, $filename, $to_charset = '')
    {
        if ($to_charset && $to_charset != 'utf-8')
        {
            $need_convert = true;
            //$iconv = new Chinese(ROOT_PATH . '/');
            $iconv = new Chinese( '/');
        }
        else
        {
            $need_convert = false;
        }

        header("Content-type: application/unknown");
        header("Content-Disposition: attachment; filename={$filename}.csv");
        foreach ($data as $row)
        {
            foreach ($row as $key => $col)
            {

                if ($need_convert)
                {
                    $col = $iconv->Convert('utf-8', $to_charset, $col);
                }
                $row[$key] = $this->_replace_special_char($col);

            }
            echo join(',', $row) . "\r\n";
        }
    }

    /**
     * 替换影响csv文件的字符
     *
     * @param $str string 处理字符串
     */
    function _replace_special_char($str, $replace = true)
    {
        $str = str_replace("\r\n", "", $str);
        $str = str_replace("\t", "    ", $str);
        $str = str_replace("\n", "", $str);
        if ($replace == true)
        {
            $str = '"' . str_replace('"', '""', $str) . '"';
        }
        return $str;
    }

    public function organizePushServerId( $input = 'push_to_server_id' ){
        $this->load->model('server_mod');
        $servers = $this->server_mod->getServersList();


        foreach($servers as $key=>$val){
            $serverIds[] = $val['id'];
        }
        if(isset($_POST[$input]) && count($_POST[$input]) > 0){
            if(in_array('0',$_POST[$input])){
                //选中了全服，其他数据可以省略
                $_POST[$input] = $serverIds;
            }
        }
        return  isset($_POST[$input]) && $_POST[$input]  && count($_POST[$input]) > 0 ? join(',',$_POST[$input]) : '';
    }


    public function getPltIDBySerID($sIds = array()){
        $this->load->model('server_mod');
        $plt = array();
        if(!empty($sIds)){
            if(is_array($sIds)){
                foreach($sIds as $key=>$val){
                    $plt[] = $this->server_mod->getPltIDBySerID($val);
                }
            }else{
                $plt[] = $this->server_mod->getPltIDBySerID($sIds);
            }
        }
        return array_unique($plt);
    }


    public function organizePlatformIDs(){
        $this->load->model('admin_platform_mod');
        $plt = $this->admin_platform_mod->get_all();

        foreach($plt as $key=>$val){
            $pltIds[] = $val['id'];
        }
        if(isset($_POST['key_scope']) && count($_POST['key_scope']) > 0){
            if(in_array('0',$_POST['key_scope'])){
                //选中了全，其他数据可以省略
                $_POST['key_scope'] = $pltIds;
            }
        }
        return  $_POST['key_scope'] && count($_POST['key_scope']) > 0 ? join(',',$_POST['key_scope']) : '';
    }

    public function __getBinaryByServerSelect($sIDs){
        $platform_powers = array();
        $power_plus = 0;
        $power_plus_binary = 0;
        if(empty($sIDs)) return $power_plus_binary;
        $servers = $sIDs;
        $servers_arr = explode(',',$servers);
        if(!empty($servers_arr)){
            foreach($servers_arr as $k=>$v){
                $sql = "select P.power_id from {$this->db->dbprefix('st_game_platform')} P left join
{$this->db->dbprefix('st_server')} S on S.platform_id = P.id where S.id = {$v}";
                $platform_powers[] = $this->server_mod->getSingle($sql);
            }
        }
        if(empty($platform_powers)) return $power_plus_binary;
        $platform_powers = array_unique($platform_powers);
        foreach($platform_powers as $key=>$val){
            $power_plus += $val;
        }
        $power_plus_binary = decbin($power_plus);
        return $power_plus_binary;
    }

    public function __getBinaryByPlatformSelect($pltIDs){
        $platform_powers = array();
        $power_plus = 0;
        $power_plus_binary = 0;
        if(empty($pltIDs)) return $power_plus_binary;
        $plt_arr = explode(',',$pltIDs);
        if(!empty($plt_arr)){
            foreach($plt_arr as $key=>$val){
                $sql = "select power_id from {$this->db->dbprefix('st_game_platform')} WHERE id = {$val}";
                $platform_powers[] = $this->server_mod->getSingle($sql);
            }
        }
        if(empty($platform_powers)) return $power_plus_binary;
        foreach($platform_powers as $key=>$val){
            $power_plus += $val;
        }
        $power_plus_binary = decbin($power_plus);
        return $power_plus_binary;
    }


}




class PRE_Controller extends CI_Controller{
	
	public $mconfig;
	public $micro	= false;
	
	public function __construct(){
		
		parent::__construct();
		
		//读取系统配制信息
		$this->mconfig = read_cache('config');
		
		/* 
		 * 域名处理及判断 微网站域名及自动判断
		 * m.**.com  及 安卓等手机自动访问，都去微网站
		 * 1.默认访问web
		 * 2.web关闭，
		 */
		
		
		if(!isset($this->mconfig['open_miweb']) && !isset($this->mconfig['open_web'])){
			die("<div style='color:red'>{$this->mconfig['close_notice']}</div>");
		}
		
		$templates = $this->mconfig['templates'].'/';
		if(empty($templates)){
			$templates = 'default/';
		}
		
		//直接访问 micro
		if(!isset($this->mconfig['open_web'])){
			$this->micro= true;
		}
		
		//判断访问 iphone,ipad,visit
		if(isset($this->mconfig['open_miweb']) && !$this->micro){
			if(in_array(1, $this->mconfig['visit'])){ //自动判断
				if(preg_match('/(Android|iOS|iPad|iPhone)/i', $_SERVER['HTTP_USER_AGENT'])){
					$this->micro = true;
				}
			}
			if(!$this->micro && in_array(2, $this->mconfig['visit']) && !empty($this->mconfig['miwebsite'])){
				if(strtoupper($this->mconfig['miwebsite']) == strtoupper($_SERVER['HTTP_HOST'])){
					$this->micro = true;
				}
			}
		}
		
		if($this->micro){
			$templates	.= 'micro/';
		}
		//模板及风格
		$this->ci_smarty->template_dir	= FCPATH."templates/{$templates}";
		$this->ci_smarty->compile_dir	= FCPATH."data/templates_co";
		$this->ci_smarty->cache_dir		= FCPATH."data/templates_ca";
		$this->ci_smarty->caching		= 0;
		
		$this->ci_smarty->left_delimiter	= "{";
		$this->ci_smarty->right_delimiter	= "}";
		
		$path = str_replace('\\', '', dirname($_SERVER['SCRIPT_NAME']));
		$this->ci_smarty->assign('system', array(
			'base_url'	=> 'http://'.$_SERVER['HTTP_HOST'].$path.'/',
			'temp_url'	=> "{$path}/templates/{$templates}",
			'class'		=> $this->router->fetch_class(),
			'method'	=> $this->router->fetch_method()
		));
		//注册标签
		foreach (register_smarty() as $key=>$val){
			$this->ci_smarty->registerPlugin('function', $key, $val);
		}
		
	}
	
	
	public function _error($data, $error = 1){
		$data['error'] = $error;
		die(json_encode($data));
	}

}


/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */