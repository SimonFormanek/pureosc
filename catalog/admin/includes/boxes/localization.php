<?php

/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
 */

$cl_box_groups[] = array(
    'heading' => __('BOX_HEADING_LOCALIZATION', _('Localization')),
    'apps' => array(
        array(
            'code' => cfg('FILENAME_CURRENCIES'),
            'title' => __('BOX_LOCALIZATION_CURRENCIES', _('Currencies')),
            'link' => tep_href_link(cfg('FILENAME_CURRENCIES'))
        ),
        array(
            'code' => cfg('FILENAME_LANGUAGES'),
            'title' => __('BOX_LOCALIZATION_LANGUAGES', _('Languages')),
            'link' => tep_href_link(cfg('FILENAME_LANGUAGES'))
        ),
        array(
            'code' => cfg('FILENAME_ORDERS_STATUS'),
            'title' => __('BOX_LOCALIZATION_ORDERS_STATUS', _('Orders status')),
            'link' => tep_href_link(cfg('FILENAME_ORDERS_STATUS'))
        )
    )
);

