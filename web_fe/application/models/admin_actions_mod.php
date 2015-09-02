<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_actions_mod extends MY_Model {

    public function __construct(){
        parent::__construct();
        $this->_table = $this->db->dbprefix.'admin_actions';
        $this->_id = 'id';
    }

    public function getActions(){
        $sql = "SELECT * from {$this->_table}";
        return $this->getList($sql);
    }

    public function getActionTree(){
        $sql = "SELECT id,parent_id,action_name from {$this->_table}";
        $cates = $res = $this->getList($sql);
        $this->load->helper('html_tree');
        $tree = new tree($cates);
        $tree->icon = array('&nbsp;&nbsp;│&nbsp;','&nbsp;&nbsp;├─&nbsp;','&nbsp;&nbsp;└─&nbsp;');//树形图标
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';//三个空格
        $options = '';
        $tree->init($cates);
        return $tree->get_tree(0, "<option value='\$id'>\$spacer\$action_name</option>\n");
    }

    public function dropItem($table,$id){
        $table = $this->db->dbprefix.$table;
        $sql = "DELETE FROM {$table} where id IN ($id)";
        return $this->db->query($sql);
    }

    public function getActionOptions(){
        $sql = "select * from {$this->_table} where `desc` = 'C'";
        $res  = $this->getList($sql);
        foreach($res as $key=>&$val){
            $resChildSql = "select * from {$this->_table} where parent_id = {$val['id']}";
            $val['childActions'] = $this->getList($resChildSql);
        }
        return $res;
    }










}