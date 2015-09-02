/*
Navicat MySQL Data Transfer

Source Server         : 192.168.184.43[st_back]
Source Server Version : 50617
Source Host           : 192.168.184.43:3306
Source Database       : st_conf_sys

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-09-02 14:17:12
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `conf_admin`
-- ----------------------------
DROP TABLE IF EXISTS `conf_admin`;
CREATE TABLE `conf_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `nickname` varchar(200) NOT NULL,
  `platform_id` varchar(64) NOT NULL DEFAULT '' COMMENT '[可以查看的平台]关联platform表的id',
  `role_id` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '角色ID',
  `sex` tinyint(1) NOT NULL,
  `password` varchar(32) NOT NULL,
  `salt` char(8) NOT NULL,
  `telphone` varchar(255) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `dateline` int(10) unsigned NOT NULL,
  `login_time` int(10) unsigned NOT NULL DEFAULT '0',
  `login_ip` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of conf_admin
-- ----------------------------
INSERT INTO conf_admin VALUES ('1', 'admin', '系统', '1', '1', '1', '274df22c4933ed3b778d1516a8b66a3c', 'CwrFTvWR', '11111111111', '1', '1441174478', '1441174403', '192.168.184.168');
INSERT INTO conf_admin VALUES ('20', 'ceshi', '测试', '', '1', '1', '8814594d12c9b92987e6c90c5c343270', 'CwrFTvWR', '11111111111', '1', '1441174489', '1430996463', '192.168.184.164');
INSERT INTO conf_admin VALUES ('21', 'demo', 'demo', '', '11', '1', '8814594d12c9b92987e6c90c5c343270', 'CwrFTvWR', '11111111111', '1', '1441174483', '1432809950', '127.0.0.1');

-- ----------------------------
-- Table structure for `conf_admin_actions`
-- ----------------------------
DROP TABLE IF EXISTS `conf_admin_actions`;
CREATE TABLE `conf_admin_actions` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(5) unsigned NOT NULL DEFAULT '0',
  `action_name` varchar(32) NOT NULL DEFAULT '' COMMENT '方法名',
  `controller` varchar(32) NOT NULL DEFAULT '' COMMENT '控制器',
  `action` varchar(32) NOT NULL DEFAULT '' COMMENT '方法',
  `desc` varchar(32) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of conf_admin_actions
-- ----------------------------
INSERT INTO conf_admin_actions VALUES ('2', '0', '主机管理', 'server', '', 'C', '1');
INSERT INTO conf_admin_actions VALUES ('3', '2', '结构一览', 'server', 'structure', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('4', '2', '平台列表', 'server', 'platform', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('5', '2', '添加平台', 'server', 'addPlatform', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('7', '2', '删除', 'server', 'drop', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('8', '2', '编辑平台', 'server', 'editPlatform', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('9', '2', '主机管理', 'server', 'index', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('10', '2', '添加主机', 'server', 'addServer', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('11', '2', '编辑主机', 'server', 'editServer', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('12', '0', '游戏配置', 'game', '', 'C', '1');
INSERT INTO conf_admin_actions VALUES ('22', '12', '删除', 'game', 'drop', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('48', '0', '平台设置', 'admin', '', 'C', '1');
INSERT INTO conf_admin_actions VALUES ('49', '48', '角色管理', 'admin', 'role', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('50', '48', '添加角色', 'admin', 'addRole', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('51', '48', '编辑角色', 'admin', 'editRole', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('52', '48', '删除角色', 'admin', 'dropRole', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('53', '48', '用户列表', 'admin', 'index', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('54', '48', '添加用户', 'admin', 'addAdmin', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('55', '48', '编辑用户', 'admin', 'editAdmin', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('56', '48', '控制器列表', 'admin', 'permitAction', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('57', '48', '添加控制器', 'admin', 'addPermitAction', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('58', '48', '删除用户', 'admin', 'drop', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('120', '12', 'LB应用配置列表', 'game', 'loadBalanceSetList', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('121', '12', '创建LB应用配置', 'game', 'createLoadBalanceSet', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('122', '12', 'IM应用配置列表', 'game', 'imServerSetList', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('123', '12', '创建IM应用配置', 'game', 'createImServerSet', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('124', '12', 'BB应用配置列表', 'game', 'battleBalanceSetList', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('125', '12', '创建BB应用配置', 'game', 'createBattleBalanceSet', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('126', '12', 'battle应用配置列表', 'game', 'battleSetList', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('127', '12', '创建battle应用配置', 'game', 'createBattleSet', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('128', '12', 'gameServer配置列表', 'game', 'gameServerSetList', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('129', '12', '创建gameServer配置', 'game', 'createGameServerSet', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('130', '12', '编辑LB应用配置', 'game', 'editLoadBalanceSet', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('131', '12', '编辑IM应用配置', 'game', 'editImServerSet', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('132', '12', '编辑BB应用配置', 'game', 'editBattleBalanceSet', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('133', '12', '编辑battle应用配置', 'game', 'editBattleSet', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('134', '12', '编辑gameServer配置', 'game', 'editGameServerSet', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('135', '12', 'battleStronghold配置列表', 'game', 'BattleStrongholdSetList', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('136', '12', '创建battleStronghold配置', 'game', 'createBattleStrongholdSet', 'A', '1');
INSERT INTO conf_admin_actions VALUES ('137', '12', '编辑battleStronghold配置', 'game', 'editBattleStrongholdSet', 'A', '1');

-- ----------------------------
-- Table structure for `conf_admin_role`
-- ----------------------------
DROP TABLE IF EXISTS `conf_admin_role`;
CREATE TABLE `conf_admin_role` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色表【主键】',
  `role_name` varchar(32) NOT NULL DEFAULT '' COMMENT '角色名',
  `role_source` tinyint(1) unsigned DEFAULT '0' COMMENT '角色内外部区分[默认0来自内部人员]',
  `platform_id` varchar(64) NOT NULL DEFAULT '' COMMENT '[可以查看的平台]',
  `desc` varchar(32) NOT NULL DEFAULT '' COMMENT '注释',
  `add_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `approve_right` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '审核权限[默认为0]',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of conf_admin_role
-- ----------------------------
INSERT INTO conf_admin_role VALUES ('1', '超级管理员', '0', '4,5', '最高权限在此', '1438257039', '1');
INSERT INTO conf_admin_role VALUES ('11', 'demo', '1', '', 'demo', '1432809853', '1');

-- ----------------------------
-- Table structure for `conf_admin_role_action`
-- ----------------------------
DROP TABLE IF EXISTS `conf_admin_role_action`;
CREATE TABLE `conf_admin_role_action` (
  `role_id` int(5) unsigned NOT NULL COMMENT '角色表ID',
  `action_id` int(5) unsigned NOT NULL COMMENT '控制器ID',
  PRIMARY KEY (`role_id`,`action_id`),
  KEY `action_id` (`action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of conf_admin_role_action
-- ----------------------------
INSERT INTO conf_admin_role_action VALUES ('1', '3');
INSERT INTO conf_admin_role_action VALUES ('11', '3');
INSERT INTO conf_admin_role_action VALUES ('1', '4');
INSERT INTO conf_admin_role_action VALUES ('11', '4');
INSERT INTO conf_admin_role_action VALUES ('1', '5');
INSERT INTO conf_admin_role_action VALUES ('11', '5');
INSERT INTO conf_admin_role_action VALUES ('1', '7');
INSERT INTO conf_admin_role_action VALUES ('11', '7');
INSERT INTO conf_admin_role_action VALUES ('1', '8');
INSERT INTO conf_admin_role_action VALUES ('11', '8');
INSERT INTO conf_admin_role_action VALUES ('1', '9');
INSERT INTO conf_admin_role_action VALUES ('11', '9');
INSERT INTO conf_admin_role_action VALUES ('1', '10');
INSERT INTO conf_admin_role_action VALUES ('11', '10');
INSERT INTO conf_admin_role_action VALUES ('1', '11');
INSERT INTO conf_admin_role_action VALUES ('11', '11');
INSERT INTO conf_admin_role_action VALUES ('11', '13');
INSERT INTO conf_admin_role_action VALUES ('11', '14');
INSERT INTO conf_admin_role_action VALUES ('11', '15');
INSERT INTO conf_admin_role_action VALUES ('11', '16');
INSERT INTO conf_admin_role_action VALUES ('11', '17');
INSERT INTO conf_admin_role_action VALUES ('11', '18');
INSERT INTO conf_admin_role_action VALUES ('11', '19');
INSERT INTO conf_admin_role_action VALUES ('11', '20');
INSERT INTO conf_admin_role_action VALUES ('11', '21');
INSERT INTO conf_admin_role_action VALUES ('1', '22');
INSERT INTO conf_admin_role_action VALUES ('11', '22');
INSERT INTO conf_admin_role_action VALUES ('11', '24');
INSERT INTO conf_admin_role_action VALUES ('11', '25');
INSERT INTO conf_admin_role_action VALUES ('11', '27');
INSERT INTO conf_admin_role_action VALUES ('11', '28');
INSERT INTO conf_admin_role_action VALUES ('11', '29');
INSERT INTO conf_admin_role_action VALUES ('11', '30');
INSERT INTO conf_admin_role_action VALUES ('11', '31');
INSERT INTO conf_admin_role_action VALUES ('11', '33');
INSERT INTO conf_admin_role_action VALUES ('11', '34');
INSERT INTO conf_admin_role_action VALUES ('11', '35');
INSERT INTO conf_admin_role_action VALUES ('11', '36');
INSERT INTO conf_admin_role_action VALUES ('11', '37');
INSERT INTO conf_admin_role_action VALUES ('11', '38');
INSERT INTO conf_admin_role_action VALUES ('11', '39');
INSERT INTO conf_admin_role_action VALUES ('11', '41');
INSERT INTO conf_admin_role_action VALUES ('11', '42');
INSERT INTO conf_admin_role_action VALUES ('11', '43');
INSERT INTO conf_admin_role_action VALUES ('11', '44');
INSERT INTO conf_admin_role_action VALUES ('11', '45');
INSERT INTO conf_admin_role_action VALUES ('11', '47');
INSERT INTO conf_admin_role_action VALUES ('1', '49');
INSERT INTO conf_admin_role_action VALUES ('11', '49');
INSERT INTO conf_admin_role_action VALUES ('1', '50');
INSERT INTO conf_admin_role_action VALUES ('11', '50');
INSERT INTO conf_admin_role_action VALUES ('1', '51');
INSERT INTO conf_admin_role_action VALUES ('11', '51');
INSERT INTO conf_admin_role_action VALUES ('1', '52');
INSERT INTO conf_admin_role_action VALUES ('11', '52');
INSERT INTO conf_admin_role_action VALUES ('1', '53');
INSERT INTO conf_admin_role_action VALUES ('11', '53');
INSERT INTO conf_admin_role_action VALUES ('1', '54');
INSERT INTO conf_admin_role_action VALUES ('11', '54');
INSERT INTO conf_admin_role_action VALUES ('1', '55');
INSERT INTO conf_admin_role_action VALUES ('11', '55');
INSERT INTO conf_admin_role_action VALUES ('1', '56');
INSERT INTO conf_admin_role_action VALUES ('11', '56');
INSERT INTO conf_admin_role_action VALUES ('1', '57');
INSERT INTO conf_admin_role_action VALUES ('11', '57');
INSERT INTO conf_admin_role_action VALUES ('1', '58');
INSERT INTO conf_admin_role_action VALUES ('11', '58');
INSERT INTO conf_admin_role_action VALUES ('11', '59');
INSERT INTO conf_admin_role_action VALUES ('11', '60');
INSERT INTO conf_admin_role_action VALUES ('11', '61');
INSERT INTO conf_admin_role_action VALUES ('11', '62');
INSERT INTO conf_admin_role_action VALUES ('11', '63');
INSERT INTO conf_admin_role_action VALUES ('11', '64');
INSERT INTO conf_admin_role_action VALUES ('11', '65');
INSERT INTO conf_admin_role_action VALUES ('11', '66');
INSERT INTO conf_admin_role_action VALUES ('11', '67');
INSERT INTO conf_admin_role_action VALUES ('11', '68');
INSERT INTO conf_admin_role_action VALUES ('11', '69');
INSERT INTO conf_admin_role_action VALUES ('11', '70');
INSERT INTO conf_admin_role_action VALUES ('11', '71');
INSERT INTO conf_admin_role_action VALUES ('11', '72');
INSERT INTO conf_admin_role_action VALUES ('11', '73');
INSERT INTO conf_admin_role_action VALUES ('11', '74');
INSERT INTO conf_admin_role_action VALUES ('11', '75');
INSERT INTO conf_admin_role_action VALUES ('11', '76');
INSERT INTO conf_admin_role_action VALUES ('11', '77');
INSERT INTO conf_admin_role_action VALUES ('11', '78');
INSERT INTO conf_admin_role_action VALUES ('11', '79');
INSERT INTO conf_admin_role_action VALUES ('11', '80');
INSERT INTO conf_admin_role_action VALUES ('11', '81');
INSERT INTO conf_admin_role_action VALUES ('11', '82');
INSERT INTO conf_admin_role_action VALUES ('11', '83');
INSERT INTO conf_admin_role_action VALUES ('11', '84');
INSERT INTO conf_admin_role_action VALUES ('11', '85');
INSERT INTO conf_admin_role_action VALUES ('11', '86');
INSERT INTO conf_admin_role_action VALUES ('11', '87');
INSERT INTO conf_admin_role_action VALUES ('11', '88');
INSERT INTO conf_admin_role_action VALUES ('11', '89');
INSERT INTO conf_admin_role_action VALUES ('11', '90');
INSERT INTO conf_admin_role_action VALUES ('11', '91');
INSERT INTO conf_admin_role_action VALUES ('11', '92');
INSERT INTO conf_admin_role_action VALUES ('11', '93');
INSERT INTO conf_admin_role_action VALUES ('11', '94');
INSERT INTO conf_admin_role_action VALUES ('11', '95');
INSERT INTO conf_admin_role_action VALUES ('11', '96');
INSERT INTO conf_admin_role_action VALUES ('11', '97');
INSERT INTO conf_admin_role_action VALUES ('11', '101');
INSERT INTO conf_admin_role_action VALUES ('11', '102');
INSERT INTO conf_admin_role_action VALUES ('11', '103');
INSERT INTO conf_admin_role_action VALUES ('11', '104');
INSERT INTO conf_admin_role_action VALUES ('11', '105');
INSERT INTO conf_admin_role_action VALUES ('11', '106');
INSERT INTO conf_admin_role_action VALUES ('11', '107');
INSERT INTO conf_admin_role_action VALUES ('11', '108');
INSERT INTO conf_admin_role_action VALUES ('11', '109');
INSERT INTO conf_admin_role_action VALUES ('11', '110');
INSERT INTO conf_admin_role_action VALUES ('11', '111');
INSERT INTO conf_admin_role_action VALUES ('11', '112');
INSERT INTO conf_admin_role_action VALUES ('1', '120');
INSERT INTO conf_admin_role_action VALUES ('1', '121');
INSERT INTO conf_admin_role_action VALUES ('1', '122');
INSERT INTO conf_admin_role_action VALUES ('1', '123');
INSERT INTO conf_admin_role_action VALUES ('1', '124');
INSERT INTO conf_admin_role_action VALUES ('1', '125');
INSERT INTO conf_admin_role_action VALUES ('1', '126');
INSERT INTO conf_admin_role_action VALUES ('1', '127');
INSERT INTO conf_admin_role_action VALUES ('1', '128');
INSERT INTO conf_admin_role_action VALUES ('1', '129');
INSERT INTO conf_admin_role_action VALUES ('1', '130');
INSERT INTO conf_admin_role_action VALUES ('1', '131');
INSERT INTO conf_admin_role_action VALUES ('1', '132');
INSERT INTO conf_admin_role_action VALUES ('1', '133');
INSERT INTO conf_admin_role_action VALUES ('1', '134');
INSERT INTO conf_admin_role_action VALUES ('1', '135');
INSERT INTO conf_admin_role_action VALUES ('1', '136');
INSERT INTO conf_admin_role_action VALUES ('1', '137');

-- ----------------------------
-- Table structure for `conf_st_battle_balance`
-- ----------------------------
DROP TABLE IF EXISTS `conf_st_battle_balance`;
CREATE TABLE `conf_st_battle_balance` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `battle_balance_host_id` int(10) unsigned NOT NULL DEFAULT '0',
  `server_id` int(10) unsigned NOT NULL DEFAULT '0',
  `in_ip` varchar(32) NOT NULL DEFAULT '' COMMENT '内网IP',
  `out_ip` varchar(32) NOT NULL DEFAULT '' COMMENT '外网ip',
  `in_nic_name` varchar(32) NOT NULL DEFAULT '' COMMENT '内网网卡',
  `out_nic_name` varchar(32) NOT NULL DEFAULT '' COMMENT '外网网卡',
  `open_server_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '开服时间',
  `battle_for_battle_master_ip` varchar(32) NOT NULL DEFAULT '' COMMENT 'load_for_login_server_ip',
  `battle_for_battle_mater_port` varchar(32) NOT NULL DEFAULT '' COMMENT 'load_for_login_server_port',
  `battle_for_battle_balance_ip` varchar(32) NOT NULL DEFAULT '' COMMENT 'load_for_load_balance_ip',
  `battle_for_battle_balance_port` varchar(32) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态【1正常】【0关闭】',
  `battle_balancer_ini` text NOT NULL,
  `zk_path` varchar(255) NOT NULL DEFAULT '' COMMENT 'zk_path',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of conf_st_battle_balance
-- ----------------------------
INSERT INTO conf_st_battle_balance VALUES ('1', '1', '37', '192.168.18.100', '192.168.18.100', 'venet0:0', 'venet0:0', '2015-07-27 09:00:00', '0.0.0.0', '8501', '0.0.0.0', '8401', '1', '[general]\r\nlogpath           = /data/logs/\r\n\r\n[battle_balancer]\r\nip                = 0.0.0.0\r\nport              = 8401\r\naccept_queue_size = 250\r\n\r\nio_thread_size    = 8\r\nwork_thread_init  = 8\r\nwork_thread_high  = 32\r\nwork_thread_load  = 500\r\n\r\nhandler_pool_init = 100\r\nhandler_pool_low  = 0\r\nhandler_pool_high = 500\r\nhandler_pool_inc  = 50\r\nhandler_pool_max  = 5000\r\n\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\n\r\n[battle_master]\r\nip                = 0.0.0.0\r\nport              = 8501\r\naccept_queue_size = 250\r\n\r\nio_thread_size    = 1\r\nwork_thread_init  = 1\r\nwork_thread_high  = 1\r\nwork_thread_load  = 500\r\n\r\nhandler_pool_init = 100\r\nhandler_pool_low  = 0\r\nhandler_pool_high = 500\r\nhandler_pool_inc  = 50\r\nhandler_pool_max  = 5000\r\n\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\n\r\n[monitor]\r\nip                = 127.0.0.1\r\nport              = 9010\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30', '/CONF-TESTER-01/data/apps/cpp-configs/battle_balancer.ini');
INSERT INTO conf_st_battle_balance VALUES ('2', '2', '38', '192.168.18.101', '192.168.18.101', 'venet0:0', 'venet0:0', '2015-07-27 09:00:00', '0.0.0.0', '8502', '0.0.0.0', '8402', '1', '[general]\r\nlogpath           = /data/logs/\r\n\r\n[battle_balancer]\r\nip                = 0.0.0.0\r\nport              = 8402\r\naccept_queue_size = 250\r\n\r\nio_thread_size    = 8\r\nwork_thread_init  = 8\r\nwork_thread_high  = 32\r\nwork_thread_load  = 500\r\n\r\nhandler_pool_init = 100\r\nhandler_pool_low  = 0\r\nhandler_pool_high = 500\r\nhandler_pool_inc  = 50\r\nhandler_pool_max  = 5000\r\n\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\n\r\n[battle_master]\r\nip                = 0.0.0.0\r\nport              = 8502\r\naccept_queue_size = 250\r\n\r\nio_thread_size    = 1\r\nwork_thread_init  = 1\r\nwork_thread_high  = 1\r\nwork_thread_load  = 500\r\n\r\nhandler_pool_init = 100\r\nhandler_pool_low  = 0\r\nhandler_pool_high = 500\r\nhandler_pool_inc  = 50\r\nhandler_pool_max  = 5000\r\n\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\n\r\n[monitor]\r\nip                = 127.0.0.1\r\nport              = 9010\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30', '/CONF-TESTER-02/data/apps/cpp-configs/battle_balancer.ini');
INSERT INTO conf_st_battle_balance VALUES ('3', '3', '39', '192.168.18.102', '192.168.18.102', 'venet0:0', 'venet0:0', '2015-07-29 10:00:00', '0.0.0.0', '8503', '0.0.0.0', '8403', '1', '[general]\r\nlogpath           = /data/logs/\r\n\r\n[battle_balancer]\r\nip                = 0.0.0.0\r\nport              = 8403\r\naccept_queue_size = 250\r\n\r\nio_thread_size    = 8\r\nwork_thread_init  = 8\r\nwork_thread_high  = 32\r\nwork_thread_load  = 500\r\n\r\nhandler_pool_init = 100\r\nhandler_pool_low  = 0\r\nhandler_pool_high = 500\r\nhandler_pool_inc  = 50\r\nhandler_pool_max  = 5000\r\n\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\n\r\n[battle_master]\r\nip                = 0.0.0.0\r\nport              = 8503\r\naccept_queue_size = 250\r\n\r\nio_thread_size    = 1\r\nwork_thread_init  = 1\r\nwork_thread_high  = 1\r\nwork_thread_load  = 500\r\n\r\nhandler_pool_init = 100\r\nhandler_pool_low  = 0\r\nhandler_pool_high = 500\r\nhandler_pool_inc  = 50\r\nhandler_pool_max  = 5000\r\n\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\n\r\n[monitor]\r\nip                = 127.0.0.1\r\nport              = 9010\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30', '/CONF-TESTER-03/data/apps/cpp-configs/battle_balancer.ini');

-- ----------------------------
-- Table structure for `conf_st_battle_server`
-- ----------------------------
DROP TABLE IF EXISTS `conf_st_battle_server`;
CREATE TABLE `conf_st_battle_server` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `battle_server_host_id` int(10) unsigned NOT NULL DEFAULT '0',
  `battle_balance_host_id_support` int(10) unsigned NOT NULL DEFAULT '0',
  `server_id` int(10) unsigned NOT NULL DEFAULT '0',
  `in_ip` varchar(32) NOT NULL DEFAULT '' COMMENT '内网IP',
  `out_ip` varchar(32) NOT NULL DEFAULT '' COMMENT '外网ip',
  `in_nic_name` varchar(32) NOT NULL DEFAULT '' COMMENT '内网网卡',
  `out_nic_name` varchar(32) NOT NULL DEFAULT '' COMMENT '外网网卡',
  `open_server_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '开服时间',
  `battle_server_ip` varchar(32) NOT NULL DEFAULT '' COMMENT 'battle_server_ip',
  `battle_server_port` varchar(32) NOT NULL DEFAULT '' COMMENT 'battle_server_port',
  `battle_balancer_ip` varchar(32) NOT NULL DEFAULT '' COMMENT 'battle_balancer_ip',
  `battle_balancer_port` varchar(32) NOT NULL DEFAULT '' COMMENT 'battle_balancer_port',
  `php_service_address` varchar(32) NOT NULL DEFAULT '' COMMENT 'php_service_address',
  `php_service_port` varchar(32) NOT NULL DEFAULT '' COMMENT 'php_service_port',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态【1正常】【0关闭】',
  `battle_ini` text NOT NULL,
  `zk_path` varchar(255) NOT NULL DEFAULT '' COMMENT 'zk_path',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of conf_st_battle_server
-- ----------------------------
INSERT INTO conf_st_battle_server VALUES ('1', '1001', '1', '37', '192.168.18.100', '192.168.18.100', 'venet0:0', 'venet0:0', '2015-07-27 09:00:00', '0.0.0.0', '8601', '0.0.0.0', '8401', '', '', '1', '[general]\r\nio_thread_size    = 1\r\nbattle_thread_size= 4\r\nlogpath           = /data/logs/\r\nluapath           = /data/lua/\r\nlanguage          = En\r\n\r\n[battle_server]\r\nip                = 0.0.0.0\r\nport              = 8601\r\naccept_queue_size = 250\r\n\r\nio_thread_size    = 8\r\nwork_thread_init  = 8\r\nwork_thread_high  = 32\r\nwork_thread_load  = 500\r\n\r\nhandler_pool_init = 100\r\nhandler_pool_low  = 0\r\nhandler_pool_high = 500\r\nhandler_pool_inc  = 50\r\nhandler_pool_max  = 5000\r\n\r\nread_buffer_size  = 10240\r\nwrite_buffer_size = 10240\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\n\r\n[battle_balancer]\r\nip                = 0.0.0.0\r\nport              = 8401\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n[thrift_phpservice]\r\ntype              = http\r\naddress           = http://PHP-SERVER:8784/main.php?stream=\r\nport              = 9090\r\nconnect_timeout   = 10\r\nreceive_timeout   = 10\r\nsend_timeout      = 10\r\nread_buffer_size  = 10240\r\nwrite_buffer_size = 10240\r\npool_init         = 4\r\npool_low          = 0\r\npool_high         = 8\r\npool_inc          = 2\r\npool_max          = 16\r\n\r\n[monitor]\r\nip                = 127.0.0.1\r\nport              = 9010\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n\r\n[redis]\r\nip                = REDIS-SYSDB-SERVER\r\nport              = 6379', '/CONF-TESTER-01/data/apps/cpp-configs/battle.ini.d/1001/battle.ini');
INSERT INTO conf_st_battle_server VALUES ('2', '1002', '1', '37', '192.168.18.100', '192.168.18.100', 'venet0:0', 'venet0:0', '2015-07-28 10:00:00', '0.0.0.0', '8602', '0.0.0.0', '8401', '', '', '1', '[general]\r\nio_thread_size    = 1\r\nbattle_thread_size= 4\r\nlogpath           = /data/logs/\r\nluapath           = /data/lua/\r\nlanguage          = En\r\n\r\n[battle_server]\r\nip                = 0.0.0.0\r\nport              = 8602\r\naccept_queue_size = 250\r\n\r\nio_thread_size    = 8\r\nwork_thread_init  = 8\r\nwork_thread_high  = 32\r\nwork_thread_load  = 500\r\n\r\nhandler_pool_init = 100\r\nhandler_pool_low  = 0\r\nhandler_pool_high = 500\r\nhandler_pool_inc  = 50\r\nhandler_pool_max  = 5000\r\n\r\nread_buffer_size  = 10240\r\nwrite_buffer_size = 10240\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\n\r\n[battle_balancer]\r\nip                = 0.0.0.0\r\nport              = 8401\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n[thrift_phpservice]\r\ntype              = http\r\naddress           = http://PHP-SERVER:8784/main.php?stream=\r\nport              = 9090\r\nconnect_timeout   = 10\r\nreceive_timeout   = 10\r\nsend_timeout      = 10\r\nread_buffer_size  = 10240\r\nwrite_buffer_size = 10240\r\npool_init         = 4\r\npool_low          = 0\r\npool_high         = 8\r\npool_inc          = 2\r\npool_max          = 16\r\n\r\n[monitor]\r\nip                = 127.0.0.1\r\nport              = 9010\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n\r\n[redis]\r\nip                = REDIS-SYSDB-SERVER\r\nport              = 6379', '/CONF-TESTER-01/data/apps/cpp-configs/battle.ini.d/1002/battle.ini');
INSERT INTO conf_st_battle_server VALUES ('3', '1003', '1', '37', '192.168.18.100', '192.168.18.100', 'venet0:0', 'venet0:0', '2015-07-28 10:00:00', '0.0.0.0', '8603', '0.0.0.0', '8401', '', '', '1', '[general]\r\nio_thread_size    = 1\r\nbattle_thread_size= 4\r\nlogpath           = /data/logs/\r\nluapath           = /data/lua/\r\nlanguage          = En\r\n\r\n[battle_server]\r\nip                = 0.0.0.0\r\nport              = 8603\r\naccept_queue_size = 250\r\n\r\nio_thread_size    = 8\r\nwork_thread_init  = 8\r\nwork_thread_high  = 32\r\nwork_thread_load  = 500\r\n\r\nhandler_pool_init = 100\r\nhandler_pool_low  = 0\r\nhandler_pool_high = 500\r\nhandler_pool_inc  = 50\r\nhandler_pool_max  = 5000\r\n\r\nread_buffer_size  = 10240\r\nwrite_buffer_size = 10240\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\n\r\n[battle_balancer]\r\nip                = 0.0.0.0\r\nport              = 8401\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n[thrift_phpservice]\r\ntype              = http\r\naddress           = http://PHP-SERVER:8784/main.php?stream=\r\nport              = 9090\r\nconnect_timeout   = 10\r\nreceive_timeout   = 10\r\nsend_timeout      = 10\r\nread_buffer_size  = 10240\r\nwrite_buffer_size = 10240\r\npool_init         = 4\r\npool_low          = 0\r\npool_high         = 8\r\npool_inc          = 2\r\npool_max          = 16\r\n\r\n[monitor]\r\nip                = 127.0.0.1\r\nport              = 9010\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n\r\n[redis]\r\nip                = REDIS-SYSDB-SERVER\r\nport              = 6379', '/CONF-TESTER-01/data/apps/cpp-configs/battle.ini.d/1003/battle.ini');
INSERT INTO conf_st_battle_server VALUES ('4', '1004', '1', '37', '192.168.18.100', '192.168.18.100', 'venet0:0', 'venet0:0', '2015-07-28 10:00:00', '0.0.0.0', '8605', '0.0.0.0', '8401', '', '', '1', '[general]\r\nio_thread_size    = 1\r\nbattle_thread_size= 4\r\nlogpath           = /data/logs/\r\nluapath           = /data/lua/\r\nlanguage          = En\r\n\r\n[battle_server]\r\nip                = 0.0.0.0\r\nport              = 8605\r\naccept_queue_size = 250\r\n\r\nio_thread_size    = 8\r\nwork_thread_init  = 8\r\nwork_thread_high  = 32\r\nwork_thread_load  = 500\r\n\r\nhandler_pool_init = 100\r\nhandler_pool_low  = 0\r\nhandler_pool_high = 500\r\nhandler_pool_inc  = 50\r\nhandler_pool_max  = 5000\r\n\r\nread_buffer_size  = 10240\r\nwrite_buffer_size = 10240\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\n\r\n[battle_balancer]\r\nip                = 0.0.0.0\r\nport              = 8401\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n[thrift_phpservice]\r\ntype              = http\r\naddress           = http://PHP-SERVER:8784/main.php?stream=\r\nport              = 9090\r\nconnect_timeout   = 10\r\nreceive_timeout   = 10\r\nsend_timeout      = 10\r\nread_buffer_size  = 10240\r\nwrite_buffer_size = 10240\r\npool_init         = 4\r\npool_low          = 0\r\npool_high         = 8\r\npool_inc          = 2\r\npool_max          = 16\r\n\r\n[monitor]\r\nip                = 127.0.0.1\r\nport              = 9010\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n\r\n[redis]\r\nip                = REDIS-SYSDB-SERVER\r\nport              = 6379', '/CONF-TESTER-01/data/apps/cpp-configs/battle.ini.d/1004/battle.ini');
INSERT INTO conf_st_battle_server VALUES ('5', '1005', '1', '37', '192.168.18.100', '192.168.18.100', 'venet0:0', 'venet0:0', '2015-07-28 10:00:00', '0.0.0.0', '8605', '0.0.0.0', '8401', '', '', '1', '[general]\r\nio_thread_size    = 1\r\nbattle_thread_size= 4\r\nlogpath           = /data/logs/\r\nluapath           = /data/lua/\r\nlanguage          = En\r\n\r\n[battle_server]\r\nip                = 0.0.0.0\r\nport              = 8605\r\naccept_queue_size = 250\r\n\r\nio_thread_size    = 8\r\nwork_thread_init  = 8\r\nwork_thread_high  = 32\r\nwork_thread_load  = 500\r\n\r\nhandler_pool_init = 100\r\nhandler_pool_low  = 0\r\nhandler_pool_high = 500\r\nhandler_pool_inc  = 50\r\nhandler_pool_max  = 5000\r\n\r\nread_buffer_size  = 10240\r\nwrite_buffer_size = 10240\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\n\r\n[battle_balancer]\r\nip                = 0.0.0.0\r\nport              = 8401\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n[thrift_phpservice]\r\ntype              = http\r\naddress           = http://PHP-SERVER:8784/main.php?stream=\r\nport              = 9090\r\nconnect_timeout   = 10\r\nreceive_timeout   = 10\r\nsend_timeout      = 10\r\nread_buffer_size  = 10240\r\nwrite_buffer_size = 10240\r\npool_init         = 4\r\npool_low          = 0\r\npool_high         = 8\r\npool_inc          = 2\r\npool_max          = 16\r\n\r\n[monitor]\r\nip                = 127.0.0.1\r\nport              = 9010\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n\r\n[redis]\r\nip                = REDIS-SYSDB-SERVER\r\nport              = 6379', '/CONF-TESTER-01/data/apps/cpp-configs/battle.ini.d/1005/battle.ini');
INSERT INTO conf_st_battle_server VALUES ('6', '1006', '1', '37', '192.168.18.100', '192.168.18.100', 'venet0:0', 'venet0:0', '2015-07-28 10:00:00', '0.0.0.0', '8606', '0.0.0.0', '8401', '', '', '1', '[general]\r\nio_thread_size    = 1\r\nbattle_thread_size= 4\r\nlogpath           = /data/logs/\r\nluapath           = /data/lua/\r\nlanguage          = En\r\n\r\n[battle_server]\r\nip                = 0.0.0.0\r\nport              = 8606\r\naccept_queue_size = 250\r\n\r\nio_thread_size    = 8\r\nwork_thread_init  = 8\r\nwork_thread_high  = 32\r\nwork_thread_load  = 500\r\n\r\nhandler_pool_init = 100\r\nhandler_pool_low  = 0\r\nhandler_pool_high = 500\r\nhandler_pool_inc  = 50\r\nhandler_pool_max  = 5000\r\n\r\nread_buffer_size  = 10240\r\nwrite_buffer_size = 10240\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\n\r\n[battle_balancer]\r\nip                = 0.0.0.0\r\nport              = 8401\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n[thrift_phpservice]\r\ntype              = http\r\naddress           = http://PHP-SERVER:8784/main.php?stream=\r\nport              = 9090\r\nconnect_timeout   = 10\r\nreceive_timeout   = 10\r\nsend_timeout      = 10\r\nread_buffer_size  = 10240\r\nwrite_buffer_size = 10240\r\npool_init         = 4\r\npool_low          = 0\r\npool_high         = 8\r\npool_inc          = 2\r\npool_max          = 16\r\n\r\n[monitor]\r\nip                = 127.0.0.1\r\nport              = 9010\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n\r\n[redis]\r\nip                = REDIS-SYSDB-SERVER\r\nport              = 6379', '/CONF-TESTER-01/data/apps/cpp-configs/battle.ini.d/1006/battle.ini');
INSERT INTO conf_st_battle_server VALUES ('7', '1007', '2', '38', '192.168.18.101', '192.168.18.101', 'venet0:0', 'venet0:0', '2015-07-29 10:00:00', '0.0.0.0', '8607', '0.0.0.0', '8402', '', '', '1', '[general]\r\nio_thread_size    = 1\r\nbattle_thread_size= 4\r\nlogpath           = /data/logs/\r\nluapath           = /data/lua/\r\nlanguage          = En\r\n\r\n[battle_server]\r\nip                = 0.0.0.0\r\nport              = 8607\r\naccept_queue_size = 250\r\n\r\nio_thread_size    = 8\r\nwork_thread_init  = 8\r\nwork_thread_high  = 32\r\nwork_thread_load  = 500\r\n\r\nhandler_pool_init = 100\r\nhandler_pool_low  = 0\r\nhandler_pool_high = 500\r\nhandler_pool_inc  = 50\r\nhandler_pool_max  = 5000\r\n\r\nread_buffer_size  = 10240\r\nwrite_buffer_size = 10240\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\n\r\n[battle_balancer]\r\nip                = 0.0.0.0\r\nport              = 8402\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n[thrift_phpservice]\r\ntype              = http\r\naddress           = http://PHP-SERVER:8784/main.php?stream=\r\nport              = 9090\r\nconnect_timeout   = 10\r\nreceive_timeout   = 10\r\nsend_timeout      = 10\r\nread_buffer_size  = 10240\r\nwrite_buffer_size = 10240\r\npool_init         = 4\r\npool_low          = 0\r\npool_high         = 8\r\npool_inc          = 2\r\npool_max          = 16\r\n\r\n[monitor]\r\nip                = 127.0.0.1\r\nport              = 9010\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n\r\n[redis]\r\nip                = REDIS-SYSDB-SERVER\r\nport              = 6379', '/CONF-TESTER-02/data/apps/cpp-configs/battle.ini.d/1007/battle.ini');
INSERT INTO conf_st_battle_server VALUES ('8', '1008', '2', '38', '192.168.18.101', '192.168.18.101', 'venet0:0', 'venet0:0', '2015-07-29 10:00:00', '0.0.0.0', '8608', '0.0.0.0', '8402', '', '', '1', '[general]\r\nio_thread_size    = 1\r\nbattle_thread_size= 4\r\nlogpath           = /data/logs/\r\nluapath           = /data/lua/\r\nlanguage          = En\r\n\r\n[battle_server]\r\nip                = 0.0.0.0\r\nport              = 8608\r\naccept_queue_size = 250\r\n\r\nio_thread_size    = 8\r\nwork_thread_init  = 8\r\nwork_thread_high  = 32\r\nwork_thread_load  = 500\r\n\r\nhandler_pool_init = 100\r\nhandler_pool_low  = 0\r\nhandler_pool_high = 500\r\nhandler_pool_inc  = 50\r\nhandler_pool_max  = 5000\r\n\r\nread_buffer_size  = 10240\r\nwrite_buffer_size = 10240\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\n\r\n[battle_balancer]\r\nip                = 0.0.0.0\r\nport              = 8402\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n[thrift_phpservice]\r\ntype              = http\r\naddress           = http://PHP-SERVER:8784/main.php?stream=\r\nport              = 9090\r\nconnect_timeout   = 10\r\nreceive_timeout   = 10\r\nsend_timeout      = 10\r\nread_buffer_size  = 10240\r\nwrite_buffer_size = 10240\r\npool_init         = 4\r\npool_low          = 0\r\npool_high         = 8\r\npool_inc          = 2\r\npool_max          = 16\r\n\r\n[monitor]\r\nip                = 127.0.0.1\r\nport              = 9010\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n\r\n[redis]\r\nip                = REDIS-SYSDB-SERVER\r\nport              = 6379', '/CONF-TESTER-02/data/apps/cpp-configs/battle.ini.d/1008/battle.ini');
INSERT INTO conf_st_battle_server VALUES ('9', '1009', '2', '38', '192.168.18.101', '192.168.18.101', 'venet0:0', 'venet0:0', '2015-07-29 09:00:00', '0.0.0.0', '8609', '0.0.0.0', '8402', '', '', '1', '[general]\r\nio_thread_size    = 1\r\nbattle_thread_size= 4\r\nlogpath           = /data/logs/\r\nluapath           = /data/lua/\r\nlanguage          = En\r\n\r\n[battle_server]\r\nip                = 0.0.0.0\r\nport              = 8609\r\naccept_queue_size = 250\r\n\r\nio_thread_size    = 8\r\nwork_thread_init  = 8\r\nwork_thread_high  = 32\r\nwork_thread_load  = 500\r\n\r\nhandler_pool_init = 100\r\nhandler_pool_low  = 0\r\nhandler_pool_high = 500\r\nhandler_pool_inc  = 50\r\nhandler_pool_max  = 5000\r\n\r\nread_buffer_size  = 10240\r\nwrite_buffer_size = 10240\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\n\r\n[battle_balancer]\r\nip                = 0.0.0.0\r\nport              = 8402\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n[thrift_phpservice]\r\ntype              = http\r\naddress           = http://PHP-SERVER:8784/main.php?stream=\r\nport              = 9090\r\nconnect_timeout   = 10\r\nreceive_timeout   = 10\r\nsend_timeout      = 10\r\nread_buffer_size  = 10240\r\nwrite_buffer_size = 10240\r\npool_init         = 4\r\npool_low          = 0\r\npool_high         = 8\r\npool_inc          = 2\r\npool_max          = 16\r\n\r\n[monitor]\r\nip                = 127.0.0.1\r\nport              = 9010\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n\r\n[redis]\r\nip                = REDIS-SYSDB-SERVER\r\nport              = 6379', '/CONF-TESTER-02/data/apps/cpp-configs/battle.ini.d/1009/battle.ini');

-- ----------------------------
-- Table structure for `conf_st_battle_stronghold`
-- ----------------------------
DROP TABLE IF EXISTS `conf_st_battle_stronghold`;
CREATE TABLE `conf_st_battle_stronghold` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `battle_stronghold_host_id` int(10) unsigned NOT NULL DEFAULT '0',
  `battle_balance_host_id_support` int(10) unsigned NOT NULL DEFAULT '0',
  `server_id` int(10) unsigned NOT NULL DEFAULT '0',
  `in_ip` varchar(32) NOT NULL DEFAULT '' COMMENT '内网IP',
  `out_ip` varchar(32) NOT NULL DEFAULT '' COMMENT '外网ip',
  `in_nic_name` varchar(32) NOT NULL DEFAULT '' COMMENT '内网网卡',
  `out_nic_name` varchar(32) NOT NULL DEFAULT '' COMMENT '外网网卡',
  `open_server_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '开服时间',
  `battle_server_ip` varchar(32) NOT NULL DEFAULT '' COMMENT 'battle_server_ip',
  `battle_server_port` varchar(32) NOT NULL DEFAULT '' COMMENT 'battle_server_port',
  `battle_balancer_ip` varchar(32) NOT NULL DEFAULT '' COMMENT 'battle_balancer_ip',
  `battle_balancer_port` varchar(32) NOT NULL DEFAULT '' COMMENT 'battle_balancer_port',
  `php_service_address` varchar(32) NOT NULL DEFAULT '' COMMENT 'php_service_address',
  `php_service_port` varchar(32) NOT NULL DEFAULT '' COMMENT 'php_service_port',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态【1正常】【0关闭】',
  `battle_stronghold_ini` text NOT NULL,
  `zk_path` varchar(255) NOT NULL DEFAULT '' COMMENT 'zk_path',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of conf_st_battle_stronghold
-- ----------------------------
INSERT INTO conf_st_battle_stronghold VALUES ('1', '1001', '1', '37', '192.168.18.100', '192.168.18.100', 'venet0:0', 'venet0:0', '2015-07-30 09:00:00', '0.0.0.0', '8801', '0.0.0.0', '8401', '', '', '1', '[general]\r\ngame_zone_id      = 1001\r\nbattle_service_id = 0\r\nbattle_type       = Stronghold\r\nio_thread_size    = 1\r\nbattle_thread_size= 4\r\nlogpath           = /data/logs/\r\nluapath           = /data/lua/\r\nlanguage          = En\r\n\r\n[battle_server]\r\nip                = 0.0.0.0\r\nport              = 8801\r\naccept_queue_size = 250\r\n\r\nio_thread_size    = 8\r\nwork_thread_init  = 8\r\nwork_thread_high  = 32\r\nwork_thread_load  = 500\r\n\r\nhandler_pool_init = 100\r\nhandler_pool_low  = 0\r\nhandler_pool_high = 500\r\nhandler_pool_inc  = 50\r\nhandler_pool_max  = 5000\r\n\r\nread_buffer_size  = 10240\r\nwrite_buffer_size = 10240\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\n\r\n[battle_balancer]\r\nip                = 0.0.0.0\r\nport              = 8401\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n[monitor]\r\nip                = 127.0.0.1\r\nport              = 9010\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n[thrift_phpservice]\r\ntype              = http\r\naddress           = http://PHP-SERVER:8784/main.php?stream=\r\nport              = 9090\r\nconnect_timeout   = 10\r\nreceive_timeout   = 10\r\nsend_timeout      = 10\r\nread_buffer_size  = 10240\r\nwrite_buffer_size = 10240\r\npool_init         = 4\r\npool_low          = 0\r\npool_high         = 8\r\npool_inc          = 2\r\npool_max          = 16\r\n\r\n[redis]\r\nip                = REDIS-SYSDB-SERVER\r\nport              = 6379\r\n', '/CONF-TESTER-01/data/apps/cpp-configs/battle_stronghold.ini.d/1001/battle_stronghold.ini');

-- ----------------------------
-- Table structure for `conf_st_game_platform`
-- ----------------------------
DROP TABLE IF EXISTS `conf_st_game_platform`;
CREATE TABLE `conf_st_game_platform` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `platform_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '平台ID',
  `platform_name` varchar(64) NOT NULL DEFAULT '' COMMENT '平台名称',
  `official_site` varchar(255) NOT NULL DEFAULT '' COMMENT '官网地址',
  `desc` varchar(255) NOT NULL DEFAULT '' COMMENT '简要描述',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `sort` tinyint(2) unsigned NOT NULL DEFAULT '255' COMMENT '排序',
  `power_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '权限基于二进制的识别码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of conf_st_game_platform
-- ----------------------------
INSERT INTO conf_st_game_platform VALUES ('1', '1001', 'STAR WAR', 'http://www.demo.com/', 'DEMO', '1', '255', '2');

-- ----------------------------
-- Table structure for `conf_st_game_server`
-- ----------------------------
DROP TABLE IF EXISTS `conf_st_game_server`;
CREATE TABLE `conf_st_game_server` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `game_server_host_id` int(10) unsigned NOT NULL DEFAULT '0',
  `im_server_host_id_support` int(10) unsigned NOT NULL DEFAULT '0',
  `load_balance_host_id_support` int(10) unsigned NOT NULL DEFAULT '0',
  `battle_balance_host_id_support` int(10) unsigned NOT NULL DEFAULT '0',
  `server_id` int(10) unsigned NOT NULL DEFAULT '0',
  `in_ip` varchar(32) NOT NULL DEFAULT '' COMMENT '内网IP',
  `out_ip` varchar(32) NOT NULL DEFAULT '' COMMENT '外网ip',
  `in_nic_name` varchar(32) NOT NULL DEFAULT '' COMMENT '内网网卡',
  `out_nic_name` varchar(32) NOT NULL DEFAULT '' COMMENT '外网网卡',
  `open_server_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '开服时间',
  `game_server_ip` varchar(32) NOT NULL DEFAULT '' COMMENT 'game_server_ip',
  `game_server_network` varchar(32) NOT NULL DEFAULT '' COMMENT 'game_server_network',
  `game_server_port` varchar(32) NOT NULL DEFAULT '' COMMENT 'game_server_port',
  `load_balancer_ip` varchar(32) NOT NULL DEFAULT '' COMMENT 'load_balancer_ip',
  `load_balancer_port` varchar(32) NOT NULL DEFAULT '' COMMENT 'load_balancer_port',
  `battle_balancer_ip` varchar(32) NOT NULL DEFAULT '' COMMENT 'battle_balancer_ip',
  `battle_balancer_port` varchar(32) NOT NULL DEFAULT '' COMMENT 'battle_balancer_port',
  `cpp_service_ip` varchar(32) NOT NULL DEFAULT '' COMMENT 'cpp_service_ip',
  `cpp_service_port` varchar(32) NOT NULL DEFAULT '' COMMENT 'cpp_service_port',
  `php_service_address` varchar(32) NOT NULL DEFAULT '' COMMENT 'php_service_address',
  `php_service_port` varchar(32) NOT NULL DEFAULT '' COMMENT 'php_service_port',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态【1正常】【0关闭】',
  `game_server_xml` text NOT NULL,
  `zk_path` varchar(255) NOT NULL DEFAULT '' COMMENT 'zk_path',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of conf_st_game_server
-- ----------------------------
INSERT INTO conf_st_game_server VALUES ('1', '1001', '1', '1', '1', '37', '192.168.18.100', '192.168.18.100', 'venet0:0', 'venet0:0', '2015-07-27 09:00:00', '0.0.0.0', 'venet0:0', '8701', '127.0.0.1', '7101', '0.0.0.0', '8401', '0.0.0.0', '8301', '', '', '1', '<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n<game_server>\r\n  <general>\r\n    <service_id>1001</service_id>\r\n    <io_thread_size>1</io_thread_size>\r\n    <logpath>/data/logs/</logpath>\r\n    <language>En</language>\r\n  </general>\r\n  <server>\r\n    <network>venet0:0</network>\r\n    <ip>0.0.0.0</ip>\r\n    <port>8701</port>\r\n    <accept_queue_size>250</accept_queue_size>\r\n    <io_thread_size>4</io_thread_size>\r\n    <work_thread_init>4</work_thread_init>\r\n    <work_thread_high>16</work_thread_high>\r\n    <work_thread_load>500</work_thread_load>\r\n    <handler_pool_init>100</handler_pool_init>\r\n    <handler_pool_low>0</handler_pool_low>\r\n    <handler_pool_high>1000</handler_pool_high>\r\n    <handler_pool_inc>100</handler_pool_inc>\r\n    <handler_pool_max>5000</handler_pool_max>\r\n    <read_buffer_size>10240</read_buffer_size>\r\n    <write_buffer_size>10240</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n  </server>\r\n  <load_balancer>\r\n    <ip>127.0.0.1</ip>\r\n    <port>7101</port>\r\n    <read_buffer_size>256</read_buffer_size>\r\n    <write_buffer_size>256</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n    <retry_timeout>30</retry_timeout>\r\n    <keepalive_timeout>30</keepalive_timeout>\r\n  </load_balancer>\r\n  <battle_balancer>\r\n    <ip>0.0.0.0</ip>\r\n    <port>8401</port>\r\n    <io_thread_size>1</io_thread_size>\r\n    <handler_pool_init>10</handler_pool_init>\r\n    <handler_pool_low>0</handler_pool_low>\r\n    <handler_pool_high>50</handler_pool_high>\r\n    <handler_pool_inc>10</handler_pool_inc>\r\n    <handler_pool_max>100</handler_pool_max>\r\n    <buffer_size>256</buffer_size>\r\n    <timeout_milliseconds>3000</timeout_milliseconds>\r\n  </battle_balancer>\r\n  <battle_client>\r\n    <io_thread_size>4</io_thread_size>\r\n    <work_thread_init>4</work_thread_init>\r\n    <work_thread_high>16</work_thread_high>\r\n    <work_thread_load>500</work_thread_load>\r\n    <handler_pool_init>100</handler_pool_init>\r\n    <handler_pool_low>0</handler_pool_low>\r\n    <handler_pool_high>1000</handler_pool_high>\r\n    <handler_pool_inc>100</handler_pool_inc>\r\n    <handler_pool_max>5000</handler_pool_max>\r\n    <read_buffer_size>10240</read_buffer_size>\r\n    <write_buffer_size>10240</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n  </battle_client>\r\n  <php_game_service>\r\n    <type>http</type>\r\n    <address>http://PHP-SERVER:8784/main.php?stream=</address>\r\n    <port>9090</port>\r\n    <connect_timeout>10</connect_timeout>\r\n    <receive_timeout>10</receive_timeout>\r\n    <send_timeout>10</send_timeout>\r\n    <read_buffer_size>10240</read_buffer_size>\r\n    <write_buffer_size>10240</write_buffer_size>\r\n    <pool_init>4</pool_init>\r\n    <pool_low>0</pool_low>\r\n    <pool_high>8</pool_high>\r\n    <pool_inc>2</pool_inc>\r\n    <pool_max>16</pool_max>\r\n  </php_game_service>\r\n  <php_cross_service>\r\n    <type>http</type>\r\n    <address>http://PHP-SERVER:8784/cross.php?stream=</address>\r\n    <port>9090</port>\r\n    <connect_timeout>10</connect_timeout>\r\n    <receive_timeout>10</receive_timeout>\r\n    <send_timeout>10</send_timeout>\r\n    <read_buffer_size>10240</read_buffer_size>\r\n    <write_buffer_size>10240</write_buffer_size>\r\n    <pool_init>4</pool_init>\r\n    <pool_low>0</pool_low>\r\n    <pool_high>8</pool_high>\r\n    <pool_inc>2</pool_inc>\r\n    <pool_max>16</pool_max>\r\n  </php_cross_service>\r\n  <cpp_service>\r\n    <ip>0.0.0.0</ip>\r\n    <port>8301</port>\r\n    <accept_timeout>10000</accept_timeout>\r\n    <receive_timeout>10000</receive_timeout>\r\n    <send_timeout>10000</send_timeout>\r\n    <retry_limit>3</retry_limit>\r\n    <retry_delay>3000</retry_delay>\r\n    <tcp_send_buffer></tcp_send_buffer>\r\n    <tcp_recv_buffer></tcp_recv_buffer>\r\n  </cpp_service>\r\n  <monitor>\r\n    <ip>127.0.0.1</ip>\r\n    <port>9010</port>\r\n    <read_buffer_size>1024</read_buffer_size>\r\n    <write_buffer_size>1024</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n    <retry_timeout>30</retry_timeout>\r\n    <keepalive_timeout>30</keepalive_timeout>\r\n  </monitor>\r\n  <redis>\r\n    <sys_cache>\r\n      <ip>REDIS-SYSDB-SERVER</ip>\r\n      <port>6379</port>\r\n    </sys_cache>\r\n  </redis>\r\n</game_server>', '/CONF-TESTER-01/data/apps/cpp-configs/game_server.xml.d/1001/game_server.xml');
INSERT INTO conf_st_game_server VALUES ('2', '1002', '1', '1', '1', '37', '192.168.18.100', '192.168.18.100', 'venet0:0', 'venet0:0', '2015-07-28 10:00:00', '0.0.0.0', 'venet0:0', '8702', '127.0.0.1', '7101', '0.0.0.0', '8401', '0.0.0.0', '8301', '', '', '1', '<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n<game_server>\r\n  <general>\r\n    <service_id>1002</service_id>\r\n    <io_thread_size>1</io_thread_size>\r\n    <logpath>/data/logs/</logpath>\r\n    <language>En</language>\r\n  </general>\r\n  <server>\r\n    <network>venet0:0</network>\r\n    <ip>0.0.0.0</ip>\r\n    <port>8702</port>\r\n    <accept_queue_size>250</accept_queue_size>\r\n    <io_thread_size>4</io_thread_size>\r\n    <work_thread_init>4</work_thread_init>\r\n    <work_thread_high>16</work_thread_high>\r\n    <work_thread_load>500</work_thread_load>\r\n    <handler_pool_init>100</handler_pool_init>\r\n    <handler_pool_low>0</handler_pool_low>\r\n    <handler_pool_high>1000</handler_pool_high>\r\n    <handler_pool_inc>100</handler_pool_inc>\r\n    <handler_pool_max>5000</handler_pool_max>\r\n    <read_buffer_size>10240</read_buffer_size>\r\n    <write_buffer_size>10240</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n  </server>\r\n  <load_balancer>\r\n    <ip>127.0.0.1</ip>\r\n    <port>7101</port>\r\n    <read_buffer_size>256</read_buffer_size>\r\n    <write_buffer_size>256</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n    <retry_timeout>30</retry_timeout>\r\n    <keepalive_timeout>30</keepalive_timeout>\r\n  </load_balancer>\r\n  <battle_balancer>\r\n    <ip>0.0.0.0</ip>\r\n    <port>8401</port>\r\n    <io_thread_size>1</io_thread_size>\r\n    <handler_pool_init>10</handler_pool_init>\r\n    <handler_pool_low>0</handler_pool_low>\r\n    <handler_pool_high>50</handler_pool_high>\r\n    <handler_pool_inc>10</handler_pool_inc>\r\n    <handler_pool_max>100</handler_pool_max>\r\n    <buffer_size>256</buffer_size>\r\n    <timeout_milliseconds>3000</timeout_milliseconds>\r\n  </battle_balancer>\r\n  <php_service>\r\n    <type>http</type>\r\n    <address>http://PHP-SERVER:8784/main.php?stream=</address>\r\n    <port>9090</port>\r\n    <connect_timeout>10</connect_timeout>\r\n    <receive_timeout>10</receive_timeout>\r\n    <send_timeout>10</send_timeout>\r\n    <read_buffer_size>10240</read_buffer_size>\r\n    <write_buffer_size>10240</write_buffer_size>\r\n    <pool_init>4</pool_init>\r\n    <pool_low>0</pool_low>\r\n    <pool_high>8</pool_high>\r\n    <pool_inc>2</pool_inc>\r\n    <pool_max>16</pool_max>\r\n  </php_service>\r\n  <cpp_service>\r\n    <ip>0.0.0.0</ip>\r\n    <port>8301</port>\r\n    <accept_timeout>10000</accept_timeout>\r\n    <receive_timeout>10000</receive_timeout>\r\n    <send_timeout>10000</send_timeout>\r\n    <retry_limit>3</retry_limit>\r\n    <retry_delay>3000</retry_delay>\r\n    <tcp_send_buffer></tcp_send_buffer>\r\n    <tcp_recv_buffer></tcp_recv_buffer>\r\n  </cpp_service>\r\n  <battle_client>\r\n    <io_thread_size>4</io_thread_size>\r\n    <work_thread_init>4</work_thread_init>\r\n    <work_thread_high>16</work_thread_high>\r\n    <work_thread_load>500</work_thread_load>\r\n    <handler_pool_init>100</handler_pool_init>\r\n    <handler_pool_low>0</handler_pool_low>\r\n    <handler_pool_high>1000</handler_pool_high>\r\n    <handler_pool_inc>100</handler_pool_inc>\r\n    <handler_pool_max>5000</handler_pool_max>\r\n    <read_buffer_size>10240</read_buffer_size>\r\n    <write_buffer_size>10240</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n  </battle_client>\r\n  <monitor>\r\n    <ip>127.0.0.1</ip>\r\n    <port>9010</port>\r\n    <read_buffer_size>1024</read_buffer_size>\r\n    <write_buffer_size>1024</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n    <retry_timeout>30</retry_timeout>\r\n    <keepalive_timeout>30</keepalive_timeout>\r\n  </monitor>\r\n  <redis>\r\n    <sys_cache>\r\n      <ip>REDIS-SYSDB-SERVER</ip>\r\n      <port>6379</port>\r\n    </sys_cache>\r\n  </redis>\r\n</game_server>', '/CONF-TESTER-01/data/apps/cpp-configs/game_server.xml.d/1002/game_server.xml');
INSERT INTO conf_st_game_server VALUES ('3', '1003', '1', '1', '1', '37', '192.168.18.100', '192.168.18.100', 'venet0:0', 'venet0:0', '2015-07-28 00:00:00', '0.0.0.0', 'venet0:0', '8703', '127.0.0.1', '7101', '0.0.0.0', '8401', '0.0.0.0', '8301', '', '', '1', '<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n<game_server>\r\n  <general>\r\n    <service_id>1003</service_id>\r\n    <io_thread_size>1</io_thread_size>\r\n    <logpath>/data/logs/</logpath>\r\n    <language>En</language>\r\n  </general>\r\n  <server>\r\n    <network>venet0:0</network>\r\n    <ip>0.0.0.0</ip>\r\n    <port>8703</port>\r\n    <accept_queue_size>250</accept_queue_size>\r\n    <io_thread_size>4</io_thread_size>\r\n    <work_thread_init>4</work_thread_init>\r\n    <work_thread_high>16</work_thread_high>\r\n    <work_thread_load>500</work_thread_load>\r\n    <handler_pool_init>100</handler_pool_init>\r\n    <handler_pool_low>0</handler_pool_low>\r\n    <handler_pool_high>1000</handler_pool_high>\r\n    <handler_pool_inc>100</handler_pool_inc>\r\n    <handler_pool_max>5000</handler_pool_max>\r\n    <read_buffer_size>10240</read_buffer_size>\r\n    <write_buffer_size>10240</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n  </server>\r\n  <load_balancer>\r\n    <ip>127.0.0.1</ip>\r\n    <port>7101</port>\r\n    <read_buffer_size>256</read_buffer_size>\r\n    <write_buffer_size>256</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n    <retry_timeout>30</retry_timeout>\r\n    <keepalive_timeout>30</keepalive_timeout>\r\n  </load_balancer>\r\n  <battle_balancer>\r\n    <ip>0.0.0.0</ip>\r\n    <port>8401</port>\r\n    <io_thread_size>1</io_thread_size>\r\n    <handler_pool_init>10</handler_pool_init>\r\n    <handler_pool_low>0</handler_pool_low>\r\n    <handler_pool_high>50</handler_pool_high>\r\n    <handler_pool_inc>10</handler_pool_inc>\r\n    <handler_pool_max>100</handler_pool_max>\r\n    <buffer_size>256</buffer_size>\r\n    <timeout_milliseconds>3000</timeout_milliseconds>\r\n  </battle_balancer>\r\n  <php_service>\r\n    <type>http</type>\r\n    <address>http://PHP-SERVER:8784/main.php?stream=</address>\r\n    <port>9090</port>\r\n    <connect_timeout>10</connect_timeout>\r\n    <receive_timeout>10</receive_timeout>\r\n    <send_timeout>10</send_timeout>\r\n    <read_buffer_size>10240</read_buffer_size>\r\n    <write_buffer_size>10240</write_buffer_size>\r\n    <pool_init>4</pool_init>\r\n    <pool_low>0</pool_low>\r\n    <pool_high>8</pool_high>\r\n    <pool_inc>2</pool_inc>\r\n    <pool_max>16</pool_max>\r\n  </php_service>\r\n  <cpp_service>\r\n    <ip>0.0.0.0</ip>\r\n    <port>8301</port>\r\n    <accept_timeout>10000</accept_timeout>\r\n    <receive_timeout>10000</receive_timeout>\r\n    <send_timeout>10000</send_timeout>\r\n    <retry_limit>3</retry_limit>\r\n    <retry_delay>3000</retry_delay>\r\n    <tcp_send_buffer></tcp_send_buffer>\r\n    <tcp_recv_buffer></tcp_recv_buffer>\r\n  </cpp_service>\r\n  <battle_client>\r\n    <io_thread_size>4</io_thread_size>\r\n    <work_thread_init>4</work_thread_init>\r\n    <work_thread_high>16</work_thread_high>\r\n    <work_thread_load>500</work_thread_load>\r\n    <handler_pool_init>100</handler_pool_init>\r\n    <handler_pool_low>0</handler_pool_low>\r\n    <handler_pool_high>1000</handler_pool_high>\r\n    <handler_pool_inc>100</handler_pool_inc>\r\n    <handler_pool_max>5000</handler_pool_max>\r\n    <read_buffer_size>10240</read_buffer_size>\r\n    <write_buffer_size>10240</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n  </battle_client>\r\n  <monitor>\r\n    <ip>127.0.0.1</ip>\r\n    <port>9010</port>\r\n    <read_buffer_size>1024</read_buffer_size>\r\n    <write_buffer_size>1024</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n    <retry_timeout>30</retry_timeout>\r\n    <keepalive_timeout>30</keepalive_timeout>\r\n  </monitor>\r\n  <redis>\r\n    <sys_cache>\r\n      <ip>REDIS-SYSDB-SERVER</ip>\r\n      <port>6379</port>\r\n    </sys_cache>\r\n  </redis>\r\n</game_server>', '/CONF-TESTER-01/data/apps/cpp-configs/game_server.xml.d/1003/game_server.xml');
INSERT INTO conf_st_game_server VALUES ('4', '1004', '1', '1', '1', '37', '192.168.18.100', '192.168.18.100', 'venet0:0', 'venet0:0', '2015-07-28 00:00:00', '0.0.0.0', 'venet0:0', '8704', '127.0.0.1', '7101', '0.0.0.0', '8401', '0.0.0.0', '8301', '', '', '1', '<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n<game_server>\r\n  <general>\r\n    <service_id>1004</service_id>\r\n    <io_thread_size>1</io_thread_size>\r\n    <logpath>/data/logs/</logpath>\r\n    <language>En</language>\r\n  </general>\r\n  <server>\r\n    <network>venet0:0</network>\r\n    <ip>0.0.0.0</ip>\r\n    <port>8704</port>\r\n    <accept_queue_size>250</accept_queue_size>\r\n    <io_thread_size>4</io_thread_size>\r\n    <work_thread_init>4</work_thread_init>\r\n    <work_thread_high>16</work_thread_high>\r\n    <work_thread_load>500</work_thread_load>\r\n    <handler_pool_init>100</handler_pool_init>\r\n    <handler_pool_low>0</handler_pool_low>\r\n    <handler_pool_high>1000</handler_pool_high>\r\n    <handler_pool_inc>100</handler_pool_inc>\r\n    <handler_pool_max>5000</handler_pool_max>\r\n    <read_buffer_size>10240</read_buffer_size>\r\n    <write_buffer_size>10240</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n  </server>\r\n  <load_balancer>\r\n    <ip>127.0.0.1</ip>\r\n    <port>7101</port>\r\n    <read_buffer_size>256</read_buffer_size>\r\n    <write_buffer_size>256</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n    <retry_timeout>30</retry_timeout>\r\n    <keepalive_timeout>30</keepalive_timeout>\r\n  </load_balancer>\r\n  <battle_balancer>\r\n    <ip>0.0.0.0</ip>\r\n    <port>8401</port>\r\n    <io_thread_size>1</io_thread_size>\r\n    <handler_pool_init>10</handler_pool_init>\r\n    <handler_pool_low>0</handler_pool_low>\r\n    <handler_pool_high>50</handler_pool_high>\r\n    <handler_pool_inc>10</handler_pool_inc>\r\n    <handler_pool_max>100</handler_pool_max>\r\n    <buffer_size>256</buffer_size>\r\n    <timeout_milliseconds>3000</timeout_milliseconds>\r\n  </battle_balancer>\r\n  <php_service>\r\n    <type>http</type>\r\n    <address>http://PHP-SERVER:8784/main.php?stream=</address>\r\n    <port>9090</port>\r\n    <connect_timeout>10</connect_timeout>\r\n    <receive_timeout>10</receive_timeout>\r\n    <send_timeout>10</send_timeout>\r\n    <read_buffer_size>10240</read_buffer_size>\r\n    <write_buffer_size>10240</write_buffer_size>\r\n    <pool_init>4</pool_init>\r\n    <pool_low>0</pool_low>\r\n    <pool_high>8</pool_high>\r\n    <pool_inc>2</pool_inc>\r\n    <pool_max>16</pool_max>\r\n  </php_service>\r\n  <cpp_service>\r\n    <ip>0.0.0.0</ip>\r\n    <port>8301</port>\r\n    <accept_timeout>10000</accept_timeout>\r\n    <receive_timeout>10000</receive_timeout>\r\n    <send_timeout>10000</send_timeout>\r\n    <retry_limit>3</retry_limit>\r\n    <retry_delay>3000</retry_delay>\r\n    <tcp_send_buffer></tcp_send_buffer>\r\n    <tcp_recv_buffer></tcp_recv_buffer>\r\n  </cpp_service>\r\n  <battle_client>\r\n    <io_thread_size>4</io_thread_size>\r\n    <work_thread_init>4</work_thread_init>\r\n    <work_thread_high>16</work_thread_high>\r\n    <work_thread_load>500</work_thread_load>\r\n    <handler_pool_init>100</handler_pool_init>\r\n    <handler_pool_low>0</handler_pool_low>\r\n    <handler_pool_high>1000</handler_pool_high>\r\n    <handler_pool_inc>100</handler_pool_inc>\r\n    <handler_pool_max>5000</handler_pool_max>\r\n    <read_buffer_size>10240</read_buffer_size>\r\n    <write_buffer_size>10240</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n  </battle_client>\r\n  <monitor>\r\n    <ip>127.0.0.1</ip>\r\n    <port>9010</port>\r\n    <read_buffer_size>1024</read_buffer_size>\r\n    <write_buffer_size>1024</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n    <retry_timeout>30</retry_timeout>\r\n    <keepalive_timeout>30</keepalive_timeout>\r\n  </monitor>\r\n  <redis>\r\n    <sys_cache>\r\n      <ip>REDIS-SYSDB-SERVER</ip>\r\n      <port>6379</port>\r\n    </sys_cache>\r\n  </redis>\r\n</game_server>', '/CONF-TESTER-01/data/apps/cpp-configs/game_server.xml.d/1004/game_server.xml');
INSERT INTO conf_st_game_server VALUES ('5', '1005', '1', '1', '1', '37', '192.168.18.100', '192.168.18.100', 'venet0:0', 'venet0:0', '2015-07-28 00:00:00', '0.0.0.0', 'venet0:0', '8705', '127.0.0.1', '7101', '0.0.0.0', '8401', '0.0.0.0', '8301', '', '', '1', '<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n<game_server>\r\n  <general>\r\n    <service_id>1005</service_id>\r\n    <io_thread_size>1</io_thread_size>\r\n    <logpath>/data/logs/</logpath>\r\n    <language>En</language>\r\n  </general>\r\n  <server>\r\n    <network>venet0:0</network>\r\n    <ip>0.0.0.0</ip>\r\n    <port>8705</port>\r\n    <accept_queue_size>250</accept_queue_size>\r\n    <io_thread_size>4</io_thread_size>\r\n    <work_thread_init>4</work_thread_init>\r\n    <work_thread_high>16</work_thread_high>\r\n    <work_thread_load>500</work_thread_load>\r\n    <handler_pool_init>100</handler_pool_init>\r\n    <handler_pool_low>0</handler_pool_low>\r\n    <handler_pool_high>1000</handler_pool_high>\r\n    <handler_pool_inc>100</handler_pool_inc>\r\n    <handler_pool_max>5000</handler_pool_max>\r\n    <read_buffer_size>10240</read_buffer_size>\r\n    <write_buffer_size>10240</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n  </server>\r\n  <load_balancer>\r\n    <ip>127.0.0.1</ip>\r\n    <port>7101</port>\r\n    <read_buffer_size>256</read_buffer_size>\r\n    <write_buffer_size>256</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n    <retry_timeout>30</retry_timeout>\r\n    <keepalive_timeout>30</keepalive_timeout>\r\n  </load_balancer>\r\n  <battle_balancer>\r\n    <ip>0.0.0.0</ip>\r\n    <port>8401</port>\r\n    <io_thread_size>1</io_thread_size>\r\n    <handler_pool_init>10</handler_pool_init>\r\n    <handler_pool_low>0</handler_pool_low>\r\n    <handler_pool_high>50</handler_pool_high>\r\n    <handler_pool_inc>10</handler_pool_inc>\r\n    <handler_pool_max>100</handler_pool_max>\r\n    <buffer_size>256</buffer_size>\r\n    <timeout_milliseconds>3000</timeout_milliseconds>\r\n  </battle_balancer>\r\n  <php_service>\r\n    <type>http</type>\r\n    <address>http://PHP-SERVER:8784/main.php?stream=</address>\r\n    <port>9090</port>\r\n    <connect_timeout>10</connect_timeout>\r\n    <receive_timeout>10</receive_timeout>\r\n    <send_timeout>10</send_timeout>\r\n    <read_buffer_size>10240</read_buffer_size>\r\n    <write_buffer_size>10240</write_buffer_size>\r\n    <pool_init>4</pool_init>\r\n    <pool_low>0</pool_low>\r\n    <pool_high>8</pool_high>\r\n    <pool_inc>2</pool_inc>\r\n    <pool_max>16</pool_max>\r\n  </php_service>\r\n  <cpp_service>\r\n    <ip>0.0.0.0</ip>\r\n    <port>8301</port>\r\n    <accept_timeout>10000</accept_timeout>\r\n    <receive_timeout>10000</receive_timeout>\r\n    <send_timeout>10000</send_timeout>\r\n    <retry_limit>3</retry_limit>\r\n    <retry_delay>3000</retry_delay>\r\n    <tcp_send_buffer></tcp_send_buffer>\r\n    <tcp_recv_buffer></tcp_recv_buffer>\r\n  </cpp_service>\r\n  <battle_client>\r\n    <io_thread_size>4</io_thread_size>\r\n    <work_thread_init>4</work_thread_init>\r\n    <work_thread_high>16</work_thread_high>\r\n    <work_thread_load>500</work_thread_load>\r\n    <handler_pool_init>100</handler_pool_init>\r\n    <handler_pool_low>0</handler_pool_low>\r\n    <handler_pool_high>1000</handler_pool_high>\r\n    <handler_pool_inc>100</handler_pool_inc>\r\n    <handler_pool_max>5000</handler_pool_max>\r\n    <read_buffer_size>10240</read_buffer_size>\r\n    <write_buffer_size>10240</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n  </battle_client>\r\n  <monitor>\r\n    <ip>127.0.0.1</ip>\r\n    <port>9010</port>\r\n    <read_buffer_size>1024</read_buffer_size>\r\n    <write_buffer_size>1024</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n    <retry_timeout>30</retry_timeout>\r\n    <keepalive_timeout>30</keepalive_timeout>\r\n  </monitor>\r\n  <redis>\r\n    <sys_cache>\r\n      <ip>REDIS-SYSDB-SERVER</ip>\r\n      <port>6379</port>\r\n    </sys_cache>\r\n  </redis>\r\n</game_server>', '/CONF-TESTER-01/data/apps/cpp-configs/game_server.xml.d/1005/game_server.xml');
INSERT INTO conf_st_game_server VALUES ('6', '1006', '1', '1', '1', '37', '192.168.18.100', '192.168.18.100', 'venet0:0', 'venet0:0', '2015-07-28 00:00:00', '0.0.0.0', 'venet0:0', '8706', '127.0.0.1', '7101', '0.0.0.0', '8401', '0.0.0.0', '8301', '', '', '1', '<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n<game_server>\r\n  <general>\r\n    <service_id>1006</service_id>\r\n    <io_thread_size>1</io_thread_size>\r\n    <logpath>/data/logs/</logpath>\r\n    <language>En</language>\r\n  </general>\r\n  <server>\r\n    <network>venet0:0</network>\r\n    <ip>0.0.0.0</ip>\r\n    <port>8706</port>\r\n    <accept_queue_size>250</accept_queue_size>\r\n    <io_thread_size>4</io_thread_size>\r\n    <work_thread_init>4</work_thread_init>\r\n    <work_thread_high>16</work_thread_high>\r\n    <work_thread_load>500</work_thread_load>\r\n    <handler_pool_init>100</handler_pool_init>\r\n    <handler_pool_low>0</handler_pool_low>\r\n    <handler_pool_high>1000</handler_pool_high>\r\n    <handler_pool_inc>100</handler_pool_inc>\r\n    <handler_pool_max>5000</handler_pool_max>\r\n    <read_buffer_size>10240</read_buffer_size>\r\n    <write_buffer_size>10240</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n  </server>\r\n  <load_balancer>\r\n    <ip>127.0.0.1</ip>\r\n    <port>7101</port>\r\n    <read_buffer_size>256</read_buffer_size>\r\n    <write_buffer_size>256</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n    <retry_timeout>30</retry_timeout>\r\n    <keepalive_timeout>30</keepalive_timeout>\r\n  </load_balancer>\r\n  <battle_balancer>\r\n    <ip>0.0.0.0</ip>\r\n    <port>8401</port>\r\n    <io_thread_size>1</io_thread_size>\r\n    <handler_pool_init>10</handler_pool_init>\r\n    <handler_pool_low>0</handler_pool_low>\r\n    <handler_pool_high>50</handler_pool_high>\r\n    <handler_pool_inc>10</handler_pool_inc>\r\n    <handler_pool_max>100</handler_pool_max>\r\n    <buffer_size>256</buffer_size>\r\n    <timeout_milliseconds>3000</timeout_milliseconds>\r\n  </battle_balancer>\r\n  <php_service>\r\n    <type>http</type>\r\n    <address>http://PHP-SERVER:8784/main.php?stream=</address>\r\n    <port>9090</port>\r\n    <connect_timeout>10</connect_timeout>\r\n    <receive_timeout>10</receive_timeout>\r\n    <send_timeout>10</send_timeout>\r\n    <read_buffer_size>10240</read_buffer_size>\r\n    <write_buffer_size>10240</write_buffer_size>\r\n    <pool_init>4</pool_init>\r\n    <pool_low>0</pool_low>\r\n    <pool_high>8</pool_high>\r\n    <pool_inc>2</pool_inc>\r\n    <pool_max>16</pool_max>\r\n  </php_service>\r\n  <cpp_service>\r\n    <ip>0.0.0.0</ip>\r\n    <port>8301</port>\r\n    <accept_timeout>10000</accept_timeout>\r\n    <receive_timeout>10000</receive_timeout>\r\n    <send_timeout>10000</send_timeout>\r\n    <retry_limit>3</retry_limit>\r\n    <retry_delay>3000</retry_delay>\r\n    <tcp_send_buffer></tcp_send_buffer>\r\n    <tcp_recv_buffer></tcp_recv_buffer>\r\n  </cpp_service>\r\n  <battle_client>\r\n    <io_thread_size>4</io_thread_size>\r\n    <work_thread_init>4</work_thread_init>\r\n    <work_thread_high>16</work_thread_high>\r\n    <work_thread_load>500</work_thread_load>\r\n    <handler_pool_init>100</handler_pool_init>\r\n    <handler_pool_low>0</handler_pool_low>\r\n    <handler_pool_high>1000</handler_pool_high>\r\n    <handler_pool_inc>100</handler_pool_inc>\r\n    <handler_pool_max>5000</handler_pool_max>\r\n    <read_buffer_size>10240</read_buffer_size>\r\n    <write_buffer_size>10240</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n  </battle_client>\r\n  <monitor>\r\n    <ip>127.0.0.1</ip>\r\n    <port>9010</port>\r\n    <read_buffer_size>1024</read_buffer_size>\r\n    <write_buffer_size>1024</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n    <retry_timeout>30</retry_timeout>\r\n    <keepalive_timeout>30</keepalive_timeout>\r\n  </monitor>\r\n  <redis>\r\n    <sys_cache>\r\n      <ip>REDIS-SYSDB-SERVER</ip>\r\n      <port>6379</port>\r\n    </sys_cache>\r\n  </redis>\r\n</game_server>', '/CONF-TESTER-01/data/apps/cpp-configs/game_server.xml.d/1006/game_server.xml');
INSERT INTO conf_st_game_server VALUES ('7', '1007', '2', '2', '2', '38', '192.168.18.101', '192.168.18.101', 'venet0:0', 'venet0:0', '2015-07-29 00:00:00', '0.0.0.0', 'venet0:0', '8707', '127.0.0.1', '7102', '0.0.0.0', '8402', '0.0.0.0', '8301', '', '', '1', '<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n<game_server>\r\n  <general>\r\n    <service_id>1007</service_id>\r\n    <io_thread_size>1</io_thread_size>\r\n    <logpath>/data/logs/</logpath>\r\n    <language>En</language>\r\n  </general>\r\n  <server>\r\n    <network>venet0:0</network>\r\n    <ip>0.0.0.0</ip>\r\n    <port>8707</port>\r\n    <accept_queue_size>250</accept_queue_size>\r\n    <io_thread_size>4</io_thread_size>\r\n    <work_thread_init>4</work_thread_init>\r\n    <work_thread_high>16</work_thread_high>\r\n    <work_thread_load>500</work_thread_load>\r\n    <handler_pool_init>100</handler_pool_init>\r\n    <handler_pool_low>0</handler_pool_low>\r\n    <handler_pool_high>1000</handler_pool_high>\r\n    <handler_pool_inc>100</handler_pool_inc>\r\n    <handler_pool_max>5000</handler_pool_max>\r\n    <read_buffer_size>10240</read_buffer_size>\r\n    <write_buffer_size>10240</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n  </server>\r\n  <load_balancer>\r\n    <ip>127.0.0.1</ip>\r\n    <port>7102</port>\r\n    <read_buffer_size>256</read_buffer_size>\r\n    <write_buffer_size>256</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n    <retry_timeout>30</retry_timeout>\r\n    <keepalive_timeout>30</keepalive_timeout>\r\n  </load_balancer>\r\n  <battle_balancer>\r\n    <ip>0.0.0.0</ip>\r\n    <port>8402</port>\r\n    <io_thread_size>1</io_thread_size>\r\n    <handler_pool_init>10</handler_pool_init>\r\n    <handler_pool_low>0</handler_pool_low>\r\n    <handler_pool_high>50</handler_pool_high>\r\n    <handler_pool_inc>10</handler_pool_inc>\r\n    <handler_pool_max>100</handler_pool_max>\r\n    <buffer_size>256</buffer_size>\r\n    <timeout_milliseconds>3000</timeout_milliseconds>\r\n  </battle_balancer>\r\n  <php_service>\r\n    <type>http</type>\r\n    <address>http://PHP-SERVER:8784/main.php?stream=</address>\r\n    <port>9090</port>\r\n    <connect_timeout>10</connect_timeout>\r\n    <receive_timeout>10</receive_timeout>\r\n    <send_timeout>10</send_timeout>\r\n    <read_buffer_size>10240</read_buffer_size>\r\n    <write_buffer_size>10240</write_buffer_size>\r\n    <pool_init>4</pool_init>\r\n    <pool_low>0</pool_low>\r\n    <pool_high>8</pool_high>\r\n    <pool_inc>2</pool_inc>\r\n    <pool_max>16</pool_max>\r\n  </php_service>\r\n  <cpp_service>\r\n    <ip>0.0.0.0</ip>\r\n    <port>8301</port>\r\n    <accept_timeout>10000</accept_timeout>\r\n    <receive_timeout>10000</receive_timeout>\r\n    <send_timeout>10000</send_timeout>\r\n    <retry_limit>3</retry_limit>\r\n    <retry_delay>3000</retry_delay>\r\n    <tcp_send_buffer></tcp_send_buffer>\r\n    <tcp_recv_buffer></tcp_recv_buffer>\r\n  </cpp_service>\r\n  <battle_client>\r\n    <io_thread_size>4</io_thread_size>\r\n    <work_thread_init>4</work_thread_init>\r\n    <work_thread_high>16</work_thread_high>\r\n    <work_thread_load>500</work_thread_load>\r\n    <handler_pool_init>100</handler_pool_init>\r\n    <handler_pool_low>0</handler_pool_low>\r\n    <handler_pool_high>1000</handler_pool_high>\r\n    <handler_pool_inc>100</handler_pool_inc>\r\n    <handler_pool_max>5000</handler_pool_max>\r\n    <read_buffer_size>10240</read_buffer_size>\r\n    <write_buffer_size>10240</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n  </battle_client>\r\n  <monitor>\r\n    <ip>127.0.0.1</ip>\r\n    <port>9010</port>\r\n    <read_buffer_size>1024</read_buffer_size>\r\n    <write_buffer_size>1024</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n    <retry_timeout>30</retry_timeout>\r\n    <keepalive_timeout>30</keepalive_timeout>\r\n  </monitor>\r\n  <redis>\r\n    <sys_cache>\r\n      <ip>REDIS-SYSDB-SERVER</ip>\r\n      <port>6379</port>\r\n    </sys_cache>\r\n  </redis>\r\n</game_server>', '/CONF-TESTER-02/data/apps/cpp-configs/game_server.xml.d/1007/game_server.xml');

-- ----------------------------
-- Table structure for `conf_st_im_server`
-- ----------------------------
DROP TABLE IF EXISTS `conf_st_im_server`;
CREATE TABLE `conf_st_im_server` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `im_server_host_id` int(10) unsigned NOT NULL DEFAULT '0',
  `game_server_host_ids` varchar(255) NOT NULL DEFAULT '' COMMENT 'game_server_host_ids  数据给  gamezone',
  `server_id` int(10) unsigned NOT NULL DEFAULT '0',
  `in_ip` varchar(32) NOT NULL DEFAULT '' COMMENT '内网IP',
  `out_ip` varchar(32) NOT NULL DEFAULT '' COMMENT '外网ip',
  `in_nic_name` varchar(32) NOT NULL DEFAULT '' COMMENT '内网网卡',
  `out_nic_name` varchar(32) NOT NULL DEFAULT '' COMMENT '外网网卡',
  `open_server_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '开服时间',
  `server_im_server_ip` varchar(32) NOT NULL DEFAULT '' COMMENT 'server_im_server_ip',
  `server_im_server_network` varchar(32) NOT NULL DEFAULT '' COMMENT 'server_im_server_network',
  `server_im_server_port` varchar(32) NOT NULL DEFAULT '' COMMENT 'server_im_server_port',
  `server_im_master_ip` varchar(32) NOT NULL DEFAULT '' COMMENT 'server_im_server_ip',
  `server_im_master_port` varchar(32) NOT NULL DEFAULT '' COMMENT 'server_im_master_port',
  `server_im_loginbalancer_ip` varchar(32) NOT NULL DEFAULT '' COMMENT 'server_im_loginbalancer_ip',
  `server_im_loginbalancer_port` varchar(32) NOT NULL DEFAULT '' COMMENT 'server_im_loginbalancer_port',
  `server_im_phpservice_address` varchar(255) NOT NULL DEFAULT '' COMMENT 'server_im_phpservice_address',
  `server_im_phpservice_port` varchar(32) NOT NULL DEFAULT '' COMMENT 'server_im_phpservice_port',
  `server_im_cppservice_ip` varchar(32) NOT NULL DEFAULT '' COMMENT 'server_im_cppservice_ip',
  `server_im_cppservice_port` varchar(32) NOT NULL DEFAULT '' COMMENT 'server_im_cppservice_port',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态【1正常】【0关闭】',
  `im_server_ini` text NOT NULL,
  `zk_path` varchar(255) NOT NULL DEFAULT '' COMMENT 'zk_path',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of conf_st_im_server
-- ----------------------------
INSERT INTO conf_st_im_server VALUES ('1', '1', '1001,1002,1003,1004,1005,1006', '37', '192.168.18.100', '192.168.18.100', 'venet0:0', 'venet0:0', '2015-07-27 09:00:00', '0.0.0.0', 'venet0:0', '8201', '', '', '127.0.0.1', '7201', 'http://PHP-SERVER:8784/main.php?stream=', '9090', '0.0.0.0', '8301', '1', '[general]\r\nio_thread_size    = 1\r\nlogpath           = /data/logs/\r\ngamezone          = [1001,1002,1003,1004,1005,1006]\r\nlanguage          = En\r\n\r\n[im_server]\r\nnetwork           = venet0:0\r\nip                = 0.0.0.0\r\nport              = 8201\r\naccept_queue_size = 250\r\n\r\nio_thread_size    = 8\r\nwork_thread_init  = 8\r\nwork_thread_high  = 32\r\nwork_thread_load  = 500\r\n\r\nhandler_pool_init = 1000\r\nhandler_pool_low  = 0\r\nhandler_pool_high = 5000\r\nhandler_pool_inc  = 500\r\nhandler_pool_max  = 50000\r\n\r\nread_buffer_size  = 2048\r\nwrite_buffer_size = 2048\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\n\r\n[loginbalancer]\r\nip                = 127.0.0.1\r\nport              = 7201\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n[thrift_phpservice]\r\ntype              = http\r\naddress           = http://PHP-SERVER:8784/main.php?stream=\r\nport              = 9090\r\n\r\nconnect_timeout   = 10\r\nreceive_timeout   = 10\r\nsend_timeout      = 10\r\nread_buffer_size  = 10240\r\nwrite_buffer_size = 10240\r\npool_init         = 4\r\npool_low          = 0\r\npool_high         = 8\r\npool_inc          = 2\r\npool_max          = 16\r\n\r\n[thrift_cppservice]\r\nip                = 0.0.0.0\r\nport              = 8301\r\naccept_timeout    = 10000\r\nreceive_timeout   = 10000\r\nsend_timeout      = 10000\r\nretry_limit       = 3\r\nretry_delay       = 3000\r\ntcp_send_buffer   = 2048\r\ntcp_recv_buffer   = 2048\r\n\r\n[monitor]\r\nip                = 127.0.0.1\r\nport              = 9010\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n[im_master]\r\nip                = 127.0.0.1\r\nport              = 9300\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n[redis]\r\nip                = REDIS-SYSDB-SERVER\r\nport              = 6379', '/CONF-TESTER-01/data/apps/cpp-configs/im_server.ini');
INSERT INTO conf_st_im_server VALUES ('2', '2', '', '38', '192.168.18.101', '192.168.18.101', 'venet0:0', 'venet0:0', '2015-07-29 10:00:00', '0.0.0.0', 'venet0:0', '8202', '', '', '127.0.0.1', '7202', 'http://PHP-SERVER:8784/main.php?stream=', '9090', '0.0.0.0', '8301', '1', '[general]\r\nio_thread_size    = 1\r\nlogpath           = /data/logs/\r\ngamezone          = [3]\r\nlanguage          = En\r\n\r\n[im_server]\r\nnetwork           = venet0:0\r\nip                = 0.0.0.0\r\nport              = 8202\r\naccept_queue_size = 250\r\n\r\nio_thread_size    = 8\r\nwork_thread_init  = 8\r\nwork_thread_high  = 32\r\nwork_thread_load  = 500\r\n\r\nhandler_pool_init = 1000\r\nhandler_pool_low  = 0\r\nhandler_pool_high = 5000\r\nhandler_pool_inc  = 500\r\nhandler_pool_max  = 50000\r\n\r\nread_buffer_size  = 2048\r\nwrite_buffer_size = 2048\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\n\r\n[loginbalancer]\r\nip                = 127.0.0.1\r\nport              = 7202\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n[thrift_phpservice]\r\ntype              = http\r\naddress           = http://PHP-SERVER:8784/main.php?stream=\r\nport              = 9090\r\n\r\nconnect_timeout   = 10\r\nreceive_timeout   = 10\r\nsend_timeout      = 10\r\nread_buffer_size  = 10240\r\nwrite_buffer_size = 10240\r\npool_init         = 4\r\npool_low          = 0\r\npool_high         = 8\r\npool_inc          = 2\r\npool_max          = 16\r\n\r\n[thrift_cppservice]\r\nip                = 0.0.0.0\r\nport              = 8301\r\naccept_timeout    = 10000\r\nreceive_timeout   = 10000\r\nsend_timeout      = 10000\r\nretry_limit       = 3\r\nretry_delay       = 3000\r\ntcp_send_buffer   = 2048\r\ntcp_recv_buffer   = 2048\r\n\r\n[monitor]\r\nip                = 127.0.0.1\r\nport              = 9010\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n[im_master]\r\nip                = 127.0.0.1\r\nport              = 9300\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n[redis]\r\nip                = REDIS-SYSDB-SERVER\r\nport              = 6379', '/CONF-TESTER-02/data/apps/cpp-configs/im_server.ini');
INSERT INTO conf_st_im_server VALUES ('3', '3', '', '39', '192.168.18.102', '192.168.18.102', 'venet0:0', 'venet0:0', '2015-07-29 10:00:00', '0.0.0.0', 'venet0:0', '8203', '', '', '127.0.0.1', '7203', 'http://PHP-SERVER:8784/main.php?stream=', '9090', '0.0.0.0', '8303', '1', '[general]\r\nio_thread_size    = 1\r\nlogpath           = /data/logs/\r\ngamezone          = [3]\r\nlanguage          = En\r\n\r\n[im_server]\r\nnetwork           = venet0:0\r\nip                = 0.0.0.0\r\nport              = 8203\r\naccept_queue_size = 250\r\n\r\nio_thread_size    = 8\r\nwork_thread_init  = 8\r\nwork_thread_high  = 32\r\nwork_thread_load  = 500\r\n\r\nhandler_pool_init = 1000\r\nhandler_pool_low  = 0\r\nhandler_pool_high = 5000\r\nhandler_pool_inc  = 500\r\nhandler_pool_max  = 50000\r\n\r\nread_buffer_size  = 2048\r\nwrite_buffer_size = 2048\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\n\r\n[loginbalancer]\r\nip                = 127.0.0.1\r\nport              = 7203\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n[thrift_phpservice]\r\ntype              = http\r\naddress           = http://PHP-SERVER:8784/main.php?stream=\r\nport              = 9090\r\n\r\nconnect_timeout   = 10\r\nreceive_timeout   = 10\r\nsend_timeout      = 10\r\nread_buffer_size  = 10240\r\nwrite_buffer_size = 10240\r\npool_init         = 4\r\npool_low          = 0\r\npool_high         = 8\r\npool_inc          = 2\r\npool_max          = 16\r\n\r\n[thrift_cppservice]\r\nip                = 0.0.0.0\r\nport              = 8303\r\naccept_timeout    = 10000\r\nreceive_timeout   = 10000\r\nsend_timeout      = 10000\r\nretry_limit       = 3\r\nretry_delay       = 3000\r\ntcp_send_buffer   = 2048\r\ntcp_recv_buffer   = 2048\r\n\r\n[monitor]\r\nip                = 127.0.0.1\r\nport              = 9010\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n[im_master]\r\nip                = 127.0.0.1\r\nport              = 9300\r\nread_buffer_size  = 1024\r\nwrite_buffer_size = 1024\r\nsession_timeout   = 0\r\nio_timeout        = 60\r\nretry_timeout     = 30\r\nkeepalive_timeout = 30\r\n\r\n[redis]\r\nip                = REDIS-SYSDB-SERVER\r\nport              = 6379', '/CONF-TESTER-03/data/apps/cpp-configs/im_server.ini');

-- ----------------------------
-- Table structure for `conf_st_load_balance`
-- ----------------------------
DROP TABLE IF EXISTS `conf_st_load_balance`;
CREATE TABLE `conf_st_load_balance` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `load_balance_host_id` int(10) unsigned NOT NULL DEFAULT '0',
  `server_id` int(10) unsigned NOT NULL DEFAULT '0',
  `in_ip` varchar(32) NOT NULL DEFAULT '' COMMENT '内网IP',
  `out_ip` varchar(32) NOT NULL DEFAULT '' COMMENT '外网ip',
  `in_nic_name` varchar(32) NOT NULL DEFAULT '' COMMENT '内网网卡',
  `out_nic_name` varchar(32) NOT NULL DEFAULT '' COMMENT '外网网卡',
  `open_server_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '开服时间',
  `load_for_login_server_ip` varchar(32) NOT NULL DEFAULT '' COMMENT 'load_for_login_server_ip',
  `load_for_login_server_port` varchar(32) NOT NULL DEFAULT '' COMMENT 'load_for_login_server_port',
  `load_for_load_balance_ip` varchar(32) NOT NULL DEFAULT '' COMMENT 'load_for_load_balance_ip',
  `load_for_load_balance_port` varchar(32) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态【1正常】【0关闭】',
  `load_balancer_xml` text NOT NULL,
  `zk_path` varchar(255) NOT NULL DEFAULT '' COMMENT 'zk_path',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of conf_st_load_balance
-- ----------------------------
INSERT INTO conf_st_load_balance VALUES ('1', '1', '37', '192.168.18.100', '192.168.18.100', 'venet0:0', 'venet0:0', '2015-07-27 09:00:00', '0.0.0.0', '8101', '127.0.0.1', '7101', '1', '﻿<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n<loadbalancer>\r\n  <general>\r\n    <io_thread_size>1</io_thread_size>\r\n    <logpath>/data/logs/</logpath>\r\n  </general>\r\n  <login_server>\r\n    <ip>0.0.0.0</ip>\r\n    <port>8101</port>\r\n    <accept_queue_size>50</accept_queue_size>\r\n    <io_thread_size>4</io_thread_size>\r\n    <work_thread_init>4</work_thread_init>\r\n    <work_thread_high>8</work_thread_high>\r\n    <work_thread_load>500</work_thread_load>\r\n    <handler_pool_init>100</handler_pool_init>\r\n    <handler_pool_low>0</handler_pool_low>\r\n    <handler_pool_high>5000</handler_pool_high>\r\n    <handler_pool_inc>100</handler_pool_inc>\r\n    <handler_pool_max>50000</handler_pool_max>\r\n    <read_buffer_size>256</read_buffer_size>\r\n    <write_buffer_size>256</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n  </login_server>\r\n  <load_balancer>\r\n    <ip>127.0.0.1</ip>\r\n    <port>7101</port>\r\n    <accept_queue_size>4</accept_queue_size>\r\n    <io_thread_size>1</io_thread_size>\r\n    <work_thread_init>1</work_thread_init>\r\n    <work_thread_high>2</work_thread_high>\r\n    <work_thread_load>100</work_thread_load>\r\n    <handler_pool_init>10</handler_pool_init>\r\n    <handler_pool_low>0</handler_pool_low>\r\n    <handler_pool_high>100</handler_pool_high>\r\n    <handler_pool_inc>10</handler_pool_inc>\r\n    <handler_pool_max>500</handler_pool_max>\r\n    <read_buffer_size>1024</read_buffer_size>\r\n    <write_buffer_size>256</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n  </load_balancer>\r\n  <monitor>\r\n    <ip>127.0.0.1</ip>\r\n    <port>9010</port>\r\n    <read_buffer_size>1024</read_buffer_size>\r\n    <write_buffer_size>1024</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n    <retry_timeout>30</retry_timeout>\r\n    <keepalive_timeout>30</keepalive_timeout>\r\n  </monitor>\r\n</loadbalancer>', '/CONF-TESTER-01/data/apps/cpp-configs/load_balancer.xml');
INSERT INTO conf_st_load_balance VALUES ('2', '2', '38', '192.168.18.101', '192.168.18.101', 'venet0:0', 'venet0:0', '2015-07-27 09:00:00', '0.0.0.0', '8102', '127.0.0.1', '7102', '1', '﻿<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n<loadbalancer>\r\n  <general>\r\n    <io_thread_size>1</io_thread_size>\r\n    <logpath>/data/logs/</logpath>\r\n  </general>\r\n  <login_server>\r\n    <ip>0.0.0.0</ip>\r\n    <port>8102</port>\r\n    <accept_queue_size>50</accept_queue_size>\r\n    <io_thread_size>4</io_thread_size>\r\n    <work_thread_init>4</work_thread_init>\r\n    <work_thread_high>8</work_thread_high>\r\n    <work_thread_load>500</work_thread_load>\r\n    <handler_pool_init>100</handler_pool_init>\r\n    <handler_pool_low>0</handler_pool_low>\r\n    <handler_pool_high>5000</handler_pool_high>\r\n    <handler_pool_inc>100</handler_pool_inc>\r\n    <handler_pool_max>50000</handler_pool_max>\r\n    <read_buffer_size>256</read_buffer_size>\r\n    <write_buffer_size>256</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n  </login_server>\r\n  <load_balancer>\r\n    <ip>127.0.0.1</ip>\r\n    <port>7102</port>\r\n    <accept_queue_size>4</accept_queue_size>\r\n    <io_thread_size>1</io_thread_size>\r\n    <work_thread_init>1</work_thread_init>\r\n    <work_thread_high>2</work_thread_high>\r\n    <work_thread_load>100</work_thread_load>\r\n    <handler_pool_init>10</handler_pool_init>\r\n    <handler_pool_low>0</handler_pool_low>\r\n    <handler_pool_high>100</handler_pool_high>\r\n    <handler_pool_inc>10</handler_pool_inc>\r\n    <handler_pool_max>500</handler_pool_max>\r\n    <read_buffer_size>1024</read_buffer_size>\r\n    <write_buffer_size>256</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n  </load_balancer>\r\n  <monitor>\r\n    <ip>127.0.0.1</ip>\r\n    <port>9010</port>\r\n    <read_buffer_size>1024</read_buffer_size>\r\n    <write_buffer_size>1024</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n    <retry_timeout>30</retry_timeout>\r\n    <keepalive_timeout>30</keepalive_timeout>\r\n  </monitor>\r\n</loadbalancer>', '/CONF-TESTER-02/data/apps/cpp-configs/load_balancer.xml');
INSERT INTO conf_st_load_balance VALUES ('3', '3', '39', '192.168.18.102', '192.168.18.102', 'venet0:0', 'venet0:0', '2015-07-27 09:00:00', '0.0.0.0', '8103', '127.0.0.1', '7103', '1', '﻿<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n<loadbalancer>\r\n  <general>\r\n    <io_thread_size>1</io_thread_size>\r\n    <logpath>/data/logs/</logpath>\r\n  </general>\r\n  <login_server>\r\n    <ip>0.0.0.0</ip>\r\n    <port>8103</port>\r\n    <accept_queue_size>50</accept_queue_size>\r\n    <io_thread_size>4</io_thread_size>\r\n    <work_thread_init>4</work_thread_init>\r\n    <work_thread_high>8</work_thread_high>\r\n    <work_thread_load>500</work_thread_load>\r\n    <handler_pool_init>100</handler_pool_init>\r\n    <handler_pool_low>0</handler_pool_low>\r\n    <handler_pool_high>5000</handler_pool_high>\r\n    <handler_pool_inc>100</handler_pool_inc>\r\n    <handler_pool_max>50000</handler_pool_max>\r\n    <read_buffer_size>256</read_buffer_size>\r\n    <write_buffer_size>256</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n  </login_server>\r\n  <load_balancer>\r\n    <ip>127.0.0.1</ip>\r\n    <port>7103</port>\r\n    <accept_queue_size>4</accept_queue_size>\r\n    <io_thread_size>1</io_thread_size>\r\n    <work_thread_init>1</work_thread_init>\r\n    <work_thread_high>2</work_thread_high>\r\n    <work_thread_load>100</work_thread_load>\r\n    <handler_pool_init>10</handler_pool_init>\r\n    <handler_pool_low>0</handler_pool_low>\r\n    <handler_pool_high>100</handler_pool_high>\r\n    <handler_pool_inc>10</handler_pool_inc>\r\n    <handler_pool_max>500</handler_pool_max>\r\n    <read_buffer_size>1024</read_buffer_size>\r\n    <write_buffer_size>256</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n  </load_balancer>\r\n  <monitor>\r\n    <ip>127.0.0.1</ip>\r\n    <port>9010</port>\r\n    <read_buffer_size>1024</read_buffer_size>\r\n    <write_buffer_size>1024</write_buffer_size>\r\n    <session_timeout>0</session_timeout>\r\n    <io_timeout>60</io_timeout>\r\n    <retry_timeout>30</retry_timeout>\r\n    <keepalive_timeout>30</keepalive_timeout>\r\n  </monitor>\r\n</loadbalancer>', '/CONF-TESTER-03/data/apps/cpp-configs/load_balancer.xml');

-- ----------------------------
-- Table structure for `conf_st_server`
-- ----------------------------
DROP TABLE IF EXISTS `conf_st_server`;
CREATE TABLE `conf_st_server` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `server_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '服务器ID',
  `server_name` varchar(32) NOT NULL DEFAULT '' COMMENT '服务器名称',
  `platform_id` tinyint(2) NOT NULL DEFAULT '0' COMMENT '所属平台ID【关联平台表】',
  `desc` varchar(255) NOT NULL DEFAULT '' COMMENT '服务器描述',
  `in_ip` varchar(32) NOT NULL DEFAULT '' COMMENT '内网IP',
  `out_ip` varchar(32) NOT NULL DEFAULT '' COMMENT '外网IP',
  `in_nic_name` varchar(32) NOT NULL DEFAULT '' COMMENT '内网网卡名',
  `out_nic_name` varchar(32) NOT NULL DEFAULT '' COMMENT '外网网卡名',
  `sort` tinyint(2) unsigned NOT NULL DEFAULT '255' COMMENT 'sort',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `IDX_SERVER_ID` (`server_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of conf_st_server
-- ----------------------------
INSERT INTO conf_st_server VALUES ('37', '1', 'CONF-TESTER-01', '1', 'ST test.1 server CONF-TESTER-01', '192.168.18.100', '192.168.18.100', 'venet0:0', 'venet0:0', '255', '1');
INSERT INTO conf_st_server VALUES ('38', '2', 'CONF-TESTER-02', '1', 'ST test.2 server CONF-TESTER-02', '192.168.18.101', '192.168.18.101', 'venet0:0', 'venet0:0', '255', '1');
INSERT INTO conf_st_server VALUES ('39', '3', 'CONF-TESTER-03', '1', 'ST test.3 server CONF-TESTER-03', '192.168.18.102', '192.168.18.102', 'venet0:0', 'venet0:0', '255', '1');
