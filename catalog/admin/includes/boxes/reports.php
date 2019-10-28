<?php

/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
 */

$cl_box_groups[] = array(
    'heading' => __('BOX_HEADING_REPORTS', _('Reports')),
    'apps' => array(
        array(
            'code' => cfg('FILENAME_STATS_PRODUCTS_VIEWED'),
            'title' => __('BOX_REPORTS_PRODUCTS_VIEWED', _('Products viewed')),
            'link' => tep_href_link(cfg('FILENAME_STATS_PRODUCTS_VIEWED'))
        ),
        array(
            'code' => cfg('FILENAME_STATS_PRODUCTS_PURCHASED'),
            'title' => __('BOX_REPORTS_PRODUCTS_PURCHASED', _('Purchased')),
            'link' => tep_href_link(cfg('FILENAME_STATS_PRODUCTS_PURCHASED'))
        ),
        array(
            'code' => cfg('FILENAME_STATS_CUSTOMERS'),
            'title' => __('BOX_REPORTS_ORDERS_TOTAL', _('Totals')),
            'link' => tep_href_link(cfg('FILENAME_STATS_CUSTOMERS'))
        ),
        array(
            'code' => cfg('FILENAME_STATS_SALES'),
            'title' => __('BOX_REPORTS_STATS_SALES', _('Stats sales')),
            'link' => tep_href_link(cfg('FILENAME_STATS_SALES'))
        )
    )
);

