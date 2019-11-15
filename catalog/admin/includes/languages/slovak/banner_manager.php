<?php
/*
  $Id: banner_manager.php,v 1.17 2002/08/18 18:54:47 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Manažér bannerov');

define('TABLE_HEADING_BANNERS', 'Bannery');
define('TABLE_HEADING_GROUPS', 'Skupiny');
define('TABLE_HEADING_STATISTICS', 'Zobrazení / Kliknutí');
define('TABLE_HEADING_STATUS', 'Stav');
define('TABLE_HEADING_ACTION', 'Akcia');

define('TEXT_BANNERS_TITLE', 'Názov bannera:');
define('TEXT_BANNERS_URL', 'URL bannera:');
define('TEXT_BANNERS_GROUP', 'Bannerova skupina:');
define('TEXT_BANNERS_NEW_GROUP', ', alebo zadajte novú bannerovú skupinu nižšie');
define('TEXT_BANNERS_IMAGE', 'Obrázok:');
define('TEXT_BANNERS_IMAGE_LOCAL', ', alebo zadajte názov lokálneho súboru nižšie');
define('TEXT_BANNERS_IMAGE_TARGET', 'Cieľový priečinok pre obrázok (Uložiť Do):');
define('TEXT_BANNERS_HTML_TEXT', 'HTML Text:');
define('TEXT_BANNERS_EXPIRES_ON', 'Expirácia v:');
define('TEXT_BANNERS_OR_AT', ', alebo po');
define('TEXT_BANNERS_IMPRESSIONS', 'zobrazení.');
define('TEXT_BANNERS_SCHEDULED_AT', 'Naplánovaný na:');
define('TEXT_BANNERS_BANNER_NOTE', '<b>Poznámky k banneru:</b><ul><li>Pre banner použite obrázok alebo HTML text, nie obidve naraz.</li><li>HTML text má prioritu pred obrázkom</li></ul>');
define('TEXT_BANNERS_INSERT_NOTE', '<b>Poznámky k obrázku:</b><ul><li>Priečinok pre zasielanie musí mať riadne nastavené užívateľské práva na zápis!</li><li>Nevypĺňajte \'Uložiť Do\' kolonku pokiaľ nezasielate obrázok na web server (napr. Ak používate lokálny obrázok na strane servera).</li><li>\'Uložiť Do\' kolonka musí byť existujúci priečinok s ukončujúcim lomítkom (napr. bannery/).</li></ul>');
define('TEXT_BANNERS_EXPIRCY_NOTE', '<b>Poznámky k expirácii:</b><ul><li>Len jedna z dvoch koloniek môže byť zadaná.</li><li>Ak nemá banner expirovať automaticky, nechajte tieto kolonky prázdne.</li></ul>');
define('TEXT_BANNERS_SCHEDULE_NOTE', '<b>Poznámky k plánovaniu:</b><ul><li>Ak je kolonka \'Naplánovaný na\' vyplnená, banner sa aktivuje v daný dátum.</li><li>Všetky naplánované bannery sú označené ako neaktívne, pokiaľ nenastane ich deň spustenia.</li></ul>');

define('TEXT_BANNERS_DATE_ADDED', 'Pridaný dňa:');
define('TEXT_BANNERS_SCHEDULED_AT_DATE', 'Naplánovaný na: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_DATE', 'Dátum expirácie: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS', 'Dátum expirácie: <b>%s</b> zobrazení');
define('TEXT_BANNERS_STATUS_CHANGE', 'Stav zmeny: %s');

define('TEXT_BANNERS_DATA', 'D<br>á<br>t<br>a');
define('TEXT_BANNERS_LAST_3_DAYS', 'posledné 3 dni');
define('TEXT_BANNERS_BANNER_VIEWS', 'Počet zobrazení');
define('TEXT_BANNERS_BANNER_CLICKS', 'Počet kliknutí');

define('TEXT_INFO_DELETE_INTRO', 'Naozaj chcete odstrániť tento banner?');
define('TEXT_INFO_DELETE_IMAGE', 'Odstrániť obrázok bannera');

define('SUCCESS_BANNER_INSERTED', 'Banner bol úspešne vložený.');
define('SUCCESS_BANNER_UPDATED', 'Banner bol úspešne aktualizovaný.');
define('SUCCESS_BANNER_REMOVED', 'Banner bol úspešne odstránený.');
define('SUCCESS_BANNER_STATUS_UPDATED', 'Stav bannera bol aktualizovaný.');

define('ERROR_BANNER_TITLE_REQUIRED', 'Chyba: Názov bannera je povinný.');
define('ERROR_BANNER_GROUP_REQUIRED', 'Chyba: Bannerova skupina je povinná.');
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Chyba: Cieľový priečinok neexistuje: %s');
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Chyba: Do cieľového priečinka sa nedá zapisovať: %s');
define('ERROR_IMAGE_DOES_NOT_EXIST', 'Chyba: Obrázok neexistuje.');
define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'Chyba: Obrázok sa nedá odstrániť.');
define('ERROR_UNKNOWN_STATUS_FLAG', 'Chyba: Neznámy príznak stavu.');

define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'Chyba: Priečinok pre grafy neexistuje. Prosím vytvorte priečinok \'graphs\' vo vnútri priečinka \'images\'.');
define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'Chyba: Do priečinka grafov sa nedá zapisovať.');