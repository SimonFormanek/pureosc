alter table articles_description add cached int(1) NOT NULL DEFAULT '0' after articles_id;
alter table categories_description add cached int(1) NOT NULL DEFAULT '0' after categories_id;
alter table information add cached int(1) NOT NULL DEFAULT '0' after information_id;
alter table manufacturers_info add cached int(1) NOT NULL DEFAULT '0' after manufacturers_id;
alter table products_description add cached int(1) NOT NULL DEFAULT '0' after products_id;
alter table topics_description add cached int(1) NOT NULL DEFAULT '0' after topics_id;

DROP TABLE IF EXISTS `robot`;
CREATE TABLE `robot` (
  `crontime` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nowtime` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `robot` WRITE;
INSERT INTO `robot` VALUES ('0312','0758','cs');
