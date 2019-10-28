<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
 */

$cl_box_groups[] = array(
    'heading' => __('BOX_HEADING_CUSTOMERS',_('Customers')),
    'apps' => array(
        array(
            'code' => cfg('FILENAME_CUSTOMERS'),
            'title' => __('BOX_CUSTOMERS_CUSTOMERS',_('Customers')),
            'link' => tep_href_link( cfg('FILENAME_CUSTOMERS'))
        ),
        /*         * * Altered for Manual Order Maker and Create Order ** */
        array(
            'code' =>  cfg('FILENAME_CREATE_ACCOUNT'),
            'title' => __('BOX_CUSTOMERS_CREATE_ACCOUNT',_('Create account')),
            'link' => tep_href_link( cfg('FILENAME_CREATE_ACCOUNT'))
        ),
        array(
            'code' =>  cfg('FILENAME_CREATE_ORDER'),
            'title' => __('BOX_CUSTOMERS_CREATE_ORDER',_('Create order')),
            'link' => tep_href_link( cfg('FILENAME_CREATE_ORDER'))
        )
    /*     * * EOF for Manual Order Maker ** */
    )
);

