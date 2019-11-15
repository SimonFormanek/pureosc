<?php
/*
  $Id: backup.php,v 1.16 2002/03/16 21:30:02 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Záloha databázy');

define('TABLE_HEADING_TITLE', 'Nadpis');
define('TABLE_HEADING_FILE_DATE', 'Dátum');
define('TABLE_HEADING_FILE_SIZE', 'Veľkosť');
define('TABLE_HEADING_ACTION', 'Akcia');

define('TEXT_INFO_HEADING_NEW_BACKUP', 'Nová záloha');
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Obnova');
define('TEXT_INFO_NEW_BACKUP', 'Neprerušujte proces zálohovania, môže trvať niekoľko minút.');
define('TEXT_INFO_UNPACK', '<br><br>(po rozbalení súboru z archívu)');
define('TEXT_INFO_RESTORE', 'Neprerušujte proces obnovy.<br><br>Čím objemnejšia záloha, tým dlhšie bude tento proces trvať!<br><br>Ak je možné, použite mysql klienta.<br><br>Napríklad:<br><br><b>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </b> %s');
define('TEXT_INFO_RESTORE_LOCAL', 'Neprerušujte proces obnovy.<br><br>Čím objemnejšia záloha, tým dlhšie bude tento proces trvať!');
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'Súbor musí byť typu raw sql (text).');
define('TEXT_INFO_DATE', 'Dátum:');
define('TEXT_INFO_SIZE', 'Veľkosť:');
define('TEXT_INFO_COMPRESSION', 'Kompresia:');
define('TEXT_INFO_USE_GZIP', 'Použiť GZIP');
define('TEXT_INFO_USE_ZIP', 'Použiť ZIP');
define('TEXT_INFO_USE_NO_COMPRESSION', 'Bez kompresie (iba SQL)');
define('TEXT_INFO_DOWNLOAD_ONLY', 'Len stiahnúť (Neukladať serverovú časť)');
define('TEXT_INFO_BEST_THROUGH_HTTPS', 'Najlepšie cez HTTPS pripojenie');
define('TEXT_DELETE_INTRO', 'Naozaj chcete túto zálohu odstrániť?');
define('TEXT_NO_EXTENSION', 'Žiadna');
define('TEXT_BACKUP_DIRECTORY', 'Priečinok na zálohy:');
define('TEXT_LAST_RESTORATION', 'Posledná obnova:');
define('TEXT_FORGET', '(<u>zabudnúť</u>)');

define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'Chyba: Priečinok na zálohy neexistuje. Nastavte si ho v configure.php.');
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'Chyba: Do Priečinka na zálohy sa nedá zapisovať.');
define('ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', 'Chyba: Odkaz na stiahnutie je neprípustný.');

define('SUCCESS_LAST_RESTORE_CLEARED', 'Posledný dátum obnovy bol úspešne vymazaný.');
define('SUCCESS_DATABASE_SAVED', 'Databáza bola úspešne uložená.');
define('SUCCESS_DATABASE_RESTORED', 'Databáza bola úspešne obnovená.');
define('SUCCESS_BACKUP_DELETED', 'Záloha bola úspešne odstránená.');