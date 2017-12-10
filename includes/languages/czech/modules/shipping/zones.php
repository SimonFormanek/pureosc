<?php
/*
  $Id: zones.php,v 1.3 2002/11/19 01:48:08 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('MODULE_SHIPPING_ZONES_TEXT_TITLE', 'Poštovné dle tabulky zemí');
define('MODULE_SHIPPING_ZONES_TEXT_DESCRIPTION', 'Různá výše poštovného pro každou zemi, na základě váhy nebo ceny.');
define('MODULE_SHIPPING_ZONES_TEXT_WAY', 'Ground'); //no longer used
define('MODULE_SHIPPING_ZONES_TEXT_UNITS', 'kg');
define('MODULE_SHIPPING_ZONES_INVALID_ZONE', 'Do dané země nelze dodat');
define('MODULE_SHIPPING_ZONES_UNDEFINED_RATE', 'Cenu dopravy nelze vypočítat');
//pure:new module internationalisation
define('CONFIG_TITLE_MODULE_SHIPPING_ZONES_MODE','Tabulka ');
define('CONFIG_DESCRIPTION_MODULE_SHIPPING_ZONES_MODE','
Náklady na dopravu jsou počítány na základě celkové objednávky nebo celkové hmotnosti objednaného zboží.
Vyplňte tabulku dopravného pro různé skupiny zemí, v poslední skupině ponechte pole "Zóna N - země" prázdnou - příslušná Tabulka poštovného se použije pro všechny ostatní země .
');
define('CONFIG_TITLE_NUM_ZONES','Počet zón');
define('CONFIG_DESCRIPTION_NUM_ZONES','Zadejte počet zón (max. 10)');

define('CONFIG_TITLE_MODULE_SHIPPING_ZONES_TAX_CLASS','Sazba DPH');
define('CONFIG_DESCRIPTION_MODULE_SHIPPING_ZONES_TAX_CLASS','Zvolte sazbu DPH pro poštovné. Pokud používáte Českou poštu - nastavte 0% (je osvobozena od DPH).');

define('CONFIG_TITLE_MODULE_SHIPPING_ZONES_SORT_ORDER','Pořadí');
define('CONFIG_DESCRIPTION_MODULE_SHIPPING_ZONES_SORT_ORDER','Pořadí zobrazení.');

define('CONFIG_TITLE_MODULE_SHIPPING_ZONES_STATUS','Povolit modul Zóny?');
define('CONFIG_DESCRIPTION_MODULE_SHIPPING_ZONES_STATUS','Chcete povolit výpočet dopravného podle zón?');

