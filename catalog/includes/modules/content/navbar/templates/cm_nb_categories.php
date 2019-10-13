<?php
/*
  $Id cm_nb_categories.php v1.0 20160215 Kymation $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2016 James C Keebaugh

  Released under the GNU General Public License
 */
?>

<!-- Start cm_nb_categories -->
<li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-navicon"></i><span class="hidden-sm"><?php echo _('Products'); ?></span></a>
    <?php echo $category_tree; ?>
</li>
<!-- End cm_nb_categories -->
