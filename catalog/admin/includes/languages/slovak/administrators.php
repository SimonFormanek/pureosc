<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2009 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Správcovia');

define('TABLE_HEADING_ADMINISTRATORS', 'Správcovia');
define('TABLE_HEADING_HTPASSWD', 'Chránené htpasswd');
define('TABLE_HEADING_ACTION', 'Akčné');

define('TEXT_INFO_INSERT_INTRO', 'Prosím , zadajte nový správca s ním súvisiace údaje');
define('TEXT_INFO_EDIT_INTRO', 'Prosím vykonajte potrebné zmeny');
define('TEXT_INFO_DELETE_INTRO', 'Ste si istí , že chcete zmazať tento správcu ?');
define('TEXT_INFO_HEADING_NEW_ADMINISTRATOR', 'Nový správca');
define('TEXT_INFO_USERNAME', 'Užívateľské meno :');
define('TEXT_INFO_NEW_PASSWORD', 'Nové heslo :');
define('TEXT_INFO_PASSWORD', 'Heslo :');
define('TEXT_INFO_PROTECT_WITH_HTPASSWD', 'Chráňte S htaccess / htpasswd');

define('ERROR_ADMINISTRATOR_EXISTS', 'Chyba : Administrator už existuje .');

define('HTPASSWD_INFO', '<strong>Dodatočná ochrana s htaccess / htpasswd</strong><p>Táto inštalácia osCommerce prihlásený Merchant Administration Tool nie je ďalej zaistená pomocou htaccess / htpasswd prostriedky .</p><p>Povolenie bezpečnostné vrstvu htaccess / htpasswd sa automaticky uloží užívateľské meno a heslo správcu v súbore htpasswd pri aktualizácii hesla správcu záznamov .</p><p><strong>Vezmite prosím na vedomie ,</strong>, Ak je táto dodatočná vrstva zabezpečenia a môžete už prístup na nástroje pre správu , vykonajte nasledujúce zmeny a obráťte sa na svojho poskytovateľa hostingu k tomu , aby ochranu htaccess / htpasswd :</p><p><u><strong>1. Upraviť tento súbor :</strong></u><br /><br />' . DIR_FS_ADMIN . '.htaccess</p><p>Odstráňte nasledujúce riadky , ak existujú :</p><p><i>%s</i></p><p><u><strong>2. Zmazať tento súbor:</strong></u><br /><br />' . DIR_FS_ADMIN . '.htpasswd_oscommerce</p>');
define('HTPASSWD_SECURED', '<strong>Dodatočná ochrana s htaccess / htpasswd</strong><p>Táto inštalácia osCommerce prihlásený Merchant Administration Tool je dodatočne zaistená pomocou htaccess / htpasswd prostriedky.</p>');
define('HTPASSWD_PERMISSIONS', '<strong>Dodatočná ochrana s htaccess / htpasswd</strong><p>Táto inštalácia osCommerce prihlásený Merchant Administration Tool nie je ďalej zaistená pomocou htaccess / htpasswd prostriedky.
</p><p>Nasledujúce súbory musia byť zapisovateľný webovým serverom na to, aby htaccess / bezpečnostné htpasswd vrstvy:</p><ul><li>' . DIR_FS_ADMIN . '.htaccess</li><li>' . DIR_FS_ADMIN . '.htpasswd_oscommerce</li></ul><p>Obnoviť túto stránku pre potvrdenie, či boli nastavené správne povolenia súborov.
</p>');
?>
