<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2013 osCommerce

  Released under the GNU General Public License
 */

define('NAVBAR_TITLE_1', 'Erweiterte Suche', true);
define('NAVBAR_TITLE_2', 'Suchergebnisse', true);

define('HEADING_TITLE_1', 'Geben Sie Ihre Suchkriterien ein', true);
define('HEADING_TITLE_2', 'Artikel, welche den Suchkriterien entsprechen', true);

define('HEADING_SEARCH_CRITERIA', 'Geben Sie Ihre Stichworte ein', true);

define('TEXT_SEARCH_IN_DESCRIPTION', 'Auch in den Beschreibungen suchen', true);
define('ENTRY_CATEGORIES', 'Kategorien:', true);
define('ENTRY_INCLUDE_SUBCATEGORIES', 'Unterkategorien mit einbeziehen', true);
define('ENTRY_MANUFACTURERS', 'Hersteller:', true);
define('ENTRY_PRICE_FROM', 'Preis ab:', true);
define('ENTRY_PRICE_TO', 'Preis bis:', true);
define('ENTRY_DATE_FROM', 'hinzugefügt von:', true);
define('ENTRY_DATE_TO', 'hinzugefügt bis:', true);

define('TEXT_SEARCH_HELP_LINK', '<u>Hilfe zur erweiterten Suche</u> [?]', true);

define('TEXT_ALL_CATEGORIES', 'Alle Kategorien', true);
define('TEXT_ALL_MANUFACTURERS', 'Alle Hersteller', true);

define('HEADING_SEARCH_HELP', 'Hilfe zur erweiterten Suche', true);
define('TEXT_SEARCH_HELP',
    'Die Suchfunktion ermöglicht Ihnen die Suche in den Produktnamen, Produktbeschreibungen, Herstellern und Artikelnummern.<br><br>Sie haben die Möglichkeit logische Operatoren wie "AND" (Und) und "OR" (oder) zu verwenden.<br><br>Als Beispiel könnten Sie also angeben: <u>Microsoft AND Maus</u>.<br><br>Desweiteren können Sie Klammern verwenden um die Suche zu verschachteln, also z.B.:<br><br><u>Microsoft AND (Maus OR Tastatur OR "Visual Basic")</u>.<br><br>Mit Anführungszeichen können Sie mehrere Worte zu einem Suchbegriff zusammenfassen.',
    true);
define('TEXT_CLOSE_WINDOW', '<u>Fenster schliessen</u> [x]', true);

define('TABLE_HEADING_IMAGE', '', true);
define('TABLE_HEADING_MODEL', 'Artikelnummer', true);
define('TABLE_HEADING_PRODUCTS', 'Bezeichnung', true);
define('TABLE_HEADING_MANUFACTURER', 'Hersteller', true);
define('TABLE_HEADING_QUANTITY', 'Anzahl', true);
define('TABLE_HEADING_PRICE', 'Einzelpreis', true);
define('TABLE_HEADING_WEIGHT', 'Gewicht', true);
define('TABLE_HEADING_BUY_NOW', 'jetzt bestellen', true);

define('TEXT_NO_PRODUCTS',
    'Es wurden keine Artikel gefunden, die den Suchkriterien entsprechen.', true);

define('ERROR_AT_LEAST_ONE_INPUT',
    'Wenigstens ein Feld des Suchformulars muss ausgefüllt werden.', true);
define('ERROR_INVALID_FROM_DATE', 'Unzulässiges <b>von</b> Datum', true);
define('ERROR_INVALID_TO_DATE', 'Unzulässiges <b>bis jetzt</b> Datum', true);
define('ERROR_TO_DATE_LESS_THAN_FROM_DATE',
    'Das Datum <b>von</b> muss grösser oder gleich dem <b>bis jetzt</b> Datum sein',
    true);
define('ERROR_PRICE_FROM_MUST_BE_NUM', '<b>Preis ab</b> muss eine Zahl sein',
    true);
define('ERROR_PRICE_TO_MUST_BE_NUM', '<b>Preis bis</b> muss eine Zahl sein',
    true);
define('ERROR_PRICE_TO_LESS_THAN_PRICE_FROM',
    '<b>Preis bis</b> muss grö&szlig;er oder gleich <b>Preis ab</b> sein.', true);
define('ERROR_INVALID_KEYWORDS', 'Suchbegriff unzul&aumässig', true);
//pure:new
define('IMAGE_BUTTON_BACK_ADVANCED_SEARCH', 'back to advanced search', true);
?>
