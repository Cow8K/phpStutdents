-- MySQL dump 10.13  Distrib 5.7.35, for Win64 (x86_64)
--
-- Host: localhost    Database: php_students
-- ------------------------------------------------------
-- Server version	5.7.35-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(64) DEFAULT NULL COMMENT '密码',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `group_id` int(11) DEFAULT NULL COMMENT '角色组id',
  `score` int(11) DEFAULT NULL COMMENT '积分',
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='管理员';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (10,'name123','123123','2025-12-24 15:23:23',NULL,1,NULL),(11,'name123456','123123','2025-12-24 15:23:23',2,1,NULL),(12,'name1234567',NULL,'2025-12-24 15:23:23',3,1,NULL),(13,'666',NULL,'2025-12-24 15:23:23',NULL,2,NULL),(15,'123',NULL,'2025-12-24 15:23:23',2,NULL,NULL),(17,'32323',NULL,'2025-12-24 15:23:23',NULL,NULL,NULL),(22,'12测试1','','2025-12-24 15:23:23',NULL,NULL,NULL),(23,'121测试','','2025-12-24 15:23:23',NULL,NULL,NULL),(24,'测试修改12','1111','2025-12-24 15:23:23',NULL,NULL,NULL),(25,'6666',NULL,'2025-12-24 15:23:23',NULL,NULL,NULL),(26,'22','','2025-12-24 15:23:23',2,NULL,NULL),(27,'22',NULL,'2025-12-24 15:23:23',NULL,NULL,NULL),(39,'test03','$2y$10$KVMbG4YIkEkrFTnUr7S0ouzRrNCFrbTeNDLYem7xxLnyHGncVZpNy','2026-01-06 07:42:34',3,NULL,NULL),(32,'22222',NULL,'2025-12-24 15:23:23',NULL,NULL,NULL),(33,'555551',NULL,'2025-12-24 15:23:23',NULL,NULL,NULL),(35,'admin','$2y$10$x/Zj58FPD8ATwv49OMNI2eL1FyWzPjnBvkmJnLY1cJx7fFxipOjxy','2026-01-05 07:20:26',1,NULL,'/uploads/35/1.jpg'),(36,'liusheng','$2y$10$tN0W/wCaYtR3tYu5cNlQfetrmvxlJecawtyL3emKJcRKyK2lDhPgC','2026-01-05 07:20:57',1,NULL,'/uploads/36/寸照-刘盛.jpg'),(37,'test02','$2y$10$RRV0CQviH01RTm.Po7isZ.k1sCgb5nmHV//z4rNe2rQ7P9XdhSPQ6','2026-01-05 08:50:24',2,NULL,NULL),(38,'test01','$2y$10$SIVUL2/TIGLkysie8BK.S.81k495ED5JwL/noj09xx.AW9cJ/2AsK','2026-01-05 08:50:43',2,NULL,NULL),(40,'test04','$2y$10$UhXMrA5S449bhHXQ6Ah6N.TsXOVx4oMvG8pwfvVlmQAhQ5f56RbV6','2026-01-06 07:44:18',2,NULL,NULL),(42,'test06','$2y$10$ssS4gOlCvAdiCpPdip5GPesdABBJm44YYeFgMBli1oDCnw0whuCu.','2026-01-06 08:15:42',2,NULL,NULL),(43,'test007','$2y$10$x/R.7rexaT6n8JwdBSdvKelDTK4YxvLoCQadB/.e4LYls5K6Ym6z2','2026-01-06 08:40:26',3,NULL,NULL),(44,'cow8k','$2y$10$Lc9UJBFRUXyWOrkmS9BJieQqO5OZ6YN06RuFLjCXb/ToaucyZ9e26','2026-01-08 03:26:22',2,NULL,NULL);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_group`
--

DROP TABLE IF EXISTS `admin_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL COMMENT '角色名称',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='角色分组';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_group`
--

LOCK TABLES `admin_group` WRITE;
/*!40000 ALTER TABLE `admin_group` DISABLE KEYS */;
INSERT INTO `admin_group` VALUES (1,'超级管理员','2025-12-24 15:23:23'),(2,'二级管理员','2025-12-24 15:23:23'),(3,'三级管理员','2025-12-24 15:23:23');
/*!40000 ALTER TABLE `admin_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_log`
--

DROP TABLE IF EXISTS `admin_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `remark` varchar(20) DEFAULT NULL COMMENT '操作备注',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `admin_id` int(11) DEFAULT NULL COMMENT '管理员的id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=270 DEFAULT CHARSET=utf8 COMMENT='管理员日志';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_log`
--

LOCK TABLES `admin_log` WRITE;
/*!40000 ALTER TABLE `admin_log` DISABLE KEYS */;
INSERT INTO `admin_log` VALUES (257,'管理员 admin 登录','2026-01-12 16:02:06',35),(258,'管理员 admin 退出','2026-01-12 16:02:15',35),(240,'管理员 admin 退出','2026-01-10 09:12:21',35),(241,'管理员 admin 登录','2026-01-10 09:12:27',35),(242,'管理员 admin 退出','2026-01-10 09:25:27',35),(243,'管理员 admin 登录','2026-01-10 09:25:33',35),(244,'管理员 admin 退出','2026-01-10 09:35:31',35),(245,'管理员 admin 登录','2026-01-10 09:35:37',35),(246,'管理员 admin 退出','2026-01-10 09:41:08',35),(247,'管理员 admin 登录','2026-01-10 09:41:13',35),(248,'管理员 admin 登录','2026-01-12 03:28:07',35),(249,'管理员 admin 登录','2026-01-12 03:28:08',35),(250,'管理员 admin 登录','2026-01-12 03:28:08',35),(251,'管理员 admin 登录','2026-01-12 03:28:09',35),(252,'管理员 admin 登录','2026-01-12 06:15:24',35),(253,'管理员 liusheng 登录','2026-01-12 08:17:53',36),(254,'管理员 liusheng 登录','2026-01-12 11:55:35',36),(255,'管理员 admin 登录','2026-01-12 14:39:41',35),(256,'管理员 admin 退出','2026-01-12 14:45:04',35),(239,'管理员 admin 登录','2026-01-10 09:07:13',35),(223,'管理员 cow8k 登录','2026-01-10 03:18:51',44),(224,'管理员 cow8k 退出','2026-01-10 03:20:04',44),(225,'管理员 admin 登录','2026-01-10 03:20:10',35),(226,'管理员 admin 登录','2026-01-10 06:30:01',35),(227,'管理员 admin 退出','2026-01-10 06:30:36',35),(228,'管理员 admin 登录','2026-01-10 06:30:46',35),(229,'管理员 liusheng 登录','2026-01-10 07:17:05',36),(230,'管理员 liusheng 退出','2026-01-10 07:29:00',36),(231,'管理员 cow8k 登录','2026-01-10 07:29:13',44),(232,'管理员 cow8k 退出','2026-01-10 07:29:25',44),(233,'管理员 liusheng 登录','2026-01-10 07:29:31',36),(234,'管理员 liusheng 退出','2026-01-10 07:35:08',36),(235,'管理员 cow8k 登录','2026-01-10 07:41:15',44),(236,'管理员 cow8k 退出','2026-01-10 07:41:19',44),(237,'管理员 liusheng 登录','2026-01-10 07:43:54',36),(238,'管理员 admin 登录','2026-01-10 08:21:16',35),(205,'管理员 admin 登陆','2026-01-09 09:29:18',35),(222,'管理员 liusheng 退出','2026-01-10 03:18:47',36),(220,'管理员 liusheng 退出','2026-01-10 03:10:45',36),(221,'管理员 liusheng 登录','2026-01-10 03:10:52',36),(217,'管理员 admin 登录','2026-01-10 03:04:29',35),(218,'管理员 admin 登录','2026-01-10 03:05:00',35),(219,'管理员 liusheng 登录','2026-01-10 03:05:31',36),(216,'管理员 admin 登录','2026-01-10 03:04:23',35),(213,'管理员 liusheng 退出','2026-01-09 14:55:24',36),(214,'管理员 liusheng 登录','2026-01-09 14:55:38',36),(215,'管理员 admin 登录','2026-01-10 03:04:21',35),(212,'管理员 admin 登陆','2026-01-09 14:08:21',35),(210,'管理员 admin 登陆','2026-01-09 13:25:32',35),(211,'管理员 admin 登陆','2026-01-09 14:06:48',35),(206,'管理员 admin 登陆','2026-01-09 13:14:24',35),(207,'管理员 admin 登陆','2026-01-09 13:17:15',35),(208,'管理员 admin 登陆','2026-01-09 13:21:00',35),(209,'管理员 admin 登陆','2026-01-09 13:25:06',35),(147,'管理员10登陆','2026-01-04 09:46:44',10),(189,'管理员 admin 登陆','2026-01-07 10:49:46',35),(204,'管理员 admin 登陆','2026-01-09 08:34:02',35),(190,'管理员 liusheng 登陆','2026-01-07 11:18:10',36),(191,'管理员 liusheng 登陆','2026-01-07 12:01:06',36),(192,'管理员 admin 登陆','2026-01-07 13:47:35',35),(193,'管理员 admin 登陆','2026-01-07 14:54:59',35),(194,'管理员 liusheng 登陆','2026-01-08 02:07:51',36),(195,'管理员 liusheng 登陆','2026-01-08 02:07:53',36),(160,'管理员name123登陆','2026-01-04 10:33:38',10),(202,'管理员 admin 登陆','2026-01-09 08:32:55',35),(203,'管理员 admin 登陆','2026-01-09 08:33:24',35),(196,'管理员 admin 登陆','2026-01-08 03:07:10',35),(197,'管理员 liusheng 登陆','2026-01-08 08:14:12',36),(198,'管理员 admin 登陆','2026-01-09 07:06:09',35),(199,'管理员 admin 登陆','2026-01-09 07:14:13',35),(186,'管理员 liusheng 登陆','2026-01-06 14:27:00',36),(201,'管理员 admin 登陆','2026-01-09 07:16:34',35),(200,'管理员 admin 登陆','2026-01-09 07:16:25',35),(188,'管理员 liusheng 登陆','2026-01-07 09:28:54',36),(187,'管理员 liusheng 登陆','2026-01-07 08:29:52',36),(185,'管理员 admin 登陆','2026-01-05 07:20:46',35),(183,'管理员 name123 登陆','2026-01-05 06:19:25',10),(184,'管理员 name123 登陆','2026-01-05 06:20:55',10),(180,'管理员 name123 登陆','2026-01-05 02:50:03',10),(181,'管理员 name123 登陆','2026-01-05 02:50:16',10),(182,'管理员 name123 登陆','2026-01-05 03:11:04',10),(259,'管理员 admin 登录','2026-01-12 16:02:22',35),(260,'管理员 admin 退出','2026-01-12 16:02:48',35),(261,'管理员 liusheng 登录','2026-01-12 16:02:56',36),(262,'管理员 liusheng 退出','2026-01-12 16:03:38',36),(263,'管理员 admin 登录','2026-01-12 16:03:48',35),(264,'管理员 admin 退出','2026-01-12 16:03:51',35),(265,'管理员 liusheng 登录','2026-01-12 16:04:10',36),(266,'管理员 liusheng 退出','2026-01-12 16:05:10',36),(267,'管理员 liusheng 登录','2026-01-12 16:29:08',36),(268,'管理员 liusheng 退出','2026-01-12 16:33:45',36),(269,'管理员 liusheng 登录','2026-01-12 16:33:50',36);
/*!40000 ALTER TABLE `admin_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) DEFAULT NULL COMMENT '课程名称',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='课程';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
INSERT INTO `course` VALUES (1,'语文','2025-12-21 08:25:43'),(2,'数学','2025-12-21 08:25:51'),(3,'英语','2025-12-21 08:25:59'),(4,'test1','2026-01-12 07:38:08');
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `score`
--

DROP TABLE IF EXISTS `score`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL DEFAULT '0' COMMENT '学生id',
  `score` float(5,2) DEFAULT NULL COMMENT '成绩',
  `course_id` int(11) NOT NULL DEFAULT '0' COMMENT '课程id',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='成绩表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `score`
--

LOCK TABLES `score` WRITE;
/*!40000 ALTER TABLE `score` DISABLE KEYS */;
INSERT INTO `score` VALUES (19,34,100.00,1,'2026-01-12 07:05:21'),(5,4,123.00,3,'2025-12-21 08:44:13'),(6,9,98.00,1,'2025-01-11 03:00:29'),(7,9,99.00,2,'2024-01-11 03:00:44'),(8,9,100.00,3,'2024-01-11 03:01:12'),(9,8,60.00,1,'2024-01-11 04:13:04'),(10,8,89.00,2,'2024-01-11 04:13:13'),(11,8,98.00,3,'2024-01-11 04:13:23'),(12,6,78.00,1,'2026-01-11 04:13:48'),(13,33,88.00,2,'2026-01-11 04:14:13'),(14,1,78.00,1,'2026-01-11 07:30:02'),(15,1,90.00,3,'2026-01-11 07:40:50'),(16,12,90.00,2,'2027-01-11 08:48:38'),(17,12,90.00,1,'2025-01-11 08:50:33'),(18,12,90.00,3,'2027-01-11 08:50:57');
/*!40000 ALTER TABLE `score` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stu_class`
--

DROP TABLE IF EXISTS `stu_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stu_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(10) DEFAULT NULL COMMENT '班级名称',
  `grade` varchar(10) DEFAULT NULL COMMENT '年级',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`,`grade`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='学生班级';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stu_class`
--

LOCK TABLES `stu_class` WRITE;
/*!40000 ALTER TABLE `stu_class` DISABLE KEYS */;
INSERT INTO `stu_class` VALUES (1,'一班','二年级','2023-12-12 03:10:28'),(6,'二班','二年级','2024-01-03 03:46:02'),(7,'三班','二年级','2024-01-03 03:46:13'),(8,'一班','三年级','2024-01-10 11:57:19'),(9,'二班','三年级','2024-01-10 11:57:28'),(10,'一班','一年级','2024-01-10 11:57:36'),(11,'二班','一年级','2024-01-10 11:57:42'),(12,'91班','五年级','2026-01-07 11:28:41'),(13,'231 班','一年级','2026-01-07 11:31:25'),(15,'测试1','三年级','2026-01-08 03:27:01');
/*!40000 ALTER TABLE `stu_class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stu_number` varchar(12) NOT NULL DEFAULT '' COMMENT '学号',
  `name` varchar(10) DEFAULT NULL COMMENT '姓名',
  `gender` int(1) DEFAULT NULL COMMENT '性别:1=男,2=女',
  `birthday` date DEFAULT NULL COMMENT '出生日期',
  `stu_class_id` int(11) NOT NULL DEFAULT '0' COMMENT '班级id',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `number` (`stu_number`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COMMENT='学生表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,'202401104','学生212',1,'2016-01-01',13,'2024-01-10 08:37:47'),(2,'202401105','学生211',1,'2016-01-01',1,'2024-01-10 08:37:47'),(6,'202312145','李五222',1,'2023-12-07',6,'2023-12-14 08:45:56'),(54,'202601120035','李四',2,'2011-02-02',1,'2026-01-12 12:09:42'),(53,'202601120034','张三',1,'2012-01-01',1,'2026-01-12 12:09:42'),(13,'2024011013','学生322',2,'2024-01-01',9,'2024-01-10 12:01:01'),(55,'202601120036','王五',1,'2005-03-01',1,'2026-01-12 12:09:42'),(33,'202401208','张三f',1,'2016-03-01',13,'2024-04-24 07:57:13');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'php_students'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-01-13  0:53:02
