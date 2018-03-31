<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
 */

require_once('includes/application_top.php');

// if the customer is not logged on, redirect them to the login page
//if (!tep_session_is_registered('customer_id')) {
    //$navigation->set_snapshot(array('mode' => 'SSL', 'page' => basename(__FILE__)));
    //tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));

    $check_email_query = tep_db_query("SELECT customers_email_address from customers where customers_id = '".tep_db_input($_GET['uid'])."'");
    $check_email       = tep_db_fetch_array($check_email_query);

    if ($_GET['agree'] == hash('sha256', $check_email['customers_email_address'])) {
        tep_db_query('UPDATE customers SET customers_newsletter_date_accepted = NOW() WHERE customers_id='.$_GET['uid']);
        $success = true;
    }  else {
        $success = false;
    }
//}

$breadcrumb->add(_('Newsletter Consent'), tep_href_link(basename(__FILE__)));

require(DIR_WS_INCLUDES.'template_top.php');
?>

<div class="page-header">
    <h1><?php echo $success ? _('Consent Recieved') : _('Consent not recieved') ; ?></h1>
</div>

<div class="contentContainer">
    <div class="contentText">
        <?php 
        
        echo $success ? _('Newsletter subscription consent was accepted') : _('Newsletter subscription consent was not accepted'); ?>
    </div>

    <div class="buttonSet">
        <div class="text-right"><?php
            echo tep_draw_button(IMAGE_BUTTON_CONTINUE, 'fa fa-angle-right',
                tep_href_link(FILENAME_DEFAULT));
            ?></div>
    </div>
</div>

<?php
require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');

