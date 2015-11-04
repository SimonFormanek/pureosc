# $Id$
#
# osCommerce, Open Source E-Commerce Solutions
# http://www.oscommerce.com
#
# Copyright (c) 2014 osCommerce
#
# Gergely SMTP Email Addition
# Alternative Administration System
# Credit Class Gift Voucher
# Header Tags
# Manual Order Maker
# Mail Manager Template System
#
# Released under the GNU General Public License
#
# NOTE: * Please make any modifications to this file by hand!
#       * DO NOT use a mysqldump created file for new changes!
#       * Please take note of the table structure, and use this
#         structure as a standard for future modifications!

DROP TABLE IF EXISTS action_recorder;
CREATE TABLE action_recorder (
  id int NOT NULL auto_increment,
  module varchar(255) NOT NULL,
  user_id int,
  user_name varchar(255),
  identifier varchar(255) NOT NULL,
  success char(1),
  date_added datetime NOT NULL,
  PRIMARY KEY (id),
  KEY idx_action_recorder_module (module),
  KEY idx_action_recorder_user_id (user_id),
  KEY idx_action_recorder_identifier (identifier),
  KEY idx_action_recorder_date_added (date_added)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS address_book;
CREATE TABLE address_book (
   address_book_id int NOT NULL auto_increment,
   customers_id int NOT NULL,
   entry_gender char(1),
   entry_company varchar(255),
   entry_firstname varchar(255) NOT NULL,
   entry_lastname varchar(255) NOT NULL,
   entry_street_address varchar(255) NOT NULL,
   entry_suburb varchar(255),
   entry_postcode varchar(255) NOT NULL,
   entry_city varchar(255) NOT NULL,
   entry_state varchar(255),
   entry_country_id int DEFAULT '0' NOT NULL,
   entry_zone_id int DEFAULT '0' NOT NULL,
   PRIMARY KEY (address_book_id),
   KEY idx_address_book_customers_id (customers_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS address_format;
CREATE TABLE address_format (
  address_format_id int NOT NULL auto_increment,
  address_format varchar(128) NOT NULL,
  address_summary varchar(48) NOT NULL,
  PRIMARY KEY (address_format_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS administrators;
CREATE TABLE administrators (
  id int NOT NULL auto_increment,
  user_name varchar(255) binary NOT NULL,
  user_password varchar(60) NOT NULL,
  PRIMARY KEY (id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS banners;
CREATE TABLE banners (
  banners_id int NOT NULL auto_increment,
  banners_title varchar(64) NOT NULL,
  banners_url varchar(255) NOT NULL,
  banners_image varchar(64) NOT NULL,
  banners_group varchar(10) NOT NULL,
  banners_html_text text,
  expires_impressions int(7) DEFAULT '0',
  expires_date datetime DEFAULT NULL,
  date_scheduled datetime DEFAULT NULL,
  date_added datetime NOT NULL,
  date_status_change datetime DEFAULT NULL,
  status int(1) DEFAULT '1' NOT NULL,
  PRIMARY KEY (banners_id),
  KEY idx_banners_group (banners_group)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS banners_history;
CREATE TABLE banners_history (
  banners_history_id int NOT NULL auto_increment,
  banners_id int NOT NULL,
  banners_shown int(5) NOT NULL DEFAULT '0',
  banners_clicked int(5) NOT NULL DEFAULT '0',
  banners_history_date datetime NOT NULL,
  PRIMARY KEY (banners_history_id),
  KEY idx_banners_history_banners_id (banners_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS categories;
CREATE TABLE categories (
   categories_id int NOT NULL auto_increment,
   categories_image varchar(64),
   parent_id int DEFAULT '0' NOT NULL,
   sort_order int(3),
   date_added datetime,
   last_modified datetime,
   PRIMARY KEY (categories_id),
   KEY idx_categories_parent_id (parent_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS categories_description;
CREATE TABLE categories_description (
   categories_id int DEFAULT '0' NOT NULL,
   language_id int DEFAULT '1' NOT NULL,
   categories_name varchar(32) NOT NULL,
# SEO Header Tags Reloaded
  categories_description TEXT NULL,
  categories_seo_title VARCHAR(128) NULL,
  categories_seo_description TEXT NULL,
  categories_seo_keywords VARCHAR(128) NULL,
# EOF SEO Header Tags Reloaded
   PRIMARY KEY (categories_id, language_id),
   KEY idx_categories_name (categories_name)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS configuration;
CREATE TABLE configuration (
  configuration_id int NOT NULL auto_increment,
  configuration_title varchar(255) NOT NULL,
  configuration_key varchar(255) NOT NULL,
  configuration_value text NOT NULL,
  configuration_description varchar(255) NOT NULL,
  configuration_group_id int NOT NULL,
  sort_order int(5) NULL,
  last_modified datetime NULL,
  date_added datetime NOT NULL,
  use_function varchar(255) NULL,
  set_function varchar(255) NULL,
  PRIMARY KEY (configuration_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS configuration_group;
CREATE TABLE configuration_group (
  configuration_group_id int NOT NULL auto_increment,
  configuration_group_title varchar(64) NOT NULL,
  configuration_group_description varchar(255) NOT NULL,
  sort_order int(5) NULL,
  visible int(1) DEFAULT '1' NULL,
  PRIMARY KEY (configuration_group_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS countries;
CREATE TABLE countries (
  countries_id int NOT NULL auto_increment,
  countries_name varchar(255) NOT NULL,
  countries_iso_code_2 char(2) NOT NULL,
  countries_iso_code_3 char(3) NOT NULL,
  address_format_id int NOT NULL,
  PRIMARY KEY (countries_id),
  KEY IDX_COUNTRIES_NAME (countries_name)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS currencies;
CREATE TABLE currencies (
  currencies_id int NOT NULL auto_increment,
  title varchar(32) NOT NULL,
  code char(3) NOT NULL,
  symbol_left varchar(12),
  symbol_right varchar(12),
  decimal_point char(1),
  thousands_point char(1),
  decimal_places char(1),
  value float(13,8),
  last_updated datetime NULL,
  PRIMARY KEY (currencies_id),
  KEY idx_currencies_code (code)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS customers;
CREATE TABLE customers (
   customers_id int NOT NULL auto_increment,
   customers_gender char(1),
   customers_firstname varchar(255) NOT NULL,
   customers_lastname varchar(255) NOT NULL,
   customers_dob datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   customers_email_address varchar(255) NOT NULL,
   customers_default_address_id int,
   customers_telephone varchar(255) NOT NULL,
   customers_fax varchar(255),
   customers_password varchar(60) NOT NULL,
   customers_newsletter char(1),
# Mail Manager   
   mmstatus VARCHAR(2) NOT NULL DEFAULT '0',
# EOF Mail Manager   
   PRIMARY KEY (customers_id),
   KEY idx_customers_email_address (customers_email_address)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS customers_basket;
CREATE TABLE customers_basket (
  customers_basket_id int NOT NULL auto_increment,
  customers_id int NOT NULL,
  products_id tinytext NOT NULL,
  customers_basket_quantity int(2) NOT NULL,
  final_price decimal(15,4),
  customers_basket_date_added char(8),
  PRIMARY KEY (customers_basket_id),
  KEY idx_customers_basket_customers_id (customers_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS customers_basket_attributes;
CREATE TABLE customers_basket_attributes (
  customers_basket_attributes_id int NOT NULL auto_increment,
  customers_id int NOT NULL,
  products_id tinytext NOT NULL,
  products_options_id int NOT NULL,
  products_options_value_id int NOT NULL,
  PRIMARY KEY (customers_basket_attributes_id),
  KEY idx_customers_basket_att_customers_id (customers_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS customers_info;
CREATE TABLE customers_info (
  customers_info_id int NOT NULL,
  customers_info_date_of_last_logon datetime,
  customers_info_number_of_logons int(5),
  customers_info_date_account_created datetime,
  customers_info_date_account_last_modified datetime,
  global_product_notifications int(1) DEFAULT '0',
  password_reset_key char(40),
  password_reset_date datetime,
  PRIMARY KEY (customers_info_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS languages;
CREATE TABLE languages (
  languages_id int NOT NULL auto_increment,
  name varchar(32)  NOT NULL,
  code char(2) NOT NULL,
  image varchar(64),
  directory varchar(32),
  sort_order int(3),
  PRIMARY KEY (languages_id),
  KEY IDX_LANGUAGES_NAME (name)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS manufacturers;
CREATE TABLE manufacturers (
  manufacturers_id int NOT NULL auto_increment,
  manufacturers_name varchar(32) NOT NULL,
  manufacturers_image varchar(64),
  date_added datetime NULL,
  last_modified datetime NULL,
# SEO Header Tags Reloaded
  manufacturers_seo_title VARCHAR(128) NULL,
# EOF SEO Header Tags Reloaded
  PRIMARY KEY (manufacturers_id),
  KEY IDX_MANUFACTURERS_NAME (manufacturers_name)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS manufacturers_info;
CREATE TABLE manufacturers_info (
  manufacturers_id int NOT NULL,
  languages_id int NOT NULL,
  manufacturers_url varchar(255) NOT NULL,
  url_clicked int(5) NOT NULL default '0',
  date_last_click datetime NULL,
# SEO Header Tags Reloaded
  manufacturers_description TEXT NULL,
  manufacturers_seo_description TEXT NULL,
  manufacturers_seo_keywords VARCHAR(128) NULL,
# EOF SEO Header Tags Reloaded
  PRIMARY KEY (manufacturers_id, languages_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS newsletters;
CREATE TABLE newsletters (
  newsletters_id int NOT NULL auto_increment,
  title varchar(255) NOT NULL,
  content text NOT NULL,
  module varchar(255) NOT NULL,
  date_added datetime NOT NULL,
  date_sent datetime,
  status int(1),
  locked int(1) DEFAULT '0',
  PRIMARY KEY (newsletters_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS orders;
CREATE TABLE orders (
  orders_id int NOT NULL auto_increment,
  customers_id int NOT NULL,
  customers_name varchar(255) NOT NULL,
  customers_company varchar(255),
  customers_street_address varchar(255) NOT NULL,
  customers_suburb varchar(255),
  customers_city varchar(255) NOT NULL,
  customers_postcode varchar(255) NOT NULL,
  customers_state varchar(255),
  customers_country varchar(255) NOT NULL,
  customers_telephone varchar(255) NOT NULL,
  customers_email_address varchar(255) NOT NULL,
  customers_address_format_id int(5) NOT NULL,
  delivery_name varchar(255) NOT NULL,
  delivery_company varchar(255),
  delivery_street_address varchar(255) NOT NULL,
  delivery_suburb varchar(255),
  delivery_city varchar(255) NOT NULL,
  delivery_postcode varchar(255) NOT NULL,
  delivery_state varchar(255),
  delivery_country varchar(255) NOT NULL,
  delivery_address_format_id int(5) NOT NULL,
  billing_name varchar(255) NOT NULL,
  billing_company varchar(255),
  billing_street_address varchar(255) NOT NULL,
  billing_suburb varchar(255),
  billing_city varchar(255) NOT NULL,
  billing_postcode varchar(255) NOT NULL,
  billing_state varchar(255),
  billing_country varchar(255) NOT NULL,
  billing_address_format_id int(5) NOT NULL,
  payment_method varchar(255) NOT NULL,
  cc_type varchar(20),
  cc_owner varchar(255),
  cc_number varchar(32),
  cc_expires varchar(4),
  last_modified datetime,
  date_purchased datetime,
  orders_status int(5) NOT NULL,
  orders_date_finished datetime,
  currency char(3),
  currency_value decimal(14,6),
# Manual Order Maker
  customer_service_id VARCHAR(15),
  shipping_module VARCHAR(255),
#EOF Manual Order Maker
  PRIMARY KEY (orders_id),
  KEY idx_orders_customers_id (customers_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS orders_products;
CREATE TABLE orders_products (
  orders_products_id int NOT NULL auto_increment,
  orders_id int NOT NULL,
  products_id int NOT NULL,
  products_model varchar(64),
  products_name varchar(64) NOT NULL,
  products_price decimal(15,4) NOT NULL,
  final_price decimal(15,4) NOT NULL,
  products_tax decimal(7,4) NOT NULL,
  products_quantity int(2) NOT NULL,
  PRIMARY KEY (orders_products_id),
  KEY idx_orders_products_orders_id (orders_id),
  KEY idx_orders_products_products_id (products_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS orders_status;
CREATE TABLE orders_status (
   orders_status_id int DEFAULT '0' NOT NULL,
   language_id int DEFAULT '1' NOT NULL,
   orders_status_name varchar(32) NOT NULL,
   public_flag int DEFAULT '1',
   downloads_flag int DEFAULT '0',
   PRIMARY KEY (orders_status_id, language_id),
   KEY idx_orders_status_name (orders_status_name)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS orders_status_history;
CREATE TABLE orders_status_history (
   orders_status_history_id int NOT NULL auto_increment,
   orders_id int NOT NULL,
   orders_status_id int(5) NOT NULL,
   date_added datetime NOT NULL,
   customer_notified int(1) DEFAULT '0',
   comments text,
   PRIMARY KEY (orders_status_history_id),
   KEY idx_orders_status_history_orders_id (orders_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS orders_products_attributes;
CREATE TABLE orders_products_attributes (
  orders_products_attributes_id int NOT NULL auto_increment,
  orders_id int NOT NULL,
  orders_products_id int NOT NULL,
  products_options varchar(32) NOT NULL,
  products_options_values varchar(32) NOT NULL,
  options_values_price decimal(15,4) NOT NULL,
  price_prefix char(1) NOT NULL,
  PRIMARY KEY (orders_products_attributes_id),
  KEY idx_orders_products_att_orders_id (orders_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS orders_products_download;
CREATE TABLE orders_products_download (
  orders_products_download_id int NOT NULL auto_increment,
  orders_id int NOT NULL default '0',
  orders_products_id int NOT NULL default '0',
  orders_products_filename varchar(255) NOT NULL default '',
  download_maxdays int(2) NOT NULL default '0',
  download_count int(2) NOT NULL default '0',
  PRIMARY KEY  (orders_products_download_id),
  KEY idx_orders_products_download_orders_id (orders_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS orders_total;
CREATE TABLE orders_total (
  orders_total_id int unsigned NOT NULL auto_increment,
  orders_id int NOT NULL,
  title varchar(255) NOT NULL,
  text varchar(255) NOT NULL,
  value decimal(15,4) NOT NULL,
  class varchar(32) NOT NULL,
  sort_order int NOT NULL,
  PRIMARY KEY (orders_total_id),
  KEY idx_orders_total_orders_id (orders_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS products;
CREATE TABLE products (
  products_id int NOT NULL auto_increment,
  products_quantity int(4) NOT NULL,
  products_model varchar(64),
  products_image varchar(64),
  products_price decimal(15,4) NOT NULL,
  products_date_added datetime NOT NULL,
  products_last_modified datetime,
  products_date_available datetime,
  products_weight decimal(5,2) NOT NULL,
  products_status tinyint(1) NOT NULL,
  products_tax_class_id int NOT NULL,
  manufacturers_id int NULL,
  products_ordered int NOT NULL default '0',
  products_custom_date datetime,
  sort_order int(10) NULL,
  PRIMARY KEY (products_id),
  KEY idx_products_model (products_model),
  KEY idx_products_date_available (products_date_available),
  KEY idx_products_custom_date (products_custom_date),
  KEY idx_sort_order (sort_order)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS products_attributes;
CREATE TABLE products_attributes (
  products_attributes_id int NOT NULL auto_increment,
  products_id int NOT NULL,
  options_id int NOT NULL,
  options_values_id int NOT NULL,
  options_values_price decimal(15,4) NOT NULL,
  price_prefix char(1) NOT NULL,
  PRIMARY KEY (products_attributes_id),
  KEY idx_products_attributes_products_id (products_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS products_attributes_download;
CREATE TABLE products_attributes_download (
  products_attributes_id int NOT NULL,
  products_attributes_filename varchar(255) NOT NULL default '',
  products_attributes_maxdays int(2) default '0',
  products_attributes_maxcount int(2) default '0',
  PRIMARY KEY  (products_attributes_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS products_description;
CREATE TABLE products_description (
  products_id int NOT NULL auto_increment,
  language_id int NOT NULL default '1',
  products_name varchar(64) NOT NULL default '',
  products_description text,
  products_url varchar(255) default NULL,
  products_viewed int(5) default '0',
# SEO Header Tags Reloaded
  products_seo_title VARCHAR(128) NULL,
  products_seo_description TEXT NULL,
  products_seo_keywords VARCHAR(128) NULL,
  products_mini_description TEXT NULL,
# EOF SEO Header Tags Reloaded
  PRIMARY KEY  (products_id,language_id),
  KEY products_name (products_name)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS products_images;
CREATE TABLE products_images (
  id int NOT NULL auto_increment,
  products_id int NOT NULL,
  image varchar(64),
  htmlcontent text,
  sort_order int NOT NULL,
  PRIMARY KEY (id),
  KEY products_images_prodid (products_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS products_notifications;
CREATE TABLE products_notifications (
  products_id int NOT NULL,
  customers_id int NOT NULL,
  date_added datetime NOT NULL,
  PRIMARY KEY (products_id, customers_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS products_options;
CREATE TABLE products_options (
  products_options_id int NOT NULL default '0',
  language_id int NOT NULL default '1',
  products_options_name varchar(32) NOT NULL default '',
  PRIMARY KEY  (products_options_id,language_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS products_options_values;
CREATE TABLE products_options_values (
  products_options_values_id int NOT NULL default '0',
  language_id int NOT NULL default '1',
  products_options_values_name varchar(64) NOT NULL default '',
  PRIMARY KEY  (products_options_values_id,language_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS products_options_values_to_products_options;
CREATE TABLE products_options_values_to_products_options (
  products_options_values_to_products_options_id int NOT NULL auto_increment,
  products_options_id int NOT NULL,
  products_options_values_id int NOT NULL,
  PRIMARY KEY (products_options_values_to_products_options_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS products_to_categories;
CREATE TABLE products_to_categories (
  products_id int NOT NULL,
  categories_id int NOT NULL,
  PRIMARY KEY (products_id,categories_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS reviews;
CREATE TABLE reviews (
  reviews_id int NOT NULL auto_increment,
  products_id int NOT NULL,
  customers_id int,
  customers_name varchar(255) NOT NULL,
  reviews_rating int(1),
  date_added datetime,
  last_modified datetime,
  reviews_status tinyint(1) NOT NULL default '0',
  reviews_read int(5) NOT NULL default '0',
# SEO Header Tags Reloaded
  is_testimonial tinyint(1) NOT NULL default  '0',
# EOF SEO Header Tags Reloaded
  PRIMARY KEY (reviews_id),
  KEY idx_reviews_products_id (products_id),
  KEY idx_reviews_customers_id (customers_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS reviews_description;
CREATE TABLE reviews_description (
  reviews_id int NOT NULL,
  languages_id int NOT NULL,
  reviews_text text NOT NULL,
  PRIMARY KEY (reviews_id, languages_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS sec_directory_whitelist;
CREATE TABLE sec_directory_whitelist (
  id int NOT NULL auto_increment,
  directory varchar(255) NOT NULL,
  PRIMARY KEY (id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS sessions;
CREATE TABLE sessions (
  sesskey varchar(128) NOT NULL,
  expiry int(11) unsigned NOT NULL,
  value text NOT NULL,
  PRIMARY KEY (sesskey)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS specials;
CREATE TABLE specials (
  specials_id int NOT NULL auto_increment,
  products_id int NOT NULL,
  specials_new_products_price decimal(15,4) NOT NULL,
  specials_date_added datetime,
  specials_last_modified datetime,
  expires_date datetime,
  date_status_change datetime,
  status int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (specials_id),
  KEY idx_specials_products_id (products_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS tax_class;
CREATE TABLE tax_class (
  tax_class_id int NOT NULL auto_increment,
  tax_class_title varchar(32) NOT NULL,
  tax_class_description varchar(255) NOT NULL,
  last_modified datetime NULL,
  date_added datetime NOT NULL,
  PRIMARY KEY (tax_class_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS tax_rates;
CREATE TABLE tax_rates (
  tax_rates_id int NOT NULL auto_increment,
  tax_zone_id int NOT NULL,
  tax_class_id int NOT NULL,
  tax_priority int(5) DEFAULT 1,
  tax_rate decimal(7,4) NOT NULL,
  tax_description varchar(255) NOT NULL,
  last_modified datetime NULL,
  date_added datetime NOT NULL,
  PRIMARY KEY (tax_rates_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS geo_zones;
CREATE TABLE geo_zones (
  geo_zone_id int NOT NULL auto_increment,
  geo_zone_name varchar(32) NOT NULL,
  geo_zone_description varchar(255) NOT NULL,
  last_modified datetime NULL,
  date_added datetime NOT NULL,
  PRIMARY KEY (geo_zone_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS whos_online;
CREATE TABLE whos_online (
  customer_id int,
  full_name varchar(255) NOT NULL,
  session_id varchar(128) NOT NULL,
  ip_address varchar(15) NOT NULL,
  time_entry varchar(14) NOT NULL,
  time_last_click varchar(14) NOT NULL,
  last_page_url text NOT NULL,
  KEY idx_whos_online_session_id (session_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS zones;
CREATE TABLE zones (
  zone_id int NOT NULL auto_increment,
  zone_country_id int NOT NULL,
  zone_code varchar(32) NOT NULL,
  zone_name varchar(255) NOT NULL,
  PRIMARY KEY (zone_id),
  KEY idx_zones_country_id (zone_country_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS zones_to_geo_zones;
CREATE TABLE zones_to_geo_zones (
   association_id int NOT NULL auto_increment,
   zone_country_id int NOT NULL,
   zone_id int NULL,
   geo_zone_id int NULL,
   last_modified datetime NULL,
   date_added datetime NOT NULL,
   PRIMARY KEY (association_id),
   KEY idx_zones_to_geo_zones_country_id (zone_country_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

# data

# 1 - Default, 2 - USA, 3 - Spain, 4 - Singapore, 5 - Germany
INSERT INTO address_format VALUES (1, '$firstname $lastname$cr$streets$cr$city, $postcode$cr$statecomma$country','$city / $country');
INSERT INTO address_format VALUES (2, '$firstname $lastname$cr$streets$cr$city, $state    $postcode$cr$country','$city, $state / $country');
INSERT INTO address_format VALUES (3, '$firstname $lastname$cr$streets$cr$city$cr$postcode - $statecomma$country','$state / $country');
INSERT INTO address_format VALUES (4, '$firstname $lastname$cr$streets$cr$city ($postcode)$cr$country', '$postcode / $country');
INSERT INTO address_format VALUES (5, '$firstname $lastname$cr$streets$cr$postcode $city$cr$country','$city / $country');


INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Store Name', 'STORE_NAME', 'PureOSC', 'The name of my store', '1', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Store Owner', 'STORE_OWNER', 'PureHTML', 'The name of my store owner', '1', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('E-Mail Address', 'STORE_OWNER_EMAIL_ADDRESS', 'root@localhost', 'The e-mail address of my store owner', '1', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('E-Mail From', 'EMAIL_FROM', 'osCommerce <root@localhost>', 'The e-mail address used in (sent) e-mails', '1', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Country', 'STORE_COUNTRY', '56', 'The country my store is located in <br /><br /><strong>Note: Please remember to update the store zone.</strong>', '1', '6', 'tep_get_country_name', 'tep_cfg_pull_down_country_list(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Zone', 'STORE_ZONE', '918', 'The zone my store is located in', '1', '7', 'tep_cfg_get_zone_name', 'tep_cfg_pull_down_zone_list(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Expected Sort Order', 'EXPECTED_PRODUCTS_SORT', 'desc', 'This is the sort order used in the expected products box.', '1', '8', 'tep_cfg_select_option(array(\'asc\', \'desc\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Expected Sort Field', 'EXPECTED_PRODUCTS_FIELD', 'date_expected', 'The column to sort by in the expected products box.', '1', '9', 'tep_cfg_select_option(array(\'products_name\', \'date_expected\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Switch To Default Language Currency', 'USE_DEFAULT_LANGUAGE_CURRENCY', 'false', 'Automatically switch to the language\'s currency when it is changed', '1', '10', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Send Extra Order Emails To', 'SEND_EXTRA_ORDER_EMAILS_TO', '', 'Send extra order emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '1', '11', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Use Search-Engine Safe URLs', 'SEARCH_ENGINE_FRIENDLY_URLS', 'false', 'Use search-engine safe urls for all site links', '1', '12', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Cart After Adding Product', 'DISPLAY_CART', 'true', 'Display the shopping cart after adding a product (or return back to their origin)', '1', '14', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Allow Guest To Tell A Friend', 'ALLOW_GUEST_TO_TELL_A_FRIEND', 'false', 'Allow guests to tell a friend about a product', '1', '15', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Default Search Operator', 'ADVANCED_SEARCH_DEFAULT_OPERATOR', 'and', 'Default search operators', '1', '17', 'tep_cfg_select_option(array(\'and\', \'or\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Store Address', 'STORE_ADDRESS', 'Address Line 1\nAddress Line 2\nCountry\nPhone', 'This is the Address of my store used on printable documents and displayed online', '1', '18', 'tep_cfg_textarea(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Store Phone', 'STORE_PHONE', '555-1234', 'This is the phone number of my store used on printable documents and displayed online', '1', '19', 'tep_cfg_textarea(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Tax Decimal Places', 'TAX_DECIMAL_PLACES', '0', 'Pad the tax value this amount of decimal places', '1', '20', now());
#pure:change display prices with tax: true
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Prices with Tax', 'DISPLAY_PRICE_WITH_TAX', 'true', 'Display prices with tax included (true) or add the tax at the end (false)', '1', '21', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now());
#pure:new NEW_PRODUCTS_SORT_ORDER
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('New products Sort Order', 'NEW_PRODUCTS_SORT_ORDER', 'p.products_date_available DESC, p.products_date_added DESC', 'Possible value: \"p.products_date_available DESC, p.products_date_added DESC\" OR for Date Products \"p.products_custom_date\"', '1', '22', now());



INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Prices with Tax', 'DISPLAY_PRICE_WITH_TAX', 'true', 'Display prices with tax included (true) or add the tax at the end (false)', '1', '21', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('First Name', 'ENTRY_FIRST_NAME_MIN_LENGTH', '2', 'Minimum length of first name', '2', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Last Name', 'ENTRY_LAST_NAME_MIN_LENGTH', '2', 'Minimum length of last name', '2', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Date of Birth', 'ENTRY_DOB_MIN_LENGTH', '10', 'Minimum length of date of birth', '2', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('E-Mail Address', 'ENTRY_EMAIL_ADDRESS_MIN_LENGTH', '6', 'Minimum length of e-mail address', '2', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Street Address', 'ENTRY_STREET_ADDRESS_MIN_LENGTH', '5', 'Minimum length of street address', '2', '5', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Company', 'ENTRY_COMPANY_MIN_LENGTH', '2', 'Minimum length of company name', '2', '6', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Post Code', 'ENTRY_POSTCODE_MIN_LENGTH', '4', 'Minimum length of post code', '2', '7', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('City', 'ENTRY_CITY_MIN_LENGTH', '3', 'Minimum length of city', '2', '8', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('State', 'ENTRY_STATE_MIN_LENGTH', '2', 'Minimum length of state', '2', '9', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Telephone Number', 'ENTRY_TELEPHONE_MIN_LENGTH', '3', 'Minimum length of telephone number', '2', '10', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Password', 'ENTRY_PASSWORD_MIN_LENGTH', '5', 'Minimum length of password', '2', '11', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Credit Card Owner Name', 'CC_OWNER_MIN_LENGTH', '3', 'Minimum length of credit card owner name', '2', '12', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Credit Card Number', 'CC_NUMBER_MIN_LENGTH', '10', 'Minimum length of credit card number', '2', '13', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Review Text', 'REVIEW_TEXT_MIN_LENGTH', '50', 'Minimum length of review text', '2', '14', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Best Sellers', 'MIN_DISPLAY_BESTSELLERS', '1', 'Minimum number of best sellers to display', '2', '15', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Also Purchased', 'MIN_DISPLAY_ALSO_PURCHASED', '1', 'Minimum number of products to display in the \'This Customer Also Purchased\' box', '2', '16', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Address Book Entries', 'MAX_ADDRESS_BOOK_ENTRIES', '5', 'Maximum address book entries a customer is allowed to have', '3', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Search Results', 'MAX_DISPLAY_SEARCH_RESULTS', '20', 'Amount of products to list', '3', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Page Links', 'MAX_DISPLAY_PAGE_LINKS', '5', 'Number of \'number\' links use for page-sets', '3', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Special Products', 'MAX_DISPLAY_SPECIAL_PRODUCTS', '9', 'Maximum number of products on special to display', '3', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('New Products Module', 'MAX_DISPLAY_NEW_PRODUCTS', '9', 'Maximum number of new products to display in a category', '3', '5', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Products Expected', 'MAX_DISPLAY_UPCOMING_PRODUCTS', '10', 'Maximum number of products expected to display', '3', '6', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Manufacturers List', 'MAX_DISPLAY_MANUFACTURERS_IN_A_LIST', '0', 'Used in manufacturers box; when the number of manufacturers exceeds this number, a drop-down list will be displayed instead of the default list', '3', '7', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Manufacturers Select Size', 'MAX_MANUFACTURERS_LIST', '1', 'Used in manufacturers box; when this value is \'1\' the classic drop-down list will be used for the manufacturers box. Otherwise, a list-box with the specified number of rows will be displayed.', '3', '7', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Length of Manufacturers Name', 'MAX_DISPLAY_MANUFACTURER_NAME_LEN', '15', 'Used in manufacturers box; maximum length of manufacturers name to display', '3', '8', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('New Reviews', 'MAX_DISPLAY_NEW_REVIEWS', '6', 'Maximum number of new reviews to display', '3', '9', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Selection of Random Reviews', 'MAX_RANDOM_SELECT_REVIEWS', '10', 'How many records to select from to choose one random product review', '3', '10', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Selection of Random New Products', 'MAX_RANDOM_SELECT_NEW', '10', 'How many records to select from to choose one random new product to display', '3', '11', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Selection of Products on Special', 'MAX_RANDOM_SELECT_SPECIALS', '10', 'How many records to select from to choose one random product special to display', '3', '12', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Categories To List Per Row', 'MAX_DISPLAY_CATEGORIES_PER_ROW', '3', 'How many categories to list per row', '3', '13', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('New Products Listing', 'MAX_DISPLAY_PRODUCTS_NEW', '10', 'Maximum number of new products to display in new products page', '3', '14', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Best Sellers', 'MAX_DISPLAY_BESTSELLERS', '10', 'Maximum number of best sellers to display', '3', '15', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Also Purchased', 'MAX_DISPLAY_ALSO_PURCHASED', '6', 'Maximum number of products to display in the \'This Customer Also Purchased\' box', '3', '16', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Customer Order History Box', 'MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX', '6', 'Maximum number of products to display in the customer order history box', '3', '17', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Order History', 'MAX_DISPLAY_ORDER_HISTORY', '10', 'Maximum number of orders to display in the order history page', '3', '18', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Product Quantities In Shopping Cart', 'MAX_QTY_IN_CART', '99', 'Maximum number of product quantities that can be added to the shopping cart (0 for no limit)', '3', '19', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Small Image Width', 'SMALL_IMAGE_WIDTH', '100', 'The pixel width of small images', '4', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Small Image Height', 'SMALL_IMAGE_HEIGHT', '80', 'The pixel height of small images', '4', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Heading Image Width', 'HEADING_IMAGE_WIDTH', '57', 'The pixel width of heading images', '4', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Heading Image Height', 'HEADING_IMAGE_HEIGHT', '40', 'The pixel height of heading images', '4', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Subcategory Image Width', 'SUBCATEGORY_IMAGE_WIDTH', '100', 'The pixel width of subcategory images', '4', '5', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Subcategory Image Height', 'SUBCATEGORY_IMAGE_HEIGHT', '57', 'The pixel height of subcategory images', '4', '6', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Calculate Image Size', 'CONFIG_CALCULATE_IMAGE_SIZE', 'true', 'Calculate the size of images?', '4', '7', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Image Required', 'IMAGE_REQUIRED', 'true', 'Enable to display broken images. Good for development.', '4', '8', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Gender', 'ACCOUNT_GENDER', 'true', 'Display gender in the customers account', '5', '1', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Date of Birth', 'ACCOUNT_DOB', 'true', 'Display date of birth in the customers account', '5', '2', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Company', 'ACCOUNT_COMPANY', 'true', 'Display company in the customers account', '5', '3', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Suburb', 'ACCOUNT_SUBURB', 'true', 'Display suburb in the customers account', '5', '4', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('State', 'ACCOUNT_STATE', 'true', 'Display state in the customers account', '5', '5', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Installed Modules', 'MODULE_PAYMENT_INSTALLED', 'cod.php;paypal_express.php', 'List of payment module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: cod.php;paypal_express.php)', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Installed Modules', 'MODULE_ORDER_TOTAL_INSTALLED', 'ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_total.php', 'List of order_total module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_total.php)', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Installed Modules', 'MODULE_SHIPPING_INSTALLED', 'flat.php', 'List of shipping module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: ups.php;flat.php;item.php)', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Installed Modules', 'MODULE_ACTION_RECORDER_INSTALLED', 'ar_admin_login.php;ar_contact_us.php;ar_reset_password.php;ar_tell_a_friend.php', 'List of action recorder module filenames separated by a semi-colon. This is automatically updated. No need to edit.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Installed Modules', 'MODULE_SOCIAL_BOOKMARKS_INSTALLED', 'sb_email.php;sb_facebook.php;sb_google_plus_share.php;sb_pinterest.php;sb_twitter.php', 'List of social bookmark module filenames separated by a semi-colon. This is automatically updated. No need to edit.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Cash On Delivery Module', 'MODULE_PAYMENT_COD_STATUS', 'True', 'Do you want to accept Cash On Delevery payments?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Payment Zone', 'MODULE_PAYMENT_COD_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Sort order of display.', 'MODULE_PAYMENT_COD_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('Set Order Status', 'MODULE_PAYMENT_COD_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Flat Shipping', 'MODULE_SHIPPING_FLAT_STATUS', 'True', 'Do you want to offer flat rate shipping?', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Shipping Cost', 'MODULE_SHIPPING_FLAT_COST', '5.00', 'The shipping cost for all orders using this shipping method.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Tax Class', 'MODULE_SHIPPING_FLAT_TAX_CLASS', '0', 'Use the following tax class on the shipping fee.', '6', '0', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Shipping Zone', 'MODULE_SHIPPING_FLAT_ZONE', '0', 'If a zone is selected, only enable this shipping method for that zone.', '6', '0', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Sort Order', 'MODULE_SHIPPING_FLAT_SORT_ORDER', '0', 'Sort order of display.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Default Currency', 'DEFAULT_CURRENCY', 'CZK', 'Default Currency', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Default Language', 'DEFAULT_LANGUAGE', 'cs', 'Default Language', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Default Order Status For New Orders', 'DEFAULT_ORDERS_STATUS_ID', '1', 'When a new order is created, this order status will be assigned to it.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Shipping', 'MODULE_ORDER_TOTAL_SHIPPING_STATUS', 'true', 'Do you want to display the order shipping cost?', '6', '1','tep_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Sort Order', 'MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER', '2', 'Sort order of display.', '6', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Allow Free Shipping', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING', 'false', 'Do you want to allow free shipping?', '6', '3', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, date_added) VALUES ('Free Shipping For Orders Over', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER', '50', 'Provide free shipping for orders over the set amount.', '6', '4', 'currencies->format', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Provide Free Shipping For Orders Made', 'MODULE_ORDER_TOTAL_SHIPPING_DESTINATION', 'national', 'Provide free shipping for orders sent to the set destination.', '6', '5', 'tep_cfg_select_option(array(\'national\', \'international\', \'both\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Sub-Total', 'MODULE_ORDER_TOTAL_SUBTOTAL_STATUS', 'true', 'Do you want to display the order sub-total cost?', '6', '1','tep_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Sort Order', 'MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER', '1', 'Sort order of display.', '6', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Tax', 'MODULE_ORDER_TOTAL_TAX_STATUS', 'true', 'Do you want to display the order tax value?', '6', '1','tep_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Sort Order', 'MODULE_ORDER_TOTAL_TAX_SORT_ORDER', '3', 'Sort order of display.', '6', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Total', 'MODULE_ORDER_TOTAL_TOTAL_STATUS', 'true', 'Do you want to display the total order value?', '6', '1','tep_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Sort Order', 'MODULE_ORDER_TOTAL_TOTAL_SORT_ORDER', '4', 'Sort order of display.', '6', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Minimum Minutes Per E-Mail', 'MODULE_ACTION_RECORDER_CONTACT_US_EMAIL_MINUTES', '15', 'Minimum number of minutes to allow 1 e-mail to be sent (eg, 15 for 1 e-mail every 15 minutes)', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Minimum Minutes Per E-Mail', 'MODULE_ACTION_RECORDER_TELL_A_FRIEND_EMAIL_MINUTES', '15', 'Minimum number of minutes to allow 1 e-mail to be sent (eg, 15 for 1 e-mail every 15 minutes)', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Allowed Minutes', 'MODULE_ACTION_RECORDER_ADMIN_LOGIN_MINUTES', '5', 'Number of minutes to allow login attempts to occur.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Allowed Attempts', 'MODULE_ACTION_RECORDER_ADMIN_LOGIN_ATTEMPTS', '3', 'Number of login attempts to allow within the specified period.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Allowed Minutes', 'MODULE_ACTION_RECORDER_RESET_PASSWORD_MINUTES', '5', 'Number of minutes to allow password resets to occur.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Allowed Attempts', 'MODULE_ACTION_RECORDER_RESET_PASSWORD_ATTEMPTS', '1', 'Number of password reset attempts to allow within the specified period.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable E-Mail Module', 'MODULE_SOCIAL_BOOKMARKS_EMAIL_STATUS', 'True', 'Do you want to allow products to be shared through e-mail?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_SOCIAL_BOOKMARKS_EMAIL_SORT_ORDER', '10', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Google+ Share Module', 'MODULE_SOCIAL_BOOKMARKS_GOOGLE_PLUS_SHARE_STATUS', 'True', 'Do you want to allow products to be shared through Google+?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Annotation', 'MODULE_SOCIAL_BOOKMARKS_GOOGLE_PLUS_SHARE_ANNOTATION', 'None', 'The annotation to display next to the button.', '6', '1', 'tep_cfg_select_option(array(\'Inline\', \'Bubble\', \'Vertical-Bubble\', \'None\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Width', 'MODULE_SOCIAL_BOOKMARKS_GOOGLE_PLUS_SHARE_WIDTH', '', 'The maximum width of the button.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Height', 'MODULE_SOCIAL_BOOKMARKS_GOOGLE_PLUS_SHARE_HEIGHT', '15', 'Sets the height of the button.', '6', '1', 'tep_cfg_select_option(array(\'15\', \'20\', \'24\', \'60\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Alignment', 'MODULE_SOCIAL_BOOKMARKS_GOOGLE_PLUS_SHARE_ALIGN', 'Left', 'The alignment of the button assets.', '6', '1', 'tep_cfg_select_option(array(\'Left\', \'Right\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_SOCIAL_BOOKMARKS_GOOGLE_PLUS_SHARE_SORT_ORDER', '20', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Facebook Module', 'MODULE_SOCIAL_BOOKMARKS_FACEBOOK_STATUS', 'True', 'Do you want to allow products to be shared through Facebook?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_SOCIAL_BOOKMARKS_FACEBOOK_SORT_ORDER', '30', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Twitter Module', 'MODULE_SOCIAL_BOOKMARKS_TWITTER_STATUS', 'True', 'Do you want to allow products to be shared through Twitter?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_SOCIAL_BOOKMARKS_TWITTER_SORT_ORDER', '40', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Pinterest Module', 'MODULE_SOCIAL_BOOKMARKS_PINTEREST_STATUS', 'True', 'Do you want to allow Pinterest Button?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Layout Position', 'MODULE_SOCIAL_BOOKMARKS_PINTEREST_BUTTON_COUNT_POSITION', 'None', 'Horizontal or Vertical or None', '6', '2', 'tep_cfg_select_option(array(\'Horizontal\', \'Vertical\', \'None\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_SOCIAL_BOOKMARKS_PINTEREST_SORT_ORDER', '50', 'Sort order of display. Lowest is displayed first.', '6', '0', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Country of Origin', 'SHIPPING_ORIGIN_COUNTRY', '223', 'Select the country of origin to be used in shipping quotes.', '7', '1', 'tep_get_country_name', 'tep_cfg_pull_down_country_list(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Postal Code', 'SHIPPING_ORIGIN_ZIP', 'NONE', 'Enter the Postal Code (ZIP) of the Store to be used in shipping quotes.', '7', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Enter the Maximum Package Weight you will ship', 'SHIPPING_MAX_WEIGHT', '50', 'Carriers have a max weight limit for a single package. This is a common one for all.', '7', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Package Tare weight.', 'SHIPPING_BOX_WEIGHT', '3', 'What is the weight of typical packaging of small to medium packages?', '7', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Larger packages - percentage increase.', 'SHIPPING_BOX_PADDING', '10', 'For 10% enter 10', '7', '5', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Allow Orders Not Matching Defined Shipping Zones ', 'SHIPPING_ALLOW_UNDEFINED_ZONES', 'False', 'Should orders be allowed to shipping addresses not matching defined shipping module shipping zones?', '7', '5', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Image', 'PRODUCT_LIST_IMAGE', '1', 'Do you want to display the Product Image?', '8', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Manufacturer Name','PRODUCT_LIST_MANUFACTURER', '0', 'Do you want to display the Product Manufacturer Name?', '8', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Model', 'PRODUCT_LIST_MODEL', '0', 'Do you want to display the Product Model?', '8', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Name', 'PRODUCT_LIST_NAME', '2', 'Do you want to display the Product Name?', '8', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Price', 'PRODUCT_LIST_PRICE', '3', 'Do you want to display the Product Price', '8', '5', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Quantity', 'PRODUCT_LIST_QUANTITY', '0', 'Do you want to display the Product Quantity?', '8', '6', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Weight', 'PRODUCT_LIST_WEIGHT', '0', 'Do you want to display the Product Weight?', '8', '7', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Buy Now column', 'PRODUCT_LIST_BUY_NOW', '4', 'Do you want to display the Buy Now column?', '8', '8', now());
#pure:new order by products_date_available
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Date available sort key','PRODUCT_LIST_DATE_AVAILABLE','9', 'Sort by date available',8,9,now());
#pure:new order by products_custom_date
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Custom date sort key','PRODUCT_LIST_CUSTOM_DATE','10', 'Sort by event date',8,10,now());
#pure:new order by products_date_available
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Sort order sort key','PRODUCT_LIST_SORT_ORDER','11', 'Sort by sort order',8,11,now());
#default sort order
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Default sort order', 'PRODUCT_LIST_DEFAULT_SORT_ORDER', 'p.products_date_available DESC, p.products_date_added DESC, pd.products_name', 'Possible values: \"p.products_date_available DESC, p.products_date_added DESC, pd.products_name\" OR \"p.products_custom_date\" OR \"p.sort_order, pd.products_name\"', '8', '12', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Category/Manufacturer Filter (0=disable; 1=enable)', 'PRODUCT_LIST_FILTER', '1', 'Do you want to display the Category/Manufacturer Filter?', '8', '12', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Location of Prev/Next Navigation Bar (1-top, 2-bottom, 3-both)', 'PREV_NEXT_BAR_LOCATION', '2', 'Sets the location of the Prev/Next Navigation Bar (1-top, 2-bottom, 3-both)', '8', '13', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Check stock level', 'STOCK_CHECK', 'true', 'Check to see if sufficent stock is available', '9', '1', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Subtract stock', 'STOCK_LIMITED', 'true', 'Subtract product in stock by product orders', '9', '2', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Allow Checkout', 'STOCK_ALLOW_CHECKOUT', 'true', 'Allow customer to checkout even if there is insufficient stock', '9', '3', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Mark product out of stock', 'STOCK_MARK_PRODUCT_OUT_OF_STOCK', '***', 'Display something on screen so customer can see which product has insufficient stock', '9', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Stock Re-order level', 'STOCK_REORDER_LEVEL', '5', 'Define when stock needs to be re-ordered', '9', '5', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Store Page Parse Time', 'STORE_PAGE_PARSE_TIME', 'false', 'Store the time it takes to parse a page', '10', '1', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Log Destination', 'STORE_PAGE_PARSE_TIME_LOG', '/var/log/www/tep/page_parse_time.log', 'Directory and filename of the page parse time log', '10', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Log Date Format', 'STORE_PARSE_DATE_TIME_FORMAT', '%d/%m/%Y %H:%M:%S', 'The date format', '10', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display The Page Parse Time', 'DISPLAY_PAGE_PARSE_TIME', 'true', 'Display the page parse time (store page parse time must be enabled)', '10', '4', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Store Database Queries', 'STORE_DB_TRANSACTIONS', 'false', 'Store the database queries in the page parse time log', '10', '5', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Use Cache', 'USE_CACHE', 'false', 'Use caching features', '11', '1', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Cache Directory', 'DIR_FS_CACHE', '/tmp/', 'The directory where the cached files are saved', '11', '2', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('E-Mail Transport Method', 'EMAIL_TRANSPORT', 'sendmail', 'Defines if this server uses a local connection to sendmail or uses an SMTP connection via TCP/IP. Servers running on Windows and MacOS should change this setting to SMTP.', '12', '1', 'tep_cfg_select_option(array(\'sendmail\', \'smtp\', \'gmail\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('E-Mail Linefeeds', 'EMAIL_LINEFEED', 'LF', 'Defines the character sequence used to separate mail headers.', '12', '2', 'tep_cfg_select_option(array(\'LF\', \'CRLF\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Use MIME HTML When Sending Emails', 'EMAIL_USE_HTML', 'false', 'Send e-mails in HTML format', '12', '3', 'tep_cfg_select_option(array(\'true\', \'false\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Verify E-Mail Addresses Through DNS', 'ENTRY_EMAIL_ADDRESS_CHECK', 'false', 'Verify e-mail address through a DNS server', '12', '4', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Send E-Mails', 'SEND_EMAILS', 'true', 'Send out e-mails', '12', '5', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now());

# Gergely SMTP configuration
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('SMTP hosts', 'EMAIL_SMTP_HOSTS', '', 'Assign SMTP host senders', '12', '6', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('SMTP authentication', 'EMAIL_SMTP_AUTHENTICATION', 'true', 'Do you want authenticated SMTP server?', '12', '7', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('SMTP Password', 'EMAIL_SMTP_PASSWORD', '', 'Add SMTP Password for SMTP protocol', '12', '8', 'tep_cfg_password', 'tep_cfg_input_password(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('SMTP User', 'EMAIL_SMTP_USER', '', 'Add SMTP user for SMTP protocol', '12', '9', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('SMTP Reply To', 'EMAIL_SMTP_REPLYTO', '', 'Add SMTP reply to address', '12', '10', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable download', 'DOWNLOAD_ENABLED', 'false', 'Enable the products download functions.', '13', '1', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Download by redirect', 'DOWNLOAD_BY_REDIRECT', 'false', 'Use browser redirection for download. Disable on non-Unix systems.', '13', '2', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Expiry delay (days)' ,'DOWNLOAD_MAX_DAYS', '7', 'Set number of days before the download link expires. 0 means no limit.', '13', '3', '', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Maximum number of downloads' ,'DOWNLOAD_MAX_COUNT', '5', 'Set the maximum number of downloads. 0 means no download authorized.', '13', '4', '', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable GZip Compression', 'GZIP_COMPRESSION', 'false', 'Enable HTTP GZip compression.', '14', '1', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Compression Level', 'GZIP_LEVEL', '5', 'Use this compression level 0-9 (0 = minimum, 9 = maximum).', '14', '2', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Session Directory', 'SESSION_WRITE_DIRECTORY', '/tmp', 'If sessions are file based, store them in this directory.', '15', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Force Cookie Use', 'SESSION_FORCE_COOKIE_USE', 'False', 'Force the use of sessions when cookies are only enabled.', '15', '2', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Check SSL Session ID', 'SESSION_CHECK_SSL_SESSION_ID', 'False', 'Validate the SSL_SESSION_ID on every secure HTTPS page request.', '15', '3', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Check User Agent', 'SESSION_CHECK_USER_AGENT', 'False', 'Validate the clients browser user agent on every page request.', '15', '4', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Check IP Address', 'SESSION_CHECK_IP_ADDRESS', 'False', 'Validate the clients IP address on every page request.', '15', '5', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Prevent Spider Sessions', 'SESSION_BLOCK_SPIDERS', 'True', 'Prevent known spiders from starting a session.', '15', '6', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Recreate Session', 'SESSION_RECREATE', 'True', 'Recreate the session to generate a new session ID when the customer logs on or creates an account (PHP >=4.1 needed).', '15', '7', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Last Update Check Time', 'LAST_UPDATE_CHECK_TIME', '', 'Last time a check for new versions of osCommerce was run', '6', '0', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Store Logo', 'STORE_LOGO', 'store_logo.png', 'This is the filename of your Store Logo.  This should be updated at admin > configuration > Store Logo', 6, 1000, now());
#pure: changed page-width to container (max 1142px width)
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Bootstrap Container', 'BOOTSTRAP_CONTAINER', 'container', 'What type of container should the page content be shown in? See http://getbootstrap.com/css/#overview-container', '16', '1', 'tep_cfg_select_option(array(\'container-fluid\', \'container\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Bootstrap Content', 'BOOTSTRAP_CONTENT', '8', 'What width should the page content default to?  (8 = two thirds width, 6 = half width, 4 = one third width) Note that the Side Column(s) will adjust automatically.', '16', '2', 'tep_cfg_select_option(array(\'8\', \'6\', \'4\'), ', now());

INSERT INTO configuration_group VALUES ('1', 'My Store', 'General information about my store', '1', '1');
INSERT INTO configuration_group VALUES ('2', 'Minimum Values', 'The minimum values for functions / data', '2', '1');
INSERT INTO configuration_group VALUES ('3', 'Maximum Values', 'The maximum values for functions / data', '3', '1');
INSERT INTO configuration_group VALUES ('4', 'Images', 'Image parameters', '4', '1');
INSERT INTO configuration_group VALUES ('5', 'Customer Details', 'Customer account configuration', '5', '1');
INSERT INTO configuration_group VALUES ('6', 'Module Options', 'Hidden from configuration', '6', '0');
INSERT INTO configuration_group VALUES ('7', 'Shipping/Packaging', 'Shipping options available at my store', '7', '1');
INSERT INTO configuration_group VALUES ('8', 'Product Listing', 'Product Listing    configuration options', '8', '1');
INSERT INTO configuration_group VALUES ('9', 'Stock', 'Stock configuration options', '9', '1');
INSERT INTO configuration_group VALUES ('10', 'Logging', 'Logging configuration options', '10', '1');
INSERT INTO configuration_group VALUES ('11', 'Cache', 'Caching configuration options', '11', '1');
INSERT INTO configuration_group VALUES ('12', 'E-Mail Options', 'General setting for E-Mail transport and HTML E-Mails', '12', '1');
INSERT INTO configuration_group VALUES ('13', 'Download', 'Downloadable products options', '13', '1');
INSERT INTO configuration_group VALUES ('14', 'GZip Compression', 'GZip compression options', '14', '1');
INSERT INTO configuration_group VALUES ('15', 'Sessions', 'Session options', '15', '1');
INSERT INTO configuration_group VALUES ('16', 'Bootstrap Setup', 'Basic Bootstrap Options', '16', '1');

INSERT INTO countries VALUES (1,'Afghanistan','AF','AFG','1');
INSERT INTO countries VALUES (2,'Albania','AL','ALB','1');
INSERT INTO countries VALUES (3,'Algeria','DZ','DZA','1');
INSERT INTO countries VALUES (4,'American Samoa','AS','ASM','1');
INSERT INTO countries VALUES (5,'Andorra','AD','AND','1');
INSERT INTO countries VALUES (6,'Angola','AO','AGO','1');
INSERT INTO countries VALUES (7,'Anguilla','AI','AIA','1');
INSERT INTO countries VALUES (8,'Antarctica','AQ','ATA','1');
INSERT INTO countries VALUES (9,'Antigua and Barbuda','AG','ATG','1');
INSERT INTO countries VALUES (10,'Argentina','AR','ARG','1');
INSERT INTO countries VALUES (11,'Armenia','AM','ARM','1');
INSERT INTO countries VALUES (12,'Aruba','AW','ABW','1');
INSERT INTO countries VALUES (13,'Australia','AU','AUS','1');
INSERT INTO countries VALUES (14,'Austria','AT','AUT','5');
INSERT INTO countries VALUES (15,'Azerbaijan','AZ','AZE','1');
INSERT INTO countries VALUES (16,'Bahamas','BS','BHS','1');
INSERT INTO countries VALUES (17,'Bahrain','BH','BHR','1');
INSERT INTO countries VALUES (18,'Bangladesh','BD','BGD','1');
INSERT INTO countries VALUES (19,'Barbados','BB','BRB','1');
INSERT INTO countries VALUES (20,'Belarus','BY','BLR','1');
INSERT INTO countries VALUES (21,'Belgium','BE','BEL','1');
INSERT INTO countries VALUES (22,'Belize','BZ','BLZ','1');
INSERT INTO countries VALUES (23,'Benin','BJ','BEN','1');
INSERT INTO countries VALUES (24,'Bermuda','BM','BMU','1');
INSERT INTO countries VALUES (25,'Bhutan','BT','BTN','1');
INSERT INTO countries VALUES (26,'Bolivia','BO','BOL','1');
INSERT INTO countries VALUES (27,'Bosnia and Herzegowina','BA','BIH','1');
INSERT INTO countries VALUES (28,'Botswana','BW','BWA','1');
INSERT INTO countries VALUES (29,'Bouvet Island','BV','BVT','1');
INSERT INTO countries VALUES (30,'Brazil','BR','BRA','1');
INSERT INTO countries VALUES (31,'British Indian Ocean Territory','IO','IOT','1');
INSERT INTO countries VALUES (32,'Brunei Darussalam','BN','BRN','1');
INSERT INTO countries VALUES (33,'Bulgaria','BG','BGR','1');
INSERT INTO countries VALUES (34,'Burkina Faso','BF','BFA','1');
INSERT INTO countries VALUES (35,'Burundi','BI','BDI','1');
INSERT INTO countries VALUES (36,'Cambodia','KH','KHM','1');
INSERT INTO countries VALUES (37,'Cameroon','CM','CMR','1');
INSERT INTO countries VALUES (38,'Canada','CA','CAN','1');
INSERT INTO countries VALUES (39,'Cape Verde','CV','CPV','1');
INSERT INTO countries VALUES (40,'Cayman Islands','KY','CYM','1');
INSERT INTO countries VALUES (41,'Central African Republic','CF','CAF','1');
INSERT INTO countries VALUES (42,'Chad','TD','TCD','1');
INSERT INTO countries VALUES (43,'Chile','CL','CHL','1');
INSERT INTO countries VALUES (44,'China','CN','CHN','1');
INSERT INTO countries VALUES (45,'Christmas Island','CX','CXR','1');
INSERT INTO countries VALUES (46,'Cocos (Keeling) Islands','CC','CCK','1');
INSERT INTO countries VALUES (47,'Colombia','CO','COL','1');
INSERT INTO countries VALUES (48,'Comoros','KM','COM','1');
INSERT INTO countries VALUES (49,'Congo','CG','COG','1');
INSERT INTO countries VALUES (50,'Cook Islands','CK','COK','1');
INSERT INTO countries VALUES (51,'Costa Rica','CR','CRI','1');
INSERT INTO countries VALUES (52,'Cote D\'Ivoire','CI','CIV','1');
INSERT INTO countries VALUES (53,'Croatia','HR','HRV','1');
INSERT INTO countries VALUES (54,'Cuba','CU','CUB','1');
INSERT INTO countries VALUES (55,'Cyprus','CY','CYP','1');
INSERT INTO countries VALUES (56,'Czech Republic','CZ','CZE','1');
INSERT INTO countries VALUES (57,'Denmark','DK','DNK','1');
INSERT INTO countries VALUES (58,'Djibouti','DJ','DJI','1');
INSERT INTO countries VALUES (59,'Dominica','DM','DMA','1');
INSERT INTO countries VALUES (60,'Dominican Republic','DO','DOM','1');
INSERT INTO countries VALUES (61,'East Timor','TP','TMP','1');
INSERT INTO countries VALUES (62,'Ecuador','EC','ECU','1');
INSERT INTO countries VALUES (63,'Egypt','EG','EGY','1');
INSERT INTO countries VALUES (64,'El Salvador','SV','SLV','1');
INSERT INTO countries VALUES (65,'Equatorial Guinea','GQ','GNQ','1');
INSERT INTO countries VALUES (66,'Eritrea','ER','ERI','1');
INSERT INTO countries VALUES (67,'Estonia','EE','EST','1');
INSERT INTO countries VALUES (68,'Ethiopia','ET','ETH','1');
INSERT INTO countries VALUES (69,'Falkland Islands (Malvinas)','FK','FLK','1');
INSERT INTO countries VALUES (70,'Faroe Islands','FO','FRO','1');
INSERT INTO countries VALUES (71,'Fiji','FJ','FJI','1');
INSERT INTO countries VALUES (72,'Finland','FI','FIN','1');
INSERT INTO countries VALUES (73,'France','FR','FRA','1');
INSERT INTO countries VALUES (74,'France, Metropolitan','FX','FXX','1');
INSERT INTO countries VALUES (75,'French Guiana','GF','GUF','1');
INSERT INTO countries VALUES (76,'French Polynesia','PF','PYF','1');
INSERT INTO countries VALUES (77,'French Southern Territories','TF','ATF','1');
INSERT INTO countries VALUES (78,'Gabon','GA','GAB','1');
INSERT INTO countries VALUES (79,'Gambia','GM','GMB','1');
INSERT INTO countries VALUES (80,'Georgia','GE','GEO','1');
INSERT INTO countries VALUES (81,'Germany','DE','DEU','5');
INSERT INTO countries VALUES (82,'Ghana','GH','GHA','1');
INSERT INTO countries VALUES (83,'Gibraltar','GI','GIB','1');
INSERT INTO countries VALUES (84,'Greece','GR','GRC','1');
INSERT INTO countries VALUES (85,'Greenland','GL','GRL','1');
INSERT INTO countries VALUES (86,'Grenada','GD','GRD','1');
INSERT INTO countries VALUES (87,'Guadeloupe','GP','GLP','1');
INSERT INTO countries VALUES (88,'Guam','GU','GUM','1');
INSERT INTO countries VALUES (89,'Guatemala','GT','GTM','1');
INSERT INTO countries VALUES (90,'Guinea','GN','GIN','1');
INSERT INTO countries VALUES (91,'Guinea-bissau','GW','GNB','1');
INSERT INTO countries VALUES (92,'Guyana','GY','GUY','1');
INSERT INTO countries VALUES (93,'Haiti','HT','HTI','1');
INSERT INTO countries VALUES (94,'Heard and Mc Donald Islands','HM','HMD','1');
INSERT INTO countries VALUES (95,'Honduras','HN','HND','1');
INSERT INTO countries VALUES (96,'Hong Kong','HK','HKG','1');
INSERT INTO countries VALUES (97,'Hungary','HU','HUN','1');
INSERT INTO countries VALUES (98,'Iceland','IS','ISL','1');
INSERT INTO countries VALUES (99,'India','IN','IND','1');
INSERT INTO countries VALUES (100,'Indonesia','ID','IDN','1');
INSERT INTO countries VALUES (101,'Iran (Islamic Republic of)','IR','IRN','1');
INSERT INTO countries VALUES (102,'Iraq','IQ','IRQ','1');
INSERT INTO countries VALUES (103,'Ireland','IE','IRL','1');
INSERT INTO countries VALUES (104,'Israel','IL','ISR','1');
INSERT INTO countries VALUES (105,'Italy','IT','ITA','1');
INSERT INTO countries VALUES (106,'Jamaica','JM','JAM','1');
INSERT INTO countries VALUES (107,'Japan','JP','JPN','1');
INSERT INTO countries VALUES (108,'Jordan','JO','JOR','1');
INSERT INTO countries VALUES (109,'Kazakhstan','KZ','KAZ','1');
INSERT INTO countries VALUES (110,'Kenya','KE','KEN','1');
INSERT INTO countries VALUES (111,'Kiribati','KI','KIR','1');
INSERT INTO countries VALUES (112,'Korea, Democratic People\'s Republic of','KP','PRK','1');
INSERT INTO countries VALUES (113,'Korea, Republic of','KR','KOR','1');
INSERT INTO countries VALUES (114,'Kuwait','KW','KWT','1');
INSERT INTO countries VALUES (115,'Kyrgyzstan','KG','KGZ','1');
INSERT INTO countries VALUES (116,'Lao People\'s Democratic Republic','LA','LAO','1');
INSERT INTO countries VALUES (117,'Latvia','LV','LVA','1');
INSERT INTO countries VALUES (118,'Lebanon','LB','LBN','1');
INSERT INTO countries VALUES (119,'Lesotho','LS','LSO','1');
INSERT INTO countries VALUES (120,'Liberia','LR','LBR','1');
INSERT INTO countries VALUES (121,'Libyan Arab Jamahiriya','LY','LBY','1');
INSERT INTO countries VALUES (122,'Liechtenstein','LI','LIE','1');
INSERT INTO countries VALUES (123,'Lithuania','LT','LTU','1');
INSERT INTO countries VALUES (124,'Luxembourg','LU','LUX','1');
INSERT INTO countries VALUES (125,'Macau','MO','MAC','1');
INSERT INTO countries VALUES (126,'Macedonia, The Former Yugoslav Republic of','MK','MKD','1');
INSERT INTO countries VALUES (127,'Madagascar','MG','MDG','1');
INSERT INTO countries VALUES (128,'Malawi','MW','MWI','1');
INSERT INTO countries VALUES (129,'Malaysia','MY','MYS','1');
INSERT INTO countries VALUES (130,'Maldives','MV','MDV','1');
INSERT INTO countries VALUES (131,'Mali','ML','MLI','1');
INSERT INTO countries VALUES (132,'Malta','MT','MLT','1');
INSERT INTO countries VALUES (133,'Marshall Islands','MH','MHL','1');
INSERT INTO countries VALUES (134,'Martinique','MQ','MTQ','1');
INSERT INTO countries VALUES (135,'Mauritania','MR','MRT','1');
INSERT INTO countries VALUES (136,'Mauritius','MU','MUS','1');
INSERT INTO countries VALUES (137,'Mayotte','YT','MYT','1');
INSERT INTO countries VALUES (138,'Mexico','MX','MEX','1');
INSERT INTO countries VALUES (139,'Micronesia, Federated States of','FM','FSM','1');
INSERT INTO countries VALUES (140,'Moldova, Republic of','MD','MDA','1');
INSERT INTO countries VALUES (141,'Monaco','MC','MCO','1');
INSERT INTO countries VALUES (142,'Mongolia','MN','MNG','1');
INSERT INTO countries VALUES (143,'Montserrat','MS','MSR','1');
INSERT INTO countries VALUES (144,'Morocco','MA','MAR','1');
INSERT INTO countries VALUES (145,'Mozambique','MZ','MOZ','1');
INSERT INTO countries VALUES (146,'Myanmar','MM','MMR','1');
INSERT INTO countries VALUES (147,'Namibia','NA','NAM','1');
INSERT INTO countries VALUES (148,'Nauru','NR','NRU','1');
INSERT INTO countries VALUES (149,'Nepal','NP','NPL','1');
INSERT INTO countries VALUES (150,'Netherlands','NL','NLD','1');
INSERT INTO countries VALUES (151,'Netherlands Antilles','AN','ANT','1');
INSERT INTO countries VALUES (152,'New Caledonia','NC','NCL','1');
INSERT INTO countries VALUES (153,'New Zealand','NZ','NZL','1');
INSERT INTO countries VALUES (154,'Nicaragua','NI','NIC','1');
INSERT INTO countries VALUES (155,'Niger','NE','NER','1');
INSERT INTO countries VALUES (156,'Nigeria','NG','NGA','1');
INSERT INTO countries VALUES (157,'Niue','NU','NIU','1');
INSERT INTO countries VALUES (158,'Norfolk Island','NF','NFK','1');
INSERT INTO countries VALUES (159,'Northern Mariana Islands','MP','MNP','1');
INSERT INTO countries VALUES (160,'Norway','NO','NOR','1');
INSERT INTO countries VALUES (161,'Oman','OM','OMN','1');
INSERT INTO countries VALUES (162,'Pakistan','PK','PAK','1');
INSERT INTO countries VALUES (163,'Palau','PW','PLW','1');
INSERT INTO countries VALUES (164,'Panama','PA','PAN','1');
INSERT INTO countries VALUES (165,'Papua New Guinea','PG','PNG','1');
INSERT INTO countries VALUES (166,'Paraguay','PY','PRY','1');
INSERT INTO countries VALUES (167,'Peru','PE','PER','1');
INSERT INTO countries VALUES (168,'Philippines','PH','PHL','1');
INSERT INTO countries VALUES (169,'Pitcairn','PN','PCN','1');
INSERT INTO countries VALUES (170,'Poland','PL','POL','1');
INSERT INTO countries VALUES (171,'Portugal','PT','PRT','1');
INSERT INTO countries VALUES (172,'Puerto Rico','PR','PRI','1');
INSERT INTO countries VALUES (173,'Qatar','QA','QAT','1');
INSERT INTO countries VALUES (174,'Reunion','RE','REU','1');
INSERT INTO countries VALUES (175,'Romania','RO','ROM','1');
INSERT INTO countries VALUES (176,'Russian Federation','RU','RUS','1');
INSERT INTO countries VALUES (177,'Rwanda','RW','RWA','1');
INSERT INTO countries VALUES (178,'Saint Kitts and Nevis','KN','KNA','1');
INSERT INTO countries VALUES (179,'Saint Lucia','LC','LCA','1');
INSERT INTO countries VALUES (180,'Saint Vincent and the Grenadines','VC','VCT','1');
INSERT INTO countries VALUES (181,'Samoa','WS','WSM','1');
INSERT INTO countries VALUES (182,'San Marino','SM','SMR','1');
INSERT INTO countries VALUES (183,'Sao Tome and Principe','ST','STP','1');
INSERT INTO countries VALUES (184,'Saudi Arabia','SA','SAU','1');
INSERT INTO countries VALUES (185,'Senegal','SN','SEN','1');
INSERT INTO countries VALUES (186,'Seychelles','SC','SYC','1');
INSERT INTO countries VALUES (187,'Sierra Leone','SL','SLE','1');
INSERT INTO countries VALUES (188,'Singapore','SG','SGP', '4');
INSERT INTO countries VALUES (189,'Slovakia (Slovak Republic)','SK','SVK','1');
INSERT INTO countries VALUES (190,'Slovenia','SI','SVN','1');
INSERT INTO countries VALUES (191,'Solomon Islands','SB','SLB','1');
INSERT INTO countries VALUES (192,'Somalia','SO','SOM','1');
INSERT INTO countries VALUES (193,'South Africa','ZA','ZAF','1');
INSERT INTO countries VALUES (194,'South Georgia and the South Sandwich Islands','GS','SGS','1');
INSERT INTO countries VALUES (195,'Spain','ES','ESP','3');
INSERT INTO countries VALUES (196,'Sri Lanka','LK','LKA','1');
INSERT INTO countries VALUES (197,'St. Helena','SH','SHN','1');
INSERT INTO countries VALUES (198,'St. Pierre and Miquelon','PM','SPM','1');
INSERT INTO countries VALUES (199,'Sudan','SD','SDN','1');
INSERT INTO countries VALUES (200,'Suriname','SR','SUR','1');
INSERT INTO countries VALUES (201,'Svalbard and Jan Mayen Islands','SJ','SJM','1');
INSERT INTO countries VALUES (202,'Swaziland','SZ','SWZ','1');
INSERT INTO countries VALUES (203,'Sweden','SE','SWE','1');
INSERT INTO countries VALUES (204,'Switzerland','CH','CHE','1');
INSERT INTO countries VALUES (205,'Syrian Arab Republic','SY','SYR','1');
INSERT INTO countries VALUES (206,'Taiwan','TW','TWN','1');
INSERT INTO countries VALUES (207,'Tajikistan','TJ','TJK','1');
INSERT INTO countries VALUES (208,'Tanzania, United Republic of','TZ','TZA','1');
INSERT INTO countries VALUES (209,'Thailand','TH','THA','1');
INSERT INTO countries VALUES (210,'Togo','TG','TGO','1');
INSERT INTO countries VALUES (211,'Tokelau','TK','TKL','1');
INSERT INTO countries VALUES (212,'Tonga','TO','TON','1');
INSERT INTO countries VALUES (213,'Trinidad and Tobago','TT','TTO','1');
INSERT INTO countries VALUES (214,'Tunisia','TN','TUN','1');
INSERT INTO countries VALUES (215,'Turkey','TR','TUR','1');
INSERT INTO countries VALUES (216,'Turkmenistan','TM','TKM','1');
INSERT INTO countries VALUES (217,'Turks and Caicos Islands','TC','TCA','1');
INSERT INTO countries VALUES (218,'Tuvalu','TV','TUV','1');
INSERT INTO countries VALUES (219,'Uganda','UG','UGA','1');
INSERT INTO countries VALUES (220,'Ukraine','UA','UKR','1');
INSERT INTO countries VALUES (221,'United Arab Emirates','AE','ARE','1');
INSERT INTO countries VALUES (222,'United Kingdom','GB','GBR','1');
INSERT INTO countries VALUES (223,'United States','US','USA', '2');
INSERT INTO countries VALUES (224,'United States Minor Outlying Islands','UM','UMI','1');
INSERT INTO countries VALUES (225,'Uruguay','UY','URY','1');
INSERT INTO countries VALUES (226,'Uzbekistan','UZ','UZB','1');
INSERT INTO countries VALUES (227,'Vanuatu','VU','VUT','1');
INSERT INTO countries VALUES (228,'Vatican City State (Holy See)','VA','VAT','1');
INSERT INTO countries VALUES (229,'Venezuela','VE','VEN','1');
INSERT INTO countries VALUES (230,'Viet Nam','VN','VNM','1');
INSERT INTO countries VALUES (231,'Virgin Islands (British)','VG','VGB','1');
INSERT INTO countries VALUES (232,'Virgin Islands (U.S.)','VI','VIR','1');
INSERT INTO countries VALUES (233,'Wallis and Futuna Islands','WF','WLF','1');
INSERT INTO countries VALUES (234,'Western Sahara','EH','ESH','1');
INSERT INTO countries VALUES (235,'Yemen','YE','YEM','1');
INSERT INTO countries VALUES (236,'Yugoslavia','YU','YUG','1');
INSERT INTO countries VALUES (237,'Zaire','ZR','ZAR','1');
INSERT INTO countries VALUES (238,'Zambia','ZM','ZMB','1');
INSERT INTO countries VALUES (239,'Zimbabwe','ZW','ZWE','1');

INSERT INTO currencies VALUES (1,'U.S. Dollar','USD','$','','.',',','2','1.0000', now());
INSERT INTO currencies VALUES (2,'Euro','EUR','','�','.',',','2','1.0000', now());
INSERT INTO currencies VALUES (3,'Česká Koruna','CZK','','Kč',',','.','2','1.0000',now());

INSERT INTO languages VALUES (1,'English','en','icon.gif','english',2);
INSERT INTO languages VALUES (2,'Deutsch','de','icon.gif','german',3);
INSERT INTO languages VALUES (3,'Español','es','icon.gif','espanol',3);
#czech is default
INSERT INTO languages VALUES (4,'Czech','cs','icon.gif','czech',1);
#todo
#initial state
INSERT INTO orders_status VALUES (1,1,'Pending',1,0);
INSERT INTO orders_status VALUES (1,2,'Offen',1,0);
INSERT INTO orders_status VALUES (1,3,'Pendiente',1,0);
INSERT INTO orders_status VALUES (1,4,'Nevyřízená',1,0);

INSERT INTO orders_status VALUES (2,1,'Processing',1,0);
INSERT INTO orders_status VALUES (2,2,'In Bearbeitung',1,0);
INSERT INTO orders_status VALUES (2,3,'Proceso',1,0);
INSERT INTO orders_status VALUES (2,4,'Zpracovává se',1,0);
#canceled id=3
INSERT INTO orders_status VALUES (3,1,'Cancelled',1,0);
INSERT INTO orders_status VALUES (3,2,'Aufgelöst',1,0);
INSERT INTO orders_status VALUES (3,3,'Cancellado',1,0);
INSERT INTO orders_status VALUES (3,4,'Zrušená',1,0);

#bank transfer waiting for payment TODO german, es transate
INSERT INTO orders_status VALUES (4,1,'Waiting for payment',1,0);
INSERT INTO orders_status VALUES (4,2,'Waiting for payment',1,0);
INSERT INTO orders_status VALUES (4,3,'Waiting for payment',1,0);
INSERT INTO orders_status VALUES (4,4,'Čeká na připsání platby',1,0);

#dobirka odesláno TODO languages
INSERT INTO orders_status VALUES (5,1,'Odesláno na dobírku',1,0);
INSERT INTO orders_status VALUES (5,2,'Odesláno na dobírku',1,0);
INSERT INTO orders_status VALUES (5,3,'Odesláno na dobírku',1,0);
INSERT INTO orders_status VALUES (5,4,'Odesláno na dobírku',1,0);

#dobirka vráceno TODO languages
INSERT INTO orders_status VALUES (6,1,'Dobírka vrácena',1,0);
INSERT INTO orders_status VALUES (6,2,'Dobírka vrácena',1,0);
INSERT INTO orders_status VALUES (6,3,'Dobírka vrácena',1,0);
INSERT INTO orders_status VALUES (6,4,'Dobírka vrácena',1,0);

#PayPal Preparing [PayPal IPN] 
INSERT INTO orders_status VALUES (7,1,'Preparing [PayPal IPN]',1,0);
INSERT INTO orders_status VALUES (7,2,'Preparing [PayPal IPN]',1,0);
INSERT INTO orders_status VALUES (7,3,'Preparing [PayPal IPN]',1,0);
INSERT INTO orders_status VALUES (7,4,'Preparing [PayPal IPN]',1,0);

#PayPal Transactions
INSERT INTO orders_status VALUES (8,1,'PayPal [Transactions]',1,0);
INSERT INTO orders_status VALUES (8,2,'PayPal [Transactions]',1,0);
INSERT INTO orders_status VALUES (8,3,'PayPal [Transactions]',1,0);
INSERT INTO orders_status VALUES (8,4,'PayPal [Transactions]',1,0);

#Osobní odběr TODO
INSERT INTO orders_status VALUES (9,1,'No delivery',1,0);
INSERT INTO orders_status VALUES (9,2,'No delivery',1,0);
INSERT INTO orders_status VALUES (9,3,'No delivery',1,0);
INSERT INTO orders_status VALUES (9,4,'Osobní odběr',1,0);
#paid id > 100
INSERT INTO orders_status VALUES (101,1,'Delivered',1,1);
INSERT INTO orders_status VALUES (101,2,'Versendet',1,1);
INSERT INTO orders_status VALUES (101,3,'Entregado',1,1);
INSERT INTO orders_status VALUES (101,4,'Vyřízená',1,1);
#Paid by PayPal
INSERT INTO orders_status VALUES (102,1,'Paid by PayPal',1,1);
INSERT INTO orders_status VALUES (102,2,'Paid by PayPal',1,1);
INSERT INTO orders_status VALUES (102,3,'Paid by PayPal',1,1);
INSERT INTO orders_status VALUES (102,4,'Zaplaceno PayPal',1,1);


INSERT INTO sec_directory_whitelist values (null, 'admin/backups');
INSERT INTO sec_directory_whitelist values (null, 'admin/images/graphs');
INSERT INTO sec_directory_whitelist values (null, 'images');
INSERT INTO sec_directory_whitelist values (null, 'images/banners');
INSERT INTO sec_directory_whitelist values (null, 'includes/work');
INSERT INTO sec_directory_whitelist values (null, 'pub');

#czech vat DPH as EU
INSERT INTO `tax_class` VALUES (1,'VAT (DPH) 15%','cz VAT 15%',now(),now()),(2,'VAT (DPH) 21%','cz VAT 21%',now(),now()),(3,'VAT (DPH) 10%','cz VAT 10%',now(),now());
INSERT INTO `tax_rates` VALUES (1,1,1,1,15.0000,'VAT (DPH) 15%',now(),now()),(2,1,2,2,21.0000,'cz VAT (DPH) 21%',now(),now()), (3,1,3,3,10.0000,'cz VAT (DPH) 10%',now(),now());

INSERT INTO `geo_zones` VALUES (1,'EU','',now(),now());

#INSERT INTO `zones_to_geo_zones` VALUES (1,14,0,1,NULL,'2014-06-12 10:25:07'),(2,21,0,1,NULL,'2014-06-12 10:10:56'),(3,33,0,1,NULL,'2014-06-12 10:11:17'),(4,53,0,1,NULL,'2014-06-12 10:24:16'),(5,55,0,1,NULL,'2014-06-12 10:32:33'),(6,56,0,1,NULL,'2014-04-24 16:41:15'),(7,57,0,1,NULL,'2014-06-12 10:11:46'),(8,67,0,1,NULL,'2014-06-12 10:33:40'),(9,72,0,1,NULL,'2014-06-12 10:22:47'),(10,73,0,1,NULL,'2014-06-12 10:12:09'),(11,81,0,1,NULL,'2014-06-12 10:12:31'),(12,84,0,1,NULL,'2014-06-12 10:18:06'),(13,97,0,1,NULL,'2014-06-12 10:19:11'),(14,103,0,1,NULL,'2014-06-12 10:34:07'),(15,105,0,1,NULL,'2014-06-12 10:18:31'),(16,117,0,1,NULL,'2014-06-12 10:34:52'),(17,123,0,1,NULL,'2014-06-15 00:27:03'),(18,124,0,1,NULL,'2014-06-12 10:35:11'),(19,132,0,1,NULL,'2014-06-12 10:19:41'),(20,150,0,1,NULL,'2014-06-12 10:20:00'),(21,170,0,1,NULL,'2014-06-12 10:12:47'),(22,171,0,1,NULL,'2014-06-12 10:20:31'),(23,175,0,1,NULL,'2014-06-12 10:20:50'),(24,189,0,1,NULL,'2014-06-12 10:21:12'),(25,190,0,1,NULL,'2014-06-12 10:21:34'),(26,195,0,1,NULL,'2014-06-12 10:36:03'),(27,203,0,1,NULL,'2014-06-12 10:36:23'),(28,222,0,1,NULL,'2014-06-12 10:36:47');
 INSERT INTO `zones_to_geo_zones` VALUES (1,14,0,1,NULL,now()),(2,21,0,1,NULL,now()),(3,33,0,1,NULL,now()),(4,53,0,1,NULL,now()),(5,55,0,1,NULL,now()),(6,56,0,1,NULL,now()),(7,57,0,1,NULL,now()),(8,67,0,1,NULL,now()),(9,72,0,1,NULL,now()),(10,73,0,1,NULL,now()),(11,81,0,1,NULL,now()),(12,84,0,1,NULL,now()),(13,97,0,1,NULL,now()),(14,103,0,1,NULL,now()),(15,105,0,1,NULL,now()),(16,117,0,1,NULL,now()),(17,123,0,1,NULL,now()),(18,124,0,1,NULL,now()),(19,132,0,1,NULL,now()),(20,150,0,1,NULL,now()),(21,170,0,1,NULL,now()),(22,171,0,1,NULL,now()),(23,175,0,1,NULL,now()),(24,189,0,1,NULL,now()),(25,190,0,1,NULL,now()),(26,195,0,1,NULL,now()),(27,203,0,1,NULL,now()),(28,222,0,1,NULL,now());

#Adds World Zones - Editted from http://addons.oscommerce.com/info/1792
INSERT INTO zones VALUES (1, 1, 'BDS', 'Badakhshan');
INSERT INTO zones VALUES (2, 1, 'BDG', 'Badghis');
INSERT INTO zones VALUES (3, 1, 'BGL', 'Baghlan');
INSERT INTO zones VALUES (4, 1, 'BAL', 'Balkh');
INSERT INTO zones VALUES (5, 1, 'BAM', 'Bamian');
INSERT INTO zones VALUES (6, 1, 'FRA', 'Farah');
INSERT INTO zones VALUES (7, 1, 'FYB', 'Faryab');
INSERT INTO zones VALUES (8, 1, 'GHA', 'Ghazni');
INSERT INTO zones VALUES (9, 1, 'GHO', 'Ghowr');
INSERT INTO zones VALUES (10, 1, 'HEL', 'Helmand');
INSERT INTO zones VALUES (11, 1, 'HER', 'Herat');
INSERT INTO zones VALUES (12, 1, 'JOW', 'Jowzjan');
INSERT INTO zones VALUES (13, 1, 'KAB', 'Kabul');
INSERT INTO zones VALUES (14, 1, 'KAN', 'Kandahar');
INSERT INTO zones VALUES (15, 1, 'KAP', 'Kapisa');
INSERT INTO zones VALUES (16, 1, 'KHO', 'Khost');
INSERT INTO zones VALUES (17, 1, 'KNR', 'Konar');
INSERT INTO zones VALUES (18, 1, 'KDZ', 'Kondoz');
INSERT INTO zones VALUES (19, 1, 'LAG', 'Laghman');
INSERT INTO zones VALUES (20, 1, 'LOW', 'Lowgar');
INSERT INTO zones VALUES (21, 1, 'NAN', 'Nangrahar');
INSERT INTO zones VALUES (22, 1, 'NIM', 'Nimruz');
INSERT INTO zones VALUES (23, 1, 'NUR', 'Nurestan');
INSERT INTO zones VALUES (24, 1, 'ORU', 'Oruzgan');
INSERT INTO zones VALUES (25, 1, 'PIA', 'Paktia');
INSERT INTO zones VALUES (26, 1, 'PKA', 'Paktika');
INSERT INTO zones VALUES (27, 1, 'PAR', 'Parwan');
INSERT INTO zones VALUES (28, 1, 'SAM', 'Samangan');
INSERT INTO zones VALUES (29, 1, 'SAR', 'Sar-e Pol');
INSERT INTO zones VALUES (30, 1, 'TAK', 'Takhar');
INSERT INTO zones VALUES (31, 1, 'WAR', 'Wardak');
INSERT INTO zones VALUES (32, 1, 'ZAB', 'Zabol');
INSERT INTO zones VALUES (33, 2, 'BR', 'Berat');
INSERT INTO zones VALUES (34, 2, 'BU', 'Bulqize');
INSERT INTO zones VALUES (35, 2, 'DL', 'Delvine');
INSERT INTO zones VALUES (36, 2, 'DV', 'Devoll');
INSERT INTO zones VALUES (37, 2, 'DI', 'Diber');
INSERT INTO zones VALUES (38, 2, 'DR', 'Durres');
INSERT INTO zones VALUES (39, 2, 'EL', 'Elbasan');
INSERT INTO zones VALUES (40, 2, 'ER', 'Kolonje');
INSERT INTO zones VALUES (41, 2, 'FR', 'Fier');
INSERT INTO zones VALUES (42, 2, 'GJ', 'Gjirokaster');
INSERT INTO zones VALUES (43, 2, 'GR', 'Gramsh');
INSERT INTO zones VALUES (44, 2, 'HA', 'Has');
INSERT INTO zones VALUES (45, 2, 'KA', 'Kavaje');
INSERT INTO zones VALUES (46, 2, 'KB', 'Kurbin');
INSERT INTO zones VALUES (47, 2, 'KC', 'Kucove');
INSERT INTO zones VALUES (48, 2, 'KO', 'Korce');
INSERT INTO zones VALUES (49, 2, 'KR', 'Kruje');
INSERT INTO zones VALUES (50, 2, 'KU', 'Kukes');
INSERT INTO zones VALUES (51, 2, 'LB', 'Librazhd');
INSERT INTO zones VALUES (52, 2, 'LE', 'Lezhe');
INSERT INTO zones VALUES (53, 2, 'LU', 'Lushnje');
INSERT INTO zones VALUES (54, 2, 'MM', 'Malesi e Madhe');
INSERT INTO zones VALUES (55, 2, 'MK', 'Mallakaster');
INSERT INTO zones VALUES (56, 2, 'MT', 'Mat');
INSERT INTO zones VALUES (57, 2, 'MR', 'Mirdite');
INSERT INTO zones VALUES (58, 2, 'PQ', 'Peqin');
INSERT INTO zones VALUES (59, 2, 'PR', 'Permet');
INSERT INTO zones VALUES (60, 2, 'PG', 'Pogradec');
INSERT INTO zones VALUES (61, 2, 'PU', 'Puke');
INSERT INTO zones VALUES (62, 2, 'SH', 'Shkoder');
INSERT INTO zones VALUES (63, 2, 'SK', 'Skrapar');
INSERT INTO zones VALUES (64, 2, 'SR', 'Sarande');
INSERT INTO zones VALUES (65, 2, 'TE', 'Tepelene');
INSERT INTO zones VALUES (66, 2, 'TP', 'Tropoje');
INSERT INTO zones VALUES (67, 2, 'TR', 'Tirane');
INSERT INTO zones VALUES (68, 2, 'VL', 'Vlore');
INSERT INTO zones VALUES (69, 3, 'ADR', 'Adrar');
INSERT INTO zones VALUES (70, 3, 'ADE', 'Ain Defla');
INSERT INTO zones VALUES (71, 3, 'ATE', 'Ain Temouchent');
INSERT INTO zones VALUES (72, 3, 'ALG', 'Alger');
INSERT INTO zones VALUES (73, 3, 'ANN', 'Annaba');
INSERT INTO zones VALUES (74, 3, 'BAT', 'Batna');
INSERT INTO zones VALUES (75, 3, 'BEC', 'Bechar');
INSERT INTO zones VALUES (76, 3, 'BEJ', 'Bejaia');
INSERT INTO zones VALUES (77, 3, 'BIS', 'Biskra');
INSERT INTO zones VALUES (78, 3, 'BLI', 'Blida');
INSERT INTO zones VALUES (79, 3, 'BBA', 'Bordj Bou Arreridj');
INSERT INTO zones VALUES (80, 3, 'BOA', 'Bouira');
INSERT INTO zones VALUES (81, 3, 'BMD', 'Boumerdes');
INSERT INTO zones VALUES (82, 3, 'CHL', 'Chlef');
INSERT INTO zones VALUES (83, 3, 'CON', 'Constantine');
INSERT INTO zones VALUES (84, 3, 'DJE', 'Djelfa');
INSERT INTO zones VALUES (85, 3, 'EBA', 'El Bayadh');
INSERT INTO zones VALUES (86, 3, 'EOU', 'El Oued');
INSERT INTO zones VALUES (87, 3, 'ETA', 'El Tarf');
INSERT INTO zones VALUES (88, 3, 'GHA', 'Ghardaia');
INSERT INTO zones VALUES (89, 3, 'GUE', 'Guelma');
INSERT INTO zones VALUES (90, 3, 'ILL', 'Illizi');
INSERT INTO zones VALUES (91, 3, 'JIJ', 'Jijel');
INSERT INTO zones VALUES (92, 3, 'KHE', 'Khenchela');
INSERT INTO zones VALUES (93, 3, 'LAG', 'Laghouat');
INSERT INTO zones VALUES (94, 3, 'MUA', 'Muaskar');
INSERT INTO zones VALUES (95, 3, 'MED', 'Medea');
INSERT INTO zones VALUES (96, 3, 'MIL', 'Mila');
INSERT INTO zones VALUES (97, 3, 'MOS', 'Mostaganem');
INSERT INTO zones VALUES (98, 3, 'MSI', 'M''Sila');
INSERT INTO zones VALUES (99, 3, 'NAA', 'Naama');
INSERT INTO zones VALUES (100, 3, 'ORA', 'Oran');
INSERT INTO zones VALUES (101, 3, 'OUA', 'Ouargla');
INSERT INTO zones VALUES (102, 3, 'OEB', 'Oum el-Bouaghi');
INSERT INTO zones VALUES (103, 3, 'REL', 'Relizane');
INSERT INTO zones VALUES (104, 3, 'SAI', 'Saida');
INSERT INTO zones VALUES (105, 3, 'SET', 'Setif');
INSERT INTO zones VALUES (106, 3, 'SBA', 'Sidi Bel Abbes');
INSERT INTO zones VALUES (107, 3, 'SKI', 'Skikda');
INSERT INTO zones VALUES (108, 3, 'SAH', 'Souk Ahras');
INSERT INTO zones VALUES (109, 3, 'TAM', 'Tamanghasset');
INSERT INTO zones VALUES (110, 3, 'TEB', 'Tebessa');
INSERT INTO zones VALUES (111, 3, 'TIA', 'Tiaret');
INSERT INTO zones VALUES (112, 3, 'TIN', 'Tindouf');
INSERT INTO zones VALUES (113, 3, 'TIP', 'Tipaza');
INSERT INTO zones VALUES (114, 3, 'TIS', 'Tissemsilt');
INSERT INTO zones VALUES (115, 3, 'TOU', 'Tizi Ouzou');
INSERT INTO zones VALUES (116, 3, 'TLE', 'Tlemcen');
INSERT INTO zones VALUES (117, 4, 'E', 'Eastern');
INSERT INTO zones VALUES (118, 4, 'M', 'Manu''a');
INSERT INTO zones VALUES (119, 4, 'R', 'Rose Island');
INSERT INTO zones VALUES (120, 4, 'S', 'Swains Island');
INSERT INTO zones VALUES (121, 4, 'W', 'Western');
INSERT INTO zones VALUES (122, 5, 'ALV', 'Andorra la Vella');
INSERT INTO zones VALUES (123, 5, 'CAN', 'Canillo');
INSERT INTO zones VALUES (124, 5, 'ENC', 'Encamp');
INSERT INTO zones VALUES (125, 5, 'ESE', 'Escaldes-Engordany');
INSERT INTO zones VALUES (126, 5, 'LMA', 'La Massana');
INSERT INTO zones VALUES (127, 5, 'ORD', 'Ordino');
INSERT INTO zones VALUES (128, 5, 'SJL', 'Sant Julià de Lòria');
INSERT INTO zones VALUES (129, 6, 'BGO', 'Bengo');
INSERT INTO zones VALUES (130, 6, 'BGU', 'Benguela');
INSERT INTO zones VALUES (131, 6, 'BIE', 'Bie');
INSERT INTO zones VALUES (132, 6, 'CAB', 'Cabinda');
INSERT INTO zones VALUES (133, 6, 'CCU', 'Cuando-Cubango');
INSERT INTO zones VALUES (134, 6, 'CNO', 'Cuanza Norte');
INSERT INTO zones VALUES (135, 6, 'CUS', 'Cuanza Sul');
INSERT INTO zones VALUES (136, 6, 'CNN', 'Cunene');
INSERT INTO zones VALUES (137, 6, 'HUA', 'Huambo');
INSERT INTO zones VALUES (138, 6, 'HUI', 'Huila');
INSERT INTO zones VALUES (139, 6, 'LUA', 'Luanda');
INSERT INTO zones VALUES (140, 6, 'LNO', 'Lunda Norte');
INSERT INTO zones VALUES (141, 6, 'LSU', 'Lunda Sul');
INSERT INTO zones VALUES (142, 6, 'MAL', 'Malange');
INSERT INTO zones VALUES (143, 6, 'MOX', 'Moxico');
INSERT INTO zones VALUES (144, 6, 'NAM', 'Namibe');
INSERT INTO zones VALUES (145, 6, 'UIG', 'Uige');
INSERT INTO zones VALUES (146, 6, 'ZAI', 'Zaire');
INSERT INTO zones VALUES (147, 7, 'SCR', 'Scrub');
INSERT INTO zones VALUES (148, 7, 'SAN', 'Sandy');
INSERT INTO zones VALUES (149, 7, 'PRI', 'Prickly Pear');
INSERT INTO zones VALUES (150, 7, 'LIT', 'Little Scrub');
INSERT INTO zones VALUES (151, 7, 'DOG', 'Dog');
INSERT INTO zones VALUES (152, 7, 'ANG', 'Anguillita');
INSERT INTO zones VALUES (153, 7, 'ANG', 'Anguila');
INSERT INTO zones VALUES (154, 7, 'SEA', 'Seal');
INSERT INTO zones VALUES (155, 7, 'SOM', 'Sombrero');
INSERT INTO zones VALUES (156, 9, 'ASG', 'Saint George');
INSERT INTO zones VALUES (157, 9, 'ASJ', 'Saint John');
INSERT INTO zones VALUES (158, 9, 'ASM', 'Saint Mary');
INSERT INTO zones VALUES (159, 9, 'ASL', 'Saint Paul');
INSERT INTO zones VALUES (160, 9, 'ASR', 'Saint Peter');
INSERT INTO zones VALUES (161, 9, 'ASH', 'Saint Philip');
INSERT INTO zones VALUES (162, 9, 'BAR', 'Barbuda');
INSERT INTO zones VALUES (163, 9, 'RED', 'Redonda');
INSERT INTO zones VALUES (164, 10, 'AN', 'Antartida e Islas del Atlantico');
INSERT INTO zones VALUES (165, 10, 'BA', 'Buenos Aires');
INSERT INTO zones VALUES (166, 10, 'CA', 'Catamarca');
INSERT INTO zones VALUES (167, 10, 'CH', 'Chaco');
INSERT INTO zones VALUES (168, 10, 'CU', 'Chubut');
INSERT INTO zones VALUES (169, 10, 'CO', 'Cordoba');
INSERT INTO zones VALUES (170, 10, 'CR', 'Corrientes');
INSERT INTO zones VALUES (171, 10, 'CF', 'Capital Federal');
INSERT INTO zones VALUES (172, 10, 'ER', 'Entre Rios');
INSERT INTO zones VALUES (173, 10, 'FO', 'Formosa');
INSERT INTO zones VALUES (174, 10, 'JU', 'Jujuy');
INSERT INTO zones VALUES (175, 10, 'LP', 'La Pampa');
INSERT INTO zones VALUES (176, 10, 'LR', 'La Rioja');
INSERT INTO zones VALUES (177, 10, 'ME', 'Mendoza');
INSERT INTO zones VALUES (178, 10, 'MI', 'Misiones');
INSERT INTO zones VALUES (179, 10, 'NE', 'Neuquen');
INSERT INTO zones VALUES (180, 10, 'RN', 'Rio Negro');
INSERT INTO zones VALUES (181, 10, 'SA', 'Salta');
INSERT INTO zones VALUES (182, 10, 'SJ', 'San Juan');
INSERT INTO zones VALUES (183, 10, 'SL', 'San Luis');
INSERT INTO zones VALUES (184, 10, 'SC', 'Santa Cruz');
INSERT INTO zones VALUES (185, 10, 'SF', 'Santa Fe');
INSERT INTO zones VALUES (186, 10, 'SD', 'Santiago del Estero');
INSERT INTO zones VALUES (187, 10, 'TF', 'Tierra del Fuego');
INSERT INTO zones VALUES (188, 10, 'TU', 'Tucuman');
INSERT INTO zones VALUES (189, 11, 'AGT', 'Aragatsotn');
INSERT INTO zones VALUES (190, 11, 'ARR', 'Ararat');
INSERT INTO zones VALUES (191, 11, 'ARM', 'Armavir');
INSERT INTO zones VALUES (192, 11, 'GEG', 'Geghark''unik''');
INSERT INTO zones VALUES (193, 11, 'KOT', 'Kotayk''');
INSERT INTO zones VALUES (194, 11, 'LOR', 'Lorri');
INSERT INTO zones VALUES (195, 11, 'SHI', 'Shirak');
INSERT INTO zones VALUES (196, 11, 'SYU', 'Syunik''');
INSERT INTO zones VALUES (197, 11, 'TAV', 'Tavush');
INSERT INTO zones VALUES (198, 11, 'VAY', 'Vayots'' Dzor');
INSERT INTO zones VALUES (199, 11, 'YER', 'Yerevan');
INSERT INTO zones VALUES (200, 12, 'ARU', 'Aruba');
INSERT INTO zones VALUES (201, 12, 'ORA', 'Oranjestad');
INSERT INTO zones VALUES (202, 12, 'DRU', 'Druif Beach');
INSERT INTO zones VALUES (203, 12, 'MAN', 'Manchebo Beach');
INSERT INTO zones VALUES (204, 12, 'NOO', 'Noord');
INSERT INTO zones VALUES (205, 12, 'PAL', 'Palm Beach');
INSERT INTO zones VALUES (206, 12, 'ROO', 'Rooi Thomas');
INSERT INTO zones VALUES (207, 12, 'SIN', 'Sint Nicolaas');
INSERT INTO zones VALUES (208, 12, 'SIN', 'Sint Nicolas');
INSERT INTO zones VALUES (209, 12, 'WAY', 'Wayaca');
INSERT INTO zones VALUES (210, 13, 'ACT', 'Australian Capital Territory');
INSERT INTO zones VALUES (211, 13, 'NSW', 'New South Wales');
INSERT INTO zones VALUES (212, 13, 'NT', 'Northern Territory');
INSERT INTO zones VALUES (213, 13, 'QLD', 'Queensland');
INSERT INTO zones VALUES (214, 13, 'SA', 'South Australia');
INSERT INTO zones VALUES (215, 13, 'TAS', 'Tasmania');
INSERT INTO zones VALUES (216, 13, 'VIC', 'Victoria');
INSERT INTO zones VALUES (217, 13, 'WA', 'Western Australia');
INSERT INTO zones VALUES (218, 14, 'BUR', 'Burgenland');
INSERT INTO zones VALUES (219, 14, 'KAR', 'Kärnten');
INSERT INTO zones VALUES (220, 14, 'NOS', 'Niederösterreich');
INSERT INTO zones VALUES (221, 14, 'OOS', 'Oberösterreich');
INSERT INTO zones VALUES (222, 14, 'SAL', 'Salzburg');
INSERT INTO zones VALUES (223, 14, 'STE', 'Steiermark');
INSERT INTO zones VALUES (224, 14, 'TIR', 'Tirol');
INSERT INTO zones VALUES (225, 14, 'VOR', 'Vorarlberg');
INSERT INTO zones VALUES (226, 14, 'WIE', 'Wien');
INSERT INTO zones VALUES (227, 15, 'AB', 'Ali Bayramli');
INSERT INTO zones VALUES (228, 15, 'ABS', 'Abseron');
INSERT INTO zones VALUES (229, 15, 'AGC', 'AgcabAdi');
INSERT INTO zones VALUES (230, 15, 'AGM', 'Agdam');
INSERT INTO zones VALUES (231, 15, 'AGS', 'Agdas');
INSERT INTO zones VALUES (232, 15, 'AGA', 'Agstafa');
INSERT INTO zones VALUES (233, 15, 'AGU', 'Agsu');
INSERT INTO zones VALUES (234, 15, 'AST', 'Astara');
INSERT INTO zones VALUES (235, 15, 'BA', 'Baki');
INSERT INTO zones VALUES (236, 15, 'BAB', 'BabAk');
INSERT INTO zones VALUES (237, 15, 'BAL', 'BalakAn');
INSERT INTO zones VALUES (238, 15, 'BAR', 'BArdA');
INSERT INTO zones VALUES (239, 15, 'BEY', 'Beylaqan');
INSERT INTO zones VALUES (240, 15, 'BIL', 'Bilasuvar');
INSERT INTO zones VALUES (241, 15, 'CAB', 'Cabrayil');
INSERT INTO zones VALUES (242, 15, 'CAL', 'Calilabab');
INSERT INTO zones VALUES (243, 15, 'CUL', 'Culfa');
INSERT INTO zones VALUES (244, 15, 'DAS', 'Daskasan');
INSERT INTO zones VALUES (245, 15, 'DAV', 'Davaci');
INSERT INTO zones VALUES (246, 15, 'FUZ', 'Fuzuli');
INSERT INTO zones VALUES (247, 15, 'GA', 'Ganca');
INSERT INTO zones VALUES (248, 15, 'GAD', 'Gadabay');
INSERT INTO zones VALUES (249, 15, 'GOR', 'Goranboy');
INSERT INTO zones VALUES (250, 15, 'GOY', 'Goycay');
INSERT INTO zones VALUES (251, 15, 'HAC', 'Haciqabul');
INSERT INTO zones VALUES (252, 15, 'IMI', 'Imisli');
INSERT INTO zones VALUES (253, 15, 'ISM', 'Ismayilli');
INSERT INTO zones VALUES (254, 15, 'KAL', 'Kalbacar');
INSERT INTO zones VALUES (255, 15, 'KUR', 'Kurdamir');
INSERT INTO zones VALUES (256, 15, 'LA', 'Lankaran');
INSERT INTO zones VALUES (257, 15, 'LAC', 'Lacin');
INSERT INTO zones VALUES (258, 15, 'LAN', 'Lankaran');
INSERT INTO zones VALUES (259, 15, 'LER', 'Lerik');
INSERT INTO zones VALUES (260, 15, 'MAS', 'Masalli');
INSERT INTO zones VALUES (261, 15, 'MI', 'Mingacevir');
INSERT INTO zones VALUES (262, 15, 'NA', 'Naftalan');
INSERT INTO zones VALUES (263, 15, 'NEF', 'Neftcala');
INSERT INTO zones VALUES (264, 15, 'OGU', 'Oguz');
INSERT INTO zones VALUES (265, 15, 'ORD', 'Ordubad');
INSERT INTO zones VALUES (266, 15, 'QAB', 'Qabala');
INSERT INTO zones VALUES (267, 15, 'QAX', 'Qax');
INSERT INTO zones VALUES (268, 15, 'QAZ', 'Qazax');
INSERT INTO zones VALUES (269, 15, 'QOB', 'Qobustan');
INSERT INTO zones VALUES (270, 15, 'QBA', 'Quba');
INSERT INTO zones VALUES (271, 15, 'QBI', 'Qubadli');
INSERT INTO zones VALUES (272, 15, 'QUS', 'Qusar');
INSERT INTO zones VALUES (273, 15, 'SA', 'Saki');
INSERT INTO zones VALUES (274, 15, 'SAT', 'Saatli');
INSERT INTO zones VALUES (275, 15, 'SAB', 'Sabirabad');
INSERT INTO zones VALUES (276, 15, 'SAD', 'Sadarak');
INSERT INTO zones VALUES (277, 15, 'SAH', 'Sahbuz');
INSERT INTO zones VALUES (278, 15, 'SAK', 'Saki');
INSERT INTO zones VALUES (279, 15, 'SAL', 'Salyan');
INSERT INTO zones VALUES (280, 15, 'SM', 'Sumqayit');
INSERT INTO zones VALUES (281, 15, 'SMI', 'Samaxi');
INSERT INTO zones VALUES (282, 15, 'SKR', 'Samkir');
INSERT INTO zones VALUES (283, 15, 'SMX', 'Samux');
INSERT INTO zones VALUES (284, 15, 'SAR', 'Sarur');
INSERT INTO zones VALUES (285, 15, 'SIY', 'Siyazan');
INSERT INTO zones VALUES (286, 15, 'SS', 'Susa');
INSERT INTO zones VALUES (287, 15, 'SUS', 'Susa');
INSERT INTO zones VALUES (288, 15, 'TAR', 'Tartar');
INSERT INTO zones VALUES (289, 15, 'TOV', 'Tovuz');
INSERT INTO zones VALUES (290, 15, 'UCA', 'Ucar');
INSERT INTO zones VALUES (291, 15, 'XA', 'Xankandi');
INSERT INTO zones VALUES (292, 15, 'XAC', 'Xacmaz');
INSERT INTO zones VALUES (293, 15, 'XAN', 'Xanlar');
INSERT INTO zones VALUES (294, 15, 'XIZ', 'Xizi');
INSERT INTO zones VALUES (295, 15, 'XCI', 'Xocali');
INSERT INTO zones VALUES (296, 15, 'XVD', 'Xocavand');
INSERT INTO zones VALUES (297, 15, 'YAR', 'Yardimli');
INSERT INTO zones VALUES (298, 15, 'YEV', 'Yevlax');
INSERT INTO zones VALUES (299, 15, 'ZAN', 'Zangilan');
INSERT INTO zones VALUES (300, 15, 'ZAQ', 'Zaqatala');
INSERT INTO zones VALUES (301, 15, 'ZAR', 'Zardab');
INSERT INTO zones VALUES (302, 15, 'NX', 'Naxcivan');
INSERT INTO zones VALUES (303, 16, 'ACK', 'Acklins');
INSERT INTO zones VALUES (304, 16, 'BER', 'Berry Islands');
INSERT INTO zones VALUES (305, 16, 'BIM', 'Bimini');
INSERT INTO zones VALUES (306, 16, 'BLK', 'Black Point');
INSERT INTO zones VALUES (307, 16, 'CAT', 'Cat Island');
INSERT INTO zones VALUES (308, 16, 'CAB', 'Central Abaco');
INSERT INTO zones VALUES (309, 16, 'CAN', 'Central Andros');
INSERT INTO zones VALUES (310, 16, 'CEL', 'Central Eleuthera');
INSERT INTO zones VALUES (311, 16, 'FRE', 'City of Freeport');
INSERT INTO zones VALUES (312, 16, 'CRO', 'Crooked Island');
INSERT INTO zones VALUES (313, 16, 'EGB', 'East Grand Bahama');
INSERT INTO zones VALUES (314, 16, 'EXU', 'Exuma');
INSERT INTO zones VALUES (315, 16, 'GRD', 'Grand Cay');
INSERT INTO zones VALUES (316, 16, 'HAR', 'Harbour Island');
INSERT INTO zones VALUES (317, 16, 'HOP', 'Hope Town');
INSERT INTO zones VALUES (318, 16, 'INA', 'Inagua');
INSERT INTO zones VALUES (319, 16, 'LNG', 'Long Island');
INSERT INTO zones VALUES (320, 16, 'MAN', 'Mangrove Cay');
INSERT INTO zones VALUES (321, 16, 'MAY', 'Mayaguana');
INSERT INTO zones VALUES (322, 16, 'MOO', 'Moore''s Island');
INSERT INTO zones VALUES (323, 16, 'NAB', 'North Abaco');
INSERT INTO zones VALUES (324, 16, 'NAN', 'North Andros');
INSERT INTO zones VALUES (325, 16, 'NEL', 'North Eleuthera');
INSERT INTO zones VALUES (326, 16, 'RAG', 'Ragged Island');
INSERT INTO zones VALUES (327, 16, 'RUM', 'Rum Cay');
INSERT INTO zones VALUES (328, 16, 'SAL', 'San Salvador');
INSERT INTO zones VALUES (329, 16, 'SAB', 'South Abaco');
INSERT INTO zones VALUES (330, 16, 'SAN', 'South Andros');
INSERT INTO zones VALUES (331, 16, 'SEL', 'South Eleuthera');
INSERT INTO zones VALUES (332, 16, 'SWE', 'Spanish Wells');
INSERT INTO zones VALUES (333, 16, 'WGB', 'West Grand Bahama');
INSERT INTO zones VALUES (334, 17, 'CAP', 'Capital');
INSERT INTO zones VALUES (335, 17, 'CEN', 'Central');
INSERT INTO zones VALUES (336, 17, 'MUH', 'Muharraq');
INSERT INTO zones VALUES (337, 17, 'NOR', 'Northern');
INSERT INTO zones VALUES (338, 17, 'SOU', 'Southern');
INSERT INTO zones VALUES (339, 18, 'BAR', 'Barisal');
INSERT INTO zones VALUES (340, 18, 'CHI', 'Chittagong');
INSERT INTO zones VALUES (341, 18, 'DHA', 'Dhaka');
INSERT INTO zones VALUES (342, 18, 'KHU', 'Khulna');
INSERT INTO zones VALUES (343, 18, 'RAJ', 'Rajshahi');
INSERT INTO zones VALUES (344, 18, 'SYL', 'Sylhet');
INSERT INTO zones VALUES (345, 19, 'CC', 'Christ Church');
INSERT INTO zones VALUES (346, 19, 'AND', 'Saint Andrew');
INSERT INTO zones VALUES (347, 19, 'GEO', 'Saint George');
INSERT INTO zones VALUES (348, 19, 'JAM', 'Saint James');
INSERT INTO zones VALUES (349, 19, 'JOH', 'Saint John');
INSERT INTO zones VALUES (350, 19, 'JOS', 'Saint Joseph');
INSERT INTO zones VALUES (351, 19, 'LUC', 'Saint Lucy');
INSERT INTO zones VALUES (352, 19, 'MIC', 'Saint Michael');
INSERT INTO zones VALUES (353, 19, 'PET', 'Saint Peter');
INSERT INTO zones VALUES (354, 19, 'PHI', 'Saint Philip');
INSERT INTO zones VALUES (355, 19, 'THO', 'Saint Thomas');
INSERT INTO zones VALUES (356, 20, 'BR', 'Brestskaya (Brest)');
INSERT INTO zones VALUES (357, 20, 'HO', 'Homyel''skaya (Homyel'')');
INSERT INTO zones VALUES (358, 20, 'HM', 'Horad Minsk');
INSERT INTO zones VALUES (359, 20, 'HR', 'Hrodzyenskaya (Hrodna)');
INSERT INTO zones VALUES (360, 20, 'MA', 'Mahilyowskaya (Mahilyow)');
INSERT INTO zones VALUES (361, 20, 'MI', 'Minskaya');
INSERT INTO zones VALUES (362, 20, 'VI', 'Vitsyebskaya (Vitsyebsk)');
INSERT INTO zones VALUES (363, 21, 'VAN', 'Antwerpen');
INSERT INTO zones VALUES (364, 21, 'WBR', 'Brabant Wallon');
INSERT INTO zones VALUES (365, 21, 'WHT', 'Hainaut');
INSERT INTO zones VALUES (366, 21, 'WLG', 'Liege');
INSERT INTO zones VALUES (367, 21, 'VLI', 'Limburg');
INSERT INTO zones VALUES (368, 21, 'WLX', 'Luxembourg');
INSERT INTO zones VALUES (369, 21, 'WNA', 'Namur');
INSERT INTO zones VALUES (370, 21, 'VOV', 'Oost-Vlaanderen');
INSERT INTO zones VALUES (371, 21, 'VBR', 'Vlaams Brabant');
INSERT INTO zones VALUES (372, 21, 'VWV', 'West-Vlaanderen');
INSERT INTO zones VALUES (373, 22, 'BZ', 'Belize');
INSERT INTO zones VALUES (374, 22, 'CY', 'Cayo');
INSERT INTO zones VALUES (375, 22, 'CR', 'Corozal');
INSERT INTO zones VALUES (376, 22, 'OW', 'Orange Walk');
INSERT INTO zones VALUES (377, 22, 'SC', 'Stann Creek');
INSERT INTO zones VALUES (378, 22, 'TO', 'Toledo');
INSERT INTO zones VALUES (379, 23, 'AL', 'Alibori');
INSERT INTO zones VALUES (380, 23, 'AK', 'Atakora');
INSERT INTO zones VALUES (381, 23, 'AQ', 'Atlantique');
INSERT INTO zones VALUES (382, 23, 'BO', 'Borgou');
INSERT INTO zones VALUES (383, 23, 'CO', 'Collines');
INSERT INTO zones VALUES (384, 23, 'DO', 'Donga');
INSERT INTO zones VALUES (385, 23, 'KO', 'Kouffo');
INSERT INTO zones VALUES (386, 23, 'LI', 'Littoral');
INSERT INTO zones VALUES (387, 23, 'MO', 'Mono');
INSERT INTO zones VALUES (388, 23, 'OU', 'Oueme');
INSERT INTO zones VALUES (389, 23, 'PL', 'Plateau');
INSERT INTO zones VALUES (390, 23, 'ZO', 'Zou');
INSERT INTO zones VALUES (391, 24, 'DS', 'Devonshire');
INSERT INTO zones VALUES (392, 24, 'HC', 'Hamilton City');
INSERT INTO zones VALUES (393, 24, 'HA', 'Hamilton');
INSERT INTO zones VALUES (394, 24, 'PG', 'Paget');
INSERT INTO zones VALUES (395, 24, 'PB', 'Pembroke');
INSERT INTO zones VALUES (396, 24, 'GC', 'Saint George City');
INSERT INTO zones VALUES (397, 24, 'SG', 'Saint George''s');
INSERT INTO zones VALUES (398, 24, 'SA', 'Sandys');
INSERT INTO zones VALUES (399, 24, 'SM', 'Smith''s');
INSERT INTO zones VALUES (400, 24, 'SH', 'Southampton');
INSERT INTO zones VALUES (401, 24, 'WA', 'Warwick');
INSERT INTO zones VALUES (402, 25, 'BUM', 'Bumthang');
INSERT INTO zones VALUES (403, 25, 'CHU', 'Chukha');
INSERT INTO zones VALUES (404, 25, 'DAG', 'Dagana');
INSERT INTO zones VALUES (405, 25, 'GAS', 'Gasa');
INSERT INTO zones VALUES (406, 25, 'HAA', 'Haa');
INSERT INTO zones VALUES (407, 25, 'LHU', 'Lhuntse');
INSERT INTO zones VALUES (408, 25, 'MON', 'Mongar');
INSERT INTO zones VALUES (409, 25, 'PAR', 'Paro');
INSERT INTO zones VALUES (410, 25, 'PEM', 'Pemagatshel');
INSERT INTO zones VALUES (411, 25, 'PUN', 'Punakha');
INSERT INTO zones VALUES (412, 25, 'SJO', 'Samdrup Jongkhar');
INSERT INTO zones VALUES (413, 25, 'SAT', 'Samtse');
INSERT INTO zones VALUES (414, 25, 'SAR', 'Sarpang');
INSERT INTO zones VALUES (415, 25, 'THI', 'Thimphu');
INSERT INTO zones VALUES (416, 25, 'TRG', 'Trashigang');
INSERT INTO zones VALUES (417, 25, 'TRY', 'Trashiyangste');
INSERT INTO zones VALUES (418, 25, 'TRO', 'Trongsa');
INSERT INTO zones VALUES (419, 25, 'TSI', 'Tsirang');
INSERT INTO zones VALUES (420, 25, 'WPH', 'Wangdue Phodrang');
INSERT INTO zones VALUES (421, 25, 'ZHE', 'Zhemgang');
INSERT INTO zones VALUES (422, 26, 'BEN', 'Beni');
INSERT INTO zones VALUES (423, 26, 'CHU', 'Chuquisaca');
INSERT INTO zones VALUES (424, 26, 'COC', 'Cochabamba');
INSERT INTO zones VALUES (425, 26, 'LPZ', 'La Paz');
INSERT INTO zones VALUES (426, 26, 'ORU', 'Oruro');
INSERT INTO zones VALUES (427, 26, 'PAN', 'Pando');
INSERT INTO zones VALUES (428, 26, 'POT', 'Potosi');
INSERT INTO zones VALUES (429, 26, 'SCZ', 'Santa Cruz');
INSERT INTO zones VALUES (430, 26, 'TAR', 'Tarija');
INSERT INTO zones VALUES (431, 27, 'BRO', 'Brcko district');
INSERT INTO zones VALUES (432, 27, 'FUS', 'Unsko-Sanski Kanton');
INSERT INTO zones VALUES (433, 27, 'FPO', 'Posavski Kanton');
INSERT INTO zones VALUES (434, 27, 'FTU', 'Tuzlanski Kanton');
INSERT INTO zones VALUES (435, 27, 'FZE', 'Zenicko-Dobojski Kanton');
INSERT INTO zones VALUES (436, 27, 'FBP', 'Bosanskopodrinjski Kanton');
INSERT INTO zones VALUES (437, 27, 'FSB', 'Srednjebosanski Kanton');
INSERT INTO zones VALUES (438, 27, 'FHN', 'Hercegovacko-neretvanski Kanton');
INSERT INTO zones VALUES (439, 27, 'FZH', 'Zapadnohercegovacka Zupanija');
INSERT INTO zones VALUES (440, 27, 'FSA', 'Kanton Sarajevo');
INSERT INTO zones VALUES (441, 27, 'FZA', 'Zapadnobosanska');
INSERT INTO zones VALUES (442, 27, 'SBL', 'Banja Luka');
INSERT INTO zones VALUES (443, 27, 'SDO', 'Doboj');
INSERT INTO zones VALUES (444, 27, 'SBI', 'Bijeljina');
INSERT INTO zones VALUES (445, 27, 'SVL', 'Vlasenica');
INSERT INTO zones VALUES (446, 27, 'SSR', 'Sarajevo-Romanija or Sokolac');
INSERT INTO zones VALUES (447, 27, 'SFO', 'Foca');
INSERT INTO zones VALUES (448, 27, 'STR', 'Trebinje');
INSERT INTO zones VALUES (449, 28, 'CE', 'Central');
INSERT INTO zones VALUES (450, 28, 'GH', 'Ghanzi');
INSERT INTO zones VALUES (451, 28, 'KD', 'Kgalagadi');
INSERT INTO zones VALUES (452, 28, 'KT', 'Kgatleng');
INSERT INTO zones VALUES (453, 28, 'KW', 'Kweneng');
INSERT INTO zones VALUES (454, 28, 'NG', 'Ngamiland');
INSERT INTO zones VALUES (455, 28, 'NE', 'North East');
INSERT INTO zones VALUES (456, 28, 'NW', 'North West');
INSERT INTO zones VALUES (457, 28, 'SE', 'South East');
INSERT INTO zones VALUES (458, 28, 'SO', 'Southern');
INSERT INTO zones VALUES (459, 30, 'AC', 'Acre');
INSERT INTO zones VALUES (460, 30, 'AL', 'Alagoas');
INSERT INTO zones VALUES (461, 30, 'AP', 'Amapa');
INSERT INTO zones VALUES (462, 30, 'AM', 'Amazonas');
INSERT INTO zones VALUES (463, 30, 'BA', 'Bahia');
INSERT INTO zones VALUES (464, 30, 'CE', 'Ceara');
INSERT INTO zones VALUES (465, 30, 'DF', 'Distrito Federal');
INSERT INTO zones VALUES (466, 30, 'ES', 'Espirito Santo');
INSERT INTO zones VALUES (467, 30, 'GO', 'Goias');
INSERT INTO zones VALUES (468, 30, 'MA', 'Maranhao');
INSERT INTO zones VALUES (469, 30, 'MT', 'Mato Grosso');
INSERT INTO zones VALUES (470, 30, 'MS', 'Mato Grosso do Sul');
INSERT INTO zones VALUES (471, 30, 'MG', 'Minas Gerais');
INSERT INTO zones VALUES (472, 30, 'PA', 'Para');
INSERT INTO zones VALUES (473, 30, 'PB', 'Paraiba');
INSERT INTO zones VALUES (474, 30, 'PR', 'Parana');
INSERT INTO zones VALUES (475, 30, 'PE', 'Pernambuco');
INSERT INTO zones VALUES (476, 30, 'PI', 'Piaui');
INSERT INTO zones VALUES (477, 30, 'RJ', 'Rio de Janeiro');
INSERT INTO zones VALUES (478, 30, 'RN', 'Rio Grande do Norte');
INSERT INTO zones VALUES (479, 30, 'RS', 'Rio Grande do Sul');
INSERT INTO zones VALUES (480, 30, 'RO', 'Rondonia');
INSERT INTO zones VALUES (481, 30, 'RR', 'Roraima');
INSERT INTO zones VALUES (482, 30, 'SC', 'Santa Catarina');
INSERT INTO zones VALUES (483, 30, 'SP', 'Sao Paulo');
INSERT INTO zones VALUES (484, 30, 'SE', 'Sergipe');
INSERT INTO zones VALUES (485, 30, 'TO', 'Tocantins');
INSERT INTO zones VALUES (486, 31, 'PB', 'Peros Banhos');
INSERT INTO zones VALUES (487, 31, 'SI', 'Salomon Islands');
INSERT INTO zones VALUES (488, 31, 'NI', 'Nelsons Island');
INSERT INTO zones VALUES (489, 31, 'TB', 'Three Brothers');
INSERT INTO zones VALUES (490, 31, 'EA', 'Eagle Islands');
INSERT INTO zones VALUES (491, 31, 'DI', 'Danger Island');
INSERT INTO zones VALUES (492, 31, 'EG', 'Egmont Islands');
INSERT INTO zones VALUES (493, 31, 'DG', 'Diego Garcia');
INSERT INTO zones VALUES (494, 32, 'BEL', 'Belait');
INSERT INTO zones VALUES (495, 32, 'BRM', 'Brunei and Muara');
INSERT INTO zones VALUES (496, 32, 'TEM', 'Temburong');
INSERT INTO zones VALUES (497, 32, 'TUT', 'Tutong');
INSERT INTO zones VALUES (498, 33, '', 'Blagoevgrad');
INSERT INTO zones VALUES (499, 33, '', 'Burgas');
INSERT INTO zones VALUES (500, 33, '', 'Dobrich');
INSERT INTO zones VALUES (501, 33, '', 'Gabrovo');
INSERT INTO zones VALUES (502, 33, '', 'Haskovo');
INSERT INTO zones VALUES (503, 33, '', 'Kardjali');
INSERT INTO zones VALUES (504, 33, '', 'Kyustendil');
INSERT INTO zones VALUES (505, 33, '', 'Lovech');
INSERT INTO zones VALUES (506, 33, '', 'Montana');
INSERT INTO zones VALUES (507, 33, '', 'Pazardjik');
INSERT INTO zones VALUES (508, 33, '', 'Pernik');
INSERT INTO zones VALUES (509, 33, '', 'Pleven');
INSERT INTO zones VALUES (510, 33, '', 'Plovdiv');
INSERT INTO zones VALUES (511, 33, '', 'Razgrad');
INSERT INTO zones VALUES (512, 33, '', 'Shumen');
INSERT INTO zones VALUES (513, 33, '', 'Silistra');
INSERT INTO zones VALUES (514, 33, '', 'Sliven');
INSERT INTO zones VALUES (515, 33, '', 'Smolyan');
INSERT INTO zones VALUES (516, 33, '', 'Sofia');
INSERT INTO zones VALUES (517, 33, '', 'Sofia - town');
INSERT INTO zones VALUES (518, 33, '', 'Stara Zagora');
INSERT INTO zones VALUES (519, 33, '', 'Targovishte');
INSERT INTO zones VALUES (520, 33, '', 'Varna');
INSERT INTO zones VALUES (521, 33, '', 'Veliko Tarnovo');
INSERT INTO zones VALUES (522, 33, '', 'Vidin');
INSERT INTO zones VALUES (523, 33, '', 'Vratza');
INSERT INTO zones VALUES (524, 33, '', 'Yambol');
INSERT INTO zones VALUES (525, 34, 'BAL', 'Bale');
INSERT INTO zones VALUES (526, 34, 'BAM', 'Bam');
INSERT INTO zones VALUES (527, 34, 'BAN', 'Banwa');
INSERT INTO zones VALUES (528, 34, 'BAZ', 'Bazega');
INSERT INTO zones VALUES (529, 34, 'BOR', 'Bougouriba');
INSERT INTO zones VALUES (530, 34, 'BLG', 'Boulgou');
INSERT INTO zones VALUES (531, 34, 'BOK', 'Boulkiemde');
INSERT INTO zones VALUES (532, 34, 'COM', 'Comoe');
INSERT INTO zones VALUES (533, 34, 'GAN', 'Ganzourgou');
INSERT INTO zones VALUES (534, 34, 'GNA', 'Gnagna');
INSERT INTO zones VALUES (535, 34, 'GOU', 'Gourma');
INSERT INTO zones VALUES (536, 34, 'HOU', 'Houet');
INSERT INTO zones VALUES (537, 34, 'IOA', 'Ioba');
INSERT INTO zones VALUES (538, 34, 'KAD', 'Kadiogo');
INSERT INTO zones VALUES (539, 34, 'KEN', 'Kenedougou');
INSERT INTO zones VALUES (540, 34, 'KOD', 'Komondjari');
INSERT INTO zones VALUES (541, 34, 'KOP', 'Kompienga');
INSERT INTO zones VALUES (542, 34, 'KOS', 'Kossi');
INSERT INTO zones VALUES (543, 34, 'KOL', 'Koulpelogo');
INSERT INTO zones VALUES (544, 34, 'KOT', 'Kouritenga');
INSERT INTO zones VALUES (545, 34, 'KOW', 'Kourweogo');
INSERT INTO zones VALUES (546, 34, 'LER', 'Leraba');
INSERT INTO zones VALUES (547, 34, 'LOR', 'Loroum');
INSERT INTO zones VALUES (548, 34, 'MOU', 'Mouhoun');
INSERT INTO zones VALUES (549, 34, 'NAH', 'Nahouri');
INSERT INTO zones VALUES (550, 34, 'NAM', 'Namentenga');
INSERT INTO zones VALUES (551, 34, 'NAY', 'Nayala');
INSERT INTO zones VALUES (552, 34, 'NOU', 'Noumbiel');
INSERT INTO zones VALUES (553, 34, 'OUB', 'Oubritenga');
INSERT INTO zones VALUES (554, 34, 'OUD', 'Oudalan');
INSERT INTO zones VALUES (555, 34, 'PAS', 'Passore');
INSERT INTO zones VALUES (556, 34, 'PON', 'Poni');
INSERT INTO zones VALUES (557, 34, 'SAG', 'Sanguie');
INSERT INTO zones VALUES (558, 34, 'SAM', 'Sanmatenga');
INSERT INTO zones VALUES (559, 34, 'SEN', 'Seno');
INSERT INTO zones VALUES (560, 34, 'SIS', 'Sissili');
INSERT INTO zones VALUES (561, 34, 'SOM', 'Soum');
INSERT INTO zones VALUES (562, 34, 'SOR', 'Sourou');
INSERT INTO zones VALUES (563, 34, 'TAP', 'Tapoa');
INSERT INTO zones VALUES (564, 34, 'TUY', 'Tuy');
INSERT INTO zones VALUES (565, 34, 'YAG', 'Yagha');
INSERT INTO zones VALUES (566, 34, 'YAT', 'Yatenga');
INSERT INTO zones VALUES (567, 34, 'ZIR', 'Ziro');
INSERT INTO zones VALUES (568, 34, 'ZOD', 'Zondoma');
INSERT INTO zones VALUES (569, 34, 'ZOW', 'Zoundweogo');
INSERT INTO zones VALUES (570, 35, 'BB', 'Bubanza');
INSERT INTO zones VALUES (571, 35, 'BJ', 'Bujumbura');
INSERT INTO zones VALUES (572, 35, 'BR', 'Bururi');
INSERT INTO zones VALUES (573, 35, 'CA', 'Cankuzo');
INSERT INTO zones VALUES (574, 35, 'CI', 'Cibitoke');
INSERT INTO zones VALUES (575, 35, 'GI', 'Gitega');
INSERT INTO zones VALUES (576, 35, 'KR', 'Karuzi');
INSERT INTO zones VALUES (577, 35, 'KY', 'Kayanza');
INSERT INTO zones VALUES (578, 35, 'KI', 'Kirundo');
INSERT INTO zones VALUES (579, 35, 'MA', 'Makamba');
INSERT INTO zones VALUES (580, 35, 'MU', 'Muramvya');
INSERT INTO zones VALUES (581, 35, 'MY', 'Muyinga');
INSERT INTO zones VALUES (582, 35, 'MW', 'Mwaro');
INSERT INTO zones VALUES (583, 35, 'NG', 'Ngozi');
INSERT INTO zones VALUES (584, 35, 'RT', 'Rutana');
INSERT INTO zones VALUES (585, 35, 'RY', 'Ruyigi');
INSERT INTO zones VALUES (586, 36, 'PP', 'Phnom Penh');
INSERT INTO zones VALUES (587, 36, 'PS', 'Preah Seihanu (Kompong Som or Si');
INSERT INTO zones VALUES (588, 36, 'PA', 'Pailin');
INSERT INTO zones VALUES (589, 36, 'KB', 'Keb');
INSERT INTO zones VALUES (590, 36, 'BM', 'Banteay Meanchey');
INSERT INTO zones VALUES (591, 36, 'BA', 'Battambang');
INSERT INTO zones VALUES (592, 36, 'KM', 'Kampong Cham');
INSERT INTO zones VALUES (593, 36, 'KN', 'Kampong Chhnang');
INSERT INTO zones VALUES (594, 36, 'KU', 'Kampong Speu');
INSERT INTO zones VALUES (595, 36, 'KO', 'Kampong Som');
INSERT INTO zones VALUES (596, 36, 'KT', 'Kampong Thom');
INSERT INTO zones VALUES (597, 36, 'KP', 'Kampot');
INSERT INTO zones VALUES (598, 36, 'KL', 'Kandal');
INSERT INTO zones VALUES (599, 36, 'KK', 'Kaoh Kong');
INSERT INTO zones VALUES (600, 36, 'KR', 'Kratie');
INSERT INTO zones VALUES (601, 36, 'MK', 'Mondul Kiri');
INSERT INTO zones VALUES (602, 36, 'OM', 'Oddar Meancheay');
INSERT INTO zones VALUES (603, 36, 'PU', 'Pursat');
INSERT INTO zones VALUES (604, 36, 'PR', 'Preah Vihear');
INSERT INTO zones VALUES (605, 36, 'PG', 'Prey Veng');
INSERT INTO zones VALUES (606, 36, 'RK', 'Ratanak Kiri');
INSERT INTO zones VALUES (607, 36, 'SI', 'Siemreap');
INSERT INTO zones VALUES (608, 36, 'ST', 'Stung Treng');
INSERT INTO zones VALUES (609, 36, 'SR', 'Svay Rieng');
INSERT INTO zones VALUES (610, 36, 'TK', 'Takeo');
INSERT INTO zones VALUES (611, 37, 'ADA', 'Adamawa (Adamaoua)');
INSERT INTO zones VALUES (612, 37, 'CEN', 'Centre');
INSERT INTO zones VALUES (613, 37, 'EST', 'East (Est)');
INSERT INTO zones VALUES (614, 37, 'EXN', 'Extrême-Nord');
INSERT INTO zones VALUES (615, 37, 'LIT', 'Littoral');
INSERT INTO zones VALUES (616, 37, 'NOR', 'North (Nord)');
INSERT INTO zones VALUES (617, 37, 'NOT', 'Northwest (Nord-Ouest)');
INSERT INTO zones VALUES (618, 37, 'OUE', 'West (Ouest)');
INSERT INTO zones VALUES (619, 37, 'SUD', 'South (Sud)');
INSERT INTO zones VALUES (620, 37, 'SOU', 'Southwest (Sud-Ouest).');
INSERT INTO zones VALUES (621, 38, 'AB', 'Alberta');
INSERT INTO zones VALUES (622, 38, 'BC', 'British Columbia');
INSERT INTO zones VALUES (623, 38, 'MB', 'Manitoba');
INSERT INTO zones VALUES (624, 38, 'NB', 'New Brunswick');
INSERT INTO zones VALUES (625, 38, 'NL', 'Newfoundland and Labrador');
INSERT INTO zones VALUES (626, 38, 'NT', 'Northwest Territories');
INSERT INTO zones VALUES (627, 38, 'NS', 'Nova Scotia');
INSERT INTO zones VALUES (628, 38, 'NU', 'Nunavut');
INSERT INTO zones VALUES (629, 38, 'ON', 'Ontario');
INSERT INTO zones VALUES (630, 38, 'PE', 'Prince Edward Island');
INSERT INTO zones VALUES (631, 38, 'QC', 'Qu&eacute;bec');
INSERT INTO zones VALUES (632, 38, 'SK', 'Saskatchewan');
INSERT INTO zones VALUES (633, 38, 'YT', 'Yukon Territory');
INSERT INTO zones VALUES (634, 39, 'BV', 'Boa Vista');
INSERT INTO zones VALUES (635, 39, 'BR', 'Brava');
INSERT INTO zones VALUES (636, 39, 'CS', 'Calheta de Sao Miguel');
INSERT INTO zones VALUES (637, 39, 'MA', 'Maio');
INSERT INTO zones VALUES (638, 39, 'MO', 'Mosteiros');
INSERT INTO zones VALUES (639, 39, 'PA', 'Paul');
INSERT INTO zones VALUES (640, 39, 'PN', 'Porto Novo');
INSERT INTO zones VALUES (641, 39, 'PR', 'Praia');
INSERT INTO zones VALUES (642, 39, 'RG', 'Ribeira Grande');
INSERT INTO zones VALUES (643, 39, 'SL', 'Sal');
INSERT INTO zones VALUES (644, 39, 'CA', 'Santa Catarina');
INSERT INTO zones VALUES (645, 39, 'CR', 'Santa Cruz');
INSERT INTO zones VALUES (646, 39, 'SD', 'Sao Domingos');
INSERT INTO zones VALUES (647, 39, 'SF', 'Sao Filipe');
INSERT INTO zones VALUES (648, 39, 'SN', 'Sao Nicolau');
INSERT INTO zones VALUES (649, 39, 'SV', 'Sao Vicente');
INSERT INTO zones VALUES (650, 39, 'TA', 'Tarrafal');
INSERT INTO zones VALUES (651, 40, 'CR', 'Creek');
INSERT INTO zones VALUES (652, 40, 'EA', 'Eastern');
INSERT INTO zones VALUES (653, 40, 'ML', 'Midland');
INSERT INTO zones VALUES (654, 40, 'ST', 'South Town');
INSERT INTO zones VALUES (655, 40, 'SP', 'Spot Bay');
INSERT INTO zones VALUES (656, 40, 'SK', 'Stake Bay');
INSERT INTO zones VALUES (657, 40, 'WD', 'West End');
INSERT INTO zones VALUES (658, 40, 'WN', 'Western');
INSERT INTO zones VALUES (659, 41, 'BBA', 'Bamingui-Bangoran');
INSERT INTO zones VALUES (660, 41, 'BKO', 'Basse-Kotto');
INSERT INTO zones VALUES (661, 41, 'HKO', 'Haute-Kotto');
INSERT INTO zones VALUES (662, 41, 'HMB', 'Haut-Mbomou');
INSERT INTO zones VALUES (663, 41, 'KEM', 'Kemo');
INSERT INTO zones VALUES (664, 41, 'LOB', 'Lobaye');
INSERT INTO zones VALUES (665, 41, 'MKD', 'Mambéré-Kadéï');
INSERT INTO zones VALUES (666, 41, 'MBO', 'Mbomou');
INSERT INTO zones VALUES (667, 41, 'NMM', 'Nana-Mambere');
INSERT INTO zones VALUES (668, 41, 'OMP', 'Ombella-M''Poko');
INSERT INTO zones VALUES (669, 41, 'OUK', 'Ouaka');
INSERT INTO zones VALUES (670, 41, 'OUH', 'Ouham');
INSERT INTO zones VALUES (671, 41, 'OPE', 'Ouham-Pende');
INSERT INTO zones VALUES (672, 41, 'VAK', 'Vakaga');
INSERT INTO zones VALUES (673, 41, 'NGR', 'Nana-Grebizi');
INSERT INTO zones VALUES (674, 41, 'SMB', 'Sangha-Mbaere');
INSERT INTO zones VALUES (675, 41, 'BAN', 'Bangui');
INSERT INTO zones VALUES (676, 42, 'BA', 'Batha');
INSERT INTO zones VALUES (677, 42, 'BI', 'Biltine');
INSERT INTO zones VALUES (678, 42, 'BE', 'Borkou-Ennedi-Tibesti');
INSERT INTO zones VALUES (679, 42, 'CB', 'Chari-Baguirmi');
INSERT INTO zones VALUES (680, 42, 'GU', 'Guera');
INSERT INTO zones VALUES (681, 42, 'KA', 'Kanem');
INSERT INTO zones VALUES (682, 42, 'LA', 'Lac');
INSERT INTO zones VALUES (683, 42, 'LC', 'Logone Occidental');
INSERT INTO zones VALUES (684, 42, 'LR', 'Logone Oriental');
INSERT INTO zones VALUES (685, 42, 'MK', 'Mayo-Kebbi');
INSERT INTO zones VALUES (686, 42, 'MC', 'Moyen-Chari');
INSERT INTO zones VALUES (687, 42, 'OU', 'Ouaddai');
INSERT INTO zones VALUES (688, 42, 'SA', 'Salamat');
INSERT INTO zones VALUES (689, 42, 'TA', 'Tandjile');
INSERT INTO zones VALUES (690, 43, 'AI', 'Aisen del General Carlos Ibanez');
INSERT INTO zones VALUES (691, 43, 'AN', 'Antofagasta');
INSERT INTO zones VALUES (692, 43, 'AR', 'Araucania');
INSERT INTO zones VALUES (693, 43, 'AT', 'Atacama');
INSERT INTO zones VALUES (694, 43, 'BI', 'Bio-Bio');
INSERT INTO zones VALUES (695, 43, 'CO', 'Coquimbo');
INSERT INTO zones VALUES (696, 43, 'LI', 'Libertador General Bernardo O''Hi');
INSERT INTO zones VALUES (697, 43, 'LL', 'Los Lagos');
INSERT INTO zones VALUES (698, 43, 'MA', 'Magallanes y de la Antartica Chi');
INSERT INTO zones VALUES (699, 43, 'ML', 'Maule');
INSERT INTO zones VALUES (700, 43, 'RM', 'Region Metropolitana');
INSERT INTO zones VALUES (701, 43, 'TA', 'Tarapaca');
INSERT INTO zones VALUES (702, 43, 'VS', 'Valparaiso');
INSERT INTO zones VALUES (703, 44, 'AN', 'Anhui');
INSERT INTO zones VALUES (704, 44, 'BE', 'Beijing');
INSERT INTO zones VALUES (705, 44, 'CH', 'Chongqing');
INSERT INTO zones VALUES (706, 44, 'FU', 'Fujian');
INSERT INTO zones VALUES (707, 44, 'GA', 'Gansu');
INSERT INTO zones VALUES (708, 44, 'GU', 'Guangdong');
INSERT INTO zones VALUES (709, 44, 'GX', 'Guangxi');
INSERT INTO zones VALUES (710, 44, 'GZ', 'Guizhou');
INSERT INTO zones VALUES (711, 44, 'HA', 'Hainan');
INSERT INTO zones VALUES (712, 44, 'HB', 'Hebei');
INSERT INTO zones VALUES (713, 44, 'HL', 'Heilongjiang');
INSERT INTO zones VALUES (714, 44, 'HE', 'Henan');
INSERT INTO zones VALUES (715, 44, 'HK', 'Hong Kong');
INSERT INTO zones VALUES (716, 44, 'HU', 'Hubei');
INSERT INTO zones VALUES (717, 44, 'HN', 'Hunan');
INSERT INTO zones VALUES (718, 44, 'IM', 'Inner Mongolia');
INSERT INTO zones VALUES (719, 44, 'JI', 'Jiangsu');
INSERT INTO zones VALUES (720, 44, 'JX', 'Jiangxi');
INSERT INTO zones VALUES (721, 44, 'JL', 'Jilin');
INSERT INTO zones VALUES (722, 44, 'LI', 'Liaoning');
INSERT INTO zones VALUES (723, 44, 'MA', 'Macau');
INSERT INTO zones VALUES (724, 44, 'NI', 'Ningxia');
INSERT INTO zones VALUES (725, 44, 'SH', 'Shaanxi');
INSERT INTO zones VALUES (726, 44, 'SA', 'Shandong');
INSERT INTO zones VALUES (727, 44, 'SG', 'Shanghai');
INSERT INTO zones VALUES (728, 44, 'SX', 'Shanxi');
INSERT INTO zones VALUES (729, 44, 'SI', 'Sichuan');
INSERT INTO zones VALUES (730, 44, 'TI', 'Tianjin');
INSERT INTO zones VALUES (731, 44, 'XI', 'Xinjiang');
INSERT INTO zones VALUES (732, 44, 'YU', 'Yunnan');
INSERT INTO zones VALUES (733, 44, 'ZH', 'Zhejiang');
INSERT INTO zones VALUES (734, 46, 'D', 'Direction Island');
INSERT INTO zones VALUES (735, 46, 'H', 'Home Island');
INSERT INTO zones VALUES (736, 46, 'O', 'Horsburgh Island');
INSERT INTO zones VALUES (737, 46, 'S', 'South Island');
INSERT INTO zones VALUES (738, 46, 'W', 'West Island');
INSERT INTO zones VALUES (739, 47, 'AMZ', 'Amazonas');
INSERT INTO zones VALUES (740, 47, 'ANT', 'Antioquia');
INSERT INTO zones VALUES (741, 47, 'ARA', 'Arauca');
INSERT INTO zones VALUES (742, 47, 'ATL', 'Atlantico');
INSERT INTO zones VALUES (743, 47, 'BDC', 'Bogota D.C.');
INSERT INTO zones VALUES (744, 47, 'BOL', 'Bolivar');
INSERT INTO zones VALUES (745, 47, 'BOY', 'Boyaca');
INSERT INTO zones VALUES (746, 47, 'CAL', 'Caldas');
INSERT INTO zones VALUES (747, 47, 'CAQ', 'Caqueta');
INSERT INTO zones VALUES (748, 47, 'CAS', 'Casanare');
INSERT INTO zones VALUES (749, 47, 'CAU', 'Cauca');
INSERT INTO zones VALUES (750, 47, 'CES', 'Cesar');
INSERT INTO zones VALUES (751, 47, 'CHO', 'Choco');
INSERT INTO zones VALUES (752, 47, 'COR', 'Cordoba');
INSERT INTO zones VALUES (753, 47, 'CAM', 'Cundinamarca');
INSERT INTO zones VALUES (754, 47, 'GNA', 'Guainia');
INSERT INTO zones VALUES (755, 47, 'GJR', 'Guajira');
INSERT INTO zones VALUES (756, 47, 'GVR', 'Guaviare');
INSERT INTO zones VALUES (757, 47, 'HUI', 'Huila');
INSERT INTO zones VALUES (758, 47, 'MAG', 'Magdalena');
INSERT INTO zones VALUES (759, 47, 'MET', 'Meta');
INSERT INTO zones VALUES (760, 47, 'NAR', 'Narino');
INSERT INTO zones VALUES (761, 47, 'NDS', 'Norte de Santander');
INSERT INTO zones VALUES (762, 47, 'PUT', 'Putumayo');
INSERT INTO zones VALUES (763, 47, 'QUI', 'Quindio');
INSERT INTO zones VALUES (764, 47, 'RIS', 'Risaralda');
INSERT INTO zones VALUES (765, 47, 'SAP', 'San Andres y Providencia');
INSERT INTO zones VALUES (766, 47, 'SAN', 'Santander');
INSERT INTO zones VALUES (767, 47, 'SUC', 'Sucre');
INSERT INTO zones VALUES (768, 47, 'TOL', 'Tolima');
INSERT INTO zones VALUES (769, 47, 'VDC', 'Valle del Cauca');
INSERT INTO zones VALUES (770, 47, 'VAU', 'Vaupes');
INSERT INTO zones VALUES (771, 47, 'VIC', 'Vichada');
INSERT INTO zones VALUES (772, 48, 'G', 'Grande Comore');
INSERT INTO zones VALUES (773, 48, 'A', 'Anjouan');
INSERT INTO zones VALUES (774, 48, 'M', 'Moheli');
INSERT INTO zones VALUES (775, 49, 'BO', 'Bouenza');
INSERT INTO zones VALUES (776, 49, 'BR', 'Brazzaville');
INSERT INTO zones VALUES (777, 49, 'CU', 'Cuvette');
INSERT INTO zones VALUES (778, 49, 'CO', 'Cuvette-Ouest');
INSERT INTO zones VALUES (779, 49, 'KO', 'Kouilou');
INSERT INTO zones VALUES (780, 49, 'LE', 'Lekoumou');
INSERT INTO zones VALUES (781, 49, 'LI', 'Likouala');
INSERT INTO zones VALUES (782, 49, 'NI', 'Niari');
INSERT INTO zones VALUES (783, 49, 'PL', 'Plateaux');
INSERT INTO zones VALUES (784, 49, 'PO', 'Pool');
INSERT INTO zones VALUES (785, 49, 'SA', 'Sangha');
INSERT INTO zones VALUES (786, 50, 'PU', 'Pukapuka');
INSERT INTO zones VALUES (787, 50, 'RK', 'Rakahanga');
INSERT INTO zones VALUES (788, 50, 'MK', 'Manihiki');
INSERT INTO zones VALUES (789, 50, 'PE', 'Penrhyn');
INSERT INTO zones VALUES (790, 50, 'NI', 'Nassau Island');
INSERT INTO zones VALUES (791, 50, 'SU', 'Surwarrow');
INSERT INTO zones VALUES (792, 50, 'PA', 'Palmerston');
INSERT INTO zones VALUES (793, 50, 'AI', 'Aitutaki');
INSERT INTO zones VALUES (794, 50, 'MA', 'Manuae');
INSERT INTO zones VALUES (795, 50, 'TA', 'Takutea');
INSERT INTO zones VALUES (796, 50, 'MT', 'Mitiaro');
INSERT INTO zones VALUES (797, 50, 'AT', 'Atiu');
INSERT INTO zones VALUES (798, 50, 'MU', 'Mauke');
INSERT INTO zones VALUES (799, 50, 'RR', 'Rarotonga');
INSERT INTO zones VALUES (800, 50, 'MG', 'Mangaia');
INSERT INTO zones VALUES (801, 51, 'AL', 'Alajuela');
INSERT INTO zones VALUES (802, 51, 'CA', 'Cartago');
INSERT INTO zones VALUES (803, 51, 'GU', 'Guanacaste');
INSERT INTO zones VALUES (804, 51, 'HE', 'Heredia');
INSERT INTO zones VALUES (805, 51, 'LI', 'Limon');
INSERT INTO zones VALUES (806, 51, 'PU', 'Puntarenas');
INSERT INTO zones VALUES (807, 51, 'SJ', 'San Jose');
INSERT INTO zones VALUES (808, 52, 'ABE', 'Abengourou');
INSERT INTO zones VALUES (809, 52, 'ABI', 'Abidjan');
INSERT INTO zones VALUES (810, 52, 'ABO', 'Aboisso');
INSERT INTO zones VALUES (811, 52, 'ADI', 'Adiake');
INSERT INTO zones VALUES (812, 52, 'ADZ', 'Adzope');
INSERT INTO zones VALUES (813, 52, 'AGB', 'Agboville');
INSERT INTO zones VALUES (814, 52, 'AGN', 'Agnibilekrou');
INSERT INTO zones VALUES (815, 52, 'ALE', 'Alepe');
INSERT INTO zones VALUES (816, 52, 'BOC', 'Bocanda');
INSERT INTO zones VALUES (817, 52, 'BAN', 'Bangolo');
INSERT INTO zones VALUES (818, 52, 'BEO', 'Beoumi');
INSERT INTO zones VALUES (819, 52, 'BIA', 'Biankouma');
INSERT INTO zones VALUES (820, 52, 'BDK', 'Bondoukou');
INSERT INTO zones VALUES (821, 52, 'BGN', 'Bongouanou');
INSERT INTO zones VALUES (822, 52, 'BFL', 'Bouafle');
INSERT INTO zones VALUES (823, 52, 'BKE', 'Bouake');
INSERT INTO zones VALUES (824, 52, 'BNA', 'Bouna');
INSERT INTO zones VALUES (825, 52, 'BDL', 'Boundiali');
INSERT INTO zones VALUES (826, 52, 'DKL', 'Dabakala');
INSERT INTO zones VALUES (827, 52, 'DBU', 'Dabou');
INSERT INTO zones VALUES (828, 52, 'DAL', 'Daloa');
INSERT INTO zones VALUES (829, 52, 'DAN', 'Danane');
INSERT INTO zones VALUES (830, 52, 'DAO', 'Daoukro');
INSERT INTO zones VALUES (831, 52, 'DIM', 'Dimbokro');
INSERT INTO zones VALUES (832, 52, 'DIV', 'Divo');
INSERT INTO zones VALUES (833, 52, 'DUE', 'Duekoue');
INSERT INTO zones VALUES (834, 52, 'FER', 'Ferkessedougou');
INSERT INTO zones VALUES (835, 52, 'GAG', 'Gagnoa');
INSERT INTO zones VALUES (836, 52, 'GBA', 'Grand-Bassam');
INSERT INTO zones VALUES (837, 52, 'GLA', 'Grand-Lahou');
INSERT INTO zones VALUES (838, 52, 'GUI', 'Guiglo');
INSERT INTO zones VALUES (839, 52, 'ISS', 'Issia');
INSERT INTO zones VALUES (840, 52, 'JAC', 'Jacqueville');
INSERT INTO zones VALUES (841, 52, 'KAT', 'Katiola');
INSERT INTO zones VALUES (842, 52, 'KOR', 'Korhogo');
INSERT INTO zones VALUES (843, 52, 'LAK', 'Lakota');
INSERT INTO zones VALUES (844, 52, 'MAN', 'Man');
INSERT INTO zones VALUES (845, 52, 'MKN', 'Mankono');
INSERT INTO zones VALUES (846, 52, 'MBA', 'Mbahiakro');
INSERT INTO zones VALUES (847, 52, 'ODI', 'Odienne');
INSERT INTO zones VALUES (848, 52, 'OUM', 'Oume');
INSERT INTO zones VALUES (849, 52, 'SAK', 'Sakassou');
INSERT INTO zones VALUES (850, 52, 'SPE', 'San-Pedro');
INSERT INTO zones VALUES (851, 52, 'SAS', 'Sassandra');
INSERT INTO zones VALUES (852, 52, 'SEG', 'Seguela');
INSERT INTO zones VALUES (853, 52, 'SIN', 'Sinfra');
INSERT INTO zones VALUES (854, 52, 'SOU', 'Soubre');
INSERT INTO zones VALUES (855, 52, 'TAB', 'Tabou');
INSERT INTO zones VALUES (856, 52, 'TAN', 'Tanda');
INSERT INTO zones VALUES (857, 52, 'TIE', 'Tiebissou');
INSERT INTO zones VALUES (858, 52, 'TIN', 'Tingrela');
INSERT INTO zones VALUES (859, 52, 'TIA', 'Tiassale');
INSERT INTO zones VALUES (860, 52, 'TBA', 'Touba');
INSERT INTO zones VALUES (861, 52, 'TLP', 'Toulepleu');
INSERT INTO zones VALUES (862, 52, 'TMD', 'Toumodi');
INSERT INTO zones VALUES (863, 52, 'VAV', 'Vavoua');
INSERT INTO zones VALUES (864, 52, 'YAM', 'Yamoussoukro');
INSERT INTO zones VALUES (865, 52, 'ZUE', 'Zuenoula');
INSERT INTO zones VALUES (866, 53, 'BB', 'Bjelovar-Bilogora');
INSERT INTO zones VALUES (867, 53, 'CZ', 'City of Zagreb');
INSERT INTO zones VALUES (868, 53, 'DN', 'Dubrovnik-Neretva');
INSERT INTO zones VALUES (869, 53, 'IS', 'Istra');
INSERT INTO zones VALUES (870, 53, 'KA', 'Karlovac');
INSERT INTO zones VALUES (871, 53, 'KK', 'Koprivnica-Krizevci');
INSERT INTO zones VALUES (872, 53, 'KZ', 'Krapina-Zagorje');
INSERT INTO zones VALUES (873, 53, 'LS', 'Lika-Senj');
INSERT INTO zones VALUES (874, 53, 'ME', 'Medimurje');
INSERT INTO zones VALUES (875, 53, 'OB', 'Osijek-Baranja');
INSERT INTO zones VALUES (876, 53, 'PS', 'Pozega-Slavonia');
INSERT INTO zones VALUES (877, 53, 'PG', 'Primorje-Gorski Kotar');
INSERT INTO zones VALUES (878, 53, 'SI', 'Sibenik');
INSERT INTO zones VALUES (879, 53, 'SM', 'Sisak-Moslavina');
INSERT INTO zones VALUES (880, 53, 'SB', 'Slavonski Brod-Posavina');
INSERT INTO zones VALUES (881, 53, 'SD', 'Split-Dalmatia');
INSERT INTO zones VALUES (882, 53, 'VA', 'Varazdin');
INSERT INTO zones VALUES (883, 53, 'VP', 'Virovitica-Podravina');
INSERT INTO zones VALUES (884, 53, 'VS', 'Vukovar-Srijem');
INSERT INTO zones VALUES (885, 53, 'ZK', 'Zadar-Knin');
INSERT INTO zones VALUES (886, 53, 'ZA', 'Zagreb');
INSERT INTO zones VALUES (887, 54, 'CA', 'Camaguey');
INSERT INTO zones VALUES (888, 54, 'CD', 'Ciego de Avila');
INSERT INTO zones VALUES (889, 54, 'CI', 'Cienfuegos');
INSERT INTO zones VALUES (890, 54, 'CH', 'Ciudad de La Habana');
INSERT INTO zones VALUES (891, 54, 'GR', 'Granma');
INSERT INTO zones VALUES (892, 54, 'GU', 'Guantanamo');
INSERT INTO zones VALUES (893, 54, 'HO', 'Holguin');
INSERT INTO zones VALUES (894, 54, 'IJ', 'Isla de la Juventud');
INSERT INTO zones VALUES (895, 54, 'LH', 'La Habana');
INSERT INTO zones VALUES (896, 54, 'LT', 'Las Tunas');
INSERT INTO zones VALUES (897, 54, 'MA', 'Matanzas');
INSERT INTO zones VALUES (898, 54, 'PR', 'Pinar del Rio');
INSERT INTO zones VALUES (899, 54, 'SS', 'Sancti Spiritus');
INSERT INTO zones VALUES (900, 54, 'SC', 'Santiago de Cuba');
INSERT INTO zones VALUES (901, 54, 'VC', 'Villa Clara');
INSERT INTO zones VALUES (902, 55, 'F', 'Famagusta');
INSERT INTO zones VALUES (903, 55, 'K', 'Kyrenia');
INSERT INTO zones VALUES (904, 55, 'A', 'Larnaca');
INSERT INTO zones VALUES (905, 55, 'I', 'Limassol');
INSERT INTO zones VALUES (906, 55, 'N', 'Nicosia');
INSERT INTO zones VALUES (907, 55, 'P', 'Paphos');
INSERT INTO zones VALUES (908, 56, 'US', 'Ústecký');
INSERT INTO zones VALUES (909, 56, 'JC', 'Jihočeský');
INSERT INTO zones VALUES (910, 56, 'JM', 'Jihomoravský');
INSERT INTO zones VALUES (911, 56, 'KA', 'Karlovarský');
INSERT INTO zones VALUES (912, 56, 'KR', 'Královéhradecký');
INSERT INTO zones VALUES (913, 56, 'LI', 'Liberecký');
INSERT INTO zones VALUES (914, 56, 'MO', 'Moravskoslezský');
INSERT INTO zones VALUES (915, 56, 'OL', 'Olomoucký');
INSERT INTO zones VALUES (916, 56, 'PA', 'Pardubický');
INSERT INTO zones VALUES (917, 56, 'PL', 'Plzeňský');
INSERT INTO zones VALUES (918, 56, 'PR', 'Hlavní město Praha');
INSERT INTO zones VALUES (919, 56, 'ST', 'Středočeský');
INSERT INTO zones VALUES (920, 56, 'VY', 'Vysočina');
INSERT INTO zones VALUES (921, 56, 'ZL', 'Zlínský');
INSERT INTO zones VALUES (922, 57, 'AR', 'Arhus');
INSERT INTO zones VALUES (923, 57, 'BH', 'Bornholm');
INSERT INTO zones VALUES (924, 57, 'CO', 'Copenhagen');
INSERT INTO zones VALUES (925, 57, 'FO', 'Faroe Islands');
INSERT INTO zones VALUES (926, 57, 'FR', 'Frederiksborg');
INSERT INTO zones VALUES (927, 57, 'FY', 'Fyn');
INSERT INTO zones VALUES (928, 57, 'KO', 'Kobenhavn');
INSERT INTO zones VALUES (929, 57, 'NO', 'Nordjylland');
INSERT INTO zones VALUES (930, 57, 'RI', 'Ribe');
INSERT INTO zones VALUES (931, 57, 'RK', 'Ringkobing');
INSERT INTO zones VALUES (932, 57, 'RO', 'Roskilde');
INSERT INTO zones VALUES (933, 57, 'SO', 'Sonderjylland');
INSERT INTO zones VALUES (934, 57, 'ST', 'Storstrom');
INSERT INTO zones VALUES (935, 57, 'VK', 'Vejle');
INSERT INTO zones VALUES (936, 57, 'VJ', 'Vestj&aelig;lland');
INSERT INTO zones VALUES (937, 57, 'VB', 'Viborg');
INSERT INTO zones VALUES (938, 58, 'S', '''Ali Sabih');
INSERT INTO zones VALUES (939, 58, 'K', 'Dikhil');
INSERT INTO zones VALUES (940, 58, 'J', 'Djibouti');
INSERT INTO zones VALUES (941, 58, 'O', 'Obock');
INSERT INTO zones VALUES (942, 58, 'T', 'Tadjoura');
INSERT INTO zones VALUES (943, 59, 'AND', 'Saint Andrew Parish');
INSERT INTO zones VALUES (944, 59, 'DAV', 'Saint David Parish');
INSERT INTO zones VALUES (945, 59, 'GEO', 'Saint George Parish');
INSERT INTO zones VALUES (946, 59, 'JOH', 'Saint John Parish');
INSERT INTO zones VALUES (947, 59, 'JOS', 'Saint Joseph Parish');
INSERT INTO zones VALUES (948, 59, 'LUK', 'Saint Luke Parish');
INSERT INTO zones VALUES (949, 59, 'MAR', 'Saint Mark Parish');
INSERT INTO zones VALUES (950, 59, 'PAT', 'Saint Patrick Parish');
INSERT INTO zones VALUES (951, 59, 'PAU', 'Saint Paul Parish');
INSERT INTO zones VALUES (952, 59, 'PET', 'Saint Peter Parish');
INSERT INTO zones VALUES (953, 60, 'DN', 'Distrito Nacional');
INSERT INTO zones VALUES (954, 60, 'AZ', 'Azua');
INSERT INTO zones VALUES (955, 60, 'BC', 'Baoruco');
INSERT INTO zones VALUES (956, 60, 'BH', 'Barahona');
INSERT INTO zones VALUES (957, 60, 'DJ', 'Dajabon');
INSERT INTO zones VALUES (958, 60, 'DU', 'Duarte');
INSERT INTO zones VALUES (959, 60, 'EL', 'Elias Pina');
INSERT INTO zones VALUES (960, 60, 'SY', 'El Seybo');
INSERT INTO zones VALUES (961, 60, 'ET', 'Espaillat');
INSERT INTO zones VALUES (962, 60, 'HM', 'Hato Mayor');
INSERT INTO zones VALUES (963, 60, 'IN', 'Independencia');
INSERT INTO zones VALUES (964, 60, 'AL', 'La Altagracia');
INSERT INTO zones VALUES (965, 60, 'RO', 'La Romana');
INSERT INTO zones VALUES (966, 60, 'VE', 'La Vega');
INSERT INTO zones VALUES (967, 60, 'MT', 'Maria Trinidad Sanchez');
INSERT INTO zones VALUES (968, 60, 'MN', 'Monsenor Nouel');
INSERT INTO zones VALUES (969, 60, 'MC', 'Monte Cristi');
INSERT INTO zones VALUES (970, 60, 'MP', 'Monte Plata');
INSERT INTO zones VALUES (971, 60, 'PD', 'Pedernales');
INSERT INTO zones VALUES (972, 60, 'PR', 'Peravia (Bani)');
INSERT INTO zones VALUES (973, 60, 'PP', 'Puerto Plata');
INSERT INTO zones VALUES (974, 60, 'SL', 'Salcedo');
INSERT INTO zones VALUES (975, 60, 'SM', 'Samana');
INSERT INTO zones VALUES (976, 60, 'SH', 'Sanchez Ramirez');
INSERT INTO zones VALUES (977, 60, 'SC', 'San Cristobal');
INSERT INTO zones VALUES (978, 60, 'JO', 'San Jose de Ocoa');
INSERT INTO zones VALUES (979, 60, 'SJ', 'San Juan');
INSERT INTO zones VALUES (980, 60, 'PM', 'San Pedro de Macoris');
INSERT INTO zones VALUES (981, 60, 'SA', 'Santiago');
INSERT INTO zones VALUES (982, 60, 'ST', 'Santiago Rodriguez');
INSERT INTO zones VALUES (983, 60, 'SD', 'Santo Domingo');
INSERT INTO zones VALUES (984, 60, 'VA', 'Valverde');
INSERT INTO zones VALUES (985, 61, 'AL', 'Aileu');
INSERT INTO zones VALUES (986, 61, 'AN', 'Ainaro');
INSERT INTO zones VALUES (987, 61, 'BA', 'Baucau');
INSERT INTO zones VALUES (988, 61, 'BO', 'Bobonaro');
INSERT INTO zones VALUES (989, 61, 'CO', 'Cova Lima');
INSERT INTO zones VALUES (990, 61, 'DI', 'Dili');
INSERT INTO zones VALUES (991, 61, 'ER', 'Ermera');
INSERT INTO zones VALUES (992, 61, 'LA', 'Lautem');
INSERT INTO zones VALUES (993, 61, 'LI', 'Liquica');
INSERT INTO zones VALUES (994, 61, 'MT', 'Manatuto');
INSERT INTO zones VALUES (995, 61, 'MF', 'Manufahi');
INSERT INTO zones VALUES (996, 61, 'OE', 'Oecussi');
INSERT INTO zones VALUES (997, 61, 'VI', 'Viqueque');
INSERT INTO zones VALUES (998, 62, 'AZU', 'Azuay');
INSERT INTO zones VALUES (999, 62, 'BOL', 'Bolivar');
INSERT INTO zones VALUES (1000, 62, 'CAN', 'Ca&ntilde;ar');
INSERT INTO zones VALUES (1001, 62, 'CAR', 'Carchi');
INSERT INTO zones VALUES (1002, 62, 'CHI', 'Chimborazo');
INSERT INTO zones VALUES (1003, 62, 'COT', 'Cotopaxi');
INSERT INTO zones VALUES (1004, 62, 'EOR', 'El Oro');
INSERT INTO zones VALUES (1005, 62, 'ESM', 'Esmeraldas');
INSERT INTO zones VALUES (1006, 62, 'GPS', 'Gal&aacute;pagos');
INSERT INTO zones VALUES (1007, 62, 'GUA', 'Guayas');
INSERT INTO zones VALUES (1008, 62, 'IMB', 'Imbabura');
INSERT INTO zones VALUES (1009, 62, 'LOJ', 'Loja');
INSERT INTO zones VALUES (1010, 62, 'LRO', 'Los Ríos');
INSERT INTO zones VALUES (1011, 62, 'MAN', 'Manab&iacute;');
INSERT INTO zones VALUES (1012, 62, 'MSA', 'Morona Santiago');
INSERT INTO zones VALUES (1013, 62, 'NAP', 'Napo');
INSERT INTO zones VALUES (1014, 62, 'ORE', 'Orellana');
INSERT INTO zones VALUES (1015, 62, 'PAS', 'Pastaza');
INSERT INTO zones VALUES (1016, 62, 'PIC', 'Pichincha');
INSERT INTO zones VALUES (1017, 62, 'SUC', 'Sucumb&iacute;os');
INSERT INTO zones VALUES (1018, 62, 'TUN', 'Tungurahua');
INSERT INTO zones VALUES (1019, 62, 'ZCH', 'Zamora Chinchipe');
INSERT INTO zones VALUES (1020, 63, 'DHY', 'Ad Daqahliyah');
INSERT INTO zones VALUES (1021, 63, 'BAM', 'Al Bahr al Ahmar');
INSERT INTO zones VALUES (1022, 63, 'BHY', 'Al Buhayrah');
INSERT INTO zones VALUES (1023, 63, 'FYM', 'Al Fayyum');
INSERT INTO zones VALUES (1024, 63, 'GBY', 'Al Gharbiyah');
INSERT INTO zones VALUES (1025, 63, 'IDR', 'Al Iskandariyah');
INSERT INTO zones VALUES (1026, 63, 'IML', 'Al Isma''iliyah');
INSERT INTO zones VALUES (1027, 63, 'JZH', 'Al Jizah');
INSERT INTO zones VALUES (1028, 63, 'MFY', 'Al Minufiyah');
INSERT INTO zones VALUES (1029, 63, 'MNY', 'Al Minya');
INSERT INTO zones VALUES (1030, 63, 'QHR', 'Al Qahirah');
INSERT INTO zones VALUES (1031, 63, 'QLY', 'Al Qalyubiyah');
INSERT INTO zones VALUES (1032, 63, 'WJD', 'Al Wadi al Jadid');
INSERT INTO zones VALUES (1033, 63, 'SHQ', 'Ash Sharqiyah');
INSERT INTO zones VALUES (1034, 63, 'SWY', 'As Suways');
INSERT INTO zones VALUES (1035, 63, 'ASW', 'Aswan');
INSERT INTO zones VALUES (1036, 63, 'ASY', 'Asyut');
INSERT INTO zones VALUES (1037, 63, 'BSW', 'Bani Suwayf');
INSERT INTO zones VALUES (1038, 63, 'BSD', 'Bur Sa''id');
INSERT INTO zones VALUES (1039, 63, 'DMY', 'Dumyat');
INSERT INTO zones VALUES (1040, 63, 'JNS', 'Janub Sina''');
INSERT INTO zones VALUES (1041, 63, 'KSH', 'Kafr ash Shaykh');
INSERT INTO zones VALUES (1042, 63, 'MAT', 'Matruh');
INSERT INTO zones VALUES (1043, 63, 'QIN', 'Qina');
INSERT INTO zones VALUES (1044, 63, 'SHS', 'Shamal Sina''');
INSERT INTO zones VALUES (1045, 63, 'SUH', 'Suhaj');
INSERT INTO zones VALUES (1046, 64, 'AH', 'Ahuachapan');
INSERT INTO zones VALUES (1047, 64, 'CA', 'Cabanas');
INSERT INTO zones VALUES (1048, 64, 'CH', 'Chalatenango');
INSERT INTO zones VALUES (1049, 64, 'CU', 'Cuscatlan');
INSERT INTO zones VALUES (1050, 64, 'LB', 'La Libertad');
INSERT INTO zones VALUES (1051, 64, 'PZ', 'La Paz');
INSERT INTO zones VALUES (1052, 64, 'UN', 'La Union');
INSERT INTO zones VALUES (1053, 64, 'MO', 'Morazan');
INSERT INTO zones VALUES (1054, 64, 'SM', 'San Miguel');
INSERT INTO zones VALUES (1055, 64, 'SS', 'San Salvador');
INSERT INTO zones VALUES (1056, 64, 'SV', 'San Vicente');
INSERT INTO zones VALUES (1057, 64, 'SA', 'Santa Ana');
INSERT INTO zones VALUES (1058, 64, 'SO', 'Sonsonate');
INSERT INTO zones VALUES (1059, 64, 'US', 'Usulutan');
INSERT INTO zones VALUES (1060, 65, 'AN', 'Provincia Annobon');
INSERT INTO zones VALUES (1061, 65, 'BN', 'Provincia Bioko Norte');
INSERT INTO zones VALUES (1062, 65, 'BS', 'Provincia Bioko Sur');
INSERT INTO zones VALUES (1063, 65, 'CS', 'Provincia Centro Sur');
INSERT INTO zones VALUES (1064, 65, 'KN', 'Provincia Kie-Ntem');
INSERT INTO zones VALUES (1065, 65, 'LI', 'Provincia Litoral');
INSERT INTO zones VALUES (1066, 65, 'WN', 'Provincia Wele-Nzas');
INSERT INTO zones VALUES (1067, 66, 'MA', 'Central (Maekel)');
INSERT INTO zones VALUES (1068, 66, 'KE', 'Anseba (Keren)');
INSERT INTO zones VALUES (1069, 66, 'DK', 'Southern Red Sea (Debub-Keih-Bah');
INSERT INTO zones VALUES (1070, 66, 'SK', 'Northern Red Sea (Semien-Keih-Ba');
INSERT INTO zones VALUES (1071, 66, 'DE', 'Southern (Debub)');
INSERT INTO zones VALUES (1072, 66, 'BR', 'Gash-Barka (Barentu)');
INSERT INTO zones VALUES (1073, 67, 'HA', 'Harjumaa (Tallinn)');
INSERT INTO zones VALUES (1074, 67, 'HI', 'Hiiumaa (Kardla)');
INSERT INTO zones VALUES (1075, 67, 'IV', 'Ida-Virumaa (Johvi)');
INSERT INTO zones VALUES (1076, 67, 'JA', 'Jarvamaa (Paide)');
INSERT INTO zones VALUES (1077, 67, 'JO', 'Jogevamaa (Jogeva)');
INSERT INTO zones VALUES (1078, 67, 'LV', 'Laane-Virumaa (Rakvere)');
INSERT INTO zones VALUES (1079, 67, 'LA', 'Laanemaa (Haapsalu)');
INSERT INTO zones VALUES (1080, 67, 'PA', 'Parnumaa (Parnu)');
INSERT INTO zones VALUES (1081, 67, 'PO', 'Polvamaa (Polva)');
INSERT INTO zones VALUES (1082, 67, 'RA', 'Raplamaa (Rapla)');
INSERT INTO zones VALUES (1083, 67, 'SA', 'Saaremaa (Kuessaare)');
INSERT INTO zones VALUES (1084, 67, 'TA', 'Tartumaa (Tartu)');
INSERT INTO zones VALUES (1085, 67, 'VA', 'Valgamaa (Valga)');
INSERT INTO zones VALUES (1086, 67, 'VI', 'Viljandimaa (Viljandi)');
INSERT INTO zones VALUES (1087, 67, 'VO', 'Vorumaa (Voru)');
INSERT INTO zones VALUES (1088, 68, 'AF', 'Afar');
INSERT INTO zones VALUES (1089, 68, 'AH', 'Amhara');
INSERT INTO zones VALUES (1090, 68, 'BG', 'Benishangul-Gumaz');
INSERT INTO zones VALUES (1091, 68, 'GB', 'Gambela');
INSERT INTO zones VALUES (1092, 68, 'HR', 'Hariai');
INSERT INTO zones VALUES (1093, 68, 'OR', 'Oromia');
INSERT INTO zones VALUES (1094, 68, 'SM', 'Somali');
INSERT INTO zones VALUES (1095, 68, 'SN', 'Southern Nations - Nationalities');
INSERT INTO zones VALUES (1096, 68, 'TG', 'Tigray');
INSERT INTO zones VALUES (1097, 68, 'AA', 'Addis Ababa');
INSERT INTO zones VALUES (1098, 68, 'DD', 'Dire Dawa');
INSERT INTO zones VALUES (1099, 70, 'T&Ucirc;R', 'T&ucirc;rshavnar Kommuna');
INSERT INTO zones VALUES (1100, 70, 'KLA', 'Klaksv&iacute;k');
INSERT INTO zones VALUES (1101, 70, 'RUN', 'Runav&iacute;k');
INSERT INTO zones VALUES (1102, 70, 'TV&Oslash;', 'Tv&oslash;royri');
INSERT INTO zones VALUES (1103, 70, 'FUG', 'Fuglafj&oslash;r&eth;ur');
INSERT INTO zones VALUES (1104, 70, 'SUN', 'Sunda Kommuna');
INSERT INTO zones VALUES (1105, 70, 'V&Aacute;G', 'V&aacute;gur');
INSERT INTO zones VALUES (1106, 70, 'NES', 'Nes');
INSERT INTO zones VALUES (1107, 70, 'VES', 'Vestmanna');
INSERT INTO zones VALUES (1108, 70, 'MI&eth;', 'Mi&eth;v&aacute;gur');
INSERT INTO zones VALUES (1109, 70, 'S&Oslash;R', 'S&oslash;rv&aacute;gur');
INSERT INTO zones VALUES (1110, 70, 'G&Oslash;T', 'G&oslash;tu Kommuna');
INSERT INTO zones VALUES (1111, 70, 'SJ&Ucirc;', 'Sj&ucirc;var Kommuna');
INSERT INTO zones VALUES (1112, 70, 'LEI', 'Leirv&iacute;k');
INSERT INTO zones VALUES (1113, 70, 'SAN', 'Sandav&aacute;gur');
INSERT INTO zones VALUES (1114, 70, 'HVA', 'Hvalba');
INSERT INTO zones VALUES (1115, 70, 'EI&eth;', 'Ei&eth;i');
INSERT INTO zones VALUES (1116, 70, 'KV&Iacute;', 'Kv&iacute;v&iacute;k');
INSERT INTO zones VALUES (1117, 70, 'SAN', 'Sandur');
INSERT INTO zones VALUES (1118, 70, 'SKO', 'Skopun');
INSERT INTO zones VALUES (1119, 70, 'HVA', 'Hvannasund');
INSERT INTO zones VALUES (1120, 70, 'SUM', 'Sumba');
INSERT INTO zones VALUES (1121, 70, 'VI&eth;', 'Vi&eth;arei&eth;i');
INSERT INTO zones VALUES (1122, 70, 'POR', 'Porkeri');
INSERT INTO zones VALUES (1123, 70, 'SK&Aacute;', 'Sk&aacute;lav&iacute;k');
INSERT INTO zones VALUES (1124, 70, 'KUN', 'Kunoy');
INSERT INTO zones VALUES (1125, 70, 'H&Uacute;S', 'H&uacute;sav&iacute;k');
INSERT INTO zones VALUES (1126, 70, 'HOV', 'Hov');
INSERT INTO zones VALUES (1127, 70, 'F&Aacute;M', 'F&aacute;mjin');
INSERT INTO zones VALUES (1128, 70, 'FUN', 'Funningur');
INSERT INTO zones VALUES (1129, 70, 'H&Uacute;S', 'H&uacute;sar');
INSERT INTO zones VALUES (1130, 70, 'SK&Uacute;', 'Sk&uacute;voy');
INSERT INTO zones VALUES (1131, 70, 'SV&Iacute;', 'Sv&iacute;noy');
INSERT INTO zones VALUES (1132, 70, 'FUG', 'Fugloy');
INSERT INTO zones VALUES (1133, 71, 'C', 'Central Division');
INSERT INTO zones VALUES (1134, 71, 'N', 'Northern Division');
INSERT INTO zones VALUES (1135, 71, 'E', 'Eastern Division');
INSERT INTO zones VALUES (1136, 71, 'W', 'Western Division');
INSERT INTO zones VALUES (1137, 71, 'R', 'Rotuma');
INSERT INTO zones VALUES (1138, 72, 'AL', 'Ahvenanmaan Laani');
INSERT INTO zones VALUES (1139, 72, 'ES', 'Etela-Suomen Laani');
INSERT INTO zones VALUES (1140, 72, 'IS', 'Ita-Suomen Laani');
INSERT INTO zones VALUES (1141, 72, 'LS', 'Lansi-Suomen Laani');
INSERT INTO zones VALUES (1142, 72, 'LA', 'Lapin Lanani');
INSERT INTO zones VALUES (1143, 72, 'OU', 'Oulun Laani');
INSERT INTO zones VALUES (1144, 73, 'AL', 'Alsace');
INSERT INTO zones VALUES (1145, 73, 'AQ', 'Aquitaine');
INSERT INTO zones VALUES (1146, 73, 'AU', 'Auvergne');
INSERT INTO zones VALUES (1147, 73, 'BR', 'Brittany');
INSERT INTO zones VALUES (1148, 73, 'BU', 'Burgundy');
INSERT INTO zones VALUES (1149, 73, 'CE', 'Center Loire Valley');
INSERT INTO zones VALUES (1150, 73, 'CH', 'Champagne');
INSERT INTO zones VALUES (1151, 73, 'CO', 'Corse');
INSERT INTO zones VALUES (1152, 73, 'FR', 'France Comte');
INSERT INTO zones VALUES (1153, 73, 'LA', 'Languedoc Roussillon');
INSERT INTO zones VALUES (1154, 73, 'LI', 'Limousin');
INSERT INTO zones VALUES (1155, 73, 'LO', 'Lorraine');
INSERT INTO zones VALUES (1156, 73, 'MI', 'Midi Pyrenees');
INSERT INTO zones VALUES (1157, 73, 'NO', 'Nord Pas de Calais');
INSERT INTO zones VALUES (1158, 73, 'NR', 'Normandy');
INSERT INTO zones VALUES (1159, 73, 'PA', 'Paris / Ill de France');
INSERT INTO zones VALUES (1160, 73, 'PI', 'Picardie');
INSERT INTO zones VALUES (1161, 73, 'PO', 'Poitou Charente');
INSERT INTO zones VALUES (1162, 73, 'PR', 'Provence');
INSERT INTO zones VALUES (1163, 73, 'RH', 'Rhone Alps');
INSERT INTO zones VALUES (1164, 73, 'RI', 'Riviera');
INSERT INTO zones VALUES (1165, 73, 'WE', 'Western Loire Valley');
INSERT INTO zones VALUES (1166, 74, 'Et', 'Etranger');
INSERT INTO zones VALUES (1167, 74, '01', 'Ain');
INSERT INTO zones VALUES (1168, 74, '02', 'Aisne');
INSERT INTO zones VALUES (1169, 74, '03', 'Allier');
INSERT INTO zones VALUES (1170, 74, '04', 'Alpes de Haute Provence');
INSERT INTO zones VALUES (1171, 74, '05', 'Hautes-Alpes');
INSERT INTO zones VALUES (1172, 74, '06', 'Alpes Maritimes');
INSERT INTO zones VALUES (1173, 74, '07', 'Ard&egrave;che');
INSERT INTO zones VALUES (1174, 74, '08', 'Ardennes');
INSERT INTO zones VALUES (1175, 74, '09', 'Ari&egrave;ge');
INSERT INTO zones VALUES (1176, 74, '10', 'Aube');
INSERT INTO zones VALUES (1177, 74, '11', 'Aude');
INSERT INTO zones VALUES (1178, 74, '12', 'Aveyron');
INSERT INTO zones VALUES (1179, 74, '13', 'Bouches du Rh&ocirc;ne');
INSERT INTO zones VALUES (1180, 74, '14', 'Calvados');
INSERT INTO zones VALUES (1181, 74, '15', 'Cantal');
INSERT INTO zones VALUES (1182, 74, '16', 'Charente');
INSERT INTO zones VALUES (1183, 74, '17', 'Charente Maritime');
INSERT INTO zones VALUES (1184, 74, '18', 'Cher');
INSERT INTO zones VALUES (1185, 74, '19', 'Corr&egrave;ze');
INSERT INTO zones VALUES (1186, 74, '2A', 'Corse du Sud');
INSERT INTO zones VALUES (1187, 74, '2B', 'Haute Corse');
INSERT INTO zones VALUES (1188, 74, '21', 'C&ocirc;te d''or');
INSERT INTO zones VALUES (1189, 74, '22', 'C&ocirc;tes d''Armor');
INSERT INTO zones VALUES (1190, 74, '23', 'Creuse');
INSERT INTO zones VALUES (1191, 74, '24', 'Dordogne');
INSERT INTO zones VALUES (1192, 74, '25', 'Doubs');
INSERT INTO zones VALUES (1193, 74, '26', 'Dr&ocirc;me');
INSERT INTO zones VALUES (1194, 74, '27', 'Eure');
INSERT INTO zones VALUES (1195, 74, '28', 'Eure et Loir');
INSERT INTO zones VALUES (1196, 74, '29', 'Finist&egrave;re');
INSERT INTO zones VALUES (1197, 74, '30', 'Gard');
INSERT INTO zones VALUES (1198, 74, '31', 'Haute Garonne');
INSERT INTO zones VALUES (1199, 74, '32', 'Gers');
INSERT INTO zones VALUES (1200, 74, '33', 'Gironde');
INSERT INTO zones VALUES (1201, 74, '34', 'H&eacute;rault');
INSERT INTO zones VALUES (1202, 74, '35', 'Ille et Vilaine');
INSERT INTO zones VALUES (1203, 74, '36', 'Indre');
INSERT INTO zones VALUES (1204, 74, '37', 'Indre et Loire');
INSERT INTO zones VALUES (1205, 74, '38', 'Is&eacute;re');
INSERT INTO zones VALUES (1206, 74, '39', 'Jura');
INSERT INTO zones VALUES (1207, 74, '40', 'Landes');
INSERT INTO zones VALUES (1208, 74, '41', 'Loir et Cher');
INSERT INTO zones VALUES (1209, 74, '42', 'Loire');
INSERT INTO zones VALUES (1210, 74, '43', 'Haute Loire');
INSERT INTO zones VALUES (1211, 74, '44', 'Loire Atlantique');
INSERT INTO zones VALUES (1212, 74, '45', 'Loiret');
INSERT INTO zones VALUES (1213, 74, '46', 'Lot');
INSERT INTO zones VALUES (1214, 74, '47', 'Lot et Garonne');
INSERT INTO zones VALUES (1215, 74, '48', 'Loz&egrave;re');
INSERT INTO zones VALUES (1216, 74, '49', 'Maine et Loire');
INSERT INTO zones VALUES (1217, 74, '50', 'Manche');
INSERT INTO zones VALUES (1218, 74, '51', 'Marne');
INSERT INTO zones VALUES (1219, 74, '52', 'Haute Marne');
INSERT INTO zones VALUES (1220, 74, '53', 'Mayenne');
INSERT INTO zones VALUES (1221, 74, '54', 'Meurthe et Moselle');
INSERT INTO zones VALUES (1222, 74, '55', 'Meuse');
INSERT INTO zones VALUES (1223, 74, '56', 'Morbihan');
INSERT INTO zones VALUES (1224, 74, '57', 'Moselle');
INSERT INTO zones VALUES (1225, 74, '58', 'Ni&egrave;vre');
INSERT INTO zones VALUES (1226, 74, '59', 'Nord');
INSERT INTO zones VALUES (1227, 74, '60', 'Oise');
INSERT INTO zones VALUES (1228, 74, '61', 'Orne');
INSERT INTO zones VALUES (1229, 74, '62', 'Pas de Calais');
INSERT INTO zones VALUES (1230, 74, '63', 'Puy de D&ocirc;me');
INSERT INTO zones VALUES (1231, 74, '64', 'Pyr&eacute;n&eacute;es Atlantiqu');
INSERT INTO zones VALUES (1232, 74, '65', 'Hautes Pyr&eacute;n&eacute;es');
INSERT INTO zones VALUES (1233, 74, '66', 'Pyr&eacute;n&eacute;es Orientale');
INSERT INTO zones VALUES (1234, 74, '67', 'Bas Rhin');
INSERT INTO zones VALUES (1235, 74, '68', 'Haut Rhin');
INSERT INTO zones VALUES (1236, 74, '69', 'Rh&ocirc;ne');
INSERT INTO zones VALUES (1237, 74, '70', 'Haute Sa&ocirc;ne');
INSERT INTO zones VALUES (1238, 74, '71', 'Sa&ocirc;ne et Loire');
INSERT INTO zones VALUES (1239, 74, '72', 'Sarthe');
INSERT INTO zones VALUES (1240, 74, '73', 'Savoie');
INSERT INTO zones VALUES (1241, 74, '74', 'Haute Savoie');
INSERT INTO zones VALUES (1242, 74, '75', 'Paris');
INSERT INTO zones VALUES (1243, 74, '76', 'Seine Maritime');
INSERT INTO zones VALUES (1244, 74, '77', 'Seine et Marne');
INSERT INTO zones VALUES (1245, 74, '78', 'Yvelines');
INSERT INTO zones VALUES (1246, 74, '79', 'Deux S&egrave;vres');
INSERT INTO zones VALUES (1247, 74, '80', 'Somme');
INSERT INTO zones VALUES (1248, 74, '81', 'Tarn');
INSERT INTO zones VALUES (1249, 74, '82', 'Tarn et Garonne');
INSERT INTO zones VALUES (1250, 74, '83', 'Var');
INSERT INTO zones VALUES (1251, 74, '84', 'Vaucluse');
INSERT INTO zones VALUES (1252, 74, '85', 'Vend&eacute;e');
INSERT INTO zones VALUES (1253, 74, '86', 'Vienne');
INSERT INTO zones VALUES (1254, 74, '87', 'Haute Vienne');
INSERT INTO zones VALUES (1255, 74, '88', 'Vosges');
INSERT INTO zones VALUES (1256, 74, '89', 'Yonne');
INSERT INTO zones VALUES (1257, 74, '90', 'Territoire de Belfort');
INSERT INTO zones VALUES (1258, 74, '91', 'Essonne');
INSERT INTO zones VALUES (1259, 74, '92', 'Hauts de Seine');
INSERT INTO zones VALUES (1260, 74, '93', 'Seine St-Denis');
INSERT INTO zones VALUES (1261, 74, '94', 'Val de Marne');
INSERT INTO zones VALUES (1262, 74, '95', 'Val d''Oise');
INSERT INTO zones VALUES (1263, 75, 'AWA', 'Awala-Yalimapo');
INSERT INTO zones VALUES (1264, 75, 'MAN', 'Mana');
INSERT INTO zones VALUES (1265, 75, 'SAI', 'Saint-Laurent-Du-Maroni');
INSERT INTO zones VALUES (1266, 75, 'APA', 'Apatou');
INSERT INTO zones VALUES (1267, 75, 'GRA', 'Grand-Santi');
INSERT INTO zones VALUES (1268, 75, 'PAP', 'Papa&iuml;chton');
INSERT INTO zones VALUES (1269, 75, 'SAÜ', 'Saül');
INSERT INTO zones VALUES (1270, 75, 'MAR', 'Maripasoula');
INSERT INTO zones VALUES (1271, 75, 'CAM', 'Camopi');
INSERT INTO zones VALUES (1272, 75, 'SAI', 'Saint-Georges');
INSERT INTO zones VALUES (1273, 75, 'OUA', 'Ouanary');
INSERT INTO zones VALUES (1274, 75, 'R&Eacute;G', 'R&eacute;gina');
INSERT INTO zones VALUES (1275, 75, 'ROU', 'Roura');
INSERT INTO zones VALUES (1276, 75, 'SAI', 'Saint-&Eacute;lie');
INSERT INTO zones VALUES (1277, 75, 'IRA', 'Iracoubo');
INSERT INTO zones VALUES (1278, 75, 'SIN', 'Sinnamary');
INSERT INTO zones VALUES (1279, 75, 'KOU', 'Kourou');
INSERT INTO zones VALUES (1280, 75, 'MAC', 'Macouria');
INSERT INTO zones VALUES (1281, 75, 'MON', 'Montsin&eacute;ry-Tonnegrande');
INSERT INTO zones VALUES (1282, 75, 'MAT', 'Matoury');
INSERT INTO zones VALUES (1283, 75, 'CAY', 'Cayenne');
INSERT INTO zones VALUES (1284, 75, 'REM', 'Remire-Montjoly');
INSERT INTO zones VALUES (1285, 76, 'M', 'Archipel des Marquises');
INSERT INTO zones VALUES (1286, 76, 'T', 'Archipel des Tuamotu');
INSERT INTO zones VALUES (1287, 76, 'I', 'Archipel des Tubuai');
INSERT INTO zones VALUES (1288, 76, 'V', 'Iles du Vent');
INSERT INTO zones VALUES (1289, 76, 'S', 'Iles Sous-le-Vent');
INSERT INTO zones VALUES (1290, 77, 'C', 'Iles Crozet');
INSERT INTO zones VALUES (1291, 77, 'K', 'Iles Kerguelen');
INSERT INTO zones VALUES (1292, 77, 'A', 'Ile Amsterdam');
INSERT INTO zones VALUES (1293, 77, 'P', 'Ile Saint-Paul');
INSERT INTO zones VALUES (1294, 77, 'D', 'Adelie Land');
INSERT INTO zones VALUES (1295, 78, 'ES', 'Estuaire');
INSERT INTO zones VALUES (1296, 78, 'HO', 'Haut-Ogooue');
INSERT INTO zones VALUES (1297, 78, 'MO', 'Moyen-Ogooue');
INSERT INTO zones VALUES (1298, 78, 'NG', 'Ngounie');
INSERT INTO zones VALUES (1299, 78, 'NY', 'Nyanga');
INSERT INTO zones VALUES (1300, 78, 'OI', 'Ogooue-Ivindo');
INSERT INTO zones VALUES (1301, 78, 'OL', 'Ogooue-Lolo');
INSERT INTO zones VALUES (1302, 78, 'OM', 'Ogooue-Maritime');
INSERT INTO zones VALUES (1303, 78, 'WN', 'Woleu-Ntem');
INSERT INTO zones VALUES (1304, 79, 'BJ', 'Banjul');
INSERT INTO zones VALUES (1305, 79, 'BS', 'Basse');
INSERT INTO zones VALUES (1306, 79, 'BR', 'Brikama');
INSERT INTO zones VALUES (1307, 79, 'JA', 'Janjangbure');
INSERT INTO zones VALUES (1308, 79, 'KA', 'Kanifeng');
INSERT INTO zones VALUES (1309, 79, 'KE', 'Kerewan');
INSERT INTO zones VALUES (1310, 79, 'KU', 'Kuntaur');
INSERT INTO zones VALUES (1311, 79, 'MA', 'Mansakonko');
INSERT INTO zones VALUES (1312, 79, 'LR', 'Lower River');
INSERT INTO zones VALUES (1313, 79, 'CR', 'Central River');
INSERT INTO zones VALUES (1314, 79, 'NB', 'North Bank');
INSERT INTO zones VALUES (1315, 79, 'UR', 'Upper River');
INSERT INTO zones VALUES (1316, 79, 'WE', 'Western');
INSERT INTO zones VALUES (1317, 80, 'AB', 'Abkhazia');
INSERT INTO zones VALUES (1318, 80, 'AJ', 'Ajaria');
INSERT INTO zones VALUES (1319, 80, 'TB', 'Tbilisi');
INSERT INTO zones VALUES (1320, 80, 'GU', 'Guria');
INSERT INTO zones VALUES (1321, 80, 'IM', 'Imereti');
INSERT INTO zones VALUES (1322, 80, 'KA', 'Kakheti');
INSERT INTO zones VALUES (1323, 80, 'KK', 'Kvemo Kartli');
INSERT INTO zones VALUES (1324, 80, 'MM', 'Mtskheta-Mtianeti');
INSERT INTO zones VALUES (1325, 80, 'RL', 'Racha Lechkhumi and Kvemo Svanet');
INSERT INTO zones VALUES (1326, 80, 'SZ', 'Samegrelo-Zemo Svaneti');
INSERT INTO zones VALUES (1327, 80, 'SJ', 'Samtskhe-Javakheti');
INSERT INTO zones VALUES (1328, 80, 'SK', 'Shida Kartli');
INSERT INTO zones VALUES (1329, 81, 'BAW', 'Baden-Württemberg');
INSERT INTO zones VALUES (1330, 81, 'BAY', 'Bayern');
INSERT INTO zones VALUES (1331, 81, 'BER', 'Berlin');
INSERT INTO zones VALUES (1332, 81, 'BRG', 'Brandenburg');
INSERT INTO zones VALUES (1333, 81, 'BRE', 'Bremen');
INSERT INTO zones VALUES (1334, 81, 'HAM', 'Hamburg');
INSERT INTO zones VALUES (1335, 81, 'HES', 'Hessen');
INSERT INTO zones VALUES (1336, 81, 'MEC', 'Mecklenburg-Vorpommern');
INSERT INTO zones VALUES (1337, 81, 'NDS', 'Niedersachsen');
INSERT INTO zones VALUES (1338, 81, 'NRW', 'Nordrhein-Westfalen');
INSERT INTO zones VALUES (1339, 81, 'RHE', 'Rheinland-Pfalz');
INSERT INTO zones VALUES (1340, 81, 'SAR', 'Saarland');
INSERT INTO zones VALUES (1341, 81, 'SAS', 'Sachsen');
INSERT INTO zones VALUES (1342, 81, 'SAC', 'Sachsen-Anhalt');
INSERT INTO zones VALUES (1343, 81, 'SCN', 'Schleswig-Holstein');
INSERT INTO zones VALUES (1344, 81, 'THE', 'Th&uuml;ringen');
INSERT INTO zones VALUES (1345, 82, 'AS', 'Ashanti Region');
INSERT INTO zones VALUES (1346, 82, 'BA', 'Brong-Ahafo Region');
INSERT INTO zones VALUES (1347, 82, 'CE', 'Central Region');
INSERT INTO zones VALUES (1348, 82, 'EA', 'Eastern Region');
INSERT INTO zones VALUES (1349, 82, 'GA', 'Greater Accra Region');
INSERT INTO zones VALUES (1350, 82, 'NO', 'Northern Region');
INSERT INTO zones VALUES (1351, 82, 'UE', 'Upper East Region');
INSERT INTO zones VALUES (1352, 82, 'UW', 'Upper West Region');
INSERT INTO zones VALUES (1353, 82, 'VO', 'Volta Region');
INSERT INTO zones VALUES (1354, 82, 'WE', 'Western Region');
INSERT INTO zones VALUES (1355, 83, 'EAS', 'East Side');
INSERT INTO zones VALUES (1356, 83, 'NOR', 'North District');
INSERT INTO zones VALUES (1357, 83, 'REC', 'Reclamation Areas');
INSERT INTO zones VALUES (1358, 83, 'SAN', 'Sandpits Area');
INSERT INTO zones VALUES (1359, 83, 'SOU', 'South District');
INSERT INTO zones VALUES (1360, 83, 'TOW', 'Town Area');
INSERT INTO zones VALUES (1361, 83, 'UPP', 'Upper Town');
INSERT INTO zones VALUES (1362, 83, 'OTH', 'Other');
INSERT INTO zones VALUES (1363, 84, 'AT', 'Attica');
INSERT INTO zones VALUES (1364, 84, 'CN', 'Central Greece');
INSERT INTO zones VALUES (1365, 84, 'CM', 'Central Macedonia');
INSERT INTO zones VALUES (1366, 84, 'CR', 'Crete');
INSERT INTO zones VALUES (1367, 84, 'EM', 'East Macedonia and Thrace');
INSERT INTO zones VALUES (1368, 84, 'EP', 'Epirus');
INSERT INTO zones VALUES (1369, 84, 'II', 'Ionian Islands');
INSERT INTO zones VALUES (1370, 84, 'NA', 'North Aegean');
INSERT INTO zones VALUES (1371, 84, 'PP', 'Peloponnesos');
INSERT INTO zones VALUES (1372, 84, 'SA', 'South Aegean');
INSERT INTO zones VALUES (1373, 84, 'TH', 'Thessaly');
INSERT INTO zones VALUES (1374, 84, 'WG', 'West Greece');
INSERT INTO zones VALUES (1375, 84, 'WM', 'West Macedonia');
INSERT INTO zones VALUES (1376, 85, 'A', 'Avannaa');
INSERT INTO zones VALUES (1377, 85, 'T', 'Tunu');
INSERT INTO zones VALUES (1378, 85, 'K', 'Kitaa');
INSERT INTO zones VALUES (1379, 86, 'A', 'Saint Andrew');
INSERT INTO zones VALUES (1380, 86, 'D', 'Saint David');
INSERT INTO zones VALUES (1381, 86, 'G', 'Saint George');
INSERT INTO zones VALUES (1382, 86, 'J', 'Saint John');
INSERT INTO zones VALUES (1383, 86, 'M', 'Saint Mark');
INSERT INTO zones VALUES (1384, 86, 'P', 'Saint Patrick');
INSERT INTO zones VALUES (1385, 86, 'C', 'Carriacou');
INSERT INTO zones VALUES (1386, 86, 'Q', 'Petit Martinique');
INSERT INTO zones VALUES (1387, 87, 'ARR', 'Arrondissements Of The Guadeloup');
INSERT INTO zones VALUES (1388, 87, 'CAN', 'Cantons Of The Guadeloupe Depart');
INSERT INTO zones VALUES (1389, 87, 'COM', 'Communes Of The Guadeloupe Depar');
INSERT INTO zones VALUES (1390, 88, 'AGA', 'Agana Heights');
INSERT INTO zones VALUES (1391, 88, 'AGA', 'Agat');
INSERT INTO zones VALUES (1392, 88, 'ASA', 'Asan Maina');
INSERT INTO zones VALUES (1393, 88, 'BAR', 'Barrigada');
INSERT INTO zones VALUES (1394, 88, 'CHA', 'Chalan Pago Ordot');
INSERT INTO zones VALUES (1395, 88, 'DED', 'Dededo');
INSERT INTO zones VALUES (1396, 88, 'HAG', 'Hag&aring;t&ntilde;a');
INSERT INTO zones VALUES (1397, 88, 'INA', 'Inarajan');
INSERT INTO zones VALUES (1398, 88, 'MAN', 'Mangilao');
INSERT INTO zones VALUES (1399, 88, 'MER', 'Merizo');
INSERT INTO zones VALUES (1400, 88, 'MON', 'Mongmong Toto Maite');
INSERT INTO zones VALUES (1401, 88, 'PIT', 'Piti');
INSERT INTO zones VALUES (1402, 88, 'SAN', 'Santa Rita');
INSERT INTO zones VALUES (1403, 88, 'SIN', 'Sinajana');
INSERT INTO zones VALUES (1404, 88, 'TAL', 'Talofofo');
INSERT INTO zones VALUES (1405, 88, 'TAM', 'Tamuning');
INSERT INTO zones VALUES (1406, 88, 'UMA', 'Umatac');
INSERT INTO zones VALUES (1407, 88, 'YIG', 'Yigo');
INSERT INTO zones VALUES (1408, 88, 'YON', 'Yona');
INSERT INTO zones VALUES (1409, 89, 'AV', 'Alta Verapaz');
INSERT INTO zones VALUES (1410, 89, 'BV', 'Baja Verapaz');
INSERT INTO zones VALUES (1411, 89, 'CM', 'Chimaltenango');
INSERT INTO zones VALUES (1412, 89, 'CQ', 'Chiquimula');
INSERT INTO zones VALUES (1413, 89, 'PE', 'El Peten');
INSERT INTO zones VALUES (1414, 89, 'PR', 'El Progreso');
INSERT INTO zones VALUES (1415, 89, 'QC', 'El Quiche');
INSERT INTO zones VALUES (1416, 89, 'ES', 'Escuintla');
INSERT INTO zones VALUES (1417, 89, 'GU', 'Guatemala');
INSERT INTO zones VALUES (1418, 89, 'HU', 'Huehuetenango');
INSERT INTO zones VALUES (1419, 89, 'IZ', 'Izabal');
INSERT INTO zones VALUES (1420, 89, 'JA', 'Jalapa');
INSERT INTO zones VALUES (1421, 89, 'JU', 'Jutiapa');
INSERT INTO zones VALUES (1422, 89, 'QZ', 'Quetzaltenango');
INSERT INTO zones VALUES (1423, 89, 'RE', 'Retalhuleu');
INSERT INTO zones VALUES (1424, 89, 'ST', 'Sacatepequez');
INSERT INTO zones VALUES (1425, 89, 'SM', 'San Marcos');
INSERT INTO zones VALUES (1426, 89, 'SR', 'Santa Rosa');
INSERT INTO zones VALUES (1427, 89, 'SO', 'Solola');
INSERT INTO zones VALUES (1428, 89, 'SU', 'Suchitepequez');
INSERT INTO zones VALUES (1429, 89, 'TO', 'Totonicapan');
INSERT INTO zones VALUES (1430, 89, 'ZA', 'Zacapa');
INSERT INTO zones VALUES (1431, 90, 'CNK', 'Conakry');
INSERT INTO zones VALUES (1432, 90, 'BYL', 'Beyla');
INSERT INTO zones VALUES (1433, 90, 'BFA', 'Boffa');
INSERT INTO zones VALUES (1434, 90, 'BOK', 'Boke');
INSERT INTO zones VALUES (1435, 90, 'COY', 'Coyah');
INSERT INTO zones VALUES (1436, 90, 'DBL', 'Dabola');
INSERT INTO zones VALUES (1437, 90, 'DLB', 'Dalaba');
INSERT INTO zones VALUES (1438, 90, 'DGR', 'Dinguiraye');
INSERT INTO zones VALUES (1439, 90, 'DBR', 'Dubreka');
INSERT INTO zones VALUES (1440, 90, 'FRN', 'Faranah');
INSERT INTO zones VALUES (1441, 90, 'FRC', 'Forecariah');
INSERT INTO zones VALUES (1442, 90, 'FRI', 'Fria');
INSERT INTO zones VALUES (1443, 90, 'GAO', 'Gaoual');
INSERT INTO zones VALUES (1444, 90, 'GCD', 'Gueckedou');
INSERT INTO zones VALUES (1445, 90, 'KNK', 'Kankan');
INSERT INTO zones VALUES (1446, 90, 'KRN', 'Kerouane');
INSERT INTO zones VALUES (1447, 90, 'KND', 'Kindia');
INSERT INTO zones VALUES (1448, 90, 'KSD', 'Kissidougou');
INSERT INTO zones VALUES (1449, 90, 'KBA', 'Koubia');
INSERT INTO zones VALUES (1450, 90, 'KDA', 'Koundara');
INSERT INTO zones VALUES (1451, 90, 'KRA', 'Kouroussa');
INSERT INTO zones VALUES (1452, 90, 'LAB', 'Labe');
INSERT INTO zones VALUES (1453, 90, 'LLM', 'Lelouma');
INSERT INTO zones VALUES (1454, 90, 'LOL', 'Lola');
INSERT INTO zones VALUES (1455, 90, 'MCT', 'Macenta');
INSERT INTO zones VALUES (1456, 90, 'MAL', 'Mali');
INSERT INTO zones VALUES (1457, 90, 'MAM', 'Mamou');
INSERT INTO zones VALUES (1458, 90, 'MAN', 'Mandiana');
INSERT INTO zones VALUES (1459, 90, 'NZR', 'Nzerekore');
INSERT INTO zones VALUES (1460, 90, 'PIT', 'Pita');
INSERT INTO zones VALUES (1461, 90, 'SIG', 'Siguiri');
INSERT INTO zones VALUES (1462, 90, 'TLM', 'Telimele');
INSERT INTO zones VALUES (1463, 90, 'TOG', 'Tougue');
INSERT INTO zones VALUES (1464, 90, 'YOM', 'Yomou');
INSERT INTO zones VALUES (1465, 91, 'BF', 'Bafata Region');
INSERT INTO zones VALUES (1466, 91, 'BB', 'Biombo Region');
INSERT INTO zones VALUES (1467, 91, 'BS', 'Bissau Region');
INSERT INTO zones VALUES (1468, 91, 'BL', 'Bolama Region');
INSERT INTO zones VALUES (1469, 91, 'CA', 'Cacheu Region');
INSERT INTO zones VALUES (1470, 91, 'GA', 'Gabu Region');
INSERT INTO zones VALUES (1471, 91, 'OI', 'Oio Region');
INSERT INTO zones VALUES (1472, 91, 'QU', 'Quinara Region');
INSERT INTO zones VALUES (1473, 91, 'TO', 'Tombali Region');
INSERT INTO zones VALUES (1474, 92, 'BW', 'Barima-Waini');
INSERT INTO zones VALUES (1475, 92, 'CM', 'Cuyuni-Mazaruni');
INSERT INTO zones VALUES (1476, 92, 'DM', 'Demerara-Mahaica');
INSERT INTO zones VALUES (1477, 92, 'EC', 'East Berbice-Corentyne');
INSERT INTO zones VALUES (1478, 92, 'EW', 'Essequibo Islands-West Demerara');
INSERT INTO zones VALUES (1479, 92, 'MB', 'Mahaica-Berbice');
INSERT INTO zones VALUES (1480, 92, 'PM', 'Pomeroon-Supenaam');
INSERT INTO zones VALUES (1481, 92, 'PI', 'Potaro-Siparuni');
INSERT INTO zones VALUES (1482, 92, 'UD', 'Upper Demerara-Berbice');
INSERT INTO zones VALUES (1483, 92, 'UT', 'Upper Takutu-Upper Essequibo');
INSERT INTO zones VALUES (1484, 93, 'AR', 'Artibonite');
INSERT INTO zones VALUES (1485, 93, 'CE', 'Centre');
INSERT INTO zones VALUES (1486, 93, 'GA', 'Grand''Anse');
INSERT INTO zones VALUES (1487, 93, 'ND', 'Nord');
INSERT INTO zones VALUES (1488, 93, 'NE', 'Nord-Est');
INSERT INTO zones VALUES (1489, 93, 'NO', 'Nord-Ouest');
INSERT INTO zones VALUES (1490, 93, 'OU', 'Ouest');
INSERT INTO zones VALUES (1491, 93, 'SD', 'Sud');
INSERT INTO zones VALUES (1492, 93, 'SE', 'Sud-Est');
INSERT INTO zones VALUES (1493, 94, 'F', 'Flat Island');
INSERT INTO zones VALUES (1494, 94, 'M', 'McDonald Island');
INSERT INTO zones VALUES (1495, 94, 'S', 'Shag Island');
INSERT INTO zones VALUES (1496, 94, 'H', 'Heard Island');
INSERT INTO zones VALUES (1497, 95, 'AT', 'Atlantida');
INSERT INTO zones VALUES (1498, 95, 'CH', 'Choluteca');
INSERT INTO zones VALUES (1499, 95, 'CL', 'Colon');
INSERT INTO zones VALUES (1500, 95, 'CM', 'Comayagua');
INSERT INTO zones VALUES (1501, 95, 'CP', 'Copan');
INSERT INTO zones VALUES (1502, 95, 'CR', 'Cortes');
INSERT INTO zones VALUES (1503, 95, 'PA', 'El Paraiso');
INSERT INTO zones VALUES (1504, 95, 'FM', 'Francisco Morazan');
INSERT INTO zones VALUES (1505, 95, 'GD', 'Gracias a Dios');
INSERT INTO zones VALUES (1506, 95, 'IN', 'Intibuca');
INSERT INTO zones VALUES (1507, 95, 'IB', 'Islas de la Bahia (Bay Islands)');
INSERT INTO zones VALUES (1508, 95, 'PZ', 'La Paz');
INSERT INTO zones VALUES (1509, 95, 'LE', 'Lempira');
INSERT INTO zones VALUES (1510, 95, 'OC', 'Ocotepeque');
INSERT INTO zones VALUES (1511, 95, 'OL', 'Olancho');
INSERT INTO zones VALUES (1512, 95, 'SB', 'Santa Barbara');
INSERT INTO zones VALUES (1513, 95, 'VA', 'Valle');
INSERT INTO zones VALUES (1514, 95, 'YO', 'Yoro');
INSERT INTO zones VALUES (1515, 96, 'HCW', 'Central and Western Hong Kong Is');
INSERT INTO zones VALUES (1516, 96, 'HEA', 'Eastern Hong Kong Island');
INSERT INTO zones VALUES (1517, 96, 'HSO', 'Southern Hong Kong Island');
INSERT INTO zones VALUES (1518, 96, 'HWC', 'Wan Chai Hong Kong Island');
INSERT INTO zones VALUES (1519, 96, 'KKC', 'Kowloon City Kowloon');
INSERT INTO zones VALUES (1520, 96, 'KKT', 'Kwun Tong Kowloon');
INSERT INTO zones VALUES (1521, 96, 'KSS', 'Sham Shui Po Kowloon');
INSERT INTO zones VALUES (1522, 96, 'KWT', 'Wong Tai Sin Kowloon');
INSERT INTO zones VALUES (1523, 96, 'KYT', 'Yau Tsim Mong Kowloon');
INSERT INTO zones VALUES (1524, 96, 'NIS', 'Islands New Territories');
INSERT INTO zones VALUES (1525, 96, 'NKT', 'Kwai Tsing New Territories');
INSERT INTO zones VALUES (1526, 96, 'NNO', 'North New Territories');
INSERT INTO zones VALUES (1527, 96, 'NSK', 'Sai Kung New Territories');
INSERT INTO zones VALUES (1528, 96, 'NST', 'Sha Tin New Territories');
INSERT INTO zones VALUES (1529, 96, 'NTP', 'Tai Po New Territories');
INSERT INTO zones VALUES (1530, 96, 'NTW', 'Tsuen Wan New Territories');
INSERT INTO zones VALUES (1531, 96, 'NTM', 'Tuen Mun New Territories');
INSERT INTO zones VALUES (1532, 96, 'NYL', 'Yuen Long New Territories');
INSERT INTO zones VALUES (1533, 97, 'BK', 'Bacs-Kiskun');
INSERT INTO zones VALUES (1534, 97, 'BA', 'Baranya');
INSERT INTO zones VALUES (1535, 97, 'BE', 'Bekes');
INSERT INTO zones VALUES (1536, 97, 'BS', 'Bekescsaba');
INSERT INTO zones VALUES (1537, 97, 'BZ', 'Borsod-Abauj-Zemplen');
INSERT INTO zones VALUES (1538, 97, 'BU', 'Budapest');
INSERT INTO zones VALUES (1539, 97, 'CS', 'Csongrad');
INSERT INTO zones VALUES (1540, 97, 'DE', 'Debrecen');
INSERT INTO zones VALUES (1541, 97, 'DU', 'Dunaujvaros');
INSERT INTO zones VALUES (1542, 97, 'EG', 'Eger');
INSERT INTO zones VALUES (1543, 97, 'FE', 'Fejer');
INSERT INTO zones VALUES (1544, 97, 'GY', 'Gyor');
INSERT INTO zones VALUES (1545, 97, 'GM', 'Gyor-Moson-Sopron');
INSERT INTO zones VALUES (1546, 97, 'HB', 'Hajdu-Bihar');
INSERT INTO zones VALUES (1547, 97, 'HE', 'Heves');
INSERT INTO zones VALUES (1548, 97, 'HO', 'Hodmezovasarhely');
INSERT INTO zones VALUES (1549, 97, 'JN', 'Jasz-Nagykun-Szolnok');
INSERT INTO zones VALUES (1550, 97, 'KA', 'Kaposvar');
INSERT INTO zones VALUES (1551, 97, 'KE', 'Kecskemet');
INSERT INTO zones VALUES (1552, 97, 'KO', 'Komarom-Esztergom');
INSERT INTO zones VALUES (1553, 97, 'MI', 'Miskolc');
INSERT INTO zones VALUES (1554, 97, 'NA', 'Nagykanizsa');
INSERT INTO zones VALUES (1555, 97, 'NO', 'Nograd');
INSERT INTO zones VALUES (1556, 97, 'NY', 'Nyiregyhaza');
INSERT INTO zones VALUES (1557, 97, 'PE', 'Pecs');
INSERT INTO zones VALUES (1558, 97, 'PS', 'Pest');
INSERT INTO zones VALUES (1559, 97, 'SO', 'Somogy');
INSERT INTO zones VALUES (1560, 97, 'SP', 'Sopron');
INSERT INTO zones VALUES (1561, 97, 'SS', 'Szabolcs-Szatmar-Bereg');
INSERT INTO zones VALUES (1562, 97, 'SZ', 'Szeged');
INSERT INTO zones VALUES (1563, 97, 'SE', 'Szekesfehervar');
INSERT INTO zones VALUES (1564, 97, 'SL', 'Szolnok');
INSERT INTO zones VALUES (1565, 97, 'SM', 'Szombathely');
INSERT INTO zones VALUES (1566, 97, 'TA', 'Tatabanya');
INSERT INTO zones VALUES (1567, 97, 'TO', 'Tolna');
INSERT INTO zones VALUES (1568, 97, 'VA', 'Vas');
INSERT INTO zones VALUES (1569, 97, 'VE', 'Veszprem');
INSERT INTO zones VALUES (1570, 97, 'ZA', 'Zala');
INSERT INTO zones VALUES (1571, 97, 'ZZ', 'Zalaegerszeg');
INSERT INTO zones VALUES (1572, 98, 'AL', 'Austurland');
INSERT INTO zones VALUES (1573, 98, 'HF', 'Hofuoborgarsvaeoi');
INSERT INTO zones VALUES (1574, 98, 'NE', 'Norourland eystra');
INSERT INTO zones VALUES (1575, 98, 'NV', 'Norourland vestra');
INSERT INTO zones VALUES (1576, 98, 'SL', 'Suourland');
INSERT INTO zones VALUES (1577, 98, 'SN', 'Suournes');
INSERT INTO zones VALUES (1578, 98, 'VF', 'Vestfiroir');
INSERT INTO zones VALUES (1579, 98, 'VL', 'Vesturland');
INSERT INTO zones VALUES (1580, 99, 'AN', 'Andaman and Nicobar Islands');
INSERT INTO zones VALUES (1581, 99, 'AP', 'Andhra Pradesh');
INSERT INTO zones VALUES (1582, 99, 'AR', 'Arunachal Pradesh');
INSERT INTO zones VALUES (1583, 99, 'AS', 'Assam');
INSERT INTO zones VALUES (1584, 99, 'BI', 'Bihar');
INSERT INTO zones VALUES (1585, 99, 'CH', 'Chandigarh');
INSERT INTO zones VALUES (1586, 99, 'DA', 'Dadra and Nagar Haveli');
INSERT INTO zones VALUES (1587, 99, 'DM', 'Daman and Diu');
INSERT INTO zones VALUES (1588, 99, 'DE', 'Delhi');
INSERT INTO zones VALUES (1589, 99, 'GO', 'Goa');
INSERT INTO zones VALUES (1590, 99, 'GU', 'Gujarat');
INSERT INTO zones VALUES (1591, 99, 'HA', 'Haryana');
INSERT INTO zones VALUES (1592, 99, 'HP', 'Himachal Pradesh');
INSERT INTO zones VALUES (1593, 99, 'JA', 'Jammu and Kashmir');
INSERT INTO zones VALUES (1594, 99, 'KA', 'Karnataka');
INSERT INTO zones VALUES (1595, 99, 'KE', 'Kerala');
INSERT INTO zones VALUES (1596, 99, 'LI', 'Lakshadweep Islands');
INSERT INTO zones VALUES (1597, 99, 'MP', 'Madhya Pradesh');
INSERT INTO zones VALUES (1598, 99, 'MA', 'Maharashtra');
INSERT INTO zones VALUES (1599, 99, 'MN', 'Manipur');
INSERT INTO zones VALUES (1600, 99, 'ME', 'Meghalaya');
INSERT INTO zones VALUES (1601, 99, 'MI', 'Mizoram');
INSERT INTO zones VALUES (1602, 99, 'NA', 'Nagaland');
INSERT INTO zones VALUES (1603, 99, 'OR', 'Orissa');
INSERT INTO zones VALUES (1604, 99, 'PO', 'Pondicherry');
INSERT INTO zones VALUES (1605, 99, 'PU', 'Punjab');
INSERT INTO zones VALUES (1606, 99, 'RA', 'Rajasthan');
INSERT INTO zones VALUES (1607, 99, 'SI', 'Sikkim');
INSERT INTO zones VALUES (1608, 99, 'TN', 'Tamil Nadu');
INSERT INTO zones VALUES (1609, 99, 'TR', 'Tripura');
INSERT INTO zones VALUES (1610, 99, 'UP', 'Uttar Pradesh');
INSERT INTO zones VALUES (1611, 99, 'WB', 'West Bengal');
INSERT INTO zones VALUES (1612, 100, 'DA', 'Daista Aceh');
INSERT INTO zones VALUES (1613, 100, 'SU', 'Sumatera Utara');
INSERT INTO zones VALUES (1614, 100, 'SB', 'Sumatera Barat');
INSERT INTO zones VALUES (1615, 100, 'SI', 'Riau');
INSERT INTO zones VALUES (1616, 100, 'JA', 'Jambi');
INSERT INTO zones VALUES (1617, 100, 'SS', 'Sumatera Selatan');
INSERT INTO zones VALUES (1618, 100, 'BE', 'Bengkulu');
INSERT INTO zones VALUES (1619, 100, 'LA', 'Lampung');
INSERT INTO zones VALUES (1620, 100, 'JK', 'Dki Jakarta');
INSERT INTO zones VALUES (1621, 100, 'JB', 'Jawa Barat');
INSERT INTO zones VALUES (1622, 100, 'JT', 'Jawa Tengah');
INSERT INTO zones VALUES (1623, 100, 'DY', 'Daista Yogyakarta');
INSERT INTO zones VALUES (1624, 100, 'JT', 'Jawa Timur');
INSERT INTO zones VALUES (1625, 100, 'KB', 'Kalimantan Barat');
INSERT INTO zones VALUES (1626, 100, 'KT', 'Kalimantan Tengah');
INSERT INTO zones VALUES (1627, 100, 'KI', 'Kalimantan Timur');
INSERT INTO zones VALUES (1628, 100, 'KS', 'Kalimantan Selatan');
INSERT INTO zones VALUES (1629, 100, 'BA', 'Bali');
INSERT INTO zones VALUES (1630, 100, 'NB', 'Nusa Tenggara Barat');
INSERT INTO zones VALUES (1631, 100, 'NT', 'Nusa Tenggara Timur');
INSERT INTO zones VALUES (1632, 100, 'SN', 'Sulawesi Selatan');
INSERT INTO zones VALUES (1633, 100, 'ST', 'Sulawesi Tengah');
INSERT INTO zones VALUES (1634, 100, 'SA', 'Sulawesi Utara');
INSERT INTO zones VALUES (1635, 100, 'SG', 'Sulawesi Tenggara');
INSERT INTO zones VALUES (1636, 100, 'MA', 'Maluku');
INSERT INTO zones VALUES (1637, 100, 'MU', 'Maluku Utara');
INSERT INTO zones VALUES (1638, 100, 'IJ', 'Irian Jaya Timur');
INSERT INTO zones VALUES (1639, 100, 'IT', 'Irian Jaya Tengah');
INSERT INTO zones VALUES (1640, 100, 'IB', 'Irian Jawa Barat');
INSERT INTO zones VALUES (1641, 100, 'BT', 'Banten');
INSERT INTO zones VALUES (1642, 100, 'BB', 'Bangka Belitung');
INSERT INTO zones VALUES (1643, 100, 'GO', 'Gorontalo');
INSERT INTO zones VALUES (1644, 101, 'TEH', 'Tehran');
INSERT INTO zones VALUES (1645, 101, 'QOM', 'Qom');
INSERT INTO zones VALUES (1646, 101, 'MKZ', 'Markazi');
INSERT INTO zones VALUES (1647, 101, 'QAZ', 'Qazvin');
INSERT INTO zones VALUES (1648, 101, 'GIL', 'Gilan');
INSERT INTO zones VALUES (1649, 101, 'ARD', 'Ardabil');
INSERT INTO zones VALUES (1650, 101, 'ZAN', 'Zanjan');
INSERT INTO zones VALUES (1651, 101, 'EAZ', 'East Azarbaijan');
INSERT INTO zones VALUES (1652, 101, 'WEZ', 'West Azarbaijan');
INSERT INTO zones VALUES (1653, 101, 'KRD', 'Kurdistan');
INSERT INTO zones VALUES (1654, 101, 'HMD', 'Hamadan');
INSERT INTO zones VALUES (1655, 101, 'KRM', 'Kermanshah');
INSERT INTO zones VALUES (1656, 101, 'ILM', 'Ilam');
INSERT INTO zones VALUES (1657, 101, 'LRS', 'Lorestan');
INSERT INTO zones VALUES (1658, 101, 'KZT', 'Khuzestan');
INSERT INTO zones VALUES (1659, 101, 'CMB', 'Chahar Mahaal and Bakhtiari');
INSERT INTO zones VALUES (1660, 101, 'KBA', 'Kohkiluyeh and Buyer Ahmad');
INSERT INTO zones VALUES (1661, 101, 'BSH', 'Bushehr');
INSERT INTO zones VALUES (1662, 101, 'FAR', 'Fars');
INSERT INTO zones VALUES (1663, 101, 'HRM', 'Hormozgan');
INSERT INTO zones VALUES (1664, 101, 'SBL', 'Sistan and Baluchistan');
INSERT INTO zones VALUES (1665, 101, 'KRB', 'Kerman');
INSERT INTO zones VALUES (1666, 101, 'YZD', 'Yazd');
INSERT INTO zones VALUES (1667, 101, 'EFH', 'Esfahan');
INSERT INTO zones VALUES (1668, 101, 'SMN', 'Semnan');
INSERT INTO zones VALUES (1669, 101, 'MZD', 'Mazandaran');
INSERT INTO zones VALUES (1670, 101, 'GLS', 'Golestan');
INSERT INTO zones VALUES (1671, 101, 'NKH', 'North Khorasan');
INSERT INTO zones VALUES (1672, 101, 'RKH', 'Razavi Khorasan');
INSERT INTO zones VALUES (1673, 101, 'SKH', 'South Khorasan');
INSERT INTO zones VALUES (1674, 102, 'BD', 'Baghdad');
INSERT INTO zones VALUES (1675, 102, 'SD', 'Salah ad Din');
INSERT INTO zones VALUES (1676, 102, 'DY', 'Diyala');
INSERT INTO zones VALUES (1677, 102, 'WS', 'Wasit');
INSERT INTO zones VALUES (1678, 102, 'MY', 'Maysan');
INSERT INTO zones VALUES (1679, 102, 'BA', 'Al Basrah');
INSERT INTO zones VALUES (1680, 102, 'DQ', 'Dhi Qar');
INSERT INTO zones VALUES (1681, 102, 'MU', 'Al Muthanna');
INSERT INTO zones VALUES (1682, 102, 'QA', 'Al Qadisyah');
INSERT INTO zones VALUES (1683, 102, 'BB', 'Babil');
INSERT INTO zones VALUES (1684, 102, 'KB', 'Al Karbala');
INSERT INTO zones VALUES (1685, 102, 'NJ', 'An Najaf');
INSERT INTO zones VALUES (1686, 102, 'AB', 'Al Anbar');
INSERT INTO zones VALUES (1687, 102, 'NN', 'Ninawa');
INSERT INTO zones VALUES (1688, 102, 'DH', 'Dahuk');
INSERT INTO zones VALUES (1689, 102, 'AL', 'Arbil');
INSERT INTO zones VALUES (1690, 102, 'TM', 'At Ta''mim');
INSERT INTO zones VALUES (1691, 102, 'SL', 'As Sulaymaniyah');
INSERT INTO zones VALUES (1692, 103, 'CA', 'Carlow');
INSERT INTO zones VALUES (1693, 103, 'CV', 'Cavan');
INSERT INTO zones VALUES (1694, 103, 'CL', 'Clare');
INSERT INTO zones VALUES (1695, 103, 'CO', 'Cork');
INSERT INTO zones VALUES (1696, 103, 'DO', 'Donegal');
INSERT INTO zones VALUES (1697, 103, 'DU', 'Dublin');
INSERT INTO zones VALUES (1698, 103, 'GA', 'Galway');
INSERT INTO zones VALUES (1699, 103, 'KE', 'Kerry');
INSERT INTO zones VALUES (1700, 103, 'KI', 'Kildare');
INSERT INTO zones VALUES (1701, 103, 'KL', 'Kilkenny');
INSERT INTO zones VALUES (1702, 103, 'LA', 'Laois');
INSERT INTO zones VALUES (1703, 103, 'LE', 'Leitrim');
INSERT INTO zones VALUES (1704, 103, 'LI', 'Limerick');
INSERT INTO zones VALUES (1705, 103, 'LO', 'Longford');
INSERT INTO zones VALUES (1706, 103, 'LU', 'Louth');
INSERT INTO zones VALUES (1707, 103, 'MA', 'Mayo');
INSERT INTO zones VALUES (1708, 103, 'ME', 'Meath');
INSERT INTO zones VALUES (1709, 103, 'MO', 'Monaghan');
INSERT INTO zones VALUES (1710, 103, 'OF', 'Offaly');
INSERT INTO zones VALUES (1711, 103, 'RO', 'Roscommon');
INSERT INTO zones VALUES (1712, 103, 'SL', 'Sligo');
INSERT INTO zones VALUES (1713, 103, 'TI', 'Tipperary');
INSERT INTO zones VALUES (1714, 103, 'WA', 'Waterford');
INSERT INTO zones VALUES (1715, 103, 'WE', 'Westmeath');
INSERT INTO zones VALUES (1716, 103, 'WX', 'Wexford');
INSERT INTO zones VALUES (1717, 103, 'WI', 'Wicklow');
INSERT INTO zones VALUES (1718, 104, 'BS', 'Be''er Sheva');
INSERT INTO zones VALUES (1719, 104, 'BH', 'Bika''at Hayarden');
INSERT INTO zones VALUES (1720, 104, 'EA', 'Eilat and Arava');
INSERT INTO zones VALUES (1721, 104, 'GA', 'Galil');
INSERT INTO zones VALUES (1722, 104, 'HA', 'Haifa');
INSERT INTO zones VALUES (1723, 104, 'JM', 'Jehuda Mountains');
INSERT INTO zones VALUES (1724, 104, 'JE', 'Jerusalem');
INSERT INTO zones VALUES (1725, 104, 'NE', 'Negev');
INSERT INTO zones VALUES (1726, 104, 'SE', 'Semaria');
INSERT INTO zones VALUES (1727, 104, 'SH', 'Sharon');
INSERT INTO zones VALUES (1728, 104, 'TA', 'Tel Aviv (Gosh Dan)');
INSERT INTO zones VALUES (1729, 105, 'AG', 'Agrigento');
INSERT INTO zones VALUES (1730, 105, 'AL', 'Alessandria');
INSERT INTO zones VALUES (1731, 105, 'AN', 'Ancona');
INSERT INTO zones VALUES (1732, 105, 'AO', 'Aosta');
INSERT INTO zones VALUES (1733, 105, 'AR', 'Arezzo');
INSERT INTO zones VALUES (1734, 105, 'AP', 'Ascoli Piceno');
INSERT INTO zones VALUES (1735, 105, 'AT', 'Asti');
INSERT INTO zones VALUES (1736, 105, 'AV', 'Avellino');
INSERT INTO zones VALUES (1737, 105, 'BA', 'Bari');
INSERT INTO zones VALUES (1738, 105, 'BL', 'Belluno');
INSERT INTO zones VALUES (1739, 105, 'BN', 'Benevento');
INSERT INTO zones VALUES (1740, 105, 'BG', 'Bergamo');
INSERT INTO zones VALUES (1741, 105, 'BI', 'Biella');
INSERT INTO zones VALUES (1742, 105, 'BO', 'Bologna');
INSERT INTO zones VALUES (1743, 105, 'BZ', 'Bolzano');
INSERT INTO zones VALUES (1744, 105, 'BS', 'Brescia');
INSERT INTO zones VALUES (1745, 105, 'BR', 'Brindisi');
INSERT INTO zones VALUES (1746, 105, 'CA', 'Cagliari');
INSERT INTO zones VALUES (1747, 105, 'CL', 'Caltanissetta');
INSERT INTO zones VALUES (1748, 105, 'CB', 'Campobasso');
INSERT INTO zones VALUES (1749, 105, 'CE', 'Caserta');
INSERT INTO zones VALUES (1750, 105, 'CT', 'Catania');
INSERT INTO zones VALUES (1751, 105, 'CZ', 'Catanzaro');
INSERT INTO zones VALUES (1752, 105, 'CH', 'Chieti');
INSERT INTO zones VALUES (1753, 105, 'CO', 'Como');
INSERT INTO zones VALUES (1754, 105, 'CS', 'Cosenza');
INSERT INTO zones VALUES (1755, 105, 'CR', 'Cremona');
INSERT INTO zones VALUES (1756, 105, 'KR', 'Crotone');
INSERT INTO zones VALUES (1757, 105, 'CN', 'Cuneo');
INSERT INTO zones VALUES (1758, 105, 'EN', 'Enna');
INSERT INTO zones VALUES (1759, 105, 'FE', 'Ferrara');
INSERT INTO zones VALUES (1760, 105, 'FI', 'Firenze');
INSERT INTO zones VALUES (1761, 105, 'FG', 'Foggia');
INSERT INTO zones VALUES (1762, 105, 'FO', 'Forlì');
INSERT INTO zones VALUES (1763, 105, 'FR', 'Frosinone');
INSERT INTO zones VALUES (1764, 105, 'GE', 'Genova');
INSERT INTO zones VALUES (1765, 105, 'GO', 'Gorizia');
INSERT INTO zones VALUES (1766, 105, 'GR', 'Grosseto');
INSERT INTO zones VALUES (1767, 105, 'IM', 'Imperia');
INSERT INTO zones VALUES (1768, 105, 'IS', 'Isernia');
INSERT INTO zones VALUES (1769, 105, 'AQ', 'Aquila');
INSERT INTO zones VALUES (1770, 105, 'SP', 'La Spezia');
INSERT INTO zones VALUES (1771, 105, 'LT', 'Latina');
INSERT INTO zones VALUES (1772, 105, 'LE', 'Lecce');
INSERT INTO zones VALUES (1773, 105, 'LC', 'Lecco');
INSERT INTO zones VALUES (1774, 105, 'LI', 'Livorno');
INSERT INTO zones VALUES (1775, 105, 'LO', 'Lodi');
INSERT INTO zones VALUES (1776, 105, 'LU', 'Lucca');
INSERT INTO zones VALUES (1777, 105, 'MC', 'Macerata');
INSERT INTO zones VALUES (1778, 105, 'MN', 'Mantova');
INSERT INTO zones VALUES (1779, 105, 'MS', 'Massa-Carrara');
INSERT INTO zones VALUES (1780, 105, 'MT', 'Matera');
INSERT INTO zones VALUES (1781, 105, 'ME', 'Messina');
INSERT INTO zones VALUES (1782, 105, 'MI', 'Milano');
INSERT INTO zones VALUES (1783, 105, 'MO', 'Modena');
INSERT INTO zones VALUES (1784, 105, 'NA', 'Napoli');
INSERT INTO zones VALUES (1785, 105, 'NO', 'Novara');
INSERT INTO zones VALUES (1786, 105, 'NU', 'Nuoro');
INSERT INTO zones VALUES (1787, 105, 'OR', 'Oristano');
INSERT INTO zones VALUES (1788, 105, 'PD', 'Padova');
INSERT INTO zones VALUES (1789, 105, 'PA', 'Palermo');
INSERT INTO zones VALUES (1790, 105, 'PR', 'Parma');
INSERT INTO zones VALUES (1791, 105, 'PG', 'Perugia');
INSERT INTO zones VALUES (1792, 105, 'PV', 'Pavia');
INSERT INTO zones VALUES (1793, 105, 'PU', 'Pesaro Urbino');
INSERT INTO zones VALUES (1794, 105, 'PE', 'Pescara');
INSERT INTO zones VALUES (1795, 105, 'PC', 'Piacenza');
INSERT INTO zones VALUES (1796, 105, 'PI', 'Pisa');
INSERT INTO zones VALUES (1797, 105, 'PT', 'Pistoia');
INSERT INTO zones VALUES (1798, 105, 'PN', 'Pordenone');
INSERT INTO zones VALUES (1799, 105, 'PZ', 'Potenza');
INSERT INTO zones VALUES (1800, 105, 'PO', 'Prato');
INSERT INTO zones VALUES (1801, 105, 'RG', 'Ragusa');
INSERT INTO zones VALUES (1802, 105, 'RA', 'Ravenna');
INSERT INTO zones VALUES (1803, 105, 'RC', 'Reggio Calabria');
INSERT INTO zones VALUES (1804, 105, 'RE', 'Reggio Emilia');
INSERT INTO zones VALUES (1805, 105, 'RI', 'Rieti');
INSERT INTO zones VALUES (1806, 105, 'RN', 'Rimini');
INSERT INTO zones VALUES (1807, 105, 'RM', 'Roma');
INSERT INTO zones VALUES (1808, 105, 'RO', 'Rovigo');
INSERT INTO zones VALUES (1809, 105, 'SA', 'Salerno');
INSERT INTO zones VALUES (1810, 105, 'SS', 'Sassari');
INSERT INTO zones VALUES (1811, 105, 'SV', 'Savona');
INSERT INTO zones VALUES (1812, 105, 'SI', 'Siena');
INSERT INTO zones VALUES (1813, 105, 'SR', 'Siracusa');
INSERT INTO zones VALUES (1814, 105, 'SO', 'Sondrio');
INSERT INTO zones VALUES (1815, 105, 'TA', 'Taranto');
INSERT INTO zones VALUES (1816, 105, 'TE', 'Teramo');
INSERT INTO zones VALUES (1817, 105, 'TR', 'Terni');
INSERT INTO zones VALUES (1818, 105, 'TO', 'Torino');
INSERT INTO zones VALUES (1819, 105, 'TP', 'Trapani');
INSERT INTO zones VALUES (1820, 105, 'TN', 'Trento');
INSERT INTO zones VALUES (1821, 105, 'TV', 'Treviso');
INSERT INTO zones VALUES (1822, 105, 'TS', 'Trieste');
INSERT INTO zones VALUES (1823, 105, 'UD', 'Udine');
INSERT INTO zones VALUES (1824, 105, 'VA', 'Varese');
INSERT INTO zones VALUES (1825, 105, 'VE', 'Venezia');
INSERT INTO zones VALUES (1826, 105, 'VB', 'Verbania');
INSERT INTO zones VALUES (1827, 105, 'VC', 'Vercelli');
INSERT INTO zones VALUES (1828, 105, 'VR', 'Verona');
INSERT INTO zones VALUES (1829, 105, 'VV', 'Vibo Valentia');
INSERT INTO zones VALUES (1830, 105, 'VI', 'Vicenza');
INSERT INTO zones VALUES (1831, 105, 'VT', 'Viterbo');
INSERT INTO zones VALUES (1832, 105, 'CI', 'Carbonia-Iglesias');
INSERT INTO zones VALUES (1833, 105, 'VS', 'Medio Campidano');
INSERT INTO zones VALUES (1834, 105, 'OG', 'Ogliastra');
INSERT INTO zones VALUES (1835, 105, 'OT', 'Olbia-Tempio');
INSERT INTO zones VALUES (1836, 105, 'MB', 'Monza e Brianza');
INSERT INTO zones VALUES (1837, 105, 'FM', 'Fermo');
INSERT INTO zones VALUES (1838, 105, 'BT', 'Barletta-Andria-Trani');
INSERT INTO zones VALUES (1839, 106, 'CLA', 'Clarendon Parish');
INSERT INTO zones VALUES (1840, 106, 'HAN', 'Hanover Parish');
INSERT INTO zones VALUES (1841, 106, 'KIN', 'Kingston Parish');
INSERT INTO zones VALUES (1842, 106, 'MAN', 'Manchester Parish');
INSERT INTO zones VALUES (1843, 106, 'POR', 'Portland Parish');
INSERT INTO zones VALUES (1844, 106, 'AND', 'Saint Andrew Parish');
INSERT INTO zones VALUES (1845, 106, 'ANN', 'Saint Ann Parish');
INSERT INTO zones VALUES (1846, 106, 'CAT', 'Saint Catherine Parish');
INSERT INTO zones VALUES (1847, 106, 'ELI', 'Saint Elizabeth Parish');
INSERT INTO zones VALUES (1848, 106, 'JAM', 'Saint James Parish');
INSERT INTO zones VALUES (1849, 106, 'MAR', 'Saint Mary Parish');
INSERT INTO zones VALUES (1850, 106, 'THO', 'Saint Thomas Parish');
INSERT INTO zones VALUES (1851, 106, 'TRL', 'Trelawny Parish');
INSERT INTO zones VALUES (1852, 106, 'WML', 'Westmoreland Parish');
INSERT INTO zones VALUES (1853, 107, 'AI', 'Aichi');
INSERT INTO zones VALUES (1854, 107, 'AK', 'Akita');
INSERT INTO zones VALUES (1855, 107, 'AO', 'Aomori');
INSERT INTO zones VALUES (1856, 107, 'CH', 'Chiba');
INSERT INTO zones VALUES (1857, 107, 'EH', 'Ehime');
INSERT INTO zones VALUES (1858, 107, 'FK', 'Fukui');
INSERT INTO zones VALUES (1859, 107, 'FU', 'Fukuoka');
INSERT INTO zones VALUES (1860, 107, 'FS', 'Fukushima');
INSERT INTO zones VALUES (1861, 107, 'GI', 'Gifu');
INSERT INTO zones VALUES (1862, 107, 'GU', 'Gumma');
INSERT INTO zones VALUES (1863, 107, 'HI', 'Hiroshima');
INSERT INTO zones VALUES (1864, 107, 'HO', 'Hokkaido');
INSERT INTO zones VALUES (1865, 107, 'HY', 'Hyogo');
INSERT INTO zones VALUES (1866, 107, 'IB', 'Ibaraki');
INSERT INTO zones VALUES (1867, 107, 'IS', 'Ishikawa');
INSERT INTO zones VALUES (1868, 107, 'IW', 'Iwate');
INSERT INTO zones VALUES (1869, 107, 'KA', 'Kagawa');
INSERT INTO zones VALUES (1870, 107, 'KG', 'Kagoshima');
INSERT INTO zones VALUES (1871, 107, 'KN', 'Kanagawa');
INSERT INTO zones VALUES (1872, 107, 'KO', 'Kochi');
INSERT INTO zones VALUES (1873, 107, 'KU', 'Kumamoto');
INSERT INTO zones VALUES (1874, 107, 'KY', 'Kyoto');
INSERT INTO zones VALUES (1875, 107, 'MI', 'Mie');
INSERT INTO zones VALUES (1876, 107, 'MY', 'Miyagi');
INSERT INTO zones VALUES (1877, 107, 'MZ', 'Miyazaki');
INSERT INTO zones VALUES (1878, 107, 'NA', 'Nagano');
INSERT INTO zones VALUES (1879, 107, 'NG', 'Nagasaki');
INSERT INTO zones VALUES (1880, 107, 'NR', 'Nara');
INSERT INTO zones VALUES (1881, 107, 'NI', 'Niigata');
INSERT INTO zones VALUES (1882, 107, 'OI', 'Oita');
INSERT INTO zones VALUES (1883, 107, 'OK', 'Okayama');
INSERT INTO zones VALUES (1884, 107, 'ON', 'Okinawa');
INSERT INTO zones VALUES (1885, 107, 'OS', 'Osaka');
INSERT INTO zones VALUES (1886, 107, 'SA', 'Saga');
INSERT INTO zones VALUES (1887, 107, 'SI', 'Saitama');
INSERT INTO zones VALUES (1888, 107, 'SH', 'Shiga');
INSERT INTO zones VALUES (1889, 107, 'SM', 'Shimane');
INSERT INTO zones VALUES (1890, 107, 'SZ', 'Shizuoka');
INSERT INTO zones VALUES (1891, 107, 'TO', 'Tochigi');
INSERT INTO zones VALUES (1892, 107, 'TS', 'Tokushima');
INSERT INTO zones VALUES (1893, 107, 'TK', 'Tokyo');
INSERT INTO zones VALUES (1894, 107, 'TT', 'Tottori');
INSERT INTO zones VALUES (1895, 107, 'TY', 'Toyama');
INSERT INTO zones VALUES (1896, 107, 'WA', 'Wakayama');
INSERT INTO zones VALUES (1897, 107, 'YA', 'Yamagata');
INSERT INTO zones VALUES (1898, 107, 'YM', 'Yamaguchi');
INSERT INTO zones VALUES (1899, 107, 'YN', 'Yamanashi');
INSERT INTO zones VALUES (1900, 108, 'AM', '''Amman');
INSERT INTO zones VALUES (1901, 108, 'AJ', 'Ajlun');
INSERT INTO zones VALUES (1902, 108, 'AA', 'Al ''Aqabah');
INSERT INTO zones VALUES (1903, 108, 'AB', 'Al Balqa''');
INSERT INTO zones VALUES (1904, 108, 'AK', 'Al Karak');
INSERT INTO zones VALUES (1905, 108, 'AL', 'Al Mafraq');
INSERT INTO zones VALUES (1906, 108, 'AT', 'At Tafilah');
INSERT INTO zones VALUES (1907, 108, 'AZ', 'Az Zarqa''');
INSERT INTO zones VALUES (1908, 108, 'IR', 'Irbid');
INSERT INTO zones VALUES (1909, 108, 'JA', 'Jarash');
INSERT INTO zones VALUES (1910, 108, 'MA', 'Ma''an');
INSERT INTO zones VALUES (1911, 108, 'MD', 'Madaba');
INSERT INTO zones VALUES (1912, 109, 'AL', 'Almaty');
INSERT INTO zones VALUES (1913, 109, 'AC', 'Almaty City');
INSERT INTO zones VALUES (1914, 109, 'AM', 'Aqmola');
INSERT INTO zones VALUES (1915, 109, 'AQ', 'Aqtobe');
INSERT INTO zones VALUES (1916, 109, 'AS', 'Astana City');
INSERT INTO zones VALUES (1917, 109, 'AT', 'Atyrau');
INSERT INTO zones VALUES (1918, 109, 'BA', 'Batys Qazaqstan');
INSERT INTO zones VALUES (1919, 109, 'BY', 'Bayqongyr City');
INSERT INTO zones VALUES (1920, 109, 'MA', 'Mangghystau');
INSERT INTO zones VALUES (1921, 109, 'ON', 'Ongtustik Qazaqstan');
INSERT INTO zones VALUES (1922, 109, 'PA', 'Pavlodar');
INSERT INTO zones VALUES (1923, 109, 'QA', 'Qaraghandy');
INSERT INTO zones VALUES (1924, 109, 'QO', 'Qostanay');
INSERT INTO zones VALUES (1925, 109, 'QY', 'Qyzylorda');
INSERT INTO zones VALUES (1926, 109, 'SH', 'Shyghys Qazaqstan');
INSERT INTO zones VALUES (1927, 109, 'SO', 'Soltustik Qazaqstan');
INSERT INTO zones VALUES (1928, 109, 'ZH', 'Zhambyl');
INSERT INTO zones VALUES (1929, 110, 'CE', 'Central');
INSERT INTO zones VALUES (1930, 110, 'CO', 'Coast');
INSERT INTO zones VALUES (1931, 110, 'EA', 'Eastern');
INSERT INTO zones VALUES (1932, 110, 'NA', 'Nairobi Area');
INSERT INTO zones VALUES (1933, 110, 'NE', 'North Eastern');
INSERT INTO zones VALUES (1934, 110, 'NY', 'Nyanza');
INSERT INTO zones VALUES (1935, 110, 'RV', 'Rift Valley');
INSERT INTO zones VALUES (1936, 110, 'WE', 'Western');
INSERT INTO zones VALUES (1937, 111, 'AG', 'Abaiang');
INSERT INTO zones VALUES (1938, 111, 'AM', 'Abemama');
INSERT INTO zones VALUES (1939, 111, 'AK', 'Aranuka');
INSERT INTO zones VALUES (1940, 111, 'AO', 'Arorae');
INSERT INTO zones VALUES (1941, 111, 'BA', 'Banaba');
INSERT INTO zones VALUES (1942, 111, 'BE', 'Beru');
INSERT INTO zones VALUES (1943, 111, 'bT', 'Butaritari');
INSERT INTO zones VALUES (1944, 111, 'KA', 'Kanton');
INSERT INTO zones VALUES (1945, 111, 'KR', 'Kiritimati');
INSERT INTO zones VALUES (1946, 111, 'KU', 'Kuria');
INSERT INTO zones VALUES (1947, 111, 'MI', 'Maiana');
INSERT INTO zones VALUES (1948, 111, 'MN', 'Makin');
INSERT INTO zones VALUES (1949, 111, 'ME', 'Marakei');
INSERT INTO zones VALUES (1950, 111, 'NI', 'Nikunau');
INSERT INTO zones VALUES (1951, 111, 'NO', 'Nonouti');
INSERT INTO zones VALUES (1952, 111, 'ON', 'Onotoa');
INSERT INTO zones VALUES (1953, 111, 'TT', 'Tabiteuea');
INSERT INTO zones VALUES (1954, 111, 'TR', 'Tabuaeran');
INSERT INTO zones VALUES (1955, 111, 'TM', 'Tamana');
INSERT INTO zones VALUES (1956, 111, 'TW', 'Tarawa');
INSERT INTO zones VALUES (1957, 111, 'TE', 'Teraina');
INSERT INTO zones VALUES (1958, 112, 'CHA', 'Chagang-do');
INSERT INTO zones VALUES (1959, 112, 'HAB', 'Hamgyong-bukto');
INSERT INTO zones VALUES (1960, 112, 'HAN', 'Hamgyong-namdo');
INSERT INTO zones VALUES (1961, 112, 'HWB', 'Hwanghae-bukto');
INSERT INTO zones VALUES (1962, 112, 'HWN', 'Hwanghae-namdo');
INSERT INTO zones VALUES (1963, 112, 'KAN', 'Kangwon-do');
INSERT INTO zones VALUES (1964, 112, 'PYB', 'P''yongan-bukto');
INSERT INTO zones VALUES (1965, 112, 'PYN', 'P''yongan-namdo');
INSERT INTO zones VALUES (1966, 112, 'YAN', 'Ryanggang-do (Yanggang-do)');
INSERT INTO zones VALUES (1967, 112, 'NAJ', 'Rason Directly Governed City');
INSERT INTO zones VALUES (1968, 112, 'PYO', 'P''yongyang Special City');
INSERT INTO zones VALUES (1969, 113, 'CO', 'Ch''ungch''ong-bukto');
INSERT INTO zones VALUES (1970, 113, 'CH', 'Ch''ungch''ong-namdo');
INSERT INTO zones VALUES (1971, 113, 'CD', 'Cheju-do');
INSERT INTO zones VALUES (1972, 113, 'CB', 'Cholla-bukto');
INSERT INTO zones VALUES (1973, 113, 'CN', 'Cholla-namdo');
INSERT INTO zones VALUES (1974, 113, 'IG', 'Inch''on-gwangyoksi');
INSERT INTO zones VALUES (1975, 113, 'KA', 'Kangwon-do');
INSERT INTO zones VALUES (1976, 113, 'KG', 'Kwangju-gwangyoksi');
INSERT INTO zones VALUES (1977, 113, 'KD', 'Kyonggi-do');
INSERT INTO zones VALUES (1978, 113, 'KB', 'Kyongsang-bukto');
INSERT INTO zones VALUES (1979, 113, 'KN', 'Kyongsang-namdo');
INSERT INTO zones VALUES (1980, 113, 'PG', 'Pusan-gwangyoksi');
INSERT INTO zones VALUES (1981, 113, 'SO', 'Soul-t''ukpyolsi');
INSERT INTO zones VALUES (1982, 113, 'TA', 'Taegu-gwangyoksi');
INSERT INTO zones VALUES (1983, 113, 'TG', 'Taejon-gwangyoksi');
INSERT INTO zones VALUES (1984, 114, 'AL', 'Al ''Asimah');
INSERT INTO zones VALUES (1985, 114, 'AA', 'Al Ahmadi');
INSERT INTO zones VALUES (1986, 114, 'AF', 'Al Farwaniyah');
INSERT INTO zones VALUES (1987, 114, 'AJ', 'Al Jahra''');
INSERT INTO zones VALUES (1988, 114, 'HA', 'Hawalli');
INSERT INTO zones VALUES (1989, 115, 'GB', 'Bishkek');
INSERT INTO zones VALUES (1990, 115, 'B', 'Batken');
INSERT INTO zones VALUES (1991, 115, 'C', 'Chu');
INSERT INTO zones VALUES (1992, 115, 'J', 'Jalal-Abad');
INSERT INTO zones VALUES (1993, 115, 'N', 'Naryn');
INSERT INTO zones VALUES (1994, 115, 'O', 'Osh');
INSERT INTO zones VALUES (1995, 115, 'T', 'Talas');
INSERT INTO zones VALUES (1996, 115, 'Y', 'Ysyk-Kol');
INSERT INTO zones VALUES (1997, 116, 'VT', 'Vientiane');
INSERT INTO zones VALUES (1998, 116, 'AT', 'Attapu');
INSERT INTO zones VALUES (1999, 116, 'BK', 'Bokeo');
INSERT INTO zones VALUES (2000, 116, 'BL', 'Bolikhamxai');
INSERT INTO zones VALUES (2001, 116, 'CH', 'Champasak');
INSERT INTO zones VALUES (2002, 116, 'HO', 'Houaphan');
INSERT INTO zones VALUES (2003, 116, 'KH', 'Khammouan');
INSERT INTO zones VALUES (2004, 116, 'LM', 'Louang Namtha');
INSERT INTO zones VALUES (2005, 116, 'LP', 'Louangphabang');
INSERT INTO zones VALUES (2006, 116, 'OU', 'Oudomxai');
INSERT INTO zones VALUES (2007, 116, 'PH', 'Phongsali');
INSERT INTO zones VALUES (2008, 116, 'SL', 'Salavan');
INSERT INTO zones VALUES (2009, 116, 'SV', 'Savannakhet');
INSERT INTO zones VALUES (2010, 116, 'VI', 'Vientiane');
INSERT INTO zones VALUES (2011, 116, 'XA', 'Xaignabouli');
INSERT INTO zones VALUES (2012, 116, 'XE', 'Xekong');
INSERT INTO zones VALUES (2013, 116, 'XI', 'Xiangkhoang');
INSERT INTO zones VALUES (2014, 116, 'XN', 'Xaisomboun');
INSERT INTO zones VALUES (2015, 117, 'AIZ', 'Aizkraukles Rajons');
INSERT INTO zones VALUES (2016, 117, 'ALU', 'Aluksnes Rajons');
INSERT INTO zones VALUES (2017, 117, 'BAL', 'Balvu Rajons');
INSERT INTO zones VALUES (2018, 117, 'BAU', 'Bauskas Rajons');
INSERT INTO zones VALUES (2019, 117, 'CES', 'Cesu Rajons');
INSERT INTO zones VALUES (2020, 117, 'DGR', 'Daugavpils Rajons');
INSERT INTO zones VALUES (2021, 117, 'DOB', 'Dobeles Rajons');
INSERT INTO zones VALUES (2022, 117, 'GUL', 'Gulbenes Rajons');
INSERT INTO zones VALUES (2023, 117, 'JEK', 'Jekabpils Rajons');
INSERT INTO zones VALUES (2024, 117, 'JGR', 'Jelgavas Rajons');
INSERT INTO zones VALUES (2025, 117, 'KRA', 'Kraslavas Rajons');
INSERT INTO zones VALUES (2026, 117, 'KUL', 'Kuldigas Rajons');
INSERT INTO zones VALUES (2027, 117, 'LPR', 'Liepajas Rajons');
INSERT INTO zones VALUES (2028, 117, 'LIM', 'Limbazu Rajons');
INSERT INTO zones VALUES (2029, 117, 'LUD', 'Ludzas Rajons');
INSERT INTO zones VALUES (2030, 117, 'MAD', 'Madonas Rajons');
INSERT INTO zones VALUES (2031, 117, 'OGR', 'Ogres Rajons');
INSERT INTO zones VALUES (2032, 117, 'PRE', 'Preilu Rajons');
INSERT INTO zones VALUES (2033, 117, 'RZR', 'Rezeknes Rajons');
INSERT INTO zones VALUES (2034, 117, 'RGR', 'Rigas Rajons');
INSERT INTO zones VALUES (2035, 117, 'SAL', 'Saldus Rajons');
INSERT INTO zones VALUES (2036, 117, 'TAL', 'Talsu Rajons');
INSERT INTO zones VALUES (2037, 117, 'TUK', 'Tukuma Rajons');
INSERT INTO zones VALUES (2038, 117, 'VLK', 'Valkas Rajons');
INSERT INTO zones VALUES (2039, 117, 'VLM', 'Valmieras Rajons');
INSERT INTO zones VALUES (2040, 117, 'VSR', 'Ventspils Rajons');
INSERT INTO zones VALUES (2041, 117, 'DGV', 'Daugavpils');
INSERT INTO zones VALUES (2042, 117, 'JGV', 'Jelgava');
INSERT INTO zones VALUES (2043, 117, 'JUR', 'Jurmala');
INSERT INTO zones VALUES (2044, 117, 'LPK', 'Liepaja');
INSERT INTO zones VALUES (2045, 117, 'RZK', 'Rezekne');
INSERT INTO zones VALUES (2046, 117, 'RGA', 'Riga');
INSERT INTO zones VALUES (2047, 117, 'VSL', 'Ventspils');
INSERT INTO zones VALUES (2048, 118, 'BIN', 'Bint Jbeil');
INSERT INTO zones VALUES (2049, 118, 'HAS', 'Hasbaya');
INSERT INTO zones VALUES (2050, 118, 'MAR', 'Marjeyoun');
INSERT INTO zones VALUES (2051, 118, 'NAB', 'Nabatieh');
INSERT INTO zones VALUES (2052, 118, 'BAA', 'Baalbek');
INSERT INTO zones VALUES (2053, 118, 'HER', 'Hermel');
INSERT INTO zones VALUES (2054, 118, 'RAS', 'Rashaya');
INSERT INTO zones VALUES (2055, 118, 'WES', 'Western Beqaa');
INSERT INTO zones VALUES (2056, 118, 'ZAH', 'Zahle');
INSERT INTO zones VALUES (2057, 118, 'AKK', 'Akkar');
INSERT INTO zones VALUES (2058, 118, 'BAT', 'Batroun');
INSERT INTO zones VALUES (2059, 118, 'BSH', 'Bsharri');
INSERT INTO zones VALUES (2060, 118, 'KOU', 'Koura');
INSERT INTO zones VALUES (2061, 118, 'MIN', 'Miniyeh-Danniyeh');
INSERT INTO zones VALUES (2062, 118, 'TRI', 'Tripoli');
INSERT INTO zones VALUES (2063, 118, 'ZGH', 'Zgharta');
INSERT INTO zones VALUES (2064, 118, 'ALE', 'Aley');
INSERT INTO zones VALUES (2065, 118, 'BAA', 'Baabda');
INSERT INTO zones VALUES (2066, 118, 'BYB', 'Byblos');
INSERT INTO zones VALUES (2067, 118, 'CHO', 'Chouf');
INSERT INTO zones VALUES (2068, 118, 'KES', 'Kesrwan');
INSERT INTO zones VALUES (2069, 118, 'MAT', 'Matn');
INSERT INTO zones VALUES (2070, 118, 'JEZ', 'Jezzine');
INSERT INTO zones VALUES (2071, 118, 'SID', 'Sidon');
INSERT INTO zones VALUES (2072, 118, 'TYR', 'Tyre');
INSERT INTO zones VALUES (2073, 119, 'BE', 'Berea');
INSERT INTO zones VALUES (2074, 119, 'BB', 'Butha-Buthe');
INSERT INTO zones VALUES (2075, 119, 'LE', 'Leribe');
INSERT INTO zones VALUES (2076, 119, 'MF', 'Mafeteng');
INSERT INTO zones VALUES (2077, 119, 'MS', 'Maseru');
INSERT INTO zones VALUES (2078, 119, 'MH', 'Mohale''s Hoek');
INSERT INTO zones VALUES (2079, 119, 'MK', 'Mokhotlong');
INSERT INTO zones VALUES (2080, 119, 'QN', 'Qacha''s Nek');
INSERT INTO zones VALUES (2081, 119, 'QT', 'Quthing');
INSERT INTO zones VALUES (2082, 119, 'TT', 'Thaba-Tseka');
INSERT INTO zones VALUES (2083, 120, 'BI', 'Bomi');
INSERT INTO zones VALUES (2084, 120, 'BG', 'Bong');
INSERT INTO zones VALUES (2085, 120, 'GB', 'Grand Bassa');
INSERT INTO zones VALUES (2086, 120, 'CM', 'Grand Cape Mount');
INSERT INTO zones VALUES (2087, 120, 'GG', 'Grand Gedeh');
INSERT INTO zones VALUES (2088, 120, 'GK', 'Grand Kru');
INSERT INTO zones VALUES (2089, 120, 'LO', 'Lofa');
INSERT INTO zones VALUES (2090, 120, 'MG', 'Margibi');
INSERT INTO zones VALUES (2091, 120, 'ML', 'Maryland.');
INSERT INTO zones VALUES (2092, 120, 'MS', 'Montserrado');
INSERT INTO zones VALUES (2093, 120, 'NB', 'Nimba');
INSERT INTO zones VALUES (2094, 120, 'RC', 'River Cess');
INSERT INTO zones VALUES (2095, 120, 'SN', 'Sinoe');
INSERT INTO zones VALUES (2096, 121, 'AJ', 'Ajdabiya');
INSERT INTO zones VALUES (2097, 121, 'AZ', 'Al ''Aziziyah');
INSERT INTO zones VALUES (2098, 121, 'FA', 'Al Fatih');
INSERT INTO zones VALUES (2099, 121, 'JA', 'Al Jabal al Akhdar');
INSERT INTO zones VALUES (2100, 121, 'JU', 'Al Jufrah');
INSERT INTO zones VALUES (2101, 121, 'KH', 'Al Khums');
INSERT INTO zones VALUES (2102, 121, 'KU', 'Al Kufrah');
INSERT INTO zones VALUES (2103, 121, 'NK', 'An Nuqat al Khams');
INSERT INTO zones VALUES (2104, 121, 'AS', 'Ash Shati''');
INSERT INTO zones VALUES (2105, 121, 'AW', 'Awbari');
INSERT INTO zones VALUES (2106, 121, 'ZA', 'Az Zawiyah');
INSERT INTO zones VALUES (2107, 121, 'BA', 'Banghazi');
INSERT INTO zones VALUES (2108, 121, 'DA', 'Darnah');
INSERT INTO zones VALUES (2109, 121, 'GD', 'Ghadamis');
INSERT INTO zones VALUES (2110, 121, 'GY', 'Gharyan');
INSERT INTO zones VALUES (2111, 121, 'MI', 'Misratah');
INSERT INTO zones VALUES (2112, 121, 'MZ', 'Murzuq');
INSERT INTO zones VALUES (2113, 121, 'SB', 'Sabha');
INSERT INTO zones VALUES (2114, 121, 'SW', 'Sawfajjin');
INSERT INTO zones VALUES (2115, 121, 'SU', 'Surt');
INSERT INTO zones VALUES (2116, 121, 'TL', 'Tarabulus (Tripoli)');
INSERT INTO zones VALUES (2117, 121, 'TH', 'Tarhunah');
INSERT INTO zones VALUES (2118, 121, 'TU', 'Tubruq');
INSERT INTO zones VALUES (2119, 121, 'YA', 'Yafran');
INSERT INTO zones VALUES (2120, 121, 'ZL', 'Zlitan');
INSERT INTO zones VALUES (2121, 122, 'V', 'Vaduz');
INSERT INTO zones VALUES (2122, 122, 'A', 'Schaan');
INSERT INTO zones VALUES (2123, 122, 'B', 'Balzers');
INSERT INTO zones VALUES (2124, 122, 'N', 'Triesen');
INSERT INTO zones VALUES (2125, 122, 'E', 'Eschen');
INSERT INTO zones VALUES (2126, 122, 'M', 'Mauren');
INSERT INTO zones VALUES (2127, 122, 'T', 'Triesenberg');
INSERT INTO zones VALUES (2128, 122, 'R', 'Ruggell');
INSERT INTO zones VALUES (2129, 122, 'G', 'Gamprin');
INSERT INTO zones VALUES (2130, 122, 'L', 'Schellenberg');
INSERT INTO zones VALUES (2131, 122, 'P', 'Planken');
INSERT INTO zones VALUES (2132, 123, 'AL', 'Alytus');
INSERT INTO zones VALUES (2133, 123, 'KA', 'Kaunas');
INSERT INTO zones VALUES (2134, 123, 'KL', 'Klaipeda');
INSERT INTO zones VALUES (2135, 123, 'MA', 'Marijampole');
INSERT INTO zones VALUES (2136, 123, 'PA', 'Panevezys');
INSERT INTO zones VALUES (2137, 123, 'SI', 'Siauliai');
INSERT INTO zones VALUES (2138, 123, 'TA', 'Taurage');
INSERT INTO zones VALUES (2139, 123, 'TE', 'Telsiai');
INSERT INTO zones VALUES (2140, 123, 'UT', 'Utena');
INSERT INTO zones VALUES (2141, 123, 'VI', 'Vilnius');
INSERT INTO zones VALUES (2142, 124, 'DD', 'Diekirch');
INSERT INTO zones VALUES (2143, 124, 'DC', 'Clervaux');
INSERT INTO zones VALUES (2144, 124, 'DR', 'Redange');
INSERT INTO zones VALUES (2145, 124, 'DV', 'Vianden');
INSERT INTO zones VALUES (2146, 124, 'DW', 'Wiltz');
INSERT INTO zones VALUES (2147, 124, 'GG', 'Grevenmacher');
INSERT INTO zones VALUES (2148, 124, 'GE', 'Echternach');
INSERT INTO zones VALUES (2149, 124, 'GR', 'Remich');
INSERT INTO zones VALUES (2150, 124, 'LL', 'Luxembourg');
INSERT INTO zones VALUES (2151, 124, 'LC', 'Capellen');
INSERT INTO zones VALUES (2152, 124, 'LE', 'Esch-sur-Alzette');
INSERT INTO zones VALUES (2153, 124, 'LM', 'Mersch');
INSERT INTO zones VALUES (2154, 125, 'OLF', 'Our Lady Fatima Parish');
INSERT INTO zones VALUES (2155, 125, 'ANT', 'St. Anthony Parish');
INSERT INTO zones VALUES (2156, 125, 'LAZ', 'St. Lazarus Parish');
INSERT INTO zones VALUES (2157, 125, 'CAT', 'Cathedral Parish');
INSERT INTO zones VALUES (2158, 125, 'LAW', 'St. Lawrence Parish');
INSERT INTO zones VALUES (2159, 126, 'AER', 'Aerodrom');
INSERT INTO zones VALUES (2160, 126, 'ARA', 'Ara&#269;inovo');
INSERT INTO zones VALUES (2161, 126, 'BER', 'Berovo');
INSERT INTO zones VALUES (2162, 126, 'BIT', 'Bitola');
INSERT INTO zones VALUES (2163, 126, 'BOG', 'Bogdanci');
INSERT INTO zones VALUES (2164, 126, 'BOG', 'Bogovinje');
INSERT INTO zones VALUES (2165, 126, 'BOS', 'Bosilovo');
INSERT INTO zones VALUES (2166, 126, 'BRV', 'Brvenica');
INSERT INTO zones VALUES (2167, 126, 'BUT', 'Butel');
INSERT INTO zones VALUES (2168, 126, '&#268;AI', '&#268;air');
INSERT INTO zones VALUES (2169, 126, '&#268;A&scaron;', '&#268;a&scaron;ka');
INSERT INTO zones VALUES (2170, 126, 'CEN', 'Centar');
INSERT INTO zones VALUES (2171, 126, 'CEN', 'Centar &#381;upa');
INSERT INTO zones VALUES (2172, 126, '&#268;e&scaron;', '&#268;e&scaron;inovo-Oble&scaron');
INSERT INTO zones VALUES (2173, 126, '&#268;U&#268;', '&#268;u&#269;er-Sandevo');
INSERT INTO zones VALUES (2174, 126, 'DEB', 'Debar');
INSERT INTO zones VALUES (2175, 126, 'DEB', 'Debarca');
INSERT INTO zones VALUES (2176, 126, 'DEL', 'Del&#269;evo');
INSERT INTO zones VALUES (2177, 126, 'DEM', 'Demir Hisar');
INSERT INTO zones VALUES (2178, 126, 'DEM', 'Demir Kapija');
INSERT INTO zones VALUES (2179, 126, 'DOL', 'Dolneni');
INSERT INTO zones VALUES (2180, 126, 'DRU', 'Drugovo');
INSERT INTO zones VALUES (2181, 126, 'GAZ', 'Gazi Baba');
INSERT INTO zones VALUES (2182, 126, 'GEV', 'Gevgelija');
INSERT INTO zones VALUES (2183, 126, 'GJO', 'Gjor&#269;e Petrov');
INSERT INTO zones VALUES (2184, 126, 'GOS', 'Gostivar');
INSERT INTO zones VALUES (2185, 126, 'GRA', 'Gradsko');
INSERT INTO zones VALUES (2186, 126, 'ILI', 'Ilinden');
INSERT INTO zones VALUES (2187, 126, 'JEG', 'Jegunovce');
INSERT INTO zones VALUES (2188, 126, 'KAR', 'Karbinci');
INSERT INTO zones VALUES (2189, 126, 'KAR', 'Karpo&scaron;');
INSERT INTO zones VALUES (2190, 126, 'KAV', 'Kavadarci');
INSERT INTO zones VALUES (2191, 126, 'KI&#268;', 'Ki&#269;evo');
INSERT INTO zones VALUES (2192, 126, 'KIS', 'Kisela Voda');
INSERT INTO zones VALUES (2193, 126, 'KO&#269;', 'Ko&#269;ani');
INSERT INTO zones VALUES (2194, 126, 'KON', 'Kon&#269;e');
INSERT INTO zones VALUES (2195, 126, 'KRA', 'Kratovo');
INSERT INTO zones VALUES (2196, 126, 'KRI', 'Kriva Palanka');
INSERT INTO zones VALUES (2197, 126, 'KRI', 'Krivoga&scaron;tani');
INSERT INTO zones VALUES (2198, 126, 'KRU', 'Kru&scaron;evo');
INSERT INTO zones VALUES (2199, 126, 'KUM', 'Kumanovo');
INSERT INTO zones VALUES (2200, 126, 'LIP', 'Lipkovo');
INSERT INTO zones VALUES (2201, 126, 'LOZ', 'Lozovo');
INSERT INTO zones VALUES (2202, 126, 'MAK', 'Makedonska Kamenica');
INSERT INTO zones VALUES (2203, 126, 'MAK', 'Makedonski Brod');
INSERT INTO zones VALUES (2204, 126, 'MAV', 'Mavrovo and Rostu&scaron;a');
INSERT INTO zones VALUES (2205, 126, 'MOG', 'Mogila');
INSERT INTO zones VALUES (2206, 126, 'NEG', 'Negotino');
INSERT INTO zones VALUES (2207, 126, 'NOV', 'Novaci');
INSERT INTO zones VALUES (2208, 126, 'NOV', 'Novo Selo');
INSERT INTO zones VALUES (2209, 126, 'OHR', 'Ohrid');
INSERT INTO zones VALUES (2210, 126, 'OSL', 'Oslomej');
INSERT INTO zones VALUES (2211, 126, 'PEH', 'Peh&#269;evo');
INSERT INTO zones VALUES (2212, 126, 'PET', 'Petrovec');
INSERT INTO zones VALUES (2213, 126, 'PLA', 'Plasnica');
INSERT INTO zones VALUES (2214, 126, 'PRI', 'Prilep');
INSERT INTO zones VALUES (2215, 126, 'PRO', 'Probi&scaron;tip');
INSERT INTO zones VALUES (2216, 126, 'RAD', 'Radovi&scaron;');
INSERT INTO zones VALUES (2217, 126, 'RAN', 'Rankovce');
INSERT INTO zones VALUES (2218, 126, 'RES', 'Resen');
INSERT INTO zones VALUES (2219, 126, 'ROS', 'Rosoman');
INSERT INTO zones VALUES (2220, 126, 'SAR', 'Saraj');
INSERT INTO zones VALUES (2221, 126, 'SOP', 'Sopi&scaron;te');
INSERT INTO zones VALUES (2222, 126, 'STA', 'Star Dojran');
INSERT INTO zones VALUES (2223, 126, 'STA', 'Staro Nagori&#269;ane');
INSERT INTO zones VALUES (2224, 126, '&Scaron;TI', '&Scaron;tip');
INSERT INTO zones VALUES (2225, 126, 'STR', 'Struga');
INSERT INTO zones VALUES (2226, 126, 'STR', 'Strumica');
INSERT INTO zones VALUES (2227, 126, 'STU', 'Studeni&#269;ani');
INSERT INTO zones VALUES (2228, 126, '&Scaron;UT', '&Scaron;uto Orizari');
INSERT INTO zones VALUES (2229, 126, 'SVE', 'Sveti Nikole');
INSERT INTO zones VALUES (2230, 126, 'TEA', 'Tearce');
INSERT INTO zones VALUES (2231, 126, 'TET', 'Tetovo');
INSERT INTO zones VALUES (2232, 126, 'VAL', 'Valandovo');
INSERT INTO zones VALUES (2233, 126, 'VAS', 'Vasilevo');
INSERT INTO zones VALUES (2234, 126, 'VEL', 'Veles');
INSERT INTO zones VALUES (2235, 126, 'VEV', 'Vev&#269;ani');
INSERT INTO zones VALUES (2236, 126, 'VIN', 'Vinica');
INSERT INTO zones VALUES (2237, 126, 'VRA', 'Vrane&scaron;tica');
INSERT INTO zones VALUES (2238, 126, 'VRA', 'Vrap&#269;i&scaron;te');
INSERT INTO zones VALUES (2239, 126, 'ZAJ', 'Zajas');
INSERT INTO zones VALUES (2240, 126, 'ZEL', 'Zelenikovo');
INSERT INTO zones VALUES (2241, 126, '&#381;EL', '&#381;elino');
INSERT INTO zones VALUES (2242, 126, 'ZRN', 'Zrnovci');
INSERT INTO zones VALUES (2243, 127, 'AN', 'Antananarivo');
INSERT INTO zones VALUES (2244, 127, 'AS', 'Antsiranana');
INSERT INTO zones VALUES (2245, 127, 'FN', 'Fianarantsoa');
INSERT INTO zones VALUES (2246, 127, 'MJ', 'Mahajanga');
INSERT INTO zones VALUES (2247, 127, 'TM', 'Toamasina');
INSERT INTO zones VALUES (2248, 127, 'TL', 'Toliara');
INSERT INTO zones VALUES (2249, 128, 'BLK', 'Balaka');
INSERT INTO zones VALUES (2250, 128, 'BLT', 'Blantyre');
INSERT INTO zones VALUES (2251, 128, 'CKW', 'Chikwawa');
INSERT INTO zones VALUES (2252, 128, 'CRD', 'Chiradzulu');
INSERT INTO zones VALUES (2253, 128, 'CTP', 'Chitipa');
INSERT INTO zones VALUES (2254, 128, 'DDZ', 'Dedza');
INSERT INTO zones VALUES (2255, 128, 'DWA', 'Dowa');
INSERT INTO zones VALUES (2256, 128, 'KRG', 'Karonga');
INSERT INTO zones VALUES (2257, 128, 'KSG', 'Kasungu');
INSERT INTO zones VALUES (2258, 128, 'LKM', 'Likoma');
INSERT INTO zones VALUES (2259, 128, 'LLG', 'Lilongwe');
INSERT INTO zones VALUES (2260, 128, 'MCG', 'Machinga');
INSERT INTO zones VALUES (2261, 128, 'MGC', 'Mangochi');
INSERT INTO zones VALUES (2262, 128, 'MCH', 'Mchinji');
INSERT INTO zones VALUES (2263, 128, 'MLJ', 'Mulanje');
INSERT INTO zones VALUES (2264, 128, 'MWZ', 'Mwanza');
INSERT INTO zones VALUES (2265, 128, 'MZM', 'Mzimba');
INSERT INTO zones VALUES (2266, 128, 'NTU', 'Ntcheu');
INSERT INTO zones VALUES (2267, 128, 'NKB', 'Nkhata Bay');
INSERT INTO zones VALUES (2268, 128, 'NKH', 'Nkhotakota');
INSERT INTO zones VALUES (2269, 128, 'NSJ', 'Nsanje');
INSERT INTO zones VALUES (2270, 128, 'NTI', 'Ntchisi');
INSERT INTO zones VALUES (2271, 128, 'PHL', 'Phalombe');
INSERT INTO zones VALUES (2272, 128, 'RMP', 'Rumphi');
INSERT INTO zones VALUES (2273, 128, 'SLM', 'Salima');
INSERT INTO zones VALUES (2274, 128, 'THY', 'Thyolo');
INSERT INTO zones VALUES (2275, 128, 'ZBA', 'Zomba');
INSERT INTO zones VALUES (2276, 129, 'Johor', 'Johor');
INSERT INTO zones VALUES (2277, 129, 'Kedah', 'Kedah');
INSERT INTO zones VALUES (2278, 129, 'Kelantan', 'Kelantan');
INSERT INTO zones VALUES (2279, 129, 'Labuan', 'Labuan');
INSERT INTO zones VALUES (2280, 129, 'Melaka', 'Melaka');
INSERT INTO zones VALUES (2281, 129, 'Negeri Sembilan', 'Negeri Sembilan');
INSERT INTO zones VALUES (2282, 129, 'Pahang', 'Pahang');
INSERT INTO zones VALUES (2283, 129, 'Perak', 'Perak');
INSERT INTO zones VALUES (2284, 129, 'Perlis', 'Perlis');
INSERT INTO zones VALUES (2285, 129, 'Pulau Pinang', 'Pulau Pinang');
INSERT INTO zones VALUES (2286, 129, 'Sabah', 'Sabah');
INSERT INTO zones VALUES (2287, 129, 'Sarawak', 'Sarawak');
INSERT INTO zones VALUES (2288, 129, 'Selangor', 'Selangor');
INSERT INTO zones VALUES (2289, 129, 'Terengganu', 'Terengganu');
INSERT INTO zones VALUES (2290, 129, 'Kuala Lumpur', 'Kuala Lumpur');
INSERT INTO zones VALUES (2291, 130, 'THU', 'Thiladhunmathi Uthuru');
INSERT INTO zones VALUES (2292, 130, 'THD', 'Thiladhunmathi Dhekunu');
INSERT INTO zones VALUES (2293, 130, 'MLU', 'Miladhunmadulu Uthuru');
INSERT INTO zones VALUES (2294, 130, 'MLD', 'Miladhunmadulu Dhekunu');
INSERT INTO zones VALUES (2295, 130, 'MAU', 'Maalhosmadulu Uthuru');
INSERT INTO zones VALUES (2296, 130, 'MAD', 'Maalhosmadulu Dhekunu');
INSERT INTO zones VALUES (2297, 130, 'FAA', 'Faadhippolhu');
INSERT INTO zones VALUES (2298, 130, 'MAA', 'Male Atoll');
INSERT INTO zones VALUES (2299, 130, 'AAU', 'Ari Atoll Uthuru');
INSERT INTO zones VALUES (2300, 130, 'AAD', 'Ari Atoll Dheknu');
INSERT INTO zones VALUES (2301, 130, 'FEA', 'Felidhe Atoll');
INSERT INTO zones VALUES (2302, 130, 'MUA', 'Mulaku Atoll');
INSERT INTO zones VALUES (2303, 130, 'NAU', 'Nilandhe Atoll Uthuru');
INSERT INTO zones VALUES (2304, 130, 'NAD', 'Nilandhe Atoll Dhekunu');
INSERT INTO zones VALUES (2305, 130, 'KLH', 'Kolhumadulu');
INSERT INTO zones VALUES (2306, 130, 'HDH', 'Hadhdhunmathi');
INSERT INTO zones VALUES (2307, 130, 'HAU', 'Huvadhu Atoll Uthuru');
INSERT INTO zones VALUES (2308, 130, 'HAD', 'Huvadhu Atoll Dhekunu');
INSERT INTO zones VALUES (2309, 130, 'FMU', 'Fua Mulaku');
INSERT INTO zones VALUES (2310, 130, 'ADD', 'Addu');
INSERT INTO zones VALUES (2311, 131, 'GA', 'Gao');
INSERT INTO zones VALUES (2312, 131, 'KY', 'Kayes');
INSERT INTO zones VALUES (2313, 131, 'KD', 'Kidal');
INSERT INTO zones VALUES (2314, 131, 'KL', 'Koulikoro');
INSERT INTO zones VALUES (2315, 131, 'MP', 'Mopti');
INSERT INTO zones VALUES (2316, 131, 'SG', 'Segou');
INSERT INTO zones VALUES (2317, 131, 'SK', 'Sikasso');
INSERT INTO zones VALUES (2318, 131, 'TB', 'Tombouctou');
INSERT INTO zones VALUES (2319, 131, 'CD', 'Bamako Capital District');
INSERT INTO zones VALUES (2320, 132, 'ATT', 'Attard');
INSERT INTO zones VALUES (2321, 132, 'BAL', 'Balzan');
INSERT INTO zones VALUES (2322, 132, 'BGU', 'Birgu');
INSERT INTO zones VALUES (2323, 132, 'BKK', 'Birkirkara');
INSERT INTO zones VALUES (2324, 132, 'BRZ', 'Birzebbuga');
INSERT INTO zones VALUES (2325, 132, 'BOR', 'Bormla');
INSERT INTO zones VALUES (2326, 132, 'DIN', 'Dingli');
INSERT INTO zones VALUES (2327, 132, 'FGU', 'Fgura');
INSERT INTO zones VALUES (2328, 132, 'FLO', 'Floriana');
INSERT INTO zones VALUES (2329, 132, 'GDJ', 'Gudja');
INSERT INTO zones VALUES (2330, 132, 'GZR', 'Gzira');
INSERT INTO zones VALUES (2331, 132, 'GRG', 'Gargur');
INSERT INTO zones VALUES (2332, 132, 'GXQ', 'Gaxaq');
INSERT INTO zones VALUES (2333, 132, 'HMR', 'Hamrun');
INSERT INTO zones VALUES (2334, 132, 'IKL', 'Iklin');
INSERT INTO zones VALUES (2335, 132, 'ISL', 'Isla');
INSERT INTO zones VALUES (2336, 132, 'KLK', 'Kalkara');
INSERT INTO zones VALUES (2337, 132, 'KRK', 'Kirkop');
INSERT INTO zones VALUES (2338, 132, 'LIJ', 'Lija');
INSERT INTO zones VALUES (2339, 132, 'LUQ', 'Luqa');
INSERT INTO zones VALUES (2340, 132, 'MRS', 'Marsa');
INSERT INTO zones VALUES (2341, 132, 'MKL', 'Marsaskala');
INSERT INTO zones VALUES (2342, 132, 'MXL', 'Marsaxlokk');
INSERT INTO zones VALUES (2343, 132, 'MDN', 'Mdina');
INSERT INTO zones VALUES (2344, 132, 'MEL', 'Melliea');
INSERT INTO zones VALUES (2345, 132, 'MGR', 'Mgarr');
INSERT INTO zones VALUES (2346, 132, 'MST', 'Mosta');
INSERT INTO zones VALUES (2347, 132, 'MQA', 'Mqabba');
INSERT INTO zones VALUES (2348, 132, 'MSI', 'Msida');
INSERT INTO zones VALUES (2349, 132, 'MTF', 'Mtarfa');
INSERT INTO zones VALUES (2350, 132, 'NAX', 'Naxxar');
INSERT INTO zones VALUES (2351, 132, 'PAO', 'Paola');
INSERT INTO zones VALUES (2352, 132, 'PEM', 'Pembroke');
INSERT INTO zones VALUES (2353, 132, 'PIE', 'Pieta');
INSERT INTO zones VALUES (2354, 132, 'QOR', 'Qormi');
INSERT INTO zones VALUES (2355, 132, 'QRE', 'Qrendi');
INSERT INTO zones VALUES (2356, 132, 'RAB', 'Rabat');
INSERT INTO zones VALUES (2357, 132, 'SAF', 'Safi');
INSERT INTO zones VALUES (2358, 132, 'SGI', 'San Giljan');
INSERT INTO zones VALUES (2359, 132, 'SLU', 'Santa Lucija');
INSERT INTO zones VALUES (2360, 132, 'SPB', 'San Pawl il-Bahar');
INSERT INTO zones VALUES (2361, 132, 'SGW', 'San Gwann');
INSERT INTO zones VALUES (2362, 132, 'SVE', 'Santa Venera');
INSERT INTO zones VALUES (2363, 132, 'SIG', 'Siggiewi');
INSERT INTO zones VALUES (2364, 132, 'SLM', 'Sliema');
INSERT INTO zones VALUES (2365, 132, 'SWQ', 'Swieqi');
INSERT INTO zones VALUES (2366, 132, 'TXB', 'Ta Xbiex');
INSERT INTO zones VALUES (2367, 132, 'TRX', 'Tarxien');
INSERT INTO zones VALUES (2368, 132, 'VLT', 'Valletta');
INSERT INTO zones VALUES (2369, 132, 'XGJ', 'Xgajra');
INSERT INTO zones VALUES (2370, 132, 'ZBR', 'Zabbar');
INSERT INTO zones VALUES (2371, 132, 'ZBG', 'Zebbug');
INSERT INTO zones VALUES (2372, 132, 'ZJT', 'Zejtun');
INSERT INTO zones VALUES (2373, 132, 'ZRQ', 'Zurrieq');
INSERT INTO zones VALUES (2374, 132, 'FNT', 'Fontana');
INSERT INTO zones VALUES (2375, 132, 'GHJ', 'Ghajnsielem');
INSERT INTO zones VALUES (2376, 132, 'GHR', 'Gharb');
INSERT INTO zones VALUES (2377, 132, 'GHS', 'Ghasri');
INSERT INTO zones VALUES (2378, 132, 'KRC', 'Kercem');
INSERT INTO zones VALUES (2379, 132, 'MUN', 'Munxar');
INSERT INTO zones VALUES (2380, 132, 'NAD', 'Nadur');
INSERT INTO zones VALUES (2381, 132, 'QAL', 'Qala');
INSERT INTO zones VALUES (2382, 132, 'VIC', 'Victoria');
INSERT INTO zones VALUES (2383, 132, 'SLA', 'San Lawrenz');
INSERT INTO zones VALUES (2384, 132, 'SNT', 'Sannat');
INSERT INTO zones VALUES (2385, 132, 'ZAG', 'Xagra');
INSERT INTO zones VALUES (2386, 132, 'XEW', 'Xewkija');
INSERT INTO zones VALUES (2387, 132, 'ZEB', 'Zebbug');
INSERT INTO zones VALUES (2388, 133, 'ALG', 'Ailinginae');
INSERT INTO zones VALUES (2389, 133, 'ALL', 'Ailinglaplap');
INSERT INTO zones VALUES (2390, 133, 'ALK', 'Ailuk');
INSERT INTO zones VALUES (2391, 133, 'ARN', 'Arno');
INSERT INTO zones VALUES (2392, 133, 'AUR', 'Aur');
INSERT INTO zones VALUES (2393, 133, 'BKR', 'Bikar');
INSERT INTO zones VALUES (2394, 133, 'BKN', 'Bikini');
INSERT INTO zones VALUES (2395, 133, 'BKK', 'Bokak');
INSERT INTO zones VALUES (2396, 133, 'EBN', 'Ebon');
INSERT INTO zones VALUES (2397, 133, 'ENT', 'Enewetak');
INSERT INTO zones VALUES (2398, 133, 'EKB', 'Erikub');
INSERT INTO zones VALUES (2399, 133, 'JBT', 'Jabat');
INSERT INTO zones VALUES (2400, 133, 'JLT', 'Jaluit');
INSERT INTO zones VALUES (2401, 133, 'JEM', 'Jemo');
INSERT INTO zones VALUES (2402, 133, 'KIL', 'Kili');
INSERT INTO zones VALUES (2403, 133, 'KWJ', 'Kwajalein');
INSERT INTO zones VALUES (2404, 133, 'LAE', 'Lae');
INSERT INTO zones VALUES (2405, 133, 'LIB', 'Lib');
INSERT INTO zones VALUES (2406, 133, 'LKP', 'Likiep');
INSERT INTO zones VALUES (2407, 133, 'MJR', 'Majuro');
INSERT INTO zones VALUES (2408, 133, 'MLP', 'Maloelap');
INSERT INTO zones VALUES (2409, 133, 'MJT', 'Mejit');
INSERT INTO zones VALUES (2410, 133, 'MIL', 'Mili');
INSERT INTO zones VALUES (2411, 133, 'NMK', 'Namorik');
INSERT INTO zones VALUES (2412, 133, 'NAM', 'Namu');
INSERT INTO zones VALUES (2413, 133, 'RGL', 'Rongelap');
INSERT INTO zones VALUES (2414, 133, 'RGK', 'Rongrik');
INSERT INTO zones VALUES (2415, 133, 'TOK', 'Toke');
INSERT INTO zones VALUES (2416, 133, 'UJA', 'Ujae');
INSERT INTO zones VALUES (2417, 133, 'UJL', 'Ujelang');
INSERT INTO zones VALUES (2418, 133, 'UTK', 'Utirik');
INSERT INTO zones VALUES (2419, 133, 'WTH', 'Wotho');
INSERT INTO zones VALUES (2420, 133, 'WTJ', 'Wotje');
INSERT INTO zones VALUES (2421, 134, 'LAJ', 'L''Ajoupa-Bouillon');
INSERT INTO zones VALUES (2422, 134, 'LES', 'Les Anses-d''Arlet');
INSERT INTO zones VALUES (2423, 134, 'BAS', 'Basse-Pointe');
INSERT INTO zones VALUES (2424, 134, 'BEL', 'Bellefontaine');
INSERT INTO zones VALUES (2425, 134, 'LE', 'Le Carbet');
INSERT INTO zones VALUES (2426, 134, 'CAS', 'Case-Pilote');
INSERT INTO zones VALUES (2427, 134, 'LE', 'Le Diamant');
INSERT INTO zones VALUES (2428, 134, 'DUC', 'Ducos');
INSERT INTO zones VALUES (2429, 134, 'FON', 'Fonds-Saint-Denis');
INSERT INTO zones VALUES (2430, 134, 'FOR', 'Fort-De-France');
INSERT INTO zones VALUES (2431, 134, 'LE', 'Le Fran&ccedil;ois');
INSERT INTO zones VALUES (2432, 134, 'GRA', 'Grand''Rivi&egrave;re');
INSERT INTO zones VALUES (2433, 134, 'GRO', 'Gros-Morne');
INSERT INTO zones VALUES (2434, 134, 'LE', 'Le Lamentin');
INSERT INTO zones VALUES (2435, 134, 'LE', 'Le Lorrain');
INSERT INTO zones VALUES (2436, 134, 'MAC', 'Macouba');
INSERT INTO zones VALUES (2437, 134, 'LE', 'Le Marigot');
INSERT INTO zones VALUES (2438, 134, 'LE', 'Le Marin');
INSERT INTO zones VALUES (2439, 134, 'LE', 'Le Morne-Rouge');
INSERT INTO zones VALUES (2440, 134, 'LE', 'Le Morne-Vert');
INSERT INTO zones VALUES (2441, 134, 'LE', 'Le Pr&ecirc;cheur');
INSERT INTO zones VALUES (2442, 134, 'RIV', 'Rivi&egrave;re-Pilote');
INSERT INTO zones VALUES (2443, 134, 'RIV', 'Rivi&egrave;re-Sal&eacute;e');
INSERT INTO zones VALUES (2444, 134, 'LE', 'Le Robert');
INSERT INTO zones VALUES (2445, 134, 'SAI', 'Sainte-Anne');
INSERT INTO zones VALUES (2446, 134, 'SAI', 'Sainte-Luce');
INSERT INTO zones VALUES (2447, 134, 'SAI', 'Sainte-Marie');
INSERT INTO zones VALUES (2448, 134, 'SAI', 'Saint-Esprit');
INSERT INTO zones VALUES (2449, 134, 'SAI', 'Saint-Joseph');
INSERT INTO zones VALUES (2450, 134, 'SAI', 'Saint-Pierre');
INSERT INTO zones VALUES (2451, 134, 'SCH', 'Sch&oelig;lcher');
INSERT INTO zones VALUES (2452, 134, 'LA', 'La Trinit&eacute;');
INSERT INTO zones VALUES (2453, 134, 'LES', 'Les Trois-&Icirc;lets');
INSERT INTO zones VALUES (2454, 134, 'LE', 'Le Vauclin');
INSERT INTO zones VALUES (2455, 135, 'AD', 'Adrar');
INSERT INTO zones VALUES (2456, 135, 'AS', 'Assaba');
INSERT INTO zones VALUES (2457, 135, 'BR', 'Brakna');
INSERT INTO zones VALUES (2458, 135, 'DN', 'Dakhlet Nouadhibou');
INSERT INTO zones VALUES (2459, 135, 'GO', 'Gorgol');
INSERT INTO zones VALUES (2460, 135, 'GM', 'Guidimaka');
INSERT INTO zones VALUES (2461, 135, 'HC', 'Hodh Ech Chargui');
INSERT INTO zones VALUES (2462, 135, 'HG', 'Hodh El Gharbi');
INSERT INTO zones VALUES (2463, 135, 'IN', 'Inchiri');
INSERT INTO zones VALUES (2464, 135, 'TA', 'Tagant');
INSERT INTO zones VALUES (2465, 135, 'TZ', 'Tiris Zemmour');
INSERT INTO zones VALUES (2466, 135, 'TR', 'Trarza');
INSERT INTO zones VALUES (2467, 135, 'NO', 'Nouakchott');
INSERT INTO zones VALUES (2468, 136, 'BR', 'Beau Bassin-Rose Hill');
INSERT INTO zones VALUES (2469, 136, 'CU', 'Curepipe');
INSERT INTO zones VALUES (2470, 136, 'PU', 'Port Louis');
INSERT INTO zones VALUES (2471, 136, 'QB', 'Quatre Bornes');
INSERT INTO zones VALUES (2472, 136, 'VP', 'Vacoas-Phoenix');
INSERT INTO zones VALUES (2473, 136, 'AG', 'Agalega Islands');
INSERT INTO zones VALUES (2474, 136, 'CC', 'Cargados Carajos Shoals (Saint B');
INSERT INTO zones VALUES (2475, 136, 'RO', 'Rodrigues');
INSERT INTO zones VALUES (2476, 136, 'BL', 'Black River');
INSERT INTO zones VALUES (2477, 136, 'FL', 'Flacq');
INSERT INTO zones VALUES (2478, 136, 'GP', 'Grand Port');
INSERT INTO zones VALUES (2479, 136, 'MO', 'Moka');
INSERT INTO zones VALUES (2480, 136, 'PA', 'Pamplemousses');
INSERT INTO zones VALUES (2481, 136, 'PW', 'Plaines Wilhems');
INSERT INTO zones VALUES (2482, 136, 'PL', 'Port Louis');
INSERT INTO zones VALUES (2483, 136, 'RR', 'Riviere du Rempart');
INSERT INTO zones VALUES (2484, 136, 'SA', 'Savanne');
INSERT INTO zones VALUES (2485, 137, 'DZA', 'Dzaoudzi');
INSERT INTO zones VALUES (2486, 137, 'PAM', 'Pamandzi');
INSERT INTO zones VALUES (2487, 137, 'MAM', 'Mamoudzou');
INSERT INTO zones VALUES (2488, 137, 'DEM', 'Dembeni');
INSERT INTO zones VALUES (2489, 137, 'BAN', 'Bandrele');
INSERT INTO zones VALUES (2490, 137, 'KAN', 'Kani-K&eacute;li');
INSERT INTO zones VALUES (2491, 137, 'BOU', 'Bou&eacute;ni');
INSERT INTO zones VALUES (2492, 137, 'CHI', 'Chirongui');
INSERT INTO zones VALUES (2493, 137, 'SAD', 'Sada');
INSERT INTO zones VALUES (2494, 137, 'OUA', 'Ouangani');
INSERT INTO zones VALUES (2495, 137, 'CHI', 'Chiconi');
INSERT INTO zones VALUES (2496, 137, 'TSI', 'Tsingoni');
INSERT INTO zones VALUES (2497, 137, 'MTS', 'M''Tsangamouji');
INSERT INTO zones VALUES (2498, 137, 'ACO', 'Acoua');
INSERT INTO zones VALUES (2499, 137, 'MTS', 'Mtsamboro');
INSERT INTO zones VALUES (2500, 137, 'BAN', 'Bandraboua');
INSERT INTO zones VALUES (2501, 137, 'KOU', 'Koungou');
INSERT INTO zones VALUES (2502, 138, 'AGU', 'Aguascalientes');
INSERT INTO zones VALUES (2503, 138, 'BCN', 'Baja California Norte');
INSERT INTO zones VALUES (2504, 138, 'BCS', 'Baja California Sur');
INSERT INTO zones VALUES (2505, 138, 'CAM', 'Campeche');
INSERT INTO zones VALUES (2506, 138, 'CHP', 'Chiapas');
INSERT INTO zones VALUES (2507, 138, 'CHH', 'Chihuahua');
INSERT INTO zones VALUES (2508, 138, 'COA', 'Coahuila de Zaragoza');
INSERT INTO zones VALUES (2509, 138, 'COL', 'Colima');
INSERT INTO zones VALUES (2510, 138, 'DIF', 'Distrito Federal');
INSERT INTO zones VALUES (2511, 138, 'DUR', 'Durango');
INSERT INTO zones VALUES (2512, 138, 'GUA', 'Guanajuato');
INSERT INTO zones VALUES (2513, 138, 'GRO', 'Guerrero');
INSERT INTO zones VALUES (2514, 138, 'HID', 'Hidalgo');
INSERT INTO zones VALUES (2515, 138, 'JAL', 'Jalisco');
INSERT INTO zones VALUES (2516, 138, 'MEX', 'Mexico');
INSERT INTO zones VALUES (2517, 138, 'MIC', 'Michoacan de Ocampo');
INSERT INTO zones VALUES (2518, 138, 'MOR', 'Morelos');
INSERT INTO zones VALUES (2519, 138, 'NAY', 'Nayarit');
INSERT INTO zones VALUES (2520, 138, 'NLE', 'Nuevo Leon');
INSERT INTO zones VALUES (2521, 138, 'OAX', 'Oaxaca');
INSERT INTO zones VALUES (2522, 138, 'PUE', 'Puebla');
INSERT INTO zones VALUES (2523, 138, 'QUE', 'Queretaro de Arteaga');
INSERT INTO zones VALUES (2524, 138, 'ROO', 'Quintana Roo');
INSERT INTO zones VALUES (2525, 138, 'SLP', 'San Luis Potosi');
INSERT INTO zones VALUES (2526, 138, 'SIN', 'Sinaloa');
INSERT INTO zones VALUES (2527, 138, 'SON', 'Sonora');
INSERT INTO zones VALUES (2528, 138, 'TAB', 'Tabasco');
INSERT INTO zones VALUES (2529, 138, 'TAM', 'Tamaulipas');
INSERT INTO zones VALUES (2530, 138, 'TLA', 'Tlaxcala');
INSERT INTO zones VALUES (2531, 138, 'VER', 'Veracruz-Llave');
INSERT INTO zones VALUES (2532, 138, 'YUC', 'Yucatan');
INSERT INTO zones VALUES (2533, 138, 'ZAC', 'Zacatecas');
INSERT INTO zones VALUES (2534, 139, 'C', 'Chuuk');
INSERT INTO zones VALUES (2535, 139, 'K', 'Kosrae');
INSERT INTO zones VALUES (2536, 139, 'P', 'Pohnpei');
INSERT INTO zones VALUES (2537, 139, 'Y', 'Yap');
INSERT INTO zones VALUES (2538, 140, 'GA', 'Gagauzia');
INSERT INTO zones VALUES (2539, 140, 'CU', 'Chisinau');
INSERT INTO zones VALUES (2540, 140, 'BA', 'Balti');
INSERT INTO zones VALUES (2541, 140, 'CA', 'Cahul');
INSERT INTO zones VALUES (2542, 140, 'ED', 'Edinet');
INSERT INTO zones VALUES (2543, 140, 'LA', 'Lapusna');
INSERT INTO zones VALUES (2544, 140, 'OR', 'Orhei');
INSERT INTO zones VALUES (2545, 140, 'SO', 'Soroca');
INSERT INTO zones VALUES (2546, 140, 'TI', 'Tighina');
INSERT INTO zones VALUES (2547, 140, 'UN', 'Ungheni');
INSERT INTO zones VALUES (2548, 140, 'SN', 'Stânga Nistrului');
INSERT INTO zones VALUES (2549, 141, 'FV', 'Fontvieille');
INSERT INTO zones VALUES (2550, 141, 'LC', 'La Condamine');
INSERT INTO zones VALUES (2551, 141, 'MV', 'Monaco-Ville');
INSERT INTO zones VALUES (2552, 141, 'MC', 'Monte-Carlo');
INSERT INTO zones VALUES (2553, 142, '1', 'Ulanbaatar');
INSERT INTO zones VALUES (2554, 142, '035', 'Orhon');
INSERT INTO zones VALUES (2555, 142, '037', 'Darhan uul');
INSERT INTO zones VALUES (2556, 142, '039', 'Hentiy');
INSERT INTO zones VALUES (2557, 142, '041', 'Hovsgol');
INSERT INTO zones VALUES (2558, 142, '043', 'Hovd');
INSERT INTO zones VALUES (2559, 142, '046', 'Uvs');
INSERT INTO zones VALUES (2560, 142, '047', 'Tov');
INSERT INTO zones VALUES (2561, 142, '049', 'Selenge');
INSERT INTO zones VALUES (2562, 142, '051', 'Suhbaatar');
INSERT INTO zones VALUES (2563, 142, '053', 'Omnogovi');
INSERT INTO zones VALUES (2564, 142, '055', 'Ovorhangay');
INSERT INTO zones VALUES (2565, 142, '057', 'Dzavhan');
INSERT INTO zones VALUES (2566, 142, '059', 'DundgovL');
INSERT INTO zones VALUES (2567, 142, '061', 'Dornod');
INSERT INTO zones VALUES (2568, 142, '063', 'Dornogov');
INSERT INTO zones VALUES (2569, 142, '064', 'Govi-Sumber');
INSERT INTO zones VALUES (2570, 142, '065', 'Govi-Altay');
INSERT INTO zones VALUES (2571, 142, '067', 'Bulgan');
INSERT INTO zones VALUES (2572, 142, '069', 'Bayanhongor');
INSERT INTO zones VALUES (2573, 142, '071', 'Bayan-Olgiy');
INSERT INTO zones VALUES (2574, 142, '073', 'Arhangay');
INSERT INTO zones VALUES (2575, 143, 'A', 'Saint Anthony');
INSERT INTO zones VALUES (2576, 143, 'G', 'Saint Georges');
INSERT INTO zones VALUES (2577, 143, 'P', 'Saint Peter');
INSERT INTO zones VALUES (2578, 144, 'AGD', 'Agadir');
INSERT INTO zones VALUES (2579, 144, 'HOC', 'Al Hoceima');
INSERT INTO zones VALUES (2580, 144, 'AZI', 'Azilal');
INSERT INTO zones VALUES (2581, 144, 'BME', 'Beni Mellal');
INSERT INTO zones VALUES (2582, 144, 'BSL', 'Ben Slimane');
INSERT INTO zones VALUES (2583, 144, 'BLM', 'Boulemane');
INSERT INTO zones VALUES (2584, 144, 'CBL', 'Casablanca');
INSERT INTO zones VALUES (2585, 144, 'CHA', 'Chaouen');
INSERT INTO zones VALUES (2586, 144, 'EJA', 'El Jadida');
INSERT INTO zones VALUES (2587, 144, 'EKS', 'El Kelaa des Sraghna');
INSERT INTO zones VALUES (2588, 144, 'ERA', 'Er Rachidia');
INSERT INTO zones VALUES (2589, 144, 'ESS', 'Essaouira');
INSERT INTO zones VALUES (2590, 144, 'FES', 'Fes');
INSERT INTO zones VALUES (2591, 144, 'FIG', 'Figuig');
INSERT INTO zones VALUES (2592, 144, 'GLM', 'Guelmim');
INSERT INTO zones VALUES (2593, 144, 'IFR', 'Ifrane');
INSERT INTO zones VALUES (2594, 144, 'KEN', 'Kenitra');
INSERT INTO zones VALUES (2595, 144, 'KHM', 'Khemisset');
INSERT INTO zones VALUES (2596, 144, 'KHN', 'Khenifra');
INSERT INTO zones VALUES (2597, 144, 'KHO', 'Khouribga');
INSERT INTO zones VALUES (2598, 144, 'LYN', 'Laayoune');
INSERT INTO zones VALUES (2599, 144, 'LAR', 'Larache');
INSERT INTO zones VALUES (2600, 144, 'MRK', 'Marrakech');
INSERT INTO zones VALUES (2601, 144, 'MKN', 'Meknes');
INSERT INTO zones VALUES (2602, 144, 'NAD', 'Nador');
INSERT INTO zones VALUES (2603, 144, 'ORZ', 'Ouarzazate');
INSERT INTO zones VALUES (2604, 144, 'OUJ', 'Oujda');
INSERT INTO zones VALUES (2605, 144, 'RSA', 'Rabat-Sale');
INSERT INTO zones VALUES (2606, 144, 'SAF', 'Safi');
INSERT INTO zones VALUES (2607, 144, 'SET', 'Settat');
INSERT INTO zones VALUES (2608, 144, 'SKA', 'Sidi Kacem');
INSERT INTO zones VALUES (2609, 144, 'TGR', 'Tangier');
INSERT INTO zones VALUES (2610, 144, 'TAN', 'Tan-Tan');
INSERT INTO zones VALUES (2611, 144, 'TAO', 'Taounate');
INSERT INTO zones VALUES (2612, 144, 'TRD', 'Taroudannt');
INSERT INTO zones VALUES (2613, 144, 'TAT', 'Tata');
INSERT INTO zones VALUES (2614, 144, 'TAZ', 'Taza');
INSERT INTO zones VALUES (2615, 144, 'TET', 'Tetouan');
INSERT INTO zones VALUES (2616, 144, 'TIZ', 'Tiznit');
INSERT INTO zones VALUES (2617, 144, 'ADK', 'Ad Dakhla');
INSERT INTO zones VALUES (2618, 144, 'BJD', 'Boujdour');
INSERT INTO zones VALUES (2619, 144, 'ESM', 'Es Smara');
INSERT INTO zones VALUES (2620, 145, 'CD', 'Cabo Delgado');
INSERT INTO zones VALUES (2621, 145, 'GZ', 'Gaza');
INSERT INTO zones VALUES (2622, 145, 'IN', 'Inhambane');
INSERT INTO zones VALUES (2623, 145, 'MN', 'Manica');
INSERT INTO zones VALUES (2624, 145, 'MC', 'Maputo (city)');
INSERT INTO zones VALUES (2625, 145, 'MP', 'Maputo');
INSERT INTO zones VALUES (2626, 145, 'NA', 'Nampula');
INSERT INTO zones VALUES (2627, 145, 'NI', 'Niassa');
INSERT INTO zones VALUES (2628, 145, 'SO', 'Sofala');
INSERT INTO zones VALUES (2629, 145, 'TE', 'Tete');
INSERT INTO zones VALUES (2630, 145, 'ZA', 'Zambezia');
INSERT INTO zones VALUES (2631, 146, 'AY', 'Ayeyarwady');
INSERT INTO zones VALUES (2632, 146, 'BG', 'Bago');
INSERT INTO zones VALUES (2633, 146, 'MG', 'Magway');
INSERT INTO zones VALUES (2634, 146, 'MD', 'Mandalay');
INSERT INTO zones VALUES (2635, 146, 'SG', 'Sagaing');
INSERT INTO zones VALUES (2636, 146, 'TN', 'Tanintharyi');
INSERT INTO zones VALUES (2637, 146, 'YG', 'Yangon');
INSERT INTO zones VALUES (2638, 146, 'CH', 'Chin State');
INSERT INTO zones VALUES (2639, 146, 'KC', 'Kachin State');
INSERT INTO zones VALUES (2640, 146, 'KH', 'Kayah State');
INSERT INTO zones VALUES (2641, 146, 'KN', 'Kayin State');
INSERT INTO zones VALUES (2642, 146, 'MN', 'Mon State');
INSERT INTO zones VALUES (2643, 146, 'RK', 'Rakhine State');
INSERT INTO zones VALUES (2644, 146, 'SH', 'Shan State');
INSERT INTO zones VALUES (2645, 147, 'CA', 'Caprivi');
INSERT INTO zones VALUES (2646, 147, 'ER', 'Erongo');
INSERT INTO zones VALUES (2647, 147, 'HA', 'Hardap');
INSERT INTO zones VALUES (2648, 147, 'KR', 'Karas');
INSERT INTO zones VALUES (2649, 147, 'KV', 'Kavango');
INSERT INTO zones VALUES (2650, 147, 'KH', 'Khomas');
INSERT INTO zones VALUES (2651, 147, 'KU', 'Kunene');
INSERT INTO zones VALUES (2652, 147, 'OW', 'Ohangwena');
INSERT INTO zones VALUES (2653, 147, 'OK', 'Omaheke');
INSERT INTO zones VALUES (2654, 147, 'OT', 'Omusati');
INSERT INTO zones VALUES (2655, 147, 'ON', 'Oshana');
INSERT INTO zones VALUES (2656, 147, 'OO', 'Oshikoto');
INSERT INTO zones VALUES (2657, 147, 'OJ', 'Otjozondjupa');
INSERT INTO zones VALUES (2658, 148, 'AO', 'Aiwo');
INSERT INTO zones VALUES (2659, 148, 'AA', 'Anabar');
INSERT INTO zones VALUES (2660, 148, 'AT', 'Anetan');
INSERT INTO zones VALUES (2661, 148, 'AI', 'Anibare');
INSERT INTO zones VALUES (2662, 148, 'BA', 'Baiti');
INSERT INTO zones VALUES (2663, 148, 'BO', 'Boe');
INSERT INTO zones VALUES (2664, 148, 'BU', 'Buada');
INSERT INTO zones VALUES (2665, 148, 'DE', 'Denigomodu');
INSERT INTO zones VALUES (2666, 148, 'EW', 'Ewa');
INSERT INTO zones VALUES (2667, 148, 'IJ', 'Ijuw');
INSERT INTO zones VALUES (2668, 148, 'ME', 'Meneng');
INSERT INTO zones VALUES (2669, 148, 'NI', 'Nibok');
INSERT INTO zones VALUES (2670, 148, 'UA', 'Uaboe');
INSERT INTO zones VALUES (2671, 148, 'YA', 'Yaren');
INSERT INTO zones VALUES (2672, 149, 'BA', 'Bagmati');
INSERT INTO zones VALUES (2673, 149, 'BH', 'Bheri');
INSERT INTO zones VALUES (2674, 149, 'DH', 'Dhawalagiri');
INSERT INTO zones VALUES (2675, 149, 'GA', 'Gandaki');
INSERT INTO zones VALUES (2676, 149, 'JA', 'Janakpur');
INSERT INTO zones VALUES (2677, 149, 'KA', 'Karnali');
INSERT INTO zones VALUES (2678, 149, 'KO', 'Kosi');
INSERT INTO zones VALUES (2679, 149, 'LU', 'Lumbini');
INSERT INTO zones VALUES (2680, 149, 'MA', 'Mahakali');
INSERT INTO zones VALUES (2681, 149, 'ME', 'Mechi');
INSERT INTO zones VALUES (2682, 149, 'NA', 'Narayani');
INSERT INTO zones VALUES (2683, 149, 'RA', 'Rapti');
INSERT INTO zones VALUES (2684, 149, 'SA', 'Sagarmatha');
INSERT INTO zones VALUES (2685, 149, 'SE', 'Seti');
INSERT INTO zones VALUES (2686, 150, 'DR', 'Drenthe');
INSERT INTO zones VALUES (2687, 150, 'FL', 'Flevoland');
INSERT INTO zones VALUES (2688, 150, 'FR', 'Friesland');
INSERT INTO zones VALUES (2689, 150, 'GE', 'Gelderland');
INSERT INTO zones VALUES (2690, 150, 'GR', 'Groningen');
INSERT INTO zones VALUES (2691, 150, 'LI', 'Limburg');
INSERT INTO zones VALUES (2692, 150, 'NB', 'Noord Brabant');
INSERT INTO zones VALUES (2693, 150, 'NH', 'Noord Holland');
INSERT INTO zones VALUES (2694, 150, 'OV', 'Overijssel');
INSERT INTO zones VALUES (2695, 150, 'UT', 'Utrecht');
INSERT INTO zones VALUES (2696, 150, 'ZE', 'Zeeland');
INSERT INTO zones VALUES (2697, 150, 'ZH', 'Zuid Holland');
INSERT INTO zones VALUES (2698, 151, 'BON', 'Bonaire');
INSERT INTO zones VALUES (2699, 151, 'CUR', 'Cura&ccedil;ao');
INSERT INTO zones VALUES (2700, 151, 'SAB', 'Saba');
INSERT INTO zones VALUES (2701, 151, 'SEU', 'Sint Eustatius');
INSERT INTO zones VALUES (2702, 151, 'SMA', 'Sint Maarten');
INSERT INTO zones VALUES (2703, 152, 'L', 'Iles Loyaute');
INSERT INTO zones VALUES (2704, 152, 'N', 'Nord');
INSERT INTO zones VALUES (2705, 152, 'S', 'Sud');
INSERT INTO zones VALUES (2706, 153, 'AUK', 'Auckland');
INSERT INTO zones VALUES (2707, 153, 'BOP', 'Bay of Plenty');
INSERT INTO zones VALUES (2708, 153, 'CAN', 'Canterbury');
INSERT INTO zones VALUES (2709, 153, 'COR', 'Coromandel');
INSERT INTO zones VALUES (2710, 153, 'GIS', 'Gisborne');
INSERT INTO zones VALUES (2711, 153, 'FIO', 'Fiordland');
INSERT INTO zones VALUES (2712, 153, 'HKB', 'Hawke''s Bay');
INSERT INTO zones VALUES (2713, 153, 'MBH', 'Marlborough');
INSERT INTO zones VALUES (2714, 153, 'MWT', 'Manawatu-Wanganui');
INSERT INTO zones VALUES (2715, 153, 'MCM', 'Mt Cook-Mackenzie');
INSERT INTO zones VALUES (2716, 153, 'NSN', 'Nelson');
INSERT INTO zones VALUES (2717, 153, 'NTL', 'Northland');
INSERT INTO zones VALUES (2718, 153, 'OTA', 'Otago');
INSERT INTO zones VALUES (2719, 153, 'STL', 'Southland');
INSERT INTO zones VALUES (2720, 153, 'TKI', 'Taranaki');
INSERT INTO zones VALUES (2721, 153, 'WGN', 'Wellington');
INSERT INTO zones VALUES (2722, 153, 'WKO', 'Waikato');
INSERT INTO zones VALUES (2723, 153, 'WAI', 'Wairprarapa');
INSERT INTO zones VALUES (2724, 153, 'WTC', 'West Coast');
INSERT INTO zones VALUES (2725, 154, 'AN', 'Atlantico Norte');
INSERT INTO zones VALUES (2726, 154, 'AS', 'Atlantico Sur');
INSERT INTO zones VALUES (2727, 154, 'BO', 'Boaco');
INSERT INTO zones VALUES (2728, 154, 'CA', 'Carazo');
INSERT INTO zones VALUES (2729, 154, 'CI', 'Chinandega');
INSERT INTO zones VALUES (2730, 154, 'CO', 'Chontales');
INSERT INTO zones VALUES (2731, 154, 'ES', 'Esteli');
INSERT INTO zones VALUES (2732, 154, 'GR', 'Granada');
INSERT INTO zones VALUES (2733, 154, 'JI', 'Jinotega');
INSERT INTO zones VALUES (2734, 154, 'LE', 'Leon');
INSERT INTO zones VALUES (2735, 154, 'MD', 'Madriz');
INSERT INTO zones VALUES (2736, 154, 'MN', 'Managua');
INSERT INTO zones VALUES (2737, 154, 'MS', 'Masaya');
INSERT INTO zones VALUES (2738, 154, 'MT', 'Matagalpa');
INSERT INTO zones VALUES (2739, 154, 'NS', 'Nuevo Segovia');
INSERT INTO zones VALUES (2740, 154, 'RS', 'Rio San Juan');
INSERT INTO zones VALUES (2741, 154, 'RI', 'Rivas');
INSERT INTO zones VALUES (2742, 155, 'AG', 'Agadez');
INSERT INTO zones VALUES (2743, 155, 'DF', 'Diffa');
INSERT INTO zones VALUES (2744, 155, 'DS', 'Dosso');
INSERT INTO zones VALUES (2745, 155, 'MA', 'Maradi');
INSERT INTO zones VALUES (2746, 155, 'NM', 'Niamey');
INSERT INTO zones VALUES (2747, 155, 'TH', 'Tahoua');
INSERT INTO zones VALUES (2748, 155, 'TL', 'Tillaberi');
INSERT INTO zones VALUES (2749, 155, 'ZD', 'Zinder');
INSERT INTO zones VALUES (2750, 156, 'AB', 'Abia');
INSERT INTO zones VALUES (2751, 156, 'CT', 'Abuja Federal Capital Territory');
INSERT INTO zones VALUES (2752, 156, 'AD', 'Adamawa');
INSERT INTO zones VALUES (2753, 156, 'AK', 'Akwa Ibom');
INSERT INTO zones VALUES (2754, 156, 'AN', 'Anambra');
INSERT INTO zones VALUES (2755, 156, 'BC', 'Bauchi');
INSERT INTO zones VALUES (2756, 156, 'BY', 'Bayelsa');
INSERT INTO zones VALUES (2757, 156, 'BN', 'Benue');
INSERT INTO zones VALUES (2758, 156, 'BO', 'Borno');
INSERT INTO zones VALUES (2759, 156, 'CR', 'Cross River');
INSERT INTO zones VALUES (2760, 156, 'DE', 'Delta');
INSERT INTO zones VALUES (2761, 156, 'EB', 'Ebonyi');
INSERT INTO zones VALUES (2762, 156, 'ED', 'Edo');
INSERT INTO zones VALUES (2763, 156, 'EK', 'Ekiti');
INSERT INTO zones VALUES (2764, 156, 'EN', 'Enugu');
INSERT INTO zones VALUES (2765, 156, 'GO', 'Gombe');
INSERT INTO zones VALUES (2766, 156, 'IM', 'Imo');
INSERT INTO zones VALUES (2767, 156, 'JI', 'Jigawa');
INSERT INTO zones VALUES (2768, 156, 'KD', 'Kaduna');
INSERT INTO zones VALUES (2769, 156, 'KN', 'Kano');
INSERT INTO zones VALUES (2770, 156, 'KT', 'Katsina');
INSERT INTO zones VALUES (2771, 156, 'KE', 'Kebbi');
INSERT INTO zones VALUES (2772, 156, 'KO', 'Kogi');
INSERT INTO zones VALUES (2773, 156, 'KW', 'Kwara');
INSERT INTO zones VALUES (2774, 156, 'LA', 'Lagos');
INSERT INTO zones VALUES (2775, 156, 'NA', 'Nassarawa');
INSERT INTO zones VALUES (2776, 156, 'NI', 'Niger');
INSERT INTO zones VALUES (2777, 156, 'OG', 'Ogun');
INSERT INTO zones VALUES (2778, 156, 'ONG', 'Ondo');
INSERT INTO zones VALUES (2779, 156, 'OS', 'Osun');
INSERT INTO zones VALUES (2780, 156, 'OY', 'Oyo');
INSERT INTO zones VALUES (2781, 156, 'PL', 'Plateau');
INSERT INTO zones VALUES (2782, 156, 'RI', 'Rivers');
INSERT INTO zones VALUES (2783, 156, 'SO', 'Sokoto');
INSERT INTO zones VALUES (2784, 156, 'TA', 'Taraba');
INSERT INTO zones VALUES (2785, 156, 'YO', 'Yobe');
INSERT INTO zones VALUES (2786, 156, 'ZA', 'Zamfara');
INSERT INTO zones VALUES (2787, 157, 'MAK', 'Makefu');
INSERT INTO zones VALUES (2788, 157, 'TUA', 'Tuapa');
INSERT INTO zones VALUES (2789, 157, 'NAM', 'Namukulu');
INSERT INTO zones VALUES (2790, 157, 'HIK', 'Hikutavake');
INSERT INTO zones VALUES (2791, 157, 'TOI', 'Toi');
INSERT INTO zones VALUES (2792, 157, 'MUT', 'Mutalau');
INSERT INTO zones VALUES (2793, 157, 'LAK', 'Lakepa');
INSERT INTO zones VALUES (2794, 157, 'LIK', 'Liku');
INSERT INTO zones VALUES (2795, 157, 'HAK', 'Hakupu');
INSERT INTO zones VALUES (2796, 157, 'VAI', 'Vaiea');
INSERT INTO zones VALUES (2797, 157, 'AVA', 'Avatele');
INSERT INTO zones VALUES (2798, 157, 'TAM', 'Tamakautoga');
INSERT INTO zones VALUES (2799, 157, 'ALO', 'Alofi South');
INSERT INTO zones VALUES (2800, 157, 'ALO', 'Alofi North');
INSERT INTO zones VALUES (2801, 158, 'NOR', 'Norfolk Island');
INSERT INTO zones VALUES (2802, 159, 'N', 'Northern Islands');
INSERT INTO zones VALUES (2803, 159, 'R', 'Rota');
INSERT INTO zones VALUES (2804, 159, 'S', 'Saipan');
INSERT INTO zones VALUES (2805, 159, 'T', 'Tinian');
INSERT INTO zones VALUES (2806, 160, 'AK', 'Akershus');
INSERT INTO zones VALUES (2807, 160, 'AA', 'Aust-Agder');
INSERT INTO zones VALUES (2808, 160, 'BU', 'Buskerud');
INSERT INTO zones VALUES (2809, 160, 'FM', 'Finnmark');
INSERT INTO zones VALUES (2810, 160, 'HM', 'Hedmark');
INSERT INTO zones VALUES (2811, 160, 'HL', 'Hordaland');
INSERT INTO zones VALUES (2812, 160, 'MR', 'M&oslash;re og Romsdal');
INSERT INTO zones VALUES (2813, 160, 'NL', 'Nordland');
INSERT INTO zones VALUES (2814, 160, 'NT', 'Nord-Tr&oslash;ndelag');
INSERT INTO zones VALUES (2815, 160, 'OP', 'Oppland');
INSERT INTO zones VALUES (2816, 160, 'OL', 'Oslo');
INSERT INTO zones VALUES (2817, 160, 'RL', 'Rogaland');
INSERT INTO zones VALUES (2818, 160, 'SJ', 'Sogn og Fjordane');
INSERT INTO zones VALUES (2819, 160, 'ST', 'S&oslash;r-Tr&oslash;ndelag');
INSERT INTO zones VALUES (2820, 160, 'SV', 'Svalbard');
INSERT INTO zones VALUES (2821, 160, 'TM', 'Telemark');
INSERT INTO zones VALUES (2822, 160, 'TR', 'Troms');
INSERT INTO zones VALUES (2823, 160, 'VA', 'Vest-Agder');
INSERT INTO zones VALUES (2824, 160, 'VF', 'Vestfold');
INSERT INTO zones VALUES (2825, 160, 'OF', '&Oslash;stfold');
INSERT INTO zones VALUES (2826, 161, 'DA', 'Ad Dakhiliyah');
INSERT INTO zones VALUES (2827, 161, 'BA', 'Al Batinah');
INSERT INTO zones VALUES (2828, 161, 'WU', 'Al Wusta');
INSERT INTO zones VALUES (2829, 161, 'SH', 'Ash Sharqiyah');
INSERT INTO zones VALUES (2830, 161, 'ZA', 'Az Zahirah');
INSERT INTO zones VALUES (2831, 161, 'MA', 'Masqat');
INSERT INTO zones VALUES (2832, 161, 'MU', 'Musandam');
INSERT INTO zones VALUES (2833, 161, 'ZU', 'Zufar');
INSERT INTO zones VALUES (2834, 162, 'B', 'Balochistan');
INSERT INTO zones VALUES (2835, 162, 'T', 'Federally Administered Tribal Ar');
INSERT INTO zones VALUES (2836, 162, 'I', 'Islamabad Capital Territory');
INSERT INTO zones VALUES (2837, 162, 'N', 'North-West Frontier');
INSERT INTO zones VALUES (2838, 162, 'P', 'Punjab');
INSERT INTO zones VALUES (2839, 162, 'S', 'Sindh');
INSERT INTO zones VALUES (2840, 163, 'AM', 'Aimeliik');
INSERT INTO zones VALUES (2841, 163, 'AR', 'Airai');
INSERT INTO zones VALUES (2842, 163, 'AN', 'Angaur');
INSERT INTO zones VALUES (2843, 163, 'HA', 'Hatohobei');
INSERT INTO zones VALUES (2844, 163, 'KA', 'Kayangel');
INSERT INTO zones VALUES (2845, 163, 'KO', 'Koror');
INSERT INTO zones VALUES (2846, 163, 'ME', 'Melekeok');
INSERT INTO zones VALUES (2847, 163, 'NA', 'Ngaraard');
INSERT INTO zones VALUES (2848, 163, 'NG', 'Ngarchelong');
INSERT INTO zones VALUES (2849, 163, 'ND', 'Ngardmau');
INSERT INTO zones VALUES (2850, 163, 'NT', 'Ngatpang');
INSERT INTO zones VALUES (2851, 163, 'NC', 'Ngchesar');
INSERT INTO zones VALUES (2852, 163, 'NR', 'Ngeremlengui');
INSERT INTO zones VALUES (2853, 163, 'NW', 'Ngiwal');
INSERT INTO zones VALUES (2854, 163, 'PE', 'Peleliu');
INSERT INTO zones VALUES (2855, 163, 'SO', 'Sonsorol');
INSERT INTO zones VALUES (2856, 164, 'BT', 'Bocas del Toro');
INSERT INTO zones VALUES (2857, 164, 'CH', 'Chiriqui');
INSERT INTO zones VALUES (2858, 164, 'CC', 'Cocle');
INSERT INTO zones VALUES (2859, 164, 'CL', 'Colon');
INSERT INTO zones VALUES (2860, 164, 'DA', 'Darien');
INSERT INTO zones VALUES (2861, 164, 'HE', 'Herrera');
INSERT INTO zones VALUES (2862, 164, 'LS', 'Los Santos');
INSERT INTO zones VALUES (2863, 164, 'PA', 'Panama');
INSERT INTO zones VALUES (2864, 164, 'SB', 'San Blas');
INSERT INTO zones VALUES (2865, 164, 'VG', 'Veraguas');
INSERT INTO zones VALUES (2866, 165, 'BV', 'Bougainville');
INSERT INTO zones VALUES (2867, 165, 'CE', 'Central');
INSERT INTO zones VALUES (2868, 165, 'CH', 'Chimbu');
INSERT INTO zones VALUES (2869, 165, 'EH', 'Eastern Highlands');
INSERT INTO zones VALUES (2870, 165, 'EB', 'East New Britain');
INSERT INTO zones VALUES (2871, 165, 'ES', 'East Sepik');
INSERT INTO zones VALUES (2872, 165, 'EN', 'Enga');
INSERT INTO zones VALUES (2873, 165, 'GU', 'Gulf');
INSERT INTO zones VALUES (2874, 165, 'MD', 'Madang');
INSERT INTO zones VALUES (2875, 165, 'MN', 'Manus');
INSERT INTO zones VALUES (2876, 165, 'MB', 'Milne Bay');
INSERT INTO zones VALUES (2877, 165, 'MR', 'Morobe');
INSERT INTO zones VALUES (2878, 165, 'NC', 'National Capital');
INSERT INTO zones VALUES (2879, 165, 'NI', 'New Ireland');
INSERT INTO zones VALUES (2880, 165, 'NO', 'Northern');
INSERT INTO zones VALUES (2881, 165, 'SA', 'Sandaun');
INSERT INTO zones VALUES (2882, 165, 'SH', 'Southern Highlands');
INSERT INTO zones VALUES (2883, 165, 'WE', 'Western');
INSERT INTO zones VALUES (2884, 165, 'WH', 'Western Highlands');
INSERT INTO zones VALUES (2885, 165, 'WB', 'West New Britain');
INSERT INTO zones VALUES (2886, 166, 'AG', 'Alto Paraguay');
INSERT INTO zones VALUES (2887, 166, 'AN', 'Alto Parana');
INSERT INTO zones VALUES (2888, 166, 'AM', 'Amambay');
INSERT INTO zones VALUES (2889, 166, 'AS', 'Asuncion');
INSERT INTO zones VALUES (2890, 166, 'BO', 'Boqueron');
INSERT INTO zones VALUES (2891, 166, 'CG', 'Caaguazu');
INSERT INTO zones VALUES (2892, 166, 'CZ', 'Caazapa');
INSERT INTO zones VALUES (2893, 166, 'CN', 'Canindeyu');
INSERT INTO zones VALUES (2894, 166, 'CE', 'Central');
INSERT INTO zones VALUES (2895, 166, 'CC', 'Concepcion');
INSERT INTO zones VALUES (2896, 166, 'CD', 'Cordillera');
INSERT INTO zones VALUES (2897, 166, 'GU', 'Guaira');
INSERT INTO zones VALUES (2898, 166, 'IT', 'Itapua');
INSERT INTO zones VALUES (2899, 166, 'MI', 'Misiones');
INSERT INTO zones VALUES (2900, 166, 'NE', 'Neembucu');
INSERT INTO zones VALUES (2901, 166, 'PA', 'Paraguari');
INSERT INTO zones VALUES (2902, 166, 'PH', 'Presidente Hayes');
INSERT INTO zones VALUES (2903, 166, 'SP', 'San Pedro');
INSERT INTO zones VALUES (2904, 167, 'AM', 'Amazonas');
INSERT INTO zones VALUES (2905, 167, 'AN', 'Ancash');
INSERT INTO zones VALUES (2906, 167, 'AP', 'Apurimac');
INSERT INTO zones VALUES (2907, 167, 'AR', 'Arequipa');
INSERT INTO zones VALUES (2908, 167, 'AY', 'Ayacucho');
INSERT INTO zones VALUES (2909, 167, 'CJ', 'Cajamarca');
INSERT INTO zones VALUES (2910, 167, 'CL', 'Callao');
INSERT INTO zones VALUES (2911, 167, 'CU', 'Cusco');
INSERT INTO zones VALUES (2912, 167, 'HV', 'Huancavelica');
INSERT INTO zones VALUES (2913, 167, 'HO', 'Huanuco');
INSERT INTO zones VALUES (2914, 167, 'IC', 'Ica');
INSERT INTO zones VALUES (2915, 167, 'JU', 'Junin');
INSERT INTO zones VALUES (2916, 167, 'LD', 'La Libertad');
INSERT INTO zones VALUES (2917, 167, 'LY', 'Lambayeque');
INSERT INTO zones VALUES (2918, 167, 'LI', 'Lima');
INSERT INTO zones VALUES (2919, 167, 'LO', 'Loreto');
INSERT INTO zones VALUES (2920, 167, 'MD', 'Madre de Dios');
INSERT INTO zones VALUES (2921, 167, 'MO', 'Moquegua');
INSERT INTO zones VALUES (2922, 167, 'PA', 'Pasco');
INSERT INTO zones VALUES (2923, 167, 'PI', 'Piura');
INSERT INTO zones VALUES (2924, 167, 'PU', 'Puno');
INSERT INTO zones VALUES (2925, 167, 'SM', 'San Martin');
INSERT INTO zones VALUES (2926, 167, 'TA', 'Tacna');
INSERT INTO zones VALUES (2927, 167, 'TU', 'Tumbes');
INSERT INTO zones VALUES (2928, 167, 'UC', 'Ucayali');
INSERT INTO zones VALUES (2929, 168, 'ABR', 'Abra');
INSERT INTO zones VALUES (2930, 168, 'ANO', 'Agusan del Norte');
INSERT INTO zones VALUES (2931, 168, 'ASU', 'Agusan del Sur');
INSERT INTO zones VALUES (2932, 168, 'AKL', 'Aklan');
INSERT INTO zones VALUES (2933, 168, 'ALB', 'Albay');
INSERT INTO zones VALUES (2934, 168, 'ANT', 'Antique');
INSERT INTO zones VALUES (2935, 168, 'APY', 'Apayao');
INSERT INTO zones VALUES (2936, 168, 'AUR', 'Aurora');
INSERT INTO zones VALUES (2937, 168, 'BAS', 'Basilan');
INSERT INTO zones VALUES (2938, 168, 'BTA', 'Bataan');
INSERT INTO zones VALUES (2939, 168, 'BTE', 'Batanes');
INSERT INTO zones VALUES (2940, 168, 'BTG', 'Batangas');
INSERT INTO zones VALUES (2941, 168, 'BLR', 'Biliran');
INSERT INTO zones VALUES (2942, 168, 'BEN', 'Benguet');
INSERT INTO zones VALUES (2943, 168, 'BOL', 'Bohol');
INSERT INTO zones VALUES (2944, 168, 'BUK', 'Bukidnon');
INSERT INTO zones VALUES (2945, 168, 'BUL', 'Bulacan');
INSERT INTO zones VALUES (2946, 168, 'CAG', 'Cagayan');
INSERT INTO zones VALUES (2947, 168, 'CNO', 'Camarines Norte');
INSERT INTO zones VALUES (2948, 168, 'CSU', 'Camarines Sur');
INSERT INTO zones VALUES (2949, 168, 'CAM', 'Camiguin');
INSERT INTO zones VALUES (2950, 168, 'CAP', 'Capiz');
INSERT INTO zones VALUES (2951, 168, 'CAT', 'Catanduanes');
INSERT INTO zones VALUES (2952, 168, 'CAV', 'Cavite');
INSERT INTO zones VALUES (2953, 168, 'CEB', 'Cebu');
INSERT INTO zones VALUES (2954, 168, 'CMP', 'Compostela');
INSERT INTO zones VALUES (2955, 168, 'DNO', 'Davao del Norte');
INSERT INTO zones VALUES (2956, 168, 'DSU', 'Davao del Sur');
INSERT INTO zones VALUES (2957, 168, 'DOR', 'Davao Oriental');
INSERT INTO zones VALUES (2958, 168, 'ESA', 'Eastern Samar');
INSERT INTO zones VALUES (2959, 168, 'GUI', 'Guimaras');
INSERT INTO zones VALUES (2960, 168, 'IFU', 'Ifugao');
INSERT INTO zones VALUES (2961, 168, 'INO', 'Ilocos Norte');
INSERT INTO zones VALUES (2962, 168, 'ISU', 'Ilocos Sur');
INSERT INTO zones VALUES (2963, 168, 'ILO', 'Iloilo');
INSERT INTO zones VALUES (2964, 168, 'ISA', 'Isabela');
INSERT INTO zones VALUES (2965, 168, 'KAL', 'Kalinga');
INSERT INTO zones VALUES (2966, 168, 'LAG', 'Laguna');
INSERT INTO zones VALUES (2967, 168, 'LNO', 'Lanao del Norte');
INSERT INTO zones VALUES (2968, 168, 'LSU', 'Lanao del Sur');
INSERT INTO zones VALUES (2969, 168, 'UNI', 'La Union');
INSERT INTO zones VALUES (2970, 168, 'LEY', 'Leyte');
INSERT INTO zones VALUES (2971, 168, 'MAG', 'Maguindanao');
INSERT INTO zones VALUES (2972, 168, 'MRN', 'Marinduque');
INSERT INTO zones VALUES (2973, 168, 'MSB', 'Masbate');
INSERT INTO zones VALUES (2974, 168, 'MIC', 'Mindoro Occidental');
INSERT INTO zones VALUES (2975, 168, 'MIR', 'Mindoro Oriental');
INSERT INTO zones VALUES (2976, 168, 'MSC', 'Misamis Occidental');
INSERT INTO zones VALUES (2977, 168, 'MOR', 'Misamis Oriental');
INSERT INTO zones VALUES (2978, 168, 'MOP', 'Mountain');
INSERT INTO zones VALUES (2979, 168, 'NOC', 'Negros Occidental');
INSERT INTO zones VALUES (2980, 168, 'NOR', 'Negros Oriental');
INSERT INTO zones VALUES (2981, 168, 'NCT', 'North Cotabato');
INSERT INTO zones VALUES (2982, 168, 'NSM', 'Northern Samar');
INSERT INTO zones VALUES (2983, 168, 'NEC', 'Nueva Ecija');
INSERT INTO zones VALUES (2984, 168, 'NVZ', 'Nueva Vizcaya');
INSERT INTO zones VALUES (2985, 168, 'PLW', 'Palawan');
INSERT INTO zones VALUES (2986, 168, 'PMP', 'Pampanga');
INSERT INTO zones VALUES (2987, 168, 'PNG', 'Pangasinan');
INSERT INTO zones VALUES (2988, 168, 'QZN', 'Quezon');
INSERT INTO zones VALUES (2989, 168, 'QRN', 'Quirino');
INSERT INTO zones VALUES (2990, 168, 'RIZ', 'Rizal');
INSERT INTO zones VALUES (2991, 168, 'ROM', 'Romblon');
INSERT INTO zones VALUES (2992, 168, 'SMR', 'Samar');
INSERT INTO zones VALUES (2993, 168, 'SRG', 'Sarangani');
INSERT INTO zones VALUES (2994, 168, 'SQJ', 'Siquijor');
INSERT INTO zones VALUES (2995, 168, 'SRS', 'Sorsogon');
INSERT INTO zones VALUES (2996, 168, 'SCO', 'South Cotabato');
INSERT INTO zones VALUES (2997, 168, 'SLE', 'Southern Leyte');
INSERT INTO zones VALUES (2998, 168, 'SKU', 'Sultan Kudarat');
INSERT INTO zones VALUES (2999, 168, 'SLU', 'Sulu');
INSERT INTO zones VALUES (3000, 168, 'SNO', 'Surigao del Norte');
INSERT INTO zones VALUES (3001, 168, 'SSU', 'Surigao del Sur');
INSERT INTO zones VALUES (3002, 168, 'TAR', 'Tarlac');
INSERT INTO zones VALUES (3003, 168, 'TAW', 'Tawi-Tawi');
INSERT INTO zones VALUES (3004, 168, 'ZBL', 'Zambales');
INSERT INTO zones VALUES (3005, 168, 'ZNO', 'Zamboanga del Norte');
INSERT INTO zones VALUES (3006, 168, 'ZSU', 'Zamboanga del Sur');
INSERT INTO zones VALUES (3007, 168, 'ZSI', 'Zamboanga Sibugay');
INSERT INTO zones VALUES (3008, 169, 'PIT', 'Pitcairn Island');
INSERT INTO zones VALUES (3009, 170, 'DO', 'Dolnoslaskie');
INSERT INTO zones VALUES (3010, 170, 'KP', 'Kujawsko-Pomorskie');
INSERT INTO zones VALUES (3011, 170, 'LO', 'Lodzkie');
INSERT INTO zones VALUES (3012, 170, 'LL', 'Lubelskie');
INSERT INTO zones VALUES (3013, 170, 'LU', 'Lubuskie');
INSERT INTO zones VALUES (3014, 170, 'ML', 'Malopolskie');
INSERT INTO zones VALUES (3015, 170, 'MZ', 'Mazowieckie');
INSERT INTO zones VALUES (3016, 170, 'OP', 'Opolskie');
INSERT INTO zones VALUES (3017, 170, 'PP', 'Podkarpackie');
INSERT INTO zones VALUES (3018, 170, 'PL', 'Podlaskie');
INSERT INTO zones VALUES (3019, 170, 'PM', 'Pomorskie');
INSERT INTO zones VALUES (3020, 170, 'SL', 'Slaskie');
INSERT INTO zones VALUES (3021, 170, 'SW', 'Swietokrzyskie');
INSERT INTO zones VALUES (3022, 170, 'WM', 'Warminsko-Mazurskie');
INSERT INTO zones VALUES (3023, 170, 'WP', 'Wielkopolskie');
INSERT INTO zones VALUES (3024, 170, 'ZA', 'Zachodniopomorskie');
INSERT INTO zones VALUES (3025, 171, 'AC', 'A&ccedil;ores');
INSERT INTO zones VALUES (3026, 171, 'AV', 'Aveiro');
INSERT INTO zones VALUES (3027, 171, 'BE', 'Beja');
INSERT INTO zones VALUES (3028, 171, 'BR', 'Braga');
INSERT INTO zones VALUES (3029, 171, 'BA', 'Bragan&ccedil;a');
INSERT INTO zones VALUES (3030, 171, 'CB', 'Castelo Branco');
INSERT INTO zones VALUES (3031, 171, 'CO', 'Coimbra');
INSERT INTO zones VALUES (3032, 171, 'EV', '&Eacute;vora');
INSERT INTO zones VALUES (3033, 171, 'FA', 'Faro');
INSERT INTO zones VALUES (3034, 171, 'GU', 'Guarda');
INSERT INTO zones VALUES (3035, 171, 'LE', 'Leiria');
INSERT INTO zones VALUES (3036, 171, 'LI', 'Lisboa');
INSERT INTO zones VALUES (3037, 171, 'ME', 'Madeira');
INSERT INTO zones VALUES (3038, 171, 'PO', 'Portalegre');
INSERT INTO zones VALUES (3039, 171, 'PR', 'Porto');
INSERT INTO zones VALUES (3040, 171, 'SA', 'Santar&eacute;m');
INSERT INTO zones VALUES (3041, 171, 'SE', 'Set&uacute;bal');
INSERT INTO zones VALUES (3042, 171, 'VC', 'Viana do Castelo');
INSERT INTO zones VALUES (3043, 171, 'VR', 'Vila Real');
INSERT INTO zones VALUES (3044, 171, 'VI', 'Viseu');
INSERT INTO zones VALUES (3045, 172, 'ADJ', 'Adjuntas');
INSERT INTO zones VALUES (3046, 172, 'AGU', 'Aguada');
INSERT INTO zones VALUES (3047, 172, 'AGU', 'Aguadilla');
INSERT INTO zones VALUES (3048, 172, 'AGU', 'Aguas Buenas');
INSERT INTO zones VALUES (3049, 172, 'AIB', 'Aibonito');
INSERT INTO zones VALUES (3050, 172, 'A-A', 'Añasco');
INSERT INTO zones VALUES (3051, 172, 'ARE', 'Arecibo');
INSERT INTO zones VALUES (3052, 172, 'ARR', 'Arroyo');
INSERT INTO zones VALUES (3053, 172, 'BAR', 'Barceloneta');
INSERT INTO zones VALUES (3054, 172, 'BAR', 'Barranquitas');
INSERT INTO zones VALUES (3055, 172, 'BAY', 'Bayam&oacute;n');
INSERT INTO zones VALUES (3056, 172, 'CAB', 'Cabo Rojo');
INSERT INTO zones VALUES (3057, 172, 'CAG', 'Caguas');
INSERT INTO zones VALUES (3058, 172, 'CAM', 'Camuy');
INSERT INTO zones VALUES (3059, 172, 'CAN', 'Can&oacute;vanas');
INSERT INTO zones VALUES (3060, 172, 'CAR', 'Carolina');
INSERT INTO zones VALUES (3061, 172, 'CAT', 'Cata&ntilde;o');
INSERT INTO zones VALUES (3062, 172, 'CAY', 'Cayey');
INSERT INTO zones VALUES (3063, 172, 'CEI', 'Ceiba');
INSERT INTO zones VALUES (3064, 172, 'CIA', 'Ciales');
INSERT INTO zones VALUES (3065, 172, 'CID', 'Cidra');
INSERT INTO zones VALUES (3066, 172, 'COA', 'Coamo');
INSERT INTO zones VALUES (3067, 172, 'COM', 'Comer&iacute;o');
INSERT INTO zones VALUES (3068, 172, 'COR', 'Corozal');
INSERT INTO zones VALUES (3069, 172, 'CUL', 'Culebra');
INSERT INTO zones VALUES (3070, 172, 'DOR', 'Dorado');
INSERT INTO zones VALUES (3071, 172, 'FAJ', 'Fajardo');
INSERT INTO zones VALUES (3072, 172, 'FLO', 'Florida.');
INSERT INTO zones VALUES (3073, 172, 'GU¡', 'Guánica');
INSERT INTO zones VALUES (3074, 172, 'GUA', 'Guayama');
INSERT INTO zones VALUES (3075, 172, 'GUA', 'Guayanilla');
INSERT INTO zones VALUES (3076, 172, 'GUA', 'Guaynabo');
INSERT INTO zones VALUES (3077, 172, 'GUR', 'Gurabo');
INSERT INTO zones VALUES (3078, 172, 'HAT', 'Hatillo');
INSERT INTO zones VALUES (3079, 172, 'HOR', 'Hormigueros');
INSERT INTO zones VALUES (3080, 172, 'HUM', 'Humacao');
INSERT INTO zones VALUES (3081, 172, 'ISA', 'Isabela');
INSERT INTO zones VALUES (3082, 172, 'JAY', 'Jayuya');
INSERT INTO zones VALUES (3083, 172, 'JUA', 'Juana D&iacute;az');
INSERT INTO zones VALUES (3084, 172, 'JUN', 'Juncos');
INSERT INTO zones VALUES (3085, 172, 'LAJ', 'Lajas');
INSERT INTO zones VALUES (3086, 172, 'LAR', 'Lares');
INSERT INTO zones VALUES (3087, 172, 'LAS', 'Las Mar&iacute;as');
INSERT INTO zones VALUES (3088, 172, 'LAS', 'Las Piedras');
INSERT INTO zones VALUES (3089, 172, 'LOÕ', 'Loíza');
INSERT INTO zones VALUES (3090, 172, 'LUQ', 'Luquillo');
INSERT INTO zones VALUES (3091, 172, 'MAN', 'Manat&iacute;');
INSERT INTO zones VALUES (3092, 172, 'MAR', 'Maricao');
INSERT INTO zones VALUES (3093, 172, 'MAU', 'Maunabo');
INSERT INTO zones VALUES (3094, 172, 'MAY', 'Mayagüez');
INSERT INTO zones VALUES (3095, 172, 'MOC', 'Moca');
INSERT INTO zones VALUES (3096, 172, 'MOR', 'Morovis');
INSERT INTO zones VALUES (3097, 172, 'NAG', 'Naguabo');
INSERT INTO zones VALUES (3098, 172, 'NAR', 'Naranjito');
INSERT INTO zones VALUES (3099, 172, 'ORO', 'Orocovis');
INSERT INTO zones VALUES (3100, 172, 'PAT', 'Patillas');
INSERT INTO zones VALUES (3101, 172, 'PE-', 'Peñuelas');
INSERT INTO zones VALUES (3102, 172, 'PON', 'Ponce');
INSERT INTO zones VALUES (3103, 172, 'QUE', 'Quebradillas');
INSERT INTO zones VALUES (3104, 172, 'RIN', 'Rinc&oacute;n');
INSERT INTO zones VALUES (3105, 172, 'RÕO', 'Río Grande');
INSERT INTO zones VALUES (3106, 172, 'SAB', 'Sabana Grande');
INSERT INTO zones VALUES (3107, 172, 'SAL', 'Salinas');
INSERT INTO zones VALUES (3108, 172, 'SAN', 'San Germ&aacute;n');
INSERT INTO zones VALUES (3109, 172, 'SAN', 'San Juan');
INSERT INTO zones VALUES (3110, 172, 'SAN', 'San Lorenzo');
INSERT INTO zones VALUES (3111, 172, 'SAN', 'San Sebasti&aacute;n');
INSERT INTO zones VALUES (3112, 172, 'SAN', 'Santa Isabel');
INSERT INTO zones VALUES (3113, 172, 'TOA', 'Toa Alta');
INSERT INTO zones VALUES (3114, 172, 'TOA', 'Toa Baja');
INSERT INTO zones VALUES (3115, 172, 'TRU', 'Trujillo Alto');
INSERT INTO zones VALUES (3116, 172, 'UTU', 'Utuado');
INSERT INTO zones VALUES (3117, 172, 'VEG', 'Vega Alta');
INSERT INTO zones VALUES (3118, 172, 'VEG', 'Vega Baja');
INSERT INTO zones VALUES (3119, 172, 'VIE', 'Vieques');
INSERT INTO zones VALUES (3120, 172, 'VIL', 'Villalba');
INSERT INTO zones VALUES (3121, 172, 'YAB', 'Yabucoa');
INSERT INTO zones VALUES (3122, 172, 'YAU', 'Yauco');
INSERT INTO zones VALUES (3123, 173, 'DW', 'Ad Dawhah');
INSERT INTO zones VALUES (3124, 173, 'GW', 'Al Ghuwayriyah');
INSERT INTO zones VALUES (3125, 173, 'JM', 'Al Jumayliyah');
INSERT INTO zones VALUES (3126, 173, 'KR', 'Al Khawr');
INSERT INTO zones VALUES (3127, 173, 'WK', 'Al Wakrah');
INSERT INTO zones VALUES (3128, 173, 'RN', 'Ar Rayyan');
INSERT INTO zones VALUES (3129, 173, 'JB', 'Jarayan al Batinah');
INSERT INTO zones VALUES (3130, 173, 'MS', 'Madinat ash Shamal');
INSERT INTO zones VALUES (3131, 173, 'UD', 'Umm Sa''id');
INSERT INTO zones VALUES (3132, 173, 'UL', 'Umm Salal');
INSERT INTO zones VALUES (3133, 175, 'AB', 'Alba');
INSERT INTO zones VALUES (3134, 175, 'AR', 'Arad');
INSERT INTO zones VALUES (3135, 175, 'AG', 'Arges');
INSERT INTO zones VALUES (3136, 175, 'BC', 'Bacau');
INSERT INTO zones VALUES (3137, 175, 'BH', 'Bihor');
INSERT INTO zones VALUES (3138, 175, 'BN', 'Bistrita-Nasaud');
INSERT INTO zones VALUES (3139, 175, 'BT', 'Botosani');
INSERT INTO zones VALUES (3140, 175, 'BV', 'Brasov');
INSERT INTO zones VALUES (3141, 175, 'BR', 'Braila');
INSERT INTO zones VALUES (3142, 175, 'B', 'Bucuresti');
INSERT INTO zones VALUES (3143, 175, 'BZ', 'Buzau');
INSERT INTO zones VALUES (3144, 175, 'CS', 'Caras-Severin');
INSERT INTO zones VALUES (3145, 175, 'CL', 'Calarasi');
INSERT INTO zones VALUES (3146, 175, 'CJ', 'Cluj');
INSERT INTO zones VALUES (3147, 175, 'CT', 'Constanta');
INSERT INTO zones VALUES (3148, 175, 'CV', 'Covasna');
INSERT INTO zones VALUES (3149, 175, 'DB', 'Dimbovita');
INSERT INTO zones VALUES (3150, 175, 'DJ', 'Dolj');
INSERT INTO zones VALUES (3151, 175, 'GL', 'Galati');
INSERT INTO zones VALUES (3152, 175, 'GR', 'Giurgiu');
INSERT INTO zones VALUES (3153, 175, 'GJ', 'Gorj');
INSERT INTO zones VALUES (3154, 175, 'HR', 'Harghita');
INSERT INTO zones VALUES (3155, 175, 'HD', 'Hunedoara');
INSERT INTO zones VALUES (3156, 175, 'IL', 'Ialomita');
INSERT INTO zones VALUES (3157, 175, 'IS', 'Iasi');
INSERT INTO zones VALUES (3158, 175, 'IF', 'Ilfov');
INSERT INTO zones VALUES (3159, 175, 'MM', 'Maramures');
INSERT INTO zones VALUES (3160, 175, 'MH', 'Mehedinti');
INSERT INTO zones VALUES (3161, 175, 'MS', 'Mures');
INSERT INTO zones VALUES (3162, 175, 'NT', 'Neamt');
INSERT INTO zones VALUES (3163, 175, 'OT', 'Olt');
INSERT INTO zones VALUES (3164, 175, 'PH', 'Prahova');
INSERT INTO zones VALUES (3165, 175, 'SM', 'Satu-Mare');
INSERT INTO zones VALUES (3166, 175, 'SJ', 'Salaj');
INSERT INTO zones VALUES (3167, 175, 'SB', 'Sibiu');
INSERT INTO zones VALUES (3168, 175, 'SV', 'Suceava');
INSERT INTO zones VALUES (3169, 175, 'TR', 'Teleorman');
INSERT INTO zones VALUES (3170, 175, 'TM', 'Timis');
INSERT INTO zones VALUES (3171, 175, 'TL', 'Tulcea');
INSERT INTO zones VALUES (3172, 175, 'VS', 'Vaslui');
INSERT INTO zones VALUES (3173, 175, 'VL', 'Valcea');
INSERT INTO zones VALUES (3174, 175, 'VN', 'Vrancea');
INSERT INTO zones VALUES (3175, 176, 'AB', 'Abakan');
INSERT INTO zones VALUES (3176, 176, 'AG', 'Aginskoye');
INSERT INTO zones VALUES (3177, 176, 'AN', 'Anadyr');
INSERT INTO zones VALUES (3178, 176, 'AR', 'Arkahangelsk');
INSERT INTO zones VALUES (3179, 176, 'AS', 'Astrakhan');
INSERT INTO zones VALUES (3180, 176, 'BA', 'Barnaul');
INSERT INTO zones VALUES (3181, 176, 'BE', 'Belgorod');
INSERT INTO zones VALUES (3182, 176, 'BI', 'Birobidzhan');
INSERT INTO zones VALUES (3183, 176, 'BL', 'Blagoveshchensk');
INSERT INTO zones VALUES (3184, 176, 'BR', 'Bryansk');
INSERT INTO zones VALUES (3185, 176, 'CH', 'Cheboksary');
INSERT INTO zones VALUES (3186, 176, 'CL', 'Chelyabinsk');
INSERT INTO zones VALUES (3187, 176, 'CR', 'Cherkessk');
INSERT INTO zones VALUES (3188, 176, 'CI', 'Chita');
INSERT INTO zones VALUES (3189, 176, 'DU', 'Dudinka');
INSERT INTO zones VALUES (3190, 176, 'EL', 'Elista');
INSERT INTO zones VALUES (3191, 176, 'GO', 'Gomo-Altaysk');
INSERT INTO zones VALUES (3192, 176, 'GA', 'Gorno-Altaysk');
INSERT INTO zones VALUES (3193, 176, 'GR', 'Groznyy');
INSERT INTO zones VALUES (3194, 176, 'IR', 'Irkutsk');
INSERT INTO zones VALUES (3195, 176, 'IV', 'Ivanovo');
INSERT INTO zones VALUES (3196, 176, 'IZ', 'Izhevsk');
INSERT INTO zones VALUES (3197, 176, 'KA', 'Kalinigrad');
INSERT INTO zones VALUES (3198, 176, 'KL', 'Kaluga');
INSERT INTO zones VALUES (3199, 176, 'KS', 'Kasnodar');
INSERT INTO zones VALUES (3200, 176, 'KZ', 'Kazan');
INSERT INTO zones VALUES (3201, 176, 'KE', 'Kemerovo');
INSERT INTO zones VALUES (3202, 176, 'KH', 'Khabarovsk');
INSERT INTO zones VALUES (3203, 176, 'KM', 'Khanty-Mansiysk');
INSERT INTO zones VALUES (3204, 176, 'KO', 'Kostroma');
INSERT INTO zones VALUES (3205, 176, 'KR', 'Krasnodar');
INSERT INTO zones VALUES (3206, 176, 'KN', 'Krasnoyarsk');
INSERT INTO zones VALUES (3207, 176, 'KU', 'Kudymkar');
INSERT INTO zones VALUES (3208, 176, 'KG', 'Kurgan');
INSERT INTO zones VALUES (3209, 176, 'KK', 'Kursk');
INSERT INTO zones VALUES (3210, 176, 'KY', 'Kyzyl');
INSERT INTO zones VALUES (3211, 176, 'LI', 'Lipetsk');
INSERT INTO zones VALUES (3212, 176, 'MA', 'Magadan');
INSERT INTO zones VALUES (3213, 176, 'MK', 'Makhachkala');
INSERT INTO zones VALUES (3214, 176, 'MY', 'Maykop');
INSERT INTO zones VALUES (3215, 176, 'MO', 'Moscow');
INSERT INTO zones VALUES (3216, 176, 'MU', 'Murmansk');
INSERT INTO zones VALUES (3217, 176, 'NA', 'Nalchik');
INSERT INTO zones VALUES (3218, 176, 'NR', 'Naryan Mar');
INSERT INTO zones VALUES (3219, 176, 'NZ', 'Nazran');
INSERT INTO zones VALUES (3220, 176, 'NI', 'Nizhniy Novgorod');
INSERT INTO zones VALUES (3221, 176, 'NO', 'Novgorod');
INSERT INTO zones VALUES (3222, 176, 'NV', 'Novosibirsk');
INSERT INTO zones VALUES (3223, 176, 'OM', 'Omsk');
INSERT INTO zones VALUES (3224, 176, 'OR', 'Orel');
INSERT INTO zones VALUES (3225, 176, 'OE', 'Orenburg');
INSERT INTO zones VALUES (3226, 176, 'PA', 'Palana');
INSERT INTO zones VALUES (3227, 176, 'PE', 'Penza');
INSERT INTO zones VALUES (3228, 176, 'PR', 'Perm');
INSERT INTO zones VALUES (3229, 176, 'PK', 'Petropavlovsk-Kamchatskiy');
INSERT INTO zones VALUES (3230, 176, 'PT', 'Petrozavodsk');
INSERT INTO zones VALUES (3231, 176, 'PS', 'Pskov');
INSERT INTO zones VALUES (3232, 176, 'RO', 'Rostov-na-Donu');
INSERT INTO zones VALUES (3233, 176, 'RY', 'Ryazan');
INSERT INTO zones VALUES (3234, 176, 'SL', 'Salekhard');
INSERT INTO zones VALUES (3235, 176, 'SA', 'Samara');
INSERT INTO zones VALUES (3236, 176, 'SR', 'Saransk');
INSERT INTO zones VALUES (3237, 176, 'SV', 'Saratov');
INSERT INTO zones VALUES (3238, 176, 'SM', 'Smolensk');
INSERT INTO zones VALUES (3239, 176, 'SP', 'St. Petersburg');
INSERT INTO zones VALUES (3240, 176, 'ST', 'Stavropol');
INSERT INTO zones VALUES (3241, 176, 'SY', 'Syktyvkar');
INSERT INTO zones VALUES (3242, 176, 'TA', 'Tambov');
INSERT INTO zones VALUES (3243, 176, 'TO', 'Tomsk');
INSERT INTO zones VALUES (3244, 176, 'TU', 'Tula');
INSERT INTO zones VALUES (3245, 176, 'TR', 'Tura');
INSERT INTO zones VALUES (3246, 176, 'TV', 'Tver');
INSERT INTO zones VALUES (3247, 176, 'TY', 'Tyumen');
INSERT INTO zones VALUES (3248, 176, 'UF', 'Ufa');
INSERT INTO zones VALUES (3249, 176, 'UL', 'Ul''yanovsk');
INSERT INTO zones VALUES (3250, 176, 'UU', 'Ulan-Ude');
INSERT INTO zones VALUES (3251, 176, 'US', 'Ust''-Ordynskiy');
INSERT INTO zones VALUES (3252, 176, 'VL', 'Vladikavkaz');
INSERT INTO zones VALUES (3253, 176, 'VA', 'Vladimir');
INSERT INTO zones VALUES (3254, 176, 'VV', 'Vladivostok');
INSERT INTO zones VALUES (3255, 176, 'VG', 'Volgograd');
INSERT INTO zones VALUES (3256, 176, 'VD', 'Vologda');
INSERT INTO zones VALUES (3257, 176, 'VO', 'Voronezh');
INSERT INTO zones VALUES (3258, 176, 'VY', 'Vyatka');
INSERT INTO zones VALUES (3259, 176, 'YA', 'Yakutsk');
INSERT INTO zones VALUES (3260, 176, 'YR', 'Yaroslavl');
INSERT INTO zones VALUES (3261, 176, 'YE', 'Yekaterinburg');
INSERT INTO zones VALUES (3262, 176, 'YO', 'Yoshkar-Ola');
INSERT INTO zones VALUES (3263, 177, 'BU', 'Butare');
INSERT INTO zones VALUES (3264, 177, 'BY', 'Byumba');
INSERT INTO zones VALUES (3265, 177, 'CY', 'Cyangugu');
INSERT INTO zones VALUES (3266, 177, 'GK', 'Gikongoro');
INSERT INTO zones VALUES (3267, 177, 'GS', 'Gisenyi');
INSERT INTO zones VALUES (3268, 177, 'GT', 'Gitarama');
INSERT INTO zones VALUES (3269, 177, 'KG', 'Kibungo');
INSERT INTO zones VALUES (3270, 177, 'KY', 'Kibuye');
INSERT INTO zones VALUES (3271, 177, 'KR', 'Kigali Rurale');
INSERT INTO zones VALUES (3272, 177, 'KV', 'Kigali-ville');
INSERT INTO zones VALUES (3273, 177, 'RU', 'Ruhengeri');
INSERT INTO zones VALUES (3274, 177, 'UM', 'Umutara');
INSERT INTO zones VALUES (3275, 178, 'CCN', 'Christ Church Nichola Town');
INSERT INTO zones VALUES (3276, 178, 'SAS', 'Saint Anne Sandy Point');
INSERT INTO zones VALUES (3277, 178, 'SGB', 'Saint George Basseterre');
INSERT INTO zones VALUES (3278, 178, 'SGG', 'Saint George Gingerland');
INSERT INTO zones VALUES (3279, 178, 'SJW', 'Saint James Windward');
INSERT INTO zones VALUES (3280, 178, 'SJC', 'Saint John Capesterre');
INSERT INTO zones VALUES (3281, 178, 'SJF', 'Saint John Figtree');
INSERT INTO zones VALUES (3282, 178, 'SMC', 'Saint Mary Cayon');
INSERT INTO zones VALUES (3283, 178, 'CAP', 'Saint Paul Capesterre');
INSERT INTO zones VALUES (3284, 178, 'CHA', 'Saint Paul Charlestown');
INSERT INTO zones VALUES (3285, 178, 'SPB', 'Saint Peter Basseterre');
INSERT INTO zones VALUES (3286, 178, 'STL', 'Saint Thomas Lowland');
INSERT INTO zones VALUES (3287, 178, 'STM', 'Saint Thomas Middle Island');
INSERT INTO zones VALUES (3288, 178, 'TPP', 'Trinity Palmetto Point');
INSERT INTO zones VALUES (3289, 179, 'AR', 'Anse-la-Raye');
INSERT INTO zones VALUES (3290, 179, 'CA', 'Castries');
INSERT INTO zones VALUES (3291, 179, 'CH', 'Choiseul');
INSERT INTO zones VALUES (3292, 179, 'DA', 'Dauphin');
INSERT INTO zones VALUES (3293, 179, 'DE', 'Dennery');
INSERT INTO zones VALUES (3294, 179, 'GI', 'Gros-Islet');
INSERT INTO zones VALUES (3295, 179, 'LA', 'Laborie');
INSERT INTO zones VALUES (3296, 179, 'MI', 'Micoud');
INSERT INTO zones VALUES (3297, 179, 'PR', 'Praslin');
INSERT INTO zones VALUES (3298, 179, 'SO', 'Soufriere');
INSERT INTO zones VALUES (3299, 179, 'VF', 'Vieux-Fort');
INSERT INTO zones VALUES (3300, 180, 'C', 'Charlotte');
INSERT INTO zones VALUES (3301, 180, 'R', 'Grenadines');
INSERT INTO zones VALUES (3302, 180, 'A', 'Saint Andrew');
INSERT INTO zones VALUES (3303, 180, 'D', 'Saint David');
INSERT INTO zones VALUES (3304, 180, 'G', 'Saint George');
INSERT INTO zones VALUES (3305, 180, 'P', 'Saint Patrick');
INSERT INTO zones VALUES (3306, 181, 'AN', 'A''ana');
INSERT INTO zones VALUES (3307, 181, 'AI', 'Aiga-i-le-Tai');
INSERT INTO zones VALUES (3308, 181, 'AT', 'Atua');
INSERT INTO zones VALUES (3309, 181, 'FA', 'Fa''asaleleaga');
INSERT INTO zones VALUES (3310, 181, 'GE', 'Gaga''emauga');
INSERT INTO zones VALUES (3311, 181, 'GF', 'Gagaifomauga');
INSERT INTO zones VALUES (3312, 181, 'PA', 'Palauli');
INSERT INTO zones VALUES (3313, 181, 'SA', 'Satupa''itea');
INSERT INTO zones VALUES (3314, 181, 'TU', 'Tuamasaga');
INSERT INTO zones VALUES (3315, 181, 'VF', 'Va''a-o-Fonoti');
INSERT INTO zones VALUES (3316, 181, 'VS', 'Vaisigano');
INSERT INTO zones VALUES (3317, 182, 'AC', 'Acquaviva');
INSERT INTO zones VALUES (3318, 182, 'BM', 'Borgo Maggiore');
INSERT INTO zones VALUES (3319, 182, 'CH', 'Chiesanuova');
INSERT INTO zones VALUES (3320, 182, 'DO', 'Domagnano');
INSERT INTO zones VALUES (3321, 182, 'FA', 'Faetano');
INSERT INTO zones VALUES (3322, 182, 'FI', 'Fiorentino');
INSERT INTO zones VALUES (3323, 182, 'MO', 'Montegiardino');
INSERT INTO zones VALUES (3324, 182, 'SM', 'Citta di San Marino');
INSERT INTO zones VALUES (3325, 182, 'SE', 'Serravalle');
INSERT INTO zones VALUES (3326, 183, 'S', 'Sao Tome');
INSERT INTO zones VALUES (3327, 183, 'P', 'Principe');
INSERT INTO zones VALUES (3328, 184, 'BH', 'Al Bahah');
INSERT INTO zones VALUES (3329, 184, 'HS', 'Al Hudud ash Shamaliyah');
INSERT INTO zones VALUES (3330, 184, 'JF', 'Al Jawf');
INSERT INTO zones VALUES (3331, 184, 'MD', 'Al Madinah');
INSERT INTO zones VALUES (3332, 184, 'QS', 'Al Qasim');
INSERT INTO zones VALUES (3333, 184, 'RD', 'Ar Riyad');
INSERT INTO zones VALUES (3334, 184, 'AQ', 'Ash Sharqiyah (Eastern)');
INSERT INTO zones VALUES (3335, 184, 'AS', '''Asir');
INSERT INTO zones VALUES (3336, 184, 'HL', 'Ha''il');
INSERT INTO zones VALUES (3337, 184, 'JZ', 'Jizan');
INSERT INTO zones VALUES (3338, 184, 'ML', 'Makkah');
INSERT INTO zones VALUES (3339, 184, 'NR', 'Najran');
INSERT INTO zones VALUES (3340, 184, 'TB', 'Tabuk');
INSERT INTO zones VALUES (3341, 185, 'DA', 'Dakar');
INSERT INTO zones VALUES (3342, 185, 'DI', 'Diourbel');
INSERT INTO zones VALUES (3343, 185, 'FA', 'Fatick');
INSERT INTO zones VALUES (3344, 185, 'KA', 'Kaolack');
INSERT INTO zones VALUES (3345, 185, 'KO', 'Kolda');
INSERT INTO zones VALUES (3346, 185, 'LO', 'Louga');
INSERT INTO zones VALUES (3347, 185, 'MA', 'Matam');
INSERT INTO zones VALUES (3348, 185, 'SL', 'Saint-Louis');
INSERT INTO zones VALUES (3349, 185, 'TA', 'Tambacounda');
INSERT INTO zones VALUES (3350, 185, 'TH', 'Thies');
INSERT INTO zones VALUES (3351, 185, 'ZI', 'Ziguinchor');
INSERT INTO zones VALUES (3352, 186, 'AP', 'Anse aux Pins');
INSERT INTO zones VALUES (3353, 186, 'AB', 'Anse Boileau');
INSERT INTO zones VALUES (3354, 186, 'AE', 'Anse Etoile');
INSERT INTO zones VALUES (3355, 186, 'AL', 'Anse Louis');
INSERT INTO zones VALUES (3356, 186, 'AR', 'Anse Royale');
INSERT INTO zones VALUES (3357, 186, 'BL', 'Baie Lazare');
INSERT INTO zones VALUES (3358, 186, 'BS', 'Baie Sainte Anne');
INSERT INTO zones VALUES (3359, 186, 'BV', 'Beau Vallon');
INSERT INTO zones VALUES (3360, 186, 'BA', 'Bel Air');
INSERT INTO zones VALUES (3361, 186, 'BO', 'Bel Ombre');
INSERT INTO zones VALUES (3362, 186, 'CA', 'Cascade');
INSERT INTO zones VALUES (3363, 186, 'GL', 'Glacis');
INSERT INTO zones VALUES (3364, 186, 'GM', 'Grand'' Anse (on Mahe)');
INSERT INTO zones VALUES (3365, 186, 'GP', 'Grand'' Anse (on Praslin)');
INSERT INTO zones VALUES (3366, 186, 'DG', 'La Digue');
INSERT INTO zones VALUES (3367, 186, 'RA', 'La Riviere Anglaise');
INSERT INTO zones VALUES (3368, 186, 'MB', 'Mont Buxton');
INSERT INTO zones VALUES (3369, 186, 'MF', 'Mont Fleuri');
INSERT INTO zones VALUES (3370, 186, 'PL', 'Plaisance');
INSERT INTO zones VALUES (3371, 186, 'PR', 'Pointe La Rue');
INSERT INTO zones VALUES (3372, 186, 'PG', 'Port Glaud');
INSERT INTO zones VALUES (3373, 186, 'SL', 'Saint Louis');
INSERT INTO zones VALUES (3374, 186, 'TA', 'Takamaka');
INSERT INTO zones VALUES (3375, 187, 'E', 'Eastern');
INSERT INTO zones VALUES (3376, 187, 'N', 'Northern');
INSERT INTO zones VALUES (3377, 187, 'S', 'Southern');
INSERT INTO zones VALUES (3378, 187, 'W', 'Western');
INSERT INTO zones VALUES (3379, 189, 'BA', 'Banskobystricky');
INSERT INTO zones VALUES (3380, 189, 'BR', 'Bratislavsky');
INSERT INTO zones VALUES (3381, 189, 'KO', 'Kosicky');
INSERT INTO zones VALUES (3382, 189, 'NI', 'Nitriansky');
INSERT INTO zones VALUES (3383, 189, 'PR', 'Presovsky');
INSERT INTO zones VALUES (3384, 189, 'TC', 'Trenciansky');
INSERT INTO zones VALUES (3385, 189, 'TV', 'Trnavsky');
INSERT INTO zones VALUES (3386, 189, 'ZI', 'Zilinsky');
INSERT INTO zones VALUES (3387, 190, '4', 'Å tajerska');
INSERT INTO zones VALUES (3388, 190, '2A', 'Gorenjska');
INSERT INTO zones VALUES (3389, 190, '5', 'Prekmurje');
INSERT INTO zones VALUES (3390, 190, '3', 'Koroška');
INSERT INTO zones VALUES (3391, 190, '2B', 'Notranjska');
INSERT INTO zones VALUES (3392, 190, '1', 'Primorska');
INSERT INTO zones VALUES (3393, 190, '2C', 'Dolenjska');
INSERT INTO zones VALUES (3394, 190, '2C', 'Bela Krajina');
INSERT INTO zones VALUES (3395, 191, 'CE', 'Central');
INSERT INTO zones VALUES (3396, 191, 'CH', 'Choiseul');
INSERT INTO zones VALUES (3397, 191, 'GC', 'Guadalcanal');
INSERT INTO zones VALUES (3398, 191, 'HO', 'Honiara');
INSERT INTO zones VALUES (3399, 191, 'IS', 'Isabel');
INSERT INTO zones VALUES (3400, 191, 'MK', 'Makira');
INSERT INTO zones VALUES (3401, 191, 'ML', 'Malaita');
INSERT INTO zones VALUES (3402, 191, 'RB', 'Rennell and Bellona');
INSERT INTO zones VALUES (3403, 191, 'TM', 'Temotu');
INSERT INTO zones VALUES (3404, 191, 'WE', 'Western');
INSERT INTO zones VALUES (3405, 192, 'AW', 'Awdal');
INSERT INTO zones VALUES (3406, 192, 'BK', 'Bakool');
INSERT INTO zones VALUES (3407, 192, 'BN', 'Banaadir');
INSERT INTO zones VALUES (3408, 192, 'BR', 'Bari');
INSERT INTO zones VALUES (3409, 192, 'BY', 'Bay');
INSERT INTO zones VALUES (3410, 192, 'GA', 'Galguduud');
INSERT INTO zones VALUES (3411, 192, 'GE', 'Gedo');
INSERT INTO zones VALUES (3412, 192, 'HI', 'Hiiraan');
INSERT INTO zones VALUES (3413, 192, 'JD', 'Jubbada Dhexe');
INSERT INTO zones VALUES (3414, 192, 'JH', 'Jubbada Hoose');
INSERT INTO zones VALUES (3415, 192, 'MU', 'Mudug');
INSERT INTO zones VALUES (3416, 192, 'NU', 'Nugaal');
INSERT INTO zones VALUES (3417, 192, 'SA', 'Sanaag');
INSERT INTO zones VALUES (3418, 192, 'SD', 'Shabeellaha Dhexe');
INSERT INTO zones VALUES (3419, 192, 'SH', 'Shabeellaha Hoose');
INSERT INTO zones VALUES (3420, 192, 'SL', 'Sool');
INSERT INTO zones VALUES (3421, 192, 'TO', 'Togdheer');
INSERT INTO zones VALUES (3422, 192, 'WG', 'Woqooyi Galbeed');
INSERT INTO zones VALUES (3423, 193, 'EC', 'Eastern Cape');
INSERT INTO zones VALUES (3424, 193, 'FS', 'Free State');
INSERT INTO zones VALUES (3425, 193, 'GT', 'Gauteng');
INSERT INTO zones VALUES (3426, 193, 'KN', 'KwaZulu-Natal');
INSERT INTO zones VALUES (3427, 193, 'LP', 'Limpopo');
INSERT INTO zones VALUES (3428, 193, 'MP', 'Mpumalanga');
INSERT INTO zones VALUES (3429, 193, 'NW', 'North West');
INSERT INTO zones VALUES (3430, 193, 'NC', 'Northern Cape');
INSERT INTO zones VALUES (3431, 193, 'WC', 'Western Cape');
INSERT INTO zones VALUES (3432, 195, 'CA', 'La Coru&ntilde;a');
INSERT INTO zones VALUES (3433, 195, 'AL', '&Aacute;lava');
INSERT INTO zones VALUES (3434, 195, 'AB', 'Albacete');
INSERT INTO zones VALUES (3435, 195, 'AC', 'Alicante');
INSERT INTO zones VALUES (3436, 195, 'AM', 'Almeria');
INSERT INTO zones VALUES (3437, 195, 'AS', 'Asturias');
INSERT INTO zones VALUES (3438, 195, 'AV', '&Aacute;vila');
INSERT INTO zones VALUES (3439, 195, 'BJ', 'Badajoz');
INSERT INTO zones VALUES (3440, 195, 'IB', 'Baleares');
INSERT INTO zones VALUES (3441, 195, 'BA', 'Barcelona');
INSERT INTO zones VALUES (3442, 195, 'BU', 'Burgos');
INSERT INTO zones VALUES (3443, 195, 'CC', 'C&aacute;ceres');
INSERT INTO zones VALUES (3444, 195, 'CZ', 'C&aacute;diz');
INSERT INTO zones VALUES (3445, 195, 'CT', 'Cantabria');
INSERT INTO zones VALUES (3446, 195, 'CL', 'Castell&oacute;n');
INSERT INTO zones VALUES (3447, 195, 'CE', 'Ceuta');
INSERT INTO zones VALUES (3448, 195, 'CR', 'Ciudad Real');
INSERT INTO zones VALUES (3449, 195, 'CD', 'C&oacute;rdoba');
INSERT INTO zones VALUES (3450, 195, 'CU', 'Cuenca');
INSERT INTO zones VALUES (3451, 195, 'GI', 'Gerona');
INSERT INTO zones VALUES (3452, 195, 'GD', 'Granada');
INSERT INTO zones VALUES (3453, 195, 'GJ', 'Guadalajara');
INSERT INTO zones VALUES (3454, 195, 'GP', 'Guip&uacute;zcoa');
INSERT INTO zones VALUES (3455, 195, 'HL', 'Huelva');
INSERT INTO zones VALUES (3456, 195, 'HS', 'Huesca');
INSERT INTO zones VALUES (3457, 195, 'JN', 'Ja&eacute;n');
INSERT INTO zones VALUES (3458, 195, 'RJ', 'La Rioja');
INSERT INTO zones VALUES (3459, 195, 'PM', 'Las Palmas');
INSERT INTO zones VALUES (3460, 195, 'LE', 'Le&oacute;n');
INSERT INTO zones VALUES (3461, 195, 'LL', 'L&eacute;rida');
INSERT INTO zones VALUES (3462, 195, 'LG', 'Lugo');
INSERT INTO zones VALUES (3463, 195, 'MD', 'Madrid');
INSERT INTO zones VALUES (3464, 195, 'MA', 'M&aacute;laga');
INSERT INTO zones VALUES (3465, 195, 'ML', 'Melilla');
INSERT INTO zones VALUES (3466, 195, 'MU', 'Murcia');
INSERT INTO zones VALUES (3467, 195, 'NV', 'Navarra');
INSERT INTO zones VALUES (3468, 195, 'OU', 'Ourense');
INSERT INTO zones VALUES (3469, 195, 'PL', 'Palencia');
INSERT INTO zones VALUES (3470, 195, 'PO', 'Pontevedra');
INSERT INTO zones VALUES (3471, 195, 'SL', 'Salamanca');
INSERT INTO zones VALUES (3472, 195, 'SC', 'Santa Cruz de Tenerife');
INSERT INTO zones VALUES (3473, 195, 'SG', 'Segovia');
INSERT INTO zones VALUES (3474, 195, 'SV', 'Sevilla');
INSERT INTO zones VALUES (3475, 195, 'SO', 'Soria');
INSERT INTO zones VALUES (3476, 195, 'TA', 'Tarragona');
INSERT INTO zones VALUES (3477, 195, 'TE', 'Teruel');
INSERT INTO zones VALUES (3478, 195, 'TO', 'Toledo');
INSERT INTO zones VALUES (3479, 195, 'VC', 'Valencia');
INSERT INTO zones VALUES (3480, 195, 'VD', 'Valladolid');
INSERT INTO zones VALUES (3481, 195, 'VZ', 'Vizcaya');
INSERT INTO zones VALUES (3482, 195, 'ZM', 'Zamora');
INSERT INTO zones VALUES (3483, 195, 'ZR', 'Zaragoza');
INSERT INTO zones VALUES (3484, 196, 'CE', 'Central');
INSERT INTO zones VALUES (3485, 196, 'EA', 'Eastern');
INSERT INTO zones VALUES (3486, 196, 'NC', 'North Central');
INSERT INTO zones VALUES (3487, 196, 'NO', 'Northern');
INSERT INTO zones VALUES (3488, 196, 'NW', 'North Western');
INSERT INTO zones VALUES (3489, 196, 'SA', 'Sabaragamuwa');
INSERT INTO zones VALUES (3490, 196, 'SO', 'Southern');
INSERT INTO zones VALUES (3491, 196, 'UV', 'Uva');
INSERT INTO zones VALUES (3492, 196, 'WE', 'Western');
INSERT INTO zones VALUES (3493, 197, 'A', 'Ascension');
INSERT INTO zones VALUES (3494, 197, 'S', 'Saint Helena');
INSERT INTO zones VALUES (3495, 197, 'T', 'Tristan da Cunha');
INSERT INTO zones VALUES (3496, 198, 'P', 'Saint Pierre');
INSERT INTO zones VALUES (3497, 198, 'M', 'Miquelon');
INSERT INTO zones VALUES (3498, 199, 'ANL', 'A''ali an Nil');
INSERT INTO zones VALUES (3499, 199, 'BAM', 'Al Bahr al Ahmar');
INSERT INTO zones VALUES (3500, 199, 'BRT', 'Al Buhayrat');
INSERT INTO zones VALUES (3501, 199, 'JZR', 'Al Jazirah');
INSERT INTO zones VALUES (3502, 199, 'KRT', 'Al Khartum');
INSERT INTO zones VALUES (3503, 199, 'QDR', 'Al Qadarif');
INSERT INTO zones VALUES (3504, 199, 'WDH', 'Al Wahdah');
INSERT INTO zones VALUES (3505, 199, 'ANB', 'An Nil al Abyad');
INSERT INTO zones VALUES (3506, 199, 'ANZ', 'An Nil al Azraq');
INSERT INTO zones VALUES (3507, 199, 'ASH', 'Ash Shamaliyah');
INSERT INTO zones VALUES (3508, 199, 'BJA', 'Bahr al Jabal');
INSERT INTO zones VALUES (3509, 199, 'GIS', 'Gharb al Istiwa''iyah');
INSERT INTO zones VALUES (3510, 199, 'GBG', 'Gharb Bahr al Ghazal');
INSERT INTO zones VALUES (3511, 199, 'GDA', 'Gharb Darfur');
INSERT INTO zones VALUES (3512, 199, 'GKU', 'Gharb Kurdufan');
INSERT INTO zones VALUES (3513, 199, 'JDA', 'Janub Darfur');
INSERT INTO zones VALUES (3514, 199, 'JKU', 'Janub Kurdufan');
INSERT INTO zones VALUES (3515, 199, 'JQL', 'Junqali');
INSERT INTO zones VALUES (3516, 199, 'KSL', 'Kassala');
INSERT INTO zones VALUES (3517, 199, 'NNL', 'Nahr an Nil');
INSERT INTO zones VALUES (3518, 199, 'SBG', 'Shamal Bahr al Ghazal');
INSERT INTO zones VALUES (3519, 199, 'SDA', 'Shamal Darfur');
INSERT INTO zones VALUES (3520, 199, 'SKU', 'Shamal Kurdufan');
INSERT INTO zones VALUES (3521, 199, 'SIS', 'Sharq al Istiwa''iyah');
INSERT INTO zones VALUES (3522, 199, 'SNR', 'Sinnar');
INSERT INTO zones VALUES (3523, 199, 'WRB', 'Warab');
INSERT INTO zones VALUES (3524, 200, 'BR', 'Brokopondo');
INSERT INTO zones VALUES (3525, 200, 'CM', 'Commewijne');
INSERT INTO zones VALUES (3526, 200, 'CR', 'Coronie');
INSERT INTO zones VALUES (3527, 200, 'MA', 'Marowijne');
INSERT INTO zones VALUES (3528, 200, 'NI', 'Nickerie');
INSERT INTO zones VALUES (3529, 200, 'PA', 'Para');
INSERT INTO zones VALUES (3530, 200, 'PM', 'Paramaribo');
INSERT INTO zones VALUES (3531, 200, 'SA', 'Saramacca');
INSERT INTO zones VALUES (3532, 200, 'SI', 'Sipaliwini');
INSERT INTO zones VALUES (3533, 200, 'WA', 'Wanica');
INSERT INTO zones VALUES (3534, 202, 'H', 'Hhohho');
INSERT INTO zones VALUES (3535, 202, 'L', 'Lubombo');
INSERT INTO zones VALUES (3536, 202, 'M', 'Manzini');
INSERT INTO zones VALUES (3537, 202, 'S', 'Shishelweni');
INSERT INTO zones VALUES (3538, 203, 'K', 'Blekinge');
INSERT INTO zones VALUES (3539, 203, 'W', 'Dalama');
INSERT INTO zones VALUES (3540, 203, 'I', 'Gotland');
INSERT INTO zones VALUES (3541, 203, 'X', 'Gävleborg');
INSERT INTO zones VALUES (3542, 203, 'N', 'Halland');
INSERT INTO zones VALUES (3543, 203, 'Z', 'Jämtland');
INSERT INTO zones VALUES (3544, 203, 'F', 'Jönköping');
INSERT INTO zones VALUES (3545, 203, 'H', 'Kalmar');
INSERT INTO zones VALUES (3546, 203, 'G', 'Kronoberg');
INSERT INTO zones VALUES (3547, 203, 'BD', 'Norrbotten');
INSERT INTO zones VALUES (3548, 203, 'M', 'Sk&aring;ne');
INSERT INTO zones VALUES (3549, 203, 'AB', 'Stockholm');
INSERT INTO zones VALUES (3550, 203, 'D', 'Södermanland');
INSERT INTO zones VALUES (3551, 203, 'C', 'Uppsala');
INSERT INTO zones VALUES (3552, 203, 'S', 'Värmland');
INSERT INTO zones VALUES (3553, 203, 'AC', 'Västerbotten');
INSERT INTO zones VALUES (3554, 203, 'Y', 'Västernorrland');
INSERT INTO zones VALUES (3555, 203, 'U', 'Västmanland');
INSERT INTO zones VALUES (3556, 203, 'O', 'Västra Götaland');
INSERT INTO zones VALUES (3557, 203, 'T', 'Örebro');
INSERT INTO zones VALUES (3558, 203, 'E', 'Östergötland');
INSERT INTO zones VALUES (3559, 204, 'AG', 'Aargau');
INSERT INTO zones VALUES (3560, 204, 'AR', 'Appenzell Ausserrhoden');
INSERT INTO zones VALUES (3561, 204, 'AI', 'Appenzell Innerrhoden');
INSERT INTO zones VALUES (3562, 204, 'BS', 'Basel-Stadt');
INSERT INTO zones VALUES (3563, 204, 'BL', 'Basel-Landschaft');
INSERT INTO zones VALUES (3564, 204, 'BE', 'Bern');
INSERT INTO zones VALUES (3565, 204, 'FR', 'Fribourg');
INSERT INTO zones VALUES (3566, 204, 'GE', 'Gen&egrave;ve');
INSERT INTO zones VALUES (3567, 204, 'GL', 'Glarus');
INSERT INTO zones VALUES (3568, 204, 'GR', 'Graubünden');
INSERT INTO zones VALUES (3569, 204, 'JU', 'Jura');
INSERT INTO zones VALUES (3570, 204, 'LU', 'Lucerne');
INSERT INTO zones VALUES (3571, 204, 'NE', 'Neuch&acirc;tel');
INSERT INTO zones VALUES (3572, 204, 'NW', 'Nidwalden');
INSERT INTO zones VALUES (3573, 204, 'OW', 'Obwalden');
INSERT INTO zones VALUES (3574, 204, 'SG', 'St. Gallen');
INSERT INTO zones VALUES (3575, 204, 'SH', 'Schaffhausen');
INSERT INTO zones VALUES (3576, 204, 'SZ', 'Schwyz');
INSERT INTO zones VALUES (3577, 204, 'SO', 'Solothurn');
INSERT INTO zones VALUES (3578, 204, 'TG', 'Thurgau');
INSERT INTO zones VALUES (3579, 204, 'TI', 'Ticino');
INSERT INTO zones VALUES (3580, 204, 'UR', 'Uri');
INSERT INTO zones VALUES (3581, 204, 'VS', 'Valais');
INSERT INTO zones VALUES (3582, 204, 'VD', 'Vaud');
INSERT INTO zones VALUES (3583, 204, 'ZG', 'Zug');
INSERT INTO zones VALUES (3584, 204, 'ZH', 'Zürich');
INSERT INTO zones VALUES (3585, 205, 'HA', 'Al Hasakah');
INSERT INTO zones VALUES (3586, 205, 'LA', 'Al Ladhiqiyah');
INSERT INTO zones VALUES (3587, 205, 'QU', 'Al Qunaytirah');
INSERT INTO zones VALUES (3588, 205, 'RQ', 'Ar Raqqah');
INSERT INTO zones VALUES (3589, 205, 'SU', 'As Suwayda');
INSERT INTO zones VALUES (3590, 205, 'DA', 'Dara');
INSERT INTO zones VALUES (3591, 205, 'DZ', 'Dayr az Zawr');
INSERT INTO zones VALUES (3592, 205, 'DI', 'Dimashq');
INSERT INTO zones VALUES (3593, 205, 'HL', 'Halab');
INSERT INTO zones VALUES (3594, 205, 'HM', 'Hamah');
INSERT INTO zones VALUES (3595, 205, 'HI', 'Hims');
INSERT INTO zones VALUES (3596, 205, 'ID', 'Idlib');
INSERT INTO zones VALUES (3597, 205, 'RD', 'Rif Dimashq');
INSERT INTO zones VALUES (3598, 205, 'TA', 'Tartus');
INSERT INTO zones VALUES (3599, 206, 'CH', 'Chang-hua');
INSERT INTO zones VALUES (3600, 206, 'CI', 'Chia-i');
INSERT INTO zones VALUES (3601, 206, 'HS', 'Hsin-chu');
INSERT INTO zones VALUES (3602, 206, 'HL', 'Hua-lien');
INSERT INTO zones VALUES (3603, 206, 'IL', 'I-lan');
INSERT INTO zones VALUES (3604, 206, 'KH', 'Kao-hsiung county');
INSERT INTO zones VALUES (3605, 206, 'KM', 'Kin-men');
INSERT INTO zones VALUES (3606, 206, 'LC', 'Lien-chiang');
INSERT INTO zones VALUES (3607, 206, 'ML', 'Miao-li');
INSERT INTO zones VALUES (3608, 206, 'NT', 'Nan-t''ou');
INSERT INTO zones VALUES (3609, 206, 'PH', 'P''eng-hu');
INSERT INTO zones VALUES (3610, 206, 'PT', 'P''ing-tung');
INSERT INTO zones VALUES (3611, 206, 'TG', 'T''ai-chung');
INSERT INTO zones VALUES (3612, 206, 'TA', 'T''ai-nan');
INSERT INTO zones VALUES (3613, 206, 'TP', 'T''ai-pei county');
INSERT INTO zones VALUES (3614, 206, 'TT', 'T''ai-tung');
INSERT INTO zones VALUES (3615, 206, 'TY', 'T''ao-yuan');
INSERT INTO zones VALUES (3616, 206, 'YL', 'Yun-lin');
INSERT INTO zones VALUES (3617, 206, 'CC', 'Chia-i city');
INSERT INTO zones VALUES (3618, 206, 'CL', 'Chi-lung');
INSERT INTO zones VALUES (3619, 206, 'HC', 'Hsin-chu');
INSERT INTO zones VALUES (3620, 206, 'TH', 'T''ai-chung');
INSERT INTO zones VALUES (3621, 206, 'TN', 'T''ai-nan');
INSERT INTO zones VALUES (3622, 206, 'KC', 'Kao-hsiung city');
INSERT INTO zones VALUES (3623, 206, 'TC', 'T''ai-pei city');
INSERT INTO zones VALUES (3624, 207, 'GB', 'Gorno-Badakhstan');
INSERT INTO zones VALUES (3625, 207, 'KT', 'Khatlon');
INSERT INTO zones VALUES (3626, 207, 'SU', 'Sughd');
INSERT INTO zones VALUES (3627, 208, 'AR', 'Arusha');
INSERT INTO zones VALUES (3628, 208, 'DS', 'Dar es Salaam');
INSERT INTO zones VALUES (3629, 208, 'DO', 'Dodoma');
INSERT INTO zones VALUES (3630, 208, 'IR', 'Iringa');
INSERT INTO zones VALUES (3631, 208, 'KA', 'Kagera');
INSERT INTO zones VALUES (3632, 208, 'KI', 'Kigoma');
INSERT INTO zones VALUES (3633, 208, 'KJ', 'Kilimanjaro');
INSERT INTO zones VALUES (3634, 208, 'LN', 'Lindi');
INSERT INTO zones VALUES (3635, 208, 'MY', 'Manyara');
INSERT INTO zones VALUES (3636, 208, 'MR', 'Mara');
INSERT INTO zones VALUES (3637, 208, 'MB', 'Mbeya');
INSERT INTO zones VALUES (3638, 208, 'MO', 'Morogoro');
INSERT INTO zones VALUES (3639, 208, 'MT', 'Mtwara');
INSERT INTO zones VALUES (3640, 208, 'MW', 'Mwanza');
INSERT INTO zones VALUES (3641, 208, 'PN', 'Pemba North');
INSERT INTO zones VALUES (3642, 208, 'PS', 'Pemba South');
INSERT INTO zones VALUES (3643, 208, 'PW', 'Pwani');
INSERT INTO zones VALUES (3644, 208, 'RK', 'Rukwa');
INSERT INTO zones VALUES (3645, 208, 'RV', 'Ruvuma');
INSERT INTO zones VALUES (3646, 208, 'SH', 'Shinyanga');
INSERT INTO zones VALUES (3647, 208, 'SI', 'Singida');
INSERT INTO zones VALUES (3648, 208, 'TB', 'Tabora');
INSERT INTO zones VALUES (3649, 208, 'TN', 'Tanga');
INSERT INTO zones VALUES (3650, 208, 'ZC', 'Zanzibar Central/South');
INSERT INTO zones VALUES (3651, 208, 'ZN', 'Zanzibar North');
INSERT INTO zones VALUES (3652, 208, 'ZU', 'Zanzibar Urban/West');
INSERT INTO zones VALUES (3653, 209, 'Amnat Charoen', 'Amnat Charoen');
INSERT INTO zones VALUES (3654, 209, 'Ang Thong', 'Ang Thong');
INSERT INTO zones VALUES (3655, 209, 'Ayutthaya', 'Ayutthaya');
INSERT INTO zones VALUES (3656, 209, 'Bangkok', 'Bangkok');
INSERT INTO zones VALUES (3657, 209, 'Buriram', 'Buriram');
INSERT INTO zones VALUES (3658, 209, 'Chachoengsao', 'Chachoengsao');
INSERT INTO zones VALUES (3659, 209, 'Chai Nat', 'Chai Nat');
INSERT INTO zones VALUES (3660, 209, 'Chaiyaphum', 'Chaiyaphum');
INSERT INTO zones VALUES (3661, 209, 'Chanthaburi', 'Chanthaburi');
INSERT INTO zones VALUES (3662, 209, 'Chiang Mai', 'Chiang Mai');
INSERT INTO zones VALUES (3663, 209, 'Chiang Rai', 'Chiang Rai');
INSERT INTO zones VALUES (3664, 209, 'Chon Buri', 'Chon Buri');
INSERT INTO zones VALUES (3665, 209, 'Chumphon', 'Chumphon');
INSERT INTO zones VALUES (3666, 209, 'Kalasin', 'Kalasin');
INSERT INTO zones VALUES (3667, 209, 'Kamphaeng Phet', 'Kamphaeng Phet');
INSERT INTO zones VALUES (3668, 209, 'Kanchanaburi', 'Kanchanaburi');
INSERT INTO zones VALUES (3669, 209, 'Khon Kaen', 'Khon Kaen');
INSERT INTO zones VALUES (3670, 209, 'Krabi', 'Krabi');
INSERT INTO zones VALUES (3671, 209, 'Lampang', 'Lampang');
INSERT INTO zones VALUES (3672, 209, 'Lamphun', 'Lamphun');
INSERT INTO zones VALUES (3673, 209, 'Loei', 'Loei');
INSERT INTO zones VALUES (3674, 209, 'Lop Buri', 'Lop Buri');
INSERT INTO zones VALUES (3675, 209, 'Mae Hong Son', 'Mae Hong Son');
INSERT INTO zones VALUES (3676, 209, 'Maha Sarakham', 'Maha Sarakham');
INSERT INTO zones VALUES (3677, 209, 'Mukdahan', 'Mukdahan');
INSERT INTO zones VALUES (3678, 209, 'Nakhon Nayok', 'Nakhon Nayok');
INSERT INTO zones VALUES (3679, 209, 'Nakhon Pathom', 'Nakhon Pathom');
INSERT INTO zones VALUES (3680, 209, 'Nakhon Phanom', 'Nakhon Phanom');
INSERT INTO zones VALUES (3681, 209, 'Nakhon Ratchasima', 'Nakhon Ratchasima');
INSERT INTO zones VALUES (3682, 209, 'Nakhon Sawan', 'Nakhon Sawan');
INSERT INTO zones VALUES (3683, 209, 'Nakhon Si Thammarat', 'Nakhon Si Thammarat');
INSERT INTO zones VALUES (3684, 209, 'Nan', 'Nan');
INSERT INTO zones VALUES (3685, 209, 'Narathiwat', 'Narathiwat');
INSERT INTO zones VALUES (3686, 209, 'Nong Bua Lamphu', 'Nong Bua Lamphu');
INSERT INTO zones VALUES (3687, 209, 'Nong Khai', 'Nong Khai');
INSERT INTO zones VALUES (3688, 209, 'Nonthaburi', 'Nonthaburi');
INSERT INTO zones VALUES (3689, 209, 'Pathum Thani', 'Pathum Thani');
INSERT INTO zones VALUES (3690, 209, 'Pattani', 'Pattani');
INSERT INTO zones VALUES (3691, 209, 'Phangnga', 'Phangnga');
INSERT INTO zones VALUES (3692, 209, 'Phatthalung', 'Phatthalung');
INSERT INTO zones VALUES (3693, 209, 'Phayao', 'Phayao');
INSERT INTO zones VALUES (3694, 209, 'Phetchabun', 'Phetchabun');
INSERT INTO zones VALUES (3695, 209, 'Phetchaburi', 'Phetchaburi');
INSERT INTO zones VALUES (3696, 209, 'Phichit', 'Phichit');
INSERT INTO zones VALUES (3697, 209, 'Phitsanulok', 'Phitsanulok');
INSERT INTO zones VALUES (3698, 209, 'Phrae', 'Phrae');
INSERT INTO zones VALUES (3699, 209, 'Phuket', 'Phuket');
INSERT INTO zones VALUES (3700, 209, 'Prachin Buri', 'Prachin Buri');
INSERT INTO zones VALUES (3701, 209, 'Prachuap Khiri Khan', 'Prachuap Khiri Khan');
INSERT INTO zones VALUES (3702, 209, 'Ranong', 'Ranong');
INSERT INTO zones VALUES (3703, 209, 'Ratchaburi', 'Ratchaburi');
INSERT INTO zones VALUES (3704, 209, 'Rayong', 'Rayong');
INSERT INTO zones VALUES (3705, 209, 'Roi Et', 'Roi Et');
INSERT INTO zones VALUES (3706, 209, 'Sa Kaeo', 'Sa Kaeo');
INSERT INTO zones VALUES (3707, 209, 'Sakon Nakhon', 'Sakon Nakhon');
INSERT INTO zones VALUES (3708, 209, 'Samut Prakan', 'Samut Prakan');
INSERT INTO zones VALUES (3709, 209, 'Samut Sakhon', 'Samut Sakhon');
INSERT INTO zones VALUES (3710, 209, 'Samut Songkhram', 'Samut Songkhram');
INSERT INTO zones VALUES (3711, 209, 'Sara Buri', 'Sara Buri');
INSERT INTO zones VALUES (3712, 209, 'Satun', 'Satun');
INSERT INTO zones VALUES (3713, 209, 'Sing Buri', 'Sing Buri');
INSERT INTO zones VALUES (3714, 209, 'Sisaket', 'Sisaket');
INSERT INTO zones VALUES (3715, 209, 'Songkhla', 'Songkhla');
INSERT INTO zones VALUES (3716, 209, 'Sukhothai', 'Sukhothai');
INSERT INTO zones VALUES (3717, 209, 'Suphan Buri', 'Suphan Buri');
INSERT INTO zones VALUES (3718, 209, 'Surat Thani', 'Surat Thani');
INSERT INTO zones VALUES (3719, 209, 'Surin', 'Surin');
INSERT INTO zones VALUES (3720, 209, 'Tak', 'Tak');
INSERT INTO zones VALUES (3721, 209, 'Trang', 'Trang');
INSERT INTO zones VALUES (3722, 209, 'Trat', 'Trat');
INSERT INTO zones VALUES (3723, 209, 'Ubon Ratchathani', 'Ubon Ratchathani');
INSERT INTO zones VALUES (3724, 209, 'Udon Thani', 'Udon Thani');
INSERT INTO zones VALUES (3725, 209, 'Uthai Thani', 'Uthai Thani');
INSERT INTO zones VALUES (3726, 209, 'Uttaradit', 'Uttaradit');
INSERT INTO zones VALUES (3727, 209, 'Yala', 'Yala');
INSERT INTO zones VALUES (3728, 209, 'Yasothon', 'Yasothon');
INSERT INTO zones VALUES (3729, 210, 'K', 'Kara');
INSERT INTO zones VALUES (3730, 210, 'P', 'Plateaux');
INSERT INTO zones VALUES (3731, 210, 'S', 'Savanes');
INSERT INTO zones VALUES (3732, 210, 'C', 'Centrale');
INSERT INTO zones VALUES (3733, 210, 'M', 'Maritime');
INSERT INTO zones VALUES (3734, 211, 'A', 'Atafu');
INSERT INTO zones VALUES (3735, 211, 'F', 'Fakaofo');
INSERT INTO zones VALUES (3736, 211, 'N', 'Nukunonu');
INSERT INTO zones VALUES (3737, 212, 'H', 'Ha''apai');
INSERT INTO zones VALUES (3738, 212, 'T', 'Tongatapu');
INSERT INTO zones VALUES (3739, 212, 'V', 'Vava''u');
INSERT INTO zones VALUES (3740, 213, 'CT', 'Couva/Tabaquite/Talparo');
INSERT INTO zones VALUES (3741, 213, 'DM', 'Diego Martin');
INSERT INTO zones VALUES (3742, 213, 'MR', 'Mayaro/Rio Claro');
INSERT INTO zones VALUES (3743, 213, 'PD', 'Penal/Debe');
INSERT INTO zones VALUES (3744, 213, 'PT', 'Princes Town');
INSERT INTO zones VALUES (3745, 213, 'SG', 'Sangre Grande');
INSERT INTO zones VALUES (3746, 213, 'SL', 'San Juan/Laventille');
INSERT INTO zones VALUES (3747, 213, 'SI', 'Siparia');
INSERT INTO zones VALUES (3748, 213, 'TP', 'Tunapuna/Piarco');
INSERT INTO zones VALUES (3749, 213, 'PS', 'Port of Spain');
INSERT INTO zones VALUES (3750, 213, 'SF', 'San Fernando');
INSERT INTO zones VALUES (3751, 213, 'AR', 'Arima');
INSERT INTO zones VALUES (3752, 213, 'PF', 'Point Fortin');
INSERT INTO zones VALUES (3753, 213, 'CH', 'Chaguanas');
INSERT INTO zones VALUES (3754, 213, 'TO', 'Tobago');
INSERT INTO zones VALUES (3755, 214, 'AR', 'Ariana');
INSERT INTO zones VALUES (3756, 214, 'BJ', 'Beja');
INSERT INTO zones VALUES (3757, 214, 'BA', 'Ben Arous');
INSERT INTO zones VALUES (3758, 214, 'BI', 'Bizerte');
INSERT INTO zones VALUES (3759, 214, 'GB', 'Gabes');
INSERT INTO zones VALUES (3760, 214, 'GF', 'Gafsa');
INSERT INTO zones VALUES (3761, 214, 'JE', 'Jendouba');
INSERT INTO zones VALUES (3762, 214, 'KR', 'Kairouan');
INSERT INTO zones VALUES (3763, 214, 'KS', 'Kasserine');
INSERT INTO zones VALUES (3764, 214, 'KB', 'Kebili');
INSERT INTO zones VALUES (3765, 214, 'KF', 'Kef');
INSERT INTO zones VALUES (3766, 214, 'MH', 'Mahdia');
INSERT INTO zones VALUES (3767, 214, 'MN', 'Manouba');
INSERT INTO zones VALUES (3768, 214, 'ME', 'Medenine');
INSERT INTO zones VALUES (3769, 214, 'MO', 'Monastir');
INSERT INTO zones VALUES (3770, 214, 'NA', 'Nabeul');
INSERT INTO zones VALUES (3771, 214, 'SF', 'Sfax');
INSERT INTO zones VALUES (3772, 214, 'SD', 'Sidi');
INSERT INTO zones VALUES (3773, 214, 'SL', 'Siliana');
INSERT INTO zones VALUES (3774, 214, 'SO', 'Sousse');
INSERT INTO zones VALUES (3775, 214, 'TA', 'Tataouine');
INSERT INTO zones VALUES (3776, 214, 'TO', 'Tozeur');
INSERT INTO zones VALUES (3777, 214, 'TU', 'Tunis');
INSERT INTO zones VALUES (3778, 214, 'ZA', 'Zaghouan');
INSERT INTO zones VALUES (3779, 215, 'ADA', 'Adana');
INSERT INTO zones VALUES (3780, 215, 'ADI', 'Adiyaman');
INSERT INTO zones VALUES (3781, 215, 'AFY', 'Afyonkarahisar');
INSERT INTO zones VALUES (3782, 215, 'AGR', 'Agri');
INSERT INTO zones VALUES (3783, 215, 'AKS', 'Aksaray');
INSERT INTO zones VALUES (3784, 215, 'AMA', 'Amasya');
INSERT INTO zones VALUES (3785, 215, 'ANK', 'Ankara');
INSERT INTO zones VALUES (3786, 215, 'ANT', 'Antalya');
INSERT INTO zones VALUES (3787, 215, 'ARD', 'Ardahan');
INSERT INTO zones VALUES (3788, 215, 'ART', 'Artvin');
INSERT INTO zones VALUES (3789, 215, 'AYI', 'Aydin');
INSERT INTO zones VALUES (3790, 215, 'BAL', 'Balikesir');
INSERT INTO zones VALUES (3791, 215, 'BAR', 'Bartin');
INSERT INTO zones VALUES (3792, 215, 'BAT', 'Batman');
INSERT INTO zones VALUES (3793, 215, 'BAY', 'Bayburt');
INSERT INTO zones VALUES (3794, 215, 'BIL', 'Bilecik');
INSERT INTO zones VALUES (3795, 215, 'BIN', 'Bingol');
INSERT INTO zones VALUES (3796, 215, 'BIT', 'Bitlis');
INSERT INTO zones VALUES (3797, 215, 'BOL', 'Bolu');
INSERT INTO zones VALUES (3798, 215, 'BRD', 'Burdur');
INSERT INTO zones VALUES (3799, 215, 'BRS', 'Bursa');
INSERT INTO zones VALUES (3800, 215, 'CKL', 'Canakkale');
INSERT INTO zones VALUES (3801, 215, 'CKR', 'Cankiri');
INSERT INTO zones VALUES (3802, 215, 'COR', 'Corum');
INSERT INTO zones VALUES (3803, 215, 'DEN', 'Denizli');
INSERT INTO zones VALUES (3804, 215, 'DIY', 'Diyarbakir');
INSERT INTO zones VALUES (3805, 215, 'DUZ', 'Duzce');
INSERT INTO zones VALUES (3806, 215, 'EDI', 'Edirne');
INSERT INTO zones VALUES (3807, 215, 'ELA', 'Elazig');
INSERT INTO zones VALUES (3808, 215, 'EZC', 'Erzincan');
INSERT INTO zones VALUES (3809, 215, 'EZR', 'Erzurum');
INSERT INTO zones VALUES (3810, 215, 'ESK', 'Eskisehir');
INSERT INTO zones VALUES (3811, 215, 'GAZ', 'Gaziantep');
INSERT INTO zones VALUES (3812, 215, 'GIR', 'Giresun');
INSERT INTO zones VALUES (3813, 215, 'GMS', 'Gumushane');
INSERT INTO zones VALUES (3814, 215, 'HKR', 'Hakkari');
INSERT INTO zones VALUES (3815, 215, 'HTY', 'Hatay');
INSERT INTO zones VALUES (3816, 215, 'IGD', 'Igdir');
INSERT INTO zones VALUES (3817, 215, 'ISP', 'Isparta');
INSERT INTO zones VALUES (3818, 215, 'IST', 'Istanbul');
INSERT INTO zones VALUES (3819, 215, 'IZM', 'Izmir');
INSERT INTO zones VALUES (3820, 215, 'KAH', 'Kahramanmaras');
INSERT INTO zones VALUES (3821, 215, 'KRB', 'Karabuk');
INSERT INTO zones VALUES (3822, 215, 'KRM', 'Karaman');
INSERT INTO zones VALUES (3823, 215, 'KRS', 'Kars');
INSERT INTO zones VALUES (3824, 215, 'KAS', 'Kastamonu');
INSERT INTO zones VALUES (3825, 215, 'KAY', 'Kayseri');
INSERT INTO zones VALUES (3826, 215, 'KLS', 'Kilis');
INSERT INTO zones VALUES (3827, 215, 'KRK', 'Kirikkale');
INSERT INTO zones VALUES (3828, 215, 'KLR', 'Kirklareli');
INSERT INTO zones VALUES (3829, 215, 'KRH', 'Kirsehir');
INSERT INTO zones VALUES (3830, 215, 'KOC', 'Kocaeli');
INSERT INTO zones VALUES (3831, 215, 'KON', 'Konya');
INSERT INTO zones VALUES (3832, 215, 'KUT', 'Kutahya');
INSERT INTO zones VALUES (3833, 215, 'MAL', 'Malatya');
INSERT INTO zones VALUES (3834, 215, 'MAN', 'Manisa');
INSERT INTO zones VALUES (3835, 215, 'MAR', 'Mardin');
INSERT INTO zones VALUES (3836, 215, 'MER', 'Mersin');
INSERT INTO zones VALUES (3837, 215, 'MUG', 'Mugla');
INSERT INTO zones VALUES (3838, 215, 'MUS', 'Mus');
INSERT INTO zones VALUES (3839, 215, 'NEV', 'Nevsehir');
INSERT INTO zones VALUES (3840, 215, 'NIG', 'Nigde');
INSERT INTO zones VALUES (3841, 215, 'ORD', 'Ordu');
INSERT INTO zones VALUES (3842, 215, 'OSM', 'Osmaniye');
INSERT INTO zones VALUES (3843, 215, 'RIZ', 'Rize');
INSERT INTO zones VALUES (3844, 215, 'SAK', 'Sakarya');
INSERT INTO zones VALUES (3845, 215, 'SAM', 'Samsun');
INSERT INTO zones VALUES (3846, 215, 'SAN', 'Sanliurfa');
INSERT INTO zones VALUES (3847, 215, 'SII', 'Siirt');
INSERT INTO zones VALUES (3848, 215, 'SIN', 'Sinop');
INSERT INTO zones VALUES (3849, 215, 'SIR', 'Sirnak');
INSERT INTO zones VALUES (3850, 215, 'SIV', 'Sivas');
INSERT INTO zones VALUES (3851, 215, 'TEL', 'Tekirdag');
INSERT INTO zones VALUES (3852, 215, 'TOK', 'Tokat');
INSERT INTO zones VALUES (3853, 215, 'TRA', 'Trabzon');
INSERT INTO zones VALUES (3854, 215, 'TUN', 'Tunceli');
INSERT INTO zones VALUES (3855, 215, 'USK', 'Usak');
INSERT INTO zones VALUES (3856, 215, 'VAN', 'Van');
INSERT INTO zones VALUES (3857, 215, 'YAL', 'Yalova');
INSERT INTO zones VALUES (3858, 215, 'YOZ', 'Yozgat');
INSERT INTO zones VALUES (3859, 215, 'ZON', 'Zonguldak');
INSERT INTO zones VALUES (3860, 216, 'A', 'Ahal Welayaty');
INSERT INTO zones VALUES (3861, 216, 'B', 'Balkan Welayaty');
INSERT INTO zones VALUES (3862, 216, 'D', 'Dashhowuz Welayaty');
INSERT INTO zones VALUES (3863, 216, 'L', 'Lebap Welayaty');
INSERT INTO zones VALUES (3864, 216, 'M', 'Mary Welayaty');
INSERT INTO zones VALUES (3865, 217, 'AC', 'Ambergris Cays');
INSERT INTO zones VALUES (3866, 217, 'DC', 'Dellis Cay');
INSERT INTO zones VALUES (3867, 217, 'FC', 'French Cay');
INSERT INTO zones VALUES (3868, 217, 'LW', 'Little Water Cay');
INSERT INTO zones VALUES (3869, 217, 'RC', 'Parrot Cay');
INSERT INTO zones VALUES (3870, 217, 'PN', 'Pine Cay');
INSERT INTO zones VALUES (3871, 217, 'SL', 'Salt Cay');
INSERT INTO zones VALUES (3872, 217, 'GT', 'Grand Turk');
INSERT INTO zones VALUES (3873, 217, 'SC', 'South Caicos');
INSERT INTO zones VALUES (3874, 217, 'EC', 'East Caicos');
INSERT INTO zones VALUES (3875, 217, 'MC', 'Middle Caicos');
INSERT INTO zones VALUES (3876, 217, 'NC', 'North Caicos');
INSERT INTO zones VALUES (3877, 217, 'PR', 'Providenciales');
INSERT INTO zones VALUES (3878, 217, 'WC', 'West Caicos');
INSERT INTO zones VALUES (3879, 218, 'NMG', 'Nanumanga');
INSERT INTO zones VALUES (3880, 218, 'NLK', 'Niulakita');
INSERT INTO zones VALUES (3881, 218, 'NTO', 'Niutao');
INSERT INTO zones VALUES (3882, 218, 'FUN', 'Funafuti');
INSERT INTO zones VALUES (3883, 218, 'NME', 'Nanumea');
INSERT INTO zones VALUES (3884, 218, 'NUI', 'Nui');
INSERT INTO zones VALUES (3885, 218, 'NFT', 'Nukufetau');
INSERT INTO zones VALUES (3886, 218, 'NLL', 'Nukulaelae');
INSERT INTO zones VALUES (3887, 218, 'VAI', 'Vaitupu');
INSERT INTO zones VALUES (3888, 219, 'KAL', 'Kalangala');
INSERT INTO zones VALUES (3889, 219, 'KMP', 'Kampala');
INSERT INTO zones VALUES (3890, 219, 'KAY', 'Kayunga');
INSERT INTO zones VALUES (3891, 219, 'KIB', 'Kiboga');
INSERT INTO zones VALUES (3892, 219, 'LUW', 'Luwero');
INSERT INTO zones VALUES (3893, 219, 'MAS', 'Masaka');
INSERT INTO zones VALUES (3894, 219, 'MPI', 'Mpigi');
INSERT INTO zones VALUES (3895, 219, 'MUB', 'Mubende');
INSERT INTO zones VALUES (3896, 219, 'MUK', 'Mukono');
INSERT INTO zones VALUES (3897, 219, 'NKS', 'Nakasongola');
INSERT INTO zones VALUES (3898, 219, 'RAK', 'Rakai');
INSERT INTO zones VALUES (3899, 219, 'SEM', 'Sembabule');
INSERT INTO zones VALUES (3900, 219, 'WAK', 'Wakiso');
INSERT INTO zones VALUES (3901, 219, 'BUG', 'Bugiri');
INSERT INTO zones VALUES (3902, 219, 'BUS', 'Busia');
INSERT INTO zones VALUES (3903, 219, 'IGA', 'Iganga');
INSERT INTO zones VALUES (3904, 219, 'JIN', 'Jinja');
INSERT INTO zones VALUES (3905, 219, 'KAB', 'Kaberamaido');
INSERT INTO zones VALUES (3906, 219, 'KML', 'Kamuli');
INSERT INTO zones VALUES (3907, 219, 'KPC', 'Kapchorwa');
INSERT INTO zones VALUES (3908, 219, 'KTK', 'Katakwi');
INSERT INTO zones VALUES (3909, 219, 'KUM', 'Kumi');
INSERT INTO zones VALUES (3910, 219, 'MAY', 'Mayuge');
INSERT INTO zones VALUES (3911, 219, 'MBA', 'Mbale');
INSERT INTO zones VALUES (3912, 219, 'PAL', 'Pallisa');
INSERT INTO zones VALUES (3913, 219, 'SIR', 'Sironko');
INSERT INTO zones VALUES (3914, 219, 'SOR', 'Soroti');
INSERT INTO zones VALUES (3915, 219, 'TOR', 'Tororo');
INSERT INTO zones VALUES (3916, 219, 'ADJ', 'Adjumani');
INSERT INTO zones VALUES (3917, 219, 'APC', 'Apac');
INSERT INTO zones VALUES (3918, 219, 'ARU', 'Arua');
INSERT INTO zones VALUES (3919, 219, 'GUL', 'Gulu');
INSERT INTO zones VALUES (3920, 219, 'KIT', 'Kitgum');
INSERT INTO zones VALUES (3921, 219, 'KOT', 'Kotido');
INSERT INTO zones VALUES (3922, 219, 'LIR', 'Lira');
INSERT INTO zones VALUES (3923, 219, 'MRT', 'Moroto');
INSERT INTO zones VALUES (3924, 219, 'MOY', 'Moyo');
INSERT INTO zones VALUES (3925, 219, 'NAK', 'Nakapiripirit');
INSERT INTO zones VALUES (3926, 219, 'NEB', 'Nebbi');
INSERT INTO zones VALUES (3927, 219, 'PAD', 'Pader');
INSERT INTO zones VALUES (3928, 219, 'YUM', 'Yumbe');
INSERT INTO zones VALUES (3929, 219, 'BUN', 'Bundibugyo');
INSERT INTO zones VALUES (3930, 219, 'BSH', 'Bushenyi');
INSERT INTO zones VALUES (3931, 219, 'HOI', 'Hoima');
INSERT INTO zones VALUES (3932, 219, 'KBL', 'Kabale');
INSERT INTO zones VALUES (3933, 219, 'KAR', 'Kabarole');
INSERT INTO zones VALUES (3934, 219, 'KAM', 'Kamwenge');
INSERT INTO zones VALUES (3935, 219, 'KAN', 'Kanungu');
INSERT INTO zones VALUES (3936, 219, 'KAS', 'Kasese');
INSERT INTO zones VALUES (3937, 219, 'KBA', 'Kibaale');
INSERT INTO zones VALUES (3938, 219, 'KIS', 'Kisoro');
INSERT INTO zones VALUES (3939, 219, 'KYE', 'Kyenjojo');
INSERT INTO zones VALUES (3940, 219, 'MSN', 'Masindi');
INSERT INTO zones VALUES (3941, 219, 'MBR', 'Mbarara');
INSERT INTO zones VALUES (3942, 219, 'NTU', 'Ntungamo');
INSERT INTO zones VALUES (3943, 219, 'RUK', 'Rukungiri');
INSERT INTO zones VALUES (3944, 220, 'CK', 'Cherkasy');
INSERT INTO zones VALUES (3945, 220, 'CH', 'Chernihiv');
INSERT INTO zones VALUES (3946, 220, 'CV', 'Chernivtsi');
INSERT INTO zones VALUES (3947, 220, 'CR', 'Crimea');
INSERT INTO zones VALUES (3948, 220, 'DN', 'Dnipropetrovs''k');
INSERT INTO zones VALUES (3949, 220, 'DO', 'Donets''k');
INSERT INTO zones VALUES (3950, 220, 'IV', 'Ivano-Frankivs''k');
INSERT INTO zones VALUES (3951, 220, 'KL', 'Kharkiv Kherson');
INSERT INTO zones VALUES (3952, 220, 'KM', 'Khmel''nyts''kyy');
INSERT INTO zones VALUES (3953, 220, 'KR', 'Kirovohrad');
INSERT INTO zones VALUES (3954, 220, 'KV', 'Kiev');
INSERT INTO zones VALUES (3955, 220, 'KY', 'Kyyiv');
INSERT INTO zones VALUES (3956, 220, 'LU', 'Luhans''k');
INSERT INTO zones VALUES (3957, 220, 'LV', 'L''viv');
INSERT INTO zones VALUES (3958, 220, 'MY', 'Mykolayiv');
INSERT INTO zones VALUES (3959, 220, 'OD', 'Odesa');
INSERT INTO zones VALUES (3960, 220, 'PO', 'Poltava');
INSERT INTO zones VALUES (3961, 220, 'RI', 'Rivne');
INSERT INTO zones VALUES (3962, 220, 'SE', 'Sevastopol');
INSERT INTO zones VALUES (3963, 220, 'SU', 'Sumy');
INSERT INTO zones VALUES (3964, 220, 'TE', 'Ternopil''');
INSERT INTO zones VALUES (3965, 220, 'VI', 'Vinnytsya');
INSERT INTO zones VALUES (3966, 220, 'VO', 'Volyn''');
INSERT INTO zones VALUES (3967, 220, 'ZK', 'Zakarpattya');
INSERT INTO zones VALUES (3968, 220, 'ZA', 'Zaporizhzhya');
INSERT INTO zones VALUES (3969, 220, 'ZH', 'Zhytomyr');
INSERT INTO zones VALUES (3970, 221, 'AZ', 'Abu Zaby');
INSERT INTO zones VALUES (3971, 221, 'AJ', '''Ajman');
INSERT INTO zones VALUES (3972, 221, 'FU', 'Al Fujayrah');
INSERT INTO zones VALUES (3973, 221, 'SH', 'Ash Shariqah');
INSERT INTO zones VALUES (3974, 221, 'DU', 'Dubayy');
INSERT INTO zones VALUES (3975, 221, 'RK', 'R''as al Khaymah');
INSERT INTO zones VALUES (3976, 221, 'UQ', 'Umm al Qaywayn');
INSERT INTO zones VALUES (3977, 222, 'Aberdeen', 'Aberdeen');
INSERT INTO zones VALUES (3978, 222, 'Aberdeenshire', 'Aberdeenshire');
INSERT INTO zones VALUES (3979, 222, 'Anglesey', 'Anglesey');
INSERT INTO zones VALUES (3980, 222, 'Angus', 'Angus');
INSERT INTO zones VALUES (3981, 222, 'Argyll and Bute', 'Argyll and Bute');
INSERT INTO zones VALUES (3982, 222, 'Bedfordshire', 'Bedfordshire');
INSERT INTO zones VALUES (3983, 222, 'Berkshire', 'Berkshire');
INSERT INTO zones VALUES (3984, 222, 'Blaenau Gwent', 'Blaenau Gwent');
INSERT INTO zones VALUES (3985, 222, 'Bridgend', 'Bridgend');
INSERT INTO zones VALUES (3986, 222, 'Bristol', 'Bristol');
INSERT INTO zones VALUES (3987, 222, 'Buckinghamshire', 'Buckinghamshire');
INSERT INTO zones VALUES (3988, 222, 'Caerphilly', 'Caerphilly');
INSERT INTO zones VALUES (3989, 222, 'Cambridgeshire', 'Cambridgeshire');
INSERT INTO zones VALUES (3990, 222, 'Cardiff', 'Cardiff');
INSERT INTO zones VALUES (3991, 222, 'Carmarthenshire', 'Carmarthenshire');
INSERT INTO zones VALUES (3992, 222, 'Ceredigion', 'Ceredigion');
INSERT INTO zones VALUES (3993, 222, 'Channel Islands', 'Channel Islands');
INSERT INTO zones VALUES (3994, 222, 'Cheshire', 'Cheshire');
INSERT INTO zones VALUES (3995, 222, 'Clackmannanshire', 'Clackmannanshire');
INSERT INTO zones VALUES (3996, 222, 'Conwy', 'Conwy');
INSERT INTO zones VALUES (3997, 222, 'Cornwall', 'Cornwall');
INSERT INTO zones VALUES (3998, 222, 'Cumbria', 'Cumbria');
INSERT INTO zones VALUES (3999, 222, 'Denbighshire', 'Denbighshire');
INSERT INTO zones VALUES (4000, 222, 'Derbyshire', 'Derbyshire');
INSERT INTO zones VALUES (4001, 222, 'Devon', 'Devon');
INSERT INTO zones VALUES (4002, 222, 'Dorset', 'Dorset');
INSERT INTO zones VALUES (4003, 222, 'Dumfries and Galloway', 'Dumfries and Galloway');
INSERT INTO zones VALUES (4004, 222, 'Dundee', 'Dundee');
INSERT INTO zones VALUES (4005, 222, 'Durham', 'Durham');
INSERT INTO zones VALUES (4006, 222, 'East Ayrshire', 'East Ayrshire');
INSERT INTO zones VALUES (4007, 222, 'East Dunbartonshire', 'East Dunbartonshire');
INSERT INTO zones VALUES (4008, 222, 'East Lothian', 'East Lothian');
INSERT INTO zones VALUES (4009, 222, 'East Renfrewshire', 'East Renfrewshire');
INSERT INTO zones VALUES (4010, 222, 'East Riding of Yorkshire', 'East Riding of Yorkshire');
INSERT INTO zones VALUES (4011, 222, 'East Sussex', 'East Sussex');
INSERT INTO zones VALUES (4012, 222, 'Edinburgh', 'Edinburgh');
INSERT INTO zones VALUES (4013, 222, 'Essex', 'Essex');
INSERT INTO zones VALUES (4014, 222, 'Falkirk', 'Falkirk');
INSERT INTO zones VALUES (4015, 222, 'Fife', 'Fife');
INSERT INTO zones VALUES (4016, 222, 'Flintshire', 'Flintshire');
INSERT INTO zones VALUES (4017, 222, 'Glasgow', 'Glasgow');
INSERT INTO zones VALUES (4018, 222, 'Gloucestershire', 'Gloucestershire');
INSERT INTO zones VALUES (4019, 222, 'Greater London', 'Greater London');
INSERT INTO zones VALUES (4020, 222, 'Greater Manchester', 'Greater Manchester');
INSERT INTO zones VALUES (4021, 222, 'Gwynedd', 'Gwynedd');;
INSERT INTO zones VALUES (4022, 222, 'Hampshire', 'Hampshire');
INSERT INTO zones VALUES (4023, 222, 'Herefordshire', 'Herefordshire');
INSERT INTO zones VALUES (4024, 222, 'Hertfordshire', 'Hertfordshire');
INSERT INTO zones VALUES (4025, 222, 'Highlands', 'Highlands');
INSERT INTO zones VALUES (4026, 222, 'Inverclyde', 'Inverclyde');
INSERT INTO zones VALUES (4027, 222, 'Isle of Man', 'Isle of Man');
INSERT INTO zones VALUES (4028, 222, 'Isle of Wight', 'Isle of Wight');
INSERT INTO zones VALUES (4029, 222, 'Kent', 'Kent');
INSERT INTO zones VALUES (4030, 222, 'Lancashire', 'Lancashire');
INSERT INTO zones VALUES (4031, 222, 'Leicestershire', 'Leicestershire');
INSERT INTO zones VALUES (4032, 222, 'Lincolnshire', 'Lincolnshire');
INSERT INTO zones VALUES (4033, 222, 'Merseyside', 'Merseyside');
INSERT INTO zones VALUES (4034, 222, 'Merthyr Tydfil', 'Merthyr Tydfil');
INSERT INTO zones VALUES (4035, 222, 'Middlesex', 'Middlesex');
INSERT INTO zones VALUES (4036, 222, 'Midlothian', 'Midlothian');
INSERT INTO zones VALUES (4037, 222, 'Monmouthshire', 'Monmouthshire');
INSERT INTO zones VALUES (4038, 222, 'Moray', 'Moray');
INSERT INTO zones VALUES (4039, 222, 'Neath Port Talbot', 'Neath Port Talbot');
INSERT INTO zones VALUES (4040, 222, 'Newport', 'Newport');
INSERT INTO zones VALUES (4041, 222, 'Norfolk', 'Norfolk');
INSERT INTO zones VALUES (4042, 222, 'North Ayrshire', 'North Ayrshire');
INSERT INTO zones VALUES (4043, 222, 'North Lanarkshire', 'North Lanarkshire');
INSERT INTO zones VALUES (4044, 222, 'North Yorkshire', 'North Yorkshire');
INSERT INTO zones VALUES (4045, 222, 'Northamptonshire', 'Northamptonshire');
INSERT INTO zones VALUES (4046, 222, 'Northumberland', 'Northumberland');
INSERT INTO zones VALUES (4047, 222, 'Nottinghamshire', 'Nottinghamshire');
INSERT INTO zones VALUES (4048, 222, 'Orkney Islands', 'Orkney Islands');
INSERT INTO zones VALUES (4049, 222, 'Oxfordshire', 'Oxfordshire');
INSERT INTO zones VALUES (4050, 222, 'Pembrokeshire', 'Pembrokeshire');
INSERT INTO zones VALUES (4051, 222, 'Perth and Kinross', 'Perth and Kinross');
INSERT INTO zones VALUES (4052, 222, 'Powys', 'Powys');
INSERT INTO zones VALUES (4053, 222, 'Renfrewshire', 'Renfrewshire');
INSERT INTO zones VALUES (4054, 222, 'Rhondda Cynon Taff', 'Rhondda Cynon Taff');
INSERT INTO zones VALUES (4055, 222, 'Rutland', 'Rutland');
INSERT INTO zones VALUES (4056, 222, 'Scottish Borders', 'Scottish Borders');
INSERT INTO zones VALUES (4057, 222, 'Shetland Islands', 'Shetland Islands');
INSERT INTO zones VALUES (4058, 222, 'Shropshire', 'Shropshire');
INSERT INTO zones VALUES (4059, 222, 'Somerset', 'Somerset');
INSERT INTO zones VALUES (4060, 222, 'South Ayrshire', 'South Ayrshire');
INSERT INTO zones VALUES (4061, 222, 'South Lanarkshire', 'South Lanarkshire');
INSERT INTO zones VALUES (4062, 222, 'South Yorkshire', 'South Yorkshire');
INSERT INTO zones VALUES (4063, 222, 'Staffordshire', 'Staffordshire');
INSERT INTO zones VALUES (4064, 222, 'Stirling', 'Stirling');
INSERT INTO zones VALUES (4065, 222, 'Suffolk', 'Suffolk');
INSERT INTO zones VALUES (4066, 222, 'Surrey', 'Surrey');
INSERT INTO zones VALUES (4067, 222, 'Swansea', 'Swansea');
INSERT INTO zones VALUES (4068, 222, 'Torfaen', 'Torfaen');
INSERT INTO zones VALUES (4069, 222, 'Tyne and Wear', 'Tyne and Wear');
INSERT INTO zones VALUES (4070, 222, 'Vale of Glamorgan', 'Vale of Glamorgan');
INSERT INTO zones VALUES (4071, 222, 'Warwickshire', 'Warwickshire');
INSERT INTO zones VALUES (4072, 222, 'West Dunbartonshire', 'West Dunbartonshire');
INSERT INTO zones VALUES (4073, 222, 'West Lothian', 'West Lothian');
INSERT INTO zones VALUES (4074, 222, 'West Midlands', 'West Midlands');
INSERT INTO zones VALUES (4075, 222, 'West Sussex', 'West Sussex');
INSERT INTO zones VALUES (4076, 222, 'West Yorkshire', 'West Yorkshire');
INSERT INTO zones VALUES (4077, 222, 'Western Isles', 'Western Isles');
INSERT INTO zones VALUES (4078, 222, 'Wiltshire', 'Wiltshire');
INSERT INTO zones VALUES (4079, 222, 'Worcestershire', 'Worcestershire');
INSERT INTO zones VALUES (4080, 222, 'Wrexham', 'Wrexham');
INSERT INTO zones VALUES (4081, 223, 'AL', 'Alabama');
INSERT INTO zones VALUES (4082, 223, 'AK', 'Alaska');
INSERT INTO zones VALUES (4083, 223, 'AS', 'American Samoa');
INSERT INTO zones VALUES (4084, 223, 'AZ', 'Arizona');
INSERT INTO zones VALUES (4085, 223, 'AR', 'Arkansas');
INSERT INTO zones VALUES (4086, 223, 'AF', 'Armed Forces Africa');
INSERT INTO zones VALUES (4087, 223, 'AA', 'Armed Forces Americas');
INSERT INTO zones VALUES (4088, 223, 'AC', 'Armed Forces Canada');
INSERT INTO zones VALUES (4089, 223, 'AE', 'Armed Forces Europe');
INSERT INTO zones VALUES (4090, 223, 'AM', 'Armed Forces Middle East');
INSERT INTO zones VALUES (4091, 223, 'AP', 'Armed Forces Pacific');
INSERT INTO zones VALUES (4092, 223, 'CA', 'California');
INSERT INTO zones VALUES (4093, 223, 'CO', 'Colorado');
INSERT INTO zones VALUES (4094, 223, 'CT', 'Connecticut');
INSERT INTO zones VALUES (4095, 223, 'DE', 'Delaware');
INSERT INTO zones VALUES (4096, 223, 'DC', 'District of Columbia');
INSERT INTO zones VALUES (4097, 223, 'FM', 'Federated States Of Micronesia');
INSERT INTO zones VALUES (4098, 223, 'FL', 'Florida');
INSERT INTO zones VALUES (4099, 223, 'GA', 'Georgia');
INSERT INTO zones VALUES (4100, 223, 'GU', 'Guam');
INSERT INTO zones VALUES (4101, 223, 'HI', 'Hawaii');
INSERT INTO zones VALUES (4102, 223, 'ID', 'Idaho');
INSERT INTO zones VALUES (4103, 223, 'IL', 'Illinois');
INSERT INTO zones VALUES (4104, 223, 'IN', 'Indiana');
INSERT INTO zones VALUES (4105, 223, 'IA', 'Iowa');
INSERT INTO zones VALUES (4106, 223, 'KS', 'Kansas');
INSERT INTO zones VALUES (4107, 223, 'KY', 'Kentucky');
INSERT INTO zones VALUES (4108, 223, 'LA', 'Louisiana');
INSERT INTO zones VALUES (4109, 223, 'ME', 'Maine');
INSERT INTO zones VALUES (4110, 223, 'MH', 'Marshall Islands');
INSERT INTO zones VALUES (4111, 223, 'MD', 'Maryland');
INSERT INTO zones VALUES (4112, 223, 'MA', 'Massachusetts');
INSERT INTO zones VALUES (4113, 223, 'MI', 'Michigan');
INSERT INTO zones VALUES (4114, 223, 'MN', 'Minnesota');
INSERT INTO zones VALUES (4115, 223, 'MS', 'Mississippi');
INSERT INTO zones VALUES (4116, 223, 'MO', 'Missouri');
INSERT INTO zones VALUES (4117, 223, 'MT', 'Montana');
INSERT INTO zones VALUES (4118, 223, 'NE', 'Nebraska');
INSERT INTO zones VALUES (4119, 223, 'NV', 'Nevada');
INSERT INTO zones VALUES (4120, 223, 'NH', 'New Hampshire');
INSERT INTO zones VALUES (4121, 223, 'NJ', 'New Jersey');
INSERT INTO zones VALUES (4122, 223, 'NM', 'New Mexico');
INSERT INTO zones VALUES (4123, 223, 'NY', 'New York');
INSERT INTO zones VALUES (4124, 223, 'NC', 'North Carolina');
INSERT INTO zones VALUES (4125, 223, 'ND', 'North Dakota');
INSERT INTO zones VALUES (4126, 223, 'MP', 'Northern Mariana Islands');
INSERT INTO zones VALUES (4127, 223, 'OH', 'Ohio');
INSERT INTO zones VALUES (4128, 223, 'OK', 'Oklahoma');
INSERT INTO zones VALUES (4129, 223, 'OR', 'Oregon');
INSERT INTO zones VALUES (4130, 223, 'PW', 'Palau');
INSERT INTO zones VALUES (4131, 223, 'PA', 'Pennsylvania');
INSERT INTO zones VALUES (4132, 223, 'PR', 'Puerto Rico');
INSERT INTO zones VALUES (4133, 223, 'RI', 'Rhode Island');
INSERT INTO zones VALUES (4134, 223, 'SC', 'South Carolina');
INSERT INTO zones VALUES (4135, 223, 'SD', 'South Dakota');
INSERT INTO zones VALUES (4136, 223, 'TN', 'Tennessee');
INSERT INTO zones VALUES (4137, 223, 'TX', 'Texas');
INSERT INTO zones VALUES (4138, 223, 'UT', 'Utah');
INSERT INTO zones VALUES (4139, 223, 'VT', 'Vermont');
INSERT INTO zones VALUES (4140, 223, 'VI', 'Virgin Islands');
INSERT INTO zones VALUES (4141, 223, 'VA', 'Virginia');
INSERT INTO zones VALUES (4142, 223, 'WA', 'Washington');
INSERT INTO zones VALUES (4143, 223, 'WV', 'West Virginia');
INSERT INTO zones VALUES (4144, 223, 'WI', 'Wisconsin');
INSERT INTO zones VALUES (4145, 223, 'WY', 'Wyoming');
INSERT INTO zones VALUES (4146, 224, 'BI', 'Baker Island');
INSERT INTO zones VALUES (4147, 224, 'HI', 'Howland Island');
INSERT INTO zones VALUES (4148, 224, 'JI', 'Jarvis Island');
INSERT INTO zones VALUES (4149, 224, 'JA', 'Johnston Atoll');
INSERT INTO zones VALUES (4150, 224, 'KR', 'Kingman Reef');
INSERT INTO zones VALUES (4151, 224, 'MA', 'Midway Atoll');
INSERT INTO zones VALUES (4152, 224, 'NI', 'Navassa Island');
INSERT INTO zones VALUES (4153, 224, 'PA', 'Palmyra Atoll');
INSERT INTO zones VALUES (4154, 224, 'WI', 'Wake Island');
INSERT INTO zones VALUES (4155, 225, 'AR', 'Artigas');
INSERT INTO zones VALUES (4156, 225, 'CA', 'Canelones');
INSERT INTO zones VALUES (4157, 225, 'CL', 'Cerro Largo');
INSERT INTO zones VALUES (4158, 225, 'CO', 'Colonia');
INSERT INTO zones VALUES (4159, 225, 'DU', 'Durazno');
INSERT INTO zones VALUES (4160, 225, 'FS', 'Flores');
INSERT INTO zones VALUES (4161, 225, 'FA', 'Florida');
INSERT INTO zones VALUES (4162, 225, 'LA', 'Lavalleja');
INSERT INTO zones VALUES (4163, 225, 'MA', 'Maldonado');
INSERT INTO zones VALUES (4164, 225, 'MO', 'Montevideo');
INSERT INTO zones VALUES (4165, 225, 'PA', 'Paysandu');
INSERT INTO zones VALUES (4166, 225, 'RN', 'Rio Negro');
INSERT INTO zones VALUES (4167, 225, 'RV', 'Rivera');
INSERT INTO zones VALUES (4168, 225, 'RO', 'Rocha');
INSERT INTO zones VALUES (4169, 225, 'SL', 'Salto');
INSERT INTO zones VALUES (4170, 225, 'SJ', 'San Jose');
INSERT INTO zones VALUES (4171, 225, 'SO', 'Soriano');
INSERT INTO zones VALUES (4172, 225, 'TA', 'Tacuarembo');
INSERT INTO zones VALUES (4173, 225, 'TT', 'Treinta y Tres');
INSERT INTO zones VALUES (4174, 226, 'AN', 'Andijon');
INSERT INTO zones VALUES (4175, 226, 'BU', 'Buxoro');
INSERT INTO zones VALUES (4176, 226, 'FA', 'Farg''ona');
INSERT INTO zones VALUES (4177, 226, 'JI', 'Jizzax');
INSERT INTO zones VALUES (4178, 226, 'NG', 'Namangan');
INSERT INTO zones VALUES (4179, 226, 'NW', 'Navoiy');
INSERT INTO zones VALUES (4180, 226, 'QA', 'Qashqadaryo');
INSERT INTO zones VALUES (4181, 226, 'QR', 'Qoraqalpog''iston Republikasi');
INSERT INTO zones VALUES (4182, 226, 'SA', 'Samarqand');
INSERT INTO zones VALUES (4183, 226, 'SI', 'Sirdaryo');
INSERT INTO zones VALUES (4184, 226, 'SU', 'Surxondaryo');
INSERT INTO zones VALUES (4185, 226, 'TK', 'Toshkent City');
INSERT INTO zones VALUES (4186, 226, 'TO', 'Toshkent Region');
INSERT INTO zones VALUES (4187, 226, 'XO', 'Xorazm');
INSERT INTO zones VALUES (4188, 227, 'MA', 'Malampa');
INSERT INTO zones VALUES (4189, 227, 'PE', 'Penama');
INSERT INTO zones VALUES (4190, 227, 'SA', 'Sanma');
INSERT INTO zones VALUES (4191, 227, 'SH', 'Shefa');
INSERT INTO zones VALUES (4192, 227, 'TA', 'Tafea');
INSERT INTO zones VALUES (4193, 227, 'TO', 'Torba');
INSERT INTO zones VALUES (4194, 229, 'AM', 'Amazonas');
INSERT INTO zones VALUES (4195, 229, 'AN', 'Anzoategui');
INSERT INTO zones VALUES (4196, 229, 'AP', 'Apure');
INSERT INTO zones VALUES (4197, 229, 'AR', 'Aragua');
INSERT INTO zones VALUES (4198, 229, 'BA', 'Barinas');
INSERT INTO zones VALUES (4199, 229, 'BO', 'Bolivar');
INSERT INTO zones VALUES (4200, 229, 'CA', 'Carabobo');
INSERT INTO zones VALUES (4201, 229, 'CO', 'Cojedes');
INSERT INTO zones VALUES (4202, 229, 'DA', 'Delta Amacuro');
INSERT INTO zones VALUES (4203, 229, 'DF', 'Dependencias Federales');
INSERT INTO zones VALUES (4204, 229, 'DI', 'Distrito Federal');
INSERT INTO zones VALUES (4205, 229, 'FA', 'Falcon');
INSERT INTO zones VALUES (4206, 229, 'GU', 'Guarico');
INSERT INTO zones VALUES (4207, 229, 'LA', 'Lara');
INSERT INTO zones VALUES (4208, 229, 'ME', 'Merida');
INSERT INTO zones VALUES (4209, 229, 'MI', 'Miranda');
INSERT INTO zones VALUES (4210, 229, 'MO', 'Monagas');
INSERT INTO zones VALUES (4211, 229, 'NE', 'Nueva Esparta');
INSERT INTO zones VALUES (4212, 229, 'PO', 'Portuguesa');
INSERT INTO zones VALUES (4213, 229, 'SU', 'Sucre');
INSERT INTO zones VALUES (4214, 229, 'TA', 'Tachira');
INSERT INTO zones VALUES (4215, 229, 'TR', 'Trujillo');
INSERT INTO zones VALUES (4216, 229, 'VA', 'Vargas');
INSERT INTO zones VALUES (4217, 229, 'YA', 'Yaracuy');
INSERT INTO zones VALUES (4218, 229, 'ZU', 'Zulia');
INSERT INTO zones VALUES (4219, 230, 'AG', 'An Giang');
INSERT INTO zones VALUES (4220, 230, 'BG', 'Bac Giang');
INSERT INTO zones VALUES (4221, 230, 'BK', 'Bac Kan');
INSERT INTO zones VALUES (4222, 230, 'BL', 'Bac Lieu');
INSERT INTO zones VALUES (4223, 230, 'BC', 'Bac Ninh');
INSERT INTO zones VALUES (4224, 230, 'BR', 'Ba Ria-Vung Tau');
INSERT INTO zones VALUES (4225, 230, 'BN', 'Ben Tre');
INSERT INTO zones VALUES (4226, 230, 'BH', 'Binh Dinh');
INSERT INTO zones VALUES (4227, 230, 'BU', 'Binh Duong');
INSERT INTO zones VALUES (4228, 230, 'BP', 'Binh Phuoc');
INSERT INTO zones VALUES (4229, 230, 'BT', 'Binh Thuan');
INSERT INTO zones VALUES (4230, 230, 'CM', 'Ca Mau');
INSERT INTO zones VALUES (4231, 230, 'CT', 'Can Tho');
INSERT INTO zones VALUES (4232, 230, 'CB', 'Cao Bang');
INSERT INTO zones VALUES (4233, 230, 'DL', 'Dak Lak');
INSERT INTO zones VALUES (4234, 230, 'DG', 'Dak Nong');
INSERT INTO zones VALUES (4235, 230, 'DN', 'Da Nang');
INSERT INTO zones VALUES (4236, 230, 'DB', 'Dien Bien');
INSERT INTO zones VALUES (4237, 230, 'DI', 'Dong Nai');
INSERT INTO zones VALUES (4238, 230, 'DT', 'Dong Thap');
INSERT INTO zones VALUES (4239, 230, 'GL', 'Gia Lai');
INSERT INTO zones VALUES (4240, 230, 'HG', 'Ha Giang');
INSERT INTO zones VALUES (4241, 230, 'HD', 'Hai Duong');
INSERT INTO zones VALUES (4242, 230, 'HP', 'Hai Phong');
INSERT INTO zones VALUES (4243, 230, 'HM', 'Ha Nam');
INSERT INTO zones VALUES (4244, 230, 'HI', 'Ha Noi');
INSERT INTO zones VALUES (4245, 230, 'HT', 'Ha Tay');
INSERT INTO zones VALUES (4246, 230, 'HH', 'Ha Tinh');
INSERT INTO zones VALUES (4247, 230, 'HB', 'Hoa Binh');
INSERT INTO zones VALUES (4248, 230, 'HC', 'Ho Chin Minh');
INSERT INTO zones VALUES (4249, 230, 'HU', 'Hau Giang');
INSERT INTO zones VALUES (4250, 230, 'HY', 'Hung Yen');
INSERT INTO zones VALUES (4251, 232, 'C', 'Saint Croix');
INSERT INTO zones VALUES (4252, 232, 'J', 'Saint John');
INSERT INTO zones VALUES (4253, 232, 'T', 'Saint Thomas');
INSERT INTO zones VALUES (4254, 233, 'A', 'Alo');
INSERT INTO zones VALUES (4255, 233, 'S', 'Sigave');
INSERT INTO zones VALUES (4256, 233, 'W', 'Wallis');
INSERT INTO zones VALUES (4257, 235, 'AB', 'Abyan');
INSERT INTO zones VALUES (4258, 235, 'AD', 'Adan');
INSERT INTO zones VALUES (4259, 235, 'AM', 'Amran');
INSERT INTO zones VALUES (4260, 235, 'BA', 'Al Bayda');
INSERT INTO zones VALUES (4261, 235, 'DA', 'Ad Dali');
INSERT INTO zones VALUES (4262, 235, 'DH', 'Dhamar');
INSERT INTO zones VALUES (4263, 235, 'HD', 'Hadramawt');
INSERT INTO zones VALUES (4264, 235, 'HJ', 'Hajjah');
INSERT INTO zones VALUES (4265, 235, 'HU', 'Al Hudaydah');
INSERT INTO zones VALUES (4266, 235, 'IB', 'Ibb');
INSERT INTO zones VALUES (4267, 235, 'JA', 'Al Jawf');
INSERT INTO zones VALUES (4268, 235, 'LA', 'Lahij');
INSERT INTO zones VALUES (4269, 235, 'MA', 'Ma''rib');
INSERT INTO zones VALUES (4270, 235, 'MR', 'Al Mahrah');
INSERT INTO zones VALUES (4271, 235, 'MW', 'Al Mahwit');
INSERT INTO zones VALUES (4272, 235, 'SD', 'Sa''dah');
INSERT INTO zones VALUES (4273, 235, 'SN', 'San''a');
INSERT INTO zones VALUES (4274, 235, 'SH', 'Shabwah');
INSERT INTO zones VALUES (4275, 235, 'TA', 'Ta''izz');
INSERT INTO zones VALUES (4276, 236, 'KOS', 'Kosovo');
INSERT INTO zones VALUES (4277, 236, 'MON', 'Montenegro');
INSERT INTO zones VALUES (4278, 236, 'SER', 'Serbia');
INSERT INTO zones VALUES (4279, 236, 'VOJ', 'Vojvodina');
INSERT INTO zones VALUES (4280, 237, 'BC', 'Bas-Congo');
INSERT INTO zones VALUES (4281, 237, 'BN', 'Bandundu');
INSERT INTO zones VALUES (4282, 237, 'EQ', 'Equateur');
INSERT INTO zones VALUES (4283, 237, 'KA', 'Katanga');
INSERT INTO zones VALUES (4284, 237, 'KE', 'Kasai-Oriental');
INSERT INTO zones VALUES (4285, 237, 'KN', 'Kinshasa');
INSERT INTO zones VALUES (4286, 237, 'KW', 'Kasai-Occidental');
INSERT INTO zones VALUES (4287, 237, 'MA', 'Maniema');
INSERT INTO zones VALUES (4288, 237, 'NK', 'Nord-Kivu');
INSERT INTO zones VALUES (4289, 237, 'OR', 'Orientale');
INSERT INTO zones VALUES (4290, 237, 'SK', 'Sud-Kivu');
INSERT INTO zones VALUES (4291, 238, 'CE', 'Central');
INSERT INTO zones VALUES (4292, 238, 'CB', 'Copperbelt');
INSERT INTO zones VALUES (4293, 238, 'EA', 'Eastern');
INSERT INTO zones VALUES (4294, 238, 'LP', 'Luapula');
INSERT INTO zones VALUES (4295, 238, 'LK', 'Lusaka');
INSERT INTO zones VALUES (4296, 238, 'NO', 'Northern');
INSERT INTO zones VALUES (4297, 238, 'NW', 'North-Western');
INSERT INTO zones VALUES (4298, 238, 'SO', 'Southern');
INSERT INTO zones VALUES (4299, 238, 'WE', 'Western');
INSERT INTO zones VALUES (4300, 239, 'BU', 'Bulawayo');
INSERT INTO zones VALUES (4301, 239, 'HA', 'Harare');
INSERT INTO zones VALUES (4302, 239, 'ML', 'Manicaland');
INSERT INTO zones VALUES (4303, 239, 'MC', 'Mashonaland Central');
INSERT INTO zones VALUES (4304, 239, 'ME', 'Mashonaland East');
INSERT INTO zones VALUES (4305, 239, 'MW', 'Mashonaland West');
INSERT INTO zones VALUES (4306, 239, 'MV', 'Masvingo');
INSERT INTO zones VALUES (4307, 239, 'MN', 'Matabeleland North');
INSERT INTO zones VALUES (4308, 239, 'MS', 'Matabeleland South');
INSERT INTO zones VALUES (4309, 239, 'MD', 'Midlands');
INSERT INTO zones VALUES (4310, 222, 'Antrim', 'Antrim');
INSERT INTO zones VALUES (4311, 222, 'Armagh', 'Armagh');
INSERT INTO zones VALUES (4312, 222, 'Down', 'Down');
INSERT INTO zones VALUES (4313, 222, 'Fermanagh', 'Fermanagh');
INSERT INTO zones VALUES (4314, 222, 'Londonderry', 'Londonderry');
INSERT INTO zones VALUES (4315, 222, 'Tyrone', 'Tyrone');


# PayPal Express
#moved INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) values ('4', '1', 'PayPal [Transactions]', 0, 0);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable PayPal Express Checkout', 'MODULE_PAYMENT_PAYPAL_EXPRESS_STATUS', 'True', 'Do you want to accept PayPal Express Checkout payments?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Seller Account', 'MODULE_PAYMENT_PAYPAL_EXPRESS_SELLER_ACCOUNT', '', 'The email address of the seller account if no API credentials has been setup.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('API Username', 'MODULE_PAYMENT_PAYPAL_EXPRESS_API_USERNAME', '', 'The username to use for the PayPal API service', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('API Password', 'MODULE_PAYMENT_PAYPAL_EXPRESS_API_PASSWORD', '', 'The password to use for the PayPal API service', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('API Signature', 'MODULE_PAYMENT_PAYPAL_EXPRESS_API_SIGNATURE', '', 'The signature to use for the PayPal API service', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('PayPal Account Optional', 'MODULE_PAYMENT_PAYPAL_EXPRESS_ACCOUNT_OPTIONAL', 'False', 'This must also be enabled in your PayPal account, in Profile > Website Payment Preferences.', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('PayPal Instant Update', 'MODULE_PAYMENT_PAYPAL_EXPRESS_INSTANT_UPDATE', 'True', 'Support PayPal shipping and tax calculations on the PayPal.com site during Express Checkout.', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('PayPal Checkout Image', 'MODULE_PAYMENT_PAYPAL_EXPRESS_CHECKOUT_IMAGE', 'Static', 'Use static or dynamic Express Checkout image buttons. Dynamic images are used with PayPal campaigns.', '6', '0', 'tep_cfg_select_option(array(\'Static\', \'Dynamic\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Page Style', 'MODULE_PAYMENT_PAYPAL_EXPRESS_PAGE_STYLE', '', 'The page style to use for the checkout flow (defined at your PayPal Profile page)', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Transaction Method', 'MODULE_PAYMENT_PAYPAL_EXPRESS_TRANSACTION_METHOD', 'Sale', 'The processing method to use for each transaction.', '6', '0', 'tep_cfg_select_option(array(\'Authorization\', \'Sale\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_PAYPAL_EXPRESS_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('PayPal Transactions Order Status Level', 'MODULE_PAYMENT_PAYPAL_EXPRESS_TRANSACTIONS_ORDER_STATUS_ID', '4', 'Include PayPal transaction information in this order status level', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_PAYPAL_EXPRESS_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Transaction Server', 'MODULE_PAYMENT_PAYPAL_EXPRESS_TRANSACTION_SERVER', 'Live', 'Use the live or testing (sandbox) gateway server to process transactions?', '6', '0', 'tep_cfg_select_option(array(\'Live\', \'Sandbox\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Verify SSL Certificate', 'MODULE_PAYMENT_PAYPAL_EXPRESS_VERIFY_SSL', 'True', 'Verify gateway server SSL certificate on connection?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Proxy Server', 'MODULE_PAYMENT_PAYPAL_EXPRESS_PROXY', '', 'Send API requests through this proxy server. (host:port, eg: 123.45.67.89:8080 or proxy.example.com:8080)', '6', '0' , now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Debug E-Mail Address', 'MODULE_PAYMENT_PAYPAL_EXPRESS_DEBUG_EMAIL', '', 'All parameters of an invalid transaction will be sent to this email address.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_PAYPAL_EXPRESS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now());

# Header Tags
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Installed Modules', 'MODULE_HEADER_TAGS_INSTALLED', 'ht_canonical.php;ht_manufacturer_title.php;ht_category_title.php;ht_product_title.php;ht_robot_noindex.php;ht_datepicker_jquery.php;ht_grid_list_view.php;ht_table_click_jquery.php;ht_product_colorbox.php;ht_noscript.php', 'List of header tag module filenames separated by a semi-colon. This is automatically updated. No need to edit.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Category Title Module', 'MODULE_HEADER_TAGS_CATEGORY_TITLE_STATUS', 'True', 'Do you want to allow category titles to be added to the page title?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_HEADER_TAGS_CATEGORY_TITLE_SORT_ORDER', '200', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Manufacturer Title Module', 'MODULE_HEADER_TAGS_MANUFACTURER_TITLE_STATUS', 'True', 'Do you want to allow manufacturer titles to be added to the page title?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_HEADER_TAGS_MANUFACTURER_TITLE_SORT_ORDER', '100', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Product Title Module', 'MODULE_HEADER_TAGS_PRODUCT_TITLE_STATUS', 'True', 'Do you want to allow product titles to be added to the page title?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_HEADER_TAGS_PRODUCT_TITLE_SORT_ORDER', '300', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Canonical Module', 'MODULE_HEADER_TAGS_CANONICAL_STATUS', 'True', 'Do you want to enable the Canonical module?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_HEADER_TAGS_CANONICAL_SORT_ORDER', '400', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Robot NoIndex Module', 'MODULE_HEADER_TAGS_ROBOT_NOINDEX_STATUS', 'True', 'Do you want to enable the Robot NoIndex module?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Pages', 'MODULE_HEADER_TAGS_ROBOT_NOINDEX_PAGES', 'account.php;account_edit.php;account_history.php;account_history_info.php;account_newsletters.php;account_notifications.php;account_password.php;address_book.php;address_book_process.php;checkout_confirmation.php;checkout_payment.php;checkout_payment_address.php;checkout_process.php;checkout_shipping.php;checkout_shipping_address.php;checkout_success.php;cookie_usage.php;create_account.php;create_account_success.php;login.php;logoff.php;password_forgotten.php;password_reset.php;product_reviews_write.php;shopping_cart.php;ssl_check.php;tell_a_friend.php', 'The pages to add the meta robot noindex tag to.', '6', '0', 'ht_robot_noindex_show_pages', 'ht_robot_noindex_edit_pages(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_HEADER_TAGS_ROBOT_NOINDEX_SORT_ORDER', '500', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable No Script Module', 'MODULE_HEADER_TAGS_NOSCRIPT_STATUS', 'True', 'Add message for people with .js turned off?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_HEADER_TAGS_NOSCRIPT_SORT_ORDER', '1000', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Datepicker jQuery Module', 'MODULE_HEADER_TAGS_DATEPICKER_JQUERY_STATUS', 'True', 'Do you want to enable the Datepicker module?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Pages', 'MODULE_HEADER_TAGS_DATEPICKER_JQUERY_PAGES', 'advanced_search.php;account_edit.php;create_account.php', 'The pages to add the Datepicker jQuery Scripts to.', '6', '0', 'ht_datepicker_jquery_show_pages', 'ht_datepicker_jquery_edit_pages(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_HEADER_TAGS_DATEPICKER_JQUERY_SORT_ORDER', '600', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Grid List javascript', 'MODULE_HEADER_TAGS_GRID_LIST_VIEW_STATUS', 'True', 'Do you want to enable the Grid/List Javascript module?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Pages', 'MODULE_HEADER_TAGS_GRID_LIST_VIEW_PAGES', 'advanced_search_result.php;index.php;products_new.php;specials.php', 'The pages to add the Grid List JS Scripts to.', '6', '0', 'ht_grid_list_view_show_pages', 'ht_grid_list_view_edit_pages(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_HEADER_TAGS_GRID_LIST_VIEW_SORT_ORDER', '700', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Clickable Table Rows Module', 'MODULE_HEADER_TAGS_TABLE_CLICK_JQUERY_STATUS', 'True', 'Do you want to enable the Clickable Table Rows module?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Pages', 'MODULE_HEADER_TAGS_TABLE_CLICK_JQUERY_PAGES', 'checkout_payment.php;checkout_shipping.php', 'The pages to add the jQuery Scripts to.', '6', '0', 'ht_table_click_jquery_show_pages', 'ht_table_click_jquery_edit_pages(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_HEADER_TAGS_TABLE_CLICK_JQUERY_SORT_ORDER', '800', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Colorbox Script', 'MODULE_HEADER_TAGS_PRODUCT_COLORBOX_STATUS', 'True', 'Do you want to enable the Colorbox Scripts?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Pages', 'MODULE_HEADER_TAGS_PRODUCT_COLORBOX_PAGES', 'product_info.php', 'The pages to add the Colorbox Scripts to.', '6', '0', 'ht_product_colorbox_show_pages', 'ht_product_colorbox_edit_pages(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_HEADER_TAGS_PRODUCT_COLORBOX_SORT_ORDER', '900', 'Sort order of display. Lowest is displayed first.', '6', '0', now());

# Administration Tool Dashboard
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Installed Modules', 'MODULE_ADMIN_DASHBOARD_INSTALLED', 'd_total_revenue.php;d_total_customers.php;d_orders.php;d_customers.php;d_admin_logins.php;d_security_checks.php;d_latest_news.php;d_latest_addons.php;d_partner_news.php;d_version_check.php;d_reviews.php', 'List of Administration Tool Dashboard module filenames separated by a semi-colon. This is automatically updated. No need to edit.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Administrator Logins Module', 'MODULE_ADMIN_DASHBOARD_ADMIN_LOGINS_STATUS', 'True', 'Do you want to show the latest administrator logins on the dashboard?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ADMIN_DASHBOARD_ADMIN_LOGINS_SORT_ORDER', '500', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Customers Module', 'MODULE_ADMIN_DASHBOARD_CUSTOMERS_STATUS', 'True', 'Do you want to show the newest customers on the dashboard?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ADMIN_DASHBOARD_CUSTOMERS_SORT_ORDER', '400', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Latest Add-Ons Module', 'MODULE_ADMIN_DASHBOARD_LATEST_ADDONS_STATUS', 'True', 'Do you want to show the latest osCommerce Add-Ons on the dashboard?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ADMIN_DASHBOARD_LATEST_ADDONS_SORT_ORDER', '800', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Latest News Module', 'MODULE_ADMIN_DASHBOARD_LATEST_NEWS_STATUS', 'True', 'Do you want to show the latest osCommerce News on the dashboard?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ADMIN_DASHBOARD_LATEST_NEWS_SORT_ORDER', '700', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Orders Module', 'MODULE_ADMIN_DASHBOARD_ORDERS_STATUS', 'True', 'Do you want to show the latest orders on the dashboard?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ADMIN_DASHBOARD_ORDERS_SORT_ORDER', '300', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Security Checks Module', 'MODULE_ADMIN_DASHBOARD_SECURITY_CHECKS_STATUS', 'True', 'Do you want to run the security checks for this installation?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ADMIN_DASHBOARD_SECURITY_CHECKS_SORT_ORDER', '600', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Total Customers Module', 'MODULE_ADMIN_DASHBOARD_TOTAL_CUSTOMERS_STATUS', 'True', 'Do you want to show the total customers chart on the dashboard?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ADMIN_DASHBOARD_TOTAL_CUSTOMERS_SORT_ORDER', '200', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Total Revenue Module', 'MODULE_ADMIN_DASHBOARD_TOTAL_REVENUE_STATUS', 'True', 'Do you want to show the total revenue chart on the dashboard?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ADMIN_DASHBOARD_TOTAL_REVENUE_SORT_ORDER', '100', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Version Check Module', 'MODULE_ADMIN_DASHBOARD_VERSION_CHECK_STATUS', 'True', 'Do you want to show the version check results on the dashboard?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ADMIN_DASHBOARD_VERSION_CHECK_SORT_ORDER', '900', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Latest Reviews Module', 'MODULE_ADMIN_DASHBOARD_REVIEWS_STATUS', 'True', 'Do you want to show the latest reviews on the dashboard?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ADMIN_DASHBOARD_REVIEWS_SORT_ORDER', '1000', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Partner News Module', 'MODULE_ADMIN_DASHBOARD_PARTNER_NEWS_STATUS', 'True', 'Do you want to show the latest osCommerce Partner News on the dashboard?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ADMIN_DASHBOARD_PARTNER_NEWS_SORT_ORDER', '820', 'Sort order of display. Lowest is displayed first.', '6', '0', now());

# Boxes
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Installed Modules', 'MODULE_BOXES_INSTALLED', 'bm_categories.php;bm_manufacturers.php;bm_whats_new.php;bm_card_acceptance.php;bm_order_history.php;bm_best_sellers.php', 'List of box module filenames separated by a semi-colon. This is automatically updated. No need to edit.', '6', '0', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Best Sellers Module', 'MODULE_BOXES_BEST_SELLERS_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_BOXES_BEST_SELLERS_CONTENT_PLACEMENT', 'Right Column', 'Should the module be loaded in the left or right column or directly in the footer?', '6', '1', 'tep_cfg_select_option(array(\'Left Column\', \'Right Column\', \'Footer\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_BOXES_BEST_SELLERS_SORT_ORDER', '5030', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Categories Module', 'MODULE_BOXES_CATEGORIES_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_BOXES_CATEGORIES_CONTENT_PLACEMENT', 'Left Column', 'Should the module be loaded in the left or right column?', '6', '1', 'tep_cfg_select_option(array(\'Left Column\', \'Right Column\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_BOXES_CATEGORIES_SORT_ORDER', '1000', 'Sort order of display. Lowest is displayed first.', '6', '0', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Manufacturers Module', 'MODULE_BOXES_MANUFACTURERS_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_BOXES_MANUFACTURERS_CONTENT_PLACEMENT', 'Left Column', 'Should the module be loaded in the left or right column?', '6', '1', 'tep_cfg_select_option(array(\'Left Column\', \'Right Column\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_BOXES_MANUFACTURERS_SORT_ORDER', '1020', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Order History Module', 'MODULE_BOXES_ORDER_HISTORY_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_BOXES_ORDER_HISTORY_CONTENT_PLACEMENT', 'Right Column', 'Should the module be loaded in the left or right column or directly in the footer?', '6', '1', 'tep_cfg_select_option(array(\'Left Column\', \'Right Column\', \'Footer\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_BOXES_ORDER_HISTORY_SORT_ORDER', '5020', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Card Acceptance Module', 'MODULE_BOXES_CARD_ACCEPTANCE_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Logos', 'MODULE_BOXES_CARD_ACCEPTANCE_LOGOS', 'paypal_horizontal_large.png;visa.png;mastercard_transparent.png;american_express.png;maestro_transparent.png', 'The card acceptance logos to show.', '6', '0', 'bm_card_acceptance_show_logos', 'bm_card_acceptance_edit_logos(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_BOXES_CARD_ACCEPTANCE_CONTENT_PLACEMENT', 'Left Column', 'Should the module be loaded in the left or right column?', '6', '1', 'tep_cfg_select_option(array(\'Left Column\', \'Right Column\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_BOXES_CARD_ACCEPTANCE_SORT_ORDER', '1060', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable What\'s New Module', 'MODULE_BOXES_WHATS_NEW_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_BOXES_WHATS_NEW_CONTENT_PLACEMENT', 'Left Column', 'Should the module be loaded in the left or right column or directly in the footer?', '6', '1', 'tep_cfg_select_option(array(\'Left Column\', \'Right Column\', \'Footer\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_BOXES_WHATS_NEW_SORT_ORDER', '1040', 'Sort order of display. Lowest is displayed first.', '6', '0', now());

# Template Block Groups
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Installed Template Block Groups', 'TEMPLATE_BLOCK_GROUPS', 'boxes;header_tags', 'This is automatically updated. No need to edit.', '6', '0', now());

# Content Modules
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Installed Modules', 'MODULE_CONTENT_INSTALLED', 'account/cm_account_set_password;checkout_success/cm_cs_redirect_old_order;checkout_success/cm_cs_thank_you;checkout_success/cm_cs_product_notifications;checkout_success/cm_cs_downloads;login/cm_login_form;login/cm_create_account_link', 'This is automatically updated. No need to edit.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Set Account Password', 'MODULE_CONTENT_ACCOUNT_SET_PASSWORD_STATUS', 'True', 'Do you want to enable the Set Account Password module?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Allow Local Passwords', 'MODULE_CONTENT_ACCOUNT_SET_PASSWORD_ALLOW_PASSWORD', 'True', 'Allow local account passwords to be set.', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_ACCOUNT_SET_PASSWORD_SORT_ORDER', '100', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Redirect Old Order Module', 'MODULE_CONTENT_CHECKOUT_SUCCESS_REDIRECT_OLD_ORDER_STATUS', 'True', 'Should customers be redirected when viewing old checkout success orders?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Redirect Minutes', 'MODULE_CONTENT_CHECKOUT_SUCCESS_REDIRECT_OLD_ORDER_MINUTES', '60', 'Redirect customers to the My Account page after an order older than this amount is viewed.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_CHECKOUT_SUCCESS_REDIRECT_OLD_ORDER_SORT_ORDER', '500', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Thank You Module', 'MODULE_CONTENT_CHECKOUT_SUCCESS_THANK_YOU_STATUS', 'True', 'Should the thank you block be shown on the checkout success page?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_CHECKOUT_SUCCESS_THANK_YOU_SORT_ORDER', '1000', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Product Notifications Module', 'MODULE_CONTENT_CHECKOUT_SUCCESS_PRODUCT_NOTIFICATIONS_STATUS', 'True', 'Should the product notifications block be shown on the checkout success page?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_CHECKOUT_SUCCESS_PRODUCT_NOTIFICATIONS_SORT_ORDER', '2000', 'Sort order of display. Lowest is displayed first.', '6', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Product Downloads Module', 'MODULE_CONTENT_CHECKOUT_SUCCESS_DOWNLOADS_STATUS', 'True', 'Should ordered product download links be shown on the checkout success page?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_CHECKOUT_SUCCESS_DOWNLOADS_SORT_ORDER', '3000', 'Sort order of display. Lowest is displayed first.', '6', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Login Form Module', 'MODULE_CONTENT_LOGIN_FORM_STATUS', 'True', 'Do you want to enable the login form module?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Width', 'MODULE_CONTENT_LOGIN_FORM_CONTENT_WIDTH', 'Half', 'Should the content be shown in a full or half width container?', '6', '1', 'tep_cfg_select_option(array(\'Full\', \'Half\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_LOGIN_FORM_SORT_ORDER', '1000', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable New User Module', 'MODULE_CONTENT_CREATE_ACCOUNT_LINK_STATUS', 'True', 'Do you want to enable the new user module?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Width', 'MODULE_CONTENT_CREATE_ACCOUNT_LINK_CONTENT_WIDTH', 'Half', 'Should the content be shown in a full or half width container?', '6', '1', 'tep_cfg_select_option(array(\'Full\', \'Half\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_CREATE_ACCOUNT_LINK_SORT_ORDER', '2000', 'Sort order of display. Lowest is displayed first.', '6', '0', now());

# Alternative Administration System
DROP TABLE IF EXISTS aas_calendar;
CREATE TABLE aas_calendar ( id int(11) NOT NULL AUTO_INCREMENT, 
title text COLLATE utf8_unicode_ci NOT NULL, 
notes text COLLATE utf8_unicode_ci, 
start int(11) DEFAULT NULL,
end int(11) DEFAULT NULL,
allDay tinyint(1) NOT NULL DEFAULT '1',
date int(11) DEFAULT NULL,
PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARACTER SET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS aas_settings;
CREATE TABLE IF NOT EXISTS aas_settings (
  id int(11) NOT NULL AUTO_INCREMENT,
  sgroup varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'aac',
  skey varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  type varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default',
  description text COLLATE utf8_unicode_ci NOT NULL,
  value text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY (skey,type)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

INSERT INTO `aas_settings` (`id`, `sgroup`, `skey`, `type`, `description`, `value`) VALUES
  (1, 'aac', 'displayFieldsPanel', 'default', 'AAS_AAC_DISPLAY_FIELDS_PANEL', ''),
  (2, 'aac', 'displayLanguageSelection', 'default', 'AAS_AAC_DISPLAY_LANGUAGE_SELECTION', ''),
  (3, 'aac', 'displayBottomInformation', 'default', 'AAS_AAC_DISPLAY_BOTTOM_INFORMATION', ''),
  (4, 'aac', 'displayCountProducts', 'default', 'AAS_AAC_DISPLAYCOUNTPRODUCTS', ''),
  (5, 'aac', 'enableAttributesManager', 'default', 'AAS_AAC_DISABLE_ATTRIBUTES_MANAGER', ''),
  (6, 'aac', 'enableTempProductsList', 'default', 'AAS_AAC_DISABLE_TEMP_PRODUCTS_LIST', ''),
  (7, 'aac', 'enableToolBox', 'default', 'AAS_AAC_DISABLE_TOOLBOX', ''),
  (8, 'aac', 'enableClocks', 'default', 'AAS_AAC_DISABLE_CLOCKS', ''),
  (9, 'aac', 'enableSpecials', 'default', 'AAS_AAC_DISABLE_SPECIALS', ''),
  (10, 'aac', 'enableModulesManagerDialog', 'default', 'AAS_AAC_DISABLE_MODULES_MANAGER_DIALOG', ''),
  (11, 'aac', 'enableCalendar', 'default', 'AAS_AAC_DISABLE_CALENDAR', ''),
  (12, 'aac', 'enableOnlineUsers', 'default', 'AAS_AAC_DISABLE_ONLINE_USERS', ''),
  (13, 'aac', 'enableContactMe', 'default', 'AAS_AAC_DISABLE_CONTACT_ME', ''),
  (14, 'aac', 'enableDonations', 'default', 'AAS_AAC_DISABLE_DONATIONS', ''),
  (15, 'aac', 'delete_products', 'default', 'AAS_AAC_DISABLE_DELETE_PRODUCTS', ''),
  (16, 'aac', 'import', 'default', 'AAS_AAC_DISABLE_IMPORT', ''),
  (17, 'aac', 'export', 'default', 'AAS_AAC_DISABLE_EXPORT', ''),
  (18, 'aac', 'search', 'default', 'AAS_AAC_DISABLE_SEARCH', ''),
  (19, 'aac', 'print', 'default', 'AAS_AAC_DISABLE_PRINT', ''),
  (20, 'aac', 'all_edit', 'default', 'AAS_AAC_DISABLE_ALL_EDIT', ''),
  (21, 'aac', 'mass_columns_edit', 'default', 'AAS_AAC_DISABLE_MASS_COLUMNS_EDIT', '');

# Credit Class Gift Voucher (CCGV)
DROP TABLE IF EXISTS coupon_email_track;
CREATE TABLE coupon_email_track (
  unique_id int(11) NOT NULL AUTO_INCREMENT,
  coupon_id int(11) NOT NULL DEFAULT 0,
  customer_id_sent int(11) NOT NULL DEFAULT 0,
  sent_firstname varchar(32) DEFAULT NULL,
  sent_lastname varchar(32) DEFAULT NULL,
  emailed_to varchar(32) DEFAULT NULL,
  date_sent date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (unique_id)
  ) ENGINE=INNODB CHARACTER SET utf8 COLLATE utf8_unicode_ci;
  
DROP TABLE IF EXISTS coupon_gv_customer;
CREATE TABLE coupon_gv_customer (
  customer_id int(5) NOT NULL DEFAULT 0,
  amount decimal(8, 2) UNSIGNED NOT NULL DEFAULT 0.00,
  PRIMARY KEY (customer_id),
  INDEX customer_id (customer_id)
  ) ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_unicode_ci;
  
DROP TABLE IF EXISTS coupon_gv_queue;
CREATE TABLE coupon_gv_queue (
  unique_id int(5) NOT NULL AUTO_INCREMENT,
  customer_id int(5) NOT NULL DEFAULT 0,
  order_id int(5) NOT NULL DEFAULT 0,
  amount decimal(8, 2) UNSIGNED NOT NULL DEFAULT 0.00,
  date_created date NOT NULL DEFAULT '0000-00-00',
  ipaddr varchar(32) NOT NULL DEFAULT '',
  release_flag char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (unique_id),
  INDEX uid (unique_id, customer_id, order_id)
  ) ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_unicode_ci;
  
DROP TABLE IF EXISTS coupon_redeem_track;
CREATE TABLE coupon_redeem_track (
  unique_id int(11) NOT NULL AUTO_INCREMENT,
  coupon_id int(11) NOT NULL DEFAULT 0,
  customer_id int(11) NOT NULL DEFAULT 0,
  redeem_date date NOT NULL DEFAULT '0000-00-00',
  redeem_ip binary(20) NOT NULL,
  order_id int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (unique_id, coupon_id, customer_id)
  ) ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_unicode_ci;
  
DROP TABLE IF EXISTS coupons;  
CREATE TABLE coupons (
  coupon_id int(11) NOT NULL AUTO_INCREMENT,
  coupon_type char(1) NOT NULL DEFAULT 'F',
  coupon_code varchar(32) NOT NULL DEFAULT '',
  coupon_amount decimal(8, 2) UNSIGNED NOT NULL DEFAULT 0.00,
  coupon_minimum_order decimal(8, 2) UNSIGNED NOT NULL DEFAULT 0.00,
  coupon_start_date date DEFAULT '0000-00-00',
  coupon_expire_date date DEFAULT '0000-00-00',
  uses_per_coupon int(5) NOT NULL DEFAULT 1,
  uses_per_user int(5) NOT NULL DEFAULT 0,
  restrict_to_products varchar(255) DEFAULT NULL,
  restrict_to_categories varchar(255) DEFAULT NULL,
  restrict_to_customers text DEFAULT NULL,
  coupon_active char(1) NOT NULL DEFAULT 'Y',
  coupon_status int(1) NOT NULL DEFAULT 1,
  date_created date NOT NULL DEFAULT '0000-00-00',
  date_modified date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (coupon_id)
) ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS coupons_description;
CREATE TABLE coupons_description (
  coupon_id int(11) NOT NULL DEFAULT 0,
  language_id int(11) NOT NULL DEFAULT 0,
  coupon_name varchar(32) NOT NULL DEFAULT '',
  coupon_description text DEFAULT NULL,
  PRIMARY KEY (language_id, coupon_id)
) ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO configuration_group(configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES (100, 'CCGV Settings', 'Discount Coupons and Gift Voucher Settings', 100, 1);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Welcome Gift Voucher Amount', 'NEW_SIGNUP_GIFT_VOUCHER_AMOUNT', '0', 'Welcome Gift Voucher Amount: If you do not wish to send a Gift Voucher in your create account email put 0 for no amount else if you do place the amount here i.e. 10.00 or 50.00 no currency signs', 100, 1, NULL, '2003-12-05 05:01:41', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Welcome Discount Coupon Code', 'NEW_SIGNUP_DISCOUNT_COUPON', '', 'Welcome Discount Coupon Code: if you do not want to send a coupon in your create account email leave blank else place the coupon code you wish to use', 100, 2, NULL, '2003-12-05 05:01:41', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Coupon Code Length', 'CCGV_SECURITY_CODE_LENGTH', '8', 'Coupon Code Length: Set the length of the auto generated coupon code', 10, 3, NULL, '2014-12-05 05:01:41', NULL, NULL);

# Manual Order Maker
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES ('72', 'Order Editor', 'Configuration options for Order Editor', 72, 1);
INSERT into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Display the Payment Method dropdown?', 'ORDER_EDITOR_PAYMENT_DROPDOWN', 'true', 'Based on this selection Order Editor will display the payment method as a dropdown menu (true) or as an input field (false).', '72', '1', now(), now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Use prices from Separate Pricing Per Customer?', 'ORDER_EDITOR_USE_SPPC', 'false', 'Leave this set to false unless SPPC is installed.', '72', '3', now(), now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Use QTPro contribution?', 'ORDER_EDITOR_USE_QTPRO', 'false', 'Leave this set to false unless you have QTPro Installed.', '72', '4', now(), now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Allow the use of AJAX to update order information?', 'ORDER_EDITOR_USE_AJAX', 'true', 'This must be set to false if using a browser on which JavaScript is disabled or not available.', '72', '5', now(), now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Select your credit card payment method', 'ORDER_EDITOR_CREDIT_CARD', 'Credit Card', 'Order Editor will display the credit card fields when this payment method is selected.', '72', '6', now(), now(), NULL, 'tep_cfg_pull_down_payment_methods(');
INSERT into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Attach PDF Invoice to New Order Email', 'ORDER_EDITOR_ADD_PDF_INVOICE_EMAIL', 'false', 'When you send a new Order Email a PDF Invoice kan be attach to your email. This function only works if the contribution PDF Invoice is installed. NOT INSTALLED BY DEFAULT', '72', '15', now(), now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

# SEO Header Tags RELOADED BS
CREATE TABLE  information (
  information_seo_title VARCHAR( 255 ) NULL DEFAULT NULL,
  information_seo_meta_description TEXT NULL DEFAULT NULL,
  information_seo_meta_keywords VARCHAR( 255 ) NULL DEFAULT NULL
) ENGINE = INNODB CHARACTER SET utf8;

# Mail Manager Templating System
DROP TABLE IF EXISTS mm_newsletters;
CREATE TABLE mm_newsletters (
  newsletters_id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  subject varchar(127) NOT NULL,
  content text NOT NULL,
  txtcontent text NOT NULL,
  template varchar(35) NOT NULL,
  module varchar(255) NOT NULL,
  mailrate int(2) NOT NULL DEFAULT '8',
  date_added datetime NOT NULL,
  date_sent datetime DEFAULT NULL,
  status int(1) DEFAULT NULL,
  locked int(1) DEFAULT '0',
  PRIMARY KEY (`newsletters_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

DROP TABLE IF EXISTS mm_responsemail;
CREATE TABLE mm_responsemail (
  mail_id int(11) NOT NULL,
  title varchar(255) NOT NULL,
  htmlcontent text NOT NULL,
  txtcontent text NOT NULL,
  template varchar(35) NOT NULL,
  placeholders text NOT NULL,
  status tinyint(1) NOT NULL,
  PRIMARY KEY (`mail_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS mm_responsemail_backup;
CREATE TABLE mm_responsemail_backup (
  mail_id int(11) NOT NULL,
  title varchar(255) NOT NULL,
  htmlcontent text NOT NULL,
  txtcontent text NOT NULL,
  template varchar(35) NOT NULL,
  placeholders text NOT NULL,
  status tinyint(1) NOT NULL,
  PRIMARY KEY (`mail_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS mm_responsemail_reset;
CREATE TABLE mm_responsemail_reset (
  mail_id int(11) NOT NULL,
  title varchar(255) NOT NULL,
  htmlcontent text NOT NULL,
  txtcontent text NOT NULL,
  template varchar(35) NOT NULL,
  placeholders text NOT NULL,
  status tinyint(1) NOT NULL,
  PRIMARY KEY (`mail_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS mm_templates;
CREATE TABLE mm_templates (
  template_id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  htmlheader text NOT NULL,
  htmlfooter text NOT NULL,
  txtheader text NOT NULL,
  txtfooter text NOT NULL,
  PRIMARY KEY (`template_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

INSERT INTO `mm_newsletters` (`newsletters_id`, `title`, `subject`, `content`, `txtcontent`, `template`, `module`, `mailrate`, `date_added`, `date_sent`, `status`, `locked`) VALUES
(5, 'Weekly Newsletter', 'Example Email 2', '<table>\r\n  <tr> \r\n     <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color: #666666; margin:7px 0px;"  align="left" valign="top" width="50%">You can put add text and images to mail manager html emails.<br/><br >As installed,  all mail manager template and email images are hardcoded to the css-oscommerce.com website. <strong>You should go through these emails and hardcoded them to your website, or wherever you choose to upload the images,  by changing  http://www.css-oscommerce.com to http://www.yoursite.com. </strong> They should be hardcoded because the sent email will be looking for the images from a remote site, ie your customers email box. \r\n</td>\r\n     <td width="50%">\r\nThe content on this side does not have any inline text styling and will be rendered according to the settings in the customers email program. \r\n    </td>\r\n  </tr>\r\n</table>', 'You can put add text and images to mail manager html emails.As installed,  \r\nall mail manager template and email images are hardcoded to the \r\ncss-oscommerce.com website. You should go through these emails and \r\nhardcoded them to your website, or wherever you choose to upload the images,  \r\nby changing  http://www.css-oscommerce.com to http://www.yoursite.com.  \r\nThey should be hardcoded because the sent email will be looking for the images \r\nfrom a remote site, ie your customers email box. \r\n\r\nthere is some txt contentthere is some txt contentthere is some txt content\r\nthere is some txt contentthere is some txt contentthere is some txt content\r\nthere is some txt contentthere is some txt contentthere is some txt content\r\nthere is some txt contentthere is some txt contentthere is some txt content', 'Bluebox', 'newsletters', 4, '2010-10-12 16:23:18', '2011-07-15 06:35:25', 1, 1),
(6, 'Big Sale!', 'Example Email 1', '<table>\r\n  <tr> \r\n     <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color: #666666; margin:7px 0px;" width="50%" align="left" valign="top">\r\nThis is  a  table to hold some text or images. You could put a product image here. This content is   enclosed in a table. The template header, however ends with the opening td tag and the footer  begin with the closing td tag. That way the content is a nested table. \r\n    </td>\r\n     <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color: #666666; margin:7px 0px;" width="50%" align="left" valign="top">\r\nOf course that is just one  way to create emails.\r\n    </td>\r\n  </tr>\r\n<tr><td colspan="2"><hr></td></tr>\r\n<tr> \r\n     <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color: #666666; margin:7px 0px;"  align="left" valign="top" colspan="2">You can put add text and images to mail manager html emails.<br/><br >As installed,  all mail manager template and email images are hardcoded to the css-oscommerce.com website. <strong>You should go through these emails and hardcoded them to your website, or wherever you choose to upload the images,  by changing  http://www.css-oscommerce.com to http://www.yoursite.com. </strong> They should be hardcoded because the sent email will be looking for the images from a remote site, ie your customers email box. \r\n</td>\r\n  </tr>\r\n<tr><td colspan="2"><hr></td></tr>\r\n<tr> \r\n     <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color: #666666; margin:7px 0px;" width="50%" align="left" valign="top">Html emails almost always use inline styling. This means the email does not need a remote connection to an external stylesheet. You do not have to use tables. You can use div''s. It''s just that tables require less inline styling and more uniformly rendered by the vast array of email programs people use to read your emails.\r\n    </td>\r\n     <td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color: #666666; margin:7px 0px;" width="50%" align="left" valign="top">\r\nhtml content\r\n    </td>\r\n  </tr>\r\n</table>', 'You can put add text and images to mail manager html emails.\r\nAs installed,  all mail manager template and email images are hardcoded to the \r\ncss-oscommerce.com website. You should go through these emails and hardcoded \r\nthem to your website, or wherever you choose to upload the images,  by changing  \r\nhttp://www.css-oscommerce.com to http://www.yoursite.com.  They should be \r\nhardcoded because the sent email will be looking for the images from a \r\nremote site, ie your customers email box. \r\n\r\n\r\nthere is some txt contentthere is some txt contentthere is some txt content\r\nthere is some txt contentthere is some txt contentthere is some txt content\r\nthere is some txt contentthere is some txt contentthere is some txt content\r\nthere is some txt contentthere is some txt contentthere is some txt content\r\nthere is some txt contentthere is some txt contentthere is some txt content', 'Cityscape', 'customers', 8, '2011-01-15 15:49:14', '2011-07-29 20:36:34', 1, 1),
(14, 'Galaxy', 'Galaxys on sale!', '<table><tr>\r\n<td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color: #666666; margin:7px 0px;" width="50%" align="left" valign="top">You can add text and images to mail manager html emails, right from the admin panel.<br/><br /> <br />As installed,  all mail manager template and email images are hardcoded to the css-oscommerce.com website. <strong>You should go through these emails and hardcoded them to your website, or wherever you choose to upload the images,  by changing  http://www.css-oscommerce.com to http://www.yoursite.com. </strong> They should be hardcoded because the sent email will be looking for the images from a remote site, ie your customers email box. \r\n</td>\r\n<td width="50%">\r\n<img title="Galaxy Tab" src="http://www.css-oscommerce.com/images/mail_manager/niora-galaxytab.jpg" width="216" height="344" alt="Galaxy Tab" border="none"/>\r\n</td>\r\n</tr></table>', 'css-oscomerce codes oscommerce\r\n\r\nYou can put add text and images to mail manager html emails.As installed,  \r\nall mail manager template and email images are hardcoded to the \r\ncss-oscommerce.com website. You should go through these emails and \r\nhardcoded them to your website, or wherever you choose to upload the images,  \r\nby changing  http://www.css-oscommerce.com to http://www.yoursite.com.  \r\nThey should be hardcoded because the sent email will be looking for the \r\nimages from a remote site, ie your customers email box. \r\n............................................\r\nA lot of text can be put in here.\r\nA lot of text can be put in here.', 'Bluesky', 'sale_followup', 4, '2011-07-15 16:33:07', '2011-08-05 11:52:48', 1, 1);

INSERT INTO `mm_responsemail` (`mail_id`, `title`, `htmlcontent`, `txtcontent`, `template`, `placeholders`, `status`) VALUES
(1, 'Order Confirmation', '<table border="0" cellpadding="10" cellpadding="10" bgcolor="#FFFFFF" width="100%">\r\n            <tr>\r\n                <td colspan="2">\r\n                     <h1>Order Confirmation</h1><br />\r\n                      $invoiceurl\r\n                 </td>\r\n            </tr>           \r\n            <tr>\r\n                 <td style="font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;"> $orderno </td>\r\n                 <td >$orderdate</td>\r\n            </tr>\r\n             <tr><td colspan="2"><hr></td></tr>       \r\n            <tr>\r\n                  <td><strong>$billingaddresshead</strong>\r\n                          </td>\r\n                  <td style="font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;"><strong>$deliveryaddresshead</strong>\r\n                           </td>\r\n             </tr>         \r\n             <tr><td style="font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;">$deliveryaddress</td><td style="font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;">$billingaddress</td></tr>\r\n             <tr><td colspan="2"><hr></td></tr>            \r\n             <tr>\r\n                  <td colspan="2"><strong>$productsorderedhead</strong></td>\r\n              </tr>\r\n              <tr>\r\n                    <td colspan="2"  align="right" style="font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;">$productsordered</td>\r\n             \r\n              <tr>\r\n                     <td colspan="2"  align="right" style="font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;">$ordertotal</td>\r\n              </tr>\r\n              <tr><td colspan="2"><hr></td></tr>\r\n               <tr>\r\n                   <td colspan="2"> <strong>$paymethodhead</strong></td>\r\n               </tr>\r\n                <tr>\r\n                     <td>$paymentmethod</td><td>$ccardtype</td>\r\n                 </tr>\r\n                 <tr><td colspan="2" style="font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;">$ordercomments\r\n                         </td></tr>\r\n                 <tr><td colspan="2">\r\n                          $storeemail<br />\r\n                          $storeurl\r\n                        </td>\r\n                   </tr>\r\n</table>', 'order confirmation\r\n\r\n$storename\r\n$storeemail\r\n$separator\r\n$invoiceurl \r\n$orderno\r\n$orderdate\r\n$separator\r\n$deliveryaddresshead\r\n$deliveryaddress\r\n$separator\r\n$billingaddresshead\r\n$billingaddress\r\n$separator\r\n$productsorderedhead\r\n$productsordered\r\n$totaltext\r\n$subtotaltext\r\n$ordertotal\r\n$ccardtype\r\n$separator\r\n$paymethodhead\r\n$paymentmethod\r\n$ordercomments', 'Bluebox', '<tr><td class="main"><strong>Available placeholders:</strong><br /></td></tr>\r\n   								<tr><td ><table><tr><td class="main" valign="top"><ul>\r\n   								<li>$storeurl = store url</li>\r\n   								<li>$storename = store name</li>\r\n   								<li>$storeemail = store email address</li>\r\n   								<li>$invoiceurl = Invoice url</li>\r\n   								<li>$orderno = Order Number</li>\r\n   								<li>$orderdate = Order Date</li>\r\n   								<li>$ordercomments = comments</li>\r\n   								<li>$separator = ============</li>\r\n   								<li>$productsorderedhead =  heading, product list</li>\r\n   								<li>$productsordered =  product list</li>\r\n   								<li>$ordercomments = customer comments</li>\r\n                                                                </ul></td><td class="main" valign="top"><ul>								\r\n   								<li>$deliveryaddresshead = heading, delivery address</li>\r\n   								<li>$deliveryaddress = delivery address</li>\r\n   								<li>$billingaddresshead = heading, billing address</li>\r\n   								<li>$billingaddress = billing address</li>\r\n   								<li>$paymethodhead = heading, payment method</li>\r\n   								<li>$paymentmethod = payment method</li>\r\n                                                                <li>$ccardtype = credit card type</li>                                                               \r\n   								<li>$totaltext = heading, order total</li>\r\n                                                                <li>$subtotaltext = heading, subtotal</li>\r\n   								<li>$ordertotal = order total</li>\r\n   								</ul></td></tr></table></td></tr>', 1),
(2, 'Status Update', '<!--content-->\r\n<table><tr><td colspan="2" ><p style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;"><strong> $storename </strong></p></td></tr>\r\n            <tr><td><p style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">$orderno</p></td>  	\r\n<td align="center"><p align="right" style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">$orderdate</p></td></tr>\r\n            <tr>\r\n            	<td colspan="2">\r\n            	<table width="100%" border="0" cellspacing="0" cellpadding="0">\r\n            		<tr><td height="1"><img src="http://www.css-oscommerce.com/images/mail_manager/divider-invoice.jpg" width="100%" height="1" style="display: block;" /></td></tr>                                                 \r\n            	</table>\r\n            	</td>\r\n            </tr>\r\n            <tr><td colspan="2"><p style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">$statusnewhtml</p></td></tr>                    \r\n            <tr><td colspan="2"><p style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">$comments</p></td></tr>\r\n            <tr><td colspan="2"><p style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">$invoiceurl</p></td></tr></table>        \r\n<!--// content-->', '$txtheader\r\n$storeowner\r\n$orderno\r\n$orderdate\r\n$statusnewtxt\r\n$comments\r\n$invoiceurl', 'Choice', '<tr><td class="main"><strong>Available placeholders:</strong><br /></td></tr>\r\n   								<tr><td><table><tr><td class="main" valign="top"><ul>\r\n   								<li>$storeurl = store url</li>\r\n   								<li>$storename = store name</li>\r\n   								<li>$storeemail = store email address</li>\r\n   								<li>$customername = customer name</li>\r\n   								<li>$customeremail = customer email</li>\r\n   								<li>$separator = ============</li></ul></td><td class="main" valign="top"><ul>\r\n   								<li>$orderno =  order number</li>\r\n   								<li>$orderdate =  order date</li>\r\n   								<li>$statusnewhtml = new status, html format</li>\r\n   								<li>$statusnewtxt = new status, txt format</li>\r\n   								<li>$comments = comments</li>\r\n   								<li>$invoiceurl = invoice url</li>\r\n   								</ul></td></tr></table></td></tr>', 1),
(3, 'Password Forgotten', '<table>\r\n    <tr>\r\n        <td><br /><br /><br />$emailsubject<br /><br />$newpwandmsg<br /><br /><br /></td>\r\n    </tr>\r\n</table>', '$emailsubject\r\n\r\n$newpwandmsg', 'Email', '<tr><td class="main"><strong>Available placeholders:</strong><br /></td></tr>\r\n<tr><td><table><tr><td class="main" valign="top">\r\n<ul>\r\n<li>$storeurl = store url</li>\r\n<li>$storename = store name</li>\r\n<li>$customerfirstname = customer first name</li>\r\n<li>$customerlastname = customer last name</li>\r\n<li>$customeremail = customer email</li>\r\n<li>$emailsubject = email subject (EMAIL_PASSWORD_REMINDER_SUBJECT)</li>\r\n<li>$newpwandmsg = email text + new password (sprintf(EMAIL_PASSWORD_REMINDER_BODY, $new_password))</li>\r\n</ul>\r\n</td></tr></table></td></tr>', 1),
(4, 'Tell A Friend', '<table cellspacing="10" cellpadding="10">\r\n    <tr>\r\n        <td colspan="2" >\r\n           Hello $toname,<br /><br />\r\n           Your friend, $fromname,  thought that you would be interested in $products from $storename.<br />\r\n           To view the product click on the link below or copy and paste the link into your web browser:<br /><br />\r\n           $link<br /><br />\r\n           Regards, $storename\r\n            <br/ ><br />\r\n            <hr>\r\n            <br /><br />\r\n             $fromname says:\r\n            <br /><br />\r\n            <em> $message</em>\r\n         </td>\r\n         <td>\r\n              $image\r\n        <p align="center">$product</p>\r\n         </td>\r\n     </tr>\r\n</table>', 'Hello $toname,\r\nYour friend, $fromname  thought that you would be interested in $product from $storename.\r\n\r\nTo view the product click on the link below or copy and paste the link into your web browser:\r\n\r\n$link\r\n\r\nRegards, $storename\r\n\r\n-----------------------------------------------------------------\r\n$fromname says:\r\n\r\n$message', 'Cssosc', '<tr><td class="main"><strong>Available placeholders:</strong><br /></td></tr>\r\n                             <tr><td><table><tr><td class="main" valign="top">\r\n<ul>\r\n<li>$storeurl = store url</li>\r\n<li>$storeemail = store email</li>\r\n<li>$storename = store name</li>\r\n<li>$toname = email sent to</li>\r\n<li>$fromname = email sent from</li>\r\n</ul></td><td class="main" valign="top"><ul>\r\n<li>$product = product name</li>\r\n<li>$link = link to product</li>\r\n<li>$image = product image</li>\r\n<li>$message = message</li>\r\n</ul>\r\n</td></tr></table></td></tr>', 1),
(0, 'Create Account', '<!--content-->\r\n<tr>\r\n    <td>\r\n        <table bgcolor="#FFFFFF">\r\n             <tr>\r\n                <td>\r\n                     \r\n<p style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">$mmgreet<br/>$mmwelcome</p>\r\n<p style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">$mmtext</p>\r\n<p style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">$mmcontact</p>\r\n<p style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">$mmwarning\r\n</p>\r\n              </td>\r\n      	  </tr>\r\n          <tr>\r\n                <td>\r\n            	       <table width="100%" border="0" cellspacing="0" cellpadding="0">\r\n            		     <tr>\r\n                                   <td height="1"><img src="http://www.css-oscommerce.com/images/mail_manager/divider-invoice.jpg" width="100%" height="1" style="display: block;" />\r\n                                   </td>\r\n                            </tr>                                                 \r\n            	         </table>\r\n            	</td>\r\n            </tr>\r\n        </table>\r\n    </td>\r\n</tr>\r\n<!--// content-->', '$mmgreet\r\n\r\n$mmwelcome\r\n\r\n$mmtext\r\n\r\n$mmcontact\r\n\r\n$mmwarning', 'Cityscape', '', 1);


INSERT INTO `mm_responsemail_backup` (`mail_id`, `title`, `htmlcontent`, `txtcontent`, `template`, `placeholders`, `status`) VALUES
(1, 'Order Confirmation', '<table border="0" cellpadding="10" cellpadding="10" bgcolor="#FFFFFF" width="100%">\r\n            <tr>\r\n                <td colspan="2">\r\n                     <h1>Order Confirmation</h1><br />\r\n                      $invoiceurl\r\n                 </td>\r\n            </tr>           \r\n            <tr>\r\n                 <td style="font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;"> $orderno </td>\r\n                 <td >$orderdate</td>\r\n            </tr>\r\n             <tr><td colspan="2"><hr></td></tr>       \r\n            <tr>\r\n                  <td><strong>$billingaddresshead</strong>\r\n                          </td>\r\n                  <td style="font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;"><strong>$deliveryaddresshead</strong>\r\n                           </td>\r\n             </tr>         \r\n             <tr><td style="font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;">$deliveryaddress</td><td style="font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;">$billingaddress</td></tr>\r\n             <tr><td colspan="2"><hr></td></tr>            \r\n             <tr>\r\n                  <td colspan="2"><strong>$productsorderedhead</strong></td>\r\n              </tr>\r\n              <tr>\r\n                    <td colspan="2"  align="right" style="font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;">$productsordered</td>\r\n             \r\n              <tr>\r\n                     <td colspan="2"  align="right" style="font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;">$ordertotal</td>\r\n              </tr>\r\n              <tr><td colspan="2"><hr></td></tr>\r\n               <tr>\r\n                   <td colspan="2"> <strong>$paymethodhead</strong></td>\r\n               </tr>\r\n                <tr>\r\n                     <td>$paymentmethod</td><td>$ccardtype</td>\r\n                 </tr>\r\n                 <tr><td colspan="2" style="font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;">$ordercomments\r\n                         </td></tr>\r\n                 <tr><td colspan="2">\r\n                          $storeemail<br />\r\n                          $storeurl\r\n                        </td>\r\n                   </tr>\r\n</table>', 'order confirmation\r\n\r\n$storename\r\n$storeemail\r\n$separator\r\n$invoiceurl \r\n$orderno\r\n$orderdate\r\n$separator\r\n$deliveryaddresshead\r\n$deliveryaddress\r\n$separator\r\n$billingaddresshead\r\n$billingaddress\r\n$separator\r\n$productsorderedhead\r\n$productsordered\r\n$totaltext\r\n$subtotaltext\r\n$ordertotal\r\n$ccardtype\r\n$separator\r\n$paymethodhead\r\n$paymentmethod\r\n$ordercomments', 'Bluebox', '<tr><td class="main"><strong>Available placeholders:</strong><br /></td></tr>\r\n   								<tr><td ><table><tr><td class="main" valign="top"><ul>\r\n   								<li>$storeurl = store url</li>\r\n   								<li>$storename = store name</li>\r\n   								<li>$storeemail = store email address</li>\r\n   								<li>$invoiceurl = Invoice url</li>\r\n   								<li>$orderno = Order Number</li>\r\n   								<li>$orderdate = Order Date</li>\r\n   								<li>$ordercomments = comments</li>\r\n   								<li>$separator = ============</li>\r\n   								<li>$productsorderedhead =  heading, product list</li>\r\n   								<li>$productsordered =  product list</li>\r\n   								<li>$ordercomments = customer comments</li>\r\n                                                                </ul></td><td class="main" valign="top"><ul>								\r\n   								<li>$deliveryaddresshead = heading, delivery address</li>\r\n   								<li>$deliveryaddress = delivery address</li>\r\n   								<li>$billingaddresshead = heading, billing address</li>\r\n   								<li>$billingaddress = billing address</li>\r\n   								<li>$paymethodhead = heading, payment method</li>\r\n   								<li>$paymentmethod = payment method</li>\r\n                                                                <li>$ccardtype = credit card type</li>                                                               \r\n   								<li>$totaltext = heading, order total</li>\r\n                                                                <li>$subtotaltext = heading, subtotal</li>\r\n   								<li>$ordertotal = order total</li>\r\n   								</ul></td></tr></table></td></tr>', 1),
(2, 'Status Update', '<!--content-->\r\n<table><tr><td colspan="2" ><p style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;"><strong> $storename </strong></p></td></tr>\r\n            <tr><td><p style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">$orderno</p></td>  	\r\n<td align="center"><p align="right" style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">$orderdate</p></td></tr>\r\n            <tr>\r\n            	<td colspan="2">\r\n            	<table width="100%" border="0" cellspacing="0" cellpadding="0">\r\n            		<tr><td height="1"><img src="http://www.css-oscommerce.com/images/mail_manager/divider-invoice.jpg" width="100%" height="1" style="display: block;" /></td></tr>                                                 \r\n            	</table>\r\n            	</td>\r\n            </tr>\r\n            <tr><td colspan="2"><p style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">$statusnewhtml</p></td></tr>                    \r\n            <tr><td colspan="2"><p style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">$comments</p></td></tr>\r\n            <tr><td colspan="2"><p style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">$invoiceurl</p></td></tr></table>        \r\n<!--// content-->', '$txtheader\r\n$storeowner\r\n$orderno\r\n$orderdate\r\n$statusnewtxt\r\n$comments\r\n$invoiceurl', 'Choice', '<tr><td class="main"><strong>Available placeholders:</strong><br /></td></tr>\r\n   								<tr><td><table><tr><td class="main" valign="top"><ul>\r\n   								<li>$storeurl = store url</li>\r\n   								<li>$storename = store name</li>\r\n   								<li>$storeemail = store email address</li>\r\n   								<li>$customername = customer name</li>\r\n   								<li>$customeremail = customer email</li>\r\n   								<li>$separator = ============</li></ul></td><td class="main" valign="top"><ul>\r\n   								<li>$orderno =  order number</li>\r\n   								<li>$orderdate =  order date</li>\r\n   								<li>$statusnewhtml = new status, html format</li>\r\n   								<li>$statusnewtxt = new status, txt format</li>\r\n   								<li>$comments = comments</li>\r\n   								<li>$invoiceurl = invoice url</li>\r\n   								</ul></td></tr></table></td></tr>', 1),
(3, 'Password Forgotten', '<table>\r\n    <tr>\r\n        <td><br /><br /><br />$emailsubject<br /><br />$newpwandmsg<br /><br /><br /></td>\r\n    </tr>\r\n</table>', '$emailsubject\r\n\r\n$newpwandmsg', 'Email', '<tr><td class="main"><strong>Available placeholders:</strong><br /></td></tr>\r\n<tr><td><table><tr><td class="main" valign="top">\r\n<ul>\r\n<li>$storeurl = store url</li>\r\n<li>$storename = store name</li>\r\n<li>$customerfirstname = customer first name</li>\r\n<li>$customerlastname = customer last name</li>\r\n<li>$customeremail = customer email</li>\r\n<li>$emailsubject = email subject (EMAIL_PASSWORD_REMINDER_SUBJECT)</li>\r\n<li>$newpwandmsg = email text + new password (sprintf(EMAIL_PASSWORD_REMINDER_BODY, $new_password))</li>\r\n</ul>\r\n</td></tr></table></td></tr>', 1),
(4, 'Tell A Friend', '<table cellspacing="10" cellpadding="10">\r\n    <tr>\r\n        <td colspan="2" >\r\n           Hello $toname,<br /><br />\r\n           Your friend, $fromname,  thought that you would be interested in $products from $storename.<br />\r\n           To view the product click on the link below or copy and paste the link into your web browser:<br /><br />\r\n           $link<br /><br />\r\n           Regards, $storename\r\n            <br/ ><br />\r\n            <hr>\r\n            <br /><br />\r\n             $fromname says:\r\n            <br /><br />\r\n            <em> $message</em>\r\n         </td>\r\n         <td>\r\n              $image\r\n        <p align="center">$product</p>\r\n         </td>\r\n     </tr>\r\n</table>', 'Hello $toname,\r\nYour friend, $fromname  thought that you would be interested in $product from $storename.\r\n\r\nTo view the product click on the link below or copy and paste the link into your web browser:\r\n\r\n$link\r\n\r\nRegards, $storename\r\n\r\n-----------------------------------------------------------------\r\n$fromname says:\r\n\r\n$message', 'Cssosc', '<tr><td class="main"><strong>Available placeholders:</strong><br /></td></tr>\r\n                             <tr><td><table><tr><td class="main" valign="top">\r\n<ul>\r\n<li>$storeurl = store url</li>\r\n<li>$storeemail = store email</li>\r\n<li>$storename = store name</li>\r\n<li>$toname = email sent to</li>\r\n<li>$fromname = email sent from</li>\r\n</ul></td><td class="main" valign="top"><ul>\r\n<li>$product = product name</li>\r\n<li>$link = link to product</li>\r\n<li>$image = product image</li>\r\n<li>$message = message</li>\r\n</ul>\r\n</td></tr></table></td></tr>', 1),
(0, 'Create Account', '<!--content-->\r\n<tr>\r\n    <td>\r\n        <table bgcolor="#FFFFFF">\r\n             <tr>\r\n                <td>\r\n                     \r\n<p style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">$mmgreet<br/>$mmwelcome</p>\r\n<p style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">$mmtext</p>\r\n<p style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">$mmcontact</p>\r\n<p style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">$mmwarning\r\n</p>\r\n              </td>\r\n      	  </tr>\r\n          <tr>\r\n                <td>\r\n            	       <table width="100%" border="0" cellspacing="0" cellpadding="0">\r\n            		     <tr>\r\n                                   <td height="1"><img src="http://www.css-oscommerce.com/images/mail_manager/divider-invoice.jpg" width="100%" height="1" style="display: block;" />\r\n                                   </td>\r\n                            </tr>                                                 \r\n            	         </table>\r\n            	</td>\r\n            </tr>\r\n        </table>\r\n    </td>\r\n</tr>\r\n<!--// content-->', '$mmgreet\r\n\r\n$mmwelcome\r\n\r\n$mmtext\r\n\r\n$mmcontact\r\n\r\n$mmwarning', 'Cityscape', '', 1);

INSERT INTO `mm_templates` (`template_id`, `title`, `htmlheader`, `htmlfooter`, `txtheader`, `txtfooter`) VALUES
(17, 'Cssosc', '<html>\r\n<body style="padding: 0px; margin: 0px; background-color:#ffffff;" marginheight="0" topmargin="0" marginwidth="0" leftmargin="0" bgcolor="#ebebeb" >\r\n<table width="100%" cellspacing="0" border="0" cellpadding="0"  bgcolor="#ebebeb" align="center"><tr><td align="center" valign="top">\r\n<!--WRAPPER-->\r\n<table width="610" border="0" cellpadding="0" cellspacing="0"><tr><td align="center">\r\n<!--CONTAINER-->             \r\n<table width="600" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" >\r\n<!-- HEADER IMAGE-->                 	\r\n	<tr height="20"><td bgcolor="#ebebeb" ></td></tr>\r\n<!--//HEADER IMAGE -->\r\n<!-- LOGO AND HEADER -->\r\n    <tr>\r\n    	<td align="center" valign="top">\r\n        	<table cellpadding="0" cellspacing="0"  >\r\n            	<!--TOP CURVE -->\r\n            	<tr><td width="600" align="center" valign="top"><img src="http://www.css-oscommerce.com/images/mail_manager/niora-headercurve.jpg" width="600" height="18" border="0" style="display: block;" /></td></tr>\r\n                <!--//TOP CURVE-->\r\n                <tr>\r\n                    <td width="600" align="left" valign="top" bgcolor="#FFFFFF">                    \r\n                    	<!--NIORA-->\r\n                    	<table width="600" border="0" cellspacing="0" cellpadding="0" >\r\n                    	<tr>\r\n                    	<td width="20"></td>\r\n                    	<td align="left">\r\n                    	<img src="http://www.css-oscommerce.com/images/mail_manager/niora-logo.png" width="345" height="40" border="0" style="display: block;" />\r\n                    	</td>\r\n                    	<td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color: #666666; margin:7px 0px;" width="75" align="right" valign="top">Follow us on<br /> Facebook.</td>\r\n                    	<td valign="top" width="50" align="center">\r\n                    	<a href="http://www.facebook.com/pages" target="blank"><img title="Facebook Like Button" src="http://www.css-oscommerce.com/images/mail_manager/niora-fb-thumb.png" width="" height="" alt="facebook thumb" border="none"/></a>\r\n                    	</td></tr>\r\n                    	</table>\r\n                    </td>\r\n               </tr>               \r\n                <tr><td height="1"><img src="http://www.css-oscommerce.com/images/mail_manager/niora-divider.jpg" width="600" height="1" style="display: block;" /></td></tr>\r\n            </table>\r\n      </td>\r\n    </tr>\r\n    <tr><td align="center" valign="top">', '</td></tr>\r\n<tr>\r\n    	<td align="center" valign="top">\r\n        	<table cellpadding="0" cellspacing="0" >\r\n        		<tr><td><img src="http://www.css-oscommerce.com/images/mail_manager/niora-divider.jpg" width="560" height="1" style="display: block;" /></td></tr>\r\n            </table>\r\n         </td>\r\n     </tr>\r\n<tr>\r\n <td align="center">\r\n    <table width="600" cellpadding="0" cellspacing="0" style="padding:10px 0px;"  bgcolor="#FFFFFF">\r\n      <tr>\r\n        <td align="left" width="165" valign="top">\r\n           <p style="font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">Find out more:</p>\r\n           <p style="font-family: Arial, Helvetica, sans-serif; font-size: 11px; line-height: 16px; color: #999999; margin: 10px;">Visit us at <a href="http://www.css-oscommerce.com">www.css-oscommerce.com</a></p>\r\n        </td>\r\n        <td align="left" width="2" valign="bottom">\r\n        	<img src="http://www.css-oscommerce.com/images/mail_manager/niora_footer_div_vert.jpg" width="1" height="100" style="display: block;" />\r\n        </td>\r\n        <td align="left" width="165" valign="top">\r\n           <p style="font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">Contact us:</p>\r\n           <p style="font-family: Arial, Helvetica, sans-serif; font-size: 11px; line-height: 16px; color: #999999; margin: 10px;">1001 Madison Ave<br /> New York, NY 10001<br />Phone: (800)123-4567<br />Email: <a href="mailto:contact@yoursite.com">contact@yoursite.com</a></p>\r\n        </td>\r\n        <td align="left" width="3" valign="bottom">\r\n           <img src="http://www.css-oscommerce.com/images/mail_manager/niora_footer_div_vert.jpg" width="1" height="100" style="display: block;" />\r\n        </td>\r\n        <td align="left" width="165" valign="top">\r\n           <p style="font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">Follow us on Facebook:</p>\r\n               <table border="0" cellpadding="0" cellspacing="0" style="margin-left: 10px;">\r\n                 <tr>\r\n                   <td width="100" align="center"><a href="http://www.facebook.com" target="blank">\r\n                     <img title="Facebook Like Button" src="http://www.css-oscommerce.com/images/mail_manager/niora-fb-thumb.png" width="" height="" alt="facebook thumb" border="none"/></a>\r\n                   </td>                                                                                            \r\n                 </tr>\r\n               </table>  \r\n        </td>\r\n       </tr>\r\n    </table>\r\n  </td>\r\n</tr>\r\n<tr>\r\n  <td align="center">\r\n  	<img src="http://www.css-oscommerce.com/images/mail_manager/niora-footercurve.jpg" width="600" height="10" style="display: block;"/>\r\n  </td> \r\n</tr>        \r\n</table>  \r\n</td>\r\n</tr>\r\n<tr>\r\n <td align="center">\r\n    <table width="560" cellpadding="0" cellspacing="0">\r\n     <tr>\r\n       <td align="left" width="165" valign="top">\r\n       		<p style="font-family: Arial, Helvetica, sans-serif; font-size: 11px; line-height: 16px; color: #999999; margin: 10px;">If this email is not displaying correctly, <a href="http://www.mysite.com">click here</a> to view it online.</p>\r\n       </td>\r\n       <td align="left" width="165" valign="top">\r\n            <p style="font-family: Arial, Helvetica, sans-serif; font-size: 11px; line-height: 16px; color: #999999; margin: 10px;"> To be removed from this mailing list click <a href="mailto:unsubscribe@mysite.com?subject=Unsubscribe&body=Please%20remove%20my%20email%20from%20your%20list" ><u>here</u></a></p>\r\n       </td>\r\n       <td align="left" width="165" valign="top">\r\n           <p style="font-family: Arial, Helvetica, sans-serif; font-size: 11px; line-height: 16px; color: #999999; margin: 10px;">Forward this email to a friend by <a href="mailto:?subject=MyStore&body=You%20May%20be%20interested%20in%20www.mysite.com">clicking here.</a></p>\r\n       </td>\r\n     </tr>\r\n    </table>\r\n  </td>\r\n</tr>\r\n</table>    \r\n</td>\r\n</tr>\r\n</table>\r\n</body>\r\n</html>', '', ''),
(14, 'Bluebox', '<html xmlns="http://www.w3.org/1999/xhtml">\r\n<head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />\r\n	<title></title>\r\n</head>\r\n<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="margin:0;padding:0;"><img src="http://www.css-oscommerce.com/images/mail_manager/transp.gif" />\r\n<table id="bodywrap" cellspacing="0" cellpadding="0" border="0" width="100%" height="100%">\r\n<tr><td bgcolor="white" style="font-family:arial,sans-serif;font-size:12px; color:#000000;" valign="top">	\r\n<table cellspacing="0" cellpadding="0" border="0" width="600" bgcolor="#11a0dc" align="center" style="-webkit-border-radius:10px;-moz-border-radius:10px;border-radius:10px;background:#11a0dc;margin-top:4px;">\r\n	    <tr>\r\n		    <td>\r\n	            <table cellspacing="0" cellpadding="0" border="0" width="560" height="69" align="center">\r\n		            <tr>\r\n						<td width="4">&nbsp;</td>\r\n<td width="210" style="font-family:arial,sans-serif;font-size:12px;" align="left" valign="middle">\r\n<div style="font-weight:bold;font-size:16px;color:black;">This is Editable Text</div>\r\n<div style="font-weight:bold;font-size:22px;color:white;">And So is This</div>\r\n</td>\r\n<td width="216" align="right" style="font-family:arial,sans-serif;">\r\n <a href="http://www.mysite.com" style="color:white;font-weight:bold;">\r\n<img border="0" alt="mysite.com" width="216" height="69" src="http://www.css-oscommerce.com/images/mail_manager/blue-logo.jpg"/></a>\r\n		                </td>\r\n		            </tr>\r\n		        </table>\r\n\r\n                <table width="570" align="center" cellpadding="10" bgcolor="#FFFFFF" style="background:#FFFFFF;-webkit-border-radius:10px;-moz-border-radius:10px;border-radius:10px;">\r\n<tr>\r\n<td align="center" width="190" valign="top" style="font-family:arial,sans-serif;font-size:12px;">', '</td>\r\n    				</tr>\r\n    			</table>				\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n		    <td><img src="http://www.css-oscommerce.com/images/mail_manager/blue-skyline.jpg" style="vertical-align:bottom;" width="600" height="151" alt=""></td>\r\n		</tr>\r\n	</table>	\r\n<br/><br/>\r\n	<table cellspacing="0" cellpadding="8" border="0" width="560" align="center">\r\n	    <tr>\r\n		    <td style="font-family:arial,sans-serif;font-size:12px;">\r\n				<div style="color:#333333">\r\n					<p>\r\nThis message was sent to the following e-mail address: myemail@me.com<br/>\r\n					We hope you found this message to be useful. However, if you''d rather not receive future emails of this sort from CityScape, it''s easy to <a href="http://www.mysite.com">unsubscribe</a>.\r\n					</p>\r\n					<p>\r\n					Be sure to add MYSite@mysite.com to your address book or safe senders list so our emails get to your inbox.						\r\n					</p>\r\n					<p>\r\n					Note: This email was sent from a notification-only email address that cannot accept incoming email. Please do not reply to this email unless you really enjoy reading automated email replies. 	\r\n					</p>\r\n					<p>\r\n					&copy; 2011 MySite or its affiliates. All rights reserved. MySite and the MySiteLocal logo are trademarks of MySite.com, Inc. or its affiliates. MySiteLocal, 123 Madison Ave. New York, NY 10003. \r\n					</p>\r\n				</div>\r\n			</td>\r\n		</tr>\r\n	</table>			\r\n	\r\n	\r\n</td></tr></table>	\r\n<img src="http://www.css-oscommerce.com/images/mail_manager/transp.gif" /></body>\r\n</html>', 'Today''s Blue Local deal in Your Town', '!-----------------------------------------------------------------------------\r\nThis message was sent to the following email address: myemail@me.com \r\nWe hope you found this message to be useful. However, if you''d rather not\r\nreceive future emails of this sort from MySiteLocal, unsubscribe here:\r\nhttp://local.MySite.com \r\n(c) 2011 MySite or its affiliates. All rights reserved. MySite and\r\nthe MySite logo are trademarks of MySite.com, Inc. or its affiliates.\r\nMySite, 123 Madison Ave., New York, NY 10003.'),
(16, 'Cityscape', '<!-- header /Table used to center email -->\r\n<table border="0" cellspacing="0" cellpadding="0" width="660px">\r\n	<tr>\r\n		<td bgcolor="#ffffff">								\r\n		<div align="center">\r\n		<!-- Table used to set width of email -->	\r\n		<span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; color: #444444; font-weight: bold" align="center">							\r\n		Your CityScape Deal &nbsp; | &nbsp; <a href="http://mysite.com">Go to MySite.com</a> &nbsp; | &nbsp; <a href="http://tracking.mysite.com">Unsubscribe</a></span>&nbsp; &nbsp;&nbsp;\r\n		</div>\r\n		<div align="center">\r\n		<table border="0" cellspacing="0" cellpadding="0" width="660">\r\n			<tr>\r\n				<td style="padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px">																\r\n				<table border="0" cellspacing="0" cellpadding="0" width="100%">					<!--Preheader-->																		<!--Header-->																			<tr><td bgcolor="#e7e7e7"><table border="0" cellspacing="0" cellpadding="0" width="100%">\r\n<tr><td width="286" valign="bottom">\r\n<img style="display: block; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; color: #444444" src="http://www.css-oscommerce.com/images/mail_manager/cityscape_logo.jpg" border="0" alt="CityScape Deal" width="286" height="127" /></td><td width="334" valign="bottom" style="padding-top: 0px; padding-right: 20px; padding-bottom: 0px; padding-left: 0px"><table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td style="padding-top: 0px; padding-right: 0px; padding-bottom: 10px; padding-left: 0px"><table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td height="117" align="right" valign="middle"><table border="0" cellspacing="0" cellpadding="0" width="100%"><tr></tr><tr><td align="right" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #444444; font-weight: bold">Thursday, July 7,  2011<p>\r\n<a href="http://tracking.mysite.com">See today&#39;s deal</a></p>\r\n</td></tr></table></td>	</tr></table></td>	</tr></table></td></tr></table>\r\n</td></tr><tr><td bgcolor="#000000"><img style="display: block" src="http://www.css-oscommerce.com/images/mail_manager/cityscape_divider.gif" border="0" alt="" width="640" height="28" /></td>	</tr><tr>\r\n						<td style="padding-top: 20px; padding-right: 20px; padding-bottom: 20px; padding-left: 20px; background-repeat: no-repeat no-repeat" bgcolor="#29c3f9" background="http://www.css-oscommerce.com/images/mail_manager/cityscape_bg.gif"><table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td bgcolor="#ffffff">', '<!--footer--></td></tr></table>\r\n</td></tr><tr><td align="center"><p><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; color: #444444; font-weight: bold" align="center">You are receiving this e-mail because you signed up for CityScape Deal Alerts. If you prefer not to receive CityScape e-mails, you can <a href="http://tracking.mysite.com">unsubscribe with one click</a></span></p><p><span style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; color: #444444; font-weight: bold" align="center">This e-mail was delivered by CityScape 100 North Tower, Suite 123, New York NY 10003&nbsp;</span></p></td></tr></table></td></tr></table>\r\n		</div>\r\n		</td>				\r\n	</tr>\r\n</table>\r\n<!-- END Table used to center email --><custom name="opencounter" type="tracking"></custom>\r\n<img src="http://tracking.mysite.com" width=1 height=1 border=0>', 'Mysite text Header', 'MySite text footer'),
(20, 'Bluesky', '<table style="width: 700px;" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#ffffff">\r\n  <tbody>\r\n    <tr>\r\n      <td colspan="6">\r\n        <img src="http://www.css-oscommerce.com/images/mail_manager/bluesky_headover.jpg" border="0" alt="Headertop" width="700" height="25" />\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n      <td colspan="6">\r\n        <img src="http://www.css-oscommerce.com/images/mail_manager/bluesky_headunder.jpg" border="0" alt="Bluesky" width="700" height="83" />\r\n      </td>\r\n    </tr>\r\n    <tr>\r\n       <td width="15">&nbsp;</td>\r\n       <td width="653" valign="top" ><p><span style="font-size: 11px; line-height: 16px;"  align="right">\r\n<br/><br />', '</span></p><br/ ><br/ ></td>\r\n      <td width="15">&nbsp;</td>\r\n    </tr>\r\n    <tr>\r\n      <td style="padding: 5px;" colspan="4" height="15" align="center" valign="middle" bgcolor="#e3e2e7">\r\n         <span style="font-size: 11px;">Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus idut maxime placeat facere possimus</span>\r\n      </td>\r\n    </tr>\r\n    <tr>\r\n      <td style="padding-left: 10px; text-align: center;" colspan="4" height="50" valign="middle" bgcolor="#f4f3f5">\r\n        <table border="0" cellpadding="0" align="center">\r\n          <tbody>\r\n            <tr>\r\n              <td width="230" height="118" align="left" valign="middle">\r\n                <p><span style="font-size: 11px; line-height: 16px;"  align="right">Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus idut maxime placeat facere possimus.</span></p>\r\n              </td>\r\n              <td width="219">\r\n                <p><span style="font-size: 11px; line-height: 16px;">Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus idut maxime placeat facere possimus.</span></p>\r\n              </td>\r\n              <td width="230" align="left">\r\n                <span style="font-size: 11px;">My Wonderful Store<br />202 Madison Ave, New York, NY 10001\r\n                <br />phone: 800-123-1234 | Fax: 202-123-1234\r\n                <br /><a title="E-mail mysite.com" href="mailto:contact@mysite.com">mysite@mysite.com</a>\r\n                <br />www.mysite.com</span>\r\n             </td>\r\n           </tr>\r\n           </tbody>\r\n        </table>\r\n     </td>\r\n   </tr>\r\n   <tr>\r\n      <td style="padding: 5px;" colspan="4" height="25" align="center" valign="middle" bgcolor="#f4f3f5">\r\n         <a href="http://www.oscommerce.com">About Us</a> | \r\n         <a href="http://www.oscommerce.com">Buy Something</a> | \r\n         <a href="http://www.oscommerce.com">Donate</a> | \r\n         <a href="http://www.oscommerce.com">Contact Us</a> | \r\n         <a href="http://www.oscommerce.com">Privacy Policy</a> | \r\n         <a href="http://www.oscommerce.com">Unsubscribe</a> | \r\n         <a title="Update Profile" href="http://www.oscommerce.com">Update Your Profile</a>\r\n         <br /><span style="font-size: 10px;">&copy; Mysite. All rights reserved.</span>\r\n      </td>\r\n   </tr>\r\n   <tr>\r\n     <td colspan="4" height="1" bgcolor="#8a8a8a">&nbsp;\r\n        <img src="http://www.css-oscommerce.com/images/mail_manager/bluesky_spacer.gif" alt="" /> </td>\r\n    </tr>\r\n    </tbody>\r\n </table>', 'My Store', 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus idut maxime placeat facere possimus.\r\n\r\n\r\nhttp://www.oscommerce.com">About Us| \r\nhttp://www.oscommerce.com">Buy Something | \r\nhttp://www.oscommerce.com">Donate | \r\nhttp://www.oscommerce.com">Contact Us | \r\nhttp://www.oscommerce.com">Privacy Policy | \r\nhttp://www.oscommerce.com">Unsubscribe | \r\nhttp://www.oscommerce.com">Update Your Profile'),
(18, 'Choice', '<html><head>\r\n		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\r\n		<title>\r\n			Email Title\r\n		</title>\r\n	</head>\r\n	<body style="margin: 0;padding: 0;background-color: #ffffff;">\r\n		<p>\r\n			<a name="top" id="top"></a>\r\n		</p>\r\n		<table width="100%" border="0" cellspacing="0" cellpadding="0">\r\n			<tr>\r\n				<td align="center">\r\n					<table width="580" border="0" cellspacing="0" cellpadding="0">\r\n						<tr>\r\n							<td class="permission" align="center" style="padding: 20px 0 20px 0;">\r\n								<p style="font-family: ''Lucida Grande'', sans-serif;font-size: 10px;font-weight: normal;color: #151515;">\r\n									Add Team@My Site.org to your address book to make sure our email updates land in your inbox\r\n								</p>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td class="header" style="padding: 16px;background-color: #f5f5f5;">\r\n								<table width="100%" border="0" cellpadding="0" cellspacing="0" style="background-color: #f5f5f5;">\r\n									<tr>\r\n										<td class="mainbar" align="left" valign="bottom">\r\n											<a style="font-family: ''Lucida Grande'', sans-serif;font-size: 12px;font-weight: normal;color: #a72323;text-decoration: none;" href="http://mailer2sg.mysite.org"><img src="http://www.css-oscommerce.com/images/mail_manager/choice_logo.png" alt="My SIte" width="216" height="115" align="center" style="border: none;"></a>\r\n										</td>\r\n										<td align="right">\r\n											<h1 style="font-family: Georgia, serif;font-family: ''Lucida Grande'', sans-serif;font-size: 20px;color: #7a7f23;font-weight: bold;">\r\n												This is Editable Text\r\n											</h1>\r\n										</td>\r\n									</tr>\r\n									<tr>\r\n										<td class="header_bottom" colspan="2" style="border-bottom: 1px solid #CCCCCC;border-top: 1px solid #CCCCCC;font-size: 2px;">\r\n											&nbsp;\r\n										</td>\r\n									</tr>\r\n								</table>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td>\r\n								<table width="580" height="130" border="0" cellspacing="16" cellpadding="0" style="background-color: #f5f5f5;">\r\n									<tr>\r\n										<td class="mainbar" align="left" valign="top" width="580">', '</td>\r\n									</tr>\r\n								</table>\r\n							</td>\r\n						</tr>\r\n					</table>\r\n					<table width="646" border="0" cellspacing="0" cellpadding="0">\r\n						<tr>\r\n							<td>\r\n								<img src="http://www.css-oscommerce.com/images/mail_manager/choice_footer_tail.jpg" alt="Footer" width="646" height="87">\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td>\r\n								<table width="646" height="20" border="0" cellspacing="0" cellpadding="0" >\r\n									<tr>\r\n										<td align="center" valign="top" width="313">\r\n											<a href="http://mailer2sg.mysite.org" style="color:#FFFFFF;text-decoration:underline;"><img alt="Support us - Donate" src="http://www.css-oscommerce.com/images/mail_manager/choice_donate.png" style="border-width:0;vertical-align:bottom;"></a> \r\n											\r\n											<a href="http://mailer2sg.mysite.org" style="color:#FFFFFF;text-decoration:underline;"><img alt="Follow us on Facebook" src="http://www.css-oscommerce.com/images/mail_manager/choice_facebook.png" style="border-width:0;vertical-align:bottom;"></a>\r\n<a href="http://mailer2sg.catalogchoice.org" style="color:#FFFFFF;text-decoration:underline;"><img alt="Follow us on Twitter" src="http://www.css-oscommerce.com/images/mail_manager/choice_twitter.png" style="border-width:0;vertical-align:bottom;"></a>\r\n<a href="http://mailer2sg.catalogchoice.org" style="color:#FFFFFF;text-decoration:underline;"><img alt="Read our Blog" src="http://www.css-oscommerce.com/images/mail_manager/choice_blog.png" style="border-width:0;vertical-align:bottom;"></a>\r\n										</td>\r\n									</tr>\r\n								</table>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td align="center" style="padding: 20px 0 20px 0;">\r\n								<p style="font-family: ''Lucida Grande'', sans-serif;font-size: 10px;font-weight: normal;color: #151515;">\r\n									Not interested anymore? <a class="button" href="http://mailer2sg.mysite.org" style="color:#36581F; font-size:11px; font-weight:normal; text-align:center; text-decoration: underline;">Unsubscribe from our email here</a>\r\n								</p>\r\n								<p style="font-family: ''Lucida Grande'', sans-serif;font-size: 10px;font-weight: normal;color: #151515;">\r\n									<span>My Site 123 Madison Ave, New York, NY 10003</span> <a href="http://mailer2sg.mysite.org/wf" style="text-decoration:underline;color:#35511E;">Privacy Policy</a>\r\n								</p>\r\n							</td>\r\n						</tr>\r\n					</table>\r\n				</td>\r\n			</tr>\r\n		</table>\r\n		<p>\r\n			<img src="http://www.css-oscommerce.com/images/mail_manager/choice_spacer.gif">\r\n		</p>\r\n	\r\n<img src="http://www.css-oscommerce.com/images/mail_manager/choice_open.gif" alt="">\r\n</body>\r\n</html>', 'Add Team@mysite.org to your address book to make sure our\r\nemail updates land in your inbox\r\n\r\nCatalog Choice: Together We Make a Difference', 'P.S. Still getting unwanted mail or phone books? Log in to your\r\naccount and opt out.\r\n\r\nNot interested anymore? Unsubscribe from our email here\r\nhttps://www.mysite.org/mass_emails/423/unsubscribe\r\n\r\nMy Site 123 Madison Ave, New York, NY, 10003 Privacy\r\nPolicy http://www.mysite.org/privacy'),
(19, 'Email', '<table width="100%" border="0" cellspacing="0" cellpadding="0">\r\n			<tr>\r\n				<td align="center">\r\n					<table width="580" border="0" cellspacing="0" cellpadding="0">\r\n						<tr>\r\n							<td class="permission" align="center" style="padding: 20px 0 20px 0;">\r\n								<p style="font-family: ''Lucida Grande'', sans-serif;font-size: 10px;font-weight: normal;color: #151515;">\r\n									Add Team@mysite.org to your address book to make sure our email updates land in your inbox\r\n								</p>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td class="header" style="padding: 16px;background-color: #f5f5f5;">\r\n								<table width="100%" border="0" cellpadding="0" cellspacing="0" style="background-color: #f5f5f5;">\r\n									<tr>\r\n										<td class="mainbar" align="left" valign="bottom">\r\n											<a style="font-family: ''Lucida Grande'', sans-serif;font-size: 12px;font-weight: normal;color: #a72323;text-decoration: none;" href="http://mailer2sg.mysite.org"><img src="http://www.css-oscommerce.com/images/mail_manager/choice_logo.png" alt="My Site" width="179" height="115" align="center" style="border: none;"></a>\r\n										</td>\r\n										<td align="right">\r\n											<h1 style="font-family: Georgia, serif;font-family: ''Lucida Grande'', sans-serif;font-size: 20px;color: #7a7f23;font-weight: bold;">\r\n												Together We Make A Difference\r\n											</h1>\r\n										</td>\r\n									</tr>\r\n									<tr>\r\n										<td class="header_bottom" colspan="2" style="border-bottom: 1px solid #CCCCCC;border-top: 1px solid #CCCCCC;font-size: 2px;">\r\n											&nbsp;\r\n										</td>\r\n									</tr>\r\n								</table>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td>\r\n								<table width="580" height="130" border="0" cellspacing="16" cellpadding="0" style="background-color: #f5f5f5;">\r\n									<tr>\r\n										<td class="mainbar" align="left" valign="top" width="580">\r\n<table width="400" align="center"><tr><td style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; color: #666666; margin:7px 0px;" width="50%" align="left" valign="top">', '</td></tr></table>\r\n</td>\r\n									</tr>\r\n								</table>\r\n							</td>\r\n						</tr>\r\n					</table>\r\n					<table width="646" border="0" cellspacing="0" cellpadding="0">\r\n						<tr>\r\n							<td>\r\n								<img src="http://www.css-oscommerce.com/images/mail_manager/choice_footer_tail.jpg" alt="Footer" width="646" height="87">\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td>\r\n								<table width="646" height="20" border="0" cellspacing="0" cellpadding="0">\r\n									<tr>\r\n										<td align="center" valign="top" width="313">\r\n											<a href="http://mailer2sg.catalogchoice.org" style="color:#FFFFFF;text-decoration:underline;"><img alt="Support us - Donate" src="http://www.css-oscommerce.com/images/mail_manager/choice_donate.png" style="border-width:0;vertical-align:bottom;"></a> \r\n											\r\n											<a href="http://mailer2sg.catalogchoice.org" style="color:#FFFFFF;text-decoration:underline;"><img alt="Follow us on Facebook" src="http://www.css-oscommerce.com/images/mail_manager/choice_facebook.png" style="border-width:0;vertical-align:bottom;"></a>\r\n<a href="http://mailer2sg.catalogchoice.org" style="color:#FFFFFF;text-decoration:underline;"><img alt="Follow us on Twitter" src="http://www.css-oscommerce.com/images/mail_manager/choice_twitter.png" style="border-width:0;vertical-align:bottom;"></a>\r\n<a href="http://mailer2sg.catalogchoice.org" style="color:#FFFFFF;text-decoration:underline;"><img alt="Read our Blog" src="http://www.css-oscommerce.com/images/mail_manager/choice_blog.png" style="border-width:0;vertical-align:bottom;"></a>\r\n										</td>\r\n									</tr>\r\n								</table>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td align="center" style="padding: 20px 0 20px 0;">\r\n								<p style="font-family: ''Lucida Grande'', sans-serif;font-size: 10px;font-weight: normal;color: #151515;">\r\n									Not interested anymore? <a class="button" href="http://mailer2sg.mysite.org" style="color:#36581F; font-size:11px; font-weight:normal; text-align:center; text-decoration: underline;">Unsubscribe from our email here</a>\r\n								</p>\r\n								<p style="font-family: ''Lucida Grande'', sans-serif;font-size: 10px;font-weight: normal;color: #151515;">\r\n									<span>My Site 123 Madison Ave, New York, NY 10003</span> <a href="http://mailer2sg.catalogchoice.org/wf" style="text-decoration:underline;color:#35511E;">Privacy Policy</a>\r\n								</p>\r\n							</td>\r\n						</tr>\r\n					</table>\r\n				</td>\r\n			</tr>\r\n		</table>', '', '');

INSERT INTO `mm_responsemail_reset` (`mail_id`, `title`, `htmlcontent`, `txtcontent`, `template`, `placeholders`, `status`) VALUES
(1, 'Order Confirmation', '<table border="0" cellpadding="10" cellpadding="10" bgcolor="#FFFFFF" width="100%">\r\n            <tr>\r\n                <td colspan="2">\r\n                     <h1>Order Confirmation</h1><br />\r\n                      $invoiceurl\r\n                 </td>\r\n            </tr>           \r\n            <tr>\r\n                 <td style="font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;"> $orderno </td>\r\n                 <td >$orderdate</td>\r\n            </tr>\r\n             <tr><td colspan="2"><hr></td></tr>       \r\n            <tr>\r\n                  <td><strong>$billingaddresshead</strong>\r\n                          </td>\r\n                  <td style="font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;"><strong>$deliveryaddresshead</strong>\r\n                           </td>\r\n             </tr>         \r\n             <tr><td style="font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;">$deliveryaddress</td><td style="font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;">$billingaddress</td></tr>\r\n             <tr><td colspan="2"><hr></td></tr>            \r\n             <tr>\r\n                  <td colspan="2"><strong>$productsorderedhead</strong></td>\r\n              </tr>\r\n              <tr>\r\n                    <td colspan="2"  align="right" style="font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;">$productsordered</td>\r\n             \r\n              <tr>\r\n                     <td colspan="2"  align="right" style="font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;">$ordertotal</td>\r\n              </tr>\r\n              <tr><td colspan="2"><hr></td></tr>\r\n               <tr>\r\n                   <td colspan="2"> <strong>$paymethodhead</strong></td>\r\n               </tr>\r\n                <tr>\r\n                     <td>$paymentmethod</td><td>$ccardtype</td>\r\n                 </tr>\r\n                 <tr><td colspan="2" style="font-family: Helvetica, Verdana, sans-serif; font-size: 12px; line-height: 14px; color: #333333; margin: 10px;">$ordercomments\r\n                         </td></tr>\r\n                 <tr><td colspan="2">\r\n                          $storeemail<br />\r\n                          $storeurl\r\n                        </td>\r\n                   </tr>\r\n</table>', 'order confirmation\r\n\r\n$storename\r\n$storeemail\r\n$separator\r\n$invoiceurl \r\n$orderno\r\n$orderdate\r\n$separator\r\n$deliveryaddresshead\r\n$deliveryaddress\r\n$separator\r\n$billingaddresshead\r\n$billingaddress\r\n$separator\r\n$productsorderedhead\r\n$productsordered\r\n$totaltext\r\n$subtotaltext\r\n$ordertotal\r\n$ccardtype\r\n$separator\r\n$paymethodhead\r\n$paymentmethod\r\n$ordercomments', 'Bluebox', '<tr><td class="main"><strong>Available placeholders:</strong><br /></td></tr>\r\n   								<tr><td ><table><tr><td class="main" valign="top"><ul>\r\n   								<li>$storeurl = store url</li>\r\n   								<li>$storename = store name</li>\r\n   								<li>$storeemail = store email address</li>\r\n   								<li>$invoiceurl = Invoice url</li>\r\n   								<li>$orderno = Order Number</li>\r\n   								<li>$orderdate = Order Date</li>\r\n   								<li>$ordercomments = comments</li>\r\n   								<li>$separator = ============</li>\r\n   								<li>$productsorderedhead =  heading, product list</li>\r\n   								<li>$productsordered =  product list</li>\r\n   								<li>$ordercomments = customer comments</li>\r\n                                                                </ul></td><td class="main" valign="top"><ul>								\r\n   								<li>$deliveryaddresshead = heading, delivery address</li>\r\n   								<li>$deliveryaddress = delivery address</li>\r\n   								<li>$billingaddresshead = heading, billing address</li>\r\n   								<li>$billingaddress = billing address</li>\r\n   								<li>$paymethodhead = heading, payment method</li>\r\n   								<li>$paymentmethod = payment method</li>\r\n                                                                <li>$ccardtype = credit card type</li>                                                               \r\n   								<li>$totaltext = heading, order total</li>\r\n                                                                <li>$subtotaltext = heading, subtotal</li>\r\n   								<li>$ordertotal = order total</li>\r\n   								</ul></td></tr></table></td></tr>', 1),
(2, 'Status Update', '<!--content-->\r\n<table><tr><td colspan="2" ><p style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;"><strong> $storename </strong></p></td></tr>\r\n            <tr><td><p style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">$orderno</p></td>  	\r\n<td align="center"><p align="right" style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">$orderdate</p></td></tr>\r\n            <tr>\r\n            	<td colspan="2">\r\n            	<table width="100%" border="0" cellspacing="0" cellpadding="0">\r\n            		<tr><td height="1"><img src="http://www.css-oscommerce.com/images/mail_manager/divider-invoice.jpg" width="100%" height="1" style="display: block;" /></td></tr>                                                 \r\n            	</table>\r\n            	</td>\r\n            </tr>\r\n            <tr><td colspan="2"><p style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">$statusnewhtml</p></td></tr>                    \r\n            <tr><td colspan="2"><p style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">$comments</p></td></tr>\r\n            <tr><td colspan="2"><p style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">$invoiceurl</p></td></tr></table>        \r\n<!--// content-->', '$txtheader\r\n$storeowner\r\n$orderno\r\n$orderdate\r\n$statusnewtxt\r\n$comments\r\n$invoiceurl', 'Choice', '<tr><td class="main"><strong>Available placeholders:</strong><br /></td></tr>\r\n   								<tr><td><table><tr><td class="main" valign="top"><ul>\r\n   								<li>$storeurl = store url</li>\r\n   								<li>$storename = store name</li>\r\n   								<li>$storeemail = store email address</li>\r\n   								<li>$customername = customer name</li>\r\n   								<li>$customeremail = customer email</li>\r\n   								<li>$separator = ============</li></ul></td><td class="main" valign="top"><ul>\r\n   								<li>$orderno =  order number</li>\r\n   								<li>$orderdate =  order date</li>\r\n   								<li>$statusnewhtml = new status, html format</li>\r\n   								<li>$statusnewtxt = new status, txt format</li>\r\n   								<li>$comments = comments</li>\r\n   								<li>$invoiceurl = invoice url</li>\r\n   								</ul></td></tr></table></td></tr>', 1),
(3, 'Password Forgotten', '<table>\r\n    <tr>\r\n        <td><br /><br /><br />$emailsubject<br /><br />$newpwandmsg<br /><br /><br /></td>\r\n    </tr>\r\n</table>', '$emailsubject\r\n\r\n$newpwandmsg', 'Email', '<tr><td class="main"><strong>Available placeholders:</strong><br /></td></tr>\r\n<tr><td><table><tr><td class="main" valign="top">\r\n<ul>\r\n<li>$storeurl = store url</li>\r\n<li>$storename = store name</li>\r\n<li>$customerfirstname = customer first name</li>\r\n<li>$customerlastname = customer last name</li>\r\n<li>$customeremail = customer email</li>\r\n<li>$emailsubject = email subject (EMAIL_PASSWORD_REMINDER_SUBJECT)</li>\r\n<li>$newpwandmsg = email text + new password (sprintf(EMAIL_PASSWORD_REMINDER_BODY, $new_password))</li>\r\n</ul>\r\n</td></tr></table></td></tr>', 1),
(4, 'Tell A Friend', '<table cellspacing="10" cellpadding="10">\r\n    <tr>\r\n        <td colspan="2" >\r\n           Hello $toname,<br /><br />\r\n           Your friend, $fromname,  thought that you would be interested in $products from $storename.<br />\r\n           To view the product click on the link below or copy and paste the link into your web browser:<br /><br />\r\n           $link<br /><br />\r\n           Regards, $storename\r\n            <br/ ><br />\r\n            <hr>\r\n            <br /><br />\r\n             $fromname says:\r\n            <br /><br />\r\n            <em> $message</em>\r\n         </td>\r\n         <td>\r\n              $image\r\n        <p align="center">$product</p>\r\n         </td>\r\n     </tr>\r\n</table>', 'Hello $toname,\r\nYour friend, $fromname  thought that you would be interested in $product from $storename.\r\n\r\nTo view the product click on the link below or copy and paste the link into your web browser:\r\n\r\n$link\r\n\r\nRegards, $storename\r\n\r\n-----------------------------------------------------------------\r\n$fromname says:\r\n\r\n$message', 'Cssosc', '<tr><td class="main"><strong>Available placeholders:</strong><br /></td></tr>\r\n                             <tr><td><table><tr><td class="main" valign="top">\r\n<ul>\r\n<li>$storeurl = store url</li>\r\n<li>$storeemail = store email</li>\r\n<li>$storename = store name</li>\r\n<li>$toname = email sent to</li>\r\n<li>$fromname = email sent from</li>\r\n</ul></td><td class="main" valign="top"><ul>\r\n<li>$product = product name</li>\r\n<li>$link = link to product</li>\r\n<li>$image = product image</li>\r\n<li>$message = message</li>\r\n</ul>\r\n</td></tr></table></td></tr>', 1),
(0, 'Create Account', '<!--content-->\r\n<tr>\r\n    <td>\r\n        <table bgcolor="#FFFFFF">\r\n             <tr>\r\n                <td>\r\n                     \r\n<p style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">$mmgreet<br/>$mmwelcome</p>\r\n<p style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">$mmtext</p>\r\n<p style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">$mmcontact</p>\r\n<p style="font-family: Verdana, sans-serif; font-size: 12px; line-height: 16px; color: #666666; margin: 10px;">$mmwarning\r\n</p>\r\n              </td>\r\n      	  </tr>\r\n          <tr>\r\n                <td>\r\n            	       <table width="100%" border="0" cellspacing="0" cellpadding="0">\r\n            		     <tr>\r\n                                   <td height="1"><img src="http://www.css-oscommerce.com/images/mail_manager/divider-invoice.jpg" width="100%" height="1" style="display: block;" />\r\n                                   </td>\r\n                            </tr>                                                 \r\n            	         </table>\r\n            	</td>\r\n            </tr>\r\n        </table>\r\n    </td>\r\n</tr>\r\n<!--// content-->', '$mmgreet\r\n\r\n$mmwelcome\r\n\r\n$mmtext\r\n\r\n$mmcontact\r\n\r\n$mmwarning', 'Cityscape', '', 1);

DROP TABLE IF EXISTS mm_bulkmail;
CREATE TABLE mm_bulkmail (
  bulkmail_id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  htmlcontent text NOT NULL,
  txtcontent text NOT NULL,
  date_added datetime NOT NULL,
  date_sent datetime DEFAULT NULL,
  PRIMARY KEY (`bulkmail_id`) 
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

















