<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 */
class Game_Load_Balancer_mod extends MY_Model {
    public function __construct(){
        parent::__construct();
        $this->_table = $this->db->dbprefix.'st_load_balance';
        $this->_id = 'id';
    }

    public function getLoadBalances($conditions,$limit=null,&$item_count){
        $res  = array();
        $sql = "SELECT * from {$this->_table} " . $conditions ;
        $item_count = count($this->getList($sql));
        $sql .= " limit {$limit}";
        $res['result'] = $this->getList($sql);
        return $res;
    }

    public function getEventList($conditions,$limit=null,&$item_count){
        $res  = array();
        if(empty($this->powerCodeBinary)){
            $res['result'] = array();
            return $res;
        }
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

    public function getItems($ids,$table = 'game_event'){
        $table = $this->db->dbprefix.$table;
        $sql = "select * from {$table} where id in ($ids)";
        return $this->getList($sql);
    }

    public function ajaxCheckHostId($load_balance_host_id,$id = ''){
        $condition = '';
        $sql = "select * from {$this->_table} WHERE 1";
        $load_balance_host_id && $condition .= " AND load_balance_host_id = {$load_balance_host_id} ";
        $id && $condition .= " AND id <> {$id}";

        $sql = $sql.$condition;
        return count($this->getList($sql)) == 0;
    }

    public function ajaxCheckServerSingle($server_id,$id = ''){
        $condition = '';
        $sql = "select * from {$this->_table} WHERE 1";
        $server_id && $condition .= " AND server_id = {$server_id} ";
        $id && $condition .= " AND id <> {$id}";
        $sql = $sql.$condition;
        return count($this->getList($sql)) == 0;
    }
}