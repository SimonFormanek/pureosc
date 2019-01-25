<?php
/*
  $Id: cm_fp_upcoming_products.php, v1.1 20160208 Kymation$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2016 James C Keebaugh

  Released under the GNU General Public License v2.0 or later
 */
?>

<!-- Start cm_fp_upcoming_products module -->
<div id="upcoming_products" class="col-sm-<?php echo (int) MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_CONTENT_WIDTH; ?>">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="pull-left">
                <?php echo TABLE_HEADING_UPCOMING_PRODUCTS.PHP_EOL; ?>
            </div>
            <div class="pull-right">
                <?php echo TABLE_HEADING_DATE_EXPECTED.PHP_EOL; ?>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="panel-body">
            <?php
            foreach ($upcoming_products_data as $expected) {
                ?>
                <div class="pull-left"><a href="<?php echo tep_href_link('product_info.php',
                'products_id='.$expected['products_id']);
                ?>"><?php echo $expected['products_name']; ?></a></div>
                <div class="pull-right"><?php echo tep_date_short($expected['date_expected']); ?></div>
                <div class="clearfix"></div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<!-- End cm_fp_upcoming_products module -->