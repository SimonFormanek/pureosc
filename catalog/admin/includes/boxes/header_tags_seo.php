<?php
/*
  $Id: header_tags_seo.php,v 1.00 2008/04/04 Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
 */

$cl_box_groups[] = array(
    'heading' => __('BOX_HEADING_HEADER_TAGS_SEO',_('SEO Tags')),
    'apps' => array(
        array(
            'code' => cfg('FILENAME_HEADER_TAGS_SEO'),
            'title' => __('BOX_HEADER_TAGS_ADD_A_PAGE',_('Add page')),
            'link' => tep_href_link(cfg('FILENAME_HEADER_TAGS_SEO'))
        ),
        array(
            'code' => cfg('FILENAME_HEADER_TAGS_SILO'),
            'title' => __('BOX_HEADER_TAGS_SILO',_('Silo')),
            'link' => tep_href_link(cfg('FILENAME_HEADER_TAGS_SILO'))
        ),
        array(
            'code' => cfg('FILENAME_HEADER_TAGS_KEYWORDS'),
            'title' => __('BOX_HEADER_TAGS_KEYWORDS',_('Keywords')),
            'link' => tep_href_link(cfg('FILENAME_HEADER_TAGS_KEYWORDS'))
        ),
        array(
            'code' => cfg('FILENAME_HEADER_TAGS_FILL_TAGS'),
            'title' => __('BOX_HEADER_TAGS_FILL_TAGS',_('Fill')),
            'link' => tep_href_link(cfg('FILENAME_HEADER_TAGS_FILL_TAGS'))
        ),
        array(
            'code' => cfg('FILENAME_HEADER_TAGS_SOCIAL'),
            'title' => __('BOX_HEADER_TAGS_SOCIAL',_('Social')),
            'link' => tep_href_link(cfg('FILENAME_HEADER_TAGS_SOCIAL'))
        ),
        array(
            'code' => cfg('FILENAME_HEADER_TAGS_TEST'),
            'title' => __('BOX_HEADER_TAGS_TEST',_('Test')),
            'link' => tep_href_link(cfg('FILENAME_HEADER_TAGS_TEST'))
        )
    )
);

