<?php
/**
 * Date: 15-7-9
 * Time: 上午11:22
 */
class Zookeeper_Handle_mod extends MY_Model {
    public $zk;

    public function __construct(){
        parent::__construct();
        $this->basePath = '/data/apps/cpp-configs/';
        $this->load->helper('zookeeper_handle');
        $this->zk = new Zookeeper_Example('127.0.0.1:2181');
        $this->gameSetConfigFile = array(
            "game_server"=>array('config'=>"game_server.xml",'multi'=>'duplicate'),
            "battle"=>array('config'=>"battle.ini",'multi'=>'duplicate'),
            "battle_stronghold"=>array('config'=>"battle_stronghold.ini",'multi'=>'duplicate'),
            "load_balancer"=>array('config'=>"load_balancer.xml",'multi'=>'single'),
            "battle_balancer"=>array('config'=>"battle_balancer.ini",'multi'=>'single'),
            "im_server"=>array('config'=>"im_server.ini",'multi'=>'single'),
        );
    }

    public function setGameConf($server_name,$type,$content='',$host_num = ''){
        $flag = false;
        if(empty($type) || !array_key_exists($type,$this->gameSetConfigFile)) return $flag;
        $path = '/'. $server_name . $this->basePath . $this->gameSetConfigFile[$type]['config'];
        if($this->gameSetConfigFile[$type]['multi'] == 'duplicate' && !empty($host_num)){
            $path = '/'. $server_name . $this->basePath . $this->gameSetConfigFile[$type]['config'].'.d'.'/'.
                $host_num.'/'.$this->gameSetConfigFile[$type]['config'];
        }
        $flag = $this->zk->set($path,$content);
        if($flag){
            return $path;
        }
        return $flag;
    }

}

