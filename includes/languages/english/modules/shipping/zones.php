<?php
/*
  $Id: zones.php,v 1.3 2002/11/19 01:48:08 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('MODULE_SHIPPING_ZONES_TEXT_TITLE', 'Zone Based Shipping Rates');
define('MODULE_SHIPPING_ZONES_TEXT_DESCRIPTION', 'The module allows you to set different shipping rates for several zones, defined as a country list. Postage is calculated based on weight or price.');
define('MODULE_SHIPPING_ZONES_TEXT_WAY', 'Ground'); //no longer used
define('MODULE_SHIPPING_ZONES_TEXT_UNITS', 'kg(s)');
define('MODULE_SHIPPING_ZONES_INVALID_ZONE', 'No shipping available to the selected country');
define('MODULE_SHIPPING_ZONES_UNDEFINED_RATE', 'The shipping rate cannot be determined at this time');

//pure:new module internationalisation
define('CONFIG_TITLE_MODULE_SHIPPING_ZONES_MODE','Table Method');
define('CONFIG_DESCRIPTION_MODULE_SHIPPING_ZONES_MODE','
The shipping cost is based on the order total or the total weight of the items ordered.<br />
Create table for each group of countries with same shipping price. For all other countries, create shipping table with empty Country field.
');

define('CONFIG_TITLE_NUM_ZONES','Number of zones');
define('CONFIG_DESCRIPTION_NUM_ZONES','Enter numer of zones (max 10)');

define('CONFIG_TITLE_MODULE_SHIPPING_ZONES_TAX_CLASS','Tax Class');
define('CONFIG_DESCRIPTION_MODULE_SHIPPING_ZONES_TAX_CLASS','Use the following tax class on the shipping fee.');

define('CONFIG_TITLE_MODULE_SHIPPING_ZONES_SORT_ORDER','Sort order');
define('CONFIG_DESCRIPTION_MODULE_SHIPPING_ZONES_SORT_ORDER','Sort order of display.');

define('CONFIG_TITLE_MODULE_SHIPPING_ZONES_STATUS','Enable Zones Method');
define('CONFIG_DESCRIPTION_MODULE_SHIPPING_ZONES_STATUS','Do you want to offer zone rate shipping?');
