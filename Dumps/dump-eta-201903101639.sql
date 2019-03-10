-- MySQL dump 10.16  Distrib 10.1.38-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: eta
-- ------------------------------------------------------
-- Server version	10.1.34-MariaDB

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
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `SERIALID` varchar(100) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `PRODNUM` varchar(100) NOT NULL,
  `USERID` int(11) NOT NULL,
  `LOCATION` varchar(100) DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `FAULTDATE` date DEFAULT NULL,
  `STATUS` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`SERIALID`,`PRODNUM`),
  KEY `items_users_FK` (`USERID`),
  CONSTRAINT `items_users_FK` FOREIGN KEY (`USERID`) REFERENCES `users` (`USERID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES ('JAAJD2','Radar','ANNDQ2',1,'Luqa','hjbadchuasj','2018-08-07','faulty'),('JAAJD4','ABC','AJSADASDN',1,'DEF','adsijsaikjdsa','2018-08-07','faulty');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER items_after_insert
AFTER INSERT
   ON items FOR EACH ROW

BEGIN
   INSERT INTO itemslog
   VALUES
   (NEW.PRODNUM,
	 NEW.SERIALID,
	 NEW.USERID,
	 NEW.DESCRIPTION,
     SYSDATE(),
     NEW.STATUS,
     NEW.LOCATION,
     NEW.NAME,
     'INS');

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER items_after_update
AFTER UPDATE
   ON items FOR EACH ROW

BEGIN
   INSERT INTO itemslog
   VALUES
   (NEW.PRODNUM,
	 NEW.SERIALID,
	 NEW.USERID,
	 NEW.DESCRIPTION,
     SYSDATE(),
     NEW.STATUS,
     NEW.LOCATION,
     NEW.NAME,
     'UPD');

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER items_after_delete
AFTER DELETE
   ON items FOR EACH ROW

BEGIN
   INSERT INTO itemslog
   VALUES
   (OLD.PRODNUM,
	 OLD.SERIALID,
	 OLD.USERID,
	 OLD.DESCRIPTION,
     SYSDATE(),
     OLD.STATUS,
     OLD.LOCATION,
     OLD.NAME,
     'DEL');

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `itemslog`
--

DROP TABLE IF EXISTS `itemslog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itemslog` (
  `PRODNUM` varchar(100) NOT NULL,
  `SERIALID` varchar(100) NOT NULL,
  `USERID` varchar(100) NOT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `EDITDATE` datetime NOT NULL,
  `STATUS` varchar(100) NOT NULL,
  `LOCATION` varchar(100) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `TYPEOFQ` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itemslog`
--

LOCK TABLES `itemslog` WRITE;
/*!40000 ALTER TABLE `itemslog` DISABLE KEYS */;
INSERT INTO `itemslog` VALUES ('ANNDQ2','JAAJD2','1','hjbadchuasj','2018-08-07 22:24:28','faulty','Luqa','Radar','INS'),('AJSADASDN','JAAJD4','1','adsijsaikjdsa','2018-08-07 23:32:25','faulty','DEF','ABC','INS'),('','','1','','2018-08-07 23:34:29','','','','INS'),('','','1','','2018-08-07 23:34:38','','','','DEL');
/*!40000 ALTER TABLE `itemslog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uploads`
--

DROP TABLE IF EXISTS `uploads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uploads` (
  `location` varchar(100) NOT NULL,
  `prodid` varchar(100) NOT NULL,
  `serialid` varchar(100) NOT NULL,
  `docid` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`prodid`,`serialid`,`docid`),
  KEY `docid` (`docid`),
  KEY `uploads_items_FK` (`serialid`,`prodid`),
  CONSTRAINT `uploads_items_FK` FOREIGN KEY (`serialid`, `prodid`) REFERENCES `items` (`SERIALID`, `PRODNUM`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uploads`
--

LOCK TABLES `uploads` WRITE;
/*!40000 ALTER TABLE `uploads` DISABLE KEYS */;
INSERT INTO `uploads` VALUES ('uploads/1533677567-honda-car-4.jpg','AJSADASDN','JAAJD4',22),('uploads/1533677611-hot-cars-pictures-9.jpg','AJSADASDN','JAAJD4',23),('uploads/1533677678-uupof.jpeg','ANNDQ2','JAAJD2',24);
/*!40000 ALTER TABLE `uploads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `USERID` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `SURNAME` varchar(100) DEFAULT NULL,
  `POSN` varchar(100) DEFAULT NULL,
  `ISADMIN` tinyint(4) NOT NULL,
  `USERNAME` varchar(100) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  PRIMARY KEY (`USERID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Enrico','Zammit','IT',1,'enrico','$2b$10$/FBMolOF0y78fuVrEOyU/ed1PHl5u/Cc3eX3jI1yuruourcobilEi'),(2,'Carlo','Zammit','CLERK',0,'carlo','$2y$10$1eU1mx31zcpb7BdmWSRmQ.0U/3ex1qR6bOacSRlCTaUJtfNtDvFZi'),(3,'Leslie','Zammit','HEAD',1,'leslie','$2y$10$1eU1mx31zcpb7BdmWSRmQ.0U/3ex1qR6bOacSRlCTaUJtfNtDvFZi');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'eta'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-10 16:39:13
