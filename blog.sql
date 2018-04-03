/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50720
Source Host           : localhost:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50720
File Encoding         : 65001

Date: 2018-04-02 20:36:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for blog_admin
-- ----------------------------
DROP TABLE IF EXISTS `blog_admin`;
CREATE TABLE `blog_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员id',
  `admin_name` varchar(32) NOT NULL DEFAULT '' COMMENT '管理员帐号',
  `admin_pass` char(32) DEFAULT NULL COMMENT '管理员密码',
  `original_pass` varchar(128) NOT NULL DEFAULT '' COMMENT '不加密密码',
  `admin_email` varchar(128) NOT NULL DEFAULT '' COMMENT '管理员邮箱',
  `admin_real` varchar(62) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `admin_mobile` char(11) NOT NULL DEFAULT '' COMMENT '管理员手机号',
  `admin_qq` varchar(255) NOT NULL DEFAULT '' COMMENT '管理员QQ号',
  `create_at` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_at` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`admin_id`),
  KEY `name_pass` (`admin_name`,`admin_pass`),
  KEY `email` (`admin_email`,`admin_pass`),
  KEY `mobile` (`admin_mobile`,`admin_pass`),
  KEY `qq` (`admin_qq`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
