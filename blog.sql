/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50720
Source Host           : localhost:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50720
File Encoding         : 65001

Date: 2018-04-26 18:45:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for blog_admin
-- ----------------------------
DROP TABLE IF EXISTS `blog_admin`;
CREATE TABLE `blog_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员id',
  `admin_name` varchar(32) NOT NULL DEFAULT '' COMMENT '管理员帐号',
  `admin_pass` char(64) DEFAULT NULL COMMENT '管理员密码',
  `original_pass` varchar(128) NOT NULL DEFAULT '' COMMENT '不加密密码',
  `admin_email` varchar(128) NOT NULL DEFAULT '' COMMENT '管理员邮箱',
  `admin_real` varchar(62) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `admin_mobile` char(11) NOT NULL DEFAULT '' COMMENT '管理员手机号',
  `admin_qq` varchar(255) NOT NULL DEFAULT '' COMMENT '管理员QQ号',
  `login_time` datetime DEFAULT NULL COMMENT '上次登录时间',
  `created_at` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`admin_id`),
  KEY `name_pass` (`admin_name`,`admin_pass`),
  KEY `email` (`admin_email`,`admin_pass`),
  KEY `mobile` (`admin_mobile`,`admin_pass`),
  KEY `qq` (`admin_qq`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Table structure for blog_admin_login_log
-- ----------------------------
DROP TABLE IF EXISTS `blog_admin_login_log`;
CREATE TABLE `blog_admin_login_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '记录id',
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '管理员id',
  `ip` int(11) DEFAULT NULL COMMENT '登录ip',
  `address` varchar(64) DEFAULT NULL COMMENT '登录地点',
  `created_at` int(10) DEFAULT NULL COMMENT '登录时间',
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Table structure for blog_auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `blog_auth_assignment`;
CREATE TABLE `blog_auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `auth_assignment_user_id_idx` (`user_id`),
  CONSTRAINT `blog_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `blog_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for blog_auth_item
-- ----------------------------
DROP TABLE IF EXISTS `blog_auth_item`;
CREATE TABLE `blog_auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT '标识',
  `type` smallint(6) NOT NULL COMMENT '类型1用户2节点',
  `description` text COLLATE utf8_unicode_ci COMMENT '描述',
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '规则',
  `data` blob COMMENT '数据',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `blog_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `blog_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for blog_auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `blog_auth_item_child`;
CREATE TABLE `blog_auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `blog_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `blog_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `blog_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `blog_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for blog_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `blog_auth_rule`;
CREATE TABLE `blog_auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for blog_migration
-- ----------------------------
DROP TABLE IF EXISTS `blog_migration`;
CREATE TABLE `blog_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for blog_user
-- ----------------------------
DROP TABLE IF EXISTS `blog_user`;
CREATE TABLE `blog_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
