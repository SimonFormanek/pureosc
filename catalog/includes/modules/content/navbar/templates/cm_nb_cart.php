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
<li class="nav-item dropdown">
    <?php
    if ($cart->count_contents() > 0) {
        ?>
        <a class="nav-link dropdown-toggle" role="button" id="cartmenu" href="#"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php
            echo '<i class="fa fa-shopping-cart"></i> '.sprintf(_('%s item(s)'),
                $cart->count_contents()).' <span class="caret"></span> ';
            ?></a>
        <div class="dropdown-menu" aria-labelledby="cartmenu">
            <a class="dropdown-item" href="<?php echo tep_href_link(FILENAME_SHOPPING_CART); ?>"><?php
                echo sprintf(_('%s item(s)'), $cart->count_contents()).
                ', '.$currencies->format($cart->show_total());
                ?></a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?php echo tep_href_link(FILENAME_SHOPPING_CART); ?>"><?php echo _('View cart'); ?></a>

    </div>
    </li>

    <li><a href="<?php echo tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>"><i class="fa fa-angle-right"></i> <?php echo _('Checkout'); ?></a></li>

<?php } else { ?>

    <a class="nav-link  dropdown-toggle" id="cartmenu" role="button" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><i class="fa fa-shopping-cart"></i> <?php echo _('0 items'); ?></a>
    <ul class="dropdown-menu" aria-labelledby="cartmenu" >
        <a class="dropdown-item" href="<?php echo tep_href_link(FILENAME_SHOPPING_CART); ?>"><?php echo _('View Cart'); ?></a>
    </ul>
    </li>
<?php } ?>
<!-- End cm_nb_cart -->
