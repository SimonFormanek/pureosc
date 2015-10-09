<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2013 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Banner Manager');

define('TABLE_HEADING_BANNERS', 'Banner');
define('TABLE_HEADING_GROUPS', 'Gruppe');
define('TABLE_HEADING_STATISTICS', 'Anzeigen / Klicks');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Aktion');

define('TEXT_BANNERS_TITLE', 'Titel des Banners:'); 
define('TEXT_BANNERS_URL', 'Banner-URL:'); 
define('TEXT_BANNERS_GROUP', 'Banner-Gruppe:'); 
define('TEXT_BANNERS_NEW_GROUP', ', oder geben Sie unten eine neue Banner-Gruppe ein'); 
define('TEXT_BANNERS_IMAGE', 'Bild (Datei):'); 
define('TEXT_BANNERS_IMAGE_LOCAL', ', oder geben Sie unten die lokale Datei auf Ihrem Server an'); 
define('TEXT_BANNERS_IMAGE_TARGET', 'Bildziel (Speichern nach):'); 
define('TEXT_BANNERS_HTML_TEXT', 'HTML Text:');
define('TEXT_BANNERS_EXPIRES_ON', 'Gültigkeit bis:');
define('TEXT_BANNERS_OR_AT', ', oder bei');
define('TEXT_BANNERS_IMPRESSIONS', 'Impressionen/Anzeigen.');
define('TEXT_BANNERS_SCHEDULED_AT', 'Gültigkeit ab:');
define('TEXT_BANNERS_BANNER_NOTE', '<b>Banner Bemerkung:</b><ul><li>Sie können Bild- oder HTML-Text-Banner verwenden, beides gleichzeitig ist nicht möglich.</li><li>Wenn Sie beide Bannerarten gleichzeitig verwenden, wird nur der HTML-Text Banner angezeigt.</li></ul>');
define('TEXT_BANNERS_INSERT_NOTE', '<b>Bemerkung:</b><ul><li>Auf das Bildverzeichnis muss ein Schreibrecht bestehen!</li><li>Füllen Sie das Feld \'Bildziel (Speichern nach)\' nicht aus, wenn Sie kein Bild auf Ihren Server kopieren möchten (z.B. wenn sich das Bild bereits auf dem Server befindet).</li><li>Das \'Bildziel (Speichern nach)\' Feld muss ein bereits existierendes Verzeichnis mit \'/\' am Ende sein (z.B. banners/).</li></ul>'); 
define('TEXT_BANNERS_EXPIRCY_NOTE', '<b>Gültigkeit Bemerkung:</b><ul><li>Nur ein Feld ausfüllen!</li><li>Wenn der Banner unbegrenzt angezeigt werden soll, tragen Sie in diesen Feldern nichts ein.</li></ul>');
define('TEXT_BANNERS_SCHEDULE_NOTE', '<b>Gültigkeit ab Bemerkung:</b><ul><li>Bei Verwendung dieser Funktion, wird der Banner erst ab dem angegeben Datum angezeigt.</li><li>Alle Banner mit dieser Funktion werden bis ihrer Aktivierung, als Deaktiviert angezeigt.</li></ul>');

define('TEXT_BANNERS_DATE_ADDED', 'hinzugefügt am:');
define('TEXT_BANNERS_SCHEDULED_AT_DATE', 'Gültigkeit ab: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_DATE', 'Gültigkeit bis zum: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS', 'Gültigkeit bis: <b>%s</b> impressionen/anzeigen');
define('TEXT_BANNERS_STATUS_CHANGE', 'Status geändert: %s');

define('TEXT_BANNERS_DATA', 'D<br>A<br>T<br>E<br>N');
define('TEXT_BANNERS_LAST_3_DAYS', 'letzten 3 Tage');
define('TEXT_BANNERS_BANNER_VIEWS', 'Banneranzeigen');
define('TEXT_BANNERS_BANNER_CLICKS', 'Bannerklicks');

define('TEXT_INFO_DELETE_INTRO', 'Sind Sie sicher, dass Sie diesen Banner löschen möchten?');
define('TEXT_INFO_DELETE_IMAGE', 'Bannerbild löschen');

define('SUCCESS_BANNER_INSERTED', 'Erfolg: Der Banner wurde eingefügt.');
define('SUCCESS_BANNER_UPDATED', 'Erfolg: Der Banner wurde aktualisiert.');
define('SUCCESS_BANNER_REMOVED', 'Erfolg: Der Banner wurde gelöscht.');
define('SUCCESS_BANNER_STATUS_UPDATED', 'Erfolg: Der Status des Banners wurde aktualisiert.');

define('ERROR_BANNER_TITLE_REQUIRED', 'Fehler: Ein Bannertitel wird benötigt.');
define('ERROR_BANNER_GROUP_REQUIRED', 'Fehler: Eine Bannergruppe wird benötigt.');
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Fehler: Das Zielverzeichnis %s existiert nicht.');
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Fehler: Das Zielverzeichnis %s ist nicht beschreibbar.');
define('ERROR_IMAGE_DOES_NOT_EXIST', 'Fehler: Bild existiert nicht.');
define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'Fehler: Bild kann nicht gelöscht werden.');
define('ERROR_UNKNOWN_STATUS_FLAG', 'Fehler: Unbekanntes Status Flag.');

define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'Fehler: Das Verzeichnis \'graphs\' ist nicht vorhanden! Bitte erstellen Sie ein Verzeichnis \'graphs\' im Verzeichnis \'images\'.');
define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'Fehler: Das Verzeichnis \'graphs\' ist schreibgeschützt!');
?>
