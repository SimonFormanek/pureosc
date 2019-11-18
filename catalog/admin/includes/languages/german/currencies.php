<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2013 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Währungen',true);

define('TABLE_HEADING_CURRENCY_NAME', 'Währung',true);
define('TABLE_HEADING_CURRENCY_CODES', 'Kürzel',true);
define('TABLE_HEADING_CURRENCY_VALUE', 'Wert',true);
define('TABLE_HEADING_ACTION', 'Aktion',true);

define('TEXT_INFO_EDIT_INTRO', 'Bitte führen Sie alle notwendigen änderungen durch',true);
define('TEXT_INFO_COMMON_CURRENCIES', '-- Häufigste Währungen --',true);
define('TEXT_INFO_CURRENCY_TITLE', 'Name:',true);
define('TEXT_INFO_CURRENCY_CODE', 'Kürzel:',true);
define('TEXT_INFO_CURRENCY_SYMBOL_LEFT', 'Symbol Links:',true);
define('TEXT_INFO_CURRENCY_SYMBOL_RIGHT', 'Symbol Rechts:',true);
define('TEXT_INFO_CURRENCY_DECIMAL_POINT', 'Dezimalkomma:',true);
define('TEXT_INFO_CURRENCY_THOUSANDS_POINT', 'Tausenderpunkt:',true);
define('TEXT_INFO_CURRENCY_DECIMAL_PLACES', 'Dezimalstellen:',true);
define('TEXT_INFO_CURRENCY_LAST_UPDATED', 'letzte änderung:',true);
define('TEXT_INFO_CURRENCY_VALUE', 'Wert:',true);
define('TEXT_INFO_CURRENCY_EXAMPLE', 'Beispiel:',true);
define('TEXT_INFO_INSERT_INTRO', 'Bitte geben Sie die neue Währung mit allen relevanten Daten ein',true);
define('TEXT_INFO_DELETE_INTRO', 'Sind Sie sicher, dass Sie diese Währung löschen möchten?',true);
define('TEXT_INFO_HEADING_NEW_CURRENCY', 'neue Währung',true);
define('TEXT_INFO_HEADING_EDIT_CURRENCY', 'Währung bearbeiten',true);
define('TEXT_INFO_HEADING_DELETE_CURRENCY', 'Währung löschen',true);
define('TEXT_INFO_SET_AS_DEFAULT', TEXT_SET_DEFAULT . ' (manuelles Aktualisieren der Wechselkurse erforderlich.)',true);
define('TEXT_INFO_CURRENCY_UPDATED', 'Die Verbrauchssteuer fÃ¼r %s (%s) wurde erfolgreich aktualisiert via %s.',true);

define('ERROR_REMOVE_DEFAULT_CURRENCY', 'Fehler: Die Standardwährung darf nicht gelöscht werden. Bitte definieren Sie eine neue Standardwährung und wiederholen Sie den Vorgang.',true);
define('ERROR_CURRENCY_INVALID', 'Error: Die Verbrauchssteuer fÃ¼r %s (%s) wurde nicht aktualisiert via %s. Ist es ein gültiger Währungcode?',true);
define('WARNING_PRIMARY_SERVER_FAILED', 'Vorsicht: Der primäre Server für den Austausch (%s) konnte %s (%s) aktualisieren - Versuche von dem sekundären Server.',true);