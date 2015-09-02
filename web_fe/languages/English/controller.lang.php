<?php
function getLang(){
	
	return array(
		'back_list' => 'Back to list',
		'send_continue' => 'Continue to send',
		'add_continue' => 'Continue to add',
		'save_success' => 'Saving succeeded',
		'save_failed' => 'Saving failed',
		'handle_success' => 'Operation succeeded',
		'handle_failed' => 'Operation failed',
		'param_error' => 'Incorrect parameter',
		'data_too_large' => 'Please control the query accuracy to export results from the oversized data!',
		'need_server'=>'Need server info',

		'hostory' => '历史记录',




		//game.php
		'pushPosition' => array(
					        '1'=>'Top bulletin in chat box',
					        '2'=>'Real-time bulletin in chat box',
					        '3'=>'Top bulletin in middle screen',
					        '4'=>'Real-time bulletin in middle screen',
					    ),
		'need_only_platform' => '合服的服务器应处于同一平台下',


		//file.php
		'upload_success' => 'Uploading succeeded',
		'upload_failed' => 'Uploading failed',
		'master_directory' => 'Home directory',
		'not_exist_directory' => 'Directory does not exist',		
		'upload_avatar' => 'Upload avatar',
		'file' => 'file',
		'pos' => 'position',
		'root_irectory' => 'Root directory',
		'amount' => 'amount',	
		'firstPage' => 'First page',
		'prePage' => 'Prev page',
		'nextPage' => 'Next page',
		'lastPage' => 'Last page',	

		//key.php
		'not_expired' => 'not expired',	
		'expired' => 'Expired',
		'not_mark' => 'Not recorded',
		'unlimited' => 'Infinite/unlimited times',
		'keyCode' => 'KEY',
		'key_cate' => 'KEY category',
		'key_start_time' => 'KEY enabling time',
		'key_end_time' => 'KEY failure time',
		'export_num' => 'Bulk export quantity',
		'export_time' => 'Bulk export time',
		'key_user' => 'KEY using player',
		'key_use_times' => 'KEY using count',
		'key_use_time' => 'KEY service time',
		'key_list_export' => 'KEY list export',
		'use_time' => 'Enabling time',
		'end_time' => 'Failure time',
		'use_rules' => array(
			'The single-server single player can use it once only.',
			'The single-server multiplayer can use it once only.',
			'The single-server single player can use it repeatedly.',
		),

		//operation.php
		'auction_record' => 'Auction record',	
		'auction_continue' => 'Continue to auction',
		'label_type' => array(
			'Time-limited offer',
			'Service release offer',
			'Holiday offer',
			'Everyday first recharge',
			'The event is the gift for cumulative recharge',		
		),
		'all_servers' => 'All servers',
		'span_text_pre' => '此时间段内以下服务器：',
		'span_text_next' => '已存在红包活动',			

		//player.php
	    'factionList' => array(2=>'State Wei',3=>'State Shu',4=>'State Wu'),
		'query_continue' => 'Continue to query',	
		'dis_error' => 'An error occurred',
		'hostory' => 'Historical record',

		'roleID' => 'Role ID',
		'paltformID' => 'Platform ID',
		'role_name' => 'Role name',
		'money' => 'Money',
		'grain' => 'Forage',
		'support' => 'coins',
		'redif' => 'Reservist',
		'gift' => 'Token',
		'respect' => 'Prestige point',
		'exploit' => 'Feat point',
		'export_respect' => 'Export the first 100 of the current prestige points',
		'handle_continue' => 'Continue to operate',
		'param_error_time' => 'Parameter error: The deadline should be later than the current time!',
		'not_belong' => 'No attribution',
		'get_support' => 'coins gotten',
		'get_gift' => 'Token gotten',
		'consume' => 'Asset consumed',
		'istotal_assoc' => array(
			'No statistics',
			'Separate statistics of behavior corresponding to Action',
			'Statistics of consumption type that the Action belongs to',
		),

		//monitor.php
		'need_ser' => 'In the background, you need to enter the information of game platform and server to be managed.',	
		'player_level_info' => array('Player level','Players lost','Server ID','Server','Platform'),
		'player_level_distribute' => 'User level distribution',
		'mall_buy_records_title' => array('Goods name','Player name','Purchase quantity','Consuming coins/token','Current server','Purchasing time'),
		'mall_buy_records' => 'Buying records at the mall',
		'mall_first_records_title' => array('Goods name','Number of buyers','Total purchase quantity','Server ID','Server name'),
		'mall_first_buy_records' => 'Initial buying record',
		'build' => 'Building',
		'feats_for' => 'Feat exchange',
		'game_output' => 'game output',
		'createTitle' => array(
			'Number of clicking',
			'Loading page number',
			'Number of roles',
			'Change RoleName Nums',
			'Change Faction Nums',
		),	
		'query_con_large' => 'The query period exceeds 30 days. Please control the query interval to avoid occupying too much computing resources',
		'select_right_time' => 'Please select the correct time zone',	

		//admin.php
		'adminCannotDelete' => 'The super administrator cannot be deleted',
		'server' => 'Server',

	);	
}
