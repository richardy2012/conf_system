<?php
/**
 * Author: sarina
 * Date: 2014/12/25
 * Time: 10:03
 */
return array(
    //server.list.php
    'server_list' => 'Server list',
    'add_server' => 'Add a server',
    'belong_platform' => 'Subordinate platform',
    'serverID' => 'Server ID',
    'server_name' => 'Server name',
    'server_platform' => 'Server platform',
    'server_type' => 'Server type',
    'open_server_time' => 'Server opening time',
    'close_server_time' => 'Server closing time',
    'open_server_time_notice' => 'Please select the exact server opening time',
    'close_server_time_notice' => 'Please select the exact server closing time',
    'server_desc' => 'Description of server',
    'dateAPI' => 'Interface API',
    'mallAPI' => 'Mall API',
    'portAPI' => 'Port API',
    'server_type_label' => array(
        'In service',
        'Closed',
    ),

    //server.form.php
    'server_eg' => 'Example: Server 9 Zone 12 in double lines',
    'select_server_platform' => 'Please choose the platform belonging to the game server',
    'server_type_dis' => array(
        'Official server',
        'Testing server',
        'Rolling server',
        'Merger server',
    ),
    'default_server' => 'Default official server',
    'order_notice' => 'Automatically insert 255 in case of no entry [to improve the weights, please set the number to be less than 255]',
    'max_num' => 'Less than or equal to 255',
    'need_only_platform' => '合服的服务器应处于同一平台下',
    'merge_info'=>'合服信息',

     //platform.structure.php
    'platform_view' => 'Platform preview',
    'platform_recharge_total' => 'Total recharge amount ['.config_item('currency').']',
    'server_recharge_total' => 'Total current recharge ['.config_item('currency').']',
    'noResult' => 'No result is displayed',

     //platform.list.php
    'platform_list' => 'Platform list',
    'platform_name' => 'Platform name',
    'add_platform' => 'Add a platform',
    'platformID' => 'Platform ID',
    'platform_servers' => 'Number of servers',
    'official_site' => 'Official website address',
    'platform_type' => 'Platform type',
    'platform_type_label' => array(
            'Tencent Cooperation platform',
            'Common operating platform',
        ),
    'platform_divide' => 'FlyBearGame sharing ratio',
    'desc' => 'Brief description',

    //platform.form.php
    'platform_eg' => 'Example: FlyBearGame Platform',
    'percentage' => 'Commission ratio',
    'expired' => 'Expired',
    'integer' => 'Please enter a decimal between 0 and 1',
    'url_notice' => 'Please enter the correct URL',
    'game_operator'=>'游戏端平台标识码',

);
