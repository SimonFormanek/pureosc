<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
 */

require_once('includes/application_top.php');

if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
}

if (!isset($_GET['order_id']) || (isset($_GET['order_id']) && !is_numeric($_GET['order_id']))) {
    tep_redirect(tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
}

$customer_info_query = tep_db_query("select o.customers_id from ".TABLE_ORDERS." o, ".TABLE_ORDERS_STATUS." s where o.orders_id = '".(int) $_GET['order_id']."' and o.orders_status = s.orders_status_id and s.language_id = '".(int) $languages_id."' and s.public_flag = '1'");
$customer_info       = tep_db_fetch_array($customer_info_query);
if ($customer_info['customers_id'] != $customer_id) {
    tep_redirect(tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
}

require(DIR_WS_LANGUAGES.$language.'/'.FILENAME_ACCOUNT_HISTORY_INFO);

$breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
$breadcrumb->add(NAVBAR_TITLE_2,
    tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
$breadcrumb->add(sprintf(NAVBAR_TITLE_3, $_GET['order_id']),
    tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id='.$_GET['order_id'],
        'SSL'));

$order = new order($_GET['order_id']);
if (defined('USE_FLEXIBEE') && (constant('USE_FLEXIBEE') == 'true')) {
    $invoice = new PureOSC\flexibee\FakturaVydana('ext:orders:'.$_GET['order_id']);

    $invoiceNum = 'ext:src:faktura-vydana:'.$invoice->getRecordID();
    if ($invoice->recordExists($invoiceNum)) {
        $invoice->loadFromFlexiBee($invoiceNum);
    }
}
require(DIR_WS_INCLUDES.'template_top.php');
?>

<div class="page-header">
    <h1><?php echo _('Order info'); ?></h1>
</div>

<div class="contentContainer">

    <div class="contentText">

        <div class="panel panel-default">
            <div class="panel-heading"><strong><?php
                    echo sprintf(_('Order #%s'), $_GET['order_id']).' <span class="badge pull-right">'.$order->info['orders_status'].'</span>';
                    ?></strong></div>
            <div class="panel-body">

                <table border="0" width="100%" cellspacing="0" cellpadding="2" class="table-hover order_confirmation">
                    <?php
                    if (!empty($order->info['tax_groups'])) {
                        ?>
                        <tr>
                            <td colspan="2"><strong><?php echo _('Products'); ?></strong></td>
                            <td align="right"><strong><?php echo _('Tax'); ?></strong></td>
                            <td align="right"><strong><?php echo _('Total'); ?></strong></td>
                        </tr>
                        <?php
                    } else {
                        ?>
                        <tr>
                            <td colspan="2"><strong><?php echo _('Products'); ?></strong></td>
                            <td align="right"><strong><?php echo _('Total'); ?></strong></td>
                        </tr>
                        <?php
                    }

                    for ($i = 0, $n = sizeof($order->products); $i < $n; $i++) {
                        echo '          <tr>'."\n".
                        '            <td align="right" valign="top" width="30">'.$order->products[$i]['qty'].'&nbsp;x&nbsp;</td>'."\n".
                        '            <td valign="top">'.$order->products[$i]['name'];

                        if ((isset($order->products[$i]['attributes'])) && (sizeof($order->products[$i]['attributes'])
                            > 0)) {
                            for ($j = 0, $n2 = sizeof($order->products[$i]['attributes']); $j
                                < $n2; $j++) {
                                echo '<br /><nobr><small>&nbsp;<i> - '.$order->products[$i]['attributes'][$j]['option'].': '.$order->products[$i]['attributes'][$j]['value'].'</i></small></nobr>';
                            }
                        }

                        echo '</td>'."\n";

                        if (sizeof($order->info['tax_groups']) > 1) {
                            echo '            <td valign="top" align="right">'.tep_display_tax_value($order->products[$i]['tax']).'%</td>'."\n";
                        }

                        echo '            <td align="right" valign="top">'.$currencies->format(tep_add_tax($order->products[$i]['final_price'],
                                $order->products[$i]['tax']) * $order->products[$i]['qty'],
                            true, $order->info['currency'],
                            $order->info['currency_value']).'</td>'."\n".
                        '          </tr>'."\n";
                    }
                    ?>
                </table>
                <hr>
                <table width="100%" class="pull-right">
                    <?php
                    for ($i = 0, $n = sizeof($order->totals); $i < $n; $i++) {
                        echo '          <tr>'."\n".
                        '            <td align="right" width="100%">'.$order->totals[$i]['title'].'&nbsp;</td>'."\n".
                        '            <td align="right">'.$order->totals[$i]['text'].'</td>'."\n".
                        '          </tr>'."\n";
                    }
                    ?>
                </table>
            </div>


            <div class="panel-footer">
                <span class="pull-right hidden-xs"><?php echo _('Total').' '.$order->info['total']; ?></span><?php echo HEADING_ORDER_DATE.' '.tep_date_long($order->info['date_purchased']); ?>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <?php
    $orderInfoRow = new Ease\TWB\Row();

    if ($order->delivery !== false) {
        $orderInfoRow->addColumn(4,
            new Ease\TWB\Panel(_('Delivery Address'), 'info',
                tep_address_format($order->delivery['format_id'],
                    $order->delivery, 1, ' ', '<br />')));
    }

    $orderInfoRow->addColumn(4,
        new Ease\TWB\Panel(_('Billing Address'), 'warning',
            tep_address_format($order->billing['format_id'], $order->billing, 1,
                ' ', '<br />')));


    if ($order->info['shipping_method']) {
        $orderInfoRow->addColumn(4,
            new Ease\TWB\Panel(_('Shipping Method'), 'info',
                $order->info['shipping_method']));
    }


    $paymentRow = new \Ease\TWB\Row();

    $oPage = new Ease\TWB\WebPage();

    if (defined('USE_FLEXIBEE') && (constant('USE_FLEXIBEE') == 'true')) {
        if (floatval($invoice->getDataValue('zbyvaUhradit'))) {
            $paymentInfo = new Ease\TWB\Panel(_('Payment Method'), 'warning');
            $paymentInfo->addItem($order->info['payment_method']);
            $paymentInfo->addItem('<p>'._('QR Payment').':'.'</p>');
            $paymentInfo->addItem(new \Ease\Html\ImgTag($invoice->getQrCodeBase64(),
                    $invoice->getRecordIdent()));
        } else {
            $docId = 'ext:orders:'.$_GET['order_id'];

            $paymentInfo = new Ease\TWB\Panel(_('Payment method'), 'success');

            $paymentInfo->addItem(new Ease\Html\H3Tag(_('Already settled')));
            $paymentInfo->addItem(new Ease\TWB\LinkButton('getpdf.php?evidence=faktura-vydana&id='.$docId.'&embed=true',
                    _('PDF Invoice'), 'success'));
            $paymentInfo->addItem(new Ease\TWB\LinkButton('getisdoc.php?evidence=faktura-vydana&id='.$docId.'&embed=true',
                    _('ISDOC Invoice'), 'success'));
            $paymentInfo->addItem(new Ease\TWB\LinkButton('getxls.php?evidence=faktura-vydana&id='.$docId.'&embed=true',
                    _('XLS Invoice'), 'success'));
        }
    } else {
        $paymentInfo = new Ease\TWB\Panel(constant('HEADING_PAYMENT_METHOD'),
            'warning', $order->info['payment_method']);
    }

    
//    $paymentInfo->addItem( new \PureOSC\ui\QRFaktura($order) );
//    $paymentRow->addColumn(12, $paymentInfo);

    echo $orderInfoRow;
    echo $paymentRow;
    ?>

    <hr>

    <h2><?php echo _('Order History'); ?></h2>

    <div class="clearfix"></div>

    <div class="contentText">
        <ul class="timeline">
<?php
$statuses_query = tep_db_query("select os.orders_status_name, osh.date_added, osh.comments from ".TABLE_ORDERS_STATUS." os, ".TABLE_ORDERS_STATUS_HISTORY." osh where osh.orders_id = '".(int) $_GET['order_id']."' and osh.orders_status_id = os.orders_status_id and os.language_id = '".(int) $languages_id."' and os.public_flag = '1' order by osh.date_added");
while ($statuses       = tep_db_fetch_array($statuses_query)) {
    echo '<li>';
    echo '  <div class="timeline-badge"><i class="fa fa-check-square-o"></i></div>';
    echo '  <div class="timeline-panel">';
    echo '    <div class="timeline-heading">';
    echo '      <p class="pull-right"><small class="text-muted"><i class="fa fa-clock-o"></i> '.tep_date_short($statuses['date_added']).'</small></p><h2 class="timeline-title">'.$statuses['orders_status_name'].'</h2>';
    echo '    </div>';
    echo '    <div class="timeline-body">';
    echo '      <p>'.(empty($statuses['comments']) ? '&nbsp;' : '<blockquote>'.nl2br(tep_output_string_protected($statuses['comments'])).'</blockquote>').'</p>';
    echo '    </div>';
    echo '  </div>';
    echo '</li>';
}
?>
        </ul>
    </div>

<?php
if (DOWNLOAD_ENABLED == 'true') include(DIR_WS_MODULES.'downloads.php');
?>

    <div class="clearfix"></div>
    <div class="buttonSet">
<?php
echo tep_draw_button(IMAGE_BUTTON_BACK, 'fa fa-angle-left',
    tep_href_link(FILENAME_ACCOUNT_HISTORY,
        tep_get_all_get_params(array('order_id')), 'SSL'));
?>
    </div>
</div>

<?php
require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');
