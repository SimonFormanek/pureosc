<?php
/*
  $Id: cm_fp_new_products.php, v1.1 20160208 Kymation$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2016 James C Keebaugh

  Released under the GNU General Public License v2.0 or later
 */
?>

<!-- Start cm_fp_new_products module -->
<div id="new_products" class="col-sm-<?php echo (int) constant('MODULE_CONTENT_FRONT_PAGE_NEW_PRODUCTS_CONTENT_WIDTH'); ?>">
    <h3><?php echo sprintf(_('New Products'), strftime('%B')); ?></h3>

    <div class="row">
<?php
  foreach ($new_products_data as $new_products) {
?>
      <div class="col-sm-6 col-md-4">
        <div class="thumbnail equal-height">
          <a href="<?php echo tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']); ?>"><?php echo tep_image(DIR_WS_IMAGES . $new_products['products_image'], $new_products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT); ?></a>
          <div class="caption">
              <p class="text-center"><a href="<?php echo tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']); ?>"><?php echo $new_products['products_name']; ?></a></p>
            <hr>
            <p class="text-center"><?php echo $currencies->display_price($new_products['products_price'], tep_get_tax_rate($new_products['products_tax_class_id'])); ?></p>
            <div class="text-center">
              <div class="btn-group">
                <a href="<?php echo tep_href_link(FILENAME_PRODUCT_INFO, tep_get_all_get_params(array('action')) . 'products_id=' . $new_products['products_id']); ?>" class="btn btn-default" role="button"><?php echo SMALL_IMAGE_BUTTON_VIEW; ?></a>
                <a href="<?php echo tep_href_link($_SERVER['PHP_SELF'], tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $new_products['products_id']); ?>" class="btn btn-success" role="button"><?php echo SMALL_IMAGE_BUTTON_BUY; ?></a>
              </div>
            </div>
          </div>
        </div>
      </div>
<?php
  }
?>
    </div>
  </div>
<!-- End cm_fp_new_products module -->