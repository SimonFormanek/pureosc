-- MySQL dump 10.13  Distrib 5.5.52, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: oscxx
-- ------------------------------------------------------
-- Server version	5.5.52-0+deb8u1

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
-- Table structure for table `information`
--

DROP TABLE IF EXISTS `information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `information` (
  `information_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `information_group_id` int(11) unsigned NOT NULL DEFAULT '0',
  `information_title` varchar(255) NOT NULL DEFAULT '',
  `information_description` text NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `sort_order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `visible` enum('1','0') NOT NULL DEFAULT '1',
  `language_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`information_id`,`language_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `information`
--

LOCK TABLES `information` WRITE;
/*!40000 ALTER TABLE `information` DISABLE KEYS */;
INSERT INTO `information` VALUES (1,2,'HEADING_TITLE','Store title',0,1,'1',1),(1,2,'HEADING_TITLE','Store title',NULL,1,'1',2),(1,2,'HEADING_TITLE','Store title',NULL,1,'1',3),(1,2,'HEADING_TITLE','Store title',NULL,1,'1',4),(2,2,'TEXT_GREETING_PERSONAL','Welcome back <span class=\"greetUser\">%s!</span> Would you like to see which <a href=\"%s\"><u>new products</u></a> are available to purchase?',0,2,'1',1),(2,2,'TEXT_GREETING_PERSONAL','Welcome back <span class=\"greetUser\">%s!</span> Would you like to see which <a href=\"%s\"><u>new products</u></a> are available to purchase?',NULL,2,'1',2),(2,2,'TEXT_GREETING_PERSONAL','Welcome back <span class=\"greetUser\">%s!</span> Would you like to see which <a href=\"%s\"><u>new products</u></a> are available to purchase?',NULL,2,'1',3),(2,2,'TEXT_GREETING_PERSONAL','Welcome back <span class=\"greetUser\">%s!</span> Would you like to see which <a href=\"%s\"><u>new products</u></a> are available to purchase?',NULL,2,'1',4),(3,2,'TEXT_GREETING_PERSONAL_RELOGON','<small>If you are not %s, please <a href=\"%s\"><u>log yourself in</u></a> with your account information.</small>',0,3,'1',1),(3,2,'TEXT_GREETING_PERSONAL_RELOGON','<small>If you are not %s, please <a href=\"%s\"><u>log yourself in</u></a> with your account information.</small>',NULL,3,'1',2),(3,2,'TEXT_GREETING_PERSONAL_RELOGON','<small>If you are not %s, please <a href=\"%s\"><u>log yourself in</u></a> with your account information.</small>',NULL,3,'1',3),(3,2,'TEXT_GREETING_PERSONAL_RELOGON','<small>If you are not %s, please <a href=\"%s\"><u>log yourself in</u></a> with your account information.</small>',NULL,3,'1',4),(4,2,'TEXT_GREETING_GUEST','Welcome <span class=\"greetUser\">Guest!</span> Would you like to <a href=\"%s\"><u>log yourself in</u></a>? Or would you prefer to <a href=\"%s\"><u>create an account</u></a>?',0,4,'1',1),(4,2,'TEXT_GREETING_GUEST','Welcome <span class=\"greetUser\">Guest!</span> Would you like to <a href=\"%s\"><u>log yourself in</u></a>? Or would you prefer to <a href=\"%s\"><u>create an account</u></a>?',NULL,4,'1',2),(4,2,'TEXT_GREETING_GUEST','Welcome <span class=\"greetUser\">Guest!</span> Would you like to <a href=\"%s\"><u>log yourself in</u></a>? Or would you prefer to <a href=\"%s\"><u>create an account</u></a>?',NULL,4,'1',3),(4,2,'TEXT_GREETING_GUEST','Welcome <span class=\"greetUser\">Guest!</span> Would you like to <a href=\"%s\"><u>log yourself in</u></a>? Or would you prefer to <a href=\"%s\"><u>create an account</u></a>?',NULL,4,'1',4),(5,2,'TEXT_MAIN','This is a default text. Please go to visit the admin and change it.',0,5,'1',1),(5,2,'TEXT_MAIN','This is a default text. Please go to visit the admin and change it.',NULL,5,'1',2),(5,2,'TEXT_MAIN','This is a default text. Please go to visit the admin and change it.',NULL,5,'1',3),(5,2,'TEXT_MAIN','This is a default text. Please go to visit the admin and change it.',NULL,5,'1',4),(6,2,'META_SEO_TITLE','',0,6,'1',1),(6,2,'META_SEO_TITLE','',NULL,6,'1',2),(6,2,'META_SEO_TITLE','',NULL,6,'1',3),(6,2,'META_SEO_TITLE','',NULL,6,'1',4),(7,2,'META_SEO_DESCRIPTION','',0,7,'1',1),(7,2,'META_SEO_DESCRIPTION','',NULL,7,'1',2),(7,2,'META_SEO_DESCRIPTION','',NULL,7,'1',3),(7,2,'META_SEO_DESCRIPTION','',NULL,7,'1',4),(8,2,'META_SEO_KEYWORDS','',0,8,'1',1),(8,2,'META_SEO_KEYWORDS','',NULL,8,'1',2),(8,2,'META_SEO_KEYWORDS','',NULL,8,'1',3),(8,2,'META_SEO_KEYWORDS','',NULL,8,'1',4),(9,1,'Shipping & Returns','',NULL,1,'1',1),(9,1,'Shipping & Returns','',NULL,1,'1',2),(9,1,'Shipping & Returns','',NULL,1,'1',3),(9,1,'Dodací podmínky','',NULL,1,'1',4),(10,1,'Privacy & Cookie Policy','',0,2,'1',1),(10,1,'Privacy & Cookie Policy','',0,2,'1',2),(10,1,'Privacy & Cookie Policy','',0,2,'1',3),(10,1,'Ochrana soukromí','',0,2,'1',4),(11,1,'Terms & Conditions','',0,3,'1',1),(11,1,'Terms & Conditions','',0,3,'1',2),(11,1,'Terms & Conditions','',0,3,'1',3),(11,1,'Obchodní podmínky','',0,3,'1',4);
/*!40000 ALTER TABLE `information` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `information_group`
--

DROP TABLE IF EXISTS `information_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `information_group` (
  `information_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `information_group_title` varchar(64) NOT NULL DEFAULT '',
  `information_group_description` varchar(255) NOT NULL DEFAULT '',
  `sort_order` int(5) DEFAULT NULL,
  `visible` int(1) DEFAULT '1',
  `locked` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`information_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `information_group`
--

LOCK TABLES `information_group` WRITE;
/*!40000 ALTER TABLE `information_group` DISABLE KEYS */;
INSERT INTO `information_group` VALUES (1,'Information pages','Information pages',1,1,''),(2,'Welcome message','Welcome message',2,1,'information_title, sort_order, parent_id');
/*!40000 ALTER TABLE `information_group` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-08  1:35:25
