#!/bin/bash
#repare current osc structure of imported tables
#firt you need dump
. ./dbconnect.sh
# dump: products_attributes products_attributes_download products_options products_options_values products_options_values_to_products_options products products_description products_to_categories categories categories_description manufacturers manufacturers_info specials           
# address_book address_format  customers customers_info orders orders_products orders_products_attributes orders_products_download orders_status_history orders_total  

#read dump from file if ommitted import osCommerce demo catalog
if [[ $1 ]];then F=$1;else F='demo.sql';fi
mysql  -h${H} -u${U} ${P} $D < $F

mysql -h${H} -u${U} ${P} $D << MYSQLCMD
#use ${1};

# CATEGORIES ###########################################
ALTER TABLE categories MODIFY sort_order int(12) DEFAULT '1';

# categories_description ###########################################
#ALTER TABLE categories_description ENGINE = InnoDB;  
ALTER TABLE categories_description ADD   cached int(1) DEFAULT '0';              
ALTER TABLE categories_description ADD   cached_admin int(1) DEFAULT '0';        
ALTER TABLE categories_description ADD   categories_description text COLLATE utf8_unicode_ci;         
ALTER TABLE categories_description ADD   categories_seo_title varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL;
ALTER TABLE categories_description ADD   categories_seo_description text COLLATE utf8_unicode_ci;               
ALTER TABLE categories_description ADD   categories_seo_keywords varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL;
ALTER TABLE categories_description ADD   categories_alias varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '';
ALTER TABLE categories_description ADD   categories_htc_title_tag varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL;
ALTER TABLE categories_description ADD   categories_htc_title_tag_alt varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL;
ALTER TABLE categories_description ADD   categories_htc_title_tag_url varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL;
ALTER TABLE categories_description ADD   categories_htc_desc_tag varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL;    
ALTER TABLE categories_description ADD   categories_htc_keywords_tag text COLLATE utf8_unicode_ci;                     
ALTER TABLE categories_description ADD   categories_htc_description text COLLATE utf8_unicode_ci;                      
ALTER TABLE categories_description ADD   categories_htc_breadcrumb_text varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL;

#MANUFACTURERS ##########################################################
ALTER TABLE manufacturers ADD manufacturers_seo_title varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL;

#MANUFACTURERS_INFO ##########################################################
ALTER TABLE manufacturers_info ADD   cached int(1) NOT NULL DEFAULT '0';
ALTER TABLE manufacturers_info ADD cached_admin int(1) DEFAULT NULL;
ALTER TABLE manufacturers_info ADD  manufacturers_description text COLLATE utf8_unicode_ci;                               
ALTER TABLE manufacturers_info ADD  manufacturers_seo_description text COLLATE utf8_unicode_ci;                           
ALTER TABLE manufacturers_info ADD  manufacturers_seo_keywords varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL;         
ALTER TABLE manufacturers_info ADD  manufacturers_alias varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '';         
ALTER TABLE manufacturers_info ADD  manufacturers_htc_title_tag varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL;         
ALTER TABLE manufacturers_info ADD  manufacturers_htc_title_tag_alt varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL;     
ALTER TABLE manufacturers_info ADD  manufacturers_htc_title_tag_url varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL;     
ALTER TABLE manufacturers_info ADD  manufacturers_htc_desc_tag varchar(160) COLLATE utf8_unicode_ci DEFAULT NULL;         
ALTER TABLE manufacturers_info ADD  manufacturers_htc_keywords_tag text COLLATE utf8_unicode_ci;
ALTER TABLE manufacturers_info ADD  manufacturers_htc_description text COLLATE utf8_unicode_ci; 
ALTER TABLE manufacturers_info ADD  manufacturers_htc_breadcrumb_text varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL;   


#PRODUCTS
#ALTER TABLE products ENGINE = InnoDB;

# 1:MODIFY
ALTER TABLE products MODIFY products_model varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL;

# 2:ADD COLUMNS
ALTER TABLE products ADD products_sort_order int(10);
ALTER TABLE products ADD products_custom_date datetime DEFAULT NULL;
ALTER TABLE products ADD product_template int(2) DEFAULT NULL; 
ALTER TABLE products ADD products_biblio_isbn varchar(255) COLLATE utf8_unicode_ci NOT NULL; 
ALTER TABLE products ADD products_biblio_isbn_pdf varchar(255) COLLATE utf8_unicode_ci NOT NULL;
ALTER TABLE products ADD products_biblio_isbn_epub varchar(255) COLLATE utf8_unicode_ci NOT NULL;
ALTER TABLE products ADD products_biblio_isbn_mobi varchar(255) COLLATE utf8_unicode_ci NOT NULL;
ALTER TABLE products ADD products_biblio_pages_count varchar(255) COLLATE utf8_unicode_ci NOT NULL;
ALTER TABLE products ADD products_biblio_bindings varchar(255) COLLATE utf8_unicode_ci NOT NULL;
ALTER TABLE products ADD products_biblio_book_size varchar(255) COLLATE utf8_unicode_ci NOT NULL;
ALTER TABLE products ADD  products_biblio_publication_year varchar(255) COLLATE utf8_unicode_ci NOT NULL;

#INDEXES(KEYS)
ALTER TABLE products drop INDEX idx_products_date_added;

ALTER TABLE products ADD KEY idx_products_date_available (products_date_available); 
ALTER TABLE products ADD KEY idx_products_date_added (products_date_added);
ALTER TABLE products ADD KEY idx_products_custom_date (products_custom_date);
ALTER TABLE products ADD KEY idx_products_sort_order (products_sort_order);


#optional: CreLoaded
#ALTER TABLE products DROP products_image_med;
#ALTER TABLE products DROP products_image_lrg;
#ALTER TABLE products DROP products_image_sm_1;
#ALTER TABLE products DROP products_image_xl_1;
#ALTER TABLE products DROP products_image_sm_2;
#ALTER TABLE products DROP products_image_xl_2;
#ALTER TABLE products DROP products_image_sm_3;
#ALTER TABLE products DROP products_image_xl_3;
#ALTER TABLE products DROP products_image_sm_4;
#ALTER TABLE products DROP products_image_xl_4;
#ALTER TABLE products DROP products_image_sm_5;
#ALTER TABLE products DROP products_image_xl_5;
#ALTER TABLE products DROP products_image_sm_6;
#ALTER TABLE products DROP products_image_xl_6;

#PRODUCTS_DESCRIPTION #####################################################
#ALTER TABLE products_description ENGINE = InnoDB;
ALTER TABLE products_description ADD products_seo_title varchar(128);
ALTER TABLE products_description ADD products_seo_description text;
ALTER TABLE products_description ADD products_seo_keywords varchar(128);
ALTER TABLE products_description ADD products_mini_description text;
ALTER TABLE products_description ADD products_head_title_tag  varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL;
ALTER TABLE products_description ADD products_head_title_tag_alt  varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL;
ALTER TABLE products_description ADD products_head_title_tag_url  varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL;
ALTER TABLE products_description ADD products_head_desc_tag text;
ALTER TABLE products_description ADD products_head_keywords_tag text;
ALTER TABLE products_description ADD products_head_listing_text text;
ALTER TABLE products_description ADD products_head_sub_text text;
ALTER TABLE products_description ADD products_head_breadcrumb_text  varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL;
ALTER TABLE products_description ADD   cached int(1) DEFAULT '0';              
ALTER TABLE products_description ADD   cached_admin int(1) DEFAULT '0';        

#PRODUCTS_TO_CATEGORIES #####################################################
ALTER TABLE products_to_categories ADD  canonical int(1) DEFAULT NULL;
ALTER TABLE products_to_categories ADD linked tinyint(1) NOT NULL DEFAULT 0;
### set all products_to_categories canonical
update products_to_categories set canonical=1;


MYSQLCMD
