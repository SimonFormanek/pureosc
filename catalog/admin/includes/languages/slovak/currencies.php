<?php
/*
  $Id: currencies.php,v 1.12 2003/06/25 20:36:48 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Meny');

define('TABLE_HEADING_CURRENCY_NAME', 'Mena');
define('TABLE_HEADING_CURRENCY_CODES', 'Kód');
define('TABLE_HEADING_CURRENCY_VALUE', 'Hodnota');
define('TABLE_HEADING_ACTION', 'Akcia');

define('TEXT_INFO_EDIT_INTRO', 'Spravte prosím potrebné zmeny');
define('TEXT_INFO_CURRENCY_TITLE', 'Nadpis:');
define('TEXT_INFO_CURRENCY_CODE', 'Kód:');
define('TEXT_INFO_CURRENCY_SYMBOL_LEFT', 'Symbol vľavo:');
define('TEXT_INFO_CURRENCY_SYMBOL_RIGHT', 'Symbol vpravo:');
define('TEXT_INFO_CURRENCY_DECIMAL_POINT', 'Desatinný oddelovač:');
define('TEXT_INFO_CURRENCY_THOUSANDS_POINT', 'Oddelovač tisícov:');
define('TEXT_INFO_CURRENCY_DECIMAL_PLACES', 'Počet desatinných miest:');
define('TEXT_INFO_CURRENCY_LAST_UPDATED', 'Posledná úprava:');
define('TEXT_INFO_CURRENCY_VALUE', 'Hodnota:');
define('TEXT_INFO_CURRENCY_EXAMPLE', 'Príklad výstupu:');
define('TEXT_INFO_INSERT_INTRO', 'Zadajte prosím novú menu aj s príslušnými údajmi');
define('TEXT_INFO_DELETE_INTRO', 'Naozaj chcete odstrániť túto menu?');
define('TEXT_INFO_HEADING_NEW_CURRENCY', 'Nová mena');
define('TEXT_INFO_HEADING_EDIT_CURRENCY', 'Upraviť menu');
define('TEXT_INFO_HEADING_DELETE_CURRENCY', 'Odstrániť menu');
define('TEXT_INFO_SET_AS_DEFAULT', TEXT_SET_DEFAULT . ' (vyžaduje manuálnu aktualizáciu hodnôt meny)');
define('TEXT_INFO_CURRENCY_UPDATED', 'Ceny mien %s (%s) boli úspešne aktualizované cez %s.');

define('ERROR_REMOVE_DEFAULT_CURRENCY', 'Chyba: Predvolená mena sa nedá odstrániť. Vyberte prosím inú menu ako predvolenú a akciu opakujte.');
define('ERROR_CURRENCY_INVALID', 'Chyba: Kurz meny pre %s (%s) nebol aktualizovaný cez %s. Je správny kód meny?');
define('WARNING_PRIMARY_SERVER_FAILED', 'Upozornenie: Primárny server pre kurz meny (%s) bol neúspešný pre %s (%s) - skúšam sekundárny server.');
?>
