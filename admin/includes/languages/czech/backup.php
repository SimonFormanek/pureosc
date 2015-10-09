<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Zálohování databáze');

define('TABLE_HEADING_TITLE', 'Název');
define('TABLE_HEADING_FILE_DATE', 'Datum');
define('TABLE_HEADING_FILE_SIZE', 'Velikost');
define('TABLE_HEADING_ACTION', 'Provést');

define('TEXT_INFO_HEADING_NEW_BACKUP', 'Nová záloha');
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Restore Local');
define('TEXT_INFO_NEW_BACKUP', 'Nepřerušujte proces zálohování, může to trvat několik minut.');
define('TEXT_INFO_UNPACK', '<br /><br />(po rozbalení souboru z archivu)');
define('TEXT_INFO_RESTORE', 'Nepřerušujte proces obnovení.<br /><br />Bude to chvíli trvat, podle velikosti zálohy!<br /><br />Bude-li třeba, použijte mysql client.<br /><br />například:<br /><br /><strong>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </strong> %s');
define('TEXT_INFO_RESTORE_LOCAL', 'Nepřerušujte proces obnovení.<br /><br />Bude to chvíli trvat, podle velikosti zálohy!');
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'Soubor musí být raw sql (text) soubor.');
define('TEXT_INFO_DATE', 'Datum:');
define('TEXT_INFO_SIZE', 'Velikost:');
define('TEXT_INFO_COMPRESSION', 'Komprese:');
define('TEXT_INFO_USE_GZIP', 'Use GZIP');
define('TEXT_INFO_USE_ZIP', 'Use ZIP');
define('TEXT_INFO_USE_NO_COMPRESSION', 'Bez komprese (pouze SQL)');
define('TEXT_INFO_DOWNLOAD_ONLY', 'Pouze stáhnout (neukládat na server)');
define('TEXT_INFO_BEST_THROUGH_HTTPS', 'Best through a HTTPS connection');
define('TEXT_DELETE_INTRO', 'Chcete smazat tuto zálohu?');
define('TEXT_NO_EXTENSION', 'Ne');
define('TEXT_BACKUP_DIRECTORY', 'Adresář uložení zálohy:');
define('TEXT_LAST_RESTORATION', 'Poslední obnovení:');
define('TEXT_FORGET', '(<u>forget</u>)');

define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'Chyba: adresář záloh neexistuje. Nastavte v configure.php.');
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'Chyba: do adresáře zálohy nelze zapisovat.');
define('ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', 'Chyba: download link není akceptován.');

define('SUCCESS_LAST_RESTORE_CLEARED', 'Povedlo se: poslední obnovení bylo vyčišteno.');
define('SUCCESS_DATABASE_SAVED', 'Povedlo se: databáze byla uložena.');
define('SUCCESS_DATABASE_RESTORED', 'Povedlo se: databáze byla obnovena.');
define('SUCCESS_BACKUP_DELETED', 'Povedlo se: záloha byla odstraněna.');
?>
