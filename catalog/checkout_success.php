<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Edited by 2014 Newburns Design and Technology
 * ************************************************
 * *********** New addon definitions **************
 * ***********        Below          **************
 * ************************************************
  Credit Class, Gift Vouchers & Discount Coupons osC2.3.3.4 (CCGV) added -- http://addons.oscommerce.com/info/9020

  Released under the GNU General Public License
 */

require_once('includes/application_top.php');


// if the customer is not logged on, redirect them to the shopping cart page
if (!tep_session_is_registered('customer_id')) {
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
}

$orders_query = tep_db_query("select orders_id from ".TABLE_ORDERS." where customers_id = '".(int) $customer_id."' order by date_purchased desc limit 1");

// redirect to shopping cart page if no orders exist
if (!tep_db_num_rows($orders_query)) {
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
}

$orders = tep_db_fetch_array($orders_query);

$order_id = $orders['orders_id'];

$page_content = $oscTemplate->getContent('checkout_success');

if (isset($_GET['action']) && ($_GET['action'] == 'update')) {
    tep_redirect(tep_href_link(FILENAME_DEFAULT));
}

require(DIR_WS_LANGUAGES.$language.'/'.FILENAME_CHECKOUT_SUCCESS);

$breadcrumb->add(NAVBAR_TITLE_1);
$breadcrumb->add(NAVBAR_TITLE_2);

require(DIR_WS_INCLUDES.'template_top.php');

if (!isset($_REQUEST['PRCODE']) || ($_REQUEST['PRCODE'] == 0)) {
    ?>

    <div class="page-header">
        <h1><?php echo HEADING_TITLE; ?></h1>
    </div>

    <?php
    echo tep_draw_form('order',
        tep_href_link('checkout_success.php', 'action=update', 'SSL'), 'post',
        'class="form-horizontal" role="form"');
    ?>

    <div class="contentContainer">
        <?php echo $page_content; ?>
        <?php /*         * * Altered for CCGV ** */ ?>
        <?php
        $gv_query  = tep_db_query("select amount from ".TABLE_COUPON_GV_CUSTOMER." where customer_id='".(int) $customer_id."'");
        if ($gv_result = tep_db_fetch_array($gv_query)) {
            if ($gv_result['amount'] > 0) {
                ?>
                <?php
                echo GV_HAS_VOUCHERA;
                echo tep_href_link(FILENAME_GV_SEND);
                echo GV_HAS_VOUCHERB;
                ?>
                <?php
            }
        }
        if (defined('USE_FLEXIBEE') && (cfg('USE_FLEXIBEE') == 'true')) {
            $invoice = new PureOSC\flexibee\FakturaVydana('ext:orders:'.$order_id);
            if (floatval($invoice->getDataValue('zbyvaUhradit'))) {
                $qrImage = _('QR Payment').' '.new \Ease\Html\ImgTag($invoice->getQrCodeBase64(),
                        $invoice->getRecordIdent());
            }
            $invoiceNum = $invoice->getRecordID();


            echo '<a class="btn btn-success btn-xs" role="button" href="'.'getpdf.php?evidence=faktura-vydana&report-name=slozenkaA$$SUM&id='.$invoiceNum.'&embed=true'.'">'._('print cheque').'</a>';
            echo '<a class="btn btn-success btn-xs" role="button" href="'.'getpdf.php?evidence=faktura-vydana&id='.$invoiceNum.'&embed=true'.'">'._('PDF Invoice').'</a>';
            echo '<a class="btn btn-success btn-xs" role="button" href="'.'getisdoc.php?evidence=faktura-vydana&id='.$invoiceNum.'&embed=true'.'">'._('ISDOC Invoice').'</a>';
        } else {
            
        }
    }
    echo $qrImage.$button.$button2;
    ?>




    <?php /*     * * EOF alteration for CCGV ** */ ?>
</div>

<div class="contentContainer">
    <div class="buttonSet">
        <div class="text-right"><?php
            echo tep_draw_button(IMAGE_BUTTON_CONTINUE, 'fa fa-angle-right',
                null, 'primary', null, 'btn-success');
            ?></div>
    </div>
</div>

</form>

<?php
require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');

