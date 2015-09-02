<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_mod extends MY_Model {
	
	public function __construct(){
		parent::__construct();
		$this->_table = $this->db->dbprefix.'admin';
		$this->_id = 'id';
	}

    public function getAdmins($conditions,$limit=null,&$item_count){
        $sql = "select A.*,AR.role_name from {$this->_table} A LEFT JOIN ". $this->db->dbprefix ."admin_role AR on A.role_id = AR.id";
        $item_count = count($this->getList($sql));
        $sql .= " limit {$limit}";
        $res['result'] = $this->getList($sql);
        return $res;
    }

    public function verify($username){
		$this->db->select("COUNT(*) AS num");
		$this->db->where('username', $username);
		$row = $this->db->get($this->_table)->row_array();
		return $row['num'];
	}
	
	public function get_by_username($username){
		$this->db->where('username', $username);
		$this->db->limit(1);
		return $this->db->get($this->_table)->row_array();
	}
}