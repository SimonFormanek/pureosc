ALTER TABLE `address_book` ADD `entry_vat_number` VARCHAR( 64 ) NOT NULL AFTER `entry_company`; 

ALTER TABLE `orders` ADD `customers_vat_number` VARCHAR( 64 ) NOT NULL AFTER `customers_company` ;

ALTER TABLE `orders` ADD `delivery_vat_number` VARCHAR( 64 ) NOT NULL AFTER `delivery_company` ;

ALTER TABLE `orders` ADD `billing_vat_number` VARCHAR( 64 ) NOT NULL AFTER `billing_company` ;


