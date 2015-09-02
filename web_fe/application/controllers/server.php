<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Server extends MY_Controller{
    //服务器管理

    public function __construct(){
        parent::__construct();
        $this->load->helper('admin');
        $this->load->model(array('server_mod'));
        is_login();//?登陆
    }

    public function index(){
        //server List
        $data = array();
        $where = " where 1 = 1 ";
        $platform_id = isset($_GET['platform_id']) && !empty($_GET['platform_id']) ? intval($_GET['platform_id']) : 0;
        $platform_id && $where .= " AND S.platform_id = '{$platform_id}'";

        $item_count = 0;
        $page = $this->_get_page(15);
        $games = $this->server_mod->getServers($where,$page['limit'],$item_count);
        $page['item_count'] = $item_count;
        $this->_format_page($page);
        $data['page_info'] = $page;
        $data['server'] = $games['result'];
        $this->load->model('admin_platform_mod');
        $data['platforms'] = $this->admin_platform_mod->getPlatformNames();
        $this->view('server.list.php',$data);
    }

    /* 批量删除 */
    public function drop(){
        $id = isset($_GET['id']) ? trim($_GET['id']) : '';
        $aim = isset($_GET['aim']) ? trim($_GET['aim']) : '';
        if(!$id || !$aim || !in_array($aim,array('server'))){
            showmsg($this->MyLang['param_error']);die;
        }
        if($this->server_mod->dropItem($aim,$id)){
            $link[0]['link_url'] = 'index.php?app=server';
            $link[0]['link_name'] = $this->MyLang['back_list'];
            showmsg($this->MyLang['handle_success'], $link);die;
        }else{
            showmsg($this->MyLang['handle_failed']);die;
        }
    }

    public function addServer(){
        //addServer
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $this->load->model('admin_platform_mod');
            $data['platforms'] = $this->admin_platform_mod->getPlatformNames();
            $this->view('server.form.php',$data);
        }else{
            $data = $_POST;
            $data['sort'] = isset($_POST['sort']) ? intval($_POST['sort']) : 255;
            if($this->server_mod->insert($data)){
                $link[0]['link_url'] = 'index.php?app=server';
                $link[0]['link_name'] = $this->MyLang['back_list'];
                showmsg($this->MyLang['save_success'], $link);
            }else{
                showmsg($this->MyLang['save_failed']);
            }
        }
    }

    public function editServer(){
        //edit server
        if(!$id = intval($_GET['id'])){
            showmsg($this->MyLang['param_error']);die;
        }
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $data = $this->server_mod->get_one($id);
            $this->load->model('admin_platform_mod');
            $data['platforms'] = $this->admin_platform_mod->getPlatformNames();
            $this->view('server.form.php',$data);
        }else{
            $data = $_POST;
            $data['sort'] = isset($_POST['sort']) ? intval($_POST['sort']) : 255 ;
            if($this->server_mod->update($id,$data)){
                $link[0]['link_url'] = 'index.php?app=server';
                $link[0]['link_name'] = $this->MyLang['back_list'];
                showmsg($this->MyLang['save_success'], $link);
            }else{
                showmsg($this->MyLang['save_failed']);
            }
        }
    }

    public function structure(){
        //结构一览
        $this->load->model('admin_platform_mod');
        $plats = $this->admin_platform_mod->getPlatformNamesAndStructure();
        $data['result']= array();
        if(($plats && count($plats) > 0)){
            //重组结果
            foreach($plats as $key=>&$val){
                $val['children'] = $this->server_mod->getServerListAndChildren($val['id']);
            }

            $data['result'] = $plats;
        }

        $this->view('server.platform.structure.php',$data);
    }


    /* 构造并返回树 */
    function & _tree($datas){
        $this->load->helper('tree');
        $tree = new NodeTree();
        $tree->setTree($datas, 'id', 'parent_id', 'cate_name');
        return $tree;
    }

    public function platform(){
        //Platform List
        $data = array();
        $where = " where 1=1 ";
        $item_count = 0;
        $page = $this->_get_page(15);
        $this->load->model('admin_platform_mod');
        $platforms = $this->admin_platform_mod->getPlatforms($where,$page['limit'],$item_count);
        $page['item_count'] = $item_count;
        $this->_format_page($page);
        $data['page_info'] = $page;
        $data['platform'] = $platforms['result'];
        $this->view('admin.platform.list.php',$data);
    }

    public function addPlatform(){
        //add Platform
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $this->view('admin.platform.form.php');
        }else{
            $data = array();
            $data['platform_id'] = intval($_POST['platform_id']);
            $data['platform_name'] = trim($_POST['platform_name']);
            $data['official_site'] = trim($_POST['official_site']);
            $data['desc'] = $_POST['desc'];
            $data['status'] = intval($_POST['status']);
            $data['sort'] = intval($_POST['sort']) ? intval($_POST['sort']) : 255;
//            print_a($data);exit;
            $this->load->model('admin_platform_mod');
            $insert_res = $this->admin_platform_mod->insert($data);
            if(empty($insert_res)){
                showmsg($this->MyLang['save_failed']);
            }
            $last_id = $this->admin_platform_mod->insert_id();
            $total_p = $this->admin_platform_mod->get_all();
            $total_p_num = count($total_p);
            $data = array();
            $data['power_id'] = pow(2,$total_p_num);
            $update_res = $this->admin_platform_mod->update($last_id,$data);
//            exit;
            if(!empty($insert_res) && !empty($update_res)){
                $link[0]['link_url'] = 'index.php?app=server&act=platform';
                $link[0]['link_name'] = $this->MyLang['back_list'];
                showmsg($this->MyLang['save_success'], $link);
            }else{
                showmsg($this->MyLang['save_failed']);
            }
        }
    }

    public function editPlatform(){
        //edit Platform
        $this->load->model('admin_platform_mod');
        if(!$id = intval($_GET['id'])){
            showmsg($this->MyLang['param_error']);die;
        }
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $data = $this->admin_platform_mod->get_one($id);
            $this->view('admin.platform.form.php',$data);
        }
        else{
            $_POST['sort'] = intval($_POST['sort']) ? intval($_POST['sort']) : 255;
            $data = $_POST;
            if($this->admin_platform_mod->update($id,$data)){
                $link[0]['link_url'] = 'index.php?app=server&act=platform';
                $link[0]['link_name'] = $this->MyLang['back_list'];
                showmsg($this->MyLang['save_success'], $link);
            }else{
                showmsg($this->MyLang['save_failed']);
            }
        }
    }

    public function getServersByPlatformId()
    {
        if(!$id = intval($_GET['id'])){
            $this->_error($data['msg']=$this->MyLang['param_error']);die;
        }
        $this->load->model('server_mod');
        $res = $this->server_mod->getServersInPlatformIdForSession($id);
        $data['msg'] = json_encode($res);
        $this->_error($data,0);
    }

}