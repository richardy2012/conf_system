<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {
	public $_table;
	public $_id;

    public $currentUserHavePlatforms;
    public $currentUserHaveServers_str;
    public $currentUserHaveSIDS;
    public $powerCodeBinary;

	function __construct(){
		parent::__construct();
		$this->load->database();
        $this->__currentUserHaveServers();//获取当前用户可控制的服务器ID
    }

    private function __currentUserHaveServers(){
        $currentUserRole = $this->session->userdata('currentUserRole');
        $this->currentUserHavePlatforms = isset($currentUserRole['role_info']['platform_id']) ? $currentUserRole['role_info']['platform_id'] : '';
        $server = $this->getPlatformsUnderServer($this->currentUserHavePlatforms);
//        $this->currentUserHaveServers_str = isset($currentUserRole['role_info']['server_ids']) ? $currentUserRole['role_info']['server_ids'] : '';
//        $this->currentUserHaveSIDS = isset($currentUserRole['role_info']['sIDs']) ? $currentUserRole['role_info']['sIDs'] : '';
        $this->currentUserHaveServers_str = !empty($server) ? implode(',',array_values($server)) : '';
        $this->currentUserHaveSIDS = !empty($server) ? implode(',',array_keys($server)) : '';
        $this->powerCodeBinary= isset($currentUserRole['role_info']['power_code_binary']) ? $currentUserRole['role_info']['power_code_binary'] : 0;
    }

    public function getPlatformsUnderServer($platform_ids){
        $server_arr = array();
        if(empty($platform_ids)) return $server_arr;
        $this->db->dbprefix('st_server');
        $sql = "select * from {$this->db->dbprefix('st_server')} where platform_id in ($platform_ids)";
        $servers = $this->getList($sql);

        if (!empty($servers)) {
            foreach ($servers as $key => $val) {
                $server_arr[$val['id']] = $val['server_id'];
            }
        }
        return $server_arr;
    }

    /**
	 *Mon Mar 25 02:52:25 GMT 2013 
	 *author lijie
	 */
	public function insert($data){
		return $this->db->insert($this->_table,$data);
	}
	
	/**
	 * 获取插入Id
	 * author zhangwei
	 */
	public function insert_id(){
		return $this->db->insert_id();
	}
	
	/**
	*@author lijie
	* get_Single_table_All 
	**/
	public function get_all($select = "*",$where = array(),$start = 0, $length=1000,$orderby = ''){
		if(is_array($select)&&!empty($select)){
			$select =  implode(',',$select);
		}
		$this->db->select($select);
		if(!empty($orderby)){
			list($field, $desc) = explode(' ', $orderby);
			$this->db->order_by($field, $desc);
		}
		$query = $this->db->get_where($this->_table,$where,(int)$length,(int)$start);
		return $query->result_array();
	}
	
	
	public function delete($id){
		$this->db->where($this->_id, $id);
		$this->db->limit(1);
		return $this->db->delete($this->_table);
	}
	
   public function get_one($id){
		$query = $this->db->get_where($this->_table, array($this->_id => $id));
		return $query->row_array();
	}
	
	public function update($id,$data){
		$this->db->where($this->_id, $id);
		$this->db->limit(1);
		return $this->db->update($this->_table, $data); 
	}
	
	
	public function tbl_count($where=''){
		if($where){
			$this->db->where($where);
		}
		//$this->db->where($where);
		//$this->db->count_all($this->_table);
		return $this->db->count_all_results($this->_table);
		//echo $this->db->last_query();
	}
	
	public function get_fields($select='*',$where=array()){
		if(is_array($select)&&!empty($select)){
			$select =  implode(',',$select);
		}
		 $this->db->select($select);
		$query = $this->db->get_where($this->_table,$where);
		return $query->row_array();
	}


    public  final function getSingle( $sql ) {
        $result = $this->db->query( $sql );
        foreach ($result->row_array() as $value) {
            return $value;
        }
    }

    public  final function getList( $sql ) {
        return $this->db->query($sql)->result_array();
    }

    public  final function getRow( $sql ) {
        return $this->db->query($sql)->row_array();
    }

    public function timeRange(){
        return array(
            '0'=>"15分钟以下",
            '15'=>"15-30分钟",
            '30'=>"30分钟-1小时",
            '60'=>"1小时-3小时",
            '180'=>"3小时-8小时",
            '480'=>"8小时以上",
        );
    }


    public function returnRangeMinute($minute,$minute_range){
        if(empty($minute) || empty($minute_range)){
            return 0;
        }
        $temp_type = 0;
        foreach($minute_range as $val){
            if($minute >= $val){
                $temp_type = $val;
            }
            continue;
        }
        return $temp_type;
    }


    public function minuteRangeStep(){
//        $step = 15;//步长
//        $arr = array();
//        for($i = 0;$i<=23;$i++)
//        {
//            for($j=0;$j<60;$j=$j+$step){
//                $j=$j<10?"0".$j:$j;
//                $k = $i.".".$j;
//                if ($j==0) {
//                    $k = $i;
//                }
//                $arr[$k] = $i.":".$j;
//            }
//        }

        return array(
            '0'=>'00:00',
            '0.15'=>'00:15',
            '0.30'=>'00:30',
            '0.45'=>'00:45',

            '1'=>'1:00',
            '1.15'=>'1:15',
            '1.30'=>'1:30',
            '1.45'=>'1:45',

            '2'=>'2:00',
            '2.15'=>'2:15',
            '2.30'=>'2:30',
            '2.45'=>'2:45',

            '3'=>'3:00',
            '3.15'=>'3:15',
            '3.30'=>'3:30',
            '3.45'=>'3:45',

            '4'=>'4:00',
            '4.15'=>'4:15',
            '4.30'=>'4:30',
            '4.45'=>'4:45',

            '5'=>'5:00',
            '5.15'=>'5:15',
            '5.30'=>'5:30',
            '5.45'=>'5:45',

            '6'=>'6:00',
            '6.15'=>'6:15',
            '6.30'=>'6:30',
            '6.45'=>'6:45',

            '7'=>'7:00',
            '7.15'=>'7:15',
            '7.30'=>'7:30',
            '7.45'=>'7:45',

            '8'=>'8:00',
            '8.15'=>'8:15',
            '8.30'=>'8:30',
            '8.45'=>'8:45',

            '9'=>'9:00',
            '9.15'=>'9:15',
            '9.30'=>'9:30',
            '9.45'=>'9:45',

            '10'=>'10:00',
            '10.15'=>'10:15',
            '10.30'=>'10:30',
            '10.45'=>'10:45',

            '11'=>'11:00',
            '11.15'=>'11:15',
            '11.30'=>'11:30',
            '11.45'=>'11:45',

            '12'=>'12:00',
            '12.15'=>'12:15',
            '12.30'=>'12:30',
            '12.45'=>'12:45',

            '13'=>'13:00',
            '13.15'=>'13:15',
            '13.30'=>'13:30',
            '13.45'=>'13:45',

            '14'=>'14:00',
            '14.15'=>'14:15',
            '14.30'=>'14:30',
            '14.45'=>'14:45',

            '15'=>'15:00',
            '15.15'=>'15:15',
            '15.30'=>'15:30',
            '15.45'=>'15:45',

            '16'=>'16:00',
            '16.15'=>'16:15',
            '16.30'=>'16:30',
            '16.45'=>'16:45',

            '17'=>'17:00',
            '17.15'=>'17:15',
            '17.30'=>'17:30',
            '17.45'=>'17:45',

            '18'=>'18:00',
            '18.15'=>'18:15',
            '18.30'=>'18:30',
            '18.45'=>'18:45',

            '19'=>'19:00',
            '19.15'=>'19:15',
            '19.30'=>'19:30',
            '19.45'=>'19:45',

            '20'=>'20:00',
            '20.15'=>'20:15',
            '20.30'=>'20:30',
            '20.45'=>'20:45',

            '21'=>'21:00',
            '21.15'=>'21:15',
            '21.30'=>'21:30',
            '21.45'=>'21:45',

            '22'=>'22:00',
            '22.15'=>'22:15',
            '22.30'=>'22:30',
            '22.45'=>'22:45',

            '23'=>'23:00',
            '23.15'=>'23:15',
            '23.30'=>'23:30',
            '23.45'=>'23:45',
//            '24'=>'24:00',
        );
    }

    public function getActionClassTitle(){
        return $action_class_arr = array(
                'mall_expend'=>'商城消耗',
                'speedup_expend'=> '加速消耗',
                'openBox_expend'=> '开格加速',
                'vintage_expend'=> '酿酒加速',
                'addCount_expend'=>"购买次数消耗",
                'talk_expend'=>'清谈消耗',
                'deduct_expend'=>'拍卖消耗',
                'lottery_expend'=>'抽奖消耗',
                'inheritance_expend'=>'传承消耗',
            );
    }

    public function returnChangeNum($itemID,$num){
        $num = intval($num);
        $itemID = intval($itemID);
        if(empty($num)){
            return 0;
        }
        switch($itemID){
            case 13:
            case 1703:
                return $num * 5;
                break;
            case 37:
                return $num * 10;
                break;
            case 142:
            case 1702:
                return $num * 20;
                break;
            case 1701:
                return $num * 50;
                break;
            default:
                return $num;
                break;
        }
    }
}




/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */