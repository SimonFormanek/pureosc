<?php
/*
  $Id: header_tags_seo_social.php,v 3.0 2013/01/10 14:07:36 hpdl Exp $
  Created by Jack York from http://www.oscommerce-solution.com

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright 2009 oscommerce-solution.com

  Released under the GNU General Public License
*/
define('HEADING_TITLE', 'Header Tags SEO Social Media');
define('HEADING_TEXT_SOCIAL_ICONS', 'Tato část poskytuje způsob, jak ovládat různé položky týkající se sociálních médií.
Při zadávání adresy URL pro jednu ze sociálních ikon je důležité použít adresu URL klíčových slov a TITLE (velká písmena), kde je to v url potřeba, budou nahrazeny kódem s odpovídajícími hodnotami. Není-li tato položka zadána, nebude záznam zaznamenán. Rovněž musíte zkontrolovat jestli ikona má stejný název.

Kód je platný pro adresář images/socialbookmarks/. Pokud přidáte nový obrázek, objeví se v ikonách na této stránce políčko pro jeho odkaz. Pokud odstraníte ikonu, nebude se zde již ukazovat. Existuje mnoho míst, které nabízejí volné balíčky ikon. Některé jsou zcela jedinečné, takže si možná budete chtít hrát s tím, abyste měli sadu ikon, která vyhovuje vašim stránkám.
');

define('HEADING_TEXT_TWITTER_CARD', 'Tato část řídí možnosti karty Twitter. Uložením prázdného záznamu se volba odstraní.');
define('TEXT_DISABLE', 'Zakázat');

define('TEXT_TWITTER_CREATOR', 'Vaše Twitter user name');
define('TEXT_TWITTER_SITE', 'Jméno stránky');
define('TEXT_TWITTER_SUMMARY', 'souhrn');


define('TEXT_SIZE_16', '16x16');
define('TEXT_SIZE_24', '24x24');
define('TEXT_SIZE_32', '32x32');
define('TEXT_SIZE_48', '48x48');

define('ERROR_NO_MATCH', 'Obrázky a adresy URL chybí nebo neodpovídají..');
define('RESULT_DISABLED', '&nbsp;&nbsp;Social Bookmarks vypnuty');
define('RESULT_FAILED', '&nbsp;&nbsp;Neuložilo se!');
define('RESULT_FAILED_NO_SELECTION', '&nbsp;&nbsp;Neuloženo - nebyly vybrány žádné ikony');
define('RESULT_MISSING_PARAMETERS', 'Chybí požadované parametry url');
define('RESULT_SUCCESS_INSERTED', '&nbsp;&nbsp;Data se správně uložila');
define('RESULT_SUCCESS_REMOVED_TWITTER', '&nbsp;&nbsp;Byla odstraněna karta Twitter');
define('RESULT_SUCCESS_UPDATED', '&nbsp;&nbsp;Změna dat úspěšně uložena');

define('RESULT_TWITTER_DATA_MISSING', 'Obě pole jsou povinná');
?>
