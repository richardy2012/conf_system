<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Welcome extends MY_Controller {
    public $time;
    public $currentServerInfo;
    public function __construct(){
        parent::__construct();
        $this->time = time();
        $this->load->helper(array('admin','cookie'));//后台专用函数
        $this->load->library('form_validation');
        $this->load->model(array('admin_mod'));
        $this->currentServerInfo = $this->__setServerConnectId();//设置一个服务器接口连接        
    }

    public function __setServerConnectId(){
        $currentServerInfo = $this->session->userdata('currentConnectInfo');// 当前所在平台与服务器连接会话信息
            //没有连接信息需要随机给定一个
        $currentUserRole = $this->session->userdata('currentUserRole');
        if(empty($currentServerInfo) && !empty($currentUserRole)){
            $servers  = array();
            $role_info = $currentUserRole['role_info'];
            isset($role_info['platform_id']) && !empty($role_info['platform_id']) && $servers = $this->server_mod->getServersInPlatformIdForSession($role_info['platform_id']);
            if(!empty($servers)){
                $this->session->unset_userdata('currentConnectInfo');
                $this->session->set_userdata('currentConnectInfo',($servers[0]));
            }
        }
        return $currentServerInfo;
    }

    public function __setCurrentUserRole($data = array()){
        $currentUserRole = $this->session->userdata('currentUserRole');
        if(!empty($data)){
            $this->session->unset_userdata('currentUserRole');
            $sesData['user_id'] = $data['id'];
            $sesData['user_name'] = $data['username'];
            $sesData['role_id'] = isset($data['role_id']) ? $data['role_id'] : 0;
            $sesData['platform_id'] = isset($data['platform_id']) ? $data['platform_id'] : 0;
            $this->load->model(array('admin_role_mod','admin_platform_mod'));
            $role_info = $this->returnRoleInfoByRoleID($data['role_id'],$data['platform_id']);
            $sesData['role_info'] = $role_info;
            $this->session->unset_userdata('currentUserRole');
            $this->session->set_userdata('currentUserRole',$sesData);
            return $sesData;
        }
        return $currentUserRole;
    }

    /**
     * @param $role_id
     * @param $platform_ids
     * @return mixed
     */
    public function returnRoleInfoByRoleID($role_id,$platform_ids)
    {
        $role_info = array();
        $this->load->model(array('admin_role_mod', 'admin_platform_mod'));
        $role_info = $this->admin_role_mod->get_one($role_id);
        $power_plus_num = 0;
        if (!empty($platform_ids)) {
            $platforms = $this->admin_platform_mod->getPlatformDetailInIds($platform_ids);
            if (!empty($platforms)) {
                foreach ($platforms as $key => $val) {
                    $power_plus_num += $val['power_id'];
                }
            }
        }
        $currentUserPowerCode = decbin($power_plus_num);
        $role_info['power_code'] = $power_plus_num;
        $role_info['power_code_binary'] = $currentUserPowerCode;
        $role_info['platform_id'] = $platform_ids;
        return $role_info;
    }

    /**
     * @desc 刷新权限
     */
    public function RefreshPurview(){
        $currentUserRole = $this->session->userdata('currentUserRole');
        $role_id = isset($currentUserRole['role_id']) ? $currentUserRole['role_id'] : 0;
        $platform_ids = isset($currentUserRole['platform_id']) ? $currentUserRole['platform_id'] : 0;
        $roleInfo['role_info'] = $this->returnRoleInfoByRoleID($role_id,$platform_ids);
        $roleInfo['user_id'] = $currentUserRole['user_id'];
        $roleInfo['user_name'] = $currentUserRole['user_name'];
        $roleInfo['role_id'] = $currentUserRole['role_id'];
        $this->session->unset_userdata('currentUserRole');
        $this->session->set_userdata('currentUserRole',$roleInfo);
        $data['msg'] = json_encode($roleInfo);
        $this->_error($data,0);
    }

    //记录最后一次浏览的控制器
    public function refreshLink(){
        if(!(isset($_GET['refreshLink']) && !empty($_GET['refreshLink']))){
            $data = array();
            $data['msg'] = '参数错误';
            $this->_error($data);
        }
        $this->session->unset_userdata('refreshLink');
        delete_cookie('refreshLink');
        $refreshLink = array('link'=>$_GET['refreshLink'],'position'=>$_GET['position']);
        $this->session->set_userdata('refreshLink',$refreshLink);
        $data['msg'] = json_encode($refreshLink);
        $this->_error($data,0);
    }


    public function getServersByPlatformId()
    {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if(!$id){
            $data = array();
            $data['msg'] = '参数错误';
            $this->_error($data);
        }
        $this->load->model('server_mod');
        $res = $this->server_mod->getServersInPlatformIdForSession($id);

        $currentServerInfo = $this->session->userdata('currentConnectInfo');// 当前所在平台与服务器连接会话信息
        if(empty($currentServerInfo)){
            $this->session->unset_userdata('currentConnectInfo');
            $this->session->set_userdata('currentConnectInfo',$res[0]);
        }
        $data['msg'] = json_encode($res);
        $this->_error($data,0);
    }

    //根据服务器ID进行webservice的更换和刷新
    public function changeConnectWebServiceById(){
        if(!$id = intval($_GET['id'])){
            $this->_error($data['msg']='参数错误');die;
        }
        $this->load->model('server_mod');
        $res = $this->server_mod->get_one($id);
        $this->session->unset_userdata('currentConnectInfo');
        $this->session->set_userdata('currentConnectInfo',$res);
        $data['msg'] = json_encode($res);
        $this->_error($data,0);
    }


    public function changeConnectWebServiceByPlatformId(){
        if(!$id = intval($_GET['id'])){
            $this->_error($data['msg']='参数错误');die;
        }
        $this->load->model('server_mod');
        $servers = $this->server_mod->getServersInPlatformIdForSession($id);
        if(empty($servers)){
            $data['msg'] = '平台未设定服务器';
            $this->_error($data);die;
        }
        $this->session->unset_userdata('currentConnectInfo');
        $this->session->set_userdata('currentConnectInfo',$servers[0]);
        $data['msg']=json_encode($servers);
        $this->_error($data,0);
    }



    public function index(){
        is_login();//?登陆
        $this->view('admin/common/index');
    }

    public function header(){
        is_login();//登陆
        $data['userInfo'] = $this->session->all_userdata();
//        print_a($data);
        $this->view('admin/common/admin_top',$data);
    }

    public function left(){
        is_login();//登陆
        $this->view('admin/common/left');
    }

    public function right(){
        is_login();//登陆
        $this->load->view('admin/common/right');
    }

    public function login(){
        if(isset($_POST['submit'])){
            $username = trim(addslashes($this->input->post('username')));
            $password = $this->input->post('password');
            if(empty($username)){
                showmsg('请输入用户名');
            }

            if(empty($password)){
                showmsg('请输入密码');
            }
            //以用户名查信息
            $data = $this->admin_mod->get_by_username($username);

            if(empty($data)){
                showmsg('用户输入有误');
            }

            if(md532($password, $data['salt']) != $data['password']){
                showmsg('密码不正确');
            }

            //登陆成功
            $session = array(
                'user_id'	=> $data['id'],
                'user_name'	=> $data['username'],
                'login_time'=> $this->time,
                'login_ip'	=> $this->input->ip_address(),
                'last_login_time' => $data['login_time'],
                'last_login_ip'	=> $data['login_ip']
            );

            $this->session->set_userdata($session);
            $this->role_info = $this->__setCurrentUserRole($data);
            //更新数据库
            $udata = array(
                'login_time'	=> $this->time,
                'login_ip'		=> $this->input->ip_address()
            );

            $this->admin_mod->update($data['id'], $udata);
            $link[0]['link_url'] = 'index.php';
            $link[0]['link_name']= '后台管理首页';
            showmsg('登陆成功', $link);
        }
        $this->load->view('admin/common/login');
    }

    public function loginout(){
        is_login();//登陆
        $this->session->sess_destroy();
        $link[0]['link_url'] = '/index.php?app=welcome&act=login';
        $link[0]['link_name']= '登陆';
        showmsg('退出成功', $link, 2);
    }

    /**
     * @desc get wsdl file
     * @link http://bbs.csdn.net/topics/380160387
     * @link http://bbs.csdn.net/topics/380139704
     */
    public function wsdl(){

        $config = get_config();
        $servers = $this->server_mod->getServersList();
        $anyServer = isset($servers[0]['api']) && !empty($servers[0]['api']) ? $servers[0]['api'] : '';
        //配置文件中开启了短API输入格式 即 只是输入 域名或者IP
        $location = isset($_GET['location']) && !empty($_GET['location']) ? base64_decode(base64_decode(trim($_GET['location']))) : $anyServer;
        if(isset($config['back_wsdl_dir'])){ //开启短API输入格式时 只有IP或者域名 需要构造完整的 wsdl地址
            $url_temp_arr = parse_url($location);
            if(isset($url_temp_arr['host']) && !empty($url_temp_arr['host'])){
                //拼出完整输入
                $location = "http://".$url_temp_arr['host'].$config['back_wsdl_dir'];
                if(isset($url_temp_arr['port'])){
                    $location = "http://".$url_temp_arr['host'].":".$url_temp_arr['port'].$config['back_wsdl_dir'];
                }
            }else{
                $location = "http://".$location.$config['back_wsdl_dir'];
            }
        }
        $location_arr = explode('?',$location);
        $location = isset($location_arr[0]) && !empty($location_arr[0]) ? $location_arr[0] : $location;
        $wsdlStr = <<<STR
<?xml version="1.0" encoding="UTF-8" standalone="no"?>
<wsdl:definitions xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/" xmlns:tns="http://flybear.org/BackstageInterface/" xmlns:wsdl="http://schemas.xmlsoap.org/wsdl/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" name="BackstageInterface" targetNamespace="http://flybear.org/BackstageInterface/">
  <wsdl:types>
    <xsd:schema targetNamespace="http://flybear.org/BackstageInterface/">
      <xsd:element name="getResultByAction">
        <xsd:complexType>
          <xsd:sequence>
            <xsd:element name="in" type="xsd:string"/>
          </xsd:sequence>
        </xsd:complexType>
      </xsd:element>
      <xsd:element name="getResultByActionResponse">
        <xsd:complexType>
          <xsd:sequence>
            <xsd:element name="out" type="xsd:string"/>
          </xsd:sequence>
        </xsd:complexType>
      </xsd:element>
    </xsd:schema>
  </wsdl:types>
  <wsdl:message name="getResultByActionRequest">
    <wsdl:part name="parameters" type="xsd:string"/>
  </wsdl:message>
  <wsdl:message name="getResultByActionResponse">
    <wsdl:part name="parameters" type="xsd:string"/>
  </wsdl:message>
  <wsdl:portType name="BackstageInterface">
    <wsdl:operation name="getResultByAction">
      <wsdl:input message="tns:getResultByActionRequest"/>
      <wsdl:output message="tns:getResultByActionResponse"/>
    </wsdl:operation>
  </wsdl:portType>
  <wsdl:binding name="BackstageInterfaceSOAP"
  	type="tns:BackstageInterface">
  	<soap:binding style="document"
  		transport="http://schemas.xmlsoap.org/soap/http" />
  	<wsdl:operation name="getResultByAction">
  		<soap:operation
  			soapAction="http://flybear.org/BackstageInterface/getResultByAction" />
  		<wsdl:input>
  			<soap:body use="literal" />
  		</wsdl:input>
  		<wsdl:output>
  			<soap:body use="literal" />
  		</wsdl:output>
  	</wsdl:operation>
  </wsdl:binding>
  <wsdl:service name="BackstageInterface">
    <wsdl:port binding="tns:BackstageInterfaceSOAP" name="BackstageInterfaceSOAP">
      <soap:address location="{$location}"/>
    </wsdl:port>
  </wsdl:service>
</wsdl:definitions>
STR;
//        header("Content-type:text/xml");
        header("Content-Type:text/xml;charset=utf-8");
        echo $wsdlStr;
    }

}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */