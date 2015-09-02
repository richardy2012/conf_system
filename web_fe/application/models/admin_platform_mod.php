<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * author logonmy@126.com
 * Date: 14-5-9
 * Time: 上午11:22
 */
class Admin_platform_mod extends MY_Model {

    public function __construct(){
        parent::__construct();
        $this->_table = $this->db->dbprefix.'st_game_platform';
        $this->_id = 'id';
    }

    public function getPlatforms($conditions,$limit=null,&$item_count){
        $this->currentUserHavePlatforms && $conditions .= " AND P.id IN ($this->currentUserHavePlatforms) ";
        $res = array();
        if(empty($this->currentUserHavePlatforms)){
            $res['result'] = array();
            return $res;
        }
        $server_table = $this->db->dbprefix.'st_server';
        $sql = "select P.*,count(DISTINCT  S.id) as num  from {$this->_table} P left join {$server_table} S on
        S.platform_id = P.id ". $conditions .
        "GROUP BY P.id";

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

    public function getPlatformDetailInIds($ids){
        $sql = "select * from {$this->_table} where id in ($ids) and status = 1";
        return $this->getList($sql);
    }

    public function getPlatformNames($ids = null){
        $sql = "select name,id,platform_id from {$this->_table}";

        if(empty($this->currentUserHavePlatforms)){
            return array();
        }
        if($this->currentUserHavePlatforms){
            $sql = "select platform_name,id,platform_id from {$this->_table} where id in ($this->currentUserHavePlatforms)";
        }
        if($ids){
            $sql = "select platform_name,id,platform_id from {$this->_table} where id in ($ids)";
        }
        $plats = $this->getList($sql);
        return $plats;
    }

    //结构一览
    public function getPlatformNamesAndStructure($ids = null){
        $sql = "select CONCAT(platform_name,'_@_',platform_id) as name,id from {$this->_table}";
        $plats = $this->getList($sql);
        return $plats;
    }





    public function getPowerIDByServerID($server_id){
        $sql = "SELECT P.power_id from {$this->db->dbprefix('st_game_platform')}  P LEFT JOIN {$this->db->dbprefix('st_server')} S
        on S.platform_id = P.id WHERE S.server_id = {$server_id}";
        return $this->getSingle($sql);
    }

    public function getPlatNameByPlatID($ids = array()){
        $_res = array();
        $res = '';
        if(empty($ids)) return $_res;
        $sql = "select name from {$this->_table} WHERE id in ({$ids})";
        $names = $this->getList($sql);
        if(!empty($names)){
            foreach($names as $key=>$val){
                $_res[] = $val['name'];
                $res .= $val['name'].'<br/>';
            }
        }
        return $res;
    }


}