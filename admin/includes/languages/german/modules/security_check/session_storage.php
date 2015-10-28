<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Das sessions - Verzeichnis existiert nicht: ' . tep_session_save_path() . '. Die Sessions funktionieren nicht bis das Verzeichnis erstellt wurde.');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Ich bin nicht in der Lage in das  sessions - Verzeichnis zu schreiben: ' . tep_session_save_path() . '. Sessions arbeitet nicht, bis die korrekten Zugriffsrechte gesetzt sind.');
?>
