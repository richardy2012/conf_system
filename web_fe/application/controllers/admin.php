<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {
	public $_tpl_path = 'admin/admin/';
	public $time;
	public function __construct(){
		parent::__construct();
		$this->time = time();
		$this->load->model(array('admin_mod','admin_actions_mod','admin_role_mod','admin_role_action_mod','admin_platform_mod'));
		$this->load->library('form_validation');
		$this->load->helper('admin');
		is_login();//?登陆
	}

    public function index(){
        //admin List
        $data = array();
        $where = " 1=1 ";
        $item_count = 0;
        $page = $this->_get_page(15);
        $games = $this->admin_mod->getAdmins($where,$page['limit'],$item_count);
        $page['item_count'] = $item_count;
        $this->_format_page($page);
        $data['page_info'] = $page;
        $data['admin'] = $games['result'];
        $this->view('admin.list.php',$data);
    }

    public function addAdmin(){
        //add admin
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $roles = $this->admin_role_mod->get_all();

            $data['roles'] = $roles;
            $data['platforms'] = $this->admin_platform_mod->getPlatformNames();

            $this->view('admin.form.php',$data);
        }else{
            $data = $_POST;
            unset($data['re_password']);
            $data['dateline'] = time();
            $data['salt'] = 'CwrFTvWR';
            $data['password'] = md532($data['password'], $data['salt']);
            $data['platform_id'] = isset($_POST['platform_id']) ? join(',',$_POST['platform_id']) : '';
            if($this->admin_mod->insert($data)){
                $link[0]['link_url'] = 'index.php?app=admin';
                $link[0]['link_name'] = $this->MyLang['back_list'];
                showmsg($this->MyLang['save_success'], $link);
            }else{
                showmsg($this->MyLang['save_failed']);
            }
        }
    }

    public function editAdmin(){
        //edit admin
        if(!$id = intval($_GET['id'])){
            showmsg($this->MyLang['param_error']);die;
        }
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $data = $this->admin_mod->get_one($id);
            $roles = $this->admin_role_mod->get_all();
            $data['roles'] = $roles;
            $data['platforms'] = $this->admin_platform_mod->getPlatformNames();
            $this->view('admin.form.php',$data);
        }
        else{
            $data = $_POST;
            unset($data['re_password']);
            $data['dateline'] = time();
            $data['salt'] = 'CwrFTvWR';
            if(!empty($data['password'])){
                $data['password'] = md532($data['password'], $data['salt']);
            }else{
                unset($data['password']);
            }
            $data['platform_id'] = isset($_POST['platform_id']) ? join(',',$_POST['platform_id']) : '';
            if($this->admin_mod->update($id,$data)){
                $link[0]['link_url'] = 'index.php?app=admin';
                $link[0]['link_name'] = $this->MyLang['back_list'];
                showmsg($this->MyLang['save_success'], $link);
            }else{
                showmsg($this->MyLang['save_failed']);
            }
        }
    }

    public function permitAction(){
        // function list
        $actions = $this->admin_actions_mod->getActions();
        if(!$actions){
            $data['actions'] = false;
            $this->view('permitAction.list.php',$data);return;
        }
        $action_tree = array();
        foreach($actions as $key=>$val)
        {
            $action_tree[$val['id']] = $val;
        }
        $tree =& $this->_tree($action_tree);
        /* 先根排序 */
        $sort_action = array();
        $action_childs = $tree->getChilds();
        foreach ($action_childs as $id)
        {
            $sort_action[] = array_merge($action_tree[$id],array('layer' => $tree->getLayer($id),'parent_children_valid'=>'true'));
        }
        /* 构造映射表（每个结点的父结点对应的行，从1开始） */
        $row = array(0 => 0);   // cate_id对应的row
        $map = array();         // parent_id对应的row
        foreach ($sort_action as $key => $action)
        {
            $row[$action['id']] = $key + 1;
            $map[] = $row[$action['parent_id']];
        }
        $data['map'] = json_encode($map);
        $data['cates'] = $sort_action;
        $this->view('permitAction.list.php',$data);
    }

    public function addPermitAction(){
        //add function list
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $data['actions']  = $this->admin_actions_mod->getActionTree();
            $data[] = time();
            $this->view('permitAction.form.php',$data);
        }else{
            $data = $_POST;
            if($this->admin_actions_mod->insert($data)){
                $link[0]['link_url'] = 'index.php?app=admin&act=permitAction';
                $link[0]['link_name'] = $this->MyLang['back_list'];
                showmsg($this->MyLang['save_success'], $link);
            }else{
                showmsg($this->MyLang['save_failed']);
            }
        }
    }


    /**
     * @param $cate_id
     * @return string '2,3,4' [说明：2是自身，3 ，4 是2的child]
     */
    private function _getChildCates(&$cate_id){
        $allCates = $this->acategory_mod->getCategorys();
        $acategories = array();
        foreach($allCates as $key=>$val)
        {
            $acategories[$val['id']] = $val;
        }
        $tree =& $this->_tree($acategories);

        $childs = $tree->getChilds($cate_id);
        if($childs){
            $ids = ','. join(',',$childs);
            $cate_id .= $ids;
        }
        return $cate_id;
    }

    /* 构造并返回树 */
    function &_tree($acategories){
        $this->load->helper('tree');
        $tree = new NodeTree();
        $tree->setTree($acategories, 'id', 'parent_id', 'action_name');
        return $tree;
    }

    /* 取得可以作为上级的商品分类数据 */
    function _get_options($except = NULL){
        $acategories = $this->acategory_mod->get_all('*', array(), 0, 100);
        $tree =& $this->_tree($acategories);
        return $tree->getOptions(0, 0, $except);
    }

    public function Role(){
        //Role management list
        $data = array();
        $where = " where 1=1 ";
        $item_count = 0;
        $page = $this->_get_page(15);
        $games = $this->admin_role_mod->getRoleList($where,$page['limit'],$item_count);


        $page['item_count'] = $item_count;
        $this->_format_page($page);
        $data['page_info'] = $page;
        $data['admin'] = $games['result'];
        $this->view('role.list.php',$data);
    }

    public function addRole(){
        //add role
        if($_SERVER["REQUEST_METHOD"] == "GET"){
//            $data['platforms'] = $this->platform_mod->getPlatformNames();
            $actions = $this->admin_actions_mod->getActionOptions();
            $data['actions'] = $actions;
            $this->view('role.form.php',$data);
        }else{


            $data['role_name'] = $_POST['role_name'];
            $data['role_source'] = $_POST['role_source'];
//            $data['platform_id'] = join(',',$_POST['platform_id']);
            $data['desc'] = $_POST['desc'];
            $data['add_time'] = time();

            $data['approve_right'] = isset($_POST['approve_right']) && !empty($_POST['approve_right']) ? intval($_POST['approve_right']) : 0;

            $insert_res= $this->admin_role_mod->insert($data);
            $insert_id = $this->admin_role_mod->insert_id();
            if(count($_POST['action_detail']) > 0){
                foreach($_POST['action_detail'] as $key=>$val){
                    $actions['role_id'] = $insert_id;
                    $actions['action_id'] = $val;
                    $this->admin_role_action_mod->insert($actions);
                }
            }
            if($insert_res){
                $link[0]['link_url'] = 'index.php?app=admin&act=Role';
                $link[0]['link_name'] = $this->MyLang['back_list'];
                showmsg($this->MyLang['save_success'], $link);
            }else{
                showmsg($this->MyLang['save_failed']);
            }
        }
    }

    public function editRole(){
        //edit Role
        if(!$id = intval($_GET['id'])){
            showmsg($this->MyLang['param_error']);die;
        }
        if($_SERVER["REQUEST_METHOD"] == "GET"){

            $data = $this->admin_role_mod->getRoleActions($id);
//            $data['platforms'] = $this->platform_mod->getPlatformNames();
            $actions = $this->admin_actions_mod->getActionOptions();
            $data['actions'] = $actions;
            $this->view('role.form.php',$data);
        }
        else{


            $data['role_name'] = $_POST['role_name'];
            $data['role_source'] = $_POST['role_source'];
//            $data['platform_id'] = join(',',$_POST['platform_id']);
            $data['desc'] = $_POST['desc'];
            $data['add_time'] = time();

            $data['approve_right'] = isset($_POST['approve_right']) && !empty($_POST['approve_right']) ? intval($_POST['approve_right']) : 0;

            $update_res = $this->admin_role_mod->update($id,$data);
            if(count($_POST['action_detail']) > 0){
                $this->admin_role_action_mod->dropItem(null,$id);
                foreach($_POST['action_detail'] as $key=>$val){
                    $actions['role_id'] = $id;
                    $actions['action_id'] = $val;
                    $this->admin_role_action_mod->insert($actions);
                }
            }
            if($update_res){
                $link[0]['link_url'] = 'index.php?app=admin&act=Role';
                $link[0]['link_name'] = $this->MyLang['back_list'];
                showmsg($this->MyLang['save_success'], $link);
            }else{
                showmsg($this->MyLang['save_failed']);
            }
        }
    }


    public function drop(){
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $id = isset($_GET['id']) ? intval($_GET['id']) : '';
            if(!$id){
                showmsg($this->MyLang['param_error']);die;
            }
            if($id<2){
                showmsg($this->MyLang['adminCannotDelete']);die;
            }
            if($this->admin_mod->delete($id)){
                $link[0]['link_url'] = 'index.php?app=admin';
                $link[0]['link_name'] = $this->MyLang['back_list'];
                showmsg($this->MyLang['handle_success'], $link);die;
            }
        }
        showmsg($this->MyLang['param_error']);die;
    }

    public function dropRole(){
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $id = isset($_GET['id']) ? intval($_GET['id']) : '';
            if(!$id){
                showmsg($this->MyLang['param_error']);die;
            }
            if($id<2){
                showmsg($this->MyLang['adminCannotDelete']);die;
            }

            $delRes = $this->admin_role_mod->delete($id);

            $delARes = $this->admin_role_action_mod->dropItem(null,$id);

            $link[0]['link_url'] = 'index.php?app=admin&act=role';
            $link[0]['link_name'] = $this->MyLang['back_list'];
            showmsg($this->MyLang['handle_success'], $link);die;
        }
        showmsg($this->MyLang['param_error']);die;
    }


}


