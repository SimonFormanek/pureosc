<?php

/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
 */

$cl_box_groups[] = array(
    'heading' => __('BOX_HEADING_ORDERS', _('Orders')),
    'apps' => array(
        array(
            'code' => cfg('FILENAME_ORDERS'),
            'title' => __('BOX_ORDERS_ORDERS', _('Orders list')),
            'link' => tep_href_link(cfg('FILENAME_ORDERS'))
        ),
        /*         * * Altered for Manual Order Maker ** */
        array(
            'code' => cfg('FILENAME_CREATE_ORDER'),
            'title' => __('BOX_CUSTOMERS_CREATE_ORDER', _('Create order')),
            'link' => tep_href_link(cfg('FILENAME_CREATE_ORDER'))
        )
    /*     * * EOF for Manual Order Maker ** */
    )
);

