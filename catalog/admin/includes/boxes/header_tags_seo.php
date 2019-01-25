<?php
/*
  $Id: header_tags_seo.php,v 1.00 2008/04/04 Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
 */

$cl_box_groups[] = array(
    'heading' => BOX_HEADING_HEADER_TAGS_SEO,
    'apps' => array(
        array(
            'code' => FILENAME_HEADER_TAGS_SEO,
            'title' => BOX_HEADER_TAGS_ADD_A_PAGE,
            'link' => tep_href_link(FILENAME_HEADER_TAGS_SEO)
        ),
        array(
            'code' => FILENAME_HEADER_TAGS_SILO,
            'title' => BOX_HEADER_TAGS_SILO,
            'link' => tep_href_link(FILENAME_HEADER_TAGS_SILO)
        ),
        array(
            'code' => FILENAME_HEADER_TAGS_KEYWORDS,
            'title' => BOX_HEADER_TAGS_KEYWORDS,
            'link' => tep_href_link(FILENAME_HEADER_TAGS_KEYWORDS)
        ),
        array(
            'code' => FILENAME_HEADER_TAGS_FILL_TAGS,
            'title' => BOX_HEADER_TAGS_FILL_TAGS,
            'link' => tep_href_link(FILENAME_HEADER_TAGS_FILL_TAGS)
        ),
        array(
            'code' => FILENAME_HEADER_TAGS_SOCIAL,
            'title' => BOX_HEADER_TAGS_SOCIAL,
            'link' => tep_href_link(FILENAME_HEADER_TAGS_SOCIAL)
        ),
        array(
            'code' => FILENAME_HEADER_TAGS_TEST,
            'title' => BOX_HEADER_TAGS_TEST,
            'link' => tep_href_link(FILENAME_HEADER_TAGS_TEST)
        )
    )
);
?>
