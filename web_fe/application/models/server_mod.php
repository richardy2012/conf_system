<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Date: 14-5-9
 * Time: 上午11:22
 */
class Server_mod extends MY_Model {
    public function __construct(){
        parent::__construct();
        $this->_table = $this->db->dbprefix.'st_server';
        $this->_id = 'id';
    }

    private function getPlatIDByPlatName($name){
        if(empty($name))return;
        $sql = "select id from {$this->db->dbprefix('platform')} WHERE `name` = '{$name}'";
        return $this->getSingle($sql);
    }


    private function getPlatIDByRound(){
        $sql = "select id from {$this->db->dbprefix('platform')} ORDER BY id limit 1";
        return $this->getSingle($sql);
    }

    private function checkDate($str,$format = 'Y-m-d H:i:s'){
        $unix = strtotime($str);
        $date = date($format,$unix);
        if ($str == $date){
            return true;
        }else{
            return false;
        }
    }

    public function getServers($conditions,$limit=null,&$item_count){
        $platform_table = $this->db->dbprefix.'st_game_platform';
        $this->currentUserHavePlatforms && $conditions .= " AND P.id IN ($this->currentUserHavePlatforms) ";
        if(empty($this->currentUserHavePlatforms)){
            $res = array();
            $res['result'] = array();
            return $res;
        }
        $sql = "SELECT S.*,P.platform_name from {$this->_table} S left join {$platform_table} P on S.platform_id = P.id "
            .$conditions;
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

    public function _getServersList($ids = null){
        $currentUserRole = $this->session->userdata('currentUserRole');
        $currentUserHaveServers_str = $this->currentUserHaveServers_str ;
        $sql = "select  id,server_id,platform_id,server_name,status,out_ip from {$this->_table}
        WHERE status = 1";
        if($currentUserHaveServers_str){
            $sql = "select  id,server_id,platform_id,server_name,status,out_ip from {$this->_table}
            where server_id in ($currentUserHaveServers_str) AND status = 1";
        }
        if(!empty($ids)){
            $sql = "select  id,server_id,platform_id,server_name,status,out_ip from {$this->_table}
            where server_id in ($ids) AND status= 1";
        }
        $servers = $this->getList($sql);
        return $servers;
    }

    public function getServerListAndChildren($p_id = ''){
        $where = " where 1 ";
        $p_id && $where .= " AND p.id = {$p_id} ";
        $sql = "select CONCAT(s.server_name,'_@_',s.out_ip) as  name,s.id from {$this->_table} s
LEFT JOIN {$this->db->dbprefix('st_game_platform')} p on s.platform_id =p.id " .$where;
        $servers = $this->getList($sql);
        if(!empty($servers)){
            foreach ($servers as $key=>&$val){
                if($val['id']){
                    $battle_balances_sql = "select CONCAT('battle_balance@',bb.battle_balance_host_id) as name from {$this->db->dbprefix('st_battle_balance')} bb LEFT join {$this->db->dbprefix('st_server')} s on bb.server_id = s.id WHERE s.id = {$val['id']}";
                    $battle_balances = $this->getList($battle_balances_sql);

//                    print_a($battle_balances);

                    $battle_sql = "select CONCAT('battle@',bs.battle_server_host_id) as name from {$this->db->dbprefix('st_battle_server')} bs LEFT join {$this->db->dbprefix('st_server')} s on bs.server_id = s.id WHERE s.id = {$val['id']}";
                    $battles = $this->getList($battle_sql);
//                    print_a($battles);

                    $battle_stronghold_sql = "select CONCAT('battle_stronghold@',bs.battle_stronghold_host_id) as name from {$this->db->dbprefix('st_battle_stronghold')} bs LEFT join {$this->db->dbprefix('st_server')} s on bs.server_id = s.id WHERE s.id = {$val['id']}";
                    $battle_strongholds = $this->getList($battle_stronghold_sql);
//                    print_a($battle_strongholds);

                    $load_balance_sql = "select CONCAT('load_balance@',lb.load_balance_host_id ) as name from {$this->db->dbprefix('st_load_balance')} lb LEFT join {$this->db->dbprefix('st_server')} s on lb.server_id = s.id WHERE s.id = {$val['id']}";
                    $load_balances = $this->getList($load_balance_sql);
//                    print_a($load_balances);

                    $im_server_sql = "select CONCAT('im_server@',im.im_server_host_id ) as name from {$this->db->dbprefix('st_im_server')} im LEFT join {$this->db->dbprefix('st_server')} s on im.server_id = s.id WHERE s.id = {$val['id']}";
                    $im_server = $this->getList($im_server_sql);
//                    print_a($im_server);

                    $game_server_sql = "select CONCAT('game_server@',gs.game_server_host_id) as name from {$this->db->dbprefix('st_game_server')} gs LEFT join {$this->db->dbprefix('st_server')} s on gs.server_id = s.id WHERE s.id = {$val['id']}";
                    $game_server = $this->getList($game_server_sql);
//                    print_a($game_server);
                    $val['children'] =array_merge($battle_balances,$battles,$load_balances,$im_server,$game_server,$battle_strongholds);
                }
            }
        }

        return $servers;
    }




    public function getServersList($ids = null){
        $currentUserRole = $this->session->userdata('currentUserRole');
        $currentUserHaveServers_str = $this->currentUserHaveServers_str ;
        $sql = "select  id,server_id,platform_id,server_name,status from {$this->_table}
        WHERE status = 1";
        if($currentUserHaveServers_str){
            $sql = "select  id,server_id,platform_id,server_name,status from {$this->_table}
            where server_id in ($currentUserHaveServers_str) AND status = 1";
        }
        if(!empty($ids)){
            $sql = "select  id,server_id,platform_id,server_name,status from {$this->_table}
            where server_id in ($ids) AND status= 1";
        }
        $servers = $this->getList($sql);
        return $servers;
    }

    public function getServerNameByServerID($ids = array()){
        $_res = array();
        $res = '';
        if(empty($ids)) return $_res;
        $sql = "select server_name from {$this->_table} WHERE id in ({$ids})";
        $names = $this->getList($sql);
        if(!empty($names)){
            foreach($names as $key=>$val){
                $_res[] = $val['server_name'];
                $res .= $val['server_name'].'<br/>';
            }
        }
        return $res;
    }


    public function getServersByPlatformId($id){
        $sql = "select * from {$this->_table} where platform_id = {$id} and ";
        return $this->getList($sql);
    }

    public function getServersInPlatformId($ids){
        $sql = "select * from {$this->_table} where platform_id in ($ids) ";
        return $this->getList($sql);
    }

    public function getServersInPlatformIdForSession($ids){
        $sql = "select id,server_id,server_name,platform_id from {$this->_table} where platform_id in ($ids) and status = 1";
        return $this->getList($sql);
    }

    public function getServersIDInPlatformId($ids){
        $sql = "select server_id from {$this->_table} where platform_id in ($ids) order by server_id DESC";
        return $this->getList($sql);
    }

    public function getServerAndPlatform($id = null){
        $platform_table = $this->db->dbprefix.'st_game_platform';
        $sql = "SELECT S.server_id,S.id as s_id,S.server_name,P.platform_name,P.platform_id ,P.id as p_id from
        {$this->_table} S left join {$platform_table} P on S.platform_id = P.id ";
        return $this->getList($sql);
    }

    public function getGameOperatorByServerID($id = null){
        if(empty($id)) return '';
        $platform_table = $this->db->dbprefix.'st_game_platform';
        $sql = "SELECT P.game_operator from {$this->_table} S left join {$platform_table} P
              on S.platform_id = P.id WHERE S.server_id = '{$id}'";
        return $this->getSingle($sql);
    }

    public function getPushServer($ids){
        $sql = "select * from {$this->_table} where id in ($ids)";
        return $this->getList($sql);
    }

    public function getNameByServerID($id){
        $sql = "select server_name from {$this->_table} where server_id = {$id}";
        return $this->getSingle($sql);
    }

    public function alterRechargeInit($server_id){
        $sql = "update {$this->_table} set recharge_init = 1 where server_id = {$server_id}";
        $this->db->query($sql);
    }

    public function getServerIDAssocName(){
        $all = $this->get_all();
        $res = array();
        foreach($all as $key=>$val){
            $res[$val['server_id']] = $val['server_name'];
        }
        return $res;
    }

    public function getServerApiByServerId($server_id){
        $sql = "select api from {$this->_table} where server_id = {$server_id}";
        return $this->getSingle($sql);
    }

    public function getServerInfoListForRemote(){
        $sql = "select server_id,server_name,server_type,start_time,end_time,`desc` from {$this->_table}";
        $res = $this->getList($sql);
        $data = array();
        for($i = 0;$i<count($res);$i++){
            $data[$i]['server_id'] = $res[$i]['server_id'];
            $data[$i]['data']['server_name'] = $res[$i]['server_name'];
            $data[$i]['data']['server_type'] = $res[$i]['server_type'];
            $data[$i]['data']['start_time'] = $res[$i]['start_time'];
            $data[$i]['data']['end_time'] = $res[$i]['end_time'];
            $data[$i]['data']['desc'] = $res[$i]['desc'];
        }
        return $data;
    }


    public function getPltIDBySerID($sIDs){
        $sql = "select platform_id from {$this->_table} WHERE id = {$sIDs}";
        return $this->getSingle($sql);
    }

}