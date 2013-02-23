-- MySQL dump 10.13  Distrib 5.5.24, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: Web
-- ------------------------------------------------------
-- Server version	5.5.24-0ubuntu0.12.04.1

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
-- Table structure for table `Comments`
--

DROP TABLE IF EXISTS `Comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Comments` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `description` text,
  `uid` int(11) DEFAULT NULL,
  `oid` int(11) DEFAULT NULL,
  `since` datetime DEFAULT NULL,
  PRIMARY KEY (`cid`),
  KEY `fk_Comments_1_idx` (`uid`),
  KEY `fk_Comments_2_idx` (`oid`),
  CONSTRAINT `fk_Comments_1` FOREIGN KEY (`uid`) REFERENCES `Users` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Comments_2` FOREIGN KEY (`oid`) REFERENCES `Objects` (`oid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Comments`
--

LOCK TABLES `Comments` WRITE;
/*!40000 ALTER TABLE `Comments` DISABLE KEYS */;
INSERT INTO `Comments` VALUES (2,'cc',4,4,'2012-11-26 21:46:37');
/*!40000 ALTER TABLE `Comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Friends`
--

DROP TABLE IF EXISTS `Friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Friends` (
  `uid1` int(11) NOT NULL,
  `uid2` int(11) NOT NULL,
  PRIMARY KEY (`uid2`,`uid1`),
  KEY `fk_Friends_1_idx` (`uid1`),
  KEY `fk_Friends_2_idx` (`uid2`),
  CONSTRAINT `fk_Friends_1` FOREIGN KEY (`uid1`) REFERENCES `Users` (`uid`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_Friends_2` FOREIGN KEY (`uid2`) REFERENCES `Users` (`uid`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Friends`
--

LOCK TABLES `Friends` WRITE;
/*!40000 ALTER TABLE `Friends` DISABLE KEYS */;
INSERT INTO `Friends` VALUES (4,8),(4,19),(8,4),(8,19),(16,19),(16,20),(19,4),(19,8),(19,16),(20,16);
/*!40000 ALTER TABLE `Friends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `FriendsQuery`
--

DROP TABLE IF EXISTS `FriendsQuery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FriendsQuery` (
  `uid1` int(11) NOT NULL DEFAULT '0',
  `uid2` int(11) NOT NULL DEFAULT '0',
  `since` datetime DEFAULT NULL,
  PRIMARY KEY (`uid1`,`uid2`),
  KEY `uid2` (`uid2`),
  CONSTRAINT `FriendsQuery_ibfk_1` FOREIGN KEY (`uid1`) REFERENCES `Users` (`uid`),
  CONSTRAINT `FriendsQuery_ibfk_2` FOREIGN KEY (`uid2`) REFERENCES `Users` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FriendsQuery`
--

LOCK TABLES `FriendsQuery` WRITE;
/*!40000 ALTER TABLE `FriendsQuery` DISABLE KEYS */;
INSERT INTO `FriendsQuery` VALUES (8,18,'2012-12-03 00:21:18'),(20,4,'2012-12-17 22:14:31');
/*!40000 ALTER TABLE `FriendsQuery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Groups`
--

DROP TABLE IF EXISTS `Groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Groups` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `since` datetime DEFAULT NULL,
  PRIMARY KEY (`gid`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Groups`
--

LOCK TABLES `Groups` WRITE;
/*!40000 ALTER TABLE `Groups` DISABLE KEYS */;
INSERT INTO `Groups` VALUES (15,'aaaaaaaa','dddd','2012-11-26 16:33:37'),(19,'k','2','2012-11-26 17:26:11'),(20,'1232','2','2012-11-26 17:42:27'),(21,'q','a','2012-11-26 17:55:18');
/*!40000 ALTER TABLE `Groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Notes`
--

DROP TABLE IF EXISTS `Notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Notes` (
  `nid` int(11) NOT NULL AUTO_INCREMENT,
  `description` text,
  `title` varchar(50) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `oid` int(11) DEFAULT NULL,
  `since` datetime DEFAULT NULL,
  `public` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`nid`),
  KEY `fk_Notes_1_idx` (`uid`),
  KEY `fk_Notes_2_idx` (`oid`),
  CONSTRAINT `fk_Notes_1` FOREIGN KEY (`uid`) REFERENCES `Users` (`uid`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_Notes_2` FOREIGN KEY (`oid`) REFERENCES `Objects` (`oid`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Notes`
--

LOCK TABLES `Notes` WRITE;
/*!40000 ALTER TABLE `Notes` DISABLE KEYS */;
INSERT INTO `Notes` VALUES (1,'des2','title2',4,4,'2012-11-26 21:42:00',1);
/*!40000 ALTER TABLE `Notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Objects`
--

DROP TABLE IF EXISTS `Objects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Objects` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `uid` int(11) DEFAULT NULL,
  `since` datetime DEFAULT NULL,
  PRIMARY KEY (`oid`),
  KEY `fk_Objects_1_idx` (`uid`),
  CONSTRAINT `fk_Objects_1` FOREIGN KEY (`uid`) REFERENCES `Users` (`uid`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Objects`
--

LOCK TABLES `Objects` WRITE;
/*!40000 ALTER TABLE `Objects` DISABLE KEYS */;
INSERT INTO `Objects` VALUES (4,'name','description',4,'2012-11-26 21:39:27');
/*!40000 ALTER TABLE `Objects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Tag`
--

DROP TABLE IF EXISTS `Tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Tag` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `oid` int(11) DEFAULT NULL,
  PRIMARY KEY (`tid`),
  KEY `fk_Tag_1_idx` (`uid`),
  KEY `fk_Tag_2_idx` (`oid`),
  CONSTRAINT `fk_Tag_1` FOREIGN KEY (`uid`) REFERENCES `Users` (`uid`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tag_2` FOREIGN KEY (`oid`) REFERENCES `Objects` (`oid`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tag`
--

LOCK TABLES `Tag` WRITE;
/*!40000 ALTER TABLE `Tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `Tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT 'default',
  `password` varchar(20) DEFAULT 'default',
  `username` varchar(20) DEFAULT 'default',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (4,'','123456','root'),(8,'123','123','123123'),(15,'dddddddddddddddddddddd','dddddddd@qq.com','ddddddddddddd'),(16,'dddddddddd','ddddddddd@qq.com','ddddddd'),(17,'aaaaaaaa','aaaaaaaaaaaaa@qq.com','aaaaaaaaaaaa'),(18,'aaaaaaaad','xxxxxxxxxxxxx@qq.com','ddddddddd'),(19,'123456@qq.com','123456','kazedd'),(20,'333@qq.com','123456','kkk');
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UsersGroupsManage`
--

DROP TABLE IF EXISTS `UsersGroupsManage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UsersGroupsManage` (
  `uid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `since` datetime DEFAULT NULL,
  PRIMARY KEY (`uid`,`gid`),
  KEY `fk_UsersGroupsManage_1_idx` (`uid`),
  KEY `fk_UsersGroupsManage_2_idx` (`gid`),
  CONSTRAINT `fk_UsersGroupsManage_1` FOREIGN KEY (`uid`) REFERENCES `Users` (`uid`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_UsersGroupsManage_2` FOREIGN KEY (`gid`) REFERENCES `Groups` (`gid`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UsersGroupsManage`
--

LOCK TABLES `UsersGroupsManage` WRITE;
/*!40000 ALTER TABLE `UsersGroupsManage` DISABLE KEYS */;
INSERT INTO `UsersGroupsManage` VALUES (4,19,'2012-11-26 17:26:12'),(4,20,'2012-11-26 17:42:27'),(4,21,'2012-11-26 17:55:18');
/*!40000 ALTER TABLE `UsersGroupsManage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UsersGroupsRelation`
--

DROP TABLE IF EXISTS `UsersGroupsRelation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UsersGroupsRelation` (
  `uid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `since` datetime DEFAULT NULL,
  PRIMARY KEY (`uid`,`gid`),
  KEY `fk_UsersGroupsRelation_1_idx1` (`uid`),
  KEY `fk_UsersGroupsRelation_2_idx1` (`gid`),
  CONSTRAINT `fk_UsersGroupsRelation_1` FOREIGN KEY (`uid`) REFERENCES `Users` (`uid`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_UsersGroupsRelation_2` FOREIGN KEY (`gid`) REFERENCES `Groups` (`gid`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UsersGroupsRelation`
--

LOCK TABLES `UsersGroupsRelation` WRITE;
/*!40000 ALTER TABLE `UsersGroupsRelation` DISABLE KEYS */;
INSERT INTO `UsersGroupsRelation` VALUES (4,19,'2012-11-26 17:26:12'),(4,20,'2012-11-26 17:42:28'),(4,21,'2012-11-26 17:55:18'),(8,15,'2012-11-26 16:33:37');
/*!40000 ALTER TABLE `UsersGroupsRelation` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-12-17 23:21:47
