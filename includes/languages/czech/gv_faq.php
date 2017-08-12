<?php
/*
  $Id: gv_faq.php,v 1.1.1.1.2.2 2003/05/04 12:24:25 wilt Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Gift Voucher System v1.0
  Copyright (c) 2001,2002 Ian C Wilson
  http://www.phesis.org

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Dárkový poukaz FAQ',true);
define('HEADING_TITLE', 'Dárkový poukaz FAQ',true);

define('TEXT_INFORMATION', '<a name="Top"></a>
  <a href="'.tep_href_link(FILENAME_GV_FAQ,'faq_item=1','NONSSL').'">Nákup dárkových poukazů</a><br>
  <a href="'.tep_href_link(FILENAME_GV_FAQ,'faq_item=2','NONSSL').'">Jak zaslat dárkové poukazy</a><br>
  <a href="'.tep_href_link(FILENAME_GV_FAQ,'faq_item=3','NONSSL').'">Nákup s dárkovým poukazem</a><br>
  <a href="'.tep_href_link(FILENAME_GV_FAQ,'faq_item=4','NONSSL').'">Uplatnění dárkových poukazů</a><br>
  <a href="'.tep_href_link(FILENAME_GV_FAQ,'faq_item=5','NONSSL').'">Případné potíže</a><br>
');
switch ($_GET['faq_item']) {
  case '1':
define('SUB_HEADING_TITLE','Nákup dárkových poukazů.',true);
define('SUB_HEADING_TEXT','Dárkové poukazy se kupují stejně jako jiné položky v našem obchodě. Platíte za ně pomocí standardních platebních metod. Jakmile zakoupíte hodnotu dárkového poukazu, bude přidán do vašeho osobního účtu dárkových poukazů. Máte-li v účtu dárkových poukazů prostředky, částka se zobrazuje v Nákupním košíku a také odkaz na stránku, kterou můžete někomu zaslat e-mailem.');
  break;
  case '2':
define('SUB_HEADING_TITLE','Jak zaslat dárkové poukazy',true);
define('SUB_HEADING_TEXT','Chcete-li poslat dárkový poukaz, musíte jít na stránku Odeslat dárkový poukaz. Odkaz na tuto stránku naleznete v poli Nákupní košík v pravém sloupci každé stránky.
Při odeslání dárkového poukazu musíte zadat následující údaje:
Jméno osoby, na kterou zasíláte dárkový poukaz.
E-mailovou adresu osoby, jíž doručujete dárkový poukaz.
Částku, kterou chcete odeslat. (Všimněte si, že nemusíte odesílat celou částku, která je v účtu Vašich dárkových poukazů.)
Krátká zpráva se objeví v e-mailu.
Ujistěte se, že jste zadali všechny informace správně, můžete vše změnit, než bude e-mail skutečně odeslán.');  
  break;
  case '3':
  define('SUB_HEADING_TITLE','Nákup s dárkovým poukazem.',true);
  define('SUB_HEADING_TEXT','If you have funds in your Gift Voucher Account, you can use those funds to 
  purchase other items in out store. At the checkout stage, an extra box will 
  appear. Ticking this box will apply those funds in your Gift Voucher Account. 
  Please note, you will still have to select another payment method if there 
  is not enough in your Gift Voucher Account to cover the cost of your purchase. 
  If you have more funds in your Gift Voucher Account than the total cost of 
  your purchase the balance will bel left in you Gift Voucher Account for the 
  future.');
  break;
  case '4':
  define('SUB_HEADING_TITLE','Redeeming Gift Vouchers.',true);
  define('SUB_HEADING_TEXT','If you receive a Gift Voucher by email it will contain details of who sent 
  you the Gift Voucher, along with possibly a short message from them. The Email 
  will also contain a link to redeem the voucher. You will need to Login or Create an Account before
  you can redeem the Gift Voucher.  There are various ways you can redeem the voucher:<br>
  1. By clicking on the link contained within the email for this express purpose. 
  This will take you to the store\'s Redeem Voucher page. You will the be requested 
  to create an account or Login, before the Gift Voucher is validated and placed in your 
  Gift Voucher Account ready for you to spend it on whatever you want.<br>
  2. During the checkout procces, on the same page that you select a payment method 
there will be a tick box and button to redeem your Gift Voucher balance against that purchase.');
  break;
  case '5':
  define('SUB_HEADING_TITLE','When problems occur.',true);
  define('SUB_HEADING_TEXT','For any queries regarding the Gift Voucher System, please contact the store 
  by email at '. STORE_OWNER_EMAIL_ADDRESS . '. Please make sure you give 
  as much information as possible in the email. ');
  break;
  default:
  define('SUB_HEADING_TITLE','',true);
  define('SUB_HEADING_TEXT','Please choose from one of the questions above.',true);

  }
?>
