<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
 */

require_once('includes/application_top.php');

// if the customer is not logged on, redirect to start page
if (!tep_session_is_registered('customer_id')) {
    tep_redirect(tep_href_link(FILENAME_DEFAULT));
}

require(DIR_WS_LANGUAGES.$language.'/'.'checkout_pwa.php');

$breadcrumb->add(NAVBAR_TITLE_1);
$breadcrumb->add(NAVBAR_TITLE_2);

$orders_query = tep_db_query("select orders_id from ".TABLE_ORDERS." where customers_id = '".(int) $customer_id."' order by date_purchased desc limit 1");
$orders       = tep_db_fetch_array($orders_query);

$products_array = array();
$products_query = tep_db_query("select products_id, products_name from ".TABLE_ORDERS_PRODUCTS." where orders_id = '".(int) $orders['orders_id']."' order by products_name");
while ($products       = tep_db_fetch_array($products_query)) {
    $products_array[] = array('id' => $products['products_id'],
        'text' => $products['products_name']);
}

require(DIR_WS_INCLUDES.'template_top.php');
?>

<div class="page-header">
    <h1><?php echo HEADING_TITLE_SUCCESS; ?></h1>
</div>


<div class="contentContainer">
    <div class="contentText">


        <div class="panel panel-success">
            <div class="panel-heading">
                <?php echo TEXT_THANKS_FOR_SHOPPING; ?>
            </div>
            <div class="panel-body">
                <p><?php echo TEXT_SUCCESS; ?></p>
                <p><?php
                    echo sprintf(TEXT_CONTACT_STORE_OWNER,
                        tep_href_link(FILENAME_CONTACT_US));
                    ?></p>
            </div>
        </div>




        <?php
        if (tep_session_is_registered('customer_is_guest')) {
            tep_db_query("update ".TABLE_ORDERS." set customers_guest = '1' where customers_id = '".(int) $customer_id."'");
            tep_db_query("delete from ".TABLE_CUSTOMERS." where customers_id = '".(int) $customer_id."' and customers_guest = '1'");
            tep_db_query("delete from ".TABLE_ADDRESS_BOOK." where customers_id = '".(int) $customer_id."'");
            tep_db_query("delete from ".TABLE_CUSTOMERS_INFO." where customers_info_id = '".(int) $customer_id."'");

            tep_session_unregister('customer_default_address_id');
            tep_session_unregister('customer_first_name');
            tep_session_unregister('customer_country_id');
            tep_session_unregister('customer_zone_id');
            tep_session_unregister('customer_is_guest');
        }


        if (DOWNLOAD_ENABLED == 'true') {
            include(DIR_WS_MODULES.'downloads.php');
        } else {
            tep_session_unregister('customer_id');
        }
        ?>

        <div class="contentContainer">
            <div class="buttonSet">
                <div class="text-right"><?php
                    echo tep_draw_button(IMAGE_BUTTON_CONTINUE,
                        'glyphicon glyphicon-chevron-right',
                        tep_href_link(FILENAME_DEFAULT), 'primary', null,
                        'btn-success');
                    ?></div>
            </div>
        </div>
    </div>


    <?php
    require(DIR_WS_INCLUDES.'template_bottom.php');
    require(DIR_WS_INCLUDES.'application_bottom.php');
    ?>
