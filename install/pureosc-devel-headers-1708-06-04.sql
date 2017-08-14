-- MySQL dump 10.13  Distrib 5.5.49, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: pureoscdevel
-- ------------------------------------------------------
-- Server version	5.5.49-0+deb8u1

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `action_recorder`
--

LOCK TABLES `action_recorder` WRITE;
/*!40000 ALTER TABLE `action_recorder` DISABLE KEYS */;
INSERT INTO `action_recorder` VALUES (1,'ar_admin_login',1,'fprint2','77.87.240.6','1','2017-06-14 14:55:36'),(2,'ar_admin_login',2,'miprint2','77.87.240.6','1','2017-06-14 15:01:15'),(3,'ar_admin_login',1,'fprint2','37.188.191.242','1','2017-06-18 22:08:53'),(4,'ar_admin_login',2,'miprint2','77.87.240.6','1','2017-06-22 10:37:55'),(5,'ar_admin_login',2,'miprint2','77.87.240.6','1','2017-06-22 10:38:17'),(6,'ar_admin_login',2,'miprint2','37.188.183.172','1','2017-06-23 14:23:28'),(7,'ar_admin_login',2,'miprint2','37.188.183.172','1','2017-06-23 16:59:36'),(8,'ar_admin_login',2,'miprint2','77.87.240.6','1','2017-06-26 17:32:20'),(9,'ar_admin_login',2,'miprint2','77.87.240.6','1','2017-07-03 12:47:25'),(10,'ar_admin_login',1,'fprint2','77.87.240.4','1','2017-07-17 17:10:50'),(11,'ar_admin_login',2,'miprint2','77.87.240.4','1','2017-07-22 15:01:46'),(12,'ar_admin_login',1,'fprint2','77.87.240.4','1','2017-07-22 15:07:52'),(13,'ar_admin_login',1,'fprint2','77.87.240.4','1','2017-07-24 13:06:17'),(14,'ar_admin_login',1,'fprint2','37.188.165.217','1','2017-07-28 00:46:26'),(15,'ar_admin_login',1,'fprint2','37.188.149.91','1','2017-08-03 19:10:52'),(16,'ar_admin_login',1,'fprint2','37.188.143.220','1','2017-08-06 02:01:24');
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
  `entry_gender` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entry_company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entry_vat_number` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entry_firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `entry_lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `entry_street_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `entry_suburb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entry_postcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `entry_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL AUTO_INCREMENT,
  `categories_image` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `sort_order` int(3) DEFAULT NULL,
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
  `language_id` int(11) NOT NULL DEFAULT '1',
  `categories_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `categories_description` text COLLATE utf8_unicode_ci,
  `categories_seo_title` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `categories_seo_description` text COLLATE utf8_unicode_ci,
  `categories_seo_keywords` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `categories_alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
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
) ENGINE=InnoDB AUTO_INCREMENT=481 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuration`
--

LOCK TABLES `configuration` WRITE;
/*!40000 ALTER TABLE `configuration` DISABLE KEYS */;
INSERT INTO `configuration` VALUES (1,'Store Name','STORE_NAME','PureOSC','The name of my store',1,1,NULL,'2017-06-14 14:55:15',NULL,NULL),(2,'Store Owner','STORE_OWNER','PureHTML','The name of my store owner',1,2,NULL,'2017-06-14 14:55:15',NULL,NULL),(3,'E-Mail Address','STORE_OWNER_EMAIL_ADDRESS','root@localhost','The e-mail address of my store owner',1,3,NULL,'2017-06-14 14:55:15',NULL,NULL),(4,'E-Mail From','EMAIL_FROM','osCommerce <root@localhost>','The e-mail address used in (sent) e-mails',1,4,NULL,'2017-06-14 14:55:15',NULL,NULL),(5,'Country','STORE_COUNTRY','56','The country my store is located in <br /><br /><strong>Note: Please remember to update the store zone.</strong>',1,6,NULL,'2017-06-14 14:55:15','tep_get_country_name','tep_cfg_pull_down_country_list('),(6,'Zone','STORE_ZONE','918','The zone my store is located in',1,7,NULL,'2017-06-14 14:55:15','tep_cfg_get_zone_name','tep_cfg_pull_down_zone_list('),(7,'Expected Sort Order','EXPECTED_PRODUCTS_SORT','desc','This is the sort order used in the expected products box.',1,8,NULL,'2017-06-14 14:55:15',NULL,'tep_cfg_select_option(array(\'asc\', \'desc\'), '),(8,'Expected Sort Field','EXPECTED_PRODUCTS_FIELD','date_expected','The column to sort by in the expected products box.',1,9,NULL,'2017-06-14 14:55:15',NULL,'tep_cfg_select_option(array(\'products_name\', \'date_expected\'), '),(9,'Switch To Default Language Currency','USE_DEFAULT_LANGUAGE_CURRENCY','true','Automatically switch to the language\'s currency when it is changed',1,10,NULL,'2017-06-14 14:55:15',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(10,'Send Extra Order Emails To','SEND_EXTRA_ORDER_EMAILS_TO','','Send extra order emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;',1,11,NULL,'2017-06-14 14:55:15',NULL,NULL),(11,'Use Search-Engine Safe URLs','SEARCH_ENGINE_FRIENDLY_URLS','false','Use search-engine safe urls for all site links',1,12,NULL,'2017-06-14 14:55:15',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(12,'Display Cart After Adding Product','DISPLAY_CART','true','Display the shopping cart after adding a product (or return back to their origin)',1,14,NULL,'2017-06-14 14:55:15',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(13,'Allow Guest To Tell A Friend','ALLOW_GUEST_TO_TELL_A_FRIEND','false','Allow guests to tell a friend about a product',1,15,NULL,'2017-06-14 14:55:15',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(14,'Default Search Operator','ADVANCED_SEARCH_DEFAULT_OPERATOR','and','Default search operators',1,17,NULL,'2017-06-14 14:55:15',NULL,'tep_cfg_select_option(array(\'and\', \'or\'), '),(15,'Store Address','STORE_ADDRESS','Address Line 1\nAddress Line 2\nCountry\nPhone','This is the Address of my store used on printable documents and displayed online',1,18,NULL,'2017-06-14 14:55:15',NULL,'tep_cfg_textarea('),(16,'Store Phone','STORE_PHONE','555-1234','This is the phone number of my store used on printable documents and displayed online',1,19,NULL,'2017-06-14 14:55:15',NULL,'tep_cfg_textarea('),(17,'Tax Decimal Places','TAX_DECIMAL_PLACES','0','Pad the tax value this amount of decimal places',1,20,NULL,'2017-06-14 14:55:15',NULL,NULL),(18,'Display Prices with Tax','DISPLAY_PRICE_WITH_TAX','true','Display prices with tax included (true) or add the tax at the end (false)',1,21,NULL,'2017-06-14 14:55:15',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(19,'New products Sort Order','NEW_PRODUCTS_SORT_ORDER','products_date_available DESC, products_date_added DESC','Example settings: \"products_date_available DESC, products_date_added DESC\" OR for Date Products \"products_custom_date\"',1,22,NULL,'2017-06-14 14:55:15',NULL,NULL),(20,'Default URL with www','USE_WWW','false','Default URL: www.site.com',1,23,NULL,'2017-06-14 14:55:15',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(21,'Default product template','DEFAULT_PRODUCT_TEMPLATE','4','1=product, 2=article',1,24,'2017-06-19 10:56:03','2017-06-14 14:55:15',NULL,NULL),(22,'First Name','ENTRY_FIRST_NAME_MIN_LENGTH','2','Minimum length of first name',2,1,NULL,'2017-06-14 14:55:15',NULL,NULL),(23,'Last Name','ENTRY_LAST_NAME_MIN_LENGTH','2','Minimum length of last name',2,2,NULL,'2017-06-14 14:55:15',NULL,NULL),(24,'Date of Birth','ENTRY_DOB_MIN_LENGTH','10','Minimum length of date of birth',2,3,NULL,'2017-06-14 14:55:15',NULL,NULL),(25,'E-Mail Address','ENTRY_EMAIL_ADDRESS_MIN_LENGTH','6','Minimum length of e-mail address',2,4,NULL,'2017-06-14 14:55:15',NULL,NULL),(26,'Street Address','ENTRY_STREET_ADDRESS_MIN_LENGTH','5','Minimum length of street address',2,5,NULL,'2017-06-14 14:55:15',NULL,NULL),(27,'Company','ENTRY_COMPANY_MIN_LENGTH','2','Minimum length of company name',2,6,NULL,'2017-06-14 14:55:15',NULL,NULL),(28,'Post Code','ENTRY_POSTCODE_MIN_LENGTH','4','Minimum length of post code',2,7,NULL,'2017-06-14 14:55:15',NULL,NULL),(29,'City','ENTRY_CITY_MIN_LENGTH','3','Minimum length of city',2,8,NULL,'2017-06-14 14:55:15',NULL,NULL),(30,'State','ENTRY_STATE_MIN_LENGTH','2','Minimum length of state',2,9,NULL,'2017-06-14 14:55:15',NULL,NULL),(31,'Telephone Number','ENTRY_TELEPHONE_MIN_LENGTH','3','Minimum length of telephone number',2,10,NULL,'2017-06-14 14:55:15',NULL,NULL),(32,'Password','ENTRY_PASSWORD_MIN_LENGTH','5','Minimum length of password',2,11,NULL,'2017-06-14 14:55:15',NULL,NULL),(33,'Credit Card Owner Name','CC_OWNER_MIN_LENGTH','3','Minimum length of credit card owner name',2,12,NULL,'2017-06-14 14:55:15',NULL,NULL),(34,'Credit Card Number','CC_NUMBER_MIN_LENGTH','10','Minimum length of credit card number',2,13,NULL,'2017-06-14 14:55:15',NULL,NULL),(35,'Review Text','REVIEW_TEXT_MIN_LENGTH','50','Minimum length of review text',2,14,NULL,'2017-06-14 14:55:15',NULL,NULL),(36,'Best Sellers','MIN_DISPLAY_BESTSELLERS','1','Minimum number of best sellers to display',2,15,NULL,'2017-06-14 14:55:15',NULL,NULL),(37,'Also Purchased','MIN_DISPLAY_ALSO_PURCHASED','1','Minimum number of products to display in the \'This Customer Also Purchased\' box',2,16,NULL,'2017-06-14 14:55:15',NULL,NULL),(38,'Address Book Entries','MAX_ADDRESS_BOOK_ENTRIES','5','Maximum address book entries a customer is allowed to have',3,1,NULL,'2017-06-14 14:55:15',NULL,NULL),(39,'Search Results','MAX_DISPLAY_SEARCH_RESULTS','20','Amount of products to list',3,2,NULL,'2017-06-14 14:55:15',NULL,NULL),(40,'Page Links','MAX_DISPLAY_PAGE_LINKS','5','Number of \'number\' links use for page-sets',3,3,NULL,'2017-06-14 14:55:15',NULL,NULL),(41,'Special Products','MAX_DISPLAY_SPECIAL_PRODUCTS','9','Maximum number of products on special to display',3,4,NULL,'2017-06-14 14:55:15',NULL,NULL),(42,'New Products Module','MAX_DISPLAY_NEW_PRODUCTS','9','Maximum number of new products to display in a category',3,5,NULL,'2017-06-14 14:55:15',NULL,NULL),(43,'Products Expected','MAX_DISPLAY_UPCOMING_PRODUCTS','10','Maximum number of products expected to display',3,6,NULL,'2017-06-14 14:55:15',NULL,NULL),(44,'Manufacturers List','MAX_DISPLAY_MANUFACTURERS_IN_A_LIST','0','Used in manufacturers box; when the number of manufacturers exceeds this number, a drop-down list will be displayed instead of the default list',3,7,NULL,'2017-06-14 14:55:15',NULL,NULL),(45,'Manufacturers Select Size','MAX_MANUFACTURERS_LIST','1','Used in manufacturers box; when this value is \'1\' the classic drop-down list will be used for the manufacturers box. Otherwise, a list-box with the specified number of rows will be displayed.',3,7,NULL,'2017-06-14 14:55:15',NULL,NULL),(46,'Length of Manufacturers Name','MAX_DISPLAY_MANUFACTURER_NAME_LEN','15','Used in manufacturers box; maximum length of manufacturers name to display',3,8,NULL,'2017-06-14 14:55:15',NULL,NULL),(47,'New Reviews','MAX_DISPLAY_NEW_REVIEWS','6','Maximum number of new reviews to display',3,9,NULL,'2017-06-14 14:55:15',NULL,NULL),(48,'Selection of Random Reviews','MAX_RANDOM_SELECT_REVIEWS','10','How many records to select from to choose one random product review',3,10,NULL,'2017-06-14 14:55:15',NULL,NULL),(49,'Selection of Random New Products','MAX_RANDOM_SELECT_NEW','10','How many records to select from to choose one random new product to display',3,11,NULL,'2017-06-14 14:55:15',NULL,NULL),(50,'Selection of Products on Special','MAX_RANDOM_SELECT_SPECIALS','10','How many records to select from to choose one random product special to display',3,12,NULL,'2017-06-14 14:55:15',NULL,NULL),(51,'Categories To List Per Row','MAX_DISPLAY_CATEGORIES_PER_ROW','3','How many categories to list per row',3,13,NULL,'2017-06-14 14:55:15',NULL,NULL),(52,'New Products Listing','MAX_DISPLAY_PRODUCTS_NEW','10','Maximum number of new products to display in new products page',3,14,NULL,'2017-06-14 14:55:15',NULL,NULL),(53,'Best Sellers','MAX_DISPLAY_BESTSELLERS','10','Maximum number of best sellers to display',3,15,NULL,'2017-06-14 14:55:15',NULL,NULL),(54,'Also Purchased','MAX_DISPLAY_ALSO_PURCHASED','6','Maximum number of products to display in the \'This Customer Also Purchased\' box',3,16,NULL,'2017-06-14 14:55:15',NULL,NULL),(55,'Customer Order History Box','MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX','6','Maximum number of products to display in the customer order history box',3,17,NULL,'2017-06-14 14:55:15',NULL,NULL),(56,'Order History','MAX_DISPLAY_ORDER_HISTORY','10','Maximum number of orders to display in the order history page',3,18,NULL,'2017-06-14 14:55:15',NULL,NULL),(57,'Product Quantities In Shopping Cart','MAX_QTY_IN_CART','99','Maximum number of product quantities that can be added to the shopping cart (0 for no limit)',3,19,NULL,'2017-06-14 14:55:15',NULL,NULL),(58,'Small Image Width','SMALL_IMAGE_WIDTH','100','The pixel width of small images',4,1,NULL,'2017-06-14 14:55:15',NULL,NULL),(59,'Small Image Height','SMALL_IMAGE_HEIGHT','80','The pixel height of small images',4,2,NULL,'2017-06-14 14:55:15',NULL,NULL),(60,'Heading Image Width','HEADING_IMAGE_WIDTH','57','The pixel width of heading images',4,3,NULL,'2017-06-14 14:55:15',NULL,NULL),(61,'Heading Image Height','HEADING_IMAGE_HEIGHT','40','The pixel height of heading images',4,4,NULL,'2017-06-14 14:55:15',NULL,NULL),(62,'Subcategory Image Width','SUBCATEGORY_IMAGE_WIDTH','100','The pixel width of subcategory images',4,5,NULL,'2017-06-14 14:55:15',NULL,NULL),(63,'Subcategory Image Height','SUBCATEGORY_IMAGE_HEIGHT','57','The pixel height of subcategory images',4,6,NULL,'2017-06-14 14:55:15',NULL,NULL),(64,'Calculate Image Size','CONFIG_CALCULATE_IMAGE_SIZE','true','Calculate the size of images?',4,7,NULL,'2017-06-14 14:55:15',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(65,'Image Required','IMAGE_REQUIRED','true','Enable to display broken images. Good for development.',4,8,NULL,'2017-06-14 14:55:15',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(66,'Gender','ACCOUNT_GENDER','false','Display gender in the customers account',5,1,NULL,'2017-06-14 14:55:15',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(67,'Date of Birth','ACCOUNT_DOB','false','Display date of birth in the customers account',5,2,NULL,'2017-06-14 14:55:15',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(68,'Company','ACCOUNT_COMPANY','true','Display company in the customers account',5,3,NULL,'2017-06-14 14:55:15',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(69,'Suburb','ACCOUNT_SUBURB','false','Display suburb in the customers account',5,4,NULL,'2017-06-14 14:55:15',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(70,'State','ACCOUNT_STATE','false','Display state in the customers account',5,5,NULL,'2017-06-14 14:55:15',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(71,'Installed Modules','MODULE_PAYMENT_INSTALLED','cod.php;paypal_express.php','List of payment module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: cod.php;paypal_express.php)',6,0,NULL,'2017-06-14 14:55:15',NULL,NULL),(72,'Installed Modules','MODULE_ORDER_TOTAL_INSTALLED','ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_total.php','List of order_total module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_total.php)',6,0,NULL,'2017-06-14 14:55:15',NULL,NULL),(73,'Installed Modules','MODULE_SHIPPING_INSTALLED','flat.php','List of shipping module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: ups.php;flat.php;item.php)',6,0,NULL,'2017-06-14 14:55:15',NULL,NULL),(74,'Installed Modules','MODULE_ACTION_RECORDER_INSTALLED','ar_admin_login.php;ar_contact_us.php;ar_reset_password.php;ar_tell_a_friend.php','List of action recorder module filenames separated by a semi-colon. This is automatically updated. No need to edit.',6,0,NULL,'2017-06-14 14:55:15',NULL,NULL),(75,'Installed Modules','MODULE_SOCIAL_BOOKMARKS_INSTALLED','sb_email.php;sb_facebook.php;sb_google_plus_share.php;sb_pinterest.php;sb_twitter.php','List of social bookmark module filenames separated by a semi-colon. This is automatically updated. No need to edit.',6,0,NULL,'2017-06-14 14:55:15',NULL,NULL),(76,'Enable Cash On Delivery Module','MODULE_PAYMENT_COD_STATUS','True','Do you want to accept Cash On Delevery payments?',6,1,NULL,'2017-06-14 14:55:15',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(77,'Payment Zone','MODULE_PAYMENT_COD_ZONE','0','If a zone is selected, only enable this payment method for that zone.',6,2,NULL,'2017-06-14 14:55:15','tep_get_zone_class_title','tep_cfg_pull_down_zone_classes('),(78,'Sort order of display.','MODULE_PAYMENT_COD_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:15',NULL,NULL),(79,'Set Order Status','MODULE_PAYMENT_COD_ORDER_STATUS_ID','0','Set the status of orders made with this payment module to this value',6,0,NULL,'2017-06-14 14:55:15','tep_get_order_status_name','tep_cfg_pull_down_order_statuses('),(80,'Enable Flat Shipping','MODULE_SHIPPING_FLAT_STATUS','True','Do you want to offer flat rate shipping?',6,0,NULL,'2017-06-14 14:55:15',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(81,'Shipping Cost','MODULE_SHIPPING_FLAT_COST','5.00','The shipping cost for all orders using this shipping method.',6,0,NULL,'2017-06-14 14:55:15',NULL,NULL),(82,'Tax Class','MODULE_SHIPPING_FLAT_TAX_CLASS','0','Use the following tax class on the shipping fee.',6,0,NULL,'2017-06-14 14:55:15','tep_get_tax_class_title','tep_cfg_pull_down_tax_classes('),(83,'Shipping Zone','MODULE_SHIPPING_FLAT_ZONE','0','If a zone is selected, only enable this shipping method for that zone.',6,0,NULL,'2017-06-14 14:55:15','tep_get_zone_class_title','tep_cfg_pull_down_zone_classes('),(84,'Sort Order','MODULE_SHIPPING_FLAT_SORT_ORDER','0','Sort order of display.',6,0,NULL,'2017-06-14 14:55:15',NULL,NULL),(85,'Default Currency','DEFAULT_CURRENCY','CZK','Default Currency',6,0,NULL,'2017-06-14 14:55:15',NULL,NULL),(86,'Default Language','DEFAULT_LANGUAGE','cs','Default Language',6,0,NULL,'2017-06-14 14:55:15',NULL,NULL),(87,'Default Order Status For New Orders','DEFAULT_ORDERS_STATUS_ID','1','When a new order is created, this order status will be assigned to it.',6,0,NULL,'2017-06-14 14:55:15',NULL,NULL),(88,'Display Shipping','MODULE_ORDER_TOTAL_SHIPPING_STATUS','true','Do you want to display the order shipping cost?',6,1,NULL,'2017-06-14 14:55:15',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(89,'Sort Order','MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER','2','Sort order of display.',6,2,NULL,'2017-06-14 14:55:15',NULL,NULL),(90,'Allow Free Shipping','MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING','false','Do you want to allow free shipping?',6,3,NULL,'2017-06-14 14:55:15',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(91,'Free Shipping For Orders Over','MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER','50','Provide free shipping for orders over the set amount.',6,4,NULL,'2017-06-14 14:55:15','currencies->format',NULL),(92,'Provide Free Shipping For Orders Made','MODULE_ORDER_TOTAL_SHIPPING_DESTINATION','national','Provide free shipping for orders sent to the set destination.',6,5,NULL,'2017-06-14 14:55:15',NULL,'tep_cfg_select_option(array(\'national\', \'international\', \'both\'), '),(93,'Display Sub-Total','MODULE_ORDER_TOTAL_SUBTOTAL_STATUS','true','Do you want to display the order sub-total cost?',6,1,NULL,'2017-06-14 14:55:15',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(94,'Sort Order','MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER','1','Sort order of display.',6,2,NULL,'2017-06-14 14:55:15',NULL,NULL),(95,'Display Tax','MODULE_ORDER_TOTAL_TAX_STATUS','true','Do you want to display the order tax value?',6,1,NULL,'2017-06-14 14:55:15',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(96,'Sort Order','MODULE_ORDER_TOTAL_TAX_SORT_ORDER','3','Sort order of display.',6,2,NULL,'2017-06-14 14:55:15',NULL,NULL),(97,'Display Total','MODULE_ORDER_TOTAL_TOTAL_STATUS','true','Do you want to display the total order value?',6,1,NULL,'2017-06-14 14:55:15',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(98,'Sort Order','MODULE_ORDER_TOTAL_TOTAL_SORT_ORDER','4','Sort order of display.',6,2,NULL,'2017-06-14 14:55:15',NULL,NULL),(99,'Minimum Minutes Per E-Mail','MODULE_ACTION_RECORDER_CONTACT_US_EMAIL_MINUTES','15','Minimum number of minutes to allow 1 e-mail to be sent (eg, 15 for 1 e-mail every 15 minutes)',6,0,NULL,'2017-06-14 14:55:15',NULL,NULL),(100,'Minimum Minutes Per E-Mail','MODULE_ACTION_RECORDER_TELL_A_FRIEND_EMAIL_MINUTES','15','Minimum number of minutes to allow 1 e-mail to be sent (eg, 15 for 1 e-mail every 15 minutes)',6,0,NULL,'2017-06-14 14:55:15',NULL,NULL),(101,'Allowed Minutes','MODULE_ACTION_RECORDER_ADMIN_LOGIN_MINUTES','5','Number of minutes to allow login attempts to occur.',6,0,NULL,'2017-06-14 14:55:15',NULL,NULL),(102,'Allowed Attempts','MODULE_ACTION_RECORDER_ADMIN_LOGIN_ATTEMPTS','3','Number of login attempts to allow within the specified period.',6,0,NULL,'2017-06-14 14:55:15',NULL,NULL),(103,'Allowed Minutes','MODULE_ACTION_RECORDER_RESET_PASSWORD_MINUTES','5','Number of minutes to allow password resets to occur.',6,0,NULL,'2017-06-14 14:55:15',NULL,NULL),(104,'Allowed Attempts','MODULE_ACTION_RECORDER_RESET_PASSWORD_ATTEMPTS','1','Number of password reset attempts to allow within the specified period.',6,0,NULL,'2017-06-14 14:55:16',NULL,NULL),(105,'Enable E-Mail Module','MODULE_SOCIAL_BOOKMARKS_EMAIL_STATUS','True','Do you want to allow products to be shared through e-mail?',6,1,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(106,'Sort Order','MODULE_SOCIAL_BOOKMARKS_EMAIL_SORT_ORDER','10','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:16',NULL,NULL),(107,'Enable Google+ Share Module','MODULE_SOCIAL_BOOKMARKS_GOOGLE_PLUS_SHARE_STATUS','True','Do you want to allow products to be shared through Google+?',6,1,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(108,'Annotation','MODULE_SOCIAL_BOOKMARKS_GOOGLE_PLUS_SHARE_ANNOTATION','None','The annotation to display next to the button.',6,1,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'Inline\', \'Bubble\', \'Vertical-Bubble\', \'None\'), '),(109,'Width','MODULE_SOCIAL_BOOKMARKS_GOOGLE_PLUS_SHARE_WIDTH','','The maximum width of the button.',6,0,NULL,'2017-06-14 14:55:16',NULL,NULL),(110,'Height','MODULE_SOCIAL_BOOKMARKS_GOOGLE_PLUS_SHARE_HEIGHT','15','Sets the height of the button.',6,1,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'15\', \'20\', \'24\', \'60\'), '),(111,'Alignment','MODULE_SOCIAL_BOOKMARKS_GOOGLE_PLUS_SHARE_ALIGN','Left','The alignment of the button assets.',6,1,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'Left\', \'Right\'), '),(112,'Sort Order','MODULE_SOCIAL_BOOKMARKS_GOOGLE_PLUS_SHARE_SORT_ORDER','20','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:16',NULL,NULL),(113,'Enable Facebook Module','MODULE_SOCIAL_BOOKMARKS_FACEBOOK_STATUS','True','Do you want to allow products to be shared through Facebook?',6,1,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(114,'Sort Order','MODULE_SOCIAL_BOOKMARKS_FACEBOOK_SORT_ORDER','30','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:16',NULL,NULL),(115,'Enable Twitter Module','MODULE_SOCIAL_BOOKMARKS_TWITTER_STATUS','True','Do you want to allow products to be shared through Twitter?',6,1,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(116,'Sort Order','MODULE_SOCIAL_BOOKMARKS_TWITTER_SORT_ORDER','40','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:16',NULL,NULL),(117,'Enable Pinterest Module','MODULE_SOCIAL_BOOKMARKS_PINTEREST_STATUS','True','Do you want to allow Pinterest Button?',6,1,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(118,'Layout Position','MODULE_SOCIAL_BOOKMARKS_PINTEREST_BUTTON_COUNT_POSITION','None','Horizontal or Vertical or None',6,2,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'Horizontal\', \'Vertical\', \'None\'), '),(119,'Sort Order','MODULE_SOCIAL_BOOKMARKS_PINTEREST_SORT_ORDER','50','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:16',NULL,NULL),(120,'Country of Origin','SHIPPING_ORIGIN_COUNTRY','223','Select the country of origin to be used in shipping quotes.',7,1,NULL,'2017-06-14 14:55:16','tep_get_country_name','tep_cfg_pull_down_country_list('),(121,'Postal Code','SHIPPING_ORIGIN_ZIP','NONE','Enter the Postal Code (ZIP) of the Store to be used in shipping quotes.',7,2,NULL,'2017-06-14 14:55:16',NULL,NULL),(122,'Enter the Maximum Package Weight you will ship','SHIPPING_MAX_WEIGHT','50','Carriers have a max weight limit for a single package. This is a common one for all.',7,3,NULL,'2017-06-14 14:55:16',NULL,NULL),(123,'Package Tare weight.','SHIPPING_BOX_WEIGHT','3','What is the weight of typical packaging of small to medium packages?',7,4,NULL,'2017-06-14 14:55:16',NULL,NULL),(124,'Larger packages - percentage increase.','SHIPPING_BOX_PADDING','10','For 10% enter 10',7,5,NULL,'2017-06-14 14:55:16',NULL,NULL),(125,'Allow Orders Not Matching Defined Shipping Zones ','SHIPPING_ALLOW_UNDEFINED_ZONES','False','Should orders be allowed to shipping addresses not matching defined shipping module shipping zones?',7,5,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(126,'Display Product Image','PRODUCT_LIST_IMAGE','1','Do you want to display the Product Image?',8,1,NULL,'2017-06-14 14:55:16',NULL,NULL),(127,'Display Product Manufacturer Name','PRODUCT_LIST_MANUFACTURER','0','Do you want to display the Product Manufacturer Name?',8,2,NULL,'2017-06-14 14:55:16',NULL,NULL),(128,'Display Product Model','PRODUCT_LIST_MODEL','0','Do you want to display the Product Model?',8,3,NULL,'2017-06-14 14:55:16',NULL,NULL),(129,'Display Product Name','PRODUCT_LIST_NAME','2','Do you want to display the Product Name?',8,4,NULL,'2017-06-14 14:55:16',NULL,NULL),(130,'Display Product Price','PRODUCT_LIST_PRICE','3','Do you want to display the Product Price',8,5,NULL,'2017-06-14 14:55:16',NULL,NULL),(131,'Display Product Quantity','PRODUCT_LIST_QUANTITY','0','Do you want to display the Product Quantity?',8,6,NULL,'2017-06-14 14:55:16',NULL,NULL),(132,'Display Product Weight','PRODUCT_LIST_WEIGHT','0','Do you want to display the Product Weight?',8,7,NULL,'2017-06-14 14:55:16',NULL,NULL),(133,'Display Buy Now column','PRODUCT_LIST_BUY_NOW','4','Do you want to display the Buy Now column?',8,8,NULL,'2017-06-14 14:55:16',NULL,NULL),(134,'Date available sort key','PRODUCT_LIST_DATE_AVAILABLE','9','Sort by date available',8,9,NULL,'2017-06-14 14:55:16',NULL,NULL),(135,'Custom date sort key','PRODUCT_LIST_CUSTOM_DATE','10','Sort by event date',8,10,NULL,'2017-06-14 14:55:16',NULL,NULL),(136,'Sort order sort key','PRODUCT_LIST_SORT_ORDER','11','Sort by sort order',8,11,NULL,'2017-06-14 14:55:16',NULL,NULL),(137,'Default sort order','PRODUCT_LIST_DEFAULT_SORT_ORDER','products_date_available DESC, products_date_added DESC, products_name','Example settings: \"products_date_available DESC, products_date_added DESC, products_name\" OR \"products_custom_date\" OR \"products_sort_order, products_name\"',8,12,NULL,'2017-06-14 14:55:16',NULL,NULL),(138,'Display Category/Manufacturer Filter (0=disable; 1=enable)','PRODUCT_LIST_FILTER','1','Do you want to display the Category/Manufacturer Filter?',8,12,NULL,'2017-06-14 14:55:16',NULL,NULL),(139,'Location of Prev/Next Navigation Bar (1-top, 2-bottom, 3-both)','PREV_NEXT_BAR_LOCATION','2','Sets the location of the Prev/Next Navigation Bar (1-top, 2-bottom, 3-both)',8,13,NULL,'2017-06-14 14:55:16',NULL,NULL),(140,'Check stock level','STOCK_CHECK','true','Check to see if sufficent stock is available',9,1,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(141,'Subtract stock','STOCK_LIMITED','true','Subtract product in stock by product orders',9,2,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(142,'Allow Checkout','STOCK_ALLOW_CHECKOUT','true','Allow customer to checkout even if there is insufficient stock',9,3,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(143,'Mark product out of stock','STOCK_MARK_PRODUCT_OUT_OF_STOCK','***','Display something on screen so customer can see which product has insufficient stock',9,4,NULL,'2017-06-14 14:55:16',NULL,NULL),(144,'Stock Re-order level','STOCK_REORDER_LEVEL','5','Define when stock needs to be re-ordered',9,5,NULL,'2017-06-14 14:55:16',NULL,NULL),(145,'Store Page Parse Time','STORE_PAGE_PARSE_TIME','false','Store the time it takes to parse a page',10,1,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(146,'Log Destination','STORE_PAGE_PARSE_TIME_LOG','/var/log/www/tep/page_parse_time.log','Directory and filename of the page parse time log',10,2,NULL,'2017-06-14 14:55:16',NULL,NULL),(147,'Log Date Format','STORE_PARSE_DATE_TIME_FORMAT','%d/%m/%Y %H:%M:%S','The date format',10,3,NULL,'2017-06-14 14:55:16',NULL,NULL),(148,'Display The Page Parse Time','DISPLAY_PAGE_PARSE_TIME','true','Display the page parse time (store page parse time must be enabled)',10,4,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(149,'Store Database Queries','STORE_DB_TRANSACTIONS','false','Store the database queries in the page parse time log',10,5,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(150,'Use Cache','USE_CACHE','false','Use caching features',11,1,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(151,'Cache Directory','DIR_FS_CACHE','/tmp/','The directory where the cached files are saved',11,2,NULL,'2017-06-14 14:55:16',NULL,NULL),(152,'E-Mail Transport Method','EMAIL_TRANSPORT','sendmail','Defines if this server uses a local connection to sendmail or uses an SMTP connection via TCP/IP. Servers running on Windows and MacOS should change this setting to SMTP.',12,1,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'sendmail\', \'smtp\', \'gmail\'),'),(153,'E-Mail Linefeeds','EMAIL_LINEFEED','LF','Defines the character sequence used to separate mail headers.',12,2,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'LF\', \'CRLF\'),'),(154,'Use MIME HTML When Sending Emails','EMAIL_USE_HTML','false','Send e-mails in HTML format',12,3,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(155,'Verify E-Mail Addresses Through DNS','ENTRY_EMAIL_ADDRESS_CHECK','false','Verify e-mail address through a DNS server',12,4,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(156,'Send E-Mails','SEND_EMAILS','true','Send out e-mails',12,5,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(157,'SMTP hosts','EMAIL_SMTP_HOSTS','','Assign SMTP host senders',12,6,NULL,'2017-06-14 14:55:16',NULL,NULL),(158,'SMTP authentication','EMAIL_SMTP_AUTHENTICATION','true','Do you want authenticated SMTP server?',12,7,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(159,'SMTP Password','EMAIL_SMTP_PASSWORD','','Add SMTP Password for SMTP protocol',12,8,NULL,'2017-06-14 14:55:16','tep_cfg_password','tep_cfg_input_password('),(160,'SMTP User','EMAIL_SMTP_USER','','Add SMTP user for SMTP protocol',12,9,NULL,'2017-06-14 14:55:16',NULL,NULL),(161,'SMTP Reply To','EMAIL_SMTP_REPLYTO','','Add SMTP reply to address',12,10,NULL,'2017-06-14 14:55:16',NULL,NULL),(162,'Enable download','DOWNLOAD_ENABLED','false','Enable the products download functions.',13,1,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(163,'Download by redirect','DOWNLOAD_BY_REDIRECT','false','Use browser redirection for download. Disable on non-Unix systems.',13,2,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(164,'Expiry delay (days)','DOWNLOAD_MAX_DAYS','7','Set number of days before the download link expires. 0 means no limit.',13,3,NULL,'2017-06-14 14:55:16',NULL,''),(165,'Maximum number of downloads','DOWNLOAD_MAX_COUNT','5','Set the maximum number of downloads. 0 means no download authorized.',13,4,NULL,'2017-06-14 14:55:16',NULL,''),(166,'Enable GZip Compression','GZIP_COMPRESSION','false','Enable HTTP GZip compression.',14,1,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(167,'Compression Level','GZIP_LEVEL','5','Use this compression level 0-9 (0 = minimum, 9 = maximum).',14,2,NULL,'2017-06-14 14:55:16',NULL,NULL),(168,'Session Directory','SESSION_WRITE_DIRECTORY','/tmp','If sessions are file based, store them in this directory.',15,1,NULL,'2017-06-14 14:55:16',NULL,NULL),(169,'Force Cookie Use','SESSION_FORCE_COOKIE_USE','False','Force the use of sessions when cookies are only enabled.',15,2,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(170,'Check SSL Session ID','SESSION_CHECK_SSL_SESSION_ID','False','Validate the SSL_SESSION_ID on every secure HTTPS page request.',15,3,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(171,'Check User Agent','SESSION_CHECK_USER_AGENT','False','Validate the clients browser user agent on every page request.',15,4,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(172,'Check IP Address','SESSION_CHECK_IP_ADDRESS','False','Validate the clients IP address on every page request.',15,5,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(173,'Prevent Spider Sessions','SESSION_BLOCK_SPIDERS','True','Prevent known spiders from starting a session.',15,6,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(174,'Recreate Session','SESSION_RECREATE','True','Recreate the session to generate a new session ID when the customer logs on or creates an account (PHP >=4.1 needed).',15,7,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(175,'Last Update Check Time','LAST_UPDATE_CHECK_TIME','','Last time a check for new versions of osCommerce was run',6,0,NULL,'2017-06-14 14:55:16',NULL,NULL),(176,'Store Logo','STORE_LOGO','store_logo.png','This is the filename of your Store Logo.  This should be updated at admin > configuration > Store Logo',6,1000,NULL,'2017-06-14 14:55:16',NULL,NULL),(177,'Bootstrap Container','BOOTSTRAP_CONTAINER','container','What type of container should the page content be shown in? See http://getbootstrap.com/css/#overview-container',16,1,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'container-fluid\', \'container\'), '),(178,'Bootstrap Content','BOOTSTRAP_CONTENT','8','What width should the page content default to?  (8 = two thirds width, 6 = half width, 4 = one third width) Note that the Side Column(s) will adjust automatically.',16,2,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'8\', \'6\', \'4\'), '),(179,'Display products DateAvailable (expected)','DISPLAY_DATE_AVAILABLE','true','Display products DateAvailable (expected)?',17,1,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(180,'Display products custom date','DISPLAY_PRODUCTS_CUSTOM_DATE','true','Display products custom/events date?',17,2,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(181,'Display products sort order','DISPLAY_PRODUCTS_SORT_ORDER','true','Display products sort order?',17,3,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(182,'Display products manfacturer','DISPLAY_PRODUCTS_MANUFACTURER','true','Display products manfacturer',17,4,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(183,'Display products SEO title','DISPLAY_PRODUCTS_SEO_TITLE','true','Display products SEO title?',17,5,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(184,'Display Tax Class','DISPLAY_PRODUCTS_TAX_CLASS','true','Display Tax Class?',17,5,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(185,'Display Mini description','DISPLAY_PRODUCTS_MINI_DESCRIPTION','true','Display Mini description?',17,6,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(186,'Display products quantity','DISPLAY_PRODUCTS_QUANTITY','true','Display products quantity?',17,7,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(187,'Display products Model','DISPLAY_PRODUCTS_MODEL','true','Display products Model?',17,8,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(188,'Display products URL','DISPLAY_PRODUCTS_URL','true','Display products URL?',17,9,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(189,'Display products weight','DISPLAY_PRODUCTS_WEIGHT','true','Display products weight?',17,10,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(190,'Display products SEO description','DISPLAY_PRODUCTS_SEO_DESCRIPTION','true','Display products SEO description?',17,11,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(191,'Display products SEO keywords','DISPLAY_PRODUCTS_SEO_KEYWORDS','true','Display products SEO keywords?',17,12,NULL,'2017-06-14 14:55:16',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(192,'Enable PayPal Express Checkout','MODULE_PAYMENT_PAYPAL_EXPRESS_STATUS','True','Do you want to accept PayPal Express Checkout payments?',6,1,NULL,'2017-06-14 14:55:18',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(193,'Seller Account','MODULE_PAYMENT_PAYPAL_EXPRESS_SELLER_ACCOUNT','','The email address of the seller account if no API credentials has been setup.',6,0,NULL,'2017-06-14 14:55:18',NULL,NULL),(194,'API Username','MODULE_PAYMENT_PAYPAL_EXPRESS_API_USERNAME','','The username to use for the PayPal API service',6,0,NULL,'2017-06-14 14:55:18',NULL,NULL),(195,'API Password','MODULE_PAYMENT_PAYPAL_EXPRESS_API_PASSWORD','','The password to use for the PayPal API service',6,0,NULL,'2017-06-14 14:55:18',NULL,NULL),(196,'API Signature','MODULE_PAYMENT_PAYPAL_EXPRESS_API_SIGNATURE','','The signature to use for the PayPal API service',6,0,NULL,'2017-06-14 14:55:18',NULL,NULL),(197,'PayPal Account Optional','MODULE_PAYMENT_PAYPAL_EXPRESS_ACCOUNT_OPTIONAL','False','This must also be enabled in your PayPal account, in Profile > Website Payment Preferences.',6,0,NULL,'2017-06-14 14:55:18',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(198,'PayPal Instant Update','MODULE_PAYMENT_PAYPAL_EXPRESS_INSTANT_UPDATE','True','Support PayPal shipping and tax calculations on the PayPal.com site during Express Checkout.',6,0,NULL,'2017-06-14 14:55:18',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(199,'PayPal Checkout Image','MODULE_PAYMENT_PAYPAL_EXPRESS_CHECKOUT_IMAGE','Static','Use static or dynamic Express Checkout image buttons. Dynamic images are used with PayPal campaigns.',6,0,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'Static\', \'Dynamic\'), '),(200,'Page Style','MODULE_PAYMENT_PAYPAL_EXPRESS_PAGE_STYLE','','The page style to use for the checkout flow (defined at your PayPal Profile page)',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(201,'Transaction Method','MODULE_PAYMENT_PAYPAL_EXPRESS_TRANSACTION_METHOD','Sale','The processing method to use for each transaction.',6,0,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'Authorization\', \'Sale\'), '),(202,'Set Order Status','MODULE_PAYMENT_PAYPAL_EXPRESS_ORDER_STATUS_ID','0','Set the status of orders made with this payment module to this value',6,0,NULL,'2017-06-14 14:55:19','tep_get_order_status_name','tep_cfg_pull_down_order_statuses('),(203,'PayPal Transactions Order Status Level','MODULE_PAYMENT_PAYPAL_EXPRESS_TRANSACTIONS_ORDER_STATUS_ID','4','Include PayPal transaction information in this order status level',6,0,NULL,'2017-06-14 14:55:19','tep_get_order_status_name','tep_cfg_pull_down_order_statuses('),(204,'Payment Zone','MODULE_PAYMENT_PAYPAL_EXPRESS_ZONE','0','If a zone is selected, only enable this payment method for that zone.',6,2,NULL,'2017-06-14 14:55:19','tep_get_zone_class_title','tep_cfg_pull_down_zone_classes('),(205,'Transaction Server','MODULE_PAYMENT_PAYPAL_EXPRESS_TRANSACTION_SERVER','Live','Use the live or testing (sandbox) gateway server to process transactions?',6,0,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'Live\', \'Sandbox\'), '),(206,'Verify SSL Certificate','MODULE_PAYMENT_PAYPAL_EXPRESS_VERIFY_SSL','True','Verify gateway server SSL certificate on connection?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(207,'Proxy Server','MODULE_PAYMENT_PAYPAL_EXPRESS_PROXY','','Send API requests through this proxy server. (host:port, eg: 123.45.67.89:8080 or proxy.example.com:8080)',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(208,'Debug E-Mail Address','MODULE_PAYMENT_PAYPAL_EXPRESS_DEBUG_EMAIL','','All parameters of an invalid transaction will be sent to this email address.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(209,'Sort order of display.','MODULE_PAYMENT_PAYPAL_EXPRESS_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(210,'Installed Modules','MODULE_HEADER_TAGS_INSTALLED','ht_manufacturer_title.php;ht_category_title.php;ht_product_title.php;ht_canonical.php;ht_robot_noindex.php;ht_datepicker_jquery.php;ht_grid_list_view.php;ht_table_click_jquery.php;ht_product_colorbox.php;ht_noscript.php','List of header tag module filenames separated by a semi-colon. This is automatically updated. No need to edit.',6,0,'2017-07-22 23:50:14','2017-06-14 14:55:19',NULL,NULL),(211,'Enable Category Title Module','MODULE_HEADER_TAGS_CATEGORY_TITLE_STATUS','True','Do you want to allow category titles to be added to the page title?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(212,'Sort Order','MODULE_HEADER_TAGS_CATEGORY_TITLE_SORT_ORDER','200','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(213,'Enable Manufacturer Title Module','MODULE_HEADER_TAGS_MANUFACTURER_TITLE_STATUS','True','Do you want to allow manufacturer titles to be added to the page title?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(214,'Sort Order','MODULE_HEADER_TAGS_MANUFACTURER_TITLE_SORT_ORDER','100','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(215,'Enable Product Title Module','MODULE_HEADER_TAGS_PRODUCT_TITLE_STATUS','True','Do you want to allow product titles to be added to the page title?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(216,'Sort Order','MODULE_HEADER_TAGS_PRODUCT_TITLE_SORT_ORDER','300','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(217,'Enable Canonical Module','MODULE_HEADER_TAGS_CANONICAL_STATUS','True','Do you want to enable the Canonical module?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(218,'Sort Order','MODULE_HEADER_TAGS_CANONICAL_SORT_ORDER','400','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(219,'Enable Robot NoIndex Module','MODULE_HEADER_TAGS_ROBOT_NOINDEX_STATUS','True','Do you want to enable the Robot NoIndex module?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(220,'Pages','MODULE_HEADER_TAGS_ROBOT_NOINDEX_PAGES','account.php;account_edit.php;account_history.php;account_history_info.php;account_newsletters.php;account_notifications.php;account_password.php;address_book.php;address_book_process.php;checkout_confirmation.php;checkout_payment.php;checkout_payment_address.php;checkout_process.php;checkout_shipping.php;checkout_shipping_address.php;checkout_success.php;cookie_usage.php;create_account.php;create_account_success.php;login.php;logoff.php;password_forgotten.php;password_reset.php;product_reviews_write.php;shopping_cart.php;ssl_check.php;tell_a_friend.php','The pages to add the meta robot noindex tag to.',6,0,NULL,'2017-06-14 14:55:19','ht_robot_noindex_show_pages','ht_robot_noindex_edit_pages('),(221,'Sort Order','MODULE_HEADER_TAGS_ROBOT_NOINDEX_SORT_ORDER','500','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(222,'Enable No Script Module','MODULE_HEADER_TAGS_NOSCRIPT_STATUS','True','Add message for people with .js turned off?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(223,'Sort Order','MODULE_HEADER_TAGS_NOSCRIPT_SORT_ORDER','1000','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(224,'Enable Datepicker jQuery Module','MODULE_HEADER_TAGS_DATEPICKER_JQUERY_STATUS','True','Do you want to enable the Datepicker module?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(225,'Pages','MODULE_HEADER_TAGS_DATEPICKER_JQUERY_PAGES','advanced_search.php;account_edit.php;create_account.php','The pages to add the Datepicker jQuery Scripts to.',6,0,NULL,'2017-06-14 14:55:19','ht_datepicker_jquery_show_pages','ht_datepicker_jquery_edit_pages('),(226,'Sort Order','MODULE_HEADER_TAGS_DATEPICKER_JQUERY_SORT_ORDER','600','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(227,'Enable Grid List javascript','MODULE_HEADER_TAGS_GRID_LIST_VIEW_STATUS','True','Do you want to enable the Grid/List Javascript module?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(228,'Pages','MODULE_HEADER_TAGS_GRID_LIST_VIEW_PAGES','advanced_search_result.php;index.php;products_new.php;specials.php','The pages to add the Grid List JS Scripts to.',6,0,NULL,'2017-06-14 14:55:19','ht_grid_list_view_show_pages','ht_grid_list_view_edit_pages('),(229,'Sort Order','MODULE_HEADER_TAGS_GRID_LIST_VIEW_SORT_ORDER','700','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(230,'Enable Clickable Table Rows Module','MODULE_HEADER_TAGS_TABLE_CLICK_JQUERY_STATUS','True','Do you want to enable the Clickable Table Rows module?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(231,'Pages','MODULE_HEADER_TAGS_TABLE_CLICK_JQUERY_PAGES','checkout_payment.php;checkout_shipping.php','The pages to add the jQuery Scripts to.',6,0,NULL,'2017-06-14 14:55:19','ht_table_click_jquery_show_pages','ht_table_click_jquery_edit_pages('),(232,'Sort Order','MODULE_HEADER_TAGS_TABLE_CLICK_JQUERY_SORT_ORDER','800','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(233,'Enable Colorbox Script','MODULE_HEADER_TAGS_PRODUCT_COLORBOX_STATUS','True','Do you want to enable the Colorbox Scripts?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(234,'Pages','MODULE_HEADER_TAGS_PRODUCT_COLORBOX_PAGES','product_info.php','The pages to add the Colorbox Scripts to.',6,0,NULL,'2017-06-14 14:55:19','ht_product_colorbox_show_pages','ht_product_colorbox_edit_pages('),(235,'Sort Order','MODULE_HEADER_TAGS_PRODUCT_COLORBOX_SORT_ORDER','900','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(236,'Installed Modules','MODULE_ADMIN_DASHBOARD_INSTALLED','d_total_revenue.php;d_total_customers.php;d_orders.php;d_customers.php;d_admin_logins.php;d_security_checks.php;d_latest_news.php;d_latest_addons.php;d_partner_news.php;d_version_check.php;d_reviews.php','List of Administration Tool Dashboard module filenames separated by a semi-colon. This is automatically updated. No need to edit.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(237,'Enable Administrator Logins Module','MODULE_ADMIN_DASHBOARD_ADMIN_LOGINS_STATUS','True','Do you want to show the latest administrator logins on the dashboard?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(238,'Sort Order','MODULE_ADMIN_DASHBOARD_ADMIN_LOGINS_SORT_ORDER','500','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(239,'Enable Customers Module','MODULE_ADMIN_DASHBOARD_CUSTOMERS_STATUS','True','Do you want to show the newest customers on the dashboard?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(240,'Sort Order','MODULE_ADMIN_DASHBOARD_CUSTOMERS_SORT_ORDER','400','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(241,'Enable Latest Add-Ons Module','MODULE_ADMIN_DASHBOARD_LATEST_ADDONS_STATUS','True','Do you want to show the latest osCommerce Add-Ons on the dashboard?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(242,'Sort Order','MODULE_ADMIN_DASHBOARD_LATEST_ADDONS_SORT_ORDER','800','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(243,'Enable Latest News Module','MODULE_ADMIN_DASHBOARD_LATEST_NEWS_STATUS','True','Do you want to show the latest osCommerce News on the dashboard?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(244,'Sort Order','MODULE_ADMIN_DASHBOARD_LATEST_NEWS_SORT_ORDER','700','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(245,'Enable Orders Module','MODULE_ADMIN_DASHBOARD_ORDERS_STATUS','True','Do you want to show the latest orders on the dashboard?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(246,'Sort Order','MODULE_ADMIN_DASHBOARD_ORDERS_SORT_ORDER','300','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(247,'Enable Security Checks Module','MODULE_ADMIN_DASHBOARD_SECURITY_CHECKS_STATUS','True','Do you want to run the security checks for this installation?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(248,'Sort Order','MODULE_ADMIN_DASHBOARD_SECURITY_CHECKS_SORT_ORDER','600','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(249,'Enable Total Customers Module','MODULE_ADMIN_DASHBOARD_TOTAL_CUSTOMERS_STATUS','True','Do you want to show the total customers chart on the dashboard?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(250,'Sort Order','MODULE_ADMIN_DASHBOARD_TOTAL_CUSTOMERS_SORT_ORDER','200','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(251,'Enable Total Revenue Module','MODULE_ADMIN_DASHBOARD_TOTAL_REVENUE_STATUS','True','Do you want to show the total revenue chart on the dashboard?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(252,'Sort Order','MODULE_ADMIN_DASHBOARD_TOTAL_REVENUE_SORT_ORDER','100','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(253,'Enable Version Check Module','MODULE_ADMIN_DASHBOARD_VERSION_CHECK_STATUS','True','Do you want to show the version check results on the dashboard?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(254,'Sort Order','MODULE_ADMIN_DASHBOARD_VERSION_CHECK_SORT_ORDER','900','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(255,'Enable Latest Reviews Module','MODULE_ADMIN_DASHBOARD_REVIEWS_STATUS','True','Do you want to show the latest reviews on the dashboard?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(256,'Sort Order','MODULE_ADMIN_DASHBOARD_REVIEWS_SORT_ORDER','1000','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(257,'Enable Partner News Module','MODULE_ADMIN_DASHBOARD_PARTNER_NEWS_STATUS','True','Do you want to show the latest osCommerce Partner News on the dashboard?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(258,'Sort Order','MODULE_ADMIN_DASHBOARD_PARTNER_NEWS_SORT_ORDER','820','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(259,'Installed Modules','MODULE_BOXES_INSTALLED','','List of box module filenames separated by a semi-colon. This is automatically updated. No need to edit.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(279,'Installed Template Block Groups','TEMPLATE_BLOCK_GROUPS','boxes;header_tags','This is automatically updated. No need to edit.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(280,'Installed Modules','MODULE_CONTENT_INSTALLED','account/cm_account_set_password;checkout_success/cm_cs_redirect_old_order;checkout_success/cm_cs_thank_you;checkout_success/cm_cs_product_notifications;checkout_success/cm_cs_downloads;header/cm_header_search;login/cm_login_form;login/cm_create_account_link;navbar/cm_nb_home;navbar/cm_nb_categories_full;navbar/cm_nb_settings;navbar/cm_nb_cart;navigation/cm_modular_navbar','This is automatically updated. No need to edit.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(281,'Enable Set Account Password','MODULE_CONTENT_ACCOUNT_SET_PASSWORD_STATUS','True','Do you want to enable the Set Account Password module?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(282,'Allow Local Passwords','MODULE_CONTENT_ACCOUNT_SET_PASSWORD_ALLOW_PASSWORD','True','Allow local account passwords to be set.',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(283,'Sort Order','MODULE_CONTENT_ACCOUNT_SET_PASSWORD_SORT_ORDER','100','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(284,'Enable Redirect Old Order Module','MODULE_CONTENT_CHECKOUT_SUCCESS_REDIRECT_OLD_ORDER_STATUS','True','Should customers be redirected when viewing old checkout success orders?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(285,'Redirect Minutes','MODULE_CONTENT_CHECKOUT_SUCCESS_REDIRECT_OLD_ORDER_MINUTES','60','Redirect customers to the My Account page after an order older than this amount is viewed.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(286,'Sort Order','MODULE_CONTENT_CHECKOUT_SUCCESS_REDIRECT_OLD_ORDER_SORT_ORDER','500','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(287,'Enable Thank You Module','MODULE_CONTENT_CHECKOUT_SUCCESS_THANK_YOU_STATUS','True','Should the thank you block be shown on the checkout success page?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(288,'Sort Order','MODULE_CONTENT_CHECKOUT_SUCCESS_THANK_YOU_SORT_ORDER','1000','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(289,'Enable Product Notifications Module','MODULE_CONTENT_CHECKOUT_SUCCESS_PRODUCT_NOTIFICATIONS_STATUS','True','Should the product notifications block be shown on the checkout success page?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(290,'Sort Order','MODULE_CONTENT_CHECKOUT_SUCCESS_PRODUCT_NOTIFICATIONS_SORT_ORDER','2000','Sort order of display. Lowest is displayed first.',6,3,NULL,'2017-06-14 14:55:19',NULL,NULL),(291,'Enable Product Downloads Module','MODULE_CONTENT_CHECKOUT_SUCCESS_DOWNLOADS_STATUS','True','Should ordered product download links be shown on the checkout success page?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(292,'Sort Order','MODULE_CONTENT_CHECKOUT_SUCCESS_DOWNLOADS_SORT_ORDER','3000','Sort order of display. Lowest is displayed first.',6,3,NULL,'2017-06-14 14:55:19',NULL,NULL),(293,'Enable Login Form Module','MODULE_CONTENT_LOGIN_FORM_STATUS','True','Do you want to enable the login form module?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(294,'Content Width','MODULE_CONTENT_LOGIN_FORM_CONTENT_WIDTH','Half','Should the content be shown in a full or half width container?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'Full\', \'Half\'), '),(295,'Sort Order','MODULE_CONTENT_LOGIN_FORM_SORT_ORDER','1000','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(296,'Enable New User Module','MODULE_CONTENT_CREATE_ACCOUNT_LINK_STATUS','True','Do you want to enable the new user module?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(297,'Content Width','MODULE_CONTENT_CREATE_ACCOUNT_LINK_CONTENT_WIDTH','Half','Should the content be shown in a full or half width container?',6,1,NULL,'2017-06-14 14:55:19',NULL,'tep_cfg_select_option(array(\'Full\', \'Half\'), '),(298,'Sort Order','MODULE_CONTENT_CREATE_ACCOUNT_LINK_SORT_ORDER','2000','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-06-14 14:55:19',NULL,NULL),(299,'Welcome Gift Voucher Amount','NEW_SIGNUP_GIFT_VOUCHER_AMOUNT','0','Welcome Gift Voucher Amount: If you do not wish to send a Gift Voucher in your create account email put 0 for no amount else if you do place the amount here i.e. 10.00 or 50.00 no currency signs',100,1,NULL,'2003-12-05 05:01:41',NULL,NULL),(300,'Welcome Discount Coupon Code','NEW_SIGNUP_DISCOUNT_COUPON','','Welcome Discount Coupon Code: if you do not want to send a coupon in your create account email leave blank else place the coupon code you wish to use',100,2,NULL,'2003-12-05 05:01:41',NULL,NULL),(301,'Coupon Code Length','CCGV_SECURITY_CODE_LENGTH','8','Coupon Code Length: Set the length of the auto generated coupon code',10,3,NULL,'2014-12-05 05:01:41',NULL,NULL),(302,'Display the Payment Method dropdown?','ORDER_EDITOR_PAYMENT_DROPDOWN','true','Based on this selection Order Editor will display the payment method as a dropdown menu (true) or as an input field (false).',72,1,'2017-06-14 14:55:20','2017-06-14 14:55:20',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(303,'Use prices from Separate Pricing Per Customer?','ORDER_EDITOR_USE_SPPC','false','Leave this set to false unless SPPC is installed.',72,3,'2017-06-14 14:55:20','2017-06-14 14:55:20',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(304,'Use QTPro contribution?','ORDER_EDITOR_USE_QTPRO','false','Leave this set to false unless you have QTPro Installed.',72,4,'2017-06-14 14:55:20','2017-06-14 14:55:20',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(305,'Allow the use of AJAX to update order information?','ORDER_EDITOR_USE_AJAX','true','This must be set to false if using a browser on which JavaScript is disabled or not available.',72,5,'2017-06-14 14:55:20','2017-06-14 14:55:20',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(306,'Select your credit card payment method','ORDER_EDITOR_CREDIT_CARD','Credit Card','Order Editor will display the credit card fields when this payment method is selected.',72,6,'2017-06-14 14:55:20','2017-06-14 14:55:20',NULL,'tep_cfg_pull_down_payment_methods('),(307,'Attach PDF Invoice to New Order Email','ORDER_EDITOR_ADD_PDF_INVOICE_EMAIL','false','When you send a new Order Email a PDF Invoice kan be attach to your email. This function only works if the contribution PDF Invoice is installed. NOT INSTALLED BY DEFAULT',72,15,'2017-06-14 14:55:20','2017-06-14 14:55:20',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(308,'Use CKEditor','USE_CKEDITOR_ADMIN_TEXTAREA','true','Use CKEditor for WYSIWYG editing of textarea fields in admin',1,99,NULL,'2017-06-14 14:55:33',NULL,'tep_cfg_select_option(array(\'true\', \'false\'),'),(309,'Enable SEO Friendly Urls?','SEO_FRIENDLY_URLS_STATUS','True','Do you want to enable the SEO Friendly Urls addon?',101,1,'2017-08-03 19:11:53','2017-06-14 14:55:59',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(310,'Enable aliases for Products?','SEO_FRIENDLY_URLS_ENABLE_ALIASES_FOR_PRODUCTS','Yes','Do you want to enable aliases for products?',101,2,NULL,'2017-06-14 14:55:59',NULL,'tep_cfg_select_option(array(\'Yes\', \'No\'), '),(311,'Enable aliases for Categories?','SEO_FRIENDLY_URLS_ENABLE_ALIASES_FOR_CATEGORIES','Yes','Do you want to enable aliases for categories?',101,3,NULL,'2017-06-14 14:55:59',NULL,'tep_cfg_select_option(array(\'Yes\', \'No\'), '),(312,'Enable aliases for Manufacturers?','SEO_FRIENDLY_URLS_ENABLE_ALIASES_FOR_MANUFACTURERS','Yes','Do you want to enable aliases for manufacturers?',101,4,NULL,'2017-06-14 14:55:59',NULL,'tep_cfg_select_option(array(\'Yes\', \'No\'), '),(313,'Enable aliases for Pages?','SEO_FRIENDLY_URLS_ENABLE_ALIASES_FOR_PAGES','Yes','Do you want to enable aliases for pages?',101,5,NULL,'2017-06-14 14:55:59',NULL,'tep_cfg_select_option(array(\'Yes\', \'No\'), '),(314,'Display language alias (Code) in the urls?','SEO_FRIENDLY_URLS_DISPLAY_LANGUAGE_ALIAS','Yes','Do you want to display the current language alias (Code)?',101,6,NULL,'2017-06-14 14:55:59',NULL,'tep_cfg_select_option(array(\'Yes\', \'No\'), '),(315,'Display default language slug (Code) in the urls?','SEO_FRIENDLY_URLS_DISPLAY_DEFAULT_LANGUAGE_ALIAS','No','Do you want to display the default language slug (Code)? Note: this overrides the above option.',101,7,NULL,'2017-06-14 14:55:59',NULL,'tep_cfg_select_option(array(\'Yes\', \'No\'), '),(316,'Hide index.php from urls?','SEO_FRIENDLY_URLS_HIDE_DEFAULT_PAGE_FROM_URLS','Yes','While constructing urls, when there is a url that contains index.php it is not added in the url. This is useful when we dont want to display the ugly index.php at all.',101,8,'2017-07-27 04:59:11','2017-06-14 14:55:59',NULL,'tep_cfg_select_option(array(\'Yes\', \'No\'), '),(317,'Redirect index.php to / ?','SEO_FRIENDLY_URLS_REDIRECT_TO_DOMAIN','Yes','Redirect index.php to / when there are no GET parameters?',101,8,NULL,'2017-06-14 14:55:59',NULL,'tep_cfg_select_option(array(\'Yes\', \'No\'), '),(318,'Redirect old url to new alias url?','SEO_FRIENDLY_URLS_FORCE_SEO_FRIENDLY_URLS','True','Do you want to force the use of aliases when an old url entered in the address bar?',101,9,NULL,'2017-06-14 14:55:59',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(319,'301 Permanent Redirect?','SEO_FRIENDLY_URLS_PERMANENT_REDIRECT','No','When redirect old urls to new use 301 permanent direct?',101,10,NULL,'2017-06-14 14:55:59',NULL,'tep_cfg_select_option(array(\'Yes\', \'No\'), '),(320,'Handle not found urls as simple redirect to? (No 404 status code)','SEO_FRIENDLY_URLS_REDIRECT_NOT_FOUND_URLS_TO','index.php','Input in what page user will be directed when there is a not found url. Do not use alias, only the page file such as index.php. Note: that option does not produce a 404 status code. It is just a redirect.',101,11,NULL,'2017-06-14 14:55:59',NULL,NULL),(321,'Handle not found urls as 404 include page? (404 status code)','SEO_FRIENDLY_URLS_INCLUDE_NOT_FOUND_PAGE','','Input what page will be included when producing the 404 status code. Note: do not input an oscommerce page. Leave empty so to display the home page.',101,12,NULL,'2017-06-14 14:55:59',NULL,NULL),(322,'Not found url handling method?','SEO_FRIENDLY_URLS_NOT_FOUND_URL_HANDLING_METHOD','404 include page','Select a method for handling the not found pages.',101,13,NULL,'2017-06-14 14:55:59',NULL,'tep_cfg_select_option(array(\'Simple redirect to\', \'404 include page\'), '),(323,'Auto create aliases?','SEO_FRIENDLY_URLS_AUTO_CREATE_ALIASES','True','Do you want to auto create aliases? (Applies only in categories and products pages)',101,14,NULL,'2017-06-14 14:55:59',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(324,'Lower case auto created aliases?','SEO_FRIENDLY_URLS_LOWERCASE_AUTO_CREATED_ALIASES','Yes','Do you want to make the auto created aliases to lower case? (This applies only to auto created aliases not the custom ones)',101,15,NULL,'2017-06-14 14:55:59',NULL,'tep_cfg_select_option(array(\'Yes\', \'No\'), '),(325,'Transliterate characters to ASCII?','SEO_FRIENDLY_URLS_TRANSLITERATE_CHARACTERS_TO_ASCII','True','Do you want to transliterate alias characters to ASCII? (Applies only in categories and products pages)',101,16,NULL,'2017-06-14 14:55:59',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(326,'Use aliases from default language?','SEO_FRIENDLY_URLS_USE_DEFAULT_LANGUAGE_ALIASES','Yes','Do you want to use the default language aliases? In the greek language when english is default use: gr/monitors instead of gr/othones',101,17,NULL,'2017-06-14 14:55:59',NULL,'tep_cfg_select_option(array(\'Yes\', \'No\'), '),(327,'Use custom aliases?','SEO_FRIENDLY_URLS_USE_CUSTOM_ALIASES','False','Do you want to use custom aliases? Custom aliases use the values from table fields products_alias, categories_alias and manufacturers_alias.',101,18,NULL,'2017-06-14 14:55:59',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(328,'Fix duplicate aliases?','SEO_FRIENDLY_URLS_FIX_DUPLICATE_ALIASES','Yes','Do you want to fix duplicate aliases. Note: if duplicate alias found then a number will be appended at the end of the url. Note: duplicate fix is ony between pages, products and cateogries not manufacturers',101,19,NULL,'2017-06-14 14:55:59',NULL,'tep_cfg_select_option(array(\'Yes\', \'No\'), '),(329,'Full path aliases?','SEO_FRIENDLY_URLS_FULL_PATH_ALIASES','Yes','For example: http://mystore.com/dvd-movies/action/speed vs http://mystore.com/speed.',101,20,NULL,'2017-06-14 14:55:59',NULL,'tep_cfg_select_option(array(\'Yes\', \'No\'), '),(330,'Cache aliases?','SEO_FRIENDLY_URLS_CACHE_ALIASES','No','Cache aliases?.',101,21,'2017-08-03 19:11:12','2017-06-14 14:55:59',NULL,'tep_cfg_select_option(array(\'No\', \'mysql\', \'apc\',\'file\'), '),(331,'Reset Aliases Cache?','SEO_FRIENDLY_URLS_RESET_ALIASES_CACHE','No','Reset aliases cache? Note: <b>this is a must when you make changes to the aliases structure based on the above options.</b>',101,22,'2017-07-23 01:13:13','2017-06-14 14:55:59',NULL,'tep_cfg_select_option(array(\'Yes\', \'No\'), '),(332,'Days to store Cache?','SEO_FRIENDLY_URLS_CACHE_DAYS','3','How many days a cache will be kept before auto deleting itself. Set 0 to not auto delete.',101,23,NULL,'2017-06-14 14:55:59',NULL,NULL),(333,'Filter Short Words?','SEO_FRIENDLY_URLS_FILTER_SHORT_WORDS','1','When creating a link from a product name you may want to remove the shorter words like a | or | at | the .. etc. Set 0 for not filtering any short words.',101,24,NULL,'2017-06-14 14:55:59',NULL,NULL),(334,'Products Urls extension?','SEO_FRIENDLY_URLS_URLS_EXTENSION_PRODUCTS','','Input the extension you desire to be appended at the end of the products urls. For example: html<br>Tip: <b>enter the backslash char / if you want your urls to end with /</b>',101,25,NULL,'2017-06-14 14:55:59',NULL,NULL),(335,'Categories Urls extension?','SEO_FRIENDLY_URLS_URLS_EXTENSION_CATEGORIES','','Input the extension you desire to be appended at the end of the categories urls. For example: html<br>Tip: <b>enter the backslash char / if you want your urls to end with /</b>',101,26,NULL,'2017-06-14 14:55:59',NULL,NULL),(336,'Manufacturers Urls extension?','SEO_FRIENDLY_URLS_URLS_EXTENSION_MANUFACTURERS','','Input the extension you desire to be appended at the end of the manufacturers urls. For example: html<br>Tip: <b>enter the backslash char / if you want your urls to end with /</b>',101,27,NULL,'2017-06-14 14:55:59',NULL,NULL),(337,'Pages Urls extension?','SEO_FRIENDLY_URLS_URLS_EXTENSION_PAGES','','Input the extension you desire to be appended at the end of the pages urls. For example: html<br>Tip: <b>enter the backslash char / if you want your urls to end with /</b>',101,28,NULL,'2017-06-14 14:55:59',NULL,NULL),(338,'Do not use / if there are parameters in url. Applies only when extension is set to backslash. (Experimental)','SEO_FRIENDLY_URLS_DONT_USE_BACKSLASH_IF_PARAMETERS','No','If we have set as an extension a backslash then if the url has parameters then display the / or not. <b>I.e. drama/?filter=2a vs drama?filter=2a</b>',101,29,NULL,'2017-06-14 14:55:59',NULL,'tep_cfg_select_option(array(\'Yes\', \'No\'), '),(339,'Re-index root pages in the root?','SEO_FRIENDLY_URLS_DISCOVER_NEW_PAGES','No','Do you want to discover new pages added in the root so to make it possible to alias them? (This option auto sets to No when finished operation.)',101,30,NULL,'2017-06-14 14:55:59',NULL,'tep_cfg_select_option(array(\'Yes\', \'No\'), '),(340,'Remove SEO Friendly Urls PRO Edition ? :-(','SEO_FRIENDLY_URLS_REMOVE','No','Do you want to remove SEO Friendly Urls PRO Edition? Note: it does not delete the seo_friendly_urls.php class. By setting Yes the SEO Friendly Urls PRO Edition will be auto removed after a visit on any page in your front store.',101,31,NULL,'2017-06-14 14:55:59',NULL,'tep_cfg_select_option(array(\'Yes\', \'No\'), '),(341,'Version:','SEO_FRIENDLY_URLS_VERSION','2.0.0','Current version of SEO Friendly Urls PRO Edition (Do not edit as it is used by the class)',101,32,NULL,'2017-06-14 14:55:59',NULL,'tep_cfg_select_option(array(\'2.0.0\'), '),(342,'Edition:','SEO_FRIENDLY_URLS_EDITION','PRO','Current edition of SEO Friendly Urls PRO Edition (Do not edit as it is used by the class)',101,33,NULL,'2017-06-14 14:55:59',NULL,'tep_cfg_select_option(array(\'PRO\'), '),(343,'Alias for: <b>account.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_account.php','','Input the alias for the account.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,34,NULL,'2017-06-14 14:55:59',NULL,NULL),(344,'Alias for: <b>account_edit.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_account_edit.php','','Input the alias for the account_edit.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,35,NULL,'2017-06-14 14:55:59',NULL,NULL),(345,'Alias for: <b>account_history.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_account_history.php','','Input the alias for the account_history.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,36,NULL,'2017-06-14 14:55:59',NULL,NULL),(346,'Alias for: <b>account_history_info.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_account_history_info.php','','Input the alias for the account_history_info.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,37,NULL,'2017-06-14 14:55:59',NULL,NULL),(347,'Alias for: <b>account_newsletters.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_account_newsletters.php','','Input the alias for the account_newsletters.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,38,NULL,'2017-06-14 14:55:59',NULL,NULL),(348,'Alias for: <b>account_notifications.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_account_notifications.php','','Input the alias for the account_notifications.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,39,NULL,'2017-06-14 14:55:59',NULL,NULL),(349,'Alias for: <b>account_password.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_account_password.php','','Input the alias for the account_password.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,40,NULL,'2017-06-14 14:55:59',NULL,NULL),(350,'Alias for: <b>account_pwa.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_account_pwa.php','','Input the alias for the account_pwa.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,41,NULL,'2017-06-14 14:55:59',NULL,NULL),(351,'Alias for: <b>address_book.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_address_book.php','','Input the alias for the address_book.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,42,NULL,'2017-06-14 14:55:59',NULL,NULL),(352,'Alias for: <b>address_book_process.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_address_book_process.php','','Input the alias for the address_book_process.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,43,NULL,'2017-06-14 14:55:59',NULL,NULL),(353,'Alias for: <b>advanced_search.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_advanced_search.php','','Input the alias for the advanced_search.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,44,NULL,'2017-06-14 14:55:59',NULL,NULL),(354,'Alias for: <b>advanced_search_result.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_advanced_search_result.php','','Input the alias for the advanced_search_result.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,45,NULL,'2017-06-14 14:55:59',NULL,NULL),(355,'Alias for: <b>checkout_confirmation.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_checkout_confirmation.php','','Input the alias for the checkout_confirmation.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,46,NULL,'2017-06-14 14:55:59',NULL,NULL),(356,'Alias for: <b>checkout_payment.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_checkout_payment.php','','Input the alias for the checkout_payment.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,47,NULL,'2017-06-14 14:55:59',NULL,NULL),(357,'Alias for: <b>checkout_payment_address.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_checkout_payment_address.php','','Input the alias for the checkout_payment_address.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,48,NULL,'2017-06-14 14:55:59',NULL,NULL),(358,'Alias for: <b>checkout_process.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_checkout_process.php','','Input the alias for the checkout_process.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,49,NULL,'2017-06-14 14:55:59',NULL,NULL),(359,'Alias for: <b>checkout_shipping.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_checkout_shipping.php','','Input the alias for the checkout_shipping.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,50,NULL,'2017-06-14 14:55:59',NULL,NULL),(360,'Alias for: <b>checkout_shipping_address.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_checkout_shipping_address.php','','Input the alias for the checkout_shipping_address.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,51,NULL,'2017-06-14 14:55:59',NULL,NULL),(361,'Alias for: <b>checkout_success.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_checkout_success.php','','Input the alias for the checkout_success.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,52,NULL,'2017-06-14 14:55:59',NULL,NULL),(362,'Alias for: <b>checkout_success_pwa.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_checkout_success_pwa.php','','Input the alias for the checkout_success_pwa.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,53,NULL,'2017-06-14 14:55:59',NULL,NULL),(363,'Alias for: <b>conditions.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_conditions.php','','Input the alias for the conditions.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,54,NULL,'2017-06-14 14:55:59',NULL,NULL),(364,'Alias for: <b>contact_us.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_contact_us.php','','Input the alias for the contact_us.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,55,NULL,'2017-06-14 14:55:59',NULL,NULL),(365,'Alias for: <b>cookie_usage.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_cookie_usage.php','','Input the alias for the cookie_usage.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,56,NULL,'2017-06-14 14:55:59',NULL,NULL),(366,'Alias for: <b>create_account.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_create_account.php','','Input the alias for the create_account.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,57,NULL,'2017-06-14 14:55:59',NULL,NULL),(367,'Alias for: <b>create_account_success.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_create_account_success.php','','Input the alias for the create_account_success.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,58,NULL,'2017-06-14 14:55:59',NULL,NULL),(368,'Alias for: <b>download.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_download.php','','Input the alias for the download.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,59,NULL,'2017-06-14 14:55:59',NULL,NULL),(369,'Alias for: <b>gv_faq.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_gv_faq.php','','Input the alias for the gv_faq.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,60,NULL,'2017-06-14 14:55:59',NULL,NULL),(370,'Alias for: <b>gv_redeem.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_gv_redeem.php','','Input the alias for the gv_redeem.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,61,NULL,'2017-06-14 14:55:59',NULL,NULL),(371,'Alias for: <b>gv_send.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_gv_send.php','','Input the alias for the gv_send.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,62,NULL,'2017-06-14 14:55:59',NULL,NULL),(372,'Alias for: <b>index.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_index.php','','Input the alias for the index.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,63,NULL,'2017-06-14 14:55:59',NULL,NULL),(373,'Alias for: <b>login.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_login.php','','Input the alias for the login.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,64,NULL,'2017-06-14 14:55:59',NULL,NULL),(374,'Alias for: <b>logoff.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_logoff.php','','Input the alias for the logoff.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,65,NULL,'2017-06-14 14:55:59',NULL,NULL),(375,'Alias for: <b>mailhive.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_mailhive.php','','Input the alias for the mailhive.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,66,NULL,'2017-06-14 14:55:59',NULL,NULL),(376,'Alias for: <b>opensearch.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_opensearch.php','','Input the alias for the opensearch.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,67,NULL,'2017-06-14 14:55:59',NULL,NULL),(377,'Alias for: <b>password_forgotten.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_password_forgotten.php','','Input the alias for the password_forgotten.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,68,NULL,'2017-06-14 14:55:59',NULL,NULL),(378,'Alias for: <b>password_reset.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_password_reset.php','','Input the alias for the password_reset.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,69,NULL,'2017-06-14 14:55:59',NULL,NULL),(379,'Alias for: <b>privacy.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_privacy.php','','Input the alias for the privacy.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,70,NULL,'2017-06-14 14:55:59',NULL,NULL),(380,'Alias for: <b>product_info.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_product_info.php','','Input the alias for the product_info.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,71,NULL,'2017-06-14 14:55:59',NULL,NULL),(381,'Alias for: <b>product_reviews.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_product_reviews.php','','Input the alias for the product_reviews.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,72,NULL,'2017-06-14 14:55:59',NULL,NULL),(382,'Alias for: <b>product_reviews_write.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_product_reviews_write.php','','Input the alias for the product_reviews_write.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,73,NULL,'2017-06-14 14:55:59',NULL,NULL),(383,'Alias for: <b>products_new.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_products_new.php','','Input the alias for the products_new.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,74,NULL,'2017-06-14 14:55:59',NULL,NULL),(384,'Alias for: <b>redirect.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_redirect.php','','Input the alias for the redirect.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,75,NULL,'2017-06-14 14:55:59',NULL,NULL),(385,'Alias for: <b>reviews.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_reviews.php','','Input the alias for the reviews.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,76,NULL,'2017-06-14 14:55:59',NULL,NULL),(386,'Alias for: <b>shipping.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_shipping.php','','Input the alias for the shipping.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,77,NULL,'2017-06-14 14:55:59',NULL,NULL),(387,'Alias for: <b>shop-bewertungen-schreiben.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_shop-bewertungen-schreiben.php','','Input the alias for the shop-bewertungen-schreiben.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,78,NULL,'2017-06-14 14:55:59',NULL,NULL),(388,'Alias for: <b>shop-bewertungen.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_shop-bewertungen.php','','Input the alias for the shop-bewertungen.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,79,NULL,'2017-06-14 14:55:59',NULL,NULL),(389,'Alias for: <b>shop-reviews-write.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_shop-reviews-write.php','','Input the alias for the shop-reviews-write.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,80,NULL,'2017-06-14 14:55:59',NULL,NULL),(390,'Alias for: <b>shop-reviews.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_shop-reviews.php','','Input the alias for the shop-reviews.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,81,NULL,'2017-06-14 14:55:59',NULL,NULL),(391,'Alias for: <b>shopping_cart.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_shopping_cart.php','','Input the alias for the shopping_cart.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,82,NULL,'2017-06-14 14:55:59',NULL,NULL),(392,'Alias for: <b>specials.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_specials.php','','Input the alias for the specials.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,83,NULL,'2017-06-14 14:55:59',NULL,NULL),(393,'Alias for: <b>ssl_check.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_ssl_check.php','','Input the alias for the ssl_check.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,84,NULL,'2017-06-14 14:55:59',NULL,NULL),(394,'Alias for: <b>tell_a_friend.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_tell_a_friend.php','','Input the alias for the tell_a_friend.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,85,NULL,'2017-06-14 14:55:59',NULL,NULL),(395,'Alias for: <b>testimonials.php</b>','SEO_FRIENDLY_URLS_ALIAS_FOR_testimonials.php','','Input the alias for the testimonials.php. Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>',101,86,NULL,'2017-06-14 14:55:59',NULL,NULL),(396,'KissIT: Version','KISSIT_IMAGE_MODULE','21','KISS Image Thumbnailer - Creates image thumbnails where the image size requested differs from the actual image size',6,0,NULL,'2017-06-14 14:55:59',NULL,NULL),(397,'KissIT Product Main Image Width','KISSIT_MAIN_PRODUCT_IMAGE_WIDTH','250','KissIT Product Main Image Width.<br /><br />',4,20,NULL,'2017-06-14 14:55:59',NULL,NULL),(398,'KissIT Product Main Image Height','KISSIT_MAIN_PRODUCT_IMAGE_HEIGHT','250','KissIT Product Main Image Height.<br /><br />',4,21,NULL,'2017-06-14 14:55:59',NULL,NULL),(399,'KissIT Disable Image Upsize','KISS_DISABLE_UPSIZE','true','Keep original image size if the original image is smaller than the requested thumbnail size.',4,22,NULL,'2017-06-14 14:55:59',NULL,'tep_cfg_select_option(array(\'true\', \'false\'), '),(400,'KissIT Product Watermark Size','KISSIT_MAIN_PRODUCT_WATERMARK_SIZE','0.6','KissIT Product Main Watermark size relativ to the image size (1.0=100%, 0.5 = 50%, 0=no watermark).<br /><br />',4,23,NULL,'2017-06-14 14:55:59',NULL,NULL),(401,'KissIT Watermark File Name','KISSIT_MAIN_PRODUCT_WATERMARK_IMAGE','watermark.png','Name of Watermark image file placed in the folder /images. Remember to use a png file with transparent background.<br /><br />',4,24,NULL,'2017-06-14 14:55:59',NULL,NULL),(402,'KissIT Watermark position in image','KISSIT_MAIN_PRODUCT_WATERMARK_PLACEMENT','center','Position of the watermark in the image reletiv within the image.',4,25,NULL,'2017-06-14 14:55:59',NULL,'tep_cfg_select_option(array(\'top-right\', \'top-left\', \'center\',\'bottom-right\', \'bottom-left\'), '),(403,'KissIT min image width to apply Watermark','KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_WIDTH','60','The minimum width of thumbnail images to apply the watermark.<br /><br />',4,26,NULL,'2017-06-14 14:55:59',NULL,NULL),(404,'KissIT min image height to apply Watermark','KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_HEIGHT','60','The minimum height of thumbnail images to apply the watermark.<br /><br />',4,27,NULL,'2017-06-14 14:55:59',NULL,NULL),(405,'KissIT Reset thumbs','KISSIT_RESET_IMAGE_THUMBS','false','Reset thumbs cache.',4,28,NULL,'2017-06-14 14:55:59','tep_cfg_reset_thumbs_cache','tep_cfg_select_option(array(\'reset\', \'false\'), '),(406,'KissIT thumb directory','KISSIT_THUMBS_MAIN_DIR','thumbs/','The name of the thumbs directory inside \"images\".<br>default: \'thumbs\'<br>Please, reset thumbs if you change it.',4,29,NULL,'2017-06-14 14:56:00',NULL,NULL),(407,'Allow reviews','ALLOW_REVIEWS','false','Allow reviews for products?',1,999,'2017-06-19 01:57:03','2017-06-19 01:18:02',NULL,NULL),(413,'Module Version','MODULE_CONTENT_NAVBAR_SETTINGS_VERSION','1.0.1','The version of this module that you are running.',6,0,NULL,'2017-07-26 16:47:22',NULL,'tep_cfg_disabled('),(414,'Enable Settings Module','MODULE_CONTENT_NAVBAR_SETTINGS_STATUS','True','Should the settings menu be shown in the navbar?',6,1,NULL,'2017-07-26 16:47:22',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(415,'Sort Order','MODULE_CONTENT_NAVBAR_SETTINGS_SORT_ORDER','9200','Sort order of display. Lowest is displayed first.',6,2,NULL,'2017-07-26 16:47:22',NULL,NULL),(416,'Content Placement','MODULE_CONTENT_NAVBAR_SETTINGS_CONTENT_PLACEMENT','right','Should the settings menu be loaded on the left or right side of the navbar?',6,3,NULL,'2017-07-26 16:47:22',NULL,'tep_cfg_select_option(array(\'left\', \'right\'), '),(417,'Module Version','MODULE_CONTENT_NAVBAR_HOME_VERSION','1.0.1','The version of this module that you are running.',6,0,NULL,'2017-07-26 16:49:18',NULL,'tep_cfg_disabled('),(418,'Enable Home Module','MODULE_CONTENT_NAVBAR_HOME_STATUS','True','Should the home link be shown in the navigation bar?',6,1,NULL,'2017-07-26 16:49:18',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(419,'Sort Order','MODULE_CONTENT_NAVBAR_HOME_SORT_ORDER','9100','Sort order of display. Lowest is displayed first.',6,2,NULL,'2017-07-26 16:49:18',NULL,NULL),(420,'Content Placement','MODULE_CONTENT_NAVBAR_HOME_CONTENT_PLACEMENT','left','Should the module be loaded on the left or right side of the navbar?',6,3,NULL,'2017-07-26 16:49:18',NULL,'tep_cfg_select_option(array(\'left\', \'right\'), '),(421,'Module Version','MODULE_CONTENT_NAVBAR_CART_VERSION','1.0.1','The version of this module that you are running.',6,0,NULL,'2017-07-26 16:53:57',NULL,'tep_cfg_disabled('),(422,'Enable Cart Module','MODULE_CONTENT_NAVBAR_CART_STATUS','True','Should the shopping cart menu be shown in the navbar?',6,1,NULL,'2017-07-26 16:53:57',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(423,'Sort Order','MODULE_CONTENT_NAVBAR_CART_SORT_ORDER','9240','Sort order of display. Lowest is displayed first.',6,2,NULL,'2017-07-26 16:53:57',NULL,NULL),(424,'Content Placement','MODULE_CONTENT_NAVBAR_CART_CONTENT_PLACEMENT','right','Should the shopping cart menu be loaded on the left or right side of the navbar?',6,3,NULL,'2017-07-26 16:53:57',NULL,'tep_cfg_select_option(array(\'left\', \'right\'), '),(425,'Module Version','MODULE_CONTENT_NAVBAR_CATEGORIES_FULL_VERSION','1.0.1','The version of this module that you are running.',6,0,NULL,'2017-07-26 16:57:49',NULL,'tep_cfg_disabled('),(426,'Enable Full Categories Module','MODULE_CONTENT_NAVBAR_CATEGORIES_FULL_STATUS','True','Should the full categories menu dropdown be shown in the navbar?',6,1,NULL,'2017-07-26 16:57:49',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(427,'Sort Order','MODULE_CONTENT_NAVBAR_CATEGORIES_FULL_SORT_ORDER','9110','Sort order of display. Lowest is displayed first.',6,2,NULL,'2017-07-26 16:57:50',NULL,NULL),(428,'Content Placement','MODULE_CONTENT_NAVBAR_CATEGORIES_FULL_CONTENT_PLACEMENT','left','Should the full categories menu be loaded on the left or right side of the navbar?',6,3,NULL,'2017-07-26 16:57:50',NULL,'tep_cfg_select_option(array(\'left\', \'right\'), '),(467,'Enable Search Box Module','MODULE_CONTENT_HEADER_SEARCH_STATUS','True','Do you want to enable the Search Box content module?',6,1,NULL,'2017-08-06 02:07:02',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(468,'Content Width','MODULE_CONTENT_HEADER_SEARCH_CONTENT_WIDTH','5','What width container should the content be shown in?',6,1,NULL,'2017-08-06 02:07:02',NULL,'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), '),(469,'Sort Order','MODULE_CONTENT_HEADER_SEARCH_SORT_ORDER','2','Sort order of display. Lowest is displayed first.',6,0,NULL,'2017-08-06 02:07:02',NULL,NULL),(477,'Module Version','MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_VERSION','1.0.1','The version of this module that you are running.',6,0,NULL,'2017-08-06 02:39:53',NULL,'tep_cfg_disabled('),(478,'Enable Modular Navbar Module','MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_STATUS','True','Do you want to add the modular mavbar to your shop?',6,1,NULL,'2017-08-06 02:39:53',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(479,'Display Logo','MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_LOGO_ENABLED','True','Do you want to display Logo in the navbar?',6,1,NULL,'2017-08-06 02:39:53',NULL,'tep_cfg_select_option(array(\'True\', \'False\'), '),(480,'Sort Order','MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_SORT_ORDER','9000','Sort order of display. Lowest is displayed first.',6,2,NULL,'2017-08-06 02:39:53',NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuration_group`
--

LOCK TABLES `configuration_group` WRITE;
/*!40000 ALTER TABLE `configuration_group` DISABLE KEYS */;
INSERT INTO `configuration_group` VALUES (1,'My Store','General information about my store',1,1),(2,'Minimum Values','The minimum values for functions / data',2,1),(3,'Maximum Values','The maximum values for functions / data',3,1),(4,'Images','Image parameters',4,1),(5,'Customer Details','Customer account configuration',5,1),(6,'Module Options','Hidden from configuration',6,0),(7,'Shipping/Packaging','Shipping options available at my store',7,1),(8,'Product Listing','Product Listing    configuration options',8,1),(9,'Stock','Stock configuration options',9,1),(10,'Logging','Logging configuration options',10,1),(11,'Cache','Caching configuration options',11,1),(12,'E-Mail Options','General setting for E-Mail transport and HTML E-Mails',12,1),(13,'Download','Downloadable products options',13,1),(14,'GZip Compression','GZip compression options',14,1),(15,'Sessions','Session options',15,1),(16,'Bootstrap Setup','Basic Bootstrap Options',16,1),(17,'Products admin values visible','Define values in categories/product to be visible',17,1),(72,'Order Editor','Configuration options for Order Editor',72,1),(100,'CCGV Settings','Discount Coupons and Gift Voucher Settings',100,1),(101,'SEO Friendly Urls PRO Edition','SEO Friendly Urls PRO Edition',NULL,1);
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
INSERT INTO `currencies` VALUES (1,'U.S. Dollar','USD','$','','.',',','2',1.00000000,'2017-06-14 14:55:18'),(2,'Euro','EUR','','','.',',','2',1.00000000,'2017-06-14 14:55:18'),(3,'Česká Koruna','CZK','','Kč',',','.','2',1.00000000,'2017-06-14 14:55:18');
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
  `customers_firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customers_lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customers_dob` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `customers_email_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customers_default_address_id` int(11) DEFAULT NULL,
  `customers_telephone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customers_fax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customers_password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `customers_newsletter` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `geo_zones`
--

LOCK TABLES `geo_zones` WRITE;
/*!40000 ALTER TABLE `geo_zones` DISABLE KEYS */;
INSERT INTO `geo_zones` VALUES (1,'EU','','2017-06-14 14:55:18','2017-06-14 14:55:18');
/*!40000 ALTER TABLE `geo_zones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `information`
--

DROP TABLE IF EXISTS `information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `information` (
  `information_seo_title` varchar(255) DEFAULT NULL,
  `information_seo_meta_description` text,
  `information_seo_meta_keywords` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `information`
--

LOCK TABLES `information` WRITE;
/*!40000 ALTER TABLE `information` DISABLE KEYS */;
/*!40000 ALTER TABLE `information` ENABLE KEYS */;
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
INSERT INTO `languages` VALUES (4,'Czech','cs','icon.gif','czech',1);
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
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
  `languages_id` int(11) NOT NULL,
  `manufacturers_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url_clicked` int(5) NOT NULL DEFAULT '0',
  `date_last_click` datetime DEFAULT NULL,
  `manufacturers_description` text COLLATE utf8_unicode_ci,
  `manufacturers_seo_description` text COLLATE utf8_unicode_ci,
  `manufacturers_seo_keywords` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manufacturers_alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mm_responsemail`
--

LOCK TABLES `mm_responsemail` WRITE;
/*!40000 ALTER TABLE `mm_responsemail` DISABLE KEYS */;
INSERT INTO `mm_responsemail` VALUES (0,'Create Account','<!--content-->\r\n<tr>\r\n    <td>\r\n        <table bgcolor=\"#FFFFFF\">\r\n             <tr>\r\n                <td>\r\n                     \r\n<p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$mmgreet<br/>$mmwelcome</p>\r\n<p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$mmtext</p>\r\n<p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$mmcontact</p>\r\n<p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$mmwarning\r\n</p>\r\n              </td>\r\n      	  </tr>\r\n          <tr>\r\n                <td>\r\n            	       <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n            		     <tr>\r\n                                   <td height=\"1\"><img src=\"http://www.css-oscommerce.com/images/mail_manager/divider-invoice.jpg\" width=\"100%\" height=\"1\" style=\"display: block;\" />\r\n                                   </td>\r\n                            </tr>                                                 \r\n            	         </table>\r\n            	</td>\r\n            </tr>\r\n        </table>\r\n    </td>\r\n</tr>\r\n<!--// content-->','$mmgreet\r\n\r\n$mmwelcome\r\n\r\n$mmtext\r\n\r\n$mmcontact\r\n\r\n$mmwarning','Cityscape','',1),(1,'Order Confirmation','<table border=\"0\" cellpadding=\"10\" cellpadding=\"10\" bgcolor=\"#FFFFFF\" width=\"100%\">\r\n            <tr>\r\n                <td colspan=\"2\">\r\n                     <h1>Order Confirmation</h1><br />\r\n                      $invoiceurl\r\n                 </td>\r\n            </tr>           \r\n            <tr>\r\n                 <td style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\"> $orderno </td>\r\n                 <td >$orderdate</td>\r\n            </tr>\r\n             <tr><td colspan=\"2\"><hr></td></tr>       \r\n            <tr>\r\n                  <td><strong>$billingaddresshead</strong>\r\n                          </td>\r\n                  <td style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\"><strong>$deliveryaddresshead</strong>\r\n                           </td>\r\n             </tr>         \r\n             <tr><td style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$deliveryaddress</td><td style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$billingaddress</td></tr>\r\n             <tr><td colspan=\"2\"><hr></td></tr>            \r\n             <tr>\r\n                  <td colspan=\"2\"><strong>$productsorderedhead</strong></td>\r\n              </tr>\r\n              <tr>\r\n                    <td colspan=\"2\"  align=\"right\" style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$productsordered</td>\r\n             \r\n              <tr>\r\n                     <td colspan=\"2\"  align=\"right\" style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$ordertotal</td>\r\n              </tr>\r\n              <tr><td colspan=\"2\"><hr></td></tr>\r\n               <tr>\r\n                   <td colspan=\"2\"> <strong>$paymethodhead</strong></td>\r\n               </tr>\r\n                <tr>\r\n                     <td>$paymentmethod</td><td>$ccardtype</td>\r\n                 </tr>\r\n                 <tr><td colspan=\"2\" style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$ordercomments\r\n                         </td></tr>\r\n                 <tr><td colspan=\"2\">\r\n                          $storeemail<br />\r\n                          $storeurl\r\n                        </td>\r\n                   </tr>\r\n</table>','order confirmation\r\n\r\n$storename\r\n$storeemail\r\n$separator\r\n$invoiceurl \r\n$orderno\r\n$orderdate\r\n$separator\r\n$deliveryaddresshead\r\n$deliveryaddress\r\n$separator\r\n$billingaddresshead\r\n$billingaddress\r\n$separator\r\n$productsorderedhead\r\n$productsordered\r\n$totaltext\r\n$subtotaltext\r\n$ordertotal\r\n$ccardtype\r\n$separator\r\n$paymethodhead\r\n$paymentmethod\r\n$ordercomments','Bluebox','<tr><td class=\"main\"><strong>Available placeholders:</strong><br /></td></tr>\r\n   								<tr><td ><table><tr><td class=\"main\" valign=\"top\"><ul>\r\n   								<li>$storeurl = store url</li>\r\n   								<li>$storename = store name</li>\r\n   								<li>$storeemail = store email address</li>\r\n   								<li>$invoiceurl = Invoice url</li>\r\n   								<li>$orderno = Order Number</li>\r\n   								<li>$orderdate = Order Date</li>\r\n   								<li>$ordercomments = comments</li>\r\n   								<li>$separator = ============</li>\r\n   								<li>$productsorderedhead =  heading, product list</li>\r\n   								<li>$productsordered =  product list</li>\r\n   								<li>$ordercomments = customer comments</li>\r\n                                                                </ul></td><td class=\"main\" valign=\"top\"><ul>								\r\n   								<li>$deliveryaddresshead = heading, delivery address</li>\r\n   								<li>$deliveryaddress = delivery address</li>\r\n   								<li>$billingaddresshead = heading, billing address</li>\r\n   								<li>$billingaddress = billing address</li>\r\n   								<li>$paymethodhead = heading, payment method</li>\r\n   								<li>$paymentmethod = payment method</li>\r\n                                                                <li>$ccardtype = credit card type</li>                                                               \r\n   								<li>$totaltext = heading, order total</li>\r\n                                                                <li>$subtotaltext = heading, subtotal</li>\r\n   								<li>$ordertotal = order total</li>\r\n   								</ul></td></tr></table></td></tr>',1),(2,'Status Update','<!--content-->\r\n<table><tr><td colspan=\"2\" ><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\"><strong> $storename </strong></p></td></tr>\r\n            <tr><td><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$orderno</p></td>  	\r\n<td align=\"center\"><p align=\"right\" style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$orderdate</p></td></tr>\r\n            <tr>\r\n            	<td colspan=\"2\">\r\n            	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n            		<tr><td height=\"1\"><img src=\"http://www.css-oscommerce.com/images/mail_manager/divider-invoice.jpg\" width=\"100%\" height=\"1\" style=\"display: block;\" /></td></tr>                                                 \r\n            	</table>\r\n            	</td>\r\n            </tr>\r\n            <tr><td colspan=\"2\"><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$statusnewhtml</p></td></tr>                    \r\n            <tr><td colspan=\"2\"><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$comments</p></td></tr>\r\n            <tr><td colspan=\"2\"><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$invoiceurl</p></td></tr></table>        \r\n<!--// content-->','$txtheader\r\n$storeowner\r\n$orderno\r\n$orderdate\r\n$statusnewtxt\r\n$comments\r\n$invoiceurl','Choice','<tr><td class=\"main\"><strong>Available placeholders:</strong><br /></td></tr>\r\n   								<tr><td><table><tr><td class=\"main\" valign=\"top\"><ul>\r\n   								<li>$storeurl = store url</li>\r\n   								<li>$storename = store name</li>\r\n   								<li>$storeemail = store email address</li>\r\n   								<li>$customername = customer name</li>\r\n   								<li>$customeremail = customer email</li>\r\n   								<li>$separator = ============</li></ul></td><td class=\"main\" valign=\"top\"><ul>\r\n   								<li>$orderno =  order number</li>\r\n   								<li>$orderdate =  order date</li>\r\n   								<li>$statusnewhtml = new status, html format</li>\r\n   								<li>$statusnewtxt = new status, txt format</li>\r\n   								<li>$comments = comments</li>\r\n   								<li>$invoiceurl = invoice url</li>\r\n   								</ul></td></tr></table></td></tr>',1),(3,'Password Forgotten','<table>\r\n    <tr>\r\n        <td><br /><br /><br />$emailsubject<br /><br />$newpwandmsg<br /><br /><br /></td>\r\n    </tr>\r\n</table>','$emailsubject\r\n\r\n$newpwandmsg','Email','<tr><td class=\"main\"><strong>Available placeholders:</strong><br /></td></tr>\r\n<tr><td><table><tr><td class=\"main\" valign=\"top\">\r\n<ul>\r\n<li>$storeurl = store url</li>\r\n<li>$storename = store name</li>\r\n<li>$customerfirstname = customer first name</li>\r\n<li>$customerlastname = customer last name</li>\r\n<li>$customeremail = customer email</li>\r\n<li>$emailsubject = email subject (EMAIL_PASSWORD_REMINDER_SUBJECT)</li>\r\n<li>$newpwandmsg = email text + new password (sprintf(EMAIL_PASSWORD_REMINDER_BODY, $new_password))</li>\r\n</ul>\r\n</td></tr></table></td></tr>',1),(4,'Tell A Friend','<table cellspacing=\"10\" cellpadding=\"10\">\r\n    <tr>\r\n        <td colspan=\"2\" >\r\n           Hello $toname,<br /><br />\r\n           Your friend, $fromname,  thought that you would be interested in $products from $storename.<br />\r\n           To view the product click on the link below or copy and paste the link into your web browser:<br /><br />\r\n           $link<br /><br />\r\n           Regards, $storename\r\n            <br/ ><br />\r\n            <hr>\r\n            <br /><br />\r\n             $fromname says:\r\n            <br /><br />\r\n            <em> $message</em>\r\n         </td>\r\n         <td>\r\n              $image\r\n        <p align=\"center\">$product</p>\r\n         </td>\r\n     </tr>\r\n</table>','Hello $toname,\r\nYour friend, $fromname  thought that you would be interested in $product from $storename.\r\n\r\nTo view the product click on the link below or copy and paste the link into your web browser:\r\n\r\n$link\r\n\r\nRegards, $storename\r\n\r\n-----------------------------------------------------------------\r\n$fromname says:\r\n\r\n$message','Cssosc','<tr><td class=\"main\"><strong>Available placeholders:</strong><br /></td></tr>\r\n                             <tr><td><table><tr><td class=\"main\" valign=\"top\">\r\n<ul>\r\n<li>$storeurl = store url</li>\r\n<li>$storeemail = store email</li>\r\n<li>$storename = store name</li>\r\n<li>$toname = email sent to</li>\r\n<li>$fromname = email sent from</li>\r\n</ul></td><td class=\"main\" valign=\"top\"><ul>\r\n<li>$product = product name</li>\r\n<li>$link = link to product</li>\r\n<li>$image = product image</li>\r\n<li>$message = message</li>\r\n</ul>\r\n</td></tr></table></td></tr>',1);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mm_responsemail_backup`
--

LOCK TABLES `mm_responsemail_backup` WRITE;
/*!40000 ALTER TABLE `mm_responsemail_backup` DISABLE KEYS */;
INSERT INTO `mm_responsemail_backup` VALUES (0,'Create Account','<!--content-->\r\n<tr>\r\n    <td>\r\n        <table bgcolor=\"#FFFFFF\">\r\n             <tr>\r\n                <td>\r\n                     \r\n<p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$mmgreet<br/>$mmwelcome</p>\r\n<p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$mmtext</p>\r\n<p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$mmcontact</p>\r\n<p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$mmwarning\r\n</p>\r\n              </td>\r\n      	  </tr>\r\n          <tr>\r\n                <td>\r\n            	       <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n            		     <tr>\r\n                                   <td height=\"1\"><img src=\"http://www.css-oscommerce.com/images/mail_manager/divider-invoice.jpg\" width=\"100%\" height=\"1\" style=\"display: block;\" />\r\n                                   </td>\r\n                            </tr>                                                 \r\n            	         </table>\r\n            	</td>\r\n            </tr>\r\n        </table>\r\n    </td>\r\n</tr>\r\n<!--// content-->','$mmgreet\r\n\r\n$mmwelcome\r\n\r\n$mmtext\r\n\r\n$mmcontact\r\n\r\n$mmwarning','Cityscape','',1),(1,'Order Confirmation','<table border=\"0\" cellpadding=\"10\" cellpadding=\"10\" bgcolor=\"#FFFFFF\" width=\"100%\">\r\n            <tr>\r\n                <td colspan=\"2\">\r\n                     <h1>Order Confirmation</h1><br />\r\n                      $invoiceurl\r\n                 </td>\r\n            </tr>           \r\n            <tr>\r\n                 <td style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\"> $orderno </td>\r\n                 <td >$orderdate</td>\r\n            </tr>\r\n             <tr><td colspan=\"2\"><hr></td></tr>       \r\n            <tr>\r\n                  <td><strong>$billingaddresshead</strong>\r\n                          </td>\r\n                  <td style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\"><strong>$deliveryaddresshead</strong>\r\n                           </td>\r\n             </tr>         \r\n             <tr><td style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$deliveryaddress</td><td style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$billingaddress</td></tr>\r\n             <tr><td colspan=\"2\"><hr></td></tr>            \r\n             <tr>\r\n                  <td colspan=\"2\"><strong>$productsorderedhead</strong></td>\r\n              </tr>\r\n              <tr>\r\n                    <td colspan=\"2\"  align=\"right\" style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$productsordered</td>\r\n             \r\n              <tr>\r\n                     <td colspan=\"2\"  align=\"right\" style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$ordertotal</td>\r\n              </tr>\r\n              <tr><td colspan=\"2\"><hr></td></tr>\r\n               <tr>\r\n                   <td colspan=\"2\"> <strong>$paymethodhead</strong></td>\r\n               </tr>\r\n                <tr>\r\n                     <td>$paymentmethod</td><td>$ccardtype</td>\r\n                 </tr>\r\n                 <tr><td colspan=\"2\" style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$ordercomments\r\n                         </td></tr>\r\n                 <tr><td colspan=\"2\">\r\n                          $storeemail<br />\r\n                          $storeurl\r\n                        </td>\r\n                   </tr>\r\n</table>','order confirmation\r\n\r\n$storename\r\n$storeemail\r\n$separator\r\n$invoiceurl \r\n$orderno\r\n$orderdate\r\n$separator\r\n$deliveryaddresshead\r\n$deliveryaddress\r\n$separator\r\n$billingaddresshead\r\n$billingaddress\r\n$separator\r\n$productsorderedhead\r\n$productsordered\r\n$totaltext\r\n$subtotaltext\r\n$ordertotal\r\n$ccardtype\r\n$separator\r\n$paymethodhead\r\n$paymentmethod\r\n$ordercomments','Bluebox','<tr><td class=\"main\"><strong>Available placeholders:</strong><br /></td></tr>\r\n   								<tr><td ><table><tr><td class=\"main\" valign=\"top\"><ul>\r\n   								<li>$storeurl = store url</li>\r\n   								<li>$storename = store name</li>\r\n   								<li>$storeemail = store email address</li>\r\n   								<li>$invoiceurl = Invoice url</li>\r\n   								<li>$orderno = Order Number</li>\r\n   								<li>$orderdate = Order Date</li>\r\n   								<li>$ordercomments = comments</li>\r\n   								<li>$separator = ============</li>\r\n   								<li>$productsorderedhead =  heading, product list</li>\r\n   								<li>$productsordered =  product list</li>\r\n   								<li>$ordercomments = customer comments</li>\r\n                                                                </ul></td><td class=\"main\" valign=\"top\"><ul>								\r\n   								<li>$deliveryaddresshead = heading, delivery address</li>\r\n   								<li>$deliveryaddress = delivery address</li>\r\n   								<li>$billingaddresshead = heading, billing address</li>\r\n   								<li>$billingaddress = billing address</li>\r\n   								<li>$paymethodhead = heading, payment method</li>\r\n   								<li>$paymentmethod = payment method</li>\r\n                                                                <li>$ccardtype = credit card type</li>                                                               \r\n   								<li>$totaltext = heading, order total</li>\r\n                                                                <li>$subtotaltext = heading, subtotal</li>\r\n   								<li>$ordertotal = order total</li>\r\n   								</ul></td></tr></table></td></tr>',1),(2,'Status Update','<!--content-->\r\n<table><tr><td colspan=\"2\" ><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\"><strong> $storename </strong></p></td></tr>\r\n            <tr><td><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$orderno</p></td>  	\r\n<td align=\"center\"><p align=\"right\" style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$orderdate</p></td></tr>\r\n            <tr>\r\n            	<td colspan=\"2\">\r\n            	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n            		<tr><td height=\"1\"><img src=\"http://www.css-oscommerce.com/images/mail_manager/divider-invoice.jpg\" width=\"100%\" height=\"1\" style=\"display: block;\" /></td></tr>                                                 \r\n            	</table>\r\n            	</td>\r\n            </tr>\r\n            <tr><td colspan=\"2\"><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$statusnewhtml</p></td></tr>                    \r\n            <tr><td colspan=\"2\"><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$comments</p></td></tr>\r\n            <tr><td colspan=\"2\"><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$invoiceurl</p></td></tr></table>        \r\n<!--// content-->','$txtheader\r\n$storeowner\r\n$orderno\r\n$orderdate\r\n$statusnewtxt\r\n$comments\r\n$invoiceurl','Choice','<tr><td class=\"main\"><strong>Available placeholders:</strong><br /></td></tr>\r\n   								<tr><td><table><tr><td class=\"main\" valign=\"top\"><ul>\r\n   								<li>$storeurl = store url</li>\r\n   								<li>$storename = store name</li>\r\n   								<li>$storeemail = store email address</li>\r\n   								<li>$customername = customer name</li>\r\n   								<li>$customeremail = customer email</li>\r\n   								<li>$separator = ============</li></ul></td><td class=\"main\" valign=\"top\"><ul>\r\n   								<li>$orderno =  order number</li>\r\n   								<li>$orderdate =  order date</li>\r\n   								<li>$statusnewhtml = new status, html format</li>\r\n   								<li>$statusnewtxt = new status, txt format</li>\r\n   								<li>$comments = comments</li>\r\n   								<li>$invoiceurl = invoice url</li>\r\n   								</ul></td></tr></table></td></tr>',1),(3,'Password Forgotten','<table>\r\n    <tr>\r\n        <td><br /><br /><br />$emailsubject<br /><br />$newpwandmsg<br /><br /><br /></td>\r\n    </tr>\r\n</table>','$emailsubject\r\n\r\n$newpwandmsg','Email','<tr><td class=\"main\"><strong>Available placeholders:</strong><br /></td></tr>\r\n<tr><td><table><tr><td class=\"main\" valign=\"top\">\r\n<ul>\r\n<li>$storeurl = store url</li>\r\n<li>$storename = store name</li>\r\n<li>$customerfirstname = customer first name</li>\r\n<li>$customerlastname = customer last name</li>\r\n<li>$customeremail = customer email</li>\r\n<li>$emailsubject = email subject (EMAIL_PASSWORD_REMINDER_SUBJECT)</li>\r\n<li>$newpwandmsg = email text + new password (sprintf(EMAIL_PASSWORD_REMINDER_BODY, $new_password))</li>\r\n</ul>\r\n</td></tr></table></td></tr>',1),(4,'Tell A Friend','<table cellspacing=\"10\" cellpadding=\"10\">\r\n    <tr>\r\n        <td colspan=\"2\" >\r\n           Hello $toname,<br /><br />\r\n           Your friend, $fromname,  thought that you would be interested in $products from $storename.<br />\r\n           To view the product click on the link below or copy and paste the link into your web browser:<br /><br />\r\n           $link<br /><br />\r\n           Regards, $storename\r\n            <br/ ><br />\r\n            <hr>\r\n            <br /><br />\r\n             $fromname says:\r\n            <br /><br />\r\n            <em> $message</em>\r\n         </td>\r\n         <td>\r\n              $image\r\n        <p align=\"center\">$product</p>\r\n         </td>\r\n     </tr>\r\n</table>','Hello $toname,\r\nYour friend, $fromname  thought that you would be interested in $product from $storename.\r\n\r\nTo view the product click on the link below or copy and paste the link into your web browser:\r\n\r\n$link\r\n\r\nRegards, $storename\r\n\r\n-----------------------------------------------------------------\r\n$fromname says:\r\n\r\n$message','Cssosc','<tr><td class=\"main\"><strong>Available placeholders:</strong><br /></td></tr>\r\n                             <tr><td><table><tr><td class=\"main\" valign=\"top\">\r\n<ul>\r\n<li>$storeurl = store url</li>\r\n<li>$storeemail = store email</li>\r\n<li>$storename = store name</li>\r\n<li>$toname = email sent to</li>\r\n<li>$fromname = email sent from</li>\r\n</ul></td><td class=\"main\" valign=\"top\"><ul>\r\n<li>$product = product name</li>\r\n<li>$link = link to product</li>\r\n<li>$image = product image</li>\r\n<li>$message = message</li>\r\n</ul>\r\n</td></tr></table></td></tr>',1);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mm_responsemail_reset`
--

LOCK TABLES `mm_responsemail_reset` WRITE;
/*!40000 ALTER TABLE `mm_responsemail_reset` DISABLE KEYS */;
INSERT INTO `mm_responsemail_reset` VALUES (0,'Create Account','<!--content-->\r\n<tr>\r\n    <td>\r\n        <table bgcolor=\"#FFFFFF\">\r\n             <tr>\r\n                <td>\r\n                     \r\n<p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$mmgreet<br/>$mmwelcome</p>\r\n<p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$mmtext</p>\r\n<p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$mmcontact</p>\r\n<p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$mmwarning\r\n</p>\r\n              </td>\r\n      	  </tr>\r\n          <tr>\r\n                <td>\r\n            	       <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n            		     <tr>\r\n                                   <td height=\"1\"><img src=\"http://www.css-oscommerce.com/images/mail_manager/divider-invoice.jpg\" width=\"100%\" height=\"1\" style=\"display: block;\" />\r\n                                   </td>\r\n                            </tr>                                                 \r\n            	         </table>\r\n            	</td>\r\n            </tr>\r\n        </table>\r\n    </td>\r\n</tr>\r\n<!--// content-->','$mmgreet\r\n\r\n$mmwelcome\r\n\r\n$mmtext\r\n\r\n$mmcontact\r\n\r\n$mmwarning','Cityscape','',1),(1,'Order Confirmation','<table border=\"0\" cellpadding=\"10\" cellpadding=\"10\" bgcolor=\"#FFFFFF\" width=\"100%\">\r\n            <tr>\r\n                <td colspan=\"2\">\r\n                     <h1>Order Confirmation</h1><br />\r\n                      $invoiceurl\r\n                 </td>\r\n            </tr>           \r\n            <tr>\r\n                 <td style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\"> $orderno </td>\r\n                 <td >$orderdate</td>\r\n            </tr>\r\n             <tr><td colspan=\"2\"><hr></td></tr>       \r\n            <tr>\r\n                  <td><strong>$billingaddresshead</strong>\r\n                          </td>\r\n                  <td style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\"><strong>$deliveryaddresshead</strong>\r\n                           </td>\r\n             </tr>         \r\n             <tr><td style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$deliveryaddress</td><td style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$billingaddress</td></tr>\r\n             <tr><td colspan=\"2\"><hr></td></tr>            \r\n             <tr>\r\n                  <td colspan=\"2\"><strong>$productsorderedhead</strong></td>\r\n              </tr>\r\n              <tr>\r\n                    <td colspan=\"2\"  align=\"right\" style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$productsordered</td>\r\n             \r\n              <tr>\r\n                     <td colspan=\"2\"  align=\"right\" style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$ordertotal</td>\r\n              </tr>\r\n              <tr><td colspan=\"2\"><hr></td></tr>\r\n               <tr>\r\n                   <td colspan=\"2\"> <strong>$paymethodhead</strong></td>\r\n               </tr>\r\n                <tr>\r\n                     <td>$paymentmethod</td><td>$ccardtype</td>\r\n                 </tr>\r\n                 <tr><td colspan=\"2\" style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;\">$ordercomments\r\n                         </td></tr>\r\n                 <tr><td colspan=\"2\">\r\n                          $storeemail<br />\r\n                          $storeurl\r\n                        </td>\r\n                   </tr>\r\n</table>','order confirmation\r\n\r\n$storename\r\n$storeemail\r\n$separator\r\n$invoiceurl \r\n$orderno\r\n$orderdate\r\n$separator\r\n$deliveryaddresshead\r\n$deliveryaddress\r\n$separator\r\n$billingaddresshead\r\n$billingaddress\r\n$separator\r\n$productsorderedhead\r\n$productsordered\r\n$totaltext\r\n$subtotaltext\r\n$ordertotal\r\n$ccardtype\r\n$separator\r\n$paymethodhead\r\n$paymentmethod\r\n$ordercomments','Bluebox','<tr><td class=\"main\"><strong>Available placeholders:</strong><br /></td></tr>\r\n   								<tr><td ><table><tr><td class=\"main\" valign=\"top\"><ul>\r\n   								<li>$storeurl = store url</li>\r\n   								<li>$storename = store name</li>\r\n   								<li>$storeemail = store email address</li>\r\n   								<li>$invoiceurl = Invoice url</li>\r\n   								<li>$orderno = Order Number</li>\r\n   								<li>$orderdate = Order Date</li>\r\n   								<li>$ordercomments = comments</li>\r\n   								<li>$separator = ============</li>\r\n   								<li>$productsorderedhead =  heading, product list</li>\r\n   								<li>$productsordered =  product list</li>\r\n   								<li>$ordercomments = customer comments</li>\r\n                                                                </ul></td><td class=\"main\" valign=\"top\"><ul>								\r\n   								<li>$deliveryaddresshead = heading, delivery address</li>\r\n   								<li>$deliveryaddress = delivery address</li>\r\n   								<li>$billingaddresshead = heading, billing address</li>\r\n   								<li>$billingaddress = billing address</li>\r\n   								<li>$paymethodhead = heading, payment method</li>\r\n   								<li>$paymentmethod = payment method</li>\r\n                                                                <li>$ccardtype = credit card type</li>                                                               \r\n   								<li>$totaltext = heading, order total</li>\r\n                                                                <li>$subtotaltext = heading, subtotal</li>\r\n   								<li>$ordertotal = order total</li>\r\n   								</ul></td></tr></table></td></tr>',1),(2,'Status Update','<!--content-->\r\n<table><tr><td colspan=\"2\" ><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\"><strong> $storename </strong></p></td></tr>\r\n            <tr><td><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$orderno</p></td>  	\r\n<td align=\"center\"><p align=\"right\" style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$orderdate</p></td></tr>\r\n            <tr>\r\n            	<td colspan=\"2\">\r\n            	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n            		<tr><td height=\"1\"><img src=\"http://www.css-oscommerce.com/images/mail_manager/divider-invoice.jpg\" width=\"100%\" height=\"1\" style=\"display: block;\" /></td></tr>                                                 \r\n            	</table>\r\n            	</td>\r\n            </tr>\r\n            <tr><td colspan=\"2\"><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$statusnewhtml</p></td></tr>                    \r\n            <tr><td colspan=\"2\"><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$comments</p></td></tr>\r\n            <tr><td colspan=\"2\"><p style=\"font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">$invoiceurl</p></td></tr></table>        \r\n<!--// content-->','$txtheader\r\n$storeowner\r\n$orderno\r\n$orderdate\r\n$statusnewtxt\r\n$comments\r\n$invoiceurl','Choice','<tr><td class=\"main\"><strong>Available placeholders:</strong><br /></td></tr>\r\n   								<tr><td><table><tr><td class=\"main\" valign=\"top\"><ul>\r\n   								<li>$storeurl = store url</li>\r\n   								<li>$storename = store name</li>\r\n   								<li>$storeemail = store email address</li>\r\n   								<li>$customername = customer name</li>\r\n   								<li>$customeremail = customer email</li>\r\n   								<li>$separator = ============</li></ul></td><td class=\"main\" valign=\"top\"><ul>\r\n   								<li>$orderno =  order number</li>\r\n   								<li>$orderdate =  order date</li>\r\n   								<li>$statusnewhtml = new status, html format</li>\r\n   								<li>$statusnewtxt = new status, txt format</li>\r\n   								<li>$comments = comments</li>\r\n   								<li>$invoiceurl = invoice url</li>\r\n   								</ul></td></tr></table></td></tr>',1),(3,'Password Forgotten','<table>\r\n    <tr>\r\n        <td><br /><br /><br />$emailsubject<br /><br />$newpwandmsg<br /><br /><br /></td>\r\n    </tr>\r\n</table>','$emailsubject\r\n\r\n$newpwandmsg','Email','<tr><td class=\"main\"><strong>Available placeholders:</strong><br /></td></tr>\r\n<tr><td><table><tr><td class=\"main\" valign=\"top\">\r\n<ul>\r\n<li>$storeurl = store url</li>\r\n<li>$storename = store name</li>\r\n<li>$customerfirstname = customer first name</li>\r\n<li>$customerlastname = customer last name</li>\r\n<li>$customeremail = customer email</li>\r\n<li>$emailsubject = email subject (EMAIL_PASSWORD_REMINDER_SUBJECT)</li>\r\n<li>$newpwandmsg = email text + new password (sprintf(EMAIL_PASSWORD_REMINDER_BODY, $new_password))</li>\r\n</ul>\r\n</td></tr></table></td></tr>',1),(4,'Tell A Friend','<table cellspacing=\"10\" cellpadding=\"10\">\r\n    <tr>\r\n        <td colspan=\"2\" >\r\n           Hello $toname,<br /><br />\r\n           Your friend, $fromname,  thought that you would be interested in $products from $storename.<br />\r\n           To view the product click on the link below or copy and paste the link into your web browser:<br /><br />\r\n           $link<br /><br />\r\n           Regards, $storename\r\n            <br/ ><br />\r\n            <hr>\r\n            <br /><br />\r\n             $fromname says:\r\n            <br /><br />\r\n            <em> $message</em>\r\n         </td>\r\n         <td>\r\n              $image\r\n        <p align=\"center\">$product</p>\r\n         </td>\r\n     </tr>\r\n</table>','Hello $toname,\r\nYour friend, $fromname  thought that you would be interested in $product from $storename.\r\n\r\nTo view the product click on the link below or copy and paste the link into your web browser:\r\n\r\n$link\r\n\r\nRegards, $storename\r\n\r\n-----------------------------------------------------------------\r\n$fromname says:\r\n\r\n$message','Cssosc','<tr><td class=\"main\"><strong>Available placeholders:</strong><br /></td></tr>\r\n                             <tr><td><table><tr><td class=\"main\" valign=\"top\">\r\n<ul>\r\n<li>$storeurl = store url</li>\r\n<li>$storeemail = store email</li>\r\n<li>$storename = store name</li>\r\n<li>$toname = email sent to</li>\r\n<li>$fromname = email sent from</li>\r\n</ul></td><td class=\"main\" valign=\"top\"><ul>\r\n<li>$product = product name</li>\r\n<li>$link = link to product</li>\r\n<li>$image = product image</li>\r\n<li>$message = message</li>\r\n</ul>\r\n</td></tr></table></td></tr>',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mm_templates`
--

LOCK TABLES `mm_templates` WRITE;
/*!40000 ALTER TABLE `mm_templates` DISABLE KEYS */;
INSERT INTO `mm_templates` VALUES (14,'Bluebox','<html xmlns=\"http://www.w3.org/1999/xhtml\">\r\n<head>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />\r\n	<title></title>\r\n</head>\r\n<body leftmargin=\"0\" marginwidth=\"0\" topmargin=\"0\" marginheight=\"0\" offset=\"0\" style=\"margin:0;padding:0;\"><img src=\"http://www.css-oscommerce.com/images/mail_manager/transp.gif\" />\r\n<table id=\"bodywrap\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\" height=\"100%\">\r\n<tr><td bgcolor=\"white\" style=\"font-family:arial,sans-serif;font-size:12px; color:#000000;\" valign=\"top\">	\r\n<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"600\" bgcolor=\"#11a0dc\" align=\"center\" style=\"-webkit-border-radius:10px;-moz-border-radius:10px;border-radius:10px;background:#11a0dc;margin-top:4px;\">\r\n	    <tr>\r\n		    <td>\r\n	            <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"560\" height=\"69\" align=\"center\">\r\n		            <tr>\r\n						<td width=\"4\">&nbsp;</td>\r\n<td width=\"210\" style=\"font-family:arial,sans-serif;font-size:12px;\" align=\"left\" valign=\"middle\">\r\n<div style=\"font-weight:bold;font-size:16px;color:black;\">This is Editable Text</div>\r\n<div style=\"font-weight:bold;font-size:22px;color:white;\">And So is This</div>\r\n</td>\r\n<td width=\"216\" align=\"right\" style=\"font-family:arial,sans-serif;\">\r\n <a href=\"http://www.mysite.com\" style=\"color:white;font-weight:bold;\">\r\n<img border=\"0\" alt=\"mysite.com\" width=\"216\" height=\"69\" src=\"http://www.css-oscommerce.com/images/mail_manager/blue-logo.jpg\"/></a>\r\n		                </td>\r\n		            </tr>\r\n		        </table>\r\n\r\n                <table width=\"570\" align=\"center\" cellpadding=\"10\" bgcolor=\"#FFFFFF\" style=\"background:#FFFFFF;-webkit-border-radius:10px;-moz-border-radius:10px;border-radius:10px;\">\r\n<tr>\r\n<td align=\"center\" width=\"190\" valign=\"top\" style=\"font-family:arial,sans-serif;font-size:12px;\">','</td>\r\n    				</tr>\r\n    			</table>				\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n		    <td><img src=\"http://www.css-oscommerce.com/images/mail_manager/blue-skyline.jpg\" style=\"vertical-align:bottom;\" width=\"600\" height=\"151\" alt=\"\"></td>\r\n		</tr>\r\n	</table>	\r\n<br/><br/>\r\n	<table cellspacing=\"0\" cellpadding=\"8\" border=\"0\" width=\"560\" align=\"center\">\r\n	    <tr>\r\n		    <td style=\"font-family:arial,sans-serif;font-size:12px;\">\r\n				<div style=\"color:#333333\">\r\n					<p>\r\nThis message was sent to the following e-mail address: myemail@me.com<br/>\r\n					We hope you found this message to be useful. However, if you\'d rather not receive future emails of this sort from CityScape, it\'s easy to <a href=\"http://www.mysite.com\">unsubscribe</a>.\r\n					</p>\r\n					<p>\r\n					Be sure to add MYSite@mysite.com to your address book or safe senders list so our emails get to your inbox.						\r\n					</p>\r\n					<p>\r\n					Note: This email was sent from a notification-only email address that cannot accept incoming email. Please do not reply to this email unless you really enjoy reading automated email replies. 	\r\n					</p>\r\n					<p>\r\n					&copy; 2011 MySite or its affiliates. All rights reserved. MySite and the MySiteLocal logo are trademarks of MySite.com, Inc. or its affiliates. MySiteLocal, 123 Madison Ave. New York, NY 10003. \r\n					</p>\r\n				</div>\r\n			</td>\r\n		</tr>\r\n	</table>			\r\n	\r\n	\r\n</td></tr></table>	\r\n<img src=\"http://www.css-oscommerce.com/images/mail_manager/transp.gif\" /></body>\r\n</html>','Today\'s Blue Local deal in Your Town','!-----------------------------------------------------------------------------\r\nThis message was sent to the following email address: myemail@me.com \r\nWe hope you found this message to be useful. However, if you\'d rather not\r\nreceive future emails of this sort from MySiteLocal, unsubscribe here:\r\nhttp://local.MySite.com \r\n(c) 2011 MySite or its affiliates. All rights reserved. MySite and\r\nthe MySite logo are trademarks of MySite.com, Inc. or its affiliates.\r\nMySite, 123 Madison Ave., New York, NY 10003.'),(16,'Cityscape','<!-- header /Table used to center email -->\r\n<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"660px\">\r\n	<tr>\r\n		<td bgcolor=\"#ffffff\">								\r\n		<div align=\"center\">\r\n		<!-- Table used to set width of email -->	\r\n		<span style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; color: #444444; font-weight: bold\" align=\"center\">							\r\n		Your CityScape Deal &nbsp; | &nbsp; <a href=\"http://mysite.com\">Go to MySite.com</a> &nbsp; | &nbsp; <a href=\"http://tracking.mysite.com\">Unsubscribe</a></span>&nbsp; &nbsp;&nbsp;\r\n		</div>\r\n		<div align=\"center\">\r\n		<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"660\">\r\n			<tr>\r\n				<td style=\"padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px\">																\r\n				<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">					<!--Preheader-->																		<!--Header-->																			<tr><td bgcolor=\"#e7e7e7\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">\r\n<tr><td width=\"286\" valign=\"bottom\">\r\n<img style=\"display: block; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; color: #444444\" src=\"http://www.css-oscommerce.com/images/mail_manager/cityscape_logo.jpg\" border=\"0\" alt=\"CityScape Deal\" width=\"286\" height=\"127\" /></td><td width=\"334\" valign=\"bottom\" style=\"padding-top: 0px; padding-right: 20px; padding-bottom: 0px; padding-left: 0px\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\"><tr><td style=\"padding-top: 0px; padding-right: 0px; padding-bottom: 10px; padding-left: 0px\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\"><tr><td height=\"117\" align=\"right\" valign=\"middle\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\"><tr></tr><tr><td align=\"right\" style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #444444; font-weight: bold\">Thursday, July 7,  2011<p>\r\n<a href=\"http://tracking.mysite.com\">See today&#39;s deal</a></p>\r\n</td></tr></table></td>	</tr></table></td>	</tr></table></td></tr></table>\r\n</td></tr><tr><td bgcolor=\"#000000\"><img style=\"display: block\" src=\"http://www.css-oscommerce.com/images/mail_manager/cityscape_divider.gif\" border=\"0\" alt=\"\" width=\"640\" height=\"28\" /></td>	</tr><tr>\r\n						<td style=\"padding-top: 20px; padding-right: 20px; padding-bottom: 20px; padding-left: 20px; background-repeat: no-repeat no-repeat\" bgcolor=\"#29c3f9\" background=\"http://www.css-oscommerce.com/images/mail_manager/cityscape_bg.gif\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\"><tr><td bgcolor=\"#ffffff\">','<!--footer--></td></tr></table>\r\n</td></tr><tr><td align=\"center\"><p><span style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; color: #444444; font-weight: bold\" align=\"center\">You are receiving this e-mail because you signed up for CityScape Deal Alerts. If you prefer not to receive CityScape e-mails, you can <a href=\"http://tracking.mysite.com\">unsubscribe with one click</a></span></p><p><span style=\"font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; color: #444444; font-weight: bold\" align=\"center\">This e-mail was delivered by CityScape 100 North Tower, Suite 123, New York NY 10003&nbsp;</span></p></td></tr></table></td></tr></table>\r\n		</div>\r\n		</td>				\r\n	</tr>\r\n</table>\r\n<!-- END Table used to center email --><custom name=\"opencounter\" type=\"tracking\"></custom>\r\n<img src=\"http://tracking.mysite.com\" width=1 height=1 border=0>','Mysite text Header','MySite text footer'),(17,'Cssosc','<html>\r\n<body style=\"padding: 0px; margin: 0px; background-color:#ffffff;\" marginheight=\"0\" topmargin=\"0\" marginwidth=\"0\" leftmargin=\"0\" bgcolor=\"#ebebeb\" >\r\n<table width=\"100%\" cellspacing=\"0\" border=\"0\" cellpadding=\"0\"  bgcolor=\"#ebebeb\" align=\"center\"><tr><td align=\"center\" valign=\"top\">\r\n<!--WRAPPER-->\r\n<table width=\"610\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td align=\"center\">\r\n<!--CONTAINER-->             \r\n<table width=\"600\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FFFFFF\" >\r\n<!-- HEADER IMAGE-->                 	\r\n	<tr height=\"20\"><td bgcolor=\"#ebebeb\" ></td></tr>\r\n<!--//HEADER IMAGE -->\r\n<!-- LOGO AND HEADER -->\r\n    <tr>\r\n    	<td align=\"center\" valign=\"top\">\r\n        	<table cellpadding=\"0\" cellspacing=\"0\"  >\r\n            	<!--TOP CURVE -->\r\n            	<tr><td width=\"600\" align=\"center\" valign=\"top\"><img src=\"http://www.css-oscommerce.com/images/mail_manager/niora-headercurve.jpg\" width=\"600\" height=\"18\" border=\"0\" style=\"display: block;\" /></td></tr>\r\n                <!--//TOP CURVE-->\r\n                <tr>\r\n                    <td width=\"600\" align=\"left\" valign=\"top\" bgcolor=\"#FFFFFF\">                    \r\n                    	<!--NIORA-->\r\n                    	<table width=\"600\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" >\r\n                    	<tr>\r\n                    	<td width=\"20\"></td>\r\n                    	<td align=\"left\">\r\n                    	<img src=\"http://www.css-oscommerce.com/images/mail_manager/niora-logo.png\" width=\"345\" height=\"40\" border=\"0\" style=\"display: block;\" />\r\n                    	</td>\r\n                    	<td style=\"font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color: #666666; margin:7px 0px;\" width=\"75\" align=\"right\" valign=\"top\">Follow us on<br /> Facebook.</td>\r\n                    	<td valign=\"top\" width=\"50\" align=\"center\">\r\n                    	<a href=\"http://www.facebook.com/pages\" target=\"blank\"><img title=\"Facebook Like Button\" src=\"http://www.css-oscommerce.com/images/mail_manager/niora-fb-thumb.png\" width=\"\" height=\"\" alt=\"facebook thumb\" border=\"none\"/></a>\r\n                    	</td></tr>\r\n                    	</table>\r\n                    </td>\r\n               </tr>               \r\n                <tr><td height=\"1\"><img src=\"http://www.css-oscommerce.com/images/mail_manager/niora-divider.jpg\" width=\"600\" height=\"1\" style=\"display: block;\" /></td></tr>\r\n            </table>\r\n      </td>\r\n    </tr>\r\n    <tr><td align=\"center\" valign=\"top\">','</td></tr>\r\n<tr>\r\n    	<td align=\"center\" valign=\"top\">\r\n        	<table cellpadding=\"0\" cellspacing=\"0\" >\r\n        		<tr><td><img src=\"http://www.css-oscommerce.com/images/mail_manager/niora-divider.jpg\" width=\"560\" height=\"1\" style=\"display: block;\" /></td></tr>\r\n            </table>\r\n         </td>\r\n     </tr>\r\n<tr>\r\n <td align=\"center\">\r\n    <table width=\"600\" cellpadding=\"0\" cellspacing=\"0\" style=\"padding:10px 0px;\"  bgcolor=\"#FFFFFF\">\r\n      <tr>\r\n        <td align=\"left\" width=\"165\" valign=\"top\">\r\n           <p style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">Find out more:</p>\r\n           <p style=\"font-family: Arial, Helvetica, sans-serif; font-size: 11px; line-height: 16px; color: #999999; margin: 10px;\">Visit us at <a href=\"http://www.css-oscommerce.com\">www.css-oscommerce.com</a></p>\r\n        </td>\r\n        <td align=\"left\" width=\"2\" valign=\"bottom\">\r\n        	<img src=\"http://www.css-oscommerce.com/images/mail_manager/niora_footer_div_vert.jpg\" width=\"1\" height=\"100\" style=\"display: block;\" />\r\n        </td>\r\n        <td align=\"left\" width=\"165\" valign=\"top\">\r\n           <p style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">Contact us:</p>\r\n           <p style=\"font-family: Arial, Helvetica, sans-serif; font-size: 11px; line-height: 16px; color: #999999; margin: 10px;\">1001 Madison Ave<br /> New York, NY 10001<br />Phone: (800)123-4567<br />Email: <a href=\"mailto:contact@yoursite.com\">contact@yoursite.com</a></p>\r\n        </td>\r\n        <td align=\"left\" width=\"3\" valign=\"bottom\">\r\n           <img src=\"http://www.css-oscommerce.com/images/mail_manager/niora_footer_div_vert.jpg\" width=\"1\" height=\"100\" style=\"display: block;\" />\r\n        </td>\r\n        <td align=\"left\" width=\"165\" valign=\"top\">\r\n           <p style=\"font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;\">Follow us on Facebook:</p>\r\n               <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"margin-left: 10px;\">\r\n                 <tr>\r\n                   <td width=\"100\" align=\"center\"><a href=\"http://www.facebook.com\" target=\"blank\">\r\n                     <img title=\"Facebook Like Button\" src=\"http://www.css-oscommerce.com/images/mail_manager/niora-fb-thumb.png\" width=\"\" height=\"\" alt=\"facebook thumb\" border=\"none\"/></a>\r\n                   </td>                                                                                            \r\n                 </tr>\r\n               </table>  \r\n        </td>\r\n       </tr>\r\n    </table>\r\n  </td>\r\n</tr>\r\n<tr>\r\n  <td align=\"center\">\r\n  	<img src=\"http://www.css-oscommerce.com/images/mail_manager/niora-footercurve.jpg\" width=\"600\" height=\"10\" style=\"display: block;\"/>\r\n  </td> \r\n</tr>        \r\n</table>  \r\n</td>\r\n</tr>\r\n<tr>\r\n <td align=\"center\">\r\n    <table width=\"560\" cellpadding=\"0\" cellspacing=\"0\">\r\n     <tr>\r\n       <td align=\"left\" width=\"165\" valign=\"top\">\r\n       		<p style=\"font-family: Arial, Helvetica, sans-serif; font-size: 11px; line-height: 16px; color: #999999; margin: 10px;\">If this email is not displaying correctly, <a href=\"http://www.mysite.com\">click here</a> to view it online.</p>\r\n       </td>\r\n       <td align=\"left\" width=\"165\" valign=\"top\">\r\n            <p style=\"font-family: Arial, Helvetica, sans-serif; font-size: 11px; line-height: 16px; color: #999999; margin: 10px;\"> To be removed from this mailing list click <a href=\"mailto:unsubscribe@mysite.com?subject=Unsubscribe&body=Please%20remove%20my%20email%20from%20your%20list\" ><u>here</u></a></p>\r\n       </td>\r\n       <td align=\"left\" width=\"165\" valign=\"top\">\r\n           <p style=\"font-family: Arial, Helvetica, sans-serif; font-size: 11px; line-height: 16px; color: #999999; margin: 10px;\">Forward this email to a friend by <a href=\"mailto:?subject=MyStore&body=You%20May%20be%20interested%20in%20www.mysite.com\">clicking here.</a></p>\r\n       </td>\r\n     </tr>\r\n    </table>\r\n  </td>\r\n</tr>\r\n</table>    \r\n</td>\r\n</tr>\r\n</table>\r\n</body>\r\n</html>','',''),(18,'Choice','<html><head>\r\n		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n		<title>\r\n			Email Title\r\n		</title>\r\n	</head>\r\n	<body style=\"margin: 0;padding: 0;background-color: #ffffff;\">\r\n		<p>\r\n			<a name=\"top\" id=\"top\"></a>\r\n		</p>\r\n		<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n			<tr>\r\n				<td align=\"center\">\r\n					<table width=\"580\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n						<tr>\r\n							<td class=\"permission\" align=\"center\" style=\"padding: 20px 0 20px 0;\">\r\n								<p style=\"font-family: \'Lucida Grande\', sans-serif;font-size: 10px;font-weight: normal;color: #151515;\">\r\n									Add Team@My Site.org to your address book to make sure our email updates land in your inbox\r\n								</p>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td class=\"header\" style=\"padding: 16px;background-color: #f5f5f5;\">\r\n								<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"background-color: #f5f5f5;\">\r\n									<tr>\r\n										<td class=\"mainbar\" align=\"left\" valign=\"bottom\">\r\n											<a style=\"font-family: \'Lucida Grande\', sans-serif;font-size: 12px;font-weight: normal;color: #a72323;text-decoration: none;\" href=\"http://mailer2sg.mysite.org\"><img src=\"http://www.css-oscommerce.com/images/mail_manager/choice_logo.png\" alt=\"My SIte\" width=\"216\" height=\"115\" align=\"center\" style=\"border: none;\"></a>\r\n										</td>\r\n										<td align=\"right\">\r\n											<h1 style=\"font-family: Georgia, serif;font-family: \'Lucida Grande\', sans-serif;font-size: 20px;color: #7a7f23;font-weight: bold;\">\r\n												This is Editable Text\r\n											</h1>\r\n										</td>\r\n									</tr>\r\n									<tr>\r\n										<td class=\"header_bottom\" colspan=\"2\" style=\"border-bottom: 1px solid #CCCCCC;border-top: 1px solid #CCCCCC;font-size: 2px;\">\r\n											&nbsp;\r\n										</td>\r\n									</tr>\r\n								</table>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td>\r\n								<table width=\"580\" height=\"130\" border=\"0\" cellspacing=\"16\" cellpadding=\"0\" style=\"background-color: #f5f5f5;\">\r\n									<tr>\r\n										<td class=\"mainbar\" align=\"left\" valign=\"top\" width=\"580\">','</td>\r\n									</tr>\r\n								</table>\r\n							</td>\r\n						</tr>\r\n					</table>\r\n					<table width=\"646\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n						<tr>\r\n							<td>\r\n								<img src=\"http://www.css-oscommerce.com/images/mail_manager/choice_footer_tail.jpg\" alt=\"Footer\" width=\"646\" height=\"87\">\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td>\r\n								<table width=\"646\" height=\"20\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" >\r\n									<tr>\r\n										<td align=\"center\" valign=\"top\" width=\"313\">\r\n											<a href=\"http://mailer2sg.mysite.org\" style=\"color:#FFFFFF;text-decoration:underline;\"><img alt=\"Support us - Donate\" src=\"http://www.css-oscommerce.com/images/mail_manager/choice_donate.png\" style=\"border-width:0;vertical-align:bottom;\"></a> \r\n											\r\n											<a href=\"http://mailer2sg.mysite.org\" style=\"color:#FFFFFF;text-decoration:underline;\"><img alt=\"Follow us on Facebook\" src=\"http://www.css-oscommerce.com/images/mail_manager/choice_facebook.png\" style=\"border-width:0;vertical-align:bottom;\"></a>\r\n<a href=\"http://mailer2sg.catalogchoice.org\" style=\"color:#FFFFFF;text-decoration:underline;\"><img alt=\"Follow us on Twitter\" src=\"http://www.css-oscommerce.com/images/mail_manager/choice_twitter.png\" style=\"border-width:0;vertical-align:bottom;\"></a>\r\n<a href=\"http://mailer2sg.catalogchoice.org\" style=\"color:#FFFFFF;text-decoration:underline;\"><img alt=\"Read our Blog\" src=\"http://www.css-oscommerce.com/images/mail_manager/choice_blog.png\" style=\"border-width:0;vertical-align:bottom;\"></a>\r\n										</td>\r\n									</tr>\r\n								</table>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td align=\"center\" style=\"padding: 20px 0 20px 0;\">\r\n								<p style=\"font-family: \'Lucida Grande\', sans-serif;font-size: 10px;font-weight: normal;color: #151515;\">\r\n									Not interested anymore? <a class=\"button\" href=\"http://mailer2sg.mysite.org\" style=\"color:#36581F; font-size:11px; font-weight:normal; text-align:center; text-decoration: underline;\">Unsubscribe from our email here</a>\r\n								</p>\r\n								<p style=\"font-family: \'Lucida Grande\', sans-serif;font-size: 10px;font-weight: normal;color: #151515;\">\r\n									<span>My Site 123 Madison Ave, New York, NY 10003</span> <a href=\"http://mailer2sg.mysite.org/wf\" style=\"text-decoration:underline;color:#35511E;\">Privacy Policy</a>\r\n								</p>\r\n							</td>\r\n						</tr>\r\n					</table>\r\n				</td>\r\n			</tr>\r\n		</table>\r\n		<p>\r\n			<img src=\"http://www.css-oscommerce.com/images/mail_manager/choice_spacer.gif\">\r\n		</p>\r\n	\r\n<img src=\"http://www.css-oscommerce.com/images/mail_manager/choice_open.gif\" alt=\"\">\r\n</body>\r\n</html>','Add Team@mysite.org to your address book to make sure our\r\nemail updates land in your inbox\r\n\r\nCatalog Choice: Together We Make a Difference','P.S. Still getting unwanted mail or phone books? Log in to your\r\naccount and opt out.\r\n\r\nNot interested anymore? Unsubscribe from our email here\r\nhttps://www.mysite.org/mass_emails/423/unsubscribe\r\n\r\nMy Site 123 Madison Ave, New York, NY, 10003 Privacy\r\nPolicy http://www.mysite.org/privacy'),(19,'Email','<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n			<tr>\r\n				<td align=\"center\">\r\n					<table width=\"580\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n						<tr>\r\n							<td class=\"permission\" align=\"center\" style=\"padding: 20px 0 20px 0;\">\r\n								<p style=\"font-family: \'Lucida Grande\', sans-serif;font-size: 10px;font-weight: normal;color: #151515;\">\r\n									Add Team@mysite.org to your address book to make sure our email updates land in your inbox\r\n								</p>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td class=\"header\" style=\"padding: 16px;background-color: #f5f5f5;\">\r\n								<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"background-color: #f5f5f5;\">\r\n									<tr>\r\n										<td class=\"mainbar\" align=\"left\" valign=\"bottom\">\r\n											<a style=\"font-family: \'Lucida Grande\', sans-serif;font-size: 12px;font-weight: normal;color: #a72323;text-decoration: none;\" href=\"http://mailer2sg.mysite.org\"><img src=\"http://www.css-oscommerce.com/images/mail_manager/choice_logo.png\" alt=\"My Site\" width=\"179\" height=\"115\" align=\"center\" style=\"border: none;\"></a>\r\n										</td>\r\n										<td align=\"right\">\r\n											<h1 style=\"font-family: Georgia, serif;font-family: \'Lucida Grande\', sans-serif;font-size: 20px;color: #7a7f23;font-weight: bold;\">\r\n												Together We Make A Difference\r\n											</h1>\r\n										</td>\r\n									</tr>\r\n									<tr>\r\n										<td class=\"header_bottom\" colspan=\"2\" style=\"border-bottom: 1px solid #CCCCCC;border-top: 1px solid #CCCCCC;font-size: 2px;\">\r\n											&nbsp;\r\n										</td>\r\n									</tr>\r\n								</table>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td>\r\n								<table width=\"580\" height=\"130\" border=\"0\" cellspacing=\"16\" cellpadding=\"0\" style=\"background-color: #f5f5f5;\">\r\n									<tr>\r\n										<td class=\"mainbar\" align=\"left\" valign=\"top\" width=\"580\">\r\n<table width=\"400\" align=\"center\"><tr><td style=\"font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color: #666666; margin:7px 0px;\" width=\"50%\" align=\"left\" valign=\"top\">','</td></tr></table>\r\n</td>\r\n									</tr>\r\n								</table>\r\n							</td>\r\n						</tr>\r\n					</table>\r\n					<table width=\"646\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n						<tr>\r\n							<td>\r\n								<img src=\"http://www.css-oscommerce.com/images/mail_manager/choice_footer_tail.jpg\" alt=\"Footer\" width=\"646\" height=\"87\">\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td>\r\n								<table width=\"646\" height=\"20\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n									<tr>\r\n										<td align=\"center\" valign=\"top\" width=\"313\">\r\n											<a href=\"http://mailer2sg.catalogchoice.org\" style=\"color:#FFFFFF;text-decoration:underline;\"><img alt=\"Support us - Donate\" src=\"http://www.css-oscommerce.com/images/mail_manager/choice_donate.png\" style=\"border-width:0;vertical-align:bottom;\"></a> \r\n											\r\n											<a href=\"http://mailer2sg.catalogchoice.org\" style=\"color:#FFFFFF;text-decoration:underline;\"><img alt=\"Follow us on Facebook\" src=\"http://www.css-oscommerce.com/images/mail_manager/choice_facebook.png\" style=\"border-width:0;vertical-align:bottom;\"></a>\r\n<a href=\"http://mailer2sg.catalogchoice.org\" style=\"color:#FFFFFF;text-decoration:underline;\"><img alt=\"Follow us on Twitter\" src=\"http://www.css-oscommerce.com/images/mail_manager/choice_twitter.png\" style=\"border-width:0;vertical-align:bottom;\"></a>\r\n<a href=\"http://mailer2sg.catalogchoice.org\" style=\"color:#FFFFFF;text-decoration:underline;\"><img alt=\"Read our Blog\" src=\"http://www.css-oscommerce.com/images/mail_manager/choice_blog.png\" style=\"border-width:0;vertical-align:bottom;\"></a>\r\n										</td>\r\n									</tr>\r\n								</table>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td align=\"center\" style=\"padding: 20px 0 20px 0;\">\r\n								<p style=\"font-family: \'Lucida Grande\', sans-serif;font-size: 10px;font-weight: normal;color: #151515;\">\r\n									Not interested anymore? <a class=\"button\" href=\"http://mailer2sg.mysite.org\" style=\"color:#36581F; font-size:11px; font-weight:normal; text-align:center; text-decoration: underline;\">Unsubscribe from our email here</a>\r\n								</p>\r\n								<p style=\"font-family: \'Lucida Grande\', sans-serif;font-size: 10px;font-weight: normal;color: #151515;\">\r\n									<span>My Site 123 Madison Ave, New York, NY 10003</span> <a href=\"http://mailer2sg.catalogchoice.org/wf\" style=\"text-decoration:underline;color:#35511E;\">Privacy Policy</a>\r\n								</p>\r\n							</td>\r\n						</tr>\r\n					</table>\r\n				</td>\r\n			</tr>\r\n		</table>','',''),(20,'Bluesky','<table style=\"width: 700px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" bgcolor=\"#ffffff\">\r\n  <tbody>\r\n    <tr>\r\n      <td colspan=\"6\">\r\n        <img src=\"http://www.css-oscommerce.com/images/mail_manager/bluesky_headover.jpg\" border=\"0\" alt=\"Headertop\" width=\"700\" height=\"25\" />\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n      <td colspan=\"6\">\r\n        <img src=\"http://www.css-oscommerce.com/images/mail_manager/bluesky_headunder.jpg\" border=\"0\" alt=\"Bluesky\" width=\"700\" height=\"83\" />\r\n      </td>\r\n    </tr>\r\n    <tr>\r\n       <td width=\"15\">&nbsp;</td>\r\n       <td width=\"653\" valign=\"top\" ><p><span style=\"font-size: 11px; line-height: 16px;\"  align=\"right\">\r\n<br/><br />','</span></p><br/ ><br/ ></td>\r\n      <td width=\"15\">&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td style=\"padding: 5px;\" colspan=\"4\" height=\"15\" align=\"center\" valign=\"middle\" bgcolor=\"#e3e2e7\">\r\n         <span style=\"font-size: 11px;\">Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus idut maxime placeat facere possimus</span>\r\n      </td>\r\n    </tr>\r\n    <tr>\r\n      <td style=\"padding-left: 10px; text-align: center;\" colspan=\"4\" height=\"50\" valign=\"middle\" bgcolor=\"#f4f3f5\">\r\n        <table border=\"0\" cellpadding=\"0\" align=\"center\">\r\n          <tbody>\r\n            <tr>\r\n              <td width=\"230\" height=\"118\" align=\"left\" valign=\"middle\">\r\n                <p><span style=\"font-size: 11px; line-height: 16px;\"  align=\"right\">Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus idut maxime placeat facere possimus.</span></p>\r\n              </td>\r\n              <td width=\"219\">\r\n                <p><span style=\"font-size: 11px; line-height: 16px;\">Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus idut maxime placeat facere possimus.</span></p>\r\n              </td>\r\n              <td width=\"230\" align=\"left\">\r\n                <span style=\"font-size: 11px;\">My Wonderful Store<br />202 Madison Ave, New York, NY 10001\r\n                <br />phone: 800-123-1234 | Fax: 202-123-1234\r\n                <br /><a title=\"E-mail mysite.com\" href=\"mailto:contact@mysite.com\">mysite@mysite.com</a>\r\n                <br />www.mysite.com</span>\r\n             </td>\r\n           </tr>\r\n           </tbody>\r\n        </table>\r\n     </td>\r\n   </tr>\r\n   <tr>\r\n      <td style=\"padding: 5px;\" colspan=\"4\" height=\"25\" align=\"center\" valign=\"middle\" bgcolor=\"#f4f3f5\">\r\n         <a href=\"http://www.oscommerce.com\">About Us</a> | \r\n         <a href=\"http://www.oscommerce.com\">Buy Something</a> | \r\n         <a href=\"http://www.oscommerce.com\">Donate</a> | \r\n         <a href=\"http://www.oscommerce.com\">Contact Us</a> | \r\n         <a href=\"http://www.oscommerce.com\">Privacy Policy</a> | \r\n         <a href=\"http://www.oscommerce.com\">Unsubscribe</a> | \r\n         <a title=\"Update Profile\" href=\"http://www.oscommerce.com\">Update Your Profile</a>\r\n         <br /><span style=\"font-size: 10px;\">&copy; Mysite. All rights reserved.</span>\r\n      </td>\r\n   </tr>\r\n   <tr>\r\n     <td colspan=\"4\" height=\"1\" bgcolor=\"#8a8a8a\">&nbsp;\r\n        <img src=\"http://www.css-oscommerce.com/images/mail_manager/bluesky_spacer.gif\" alt=\"\" /> </td>\r\n    </tr>\r\n    </tbody>\r\n </table>','My Store','Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus idut maxime placeat facere possimus.\r\n\r\n\r\nhttp://www.oscommerce.com\">About Us| \r\nhttp://www.oscommerce.com\">Buy Something | \r\nhttp://www.oscommerce.com\">Donate | \r\nhttp://www.oscommerce.com\">Contact Us | \r\nhttp://www.oscommerce.com\">Privacy Policy | \r\nhttp://www.oscommerce.com\">Unsubscribe | \r\nhttp://www.oscommerce.com\">Update Your Profile');
/*!40000 ALTER TABLE `mm_templates` ENABLE KEYS */;
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
INSERT INTO `orders_status` VALUES (1,4,'Nevyřízená',1,0),(2,4,'Zpracovává se',1,0),(3,4,'Zrušená',1,0),(4,4,'Čeká na připsání platby',1,0),(5,4,'Odesláno na dobírku',1,0),(6,4,'Dobírka vrácena',1,0),(7,4,'Preparing [PayPal IPN]',1,0),(8,4,'PayPal [Transactions]',1,0),(9,4,'Osobní odběr',1,0),(101,4,'Vyřízená',1,1),(102,4,'Zaplaceno PayPal',1,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_images`
--

LOCK TABLES `products_images` WRITE;
/*!40000 ALTER TABLE `products_images` DISABLE KEYS */;
INSERT INTO `products_images` VALUES (1,13,'probudte-svou-krasu-kap1.jpg','',1),(2,13,'probudte-svou-krasu-kap4.jpg','',2),(3,89,'fertekova-kosmetika.jpg','',1),(4,79,'smrst-mesteckogalvesias.jpg','',1),(5,90,'martinez-obalka-mala.jpg','',1),(6,77,'bookman-kocky-a-kocicaci.jpg','',1),(7,76,'bookman-neradi.jpg','',1),(8,75,'bookman-stilnox-detox.jpg','',1),(9,91,'dokoran-naucne-stezky.jpg','',1),(10,92,'dokoran-naucne-stezky2.jpg','',1),(11,93,'volvox-zelena-mladi.jpg','',1),(12,94,'volvox-leceni-kvetinami.jpg','',1),(13,96,'rabinuv-kocour-1-bar-micva.jpg','',1);
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
INSERT INTO `products_to_categories` VALUES (1,0,1),(2,29,NULL),(3,29,NULL),(4,29,NULL),(5,29,NULL),(6,29,NULL),(7,29,NULL),(8,29,NULL),(9,29,NULL),(10,29,NULL),(11,29,NULL),(12,29,NULL),(13,37,1),(14,29,NULL),(15,29,NULL),(16,29,NULL),(17,29,NULL),(18,29,NULL),(19,29,NULL),(20,29,NULL),(21,29,NULL),(23,29,NULL),(24,29,NULL),(25,29,NULL),(26,29,NULL),(27,29,1),(28,29,NULL),(29,29,NULL),(30,29,NULL),(31,35,1),(32,29,1),(33,29,NULL),(34,29,NULL),(35,29,NULL),(36,29,NULL),(37,29,NULL),(38,29,NULL),(39,29,NULL),(40,29,NULL),(41,29,NULL),(42,29,NULL),(43,29,NULL),(44,29,NULL),(45,29,NULL),(46,29,NULL),(47,29,NULL),(48,29,NULL),(49,29,NULL),(50,29,NULL),(51,29,NULL),(52,29,NULL),(53,29,NULL),(54,29,NULL),(55,29,NULL),(56,29,NULL),(57,29,NULL),(58,29,NULL),(59,29,NULL),(60,29,NULL),(61,29,NULL),(62,29,NULL),(63,29,NULL),(64,29,1),(65,30,NULL),(66,30,NULL),(67,30,NULL),(68,30,NULL),(69,30,NULL),(71,30,1),(72,30,1),(73,32,NULL),(74,32,NULL),(75,40,1),(76,40,1),(77,40,1),(78,34,1),(79,41,1),(80,32,1),(81,32,1),(82,32,1),(83,32,1),(84,32,1),(85,30,1),(86,30,1),(87,30,1),(88,30,1),(89,43,1),(90,41,1),(91,44,1),(92,44,1),(93,29,1),(94,29,1),(95,30,1),(96,30,1),(97,30,1),(98,30,1),(99,30,1),(100,30,1),(101,30,1),(102,30,1),(103,30,1),(104,30,1),(105,30,1),(106,30,1),(107,30,1),(108,30,1),(109,30,1),(110,30,1),(111,30,1),(112,30,1),(113,30,1),(114,30,1),(115,30,1),(116,30,1),(117,30,1),(118,30,1),(119,30,1),(120,30,1);
/*!40000 ALTER TABLE `products_to_categories` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=461 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seo_friendly_urls`
--

LOCK TABLES `seo_friendly_urls` WRITE;
/*!40000 ALTER TABLE `seo_friendly_urls` DISABLE KEYS */;
INSERT INTO `seo_friendly_urls` VALUES (460,'cache_aliases','a:2:{s:10:\"categories\";a:1:{i:4;a:40:{i:2;s:14:\"digitalni-tisk\";s:4:\"2_15\";s:31:\"digitalni-tisk/casopisy-brozury\";s:4:\"2_22\";s:25:\"digitalni-tisk/fotografie\";s:4:\"2_21\";s:24:\"digitalni-tisk/fotoknihy\";s:4:\"2_20\";s:32:\"digitalni-tisk/hlavickove-papiry\";s:4:\"2_19\";s:24:\"digitalni-tisk/kalendare\";s:4:\"2_17\";s:20:\"digitalni-tisk/knihy\";s:4:\"2_18\";s:21:\"digitalni-tisk/letaky\";s:4:\"2_11\";s:26:\"digitalni-tisk/nase-stroje\";s:4:\"2_16\";s:29:\"digitalni-tisk/soukrome-tisky\";s:4:\"2_14\";s:22:\"digitalni-tisk/vizitky\";s:4:\"2_45\";s:38:\"digitalni-tisk/malonakladovy-tisk-knih\";i:10;s:17:\"sazba-knih-e-knih\";s:5:\"10_27\";s:35:\"sazba-knih-e-knih/dvojjazycne-knihy\";s:5:\"10_12\";s:37:\"sazba-knih-e-knih/polytonicka-rectina\";s:4:\"10_9\";s:31:\"sazba-knih-e-knih/tvorba-e-knih\";s:5:\"10_13\";s:34:\"sazba-knih-e-knih/zpracovani-textu\";i:3;s:15:\"graficke-sluzby\";s:4:\"3_23\";s:31:\"graficke-sluzby/graficke-upravy\";s:4:\"3_24\";s:43:\"graficke-sluzby/kompletni-firemni-materialy\";s:4:\"3_25\";s:20:\"graficke-sluzby/loga\";s:4:\"3_26\";s:22:\"graficke-sluzby/obalky\";i:1;s:3:\"dtp\";i:46;s:13:\"skenovani-ocr\";i:42;s:7:\"klienti\";s:5:\"42_36\";s:35:\"klienti/brandwise-reklamni-agentura\";s:5:\"42_37\";s:38:\"klienti/dr-hauschka-prirodni-kosmetika\";s:5:\"42_38\";s:15:\"klienti/e-tovar\";s:5:\"42_40\";s:30:\"klienti/nakladatelstvi-bookman\";s:5:\"42_33\";s:28:\"klienti/nakladatelstvi-brana\";s:5:\"42_44\";s:30:\"klienti/nakladatelstvi-dokoran\";s:5:\"42_30\";s:31:\"klienti/nakladatelstvi-garamond\";s:5:\"42_34\";s:32:\"klienti/nakladatelstvi-oikoymenh\";s:5:\"42_32\";s:27:\"klienti/nakladatelstvi-onyx\";s:5:\"42_31\";s:39:\"klienti/nakladatelstvi-rybka-publishers\";s:5:\"42_41\";s:28:\"klienti/nakladatelstvi-smrst\";s:5:\"42_29\";s:38:\"klienti/nakladatelstvi-volvox-globator\";s:5:\"42_39\";s:17:\"klienti/spoje-net\";s:5:\"42_35\";s:26:\"klienti/ustav-t-g-masaryka\";s:5:\"42_43\";s:24:\"klienti/vlasta-fertekova\";}}s:8:\"products\";a:1:{i:4;a:10:{i:30;a:32:{i:100;s:40:\"klienti/nakladatelstvi-garamond/21-gramu\";i:101;s:52:\"klienti/nakladatelstvi-garamond/albert-camus-cizinec\";i:110;s:48:\"klienti/nakladatelstvi-garamond/albert-camus-mor\";i:113;s:63:\"klienti/nakladatelstvi-garamond/alexandre-dumas-kralovna-margot\";i:114;s:60:\"klienti/nakladatelstvi-garamond/alexandre-dumas-kraluv-sasek\";i:112;s:62:\"klienti/nakladatelstvi-garamond/alexandre-dumas-pani-monsoreau\";i:117;s:49:\"klienti/nakladatelstvi-garamond/amedeo-modigliani\";i:107;s:45:\"klienti/nakladatelstvi-garamond/amores-perros\";i:85;s:46:\"klienti/nakladatelstvi-garamond/bezstarostnost\";i:119;s:46:\"klienti/nakladatelstvi-garamond/christian-dior\";i:116;s:43:\"klienti/nakladatelstvi-garamond/coco-chanel\";i:97;s:59:\"klienti/nakladatelstvi-garamond/desitky-knih-edice-bilingua\";i:102;s:78:\"klienti/nakladatelstvi-garamond/ernest-kolowrat-zpovedi-lehkovazneho-slechtice\";i:87;s:65:\"klienti/nakladatelstvi-garamond/francouzska-literatura-19-stoleti\";i:108;s:59:\"klienti/nakladatelstvi-garamond/gilles-deleuze-bergsonismus\";i:99;s:58:\"klienti/nakladatelstvi-garamond/knihy-edici-transatlantika\";i:104;s:57:\"klienti/nakladatelstvi-garamond/maigret-inspektor-protiva\";i:109;s:65:\"klienti/nakladatelstvi-garamond/maurice-blanchot-lautreamont-sade\";i:98;s:72:\"klienti/nakladatelstvi-garamond/nektere-knihy-edici-francouzska-knihovna\";i:106;s:45:\"klienti/nakladatelstvi-garamond/patty-diphusa\";i:105;s:83:\"klienti/nakladatelstvi-garamond/pres-10-titulu-agatha-christie-edice-bilingua-crimi\";i:95;s:46:\"klienti/nakladatelstvi-garamond/promena-komiks\";i:96;s:46:\"klienti/nakladatelstvi-garamond/rabinuv-kocour\";i:111;s:79:\"klienti/nakladatelstvi-garamond/raymond-chandler-10-titulu-edice-bilingua-crimi\";i:88;s:44:\"klienti/nakladatelstvi-garamond/recky-zazrak\";i:72;s:45:\"klienti/nakladatelstvi-garamond/rodinny-sjezd\";i:71;s:42:\"klienti/nakladatelstvi-garamond/rude-hreby\";i:118;s:68:\"klienti/nakladatelstvi-garamond/suetonius-zivotopisy-dvanacti-cisaru\";i:103;s:42:\"klienti/nakladatelstvi-garamond/erbu-lvice\";i:86;s:44:\"klienti/nakladatelstvi-garamond/vecny-manzel\";i:115;s:69:\"klienti/nakladatelstvi-garamond/vojtech-zamarovsky-dejiny-psane-rimem\";i:120;s:50:\"klienti/nakladatelstvi-garamond/yves-saint-laurent\";}i:32;a:5:{i:80;s:50:\"klienti/nakladatelstvi-onyx/cesty-harmonii-cloveka\";i:81;s:53:\"klienti/nakladatelstvi-onyx/chotesovsky-probost-sulek\";i:83;s:51:\"klienti/nakladatelstvi-onyx/klaster-svata-dobrotiva\";i:82;s:58:\"klienti/nakladatelstvi-onyx/kostel-klaster-svateho-vaclava\";i:84;s:52:\"klienti/nakladatelstvi-onyx/stari-jako-zivotni-sance\";}i:40;a:3:{i:77;s:45:\"klienti/nakladatelstvi-bookman/kocky-kocicaci\";i:76;s:37:\"klienti/nakladatelstvi-bookman/neradi\";i:75;s:44:\"klienti/nakladatelstvi-bookman/stilnox-detox\";}i:43;a:1:{i:89;s:47:\"klienti/vlasta-fertekova/kosmetika-teorii-praxi\";}i:29;a:5:{i:94;s:73:\"klienti/nakladatelstvi-volvox-globator/leceni-pomoci-kvetu-drahych-kamenu\";i:27;s:63:\"klienti/nakladatelstvi-volvox-globator/nacisticka-okultni-valka\";i:32;s:46:\"klienti/nakladatelstvi-volvox-globator/nirvana\";i:93;s:51:\"klienti/nakladatelstvi-volvox-globator/zelena-mladi\";i:64;s:71:\"klienti/nakladatelstvi-volvox-globator/zivoty-osmdesati-ctyr-mahasiddhu\";}i:41;a:2:{i:90;s:44:\"klienti/nakladatelstvi-smrst/los-de-enfrente\";i:79;s:46:\"klienti/nakladatelstvi-smrst/mestecko-galveias\";}i:44;a:2:{i:91;s:50:\"klienti/nakladatelstvi-dokoran/naucne-stezky-trasy\";i:92;s:53:\"klienti/nakladatelstvi-dokoran/naucne-stezky-trasy-ii\";}i:37;a:1:{i:13;s:58:\"klienti/dr-hauschka-prirodni-kosmetika/probudte-svou-krasu\";}i:34;a:1:{i:78;s:77:\"klienti/nakladatelstvi-oikoymenh/sazba-nekterych-titulu-polytonickou-rectinou\";}i:35;a:1:{i:31;s:88:\"klienti/ustav-t-g-masaryka/univerzitni-prednasky-ii-strucny-nacrt-dejin-filozofie-dejiny\";}}}}',1501125766);
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
INSERT INTO `sessions` VALUES ('08i32nj9eo3j16j462pk94e5s2',1501984200,'sessiontoken|s:32:\"2ef1f645ec41e4da5d32a8e3456cb997\";cart|O:12:\"shoppingCart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}language|s:5:\"czech\";languages_id|s:1:\"4\";currency|s:3:\"CZK\";navigation|O:17:\"navigationHistory\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),('0qg5c1ms9h54hg7e5bv1ustvn1',1500820585,'language|s:5:\"czech\";languages_id|s:1:\"4\";KCFINDER|a:1:{s:8:\"disabled\";b:0;}admin|a:2:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:7:\"fprint2\";}'),('224dtcsuhua8cf64rbkk6hubb7',1497995572,'language|s:5:\"czech\";languages_id|s:1:\"4\";KCFINDER|a:1:{s:8:\"disabled\";b:0;}admin|a:2:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:7:\"fprint2\";}'),('412lshj1repho0ai06kogkmq85',1498120670,'language|s:5:\"czech\";languages_id|s:1:\"4\";KCFINDER|a:1:{s:8:\"disabled\";b:0;}auth_ignore|b:1;admin|a:2:{s:2:\"id\";s:1:\"2\";s:8:\"username\";s:8:\"miprint2\";}'),('41onf8egje095iaq30435crrq4',1501284671,'sessiontoken|s:32:\"a9ac56372370c9facbb4d69055b4c9a5\";cart|O:12:\"shoppingCart\":4:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:12:\"content_type\";b:0;}language|s:5:\"czech\";languages_id|s:1:\"4\";currency|s:3:\"CZK\";navigation|O:17:\"navigationHistory\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:26:\"advanced_search_result.php\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";a:2:{s:8:\"keywords\";s:6:\"Albert\";s:21:\"search_in_description\";s:1:\"1\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),('504hj6si9la5olil8kk7r7g9q1',1500806914,'sessiontoken|s:32:\"1de5f29f73d93dc1ea331839549b97ef\";cart|O:12:\"shoppingCart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}language|s:5:\"czech\";languages_id|s:1:\"4\";currency|s:3:\"CZK\";navigation|O:17:\"navigationHistory\":2:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:16:\"product_info.php\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";a:2:{s:5:\"cPath\";s:5:\"42_30\";s:11:\"products_id\";s:3:\"120\";}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),('5dqjaa62qpn42u7rv90milt214',1500466267,'sessiontoken|s:32:\"7de0eacd26bc1f9706f2b82e059f3aba\";cart|O:12:\"shoppingCart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}language|s:5:\"czech\";languages_id|s:1:\"4\";currency|s:3:\"CZK\";navigation|O:17:\"navigationHistory\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";a:1:{s:5:\"cPath\";s:2:\"42\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),('8e5e555mn4bshschskcv2d0vf5',1500479613,'language|s:5:\"czech\";languages_id|s:1:\"4\";KCFINDER|a:1:{s:8:\"disabled\";b:0;}admin|a:2:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:7:\"fprint2\";}'),('8evdsnr919k334t4p8mf3rs261',1498083487,'language|s:5:\"czech\";languages_id|s:1:\"4\";redirect_origin|a:4:{s:4:\"page\";s:14:\"categories.php\";s:3:\"get\";a:1:{s:5:\"cPath\";s:4:\"5_28\";}s:9:\"auth_user\";s:8:\"miprint1\";s:7:\"auth_pw\";s:20:\"GqwciVXP7MPTGOGYw7QS\";}KCFINDER|a:1:{s:8:\"disabled\";b:0;}'),('bdgdn6belqlbu2ulirroifij83',1500890844,'sessiontoken|s:32:\"5479931c27d3ffc9819941f7fc468d36\";cart|O:12:\"shoppingCart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}language|s:5:\"czech\";languages_id|s:1:\"4\";currency|s:3:\"CZK\";navigation|O:17:\"navigationHistory\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),('hsvoserom6fc226ssbnvmtcab5',1501199249,'language|s:5:\"czech\";languages_id|s:1:\"4\";KCFINDER|a:1:{s:8:\"disabled\";b:0;}auth_ignore|b:1;redirect_origin|a:2:{s:4:\"page\";s:9:\"index.php\";s:3:\"get\";a:0:{}}'),('hunejb4lphuttqtl19lvma0h34',1501780275,'language|s:5:\"czech\";languages_id|s:1:\"4\";KCFINDER|a:1:{s:8:\"disabled\";b:0;}admin|a:2:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:7:\"fprint2\";}'),('irue5k3dhvd71crc0h90lm1vf7',1501081681,'sessiontoken|s:32:\"d8fe916393955254ea129cac09c4adfc\";cart|O:12:\"shoppingCart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}language|s:5:\"czech\";languages_id|s:1:\"4\";currency|s:3:\"CZK\";navigation|O:17:\"navigationHistory\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),('is6n4svj0v27sd2gv7a1008ji0',1497527438,'sessiontoken|s:32:\"45acbc6f1184b494a87a593edff66ed5\";cart|O:12:\"shoppingCart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}language|s:5:\"czech\";languages_id|s:1:\"4\";currency|s:3:\"CZK\";navigation|O:17:\"navigationHistory\":2:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:16:\"product_info.php\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";a:2:{s:5:\"cPath\";s:0:\"\";s:11:\"products_id\";s:1:\"1\";}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),('k3atgq98tqmv37vpeek59u1qq5',1501112924,'sessiontoken|s:32:\"940c8cef2bbc196bb3dec168f5afbee7\";cart|O:12:\"shoppingCart\":7:{s:8:\"contents\";a:1:{i:118;a:1:{s:3:\"qty\";i:1;}}s:5:\"total\";d:0;s:6:\"weight\";d:0;s:6:\"cartID\";s:5:\"66796\";s:12:\"content_type\";b:0;s:13:\"total_virtual\";d:0;s:14:\"weight_virtual\";d:0;}language|s:5:\"czech\";languages_id|s:1:\"4\";currency|s:3:\"CZK\";navigation|O:17:\"navigationHistory\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}new_products_id_in_cart|i:118;'),('lb7c5oggs2j6g90ll4nkop39b4',1498598842,'language|s:5:\"czech\";languages_id|s:1:\"4\";KCFINDER|a:1:{s:8:\"disabled\";b:0;}admin|a:2:{s:2:\"id\";s:1:\"2\";s:8:\"username\";s:8:\"miprint2\";}'),('le8e8dagc0248r54t35m7ou2p5',1497872672,'sessiontoken|s:32:\"ea5aa0073a980733360900218d45d227\";cart|O:12:\"shoppingCart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}language|s:5:\"czech\";languages_id|s:1:\"4\";currency|s:3:\"CZK\";navigation|O:17:\"navigationHistory\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),('m7rb4t252vme05kfi4ka353gk3',1499164968,'language|s:5:\"czech\";languages_id|s:1:\"4\";KCFINDER|a:1:{s:8:\"disabled\";b:0;}admin|a:2:{s:2:\"id\";s:1:\"2\";s:8:\"username\";s:8:\"miprint2\";}'),('mcogp4r9frk4kso17l4q281se6',1500890832,'sessiontoken|s:32:\"4b8421dda10ecebe15d5d14456adbcd4\";cart|O:12:\"shoppingCart\":4:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:12:\"content_type\";b:0;}language|s:5:\"czech\";languages_id|s:1:\"4\";currency|s:3:\"CZK\";navigation|O:17:\"navigationHistory\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),('me6r3etg8f4d3d5hbrhn95gp36',1500893818,'sessiontoken|s:32:\"47c9469d7802e64f46107fb0553c1360\";cart|O:12:\"shoppingCart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}language|s:5:\"czech\";languages_id|s:1:\"4\";currency|s:3:\"CZK\";navigation|O:17:\"navigationHistory\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),('mslsr3tvlhrj92o3u95hh0t0a3',1498672632,'language|s:5:\"czech\";languages_id|s:1:\"4\";redirect_origin|a:4:{s:4:\"page\";s:14:\"categories.php\";s:3:\"get\";a:1:{s:6:\"search\";s:2:\"10\";}s:9:\"auth_user\";s:7:\"fprint1\";s:7:\"auth_pw\";s:20:\"5etLjRJxD9fIzpeeL5LB\";}KCFINDER|a:1:{s:8:\"disabled\";b:0;}'),('o66el13j792418jbpgoa32o426',1501982741,'language|s:5:\"czech\";languages_id|s:1:\"4\";KCFINDER|a:1:{s:8:\"disabled\";b:0;}admin|a:2:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:7:\"fprint2\";}'),('oar3utb4it0cc16mgfoeeg39j0',1497528172,'language|s:5:\"czech\";languages_id|s:1:\"4\";KCFINDER|a:1:{s:8:\"disabled\";b:0;}admin|a:2:{s:2:\"id\";s:1:\"1\";s:8:\"username\";s:7:\"fprint2\";}'),('op3s8b4cr8nec93entpi30hua6',1500973054,'language|s:5:\"czech\";languages_id|s:1:\"4\";KCFINDER|a:1:{s:8:\"disabled\";b:0;}admin|a:2:{s:2:\"id\";s:1:\"2\";s:8:\"username\";s:8:\"miprint2\";}'),('pkkfp19jteqb1eijo66qi55ce4',1497904599,'sessiontoken|s:32:\"6e881bb1ba2022f81076f37822b1b5ce\";cart|O:12:\"shoppingCart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}language|s:5:\"czech\";languages_id|s:1:\"4\";currency|s:3:\"CZK\";navigation|O:17:\"navigationHistory\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),('pr3hj081655vi78fv16gid3a73',1501284734,'language|s:5:\"czech\";languages_id|s:1:\"4\";redirect_origin|a:2:{s:4:\"page\";s:14:\"categories.php\";s:3:\"get\";a:3:{s:5:\"cPath\";s:5:\"42_30\";s:3:\"pID\";s:3:\"120\";s:6:\"action\";s:11:\"new_product\";}}KCFINDER|a:1:{s:8:\"disabled\";b:0;}'),('qcgbe1abtmvrkn1alo12qj2rr3',1500771051,'sessiontoken|s:32:\"f4e19cccacb94cc85eb8891df43e763f\";cart|O:12:\"shoppingCart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}language|s:5:\"czech\";languages_id|s:1:\"4\";currency|s:3:\"CZK\";navigation|O:17:\"navigationHistory\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),('s768mf6215ep2i75daq20i6oc6',1498079491,'language|s:5:\"czech\";languages_id|s:1:\"4\";KCFINDER|a:1:{s:8:\"disabled\";b:0;}admin|a:2:{s:2:\"id\";s:1:\"2\";s:8:\"username\";s:8:\"miprint2\";}'),('u091h4ohopbbqruc5pbuqp4235',1501780315,'sessiontoken|s:32:\"31e085bd21c367b6537e4196afc11fa9\";cart|O:12:\"shoppingCart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}language|s:5:\"czech\";languages_id|s:1:\"4\";currency|s:3:\"CZK\";navigation|O:17:\"navigationHistory\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),('u32oo1cqajpucafmf11d91c3s4',1501125766,'sessiontoken|s:32:\"b6e5c929f6d596dc6a359d7ebb2736fa\";cart|O:12:\"shoppingCart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}language|s:5:\"czech\";languages_id|s:1:\"4\";currency|s:3:\"CZK\";navigation|O:17:\"navigationHistory\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),('u73hde34grshrej0cfaar39o45',1501125707,'sessiontoken|s:32:\"9bf5d0d0f0e3d4380b00d6edff455fe5\";cart|O:12:\"shoppingCart\":7:{s:8:\"contents\";a:1:{i:120;a:1:{s:3:\"qty\";i:1;}}s:5:\"total\";d:0;s:6:\"weight\";d:0;s:6:\"cartID\";s:5:\"58060\";s:12:\"content_type\";b:0;s:13:\"total_virtual\";d:0;s:14:\"weight_virtual\";d:0;}language|s:5:\"czech\";languages_id|s:1:\"4\";currency|s:3:\"CZK\";navigation|O:17:\"navigationHistory\":2:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:4:{s:4:\"page\";s:21:\"checkout_shipping.php\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}new_products_id_in_cart|i:120;'),('u8dffeuej9n50s2omqdkdledr0',1498229984,'language|s:5:\"czech\";languages_id|s:1:\"4\";KCFINDER|a:1:{s:8:\"disabled\";b:0;}auth_ignore|b:1;admin|a:2:{s:2:\"id\";s:1:\"2\";s:8:\"username\";s:8:\"miprint2\";}'),('uls58d3bcetpahc1djbihsveq7',1498598867,'sessiontoken|s:32:\"5643c1120f00f9e07d29a521cbdf1235\";cart|O:12:\"shoppingCart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}language|s:5:\"czech\";languages_id|s:1:\"4\";currency|s:3:\"CZK\";navigation|O:17:\"navigationHistory\":2:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:16:\"product_info.php\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";a:1:{s:11:\"products_id\";s:2:\"88\";}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}'),('v71k2to6vpbguoba3dhra3qpq1',1498229080,'sessiontoken|s:32:\"cdc4a7f585c22de98fa93b71d6a4ed9c\";cart|O:12:\"shoppingCart\":5:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;}language|s:5:\"czech\";languages_id|s:1:\"4\";currency|s:3:\"CZK\";navigation|O:17:\"navigationHistory\":2:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:16:\"product_info.php\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";a:2:{s:5:\"cPath\";s:5:\"42_30\";s:11:\"products_id\";s:2:\"71\";}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:9:\"index.php\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}}');
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
INSERT INTO `tax_class` VALUES (1,'VAT (DPH) 15%','cz VAT 15%','2017-06-14 14:55:18','2017-06-14 14:55:18'),(2,'VAT (DPH) 21%','cz VAT 21%','2017-06-14 14:55:18','2017-06-14 14:55:18'),(3,'VAT (DPH) 10%','cz VAT 10%','2017-06-14 14:55:18','2017-06-14 14:55:18');
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
INSERT INTO `tax_rates` VALUES (1,1,1,1,15.0000,'VAT (DPH) 15%','2017-06-14 14:55:18','2017-06-14 14:55:18'),(2,1,2,2,21.0000,'cz VAT (DPH) 21%','2017-06-14 14:55:18','2017-06-14 14:55:18'),(3,1,3,3,10.0000,'cz VAT (DPH) 10%','2017-06-14 14:55:18','2017-06-14 14:55:18');
/*!40000 ALTER TABLE `tax_rates` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zones_to_geo_zones`
--

LOCK TABLES `zones_to_geo_zones` WRITE;
/*!40000 ALTER TABLE `zones_to_geo_zones` DISABLE KEYS */;
INSERT INTO `zones_to_geo_zones` VALUES (1,14,0,1,NULL,'2017-06-14 14:55:18'),(2,21,0,1,NULL,'2017-06-14 14:55:18'),(3,33,0,1,NULL,'2017-06-14 14:55:18'),(4,53,0,1,NULL,'2017-06-14 14:55:18'),(5,55,0,1,NULL,'2017-06-14 14:55:18'),(6,56,0,1,NULL,'2017-06-14 14:55:18'),(7,57,0,1,NULL,'2017-06-14 14:55:18'),(8,67,0,1,NULL,'2017-06-14 14:55:18'),(9,72,0,1,NULL,'2017-06-14 14:55:18'),(10,73,0,1,NULL,'2017-06-14 14:55:18'),(11,81,0,1,NULL,'2017-06-14 14:55:18'),(12,84,0,1,NULL,'2017-06-14 14:55:18'),(13,97,0,1,NULL,'2017-06-14 14:55:18'),(14,103,0,1,NULL,'2017-06-14 14:55:18'),(15,105,0,1,NULL,'2017-06-14 14:55:18'),(16,117,0,1,NULL,'2017-06-14 14:55:18'),(17,123,0,1,NULL,'2017-06-14 14:55:18'),(18,124,0,1,NULL,'2017-06-14 14:55:18'),(19,132,0,1,NULL,'2017-06-14 14:55:18'),(20,150,0,1,NULL,'2017-06-14 14:55:18'),(21,170,0,1,NULL,'2017-06-14 14:55:18'),(22,171,0,1,NULL,'2017-06-14 14:55:18'),(23,175,0,1,NULL,'2017-06-14 14:55:18'),(24,189,0,1,NULL,'2017-06-14 14:55:18'),(25,190,0,1,NULL,'2017-06-14 14:55:18'),(26,195,0,1,NULL,'2017-06-14 14:55:18'),(27,203,0,1,NULL,'2017-06-14 14:55:18'),(28,222,0,1,NULL,'2017-06-14 14:55:18');
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

-- Dump completed on 2017-08-06  3:51:45
