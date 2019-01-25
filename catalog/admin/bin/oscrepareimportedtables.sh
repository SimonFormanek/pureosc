#!/bin/bash
#repagre current osc structure of imported tables
if [ ! "$1" ]; then
echo 'Missing: "-uuser -ppassword -hhost DBNAME"; only DBNAME is needed...'
exit
fi
mysql<<MYSQLCMD
use ${1};

#PRODUCTS
ALTER TABLE products ENGINE = InnoDB;
ALTER TABLE products ADD products_custom_date datetime;
ALTER TABLE products ADD products_sort_order int(10);
#special for conversion from CreLoaded:
ALTER TABLE products DROP products_image_med;
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

#PRODUCTS_DESCRIPTION 
ALTER TABLE products_description ENGINE = InnoDB;
ALTER TABLE products_description ADD products_seo_title varchar(128);
ALTER TABLE products_description ADD products_seo_description text;
ALTER TABLE products_description ADD products_seo_keywords varchar(128);
ALTER TABLE products_description ADD products_mini_description text;
#special for conversion from CreLoaded:
ALTER TABLE products_description DROP products_head_title_tag;
#ALTER TABLE products_description DROP products_head_desc_tag;
#ALTER TABLE products_description DROP products_head_keywords_tag;

#CATEGORIES_DESCRIPTION 
ALTER TABLE categories_description ENGINE = InnoDB;
ALTER TABLE categories_description ADD categories_seo_title varchar(128);
ALTER TABLE categories_description ADD categories_seo_description  text;
ALTER TABLE categories_description ADD categories_seo_keywords varchar(128);
#special for conversion from CreLoaded:
ALTER TABLE categories_description DROP categories_head_title_tag;
#ALTER TABLE categories_description DROP categories_head_desc_tag;
#ALTER TABLE categories_description DROP categories_head_keywords_tag;
MYSQLCMD
