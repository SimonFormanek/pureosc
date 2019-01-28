<?php
/*
  $Id: advanced_search.php,v 1.15 2003/07/08 16:45:35 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Rozšírené hľadanie');
define('NAVBAR_TITLE_2', 'Výsledky hľadania');

define('HEADING_TITLE_1', 'Rozšírené hľadanie');
define('HEADING_TITLE_2', 'Produkty vyhovujúce kritériám vyhľadávania');

define('HEADING_SEARCH_CRITERIA', 'Kritéria vyhľadávania');

define('TEXT_SEARCH_IN_DESCRIPTION', 'Hľadať v popisoch produktov');
define('ENTRY_CATEGORIES', 'Kategórie:');
define('ENTRY_INCLUDE_SUBCATEGORIES', 'Vrátane subkategórií');
define('ENTRY_MANUFACTURERS', 'Výrobcovia:');
define('ENTRY_PRICE_FROM', 'Cena od:');
define('ENTRY_PRICE_TO', 'Cena do:');
define('ENTRY_DATE_FROM', 'Dátum od:');
define('ENTRY_DATE_TO', 'Dátum do:');

define('TEXT_SEARCH_HELP_LINK', '<u>Pomoc k vyhľadávániu</u> [?]');

define('TEXT_ALL_CATEGORIES', 'Všetky kategórie');
define('TEXT_ALL_MANUFACTURERS', 'Všetci výrobcovia');

define('HEADING_SEARCH_HELP', 'Pomoc k vyhľadávániu');
define('TEXT_SEARCH_HELP', 'Kľúčové slová môžu byť oddelené AND a/alebo OR operátormi pre lepšiu kontrolu výsledkov vyhľadávania.<br><br>Napríklad, <u>Microsoft AND myš</u> vygeneruje výsledok ktorý obsahuje obidve slová. Ale, pre <u>myš OR klávesnica</u> bude výsledok hľadania obsahovať obidve alebo len jedno slovo.<br><br>Presné vyhľadávanie docielite vpísaním dvojitých úvodzoviek pred a za vyhľadávaný výraz.<br><br>Napríklad, <u>"notebook počítač"</u> vygeneruje rovnaký výsledok vyhľadávania.<br><br>Kruhové zátvorky môžu byť použité pre ďalšiu kontrolu vyhľadávania.<br><br>Napríklad, <u>Microsoft AND (klávesnica OR myš OR "visual basic")</u>.');
define('TEXT_CLOSE_WINDOW', '<u>Zavrieť okno</u> [x]');

define('TABLE_HEADING_IMAGE', '');
define('TABLE_HEADING_MODEL', 'Model');
define('TABLE_HEADING_PRODUCTS', 'Názov produktu');
define('TABLE_HEADING_MANUFACTURER', 'Výrobca');
define('TABLE_HEADING_QUANTITY', 'Množstvo');
define('TABLE_HEADING_PRICE', 'Cena');
define('TABLE_HEADING_WEIGHT', 'Hmotnosť');
define('TABLE_HEADING_BUY_NOW', 'Kúpiť');

define('TEXT_NO_PRODUCTS', 'Nebol nájdený žiadny produkt vyhovujúci vašim kritériám.');

define('ERROR_AT_LEAST_ONE_INPUT', 'Minimálne jedno pole vyhľadávacieho formulára musí byť vyplnené.');
define('ERROR_INVALID_FROM_DATE', 'Neplatný dátum Od.');
define('ERROR_INVALID_TO_DATE', 'Neplatný dátum Do.');
define('ERROR_TO_DATE_LESS_THAN_FROM_DATE', 'Dátum Do musí byť väčší alebo rovnaký ako dátum Od.');
define('ERROR_PRICE_FROM_MUST_BE_NUM', 'Cena Od musí byť číslo.');
define('ERROR_PRICE_TO_MUST_BE_NUM', 'Cena Do musí byť číslo.');
define('ERROR_PRICE_TO_LESS_THAN_PRICE_FROM', 'Cena Do musí byť väčšia, alebo rovná cene Od.');
define('ERROR_INVALID_KEYWORDS', 'Neplatné kľúčové slová.');
?>
