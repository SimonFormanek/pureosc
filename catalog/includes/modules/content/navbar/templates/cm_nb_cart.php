<?php
/*
  $Id cm_nb_cart.php v1.0.1 20160218 Kymation $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2016 James C Keebaugh

  Released under the GNU General Public License
 */
?>

<!-- Start cm_nb_cart -->
<li class="dropdown">
    <?php if ($cart->count_contents() > 0) { ?>
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php
        echo '<i class="fa fa-shopping-cart"></i> '.sprintf(_('%s item(s)'),
            $cart->count_contents()).' <span class="caret"></span> ';
        ?></a>
        <ul class="dropdown-menu">
            <li><a href="<?php echo tep_href_link(FILENAME_SHOPPING_CART); ?>"><?php
        echo sprintf(_('%s item(s)'), $cart->count_contents()).
        ', '.$currencies->format($cart->show_total());
        ?></a></li>
            <li class="divider"></li>
            <li><a href="<?php echo tep_href_link(FILENAME_SHOPPING_CART); ?>"><?php echo _('View cart'); ?></a></li>
        </ul>
    </li>

    <li><a href="<?php echo tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>"><i class="fa fa-angle-right"></i> <?php echo _('Checkout'); ?></a></li>

<?php } else { ?>

    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-shopping-cart"></i> <?php echo _('0 items'); ?></a>
    <ul class="dropdown-menu">
        <li><a href="<?php echo tep_href_link(FILENAME_SHOPPING_CART); ?>"><?php echo _('View Cart'); ?></a></li>
    </ul>
    </li>
<?php } ?>
<!-- End cm_nb_cart -->
