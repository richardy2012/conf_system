<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Game extends MY_Controller{
    //游戏中心
    public $connectInfo;
    public $pushPosition;

    public function __construct(){
        parent::__construct();
        $this->load->helper(array('admin'));
//        $this->load->model(array('game_push_mod','game_notice_mod','game_event_mod','server_mod'));
        $this->connectInfo = $this->session->userdata('currentConnectInfo');
        is_login();//?登陆
        //公告显示位置
        $this->pushPosition = $this->MyLang['pushPosition'];

        $this->gameSetConfigFile = array(
            "battle"=>"battle.ini",
            "battle_stronghold"=>"battle_stronghold.ini",
            "battle_balancer"=>"battle_balancer.ini",
            "game_server"=>"game_server.xml",
            "im_server"=>"im_server.ini",
            "load_balancer"=>"load_balancer.xml",
        );
    }

    public function loadBalanceSetList(){
        $data = array();
        $where = " where 1 = 1 ";
        $server_id = isset($_GET['server_id']) && !empty($_GET['server_id']) ? intval($_GET['server_id']) : 0;
        $server_id && $where .= " AND server_id = '{$server_id}'";

        $item_count = 0;
        $page = $this->_get_page(25);
        $this->load->model('game_load_balancer_mod');

        $load_balances = $this->game_load_balancer_mod->getLoadBalances($where,$page['limit'],$item_count);

        $page['item_count'] = $item_count;
        $this->_format_page($page);
        $data['page_info'] = $page;
        $data['balances'] = $load_balances['result'];
        $data['servers'] = $this->server_mod->getServersList($this->currentUserHaveServers_str);
        $this->view('game.loadBalanceSetList.list.php',$data);
    }

    public function createLoadBalanceSet(){
        $set_type = 'load_balancer';
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $data = array();
            $data['servers'] = $this->server_mod->getServersList($this->currentUserHaveServers_str);
            $this->view('game.createLoadBalanceSet.form.php',$data);
        }else {
            $data = array();
            $server_id = isset($_POST['server_id']) ? intval($_POST['server_id']) : 0;
            if(empty($server_id)){
                showmsg('信息有误');
            }
            $server_info = $this->server_mod->get_one($server_id);
            $data['load_balance_host_id'] = $_POST['load_balance_host_id'];
            $data['server_id'] = $server_id;
            $data['in_ip'] = $server_info['in_ip'];
            $data['out_ip'] = $server_info['out_ip'];
            $data['in_nic_name'] = $server_info['in_nic_name'];
            $data['out_nic_name'] = $server_info['out_nic_name'];
            $data['open_server_time'] = $_POST['open_server_time'];
            $data['load_for_login_server_ip'] = $_POST['load_for_login_server_ip'];
            $data['load_for_login_server_port'] = $_POST['load_for_login_server_port'];
            $data['load_for_load_balance_ip'] = $_POST['load_for_load_balance_ip'];
            $data['load_for_load_balance_port'] = $_POST['load_for_load_balance_port'];
            $data['status'] = isset($_POST['status']) ? intval($_POST['status']) : 1;

            list($path,$config) = $this->writeZkPathAndReturn($set_type, $data, $server_info);

            $data['load_balancer_xml'] = !empty($config) ? $config : '';
            $data['zk_path'] = (string)$path;
            $this->load->model('game_load_balancer_mod');
            $ins_res = false;
            if(!empty($path)){
                $ins_res = $this->game_load_balancer_mod->insert($data);
            }
            if($ins_res && $path){
                $link[0]['link_url'] = 'index.php?app=game&act=loadBalanceSetList';
                $link[0]['link_name'] = $this->MyLang['back_list'];
                $link[1]['link_url'] = 'index.php?app=game&act=createLoadBalanceSet';
                $link[1]['link_name'] = '重新填写';
                showmsg($this->MyLang['save_success'], $link);
            }else{
                showmsg($this->MyLang['save_failed']);
            }
        }
    }

    public function editLoadBalanceSet(){
        $set_type = 'load_balancer';
        if(!$id = intval($_GET['id'])){
            showmsg( $this->MyLang['param_error'] );die;
        }
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $data = array();
            $this->load->model('game_load_balancer_mod');
            $data = $this->game_load_balancer_mod->get_one($id);
            $data['servers'] = $this->server_mod->getServersList($this->currentUserHaveServers_str);
            $this->view('game.createLoadBalanceSet.form.php',$data);
        }else {
            $data = array();
            $data['id'] = $id;
            $server_id = isset($_POST['server_id']) ? intval($_POST['server_id']) : 0;
            if(empty($server_id)){
                showmsg('信息有误');
            }
            $server_info = $this->server_mod->get_one($server_id);
            $data['load_balance_host_id'] = $_POST['load_balance_host_id'];
            $data['server_id'] = $server_id;
            $data['in_ip'] = $server_info['in_ip'];
            $data['out_ip'] = $server_info['out_ip'];
            $data['in_nic_name'] = $server_info['in_nic_name'];
            $data['out_nic_name'] = $server_info['out_nic_name'];
            $data['open_server_time'] = $_POST['open_server_time'];
            $data['load_for_login_server_ip'] = $_POST['load_for_login_server_ip'];
            $data['load_for_login_server_port'] = $_POST['load_for_login_server_port'];
            $data['load_for_load_balance_ip'] = $_POST['load_for_load_balance_ip'];
            $data['load_for_load_balance_port'] = $_POST['load_for_load_balance_port'];
            $data['status'] = isset($_POST['status']) ? intval($_POST['status']) : 1;

            list($path,$config) = $this->writeZkPathAndReturn($set_type, $data, $server_info);
            $data['load_balancer_xml'] = !empty($config) ? $config : '';
            $data['zk_path'] = (string)$path;

            $this->load->model('game_load_balancer_mod');

            $ins_res = false;
            if(!empty($path)){
                $ins_res = $this->game_load_balancer_mod->update($id,$data);
            }

            if($ins_res && $path){
                $link[0]['link_url'] = 'index.php?app=game&act=loadBalanceSetList';
                $link[0]['link_name'] = $this->MyLang['back_list'];
                $link[1]['link_url'] = 'index.php?app=game&act=createLoadBalanceSet';
                $link[1]['link_name'] = '重新填写';
                showmsg($this->MyLang['save_success'], $link);
            }else{
                showmsg($this->MyLang['save_failed']);
            }
        }
    }

    public function showGameSet(){
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $set_type = isset($_GET['set_type']) ? trim($_GET['set_type']) : '';
            if(empty($set_type)){
               return false;
            }
            $data = $_GET;
            if($set_type == 'im_server'){
                $server_id = isset($_GET['server_id']) ? intval($_GET['server_id']) : 0;
                $server_info = $server_id ? $this->server_mod->get_one($server_id) : array();
                $this->load->model(array('game_im_server_mod'));
                $im_server_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
                $im_server_info = $im_server_id ? $this->game_im_server_mod->get_one($im_server_id) : array();

                $data['game_server_host_ids'] = !empty($im_server_info) ? $im_server_info['game_server_host_ids'] : '';
                $data['server_im_server_network'] = !empty($server_info) ? $server_info['out_nic_name'] : '';
            }

            if($set_type == 'game_server'){
                $server_id = isset($_GET['server_id']) ? intval($_GET['server_id']) : 0;
                $server_info = $server_id ? $this->server_mod->get_one($server_id) : array();
                $data['game_server_network'] = !empty($server_info) ? $server_info['out_nic_name'] : '';

                $this->load->model(array('game_im_server_mod','game_load_balancer_mod','game_battle_balancer_mod'));
                $im_servers = isset($_GET['im_server_host_id_support']) ? $this->game_im_server_mod->get_one($_GET['im_server_host_id_support']) : array();
                $load_balances = isset($_GET['load_balance_host_id_support']) ? $this->game_load_balancer_mod->get_one($_GET['load_balance_host_id_support']) : array();
                $battle_balances = isset($_GET['battle_balance_host_id_support']) ? $this->game_battle_balancer_mod->get_one($_GET['battle_balance_host_id_support']) : array();

                !empty($load_balances) ? $data['load_balancer_ip'] = $load_balances['load_for_load_balance_ip'] : null;
                !empty($load_balances) ? $data['load_balancer_port'] = $load_balances['load_for_load_balance_port'] : null;

                !empty($battle_balances) ? $data['battle_balancer_ip'] = $battle_balances['battle_for_battle_balance_ip'] : null;
                !empty($battle_balances) ? $data['battle_balancer_port'] = $battle_balances['battle_for_battle_balance_port'] : null;

                !empty($im_servers) ? $data['cpp_service_ip'] = $im_servers['server_im_cppservice_ip'] : null;
                !empty($im_servers) ? $data['cpp_service_port'] = $im_servers['server_im_cppservice_port'] : null;
            }

            if($set_type == 'battle' || $set_type == 'battle_stronghold'){
                $this->load->model(array('game_im_server_mod','game_battle_balancer_mod'));
                $im_servers = isset($_GET['im_server_host_id_support']) ? $this->game_im_server_mod->get_one($_GET['im_server_host_id_support']) : array();
                $battle_balances = isset($_GET['battle_balance_host_id_support']) ? $this->game_battle_balancer_mod->get_one($_GET['battle_balance_host_id_support']) : array();

                !empty($battle_balances) ? $data['battle_balancer_ip'] = $battle_balances['battle_for_battle_balance_ip'] : null;
                !empty($battle_balances) ? $data['battle_balancer_port'] = $battle_balances['battle_for_battle_balance_port'] : null;

                !empty($im_servers) ? $data['php_service_address'] = $im_servers['server_im_phpservice_address'] : null;
                !empty($im_servers) ? $data['php_service_port'] = $im_servers['server_im_cppservice_port'] : null;
            }

            $set_content = file_get_contents(GAMESETDIR.DIRECTORY_SEPARATOR.$this->gameSetConfigFile[$set_type]);
            if(!empty($set_content)){
                foreach($data as $key=>$val){
                    $set_content = str_replace('[replace_'.$key.']',$val,$set_content);
                }
            }
            $Text = <<<EOT
<textarea cols=90 rows=40 name=copy id=code>
$set_content
</textarea>
EOT;
            echo $Text;
        }
    }

    public function ajaxCheckHostId(){
        $host_id = isset($_POST['host_id']) ? intval($_POST['host_id']) : 0;
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $type = isset($_POST['type']) ? trim($_POST['type']) : '';

        if(empty($type) || !$host_id){
            echo json_encode(false);
            return;
        }
        $mod = 'game_'.$type.'_mod';
        $this->load->model($mod);
        if(!$this->$mod->ajaxCheckHostId($host_id,$id)){
            echo json_encode(false);return;
        }
        echo json_encode(true);return;
    }

    public function ajaxCheckServerSingle(){
        $server_id = isset($_POST['server_id']) ? intval($_POST['server_id']) : 0;
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if(!$server_id){
            echo json_encode(false);
            return;
        }
        $this->load->model('game_load_balancer_mod');
        if(!$this->game_load_balancer_mod->ajaxCheckServerSingle($server_id,$id)){
            echo json_encode(false);return;
        }
        echo json_encode(true);return;
    }

    public function ajaxCheckBattleBalanceServerSingle(){
        $server_id = isset($_POST['server_id']) ? intval($_POST['server_id']) : 0;
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if(!$server_id){
            echo json_encode(false);
            return;
        }
        $this->load->model('game_battle_balancer_mod');
        if(!$this->game_battle_balancer_mod->ajaxCheckBattleBalanceServerSingle($server_id,$id)){
            echo json_encode(false);return;
        }
        echo json_encode(true);return;
    }

    public function ajaxCheckImServerSingle(){
        $server_id = isset($_POST['server_id']) ? intval($_POST['server_id']) : 0;
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        if(!$server_id){
            echo json_encode(false);
            return;
        }
        $this->load->model('game_im_server_mod');
        if(!$this->game_im_server_mod->ajaxCheckImServerSingle($server_id,$id)){
            echo json_encode(false);return;
        }
        echo json_encode(true);return;
    }

    public function battleBalanceSetList(){
        $data = array();
        $where = " where 1 = 1 ";
        $server_id = isset($_GET['server_id']) && !empty($_GET['server_id']) ? intval($_GET['server_id']) : 0;
        $server_id && $where .= " AND server_id = '{$server_id}'";

        $item_count = 0;
        $page = $this->_get_page(25);
        $this->load->model('game_battle_balancer_mod');

        $load_balances = $this->game_battle_balancer_mod->getBattleBalances($where,$page['limit'],$item_count);

        $page['item_count'] = $item_count;
        $this->_format_page($page);
        $data['page_info'] = $page;
        $data['balances'] = $load_balances['result'];
        $data['servers'] = $this->server_mod->getServersList($this->currentUserHaveServers_str);
        $this->view('game.battleBalanceSetList.list.php',$data);
    }

    public function createBattleBalanceSet(){
        $set_type = 'battle_balancer';
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $data = array();
            $data['servers'] = $this->server_mod->getServersList($this->currentUserHaveServers_str);
            $this->view('game.createBattleBalanceSet.form.php',$data);
        }else {
            $data = array();
            $server_id = isset($_POST['server_id']) ? intval($_POST['server_id']) : 0;
            if(empty($server_id)){
                showmsg('信息有误');
            }
            $server_info = $this->server_mod->get_one($server_id);
            $data['battle_balance_host_id'] = $_POST['battle_balance_host_id'];
            $data['server_id'] = $server_id;
            $data['in_ip'] = $server_info['in_ip'];
            $data['out_ip'] = $server_info['out_ip'];
            $data['in_nic_name'] = $server_info['in_nic_name'];
            $data['out_nic_name'] = $server_info['out_nic_name'];
            $data['open_server_time'] = $_POST['open_server_time'];
            $data['battle_for_battle_master_ip'] = $_POST['battle_for_battle_master_ip'];
            $data['battle_for_battle_mater_port'] = $_POST['battle_for_battle_mater_port'];
            $data['battle_for_battle_balance_ip'] = $_POST['battle_for_battle_balance_ip'];
            $data['battle_for_battle_balance_port'] = $_POST['battle_for_battle_balance_port'];
            $data['status'] = isset($_POST['status']) ? intval($_POST['status']) : 1;


            list($path,$config) = $this->writeZkPathAndReturn($set_type, $data, $server_info);
            $data['battle_balancer_ini'] = !empty($config) ? $config : '';
            $data['zk_path'] = (string)$path;

            $this->load->model('game_battle_balancer_mod');
            $ins_res = false;
            if(!empty($path)){
                $ins_res = $this->game_battle_balancer_mod->insert($data);
            }
            if($ins_res && $path){
                $link[0]['link_url'] = 'index.php?app=game&act=battleBalanceSetList';
                $link[0]['link_name'] = $this->MyLang['back_list'];
                $link[1]['link_url'] = 'index.php?app=game&act=createBattleBalanceSet';
                $link[1]['link_name'] = '重新填写';
                showmsg($this->MyLang['save_success'], $link);
            }else{
                showmsg($this->MyLang['save_failed']);
            }
        }
    }

    public function editBattleBalanceSet(){
        $set_type = 'battle_balancer';
        if(!$id = intval($_GET['id'])){
            showmsg( $this->MyLang['param_error'] );die;
        }
        $this->load->model('game_battle_balancer_mod');
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $data = array();
            $data = $this->game_battle_balancer_mod->get_one($id);
            $data['servers'] = $this->server_mod->getServersList($this->currentUserHaveServers_str);
            $this->view('game.createBattleBalanceSet.form.php',$data);
        }else {
            $data = array();
            $data['id'] = $id;
            $server_id = isset($_POST['server_id']) ? intval($_POST['server_id']) : 0;
            if(empty($server_id)){
                showmsg('信息有误');
            }
            $server_info = $this->server_mod->get_one($server_id);
            $data['battle_balance_host_id'] = $_POST['battle_balance_host_id'];
            $data['server_id'] = $server_id;
            $data['in_ip'] = $server_info['in_ip'];
            $data['out_ip'] = $server_info['out_ip'];
            $data['in_nic_name'] = $server_info['in_nic_name'];
            $data['out_nic_name'] = $server_info['out_nic_name'];
            $data['open_server_time'] = $_POST['open_server_time'];
            $data['battle_for_battle_master_ip'] = $_POST['battle_for_battle_master_ip'];
            $data['battle_for_battle_mater_port'] = $_POST['battle_for_battle_mater_port'];
            $data['battle_for_battle_balance_ip'] = $_POST['battle_for_battle_balance_ip'];
            $data['battle_for_battle_balance_port'] = $_POST['battle_for_battle_balance_port'];
            $data['status'] = isset($_POST['status']) ? intval($_POST['status']) : 1;

            list($path,$config) = $this->writeZkPathAndReturn($set_type, $data, $server_info);
            $data['battle_balancer_ini'] = !empty($config) ? $config : '';
            $data['zk_path'] = (string)$path;

            $ins_res = false;
            if(!empty($path)){
                $ins_res = $this->game_battle_balancer_mod->update($id,$data);
            }
            if($ins_res && $path){
                $link[0]['link_url'] = 'index.php?app=game&act=battleBalanceSetList';
                $link[0]['link_name'] = $this->MyLang['back_list'];
                $link[1]['link_url'] = 'index.php?app=game&act=createBattleBalanceSet';
                $link[1]['link_name'] = '重新填写';
                showmsg($this->MyLang['save_success'], $link);
            }else{
                showmsg($this->MyLang['save_failed']);
            }
        }
    }

    public function createImServerSet(){
        $set_type = 'im_server';
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $data = array();
            $data['servers'] = $this->server_mod->getServersList($this->currentUserHaveServers_str);
            $this->view('game.createImServerSet.form.php',$data);
        }else {
            $data = array();
            $server_id = isset($_POST['server_id']) ? intval($_POST['server_id']) : 0;
            if(empty($server_id)){
                showmsg('信息有误');
            }
            $server_info = $this->server_mod->get_one($server_id);
            $data['im_server_host_id'] = $_POST['im_server_host_id'];
            $data['server_id'] = $server_id;
            $data['in_ip'] = $server_info['in_ip'];
            $data['out_ip'] = $server_info['out_ip'];
            $data['in_nic_name'] = $server_info['in_nic_name'];
            $data['out_nic_name'] = $server_info['out_nic_name'];
            $data['open_server_time'] = $_POST['open_server_time'];

            $data['server_im_server_ip'] = $_POST['server_im_server_ip'];
            $data['server_im_server_network'] = $server_info['out_nic_name'];
            $data['server_im_server_port'] = $_POST['server_im_server_port'];

            $data['server_im_loginbalancer_ip'] = $_POST['server_im_loginbalancer_ip'];
            $data['server_im_loginbalancer_port'] = $_POST['server_im_loginbalancer_port'];

            $data['server_im_phpservice_address'] = $_POST['server_im_phpservice_address'];
            $data['server_im_phpservice_port'] = $_POST['server_im_phpservice_port'];

            $data['server_im_cppservice_ip'] = $_POST['server_im_cppservice_ip'];
            $data['server_im_cppservice_port'] = $_POST['server_im_cppservice_port'];



            $data['status'] = isset($_POST['status']) ? intval($_POST['status']) : 1;

            list($path,$config) = $this->writeZkPathAndReturn($set_type, $data, $server_info);
            $data['im_server_ini'] = !empty($config) ? $config : '';
            $data['zk_path'] = (string)$path;


            $this->load->model('game_im_server_mod');
            $ins_res = false;
            if(!empty($path)){
                $ins_res = $this->game_im_server_mod->insert($data);
            }
            if($ins_res && $path){
                $link[0]['link_url'] = 'index.php?app=game&act=imServerSetList';
                $link[0]['link_name'] = $this->MyLang['back_list'];
                $link[1]['link_url'] = 'index.php?app=game&act=createImServerSet';
                $link[1]['link_name'] = '重新填写';
                showmsg($this->MyLang['save_success'], $link);
            }else{
                showmsg($this->MyLang['save_failed']);
            }
        }
    }

    public function imServerSetList(){
        $data = array();
        $where = " where 1 = 1 ";
        $server_id = isset($_GET['server_id']) && !empty($_GET['server_id']) ? intval($_GET['server_id']) : 0;
        $server_id && $where .= " AND server_id = '{$server_id}'";

        $item_count = 0;
        $page = $this->_get_page(25);
        $this->load->model('game_im_server_mod');

        $load_balances = $this->game_im_server_mod->getImServers($where,$page['limit'],$item_count);

        $page['item_count'] = $item_count;
        $this->_format_page($page);
        $data['page_info'] = $page;
        $data['balances'] = $load_balances['result'];
        $data['servers'] = $this->server_mod->getServersList($this->currentUserHaveServers_str);
        $this->view('game.imServerSetList.list.php',$data);
    }


    public function editImServerSet(){
        $set_type = 'im_server';
        if(!$id = intval($_GET['id'])){
            showmsg( $this->MyLang['param_error'] );die;
        }
        $this->load->model('game_im_server_mod');

        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $data = array();
            $data = $this->game_im_server_mod->get_one($id);
            $data['servers'] = $this->server_mod->getServersList($this->currentUserHaveServers_str);
            $this->view('game.createImServerSet.form.php',$data);
        }else {
            $data = array();

            $server_id = isset($_POST['server_id']) ? intval($_POST['server_id']) : 0;

            if(empty($server_id)){
                showmsg('信息有误');
            }

            $server_info = $this->server_mod->get_one($server_id);
            $data['im_server_host_id'] = $_POST['im_server_host_id'];
            $data['server_id'] = $server_id;
            $data['in_ip'] = $server_info['in_ip'];
            $data['out_ip'] = $server_info['out_ip'];
            $data['in_nic_name'] = $server_info['in_nic_name'];
            $data['out_nic_name'] = $server_info['out_nic_name'];
            $data['open_server_time'] = $_POST['open_server_time'];

            $data['server_im_server_ip'] = $_POST['server_im_server_ip'];
            $data['server_im_server_network'] = $server_info['out_nic_name'];
            $data['server_im_server_port'] = $_POST['server_im_server_port'];

            $data['server_im_loginbalancer_ip'] = $_POST['server_im_loginbalancer_ip'];
            $data['server_im_loginbalancer_port'] = $_POST['server_im_loginbalancer_port'];

            $data['server_im_phpservice_address'] = $_POST['server_im_phpservice_address'];
            $data['server_im_phpservice_port'] = $_POST['server_im_phpservice_port'];

            $data['server_im_cppservice_ip'] = $_POST['server_im_cppservice_ip'];
            $data['server_im_cppservice_port'] = $_POST['server_im_cppservice_port'];

            $data['status'] = isset($_POST['status']) ? intval($_POST['status']) : 1;

            list($path,$config) = $this->writeZkPathAndReturn($set_type, $data, $server_info);
            $data['im_server_ini'] = !empty($config) ? $config : '';
            $data['zk_path'] = (string)$path;

            $ins_res = false;
            if(!empty($path)){
                $ins_res = $this->game_im_server_mod->update($id,$data);
            }
            if($ins_res && $path){
                $link[0]['link_url'] = 'index.php?app=game&act=imServerSetList';
                $link[0]['link_name'] = $this->MyLang['back_list'];
                $link[1]['link_url'] = 'index.php?app=game&act=createImServerSet';
                $link[1]['link_name'] = '重新填写';
                showmsg($this->MyLang['save_success'], $link);
            }else{
                showmsg($this->MyLang['save_failed']);
            }
        }
    }


//BattleStrongholdSetList
//createBattleStrongholdSet
//editBattleStrongholdSet


    public function BattleStrongholdSetList(){
        $data = array();
        $where = " where 1 = 1 ";
        $server_id = isset($_GET['server_id']) && !empty($_GET['server_id']) ? intval($_GET['server_id']) : 0;
        $server_id && $where .= " AND server_id = '{$server_id}'";

        $item_count = 0;
        $page = $this->_get_page(25);
        $this->load->model('game_battle_stronghold_mod');

        $load_balances = $this->game_battle_stronghold_mod->getBattleStronghold($where,$page['limit'],$item_count);

        $page['item_count'] = $item_count;
        $this->_format_page($page);
        $data['page_info'] = $page;
        $data['balances'] = $load_balances['result'];
        $data['servers'] = $this->server_mod->getServersList($this->currentUserHaveServers_str);
        $this->view('game.battleStrongholdSetList.list.php',$data);
    }

    public function createBattleStrongholdSet(){
        $set_type = 'battle_stronghold';
        $this->load->model(array('game_im_server_mod','game_load_balancer_mod','game_battle_balancer_mod'));
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $data = array();
            $data['servers'] = $this->server_mod->getServersList($this->currentUserHaveServers_str);
            $data['im_server_hosts'] = $this->game_im_server_mod->get_all();

            $data['load_balance_hosts'] = $this->game_load_balancer_mod->get_all();
            $data['battle_balance_hosts'] = $this->game_battle_balancer_mod->get_all();
            $this->view('game.createBattleStrongholdSet.form.php',$data);
        }else {
            $data = array();
            $server_id = isset($_POST['server_id']) ? intval($_POST['server_id']) : 0;
            if(empty($server_id)){
                showmsg('信息有误');
            }
            $server_info = $this->server_mod->get_one($server_id);
            $data['battle_stronghold_host_id'] = $_POST['battle_stronghold_host_id'];
            $data['server_id'] = $server_id;
            $data['in_ip'] = $server_info['in_ip'];
            $data['out_ip'] = $server_info['out_ip'];
            $data['in_nic_name'] = $server_info['in_nic_name'];
            $data['out_nic_name'] = $server_info['out_nic_name'];
            $data['open_server_time'] = $_POST['open_server_time'];
            $data['status'] = isset($_POST['status']) ? intval($_POST['status']) : 1;

//            $data['im_server_host_id_support'] = $_POST['im_server_host_id_support'];
            $data['battle_balance_host_id_support'] = $_POST['battle_balance_host_id_support'];

            $data['battle_server_ip'] = $_POST['battle_server_ip'];
            $data['battle_server_port'] = $_POST['battle_server_port'];

//            $im_servers = intval($_POST['im_server_host_id_support']) ? $this->game_im_server_mod->get_one($_POST['im_server_host_id_support']) : array();
            $battle_balances = intval($_POST['battle_balance_host_id_support']) ? $this->game_battle_balancer_mod->get_one($_POST['battle_balance_host_id_support']) : array();

            $data['battle_balancer_ip'] = $battle_balances['battle_for_battle_balance_ip'];
            $data['battle_balancer_port'] = $battle_balances['battle_for_battle_balance_port'];

            list($path,$config) = $this->writeZkPathAndReturn($set_type, $data, $server_info,$data['battle_stronghold_host_id']);
            $data['battle_stronghold_ini'] = !empty($config) ? $config : '';
            $data['zk_path'] = (string)$path;

            $this->load->model('game_battle_stronghold_mod');

            $ins_res = false;

            if(!empty($path)){
                $ins_res = $this->game_battle_stronghold_mod->insert($data);
            }

            if($ins_res && $path){
                $link[0]['link_url'] = 'index.php?app=game&act=BattleStrongholdSetList';
                $link[0]['link_name'] = $this->MyLang['back_list'];
                $link[1]['link_url'] = 'index.php?app=game&act=createBattleStrongholdSet';
                $link[1]['link_name'] = '重新填写';
                showmsg($this->MyLang['save_success'], $link);
            }else{
                showmsg($this->MyLang['save_failed']);
            }
        }
    }


    public function editBattleStrongholdSet(){
        $set_type = 'battle_stronghold';
        if(!$id = intval($_GET['id'])){
            showmsg( $this->MyLang['param_error'] );die;
        }
        $this->load->model(array('game_im_server_mod','game_load_balancer_mod','game_battle_balancer_mod'));
        $this->load->model('game_battle_stronghold_mod');
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $data = array();

            $data = $this->game_battle_stronghold_mod->get_one($id);
            $data['servers'] = $this->server_mod->getServersList($this->currentUserHaveServers_str);
            $data['im_server_hosts'] = $this->game_im_server_mod->get_all();
            $data['load_balance_hosts'] = $this->game_load_balancer_mod->get_all();
            $data['battle_balance_hosts'] = $this->game_battle_balancer_mod->get_all();
            $this->view('game.createBattleStrongholdSet.form.php',$data);

        }else {
            $data = array();
            $server_id = isset($_POST['server_id']) ? intval($_POST['server_id']) : 0;
            if(empty($server_id)){
                showmsg('信息有误');
            }
            $server_info = $this->server_mod->get_one($server_id);
            $data['battle_stronghold_host_id'] = $_POST['battle_stronghold_host_id'];
            $data['server_id'] = $server_id;
            $data['in_ip'] = $server_info['in_ip'];
            $data['out_ip'] = $server_info['out_ip'];
            $data['in_nic_name'] = $server_info['in_nic_name'];
            $data['out_nic_name'] = $server_info['out_nic_name'];
            $data['open_server_time'] = $_POST['open_server_time'];
            $data['status'] = isset($_POST['status']) ? intval($_POST['status']) : 1;

//            $data['im_server_host_id_support'] = $_POST['im_server_host_id_support'];
            $data['battle_balance_host_id_support'] = $_POST['battle_balance_host_id_support'];

            $data['battle_server_ip'] = $_POST['battle_server_ip'];
            $data['battle_server_port'] = $_POST['battle_server_port'];

//            $im_servers = intval($_POST['im_server_host_id_support']) ? $this->game_im_server_mod->get_one($_POST['im_server_host_id_support']) : array();
            $battle_balances = intval($_POST['battle_balance_host_id_support']) ? $this->game_battle_balancer_mod->get_one($_POST['battle_balance_host_id_support']) : array();

            $data['battle_balancer_ip'] = $battle_balances['battle_for_battle_balance_ip'];
            $data['battle_balancer_port'] = $battle_balances['battle_for_battle_balance_port'];

            list($path,$config) = $this->writeZkPathAndReturn($set_type, $data, $server_info,$data['battle_stronghold_host_id']);
            $data['battle_stronghold_ini'] = !empty($config) ? $config : '';
            $data['zk_path'] = (string)$path;

            $ins_res = false;
            if(!empty($path)){
                $ins_res = $this->game_battle_stronghold_mod->update($id,$data);
            }

            if($ins_res && $path){
                $link[0]['link_url'] = 'index.php?app=game&act=BattleStrongholdSetList';
                $link[0]['link_name'] = $this->MyLang['back_list'];
                $link[1]['link_url'] = 'index.php?app=game&act=createBattleStrongholdSet';
                $link[1]['link_name'] = '重新填写';
                showmsg($this->MyLang['save_success'], $link);
            }else{
                showmsg($this->MyLang['save_failed']);
            }
        }
    }



    public function battleSetList(){
        $data = array();
        $where = " where 1 = 1 ";
        $server_id = isset($_GET['server_id']) && !empty($_GET['server_id']) ? intval($_GET['server_id']) : 0;
        $server_id && $where .= " AND server_id = '{$server_id}'";

        $item_count = 0;
        $page = $this->_get_page(25);
        $this->load->model('game_battle_mod');

        $load_balances = $this->game_battle_mod->getBattleServers($where,$page['limit'],$item_count);

        $page['item_count'] = $item_count;
        $this->_format_page($page);
        $data['page_info'] = $page;
        $data['balances'] = $load_balances['result'];
        $data['servers'] = $this->server_mod->getServersList($this->currentUserHaveServers_str);
        $this->view('game.battleSetList.list.php',$data);
    }


    public function createBattleSet(){
        $set_type = 'battle';
        $this->load->model(array('game_im_server_mod','game_load_balancer_mod','game_battle_balancer_mod'));
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $data = array();
            $data['servers'] = $this->server_mod->getServersList($this->currentUserHaveServers_str);
            $data['im_server_hosts'] = $this->game_im_server_mod->get_all();

            $data['load_balance_hosts'] = $this->game_load_balancer_mod->get_all();
            $data['battle_balance_hosts'] = $this->game_battle_balancer_mod->get_all();
            $this->view('game.createBattleSet.form.php',$data);
        }else {
            $data = array();
            $server_id = isset($_POST['server_id']) ? intval($_POST['server_id']) : 0;
            if(empty($server_id)){
                showmsg('信息有误');
            }
            $server_info = $this->server_mod->get_one($server_id);
            $data['battle_server_host_id'] = $_POST['battle_server_host_id'];
            $data['server_id'] = $server_id;
            $data['in_ip'] = $server_info['in_ip'];
            $data['out_ip'] = $server_info['out_ip'];
            $data['in_nic_name'] = $server_info['in_nic_name'];
            $data['out_nic_name'] = $server_info['out_nic_name'];
            $data['open_server_time'] = $_POST['open_server_time'];
            $data['status'] = isset($_POST['status']) ? intval($_POST['status']) : 1;

//            $data['im_server_host_id_support'] = $_POST['im_server_host_id_support'];
            $data['battle_balance_host_id_support'] = $_POST['battle_balance_host_id_support'];

            $data['battle_server_ip'] = $_POST['battle_server_ip'];
            $data['battle_server_port'] = $_POST['battle_server_port'];

//            $im_servers = intval($_POST['im_server_host_id_support']) ? $this->game_im_server_mod->get_one($_POST['im_server_host_id_support']) : array();
            $battle_balances = intval($_POST['battle_balance_host_id_support']) ? $this->game_battle_balancer_mod->get_one($_POST['battle_balance_host_id_support']) : array();

            $data['battle_balancer_ip'] = $battle_balances['battle_for_battle_balance_ip'];
            $data['battle_balancer_port'] = $battle_balances['battle_for_battle_balance_port'];

            list($path,$config) = $this->writeZkPathAndReturn($set_type, $data, $server_info,$data['battle_server_host_id']);
            $data['battle_ini'] = !empty($config) ? $config : '';
            $data['zk_path'] = (string)$path;

            $this->load->model('game_battle_mod');
            $ins_res = false;

            if(!empty($path)){
                $ins_res = $this->game_battle_mod->insert($data);
            }

            if($ins_res && $path){
                $link[0]['link_url'] = 'index.php?app=game&act=battleSetList';
                $link[0]['link_name'] = $this->MyLang['back_list'];
                $link[1]['link_url'] = 'index.php?app=game&act=createBattleSet';
                $link[1]['link_name'] = '重新填写';
                showmsg($this->MyLang['save_success'], $link);
            }else{
                showmsg($this->MyLang['save_failed']);
            }
        }
    }

    public function editBattleSet(){
        $set_type = 'battle';
        if(!$id = intval($_GET['id'])){
            showmsg( $this->MyLang['param_error'] );die;
        }
        $this->load->model('game_battle_mod');
        $this->load->model(array('game_im_server_mod','game_load_balancer_mod','game_battle_balancer_mod'));
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $data = array();

            $data = $this->game_battle_mod->get_one($id);
            $data['servers'] = $this->server_mod->getServersList($this->currentUserHaveServers_str);
            $data['im_server_hosts'] = $this->game_im_server_mod->get_all();

            $data['load_balance_hosts'] = $this->game_load_balancer_mod->get_all();
            $data['battle_balance_hosts'] = $this->game_battle_balancer_mod->get_all();
            $this->view('game.createBattleSet.form.php',$data);
        }else {
            $data = array();
            $server_id = isset($_POST['server_id']) ? intval($_POST['server_id']) : 0;
            if(empty($server_id)){
                showmsg('信息有误');
            }
            $server_info = $this->server_mod->get_one($server_id);
            $data['battle_server_host_id'] = $_POST['battle_server_host_id'];
            $data['server_id'] = $server_id;
            $data['in_ip'] = $server_info['in_ip'];
            $data['out_ip'] = $server_info['out_ip'];
            $data['in_nic_name'] = $server_info['in_nic_name'];
            $data['out_nic_name'] = $server_info['out_nic_name'];
            $data['open_server_time'] = $_POST['open_server_time'];
            $data['status'] = isset($_POST['status']) ? intval($_POST['status']) : 1;

//            $data['im_server_host_id_support'] = $_POST['im_server_host_id_support'];
            $data['battle_balance_host_id_support'] = $_POST['battle_balance_host_id_support'];

            $data['battle_server_ip'] = $_POST['battle_server_ip'];
            $data['battle_server_port'] = $_POST['battle_server_port'];

//            $im_servers = intval($_POST['im_server_host_id_support']) ? $this->game_im_server_mod->get_one($_POST['im_server_host_id_support']) : array();
            $battle_balances = intval($_POST['battle_balance_host_id_support']) ? $this->game_battle_balancer_mod->get_one($_POST['battle_balance_host_id_support']) : array();

            $data['battle_balancer_ip'] = $battle_balances['battle_for_battle_balance_ip'];
            $data['battle_balancer_port'] = $battle_balances['battle_for_battle_balance_port'];


            list($path,$config) = $this->writeZkPathAndReturn($set_type, $data, $server_info,$data['battle_server_host_id']);
            $data['battle_ini'] = !empty($config) ? $config : '';
            $data['zk_path'] = (string)$path;

            $ins_res = false;

            if(!empty($path)){
                $ins_res = $this->game_battle_mod->update($id,$data);
            }

            if($ins_res && $path){
                $link[0]['link_url'] = 'index.php?app=game&act=battleSetList';
                $link[0]['link_name'] = $this->MyLang['back_list'];
                $link[1]['link_url'] = 'index.php?app=game&act=createBattleSet';
                $link[1]['link_name'] = '重新填写';
                showmsg($this->MyLang['save_success'], $link);
            }else{
                showmsg($this->MyLang['save_failed']);
            }
        }
    }

    public function gameServerSetList(){
        $data = array();
        $where = " where 1 = 1 ";
        $server_id = isset($_GET['server_id']) && !empty($_GET['server_id']) ? intval($_GET['server_id']) : 0;
        $server_id && $where .= " AND server_id = '{$server_id}'";

        $item_count = 0;
        $page = $this->_get_page(25);
        $this->load->model('game_game_server_mod');

        $load_balances = $this->game_game_server_mod->getGameServers($where,$page['limit'],$item_count);

        $page['item_count'] = $item_count;
        $this->_format_page($page);
        $data['page_info'] = $page;
        $data['balances'] = $load_balances['result'];
        $data['servers'] = $this->server_mod->getServersList($this->currentUserHaveServers_str);
        $this->view('game.gameServerSetList.list.php',$data);
    }

    public function createGameServerSet(){
        $set_type = 'game_server';
        $this->load->model(array('game_im_server_mod','game_load_balancer_mod','game_battle_balancer_mod'));
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $data = array();
            $data['servers'] = $this->server_mod->getServersList($this->currentUserHaveServers_str);
            $data['im_server_hosts'] = $this->game_im_server_mod->get_all();

            $data['load_balance_hosts'] = $this->game_load_balancer_mod->get_all();
            $data['battle_balance_hosts'] = $this->game_battle_balancer_mod->get_all();

            $this->view('game.createGameServerSet.form.php',$data);
        }else {
            $data = array();
            $server_id = isset($_POST['server_id']) ? intval($_POST['server_id']) : 0;
            if(empty($server_id)){
                showmsg('信息有误');
            }
            $server_info = $this->server_mod->get_one($server_id);
            $data['game_server_host_id'] = $_POST['game_server_host_id'];
            $data['server_id'] = $server_id;
            $data['in_ip'] = $server_info['in_ip'];
            $data['out_ip'] = $server_info['out_ip'];
            $data['in_nic_name'] = $server_info['in_nic_name'];
            $data['out_nic_name'] = $server_info['out_nic_name'];
            $data['open_server_time'] = $_POST['open_server_time'];
            $data['status'] = isset($_POST['status']) ? intval($_POST['status']) : 1;

            $data['im_server_host_id_support'] = $_POST['im_server_host_id_support'];
            $data['load_balance_host_id_support'] = $_POST['load_balance_host_id_support'];
            $data['battle_balance_host_id_support'] = $_POST['battle_balance_host_id_support'];

            $data['game_server_ip'] = $_POST['game_server_ip'];
            $data['game_server_port'] = $_POST['game_server_port'];
            $data['game_server_network'] = $server_info['out_nic_name'];

            $im_servers = intval($_POST['im_server_host_id_support']) ? $this->game_im_server_mod->get_one($_POST['im_server_host_id_support']) : array();
            $load_balances = intval($_POST['load_balance_host_id_support']) ? $this->game_load_balancer_mod->get_one($_POST['load_balance_host_id_support']) : array();
            $battle_balances = intval($_POST['battle_balance_host_id_support']) ? $this->game_battle_balancer_mod->get_one($_POST['battle_balance_host_id_support']) : array();

            $data['load_balancer_ip'] = $load_balances['load_for_load_balance_ip'];
            $data['load_balancer_port'] = $load_balances['load_for_load_balance_port'];


            $data['battle_balancer_ip'] = $battle_balances['battle_for_battle_balance_ip'];
            $data['battle_balancer_port'] = $battle_balances['battle_for_battle_balance_port'];

            $data['cpp_service_ip'] = $im_servers['server_im_cppservice_ip'];
            $data['cpp_service_port'] = $im_servers['server_im_cppservice_port'];

            list($path,$config) = $this->writeZkPathAndReturn($set_type, $data, $server_info,$data['game_server_host_id']);
            $data['game_server_xml'] = !empty($config) ? $config : '';
            $data['zk_path'] = (string)$path;

            $this->load->model('game_game_server_mod');
            $ins_res = false;

            if(!empty($path)){
                $ins_res = $this->game_game_server_mod->insert($data);
            }

            $game_server_host_ids = '';
            $game_server_host_ids_arr = array();
            $game_server_host_ids_in_im_server = $this->game_game_server_mod->getGameServerHostIdsInImServer($data['im_server_host_id_support']);

            if(!empty($game_server_host_ids_in_im_server)){
                foreach($game_server_host_ids_in_im_server as $key=>$val){
                    $game_server_host_ids_arr[] = $val['game_server_host_id'];
                }
            }

            $game_server_host_ids = implode(',',$game_server_host_ids_arr);
            $flag = $this->game_im_server_mod->updateGameServerHostIds($data['im_server_host_id_support'],$game_server_host_ids);

            if($flag){
                $im_server_set_type = 'im_server';
                //更新im_server 的 zk_path
                $server_info_query = $this->db->get_where($this->game_im_server_mod->_table, array('im_server_host_id'=> $data['im_server_host_id_support']));
                $im_server_info = $server_info_query->row_array();
                $im_server_host_server_info = array();
                if(!empty($im_server_info)){
                    isset($im_server_info['server_id']) && $im_server_host_server_info = $this->server_mod->get_one($im_server_info['server_id']);
                }
                list($im_zk_path,$im_server_config) = $this->writeZkPathAndReturn($im_server_set_type, $im_server_info, $im_server_host_server_info);

                $this->game_im_server_mod->db->query($this->game_im_server_mod->db->update_string(
                    $this->game_im_server_mod->_table,array('im_server_ini'=>$im_server_config),array('im_server_host_id'=>$data['im_server_host_id_support'])));
            }

            if($ins_res && $path){
                $link[0]['link_url'] = 'index.php?app=game&act=gameServerSetList';
                $link[0]['link_name'] = $this->MyLang['back_list'];
                $link[1]['link_url'] = 'index.php?app=game&act=createGameServerSet';
                $link[1]['link_name'] = '重新填写';
                showmsg($this->MyLang['save_success'], $link);
            }else{
                showmsg($this->MyLang['save_failed']);
            }
        }
    }

    public function editGameServerSet(){
        $set_type = 'game_server';
        if(!$id = intval($_GET['id'])){
            showmsg( $this->MyLang['param_error'] );die;
        }
        $this->load->model('game_game_server_mod');
        $this->load->model(array('game_im_server_mod','game_load_balancer_mod','game_battle_balancer_mod'));
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $data = array();
            $data = $this->game_game_server_mod->get_one($id);

            $data['servers'] = $this->server_mod->getServersList($this->currentUserHaveServers_str);
            $data['im_server_hosts'] = $this->game_im_server_mod->get_all();
            $data['load_balance_hosts'] = $this->game_load_balancer_mod->get_all();
            $data['battle_balance_hosts'] = $this->game_battle_balancer_mod->get_all();

            $this->view('game.createGameServerSet.form.php',$data);
        }else {
            $data = array();
            $server_id = isset($_POST['server_id']) ? intval($_POST['server_id']) : 0;
            if(empty($server_id)){
                showmsg('信息有误');
            }
            $server_info = $this->server_mod->get_one($server_id);
            $data['id'] = $id;
            $data['game_server_host_id'] = $_POST['game_server_host_id'];
            $data['server_id'] = $server_id;
            $data['in_ip'] = $server_info['in_ip'];
            $data['out_ip'] = $server_info['out_ip'];
            $data['in_nic_name'] = $server_info['in_nic_name'];
            $data['out_nic_name'] = $server_info['out_nic_name'];
            $data['open_server_time'] = $_POST['open_server_time'];
            $data['status'] = isset($_POST['status']) ? intval($_POST['status']) : 1;

            $data['im_server_host_id_support'] = $_POST['im_server_host_id_support'];
            $data['load_balance_host_id_support'] = $_POST['load_balance_host_id_support'];
            $data['battle_balance_host_id_support'] = $_POST['battle_balance_host_id_support'];

            $data['game_server_ip'] = $_POST['game_server_ip'];
            $data['game_server_port'] = $_POST['game_server_port'];
            $data['game_server_network'] = $server_info['out_nic_name'];

            $im_servers = intval($_POST['im_server_host_id_support']) ? $this->game_im_server_mod->get_one($_POST['im_server_host_id_support']) : array();
            $load_balances = intval($_POST['load_balance_host_id_support']) ? $this->game_load_balancer_mod->get_one($_POST['load_balance_host_id_support']) : array();
            $battle_balances = intval($_POST['battle_balance_host_id_support']) ? $this->game_battle_balancer_mod->get_one($_POST['battle_balance_host_id_support']) : array();

            $data['load_balancer_ip'] = $load_balances['load_for_load_balance_ip'];
            $data['load_balancer_port'] = $load_balances['load_for_load_balance_port'];


            $data['battle_balancer_ip'] = $battle_balances['battle_for_battle_balance_ip'];
            $data['battle_balancer_port'] = $battle_balances['battle_for_battle_balance_port'];

            $data['cpp_service_ip'] = $im_servers['server_im_cppservice_ip'];
            $data['cpp_service_port'] = $im_servers['server_im_cppservice_port'];

            list($path,$config) = $this->writeZkPathAndReturn($set_type, $data, $server_info,$data['game_server_host_id']);
            $data['game_server_xml'] = !empty($config) ? $config : '';
            $data['zk_path'] = (string)$path;

            $ins_res = false;

            if(!empty($path)){
                $ins_res = $this->game_game_server_mod->update($id,$data);
            }

            $game_server_host_ids = '';
            $game_server_host_ids_arr = array();
            $game_server_host_ids_in_im_server = $this->game_game_server_mod->getGameServerHostIdsInImServer($data['im_server_host_id_support']);

            if(!empty($game_server_host_ids_in_im_server)){
                foreach($game_server_host_ids_in_im_server as $key=>$val){
                    $game_server_host_ids_arr[] = $val['game_server_host_id'];
                }
            }

            $game_server_host_ids = implode(',',$game_server_host_ids_arr);
            $flag = $this->game_im_server_mod->updateGameServerHostIds($data['im_server_host_id_support'],$game_server_host_ids);

            if($flag){
                $im_server_set_type = 'im_server';
                //更新im_server 的 zk_path
                $server_info_query = $this->db->get_where($this->game_im_server_mod->_table, array('im_server_host_id'=> $data['im_server_host_id_support']));
                $im_server_info = $server_info_query->row_array();
                $im_server_host_server_info = array();
                if(!empty($im_server_info)){
                    isset($im_server_info['server_id']) && $im_server_host_server_info = $this->server_mod->get_one($im_server_info['server_id']);
                }
                list($im_zk_path,$im_server_config) = $this->writeZkPathAndReturn($im_server_set_type, $im_server_info, $im_server_host_server_info);

                $this->game_im_server_mod->db->query($this->game_im_server_mod->db->update_string(
                    $this->game_im_server_mod->_table,array('im_server_ini'=>$im_server_config),array('im_server_host_id'=>$data['im_server_host_id_support'])));
            }

            if($ins_res && $path){
                $link[0]['link_url'] = 'index.php?app=game&act=gameServerSetList';
                $link[0]['link_name'] = $this->MyLang['back_list'];
                $link[1]['link_url'] = 'index.php?app=game&act=createGameServerSet';
                $link[1]['link_name'] = '重新填写';
                showmsg($this->MyLang['save_success'], $link);
            }else{
                showmsg($this->MyLang['save_failed']);
            }
        }
    }

    /* 批量删除 */
    public function drop(){
        $id = isset($_GET['id']) ? trim($_GET['id']) : '';
        $aim = isset($_GET['aim']) ? trim($_GET['aim']) : '';
        if(!$id || !$aim || !in_array($aim,array('game_push','game_notice','game_event'))){
            showmsg($this->MyLang['param_error']);die;
        }
        $act = 'push';
        if($aim == 'game_notice'){
            $this->editRemoteNotice($id);
            $act = 'notice';
        }
        if($aim == 'game_event'){
            $act = 'event';
        }
        if($this->game_push_mod->dropItem($aim,$id)){
            $aim == 'game_event' && $this->editRemoteEvent($id);
            $link[0]['link_url'] = 'index.php?app=game&act='.$act;
            $link[0]['link_name'] = $this->MyLang['back_list'];
            showmsg($this->MyLang['handle_success'], $link);die;
        }else{
            showmsg($this->MyLang['handle_failed']);die;
        }
    }

    /**
     * @param $set_type
     * @param $data
     * @param $server_info
     * @return array
     */
    public function writeZkPathAndReturn($set_type, $data, $server_info,$server_num = '')
    {
        $path = '';
        $config = '';
        $server_name = isset($server_info['server_name']) ? $server_info['server_name'] : '';
        $set_content = file_get_contents(GAMESETDIR . DIRECTORY_SEPARATOR . $this->gameSetConfigFile[$set_type]);
        if (!empty($set_content)) {
            foreach ($data as $key => $val) {
                $set_content = str_replace('[replace_' . $key . ']', $val, $set_content);
            }
        }
        $config = !empty($set_content) ? $set_content : '';
        $this->load->model('zookeeper_handle_mod');
        if($server_name){
            $path = $this->zookeeper_handle_mod->setGameConf($server_name, $set_type, $set_content, $server_num);
        }
        return array($path,$config);
    }

}