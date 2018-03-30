<?php 
/*
  $Id cm_nb_account.php v1.0.1 20160218 Kymation $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2016 James C Keebaugh

  Released under the GNU General Public License
*/
?>

<!-- Start cm_nb_account -->
         <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo (tep_session_is_registered('customer_id')) ? sprintf( HEADER_ACCOUNT_LOGGED_IN, $customer_first_name ) : HEADER_ACCOUNT_LOGGED_OUT; ?></a>
            <ul class="dropdown-menu">
                
              <?php  if (tep_session_is_registered('customer_id')) { ?>
               <li><a href="<?php echo tep_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>"><?php echo HEADER_ACCOUNT_LOGOFF; ?></a></li>
              <?php  } else { ?>
                <li><a href="<?php echo tep_href_link(FILENAME_LOGIN, '', 'SSL'); ?>"><?php echo HEADER_ACCOUNT_LOGIN; ?></a></li>
                <li><a href="<?php echo tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'); ?>"><?php echo HEADER_ACCOUNT_REGISTER; ?></a></li>
              <?php  } ?>
                
              <li class="divider"></li>
              <li><a href="<?php echo tep_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>"><?php echo HEADER_ACCOUNT; ?></a></li>
              <li><a href="<?php echo tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'); ?>"><?php echo HEADER_ACCOUNT_HISTORY; ?></a></li>
              <li><a href="<?php echo tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'); ?>"><?php echo HEADER_ACCOUNT_ADDRESS_BOOK; ?></a></li>
              <li><a href="<?php echo tep_href_link(FILENAME_ACCOUNT_PASSWORD, '', 'SSL'); ?>"><?php echo HEADER_ACCOUNT_PASSWORD; ?></a></li>
              
            </ul>
          </li>
<!-- End cm_nb_account -->
