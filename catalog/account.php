<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
 */


define('NAVBAR_TITLE', _('My Account'));
define('HEADING_TITLE', _('Informations about my account'));

require_once('includes/application_top.php');

if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
}

$breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));

require(DIR_WS_INCLUDES.'template_top.php');
?>

<div class="page-header">
    <h1><?php echo HEADING_TITLE; ?></h1>
</div>

<?php
if ($messageStack->size('account') > 0) {
    echo $messageStack->output('account');
}
?>

<div class="contentContainer">
    <div class="row">

        <?php
        echo $oscTemplate->getContent('account');
        ?>
        <?php /*         * * Altered for CCGV ** */ ?>
        <div class="contentText">
            <?php
            if (tep_session_is_registered('customer_id')) {
                $gv_query  = tep_db_query("select amount from ".TABLE_COUPON_GV_CUSTOMER." where customer_id = '".(int) $customer_id."'");
                $gv_result = tep_db_fetch_array($gv_query);
                if ($gv_result['amount'] > 0) {
                    ?>
                    <p><?php echo CCGV_BALANCE.':'.$currencies->format($gv_result['amount']); ?></p>
                    <?php
                }
            }
            ?><div class="col-sm-12"> 
                <h2><?php echo _('Gift Coupon / Voucher'); ?></h2>
                <ul class="accountLinkList">
                    <li><i class="fa fa-send"></i> </span><?php
                        echo '<a href="'.tep_href_link(FILENAME_GV_SEND, '',
                            'SSL').'">'._('send voucher').'</a>';
                        ?></li>
                    <li><i class="fa fa-question-circle"></i> </span><?php
                        echo '<a href="'.tep_href_link(FILENAME_GV_FAQ, '',
                            'SSL').'">'._('Vouchers FAQ').'</a>';
                        ?></li>  
                </ul>
            </div>
<?php /* * * EOF alteration for CCGV ** */ ?>
        </div>
    </div>
</div>

<?php
require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');

