<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
 */

$cl_box_groups[] = array(
    'heading' => __('BOX_HEADING_LOCATION_AND_TAXES',_('Location and taxes')),
    'apps' => array(
        array(
            'code' => cfg('FILENAME_COUNTRIES'),
            'title' => __('BOX_TAXES_COUNTRIES',_('Countries')),
            'link' => tep_href_link(cfg('FILENAME_COUNTRIES'))
        ),
        array(
            'code' =>  cfg('FILENAME_ZONES'),
            'title' =>  __('BOX_TAXES_ZONES',_('Tax zones')),
            'link' => tep_href_link(cfg('FILENAME_ZONES'))
        ),
        array(
            'code' =>  cfg('FILENAME_GEO_ZONES'),
            'title' => __('BOX_TAXES_GEO_ZONES',_('Geo zones')),
            'link' => tep_href_link(cfg('FILENAME_GEO_ZONES'))
        ),
        array(
            'code' =>  cfg('FILENAME_TAX_CLASSES'),
            'title' =>  __('BOX_TAXES_TAX_CLASSES',_('Tax Classes')),
            'link' => tep_href_link( cfg('FILENAME_TAX_CLASSES'))
        ),
        array(
            'code' =>  cfg('FILENAME_TAX_RATES'),
            'title' =>  __('BOX_TAXES_TAX_RATES',_('Tax Rates')),
            'link' => tep_href_link( cfg('FILENAME_TAX_RATES'))
        )
    )
);

