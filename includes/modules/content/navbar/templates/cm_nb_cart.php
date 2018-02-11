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
         <?php  if ($cart->count_contents() > 0) { ?>
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php 
              echo sprintf(HEADER_CART_CONTENTS.' ', $cart->count_contents(),$cart->count_contents()); 
              ?></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo tep_href_link(FILENAME_SHOPPING_CART); ?>"><?php echo sprintf(HEADER_CART_HAS_CONTENTS, $cart->count_contents(), $currencies->format($cart->show_total())); ?></a></li>
                  <li class="divider"></li>
                  <li><a href="<?php echo tep_href_link(FILENAME_SHOPPING_CART); ?>"><?php echo HEADER_CART_VIEW_CART; ?></a></li>
              </ul>
            </li>

            <li><a href="<?php echo tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>"><?php echo HEADER_CART_CHECKOUT; ?></a></li>
            
          <?php  } else { ?>
            
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo HEADER_CART_NO_CONTENTS; ?></a>
              <ul class="dropdown-menu">

                  <li><a href="<?php echo tep_href_link(FILENAME_SHOPPING_CART); ?>"><?php echo HEADER_CART_VIEW_CART; ?></a></li>
              </ul>
            </li>



<!--ORIG:            <li class="nav navbar-text"><?php echo HEADER_CART_NO_CONTENTS; ?></li>-->
          <?php  } ?>
<!-- End cm_nb_cart -->
