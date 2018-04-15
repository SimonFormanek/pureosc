# TABLE OF CONTENTS:

# ADDRESS_BOOK
# KEYS_CUSTOMER
# LAST_EMPTY_CUSTOMERS_ID

# configuration insert

# ADDRESS_BOOK ########################################

DROP TABLE IF EXISTS address_book_real;
CREATE TABLE address_book_real (
   address_book_id int NOT NULL auto_increment,
   customers_id int NOT NULL,
   entry_gender char(1),
   entry_company text,
   entry_company_number text,
   entry_vat_number text,
   entry_firstname text,
   entry_lastname text,
   entry_street_address text,
   entry_suburb text,
   entry_postcode text,
   entry_city text,
   entry_state varchar(255),
   entry_country_id int DEFAULT '0' NOT NULL,
   entry_zone_id int DEFAULT '0' NOT NULL,
   PRIMARY KEY (address_book_id),
   KEY idx_address_book_customers_id (customers_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS address_book;

DROP VIEW IF EXISTS address_book;
CREATE VIEW address_book (
   address_book_id,
   customers_id,
   entry_gender,
   entry_company,
   entry_company_number,
   entry_vat_number,
   entry_firstname,
   entry_lastname,
   entry_street_address,
   entry_suburb,
   entry_postcode,
   entry_city,
   entry_state,
   entry_country_id,
   entry_zone_id
)
AS SELECT
   address_book_real.address_book_id,
   address_book_real.customers_id,
   address_book_real.entry_gender,
   address_book_real.entry_company,
   address_book_real.entry_company_number,
   address_book_real.entry_vat_number,
   address_book_real.entry_firstname,
   address_book_real.entry_lastname,
   address_book_real.entry_street_address,
   address_book_real.entry_suburb,
   address_book_real.entry_postcode,
   address_book_real.entry_city,
   address_book_real.entry_state,
   address_book_real.entry_country_id,
   address_book_real.entry_zone_id
FROM address_book_real
WHERE ( (address_book_real.customers_id = (select substr(substring_index(user(),'@',1),3))) OR (select substr(substring_index(user(),'@',1),3,3) = 'adm') OR (select substr(substring_index(user(),'@',1),3,3) = 'mad') );



# KEYS_CUSTOMER #######################################

DROP TABLE IF EXISTS `keys_customer_real`;
CREATE TABLE `keys_customer_real` (
  `customers_id` int(11) NOT NULL,
  `keys_customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `public_key_customer` text COLLATE utf8_unicode_ci,
  `private_key_customer` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`keys_customer_id`)
);

DROP TABLE IF EXISTS `keys_customer`;
DROP VIEW IF EXISTS keys_customer;

CREATE VIEW keys_customer (
   customers_id,
   keys_customer_id,
   public_key_customer,
   private_key_customer
)
AS SELECT
   keys_customer_real.customers_id,
   keys_customer_real.keys_customer_id,
   keys_customer_real.public_key_customer,
   keys_customer_real.private_key_customer
FROM keys_customer_real
WHERE ( (keys_customer_real.customers_id = (select substr(substring_index(user(),'@',1),3))) OR (select substr(substring_index(user(),'@',1),3,3) = 'adm') OR (select substr(substring_index(user(),'@',1),3,3) = 'mad') );

# KEYS_ADMIN

DROP TABLE IF EXISTS `keys_admin`;
CREATE TABLE `keys_admin` (
  `customers_id` int(11),
  `public_key_admin` text,
  PRIMARY KEY (`customers_id`)
);


# CUSTOMERS ##############################################################
   
	 DROP TABLE IF EXISTS customers_real;
	 CREATE TABLE customers_real (
   customers_id int,
   customers_status tinyint default '0' COMMENT '0=not active yet, 1=active, 2=to be deleted PWA, 3=user demand to be deleted, 8=deleted from client and admin, 9=deleted and fully anonymized',
   customers_gender char(1),
   customers_firstname text,
   customers_lastname text,
   customers_dob text,
   customers_email_address varchar(255) NOT NULL,
   customers_default_address_id int,
   customers_telephone text,
   customers_fax text,
   customers_password varchar(60) NOT NULL,
   customers_newsletter char(1),
   mmstatus VARCHAR(2) NOT NULL DEFAULT '0',
   PRIMARY KEY (customers_id),
   KEY idx_customers_email_address (customers_email_address)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS customers;

DROP VIEW IF EXISTS customers;
CREATE VIEW customers (
   customers_id,
   customers_gender,
   customers_firstname,
   customers_lastname,
   customers_dob,
   customers_email_address,
   customers_default_address_id,
   customers_telephone,
   customers_fax,
   customers_password,
   customers_newsletter,
   mmstatus 
)
AS SELECT
   customers_real.customers_id,
   customers_real.customers_gender,
   customers_real.customers_firstname,
   customers_real.customers_lastname,
   customers_real.customers_dob,
   customers_real.customers_email_address,
   customers_real.customers_default_address_id,
   customers_real.customers_telephone,
   customers_real.customers_fax,
   customers_real.customers_password,
   customers_real.customers_newsletter,
   customers_real.mmstatus 
FROM customers_real
WHERE ( (customers_real.customers_id = (select substr(substring_index(user(),'@',1),3))) OR (select substr(substring_index(user(),'@',1),3,3) = 'adm') OR (select substr(substring_index(user(),'@',1),3,3) = 'mad') );


# LAST_EMPTY_CUSTOMERS_ID ###############################################################

DROP TABLE IF EXISTS last_empty_customers_id;
CREATE TABLE last_empty_customers_id (
customers_id int(12)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;

INSERT INTO last_empty_customers_id values ('0');

# TABLE_NEW_CUSTOMER_ID #####################################

DROP TABLE IF EXISTS new_customer_id;
CREATE TABLE new_customer_id (
  customers_id int NOT NULL auto_increment,
  created tinyint NOT NULL,
  PRIMARY KEY (customers_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;



# ORDERS

DROP TABLE IF EXISTS orders_real;
CREATE TABLE orders_real (
  orders_id int NOT NULL auto_increment,
  customers_id int NOT NULL,
  customers_name text,
  customers_company text,
  customers_company_number text,
  customers_vat_number text,
  customers_street_address text,
  customers_suburb text,
  customers_city text,
  customers_postcode text,
  customers_state varchar(255),
  customers_country varchar(255) NOT NULL,
  customers_telephone text,
  customers_email_address varchar(255) NOT NULL,
  customers_address_format_id int(5) NOT NULL,
  delivery_name text,
  delivery_company text,
  delivery_company_number text,
  delivery_vat_number text,
  delivery_street_address text,
  delivery_suburb text,
  delivery_city text,
  delivery_postcode text,
  delivery_state varchar(255),
  delivery_country varchar(255) NOT NULL,
  delivery_address_format_id int(5) NOT NULL,
  billing_name text,
  billing_company text,
  billing_company_number text,
  billing_vat_number text,
  billing_street_address text,
  billing_suburb text,
  billing_city text,
  billing_postcode text,
  billing_state varchar(255),
  billing_country varchar(255) NOT NULL,
  billing_address_format_id int(5) NOT NULL,
  payment_method varchar(255) NOT NULL,
  cc_type text,
  cc_owner text,
  cc_number text,
  cc_expires text,
  last_modified datetime,
  date_purchased datetime,
  orders_status int(5) NOT NULL,
  orders_date_finished datetime,
  currency char(3),
  currency_value decimal(14,6),
  customer_service_id VARCHAR(15),
  shipping_module VARCHAR(255),
  PRIMARY KEY (orders_id),
  KEY idx_orders_customers_id (customers_id)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci
  ROW_FORMAT=DYNAMIC;
;

DROP TABLE IF EXISTS orders;

DROP VIEW IF EXISTS orders;
CREATE VIEW orders (
  orders_id,
  customers_id,
  customers_name,
  customers_company,
  customers_company_number,
  customers_vat_number,
  customers_street_address,
  customers_suburb,
  customers_city,
  customers_postcode,
  customers_state,
  customers_country,
  customers_telephone,
  customers_email_address,
  customers_address_format_id,
  delivery_name,
  delivery_company,
  delivery_company_number,
  delivery_vat_number,
  delivery_street_address,
  delivery_suburb,
  delivery_city,
  delivery_postcode,
  delivery_state,
  delivery_country,
  delivery_address_format_id,
  billing_name,
  billing_company,
  billing_company_number,
  billing_vat_number,
  billing_street_address,
  billing_suburb,
  billing_city,
  billing_postcode,
  billing_state,
  billing_country,
  billing_address_format_id,
  payment_method,
  cc_type,
  cc_owner,
  cc_number,
  cc_expires,
  last_modified,
  date_purchased,
  orders_status,
  orders_date_finished,
  currency,
  currency_value,
  customer_service_id,
  shipping_module
)
AS SELECT
  orders_real.orders_id AS orders_id,
  orders_real.customers_id AS customers_id,
  orders_real.customers_name AS customers_name,
  orders_real.customers_company AS customers_company,
  orders_real.customers_company_number AS customers_company_number,
  orders_real.customers_vat_number AS customers_vat_number,
  orders_real.customers_street_address AS customers_street_address,
  orders_real.customers_suburb AS customers_suburb,
  orders_real.customers_city AS customers_city,
  orders_real.customers_postcode AS customers_postcode,
  orders_real.customers_state AS customers_state,
  orders_real.customers_country AS customers_country,
  orders_real.customers_telephone AS customers_telephone,
  orders_real.customers_email_address AS customers_email_address,
  orders_real.customers_address_format_id AS customers_address_format_id,
  orders_real.delivery_name AS delivery_name,
  orders_real.delivery_company AS delivery_company,
  orders_real.delivery_company_number AS delivery_company_number,
  orders_real.delivery_vat_number AS delivery_vat_number,
  orders_real.delivery_street_address AS delivery_street_address,
  orders_real.delivery_suburb AS delivery_suburb,
  orders_real.delivery_city AS delivery_city,
  orders_real.delivery_postcode AS delivery_postcode,
  orders_real.delivery_state AS delivery_state,
  orders_real.delivery_country AS delivery_country,
  orders_real.delivery_address_format_id AS delivery_address_format_id,
  orders_real.billing_name AS billing_name,
  orders_real.billing_company AS billing_company,
  orders_real.billing_company_number AS billing_company_number,
  orders_real.billing_vat_number AS billing_vat_number,
  orders_real.billing_street_address AS billing_street_address,
  orders_real.billing_suburb AS billing_suburb,
  orders_real.billing_city AS billing_city,
  orders_real.billing_postcode AS billing_postcode,
  orders_real.billing_state AS billing_state,
  orders_real.billing_country AS billing_country,
  orders_real.billing_address_format_id AS billing_address_format_id,
  orders_real.payment_method AS payment_method,
  orders_real.cc_type AS cc_type,
  orders_real.cc_owner AS cc_owner,
  orders_real.cc_number AS cc_number,
  orders_real.cc_expires AS cc_expires,
  orders_real.last_modified AS last_modified,
  orders_real.date_purchased AS date_purchased,
  orders_real.orders_status AS orders_status,
  orders_real.orders_date_finished AS orders_date_finished,
  orders_real.currency AS currency,
  orders_real.currency_value AS currency_value,
  orders_real.customer_service_id AS customer_service_id,
  orders_real.shipping_module AS shipping_module
FROM orders_real
WHERE ( (orders_real.customers_id = (select substr(substring_index(user(),'@',1),3))) OR (select substr(substring_index(user(),'@',1),3,3) = 'adm') OR (select substr(substring_index(user(),'@',1),3,3) = 'mad') );


# configuration insert #####################################################

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('New customers id reserve', 'NEW_CUSTOMERS_ID_RESERVE', '5', 'Amount of new customers reserve', '1', '23', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('New customers to generate', 'NEW_CUSTOMERS_ID_TO_GENERATE', '10', 'How much generate new customers IDs?', '1', '24', now());

