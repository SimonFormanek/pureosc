-- MySQL dump 10.13  Distrib 5.5.52, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: oscempty
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
-- Table structure for table `aas_calendar`
--

DROP TABLE IF EXISTS `aas_calendar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aas_calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `start` int(11) DEFAULT NULL,
  `end` int(11) DEFAULT NULL,
  `allDay` tinyint(1) NOT NULL DEFAULT '1',
  `date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aas_calendar`
--

LOCK TABLES `aas_calendar` WRITE;
/*!40000 ALTER TABLE `aas_calendar` DISABLE KEYS */;
/*!40000 ALTER TABLE `aas_calendar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aas_settings`
--

DROP TABLE IF EXISTS `aas_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aas_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sgroup` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'aac',
  `skey` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `skey` (`skey`,`type`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aas_settings`
--

LOCK TABLES `aas_settings` WRITE;
/*!40000 ALTER TABLE `aas_settings` DISABLE KEYS */;
INSERT INTO `aas_settings` VALUES (1,'aac','displayFieldsPanel','default','AAS_AAC_DISPLAY_FIELDS_PANEL',''),(2,'aac','displayLanguageSelection','default','AAS_AAC_DISPLAY_LANGUAGE_SELECTION',''),(3,'aac','displayBottomInformation','default','AAS_AAC_DISPLAY_BOTTOM_INFORMATION',''),(4,'aac','displayCountProducts','default','AAS_AAC_DISPLAYCOUNTPRODUCTS',''),(5,'aac','enableAttributesManager','default','AAS_AAC_DISABLE_ATTRIBUTES_MANAGER',''),(6,'aac','enableTempProductsList','default','AAS_AAC_DISABLE_TEMP_PRODUCTS_LIST',''),(7,'aac','enableToolBox','default','AAS_AAC_DISABLE_TOOLBOX',''),(8,'aac','enableClocks','default','AAS_AAC_DISABLE_CLOCKS',''),(9,'aac','enableSpecials','default','AAS_AAC_DISABLE_SPECIALS',''),(10,'aac','enableModulesManagerDialog','default','AAS_AAC_DISABLE_MODULES_MANAGER_DIALOG',''),(11,'aac','enableCalendar','default','AAS_AAC_DISABLE_CALENDAR',''),(12,'aac','enableOnlineUsers','default','AAS_AAC_DISABLE_ONLINE_USERS',''),(13,'aac','enableContactMe','default','AAS_AAC_DISABLE_CONTACT_ME',''),(14,'aac','enableDonations','default','AAS_AAC_DISABLE_DONATIONS',''),(15,'aac','delete_products','default','AAS_AAC_DISABLE_DELETE_PRODUCTS',''),(16,'aac','import','default','AAS_AAC_DISABLE_IMPORT',''),(17,'aac','export','default','AAS_AAC_DISABLE_EXPORT',''),(18,'aac','search','default','AAS_AAC_DISABLE_SEARCH',''),(19,'aac','print','default','AAS_AAC_DISABLE_PRINT',''),(20,'aac','all_edit','default','AAS_AAC_DISABLE_ALL_EDIT',''),(21,'aac','mass_columns_edit','default','AAS_AAC_DISABLE_MASS_COLUMNS_EDIT','');
/*!40000 ALTER TABLE `aas_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `action_recorder`
--

DROP TABLE IF EXISTS `action_recorder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `action_recorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `identifier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `success` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_action_recorder_module` (`module`),
  KEY `idx_action_recorder_user_id` (`user_id`),
  KEY `idx_action_recorder_identifier` (`identifier`),
  KEY `idx_action_recorder_date_added` (`date_added`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `action_recorder`
--

LOCK TABLES `action_recorder` WRITE;
/*!40000 ALTER TABLE `action_recorder` DISABLE KEYS */;
INSERT INTO `action_recorder` VALUES (2,'ar_admin_login',1,'admin','127.0.0.1','1','2017-09-13 02:14:47'),(3,'ar_admin_login',2,'admin','127.0.0.1','1','2017-09-15 04:49:00'),(4,'ar_admin_login',1,'admin','127.0.0.1','1','2017-11-20 17:49:42'),(5,'ar_admin_login',0,'f','127.0.0.1','0','2017-11-24 01:04:57'),(6,'ar_admin_login',0,'f','127.0.0.1','0','2017-11-24 01:05:14'),(7,'ar_admin_login',1,'admin','127.0.0.1','1','2017-11-24 01:05:22'),(8,'ar_admin_login',1,'admin','127.0.0.1','1','2017-11-30 23:50:21'),(9,'ar_admin_login',1,'admin','127.0.0.1','1','2017-12-07 23:58:22'),(10,'ar_admin_login',1,'admin','127.0.0.1','1','2017-12-09 20:00:18'),(11,'ar_admin_login',1,'admin','127.0.0.1','1','2017-12-10 01:47:53'),(12,'ar_admin_login',1,'admin','127.0.0.1','1','2017-12-11 21:05:36');
/*!40000 ALTER TABLE `action_recorder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `address_book`
--

DROP TABLE IF EXISTS `address_book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address_book` (
  `address_book_id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `customers_guest` int(1) NOT NULL DEFAULT '0',
  `entry_gender` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entry_company` text COLLATE utf8_unicode_ci,
  `entry_vat_number` text COLLATE utf8_unicode_ci,
  `entry_firstname` text COLLATE utf8_unicode_ci,
  `entry_lastname` text COLLATE utf8_unicode_ci,
  `entry_street_address` text COLLATE utf8_unicode_ci,
  `entry_suburb` text COLLATE utf8_unicode_ci,
  `entry_postcode` text COLLATE utf8_unicode_ci,
  `entry_city` text COLLATE utf8_unicode_ci,
  `entry_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entry_country_id` int(11) NOT NULL DEFAULT '0',
  `entry_zone_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`address_book_id`),
  KEY `idx_address_book_customers_id` (`customers_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address_book`
--

LOCK TABLES `address_book` WRITE;
/*!40000 ALTER TABLE `address_book` DISABLE KEYS */;
/*!40000 ALTER TABLE `address_book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `address_book_real`
--

DROP TABLE IF EXISTS `address_book_real`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address_book_real` (
  `address_book_id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `entry_gender` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entry_company` text COLLATE utf8_unicode_ci,
  `entry_vat_number` text COLLATE utf8_unicode_ci,
  `entry_firstname` text COLLATE utf8_unicode_ci,
  `entry_lastname` text COLLATE utf8_unicode_ci,
  `entry_street_address` text COLLATE utf8_unicode_ci,
  `entry_suburb` text COLLATE utf8_unicode_ci,
  `entry_postcode` text COLLATE utf8_unicode_ci,
  `entry_city` text COLLATE utf8_unicode_ci,
  `entry_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entry_country_id` int(11) NOT NULL DEFAULT '0',
  `entry_zone_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`address_book_id`),
  KEY `idx_address_book_customers_id` (`customers_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address_book_real`
--

LOCK TABLES `address_book_real` WRITE;
/*!40000 ALTER TABLE `address_book_real` DISABLE KEYS */;
/*!40000 ALTER TABLE `address_book_real` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `address_format`
--

DROP TABLE IF EXISTS `address_format`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address_format` (
  `address_format_id` int(11) NOT NULL AUTO_INCREMENT,
  `address_format` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `address_summary` varchar(48) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`address_format_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address_format`
--

LOCK TABLES `address_format` WRITE;
/*!40000 ALTER TABLE `address_format` DISABLE KEYS */;
INSERT INTO `address_format` VALUES (1,'$firstname $lastname$cr$streets$cr$city, $postcode$cr$statecomma$country','$city / $country'),(2,'$firstname $lastname$cr$streets$cr$city, $state    $postcode$cr$country','$city, $state / $country'),(3,'$firstname $lastname$cr$streets$cr$city$cr$postcode - $statecomma$country','$state / $country'),(4,'$firstname $lastname$cr$streets$cr$city ($postcode)$cr$country','$postcode / $country'),(5,'$firstname $lastname$cr$streets$cr$postcode $city$cr$country','$city / $country');
/*!40000 ALTER TABLE `address_format` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `administrators`
--

DROP TABLE IF EXISTS `administrators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrators`
--

LOCK TABLES `administrators` WRITE;
/*!40000 ALTER TABLE `administrators` DISABLE KEYS */;
/*!40000 ALTER TABLE `administrators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article_reviews`
--

DROP TABLE IF EXISTS `article_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_reviews` (
  `reviews_id` int(11) NOT NULL AUTO_INCREMENT,
  `articles_id` int(11) NOT NULL DEFAULT '0',
  `customers_id` int(11) DEFAULT NULL,
  `customers_name` varchar(64) NOT NULL DEFAULT '',
  `reviews_rating` int(1) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `reviews_read` int(5) NOT NULL DEFAULT '0',
  `approved` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`reviews_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_reviews`
--

LOCK TABLES `article_reviews` WRITE;
/*!40000 ALTER TABLE `article_reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `article_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article_reviews_description`
--

DROP TABLE IF EXISTS `article_reviews_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article_reviews_description` (
  `reviews_id` int(11) NOT NULL DEFAULT '0',
  `languages_id` int(11) NOT NULL DEFAULT '0',
  `reviews_text` text NOT NULL,
  PRIMARY KEY (`reviews_id`,`languages_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_reviews_description`
--

LOCK TABLES `article_reviews_description` WRITE;
/*!40000 ALTER TABLE `article_reviews_description` DISABLE KEYS */;
/*!40000 ALTER TABLE `article_reviews_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `articles_id` int(11) NOT NULL AUTO_INCREMENT,
  `articles_date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `articles_last_modified` datetime DEFAULT NULL,
  `articles_date_available` datetime DEFAULT NULL,
  `articles_status` tinyint(1) NOT NULL DEFAULT '0',
  `articles_is_blog` tinyint(1) NOT NULL DEFAULT '0',
  `articles_sort_order` tinyint(5) NOT NULL DEFAULT '0',
  `authors_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`articles_id`),
  KEY `idx_articles_date_added` (`articles_date_added`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articles_blog`
--

DROP TABLE IF EXISTS `articles_blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles_blog` (
  `unique_id` int(11) NOT NULL AUTO_INCREMENT,
  `articles_id` int(11) NOT NULL DEFAULT '0',
  `customers_id` int(11) NOT NULL DEFAULT '0',
  `commenters_name` varchar(54) DEFAULT NULL,
  `comment_date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comments_status` tinyint(1) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`unique_id`),
  KEY `idx_articles_id` (`articles_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles_blog`
--

LOCK TABLES `articles_blog` WRITE;
/*!40000 ALTER TABLE `articles_blog` DISABLE KEYS */;
/*!40000 ALTER TABLE `articles_blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articles_description`
--

DROP TABLE IF EXISTS `articles_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles_description` (
  `articles_id` int(11) NOT NULL AUTO_INCREMENT,
  `cached` int(1) DEFAULT '0',
  `cached_admin` int(1) DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '1',
  `articles_name` varchar(64) NOT NULL DEFAULT '',
  `articles_description` text,
  `articles_image` varchar(64) NOT NULL DEFAULT '',
  `articles_head_desc_tag` text,
  `articles_url` varchar(255) DEFAULT NULL,
  `articles_viewed` int(5) DEFAULT '0',
  PRIMARY KEY (`articles_id`,`language_id`),
  KEY `articles_name` (`articles_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles_description`
--

LOCK TABLES `articles_description` WRITE;
/*!40000 ALTER TABLE `articles_description` DISABLE KEYS */;
/*!40000 ALTER TABLE `articles_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articles_to_topics`
--

DROP TABLE IF EXISTS `articles_to_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles_to_topics` (
  `articles_id` int(11) NOT NULL DEFAULT '0',
  `topics_id` int(11) NOT NULL DEFAULT '0',
  `canonical` int(1) DEFAULT NULL,
  KEY `idx_a2t_articles_id` (`articles_id`),
  KEY `idx_a2t_topics_id` (`topics_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles_to_topics`
--

LOCK TABLES `articles_to_topics` WRITE;
/*!40000 ALTER TABLE `articles_to_topics` DISABLE KEYS */;
/*!40000 ALTER TABLE `articles_to_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articles_xsell`
--

DROP TABLE IF EXISTS `articles_xsell`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles_xsell` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `articles_id` int(10) unsigned NOT NULL DEFAULT '1',
  `xsell_id` int(10) unsigned NOT NULL DEFAULT '1',
  `sort_order` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles_xsell`
--

LOCK TABLES `articles_xsell` WRITE;
/*!40000 ALTER TABLE `articles_xsell` DISABLE KEYS */;
/*!40000 ALTER TABLE `articles_xsell` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authors` (
  `authors_id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `authors_name` varchar(32) NOT NULL DEFAULT '',
  `authors_image` varchar(64) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`authors_id`),
  KEY `IDX_AUTHORS_NAME` (`authors_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authors`
--

LOCK TABLES `authors` WRITE;
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
INSERT INTO `authors` VALUES (1,0,'Jméno Příjmení','','2017-05-14 01:32:03',NULL);
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `authors_info`
--

DROP TABLE IF EXISTS `authors_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authors_info` (
  `authors_id` int(11) NOT NULL DEFAULT '0',
  `languages_id` int(11) NOT NULL DEFAULT '0',
  `authors_description` text,
  `authors_url` varchar(255) NOT NULL DEFAULT '',
  `url_clicked` int(5) NOT NULL DEFAULT '0',
  `date_last_click` datetime DEFAULT NULL,
  PRIMARY KEY (`authors_id`,`languages_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authors_info`
--

LOCK TABLES `authors_info` WRITE;
/*!40000 ALTER TABLE `authors_info` DISABLE KEYS */;
INSERT INTO `authors_info` VALUES (1,1,'','',0,NULL),(1,2,'','',0,NULL),(1,3,'','',0,NULL),(1,4,'','',0,NULL);
/*!40000 ALTER TABLE `authors_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banners` (
  `banners_id` int(11) NOT NULL AUTO_INCREMENT,
  `banners_title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `banners_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `banners_image` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `banners_group` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `banners_html_text` text COLLATE utf8_unicode_ci,
  `expires_impressions` int(7) DEFAULT '0',
  `expires_date` datetime DEFAULT NULL,
  `date_scheduled` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `date_status_change` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`banners_id`),
  KEY `idx_banners_group` (`banners_group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banners_history`
--

DROP TABLE IF EXISTS `banners_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banners_history` (
  `banners_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `banners_id` int(11) NOT NULL,
  `banners_shown` int(5) NOT NULL DEFAULT '0',
  `banners_clicked` int(5) NOT NULL DEFAULT '0',
  `banners_history_date` datetime NOT NULL,
  PRIMARY KEY (`banners_history_id`),
  KEY `idx_banners_history_banners_id` (`banners_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners_history`
--

LOCK TABLES `banners_history` WRITE;
/*!40000 ALTER TABLE `banners_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `banners_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `cache_id` varchar(32) NOT NULL DEFAULT '',
  `cache_language_id` tinyint(1) NOT NULL DEFAULT '0',
  `cache_name` varchar(255) NOT NULL DEFAULT '',
  `cache_data` mediumtext NOT NULL,
  `cache_global` tinyint(1) NOT NULL DEFAULT '1',
  `cache_gzip` tinyint(1) NOT NULL DEFAULT '1',
  `cache_method` varchar(20) NOT NULL DEFAULT 'RETURN',
  `cache_date` datetime NOT NULL,
  `cache_expires` datetime NOT NULL,
  PRIMARY KEY (`cache_id`,`cache_language_id`),
  KEY `cache_id` (`cache_id`),
  KEY `cache_language_id` (`cache_language_id`),
  KEY `cache_global` (`cache_global`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('3f99e969ab97a4ed9b2f66db76e4c167',4,'seo_urls_v2_MANUFACTURERS','AwA=',1,1,'EVAL','2017-12-14 00:41:13','2018-01-13 00:41:13'),('5aea2ef0968befad405de776007fa7b2',4,'seo_urls_v2_PRODUCTS','AwA=',1,1,'EVAL','2017-12-14 00:41:12','2018-01-13 00:41:12'),('82c85abb1a53ab2274cf8f913897f181',4,'seo_urls_v2_CATEGORIES','AwA=',1,1,'EVAL','2017-12-14 00:41:12','2018-01-13 00:41:12');
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL AUTO_INCREMENT,
  `categories_image` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `sort_order` int(12) DEFAULT '1',
  `date_added` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`categories_id`),
  KEY `idx_categories_parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories_description`
--

DROP TABLE IF EXISTS `categories_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories_description` (
  `categories_id` int(11) NOT NULL DEFAULT '0',
  `cached` int(1) DEFAULT '0',
  `cached_admin` int(1) DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '1',
  `categories_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `categories_description` text COLLATE utf8_unicode_ci,
  `categories_seo_title` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `categories_seo_description` text COLLATE utf8_unicode_ci,
  `categories_seo_keywords` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `categories_alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `categories_htc_title_tag` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `categories_htc_title_tag_alt` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `categories_htc_title_tag_url` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `categories_htc_desc_tag` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `categories_htc_keywords_tag` text COLLATE utf8_unicode_ci,
  `categories_htc_description` text COLLATE utf8_unicode_ci,
  `categories_htc_breadcrumb_text` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`categories_id`,`language_id`),
  KEY `idx_categories_name` (`categories_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories_description`
--

LOCK TABLES `categories_description` WRITE;
/*!40000 ALTER TABLE `categories_description` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuration`
--

DROP TABLE IF EXISTS `configuration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuration` (
  `configuration_id` int(11) NOT NULL AUTO_INCREMENT,
  `configuration_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `configuration_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `configuration_value` text COLLATE utf8_unicode_ci NOT NULL,
  `configuration_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `configuration_group_id` int(11) NOT NULL,
  `sort_order` int(5) DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `use_function` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `set_function` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`configuration_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1015 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuration`
--

LOCK TABLES `configuration` WRITE;
/*!40000 ALTER TABLE `configuration` DISABLE KEYS */;
INSERT INTO `configuration` VALUES (1,'Store Name','STORE_NAME','Nový obchod','The name of my store',1,1,'2017-12-09 19:31:57','2015-12-19 14:54:23',NULL,NULL),(2,'Store Owner','STORE_OWNER','Provozovatel','The name of my store owner',1,2,'2017-12-09 19:32:10','2015-12-19 14:54:23',NULL,NULL),(3,'E-Mail Address','STORE_OWNER_EMAIL_ADDRESS','root@localhost','The e-mail address of my store owner',1,3,NULL,'2015-12-19 14:54:23',NULL,NULL),(4,'E-Mail From','EMAIL_FROM','osCommerce <root@localhost>','The e-mail address used in (sent) e-mails',1,4,NULL,'2015-12-19 14:54:23',NULL,NULL),(5,'Country','STORE_COUNTRY','56','The country my store is located in <br /><br /><strong>Note: Please remember to update the store zone.</strong>',1,6,NULL,'2015-12-19 14:54:23','tep_get_country_name','tep_cfg_pull_down_country_list('),(6,'Zone','STORE_ZONE','918','The zone my store is located in',1,7,NULL,'2015-12-19 14:54:23','tep_cfg_get_zone_name','tep_cfg_pull_down_zone_list('),(7,'Expected Sort Order','EXPECTED_PRODUCTS_SORT','desc','This is the sort order used in the expected products box.',1,8,NULL,'2015-12-19 14:54:23',NULL,'tep_cfg_select_option(array(\'asc\', \'desc\'), '),(8,'Expected Sort Field','EXPECTED_PRODUCTS_FIELD','date_expected','The column to sort by in the expected products box.',1,9,NULL,'2015-12-19 14:54:23',NULL,'tep_cfg_select_option(array(\'products_name\', \'date_expected\'), '),(9,'Switch To Default Language Currency','USE_DEFAULT_LANGUAGE_CURRENCY','true','Automatically switch to the language\'s currency when it is changed',1,10,NULL,'2015-12-19 14:54:23',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(10,'Send Extra Order Emails To','SEND_EXTRA_ORDER_EMAILS_TO','','Send extra order emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;',1,11,NULL,'2015-12-19 14:54:23',NULL,NULL),(11,'Use Search-Engine Safe URLs','SEARCH_ENGINE_FRIENDLY_URLS','false','Use search-engine safe urls for all site links',1,12,NULL,'2015-12-19 14:54:23',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(12,'Display Cart After Adding Product','DISPLAY_CART','true','Display the shopping cart after adding a product (or return back to their origin)',1,14,NULL,'2015-12-19 14:54:23',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(13,'Allow Guest To Tell A Friend','ALLOW_GUEST_TO_TELL_A_FRIEND','false','Allow guests to tell a friend about a product',1,15,NULL,'2015-12-19 14:54:23',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(14,'Default Search Operator','ADVANCED_SEARCH_DEFAULT_OPERATOR','and','Default search operators',1,17,NULL,'2015-12-19 14:54:23',NULL,'tep_cfg_select_option(array(\'and\', \'or\'), '),(15,'Store Address','STORE_ADDRESS','Ulice číslo\nMěsto PSČ\nZemě','This is the Address of my store used on printable documents and displayed online',1,18,'2017-12-09 19:32:36','2015-12-19 14:54:23',NULL,'tep_cfg_textarea('),(16,'Store Phone','STORE_PHONE','+420 000 000 000','This is the phone number of my store used on printable documents and displayed online',1,19,'2017-10-02 00:44:35','2015-12-19 14:54:24',NULL,'tep_cfg_textarea('),(17,'Tax Decimal Places','TAX_DECIMAL_PLACES','0','Pad the tax value this amount of decimal places',1,20,NULL,'2015-12-19 14:54:24',NULL,NULL),(18,'Display Prices with Tax','DISPLAY_PRICE_WITH_TAX','true','Display prices with tax included (true) or add the tax at the end (false)',1,21,NULL,'2015-12-19 14:54:24',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(19,'New products Sort Order','NEW_PRODUCTS_SORT_ORDER','products_date_available DESC, products_date_added DESC','Example settings: \"products_date_available DESC, products_date_added DESC\" OR for Date Products \"products_custom_date\"',1,22,NULL,'2015-12-19 14:54:24',NULL,NULL),(20,'Default URL with www','USE_WWW','false','Default URL: www.site.com',1,23,NULL,'2015-12-19 14:54:24',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(21,'New customers id reserve','NEW_CUSTOMERS_ID_RESERVE','5','Amount of new customers reserve',1,23,NULL,'2015-12-19 14:54:24',NULL,NULL),(22,'New customers to generate','NEW_CUSTOMERS_ID_TO_GENERATE','5','How much generate new customers IDs?',1,24,NULL,'2015-12-19 14:54:24',NULL,NULL),(23,'First Name','ENTRY_FIRST_NAME_MIN_LENGTH','2','Minimum length of first name',2,1,NULL,'2015-12-19 14:54:24',NULL,NULL),(24,'Last Name','ENTRY_LAST_NAME_MIN_LENGTH','2','Minimum length of last name',2,2,NULL,'2015-12-19 14:54:24',NULL,NULL),(25,'Date of Birth','ENTRY_DOB_MIN_LENGTH','10','Minimum length of date of birth',2,3,NULL,'2015-12-19 14:54:24',NULL,NULL),(26,'E-Mail Address','ENTRY_EMAIL_ADDRESS_MIN_LENGTH','6','Minimum length of e-mail address',2,4,NULL,'2015-12-19 14:54:24',NULL,NULL),(27,'Street Address','ENTRY_STREET_ADDRESS_MIN_LENGTH','5','Minimum length of street address',2,5,NULL,'2015-12-19 14:54:24',NULL,NULL),(28,'Company','ENTRY_COMPANY_MIN_LENGTH','2','Minimum length of company name',2,6,NULL,'2015-12-19 14:54:24',NULL,NULL),(29,'Post Code','ENTRY_POSTCODE_MIN_LENGTH','4','Minimum length of post code',2,7,NULL,'2015-12-19 14:54:24',NULL,NULL),(30,'City','ENTRY_CITY_MIN_LENGTH','3','Minimum length of city',2,8,NULL,'2015-12-19 14:54:24',NULL,NULL),(31,'State','ENTRY_STATE_MIN_LENGTH','2','Minimum length of state',2,9,NULL,'2015-12-19 14:54:24',NULL,NULL),(32,'Telephone Number','ENTRY_TELEPHONE_MIN_LENGTH','3','Minimum length of telephone number',2,10,NULL,'2015-12-19 14:54:24',NULL,NULL),(33,'Password','ENTRY_PASSWORD_MIN_LENGTH','5','Minimum length of password',2,11,NULL,'2015-12-19 14:54:24',NULL,NULL),(34,'Credit Card Owner Name','CC_OWNER_MIN_LENGTH','3','Minimum length of credit card owner name',2,12,NULL,'2015-12-19 14:54:24',NULL,NULL),(35,'Credit Card Number','CC_NUMBER_MIN_LENGTH','10','Minimum length of credit card number',2,13,NULL,'2015-12-19 14:54:24',NULL,NULL),(36,'Review Text','REVIEW_TEXT_MIN_LENGTH','50','Minimum length of review text',2,14,NULL,'2015-12-19 14:54:24',NULL,NULL),(37,'Best Sellers','MIN_DISPLAY_BESTSELLERS','1','Minimum number of best sellers to display',2,15,NULL,'2015-12-19 14:54:24',NULL,NULL),(38,'Also Purchased','MIN_DISPLAY_ALSO_PURCHASED','1','Minimum number of products to display in the \'This Customer Also Purchased\' box',2,16,NULL,'2015-12-19 14:54:25',NULL,NULL),(39,'Address Book Entries','MAX_ADDRESS_BOOK_ENTRIES','5','Maximum address book entries a customer is allowed to have',3,1,NULL,'2015-12-19 14:54:25',NULL,NULL),(40,'Search Results','MAX_DISPLAY_SEARCH_RESULTS','21','Amount of products to list',3,2,'2017-10-01 23:26:45','2015-12-19 14:54:25',NULL,NULL),(41,'Page Links','MAX_DISPLAY_PAGE_LINKS','5','Number of \'number\' links use for page-sets',3,3,NULL,'2015-12-19 14:54:25',NULL,NULL),(42,'Special Products','MAX_DISPLAY_SPECIAL_PRODUCTS','9','Maximum number of products on special to display',3,4,NULL,'2015-12-19 14:54:25',NULL,NULL),(43,'New Products Module','MAX_DISPLAY_NEW_PRODUCTS','9','Maximum number of new products to display in a category',3,5,NULL,'2015-12-19 14:54:25',NULL,NULL),(44,'Products Expected','MAX_DISPLAY_UPCOMING_PRODUCTS','10','Maximum number of products expected to display',3,6,NULL,'2015-12-19 14:54:25',NULL,NULL),(45,'Manufacturers List','MAX_DISPLAY_MANUFACTURERS_IN_A_LIST','0','Used in manufacturers box; when the number of manufacturers exceeds this number, a drop-down list will be displayed instead of the default list',3,7,NULL,'2015-12-19 14:54:25',NULL,NULL),(46,'Manufacturers Select Size','MAX_MANUFACTURERS_LIST','1','Used in manufacturers box; when this value is \'1\' the classic drop-down list will be used for the manufacturers box. Otherwise, a list-box with the specified number of rows will be displayed.',3,7,NULL,'2015-12-19 14:54:25',NULL,NULL),(47,'Length of Manufacturers Name','MAX_DISPLAY_MANUFACTURER_NAME_LEN','15','Used in manufacturers box; maximum length of manufacturers name to display',3,8,NULL,'2015-12-19 14:54:25',NULL,NULL),(48,'New Reviews','MAX_DISPLAY_NEW_REVIEWS','6','Maximum number of new reviews to display',3,9,NULL,'2015-12-19 14:54:25',NULL,NULL),(49,'Selection of Random Reviews','MAX_RANDOM_SELECT_REVIEWS','10','How many records to select from to choose one random product review',3,10,NULL,'2015-12-19 14:54:25',NULL,NULL),(50,'Selection of Random New Products','MAX_RANDOM_SELECT_NEW','10','How many records to select from to choose one random new product to display',3,11,NULL,'2015-12-19 14:54:25',NULL,NULL),(51,'Selection of Products on Special','MAX_RANDOM_SELECT_SPECIALS','10','How many records to select from to choose one random product special to display',3,12,NULL,'2015-12-19 14:54:25',NULL,NULL),(52,'Categories To List Per Row','MAX_DISPLAY_CATEGORIES_PER_ROW','3','How many categories to list per row',3,13,NULL,'2015-12-19 14:54:25',NULL,NULL),(53,'New Products Listing','MAX_DISPLAY_PRODUCTS_NEW','10','Maximum number of new products to display in new products page',3,14,NULL,'2015-12-19 14:54:25',NULL,NULL),(54,'Best Sellers','MAX_DISPLAY_BESTSELLERS','10','Maximum number of best sellers to display',3,15,NULL,'2015-12-19 14:54:25',NULL,NULL),(55,'Also Purchased','MAX_DISPLAY_ALSO_PURCHASED','6','Maximum number of products to display in the \'This Customer Also Purchased\' box',3,16,NULL,'2015-12-19 14:54:25',NULL,NULL),(56,'Customer Order History Box','MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX','6','Maximum number of products to display in the customer order history box',3,17,NULL,'2015-12-19 14:54:25',NULL,NULL),(57,'Order History','MAX_DISPLAY_ORDER_HISTORY','10','Maximum number of orders to display in the order history page',3,18,NULL,'2015-12-19 14:54:26',NULL,NULL),(58,'Product Quantities In Shopping Cart','MAX_QTY_IN_CART','99','Maximum number of product quantities that can be added to the shopping cart (0 for no limit)',3,19,NULL,'2015-12-19 14:54:26',NULL,NULL),(59,'Small Image Width','SMALL_IMAGE_WIDTH','100','The pixel width of small images',4,1,NULL,'2015-12-19 14:54:26',NULL,NULL),(60,'Small Image Height','SMALL_IMAGE_HEIGHT','80','The pixel height of small images',4,2,NULL,'2015-12-19 14:54:26',NULL,NULL),(61,'Heading Image Width','HEADING_IMAGE_WIDTH','57','The pixel width of heading images',4,3,NULL,'2015-12-19 14:54:26',NULL,NULL),(62,'Heading Image Height','HEADING_IMAGE_HEIGHT','40','The pixel height of heading images',4,4,NULL,'2015-12-19 14:54:26',NULL,NULL),(63,'Subcategory Image Width','SUBCATEGORY_IMAGE_WIDTH','100','The pixel width of subcategory images',4,5,NULL,'2015-12-19 14:54:26',NULL,NULL),(64,'Subcategory Image Height','SUBCATEGORY_IMAGE_HEIGHT','57','The pixel height of subcategory images',4,6,NULL,'2015-12-19 14:54:26',NULL,NULL),(65,'Calculate Image Size','CONFIG_CALCULATE_IMAGE_SIZE','true','Calculate the size of images?',4,7,NULL,'2015-12-19 14:54:26',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(66,'Image Required','IMAGE_REQUIRED','true','Enable to display broken images. Good for development.',4,8,NULL,'2015-12-19 14:54:26',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(67,'Gender','ACCOUNT_GENDER','false','Display gender in the customers account',5,1,NULL,'2015-12-19 14:54:26',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(68,'Date of Birth','ACCOUNT_DOB','false','Display date of birth in the customers account',5,2,NULL,'2015-12-19 14:54:26',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(69,'Company','ACCOUNT_COMPANY','true','Display company in the customers account',5,3,NULL,'2015-12-19 14:54:26',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(70,'Suburb','ACCOUNT_SUBURB','false','Display suburb in the customers account',5,4,NULL,'2015-12-19 14:54:26',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(71,'State','ACCOUNT_STATE','false','Display state in the customers account',5,5,NULL,'2015-12-19 14:54:26',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(72,'Installed Modules','MODULE_PAYMENT_INSTALLED','moneyorder.php;cod.php;paypal_express.php','List of payment module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: cod.php;paypal_express.php)',6,0,'2017-12-10 03:54:07','2015-12-19 14:54:26',NULL,NULL),(73,'Installed Modules','MODULE_ORDER_TOTAL_INSTALLED','ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_total.php','List of order_total module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_total.php)',6,0,NULL,'2015-12-19 14:54:26',NULL,NULL),(74,'Installed Modules','MODULE_SHIPPING_INSTALLED','zones.php','List of shipping module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: ups.php;flat.php;item.php)',6,0,'2017-12-10 04:04:21','2015-12-19 14:54:26',NULL,NULL),(75,'Installed Modules','MODULE_ACTION_RECORDER_INSTALLED','ar_admin_login.php;ar_contact_us.php;ar_reset_password.php;ar_tell_a_friend.php','List of action recorder module filenames separated by a semi-colon. This is automatically updated. No need to edit.',6,0,NULL,'2015-12-19 14:54:26',NULL,NULL),(76,'Installed Modules','MODULE_SOCIAL_BOOKMARKS_INSTALLED','sb_email.php;sb_facebook.php;sb_google_plus_share.php;sb_pinterest.php;sb_twitter.php','List of social bookmark module filenames separated by a semi-colon. This is automatically updated. No need to edit.',6,0,NULL,'2015-12-19 14:54:26',NULL,NULL),(86,'Default Currency','DEFAULT_CURRENCY','CZK','Default Currency',6,0,NULL,'2015-12-19 14:54:27',NULL,NULL),(87,'Default Language','DEFAULT_LANGUAGE','cs','Default Language',6,0,NULL,'2015-12-19 14:54:27',NULL,NULL),(88,'Default Order Status For New Orders','DEFAULT_ORDERS_STATUS_ID','1','When a new order is created, this order status will be assigned to it.',6,0,NULL,'2015-12-19 14:54:27',NULL,NULL),(89,'Display Shipping','MODULE_ORDER_TOTAL_SHIPPING_STATUS','true','Do you want to display the order shipping cost?',6,1,NULL,'2015-12-19 14:54:27',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(90,'Sort Order','MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER','2','Sort order of display.',6,2,NULL,'2015-12-19 14:54:27',NULL,NULL),(91,'Allow Free Shipping','MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING','false','Do you want to allow free shipping?',6,3,NULL,'2015-12-19 14:54:27',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(92,'Free Shipping For Orders Over','MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER','50','Provide free shipping for orders over the set amount.',6,4,NULL,'2015-12-19 14:54:27','currencies->format',NULL),(93,'Provide Free Shipping For Orders Made','MODULE_ORDER_TOTAL_SHIPPING_DESTINATION','national','Provide free shipping for orders sent to the set destination.',6,5,NULL,'2015-12-19 14:54:27',NULL,'tep_cfg_select_option(array(\'national\', \'international\', \'both\'), '),(94,'Display Sub-Total','MODULE_ORDER_TOTAL_SUBTOTAL_STATUS','true','Do you want to display the order sub-total cost?',6,1,NULL,'2015-12-19 14:54:27',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(95,'Sort Order','MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER','1','Sort order of display.',6,2,NULL,'2015-12-19 14:54:27',NULL,NULL),(96,'Display Tax','MODULE_ORDER_TOTAL_TAX_STATUS','true','Do you want to display the order tax value?',6,1,NULL,'2015-12-19 14:54:27',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(97,'Sort Order','MODULE_ORDER_TOTAL_TAX_SORT_ORDER','3','Sort order of display.',6,2,NULL,'2015-12-19 14:54:27',NULL,NULL),(98,'Display Total','MODULE_ORDER_TOTAL_TOTAL_STATUS','true','Do you want to display the total order value?',6,1,NULL,'2015-12-19 14:54:27',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(99,'Sort Order','MODULE_ORDER_TOTAL_TOTAL_SORT_ORDER','4','Sort order of display.',6,2,NULL,'2015-12-19 14:54:27',NULL,NULL),(100,'Minimum Minutes Per E-Mail','MODULE_ACTION_RECORDER_CONTACT_US_EMAIL_MINUTES','15','Minimum number of minutes to allow 1 e-mail to be sent (eg, 15 for 1 e-mail every 15 minutes)',6,0,NULL,'2015-12-19 14:54:28',NULL,NULL),(101,'Minimum Minutes Per E-Mail','MODULE_ACTION_RECORDER_TELL_A_FRIEND_EMAIL_MINUTES','15','Minimum number of minutes to allow 1 e-mail to be sent (eg, 15 for 1 e-mail every 15 minutes)',6,0,NULL,'2015-12-19 14:54:28',NULL,NULL),(102,'Allowed Minutes','MODULE_ACTION_RECORDER_ADMIN_LOGIN_MINUTES','5','Number of minutes to allow login attempts to occur.',6,0,NULL,'2015-12-19 14:54:28',NULL,NULL),(103,'Allowed Attempts','MODULE_ACTION_RECORDER_ADMIN_LOGIN_ATTEMPTS','3','Number of login attempts to allow within the specified period.',6,0,NULL,'2015-12-19 14:54:28',NULL,NULL),(104,'Allowed Minutes','MODULE_ACTION_RECORDER_RESET_PASSWORD_MINUTES','5','Number of minutes to allow password resets to occur.',6,0,NULL,'2015-12-19 14:54:28',NULL,NULL),(105,'Allowed Attempts','MODULE_ACTION_RECORDER_RESET_PASSWORD_ATTEMPTS','1','Number of password reset attempts to allow within the specified period.',6,0,NULL,'2015-12-19 14:54:28',NULL,NULL),(106,'Enable E-Mail Module','MODULE_SOCIAL_BOOKMARKS_EMAIL_STATUS','True','Do you want to allow products to be shared through e-mail?',6,1,NULL,'2015-12-19 14:54:28',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(107,'Sort Order','MODULE_SOCIAL_BOOKMARKS_EMAIL_SORT_ORDER','10','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:28',NULL,NULL),(108,'Enable Google+ Share Module','MODULE_SOCIAL_BOOKMARKS_GOOGLE_PLUS_SHARE_STATUS','True','Do you want to allow products to be shared through Google+?',6,1,NULL,'2015-12-19 14:54:28',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(109,'Annotation','MODULE_SOCIAL_BOOKMARKS_GOOGLE_PLUS_SHARE_ANNOTATION','None','The annotation to display next to the button.',6,1,NULL,'2015-12-19 14:54:28',NULL,'tep_cfg_select_option(array(\'Inline\', \'Bubble\', \'Vertical-Bubble\', \'None\'), '),(110,'Width','MODULE_SOCIAL_BOOKMARKS_GOOGLE_PLUS_SHARE_WIDTH','','The maximum width of the button.',6,0,NULL,'2015-12-19 14:54:28',NULL,NULL),(111,'Height','MODULE_SOCIAL_BOOKMARKS_GOOGLE_PLUS_SHARE_HEIGHT','15','Sets the height of the button.',6,1,NULL,'2015-12-19 14:54:28',NULL,'tep_cfg_select_option(array(\'15\', \'20\', \'24\', \'60\'), '),(112,'Alignment','MODULE_SOCIAL_BOOKMARKS_GOOGLE_PLUS_SHARE_ALIGN','Left','The alignment of the button assets.',6,1,NULL,'2015-12-19 14:54:28',NULL,'tep_cfg_select_option(array(\'Left\', \'Right\'), '),(113,'Sort Order','MODULE_SOCIAL_BOOKMARKS_GOOGLE_PLUS_SHARE_SORT_ORDER','20','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:28',NULL,NULL),(114,'Enable Facebook Module','MODULE_SOCIAL_BOOKMARKS_FACEBOOK_STATUS','True','Do you want to allow products to be shared through Facebook?',6,1,NULL,'2015-12-19 14:54:28',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(115,'Sort Order','MODULE_SOCIAL_BOOKMARKS_FACEBOOK_SORT_ORDER','30','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:28',NULL,NULL),(116,'Enable Twitter Module','MODULE_SOCIAL_BOOKMARKS_TWITTER_STATUS','True','Do you want to allow products to be shared through Twitter?',6,1,NULL,'2015-12-19 14:54:28',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(117,'Sort Order','MODULE_SOCIAL_BOOKMARKS_TWITTER_SORT_ORDER','40','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:28',NULL,NULL),(118,'Enable Pinterest Module','MODULE_SOCIAL_BOOKMARKS_PINTEREST_STATUS','True','Do you want to allow Pinterest Button?',6,1,NULL,'2015-12-19 14:54:28',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(119,'Layout Position','MODULE_SOCIAL_BOOKMARKS_PINTEREST_BUTTON_COUNT_POSITION','None','Horizontal or Vertical or None',6,2,NULL,'2015-12-19 14:54:28',NULL,'tep_cfg_select_option(array(\'Horizontal\', \'Vertical\', \'None\'), '),(120,'Sort Order','MODULE_SOCIAL_BOOKMARKS_PINTEREST_SORT_ORDER','50','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:29',NULL,NULL),(121,'Country of Origin','SHIPPING_ORIGIN_COUNTRY','223','Select the country of origin to be used in shipping quotes.',7,1,NULL,'2015-12-19 14:54:29','tep_get_country_name','tep_cfg_pull_down_country_list('),(122,'Postal Code','SHIPPING_ORIGIN_ZIP','NONE','Enter the Postal Code (ZIP) of the Store to be used in shipping quotes.',7,2,NULL,'2015-12-19 14:54:29',NULL,NULL),(123,'Enter the Maximum Package Weight you will ship','SHIPPING_MAX_WEIGHT','50','Carriers have a max weight limit for a single package. This is a common one for all.',7,3,NULL,'2015-12-19 14:54:29',NULL,NULL),(124,'Package Tare weight.','SHIPPING_BOX_WEIGHT','3','What is the weight of typical packaging of small to medium packages?',7,4,NULL,'2015-12-19 14:54:29',NULL,NULL),(125,'Larger packages - percentage increase.','SHIPPING_BOX_PADDING','10','For 10% enter 10',7,5,NULL,'2015-12-19 14:54:29',NULL,NULL),(126,'Allow Orders Not Matching Defined Shipping Zones ','SHIPPING_ALLOW_UNDEFINED_ZONES','False','Should orders be allowed to shipping addresses not matching defined shipping module shipping zones?',7,5,NULL,'2015-12-19 14:54:29',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(127,'Display Product Image','PRODUCT_LIST_IMAGE','1','Do you want to display the Product Image?',8,1,NULL,'2015-12-19 14:54:29',NULL,NULL),(128,'Display Product Manufacturer Name','PRODUCT_LIST_MANUFACTURER','0','Do you want to display the Product Manufacturer Name?',8,2,NULL,'2015-12-19 14:54:29',NULL,NULL),(129,'Display Product Model','PRODUCT_LIST_MODEL','0','Do you want to display the Product Model?',8,3,NULL,'2015-12-19 14:54:29',NULL,NULL),(130,'Display Product Name','PRODUCT_LIST_NAME','2','Do you want to display the Product Name?',8,4,NULL,'2015-12-19 14:54:29',NULL,NULL),(131,'Display Product Price','PRODUCT_LIST_PRICE','3','Do you want to display the Product Price',8,5,NULL,'2015-12-19 14:54:29',NULL,NULL),(132,'Display Product Quantity','PRODUCT_LIST_QUANTITY','0','Do you want to display the Product Quantity?',8,6,NULL,'2015-12-19 14:54:29',NULL,NULL),(133,'Display Product Weight','PRODUCT_LIST_WEIGHT','0','Do you want to display the Product Weight?',8,7,NULL,'2015-12-19 14:54:29',NULL,NULL),(134,'Display Buy Now column','PRODUCT_LIST_BUY_NOW','4','Do you want to display the Buy Now column?',8,8,NULL,'2015-12-19 14:54:29',NULL,NULL),(135,'Date available sort key','PRODUCT_LIST_DATE_AVAILABLE','9','Sort by date available',8,9,NULL,'2015-12-19 14:54:30',NULL,NULL),(136,'Custom date sort key','PRODUCT_LIST_CUSTOM_DATE','10','Sort by event date',8,10,NULL,'2015-12-19 14:54:30',NULL,NULL),(137,'Sort order sort key','PRODUCT_LIST_SORT_ORDER','11','Sort by sort order',8,11,NULL,'2015-12-19 14:54:30',NULL,NULL),(138,'Default sort order','PRODUCT_LIST_DEFAULT_SORT_ORDER','products_date_available DESC, products_date_added DESC, products_name','Example settings: \"products_date_available DESC, products_date_added DESC, products_name\" OR \"products_custom_date\" OR \"products_sort_order, products_name\"',8,12,NULL,'2015-12-19 14:54:30',NULL,NULL),(139,'Display Category/Manufacturer Filter (0=disable; 1=enable)','PRODUCT_LIST_FILTER','1','Do you want to display the Category/Manufacturer Filter?',8,12,NULL,'2015-12-19 14:54:30',NULL,NULL),(140,'Location of Prev/Next Navigation Bar (1-top, 2-bottom, 3-both)','PREV_NEXT_BAR_LOCATION','2','Sets the location of the Prev/Next Navigation Bar (1-top, 2-bottom, 3-both)',8,13,NULL,'2015-12-19 14:54:30',NULL,NULL),(141,'Check stock level','STOCK_CHECK','true','Check to see if sufficent stock is available',9,1,NULL,'2015-12-19 14:54:30',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(142,'Subtract stock','STOCK_LIMITED','true','Subtract product in stock by product orders',9,2,NULL,'2015-12-19 14:54:30',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(143,'Allow Checkout','STOCK_ALLOW_CHECKOUT','true','Allow customer to checkout even if there is insufficient stock',9,3,NULL,'2015-12-19 14:54:30',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(144,'Mark product out of stock','STOCK_MARK_PRODUCT_OUT_OF_STOCK','***','Display something on screen so customer can see which product has insufficient stock',9,4,NULL,'2015-12-19 14:54:30',NULL,NULL),(145,'Stock Re-order level','STOCK_REORDER_LEVEL','5','Define when stock needs to be re-ordered',9,5,NULL,'2015-12-19 14:54:30',NULL,NULL),(146,'Store Page Parse Time','STORE_PAGE_PARSE_TIME','false','Store the time it takes to parse a page',10,1,NULL,'2015-12-19 14:54:30',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(147,'Log Destination','STORE_PAGE_PARSE_TIME_LOG','/var/log/www/tep/page_parse_time.log','Directory and filename of the page parse time log',10,2,NULL,'2015-12-19 14:54:30',NULL,NULL),(148,'Log Date Format','STORE_PARSE_DATE_TIME_FORMAT','%d/%m/%Y %H:%M:%S','The date format',10,3,NULL,'2015-12-19 14:54:30',NULL,NULL),(149,'Display The Page Parse Time','DISPLAY_PAGE_PARSE_TIME','true','Display the page parse time (store page parse time must be enabled)',10,4,NULL,'2015-12-19 14:54:30',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(150,'Store Database Queries','STORE_DB_TRANSACTIONS','false','Store the database queries in the page parse time log',10,5,NULL,'2015-12-19 14:54:30',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(151,'Use Cache','USE_CACHE','true','Use caching features',11,1,'2017-05-14 02:23:23','2015-12-19 14:54:30',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(152,'Cache Directory','DIR_FS_CACHE','/tmp/osc_cache/','The directory where the cached files are saved',11,2,'2016-05-11 06:14:51','2015-12-19 14:54:30',NULL,NULL),(153,'E-Mail Transport Method','EMAIL_TRANSPORT','sendmail','Defines if this server uses a local connection to sendmail or uses an SMTP connection via TCP/IP. Servers running on Windows and MacOS should change this setting to SMTP.',12,1,NULL,'2015-12-19 14:54:30',NULL,'tep_cfg_select_option(array(\'sendmail\', \'smtp\', \'gmail\'),'),(154,'E-Mail Linefeeds','EMAIL_LINEFEED','LF','Defines the character sequence used to separate mail headers.',12,2,NULL,'2015-12-19 14:54:30',NULL,'tep_cfg_select_option(array(\'LF\', \'CRLF\'),'),(155,'Use MIME HTML When Sending Emails','EMAIL_USE_HTML','false','Send e-mails in HTML format',12,3,NULL,'2015-12-19 14:54:30',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(156,'Verify E-Mail Addresses Through DNS','ENTRY_EMAIL_ADDRESS_CHECK','false','Verify e-mail address through a DNS server',12,4,NULL,'2015-12-19 14:54:30',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(157,'Send E-Mails','SEND_EMAILS','true','Send out e-mails',12,5,NULL,'2015-12-19 14:54:31',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(158,'SMTP hosts','EMAIL_SMTP_HOSTS','','Assign SMTP host senders',12,6,NULL,'2015-12-19 14:54:31',NULL,NULL),(159,'SMTP authentication','EMAIL_SMTP_AUTHENTICATION','true','Do you want authenticated SMTP server?',12,7,NULL,'2015-12-19 14:54:31',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(160,'SMTP Password','EMAIL_SMTP_PASSWORD','','Add SMTP Password for SMTP protocol',12,8,NULL,'2015-12-19 14:54:31','tep_cfg_password','tep_cfg_input_password('),(161,'SMTP User','EMAIL_SMTP_USER','','Add SMTP user for SMTP protocol',12,9,NULL,'2015-12-19 14:54:31',NULL,NULL),(162,'SMTP Reply To','EMAIL_SMTP_REPLYTO','','Add SMTP reply to address',12,10,NULL,'2015-12-19 14:54:31',NULL,NULL),(163,'Enable download','DOWNLOAD_ENABLED','false','Enable the products download functions.',13,1,NULL,'2015-12-19 14:54:31',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(164,'Download by redirect','DOWNLOAD_BY_REDIRECT','false','Use browser redirection for download. Disable on non-Unix systems.',13,2,NULL,'2015-12-19 14:54:31',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(165,'Expiry delay (days)','DOWNLOAD_MAX_DAYS','7','Set number of days before the download link expires. 0 means no limit.',13,3,NULL,'2015-12-19 14:54:31',NULL,''),(166,'Maximum number of downloads','DOWNLOAD_MAX_COUNT','5','Set the maximum number of downloads. 0 means no download authorized.',13,4,NULL,'2015-12-19 14:54:31',NULL,''),(167,'Enable GZip Compression','GZIP_COMPRESSION','true','Enable HTTP GZip compression.',14,1,'2016-05-11 05:12:46','2015-12-19 14:54:31',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(168,'Compression Level','GZIP_LEVEL','5','Use this compression level 0-9 (0 = minimum, 9 = maximum).',14,2,NULL,'2015-12-19 14:54:31',NULL,NULL),(169,'Session Directory','SESSION_WRITE_DIRECTORY','/tmp','If sessions are file based, store them in this directory.',15,1,NULL,'2015-12-19 14:54:31',NULL,NULL),(171,'Check SSL Session ID','SESSION_CHECK_SSL_SESSION_ID','False','Validate the SSL_SESSION_ID on every secure HTTPS page request.',15,3,NULL,'2015-12-19 14:54:31',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(172,'Check User Agent','SESSION_CHECK_USER_AGENT','False','Validate the clients browser user agent on every page request.',15,4,NULL,'2015-12-19 14:54:31',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(173,'Check IP Address','SESSION_CHECK_IP_ADDRESS','False','Validate the clients IP address on every page request.',15,5,NULL,'2015-12-19 14:54:31',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(174,'Prevent Spider Sessions','SESSION_BLOCK_SPIDERS','True','Prevent known spiders from starting a session.',15,6,NULL,'2015-12-19 14:54:31',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(175,'Recreate Session','SESSION_RECREATE','True','Recreate the session to generate a new session ID when the customer logs on or creates an account (PHP >=4.1 needed).',15,7,NULL,'2015-12-19 14:54:31',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(176,'Last Update Check Time','LAST_UPDATE_CHECK_TIME','','Last time a check for new versions of osCommerce was run',6,0,NULL,'2015-12-19 14:54:31',NULL,NULL),(177,'Store Logo','STORE_LOGO','store_logo.png','This is the filename of your Store Logo.  This should be updated at admin > configuration > Store Logo',6,1000,NULL,'2015-12-19 14:54:31',NULL,NULL),(178,'Bootstrap Container','BOOTSTRAP_CONTAINER','container','What type of container should the page content be shown in? See http://getbootstrap.com/css/#overview-container',16,1,NULL,'2015-12-19 14:54:31',NULL,'tep_cfg_select_option(array(\'container-fluid\', \'container\'), '),(179,'Bootstrap Content','BOOTSTRAP_CONTENT','8','What width should the page content default to?  (8 = two thirds width, 6 = half width, 4 = one third width) Note that the Side Column(s) will adjust automatically.',16,2,NULL,'2015-12-19 14:54:31',NULL,'tep_cfg_select_option(array(\'8\', \'6\', \'4\'), '),(180,'Display products DateAvailable (expected)','DISPLAY_DATE_AVAILABLE','true','Display products DateAvailable (expected)?',17,1,NULL,'2015-12-19 14:54:32',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(181,'Display products custom date','DISPLAY_PRODUCTS_CUSTOM_DATE','true','Display products custom/events date?',17,2,NULL,'2015-12-19 14:54:32',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(182,'Display products sort order','DISPLAY_PRODUCTS_SORT_ORDER','true','Display products sort order?',17,3,NULL,'2015-12-19 14:54:32',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(183,'Display products manfacturer','DISPLAY_PRODUCTS_MANUFACTURER','true','Display products manfacturer',17,4,NULL,'2015-12-19 14:54:32',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(184,'Display products SEO title','DISPLAY_PRODUCTS_SEO_TITLE','true','Display products SEO title?',17,5,NULL,'2015-12-19 14:54:32',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(185,'Display Tax Class','DISPLAY_PRODUCTS_TAX_CLASS','true','Display Tax Class?',17,5,NULL,'2015-12-19 14:54:32',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(186,'Display Mini description','DISPLAY_PRODUCTS_MINI_DESCRIPTION','true','Display Mini description?',17,6,NULL,'2015-12-19 14:54:32',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(187,'Display products quantity','DISPLAY_PRODUCTS_QUANTITY','true','Display products quantity?',17,7,NULL,'2015-12-19 14:54:32',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(188,'Display products Model','DISPLAY_PRODUCTS_MODEL','true','Display products Model?',17,8,NULL,'2015-12-19 14:54:32',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(189,'Display products URL','DISPLAY_PRODUCTS_URL','false','Display products URL?',17,9,'2017-09-23 02:02:08','2015-12-19 14:54:32',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(190,'Display products weight','DISPLAY_PRODUCTS_WEIGHT','true','Display products weight?',17,10,NULL,'2015-12-19 14:54:32',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(191,'Display products SEO description','DISPLAY_PRODUCTS_SEO_DESCRIPTION','true','Display products SEO description?',17,11,NULL,'2015-12-19 14:54:32',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(192,'Display products SEO keywords','DISPLAY_PRODUCTS_SEO_KEYWORDS','true','Display products SEO keywords?',17,12,NULL,'2015-12-19 14:54:32',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(193,'Enable PayPal Express Checkout','MODULE_PAYMENT_PAYPAL_EXPRESS_STATUS','True','Do you want to accept PayPal Express Checkout payments?',6,1,NULL,'2015-12-19 14:54:50',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(194,'Seller Account','MODULE_PAYMENT_PAYPAL_EXPRESS_SELLER_ACCOUNT','','The email address of the seller account if no API credentials has been setup.',6,0,NULL,'2015-12-19 14:54:50',NULL,NULL),(195,'API Username','MODULE_PAYMENT_PAYPAL_EXPRESS_API_USERNAME','','The username to use for the PayPal API service',6,0,NULL,'2015-12-19 14:54:50',NULL,NULL),(196,'API Password','MODULE_PAYMENT_PAYPAL_EXPRESS_API_PASSWORD','','The password to use for the PayPal API service',6,0,NULL,'2015-12-19 14:54:50',NULL,NULL),(197,'API Signature','MODULE_PAYMENT_PAYPAL_EXPRESS_API_SIGNATURE','','The signature to use for the PayPal API service',6,0,NULL,'2015-12-19 14:54:50',NULL,NULL),(198,'PayPal Account Optional','MODULE_PAYMENT_PAYPAL_EXPRESS_ACCOUNT_OPTIONAL','False','This must also be enabled in your PayPal account, in Profile > Website Payment Preferences.',6,0,NULL,'2015-12-19 14:54:50',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(199,'PayPal Instant Update','MODULE_PAYMENT_PAYPAL_EXPRESS_INSTANT_UPDATE','True','Support PayPal shipping and tax calculations on the PayPal.com site during Express Checkout.',6,0,NULL,'2015-12-19 14:54:50',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(200,'PayPal Checkout Image','MODULE_PAYMENT_PAYPAL_EXPRESS_CHECKOUT_IMAGE','Static','Use static or dynamic Express Checkout image buttons. Dynamic images are used with PayPal campaigns.',6,0,NULL,'2015-12-19 14:54:51',NULL,'tep_cfg_select_option(array(\'Static\', \'Dynamic\'), '),(201,'Page Style','MODULE_PAYMENT_PAYPAL_EXPRESS_PAGE_STYLE','','The page style to use for the checkout flow (defined at your PayPal Profile page)',6,0,NULL,'2015-12-19 14:54:51',NULL,NULL),(202,'Transaction Method','MODULE_PAYMENT_PAYPAL_EXPRESS_TRANSACTION_METHOD','Sale','The processing method to use for each transaction.',6,0,NULL,'2015-12-19 14:54:51',NULL,'tep_cfg_select_option(array(\'Authorization\', \'Sale\'), '),(203,'Set Order Status','MODULE_PAYMENT_PAYPAL_EXPRESS_ORDER_STATUS_ID','0','Set the status of orders made with this payment module to this value',6,0,NULL,'2015-12-19 14:54:51','tep_get_order_status_name','tep_cfg_pull_down_order_statuses('),(204,'PayPal Transactions Order Status Level','MODULE_PAYMENT_PAYPAL_EXPRESS_TRANSACTIONS_ORDER_STATUS_ID','4','Include PayPal transaction information in this order status level',6,0,NULL,'2015-12-19 14:54:51','tep_get_order_status_name','tep_cfg_pull_down_order_statuses('),(205,'Payment Zone','MODULE_PAYMENT_PAYPAL_EXPRESS_ZONE','0','If a zone is selected, only enable this payment method for that zone.',6,2,NULL,'2015-12-19 14:54:51','tep_get_zone_class_title','tep_cfg_pull_down_zone_classes('),(206,'Transaction Server','MODULE_PAYMENT_PAYPAL_EXPRESS_TRANSACTION_SERVER','Live','Use the live or testing (sandbox) gateway server to process transactions?',6,0,NULL,'2015-12-19 14:54:51',NULL,'tep_cfg_select_option(array(\'Live\', \'Sandbox\'), '),(207,'Verify SSL Certificate','MODULE_PAYMENT_PAYPAL_EXPRESS_VERIFY_SSL','True','Verify gateway server SSL certificate on connection?',6,1,NULL,'2015-12-19 14:54:51',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(208,'Proxy Server','MODULE_PAYMENT_PAYPAL_EXPRESS_PROXY','','Send API requests through this proxy server. (host:port, eg: 123.45.67.89:8080 or proxy.example.com:8080)',6,0,NULL,'2015-12-19 14:54:51',NULL,NULL),(209,'Debug E-Mail Address','MODULE_PAYMENT_PAYPAL_EXPRESS_DEBUG_EMAIL','','All parameters of an invalid transaction will be sent to this email address.',6,0,NULL,'2015-12-19 14:54:51',NULL,NULL),(210,'Sort order of display.','MODULE_PAYMENT_PAYPAL_EXPRESS_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:51',NULL,NULL),(211,'Installed Modules','MODULE_HEADER_TAGS_INSTALLED','ht_article_meta.php;ht_article_title.php;ht_manufacturer_title.php;ht_category_title.php;ht_product_title.php;ht_canonical.php;ht_category_meta.php;ht_robot_noindex.php;ht_datepicker_jquery.php;ht_div_equal_heights.php;ht_grid_list_view.php;ht_manufacturer_meta.php;ht_table_click_jquery.php;ht_product_colorbox.php;ht_noscript.php;ht_pages_meta.php;ht_pages_seo.php;ht_pages_title.php;ht_product_meta.php;ht_topic_title.php','List of header tag module filenames separated by a semi-colon. This is automatically updated. No need to edit.',6,0,'2017-11-20 17:56:46','2015-12-19 14:54:51',NULL,NULL),(212,'Enable Category Title Module','MODULE_HEADER_TAGS_CATEGORY_TITLE_STATUS','True','Do you want to allow category titles to be added to the page title?',6,1,NULL,'2015-12-19 14:54:51',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(213,'Sort Order','MODULE_HEADER_TAGS_CATEGORY_TITLE_SORT_ORDER','200','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:51',NULL,NULL),(214,'Enable Manufacturer Title Module','MODULE_HEADER_TAGS_MANUFACTURER_TITLE_STATUS','True','Do you want to allow manufacturer titles to be added to the page title?',6,1,NULL,'2015-12-19 14:54:51',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(215,'Sort Order','MODULE_HEADER_TAGS_MANUFACTURER_TITLE_SORT_ORDER','100','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:51',NULL,NULL),(216,'Enable Product Title Module','MODULE_HEADER_TAGS_PRODUCT_TITLE_STATUS','True','Do you want to allow product titles to be added to the page title?',6,1,NULL,'2015-12-19 14:54:51',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(217,'Sort Order','MODULE_HEADER_TAGS_PRODUCT_TITLE_SORT_ORDER','300','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:51',NULL,NULL),(218,'Enable Canonical Module','MODULE_HEADER_TAGS_CANONICAL_STATUS','True','Do you want to enable the Canonical module?',6,1,NULL,'2015-12-19 14:54:51',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(219,'Sort Order','MODULE_HEADER_TAGS_CANONICAL_SORT_ORDER','400','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:51',NULL,NULL),(220,'Enable Robot NoIndex Module','MODULE_HEADER_TAGS_ROBOT_NOINDEX_STATUS','True','Do you want to enable the Robot NoIndex module?',6,1,NULL,'2015-12-19 14:54:51',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(221,'Pages','MODULE_HEADER_TAGS_ROBOT_NOINDEX_PAGES','account.php;account_edit.php;account_history.php;account_history_info.php;account_newsletters.php;account_notifications.php;account_password.php;address_book.php;address_book_process.php;checkout_confirmation.php;checkout_payment.php;checkout_payment_address.php;checkout_process.php;checkout_shipping.php;checkout_shipping_address.php;checkout_success.php;cookie_usage.php;create_account.php;create_account_success.php;login.php;logoff.php;password_forgotten.php;password_reset.php;product_reviews_write.php;shopping_cart.php;ssl_check.php;tell_a_friend.php','The pages to add the meta robot noindex tag to.',6,0,NULL,'2015-12-19 14:54:51','ht_robot_noindex_show_pages','ht_robot_noindex_edit_pages('),(222,'Sort Order','MODULE_HEADER_TAGS_ROBOT_NOINDEX_SORT_ORDER','500','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:51',NULL,NULL),(223,'Enable No Script Module','MODULE_HEADER_TAGS_NOSCRIPT_STATUS','True','Add message for people with .js turned off?',6,1,NULL,'2015-12-19 14:54:52',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(224,'Sort Order','MODULE_HEADER_TAGS_NOSCRIPT_SORT_ORDER','1000','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:52',NULL,NULL),(225,'Enable Datepicker jQuery Module','MODULE_HEADER_TAGS_DATEPICKER_JQUERY_STATUS','True','Do you want to enable the Datepicker module?',6,1,NULL,'2015-12-19 14:54:52',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(226,'Pages','MODULE_HEADER_TAGS_DATEPICKER_JQUERY_PAGES','advanced_search.php;account_edit.php;create_account.php','The pages to add the Datepicker jQuery Scripts to.',6,0,NULL,'2015-12-19 14:54:52','ht_datepicker_jquery_show_pages','ht_datepicker_jquery_edit_pages('),(227,'Sort Order','MODULE_HEADER_TAGS_DATEPICKER_JQUERY_SORT_ORDER','600','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:52',NULL,NULL),(228,'Enable Grid List javascript','MODULE_HEADER_TAGS_GRID_LIST_VIEW_STATUS','True','Do you want to enable the Grid/List Javascript module?',6,1,NULL,'2015-12-19 14:54:52',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(229,'Pages','MODULE_HEADER_TAGS_GRID_LIST_VIEW_PAGES','advanced_search_result.php;index.php;products_new.php;specials.php','The pages to add the Grid List JS Scripts to.',6,0,NULL,'2015-12-19 14:54:52','ht_grid_list_view_show_pages','ht_grid_list_view_edit_pages('),(230,'Sort Order','MODULE_HEADER_TAGS_GRID_LIST_VIEW_SORT_ORDER','700','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:52',NULL,NULL),(231,'Enable Clickable Table Rows Module','MODULE_HEADER_TAGS_TABLE_CLICK_JQUERY_STATUS','True','Do you want to enable the Clickable Table Rows module?',6,1,NULL,'2015-12-19 14:54:52',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(232,'Pages','MODULE_HEADER_TAGS_TABLE_CLICK_JQUERY_PAGES','checkout_payment.php;checkout_shipping.php','The pages to add the jQuery Scripts to.',6,0,NULL,'2015-12-19 14:54:52','ht_table_click_jquery_show_pages','ht_table_click_jquery_edit_pages('),(233,'Sort Order','MODULE_HEADER_TAGS_TABLE_CLICK_JQUERY_SORT_ORDER','800','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:52',NULL,NULL),(234,'Enable Colorbox Script','MODULE_HEADER_TAGS_PRODUCT_COLORBOX_STATUS','True','Do you want to enable the Colorbox Scripts?',6,1,NULL,'2015-12-19 14:54:52',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(235,'Pages','MODULE_HEADER_TAGS_PRODUCT_COLORBOX_PAGES','product_info.php','The pages to add the Colorbox Scripts to.',6,0,NULL,'2015-12-19 14:54:52','ht_product_colorbox_show_pages','ht_product_colorbox_edit_pages('),(236,'Sort Order','MODULE_HEADER_TAGS_PRODUCT_COLORBOX_SORT_ORDER','900','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:52',NULL,NULL),(237,'Installed Modules','MODULE_ADMIN_DASHBOARD_INSTALLED','d_total_revenue.php;d_total_customers.php;d_orders.php;d_customers.php;d_admin_logins.php;d_security_checks.php;d_latest_news.php;d_latest_addons.php;d_partner_news.php;d_version_check.php;d_reviews.php','List of Administration Tool Dashboard module filenames separated by a semi-colon. This is automatically updated. No need to edit.',6,0,NULL,'2015-12-19 14:54:52',NULL,NULL),(238,'Enable Administrator Logins Module','MODULE_ADMIN_DASHBOARD_ADMIN_LOGINS_STATUS','True','Do you want to show the latest administrator logins on the dashboard?',6,1,NULL,'2015-12-19 14:54:52',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(239,'Sort Order','MODULE_ADMIN_DASHBOARD_ADMIN_LOGINS_SORT_ORDER','500','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:52',NULL,NULL),(240,'Enable Customers Module','MODULE_ADMIN_DASHBOARD_CUSTOMERS_STATUS','True','Do you want to show the newest customers on the dashboard?',6,1,NULL,'2015-12-19 14:54:52',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(241,'Sort Order','MODULE_ADMIN_DASHBOARD_CUSTOMERS_SORT_ORDER','400','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:52',NULL,NULL),(242,'Enable Latest Add-Ons Module','MODULE_ADMIN_DASHBOARD_LATEST_ADDONS_STATUS','True','Do you want to show the latest osCommerce Add-Ons on the dashboard?',6,1,NULL,'2015-12-19 14:54:52',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(243,'Sort Order','MODULE_ADMIN_DASHBOARD_LATEST_ADDONS_SORT_ORDER','800','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:52',NULL,NULL),(244,'Enable Latest News Module','MODULE_ADMIN_DASHBOARD_LATEST_NEWS_STATUS','True','Do you want to show the latest osCommerce News on the dashboard?',6,1,NULL,'2015-12-19 14:54:52',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(245,'Sort Order','MODULE_ADMIN_DASHBOARD_LATEST_NEWS_SORT_ORDER','700','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:53',NULL,NULL),(246,'Enable Orders Module','MODULE_ADMIN_DASHBOARD_ORDERS_STATUS','True','Do you want to show the latest orders on the dashboard?',6,1,NULL,'2015-12-19 14:54:53',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(247,'Sort Order','MODULE_ADMIN_DASHBOARD_ORDERS_SORT_ORDER','300','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:53',NULL,NULL),(248,'Enable Security Checks Module','MODULE_ADMIN_DASHBOARD_SECURITY_CHECKS_STATUS','True','Do you want to run the security checks for this installation?',6,1,NULL,'2015-12-19 14:54:53',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(249,'Sort Order','MODULE_ADMIN_DASHBOARD_SECURITY_CHECKS_SORT_ORDER','600','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:53',NULL,NULL),(250,'Enable Total Customers Module','MODULE_ADMIN_DASHBOARD_TOTAL_CUSTOMERS_STATUS','True','Do you want to show the total customers chart on the dashboard?',6,1,NULL,'2015-12-19 14:54:53',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(251,'Sort Order','MODULE_ADMIN_DASHBOARD_TOTAL_CUSTOMERS_SORT_ORDER','200','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:53',NULL,NULL),(252,'Enable Total Revenue Module','MODULE_ADMIN_DASHBOARD_TOTAL_REVENUE_STATUS','True','Do you want to show the total revenue chart on the dashboard?',6,1,NULL,'2015-12-19 14:54:53',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(253,'Sort Order','MODULE_ADMIN_DASHBOARD_TOTAL_REVENUE_SORT_ORDER','100','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:53',NULL,NULL),(254,'Enable Version Check Module','MODULE_ADMIN_DASHBOARD_VERSION_CHECK_STATUS','True','Do you want to show the version check results on the dashboard?',6,1,NULL,'2015-12-19 14:54:53',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(255,'Sort Order','MODULE_ADMIN_DASHBOARD_VERSION_CHECK_SORT_ORDER','900','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:53',NULL,NULL),(256,'Enable Latest Reviews Module','MODULE_ADMIN_DASHBOARD_REVIEWS_STATUS','True','Do you want to show the latest reviews on the dashboard?',6,1,NULL,'2015-12-19 14:54:53',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(257,'Sort Order','MODULE_ADMIN_DASHBOARD_REVIEWS_SORT_ORDER','1000','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:53',NULL,NULL),(258,'Enable Partner News Module','MODULE_ADMIN_DASHBOARD_PARTNER_NEWS_STATUS','True','Do you want to show the latest osCommerce Partner News on the dashboard?',6,1,NULL,'2015-12-19 14:54:53',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(259,'Sort Order','MODULE_ADMIN_DASHBOARD_PARTNER_NEWS_SORT_ORDER','820','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:53',NULL,NULL),(260,'Installed Modules','MODULE_BOXES_INSTALLED','','List of box module filenames separated by a semi-colon. This is automatically updated. No need to edit.',6,0,'2017-09-23 05:29:48','2015-12-19 14:54:53',NULL,NULL),(280,'Installed Template Block Groups','TEMPLATE_BLOCK_GROUPS','boxes;header_tags','This is automatically updated. No need to edit.',6,0,NULL,'2015-12-19 14:54:54',NULL,NULL),(281,'Installed Modules','MODULE_CONTENT_INSTALLED','account/cm_account_braintree_cards;account/cm_account_set_password;checkout_success/cm_cs_redirect_old_order;checkout_success/cm_cs_thank_you;checkout_success/cm_cs_downloads;footer/cm_footer_information_links;footer/cm_footer_text;footer/cm_footer_contact_us;footer_suffix/cm_footer_extra_copyright;footer_suffix/cm_footer_extra_icons;front_page/cm_fp_message;front_page/cm_fp_carousel;front_page/cm_fp_title;front_page/cm_fp_text_main;front_page/cm_fp_new_products;front_page/cm_fp_upcoming_products;front_page/cm_fp_new_blog_articles;header/cm_header_breadcrumb;login/cm_pwa_login;login/cm_login_form;login/cm_create_account_link;navbar/cm_nb_store_search;navbar/cm_nb_categories;navbar/cm_nb_settings;navbar/cm_nb_account;navbar/cm_nb_cart;navigation/cm_modular_navbar','This is automatically updated. No need to edit.',6,0,NULL,'2015-12-19 14:54:54',NULL,NULL),(282,'Enable Set Account Password','MODULE_CONTENT_ACCOUNT_SET_PASSWORD_STATUS','True','Do you want to enable the Set Account Password module?',6,1,NULL,'2015-12-19 14:54:54',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(283,'Allow Local Passwords','MODULE_CONTENT_ACCOUNT_SET_PASSWORD_ALLOW_PASSWORD','True','Allow local account passwords to be set.',6,1,NULL,'2015-12-19 14:54:54',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(284,'Sort Order','MODULE_CONTENT_ACCOUNT_SET_PASSWORD_SORT_ORDER','100','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:54',NULL,NULL),(285,'Enable Redirect Old Order Module','MODULE_CONTENT_CHECKOUT_SUCCESS_REDIRECT_OLD_ORDER_STATUS','True','Should customers be redirected when viewing old checkout success orders?',6,1,NULL,'2015-12-19 14:54:54',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(286,'Redirect Minutes','MODULE_CONTENT_CHECKOUT_SUCCESS_REDIRECT_OLD_ORDER_MINUTES','60','Redirect customers to the My Account page after an order older than this amount is viewed.',6,0,NULL,'2015-12-19 14:54:54',NULL,NULL),(287,'Sort Order','MODULE_CONTENT_CHECKOUT_SUCCESS_REDIRECT_OLD_ORDER_SORT_ORDER','500','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:54',NULL,NULL),(288,'Enable Thank You Module','MODULE_CONTENT_CHECKOUT_SUCCESS_THANK_YOU_STATUS','True','Should the thank you block be shown on the checkout success page?',6,1,NULL,'2015-12-19 14:54:54',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(289,'Sort Order','MODULE_CONTENT_CHECKOUT_SUCCESS_THANK_YOU_SORT_ORDER','1000','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:54',NULL,NULL),(292,'Enable Product Downloads Module','MODULE_CONTENT_CHECKOUT_SUCCESS_DOWNLOADS_STATUS','True','Should ordered product download links be shown on the checkout success page?',6,1,NULL,'2015-12-19 14:54:55',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(293,'Sort Order','MODULE_CONTENT_CHECKOUT_SUCCESS_DOWNLOADS_SORT_ORDER','3000','Sort order of display. Lowest is displayed first.',6,3,NULL,'2015-12-19 14:54:55',NULL,NULL),(294,'Enable Login Form Module','MODULE_CONTENT_LOGIN_FORM_STATUS','True','Do you want to enable the login form module?',6,1,NULL,'2015-12-19 14:54:55',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(295,'Content Width','MODULE_CONTENT_LOGIN_FORM_CONTENT_WIDTH','Half','Should the content be shown in a full or half width container?',6,1,NULL,'2015-12-19 14:54:55',NULL,'tep_cfg_select_option(array(\'Full\', \'Half\'), '),(296,'Sort Order','MODULE_CONTENT_LOGIN_FORM_SORT_ORDER','1000','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:55',NULL,NULL),(297,'Enable New User Module','MODULE_CONTENT_CREATE_ACCOUNT_LINK_STATUS','True','Do you want to enable the new user module?',6,1,NULL,'2015-12-19 14:54:55',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(298,'Content Width','MODULE_CONTENT_CREATE_ACCOUNT_LINK_CONTENT_WIDTH','Half','Should the content be shown in a full or half width container?',6,1,NULL,'2015-12-19 14:54:55',NULL,'tep_cfg_select_option(array(\'Full\', \'Half\'), '),(299,'Sort Order','MODULE_CONTENT_CREATE_ACCOUNT_LINK_SORT_ORDER','2000','Sort order of display. Lowest is displayed first.',6,0,NULL,'2015-12-19 14:54:55',NULL,NULL),(300,'Welcome Gift Voucher Amount','NEW_SIGNUP_GIFT_VOUCHER_AMOUNT','0','Welcome Gift Voucher Amount: If you do not wish to send a Gift Voucher in your create account email put 0 for no amount else if you do place the amount here i.e. 10.00 or 50.00 no currency signs',100,1,NULL,'2003-12-05 05:01:41',NULL,NULL),(301,'Welcome Discount Coupon Code','NEW_SIGNUP_DISCOUNT_COUPON','','Welcome Discount Coupon Code: if you do not want to send a coupon in your create account email leave blank else place the coupon code you wish to use',100,2,NULL,'2003-12-05 05:01:41',NULL,NULL),(302,'Coupon Code Length','CCGV_SECURITY_CODE_LENGTH','8','Coupon Code Length: Set the length of the auto generated coupon code',10,3,NULL,'2014-12-05 05:01:41',NULL,NULL),(303,'Display the Payment Method dropdown?','ORDER_EDITOR_PAYMENT_DROPDOWN','true','Based on this selection Order Editor will display the payment method as a dropdown menu (true) or as an input field (false).',72,1,'2015-12-19 14:54:56','2015-12-19 14:54:56',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(304,'Use prices from Separate Pricing Per Customer?','ORDER_EDITOR_USE_SPPC','false','Leave this set to false unless SPPC is installed.',72,3,'2015-12-19 14:54:56','2015-12-19 14:54:56',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(305,'Use QTPro contribution?','ORDER_EDITOR_USE_QTPRO','false','Leave this set to false unless you have QTPro Installed.',72,4,'2015-12-19 14:54:56','2015-12-19 14:54:56',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(306,'Allow the use of AJAX to update order information?','ORDER_EDITOR_USE_AJAX','true','This must be set to false if using a browser on which JavaScript is disabled or not available.',72,5,'2015-12-19 14:54:56','2015-12-19 14:54:56',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(307,'Select your credit card payment method','ORDER_EDITOR_CREDIT_CARD','Credit Card','Order Editor will display the credit card fields when this payment method is selected.',72,6,'2015-12-19 14:54:56','2015-12-19 14:54:56',NULL,'tep_cfg_pull_down_payment_methods('),(308,'Attach PDF Invoice to New Order Email','ORDER_EDITOR_ADD_PDF_INVOICE_EMAIL','false','When you send a new Order Email a PDF Invoice kan be attach to your email. This function only works if the contribution PDF Invoice is installed. NOT INSTALLED BY DEFAULT',72,15,'2015-12-19 14:54:56','2015-12-19 14:54:56',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(309,'KissIT: Version','KISSIT_IMAGE_MODULE','21','KISS Image Thumbnailer - Creates image thumbnails where the image size requested differs from the actual image size',6,0,NULL,'2015-12-19 14:55:08',NULL,NULL),(310,'KissIT Product Main Image Width','KISSIT_MAIN_PRODUCT_IMAGE_WIDTH','250','KissIT Product Main Image Width.<br /><br />',4,20,NULL,'2015-12-19 14:55:08',NULL,NULL),(311,'KissIT Product Main Image Height','KISSIT_MAIN_PRODUCT_IMAGE_HEIGHT','250','KissIT Product Main Image Height.<br /><br />',4,21,NULL,'2015-12-19 14:55:08',NULL,NULL),(312,'KissIT Disable Image Upsize','KISS_DISABLE_UPSIZE','true','Keep original image size if the original image is smaller than the requested thumbnail size.',4,22,NULL,'2015-12-19 14:55:08',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(313,'KissIT Product Watermark Size','KISSIT_MAIN_PRODUCT_WATERMARK_SIZE','0.6','KissIT Product Main Watermark size relativ to the image size (1.0=100%, 0.5 = 50%, 0=no watermark).<br /><br />',4,23,NULL,'2015-12-19 14:55:08',NULL,NULL),(314,'KissIT Watermark File Name','KISSIT_MAIN_PRODUCT_WATERMARK_IMAGE','watermark.png','Name of Watermark image file placed in the folder /images. Remember to use a png file with transparent background.<br /><br />',4,24,NULL,'2015-12-19 14:55:08',NULL,NULL),(315,'KissIT Watermark position in image','KISSIT_MAIN_PRODUCT_WATERMARK_PLACEMENT','center','Position of the watermark in the image reletiv within the image.',4,25,NULL,'2015-12-19 14:55:08',NULL,'tep_cfg_select_option(array(\'top-right\', \'top-left\', \'center\',\'bottom-right\', \'bottom-left\'), '),(316,'KissIT min image width to apply Watermark','KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_WIDTH','60','The minimum width of thumbnail images to apply the watermark.<br /><br />',4,26,NULL,'2015-12-19 14:55:08',NULL,NULL),(317,'KissIT min image height to apply Watermark','KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_HEIGHT','60','The minimum height of thumbnail images to apply the watermark.<br /><br />',4,27,NULL,'2015-12-19 14:55:08',NULL,NULL),(318,'KissIT Reset thumbs','KISSIT_RESET_IMAGE_THUMBS','false','Reset thumbs cache.',4,28,NULL,'2015-12-19 14:55:08','tep_cfg_reset_thumbs_cache','tep_cfg_select_option(array(\'reset\', \'false\'), '),(319,'KissIT thumb directory','KISSIT_THUMBS_MAIN_DIR','thumbs/','The name of the thumbs directory inside \"images\".<br>default: \'thumbs\'<br>Please, reset thumbs if you change it.',4,29,NULL,'2015-12-19 14:55:09',NULL,NULL),(415,'Use CKEditor','USE_CKEDITOR_ADMIN_TEXTAREA','true','Use CKEditor for WYSIWYG editing of textarea fields in admin',1,99,NULL,'2016-02-03 21:44:00',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(416,'<font color=blue>Article Image Width</font>','ARTICLES_IMAGE_WIDTH','100','Set the width of the image displayed in an article.',102,1,NULL,'2017-05-14 00:40:16',NULL,NULL),(417,'<font color=blue>Article Image Height</font>','ARTICLES_IMAGE_HEIGHT','100','Set the height of the image displayed in an article.',102,2,NULL,'2017-05-14 00:40:16',NULL,NULL),(418,'<font color=blue>Authors List Style</font>','MAX_DISPLAY_AUTHORS_IN_A_LIST','1','Used in Authors box. When the number of authors exceeds this number, a drop-down list will be displayed instead of the default list',102,3,NULL,'2017-05-14 00:40:16',NULL,NULL),(419,'<font color=blue>Authors Select Box Size</font>','MAX_AUTHORS_LIST','1','Used in Authors box. When this value is 1 the classic drop-down list will be used for the authors box. Otherwise, a list-box with the specified number of rows will be displayed.',102,4,NULL,'2017-05-14 00:40:16',NULL,NULL),(420,'<font color=>Display Author in Article Listing</font>','DISPLAY_AUTHOR_ARTICLE_LISTING','true','Display the Author in the Article Listing?',102,5,NULL,'2017-05-14 00:40:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(421,'<font color=>Display Topic in Article Listing</font>','DISPLAY_TOPIC_ARTICLE_LISTING','true','Display the Topic in the Article Listing?',102,6,NULL,'2017-05-14 00:40:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(422,'<font color=>Display Abstract in Article Listing</font>','DISPLAY_ABSTRACT_ARTICLE_LISTING','true','Display the Abstract in the Article Listing?',102,7,NULL,'2017-05-14 00:40:16',NULL,'tep_cfg_select_option(array(\'true\', '),(423,'<font color=>Display Date Added in Article Listing</font>','DISPLAY_DATE_ADDED_ARTICLE_LISTING','true','Display the Date Added in the Article Listing?',102,8,NULL,'2017-05-14 00:40:16',NULL,'tep_cfg_select_option(array(\'true\', '),(424,'<font color=>Display Topic/Author Filter</font>','ARTICLE_LIST_FILTER','true','Do you want to display the Topic/Author Filter?',102,9,NULL,'2017-05-14 00:40:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(425,'<font color=>Display Box Authors</font>','AUTHOR_BOX_DISPLAY','true','Display the Author box in the destination column',102,10,NULL,'2017-05-14 00:40:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(426,'<font color=>Display Box Articles</font>','ARTICLE_BOX_DISPLAY','true','Display the Articles box in the destination column',102,11,NULL,'2017-05-14 00:40:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(427,'<font color=>Display Box Articles - All Articles Section</font>','ARTICLE_BOX_DISPLAY_ALL_ARTICLES_SECTION','true','Display an All Articles section in the articles box',102,12,NULL,'2017-05-14 00:40:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(428,'<font color=>Display Box Articles - All Articles Sort Order</font>','ARTICLE_BOX_DISPLAY_ALL_ARTICLES_SECTION_SORT_ORDER','2','Determines the where the All Articles section will be displayed in the infobox.',102,13,NULL,'2017-05-14 00:40:16',NULL,NULL),(429,'<font color=>Display Box Articles - All Articles Links?</font>','ARTICLE_BOX_DISPLAY_All_ARTICLES_LINKS','true','Display links to individual articles. Requires the Display Box Articles - All Articles Section option to be true. ',102,14,NULL,'2017-05-14 00:40:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(430,'<font color=>Display Box Articles - All Articles Links Limit</font>','ARTICLE_BOX_DISPLAY_ALL_ARTICLES_LINKS_LIMIT','','Maximum number of article links to display in the articles infobox. Leave blank for no limit.',102,15,NULL,'2017-05-14 00:40:17',NULL,NULL),(431,'<font color=>Display Box Articles - All Blog Section</font>','ARTICLE_BOX_DISPLAY_ALL_BLOG_SECTION','true','Display an All Blog Articles section in the articles box',102,16,NULL,'2017-05-14 00:40:17',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(432,'<font color=>Display Box Articles - All Blog Sort Order</font>','ARTICLE_BOX_DISPLAY_ALL_BLOG_SECTION_SORT_ORDER','1','Determines the where the All Blog Articles section will be displayed in the infobox.',102,17,NULL,'2017-05-14 00:40:17',NULL,NULL),(433,'<font color=>Display Box Articles - All Blog Links?</font>','ARTICLE_BOX_DISPLAY_All_BLOG_LINKS','true','Display links to individual articles. Requires the Display Box Articles - All Blog Articles Section option to be true. ',102,18,NULL,'2017-05-14 00:40:17',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(434,'<font color=>Display Box Articles - All Blog Links Limit</font>','ARTICLE_BOX_DISPLAY_ALL_BLOG_LINKS_LIMIT','','Maximum number of blog article links to display in the articles infobox. Leave blank for no limit.',102,19,NULL,'2017-05-14 00:40:17',NULL,NULL),(435,'<font color=>Display Box Articles - All Topics Section</font>','ARTICLE_BOX_DISPLAY_TOPICS_SECTION','true','Display an All Topics section in the articles box',102,20,NULL,'2017-05-14 00:40:17',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(436,'<font color=>Display Box Articles - All Topics Sort Order</font>','ARTICLE_BOX_DISPLAY_TOPICS_SECTION_SORT_ORDER','3','Determines the where the All Topics section will be displayed in the infobox.',102,21,NULL,'2017-05-14 00:40:17',NULL,NULL),(437,'<font color=>Display Box Articles - All Topics Links?</font>','ARTICLE_BOX_DISPLAY_TOPICS_LINKS','true','Display links to individual topics. Requires the Display Box Articles - All Topics Section option to be true. ',102,22,NULL,'2017-05-14 00:40:17',NULL,'tep_cfg_select_option(array(\'true\', '),(438,'<font color=>Display Box Articles - All Topics Links Limit</font>','ARTICLE_BOX_DISPLAY_TOPICS_LINKS_LIMIT','','Maximum number of topics links to display in the articles infobox. Leave blank for no limit.',102,23,NULL,'2017-05-14 00:40:17',NULL,NULL),(439,'<font color=>Display Box Articles - New Articles Section</font>','ARTICLE_BOX_DISPLAY_NEW_ARTICLES_SECTION','true','Display a New Articles section in the articles box',102,24,NULL,'2017-05-14 00:40:17',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(440,'<font color=>Display Box Articles - New Articles Sort Order</font>','ARTICLE_BOX_DISPLAY_NEW_ARTICLES_SECTION_SORT_ORDER','4','Determines the where the New Articles section will be displayed in the infobox.',102,25,NULL,'2017-05-14 00:40:17',NULL,NULL),(441,'<font color=>Display Box Articles - New Articles Links?</font>','ARTICLE_BOX_DISPLAY_NEW_ARTICLES_LINKS','true','Display links to individual articles. Requires the Display Box Articles - New Articles Section option to be true. ',102,26,NULL,'2017-05-14 00:40:17',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(442,'<font color=>Display Box Articles - New Articles Links Limit</font>','ARTICLE_BOX_DISPLAY_NEW_ARTICLES_LINKS_LIMIT','','Maximum number of new article links to display in the articles infobox. Leave blank for no limit.',102,27,NULL,'2017-05-14 00:40:17',NULL,NULL),(443,'<font color=>Display Box Articles - RSS Feed Section</font>','ARTICLE_BOX_DISPLAY_RSS_FEED_SECTION','true','Display an RSS Feed section in the articles box',102,28,NULL,'2017-05-14 00:40:17',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(444,'<font color=>Display Box Articles - RSS Feed Sort Order</font>','ARTICLE_BOX_DISPLAY_RSS_FEED_SECTION_SORT_ORDER','5','Determines the where the RSS Feed section will be displayed in the infobox.',102,29,NULL,'2017-05-14 00:40:17',NULL,NULL),(445,'<font color=>Display Box Articles - Search Articles Section</font>','ARTICLE_BOX_DISPLAY_SEARCH_ARTICLES_SECTION','true','Display a Search Box in the articles box',102,30,NULL,'2017-05-14 00:40:17',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(446,'<font color=>Display Box Articles - Search Articles Sort Order</font>','ARTICLE_BOX_DISPLAY_SEARCH_ARTICLES_SECTION_SORT_ORDER','8','Determines the where the Search Box will be displayed in the infobox.',102,31,NULL,'2017-05-14 00:40:17',NULL,NULL),(447,'<font color=>Display Box Articles - Submit Article Section</font>','ARTICLE_BOX_DISPLAY_SUBMIT_ARTICLE_SECTION','true','Display a Submit Article section in the articles box',102,32,NULL,'2017-05-14 00:40:17',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(448,'<font color=>Display Box Articles - Submit Article Sort Order</font>','ARTICLE_BOX_DISPLAY_SUBMIT_ARTICLE_SECTION_SORT_ORDER','6','Determines the where the Submit Article section will be displayed in the infobox.',102,33,NULL,'2017-05-14 00:40:17',NULL,NULL),(449,'<font color=>Display Box Articles - Upcoming Articles Section</font>','ARTICLE_BOX_DISPLAY_UPCOMING_SECTION','true','Display an Upcoming Articles section in the articles box',102,34,NULL,'2017-05-14 00:40:18',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(450,'<font color=>Display Box Articles - Upcoming Articles Sort Order</font>','ARTICLE_BOX_DISPLAY_UPCOMING_SECTION_SORT_ORDER','6','Determines the where the Upcoming Articles section will be displayed in the infobox.',102,35,NULL,'2017-05-14 00:40:18',NULL,NULL),(451,'<font color=>Display Box Articles - Separate Articles</font>','SEPARATE_ARTICLES','false','Separate each article in the article infobox with a line.',102,36,NULL,'2017-05-14 00:40:18',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(452,'<font color=>Display Box Articles - Separate Blog Articles</font>','SEPARATE_BLOG_ARTICLES','false','Separate each blog article in the article infobox with a line.',102,37,NULL,'2017-05-14 00:40:18',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(453,'<font color=>Display Box Articles - Separate New Articles</font>','SEPARATE_NEW_ARTICLES','false','Separate each new article in the article infobox with a line.',102,38,NULL,'2017-05-14 00:40:18',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(454,'<font color=>Display Box Articles - Separate Topics</font>','SEPARATE_TOPICS','false','Separate each topic in the article infobox with a line.',102,39,NULL,'2017-05-14 00:40:18',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(455,'<font color=steelblue>Enable Article Reviews</font>','ENABLE_ARTICLE_REVIEWS','true','Enable registered users to review articles?',102,40,NULL,'2017-05-14 00:40:18',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(456,'<font color=steelblue>Enable an HTML Editor</font>','ARTICLE_ENABLE_HTML_EDITOR','CKEditor','Use an HTML editor, if selected. !!! Warning !!! The selected editor must be installed for it to work!!!)',102,41,'2017-05-14 01:32:59','2017-05-14 00:40:18',NULL,'tep_cfg_select_option(array(\'CKEditor\', \'FCKEditor\', \'TinyMCE\', \'No Editor\'), '),(457,'<font color=steelblue>Enable Tell a Friend About Article</font>','ENABLE_TELL_A_FRIEND_ARTICLE','true','Enable Tell a Friend option in the Article Information page?',102,42,NULL,'2017-05-14 00:40:18',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(458,'<font color=steelblue>Enable Version Checker</font>','ARTICLE_ENABLE_VERSION_CHECKER','false','Enables the version checking code to automatically check if an update is available.',102,43,NULL,'2017-05-14 00:40:18',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(459,'<font color=>Location of Prev/Next Navigation Bar</font>','ARTICLE_PREV_NEXT_BAR_LOCATION','bottom','Sets the location of the Previous/Next Navigation Bar<br><br>(top; bottom; both)',102,44,NULL,'2017-05-14 00:40:18',NULL,'tep_cfg_select_option(array(\'top\', \'bottom\', \'both\'), '),(460,'<font color=red>Maximum New Articles Per Page</font>','MAX_NEW_ARTICLES_PER_PAGE','10','The maximum number of New Articles to display per page<br>(New Articles page)',102,45,NULL,'2017-05-14 00:40:18',NULL,NULL),(461,'<font color=red>Maximum Article Abstract Length</font>','MAX_ARTICLE_ABSTRACT_LENGTH','300','Sets the maximum length of the Article Abstract to be displayed<br><br>(No. of characters)',102,46,NULL,'2017-05-14 00:40:18',NULL,NULL),(462,'<font color=red>Maximum Articles Per Page</font>','MAX_ARTICLES_PER_PAGE','10','The maximum number of Articles to display per page<br>(All Articles and Topic/Author pages)',102,47,NULL,'2017-05-14 00:40:18',NULL,NULL),(463,'<font color=red>Maximum Number Articles in Infobox</font>','MAX_DISPLAY_ARTICLES_INFOBOX','6','Maximum number of articles to display in the articles infobox.',102,48,NULL,'2017-05-14 00:40:18',NULL,NULL),(464,'<font color=red>Maximum Display Upcoming Articles</font>','MAX_DISPLAY_UPCOMING_ARTICLES','5','Maximum number of articles to display in the Upcoming Articles module',102,49,NULL,'2017-05-14 00:40:18',NULL,NULL),(465,'<font color=red>Minimum Number Cross-Sell Products</font>','MIN_DISPLAY_ARTICLES_XSELL','1','Minimum number of products to display in the articles Cross-Sell listing.',102,50,NULL,'2017-05-14 00:40:18',NULL,NULL),(466,'<font color=red>Maximum Number Cross-Sell Products</font>','MAX_DISPLAY_ARTICLES_XSELL','6','Maximum number of products to display in the articles Cross-Sell listing.',102,51,NULL,'2017-05-14 00:40:18',NULL,NULL),(467,'<font color=red>Maximum Length of Author Name</font>','MAX_DISPLAY_AUTHOR_NAME_LEN','20','The maximum length of the author\'s name for display in the Author box',102,52,NULL,'2017-05-14 00:40:18',NULL,NULL),(468,'<font color=purple>Number of Days Display New Articles</font>','NEW_ARTICLES_DAYS_DISPLAY','30','The number of days to display New Articles?',102,53,NULL,'2017-05-14 00:40:19',NULL,NULL),(469,'<font color=purple>Number of articles to display in the RSS Feed.</font>','NEWS_RSS_ARTICLE','10','If you want all of your articles to display in the RSS type in something like 2000.  The default is 10',102,54,NULL,'2017-05-14 00:40:19',NULL,NULL),(470,'<font color=purple>Number of characters to display in each RSS article.</font>','NEWS_RSS_CHARACTERS','250','If you keep this at 250 it will hide a little bit of each of article from your viewers. They will have to come to your store to finish.  The default is 250',102,55,NULL,'2017-05-14 00:40:19',NULL,NULL),(471,'<font color=>Show Article Counts</font>','SHOW_ARTICLE_COUNTS','true','Count recursively how many articles are in each topic.',102,56,NULL,'2017-05-14 00:40:19',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(478,'Automatically Add New Pages','HEADER_TAGS_AUTO_ADD_PAGES','true','<center><b><h2>Header Tags SEO</h2><i>Developed by:</i><br>Jack York @ Oscommerce Solution<br><a href=\"//oscommerce-solution.com//check_unreleased_updates.php?id=3.3.4&name=HeaderTagsSEO\" target=\"_blank\">Check Updates</a></b></center><br>Adds any new page',103,1,NULL,'2017-05-14 02:13:24',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(479,'Breadcrumb Model Override','HEADER_TAGS_BREADCRUMB_MODEL_OVERRIDE','false','Force the breadrumb to use the model field for the breadcrumb trail.',103,2,NULL,'2017-05-14 02:13:24',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(480,'ByPass New Pages Check','HEADER_TAGS_BYPASS_ISTEMPLATE','false','If enabled, all files in the root will be added to the list in Page Control - only use if needed<br>(true=on false=off)',103,3,NULL,'2017-05-14 02:13:24',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(481,'Canonical Path','HEADER_TAGS_CANONICAL_PATH','full','Canonical url will use all of the ID\'s in the url or just the last one.',103,4,NULL,'2017-05-14 02:13:24',NULL,'tep_cfg_select_option(array(\'full\', \'last\'), '),(482,'Check for Missing Tags','HEADER_TAGS_CHECK_TAGS','true','Check to see if any products, categories or manufacturers contain empty meta tag fields<br>(true=on false=off)',103,5,NULL,'2017-05-14 02:13:25',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(483,'Clear Cache','HEADER_TAGS_CLEAR_CACHE','clear','Remove all Header Tags cache entries from the database.',103,6,'2017-07-08 22:56:38','2017-05-14 02:13:25','header_tags_reset_cache','tep_cfg_select_option(array(\'clear\', \'false\'), '),(484,'<font color=purple>Display Category Parents in Title and Tags</font>','HEADER_TAGS_ADD_CATEGORY_PARENTS','Standard','Adds all categories in the current path (Full), all immediate categories if the product is in more than one category (Duplicate) or only the immediate category (Standard). These settings only work if the Category checkbox is enabled in Page Control.',103,7,NULL,'2017-05-14 02:13:25',NULL,'tep_cfg_select_option(array(\'Full Category Path\', \'Duplicate Categories\', \'Standard\'), '),(485,'<font color=purple>Display Category Short Description</font>','HEADER_TAGS_DISPLAY_CATEGORY_SHORT_DESCRIPTION','Off','If a number is entered, that many characters of the category description will be displayed under the category name on the category listing page. <br><br>Leave blank to display all of the text (not recommended). <br><br>Enter \'Off\' to disable this option.',103,8,NULL,'2017-05-14 02:13:25',NULL,NULL),(486,'<font color=purple>Display Column Box</font>','HEADER_TAGS_DISPLAY_COLUMN_BOX','false','Display product box in column while on product page<br>(true=on false=off)',103,9,NULL,'2017-05-14 02:13:25',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(487,'<font color=purple>Display Currently Viewing</font>','HEADER_TAGS_DISPLAY_CURRENTLY_VIEWING','true','Display a link near the bottom of the product page.<br>(true=on false=off)',103,10,NULL,'2017-05-14 02:13:25',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(488,'<font color=purple>Display Help Popups</font>','HEADER_TAGS_DISPLAY_HELP_POPUPS','true','Display short popup messages that describes a feature<br>(true=on false=off)',103,11,NULL,'2017-05-14 02:13:25',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(489,'<font color=purple>Disable Permission Warning</font>','HEADER_TAGS_DIABLE_PERMISSION_WARNING','false','Prevent the warning that appears if the permissions for the includes/header_tags.php file appear to be incoorect.<br>(true=on false=off)',103,12,'2017-07-08 19:05:27','2017-05-14 02:13:26',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(490,'<font color=purple>Display Page Top Title</font>','HEADER_TAGS_DISPLAY_PAGE_TOP_TITLE','true','Displays the page title at the very top of the page<br>(true=on false=off)',103,13,NULL,'2017-05-14 02:13:26',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(491,'<font color=purple>Display See More</font>','HEADER_TAGS_DISPLAY_SEE_MORE','short','Display see more on the category and product listing pages. This option can be set as:<br><br>off - do not show see more link<br>short - link just shows see more<br>full - link shows see more with item name',103,14,NULL,'2017-05-14 02:13:27',NULL,'tep_cfg_select_option(array(\'off\', \'short\', \'full\'), '),(492,'<font color=purple>Display Silo Links</font>','HEADER_TAGS_DISPLAY_SILO_BOX','false','Display a box displaying links based on the settings in Silo Control<br>(true=on false=off)',103,15,NULL,'2017-05-14 02:13:27',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(493,'<font color=purple>Display Social Bookmark</font>','HEADER_TAGS_DISPLAY_SOCIAL_BOOKMARKS','true','Display social bookmarks on the product page<br>(true=on false=off)',103,16,NULL,'2017-05-14 02:13:27',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(494,'<font color=purple>Display Tag Cloud</font>','HEADER_TAGS_DISPLAY_TAG_CLOUD','true','Display the Tag Cloud infobox<br>(true=on false=off)',103,17,'2017-07-08 23:05:26','2017-05-14 02:13:27',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(495,'<font color=blue>Enable AutoFill - Listing Text</font>','HEADER_TAGS_ENABLE_AUTOFILL_LISTING_TEXT','false','If true, text will be shown on the product listing page automatically. If false, the text only shows if the field has text in it.',103,18,NULL,'2017-05-14 02:13:27',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(496,'<font color=blue>Enable Cache</font>','HEADER_TAGS_ENABLE_CACHE','Normal','Enables cache for Header Tags. The GZip option will use gzip to try to increase speed but may be a little slower if the Header Tags data is small.',103,19,'2017-07-08 23:03:19','2017-05-14 02:13:27',NULL,'tep_cfg_select_option(array(\'None\', \'Normal\', \'GZip\'),'),(497,'<font color=blue>Enable an HTML Editor</font>','HEADER_TAGS_ENABLE_HTML_EDITOR','CKEditor','Use an HTML editor, if selected. !!! Warning !!! The selected editor must be installed for it to work!!!)',103,20,'2017-07-08 23:03:44','2017-05-14 02:13:27',NULL,'tep_cfg_select_option(array(\'CKEditor\', \'FCKEditor\', \'TinyMCE\', \'No Editor\'),'),(498,'<font color=blue>Enable HTML Editor for Category Descriptions</font>','HEADER_TAGS_ENABLE_EDITOR_CATEGORIES','false','Enables the selected HTML editor for the categories description box. The editor must be installed for this to work.',103,21,NULL,'2017-05-14 02:13:27',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(499,'<font color=blue>Enable HTML Editor for Products Descriptions</font>','HEADER_TAGS_ENABLE_EDITOR_PRODUCTS','false','Enables the selected HTML editor for the products description box. The editor must be installed for this to work.',103,22,NULL,'2017-05-14 02:13:28',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(500,'<font color=blue>Enable HTML Editor for Product Listing text</font>','HEADER_TAGS_ENABLE_EDITOR_LISTING_TEXT','false','Enables the selected HTML editor for the Header Tags text on the product listing page. The editor must be installed for this to work.',103,23,NULL,'2017-05-14 02:13:28',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(501,'<font color=blue>Enable HTML Editor for Product Sub Text</font>','HEADER_TAGS_ENABLE_EDITOR_SUB_TEXT','false','Enables the selected HTML editor for the sub text on the products page. The editor must be installed for this to work.',103,24,NULL,'2017-05-14 02:13:28',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(502,'<font color=blue>Enable Google +1</font>','HEADER_TAGS_ENABLE_GOOGLE_PLUS_ONE','true','Enables the display of the google +1 social icon.',103,25,NULL,'2017-05-14 02:13:28',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(503,'<font color=blue>Enable Version Checker</font>','HEADER_TAGS_ENABLE_VERSION_CHECKER','true','Enables the code that checks if updates are available.',103,26,NULL,'2017-05-14 02:13:28',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(504,'Keyword Density Range','HEADER_TAGS_KEYWORD_DENSITY_RANGE','0.02,0.06','Set the limits for the keyword density use to dynamically select the keywords. Enter two figures, separated by a comma.',103,27,NULL,'2017-05-14 02:13:28',NULL,NULL),(505,'Keyword Highlighter','HEADER_TAGS_KEYWORD_HIGHLIGHTER','No Highlighting','Bold any keywords found on the page.',103,28,NULL,'2017-05-14 02:13:28',NULL,'tep_cfg_select_option(array(\'No Highlighting\', \'Highlight Full Words Only\', \'Highlight Individual Words\'),'),(506,'Position Domain','HEADER_TAGS_POSITION_DOMAIN','','Set the domain name to be used in the keyword position checking code, like www.domain_name.com or domain_name.com/shop.',103,29,NULL,'2017-05-14 02:13:28',NULL,NULL),(507,'Position Page Count','HEADER_TAGS_POSITION_PAGE_COUNT','2','Set the number of pages to search when checking keyword positions (10 urls per page).',103,30,NULL,'2017-05-14 02:13:28',NULL,NULL),(508,'Separator - Description','HEADER_TAGS_SEPARATOR_DESCRIPTION','-','Set the separator to be used for the description (and titles and logo).',103,31,NULL,'2017-05-14 02:13:28',NULL,NULL),(509,'Separator - Keywords','HEADER_TAGS_SEPARATOR_KEYWORD',',','Set the separator to be used for the keywords.',103,32,NULL,'2017-05-14 02:13:28',NULL,NULL),(510,'Search Keywords','HEADER_TAGS_SEARCH_KEYWORDS','true','This option allows keywords stored in the Header Tags SEO search table to be searched when a search is performed on the site.',103,33,'2017-07-08 23:04:42','2017-05-14 02:13:28',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(511,'Store Keywords','HEADER_TAGS_STORE_KEYWORDS','true','This option stores the searched for keywords so they can be used by other parts of Header Tags, like in the Tag Cloud option.',103,34,NULL,'2017-05-14 02:13:29',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(512,'Tag Cloud Column Count','HEADER_TAGS_TAG_CLOUD_COLUMN_COUNT','8','Set the number of keywords to display in a row in the Tag Cloud box.',103,35,NULL,'2017-05-14 02:13:29',NULL,NULL),(513,'Use Item Name on Page</font>','HEADER_TAGS_USE_PAGE_NAME','false','If true, the title on the page will be the name of the item (category, manufacturer or product). If false, the Header Tags SEO title will be used.',103,36,NULL,'2017-05-14 02:13:29',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(514,'Enable Category Meta Module','MODULE_HEADER_TAGS_CATEGORY_META_STATUS','True','Do you want to allow Category meta tags to be added to the page header?',6,1,NULL,'2017-07-08 17:56:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(515,'Display Category Meta Description','MODULE_HEADER_TAGS_CATEGORY_META_DESCRIPTION_STATUS','True','Category Descriptions help your site and your sites visitors.',6,1,NULL,'2017-07-08 17:56:19',NULL,'tep_cfg_select_option(array(\'True\'), '),(516,'Display Category Meta Keywords','MODULE_HEADER_TAGS_CATEGORY_META_KEYWORDS_STATUS','True','Category Keywords are pointless.  If you are into the Chinese Market select True (for Baidu Search Engine) otherwise select False.',6,1,NULL,'2017-07-08 17:56:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(517,'Sort Order','MODULE_HEADER_TAGS_CATEGORY_META_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-07-08 17:56:19',NULL,NULL),(518,'Enable Manufacturer Meta Module','MODULE_HEADER_TAGS_MANUFACTURERS_META_STATUS','True','Do you want to allow Category meta tags to be added to the page header?',6,1,NULL,'2017-07-08 17:56:44',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(519,'Display Category Meta Description','MODULE_HEADER_TAGS_MANUFACTURERS_META_DESCRIPTION_STATUS','True','Manufacturer Descriptions help your site and your sites visitors.',6,1,NULL,'2017-07-08 17:56:44',NULL,'tep_cfg_select_option(array(\'True\'), '),(520,'Display Category Meta Keywords','MODULE_HEADER_TAGS_MANUFACTURERS_META_KEYWORDS_STATUS','False','Manufacturer Keywords are pointless.  If you are into the Chinese Market select True (for Baidu Search Engine) otherwise select False.',6,1,NULL,'2017-07-08 17:56:44',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(521,'Sort Order','MODULE_HEADER_TAGS_MANUFACTURERS_META_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-07-08 17:56:44',NULL,NULL),(522,'Enable Product Title Module','MODULE_HEADER_TAGS_PAGES_TITLE_STATUS','True','Do you want to allow product titles to be added to the page title?',6,1,NULL,'2017-07-08 17:56:56',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(523,'Sort Order','MODULE_HEADER_TAGS_PAGES_TITLE_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-07-08 17:56:56',NULL,NULL),(524,'Enable Pages Meta Module','MODULE_HEADER_TAGS_PAGES_META_STATUS','True','Do you want to allow page (eg: specials.php) meta tags to be added to the page header?',6,1,NULL,'2017-07-08 17:57:20',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(525,'Sort Order','MODULE_HEADER_TAGS_PAGES_META_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-07-08 17:57:20',NULL,NULL),(526,'Enable Pages SEO Module','MODULE_HEADER_TAGS_PAGES_SEO_STATUS','False','Do you want to allow this module to write SEO to your Pages?',6,1,NULL,'2017-07-08 17:57:52',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(527,'Sort Order','MODULE_HEADER_TAGS_PAGES_SEO_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-07-08 17:57:52',NULL,NULL),(528,'Enable Product Meta Module','MODULE_HEADER_TAGS_PRODUCT_META_STATUS','True','Do you want to allow product meta tags to be added to the page header?',6,1,NULL,'2017-07-08 22:48:42',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(529,'Enable Product Meta Module - Keywords','MODULE_HEADER_TAGS_PRODUCT_META_KEYWORDS_STATUS','Both','Keywords can be used for META, for SEARCH, or for BOTH.  If you are into the Chinese Market select Both (for Baidu Search Engine) otherwise select Search.',6,1,NULL,'2017-07-08 22:48:42',NULL,'tep_cfg_select_option(array(\'Meta\', \'Search\', \'Both\'), '),(530,'Sort Order','MODULE_HEADER_TAGS_PRODUCT_META_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-07-08 22:48:42',NULL,NULL),(531,'Default product template','DEFAULT_PRODUCT_TEMPLATE','1','1=product, 2=article',1,24,NULL,'2017-07-23 17:20:15',NULL,NULL),(532,'Allow reviews','ALLOW_REVIEWS','false','Allow reviews for products?',1,25,NULL,'2017-07-23 17:20:15',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(563,'CONFIG_TITLE_COMISSION_PERCENTAGE','COMISSION_PERCENTAGE','0','CONFIG_DESCRIPTION_COMISSION_PERCENTAGE',1,99,NULL,'2017-08-25 12:09:29',NULL,NULL),(593,'CONFIG_TITLE_ADD_MANUFACTURER_META_TITLE','ADD_MANUFACTURER_META_TITLE','true','CONFIG_DESCRIPTION_ADD_MANUFACTURER_META_TITLE',1,1001,NULL,'2017-08-25 17:23:37',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(623,'CONFIG_TITLE_META_DESCRIPTION_LENGHT','META_DESCRIPTION_LENGHT','160','CONFIG_DESCRIPTION_META_DESCRIPTION_LENGHT',1,999,'2017-08-25 17:46:34','2017-08-25 17:45:55',NULL,NULL),(624,'CONFIG_TITLE_META_TITLE_LENGHT','META_TITLE_LENGHT','78','CONFIG_DESCRIPTION_META_TITLE_LENGHT',1,999,'2017-08-25 17:46:23','2017-08-25 17:46:08',NULL,NULL),(625,'Enable Contact Us Footer Module','MODULE_CONTENT_FOOTER_CONTACT_US_STATUS','True','Do you want to enable the Contact Us content module?',6,1,NULL,'2017-08-31 10:46:01',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(626,'Content Width','MODULE_CONTENT_FOOTER_CONTACT_US_CONTENT_WIDTH','3','What width container should the content be shown in? (12 = full width, 6 = half width).',6,1,NULL,'2017-08-31 10:46:01',NULL,'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), '),(627,'Sort Order','MODULE_CONTENT_FOOTER_CONTACT_US_SORT_ORDER','3','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-08-31 10:46:02',NULL,NULL),(628,'MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_VERSION_TITLE','MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_VERSION','1.0.1','MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_VERSION_DESCRIPTION',6,0,NULL,'2017-09-07 22:18:48',NULL,'tep_cfg_disabled('),(629,'MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_STATUS_TITLE','MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_STATUS','True','MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_STATUS_DESCRIPTION',6,1,NULL,'2017-09-07 22:18:48',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(630,'MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_LOGO_ENABLED_TITLE','MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_LOGO_ENABLED','True','MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_LOGO_ENABLED_DESCRIPTION',6,1,NULL,'2017-09-07 22:18:48',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(631,'MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_SORT_ORDER_TITLE','MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_SORT_ORDER','9000','MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_SORT_ORDER_DESCRIPTION',6,2,NULL,'2017-09-07 22:18:48',NULL,NULL),(632,'Module Version','MODULE_CONTENT_NAVBAR_SETTINGS_VERSION','1.0.1','The version of this module that you are running.',6,0,NULL,'2017-09-07 22:20:08',NULL,'tep_cfg_disabled('),(633,'Enable Settings Module','MODULE_CONTENT_NAVBAR_SETTINGS_STATUS','True','Should the settings menu be shown in the navbar?',6,1,NULL,'2017-09-07 22:20:08',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(634,'Sort Order','MODULE_CONTENT_NAVBAR_SETTINGS_SORT_ORDER','9200','Sort order of display. Lowest is displayed first.',6,2,NULL,'2017-09-07 22:20:08',NULL,NULL),(635,'Content Placement','MODULE_CONTENT_NAVBAR_SETTINGS_CONTENT_PLACEMENT','right','Should the settings menu be loaded on the left or right side of the navbar?',6,3,NULL,'2017-09-07 22:20:08',NULL,'tep_cfg_select_option(array(\'left\', \'right\'), '),(640,'Module Version','MODULE_CONTENT_NAVBAR_ACCOUNT_VERSION','1.0.1','The version of this module that you are running.',6,0,NULL,'2017-09-07 22:21:28',NULL,'tep_cfg_disabled('),(641,'Enable Account Module','MODULE_CONTENT_NAVBAR_ACCOUNT_STATUS','True','Should the account menu be shown in the navbar?',6,1,NULL,'2017-09-07 22:21:28',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(642,'Sort Order','MODULE_CONTENT_NAVBAR_ACCOUNT_SORT_ORDER','9220','Sort order of display. Lowest is displayed first.',6,2,NULL,'2017-09-07 22:21:28',NULL,NULL),(643,'Content Placement','MODULE_CONTENT_NAVBAR_ACCOUNT_CONTENT_PLACEMENT','right','Should the account menu be loaded on the left or right side of the navbar?',6,3,NULL,'2017-09-07 22:21:28',NULL,'tep_cfg_select_option(array(\'left\', \'right\'), '),(644,'Enable Header Breadcrumb Module','MODULE_CONTENT_HEADER_BREADCRUMB_STATUS','True','Do you want to enable the Breadcrumb content module?',6,1,NULL,'2017-09-07 22:22:51',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(645,'Content Width','MODULE_CONTENT_HEADER_BREADCRUMB_CONTENT_WIDTH','8','What width container should the content be shown in?',6,1,NULL,'2017-09-07 22:22:51',NULL,'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), '),(646,'Sort Order','MODULE_CONTENT_HEADER_BREADCRUMB_SORT_ORDER','1','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-09-07 22:22:51',NULL,NULL),(647,'Module Version','MODULE_CONTENT_NAVBAR_CART_VERSION','1.0.1','The version of this module that you are running.',6,0,NULL,'2017-09-07 22:23:46',NULL,'tep_cfg_disabled('),(648,'Enable Cart Module','MODULE_CONTENT_NAVBAR_CART_STATUS','True','Should the shopping cart menu be shown in the navbar?',6,1,NULL,'2017-09-07 22:23:46',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(649,'Sort Order','MODULE_CONTENT_NAVBAR_CART_SORT_ORDER','9240','Sort order of display. Lowest is displayed first.',6,2,NULL,'2017-09-07 22:23:46',NULL,NULL),(650,'Content Placement','MODULE_CONTENT_NAVBAR_CART_CONTENT_PLACEMENT','right','Should the shopping cart menu be loaded on the left or right side of the navbar?',6,3,NULL,'2017-09-07 22:23:46',NULL,'tep_cfg_select_option(array(\'left\', \'right\'), '),(663,'Enable Copyright Details Footer Module','MODULE_CONTENT_FOOTER_EXTRA_COPYRIGHT_STATUS','True','Do you want to enable the Copyright content module?',6,1,NULL,'2017-09-07 22:27:13',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(664,'Content Width','MODULE_CONTENT_FOOTER_EXTRA_COPYRIGHT_CONTENT_WIDTH','6','What width container should the content be shown in? (12 = full width, 6 = half width).',6,1,NULL,'2017-09-07 22:27:13',NULL,'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), '),(665,'Sort Order','MODULE_CONTENT_FOOTER_EXTRA_COPYRIGHT_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-09-07 22:27:13',NULL,NULL),(666,'Enable Braintree Card Management','MODULE_CONTENT_ACCOUNT_BRAINTREE_CARDS_STATUS','True','Do you want to enable the Braintree Card Management module?',6,1,NULL,'2017-09-07 22:27:58',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(667,'Sort Order','MODULE_CONTENT_ACCOUNT_BRAINTREE_CARDS_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-09-07 22:27:58',NULL,NULL),(668,'Enable Login Form Module','MODULE_CONTENT_PWA_LOGIN_STATUS','True','Do you want to enable the login form module?',6,1,NULL,'2017-09-07 22:29:23',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(669,'Content Width','MODULE_CONTENT_PWA_LOGIN_CONTENT_WIDTH','Half','Should the content be shown in a full or half width container?',6,2,NULL,'2017-09-07 22:29:23',NULL,'tep_cfg_select_option(array(\'Full\', \'Half\'), '),(670,'Sort Order','MODULE_CONTENT_PWA_LOGIN_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,3,NULL,'2017-09-07 22:29:23',NULL,NULL),(671,'Require Telephone Number','GUEST_CHECKOUT_TELEPHONE','true','Require Telephone Number?',6,5,'0000-00-00 00:00:00','2017-09-07 22:29:23',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(672,'Enable Generic Text Footer Module','MODULE_CONTENT_FOOTER_TEXT_STATUS','True','Do you want to enable the Generic Text content module?',6,1,NULL,'2017-09-07 22:31:59',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(673,'Content Width','MODULE_CONTENT_FOOTER_TEXT_CONTENT_WIDTH','7','What width container should the content be shown in? (12 = full width, 6 = half width).',6,1,NULL,'2017-09-07 22:31:59',NULL,'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), '),(674,'Sort Order','MODULE_CONTENT_FOOTER_TEXT_SORT_ORDER','2','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-09-07 22:31:59',NULL,NULL),(678,'Enable Payment Icons Footer Module','MODULE_CONTENT_FOOTER_EXTRA_ICONS_STATUS','True','Do you want to enable the Payment Icons content module?',6,1,NULL,'2017-09-07 22:35:23',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(679,'Content Width','MODULE_CONTENT_FOOTER_EXTRA_ICONS_CONTENT_WIDTH','6','What width container should the content be shown in? (12 = full width, 6 = half width).',6,1,NULL,'2017-09-07 22:35:23',NULL,'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), '),(680,'Sort Order','MODULE_CONTENT_FOOTER_EXTRA_ICONS_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-09-07 22:35:23',NULL,NULL),(690,'Enable Information Links Footer Module','MODULE_CONTENT_FOOTER_INFORMATION_STATUS','True','Do you want to enable the Information Links content module?',6,1,NULL,'2017-09-08 01:18:06',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(691,'Content Width','MODULE_CONTENT_FOOTER_INFORMATION_CONTENT_WIDTH','2','What width container should the content be shown in? (12 = full width, 6 = half width).',6,1,NULL,'2017-09-08 01:18:06',NULL,'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), '),(692,'Sort Order','MODULE_CONTENT_FOOTER_INFORMATION_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-09-08 01:18:06',NULL,NULL),(693,'Module Version','MODULE_CONTENT_FRONT_PAGE_TITLE_VERSION','1.2.1','The version of this module that you are running.',6,0,NULL,'2017-09-15 04:49:23',NULL,'tep_cfg_disabled('),(694,'Enable Title Module','MODULE_CONTENT_FRONT_PAGE_TITLE_STATUS','True','Should the title block be shown on the front page?',6,1,NULL,'2017-09-15 04:49:23',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(695,'Sort Order','MODULE_CONTENT_FRONT_PAGE_TITLE_SORT_ORDER','10','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-09-15 04:49:23',NULL,NULL),(696,'Content Width','MODULE_CONTENT_FRONT_PAGE_TITLE_CONTENT_WIDTH','12','What width container should the content be shown in?',6,3,NULL,'2017-09-15 04:49:23',NULL,'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), '),(697,'Module Version','MODULE_CONTENT_FRONT_PAGE_NEW_PRODUCTS_VERSION','1.2.1','The version of this module that you are running.',6,0,NULL,'2017-09-15 04:49:40',NULL,'tep_cfg_disabled('),(698,'Enable New Products Module','MODULE_CONTENT_FRONT_PAGE_NEW_PRODUCTS_STATUS','True','Should the new products block be shown on the front page?',6,1,NULL,'2017-09-15 04:49:40',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(699,'Sort Order','MODULE_CONTENT_FRONT_PAGE_NEW_PRODUCTS_SORT_ORDER','50','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-09-15 04:49:40',NULL,NULL),(700,'Content Width','MODULE_CONTENT_FRONT_PAGE_NEW_PRODUCTS_CONTENT_WIDTH','12','What width container should the content be shown in?',6,3,NULL,'2017-09-15 04:49:40',NULL,'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), '),(701,'Max Products','MODULE_CONTENT_FRONT_PAGE_NEW_PRODUCTS_MAX_DISPLAY_NEW_PRODUCTS','9','Maximum number of new products to show on the front page.',6,2,NULL,'2017-09-15 04:49:40',NULL,NULL),(702,'Module Version','MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_VERSION','1.2.1','The version of this module that you are running.',6,0,NULL,'2017-09-15 04:50:06',NULL,'tep_cfg_disabled('),(703,'Enable Upcoming Products Module','MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_STATUS','True','Should the upcoming products block be shown on the front page?',6,1,NULL,'2017-09-15 04:50:06',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(704,'Module Sort Order','MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_SORT_ORDER','60','Sort order of display of the modules. Lowest is displayed first.',6,0,NULL,'2017-09-15 04:50:06',NULL,NULL),(705,'Content Width','MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_CONTENT_WIDTH','12','What width container should the content be shown in?',6,3,NULL,'2017-09-15 04:50:06',NULL,'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), '),(706,'Max Products Shown','MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_MAX_DISPLAY','9','Maximum number of upcoming products to show on the front page.',6,2,NULL,'2017-09-15 04:50:06',NULL,NULL),(707,'Sort Products By','MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_FIELD','date_expected','Field to sort the upcoming products by.',6,3,NULL,'2017-09-15 04:50:07',NULL,'tep_cfg_select_option(array(\'products_name\', \'date_expected\'), '),(708,'Sort Direction','MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_DIRECTION','desc','Sort in ascending or descending order.',6,4,NULL,'2017-09-15 04:50:07',NULL,'tep_cfg_select_option(array(\'asc\', \'desc\'), '),(709,'Module Version','MODULE_CONTENT_FRONT_PAGE_MESSAGE_VERSION','1.2.1','The version of this module that you are running.',6,0,NULL,'2017-09-15 04:50:39',NULL,'tep_cfg_disabled('),(710,'Enable Message Module','MODULE_CONTENT_FRONT_PAGE_MESSAGE_STATUS','True','Should the Message block be shown on the front page?',6,1,NULL,'2017-09-15 04:50:39',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(711,'Sort Order','MODULE_CONTENT_FRONT_PAGE_MESSAGE_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,2,NULL,'2017-09-15 04:50:39',NULL,NULL),(712,'Content Width','MODULE_CONTENT_FRONT_PAGE_MESSAGE_CONTENT_WIDTH','12','What width container should the content be shown in?',6,3,NULL,'2017-09-15 04:50:39',NULL,'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), '),(713,'Module Version','MODULE_CONTENT_FRONT_PAGE_CAROUSEL_VERSION','1.0.2','The version of this module that you are running.',6,0,NULL,'2017-09-15 04:50:52',NULL,'tep_cfg_disabled('),(714,'Enable Banner Rotator','MODULE_CONTENT_FRONT_PAGE_CAROUSEL_STATUS','True','Do you want to show the banner rotator?',6,1,NULL,'2017-09-15 04:50:52',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(715,'Sort Order','MODULE_CONTENT_FRONT_PAGE_CAROUSEL_SORT_ORDER','10','Sort order of display. Lowest is displayed first.',6,2,NULL,'2017-09-15 04:50:52',NULL,NULL),(716,'Content Width','MODULE_CONTENT_FRONT_PAGE_CAROUSEL_CONTENT_WIDTH','12','What width container should the content be shown in?',6,3,NULL,'2017-09-15 04:50:52',NULL,'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), '),(717,'Banner Order','MODULE_CONTENT_FRONT_PAGE_CAROUSEL_BANNER_ORDER','Asc','Order that the Banner Rotator uses to show the banners.',6,4,NULL,'2017-09-15 04:50:52',NULL,'tep_cfg_select_option(array(\'Asc\', \'Desc\'), '),(718,'Banner Rotator Group','MODULE_CONTENT_FRONT_PAGE_CAROUSEL_GROUP','rotator','Name of the banner group that the Banner Rotator uses to show the banners.',6,5,NULL,'2017-09-15 04:50:52',NULL,NULL),(719,'Banner Rotator Max Banners','MODULE_CONTENT_FRONT_PAGE_CAROUSEL_MAX_DISPLAY','4','Maximum number of banners that the Banner Rotator will show',6,6,NULL,'2017-09-15 04:50:52',NULL,NULL),(720,'Align Banners','MODULE_CONTENT_FRONT_PAGE_CAROUSEL_ALIGN','center','Align the banners to the left, center, or right?',6,7,NULL,'2017-09-15 04:50:52',NULL,'tep_cfg_select_option(array(\'left\', \'center\', \'right\'), '),(721,'Automatic Carousel','MODULE_CONTENT_FRONT_PAGE_CAROUSEL_AUTOPLAY','true','Do you want the carousel to run automatically?',6,8,NULL,'2017-09-15 04:50:52',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(722,'Start Delay','MODULE_CONTENT_FRONT_PAGE_CAROUSEL_START_DELAY','0','Delay the start of the carousel (1000 = 1 second).',6,9,NULL,'2017-09-15 04:50:52',NULL,NULL),(723,'Hold Time','MODULE_CONTENT_FRONT_PAGE_CAROUSEL_HOLD_TIME','4000','The time each banner is shown (1000 = 1 second).',6,10,NULL,'2017-09-15 04:50:52',NULL,NULL),(724,'Transition Time','MODULE_CONTENT_FRONT_PAGE_CAROUSEL_TRANSITION_TIME','500','The time to transition between banners (1000 = 1 second).',6,11,NULL,'2017-09-15 04:50:52',NULL,NULL),(725,'Easing','MODULE_CONTENT_FRONT_PAGE_CAROUSEL_EASING','swing','How the carousel transitions between banners.',6,12,NULL,'2017-09-15 04:50:52',NULL,'tep_cfg_pull_down_easing_list('),(726,'Loop Around','MODULE_CONTENT_FRONT_PAGE_CAROUSEL_LOOP','true','Do you want the carousel to start again after showing all of the banners?',6,13,NULL,'2017-09-15 04:50:52',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(727,'Module Version','MODULE_CONTENT_FRONT_PAGE_TEXT_MAIN_VERSION','1.2.1','The version of this module that you are running.',6,0,NULL,'2017-09-15 04:51:48',NULL,'tep_cfg_disabled('),(728,'Enable Main Text Module','MODULE_CONTENT_FRONT_PAGE_TEXT_MAIN_STATUS','True','Should the main text block be shown on the front page?',6,1,NULL,'2017-09-15 04:51:48',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(729,'Sort Order','MODULE_CONTENT_FRONT_PAGE_TEXT_MAIN_SORT_ORDER','40','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-09-15 04:51:48',NULL,NULL),(730,'Content Width','MODULE_CONTENT_FRONT_PAGE_TEXT_MAIN_CONTENT_WIDTH','12','What width container should the content be shown in?',6,3,NULL,'2017-09-15 04:51:48',NULL,'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), '),(731,'Module Version','MODULE_CONTENT_FRONT_PAGE_NEW_BLOG_ARTICLES_VERSION','1.0','The version of this module that you are running.',6,0,NULL,'2017-09-15 04:52:22',NULL,'tep_cfg_disabled('),(732,'Enable New Blog Articles Module','MODULE_CONTENT_FRONT_PAGE_NEW_BLOG_ARTICLES_STATUS','True','Should the new blog articles block be shown on the front page?',6,1,NULL,'2017-09-15 04:52:22',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(733,'Sort Order','MODULE_CONTENT_FRONT_PAGE_NEW_BLOG_ARTICLES_SORT_ORDER','90','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-09-15 04:52:22',NULL,NULL),(734,'Content Width','MODULE_CONTENT_FRONT_PAGE_NEW_BLOG_ARTICLES_CONTENT_WIDTH','12','What width container should the content be shown in?',6,3,NULL,'2017-09-15 04:52:23',NULL,'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), '),(735,'Max Products','MODULE_CONTENT_FRONT_PAGE_NEW_BLOG_ARTICLES_MAX_DISPLAY_NEW_ARTICLES','3','Maximum number of new blog articles to show on the front page.',6,2,NULL,'2017-09-15 04:52:23',NULL,NULL),(742,'CONFIG_TITLE_LISTING_SNIPPET_LENGHT','LISTING_SNIPPET_LENGHT','40','CONFIG_DESCRIPTION_LISTING_SNIPPET_LENGHT',8,15,NULL,'2017-09-15 23:48:36',NULL,NULL),(800,'Enable SEO URLs?','SEO_ENABLED','true','Enable the SEO URLs?  This is a global setting and will turn them off completely.',110,0,'2017-10-02 00:21:38','2017-10-02 00:21:38',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(801,'Add cPath to product URLs?','SEO_ADD_CID_TO_PRODUCT_URLS','false','This setting will append the cPath to the end of product URLs (i.e. - some-product-p-1.html?cPath=xx).',110,1,'2017-10-02 00:21:38','2017-10-02 00:21:38',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(802,'Add category parent to product URLs?','SEO_ADD_CPATH_TO_PRODUCT_URLS','true','This setting will append the category parent(s) name to the product URLs (i.e. - parent-some-product-p-1.html).',110,2,'2017-11-24 18:10:21','2017-10-02 00:21:38',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(803,'Add category parent to begining of URLs?','SEO_ADD_CAT_PARENT','true','This setting will add the category parent(s) name to the beginning of the category URLs (i.e. - parent-category-c-1.html).',110,3,'2017-11-24 18:10:30','2017-10-02 00:21:38',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(804,'Filter Short Words','SEO_URLS_FILTER_SHORT_WORDS','0','This setting will filter words less than or equal to the value from the URL.',110,4,'2017-11-20 17:52:29','2017-10-02 00:21:38',NULL,NULL),(805,'Output W3C valid URLs (parameter string)?','SEO_URLS_USE_W3C_VALID','true','This setting will output W3C valid URLs.',110,5,'2017-10-02 00:21:38','2017-10-02 00:21:38',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(806,'Enable SEO cache to save queries?','USE_SEO_CACHE_GLOBAL','true','This is a global setting and will turn off caching completely.',110,6,'2017-10-02 00:21:39','2017-10-02 00:21:39',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(807,'Enable product cache?','USE_SEO_CACHE_PRODUCTS','true','This will turn off caching for the products.',110,7,'2017-10-02 00:21:39','2017-10-02 00:21:39',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(808,'Enable categories cache?','USE_SEO_CACHE_CATEGORIES','true','This will turn off caching for the categories.',110,8,'2017-10-02 00:21:39','2017-10-02 00:21:39',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(809,'Enable manufacturers cache?','USE_SEO_CACHE_MANUFACTURERS','true','This will turn off caching for the manufacturers.',110,9,'2017-10-02 00:21:39','2017-10-02 00:21:39',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(810,'Enable Articles Manager Articles cache?','USE_SEO_CACHE_ARTICLES','false','This will turn off caching for the Articles Manager articles.',110,10,'2017-10-02 00:21:39','2017-10-02 00:21:39',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(811,'Enable Articles Manager Topics cache?','USE_SEO_CACHE_TOPICS','false','This will turn off caching for the Articles Manager topics.',110,11,'2017-10-02 00:21:39','2017-10-02 00:21:39',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(812,'Enable FAQDesk Categories cache?','USE_SEO_CACHE_FAQDESK_CATEGORIES','false','This will turn off caching for the FAQDesk Category pages.',110,12,'2017-10-02 00:21:39','2017-10-02 00:21:39',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(813,'Enable Information Pages cache?','USE_SEO_CACHE_INFO_PAGES','false','This will turn off caching for Information Pages.',110,13,'2017-10-02 00:21:39','2017-10-02 00:21:39',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(814,'Enable Links Manager cache?','USE_SEO_CACHE_LINKS','false','This will turn off caching for the Links Manager category pages.',110,14,'2017-10-02 00:21:39','2017-10-02 00:21:39',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(815,'Enable NewsDesk Articles cache?','USE_SEO_CACHE_NEWSDESK_ARTICLES','false','This will turn off caching for the NewsDesk Article pages.',110,15,'2017-10-02 00:21:39','2017-10-02 00:21:39',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(816,'Enable NewsDesk Categories cache?','USE_SEO_CACHE_NEWSDESK_CATEGORIES','false','This will turn off caching for the NewsDesk Category pages.',110,16,'2017-10-02 00:21:39','2017-10-02 00:21:39',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(817,'Enable Pollbooth cache?','USE_SEO_CACHE_POLLBOOTH','false','This will turn off caching for Pollbooth.',110,17,'2017-10-02 00:21:39','2017-10-02 00:21:39',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(818,'Enable Page Editor cache?','USE_SEO_CACHE_PAGE_EDITOR','false','This will turn off caching for the Page Editor pages.',110,18,'2017-10-02 00:21:39','2017-10-02 00:21:39',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(819,'Enable automatic redirects?','USE_SEO_REDIRECT','true','This will activate the automatic redirect code and send 301 headers for old to new URLs.',110,19,'2017-10-02 00:21:39','2017-10-02 00:21:39',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(820,'Enable use Header Tags SEO as name?','USE_SEO_HEADER_TAGS','false','This will cause the title set in Header Tags SEO to be used instead of the categories or products name.',110,20,'2017-10-02 00:21:39','2017-10-02 00:21:39',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(821,'Enable performance checker?','USE_SEO_PERFORMANCE_CHECK','false','This will cause the code to track all database queries so that its affect on the speed of the page can be determined. Enabling it will cause a small speed loss.',110,21,'2017-10-02 00:21:39','2017-10-02 00:21:39',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(822,'Choose URL Rewrite Type','SEO_REWRITE_TYPE','Rewrite','Choose which SEO URL format to use.',110,22,'2017-10-02 00:21:39','2017-10-02 00:21:39',NULL,'tep_cfg_select_option(array(\'Rewrite\'),'),(823,'Enter special character conversions','SEO_CHAR_CONVERT_SET','','This setting will convert characters.<br><br>The format <b>MUST</b> be in the form: <b>char=>conv,char2=>conv2</b>',110,23,'2017-10-02 00:21:39','2017-10-02 00:21:39',NULL,NULL),(824,'Remove all non-alphanumeric characters?','SEO_REMOVE_ALL_SPEC_CHARS','false','This will remove all non-letters and non-numbers.  This should be handy to remove all special characters with 1 setting.',110,24,'2017-10-02 00:21:39','2017-10-02 00:21:39',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(825,'Reset SEO URLs Cache','SEO_URLS_CACHE_RESET','false','This will reset the cache data for SEO',110,25,'2017-10-02 00:21:39','2017-10-02 00:21:39','tep_reset_cache_data_seo_urls','tep_cfg_select_option(array(\'reset\', \'false\'),'),(826,'Uninstall Ultimate SEO','SEO_URLS_DB_UNINSTALL','false','This will delete all of the entries in the configuration table for SEO',110,26,'2017-10-02 00:21:39','2017-10-02 00:21:39','tep_reset_cache_data_seo_urls','tep_cfg_select_option(array(\'uninstall\', \'false\'),'),(827,'Enable Articles Meta Module','MODULE_HEADER_TAGS_ARTICLE_META_STATUS','True','Do you want to allow article meta tags to be added to the page header?',6,1,NULL,'2017-11-20 17:55:20',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(828,'Sort Order','MODULE_HEADER_TAGS_ARTICLE_META_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-11-20 17:55:20',NULL,NULL),(829,'Enable Article Title Module','MODULE_HEADER_TAGS_ARTICLE_TITLE_STATUS','True','Do you want to allow article titles to be added to the page title?',6,1,NULL,'2017-11-20 17:55:34',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(830,'Sort Order','MODULE_HEADER_TAGS_ARTICLE_TITLE_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-11-20 17:55:34',NULL,NULL),(831,'Enable Equal Heights Module','MODULE_HEADER_TAGS_DIV_EQUAL_HEIGHTS_STATUS','True','Do you want to enable the Equal Heights module?',6,1,NULL,'2017-11-20 17:56:46',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(832,'Pages','MODULE_HEADER_TAGS_DIV_EQUAL_HEIGHTS_PAGES','advanced_search_result.php;index.php;products_new.php','The pages to add the script to.',6,0,NULL,'2017-11-20 17:56:46','ht_div_equal_heights_show_pages','ht_div_equal_heights_edit_pages('),(833,'Sort Order','MODULE_HEADER_TAGS_DIV_EQUAL_HEIGHTS_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-11-20 17:56:46',NULL,NULL),(834,'CONFIG_TITLE_ORDER_SEND_CUSTOMERS_EMAIL_PHONE','ORDER_SEND_CUSTOMERS_EMAIL_PHONE','false','CONFIG_DESCRIPTION_ORDER_SEND_CUSTOMERS_EMAIL_PHONE',12,11,'2017-11-20 18:07:50','2017-11-20 18:07:50',NULL,NULL),(835,'Enable Check/Money Order Module','MODULE_PAYMENT_MONEYORDER_STATUS','True','Do you want to accept Check/Money Order payments?',6,1,NULL,'2017-11-20 18:20:47',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(836,'Make Payable to:','MODULE_PAYMENT_MONEYORDER_PAYTO','','Who should payments be made payable to?',6,1,NULL,'2017-11-20 18:20:47',NULL,NULL),(837,'Sort order of display.','MODULE_PAYMENT_MONEYORDER_SORT_ORDER','1','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-11-20 18:20:47',NULL,NULL),(838,'Payment Zone','MODULE_PAYMENT_MONEYORDER_ZONE','0','If a zone is selected, only enable this payment method for that zone.',6,2,NULL,'2017-11-20 18:20:47','tep_get_zone_class_title','tep_cfg_pull_down_zone_classes('),(839,'Set Order Status','MODULE_PAYMENT_MONEYORDER_ORDER_STATUS_ID','0','Set the status of orders made with this payment module to this value',6,0,NULL,'2017-11-20 18:20:47','tep_get_order_status_name','tep_cfg_pull_down_order_statuses('),(905,'MODULE_PAYMENT_COD_STATUS_TITLE','MODULE_PAYMENT_COD_STATUS','True','MODULE_PAYMENT_COD_STATUS_DESCRIPTION',6,1,NULL,'2017-12-10 03:45:08',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(906,'CONFIGURATION_TITLE_MODULE_PAYMENT_COD_ZONE','MODULE_PAYMENT_COD_ZONE','2','CONFIGURATION_DESCRIPTION_MODULE_PAYMENT_COD_ZONE',6,2,NULL,'2017-12-10 03:45:08','tep_get_zone_class_title','tep_cfg_pull_down_zone_classes('),(907,'CONFIGURATION_TITLE_MODULE_PAYMENT_COD_SORT_ORDER','MODULE_PAYMENT_COD_SORT_ORDER','2','CONFIGURATION_DESCRIPTION_MODULE_PAYMENT_COD_SORT_ORDER',6,0,NULL,'2017-12-10 03:45:08',NULL,NULL),(908,'CONFIGURATTION_TITLE_MODULE_PAYMENT_COD_ORDER_STATUS_ID','MODULE_PAYMENT_COD_ORDER_STATUS_ID','0','CONFIGURATION_DESCRIPTION_MODULE_PAYMENT_COD_ORDER_STATUS_ID',6,0,NULL,'2017-12-10 03:45:08','tep_get_order_status_name','tep_cfg_pull_down_order_statuses('),(954,'CONFIG_TITLE_MODULE_SHIPPING_ZONES_STATUS','MODULE_SHIPPING_ZONES_STATUS','True','CONFIG_DESCRIPTION_MODULE_SHIPPING_ZONES_STATUS',6,0,NULL,'2017-12-10 04:04:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(955,'CONFIG_TITLE_MODULE_SHIPPING_ZONES_TAX_CLASS','MODULE_SHIPPING_ZONES_TAX_CLASS','0','CONFIG_DESCRIPTION_MODULE_SHIPPING_ZONES_TAX_CLASS',6,0,NULL,'2017-12-10 04:04:19','tep_get_tax_class_title','tep_cfg_pull_down_tax_classes('),(956,'CONFIG_TITLE_MODULE_SHIPPING_ZONES_SORT_ORDER','MODULE_SHIPPING_ZONES_SORT_ORDER','0','CONFIG_DESCRIPTION_MODULE_SHIPPING_ZONES_SORT_ORDER',6,0,NULL,'2017-12-10 04:04:19',NULL,NULL),(957,'CONFIG_TITLE_NUM_ZONES','NUM_ZONES','3','CONFIG_DESCRIPTION_NUM_ZONES',6,0,NULL,'2017-12-10 04:04:19',NULL,NULL),(958,'CONFIG_TITLE_MODULE_SHIPPING_ZONES_MODE','MODULE_SHIPPING_ZONES_MODE','price','CONFIG_DESCRIPTION_MODULE_SHIPPING_ZONES_MODE',6,0,NULL,'2017-12-10 04:04:19',NULL,'tep_cfg_select_option(array(\'weight\', \'price\'), '),(959,'Zone 1 Countries (Empty for all others not listed above)','MODULE_SHIPPING_ZONES_COUNTRIES_1','CZ','Comma separated list of two character ISO country codes that are part of Zone 1.',6,0,NULL,'2017-12-10 04:04:19',NULL,NULL),(960,'Zone 1 Shipping Method Name','MODULE_SHIPPING_ZONES_TITLE_1','Česká pošta','Description of this shipping method shown during checkout. ie. UPS Ground.',6,0,NULL,'2017-12-10 04:04:19',NULL,NULL),(961,'Zone 1 Shipping Table','MODULE_SHIPPING_ZONES_COST_1','1999:60,100000000:0','Shipping rates to Zone 1 destinations based on a group of maximum order weights. Example: 3:8.50,7:10.50,... Weights less than or equal to 3 would cost 8.50 for Zone 1 destinations.',6,0,NULL,'2017-12-10 04:04:19',NULL,NULL),(962,'Zone 1 Handling Fee','MODULE_SHIPPING_ZONES_HANDLING_1','0','Handling Fee for this shipping zone',6,0,NULL,'2017-12-10 04:04:19',NULL,NULL),(963,'Zone 2 Countries (Empty for all others not listed above)','MODULE_SHIPPING_ZONES_COUNTRIES_2','SK','Comma separated list of two character ISO country codes that are part of Zone 2.',6,0,NULL,'2017-12-10 04:04:19',NULL,NULL),(964,'Zone 2 Shipping Method Name','MODULE_SHIPPING_ZONES_TITLE_2','Česká pošta','Description of this shipping method shown during checkout. ie. UPS Ground.',6,0,NULL,'2017-12-10 04:04:19',NULL,NULL),(965,'Zone 2 Shipping Table','MODULE_SHIPPING_ZONES_COST_2','1999:150,100000000:0','Shipping rates to Zone 2 destinations based on a group of maximum order weights. Example: 3:8.50,7:10.50,... Weights less than or equal to 3 would cost 8.50 for Zone 2 destinations.',6,0,NULL,'2017-12-10 04:04:19',NULL,NULL),(966,'Zone 2 Handling Fee','MODULE_SHIPPING_ZONES_HANDLING_2','0','Handling Fee for this shipping zone',6,0,NULL,'2017-12-10 04:04:20',NULL,NULL),(967,'Zone 3 Countries (Empty for all others not listed above)','MODULE_SHIPPING_ZONES_COUNTRIES_3','','Comma separated list of two character ISO country codes that are part of Zone 3.',6,0,NULL,'2017-12-10 04:04:20',NULL,NULL),(968,'Zone 3 Shipping Method Name','MODULE_SHIPPING_ZONES_TITLE_3','UPS Ground','Description of this shipping method shown during checkout. ie. UPS Ground.',6,0,NULL,'2017-12-10 04:04:20',NULL,NULL),(969,'Zone 3 Shipping Table','MODULE_SHIPPING_ZONES_COST_3','2999:200,100000000:0','Shipping rates to Zone 3 destinations based on a group of maximum order weights. Example: 3:8.50,7:10.50,... Weights less than or equal to 3 would cost 8.50 for Zone 3 destinations.',6,0,NULL,'2017-12-10 04:04:20',NULL,NULL),(970,'Zone 3 Handling Fee','MODULE_SHIPPING_ZONES_HANDLING_3','0','Handling Fee for this shipping zone',6,0,NULL,'2017-12-10 04:04:20',NULL,NULL),(971,'Zone 4 Countries (Empty for all others not listed above)','MODULE_SHIPPING_ZONES_COUNTRIES_4','','Comma separated list of two character ISO country codes that are part of Zone 4.',6,0,NULL,'2017-12-10 04:04:20',NULL,NULL),(972,'Zone 4 Shipping Method Name','MODULE_SHIPPING_ZONES_TITLE_4','UPS Ground','Description of this shipping method shown during checkout. ie. UPS Ground.',6,0,NULL,'2017-12-10 04:04:20',NULL,NULL),(973,'Zone 4 Shipping Table','MODULE_SHIPPING_ZONES_COST_4','3:8.50,7:10.50,99:20.00','Shipping rates to Zone 4 destinations based on a group of maximum order weights. Example: 3:8.50,7:10.50,... Weights less than or equal to 3 would cost 8.50 for Zone 4 destinations.',6,0,NULL,'2017-12-10 04:04:20',NULL,NULL),(974,'Zone 4 Handling Fee','MODULE_SHIPPING_ZONES_HANDLING_4','0','Handling Fee for this shipping zone',6,0,NULL,'2017-12-10 04:04:20',NULL,NULL),(975,'Zone 5 Countries (Empty for all others not listed above)','MODULE_SHIPPING_ZONES_COUNTRIES_5','','Comma separated list of two character ISO country codes that are part of Zone 5.',6,0,NULL,'2017-12-10 04:04:20',NULL,NULL),(976,'Zone 5 Shipping Method Name','MODULE_SHIPPING_ZONES_TITLE_5','UPS Ground','Description of this shipping method shown during checkout. ie. UPS Ground.',6,0,NULL,'2017-12-10 04:04:20',NULL,NULL),(977,'Zone 5 Shipping Table','MODULE_SHIPPING_ZONES_COST_5','3:8.50,7:10.50,99:20.00','Shipping rates to Zone 5 destinations based on a group of maximum order weights. Example: 3:8.50,7:10.50,... Weights less than or equal to 3 would cost 8.50 for Zone 5 destinations.',6,0,NULL,'2017-12-10 04:04:20',NULL,NULL),(978,'Zone 5 Handling Fee','MODULE_SHIPPING_ZONES_HANDLING_5','0','Handling Fee for this shipping zone',6,0,NULL,'2017-12-10 04:04:20',NULL,NULL),(979,'Zone 6 Countries (Empty for all others not listed above)','MODULE_SHIPPING_ZONES_COUNTRIES_6','','Comma separated list of two character ISO country codes that are part of Zone 6.',6,0,NULL,'2017-12-10 04:04:20',NULL,NULL),(980,'Zone 6 Shipping Method Name','MODULE_SHIPPING_ZONES_TITLE_6','UPS Ground','Description of this shipping method shown during checkout. ie. UPS Ground.',6,0,NULL,'2017-12-10 04:04:20',NULL,NULL),(981,'Zone 6 Shipping Table','MODULE_SHIPPING_ZONES_COST_6','3:8.50,7:10.50,99:20.00','Shipping rates to Zone 6 destinations based on a group of maximum order weights. Example: 3:8.50,7:10.50,... Weights less than or equal to 3 would cost 8.50 for Zone 6 destinations.',6,0,NULL,'2017-12-10 04:04:20',NULL,NULL),(982,'Zone 6 Handling Fee','MODULE_SHIPPING_ZONES_HANDLING_6','0','Handling Fee for this shipping zone',6,0,NULL,'2017-12-10 04:04:20',NULL,NULL),(983,'Zone 7 Countries (Empty for all others not listed above)','MODULE_SHIPPING_ZONES_COUNTRIES_7','','Comma separated list of two character ISO country codes that are part of Zone 7.',6,0,NULL,'2017-12-10 04:04:20',NULL,NULL),(984,'Zone 7 Shipping Method Name','MODULE_SHIPPING_ZONES_TITLE_7','UPS Ground','Description of this shipping method shown during checkout. ie. UPS Ground.',6,0,NULL,'2017-12-10 04:04:20',NULL,NULL),(985,'Zone 7 Shipping Table','MODULE_SHIPPING_ZONES_COST_7','3:8.50,7:10.50,99:20.00','Shipping rates to Zone 7 destinations based on a group of maximum order weights. Example: 3:8.50,7:10.50,... Weights less than or equal to 3 would cost 8.50 for Zone 7 destinations.',6,0,NULL,'2017-12-10 04:04:20',NULL,NULL),(986,'Zone 7 Handling Fee','MODULE_SHIPPING_ZONES_HANDLING_7','0','Handling Fee for this shipping zone',6,0,NULL,'2017-12-10 04:04:20',NULL,NULL),(987,'Zone 8 Countries (Empty for all others not listed above)','MODULE_SHIPPING_ZONES_COUNTRIES_8','','Comma separated list of two character ISO country codes that are part of Zone 8.',6,0,NULL,'2017-12-10 04:04:21',NULL,NULL),(988,'Zone 8 Shipping Method Name','MODULE_SHIPPING_ZONES_TITLE_8','UPS Ground','Description of this shipping method shown during checkout. ie. UPS Ground.',6,0,NULL,'2017-12-10 04:04:21',NULL,NULL),(989,'Zone 8 Shipping Table','MODULE_SHIPPING_ZONES_COST_8','3:8.50,7:10.50,99:20.00','Shipping rates to Zone 8 destinations based on a group of maximum order weights. Example: 3:8.50,7:10.50,... Weights less than or equal to 3 would cost 8.50 for Zone 8 destinations.',6,0,NULL,'2017-12-10 04:04:21',NULL,NULL),(990,'Zone 8 Handling Fee','MODULE_SHIPPING_ZONES_HANDLING_8','0','Handling Fee for this shipping zone',6,0,NULL,'2017-12-10 04:04:21',NULL,NULL),(991,'Zone 9 Countries (Empty for all others not listed above)','MODULE_SHIPPING_ZONES_COUNTRIES_9','','Comma separated list of two character ISO country codes that are part of Zone 9.',6,0,NULL,'2017-12-10 04:04:21',NULL,NULL),(992,'Zone 9 Shipping Method Name','MODULE_SHIPPING_ZONES_TITLE_9','UPS Ground','Description of this shipping method shown during checkout. ie. UPS Ground.',6,0,NULL,'2017-12-10 04:04:21',NULL,NULL),(993,'Zone 9 Shipping Table','MODULE_SHIPPING_ZONES_COST_9','3:8.50,7:10.50,99:20.00','Shipping rates to Zone 9 destinations based on a group of maximum order weights. Example: 3:8.50,7:10.50,... Weights less than or equal to 3 would cost 8.50 for Zone 9 destinations.',6,0,NULL,'2017-12-10 04:04:21',NULL,NULL),(994,'Zone 9 Handling Fee','MODULE_SHIPPING_ZONES_HANDLING_9','0','Handling Fee for this shipping zone',6,0,NULL,'2017-12-10 04:04:21',NULL,NULL),(995,'Zone 10 Countries (Empty for all others not listed above)','MODULE_SHIPPING_ZONES_COUNTRIES_10','','Comma separated list of two character ISO country codes that are part of Zone 10.',6,0,NULL,'2017-12-10 04:04:21',NULL,NULL),(996,'Zone 10 Shipping Method Name','MODULE_SHIPPING_ZONES_TITLE_10','UPS Ground','Description of this shipping method shown during checkout. ie. UPS Ground.',6,0,NULL,'2017-12-10 04:04:21',NULL,NULL),(997,'Zone 10 Shipping Table','MODULE_SHIPPING_ZONES_COST_10','3:8.50,7:10.50,99:20.00','Shipping rates to Zone 10 destinations based on a group of maximum order weights. Example: 3:8.50,7:10.50,... Weights less than or equal to 3 would cost 8.50 for Zone 10 destinations.',6,0,NULL,'2017-12-10 04:04:21',NULL,NULL),(998,'Zone 10 Handling Fee','MODULE_SHIPPING_ZONES_HANDLING_10','0','Handling Fee for this shipping zone',6,0,NULL,'2017-12-10 04:04:21',NULL,NULL),(999,'Enable Topic Title Module','MODULE_HEADER_TAGS_TOPIC_TITLE_STATUS','True','Do you want to allow topic titles to be added to the page title?',6,1,NULL,'2017-12-11 22:36:55',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(1000,'Sort Order','MODULE_HEADER_TAGS_TOPIC_TITLE_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-12-11 22:36:56',NULL,NULL),(1001,'Module Version','MODULE_NAVIGATION_BAR_STORE_SEARCH_VERSION','1.0.1','The version of this module that you are running.',6,0,NULL,'2017-12-12 01:39:03',NULL,'tep_cfg_disabled('),(1002,'Enable Navbar Search Module','MODULE_NAVIGATION_BAR_STORE_SEARCH_STATUS','True','Do you want to add the module to your shop?',6,1,NULL,'2017-12-12 01:39:03',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(1003,'Content Placement','MODULE_NAVIGATION_BAR_STORE_SEARCH_PLACEMENT','left','Should the link be loaded on the left or right side of the navbar?',6,3,NULL,'2017-12-12 01:39:04',NULL,'tep_cfg_select_option(array(\'left\', \'right\'), '),(1004,'Enable Extended Store Search Functions','MODULE_NAVIGATION_BAR_STORE_SEARCH_FUNCTIONS','Standard','Do you want to enable search function in descriptions?',6,1,NULL,'2017-12-12 01:39:04',NULL,'tep_cfg_select_option(array(\'Standard\', \'Descriptions\'), '),(1005,'Product Image Width Desktop (LG size)','MODULE_NAVIGATION_BAR_STORE_SEARCH_IMAGE_WIDTH_LG','80','What image width must be displayed for desktops?',6,6,NULL,'2017-12-12 01:39:04',NULL,NULL),(1006,'Product Image Width Tablet+ (MD size)','MODULE_NAVIGATION_BAR_STORE_SEARCH_IMAGE_WIDTH_MD','66','What image width must be displayed for tablets+?',6,7,NULL,'2017-12-12 01:39:04',NULL,NULL),(1007,'Product Image Width Tablet (SM size)','MODULE_NAVIGATION_BAR_STORE_SEARCH_IMAGE_WIDTH_SM','50','What image width must be displayed for tablets?',6,8,NULL,'2017-12-12 01:39:04',NULL,NULL),(1008,'Product Image Width Mobile (XS size)','MODULE_NAVIGATION_BAR_STORE_SEARCH_IMAGE_WIDTH_XS','40','What image width must be displayed for mobiles?',6,9,NULL,'2017-12-12 01:39:04',NULL,NULL),(1009,'Pages','MODULE_NAVIGATION_BAR_STORE_SEARCH_PAGES','account_history.php;address_book.php;advanced_search.php;conditions.php;contact_us.php;cookie_usage.php;create_account.php;login.php;privacy.php;products_new.php;reviews.php;shipping.php;shopping_cart.php;specials.php;ssl_check.php','The pages to add the Store Search\'s results.',6,0,NULL,'2017-12-12 01:39:04','cm_nb_store_search_show_pages','cm_nb_store_search_pages('),(1010,'Sort Order','MODULE_NAVIGATION_BAR_STORE_SEARCH_SORT_ORDER','1','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-12-12 01:39:04',NULL,NULL),(1011,'Module Version','MODULE_CONTENT_NAVBAR_CATEGORIES_VERSION','1.0.1','The version of this module that you are running.',6,0,NULL,'2017-12-12 01:42:47',NULL,'tep_cfg_disabled('),(1012,'Enable Categories Module','MODULE_CONTENT_NAVBAR_CATEGORIES_STATUS','True','Should the categories menu dropdown be shown in the navbar?',6,1,NULL,'2017-12-12 01:42:47',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(1013,'Sort Order','MODULE_CONTENT_NAVBAR_CATEGORIES_SORT_ORDER','2','Sort order of display. Lowest is displayed first.',6,2,NULL,'2017-12-12 01:42:47',NULL,NULL),(1014,'Content Placement','MODULE_CONTENT_NAVBAR_CATEGORIES_CONTENT_PLACEMENT','right','Should the contact us link be loaded on the left or right side of the navbar?',6,3,NULL,'2017-12-12 01:42:47',NULL,'tep_cfg_select_option(array(\'left\', \'right\'), ');
/*!40000 ALTER TABLE `configuration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuration_group`
--

DROP TABLE IF EXISTS `configuration_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuration_group` (
  `configuration_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `configuration_group_title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `configuration_group_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sort_order` int(5) DEFAULT NULL,
  `visible` int(1) DEFAULT '1',
  PRIMARY KEY (`configuration_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuration_group`
--

LOCK TABLES `configuration_group` WRITE;
/*!40000 ALTER TABLE `configuration_group` DISABLE KEYS */;
INSERT INTO `configuration_group` VALUES (1,'My Store','General information about my store',1,1),(2,'Minimum Values','The minimum values for functions / data',2,1),(3,'Maximum Values','The maximum values for functions / data',3,1),(4,'Images','Image parameters',4,1),(5,'Customer Details','Customer account configuration',5,1),(6,'Module Options','Hidden from configuration',6,0),(7,'Shipping/Packaging','Shipping options available at my store',7,1),(8,'Product Listing','Product Listing    configuration options',8,1),(9,'Stock','Stock configuration options',9,1),(10,'Logging','Logging configuration options',10,1),(11,'Cache','Caching configuration options',11,1),(12,'E-Mail Options','General setting for E-Mail transport and HTML E-Mails',12,1),(13,'Download','Downloadable products options',13,1),(14,'GZip Compression','GZip compression options',14,1),(15,'Sessions','Session options',15,1),(16,'Bootstrap Setup','Basic Bootstrap Options',16,1),(17,'Products admin values visible','Define values in categories/product to be visible',17,1),(72,'Order Editor','Configuration options for Order Editor',72,1),(100,'CCGV Settings','Discount Coupons and Gift Voucher Settings',100,1),(102,'Article Manager','Article Manager site wide options',102,1),(103,'Header Tags SEO','Header Tags SEO site wide options',22,1),(110,'SEO URLs','Options for Ultimate SEO URLs by Chemo',103,1);
/*!40000 ALTER TABLE `configuration_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `countries_id` int(11) NOT NULL AUTO_INCREMENT,
  `countries_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `countries_iso_code_2` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `countries_iso_code_3` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `address_format_id` int(11) NOT NULL,
  PRIMARY KEY (`countries_id`),
  KEY `IDX_COUNTRIES_NAME` (`countries_name`)
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'Afghanistan','AF','AFG',1),(2,'Albania','AL','ALB',1),(3,'Algeria','DZ','DZA',1),(4,'American Samoa','AS','ASM',1),(5,'Andorra','AD','AND',1),(6,'Angola','AO','AGO',1),(7,'Anguilla','AI','AIA',1),(8,'Antarctica','AQ','ATA',1),(9,'Antigua and Barbuda','AG','ATG',1),(10,'Argentina','AR','ARG',1),(11,'Armenia','AM','ARM',1),(12,'Aruba','AW','ABW',1),(13,'Australia','AU','AUS',1),(14,'Austria','AT','AUT',5),(15,'Azerbaijan','AZ','AZE',1),(16,'Bahamas','BS','BHS',1),(17,'Bahrain','BH','BHR',1),(18,'Bangladesh','BD','BGD',1),(19,'Barbados','BB','BRB',1),(20,'Belarus','BY','BLR',1),(21,'Belgium','BE','BEL',1),(22,'Belize','BZ','BLZ',1),(23,'Benin','BJ','BEN',1),(24,'Bermuda','BM','BMU',1),(25,'Bhutan','BT','BTN',1),(26,'Bolivia','BO','BOL',1),(27,'Bosnia and Herzegowina','BA','BIH',1),(28,'Botswana','BW','BWA',1),(29,'Bouvet Island','BV','BVT',1),(30,'Brazil','BR','BRA',1),(31,'British Indian Ocean Territory','IO','IOT',1),(32,'Brunei Darussalam','BN','BRN',1),(33,'Bulgaria','BG','BGR',1),(34,'Burkina Faso','BF','BFA',1),(35,'Burundi','BI','BDI',1),(36,'Cambodia','KH','KHM',1),(37,'Cameroon','CM','CMR',1),(38,'Canada','CA','CAN',1),(39,'Cape Verde','CV','CPV',1),(40,'Cayman Islands','KY','CYM',1),(41,'Central African Republic','CF','CAF',1),(42,'Chad','TD','TCD',1),(43,'Chile','CL','CHL',1),(44,'China','CN','CHN',1),(45,'Christmas Island','CX','CXR',1),(46,'Cocos (Keeling) Islands','CC','CCK',1),(47,'Colombia','CO','COL',1),(48,'Comoros','KM','COM',1),(49,'Congo','CG','COG',1),(50,'Cook Islands','CK','COK',1),(51,'Costa Rica','CR','CRI',1),(52,'Cote D\'Ivoire','CI','CIV',1),(53,'Croatia','HR','HRV',1),(54,'Cuba','CU','CUB',1),(55,'Cyprus','CY','CYP',1),(56,'Czech Republic','CZ','CZE',1),(57,'Denmark','DK','DNK',1),(58,'Djibouti','DJ','DJI',1),(59,'Dominica','DM','DMA',1),(60,'Dominican Republic','DO','DOM',1),(61,'East Timor','TP','TMP',1),(62,'Ecuador','EC','ECU',1),(63,'Egypt','EG','EGY',1),(64,'El Salvador','SV','SLV',1),(65,'Equatorial Guinea','GQ','GNQ',1),(66,'Eritrea','ER','ERI',1),(67,'Estonia','EE','EST',1),(68,'Ethiopia','ET','ETH',1),(69,'Falkland Islands (Malvinas)','FK','FLK',1),(70,'Faroe Islands','FO','FRO',1),(71,'Fiji','FJ','FJI',1),(72,'Finland','FI','FIN',1),(73,'France','FR','FRA',1),(74,'France, Metropolitan','FX','FXX',1),(75,'French Guiana','GF','GUF',1),(76,'French Polynesia','PF','PYF',1),(77,'French Southern Territories','TF','ATF',1),(78,'Gabon','GA','GAB',1),(79,'Gambia','GM','GMB',1),(80,'Georgia','GE','GEO',1),(81,'Germany','DE','DEU',5),(82,'Ghana','GH','GHA',1),(83,'Gibraltar','GI','GIB',1),(84,'Greece','GR','GRC',1),(85,'Greenland','GL','GRL',1),(86,'Grenada','GD','GRD',1),(87,'Guadeloupe','GP','GLP',1),(88,'Guam','GU','GUM',1),(89,'Guatemala','GT','GTM',1),(90,'Guinea','GN','GIN',1),(91,'Guinea-bissau','GW','GNB',1),(92,'Guyana','GY','GUY',1),(93,'Haiti','HT','HTI',1),(94,'Heard and Mc Donald Islands','HM','HMD',1),(95,'Honduras','HN','HND',1),(96,'Hong Kong','HK','HKG',1),(97,'Hungary','HU','HUN',1),(98,'Iceland','IS','ISL',1),(99,'India','IN','IND',1),(100,'Indonesia','ID','IDN',1),(101,'Iran (Islamic Republic of)','IR','IRN',1),(102,'Iraq','IQ','IRQ',1),(103,'Ireland','IE','IRL',1),(104,'Israel','IL','ISR',1),(105,'Italy','IT','ITA',1),(106,'Jamaica','JM','JAM',1),(107,'Japan','JP','JPN',1),(108,'Jordan','JO','JOR',1),(109,'Kazakhstan','KZ','KAZ',1),(110,'Kenya','KE','KEN',1),(111,'Kiribati','KI','KIR',1),(112,'Korea, Democratic People\'s Republic of','KP','PRK',1),(113,'Korea, Republic of','KR','KOR',1),(114,'Kuwait','KW','KWT',1),(115,'Kyrgyzstan','KG','KGZ',1),(116,'Lao People\'s Democratic Republic','LA','LAO',1),(117,'Latvia','LV','LVA',1),(118,'Lebanon','LB','LBN',1),(119,'Lesotho','LS','LSO',1),(120,'Liberia','LR','LBR',1),(121,'Libyan Arab Jamahiriya','LY','LBY',1),(122,'Liechtenstein','LI','LIE',1),(123,'Lithuania','LT','LTU',1),(124,'Luxembourg','LU','LUX',1),(125,'Macau','MO','MAC',1),(126,'Macedonia, The Former Yugoslav Republic of','MK','MKD',1),(127,'Madagascar','MG','MDG',1),(128,'Malawi','MW','MWI',1),(129,'Malaysia','MY','MYS',1),(130,'Maldives','MV','MDV',1),(131,'Mali','ML','MLI',1),(132,'Malta','MT','MLT',1),(133,'Marshall Islands','MH','MHL',1),(134,'Martinique','MQ','MTQ',1),(135,'Mauritania','MR','MRT',1),(136,'Mauritius','MU','MUS',1),(137,'Mayotte','YT','MYT',1),(138,'Mexico','MX','MEX',1),(139,'Micronesia, Federated States of','FM','FSM',1),(140,'Moldova, Republic of','MD','MDA',1),(141,'Monaco','MC','MCO',1),(142,'Mongolia','MN','MNG',1),(143,'Montserrat','MS','MSR',1),(144,'Morocco','MA','MAR',1),(145,'Mozambique','MZ','MOZ',1),(146,'Myanmar','MM','MMR',1),(147,'Namibia','NA','NAM',1),(148,'Nauru','NR','NRU',1),(149,'Nepal','NP','NPL',1),(150,'Netherlands','NL','NLD',1),(151,'Netherlands Antilles','AN','ANT',1),(152,'New Caledonia','NC','NCL',1),(153,'New Zealand','NZ','NZL',1),(154,'Nicaragua','NI','NIC',1),(155,'Niger','NE','NER',1),(156,'Nigeria','NG','NGA',1),(157,'Niue','NU','NIU',1),(158,'Norfolk Island','NF','NFK',1),(159,'Northern Mariana Islands','MP','MNP',1),(160,'Norway','NO','NOR',1),(161,'Oman','OM','OMN',1),(162,'Pakistan','PK','PAK',1),(163,'Palau','PW','PLW',1),(164,'Panama','PA','PAN',1),(165,'Papua New Guinea','PG','PNG',1),(166,'Paraguay','PY','PRY',1),(167,'Peru','PE','PER',1),(168,'Philippines','PH','PHL',1),(169,'Pitcairn','PN','PCN',1),(170,'Poland','PL','POL',1),(171,'Portugal','PT','PRT',1),(172,'Puerto Rico','PR','PRI',1),(173,'Qatar','QA','QAT',1),(174,'Reunion','RE','REU',1),(175,'Romania','RO','ROM',1),(176,'Russian Federation','RU','RUS',1),(177,'Rwanda','RW','RWA',1),(178,'Saint Kitts and Nevis','KN','KNA',1),(179,'Saint Lucia','LC','LCA',1),(180,'Saint Vincent and the Grenadines','VC','VCT',1),(181,'Samoa','WS','WSM',1),(182,'San Marino','SM','SMR',1),(183,'Sao Tome and Principe','ST','STP',1),(184,'Saudi Arabia','SA','SAU',1),(185,'Senegal','SN','SEN',1),(186,'Seychelles','SC','SYC',1),(187,'Sierra Leone','SL','SLE',1),(188,'Singapore','SG','SGP',4),(189,'Slovakia (Slovak Republic)','SK','SVK',1),(190,'Slovenia','SI','SVN',1),(191,'Solomon Islands','SB','SLB',1),(192,'Somalia','SO','SOM',1),(193,'South Africa','ZA','ZAF',1),(194,'South Georgia and the South Sandwich Islands','GS','SGS',1),(195,'Spain','ES','ESP',3),(196,'Sri Lanka','LK','LKA',1),(197,'St. Helena','SH','SHN',1),(198,'St. Pierre and Miquelon','PM','SPM',1),(199,'Sudan','SD','SDN',1),(200,'Suriname','SR','SUR',1),(201,'Svalbard and Jan Mayen Islands','SJ','SJM',1),(202,'Swaziland','SZ','SWZ',1),(203,'Sweden','SE','SWE',1),(204,'Switzerland','CH','CHE',1),(205,'Syrian Arab Republic','SY','SYR',1),(206,'Taiwan','TW','TWN',1),(207,'Tajikistan','TJ','TJK',1),(208,'Tanzania, United Republic of','TZ','TZA',1),(209,'Thailand','TH','THA',1),(210,'Togo','TG','TGO',1),(211,'Tokelau','TK','TKL',1),(212,'Tonga','TO','TON',1),(213,'Trinidad and Tobago','TT','TTO',1),(214,'Tunisia','TN','TUN',1),(215,'Turkey','TR','TUR',1),(216,'Turkmenistan','TM','TKM',1),(217,'Turks and Caicos Islands','TC','TCA',1),(218,'Tuvalu','TV','TUV',1),(219,'Uganda','UG','UGA',1),(220,'Ukraine','UA','UKR',1),(221,'United Arab Emirates','AE','ARE',1),(222,'United Kingdom','GB','GBR',1),(223,'United States','US','USA',2),(224,'United States Minor Outlying Islands','UM','UMI',1),(225,'Uruguay','UY','URY',1),(226,'Uzbekistan','UZ','UZB',1),(227,'Vanuatu','VU','VUT',1),(228,'Vatican City State (Holy See)','VA','VAT',1),(229,'Venezuela','VE','VEN',1),(230,'Viet Nam','VN','VNM',1),(231,'Virgin Islands (British)','VG','VGB',1),(232,'Virgin Islands (U.S.)','VI','VIR',1),(233,'Wallis and Futuna Islands','WF','WLF',1),(234,'Western Sahara','EH','ESH',1),(235,'Yemen','YE','YEM',1),(236,'Yugoslavia','YU','YUG',1),(237,'Zaire','ZR','ZAR',1),(238,'Zambia','ZM','ZMB',1),(239,'Zimbabwe','ZW','ZWE',1);
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupon_email_track`
--

DROP TABLE IF EXISTS `coupon_email_track`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupon_email_track` (
  `unique_id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_id` int(11) NOT NULL DEFAULT '0',
  `customer_id_sent` int(11) NOT NULL DEFAULT '0',
  `sent_firstname` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sent_lastname` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emailed_to` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_sent` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`unique_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupon_email_track`
--

LOCK TABLES `coupon_email_track` WRITE;
/*!40000 ALTER TABLE `coupon_email_track` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupon_email_track` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupon_gv_customer`
--

DROP TABLE IF EXISTS `coupon_gv_customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupon_gv_customer` (
  `customer_id` int(5) NOT NULL DEFAULT '0',
  `amount` decimal(8,2) unsigned NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`customer_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupon_gv_customer`
--

LOCK TABLES `coupon_gv_customer` WRITE;
/*!40000 ALTER TABLE `coupon_gv_customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupon_gv_customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupon_gv_queue`
--

DROP TABLE IF EXISTS `coupon_gv_queue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupon_gv_queue` (
  `unique_id` int(5) NOT NULL AUTO_INCREMENT,
  `customer_id` int(5) NOT NULL DEFAULT '0',
  `order_id` int(5) NOT NULL DEFAULT '0',
  `amount` decimal(8,2) unsigned NOT NULL DEFAULT '0.00',
  `date_created` date NOT NULL DEFAULT '0000-00-00',
  `ipaddr` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `release_flag` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`unique_id`),
  KEY `uid` (`unique_id`,`customer_id`,`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupon_gv_queue`
--

LOCK TABLES `coupon_gv_queue` WRITE;
/*!40000 ALTER TABLE `coupon_gv_queue` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupon_gv_queue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupon_redeem_track`
--

DROP TABLE IF EXISTS `coupon_redeem_track`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupon_redeem_track` (
  `unique_id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_id` int(11) NOT NULL DEFAULT '0',
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `redeem_date` date NOT NULL DEFAULT '0000-00-00',
  `redeem_ip` binary(20) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`unique_id`,`coupon_id`,`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupon_redeem_track`
--

LOCK TABLES `coupon_redeem_track` WRITE;
/*!40000 ALTER TABLE `coupon_redeem_track` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupon_redeem_track` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupons` (
  `coupon_id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_type` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'F',
  `coupon_code` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `coupon_amount` decimal(8,2) unsigned NOT NULL DEFAULT '0.00',
  `coupon_minimum_order` decimal(8,2) unsigned NOT NULL DEFAULT '0.00',
  `coupon_start_date` date DEFAULT '0000-00-00',
  `coupon_expire_date` date DEFAULT '0000-00-00',
  `uses_per_coupon` int(5) NOT NULL DEFAULT '1',
  `uses_per_user` int(5) NOT NULL DEFAULT '0',
  `restrict_to_products` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `restrict_to_categories` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `restrict_to_customers` text COLLATE utf8_unicode_ci,
  `coupon_active` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  `coupon_status` int(1) NOT NULL DEFAULT '1',
  `date_created` date NOT NULL DEFAULT '0000-00-00',
  `date_modified` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`coupon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons_description`
--

DROP TABLE IF EXISTS `coupons_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupons_description` (
  `coupon_id` int(11) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '0',
  `coupon_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `coupon_description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`language_id`,`coupon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons_description`
--

LOCK TABLES `coupons_description` WRITE;
/*!40000 ALTER TABLE `coupons_description` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupons_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currencies` (
  `currencies_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `code` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `symbol_left` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `symbol_right` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `decimal_point` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thousands_point` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `decimal_places` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` float(13,8) DEFAULT NULL,
  `last_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`currencies_id`),
  KEY `idx_currencies_code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES (1,'U.S. Dollar','USD','$','','.',',','2',1.00000000,'2015-12-19 14:54:44'),(2,'Euro','EUR','','','.',',','2',1.00000000,'2015-12-19 14:54:44'),(3,'Česká Koruna','CZK','',' Kč',',','.','2',1.00000000,'2015-12-19 14:54:44');
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `customers_id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_gender` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customers_firstname` text COLLATE utf8_unicode_ci,
  `customers_lastname` text COLLATE utf8_unicode_ci,
  `customers_dob` text COLLATE utf8_unicode_ci,
  `customers_email_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customers_default_address_id` int(11) DEFAULT NULL,
  `customers_telephone` text COLLATE utf8_unicode_ci,
  `customers_fax` text COLLATE utf8_unicode_ci,
  `customers_password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `customers_newsletter` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customers_guest` int(1) NOT NULL DEFAULT '0',
  `mmstatus` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`customers_id`),
  KEY `idx_customers_email_address` (`customers_email_address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers_basket`
--

DROP TABLE IF EXISTS `customers_basket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers_basket` (
  `customers_basket_id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `products_id` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `customers_basket_quantity` int(2) NOT NULL,
  `final_price` decimal(15,4) DEFAULT NULL,
  `customers_basket_date_added` char(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`customers_basket_id`),
  KEY `idx_customers_basket_customers_id` (`customers_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers_basket`
--

LOCK TABLES `customers_basket` WRITE;
/*!40000 ALTER TABLE `customers_basket` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers_basket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers_basket_attributes`
--

DROP TABLE IF EXISTS `customers_basket_attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers_basket_attributes` (
  `customers_basket_attributes_id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `products_id` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `products_options_id` int(11) NOT NULL,
  `products_options_value_id` int(11) NOT NULL,
  PRIMARY KEY (`customers_basket_attributes_id`),
  KEY `idx_customers_basket_att_customers_id` (`customers_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers_basket_attributes`
--

LOCK TABLES `customers_basket_attributes` WRITE;
/*!40000 ALTER TABLE `customers_basket_attributes` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers_basket_attributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers_info`
--

DROP TABLE IF EXISTS `customers_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers_info` (
  `customers_info_id` int(11) NOT NULL,
  `customers_info_date_of_last_logon` datetime DEFAULT NULL,
  `customers_info_number_of_logons` int(5) DEFAULT NULL,
  `customers_info_date_account_created` datetime DEFAULT NULL,
  `customers_info_date_account_last_modified` datetime DEFAULT NULL,
  `global_product_notifications` int(1) DEFAULT '0',
  `password_reset_key` char(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_reset_date` datetime DEFAULT NULL,
  PRIMARY KEY (`customers_info_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers_info`
--

LOCK TABLES `customers_info` WRITE;
/*!40000 ALTER TABLE `customers_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `geo_zones`
--

DROP TABLE IF EXISTS `geo_zones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `geo_zones` (
  `geo_zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `geo_zone_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `geo_zone_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_modified` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`geo_zone_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `geo_zones`
--

LOCK TABLES `geo_zones` WRITE;
/*!40000 ALTER TABLE `geo_zones` DISABLE KEYS */;
INSERT INTO `geo_zones` VALUES (1,'EU','','2015-12-19 14:54:46','2015-12-19 14:54:46'),(2,'ČR','Česká republika',NULL,'2017-12-10 03:46:29');
/*!40000 ALTER TABLE `geo_zones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `headertags`
--

DROP TABLE IF EXISTS `headertags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `headertags` (
  `page_name` varchar(64) NOT NULL DEFAULT '',
  `page_title` varchar(120) NOT NULL DEFAULT '',
  `page_description` varchar(255) NOT NULL DEFAULT '',
  `page_keywords` varchar(255) NOT NULL DEFAULT '',
  `page_logo` varchar(255) NOT NULL DEFAULT '',
  `page_logo_1` varchar(255) NOT NULL DEFAULT '',
  `page_logo_2` varchar(255) NOT NULL DEFAULT '',
  `page_logo_3` varchar(255) NOT NULL DEFAULT '',
  `page_logo_4` varchar(255) NOT NULL DEFAULT '',
  `append_default_title` tinyint(1) NOT NULL DEFAULT '0',
  `append_default_description` tinyint(1) NOT NULL DEFAULT '0',
  `append_default_keywords` tinyint(1) NOT NULL DEFAULT '0',
  `append_default_logo` tinyint(1) NOT NULL DEFAULT '0',
  `append_category` tinyint(1) NOT NULL DEFAULT '0',
  `append_manufacturer` tinyint(1) NOT NULL DEFAULT '0',
  `append_model` tinyint(1) NOT NULL DEFAULT '0',
  `append_product` tinyint(1) NOT NULL DEFAULT '1',
  `append_root` tinyint(1) NOT NULL DEFAULT '1',
  `sortorder_title` tinyint(2) NOT NULL DEFAULT '0',
  `sortorder_description` tinyint(2) NOT NULL DEFAULT '0',
  `sortorder_keywords` tinyint(2) NOT NULL DEFAULT '0',
  `sortorder_logo` tinyint(2) NOT NULL DEFAULT '0',
  `sortorder_logo_1` tinyint(2) NOT NULL DEFAULT '0',
  `sortorder_logo_2` tinyint(2) NOT NULL DEFAULT '0',
  `sortorder_logo_3` tinyint(2) NOT NULL DEFAULT '0',
  `sortorder_logo_4` tinyint(2) NOT NULL DEFAULT '0',
  `sortorder_category` tinyint(2) NOT NULL DEFAULT '0',
  `sortorder_manufacturer` tinyint(2) NOT NULL DEFAULT '0',
  `sortorder_model` tinyint(2) NOT NULL DEFAULT '0',
  `sortorder_product` tinyint(2) NOT NULL DEFAULT '10',
  `sortorder_root` tinyint(2) NOT NULL DEFAULT '1',
  `sortorder_root_1` tinyint(2) NOT NULL DEFAULT '1',
  `sortorder_root_2` tinyint(2) NOT NULL DEFAULT '1',
  `sortorder_root_3` tinyint(2) NOT NULL DEFAULT '1',
  `sortorder_root_4` tinyint(2) NOT NULL DEFAULT '1',
  `language_id` int(11) NOT NULL DEFAULT '1',
  KEY `idx_page_name` (`page_name`),
  KEY `idx_page_description` (`page_description`),
  KEY `idx_page_keywords` (`page_keywords`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `headertags`
--

LOCK TABLES `headertags` WRITE;
/*!40000 ALTER TABLE `headertags` DISABLE KEYS */;
INSERT INTO `headertags` VALUES ('index.php','Replace me in Page Control under index.php - oscommerce-solution.com','Replace me in Page Control under index.php - oscommerce-solution.com','Replace me in Page Control under index.php - oscommerce-solution.com','Replace me in Page Control under index.php - oscommerce-solution.com','','','','',0,0,0,0,1,0,0,1,0,0,0,0,0,0,0,0,0,2,0,0,10,0,1,1,1,1,4),('product_info.php','','','','','','','','',0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,10,1,1,1,1,1,4),('product_reviews.php','','','','','','','','',0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,10,1,1,1,1,1,4),('product_reviews_info.php','','','','','','','','',0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,10,1,1,1,1,1,4),('product_reviews_write.php','','','','','','','','',0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,10,1,1,1,1,1,4),('specials.php','specials','specials','specials','Specials','','','','',0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,10,1,1,1,1,1,4),('index.php','Replace me in Page Control under index.php - oscommerce-solution.com','Replace me in Page Control under index.php - oscommerce-solution.com','Replace me in Page Control under index.php - oscommerce-solution.com','Replace me in Page Control under index.php - oscommerce-solution.com','','','','',0,0,0,0,1,0,0,1,0,0,0,0,0,0,0,0,0,2,0,0,10,0,1,1,1,1,1),('product_info.php','','','','','','','','',0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,10,1,1,1,1,1,1),('product_reviews.php','','','','','','','','',0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,10,1,1,1,1,1,1),('product_reviews_info.php','','','','','','','','',0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,10,1,1,1,1,1,1),('product_reviews_write.php','','','','','','','','',0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,10,1,1,1,1,1,1),('specials.php','specials','specials','specials','Specials','','','','',0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,10,1,1,1,1,1,1),('index.php','Replace me in Page Control under index.php - oscommerce-solution.com','Replace me in Page Control under index.php - oscommerce-solution.com','Replace me in Page Control under index.php - oscommerce-solution.com','Replace me in Page Control under index.php - oscommerce-solution.com','','','','',0,0,0,0,1,0,0,1,0,0,0,0,0,0,0,0,0,2,0,0,10,0,1,1,1,1,2),('product_info.php','','','','','','','','',0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,10,1,1,1,1,1,2),('product_reviews.php','','','','','','','','',0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,10,1,1,1,1,1,2),('product_reviews_info.php','','','','','','','','',0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,10,1,1,1,1,1,2),('product_reviews_write.php','','','','','','','','',0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,10,1,1,1,1,1,2),('specials.php','specials','specials','specials','Specials','','','','',0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,10,1,1,1,1,1,2),('index.php','Replace me in Page Control under index.php - oscommerce-solution.com','Replace me in Page Control under index.php - oscommerce-solution.com','Replace me in Page Control under index.php - oscommerce-solution.com','Replace me in Page Control under index.php - oscommerce-solution.com','','','','',0,0,0,0,1,0,0,1,0,0,0,0,0,0,0,0,0,2,0,0,10,0,1,1,1,1,3),('product_info.php','','','','','','','','',0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,10,1,1,1,1,1,3),('product_reviews.php','','','','','','','','',0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,10,1,1,1,1,1,3),('product_reviews_info.php','','','','','','','','',0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,10,1,1,1,1,1,3),('product_reviews_write.php','','','','','','','','',0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,10,1,1,1,1,1,3),('specials.php','specials','specials','specials','Specials','','','','',0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,10,1,1,1,1,1,3);
/*!40000 ALTER TABLE `headertags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `headertags_cache`
--

DROP TABLE IF EXISTS `headertags_cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `headertags_cache` (
  `title` text,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `headertags_cache`
--

LOCK TABLES `headertags_cache` WRITE;
/*!40000 ALTER TABLE `headertags_cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `headertags_cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `headertags_default`
--

DROP TABLE IF EXISTS `headertags_default`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `headertags_default` (
  `default_title` varchar(64) NOT NULL DEFAULT '',
  `default_description` varchar(120) NOT NULL DEFAULT '',
  `default_keywords` varchar(255) NOT NULL DEFAULT '',
  `default_logo_text` varchar(255) NOT NULL DEFAULT '',
  `home_page_text` text NOT NULL,
  `default_logo_append_group` tinyint(1) NOT NULL DEFAULT '1',
  `default_logo_append_category` tinyint(1) NOT NULL DEFAULT '1',
  `default_logo_append_manufacturer` tinyint(1) NOT NULL DEFAULT '1',
  `default_logo_append_product` tinyint(1) NOT NULL DEFAULT '1',
  `meta_google` tinyint(1) NOT NULL DEFAULT '0',
  `meta_language` tinyint(1) NOT NULL DEFAULT '0',
  `meta_noodp` tinyint(1) NOT NULL DEFAULT '1',
  `meta_noydir` tinyint(1) NOT NULL DEFAULT '1',
  `meta_replyto` tinyint(1) NOT NULL DEFAULT '0',
  `meta_revisit` tinyint(1) NOT NULL DEFAULT '0',
  `meta_robots` tinyint(1) NOT NULL DEFAULT '0',
  `meta_unspam` tinyint(1) NOT NULL DEFAULT '0',
  `meta_canonical` tinyint(1) NOT NULL DEFAULT '1',
  `meta_og` tinyint(1) NOT NULL DEFAULT '1',
  `language_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`default_title`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `headertags_default`
--

LOCK TABLES `headertags_default` WRITE;
/*!40000 ALTER TABLE `headertags_default` DISABLE KEYS */;
INSERT INTO `headertags_default` VALUES ('Default title','Default description','Default Keywords','Default Logo Text','',0,0,0,0,0,0,1,1,0,0,0,0,1,1,1),('Default title','Default description','Default Keywords','Default Logo Text','',0,0,0,0,0,0,1,1,0,0,0,0,1,1,2),('Default title','Default description','Default Keywords','Default Logo Text','',0,0,0,0,0,0,1,1,0,0,0,0,1,1,3),('Default title','Default description','Default Keywords','Default Logo Text','',0,0,0,0,0,0,1,1,0,0,0,0,1,1,4);
/*!40000 ALTER TABLE `headertags_default` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `headertags_keywords`
--

DROP TABLE IF EXISTS `headertags_keywords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `headertags_keywords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(120) NOT NULL DEFAULT '',
  `counter` int(11) NOT NULL DEFAULT '1',
  `last_search` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `google_last_position` tinyint(4) NOT NULL,
  `google_date_position_check` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `found` tinyint(1) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `keyword` (`keyword`),
  KEY `found` (`found`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `headertags_keywords`
--

LOCK TABLES `headertags_keywords` WRITE;
/*!40000 ALTER TABLE `headertags_keywords` DISABLE KEYS */;
/*!40000 ALTER TABLE `headertags_keywords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `headertags_search`
--

DROP TABLE IF EXISTS `headertags_search`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `headertags_search` (
  `product_id` int(11) NOT NULL,
  `keyword` varchar(64) NOT NULL,
  `language_id` int(11) NOT NULL,
  KEY `keyword` (`keyword`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `headertags_search`
--

LOCK TABLES `headertags_search` WRITE;
/*!40000 ALTER TABLE `headertags_search` DISABLE KEYS */;
/*!40000 ALTER TABLE `headertags_search` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `headertags_silo`
--

DROP TABLE IF EXISTS `headertags_silo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `headertags_silo` (
  `category_id` int(11) NOT NULL DEFAULT '0',
  `box_heading` varchar(60) NOT NULL,
  `is_disabled` tinyint(1) NOT NULL DEFAULT '0',
  `max_links` int(11) NOT NULL DEFAULT '6',
  `sorton` tinyint(2) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`category_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `headertags_silo`
--

LOCK TABLES `headertags_silo` WRITE;
/*!40000 ALTER TABLE `headertags_silo` DISABLE KEYS */;
/*!40000 ALTER TABLE `headertags_silo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `headertags_social`
--

DROP TABLE IF EXISTS `headertags_social`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `headertags_social` (
  `unique_id` int(4) NOT NULL AUTO_INCREMENT,
  `section` varchar(48) NOT NULL,
  `groupname` varchar(24) NOT NULL,
  `url` varchar(255) NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`unique_id`),
  KEY `idx_section` (`section`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `headertags_social`
--

LOCK TABLES `headertags_social` WRITE;
/*!40000 ALTER TABLE `headertags_social` DISABLE KEYS */;
INSERT INTO `headertags_social` VALUES (1,'socialicons','digg','http://digg.com/submit?phase=2&url=URL&TITLE','16x16'),(2,'socialicons','facebook','http://www.facebook.com/share.php?u=URL&TITLE','16x16'),(3,'socialicons','google','http://www.google.com/bookmarks/mark?op=edit&bkmk=URL&TITLE','16x16'),(4,'socialicons','pintrest','http://pinterest.com/pin/create/button/?url=URL&TITLE','16x16'),(5,'socialicons','reddit','http://reddit.com/submit?url=URL&TITLE','16x16'),(6,'socialicons','google+','https://plus.google.com/share?url=URL&TITLE','16x16'),(7,'socialicons','linkedin','http://www.linkedin.com/shareArticle?mini=true&url=&title=TITLE=&source=URL','16x16'),(8,'socialicons','newsvine','http://www.newsvine.com/_tools/seed&amp;save?u=URL&h=TITLE','16x16'),(9,'socialicons','stumbleupon','http://www.stumbleupon.com/submit?url=URL&TITLE','16x16'),(10,'socialicons','twitter','http://twitter.com/home?status=URL&TITLE','16x16');
/*!40000 ALTER TABLE `headertags_social` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `information`
--

DROP TABLE IF EXISTS `information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `information` (
  `information_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `cached` int(1) DEFAULT '0',
  `cached_admin` int(1) DEFAULT '0',
  `information_group_id` int(11) unsigned NOT NULL DEFAULT '0',
  `information_title` varchar(255) NOT NULL DEFAULT '',
  `information_description` text NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `sort_order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `visible` enum('1','0') NOT NULL DEFAULT '1',
  `language_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`information_id`,`language_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `information`
--

LOCK TABLES `information` WRITE;
/*!40000 ALTER TABLE `information` DISABLE KEYS */;
INSERT INTO `information` VALUES (1,0,0,2,'TEXT_GREETING_PERSONAL','Welcome back <span class=\"greetUser\">%s!</span> Would you like to see which <a href=\"%s\"><u>new products</u></a> are available to purchase?',0,1,'1',1),(1,0,0,2,'TEXT_GREETING_PERSONAL','Welcome back <span class=\"greetUser\">%s!</span> Would you like to see which <a href=\"%s\"><u>new products</u></a> are available to purchase?',0,1,'1',4),(2,0,0,2,'TEXT_GREETING_PERSONAL_RELOGON','<small>If you are not %s, please <a href=\"%s\"><u>log yourself in</u></a> with your account information.</small>',0,2,'1',1),(2,0,0,2,'TEXT_GREETING_PERSONAL_RELOGON','<small>If you are not %s, please <a href=\"%s\"><u>log yourself in</u></a> with your account information.</small>',0,2,'1',4),(3,0,0,2,'TEXT_GREETING_GUEST','Welcome <span class=\"greetUser\">Guest!</span> Would you like to <a href=\"%s\"><u>log yourself in</u></a>? Or would you prefer to <a href=\"%s\"><u>create an account</u></a>?',0,3,'1',1),(3,0,0,2,'TEXT_GREETING_GUEST','Welcome <span class=\"greetUser\">Guest!</span> Would you like to <a href=\"%s\"><u>log yourself in</u></a>? Or would you prefer to <a href=\"%s\"><u>create an account</u></a>?',0,3,'1',4),(4,0,0,2,'TEXT_MAIN','<p>This is a default text. Please go to visit Admin -&gt; InfoManager -&gt; MainPage textsThis is a default text.</p>',0,4,'1',1),(4,0,0,2,'TEXT_MAIN','<p>Text pro HomePage. UPRAVIT: Admin -&gt; InfoManager -&gt; Texty HomePage</p>',0,4,'1',4),(5,0,0,3,'HEADING_TITLE','Store title',0,1,'1',1),(5,0,0,3,'HEADING_TITLE','Store title',0,1,'1',2),(5,0,0,3,'HEADING_TITLE','Store title',0,1,'1',3),(5,0,0,3,'HEADING_TITLE','Titulek H1 obchodu',0,1,'1',4),(6,0,0,3,'META_SEO_TITLE','',0,2,'1',1),(6,0,0,3,'META_SEO_TITLE','',0,2,'1',2),(6,0,0,3,'META_SEO_TITLE','',0,2,'1',3),(6,0,0,3,'META_SEO_TITLE','',0,2,'1',4),(7,0,0,3,'META_SEO_DESCRIPTION','',0,3,'1',1),(7,0,0,3,'META_SEO_DESCRIPTION','',0,3,'1',2),(7,0,0,3,'META_SEO_DESCRIPTION','',0,3,'1',3),(7,0,0,3,'META_SEO_DESCRIPTION','',0,3,'1',4),(8,0,0,3,'META_SEO_KEYWORDS','',0,4,'1',1),(8,0,0,3,'META_SEO_KEYWORDS','',0,4,'1',2),(8,0,0,3,'META_SEO_KEYWORDS','',0,4,'1',3),(8,0,0,3,'META_SEO_KEYWORDS','',0,4,'1',4),(9,0,0,4,'HEADER_GENERIC1','<i class=\"fa fa-question\"></i><span class=\"hidden-sm\"> Generic1</span>',0,1,'1',1),(9,0,0,4,'HEADER_GENERIC1','<i class=\"fa fa-question\"></i><span class=\"hidden-sm\"> Generic1</span>',0,1,'1',4),(10,0,0,4,'HEADER_GENERIC2','<i class=\"fa fa-question\"></i><span class=\"hidden-sm\"> Generic2</span>',0,2,'1',1),(10,0,0,4,'HEADER_GENERIC2','<i class=\"fa fa-question\"></i><span class=\"hidden-sm\"> Generic2</span>',0,2,'1',4),(11,0,0,4,'HEADER_GENERIC3','<i class=\"fa fa-question\"></i><span class=\"hidden-sm\"> Generic3</span>',0,3,'1',1),(11,0,0,4,'HEADER_GENERIC3','<i class=\"fa fa-question\"></i><span class=\"hidden-sm\"> Generic3</span>',0,3,'1',4),(12,0,0,4,'HEADER_GENERIC4','<i class=\"fa fa-question\"></i><span class=\"hidden-sm\"> Generic4</span>',0,4,'1',1),(12,0,0,4,'HEADER_GENERIC4','<i class=\"fa fa-question\"></i><span class=\"hidden-sm\"> Generic4</span>',0,4,'1',4),(13,0,0,4,'HEADER_GENERIC5','<i class=\"fa fa-question\"></i><span class=\"hidden-sm\"> Generic5</span>',0,5,'1',1),(13,0,0,4,'HEADER_GENERIC5','<i class=\"fa fa-question\"></i><span class=\"hidden-sm\"> Generic5</span>',0,5,'1',4),(14,0,0,5,'MODULE_CONTENT_FOOTER_TEXT_TEXT','This is a default footer text. Please go to visit the admin and change it (Info manager -> Welcome message).',0,1,'1',1),(14,0,0,5,'MODULE_CONTENT_FOOTER_TEXT_TEXT','This is a default footer text. Please go to visit the admin and change it (Info manager -> Welcome message).',0,1,'1',4),(15,0,0,4,'MODULE_SHIPPING_ZONES_TEXT_TITLE','Shipping',0,6,'1',1),(15,0,0,4,'MODULE_SHIPPING_ZONES_TEXT_TITLE','Poštovné',0,6,'1',4),(16,0,0,4,'MODULE_PAYMENT_MONEYORDER_TEXT_TITLE','Moneyorder',0,7,'1',1),(16,0,0,4,'MODULE_PAYMENT_MONEYORDER_TEXT_TITLE','Platba převodem',0,7,'1',4),(17,0,0,4,'MODULE_PAYMENT_COD_TEXT_TITLE','Cash on Deliver',0,8,'1',1),(17,0,0,4,'MODULE_PAYMENT_COD_TEXT_TITLE','Platba na dobírku',0,8,'1',4),(19,0,0,4,'HEADER_SITE_CATEGORIES','<i class=\"fa fa-navicon\"></i><span class=\"hidden-sm\">Catalog</span>',0,9,'1',1),(19,0,0,4,'HEADER_SITE_CATEGORIES','<i class=\"fa fa-navicon\"></i><span class=\"hidden-sm\"> Katalog</span>',0,9,'1',4),(20,0,0,4,'HEADER_SITE_SETTINGS','<i class=\"fa fa-cog\"></i><span class=\"hidden-sm\"> International</span> <span class=\"caret\"></span>',0,10,'1',1),(20,0,0,4,'HEADER_SITE_SETTINGS','<i class=\"fa fa-cog\"></i><span class=\"hidden-sm\"> International</span> <span class=\"caret\"></span>',0,10,'1',4),(21,0,0,4,'HEADER_CART_CONTENTS','<i class=\"fa fa-shopping-cart\"></i> %s kusů <span class=\"caret\"></span><i class=\"fa fa-shopping-cart\"></i> %s <span class=\"hidden-lg hidden-md hidden-sm\">items</span> <span class=\"caret\"></span>',0,11,'1',1),(21,0,0,4,'HEADER_CART_CONTENTS','<i class=\"fa fa-shopping-cart\"></i> %s kusů <span class=\"caret\"></span><i class=\"fa fa-shopping-cart\"></i> %s <span class=\"hidden-lg hidden-md hidden-sm\">kusů</span> <span class=\"caret\"></span>',0,11,'1',4),(22,0,0,4,'HEADER_CONTACT_US','<i class=\"fa fa-envelope\"></i><span class=\"hidden-lg hidden-md hidden-sm\"> Contact Us</span>',0,12,'1',1),(22,0,0,4,'HEADER_CONTACT_US','<i class=\"fa fa-envelope\"></i><span class=\"hidden-lg hidden-md hidden-sm\"> Napište nám</span>',0,12,'1',4),(23,0,0,4,'HEADER_CART_CHECKOUT','<i class=\"fa fa-angle-right\"></i> <span class=\"hidden-sm\">Checkout</span>',0,13,'1',1),(23,0,0,4,'HEADER_CART_CHECKOUT','<i class=\"fa fa-angle-right\"></i> <span class=\"hidden-sm\">Pokladna</span>',0,13,'1',4);
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
  `format` varchar(10) NOT NULL DEFAULT 'html',
  PRIMARY KEY (`information_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `information_group`
--

LOCK TABLES `information_group` WRITE;
/*!40000 ALTER TABLE `information_group` DISABLE KEYS */;
INSERT INTO `information_group` VALUES (1,'Information pages','Information pages',1,1,'','html'),(2,'MainPage texts','MainPage text, Customer greatings',2,1,'information_title, sort_order, parent_id','html'),(3,'MainPage titles','MainPage H1,title, description, keywords',3,1,'information_title, sort_order, parent_id','plaintext'),(4,'Plaintext constants','Plaintext constants',4,1,'','plaintext'),(5,'HTML constants','HTML constants',5,1,'','html');
/*!40000 ALTER TABLE `information_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keys_customer`
--

DROP TABLE IF EXISTS `keys_customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `keys_customer` (
  `customers_id` int(11) NOT NULL,
  `keys_customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `public_key_customer` text COLLATE utf8_unicode_ci,
  `private_key_customer` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`keys_customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keys_customer`
--

LOCK TABLES `keys_customer` WRITE;
/*!40000 ALTER TABLE `keys_customer` DISABLE KEYS */;
INSERT INTO `keys_customer` VALUES (1,1,'-----BEGIN PUBLIC KEY-----\nMIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEA53Azipq4NzM3Vus3fRbG\nXAqdz52ATZ3Z1TMIYS8u9dnIiJN1uD5o8+eaz6FzLGQMF+fQ/AS3VlRPs+euw3uu\nHhpFLiyY+AOxYFmdmCwyKU2LZclFlZo/R1enaeX0tNvUbUON+E8qhIUNeD7Tyuz9\n3OlSp+8nhm8AwjimQ+xozgwGX1+QQ5gOLprzLIiwg4XHwtqKMW1sen1th+TvFHRz\nx0i2sEV9g14YmWWNgpc9JMGTQ+zht6ZeEo+DausxBloGGb/0bJ3Oxim1fDhsY0oa\nfWxOGNsY+EVJ7sjXGxEeQvBunV5z3IWzcdQ0XbiplHkY4GefXJWyzsCOtejjTIAN\nK1zhDCMzrLYwQXsMxjdhYYqOavK1rQFWtQSKI7QF125ZantGedJPmqPjLAoe7yvG\n8jivCV05cVIT0jt4e+yzmVQo+P7uOndXrqeMPnEm8ru3pa1X62Qf+ZgdpGVTwkJK\nQFH64E/dpgJOT/lTZ6DAUd6Z1M8Im/pf2k4if9Vl//K7mc2jUU4mz3Yko+TJ2wLx\nbnWeZk+ZMebUJVnQMkFfAl7iKeATGEkV7Bv+LclWjh6woW4Wt4EWlthVAxfRLSrc\n+eLxcXLj1u6ymL1jRtTqWgMLhtOusWAC1S1p9Ar15yls2fkAmxYFrkUsG2GjQEHH\nwqzAphA6VM4Zv622rmCMS80CAwEAAQ==\n-----END PUBLIC KEY-----\n','-----BEGIN ENCRYPTED PRIVATE KEY-----\nMIIJjjBABgkqhkiG9w0BBQ0wMzAbBgkqhkiG9w0BBQwwDgQIg7NmuTMepyYCAggA\nMBQGCCqGSIb3DQMHBAjsanpcilhnMgSCCUgbRbz+o/anKBPVRDED4f2VDPicE11U\nmfsaRBpAt4KsYK7gkJY010pIIzgMrh2ySf59s4G5TfSfQ+UI8Rks5AlZ3RdF6U5y\nPZYCYeYhPB9CJDAfdvlane3LuQHhFBTiL6+X101nwBj/IQRops/IpAhh9uPomwp+\nl0TVELGXVqKLp/qw7sJbx1mjq1mKoqpUMTYDtLO/uA+yYW1fng8TaJyU46XbYoUk\n9A0Xf1FZJcZxgt1CZtRwX+rdmj+P8+8xOZuogKsoaArvxZ1P7cRnev+ExAIlcPR3\nryv/h8C1zwOfqfWpML6sBIkt46AymTGYXA7ZrWhmOjm3u2x78UVqmSNtgocA8wrA\n2AZzZNRlYV1ic7hlqrTtS89QvNAWZ61QChxFULPpo4VtcA13K75n5zwbg96szgnd\nSi3nHb37Dh4lnBWo6RBlCdyd35Wgslg1r2uzv8OJ+Lqdet4TGRe46Vbkez03ilbb\nZoOAC8e2uxzTPCkgide5aZqwFwzj4KnbbRVW97NhsQZG8QTvlW71pLmNF/Z0Kem1\nlwxMdwUEjqmdWa+Fx68pAcuztPdbTP5F3RwNDkmWbnqy9WJz1fhaEs5foGc9V7Hj\nB7GW6eXDf85ZAsjG+xln6mwXkQX+uh+lA/wumLRDtqJTF6FW3wxZ3AH5k0mmJVP9\nEA+bX4EStQml7zFRaoc1yYuuLYOy2Ey89mg7rzJetv00fvYKbnACrygACOb7i59c\nv1qkuR77Vbz/v7jsivzEglopue0x6BDneTSAB1XSJAwQjk2ujvXS4XO9cf3p0uvQ\nZ5+wKO4+TH3jYzQDYJHMBCjYl8QIY0vUNQOejrc+WyI7ZsRlpP1HxYvKQShekYPP\nd7vZfQs5CQ3GWw5iBy7VOjrujWYkrOl7nelk2tY4qqWi3etm9ueRa6R+0z4LDNF/\nsQL3/ia0LxZYuE5g6J17N6M0vcyC7+yzOz3UNDC/+xqX2W5KROtV88Kp5a4Qa0XG\n1hup5TWA2udcEGAClbgcPDfLzoaASYSaajb6dTN2ZLZ7lC+mXfSXhjNRPonDzyay\n1PswN8FTqcF8D2QQ6int0m/UqLRtk1y65VEiz9+miomO1csixKJkD1dbuoXfP1/m\nQ2MEerlkaePcwpHW0dLWxzT1XuGG1AEAKtPPlxcvVCgXKMofKPg1QlLaRzFcElJ7\nrUbUcoff4bS1EsdPQdkc4EUutLZNBzO7JCToBVH/nIgoTJp5seYEstQEoZe2EbUA\nmMCnTrtknRh0aeFt6ZDpXgiWxpXmLJtksuO9KXvksZJTht4dZkOcUQzEU8qp1KDL\nnWOjxQ3abfxuCfk3zKnBVMQKraIniBYF6oqRb95VT4RyBWsz8AQ21MQtZ6xfdqbQ\nUZKKqdA+ql1bE32aEdHDY0lS9ffSSzh1QUgZqrm08rPPSKNwbhESWh4Ax0c7ule2\nH3NkowmXjdszDhYAuZchfb9swHLphOb+Fzf9fCbYEozlEljQH0Xvbl5UJKv+SRqG\nEWpP40niWZ8VZwZuM10ENvLbh4IAmPTmKMwwV28TJ9TPB+UHZcgKVmubL1ISppeE\ntPzs98zFSszHHr46vVG3AN6YTFnvf1L/pZ47JbMPrU9LIrsDNTdH7mdU1oqjkbCA\nvS9xPpTvos4RVLEvTc+AdtE+1Fi9VabDUuj9J0TzfbJIq4HgAc+GEl9AWDoAy8r2\n7bfmZHkCQVu1+JgEU7tAbwkaqNujT2lcqtuGEy/BYn/KtiuEqsfEF9IJD8hjo/pp\ncdHB71sf4B4kZQAefxkppbcONpYIkJFrWGt0F5crohGbAY+1pKIUb++nJBOfb45O\n3zmPDa3XNaZf5Y+Yr1CkDZpOsoprT5+/R70Oi0NFXuSPyykFVBh3RceEU0Gj2eDX\nbmEn1oQtUwx7m2xyjmnGia3H7XFVM8mOyxM83VbPlxrv3+3aIJB88Al7cL1RbeJ8\nqmw2SCP7FJ6CYc2K0PkYJ5LTnuHMHSFv6fnjLdOgE+HSwm1XyhUeQbC1qgWhIqkP\n8qudoZHrOmcUR2Ky6Lx363P3GXRvnzGSicu2zddqy79AN2IwQykt4wHbZQG5yWYX\n9BSnpTjL0nF5i6sSa5qhN1744o3swjfFzVMZ/g8r+/5LbylOm91+F//wmS9/wtMz\nD4wL1NNXG7SLT5c/ZY436axLEFqgorkJ6+WBY1lImUQ2vbrTfZWuAqvd/cB+o/cc\nbfCCs8ZiQaXoKH7RG9NbXY9bit6WztPaLu5TA76+/7d2SZ//MSFd3FQGGdYDyQBm\n6OGsdzQAZryBhTSqDEMVmHARAuPCZRZ/lTeE620Hq2LF3n9agv/caX1OnZNpS6qk\nmr06Fkfb6dtjh7+RhLsNRCFRFUiKmFKLXbK1jJDwqVczZwu2y/zb6PPHpk0qYmL1\niFqHedhCdmY7k2iy6XWxNxkIsxSJfYSiquyCu5DZMXQXCEv225UmPf4ojmKnsllQ\n/JRB/GQvSifQNhAGVztt0E+Sc1oiFL9yF/BnVOqzqR3Uk7U4l01c6mjn8uyA5XDR\n4apvE38VIxiHWB1uw1DUD9l3MK2sxEZWTFY5Kr1jAfbq+rwWztutxCRIwA8A0Pk9\n3HxwYb9jDkuv1KAb3ozSJShKnXsMKmGpt5Os6jSp0J439fB9PA4tcMTGpylRkWPW\nAuewITjDRy9bUpMExOMd+Shqrpmv/Dc7fyXX4Ql9+5wzBSyq4X4rn6x9Nr1i2VNR\nBUiDSIz8SG4rxXL+LH2xKNZadAc0DV5iZA//8ZGhjSIz3wpQrP84LD+v2olp+/Ab\ng2gkzjenQ/FR4hgT0cdyUBvkWES+1NBRPjaiyyZFPMposfbwngm3ZfPTV0b1rUHd\ntpS/q5Grg6/WjpEHkYwyJH4jdUV4I5AUO0/zj+c4YBHi0rdlc1oohLiUT1zM7IFP\nHPK6sjgHb62AoN1h+xjUPKxpLNuaXsIzeC1FsDFqdt0LZlL/VQmmBpZeij5ufRRx\nzpUwiMiAyQBC1CIrf84YN1VWBM6o1aS8nK6cD9ouq9CP8dmpWQ8G+1YPHmdi6QPK\n6o+jwm/y8db5UihHFfSduF0Qqku4BVlAkJS+cBFcc8zz9nU2UFO0xlW6yStubJuv\n/MNJy/d0orDK9MvkJ4J3WRJ9TZhO50g4R1OBo2DT5SKB2s8HgAnMUPwmStkoSSWe\nTFk=\n-----END ENCRYPTED PRIVATE KEY-----\n');
/*!40000 ALTER TABLE `keys_customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages` (
  `languages_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `code` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `directory` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort_order` int(3) DEFAULT NULL,
  PRIMARY KEY (`languages_id`),
  KEY `IDX_LANGUAGES_NAME` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (1,'English','en','icon.gif','english',2),(4,'Czech','cs','icon.gif','czech',1);
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `last_empty_customers_id`
--

DROP TABLE IF EXISTS `last_empty_customers_id`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `last_empty_customers_id` (
  `customers_id` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `last_empty_customers_id`
--

LOCK TABLES `last_empty_customers_id` WRITE;
/*!40000 ALTER TABLE `last_empty_customers_id` DISABLE KEYS */;
INSERT INTO `last_empty_customers_id` VALUES (0);
/*!40000 ALTER TABLE `last_empty_customers_id` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manufacturers`
--

DROP TABLE IF EXISTS `manufacturers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manufacturers` (
  `manufacturers_id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturers_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `manufacturers_image` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `manufacturers_seo_title` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`manufacturers_id`),
  KEY `IDX_MANUFACTURERS_NAME` (`manufacturers_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manufacturers`
--

LOCK TABLES `manufacturers` WRITE;
/*!40000 ALTER TABLE `manufacturers` DISABLE KEYS */;
/*!40000 ALTER TABLE `manufacturers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manufacturers_info`
--

DROP TABLE IF EXISTS `manufacturers_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manufacturers_info` (
  `manufacturers_id` int(11) NOT NULL,
  `cached` int(1) NOT NULL DEFAULT '0',
  `cached_admin` int(1) DEFAULT NULL,
  `languages_id` int(11) NOT NULL,
  `manufacturers_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url_clicked` int(5) NOT NULL DEFAULT '0',
  `date_last_click` datetime DEFAULT NULL,
  `manufacturers_description` text COLLATE utf8_unicode_ci,
  `manufacturers_seo_description` text COLLATE utf8_unicode_ci,
  `manufacturers_seo_keywords` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manufacturers_alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `manufacturers_htc_title_tag` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manufacturers_htc_title_tag_alt` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manufacturers_htc_title_tag_url` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manufacturers_htc_desc_tag` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manufacturers_htc_keywords_tag` text COLLATE utf8_unicode_ci,
  `manufacturers_htc_description` text COLLATE utf8_unicode_ci,
  `manufacturers_htc_breadcrumb_text` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`manufacturers_id`,`languages_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manufacturers_info`
--

LOCK TABLES `manufacturers_info` WRITE;
/*!40000 ALTER TABLE `manufacturers_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `manufacturers_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mm_bulkmail`
--

DROP TABLE IF EXISTS `mm_bulkmail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mm_bulkmail` (
  `bulkmail_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `htmlcontent` text NOT NULL,
  `txtcontent` text NOT NULL,
  `date_added` datetime NOT NULL,
  `date_sent` datetime DEFAULT NULL,
  PRIMARY KEY (`bulkmail_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mm_bulkmail`
--

LOCK TABLES `mm_bulkmail` WRITE;
/*!40000 ALTER TABLE `mm_bulkmail` DISABLE KEYS */;
/*!40000 ALTER TABLE `mm_bulkmail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mm_newsletters`
--

DROP TABLE IF EXISTS `mm_newsletters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mm_newsletters` (
  `newsletters_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `subject` varchar(127) NOT NULL,
  `content` text NOT NULL,
  `txtcontent` text NOT NULL,
  `template` varchar(35) NOT NULL,
  `module` varchar(255) NOT NULL,
  `mailrate` int(2) NOT NULL DEFAULT '8',
  `date_added` datetime NOT NULL,
  `date_sent` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `locked` int(1) DEFAULT '0',
  PRIMARY KEY (`newsletters_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mm_newsletters`
--

LOCK TABLES `mm_newsletters` WRITE;
/*!40000 ALTER TABLE `mm_newsletters` DISABLE KEYS */;
INSERT INTO `mm_newsletters` VALUES (5,'Weekly Newsletter','Example Email 2','<table>\r\n  <tr> \r\n     <td style=\"font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color: #666666; margin:7px 0px;\"  align=\"left\" valign=\"top\" width=\"50%\">You can put add text and images to mail manager html emails.<br/><br >As installed,  all mail manager template and email images are hardcoded to the css-oscommerce.com website. <strong>You should go through these emails and hardcoded them to your website, or wherever you choose to upload the images,  by changing  http://www.css-oscommerce.com to http://www.yoursite.com. </strong> They should be hardcoded because the sent email will be looking for the images from a remote site, ie your customers email box. \r\n</td>\r\n     <td width=\"50%\">\r\nThe content on this side does not have any inline text styling and will be rendered according to the settings in the customers email program. \r\n    </td>\r\n  </tr>\r\n</table>','You can put add text and images to mail manager html emails.As installed,  \r\nall mail manager template and email images are hardcoded to the \r\ncss-oscommerce.com website. You should go through these emails and \r\nhardcoded them to your website, or wherever you choose to upload the images,  \r\nby changing  http://www.css-oscommerce.com to http://www.yoursite.com.  \r\nThey should be hardcoded because the sent email will be looking for the images \r\nfrom a remote site, ie your customers email box. \r\n\r\nthere is some txt contentthere is some txt contentthere is some txt content\r\nthere is some txt contentthere is some txt contentthere is some txt content\r\nthere is some txt contentthere is some txt contentthere is some txt content\r\nthere is some txt contentthere is some txt contentthere is some txt content','Bluebox','newsletters',4,'2010-10-12 16:23:18','2011-07-15 06:35:25',1,1),(6,'Big Sale!','Example Email 1','<table>\r\n  <tr> \r\n     <td style=\"font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color: #666666; margin:7px 0px;\" width=\"50%\" align=\"left\" valign=\"top\">\r\nThis is  a  table to hold some text or images. You could put a product image here. This content is   enclosed in a table. The template header, however ends with the opening td tag and the footer  begin with the closing td tag. That way the content is a nested table. \r\n    </td>\r\n     <td style=\"font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color: #666666; margin:7px 0px;\" width=\"50%\" align=\"left\" valign=\"top\">\r\nOf course that is just one  way to create emails.\r\n    </td>\r\n  </tr>\r\n<tr><td colspan=\"2\"><hr></td></tr>\r\n<tr> \r\n     <td style=\"font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color: #666666; margin:7px 0px;\"  align=\"left\" valign=\"top\" colspan=\"2\">You can put add text and images to mail manager html emails.<br/><br >As installed,  all mail manager template and email images are hardcoded to the css-oscommerce.com website. <strong>You should go through these emails and hardcoded them to your website, or wherever you choose to upload the images,  by changing  http://www.css-oscommerce.com to http://www.yoursite.com. </strong> They should be hardcoded because the sent email will be looking for the images from a remote site, ie your customers email box. \r\n</td>\r\n  </tr>\r\n<tr><td colspan=\"2\"><hr></td></tr>\r\n<tr> \r\n     <td style=\"font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color: #666666; margin:7px 0px;\" width=\"50%\" align=\"left\" valign=\"top\">Html emails almost always use inline styling. This means the email does not need a remote connection to an external stylesheet. You do not have to use tables. You can use div\'s. It\'s just that tables require less inline styling and more uniformly rendered by the vast array of email programs people use to read your emails.\r\n    </td>\r\n     <td style=\"font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color: #666666; margin:7px 0px;\" width=\"50%\" align=\"left\" valign=\"top\">\r\nhtml content\r\n    </td>\r\n  </tr>\r\n</table>','You can put add text and images to mail manager html emails.\r\nAs installed,  all mail manager template and email images are hardcoded to the \r\ncss-oscommerce.com website. You should go through these emails and hardcoded \r\nthem to your website, or wherever you choose to upload the images,  by changing  \r\nhttp://www.css-oscommerce.com to http://www.yoursite.com.  They should be \r\nhardcoded because the sent email will be looking for the images from a \r\nremote site, ie your customers email box. \r\n\r\n\r\nthere is some txt contentthere is some txt contentthere is some txt content\r\nthere is some txt contentthere is some txt contentthere is some txt content\r\nthere is some txt contentthere is some txt contentthere is some txt content\r\nthere is some txt contentthere is some txt contentthere is some txt content\r\nthere is some txt contentthere is some txt contentthere is some txt content','Cityscape','customers',8,'2011-01-15 15:49:14','2011-07-29 20:36:34',1,1),(14,'Galaxy','Galaxys on sale!','<table><tr>\r\n<td style=\"font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color: #666666; margin:7px 0px;\" width=\"50%\" align=\"left\" valign=\"top\">You can add text and images to mail manager html emails, right from the admin panel.<br/><br /> <br />As installed,  all mail manager template and email images are hardcoded to the css-oscommerce.com website. <strong>You should go through these emails and hardcoded them to your website, or wherever you choose to upload the images,  by changing  http://www.css-oscommerce.com to http://www.yoursite.com. </strong> They should be hardcoded because the sent email will be looking for the images from a remote site, ie your customers email box. \r\n</td>\r\n<td width=\"50%\">\r\n<img title=\"Galaxy Tab\" src=\"http://www.css-oscommerce.com/images/mail_manager/niora-galaxytab.jpg\" width=\"216\" height=\"344\" alt=\"Galaxy Tab\" border=\"none\"/>\r\n</td>\r\n</tr></table>','css-oscomerce codes oscommerce\r\n\r\nYou can put add text and images to mail manager html emails.As installed,  \r\nall mail manager template and email images are hardcoded to the \r\ncss-oscommerce.com website. You should go through these emails and \r\nhardcoded them to your website, or wherever you choose to upload the images,  \r\nby changing  http://www.css-oscommerce.com to http://www.yoursite.com.  \r\nThey should be hardcoded because the sent email will be looking for the \r\nimages from a remote site, ie your customers email box. \r\n............................................\r\nA lot of text can be put in here.\r\nA lot of text can be put in here.','Bluesky','sale_followup',4,'2011-07-15 16:33:07','2011-08-05 11:52:48',1,1);
/*!40000 ALTER TABLE `mm_newsletters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mm_responsemail`
--

DROP TABLE IF EXISTS `mm_responsemail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mm_responsemail` (
  `mail_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `htmlcontent` text NOT NULL,
  `txtcontent` text NOT NULL,
  `template` varchar(35) NOT NULL,
  `placeholders` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`mail_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mm_responsemail`
--

LOCK TABLES `mm_responsemail` WRITE;
/*!40000 ALTER TABLE `mm_responsemail` DISABLE KEYS */;
INSERT INTO `mm_responsemail` VALUES (1,'Order Confirmation','<table border=\"0\" cellpadding=\"10\" cellpadding=\"10\" bgcolor=\"#FFFFFF\" width=\"100%\">\r\n            <tr>\r\n                <td colspan=\"2\">\r\n                     <h1>Order Confirmation</h1><br />\r\n                      $invoiceurl\r\n                 </td>\r\n            </tr>           \r\n            <tr>\r\n                 <td style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\"> $orderno </td>\r\n                 <td >$orderdate</td>\r\n            </tr>\r\n             <tr><td colspan=\"2\"><hr></td></tr>       \r\n            <tr>\r\n                  <td><strong>$billingaddresshead</strong>\r\n                          </td>\r\n                  <td style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\"><strong>$deliveryaddresshead</strong>\r\n                           </td>\r\n             </tr>         \r\n             <tr><td style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$deliveryaddress</td><td style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$billingaddress</td></tr>\r\n             <tr><td colspan=\"2\"><hr></td></tr>            \r\n             <tr>\r\n                  <td colspan=\"2\"><strong>$productsorderedhead</strong></td>\r\n              </tr>\r\n              <tr>\r\n                    <td colspan=\"2\"  align=\"right\" style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$productsordered</td>\r\n             \r\n              <tr>\r\n                     <td colspan=\"2\"  align=\"right\" style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$ordertotal</td>\r\n              </tr>\r\n              <tr><td colspan=\"2\"><hr></td></tr>\r\n               <tr>\r\n                   <td colspan=\"2\"> <strong>$paymethodhead</strong></td>\r\n               </tr>\r\n                <tr>\r\n                     <td>$paymentmethod</td><td>$ccardtype</td>\r\n                 </tr>\r\n                 <tr><td colspan=\"2\" style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$ordercomments\r\n                         </td></tr>\r\n                 <tr><td colspan=\"2\">\r\n                          $storeemail<br />\r\n                          $storeurl\r\n                        </td>\r\n                   </tr>\r\n</table>','order confirmation\r\n\r\n$storename\r\n$storeemail\r\n$separator\r\n$invoiceurl \r\n$orderno\r\n$orderdate\r\n$separator\r\n$deliveryaddresshead\r\n$deliveryaddress\r\n$separator\r\n$billingaddresshead\r\n$billingaddress\r\n$separator\r\n$productsorderedhead\r\n$productsordered\r\n$totaltext\r\n$subtotaltext\r\n$ordertotal\r\n$ccardtype\r\n$separator\r\n$paymethodhead\r\n$paymentmethod\r\n$ordercomments','Bluebox','<tr><td class=\"main\"><strong>Available placeholders:</strong><br /></td></tr>\r\n   								<tr><td ><table><tr><td class=\"main\" valign=\"top\"><ul>\r\n   								<li>$storeurl = store url</li>\r\n   								<li>$storename = store name</li>\r\n   								<li>$storeemail = store email address</li>\r\n   								<li>$invoiceurl = Invoice url</li>\r\n   								<li>$orderno = Order Number</li>\r\n   								<li>$orderdate = Order Date</li>\r\n   								<li>$ordercomments = comments</li>\r\n   								<li>$separator = ============</li>\r\n   								<li>$productsorderedhead =  heading, product list</li>\r\n   								<li>$productsordered =  product list</li>\r\n   								<li>$ordercomments = customer comments</li>\r\n                                                                </ul></td><td class=\"main\" valign=\"top\"><ul>								\r\n   								<li>$deliveryaddresshead = heading, delivery address</li>\r\n   								<li>$deliveryaddress = delivery address</li>\r\n   								<li>$billingaddresshead = heading, billing address</li>\r\n   								<li>$billingaddress = billing address</li>\r\n   								<li>$paymethodhead = heading, payment method</li>\r\n   								<li>$paymentmethod = payment method</li>\r\n                                                                <li>$ccardtype = credit card type</li>                                                               \r\n   								<li>$totaltext = heading, order total</li>\r\n                                                                <li>$subtotaltext = heading, subtotal</li>\r\n   								<li>$ordertotal = order total</li>\r\n   								</ul></td></tr></table></td></tr>',0),(2,'Status Update','<!--content-->\r\n<table><tr><td colspan=\"2\" ><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\"><strong> $storename </strong></p></td></tr>\r\n            <tr><td><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$orderno</p></td>  	\r\n<td align=\"center\"><p align=\"right\" style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$orderdate</p></td></tr>\r\n            <tr>\r\n            	<td colspan=\"2\">\r\n            	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n            		<tr><td height=\"1\"><img src=\"http://www.css-oscommerce.com/images/mail_manager/divider-invoice.jpg\" width=\"100%\" height=\"1\" style=\"display: block;\" /></td></tr>                                                 \r\n            	</table>\r\n            	</td>\r\n            </tr>\r\n            <tr><td colspan=\"2\"><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$statusnewhtml</p></td></tr>                    \r\n            <tr><td colspan=\"2\"><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$comments</p></td></tr>\r\n            <tr><td colspan=\"2\"><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$invoiceurl</p></td></tr></table>        \r\n<!--// content-->','$txtheader\r\n$storeowner\r\n$orderno\r\n$orderdate\r\n$statusnewtxt\r\n$comments\r\n$invoiceurl','Choice','<tr><td class=\"main\"><strong>Available placeholders:</strong><br /></td></tr>\r\n   								<tr><td><table><tr><td class=\"main\" valign=\"top\"><ul>\r\n   								<li>$storeurl = store url</li>\r\n   								<li>$storename = store name</li>\r\n   								<li>$storeemail = store email address</li>\r\n   								<li>$customername = customer name</li>\r\n   								<li>$customeremail = customer email</li>\r\n   								<li>$separator = ============</li></ul></td><td class=\"main\" valign=\"top\"><ul>\r\n   								<li>$orderno =  order number</li>\r\n   								<li>$orderdate =  order date</li>\r\n   								<li>$statusnewhtml = new status, html format</li>\r\n   								<li>$statusnewtxt = new status, txt format</li>\r\n   								<li>$comments = comments</li>\r\n   								<li>$invoiceurl = invoice url</li>\r\n   								</ul></td></tr></table></td></tr>',0),(3,'Password Forgotten','<table>\r\n    <tr>\r\n        <td><br /><br /><br />$emailsubject<br /><br />$newpwandmsg<br /><br /><br /></td>\r\n    </tr>\r\n</table>','$emailsubject\r\n\r\n$newpwandmsg','Email','<tr><td class=\"main\"><strong>Available placeholders:</strong><br /></td></tr>\r\n<tr><td><table><tr><td class=\"main\" valign=\"top\">\r\n<ul>\r\n<li>$storeurl = store url</li>\r\n<li>$storename = store name</li>\r\n<li>$customerfirstname = customer first name</li>\r\n<li>$customerlastname = customer last name</li>\r\n<li>$customeremail = customer email</li>\r\n<li>$emailsubject = email subject (EMAIL_PASSWORD_REMINDER_SUBJECT)</li>\r\n<li>$newpwandmsg = email text + new password (sprintf(EMAIL_PASSWORD_REMINDER_BODY, $new_password))</li>\r\n</ul>\r\n</td></tr></table></td></tr>',0),(4,'Tell A Friend','<table cellspacing=\"10\" cellpadding=\"10\">\r\n    <tr>\r\n        <td colspan=\"2\" >\r\n           Hello $toname,<br /><br />\r\n           Your friend, $fromname,  thought that you would be interested in $products from $storename.<br />\r\n           To view the product click on the link below or copy and paste the link into your web browser:<br /><br />\r\n           $link<br /><br />\r\n           Regards, $storename\r\n            <br/ ><br />\r\n            <hr>\r\n            <br /><br />\r\n             $fromname says:\r\n            <br /><br />\r\n            <em> $message</em>\r\n         </td>\r\n         <td>\r\n              $image\r\n        <p align=\"center\">$product</p>\r\n         </td>\r\n     </tr>\r\n</table>','Hello $toname,\r\nYour friend, $fromname  thought that you would be interested in $product from $storename.\r\n\r\nTo view the product click on the link below or copy and paste the link into your web browser:\r\n\r\n$link\r\n\r\nRegards, $storename\r\n\r\n-----------------------------------------------------------------\r\n$fromname says:\r\n\r\n$message','Cssosc','<tr><td class=\"main\"><strong>Available placeholders:</strong><br /></td></tr>\r\n                             <tr><td><table><tr><td class=\"main\" valign=\"top\">\r\n<ul>\r\n<li>$storeurl = store url</li>\r\n<li>$storeemail = store email</li>\r\n<li>$storename = store name</li>\r\n<li>$toname = email sent to</li>\r\n<li>$fromname = email sent from</li>\r\n</ul></td><td class=\"main\" valign=\"top\"><ul>\r\n<li>$product = product name</li>\r\n<li>$link = link to product</li>\r\n<li>$image = product image</li>\r\n<li>$message = message</li>\r\n</ul>\r\n</td></tr></table></td></tr>',0),(0,'Create Account','<!--content-->\r\n<tr>\r\n    <td>\r\n        <table bgcolor=\"#FFFFFF\">\r\n             <tr>\r\n                <td>\r\n                     \r\n<p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$mmgreet<br/>$mmwelcome</p>\r\n<p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$mmtext</p>\r\n<p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$mmcontact</p>\r\n<p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$mmwarning\r\n</p>\r\n              </td>\r\n      	  </tr>\r\n          <tr>\r\n                <td>\r\n            	       <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n            		     <tr>\r\n                                   <td height=\"1\"><img src=\"http://www.css-oscommerce.com/images/mail_manager/divider-invoice.jpg\" width=\"100%\" height=\"1\" style=\"display: block;\" />\r\n                                   </td>\r\n                            </tr>                                                 \r\n            	         </table>\r\n            	</td>\r\n            </tr>\r\n        </table>\r\n    </td>\r\n</tr>\r\n<!--// content-->','$mmgreet\r\n\r\n$mmwelcome\r\n\r\n$mmtext\r\n\r\n$mmcontact\r\n\r\n$mmwarning','Cityscape','',0);
/*!40000 ALTER TABLE `mm_responsemail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mm_responsemail_backup`
--

DROP TABLE IF EXISTS `mm_responsemail_backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mm_responsemail_backup` (
  `mail_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `htmlcontent` text NOT NULL,
  `txtcontent` text NOT NULL,
  `template` varchar(35) NOT NULL,
  `placeholders` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`mail_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mm_responsemail_backup`
--

LOCK TABLES `mm_responsemail_backup` WRITE;
/*!40000 ALTER TABLE `mm_responsemail_backup` DISABLE KEYS */;
INSERT INTO `mm_responsemail_backup` VALUES (1,'Order Confirmation','<table border=\"0\" cellpadding=\"10\" cellpadding=\"10\" bgcolor=\"#FFFFFF\" width=\"100%\">\r\n            <tr>\r\n                <td colspan=\"2\">\r\n                     <h1>Order Confirmation</h1><br />\r\n                      $invoiceurl\r\n                 </td>\r\n            </tr>           \r\n            <tr>\r\n                 <td style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\"> $orderno </td>\r\n                 <td >$orderdate</td>\r\n            </tr>\r\n             <tr><td colspan=\"2\"><hr></td></tr>       \r\n            <tr>\r\n                  <td><strong>$billingaddresshead</strong>\r\n                          </td>\r\n                  <td style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\"><strong>$deliveryaddresshead</strong>\r\n                           </td>\r\n             </tr>         \r\n             <tr><td style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$deliveryaddress</td><td style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$billingaddress</td></tr>\r\n             <tr><td colspan=\"2\"><hr></td></tr>            \r\n             <tr>\r\n                  <td colspan=\"2\"><strong>$productsorderedhead</strong></td>\r\n              </tr>\r\n              <tr>\r\n                    <td colspan=\"2\"  align=\"right\" style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$productsordered</td>\r\n             \r\n              <tr>\r\n                     <td colspan=\"2\"  align=\"right\" style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$ordertotal</td>\r\n              </tr>\r\n              <tr><td colspan=\"2\"><hr></td></tr>\r\n               <tr>\r\n                   <td colspan=\"2\"> <strong>$paymethodhead</strong></td>\r\n               </tr>\r\n                <tr>\r\n                     <td>$paymentmethod</td><td>$ccardtype</td>\r\n                 </tr>\r\n                 <tr><td colspan=\"2\" style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$ordercomments\r\n                         </td></tr>\r\n                 <tr><td colspan=\"2\">\r\n                          $storeemail<br />\r\n                          $storeurl\r\n                        </td>\r\n                   </tr>\r\n</table>','order confirmation\r\n\r\n$storename\r\n$storeemail\r\n$separator\r\n$invoiceurl \r\n$orderno\r\n$orderdate\r\n$separator\r\n$deliveryaddresshead\r\n$deliveryaddress\r\n$separator\r\n$billingaddresshead\r\n$billingaddress\r\n$separator\r\n$productsorderedhead\r\n$productsordered\r\n$totaltext\r\n$subtotaltext\r\n$ordertotal\r\n$ccardtype\r\n$separator\r\n$paymethodhead\r\n$paymentmethod\r\n$ordercomments','Bluebox','<tr><td class=\"main\"><strong>Available placeholders:</strong><br /></td></tr>\r\n   								<tr><td ><table><tr><td class=\"main\" valign=\"top\"><ul>\r\n   								<li>$storeurl = store url</li>\r\n   								<li>$storename = store name</li>\r\n   								<li>$storeemail = store email address</li>\r\n   								<li>$invoiceurl = Invoice url</li>\r\n   								<li>$orderno = Order Number</li>\r\n   								<li>$orderdate = Order Date</li>\r\n   								<li>$ordercomments = comments</li>\r\n   								<li>$separator = ============</li>\r\n   								<li>$productsorderedhead =  heading, product list</li>\r\n   								<li>$productsordered =  product list</li>\r\n   								<li>$ordercomments = customer comments</li>\r\n                                                                </ul></td><td class=\"main\" valign=\"top\"><ul>								\r\n   								<li>$deliveryaddresshead = heading, delivery address</li>\r\n   								<li>$deliveryaddress = delivery address</li>\r\n   								<li>$billingaddresshead = heading, billing address</li>\r\n   								<li>$billingaddress = billing address</li>\r\n   								<li>$paymethodhead = heading, payment method</li>\r\n   								<li>$paymentmethod = payment method</li>\r\n                                                                <li>$ccardtype = credit card type</li>                                                               \r\n   								<li>$totaltext = heading, order total</li>\r\n                                                                <li>$subtotaltext = heading, subtotal</li>\r\n   								<li>$ordertotal = order total</li>\r\n   								</ul></td></tr></table></td></tr>',1),(2,'Status Update','<!--content-->\r\n<table><tr><td colspan=\"2\" ><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\"><strong> $storename </strong></p></td></tr>\r\n            <tr><td><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$orderno</p></td>  	\r\n<td align=\"center\"><p align=\"right\" style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$orderdate</p></td></tr>\r\n            <tr>\r\n            	<td colspan=\"2\">\r\n            	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n            		<tr><td height=\"1\"><img src=\"http://www.css-oscommerce.com/images/mail_manager/divider-invoice.jpg\" width=\"100%\" height=\"1\" style=\"display: block;\" /></td></tr>                                                 \r\n            	</table>\r\n            	</td>\r\n            </tr>\r\n            <tr><td colspan=\"2\"><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$statusnewhtml</p></td></tr>                    \r\n            <tr><td colspan=\"2\"><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$comments</p></td></tr>\r\n            <tr><td colspan=\"2\"><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$invoiceurl</p></td></tr></table>        \r\n<!--// content-->','$txtheader\r\n$storeowner\r\n$orderno\r\n$orderdate\r\n$statusnewtxt\r\n$comments\r\n$invoiceurl','Choice','<tr><td class=\"main\"><strong>Available placeholders:</strong><br /></td></tr>\r\n   								<tr><td><table><tr><td class=\"main\" valign=\"top\"><ul>\r\n   								<li>$storeurl = store url</li>\r\n   								<li>$storename = store name</li>\r\n   								<li>$storeemail = store email address</li>\r\n   								<li>$customername = customer name</li>\r\n   								<li>$customeremail = customer email</li>\r\n   								<li>$separator = ============</li></ul></td><td class=\"main\" valign=\"top\"><ul>\r\n   								<li>$orderno =  order number</li>\r\n   								<li>$orderdate =  order date</li>\r\n   								<li>$statusnewhtml = new status, html format</li>\r\n   								<li>$statusnewtxt = new status, txt format</li>\r\n   								<li>$comments = comments</li>\r\n   								<li>$invoiceurl = invoice url</li>\r\n   								</ul></td></tr></table></td></tr>',1),(3,'Password Forgotten','<table>\r\n    <tr>\r\n        <td><br /><br /><br />$emailsubject<br /><br />$newpwandmsg<br /><br /><br /></td>\r\n    </tr>\r\n</table>','$emailsubject\r\n\r\n$newpwandmsg','Email','<tr><td class=\"main\"><strong>Available placeholders:</strong><br /></td></tr>\r\n<tr><td><table><tr><td class=\"main\" valign=\"top\">\r\n<ul>\r\n<li>$storeurl = store url</li>\r\n<li>$storename = store name</li>\r\n<li>$customerfirstname = customer first name</li>\r\n<li>$customerlastname = customer last name</li>\r\n<li>$customeremail = customer email</li>\r\n<li>$emailsubject = email subject (EMAIL_PASSWORD_REMINDER_SUBJECT)</li>\r\n<li>$newpwandmsg = email text + new password (sprintf(EMAIL_PASSWORD_REMINDER_BODY, $new_password))</li>\r\n</ul>\r\n</td></tr></table></td></tr>',1),(4,'Tell A Friend','<table cellspacing=\"10\" cellpadding=\"10\">\r\n    <tr>\r\n        <td colspan=\"2\" >\r\n           Hello $toname,<br /><br />\r\n           Your friend, $fromname,  thought that you would be interested in $products from $storename.<br />\r\n           To view the product click on the link below or copy and paste the link into your web browser:<br /><br />\r\n           $link<br /><br />\r\n           Regards, $storename\r\n            <br/ ><br />\r\n            <hr>\r\n            <br /><br />\r\n             $fromname says:\r\n            <br /><br />\r\n            <em> $message</em>\r\n         </td>\r\n         <td>\r\n              $image\r\n        <p align=\"center\">$product</p>\r\n         </td>\r\n     </tr>\r\n</table>','Hello $toname,\r\nYour friend, $fromname  thought that you would be interested in $product from $storename.\r\n\r\nTo view the product click on the link below or copy and paste the link into your web browser:\r\n\r\n$link\r\n\r\nRegards, $storename\r\n\r\n-----------------------------------------------------------------\r\n$fromname says:\r\n\r\n$message','Cssosc','<tr><td class=\"main\"><strong>Available placeholders:</strong><br /></td></tr>\r\n                             <tr><td><table><tr><td class=\"main\" valign=\"top\">\r\n<ul>\r\n<li>$storeurl = store url</li>\r\n<li>$storeemail = store email</li>\r\n<li>$storename = store name</li>\r\n<li>$toname = email sent to</li>\r\n<li>$fromname = email sent from</li>\r\n</ul></td><td class=\"main\" valign=\"top\"><ul>\r\n<li>$product = product name</li>\r\n<li>$link = link to product</li>\r\n<li>$image = product image</li>\r\n<li>$message = message</li>\r\n</ul>\r\n</td></tr></table></td></tr>',1),(0,'Create Account','<!--content-->\r\n<tr>\r\n    <td>\r\n        <table bgcolor=\"#FFFFFF\">\r\n             <tr>\r\n                <td>\r\n                     \r\n<p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$mmgreet<br/>$mmwelcome</p>\r\n<p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$mmtext</p>\r\n<p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$mmcontact</p>\r\n<p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$mmwarning\r\n</p>\r\n              </td>\r\n      	  </tr>\r\n          <tr>\r\n                <td>\r\n            	       <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n            		     <tr>\r\n                                   <td height=\"1\"><img src=\"http://www.css-oscommerce.com/images/mail_manager/divider-invoice.jpg\" width=\"100%\" height=\"1\" style=\"display: block;\" />\r\n                                   </td>\r\n                            </tr>                                                 \r\n            	         </table>\r\n            	</td>\r\n            </tr>\r\n        </table>\r\n    </td>\r\n</tr>\r\n<!--// content-->','$mmgreet\r\n\r\n$mmwelcome\r\n\r\n$mmtext\r\n\r\n$mmcontact\r\n\r\n$mmwarning','Cityscape','',1);
/*!40000 ALTER TABLE `mm_responsemail_backup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mm_responsemail_reset`
--

DROP TABLE IF EXISTS `mm_responsemail_reset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mm_responsemail_reset` (
  `mail_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `htmlcontent` text NOT NULL,
  `txtcontent` text NOT NULL,
  `template` varchar(35) NOT NULL,
  `placeholders` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`mail_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mm_responsemail_reset`
--

LOCK TABLES `mm_responsemail_reset` WRITE;
/*!40000 ALTER TABLE `mm_responsemail_reset` DISABLE KEYS */;
INSERT INTO `mm_responsemail_reset` VALUES (1,'Order Confirmation','<table border=\"0\" cellpadding=\"10\" cellpadding=\"10\" bgcolor=\"#FFFFFF\" width=\"100%\">\r\n            <tr>\r\n                <td colspan=\"2\">\r\n                     <h1>Order Confirmation</h1><br />\r\n                      $invoiceurl\r\n                 </td>\r\n            </tr>           \r\n            <tr>\r\n                 <td style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\"> $orderno </td>\r\n                 <td >$orderdate</td>\r\n            </tr>\r\n             <tr><td colspan=\"2\"><hr></td></tr>       \r\n            <tr>\r\n                  <td><strong>$billingaddresshead</strong>\r\n                          </td>\r\n                  <td style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\"><strong>$deliveryaddresshead</strong>\r\n                           </td>\r\n             </tr>         \r\n             <tr><td style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$deliveryaddress</td><td style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$billingaddress</td></tr>\r\n             <tr><td colspan=\"2\"><hr></td></tr>            \r\n             <tr>\r\n                  <td colspan=\"2\"><strong>$productsorderedhead</strong></td>\r\n              </tr>\r\n              <tr>\r\n                    <td colspan=\"2\"  align=\"right\" style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$productsordered</td>\r\n             \r\n              <tr>\r\n                     <td colspan=\"2\"  align=\"right\" style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$ordertotal</td>\r\n              </tr>\r\n              <tr><td colspan=\"2\"><hr></td></tr>\r\n               <tr>\r\n                   <td colspan=\"2\"> <strong>$paymethodhead</strong></td>\r\n               </tr>\r\n                <tr>\r\n                     <td>$paymentmethod</td><td>$ccardtype</td>\r\n                 </tr>\r\n                 <tr><td colspan=\"2\" style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$ordercomments\r\n                         </td></tr>\r\n                 <tr><td colspan=\"2\">\r\n                          $storeemail<br />\r\n                          $storeurl\r\n                        </td>\r\n                   </tr>\r\n</table>','order confirmation\r\n\r\n$storename\r\n$storeemail\r\n$separator\r\n$invoiceurl \r\n$orderno\r\n$orderdate\r\n$separator\r\n$deliveryaddresshead\r\n$deliveryaddress\r\n$separator\r\n$billingaddresshead\r\n$billingaddress\r\n$separator\r\n$productsorderedhead\r\n$productsordered\r\n$totaltext\r\n$subtotaltext\r\n$ordertotal\r\n$ccardtype\r\n$separator\r\n$paymethodhead\r\n$paymentmethod\r\n$ordercomments','Bluebox','<tr><td class=\"main\"><strong>Available placeholders:</strong><br /></td></tr>\r\n   								<tr><td ><table><tr><td class=\"main\" valign=\"top\"><ul>\r\n   								<li>$storeurl = store url</li>\r\n   								<li>$storename = store name</li>\r\n   								<li>$storeemail = store email address</li>\r\n   								<li>$invoiceurl = Invoice url</li>\r\n   								<li>$orderno = Order Number</li>\r\n   								<li>$orderdate = Order Date</li>\r\n   								<li>$ordercomments = comments</li>\r\n   								<li>$separator = ============</li>\r\n   								<li>$productsorderedhead =  heading, product list</li>\r\n   								<li>$productsordered =  product list</li>\r\n   								<li>$ordercomments = customer comments</li>\r\n                                                                </ul></td><td class=\"main\" valign=\"top\"><ul>								\r\n   								<li>$deliveryaddresshead = heading, delivery address</li>\r\n   								<li>$deliveryaddress = delivery address</li>\r\n   								<li>$billingaddresshead = heading, billing address</li>\r\n   								<li>$billingaddress = billing address</li>\r\n   								<li>$paymethodhead = heading, payment method</li>\r\n   								<li>$paymentmethod = payment method</li>\r\n                                                                <li>$ccardtype = credit card type</li>                                                               \r\n   								<li>$totaltext = heading, order total</li>\r\n                                                                <li>$subtotaltext = heading, subtotal</li>\r\n   								<li>$ordertotal = order total</li>\r\n   								</ul></td></tr></table></td></tr>',1),(2,'Status Update','<!--content-->\r\n<table><tr><td colspan=\"2\" ><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\"><strong> $storename </strong></p></td></tr>\r\n            <tr><td><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$orderno</p></td>  	\r\n<td align=\"center\"><p align=\"right\" style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$orderdate</p></td></tr>\r\n            <tr>\r\n            	<td colspan=\"2\">\r\n            	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n            		<tr><td height=\"1\"><img src=\"http://www.css-oscommerce.com/images/mail_manager/divider-invoice.jpg\" width=\"100%\" height=\"1\" style=\"display: block;\" /></td></tr>                                                 \r\n            	</table>\r\n            	</td>\r\n            </tr>\r\n            <tr><td colspan=\"2\"><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$statusnewhtml</p></td></tr>                    \r\n            <tr><td colspan=\"2\"><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$comments</p></td></tr>\r\n            <tr><td colspan=\"2\"><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$invoiceurl</p></td></tr></table>        \r\n<!--// content-->','$txtheader\r\n$storeowner\r\n$orderno\r\n$orderdate\r\n$statusnewtxt\r\n$comments\r\n$invoiceurl','Choice','<tr><td class=\"main\"><strong>Available placeholders:</strong><br /></td></tr>\r\n   								<tr><td><table><tr><td class=\"main\" valign=\"top\"><ul>\r\n   								<li>$storeurl = store url</li>\r\n   								<li>$storename = store name</li>\r\n   								<li>$storeemail = store email address</li>\r\n   								<li>$customername = customer name</li>\r\n   								<li>$customeremail = customer email</li>\r\n   								<li>$separator = ============</li></ul></td><td class=\"main\" valign=\"top\"><ul>\r\n   								<li>$orderno =  order number</li>\r\n   								<li>$orderdate =  order date</li>\r\n   								<li>$statusnewhtml = new status, html format</li>\r\n   								<li>$statusnewtxt = new status, txt format</li>\r\n   								<li>$comments = comments</li>\r\n   								<li>$invoiceurl = invoice url</li>\r\n   								</ul></td></tr></table></td></tr>',1),(3,'Password Forgotten','<table>\r\n    <tr>\r\n        <td><br /><br /><br />$emailsubject<br /><br />$newpwandmsg<br /><br /><br /></td>\r\n    </tr>\r\n</table>','$emailsubject\r\n\r\n$newpwandmsg','Email','<tr><td class=\"main\"><strong>Available placeholders:</strong><br /></td></tr>\r\n<tr><td><table><tr><td class=\"main\" valign=\"top\">\r\n<ul>\r\n<li>$storeurl = store url</li>\r\n<li>$storename = store name</li>\r\n<li>$customerfirstname = customer first name</li>\r\n<li>$customerlastname = customer last name</li>\r\n<li>$customeremail = customer email</li>\r\n<li>$emailsubject = email subject (EMAIL_PASSWORD_REMINDER_SUBJECT)</li>\r\n<li>$newpwandmsg = email text + new password (sprintf(EMAIL_PASSWORD_REMINDER_BODY, $new_password))</li>\r\n</ul>\r\n</td></tr></table></td></tr>',1),(4,'Tell A Friend','<table cellspacing=\"10\" cellpadding=\"10\">\r\n    <tr>\r\n        <td colspan=\"2\" >\r\n           Hello $toname,<br /><br />\r\n           Your friend, $fromname,  thought that you would be interested in $products from $storename.<br />\r\n           To view the product click on the link below or copy and paste the link into your web browser:<br /><br />\r\n           $link<br /><br />\r\n           Regards, $storename\r\n            <br/ ><br />\r\n            <hr>\r\n            <br /><br />\r\n             $fromname says:\r\n            <br /><br />\r\n            <em> $message</em>\r\n         </td>\r\n         <td>\r\n              $image\r\n        <p align=\"center\">$product</p>\r\n         </td>\r\n     </tr>\r\n</table>','Hello $toname,\r\nYour friend, $fromname  thought that you would be interested in $product from $storename.\r\n\r\nTo view the product click on the link below or copy and paste the link into your web browser:\r\n\r\n$link\r\n\r\nRegards, $storename\r\n\r\n-----------------------------------------------------------------\r\n$fromname says:\r\n\r\n$message','Cssosc','<tr><td class=\"main\"><strong>Available placeholders:</strong><br /></td></tr>\r\n                             <tr><td><table><tr><td class=\"main\" valign=\"top\">\r\n<ul>\r\n<li>$storeurl = store url</li>\r\n<li>$storeemail = store email</li>\r\n<li>$storename = store name</li>\r\n<li>$toname = email sent to</li>\r\n<li>$fromname = email sent from</li>\r\n</ul></td><td class=\"main\" valign=\"top\"><ul>\r\n<li>$product = product name</li>\r\n<li>$link = link to product</li>\r\n<li>$image = product image</li>\r\n<li>$message = message</li>\r\n</ul>\r\n</td></tr></table></td></tr>',1),(0,'Create Account','<!--content-->\r\n<tr>\r\n    <td>\r\n        <table bgcolor=\"#FFFFFF\">\r\n             <tr>\r\n                <td>\r\n                     \r\n<p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$mmgreet<br/>$mmwelcome</p>\r\n<p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$mmtext</p>\r\n<p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$mmcontact</p>\r\n<p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$mmwarning\r\n</p>\r\n              </td>\r\n      	  </tr>\r\n          <tr>\r\n                <td>\r\n            	       <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n            		     <tr>\r\n                                   <td height=\"1\"><img src=\"http://www.css-oscommerce.com/images/mail_manager/divider-invoice.jpg\" width=\"100%\" height=\"1\" style=\"display: block;\" />\r\n                                   </td>\r\n                            </tr>                                                 \r\n            	         </table>\r\n            	</td>\r\n            </tr>\r\n        </table>\r\n    </td>\r\n</tr>\r\n<!--// content-->','$mmgreet\r\n\r\n$mmwelcome\r\n\r\n$mmtext\r\n\r\n$mmcontact\r\n\r\n$mmwarning','Cityscape','',1);
/*!40000 ALTER TABLE `mm_responsemail_reset` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mm_templates`
--

DROP TABLE IF EXISTS `mm_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mm_templates` (
  `template_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `htmlheader` text NOT NULL,
  `htmlfooter` text NOT NULL,
  `txtheader` text NOT NULL,
  `txtfooter` text NOT NULL,
  PRIMARY KEY (`template_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mm_templates`
--

LOCK TABLES `mm_templates` WRITE;
/*!40000 ALTER TABLE `mm_templates` DISABLE KEYS */;
INSERT INTO `mm_templates` VALUES (17,'Cssosc','<html>\r\n<body style=\"padding: 0px; margin: 0px; background-color:#ffffff;\" marginheight=\"0\" topmargin=\"0\" marginwidth=\"0\" leftmargin=\"0\" bgcolor=\"#ebebeb\" >\r\n<table width=\"100%\" cellspacing=\"0\" border=\"0\" cellpadding=\"0\"  bgcolor=\"#ebebeb\" align=\"center\"><tr><td align=\"center\" valign=\"top\">\r\n<!--WRAPPER-->\r\n<table width=\"610\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td align=\"center\">\r\n<!--CONTAINER-->             \r\n<table width=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FFFFFF\" >\r\n<!-- HEADER IMAGE-->                 	\r\n	<tr height=\"20\"><td bgcolor=\"#ebebeb\" ></td></tr>\r\n<!--//HEADER IMAGE -->\r\n<!-- LOGO AND HEADER -->\r\n    <tr>\r\n    	<td align=\"center\" valign=\"top\">\r\n        	<table cellpadding=\"0\" cellspacing=\"0\"  >\r\n            	<!--TOP CURVE -->\r\n            	<tr><td width=\"600\" align=\"center\" valign=\"top\"><img src=\"http://www.css-oscommerce.com/images/mail_manager/niora-headercurve.jpg\" width=\"600\" height=\"18\" border=\"0\" style=\"display: block;\" /></td></tr>\r\n                <!--//TOP CURVE-->\r\n                <tr>\r\n                    <td width=\"600\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\">                    \r\n                    	<!--NIORA-->\r\n                    	<table width=\"600\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" >\r\n                    	<tr>\r\n                    	<td width=\"20\"></td>\r\n                    	<td align=\"left\">\r\n                    	<img src=\"http://www.css-oscommerce.com/images/mail_manager/niora-logo.png\" width=\"345\" height=\"40\" border=\"0\" style=\"display: block;\" />\r\n                    	</td>\r\n                    	<td style=\"font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color: #666666; margin:7px 0px;\" width=\"75\" align=\"right\" valign=\"top\">Follow us on<br /> Facebook.</td>\r\n                    	<td valign=\"top\" width=\"50\" align=\"center\">\r\n                    	<a href=\"http://www.facebook.com/pages\" target=\"blank\"><img title=\"Facebook Like Button\" src=\"http://www.css-oscommerce.com/images/mail_manager/niora-fb-thumb.png\" width=\"\" height=\"\" alt=\"facebook thumb\" border=\"none\"/></a>\r\n                    	</td></tr>\r\n                    	</table>\r\n                    </td>\r\n               </tr>               \r\n                <tr><td height=\"1\"><img src=\"http://www.css-oscommerce.com/images/mail_manager/niora-divider.jpg\" width=\"600\" height=\"1\" style=\"display: block;\" /></td></tr>\r\n            </table>\r\n      </td>\r\n    </tr>\r\n    <tr><td align=\"center\" valign=\"top\">','</td></tr>\r\n<tr>\r\n    	<td align=\"center\" valign=\"top\">\r\n        	<table cellpadding=\"0\" cellspacing=\"0\" >\r\n        		<tr><td><img src=\"http://www.css-oscommerce.com/images/mail_manager/niora-divider.jpg\" width=\"560\" height=\"1\" style=\"display: block;\" /></td></tr>\r\n            </table>\r\n         </td>\r\n     </tr>\r\n<tr>\r\n <td align=\"center\">\r\n    <table width=\"600\" cellpadding=\"0\" cellspacing=\"0\" style=\"padding:10px 0px;\"  bgcolor=\"#FFFFFF\">\r\n      <tr>\r\n        <td align=\"left\" width=\"165\" valign=\"top\">\r\n           <p style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">Find out more:</p>\r\n           <p style=\"font-family: Arial, Helvetica, sans-serif; font-size: 11px; line-height: 16px; color: #999999; margin: 10px;\">Visit us at <a href=\"http://www.css-oscommerce.com\">www.css-oscommerce.com</a></p>\r\n        </td>\r\n        <td align=\"left\" width=\"2\" valign=\"bottom\">\r\n        	<img src=\"http://www.css-oscommerce.com/images/mail_manager/niora_footer_div_vert.jpg\" width=\"1\" height=\"100\" style=\"display: block;\" />\r\n        </td>\r\n        <td align=\"left\" width=\"165\" valign=\"top\">\r\n           <p style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">Contact us:</p>\r\n           <p style=\"font-family: Arial, Helvetica, sans-serif; font-size: 11px; line-height: 16px; color: #999999; margin: 10px;\">1001 Madison Ave<br /> New York, NY 10001<br />Phone: (800)123-4567<br />Email: <a href=\"mailto:contact@yoursite.com\">contact@yoursite.com</a></p>\r\n        </td>\r\n        <td align=\"left\" width=\"3\" valign=\"bottom\">\r\n           <img src=\"http://www.css-oscommerce.com/images/mail_manager/niora_footer_div_vert.jpg\" width=\"1\" height=\"100\" style=\"display: block;\" />\r\n        </td>\r\n        <td align=\"left\" width=\"165\" valign=\"top\">\r\n           <p style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">Follow us on Facebook:</p>\r\n               <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"margin-left: 10px;\">\r\n                 <tr>\r\n                   <td width=\"100\" align=\"center\"><a href=\"http://www.facebook.com\" target=\"blank\">\r\n                     <img title=\"Facebook Like Button\" src=\"http://www.css-oscommerce.com/images/mail_manager/niora-fb-thumb.png\" width=\"\" height=\"\" alt=\"facebook thumb\" border=\"none\"/></a>\r\n                   </td>                                                                                            \r\n                 </tr>\r\n               </table>  \r\n        </td>\r\n       </tr>\r\n    </table>\r\n  </td>\r\n</tr>\r\n<tr>\r\n  <td align=\"center\">\r\n  	<img src=\"http://www.css-oscommerce.com/images/mail_manager/niora-footercurve.jpg\" width=\"600\" height=\"10\" style=\"display: block;\"/>\r\n  </td> \r\n</tr>        \r\n</table>  \r\n</td>\r\n</tr>\r\n<tr>\r\n <td align=\"center\">\r\n    <table width=\"560\" cellpadding=\"0\" cellspacing=\"0\">\r\n     <tr>\r\n       <td align=\"left\" width=\"165\" valign=\"top\">\r\n       		<p style=\"font-family: Arial, Helvetica, sans-serif; font-size: 11px; line-height: 16px; color: #999999; margin: 10px;\">If this email is not displaying correctly, <a href=\"http://www.mysite.com\">click here</a> to view it online.</p>\r\n       </td>\r\n       <td align=\"left\" width=\"165\" valign=\"top\">\r\n            <p style=\"font-family: Arial, Helvetica, sans-serif; font-size: 11px; line-height: 16px; color: #999999; margin: 10px;\"> To be removed from this mailing list click <a href=\"mailto:unsubscribe@mysite.com?subject=Unsubscribe&body=Please%20remove%20my%20email%20from%20your%20list\" ><u>here</u></a></p>\r\n       </td>\r\n       <td align=\"left\" width=\"165\" valign=\"top\">\r\n           <p style=\"font-family: Arial, Helvetica, sans-serif; font-size: 11px; line-height: 16px; color: #999999; margin: 10px;\">Forward this email to a friend by <a href=\"mailto:?subject=MyStore&body=You%20May%20be%20interested%20in%20www.mysite.com\">clicking here.</a></p>\r\n       </td>\r\n     </tr>\r\n    </table>\r\n  </td>\r\n</tr>\r\n</table>    \r\n</td>\r\n</tr>\r\n</table>\r\n</body>\r\n</html>','',''),(14,'Bluebox','<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />\r\n	<title></title>\r\n</head>\r\n<body leftmargin=\"0\" marginwidth=\"0\" topmargin=\"0\" marginheight=\"0\" offset=\"0\" style=\"margin:0;padding:0;\"><img src=\"http://www.css-oscommerce.com/images/mail_manager/transp.gif\" />\r\n<table id=\"bodywrap\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\" height=\"100%\">\r\n<tr><td bgcolor=\"white\" style=\"font-family:arial,sans-serif;font-size:12px; color:#000000;\" valign=\"top\">	\r\n<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"600\" bgcolor=\"#11a0dc\" align=\"center\" style=\"-webkit-border-radius:10px;-moz-border-radius:10px;border-radius:10px;background:#11a0dc;margin-top:4px;\">\r\n	    <tr>\r\n		    <td>\r\n	            <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"560\" height=\"69\" align=\"center\">\r\n		            <tr>\r\n						<td width=\"4\">&nbsp;</td>\r\n<td width=\"210\" style=\"font-family:arial,sans-serif;font-size:12px;\" align=\"left\" valign=\"middle\">\r\n<div style=\"font-weight:bold;font-size:16px;color:black;\">This is Editable Text</div>\r\n<div style=\"font-weight:bold;font-size:22px;color:white;\">And So is This</div>\r\n</td>\r\n<td width=\"216\" align=\"right\" style=\"font-family:arial,sans-serif;\">\r\n <a href=\"http://www.mysite.com\" style=\"color:white;font-weight:bold;\">\r\n<img border=\"0\" alt=\"mysite.com\" width=\"216\" height=\"69\" src=\"http://www.css-oscommerce.com/images/mail_manager/blue-logo.jpg\"/></a>\r\n		                </td>\r\n		            </tr>\r\n		        </table>\r\n\r\n                <table width=\"570\" align=\"center\" cellpadding=\"10\" bgcolor=\"#FFFFFF\" style=\"background:#FFFFFF;-webkit-border-radius:10px;-moz-border-radius:10px;border-radius:10px;\">\r\n<tr>\r\n<td align=\"center\" width=\"190\" valign=\"top\" style=\"font-family:arial,sans-serif;font-size:12px;\">','</td>\r\n    				</tr>\r\n    			</table>				\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n		    <td><img src=\"http://www.css-oscommerce.com/images/mail_manager/blue-skyline.jpg\" style=\"vertical-align:bottom;\" width=\"600\" height=\"151\" alt=\"\"></td>\r\n		</tr>\r\n	</table>	\r\n<br/><br/>\r\n	<table cellspacing=\"0\" cellpadding=\"8\" border=\"0\" width=\"560\" align=\"center\">\r\n	    <tr>\r\n		    <td style=\"font-family:arial,sans-serif;font-size:12px;\">\r\n				<div style=\"color:#333333\">\r\n					<p>\r\nThis message was sent to the following e-mail address: myemail@me.com<br/>\r\n					We hope you found this message to be useful. However, if you\'d rather not receive future emails of this sort from CityScape, it\'s easy to <a href=\"http://www.mysite.com\">unsubscribe</a>.\r\n					</p>\r\n					<p>\r\n					Be sure to add MYSite@mysite.com to your address book or safe senders list so our emails get to your inbox.						\r\n					</p>\r\n					<p>\r\n					Note: This email was sent from a notification-only email address that cannot accept incoming email. Please do not reply to this email unless you really enjoy reading automated email replies. 	\r\n					</p>\r\n					<p>\r\n					&copy; 2011 MySite or its affiliates. All rights reserved. MySite and the MySiteLocal logo are trademarks of MySite.com, Inc. or its affiliates. MySiteLocal, 123 Madison Ave. New York, NY 10003. \r\n					</p>\r\n				</div>\r\n			</td>\r\n		</tr>\r\n	</table>			\r\n	\r\n	\r\n</td></tr></table>	\r\n<img src=\"http://www.css-oscommerce.com/images/mail_manager/transp.gif\" /></body>\r\n</html>','Today\'s Blue Local deal in Your Town','!-----------------------------------------------------------------------------\r\nThis message was sent to the following email address: myemail@me.com \r\nWe hope you found this message to be useful. However, if you\'d rather not\r\nreceive future emails of this sort from MySiteLocal, unsubscribe here:\r\nhttp://local.MySite.com \r\n(c) 2011 MySite or its affiliates. All rights reserved. MySite and\r\nthe MySite logo are trademarks of MySite.com, Inc. or its affiliates.\r\nMySite, 123 Madison Ave., New York, NY 10003.'),(16,'Cityscape','<!-- header /Table used to center email -->\r\n<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"660px\">\r\n	<tr>\r\n		<td bgcolor=\"#ffffff\">								\r\n		<div align=\"center\">\r\n		<!-- Table used to set width of email -->	\r\n		<span style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; color: #444444; font-weight: bold\" align=\"center\">							\r\n		Your CityScape Deal &nbsp; | &nbsp; <a href=\"http://mysite.com\">Go to MySite.com</a> &nbsp; | &nbsp; <a href=\"http://tracking.mysite.com\">Unsubscribe</a></span>&nbsp; &nbsp;&nbsp;\r\n		</div>\r\n		<div align=\"center\">\r\n		<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"660\">\r\n			<tr>\r\n				<td style=\"padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px\">																\r\n				<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">					<!--Preheader-->																		<!--Header-->																			<tr><td bgcolor=\"#e7e7e7\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">\r\n<tr><td width=\"286\" valign=\"bottom\">\r\n<img style=\"display: block; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; color: #444444\" src=\"http://www.css-oscommerce.com/images/mail_manager/cityscape_logo.jpg\" border=\"0\" alt=\"CityScape Deal\" width=\"286\" height=\"127\" /></td><td width=\"334\" valign=\"bottom\" style=\"padding-top: 0px; padding-right: 20px; padding-bottom: 0px; padding-left: 0px\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\"><tr><td style=\"padding-top: 0px; padding-right: 0px; padding-bottom: 10px; padding-left: 0px\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\"><tr><td height=\"117\" align=\"right\" valign=\"middle\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\"><tr></tr><tr><td align=\"right\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #444444; font-weight: bold\">Thursday, July 7,  2011<p>\r\n<a href=\"http://tracking.mysite.com\">See today&#39;s deal</a></p>\r\n</td></tr></table></td>	</tr></table></td>	</tr></table></td></tr></table>\r\n</td></tr><tr><td bgcolor=\"#000000\"><img style=\"display: block\" src=\"http://www.css-oscommerce.com/images/mail_manager/cityscape_divider.gif\" border=\"0\" alt=\"\" width=\"640\" height=\"28\" /></td>	</tr><tr>\r\n						<td style=\"padding-top: 20px; padding-right: 20px; padding-bottom: 20px; padding-left: 20px; background-repeat: no-repeat no-repeat\" bgcolor=\"#29c3f9\" background=\"http://www.css-oscommerce.com/images/mail_manager/cityscape_bg.gif\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\"><tr><td bgcolor=\"#ffffff\">','<!--footer--></td></tr></table>\r\n</td></tr><tr><td align=\"center\"><p><span style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; color: #444444; font-weight: bold\" align=\"center\">You are receiving this e-mail because you signed up for CityScape Deal Alerts. If you prefer not to receive CityScape e-mails, you can <a href=\"http://tracking.mysite.com\">unsubscribe with one click</a></span></p><p><span style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; color: #444444; font-weight: bold\" align=\"center\">This e-mail was delivered by CityScape 100 North Tower, Suite 123, New York NY 10003&nbsp;</span></p></td></tr></table></td></tr></table>\r\n		</div>\r\n		</td>				\r\n	</tr>\r\n</table>\r\n<!-- END Table used to center email --><custom name=\"opencounter\" type=\"tracking\"></custom>\r\n<img src=\"http://tracking.mysite.com\" width=1 height=1 border=0>','Mysite text Header','MySite text footer'),(20,'Bluesky','<table style=\"width: 700px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bgcolor=\"#ffffff\">\r\n  <tbody>\r\n    <tr>\r\n      <td colspan=\"6\">\r\n        <img src=\"http://www.css-oscommerce.com/images/mail_manager/bluesky_headover.jpg\" border=\"0\" alt=\"Headertop\" width=\"700\" height=\"25\" />\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n      <td colspan=\"6\">\r\n        <img src=\"http://www.css-oscommerce.com/images/mail_manager/bluesky_headunder.jpg\" border=\"0\" alt=\"Bluesky\" width=\"700\" height=\"83\" />\r\n      </td>\r\n    </tr>\r\n    <tr>\r\n       <td width=\"15\">&nbsp;</td>\r\n       <td width=\"653\" valign=\"top\" ><p><span style=\"font-size: 11px; line-height: 16px;\"  align=\"right\">\r\n<br/><br />','</span></p><br/ ><br/ ></td>\r\n      <td width=\"15\">&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td style=\"padding: 5px;\" colspan=\"4\" height=\"15\" align=\"center\" valign=\"middle\" bgcolor=\"#e3e2e7\">\r\n         <span style=\"font-size: 11px;\">Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus idut maxime placeat facere possimus</span>\r\n      </td>\r\n    </tr>\r\n    <tr>\r\n      <td style=\"padding-left: 10px; text-align: center;\" colspan=\"4\" height=\"50\" valign=\"middle\" bgcolor=\"#f4f3f5\">\r\n        <table border=\"0\" cellpadding=\"0\" align=\"center\">\r\n          <tbody>\r\n            <tr>\r\n              <td width=\"230\" height=\"118\" align=\"left\" valign=\"middle\">\r\n                <p><span style=\"font-size: 11px; line-height: 16px;\"  align=\"right\">Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus idut maxime placeat facere possimus.</span></p>\r\n              </td>\r\n              <td width=\"219\">\r\n                <p><span style=\"font-size: 11px; line-height: 16px;\">Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus idut maxime placeat facere possimus.</span></p>\r\n              </td>\r\n              <td width=\"230\" align=\"left\">\r\n                <span style=\"font-size: 11px;\">My Wonderful Store<br />202 Madison Ave, New York, NY 10001\r\n                <br />phone: 800-123-1234 | Fax: 202-123-1234\r\n                <br /><a title=\"E-mail mysite.com\" href=\"mailto:contact@mysite.com\">mysite@mysite.com</a>\r\n                <br />www.mysite.com</span>\r\n             </td>\r\n           </tr>\r\n           </tbody>\r\n        </table>\r\n     </td>\r\n   </tr>\r\n   <tr>\r\n      <td style=\"padding: 5px;\" colspan=\"4\" height=\"25\" align=\"center\" valign=\"middle\" bgcolor=\"#f4f3f5\">\r\n         <a href=\"http://www.oscommerce.com\">About Us</a> | \r\n         <a href=\"http://www.oscommerce.com\">Buy Something</a> | \r\n         <a href=\"http://www.oscommerce.com\">Donate</a> | \r\n         <a href=\"http://www.oscommerce.com\">Contact Us</a> | \r\n         <a href=\"http://www.oscommerce.com\">Privacy Policy</a> | \r\n         <a href=\"http://www.oscommerce.com\">Unsubscribe</a> | \r\n         <a title=\"Update Profile\" href=\"http://www.oscommerce.com\">Update Your Profile</a>\r\n         <br /><span style=\"font-size: 10px;\">&copy; Mysite. All rights reserved.</span>\r\n      </td>\r\n   </tr>\r\n   <tr>\r\n     <td colspan=\"4\" height=\"1\" bgcolor=\"#8a8a8a\">&nbsp;\r\n        <img src=\"http://www.css-oscommerce.com/images/mail_manager/bluesky_spacer.gif\" alt=\"\" /> </td>\r\n    </tr>\r\n    </tbody>\r\n </table>','My Store','Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus idut maxime placeat facere possimus.\r\n\r\n\r\nhttp://www.oscommerce.com\">About Us| \r\nhttp://www.oscommerce.com\">Buy Something | \r\nhttp://www.oscommerce.com\">Donate | \r\nhttp://www.oscommerce.com\">Contact Us | \r\nhttp://www.oscommerce.com\">Privacy Policy | \r\nhttp://www.oscommerce.com\">Unsubscribe | \r\nhttp://www.oscommerce.com\">Update Your Profile'),(18,'Choice','<html><head>\r\n		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n		<title>\r\n			Email Title\r\n		</title>\r\n	</head>\r\n	<body style=\"margin: 0;padding: 0;background-color: #ffffff;\">\r\n		<p>\r\n			<a name=\"top\" id=\"top\"></a>\r\n		</p>\r\n		<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n			<tr>\r\n				<td align=\"center\">\r\n					<table width=\"580\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n						<tr>\r\n							<td class=\"permission\" align=\"center\" style=\"padding: 20px 0 20px 0;\">\r\n								<p style=\"font-family: \'Lucida Grande\', sans-serif;font-size: 10px;font-weight: normal;color: #151515;\">\r\n									Add Team@My Site.org to your address book to make sure our email updates land in your inbox\r\n								</p>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td class=\"header\" style=\"padding: 16px;background-color: #f5f5f5;\">\r\n								<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"background-color: #f5f5f5;\">\r\n									<tr>\r\n										<td class=\"mainbar\" align=\"left\" valign=\"bottom\">\r\n											<a style=\"font-family: \'Lucida Grande\', sans-serif;font-size: 12px;font-weight: normal;color: #a72323;text-decoration: none;\" href=\"http://mailer2sg.mysite.org\"><img src=\"http://www.css-oscommerce.com/images/mail_manager/choice_logo.png\" alt=\"My SIte\" width=\"216\" height=\"115\" align=\"center\" style=\"border: none;\"></a>\r\n										</td>\r\n										<td align=\"right\">\r\n											<h1 style=\"font-family: Georgia, serif;font-family: \'Lucida Grande\', sans-serif;font-size: 20px;color: #7a7f23;font-weight: bold;\">\r\n												This is Editable Text\r\n											</h1>\r\n										</td>\r\n									</tr>\r\n									<tr>\r\n										<td class=\"header_bottom\" colspan=\"2\" style=\"border-bottom: 1px solid #CCCCCC;border-top: 1px solid #CCCCCC;font-size: 2px;\">\r\n											&nbsp;\r\n										</td>\r\n									</tr>\r\n								</table>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td>\r\n								<table width=\"580\" height=\"130\" border=\"0\" cellspacing=\"16\" cellpadding=\"0\" style=\"background-color: #f5f5f5;\">\r\n									<tr>\r\n										<td class=\"mainbar\" align=\"left\" valign=\"top\" width=\"580\">','</td>\r\n									</tr>\r\n								</table>\r\n							</td>\r\n						</tr>\r\n					</table>\r\n					<table width=\"646\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n						<tr>\r\n							<td>\r\n								<img src=\"http://www.css-oscommerce.com/images/mail_manager/choice_footer_tail.jpg\" alt=\"Footer\" width=\"646\" height=\"87\">\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td>\r\n								<table width=\"646\" height=\"20\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" >\r\n									<tr>\r\n										<td align=\"center\" valign=\"top\" width=\"313\">\r\n											<a href=\"http://mailer2sg.mysite.org\" style=\"color:#FFFFFF;text-decoration:underline;\"><img alt=\"Support us - Donate\" src=\"http://www.css-oscommerce.com/images/mail_manager/choice_donate.png\" style=\"border-width:0;vertical-align:bottom;\"></a> \r\n											\r\n											<a href=\"http://mailer2sg.mysite.org\" style=\"color:#FFFFFF;text-decoration:underline;\"><img alt=\"Follow us on Facebook\" src=\"http://www.css-oscommerce.com/images/mail_manager/choice_facebook.png\" style=\"border-width:0;vertical-align:bottom;\"></a>\r\n<a href=\"http://mailer2sg.catalogchoice.org\" style=\"color:#FFFFFF;text-decoration:underline;\"><img alt=\"Follow us on Twitter\" src=\"http://www.css-oscommerce.com/images/mail_manager/choice_twitter.png\" style=\"border-width:0;vertical-align:bottom;\"></a>\r\n<a href=\"http://mailer2sg.catalogchoice.org\" style=\"color:#FFFFFF;text-decoration:underline;\"><img alt=\"Read our Blog\" src=\"http://www.css-oscommerce.com/images/mail_manager/choice_blog.png\" style=\"border-width:0;vertical-align:bottom;\"></a>\r\n										</td>\r\n									</tr>\r\n								</table>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td align=\"center\" style=\"padding: 20px 0 20px 0;\">\r\n								<p style=\"font-family: \'Lucida Grande\', sans-serif;font-size: 10px;font-weight: normal;color: #151515;\">\r\n									Not interested anymore? <a class=\"button\" href=\"http://mailer2sg.mysite.org\" style=\"color:#36581F; font-size:11px; font-weight:normal; text-align:center; text-decoration: underline;\">Unsubscribe from our email here</a>\r\n								</p>\r\n								<p style=\"font-family: \'Lucida Grande\', sans-serif;font-size: 10px;font-weight: normal;color: #151515;\">\r\n									<span>My Site 123 Madison Ave, New York, NY 10003</span> <a href=\"http://mailer2sg.mysite.org/wf\" style=\"text-decoration:underline;color:#35511E;\">Privacy Policy</a>\r\n								</p>\r\n							</td>\r\n						</tr>\r\n					</table>\r\n				</td>\r\n			</tr>\r\n		</table>\r\n		<p>\r\n			<img src=\"http://www.css-oscommerce.com/images/mail_manager/choice_spacer.gif\">\r\n		</p>\r\n	\r\n<img src=\"http://www.css-oscommerce.com/images/mail_manager/choice_open.gif\" alt=\"\">\r\n</body>\r\n</html>','Add Team@mysite.org to your address book to make sure our\r\nemail updates land in your inbox\r\n\r\nCatalog Choice: Together We Make a Difference','P.S. Still getting unwanted mail or phone books? Log in to your\r\naccount and opt out.\r\n\r\nNot interested anymore? Unsubscribe from our email here\r\nhttps://www.mysite.org/mass_emails/423/unsubscribe\r\n\r\nMy Site 123 Madison Ave, New York, NY, 10003 Privacy\r\nPolicy http://www.mysite.org/privacy'),(19,'Email','<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n			<tr>\r\n				<td align=\"center\">\r\n					<table width=\"580\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n						<tr>\r\n							<td class=\"permission\" align=\"center\" style=\"padding: 20px 0 20px 0;\">\r\n								<p style=\"font-family: \'Lucida Grande\', sans-serif;font-size: 10px;font-weight: normal;color: #151515;\">\r\n									Add Team@mysite.org to your address book to make sure our email updates land in your inbox\r\n								</p>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td class=\"header\" style=\"padding: 16px;background-color: #f5f5f5;\">\r\n								<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"background-color: #f5f5f5;\">\r\n									<tr>\r\n										<td class=\"mainbar\" align=\"left\" valign=\"bottom\">\r\n											<a style=\"font-family: \'Lucida Grande\', sans-serif;font-size: 12px;font-weight: normal;color: #a72323;text-decoration: none;\" href=\"http://mailer2sg.mysite.org\"><img src=\"http://www.css-oscommerce.com/images/mail_manager/choice_logo.png\" alt=\"My Site\" width=\"179\" height=\"115\" align=\"center\" style=\"border: none;\"></a>\r\n										</td>\r\n										<td align=\"right\">\r\n											<h1 style=\"font-family: Georgia, serif;font-family: \'Lucida Grande\', sans-serif;font-size: 20px;color: #7a7f23;font-weight: bold;\">\r\n												Together We Make A Difference\r\n											</h1>\r\n										</td>\r\n									</tr>\r\n									<tr>\r\n										<td class=\"header_bottom\" colspan=\"2\" style=\"border-bottom: 1px solid #CCCCCC;border-top: 1px solid #CCCCCC;font-size: 2px;\">\r\n											&nbsp;\r\n										</td>\r\n									</tr>\r\n								</table>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td>\r\n								<table width=\"580\" height=\"130\" border=\"0\" cellspacing=\"16\" cellpadding=\"0\" style=\"background-color: #f5f5f5;\">\r\n									<tr>\r\n										<td class=\"mainbar\" align=\"left\" valign=\"top\" width=\"580\">\r\n<table width=\"400\" align=\"center\"><tr><td style=\"font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color: #666666; margin:7px 0px;\" width=\"50%\" align=\"left\" valign=\"top\">','</td></tr></table>\r\n</td>\r\n									</tr>\r\n								</table>\r\n							</td>\r\n						</tr>\r\n					</table>\r\n					<table width=\"646\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n						<tr>\r\n							<td>\r\n								<img src=\"http://www.css-oscommerce.com/images/mail_manager/choice_footer_tail.jpg\" alt=\"Footer\" width=\"646\" height=\"87\">\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td>\r\n								<table width=\"646\" height=\"20\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n									<tr>\r\n										<td align=\"center\" valign=\"top\" width=\"313\">\r\n											<a href=\"http://mailer2sg.catalogchoice.org\" style=\"color:#FFFFFF;text-decoration:underline;\"><img alt=\"Support us - Donate\" src=\"http://www.css-oscommerce.com/images/mail_manager/choice_donate.png\" style=\"border-width:0;vertical-align:bottom;\"></a> \r\n											\r\n											<a href=\"http://mailer2sg.catalogchoice.org\" style=\"color:#FFFFFF;text-decoration:underline;\"><img alt=\"Follow us on Facebook\" src=\"http://www.css-oscommerce.com/images/mail_manager/choice_facebook.png\" style=\"border-width:0;vertical-align:bottom;\"></a>\r\n<a href=\"http://mailer2sg.catalogchoice.org\" style=\"color:#FFFFFF;text-decoration:underline;\"><img alt=\"Follow us on Twitter\" src=\"http://www.css-oscommerce.com/images/mail_manager/choice_twitter.png\" style=\"border-width:0;vertical-align:bottom;\"></a>\r\n<a href=\"http://mailer2sg.catalogchoice.org\" style=\"color:#FFFFFF;text-decoration:underline;\"><img alt=\"Read our Blog\" src=\"http://www.css-oscommerce.com/images/mail_manager/choice_blog.png\" style=\"border-width:0;vertical-align:bottom;\"></a>\r\n										</td>\r\n									</tr>\r\n								</table>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td align=\"center\" style=\"padding: 20px 0 20px 0;\">\r\n								<p style=\"font-family: \'Lucida Grande\', sans-serif;font-size: 10px;font-weight: normal;color: #151515;\">\r\n									Not interested anymore? <a class=\"button\" href=\"http://mailer2sg.mysite.org\" style=\"color:#36581F; font-size:11px; font-weight:normal; text-align:center; text-decoration: underline;\">Unsubscribe from our email here</a>\r\n								</p>\r\n								<p style=\"font-family: \'Lucida Grande\', sans-serif;font-size: 10px;font-weight: normal;color: #151515;\">\r\n									<span>My Site 123 Madison Ave, New York, NY 10003</span> <a href=\"http://mailer2sg.catalogchoice.org/wf\" style=\"text-decoration:underline;color:#35511E;\">Privacy Policy</a>\r\n								</p>\r\n							</td>\r\n						</tr>\r\n					</table>\r\n				</td>\r\n			</tr>\r\n		</table>','','');
/*!40000 ALTER TABLE `mm_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `new_customer_id`
--

DROP TABLE IF EXISTS `new_customer_id`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `new_customer_id` (
  `customers_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` tinyint(4) NOT NULL,
  PRIMARY KEY (`customers_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `new_customer_id`
--

LOCK TABLES `new_customer_id` WRITE;
/*!40000 ALTER TABLE `new_customer_id` DISABLE KEYS */;
INSERT INTO `new_customer_id` VALUES (1,1);
/*!40000 ALTER TABLE `new_customer_id` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletters`
--

DROP TABLE IF EXISTS `newsletters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletters` (
  `newsletters_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `module` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_added` datetime NOT NULL,
  `date_sent` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `locked` int(1) DEFAULT '0',
  PRIMARY KEY (`newsletters_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletters`
--

LOCK TABLES `newsletters` WRITE;
/*!40000 ALTER TABLE `newsletters` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `orders_id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `customers_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customers_company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customers_vat_number` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customers_street_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customers_suburb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customers_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customers_postcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customers_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customers_country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customers_telephone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customers_email_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customers_address_format_id` int(5) NOT NULL,
  `customers_guest` int(1) NOT NULL DEFAULT '0',
  `delivery_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_vat_number` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_street_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_suburb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_postcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_address_format_id` int(5) NOT NULL,
  `billing_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_vat_number` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_street_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_suburb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_postcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `billing_address_format_id` int(5) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cc_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cc_owner` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cc_number` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cc_expires` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `date_purchased` datetime DEFAULT NULL,
  `orders_status` int(5) NOT NULL,
  `orders_date_finished` datetime DEFAULT NULL,
  `currency` char(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency_value` decimal(14,6) DEFAULT NULL,
  `customer_service_id` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_module` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`orders_id`),
  KEY `idx_orders_customers_id` (`customers_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_products`
--

DROP TABLE IF EXISTS `orders_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_products` (
  `orders_products_id` int(11) NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `products_model` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `products_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `products_price` decimal(15,4) NOT NULL,
  `final_price` decimal(15,4) NOT NULL,
  `products_tax` decimal(7,4) NOT NULL,
  `products_quantity` int(2) NOT NULL,
  PRIMARY KEY (`orders_products_id`),
  KEY `idx_orders_products_orders_id` (`orders_id`),
  KEY `idx_orders_products_products_id` (`products_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_products`
--

LOCK TABLES `orders_products` WRITE;
/*!40000 ALTER TABLE `orders_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_products_attributes`
--

DROP TABLE IF EXISTS `orders_products_attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_products_attributes` (
  `orders_products_attributes_id` int(11) NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL,
  `orders_products_id` int(11) NOT NULL,
  `products_options` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `products_options_values` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `options_values_price` decimal(15,4) NOT NULL,
  `price_prefix` char(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`orders_products_attributes_id`),
  KEY `idx_orders_products_att_orders_id` (`orders_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_products_attributes`
--

LOCK TABLES `orders_products_attributes` WRITE;
/*!40000 ALTER TABLE `orders_products_attributes` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders_products_attributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_products_download`
--

DROP TABLE IF EXISTS `orders_products_download`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_products_download` (
  `orders_products_download_id` int(11) NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL DEFAULT '0',
  `orders_products_id` int(11) NOT NULL DEFAULT '0',
  `orders_products_filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `download_maxdays` int(2) NOT NULL DEFAULT '0',
  `download_count` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`orders_products_download_id`),
  KEY `idx_orders_products_download_orders_id` (`orders_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_products_download`
--

LOCK TABLES `orders_products_download` WRITE;
/*!40000 ALTER TABLE `orders_products_download` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders_products_download` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_status`
--

DROP TABLE IF EXISTS `orders_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_status` (
  `orders_status_id` int(11) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '1',
  `orders_status_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `public_flag` int(11) DEFAULT '1',
  `downloads_flag` int(11) DEFAULT '0',
  PRIMARY KEY (`orders_status_id`,`language_id`),
  KEY `idx_orders_status_name` (`orders_status_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_status`
--

LOCK TABLES `orders_status` WRITE;
/*!40000 ALTER TABLE `orders_status` DISABLE KEYS */;
INSERT INTO `orders_status` VALUES (1,1,'Pending',1,0),(1,4,'Nevyřízená',1,0),(2,1,'Processing',1,0),(2,4,'Zpracovává se',1,0),(3,1,'Cancelled',1,0),(3,4,'Zrušená',1,0),(4,1,'Waiting for payment',1,0),(4,4,'Čeká na připsání platby',1,0),(5,1,'Odesláno na dobírku',1,0),(5,4,'Odesláno na dobírku',1,0),(6,1,'Dobírka vrácena',1,0),(6,4,'Dobírka vrácena',1,0),(7,1,'Preparing [PayPal IPN]',1,0),(7,4,'Preparing [PayPal IPN]',1,0),(8,1,'PayPal [Transactions]',1,0),(8,4,'PayPal [Transactions]',1,0),(9,1,'No delivery',1,0),(9,4,'Osobní odběr',1,0),(10,1,'Shipped [Payment in advance]',1,1),(10,4,'Odesláno [Platba předem]',1,1),(101,1,'Delivered',1,1),(101,4,'Vyřízená',1,1),(102,1,'Paid by PayPal',1,1),(102,4,'Zaplaceno PayPal',1,1),(103,1,'Authorize.net [Transactions]',0,0),(103,4,'Authorize.net [Transactions]',0,0);
/*!40000 ALTER TABLE `orders_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_status_history`
--

DROP TABLE IF EXISTS `orders_status_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_status_history` (
  `orders_status_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL,
  `orders_status_id` int(5) NOT NULL,
  `date_added` datetime NOT NULL,
  `customer_notified` int(1) DEFAULT '0',
  `comments` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`orders_status_history_id`),
  KEY `idx_orders_status_history_orders_id` (`orders_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_status_history`
--

LOCK TABLES `orders_status_history` WRITE;
/*!40000 ALTER TABLE `orders_status_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders_status_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_total`
--

DROP TABLE IF EXISTS `orders_total`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_total` (
  `orders_total_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` decimal(15,4) NOT NULL,
  `class` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`orders_total_id`),
  KEY `idx_orders_total_orders_id` (`orders_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_total`
--

LOCK TABLES `orders_total` WRITE;
/*!40000 ALTER TABLE `orders_total` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders_total` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_templates`
--

DROP TABLE IF EXISTS `product_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_templates` (
  `product_template_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_template_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`product_template_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_templates`
--

LOCK TABLES `product_templates` WRITE;
/*!40000 ALTER TABLE `product_templates` DISABLE KEYS */;
INSERT INTO `product_templates` VALUES (1,'product'),(2,'article - reviews FALSE'),(3,'article - reviews TRUE'),(4,'reference');
/*!40000 ALTER TABLE `product_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `products_id` int(11) NOT NULL AUTO_INCREMENT,
  `products_quantity` int(4) NOT NULL,
  `products_model` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `products_image` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `products_price` decimal(15,4) NOT NULL,
  `products_date_added` datetime NOT NULL,
  `products_last_modified` datetime DEFAULT NULL,
  `products_date_available` datetime DEFAULT NULL,
  `products_weight` decimal(5,2) NOT NULL,
  `products_status` tinyint(1) NOT NULL,
  `products_tax_class_id` int(11) NOT NULL,
  `manufacturers_id` int(11) DEFAULT NULL,
  `products_ordered` int(11) NOT NULL DEFAULT '0',
  `products_custom_date` datetime DEFAULT NULL,
  `products_sort_order` int(10) DEFAULT NULL,
  `product_template` int(2) DEFAULT NULL,
  PRIMARY KEY (`products_id`),
  KEY `idx_products_model` (`products_model`),
  KEY `idx_products_date_available` (`products_date_available`),
  KEY `idx_products_custom_date` (`products_custom_date`),
  KEY `idx_products_sort_order` (`products_sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_attributes`
--

DROP TABLE IF EXISTS `products_attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_attributes` (
  `products_attributes_id` int(11) NOT NULL AUTO_INCREMENT,
  `products_id` int(11) NOT NULL,
  `options_id` int(11) NOT NULL,
  `options_values_id` int(11) NOT NULL,
  `options_values_price` decimal(15,4) NOT NULL,
  `price_prefix` char(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`products_attributes_id`),
  KEY `idx_products_attributes_products_id` (`products_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_attributes`
--

LOCK TABLES `products_attributes` WRITE;
/*!40000 ALTER TABLE `products_attributes` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_attributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_attributes_download`
--

DROP TABLE IF EXISTS `products_attributes_download`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_attributes_download` (
  `products_attributes_id` int(11) NOT NULL,
  `products_attributes_filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `products_attributes_maxdays` int(2) DEFAULT '0',
  `products_attributes_maxcount` int(2) DEFAULT '0',
  PRIMARY KEY (`products_attributes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_attributes_download`
--

LOCK TABLES `products_attributes_download` WRITE;
/*!40000 ALTER TABLE `products_attributes_download` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_attributes_download` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_description`
--

DROP TABLE IF EXISTS `products_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_description` (
  `products_id` int(11) NOT NULL AUTO_INCREMENT,
  `cached` int(1) DEFAULT '0',
  `cached_admin` int(1) DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '1',
  `products_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `products_alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `products_description` text COLLATE utf8_unicode_ci,
  `products_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `products_viewed` int(5) DEFAULT '0',
  `products_seo_title` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `products_seo_description` text COLLATE utf8_unicode_ci,
  `products_seo_keywords` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `products_mini_description` text COLLATE utf8_unicode_ci,
  `products_head_title_tag` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `products_head_title_tag_alt` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `products_head_title_tag_url` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `products_head_desc_tag` varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL,
  `products_head_keywords_tag` text COLLATE utf8_unicode_ci,
  `products_head_listing_text` text COLLATE utf8_unicode_ci,
  `products_head_sub_text` text COLLATE utf8_unicode_ci,
  `products_head_breadcrumb_text` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`products_id`,`language_id`),
  KEY `products_name` (`products_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_description`
--

LOCK TABLES `products_description` WRITE;
/*!40000 ALTER TABLE `products_description` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_images`
--

DROP TABLE IF EXISTS `products_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `products_id` int(11) NOT NULL,
  `image` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `htmlcontent` text COLLATE utf8_unicode_ci,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `products_images_prodid` (`products_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_images`
--

LOCK TABLES `products_images` WRITE;
/*!40000 ALTER TABLE `products_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_notifications`
--

DROP TABLE IF EXISTS `products_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_notifications` (
  `products_id` int(11) NOT NULL,
  `customers_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`products_id`,`customers_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_notifications`
--

LOCK TABLES `products_notifications` WRITE;
/*!40000 ALTER TABLE `products_notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_options`
--

DROP TABLE IF EXISTS `products_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_options` (
  `products_options_id` int(11) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '1',
  `products_options_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`products_options_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_options`
--

LOCK TABLES `products_options` WRITE;
/*!40000 ALTER TABLE `products_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_options_values`
--

DROP TABLE IF EXISTS `products_options_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_options_values` (
  `products_options_values_id` int(11) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '1',
  `products_options_values_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`products_options_values_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_options_values`
--

LOCK TABLES `products_options_values` WRITE;
/*!40000 ALTER TABLE `products_options_values` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_options_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_options_values_to_products_options`
--

DROP TABLE IF EXISTS `products_options_values_to_products_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_options_values_to_products_options` (
  `products_options_values_to_products_options_id` int(11) NOT NULL AUTO_INCREMENT,
  `products_options_id` int(11) NOT NULL,
  `products_options_values_id` int(11) NOT NULL,
  PRIMARY KEY (`products_options_values_to_products_options_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_options_values_to_products_options`
--

LOCK TABLES `products_options_values_to_products_options` WRITE;
/*!40000 ALTER TABLE `products_options_values_to_products_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_options_values_to_products_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_to_categories`
--

DROP TABLE IF EXISTS `products_to_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_to_categories` (
  `products_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `canonical` int(1) DEFAULT NULL,
  PRIMARY KEY (`products_id`,`categories_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_to_categories`
--

LOCK TABLES `products_to_categories` WRITE;
/*!40000 ALTER TABLE `products_to_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_to_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reset`
--

DROP TABLE IF EXISTS `reset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reset` (
  `section` varchar(4) COLLATE utf8_unicode_ci DEFAULT 'all',
  `lang` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin` varchar(10) COLLATE utf8_unicode_ci DEFAULT 'shop',
  `reset` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reset`
--

LOCK TABLES `reset` WRITE;
/*!40000 ALTER TABLE `reset` DISABLE KEYS */;
INSERT INTO `reset` VALUES ('all','cs','admin',1),('all','cs','shop',1),('all','en','shop',1),('all','en','admin',1),('all','de','admin',1),('all','de','shop',1),('all','es','shop',1),('all','es','admin',1),('all','fr','admin',1),('all','fr','shop',1);
/*!40000 ALTER TABLE `reset` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `reviews_id` int(11) NOT NULL AUTO_INCREMENT,
  `products_id` int(11) NOT NULL,
  `customers_id` int(11) DEFAULT NULL,
  `customers_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reviews_rating` int(1) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `reviews_status` tinyint(1) NOT NULL DEFAULT '0',
  `reviews_read` int(5) NOT NULL DEFAULT '0',
  `is_testimonial` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`reviews_id`),
  KEY `idx_reviews_products_id` (`products_id`),
  KEY `idx_reviews_customers_id` (`customers_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews_description`
--

DROP TABLE IF EXISTS `reviews_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews_description` (
  `reviews_id` int(11) NOT NULL,
  `languages_id` int(11) NOT NULL,
  `reviews_text` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`reviews_id`,`languages_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews_description`
--

LOCK TABLES `reviews_description` WRITE;
/*!40000 ALTER TABLE `reviews_description` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviews_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `robot`
--

DROP TABLE IF EXISTS `robot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `robot` (
  `nowtime` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin` varchar(10) DEFAULT 'shop'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `robot`
--

LOCK TABLES `robot` WRITE;
/*!40000 ALTER TABLE `robot` DISABLE KEYS */;
/*!40000 ALTER TABLE `robot` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sec_directory_whitelist`
--

DROP TABLE IF EXISTS `sec_directory_whitelist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sec_directory_whitelist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `directory` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sec_directory_whitelist`
--

LOCK TABLES `sec_directory_whitelist` WRITE;
/*!40000 ALTER TABLE `sec_directory_whitelist` DISABLE KEYS */;
INSERT INTO `sec_directory_whitelist` VALUES (1,'admin/backups'),(2,'admin/images/graphs'),(3,'images'),(4,'images/banners'),(5,'includes/work'),(6,'pub');
/*!40000 ALTER TABLE `sec_directory_whitelist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seo_friendly_urls`
--

DROP TABLE IF EXISTS `seo_friendly_urls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seo_friendly_urls` (
  `seo_friendly_urls_id` int(11) NOT NULL AUTO_INCREMENT,
  `seo_friendly_urls_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_friendly_urls_value` text COLLATE utf8_unicode_ci NOT NULL,
  `seo_friendly_urls_date` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`seo_friendly_urls_id`),
  UNIQUE KEY `seo_friendly_urls_key` (`seo_friendly_urls_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seo_friendly_urls`
--

LOCK TABLES `seo_friendly_urls` WRITE;
/*!40000 ALTER TABLE `seo_friendly_urls` DISABLE KEYS */;
/*!40000 ALTER TABLE `seo_friendly_urls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `sesskey` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `expiry` int(11) unsigned NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`sesskey`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specials`
--

DROP TABLE IF EXISTS `specials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specials` (
  `specials_id` int(11) NOT NULL AUTO_INCREMENT,
  `products_id` int(11) NOT NULL,
  `specials_new_products_price` decimal(15,4) NOT NULL,
  `specials_date_added` datetime DEFAULT NULL,
  `specials_last_modified` datetime DEFAULT NULL,
  `expires_date` datetime DEFAULT NULL,
  `date_status_change` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`specials_id`),
  KEY `idx_specials_products_id` (`products_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specials`
--

LOCK TABLES `specials` WRITE;
/*!40000 ALTER TABLE `specials` DISABLE KEYS */;
/*!40000 ALTER TABLE `specials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tax_class`
--

DROP TABLE IF EXISTS `tax_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tax_class` (
  `tax_class_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_class_title` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `tax_class_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_modified` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`tax_class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tax_class`
--

LOCK TABLES `tax_class` WRITE;
/*!40000 ALTER TABLE `tax_class` DISABLE KEYS */;
INSERT INTO `tax_class` VALUES (1,'VAT (DPH) 15%','cz VAT 15%','2015-12-19 14:54:46','2015-12-19 14:54:46'),(2,'VAT (DPH) 21%','cz VAT 21%','2015-12-19 14:54:46','2015-12-19 14:54:46'),(3,'VAT (DPH) 10%','cz VAT 10%','2015-12-19 14:54:46','2015-12-19 14:54:46');
/*!40000 ALTER TABLE `tax_class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tax_rates`
--

DROP TABLE IF EXISTS `tax_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tax_rates` (
  `tax_rates_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_zone_id` int(11) NOT NULL,
  `tax_class_id` int(11) NOT NULL,
  `tax_priority` int(5) DEFAULT '1',
  `tax_rate` decimal(7,4) NOT NULL,
  `tax_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_modified` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`tax_rates_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tax_rates`
--

LOCK TABLES `tax_rates` WRITE;
/*!40000 ALTER TABLE `tax_rates` DISABLE KEYS */;
INSERT INTO `tax_rates` VALUES (1,1,1,1,15.0000,'VAT (DPH) 15%','2015-12-19 14:54:46','2015-12-19 14:54:46'),(2,1,2,2,21.0000,'cz VAT (DPH) 21%','2015-12-19 14:54:46','2015-12-19 14:54:46'),(3,1,3,3,10.0000,'cz VAT (DPH) 10%','2015-12-19 14:54:46','2015-12-19 14:54:46');
/*!40000 ALTER TABLE `tax_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topics` (
  `topics_id` int(11) NOT NULL AUTO_INCREMENT,
  `topics_image` varchar(64) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `sort_order` int(12) DEFAULT '1',
  `date_added` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`topics_id`),
  KEY `idx_topics_parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topics`
--

LOCK TABLES `topics` WRITE;
/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
/*!40000 ALTER TABLE `topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topics_description`
--

DROP TABLE IF EXISTS `topics_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topics_description` (
  `topics_id` int(11) NOT NULL DEFAULT '0',
  `cached` int(1) DEFAULT '0',
  `cached_admin` int(1) DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '1',
  `topics_name` varchar(32) NOT NULL DEFAULT '',
  `topics_heading_title` varchar(64) DEFAULT NULL,
  `topics_description` text,
  `topics_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`topics_id`,`language_id`),
  KEY `idx_topics_name` (`topics_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topics_description`
--

LOCK TABLES `topics_description` WRITE;
/*!40000 ALTER TABLE `topics_description` DISABLE KEYS */;
/*!40000 ALTER TABLE `topics_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usu_cache`
--

DROP TABLE IF EXISTS `usu_cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usu_cache` (
  `cache_name` varchar(64) NOT NULL,
  `cache_data` mediumtext NOT NULL,
  `cache_date` datetime NOT NULL,
  UNIQUE KEY `cache_name` (`cache_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usu_cache`
--

LOCK TABLES `usu_cache` WRITE;
/*!40000 ALTER TABLE `usu_cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `usu_cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `whos_online`
--

DROP TABLE IF EXISTS `whos_online`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `whos_online` (
  `customer_id` int(11) DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `session_id` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `time_entry` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `time_last_click` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `last_page_url` text COLLATE utf8_unicode_ci NOT NULL,
  KEY `idx_whos_online_session_id` (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `whos_online`
--

LOCK TABLES `whos_online` WRITE;
/*!40000 ALTER TABLE `whos_online` DISABLE KEYS */;
INSERT INTO `whos_online` VALUES (0,'Guest','0eqas7070eob7ebp9ph8p9nor1','127.0.0.1','1513208260','1513210616','/');
/*!40000 ALTER TABLE `whos_online` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zones`
--

DROP TABLE IF EXISTS `zones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zones` (
  `zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_country_id` int(11) NOT NULL,
  `zone_code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `zone_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`zone_id`),
  KEY `idx_zones_country_id` (`zone_country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=922 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zones`
--

LOCK TABLES `zones` WRITE;
/*!40000 ALTER TABLE `zones` DISABLE KEYS */;
INSERT INTO `zones` VALUES (1,223,'AL','Alabama'),(2,223,'AK','Alaska'),(3,223,'AS','American Samoa'),(4,223,'AZ','Arizona'),(5,223,'AR','Arkansas'),(6,223,'AF','Armed Forces Africa'),(7,223,'AA','Armed Forces Americas'),(8,223,'AC','Armed Forces Canada'),(9,223,'AE','Armed Forces Europe'),(10,223,'AM','Armed Forces Middle East'),(11,223,'AP','Armed Forces Pacific'),(12,223,'CA','California'),(13,223,'CO','Colorado'),(14,223,'CT','Connecticut'),(15,223,'DE','Delaware'),(16,223,'DC','District of Columbia'),(17,223,'FM','Federated States Of Micronesia'),(18,223,'FL','Florida'),(19,223,'GA','Georgia'),(20,223,'GU','Guam'),(21,223,'HI','Hawaii'),(22,223,'ID','Idaho'),(23,223,'IL','Illinois'),(24,223,'IN','Indiana'),(25,223,'IA','Iowa'),(26,223,'KS','Kansas'),(27,223,'KY','Kentucky'),(28,223,'LA','Louisiana'),(29,223,'ME','Maine'),(30,223,'MH','Marshall Islands'),(31,223,'MD','Maryland'),(32,223,'MA','Massachusetts'),(33,223,'MI','Michigan'),(34,223,'MN','Minnesota'),(35,223,'MS','Mississippi'),(36,223,'MO','Missouri'),(37,223,'MT','Montana'),(38,223,'NE','Nebraska'),(39,223,'NV','Nevada'),(40,223,'NH','New Hampshire'),(41,223,'NJ','New Jersey'),(42,223,'NM','New Mexico'),(43,223,'NY','New York'),(44,223,'NC','North Carolina'),(45,223,'ND','North Dakota'),(46,223,'MP','Northern Mariana Islands'),(47,223,'OH','Ohio'),(48,223,'OK','Oklahoma'),(49,223,'OR','Oregon'),(50,223,'PW','Palau'),(51,223,'PA','Pennsylvania'),(52,223,'PR','Puerto Rico'),(53,223,'RI','Rhode Island'),(54,223,'SC','South Carolina'),(55,223,'SD','South Dakota'),(56,223,'TN','Tennessee'),(57,223,'TX','Texas'),(58,223,'UT','Utah'),(59,223,'VT','Vermont'),(60,223,'VI','Virgin Islands'),(61,223,'VA','Virginia'),(62,223,'WA','Washington'),(63,223,'WV','West Virginia'),(64,223,'WI','Wisconsin'),(65,223,'WY','Wyoming'),(908,56,'US','Ústecký'),(909,56,'JC','Jihočeský'),(910,56,'JM','Jihomoravský'),(911,56,'KA','Karlovarský'),(912,56,'KR','Královéhradecký'),(913,56,'LI','Liberecký'),(914,56,'MO','Moravskoslezský'),(915,56,'OL','Olomoucký'),(916,56,'PA','Pardubický'),(917,56,'PL','Plzeňský'),(918,56,'PR','Hlavní město Praha'),(919,56,'ST','Středočeský'),(920,56,'VY','Vysočina'),(921,56,'ZL','Zlínský');
/*!40000 ALTER TABLE `zones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zones_to_geo_zones`
--

DROP TABLE IF EXISTS `zones_to_geo_zones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zones_to_geo_zones` (
  `association_id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_country_id` int(11) NOT NULL,
  `zone_id` int(11) DEFAULT NULL,
  `geo_zone_id` int(11) DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`association_id`),
  KEY `idx_zones_to_geo_zones_country_id` (`zone_country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zones_to_geo_zones`
--

LOCK TABLES `zones_to_geo_zones` WRITE;
/*!40000 ALTER TABLE `zones_to_geo_zones` DISABLE KEYS */;
INSERT INTO `zones_to_geo_zones` VALUES (1,14,0,1,NULL,'2015-12-19 14:54:46'),(2,21,0,1,NULL,'2015-12-19 14:54:46'),(3,33,0,1,NULL,'2015-12-19 14:54:46'),(4,53,0,1,NULL,'2015-12-19 14:54:46'),(5,55,0,1,NULL,'2015-12-19 14:54:46'),(6,56,0,1,NULL,'2015-12-19 14:54:46'),(7,57,0,1,NULL,'2015-12-19 14:54:46'),(8,67,0,1,NULL,'2015-12-19 14:54:46'),(9,72,0,1,NULL,'2015-12-19 14:54:46'),(10,73,0,1,NULL,'2015-12-19 14:54:46'),(11,81,0,1,NULL,'2015-12-19 14:54:46'),(12,84,0,1,NULL,'2015-12-19 14:54:46'),(13,97,0,1,NULL,'2015-12-19 14:54:46'),(14,103,0,1,NULL,'2015-12-19 14:54:46'),(15,105,0,1,NULL,'2015-12-19 14:54:46'),(16,117,0,1,NULL,'2015-12-19 14:54:46'),(17,123,0,1,NULL,'2015-12-19 14:54:46'),(18,124,0,1,NULL,'2015-12-19 14:54:46'),(19,132,0,1,NULL,'2015-12-19 14:54:46'),(20,150,0,1,NULL,'2015-12-19 14:54:46'),(21,170,0,1,NULL,'2015-12-19 14:54:46'),(22,171,0,1,NULL,'2015-12-19 14:54:46'),(23,175,0,1,NULL,'2015-12-19 14:54:46'),(24,189,0,1,NULL,'2015-12-19 14:54:46'),(25,190,0,1,NULL,'2015-12-19 14:54:46'),(26,195,0,1,NULL,'2015-12-19 14:54:46'),(27,203,0,1,NULL,'2015-12-19 14:54:46'),(28,222,0,1,NULL,'2015-12-19 14:54:46'),(29,56,0,2,NULL,'2017-12-10 03:46:44');
/*!40000 ALTER TABLE `zones_to_geo_zones` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-14  1:38:27
