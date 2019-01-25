<?php
/*
  $Id: cm_fp_message.php, v1.1 20160208 Kymation$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2016 James C Keebaugh

  Released under the GNU General Public License
 */
?>

<!-- Start cm_fp_message module -->
<div id="message" class="col-sm-<?php echo (int) MODULE_CONTENT_FRONT_PAGE_MESSAGE_CONTENT_WIDTH; ?>">
    <?php echo $messageStack->output('product_action'); ?>
</div>
<!-- End cm_fp_message module -->