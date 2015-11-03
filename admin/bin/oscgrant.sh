#!/bin/bash
DB=oscpure
HOSTSHOP=localhost
HOSTADMIN=localhost
MASTERADMIN=masteradmin
MASTERADMINPWD=master
ADMIN=admin
ADMINPWD=admin
CUSTOMER=customer
CUSTOMERPWD=customer

#
#if [ ! "$1" ] 
#then 
#echo error
#    exit
#fi
#if [ ! "$2" ] 
#then 
#    DBNAME=$1 
#else
#    DBNAME=$2
#    DUMPSET=$1
#fi
#master admin

mysql<<MYSQLCMD

GRANT all privileges ON ${DB}.* to ${MASTERADMIN}@${HOSTADMIN} identified by "${MASTERADMINPWD}";

#ordinary admin
GRANT usage ON ${DB}.* to ${ADMIN}@${HOSTADMIN} identified by "${ADMINPWD}";

GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.aas_calendar to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.aas_settings to ${ADMIN}@${HOSTADMIN};
#only select, insert
GRANT SELECT, INSERT ON ${DB}.action_recorder to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.address_book to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.address_format to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.administrators to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.banners to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.banners_history to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.categories to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.categories_description to ${ADMIN}@${HOSTADMIN};
#only SELECT
GRANT SELECT ON ${DB}.configuration to ${ADMIN}@${HOSTADMIN};
#only SELECT
GRANT SELECT ON ${DB}.configuration_group to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.countries to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.coupon_email_track to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.coupon_gv_customer to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.coupon_gv_queue to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.coupon_redeem_track to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.coupons to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.coupons_description to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.currencies to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.customers to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.customers_basket to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.customers_basket_attributes to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.customers_info to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.geo_zones to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.information to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.languages to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.manufacturers to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.manufacturers_info to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.mm_bulkmail to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.mm_newsletters to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.mm_responsemail to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.mm_responsemail_backup to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.mm_responsemail_reset to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.mm_templates to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.newsletters to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.orders to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.orders_products to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.orders_products_attributes to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.orders_products_download to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.orders_status to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.orders_status_history to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.orders_total to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.products to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.products_attributes to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.products_attributes_download to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.products_description to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.products_images to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.products_notifications to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.products_options to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.products_options_values to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.products_options_values_to_products_options to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.products_options_values_to_products_options to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.products_to_categories to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.reviews to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.reviews_description to ${ADMIN}@${HOSTADMIN};
#only SELECT
GRANT SELECT ON ${DB}.sec_directory_whitelist to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.seo_friendly_urls to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.sessions to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.specials to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.tax_class to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.tax_rates to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.whos_online to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.zones to ${ADMIN}@${HOSTADMIN};
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.zones_to_geo_zones to ${ADMIN}@${HOSTADMIN};


#customer
GRANT usage ON ${DB}.* to ${CUSTOMER}@${HOSTSHOP} identified by "${CUSTOMERPWD}";

#address_book
GRANT SELECT ON ${DB}.address_book to ${CUSTOMER}@${HOSTSHOP};
GRANT INSERT ON ${DB}.address_book to ${CUSTOMER}@${HOSTSHOP};

#address_format
GRANT SELECT ON ${DB}.address_format to ${CUSTOMER}@${HOSTSHOP};

#banners
GRANT SELECT ON ${DB}.banners to ${CUSTOMER}@${HOSTSHOP};

#banners_history
GRANT SELECT ON ${DB}.banners_history to ${CUSTOMER}@${HOSTSHOP};

#banners_history
GRANT UPDATE ON ${DB}.banners_history to ${CUSTOMER}@${HOSTSHOP};

#categories
GRANT SELECT ON ${DB}.categories to ${CUSTOMER}@${HOSTSHOP};

#categories_description
GRANT SELECT ON ${DB}.categories_description to ${CUSTOMER}@${HOSTSHOP};

#configuration
GRANT SELECT ON ${DB}.configuration to ${CUSTOMER}@${HOSTSHOP};

#countries
GRANT SELECT ON ${DB}.countries to ${CUSTOMER}@${HOSTSHOP};

#coupon_gv_customer
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.coupon_gv_customer to ${CUSTOMER}@${HOSTSHOP};

#currencies
GRANT SELECT ON ${DB}.currencies to ${CUSTOMER}@${HOSTSHOP};

#customers
GRANT SELECT, INSERT, UPDATE ON ${DB}.customers to ${CUSTOMER}@${HOSTSHOP};

#customers_basket
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.customers_basket to ${CUSTOMER}@${HOSTSHOP};

#customers_basket_attributes
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.customers_basket_attributes to ${CUSTOMER}@${HOSTSHOP};

#customers_info
GRANT SELECT ON ${DB}.customers_info to ${CUSTOMER}@${HOSTSHOP};
GRANT UPDATE ON ${DB}.customers_info to ${CUSTOMER}@${HOSTSHOP};
GRANT INSERT ON ${DB}.customers_info to ${CUSTOMER}@${HOSTSHOP};

#geo_zones
GRANT SELECT ON ${DB}.geo_zones to ${CUSTOMER}@${HOSTSHOP};

#information (?)
GRANT SELECT ON ${DB}.information to ${CUSTOMER}@${HOSTSHOP};

#languages
GRANT SELECT ON ${DB}.languages to ${CUSTOMER}@${HOSTSHOP};

#manudiscount
#GRANT SELECT ON ${DB}.manudiscount to ${CUSTOMER}@${HOSTSHOP};

#manufacturers
GRANT SELECT ON ${DB}.manufacturers to ${CUSTOMER}@${HOSTSHOP};

#manufacturers_info
GRANT SELECT ON ${DB}.manufacturers_info to ${CUSTOMER}@${HOSTSHOP};

#mm_responsemail
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.mm_responsemail to ${CUSTOMER}@${HOSTSHOP};

#mm_templates
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.mm_templates to ${CUSTOMER}@${HOSTSHOP};

#orders
GRANT SELECT ON ${DB}.orders to ${CUSTOMER}@${HOSTSHOP};
GRANT INSERT ON ${DB}.orders to ${CUSTOMER}@${HOSTSHOP};

#orders_total
GRANT INSERT ON ${DB}.orders_total to ${CUSTOMER}@${HOSTSHOP};

#orders_status_history
GRANT INSERT ON ${DB}.orders_status_history to ${CUSTOMER}@${HOSTSHOP};


#orders_products
GRANT SELECT ON ${DB}.orders_products to ${CUSTOMER}@${HOSTSHOP};
GRANT INSERT ON ${DB}.orders_products to ${CUSTOMER}@${HOSTSHOP};


#products
GRANT SELECT ON ${DB}.products to ${CUSTOMER}@${HOSTSHOP};
GRANT UPDATE ON ${DB}.products to ${CUSTOMER}@${HOSTSHOP};

#products_attributes
GRANT SELECT ON ${DB}.products_attributes to ${CUSTOMER}@${HOSTSHOP};

#products_attributes_download
GRANT SELECT ON ${DB}.products_attributes_download to ${CUSTOMER}@${HOSTSHOP};

#products_description
GRANT SELECT ON ${DB}.products_description to ${CUSTOMER}@${HOSTSHOP};
GRANT UPDATE (products_viewed) ON ${DB}.products_description to ${CUSTOMER}@${HOSTSHOP};

#products_notifications
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.products_notifications to ${CUSTOMER}@${HOSTSHOP};

#products_options
GRANT SELECT ON ${DB}.products_options to ${CUSTOMER}@${HOSTSHOP};

#products_options_values
GRANT SELECT ON ${DB}.products_options_values to ${CUSTOMER}@${HOSTSHOP};

#products_to_categories
GRANT SELECT ON ${DB}.products_to_categories to ${CUSTOMER}@${HOSTSHOP};

#reviews
GRANT SELECT ON ${DB}.reviews to ${CUSTOMER}@${HOSTSHOP};
GRANT SELECT ON ${DB}.reviews_description to ${CUSTOMER}@${HOSTSHOP};

#sessions (?)
GRANT SELECT, INSERT, UPDATE, DELETE ON ${DB}.sessions to ${CUSTOMER}@${HOSTSHOP};

#specials
GRANT SELECT ON ${DB}.specials to ${CUSTOMER}@${HOSTSHOP};

#tax_class (?)
GRANT SELECT ON ${DB}.tax_class to ${CUSTOMER}@${HOSTSHOP};


#tax_rates
GRANT SELECT ON ${DB}.tax_rates to ${CUSTOMER}@${HOSTSHOP};

#whos_online
GRANT SELECT ON ${DB}.whos_online to ${CUSTOMER}@${HOSTSHOP};
GRANT INSERT ON ${DB}.whos_online to ${CUSTOMER}@${HOSTSHOP};
GRANT DELETE ON ${DB}.whos_online to ${CUSTOMER}@${HOSTSHOP};
GRANT UPDATE ON ${DB}.whos_online to ${CUSTOMER}@${HOSTSHOP};

#zones
GRANT SELECT ON ${DB}.zones to ${CUSTOMER}@${HOSTSHOP};

#zones_to_geo_zones
GRANT SELECT ON ${DB}.zones_to_geo_zones to ${CUSTOMER}@${HOSTSHOP};
MYSQLCMD