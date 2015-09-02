<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 */
class Admin_role_action_mod extends MY_Model {
    public function __construct(){
        parent::__construct();
        $this->_table = $this->db->dbprefix.'admin_role_action';
        $this->_id = 'id';
    }

    public function getEventList($conditions,$limit=null,&$item_count){
        $sql = "SELECT * from {$this->_table} " . $conditions . " order by id DESC ";
        $item_count = count($this->getList($sql));
        $sql .= " limit {$limit}";
        $res['result'] = $this->getList($sql);
        return $res;
    }

    public function dropItem($table=null,$id){
        if($table){
            $table = $this->db->dbprefix.$table;
        }else{
            $table = $this->_table;
        }
        $sql = "DELETE FROM {$table} where role_id IN ($id)";
        return $this->db->query($sql);
    }


    public function getUserCanActions($role_id = 0,$class = null,$function = null){
        $sql = "select * from {$this->_table} ARA LEFT JOIN " .$this->db->dbprefix. "admin_actions AC on ARA.action_id = AC.id
        where role_id = {$role_id} AND controller = '{$class}' AND action = '{$function}'";

        $userCanActions = $this->getRow($sql);

        if(empty($userCanActions)){
            return false;
        }
        return true;
    }

    public function getItems($ids,$table = 'admin_role_action'){
        $table = $this->db->dbprefix.$table;
        $sql = "select * from {$table} where id in ($ids)";
        return $this->getList($sql);
    }

}