<?php
/*
  $Id: gv_send.php,v 1.1.2.1 2003/04/18 17:25:44 wilt Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Gift Voucher System v1.0
  Copyright (c) 2001,2002 Ian C Wilson
  http://www.phesis.org

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Send Gift Voucher',true);
define('NAVBAR_TITLE', 'Send Gift Voucher',true);
define('EMAIL_SUBJECT', 'Enquiry from ' . STORE_NAME);
define('HEADING_TEXT','<br>Please enter below the details of the Gift Voucher you wish to send. For more information, please see our <a href="' . tep_href_link(FILENAME_GV_FAQ,'','NONSSL').'">'.GV_FAQ.'.</a><br>',true);
define('ENTRY_NAME', 'Recipients Name:',true);
define('ENTRY_EMAIL', 'Recipients E-Mail Address:',true);
define('ENTRY_MESSAGE', 'Message to Recipients:',true);
define('ENTRY_AMOUNT', 'Amount of Gift Voucher:',true);
define('ERROR_ENTRY_AMOUNT_CHECK', '&nbsp;&nbsp;<span class="errorText">Invalid Amount</span>',true);
define('ERROR_ENTRY_EMAIL_ADDRESS_CHECK', '&nbsp;&nbsp;<span class="errorText">Invalid Email Address</span>',true);
define('MAIN_MESSAGE', 'You have decided to post a gift voucher worth %s to %s who\'s email address is %s<br><br>The text accompanying the email will read<br><br>Dear %s<br><br>
                        You have been sent a Gift Voucher worth %s by %s');

define('PERSONAL_MESSAGE', '%s says',true);
define('TEXT_SUCCESS', 'Congratulations, your Gift Voucher has successfully been sent',true);


define('EMAIL_SEPARATOR', '----------------------------------------------------------------------------------------',true);
define('EMAIL_GV_TEXT_HEADER', 'Congratulations, You have received a gift voucher worth %s',true);
define('EMAIL_GV_TEXT_SUBJECT', 'A gift from %s',true);
define('EMAIL_GV_FROM', 'This Gift Voucher has been sent to you by %s',true);
define('EMAIL_GV_MESSAGE', 'With a message saying ',true);
define('EMAIL_GV_SEND_TO', 'Hi, %s',true);
define('EMAIL_GV_REDEEM', 'To redeem this Gift Voucher, please click on the link below. Please also write down the redemption code which is %s. In case you have problems.',true);
define('EMAIL_GV_LINK', 'To redeem please click ',true);
define('EMAIL_GV_VISIT', ' or visit ',true);
define('EMAIL_GV_ENTER', ' and enter the code ',true);
define('EMAIL_GV_FIXED_FOOTER', 'If you are have problems redeeming the Gift Voucher using the automated link above, ' . "\n" . 
                                'you can also enter the Gift Voucher code during the checkout process at our store.' . "\n\n");
define('EMAIL_GV_SHOP_FOOTER', '',true);
?>