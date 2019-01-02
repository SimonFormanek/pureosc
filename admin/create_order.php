<?php
/*
  $Id: create_order.php,v 1 2003/08/17 23:21:34 frankl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
 */

require('includes/application_top.php');

// #### Get Available Customers

$query  = tep_db_query("select a.customers_id, a.customers_firstname, a.customers_lastname, b.entry_company, b.entry_city, c.zone_code from ".TABLE_CUSTOMERS." AS a, ".TABLE_ADDRESS_BOOK." AS b LEFT JOIN ".TABLE_ZONES." as c ON (b.entry_zone_id = c.zone_id) WHERE a.customers_default_address_id = b.address_book_id ORDER BY entry_company, customers_firstname, customers_lastname");
$result = $query;

$customer_count = tep_db_num_rows($result);
if ($customer_count > 0) {
    // Query Successful
    $SelectCustomerBox = "<select name=\"Customer\" id=\"Customer\"><option value=\"\">".TEXT_SELECT_CUST."</option>\n";

    while ($db_Row = tep_db_fetch_array($result)) {

        $SelectCustomerBox .= "<option value=\"".$db_Row['customers_id']."\"";

        if (isSet($_GET['Customer']) and $db_Row['customers_id'] == $_GET['Customer']) {
            $SelectCustomerBox .= " SELECTED ";
            $SelectCustomerBox .= ">".(empty($db_Row['entry_company']) ? "" : strtoupper($db_Row['entry_company'])." - " ).$db_Row['customers_firstname']." ".$db_Row['customers_lastname']." - ".$db_Row['entry_city']." (".$db_Row['zone_code'].")</option>\n";
        } else {
            $SelectCustomerBox .= ">".(empty($db_Row['entry_company']) ? "" : strtoupper($db_Row['entry_company'])." - " ).$db_Row['customers_firstname']." ".$db_Row['customers_lastname']." - ".$db_Row['entry_city']." (".$db_Row['zone_code'].")</option>\n";
        }
    }

    $SelectCustomerBox .= "</select>\n";
}

$query  = tep_db_query("select code, value from ".TABLE_CURRENCIES." ORDER BY code");
$result = $query;

if (tep_db_num_rows($result) > 0) {
    // Query Successful
    $SelectCurrencyBox = "<select name=\"Currency\"><option value=\"\">".TEXT_SELECT_CURRENCY."</option>\n";
    while ($db_Row            = tep_db_fetch_array($result)) {
        $SelectCurrencyBox .= "<option value='".$db_Row["code"]." , ".$db_Row["value"]."'";

        if ($db_Row["code"] == DEFAULT_CURRENCY) {
            $SelectCurrencyBox .= " SELECTED ";
        }

        $SelectCurrencyBox .= ">".$db_Row["code"]."</option>\n";
    }
    $SelectCurrencyBox .= "</select>\n";
}

if (isset($_GET['Customer'])) {
    $account_query = tep_db_query("select * from ".TABLE_CUSTOMERS." where customers_id = '".$_GET['Customer']."'");
    $account       = tep_db_fetch_array($account_query);
    $customer      = $account['customers_id'];
    $address_query = tep_db_query("select * from ".TABLE_ADDRESS_BOOK." where customers_id = '".$_GET['Customer']."'");
    $address       = tep_db_fetch_array($address_query);
} elseif (isset($_GET['Customer_nr'])) {
    $account_query = tep_db_query("select * from ".TABLE_CUSTOMERS." where customers_id = '".$_GET['Customer_nr']."'");
    $account       = tep_db_fetch_array($account_query);
    $customer      = $account['customers_id'];
    $address_query = tep_db_query("select * from ".TABLE_ADDRESS_BOOK." where customers_id = '".$_GET['Customer_nr']."'");
    $address       = tep_db_fetch_array($address_query);
}

require(DIR_WS_LANGUAGES.$language.'/'.FILENAME_CREATE_ORDER_PROCESS);

// #### Generate Page

require(DIR_WS_INCLUDES.'template_top.php');

require('includes/form_check.js.php');
?>

<script language="javascript" type="text/javascript"><!--
function selectExisting() {
        document.create_order.customers_create_type.value = 'existing';
        selectorsStatus(false);
        selectorsExtras(true);
    }
    function selectNew() {
        document.create_order.customers_create_type.value = 'new';
        selectorsStatus(true);
        selectorsExtras(false);
    }
    function selectNone() {
        document.create_order.customers_create_type.value = 'none';
        selectorsStatus(true);
        selectorsExtras(true);
    }
    function selectorsStatus(status) {
        document.cust_select.Customer.disabled = status;
        document.cust_select.cust_select_button.disabled = status;
        document.cust_select_id.cust_select_id_field.disabled = status;
        document.cust_select_id.cust_select_id_button.disabled = status;
    }
    function selectorsExtras(status) { /*TODO: next 2 commented lines partialy fix error message canot create account missing pass*/
//  document.create_order.customers_password.disabled = status;
//  document.create_order.customers_newsletter.disabled = status;
<?php if (ACCOUNT_DOB == 'true') { ?>
            document.create_order.customers_dob.disabled = status;
<?php } ?>
<?php if (ACCOUNT_GENDER == 'true') { ?>
            document.create_order.customers_gender[0].disabled = status;
            document.create_order.customers_gender[1].disabled = status;
<?php } ?>
    }
//--></script>


        <table border="0" width="100%" cellspacing="2" cellpadding="2">
            <tr>
                <td>
                    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
                        </tr>
                    </table>
                    <br />
                    <table border="0" width="100%" class="dataTableHeadingRow">
                        <tr>
                            <td class="dataTableHeadingContent">&nbsp;&nbsp;<?php echo TEXT_STEP_1; ?></td>
                        </tr>
                    </table>
                    <table border="0" cellpadding="3" cellspacing="0">
                        <tr>
                            <td class="main" valign="top">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td class="main" valign="top">
                                            <table border="0" cellpadding="3" cellspacing="0">
                                                <tr>
                                                    <td class="main" valign="top"><?php echo tep_draw_separator('pixel_trans.gif',
    '100%', '10');
?></td>
                                                    <td class="main" valign="top"></td>
                                                </tr>
                                                <?php
                                                if ($customer_count > 0) {
                                                    ?>
                                                    <tr>
                                                        <td class="main" valign="top"><input name="handle_customer" id="existing_customer" value="existing" type="radio" checked="checked" onClick="selectExisting();" /></td>
                                                        <td class="main" valign="top"><label for="existing_customer" style="cursor:pointer;"><?php echo CREATE_ORDER_TEXT_EXISTING_CUST; ?></label></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="main" valign="top"></td>
                                                        <td class="main" valign="top">
                                                            <?php
                                                            echo "<form action=\"$PHP_SELF\" method=\"GET\" name=\"cust_select\" id=\"cust_select\">\n";
                                                            echo tep_hide_session_id();
                                                            echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
                                                            echo "<tr>\n";
                                                            echo "<td>$SelectCustomerBox</td>\n";
                                                            echo "<td>&nbsp;".tep_draw_button(IMAGE_SELECT,
                                                                'person', null,
                                                                'primary',
                                                                array('params' => 'id="cust_select_button"'))."</td>\n";
                                                            echo "</tr>\n";
                                                            echo "</table>\n";
                                                            echo "</form>\n";
                                                            ?>	
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="main" valign="top"></td>
                                                        <td class="main" valign="top"><?php echo TEXT_OR_BY; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="main" valign="top"></td>
                                                        <td class="main" valign="top">
                                                            <?php
                                                            echo "<form action=\"$PHP_SELF\" method=\"GET\" name=\"cust_select_id\" id=\"cust_select_id\">\n";
                                                            echo tep_hide_session_id();
                                                            echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
                                                            echo "<tr>\n";
                                                            echo "<td><font class=main><input type=text name=\"Customer_nr\" name=\"cust_select_id_field\" id=\"cust_select_id_field\"></td>\n";
                                                            echo "<td>&nbsp;".tep_draw_button(IMAGE_SELECT,
                                                                'person', null,
                                                                'primary',
                                                                array('params' => 'id="cust_select_id_button"'))."</td>\n";
                                                            echo "</tr>\n";
                                                            echo "</table>\n";
                                                            echo "</form>\n";
                                                            ?>	
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="main" valign="top"><?php echo tep_draw_separator('pixel_trans.gif',
                                                                '100%', '10');
                                                            ?></td>
                                                        <td class="main" valign="top"></td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?> 
                                                <tr>
                                                    <td class="main" valign="top"><input name="handle_customer" id="new_customer" value="new" type="radio" onClick="selectNew();"></td>
                                                    <td class="main" valign="top"><label for="new_customer" style="cursor:pointer;"><?php echo CREATE_ORDER_TEXT_NEW_CUST; ?></label></td>
                                                </tr>
                                                <tr>
                                                    <td class="main" valign="top"><?php echo tep_draw_separator('pixel_trans.gif',
                                                    '100%', '10');
                                                ?></td>
                                                    <td class="main" valign="top"></td>
                                                </tr>
                                                <tr>
                                                    <td class="main" valign="top"><input name="handle_customer" id="no_customer" value="none" type="radio" onClick="selectNone();"></td>
                                                    <td class="main" valign="top"><label for="no_customer" style="cursor:pointer;"><?php echo CREATE_ORDER_TEXT_NO_CUST; ?></label></td>
                                                </tr>
                                                <tr>
                                                    <td class="main" valign="top"><?php echo tep_draw_separator('pixel_trans.gif',
                                                    '100%', '10');
                                                ?></td>
                                                    <td class="main" valign="top"></td>
                                                </tr>
                                            </table>

                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                    </table>
<?php
if (!empty($_GET['message'])) {
    ?>
                        <br />
                        <table border="0" width="100%" style=" background-color:#FF0000; height:40px;">
                            <tr>
                                <td class="dataTableHeadingContent">&nbsp;&nbsp;<?php echo $_GET['message']; ?></td>
                            </tr>
                        </table>
    <?php
}
?>
                    <br />
                    <table border="0" width="100%" class="dataTableHeadingRow">
                        <tr>
                            <td class="dataTableHeadingContent">&nbsp;&nbsp;<?php echo TEXT_STEP_2; ?></td>
                        </tr>
                    </table>

<?php
echo tep_draw_form('create_order', FILENAME_CREATE_ORDER_PROCESS, '', 'post',
    'onsubmit="return check_form(this);" id="create_order"').tep_draw_hidden_field('customers_create_type',
    'existing', 'id="customers_create_type"').tep_hide_session_id();
?>
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td>
<?php
//onSubmit="return check_form();"
require(DIR_WS_MODULES.'create_order_details.php');
?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo tep_draw_separator('pixel_trans.gif',
    '100%', '10');
?></td>
                        </tr>
                        <tr>
                            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                                    <tr>
                                        <td class="main"><?php echo tep_draw_button(IMAGE_BACK,
                                                'triangle-1-w',
                                                tep_href_link(FILENAME_DEFAULT,
                                                    '', 'SSL'), 'primary');
?></td>
                                        <td class="main" align="right"><?php echo tep_draw_button(IMAGE_SAVE,
                                                'disk', null, 'primary').'&nbsp;&nbsp;';
?></td>
                                    </tr>
                                </table></td>
                        </tr>
                    </table></form></td>
            </tr>
        </table>

        <script language="javascript" type="text/javascript"><!--
        selectorsExtras(true);
            //--></script>

<?php
require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');
?>