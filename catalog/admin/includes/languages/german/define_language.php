<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2013 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Sprache definieren',true);

define('TABLE_HEADING_FILES','Datei',true);
define('TABLE_HEADING_WRITABLE','beschreibbar',true);
define('TABLE_HEADING_LAST_MODIFIED','letzte änderung',true);

define('TEXT_EDIT_NOTE', '<strong>Definition editieren</strong><br /><br />Jede Sprache Definition ist mit PHP gemacht <a href="http://www.php.net/define" target="_blank">define()</a> funktion wie folgt:<br /><br /><nobr>define(\'TEXT_MAIN\', \'<span style="background-color: #FFFF99;">Dieser Text kann bearbeitet werden. Es ist wirklich einfach zu tun!</span>\',true);</nobr><br /><br />Der markierte Text kann bearbeitet werden. Da diese Definition verwendet einfache Anführungszeichen den Text enthält, werden alle einfachen Anführungszeichen im Text durch einen Backslash (zB McDonald\\\'s) voraus.',true); 

define('TEXT_FILE_DOES_NOT_EXIST', 'Datei nicht vorhanden.',true);

define('ERROR_FILE_NOT_WRITEABLE', 'Fehler: Die Datei ist schreibgeschützt. Bitte korrigieren Sie die Zugriffsrechte für: %s',true);
?>
