<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Zálohování databáze',true);

define('TABLE_HEADING_TITLE', 'Název',true);
define('TABLE_HEADING_FILE_DATE', 'Datum',true);
define('TABLE_HEADING_FILE_SIZE', 'Velikost',true);
define('TABLE_HEADING_ACTION', 'Provést',true);

define('TEXT_INFO_HEADING_NEW_BACKUP', 'Nová záloha',true);
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Restore Local',true);
define('TEXT_INFO_NEW_BACKUP', 'Nepřerušujte proces zálohování, může to trvat několik minut.',true);
define('TEXT_INFO_UNPACK', '<br /><br />(po rozbalení souboru z archivu)',true);
define('TEXT_INFO_RESTORE', 'Nepřerušujte proces obnovení.<br /><br />Bude to chvíli trvat, podle velikosti zálohy!<br /><br />Bude-li třeba, použijte mysql client.<br /><br />například:<br /><br /><strong>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </strong> %s',true);
define('TEXT_INFO_RESTORE_LOCAL', 'Nepřerušujte proces obnovení.<br /><br />Bude to chvíli trvat, podle velikosti zálohy!',true);
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'Soubor musí být raw sql (text) soubor.',true);
define('TEXT_INFO_DATE', 'Datum:',true);
define('TEXT_INFO_SIZE', 'Velikost:',true);
define('TEXT_INFO_COMPRESSION', 'Komprese:',true);
define('TEXT_INFO_USE_GZIP', 'Use GZIP',true);
define('TEXT_INFO_USE_ZIP', 'Use ZIP',true);
define('TEXT_INFO_USE_NO_COMPRESSION', 'Bez komprese (pouze SQL)',true);
define('TEXT_INFO_DOWNLOAD_ONLY', 'Pouze stáhnout (neukládat na server)',true);
define('TEXT_INFO_BEST_THROUGH_HTTPS', 'Best through a HTTPS connection',true);
define('TEXT_DELETE_INTRO', 'Chcete smazat tuto zálohu?',true);
define('TEXT_NO_EXTENSION', 'Ne',true);
define('TEXT_BACKUP_DIRECTORY', 'Adresář uložení zálohy:',true);
define('TEXT_LAST_RESTORATION', 'Poslední obnovení:',true);
define('TEXT_FORGET', '(<u>forget</u>)',true);

define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'Chyba: adresář záloh neexistuje. Nastavte v configure.php.',true);
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'Chyba: do adresáře zálohy nelze zapisovat.',true);
define('ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', 'Chyba: download link není akceptován.',true);

define('SUCCESS_LAST_RESTORE_CLEARED', 'Povedlo se: poslední obnovení bylo vyčišteno.',true);
define('SUCCESS_DATABASE_SAVED', 'Povedlo se: databáze byla uložena.',true);
define('SUCCESS_DATABASE_RESTORED', 'Povedlo se: databáze byla obnovena.',true);
define('SUCCESS_BACKUP_DELETED', 'Povedlo se: záloha byla odstraněna.',true);