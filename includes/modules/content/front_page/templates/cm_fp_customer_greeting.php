<?php
/*
  $Id: cm_fp_customer_greeting.php, v1.1 20160208 Kymation$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2016 James C Keebaugh

  Released under the GNU General Public License v2.0 or later
 */
?>

<!-- Start cm_fp_customer_greeting module -->
  <div id="customer_greeting" class="col-sm-<?php echo (int) MODULE_CONTENT_FRONT_PAGE_CUSTOMER_GREETING_CONTENT_WIDTH; ?>">
    <div class="alert alert-info">
      <?php echo tep_customer_greeting(); ?>
    </div>
  </div>
<!-- End cm_fp_customer_greeting module -->