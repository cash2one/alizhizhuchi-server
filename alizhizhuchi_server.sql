/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50712
 Source Host           : localhost
 Source Database       : alizhizhuchi_server

 Target Server Type    : MySQL
 Target Server Version : 50712
 File Encoding         : utf-8

 Date: 07/24/2016 23:34:25 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `admin`
-- ----------------------------
BEGIN;
INSERT INTO `admin` VALUES ('1', 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b');
COMMIT;

-- ----------------------------
--  Table structure for `domain`
-- ----------------------------
DROP TABLE IF EXISTS `domain`;
CREATE TABLE `domain` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `startdate` int(11) NOT NULL,
  `vip_id` int(11) NOT NULL DEFAULT '1',
  `login_time` int(11) DEFAULT NULL,
  `ok` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `enddate` int(11) NOT NULL,
  `domain_num` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `domain`
-- ----------------------------
BEGIN;
INSERT INTO `domain` VALUES ('8', 'bG9jYWxob3N0', '1469285544', '5', null, '1', '1469808000', '2'), ('9', 'YWxpLnhpYW56aGlodWxpYW4uY29t', '1469286112', '1', null, '1', '1474387200', null);
COMMIT;

-- ----------------------------
--  Table structure for `gengxin`
-- ----------------------------
DROP TABLE IF EXISTS `gengxin`;
CREATE TABLE `gengxin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `date` int(11) NOT NULL,
  `detail` text,
  `zip` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `gengxin`
-- ----------------------------
BEGIN;
INSERT INTO `gengxin` VALUES ('1', '1.2.1', '1468480930', '添加服务器验证', '/update/update_1_2_1.zip');
COMMIT;

-- ----------------------------
--  Table structure for `gonggao`
-- ----------------------------
DROP TABLE IF EXISTS `gonggao`;
CREATE TABLE `gonggao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `gonggao`
-- ----------------------------
BEGIN;
INSERT INTO `gonggao` VALUES ('1', '欢迎大家使用阿里蜘蛛池！！', 'http://www.alizhizhuchi.top/', '1469285195');
COMMIT;

-- ----------------------------
--  Table structure for `spider`
-- ----------------------------
DROP TABLE IF EXISTS `spider`;
CREATE TABLE `spider` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `domain_id` int(10) NOT NULL,
  `spider_num` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `spider`
-- ----------------------------
BEGIN;
INSERT INTO `spider` VALUES ('1', '8', '10', '1469341326');
COMMIT;

-- ----------------------------
--  Table structure for `templates`
-- ----------------------------
DROP TABLE IF EXISTS `templates`;
CREATE TABLE `templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `date` int(11) NOT NULL,
  `detail` text,
  `zip` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `templates`
-- ----------------------------
BEGIN;
INSERT INTO `templates` VALUES ('1', 'moban1', '1468471343', '模板一', '/templates/moban1.zip', '/templates/moban1_thumb.jpg'), ('2', 'moban2', '1468471343', '模板二', '/templates/moban2.zip', '/templates/moban2_thumb.jpg'), ('3', 'moban3', '1468471343', '模板三', '/templates/moban3.zip', '/templates/moban3_thumb.jpg'), ('4', 'moban4', '1468983936', '模板四', '/templates/moban4.zip', '/templates/moban4_thumb.jpg'), ('5', 'moban5', '1469333450', '模板五', '/templates/moban5.zip', '/templates/moban5_thumb.jpg'), ('6', 'moban6', '1469333899', '模板六', '/templates/moban6.zip', '/templates/moban6_thumb.jpg'), ('7', 'moban7', '1469333971', '模板七', '/templates/moban7.zip', '/templates/moban7_thumb.jpg'), ('8', 'moban8', '1469334038', '模板八', '/templates/moban8.zip', '/templates/moban8_thumb.jpg');
COMMIT;

-- ----------------------------
--  Table structure for `vip`
-- ----------------------------
DROP TABLE IF EXISTS `vip`;
CREATE TABLE `vip` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '1',
  `domain` int(11) NOT NULL,
  `templates` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `vip`
-- ----------------------------
BEGIN;
INSERT INTO `vip` VALUES ('1', 'VIP 1', '50', '5', ''), ('3', 'VIP 2', '100', '10', ''), ('4', 'VIP 3', '300', '20', ''), ('5', 'VIP 4', '600', '50', '');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
