<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2009 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Administrators',true);

define('TABLE_HEADING_ADMINISTRATORS', 'Administrators',true);
define('TABLE_HEADING_HTPASSWD', 'Secured by htpasswd',true);
define('TABLE_HEADING_ACTION', 'Provést',true);

define('TEXT_INFO_INSERT_INTRO', 'Vložte nového administrátora se správnými daty.',true);
define('TEXT_INFO_EDIT_INTRO', 'Proveďte potřebné změny',true);
define('TEXT_INFO_DELETE_INTRO', 'Opravdu chcete smazat administrátora?',true);
define('TEXT_INFO_HEADING_NEW_ADMINISTRATOR', 'Nový administrátor',true);
define('TEXT_INFO_USERNAME', 'Uživatel:',true);
define('TEXT_INFO_NEW_PASSWORD', 'Nové heslo:',true);
define('TEXT_INFO_PASSWORD', 'Heslo:',true);
define('TEXT_INFO_PROTECT_WITH_HTPASSWD', 'Ochrana s htaccess/htpasswd',true);

define('ERROR_ADMINISTRATOR_EXISTS', 'Chyba: Administrátor již existuje.',true);

define('HTPASSWD_INFO', '<strong>Další ochrana s htaccess/htpasswd</strong><p>This osCommerce Online Merchant Administration Tool installation is not additionally secured through htaccess/htpasswd means.</p><p>Enabling the htaccess/htpasswd security layer will automatically store administrator username and passwords in a htpasswd file when updating administrator password records.</p><p><strong>Please note</strong>, je-li dodatečná bezpečnostní vrstva zapnuta a pokud můžete přistupovat do Administration Tool, udělejte potřebné změny a konzultujte s vaším providerem zapnutí htaccess/htpasswd ochrany:</p><p><u><strong>1. Editujte tento soubor:</strong></u><br /><br />' . DIR_FS_ADMIN . '.htaccess</p><p>Smažte tyto řádky, pokud existují:</p><p><i>%s</i></p><p><u><strong>2. Smažte tento soubor:</strong></u><br /><br />' . DIR_FS_ADMIN . '.htpasswd_oscommerce</p>',true);
define('HTPASSWD_SECURED', '<strong>Další ochrana s htaccess/htpasswd</strong><p>This osCommerce Online Merchant Administration Tool installation is additionally secured through htaccess/htpasswd means.</p>',true);
define('HTPASSWD_PERMISSIONS', '<strong>Additional Protection With htaccess/htpasswd</strong><p>This osCommerce Online Merchant Administration Tool installation is not additionally secured through htaccess/htpasswd means.</p><p>The following files need to be writable by the web server to enable the htaccess/htpasswd security layer:</p><ul><li>' . DIR_FS_ADMIN . '.htaccess</li><li>' . DIR_FS_ADMIN . '.htpasswd_oscommerce</li></ul><p>Obnovte tuto stránku pro nastavení práv k souboru.</p>',true);
?>
