-- MySQL dump 10.13  Distrib 5.6.22, for Linux (x86_64)
--
-- Host: localhost    Database: aliserver
-- ------------------------------------------------------
-- Server version	5.6.22

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','7b18842db4d4c0e4833417dc8f000ae6373a6db5');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domain`
--

DROP TABLE IF EXISTS `domain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domain`
--

LOCK TABLES `domain` WRITE;
/*!40000 ALTER TABLE `domain` DISABLE KEYS */;
INSERT INTO `domain` VALUES (9,'YWxpLnhpYW56aGlodWxpYW4uY29t',1469286112,4,1469919332,1,1474387200,1),(10,'d3d3Lm5pdWthLmNj',1469803155,5,1470096791,1,1480521600,25);
/*!40000 ALTER TABLE `domain` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gengxin`
--

DROP TABLE IF EXISTS `gengxin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gengxin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `date` int(11) NOT NULL,
  `detail` text,
  `zip` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gengxin`
--

LOCK TABLES `gengxin` WRITE;
/*!40000 ALTER TABLE `gengxin` DISABLE KEYS */;
INSERT INTO `gengxin` VALUES (3,'1.2.4',1469455288,'增加授权验证，vip限制，在线下载模板，在线升级','/update/alizhizhuchi_v1.2.4.zip'),(8,'1.2.5',1469583720,'更新授权验证时间错误','/update/ALiSpider_Update_1.2.5.zip'),(9,'1.3.0',1469775751,'重写后台，百万级数据加载大幅加快；增加IP库，可直接查看蜘蛛ip信息；系统设置中内容增加“删除所有数据”选项；','/update/AliSpider_Update_v1.3.0.zip'),(11,'1.3.1',1470123913,'程序重大优化，请手动升级','/update/no_update.zip'),(12,'1.3.2',1470124028,'修复IP信息获取错误；优化蜘蛛统计，更准确；解决其他bug；','/update/AliSpider_Update_v1.3.2.zip');
/*!40000 ALTER TABLE `gengxin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gonggao`
--

DROP TABLE IF EXISTS `gonggao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gonggao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gonggao`
--

LOCK TABLES `gonggao` WRITE;
/*!40000 ALTER TABLE `gonggao` DISABLE KEYS */;
INSERT INTO `gonggao` VALUES (1,'欢迎大家使用阿里蜘蛛池！！','http://www.alizhizhuchi.top/',1469285195),(3,'AliSpider v1.2.5已发布，修复授权验证错误，请及时更新！','http://www.alizhizhuchi.top',1469584422),(4,'模板九已正式发布，请及时下载应用。','http://www.alizhizhuchi.top',1469666646),(5,'AliSpider v.1.3.0正式发布，做了重大优化及增添新功能，建议及时更新。点此链接下载完整版','http://www.alizhizhuchi.top',1469780640),(7,'AliSpider v1.3.1正式发布，优化数据库，数据随机性，页面打开速度更快。修改地方较多，请下载完整包手动升级。','http://www.alizhizhuchi.top',1469859606),(8,'“模板十”已正式发布，请及时下载应用。','templates.php',1469864016),(9,'AliSpider v1.3.2正式发布，修复程序BUG，请及时升级。','http://www.alizhizhuchi.top',1470123677);
/*!40000 ALTER TABLE `gonggao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spider`
--

DROP TABLE IF EXISTS `spider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spider` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `domain_id` int(10) NOT NULL,
  `spider_num` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spider`
--

LOCK TABLES `spider` WRITE;
/*!40000 ALTER TABLE `spider` DISABLE KEYS */;
INSERT INTO `spider` VALUES (7,8,0,1469579800),(8,8,0,1469674294),(9,10,0,1469718285),(10,10,0,1469718293),(11,8,0,1469771257),(12,9,442,1469832933),(13,10,9,1469931444),(14,10,1003,1470010392);
/*!40000 ALTER TABLE `spider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `templates`
--

DROP TABLE IF EXISTS `templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `date` int(11) NOT NULL,
  `detail` text,
  `zip` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `templates`
--

LOCK TABLES `templates` WRITE;
/*!40000 ALTER TABLE `templates` DISABLE KEYS */;
INSERT INTO `templates` VALUES (1,'moban1',1468471343,'模板一','/templates/moban1.zip','/templates/moban1_thumb.jpg'),(2,'moban2',1468471343,'模板二','/templates/moban2.zip','/templates/moban2_thumb.jpg'),(3,'moban3',1468471343,'模板三','/templates/moban3.zip','/templates/moban3_thumb.jpg'),(4,'moban4',1468983936,'模板四','/templates/moban4.zip','/templates/moban4_thumb.jpg'),(5,'moban5',1469333450,'模板五','/templates/moban5.zip','/templates/moban5_thumb.jpg'),(6,'moban6',1469333899,'模板六','/templates/moban6.zip','/templates/moban6_thumb.jpg'),(7,'moban7',1469333971,'模板七','/templates/moban7.zip','/templates/moban7_thumb.jpg'),(8,'moban8',1469334038,'模板八','/templates/moban8.zip','/templates/moban8_thumb.jpg'),(9,'moban9',1469666560,'模板九','/templates/moban9.zip','/templates/moban9_thumb.jpg'),(10,'moban10',1469863936,'模板十','/templates/moban10.zip','/templates/moban10_thumb.jpg');
/*!40000 ALTER TABLE `templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vip`
--

DROP TABLE IF EXISTS `vip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vip` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '1',
  `domain` int(11) NOT NULL,
  `templates` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vip`
--

LOCK TABLES `vip` WRITE;
/*!40000 ALTER TABLE `vip` DISABLE KEYS */;
INSERT INTO `vip` VALUES (1,'VIP 1',50,2,'http://www.alizhizhuchi.top'),(3,'VIP 2',100,5,'http://www.alizhizhuchi.top'),(4,'VIP 3',300,10,'http://www.alizhizhuchi.top'),(5,'VIP 4',1000,30,'http://www.alizhizhuchi.top'),(6,'VIP 5',5000,100,'http://www.alizhizhuchi.top');
/*!40000 ALTER TABLE `vip` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-02 20:41:34
