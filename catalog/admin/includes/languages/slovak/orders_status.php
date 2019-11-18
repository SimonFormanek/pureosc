<?php
/*
  $Id: orders_status.php,v 1.5 2002/01/29 14:43:00 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Stav objednávok');

define('TABLE_HEADING_ORDERS_STATUS', 'Stav objednávok');
define('TABLE_HEADING_ACTION', 'Akcia');

define('TEXT_INFO_EDIT_INTRO', 'Spravte prosím potrebné zmeny');
define('TEXT_INFO_ORDERS_STATUS_NAME', 'Stav objednávok:');
define('TEXT_INFO_INSERT_INTRO', 'Zadajte prosím nový stav objednávky aj s príslušnými údajmi');
define('TEXT_INFO_DELETE_INTRO', 'Naozaj chcete odstrániť stav tejto objednávky?');
define('TEXT_INFO_HEADING_NEW_ORDERS_STATUS', 'Nový stav objednávky');
define('TEXT_INFO_HEADING_EDIT_ORDERS_STATUS', 'Upraviť stav objednávky');
define('TEXT_INFO_HEADING_DELETE_ORDERS_STATUS', 'Odstrániť stav objednávky');

define('ERROR_REMOVE_DEFAULT_ORDER_STATUS', 'Chyba: Predvolený stav objednávky sa nedá odstrániť. Vyberte prosím iný stav objednávky ako predvolený a akciu opakujte.');
define('ERROR_STATUS_USED_IN_ORDERS', 'Chyba: Tento stav objednávky je už použitý v objednávkach.');
define('ERROR_STATUS_USED_IN_HISTORY', 'Chyba: Tento stav objednávky je už použitý v histórii objednávok.');