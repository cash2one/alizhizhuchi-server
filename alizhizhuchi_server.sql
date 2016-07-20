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

 Date: 07/20/2016 14:51:31 PM
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `domain`
-- ----------------------------
BEGIN;
INSERT INTO `domain` VALUES ('1', 'eGlhbnpoaWh1bGlhbi5jb20=', '1468229135', '1', '1468502915', '1', '1468425600');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `templates`
-- ----------------------------
BEGIN;
INSERT INTO `templates` VALUES ('1', 'moban1', '1468471343', '模板一', '/templates/moban1.zip', '/templates/moban1_thumb.jpg'), ('2', 'moban2', '1468471343', '模板二', '/templates/moban2.zip', '/templates/moban2_thumb.jpg'), ('3', 'moban3', '1468471343', '模板三', '/templates/moban3.zip', '/templates/moban3_thumb.jpg'), ('4', 'moban4', '1468983936', '模板四', '/templates/moban4.zip', '/templates/moban4.zip');
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `vip`
-- ----------------------------
BEGIN;
INSERT INTO `vip` VALUES ('1', '1', '2', '2');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
