<?php
/*
  $Id: stats_sales.php 2008-08-16 $

  Released under the GNU General Public License
 */

require('includes/application_top.php');


$currencies = new AdminCurrencies();

if ($_GET['month'] == '') {
    $month = date("m");
    $year  = '20'.date("y");
} else {
    $month = $_GET['month'];
    $year  = $_GET['year'];
}


$months   = array();
$months[] = array('id' => 1, 'text' => TEXT_NAME_JANUARY);
$months[] = array('id' => 2, 'text' => TEXT_NAME_FEBRUARY);
$months[] = array('id' => 3, 'text' => TEXT_NAME_MARCH);
$months[] = array('id' => 4, 'text' => TEXT_NAME_APRIL);
$months[] = array('id' => 5, 'text' => TEXT_NAME_MAY);
$months[] = array('id' => 6, 'text' => TEXT_NAME_JUNE);
$months[] = array('id' => 7, 'text' => TEXT_NAME_JULY);
$months[] = array('id' => 8, 'text' => TEXT_NAME_AUGUST);
$months[] = array('id' => 9, 'text' => TEXT_NAME_SEPTEMBER);
$months[] = array('id' => 10, 'text' => TEXT_NAME_OCTOBER);
$months[] = array('id' => 11, 'text' => TEXT_NAME_NOVEMBER);
$months[] = array('id' => 12, 'text' => TEXT_NAME_DECEMBER);

$years = array();

//starting year from first order
$start_year_query = tep_db_query("select YEAR(date_added) as year from ".TABLE_ORDERS_STATUS_HISTORY." order by orders_id limit 1");
if (tep_db_num_rows($start_year_query) == 1) {
    $start_year = tep_db_fetch_array($start_year_query);
    $start_year = $start_year['year'];
} else {
    $start_year = date("Y");
}
for ($counter_year = $start_year; $counter_year <= '20'.date("y"); $counter_year++) {
    $years[] = array('id' => $counter_year, 'text' => $counter_year);
}

$status = (int) $_GET['status'];

$statuses_query = tep_db_query("select * from ".TABLE_ORDERS_STATUS." where language_id = $languages_id order by orders_status_name");
$statuses       = array();
$statuses[]     = array('id' => 0, 'text' => TEXT_SHOW_ALL);
while ($st             = tep_db_fetch_array($statuses_query)) {
    $statuses[] = array('id' => $st['orders_status_id'], 'text' => $st['orders_status_name']);
}

if ($status != 0) {
    $os = " and o.orders_status = ".$status." ";
} else {
    $os = '';
}

switch ($_GET['by']) {
    default:
    case 'product':
        $sales_products_query = tep_db_query("select sum(op.final_price*op.products_quantity) as daily_prod, sum(op.final_price*op.products_quantity*(1+op.products_tax/100)) as withtax, o.date_purchased, op.products_name, sum(op.products_quantity) as qty, op.products_model from ".TABLE_ORDERS." as o, ".TABLE_ORDERS_PRODUCTS." as op where o.orders_id = op.orders_id and month(o.date_purchased) = ".$month." and year(o.date_purchased) = ".$year.$os." GROUP by products_id ORDER BY daily_prod DESC");
        break;
    case 'name':
        $sales_products_query = tep_db_query("select sum(op.final_price*op.products_quantity) as daily_prod, sum(op.final_price*op.products_quantity*(1+op.products_tax/100)) as withtax, o.date_purchased, op.products_name, sum(op.products_quantity) as qty, op.products_model from ".TABLE_ORDERS." as o, ".TABLE_ORDERS_PRODUCTS." as op where o.orders_id = op.orders_id and month(o.date_purchased) = ".$month." and year(o.date_purchased) = ".$year.$os." GROUP by products_id ORDER BY op.products_name");
        break;
    case 'units':
        $sales_products_query = tep_db_query("select sum(op.final_price*op.products_quantity) as daily_prod, sum(op.final_price*op.products_quantity*(1+op.products_tax/100)) as withtax, o.date_purchased, op.products_name, sum(op.products_quantity) as qty, op.products_model from ".TABLE_ORDERS." as o, ".TABLE_ORDERS_PRODUCTS." as op where o.orders_id = op.orders_id and month(o.date_purchased) = ".$month." and year(o.date_purchased) = ".$year.$os." GROUP by products_id ORDER BY qty DESC");
        break;
    case 'date':
    default:
        $sales_products_query = tep_db_query("select sum(op.final_price*op.products_quantity) as daily_prod, sum(op.final_price*op.products_quantity*(1+op.products_tax/100)) as withtax, o.date_purchased, op.products_name, sum(op.products_quantity) as qty, op.products_model from ".TABLE_ORDERS." as o, ".TABLE_ORDERS_PRODUCTS." as op where o.orders_id = op.orders_id and month(o.date_purchased) = ".$month." and year(o.date_purchased) = ".$year.$os." GROUP by dayofmonth(o.date_purchased), products_id");
        break;
}

require(DIR_WS_INCLUDES.'template_top.php');

if (!defined('COMISSION_PERCENTAGE')) {
    tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('CONFIG_TITLE_COMISSION_PERCENTAGE', 'COMISSION_PERCENTAGE', 0, 'CONFIG_DESCRIPTION_COMISSION_PERCENTAGE', 1, 99, now())");
//define ('COMISSION_PERCENTAGE','0');
    $commission_percentage = 0.0;
} else {
    $commission_percentage = COMISSION_PERCENTAGE / 100;
}
?>


<table border="0" width="100%" cellspacing="0" cellpadding="2">
    <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
                </tr>
                <tr>
                    <td><?php echo tep_draw_separator('pixel_trans.gif',
    '100%', '10');
?></td>
                </tr>
            </table></td></tr>
    <form action="stats_sales.php" method=get>
        <tr>
            <td>
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="dataTableHeadingContent" valign="middle"><?php echo TEXT_MONTH; ?></td>
                        <td class="dataTableHeadingContent" width="10">&nbsp;</td>
                        <td class="dataTableHeadingContent" valign="middle"><?php echo tep_draw_pull_down_menu('month',
                            $months, $month, 'onchange=\'this.form.submit();\'');
?></td>
                        <td class="dataTableHeadingContent" width="10">&nbsp;</td>
                        <td class="dataTableHeadingContent" valign="middle"><?php echo TEXT_YEAR; ?></td>
                        <td class="dataTableHeadingContent" width="10">&nbsp;</td>
                        <td class="dataTableHeadingContent" valign="middle"><?php echo tep_draw_pull_down_menu('year',
                            $years, $year, 'onchange=\'this.form.submit();\'');
?></td>
                        <td class="dataTableHeadingContent" width="10">&nbsp;</td>
                        <td class="dataTableHeadingContent" valign="middle"><?php echo TEXT_STATUS; ?></td>
                        <td class="dataTableHeadingContent" width="10">&nbsp;</td>
                        <td class="dataTableHeadingContent" valign="middle"><?php echo tep_draw_pull_down_menu('status',
                                $statuses, $status,
                                'onchange=\'this.form.submit();\'');
?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <input type="hidden" name="by" value="<?= $_GET['by'] ?>">
    </form>
    <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
    </tr>
    <tr>
        <td>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr class="dataTableHeadingRow">
                    <td class="dataTableHeadingContent"><?php echo TEXT_SORT_BY; ?></td>
                    <td class="dataTableHeadingContent" width="10">&nbsp;</td>
                    <td class="dataTableHeadingContent"><?php echo '<a href="'.tep_href_link(FILENAME_STATS_SALES,
                                tep_get_all_get_params(array('by')).'&by=date',
                                'NONSSL').'">'.TEXT_BY_DATE.'</a>';
?></td>
                    <td class="dataTableHeadingContent" width="10" align="center">|</td>
                    <td class="dataTableHeadingContent"><?php echo '<a href="'.tep_href_link(FILENAME_STATS_SALES,
                            tep_get_all_get_params(array('by')).'&by=product',
                            'NONSSL').'">'.TEXT_BY_AMOUNT.'</a>';
?></td>
                    <td class="dataTableHeadingContent" width="10" align="center">|</td>
                    <td class="dataTableHeadingContent"><?php echo '<a href="'.tep_href_link(FILENAME_STATS_SALES,
                            tep_get_all_get_params(array('by')).'&by=units',
                            'NONSSL').'">'.TEXT_BY_UNITS_SOLD.'</a>';
?></td>
                    <td class="dataTableHeadingContent" width="10" align="center">|</td>
                    <td class="dataTableHeadingContent"><?php echo '<a href="'.tep_href_link(FILENAME_STATS_SALES,
                            tep_get_all_get_params(array('by')).'&by=name',
                            'NONSSL').'">'.TEXT_BY_NAME.'</a>';
?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
    </tr>
    <?php
    if (tep_db_num_rows($sales_products_query) > 0) {
        $dp             = '';
        $total          = 0;
        $total_wtax     = 0;
        while ($sales_products = tep_db_fetch_array($sales_products_query)) {
            if ($_GET['by'] == 'product' || $_GET['by'] == 'units' || $_GET['by']
                == 'name') {
                $ddp         = 'Product';
                $table_title = '';
            } else {
                $ddp         = tep_date_short($sales_products['date_purchased']);
                $table_title = tep_date_long($sales_products['date_purchased']);
            }
            if (($dp != $ddp)) { //if day has changed (or first day)
                if ($dp != '') { //close previous day if not first one
                    ?>
                </table></td>
                </tr>
                </table></td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
                                                <?php
                                                                                           }
                                                                                           ?>
            <tr>
                <td class=main><b><?php echo $table_title; ?></b></td>
            </tr>
            <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td valign="top"><table border="0" width="100%" cellspacing="1" cellpadding="2">
                                    <tr class="dataTableHeadingRow">
                                        <td class="dataTableHeadingContent" width="15%"><?php echo TABLE_HEADING_MODEL; ?></td>
                                        <td class="dataTableHeadingContent" width="40%"><a href=<?php
                        echo tep_href_link(FILENAME_STATS_SALES,
                            tep_get_all_get_params(array('by')).'&by=name',
                            'NONSSL')
                        ?>><?php echo TABLE_HEADING_NAME; ?></a></td>
                                        <td class="dataTableHeadingContent" align="center" width="15%"><a href=<?php
                                            echo tep_href_link(FILENAME_STATS_SALES,
                                                tep_get_all_get_params(array('by')).'&by=units',
                                                'NONSSL')
                                            ?>><?php echo TABLE_HEADING_QUANTITY; ?></a></td>
                                        <td class="dataTableHeadingContent" align="right" width="15%"><a href=<?php
                                    echo tep_href_link(FILENAME_STATS_SALES,
                                        tep_get_all_get_params(array('by')).'&by=product',
                                        'NONSSL')
                                    ?>><?php echo TABLE_HEADING_TOTAL; ?></a></td>
                                        <td class="dataTableHeadingContent" align="right" width="15%"><?php echo TABLE_HEADING_TOTAL_TAX; ?>&nbsp;</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                <tr class="dataTableRow">
                                    <td class="dataTableContent" width="15%"><?php echo $sales_products ['products_model']; ?></td>
                                    <td class="dataTableContent" width="40%"><?php echo $sales_products ['products_name']; ?></td>
                                    <td class="dataTableContent" align="center" width="15%"><?php echo $sales_products ['qty']; ?></td>
                                    <td class="dataTableContent" align="right" width="15%"><?php echo $currencies->display_price($sales_products ['daily_prod'],
                            0);
                                ?>&nbsp;</td>
                                    <td class="dataTableContent" align="right" width="15%"><?php echo $currencies->display_price($sales_products ['withtax'],
                            0);
                                ?>&nbsp;</td>
                                </tr>
                                <?php
                                $total              += $sales_products ['daily_prod'];
                                $total_wtax         += $sales_products ['withtax'];
                                $commission         = ($total * $commission_percentage);
                                $commission_display = $commission_percentage * 100;
                                $dp                 = $ddp;
                            }

                            echo '<tr><td colspan="5">'.tep_draw_separator('pixel_trans.gif',
                                '100%', '10').'</td></tr>';
                            if ($status == 0) {
                                echo '<tr><td colspan="5" class="main">'.TEXT_MONTHLY_TOTAL_SALES.'&nbsp;<b>'.$currencies->display_price($total,
                                    0).'</b></td></tr>';
                            } else {
                                echo '<tr><td colspan="5" class="main">'.TEXT_MONTHLY_SALES.'&nbsp;<b>'.$currencies->display_price($total,
                                    0).'</b></td></tr>';
                            }
                            if ($status == 0) {
                                echo '<tr><td colspan="5" class="main">'.TEXT_MONTHLY_TOTAL_SALES_TAX.'&nbsp;<b>'.$currencies->display_price($total_wtax,
                                    0).'</b></td></tr>';
                            } else {
                                echo '<tr><td colspan="5" class="main">'.TEXT_MONTHLY_SALES_TAX.'&nbsp;<b>'.$currencies->display_price($total_wtax,
                                    0).'</b></td></tr>';
                            }
                            if (($commission_percentage != 0) && ($status == 0)) {
                                echo '<tr><td colspan="5" class="main">'.sprintf(TEXT_MONTHLY_COMMISSION,
                                    $commission_display).'&nbsp;<b>'.$currencies->display_price($commission,
                                    0).'</b></td></tr>';
                            }
                        } else {
                            ?>
                            <tr>
                                <td class=main><?php echo '<b>'.TEXT_NO_RECORDS.'</b>'; ?></td>
                            </tr>
    <?php
}
?>
                    </table></td>
            </tr>
        </table></td>
</tr>
</table>

<?php
require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');