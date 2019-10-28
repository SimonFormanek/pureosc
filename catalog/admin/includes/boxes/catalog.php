<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
 */

$cl_box_groups[] = array(
    'heading' => __('BOX_HEADING_CATALOG',_('Catalog')),
    'apps' => array(
        array(
            'code' => cfg('FILENAME_CATEGORIES'),
            'title' =>  __('BOX_CATALOG_CATEGORIES_PRODUCTS',_('Categories/Products')),
            'link' => tep_href_link(cfg('FILENAME_CATEGORIES'))
        ),
        array(
            'code' =>  cfg('FILENAME_PRODUCTS_ATTRIBUTES'),
            'title' =>  __('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES',_('Products Attributes')),
            'link' => tep_href_link(cfg('FILENAME_PRODUCTS_ATTRIBUTES'))
        ),
        array(
            'code' =>  cfg('FILENAME_MANUFACTURERS'),
            'title' =>  __('BOX_CATALOG_MANUFACTURERS',_('Manufacturers')),
            'link' => tep_href_link(cfg('FILENAME_MANUFACTURERS'))
        ),
        array(
            'code' =>  cfg('FILENAME_REVIEWS'),
            'title' =>  __('BOX_CATALOG_REVIEWS',_('Reviews')),
            'link' => tep_href_link(cfg('FILENAME_REVIEWS'))
        ),
        array(
            'code' =>  cfg('FILENAME_SPECIALS'),
            'title' =>  __('BOX_CATALOG_SPECIALS',_('Specials')),
            'link' => tep_href_link(cfg('FILENAME_SPECIALS'))
        ),
        array(
            'code' =>  cfg('FILENAME_PRODUCTS_EXPECTED'),
            'title' =>  __('BOX_CATALOG_PRODUCTS_EXPECTED',_('Products expected')),
            'link' => tep_href_link(cfg('FILENAME_PRODUCTS_EXPECTED'))
        )
    )
);
