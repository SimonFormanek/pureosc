<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  
  Edited by 2014 Newburns Design and Technology
  *************************************************
  ************ New addon definitions **************
  ************        Below          **************
  *************************************************
  Credit Class, Gift Vouchers & Discount Coupons osC2.3.3.4 (CCGV) added -- http://addons.oscommerce.com/info/9020  

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Vytvořit účet',true);

define('HEADING_TITLE', 'Informace o mém účtu',true);

define('TEXT_ORIGIN_LOGIN', '<font color="#FF0000"><small><strong>poznámka:</strong></small></font> Pokud už máte účet, přihlašte se <a href="%s"><u>zde</u></a>.',true);

define('EMAIL_SUBJECT', 'Vítáme Vás v eshopu ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Vážený pane %s,' . "\n\n");
define('EMAIL_GREET_MS', 'Vážená paní %s,' . "\n\n");
define('EMAIL_GREET_NONE', 'Vážený %s' . "\n\n");
define('EMAIL_WELCOME', 'Vítáme Vás v eshopu <strong>' . STORE_NAME . '</strong>.' . "\n\n");
define('EMAIL_TEXT', 
'Nyní můžete využívat veškeré služby našeho obchodu:' . "\n\n" . 
'<li><strong>Trvalý košík</strong> - Všechny produkty se automaticky ukádají a zůstanou v košíku, dokud je nekoupíte nebo neodstraníte.' . "\n" . 
'<li><strong>Adresář</strong> - Můžeme zaslat naše zboží na jakoukoli adresu! To je ideální pro odeslání dárků přímo obdarovávané osobě.' . "\n" . 
'<li><strong>Historie objednávek</strong> - Zobrazení historie nákupů, které jste v našem obchodě udělali.' . "\n" . 
'<li><strong>Recenze produktů</strong> - Podělte se o své názory na produkty s ostatními zákazníky.' . "\n\n");
define('EMAIL_CONTACT', 'Pokud budete potřebovat pomoc, kontaktujte provozovatele obchodu ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<strong>Pozor:</strong> Tento e-mail jste dostal(a) na základě registrace v našem obchodě. Pokud jste se v našem obchodě neregistroval(a), napište nám na adresu ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");
/*
************************************************************************
************** Custom Filenames can be defined below here **************
**************               Raymond Burns                **************
************************************************************************
*/
// CCGV
  define('EMAIL_GV_INCENTIVE_HEADER', "\n\n" .'As part of our welcome to new customers, we have sent you an e-Gift Voucher worth %s',true);
  define('EMAIL_GV_REDEEM', 'The redeem code for the e-Gift Voucher is %s, you can enter the redeem code when checking out while making a purchase',true);
  define('EMAIL_GV_LINK', 'or by following this link ',true);
  define('EMAIL_COUPON_INCENTIVE_HEADER', 'Congratulations, to make your first visit to our online shop a more rewarding experience we are sending you an e-Discount Coupon.' . "\n" . ' Below are details of the Discount Coupon created just for you' . "\n");
  define('EMAIL_COUPON_REDEEM', 'To use the coupon enter the redeem code which is %s during checkout while making a purchase',true);
?>
