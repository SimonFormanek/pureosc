<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2013 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Datenbanksicherung',true); 

define('TABLE_HEADING_TITLE', 'Titel',true);
define('TABLE_HEADING_FILE_DATE', 'Datum',true);
define('TABLE_HEADING_FILE_SIZE', 'Grösse',true);
define('TABLE_HEADING_ACTION', 'Aktion',true);

define('TEXT_INFO_HEADING_NEW_BACKUP', 'Neue Sicherung',true);
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Lokal wiederherstellen',true);
define('TEXT_INFO_NEW_BACKUP', 'Bitte den Sicherungsprozess AUF KEINEN FALL unterbrechen. Dieser kann einige Minuten in Anspruch nehmen.',true);
define('TEXT_INFO_UNPACK', '<br><br>(nach dem die Dateien aus dem Archiv extrahiert wurden)',true);
define('TEXT_INFO_RESTORE', 'Den Wiederherstellungsprozess AUF KEINEN FALL unterbrechen.<br><br>Je grösser die Sicherungsdatei - desto länger dauert die Wiederherstellung!<br><br>Bitte wenn möglich den mysql client benutzen.<br><br>Beispiel:<br><br><b>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </b> %s',true);
define('TEXT_INFO_RESTORE_LOCAL', 'Den Wiederherstellungsprozess AUF KEINEN FALL unterbrechen.<br><br>Je grösser die Sicherungsdatei - desto länger dauert die Wiederherstellung!',true);
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'Die Datei, welche hochgeladen wird muss eine sogenannte raw sql Datei sein (nur Text).',true);
define('TEXT_INFO_DATE', 'Datum:',true);
define('TEXT_INFO_SIZE', 'Grösse:',true);
define('TEXT_INFO_COMPRESSION', 'Komprimieren:',true);
define('TEXT_INFO_USE_GZIP', 'Mit GZIP',true);
define('TEXT_INFO_USE_ZIP', 'Mit ZIP',true);
define('TEXT_INFO_USE_NO_COMPRESSION', 'Keine Komprimierung (Raw SQL)',true);
define('TEXT_INFO_DOWNLOAD_ONLY', 'Nur herunterladen (nicht auf dem Server speichern)',true);
define('TEXT_INFO_BEST_THROUGH_HTTPS', 'Sichere HTTPS Verbindung verwenden!',true);
define('TEXT_NO_EXTENSION', 'Keine',true);
define('TEXT_BACKUP_DIRECTORY', 'Sicherungsverzeichnis:',true);
define('TEXT_LAST_RESTORATION', 'Letzte Wiederherstellung:',true);
define('TEXT_FORGET', '(<u> vergessen</u>)',true);
define('TEXT_DELETE_INTRO', 'Sind Sie sicher, dass Sie diese Sicherung löschen möchten?',true);

define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'Fehler: Das Sicherungsverzeichnis ist nicht vorhanden.',true);
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'Fehler: Das Sicherungsverzeichnis ist schreibgeschützt.',true);
define('ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', 'Fehler: Download Link nicht akzeptabel.',true);

define('SUCCESS_LAST_RESTORE_CLEARED', 'Erfolg: Das letzte Wiederherstellungdatum wurde gelöscht.',true);
define('SUCCESS_DATABASE_SAVED', 'Erfolg: Die Datenbank wurde gesichert.',true);
define('SUCCESS_DATABASE_RESTORED', 'Erfolg: Die Datenbank wurde wiederhergestellt.',true);
define('SUCCESS_BACKUP_DELETED', 'Erfolg: Die Sicherungsdatei wurde gelöscht.',true);
?>
