/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50720
Source Host           : localhost:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50720
File Encoding         : 65001

Date: 2018-05-11 21:10:25
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of blog_admin
-- ----------------------------
INSERT INTO `blog_admin` VALUES ('1', 'admin', '$2y$13$JKWhqzUYf3LThLFcBMZqveiKRhU3.gu2RKBh.nswe/DX5/jHNLRFW', '789456', 'admin@admin.cn', '', '15590860585', '', '2018-05-10 12:08:04', '1524306970', '1525881717');
INSERT INTO `blog_admin` VALUES ('2', 'bdmin', '$2y$13$oeM5WIA87ESUDVK6Iwn1LOg62DYUajQVkE1vC8X/7VL4aTQFmBisa', '123456', 'dingtongchuan@outlook.com', '', '13645845789', '', '2018-04-26 19:15:30', '1524727196', '1524727196');
INSERT INTO `blog_admin` VALUES ('3', 'cdmin', '$2y$13$1r7HZ4RdsPTNjQ7OoVXJYe3NZM6KnCif8KExQHyI25RL62ZHh2EDe', '654321', '759080442@qq.com', '赵发', '13645845787', '7894562', '2018-05-10 00:12:31', '1524727231', '1525882328');

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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of blog_admin_login_log
-- ----------------------------
INSERT INTO `blog_admin_login_log` VALUES ('2', '3', '2130706433', null, '1524741822');
INSERT INTO `blog_admin_login_log` VALUES ('3', '3', '2130706433', null, '1524752160');
INSERT INTO `blog_admin_login_log` VALUES ('4', '1', '2130706433', null, '1525265204');
INSERT INTO `blog_admin_login_log` VALUES ('5', '1', '2130706433', null, '1525880273');
INSERT INTO `blog_admin_login_log` VALUES ('6', '1', '2130706433', null, '1525881616');
INSERT INTO `blog_admin_login_log` VALUES ('7', '1', '2130706433', null, '1525881702');
INSERT INTO `blog_admin_login_log` VALUES ('8', '3', '2130706433', null, '1525882351');
INSERT INTO `blog_admin_login_log` VALUES ('9', '1', '2130706433', null, '1525882857');
INSERT INTO `blog_admin_login_log` VALUES ('10', '1', '2130706433', null, '1525925284');

-- ----------------------------
-- Table structure for blog_article
-- ----------------------------
DROP TABLE IF EXISTS `blog_article`;
CREATE TABLE `blog_article` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章主键',
  `title` varchar(32) NOT NULL DEFAULT '' COMMENT '文章标题',
  `category_id` varchar(10) NOT NULL DEFAULT '0' COMMENT '文章分类',
  `author_id` int(11) NOT NULL DEFAULT '0' COMMENT '作者',
  `intro` varchar(100) NOT NULL DEFAULT '' COMMENT '文章简介',
  `content` text COMMENT '文章内容',
  `hot` int(11) NOT NULL DEFAULT '0' COMMENT '点击量',
  `comment_total` int(11) NOT NULL DEFAULT '0' COMMENT '评论数',
  `article_label_id` varchar(128) NOT NULL DEFAULT '' COMMENT '标签',
  `is_comment` tinyint(1) NOT NULL DEFAULT '2' COMMENT '是否允许回复2允许3不允许',
  `is_del` tinyint(1) NOT NULL DEFAULT '2' COMMENT '是否删除2正常3删除',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章表';

-- ----------------------------
-- Records of blog_article
-- ----------------------------

-- ----------------------------
-- Table structure for blog_article_comment
-- ----------------------------
DROP TABLE IF EXISTS `blog_article_comment`;
CREATE TABLE `blog_article_comment` (
  `article_comment_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章评论主键',
  `article_id` int(11) NOT NULL DEFAULT '0' COMMENT '文章id',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '评论人',
  `content` text COMMENT '评论内容',
  `is_del` tinyint(1) NOT NULL DEFAULT '2' COMMENT '是否删除2正常3删除',
  `created_at` int(11) NOT NULL COMMENT '评论时间',
  `updated_at` int(11) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`article_comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章评论表';

-- ----------------------------
-- Records of blog_article_comment
-- ----------------------------

-- ----------------------------
-- Table structure for blog_article_label
-- ----------------------------
DROP TABLE IF EXISTS `blog_article_label`;
CREATE TABLE `blog_article_label` (
  `article_label_id` smallint(6) NOT NULL AUTO_INCREMENT COMMENT '文章标签',
  `name` varchar(10) NOT NULL DEFAULT '' COMMENT '标签内容',
  `class` varchar(24) NOT NULL DEFAULT '' COMMENT '颜色类名',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`article_label_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章标签表';

-- ----------------------------
-- Records of blog_article_label
-- ----------------------------

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
-- Records of blog_auth_assignment
-- ----------------------------

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
-- Records of blog_auth_item
-- ----------------------------
INSERT INTO `blog_auth_item` VALUES ('admin', '1', '超级管理员', null, null, '1524487421', '1524487421');
INSERT INTO `blog_auth_item` VALUES ('Admin/Add', '2', 'Admin/Add', null, null, '1524495147', '1524495147');
INSERT INTO `blog_auth_item` VALUES ('Admin/List', '2', 'Admin/List', null, null, '1525266369', '1525266369');
INSERT INTO `blog_auth_item` VALUES ('Admin/My', '2', 'Admin/My', null, null, '1525266369', '1525266369');
INSERT INTO `blog_auth_item` VALUES ('Admin/Pass', '2', 'Admin/Pass', null, null, '1525266369', '1525266369');
INSERT INTO `blog_auth_item` VALUES ('Admin/Redis', '2', 'Admin/Redis', null, null, '1525266369', '1525266369');
INSERT INTO `blog_auth_item` VALUES ('admin1', '1', '1号管理员', null, null, '1524566464', '1524566464');
INSERT INTO `blog_auth_item` VALUES ('admin2', '1', '2号管理员', null, null, '1524566473', '1524566473');
INSERT INTO `blog_auth_item` VALUES ('Permission/AssignItem', '2', 'Permission/AssignItem', null, null, '1525266369', '1525266369');
INSERT INTO `blog_auth_item` VALUES ('Permission/RoleCreate', '2', 'Permission/RoleCreate', null, null, '1524495281', '1524495281');
INSERT INTO `blog_auth_item` VALUES ('Permission/Roles', '2', 'Permission/Roles', null, null, '1524495281', '1524495281');
INSERT INTO `blog_auth_item` VALUES ('Site/FindPass', '2', 'Site/FindPass', null, null, '1525266369', '1525266369');
INSERT INTO `blog_auth_item` VALUES ('Site/Index', '2', 'Site/Index', null, null, '1524495281', '1524495281');
INSERT INTO `blog_auth_item` VALUES ('Site/Login', '2', 'Site/Login', null, null, '1524495281', '1524495281');
INSERT INTO `blog_auth_item` VALUES ('Site/Logout', '2', 'Site/Logout', null, null, '1524495281', '1524495281');

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
-- Records of blog_auth_item_child
-- ----------------------------
INSERT INTO `blog_auth_item_child` VALUES ('admin', 'Admin/Add');
INSERT INTO `blog_auth_item_child` VALUES ('admin', 'admin2');

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
-- Records of blog_auth_rule
-- ----------------------------

-- ----------------------------
-- Table structure for blog_category
-- ----------------------------
DROP TABLE IF EXISTS `blog_category`;
CREATE TABLE `blog_category` (
  `category_id` smallint(6) NOT NULL AUTO_INCREMENT COMMENT '文章分类主键',
  `category_name` varchar(20) NOT NULL DEFAULT '' COMMENT '分类名称',
  `parent_id` smallint(6) NOT NULL DEFAULT '0' COMMENT '上级id',
  `hot` tinyint(1) NOT NULL DEFAULT '2' COMMENT '是否热门2否3是',
  `praise_comment` int(11) NOT NULL DEFAULT '0' COMMENT '点赞数',
  `is_show` tinyint(1) NOT NULL DEFAULT '2' COMMENT '是否删除2正常3删除',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章分类表';

-- ----------------------------
-- Records of blog_category
-- ----------------------------

-- ----------------------------
-- Table structure for blog_email_log
-- ----------------------------
DROP TABLE IF EXISTS `blog_email_log`;
CREATE TABLE `blog_email_log` (
  `email_log_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `email` varchar(128) DEFAULT NULL COMMENT '收件人邮箱',
  `token` char(41) DEFAULT NULL COMMENT '找回密码token',
  `send_type` tinyint(1) NOT NULL DEFAULT '2' COMMENT '2管理员找回密码3用户找回密码',
  `status` tinyint(1) DEFAULT '2' COMMENT '是否以修改2未修改3已修改',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`email_log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='邮件发送日志';

-- ----------------------------
-- Records of blog_email_log
-- ----------------------------
INSERT INTO `blog_email_log` VALUES ('7', '759080442@qq.com', 'b606429f5394c090d623ef1f0be9c86b7d65dadc', '2', '3', '1525882041');

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
-- Records of blog_migration
-- ----------------------------
INSERT INTO `blog_migration` VALUES ('m000000_000000_base', '1524467747');
INSERT INTO `blog_migration` VALUES ('m130524_201442_init', '1524469515');
INSERT INTO `blog_migration` VALUES ('m140506_102106_rbac_init', '1524467944');
INSERT INTO `blog_migration` VALUES ('m170907_052038_rbac_add_index_on_auth_assignment_user_id', '1524467944');

-- ----------------------------
-- Table structure for blog_navication
-- ----------------------------
DROP TABLE IF EXISTS `blog_navication`;
CREATE TABLE `blog_navication` (
  `navication_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '导航主键',
  `name` varchar(10) NOT NULL DEFAULT '' COMMENT '导航名称',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '导航链接',
  `sort` tinyint(1) NOT NULL DEFAULT '1' COMMENT '导航排序',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`navication_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='导航表';

-- ----------------------------
-- Records of blog_navication
-- ----------------------------

-- ----------------------------
-- Table structure for blog_praise
-- ----------------------------
DROP TABLE IF EXISTS `blog_praise`;
CREATE TABLE `blog_praise` (
  `praise_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '点赞标题',
  `article_id` int(11) NOT NULL DEFAULT '0' COMMENT '文章id',
  `type` tinyint(1) NOT NULL DEFAULT '2' COMMENT '点赞类型2顶3踩',
  PRIMARY KEY (`praise_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章点赞表';

-- ----------------------------
-- Records of blog_praise
-- ----------------------------

-- ----------------------------
-- Table structure for blog_praise_comment
-- ----------------------------
DROP TABLE IF EXISTS `blog_praise_comment`;
CREATE TABLE `blog_praise_comment` (
  `praise_comment_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '点赞标题',
  `article_comment_id` int(11) NOT NULL DEFAULT '0' COMMENT '文章id',
  `type` tinyint(1) NOT NULL DEFAULT '2' COMMENT '点赞类型2顶3踩',
  PRIMARY KEY (`praise_comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章回复点赞表';

-- ----------------------------
-- Records of blog_praise_comment
-- ----------------------------

-- ----------------------------
-- Table structure for blog_reply
-- ----------------------------
DROP TABLE IF EXISTS `blog_reply`;
CREATE TABLE `blog_reply` (
  `reply_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论回复主键',
  `article_id` int(11) NOT NULL DEFAULT '0' COMMENT '文章id',
  `article_comment_id` int(11) NOT NULL DEFAULT '0' COMMENT '文章评论id',
  `relpy_content` text COMMENT '回复内容',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '回复人id',
  `author_id` int(11) NOT NULL DEFAULT '0' COMMENT '被回复人id',
  `is_del` tinyint(1) NOT NULL DEFAULT '2' COMMENT '是否删除2正常3删除',
  `created_at` int(11) NOT NULL COMMENT '回复时间',
  `updated_at` int(11) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`reply_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评论回复表';

-- ----------------------------
-- Records of blog_reply
-- ----------------------------

-- ----------------------------
-- Table structure for blog_setting
-- ----------------------------
DROP TABLE IF EXISTS `blog_setting`;
CREATE TABLE `blog_setting` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '配置项主键',
  `KEY` varchar(128) NOT NULL DEFAULT '' COMMENT '配置项键',
  `value` varchar(255) NOT NULL DEFAULT '' COMMENT '配置项值',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='网站配置项表';

-- ----------------------------
-- Records of blog_setting
-- ----------------------------

-- ----------------------------
-- Table structure for blog_suggest
-- ----------------------------
DROP TABLE IF EXISTS `blog_suggest`;
CREATE TABLE `blog_suggest` (
  `suggest_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '投诉建议主键',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `content` text COMMENT '投诉内容',
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '管理员id',
  `reply` text COMMENT '回复内容',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`suggest_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='投诉建议表';

-- ----------------------------
-- Records of blog_suggest
-- ----------------------------

-- ----------------------------
-- Table structure for blog_user
-- ----------------------------
DROP TABLE IF EXISTS `blog_user`;
CREATE TABLE `blog_user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户主键',
  `username` varchar(128) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(60) NOT NULL DEFAULT '' COMMENT '用户密码',
  `email` varchar(128) NOT NULL DEFAULT '' COMMENT '绑定邮箱',
  `mobile` char(11) NOT NULL DEFAULT '' COMMENT '绑定手机',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别2男3女',
  `age` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '年龄',
  `via` varchar(64) NOT NULL DEFAULT '' COMMENT '用户头像',
  `signature` varchar(255) DEFAULT NULL COMMENT '个性签名',
  `integral` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '积分',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `mobile` (`mobile`),
  KEY `user_pass` (`username`,`password`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of blog_user
-- ----------------------------
