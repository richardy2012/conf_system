<?php
function getLang(){
	
	return array(
		'back_list' => '返回列表',
		'send_continue' => '继续发送',
		'add_continue' => '继续添加',
		'save_success' => '保存成功',
		'save_failed' => '保存失败',
		'handle_success' => '操作成功',
		'handle_failed' => '操作失败',
		'param_error' => '参数有误',
		'data_too_large' => '数据量过大，请控制查询精确导出结果',
		'need_server'=>'需要提供服务器信息',

		//game.php
		'pushPosition' => array(
					        '1'=>'聊天室置顶公告',
					        '2'=>'聊天室即时公告',
					        '3'=>'中屏置顶公告',
					        '4'=>'中屏即时公告',
					    ),
		'need_only_platform' => '合服的服务器应处于同一平台下',

		//file.php
		'upload_success' => '上传成功',
		'upload_failed' => '上传失败',
		'master_directory' => '主目录',
		'not_exist_directory' => '目录不存在',		
		'upload_avatar' => '上传头像',
		'file' => '文件',
		'pos' => '位置',
		'root_irectory' => '根目录',
		'amount' => '数量',	
		'firstPage' => '首页',
		'prePage' => '上一页',
		'nextPage' => '下一页',
		'lastPage' => '尾页',	

		//key.php
		'not_expired' => '未失效',	
		'expired' => '已失效',
		'not_mark' => '不作记录',
		'unlimited' => '不限次数',
		'keyCode' => 'KEY码',
		'key_cate' => 'key码类别',
		'key_start_time' => 'key码启用时间',
		'key_end_time' => 'key码失效时间',
		'export_num' => '批次导出数量',
		'export_time' => '批次导出时间',
		'key_user' => 'key码使用玩家',
		'key_use_times' => 'key码使用次数',
		'key_use_time' => 'key码使用时间',
		'key_list_export' => 'KEY码列表导出',
		'use_time' => '启用时间',
		'end_time' => '结束时间',
		'use_rules' => array(
			'单服单玩家仅可用一次',
			'单服多玩家仅可用一次',
			'单服单玩家可使用多次',
		),

		//operation.php
		'auction_record' => '拍卖记录',	
		'auction_continue' => '继续拍卖',
		'label_type' => array(
			'限时特惠',
			'开服特惠',
			'节日特惠',
			'每日首充',
			'本次活动为累计充值返礼',		
		),
		'all_servers' => '全部服务器',
		'span_text_pre' => '此时间段内以下服务器：',
		'span_text_next' => '已存在红包活动',

		//player.php
	    'factionList' => array(2=>'魏国',3=>'蜀国',4=>'吴国'),
		'query_continue' => '继续查询',	
		'dis_error' => '出现错误',
		'hostory' => '历史记录',

		'hostory' => '历史记录',



		'roleID' => '角色ID',
		'paltformID' => '平台ID',
		'role_name' => '角色名',
		'money' => '金钱',
		'grain' => '粮草',
		'support' => '民心',
		'redif' => '预备兵',
		'gift' => '礼券',
		'respect' => '威望值',
		'exploit' => '功勋值',
		'export_respect' => '导出当前服威望值前1百',
		'handle_continue' => '继续操作',
		'param_error_time' => '参数错误:截止时间应该大于当前时间！',
		'not_belong' => '没有归属',
		'get_support' => '获得民心',
		'get_gift' => '获得礼券',
		'consume' => '消耗资产',
		'istotal_assoc' => array(
			'不统计',
			'以Action对应的行为单独统计',
			'已Action所属的消耗类型统计',
		),

		//monitor.php
		'need_ser' => '后台需要输入所要管理的游戏平台信息及服务器信息',	
		'player_level_info' => array('玩家等级','流失人数','服务器ID','服务器','平台'),
		'player_level_distribute' => '用户等级分布',
		'mall_buy_records_title' => array('商品名称','玩家名称','购买数量','消费民心/礼券','所在服务器','购买时间'),
		'mall_buy_records' => '商城购买记录',
		'mall_first_records_title' => array('商品名称','购买人数','购买总量','服务器ID','服务器名'),
		'mall_first_buy_records' => '商城初次购买记录',
		'build' => '修筑',
		'feats_for' => '功勋兑换',
		'game_output' => '游戏内产出',

		'createTitle' => array(
			'点击跳转人数', //usercreate
			'成功加载人数', //loadAnimation
			'成功登录人数', //rolecreate
			'成功更名人数',//editRoleName
			'更换阵营人数',//takeChangeFaction
		),

		'query_con_large' => '查询周期超过30天，请控制查询区间，以免占用过多计算资源',
		'select_right_time' => '请选择正确的时间区间',	

		//admin.php
		'adminCannotDelete' => '超级管理员不可删除',
		'server' => '服务器',

	);	
}
