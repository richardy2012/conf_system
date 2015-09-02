<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 */
class Game_Im_Server_mod extends MY_Model {
    public function __construct(){
        parent::__construct();
        $this->_table = $this->db->dbprefix.'st_im_server';
        $this->_id = 'id';
    }

    public function getImServers($conditions,$limit=null,&$item_count){
        $res  = array();
        $sql = "SELECT * from {$this->_table} " . $conditions ;
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

    public function ajaxCheckHostId($im_server_host_id,$id = ''){
        $condition = '';
        $sql = "select * from {$this->_table} WHERE 1";
        $im_server_host_id && $condition .= " AND im_server_host_id = {$im_server_host_id} ";
        $id && $condition .= " AND id <> {$id}";
        $sql = $sql.$condition;
        return count($this->getList($sql)) == 0;
    }

    public function ajaxCheckImServerSingle($server_id,$id = ''){
        $condition = '';
        $sql = "select * from {$this->_table} WHERE 1";
        $server_id && $condition .= " AND server_id = {$server_id} ";
        $id && $condition .= " AND id <> {$id}";
        $sql = $sql.$condition;
        return count($this->getList($sql)) == 0;
    }

    public function updateGameServerHostIds($im_server_host_id,$game_server_host_ids){
        return $this->db->query($this->db->update_string($this->_table,array('game_server_host_ids'=>$game_server_host_ids),
            array('im_server_host_id'=>$im_server_host_id)));
    }

}