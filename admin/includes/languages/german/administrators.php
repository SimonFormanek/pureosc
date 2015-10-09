<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2013 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Administratoren');

define('TABLE_HEADING_ADMINISTRATORS', 'Administratoren');
define('TABLE_HEADING_HTPASSWD','Abgesichert mit htpasswd');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_INFO_INSERT_INTRO', 'Bitte den neuen Administrator mit seinen Daten eingeben');
define('TEXT_INFO_EDIT_INTRO', 'Nehmen Sie bitte alle notwendigen änderungen vor');
define('TEXT_INFO_DELETE_INTRO', 'Sind Sie sicher dass Sie diesen Administrator löschen möchten?');
define('TEXT_INFO_HEADING_NEW_ADMINISTRATOR', 'Neuer Administrator');
define('TEXT_INFO_USERNAME', 'Benutzername:');
define('TEXT_INFO_NEW_PASSWORD', 'Neues Password:');
define('TEXT_INFO_PASSWORD', 'Password:');
define('TEXT_INFO_PROTECT_WITH_HTPASSWD','mit .htpasswd schützen');

define('ERROR_ADMINISTRATOR_EXISTS', 'Error: Administrator existiert bereits.');

define('HTPASSWD_INFO', '<strong>Zusätzlicher Schutz durch htaccess/htpasswd</strong><p>Dies osCommerce Online Merchant Administration Tool-Installation ist nicht mehr gesichert außen durch htaccess/htpasswd mittel.</p><p>Aktivierung der htaccess / htpasswd Security Layer speichert automatisch Administrator-Benutzernamen und das Kennwort in einer Datei htpasswd beim Update Administrator-Passwort. </p><p><strong>Hinweis</strong>,  diese zusätzliche Ebene der Sicherheit aktiviert ist, und Sie können nicht mehr auf die Administrations-Tool, können Sie die folgenden änderungen und Kontakte auf der Website zu htaccess / htpasswd-Schutz zu aktivieren:</p><p><u><strong>1.  Bearbeiten Sie diese Datei:</strong></u><br /><br />' . DIR_FS_ADMIN . '.htaccess</p><p>Entfernen Sie die folgenden Zeilen, wenn sie vorhanden sind:</p><p><i>%s</i></p><p><u><strong>2. Lö Sie diese Datei:</strong></u><br /><br />' . DIR_FS_ADMIN . '.htpasswd_oscommerce</p>') ;
define('HTPASSWD_SECURED', '<strong>Zusätzlicher Schutz durch htaccess/htpasswd</strong><p>Diese osCommerce Online Merchant Administration Tool Installation wird weiter durch htaccess / htpasswd Schutz gesichert.</p>'); 
define('HTPASSWD_PERMISSIONS', '<strong>Zusätzlicher Schutz durch htaccess/htpasswd< /strong><p>Diese osCommerce Online Merchant Administration Tool Installation ist nicht weiter durch htaccess / htpasswd Schutz gesichert.</p><p>Die folgenden Dateien muss vom Webserver beschreibbar die htaccess / htpasswd Security Layer zu aktivieren:</p><ul><li>' . DIR_FS_ADMIN . '.htaccess</li><li>' . DIR_FS_ADMIN . '.htpassw d_oscommerce</li></ul><p>Laden Sie diese Seite, um zu bestätigen, dass die richtigen Dateiberechtigungen gesetzt wurden.</p>'); 
?>
