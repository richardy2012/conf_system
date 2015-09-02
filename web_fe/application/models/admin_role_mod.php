<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 */
class Admin_role_mod extends MY_Model {
    public function __construct(){
        parent::__construct();
        $this->_table = $this->db->dbprefix.'admin_role';
        $this->_id = 'id';
    }

    public function getRoleList($conditions,$limit=null,&$item_count){
        $sql = "SELECT * from {$this->_table} " . $conditions . " order by id DESC ";
        $item_count = count($this->getList($sql));
        $sql .= " limit {$limit}";
        $res['result'] = $this->getList($sql);
        return $res;
    }

    public function dropItem($table,$id){
        $table = $this->db->dbprefix.$table;
        $sql = "DELETE FROM {$table} where id IN ($id)";
        return $this->db->query($sql);
    }

    public function getItems($ids,$table = 'admin_role'){
        $table = $this->db->dbprefix.$table;
        $sql = "select * from {$table} where id in ($ids)";
        return $this->getList($sql);
    }

    public function getRoleActions($id){
        $role = $this->get_one($id);
        if(count($role) > 0){
            $roleActionSql = "select * from {$this->db->dbprefix('admin_role_action')} where role_id = '{$role['id']}'";
            $role['action_detail'] = $this->getList($roleActionSql);
        }
        return $role;
    }

    public function getApproveRight($user_id){
        $approve = 0;
        if(empty($user_id)) return $approve;

        $sql = "select AR.approve_right from {$this->db->dbprefix('admin')} A
         LEFT JOIN {$this->db->dbprefix('admin_role')} AR
         ON A.role_id = AR.id
         WHERE A.id = {$user_id}";
        return $this->getSingle($sql);
    }


}