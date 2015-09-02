<?php
/**
 * Author: sarina
 * Date: 2014/12/25
 * Time: 10:03
 */
return array(
    //server.list.php
    'server_list' => '服务器列表', 
    'host_list' => '主机列表',
    'add_server' => '添加服务器',
    'add_host' => '添加主机',
    'belong_platform' => '所属平台',
    'serverID' => '服务器ID', 
    'server_name' => '服务器名', 
    'server_platform' => '服务器平台',
    'server_type' => '服务器类型', 
    'open_server_time' => '开服时间', 
    'close_server_time' => '闭服时间',
    'open_server_time_notice' => '请选择确切的开服时间', 
    'close_server_time_notice' => '请选择确切的闭服时间',
    'server_desc' => '服务器描述',
    'dateAPI' => '数据API',
    'mallAPI' => '商城API', 
    'portAPI' => '接口API', 
    'server_type_label' => array(
        '运行中',
        '已关闭',    
    ),

    //server.form.php
    'server_eg' => '示例: 双线12区9服',
    'server_eg' => '示例: ST_s17',
    'select_server_platform' => '请选择游戏服务器所属平台',
    'server_type_dis' => array(
        '正式服',
        '测试服',
        '轮回服',
        '合并服',
        ),
    'server_merge'=>'请选择被合服',
    'default_server' => '默认正式服', 
    'order_notice' => '未填自动插入255[提高权重请将数字设置的小于255]',   
    'max_num' => '小于等于255',
    'need_only_platform' => '合服的服务器应处于同一平台下',
    'in_ip' => '内网IP',
    'out_ip' => '外网IP',
    'in_nic_name' => '内网网卡',
    'out_nic_name' => '外网网卡',














     //platform.structure.php
    'platform_view' => '平台预览',    
    'platform_recharge_total' => "平台总充值金额[".config_item('currency')."]",
    'server_recharge_total' => "服务器当前充值总额[".config_item('currency')."]",
    'noResult' => '没有结果',
    'merge_info'=>'合服信息',

     //platform.list.php
    'platform_list' => '平台列表',  
    'platform_name' => '平台名称',  
    'add_platform' => '添加平台',
    'platformID' => '平台ID',
    'platform_servers' => '服务器数量',
    'official_site' => '官网地址',
    'platform_type' => '平台类型',
    'platform_type_label' => array(
            '腾讯平台',
            '普通运营平台',
        ),
    'platform_divide' => '牧游分成比例',
    'desc' => '简要描述',

    //platform.form.php
    'platform_eg' => '示例: 牧游平台',
    'percentage' => '提成比例',
    'expired' => '失效',
    'integer' => '请输入0-1之间的小数',
    'url_notice' => '请输入正确的URL',
    'game_operator'=>'游戏端平台标识码'
);
