<?php
/*
  $Id: articles.php, v1.0 2003/12/04 12:00:00 ra Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
 */

$cl_box_groups[] = array(
    'heading' => __('BOX_HEADING_ARTICLES',_('Articles')),
    'apps' => array(
        array(
            'code' => cfg('FILENAME_ARTICLES'),
            'title' => __('BOX_TOPICS_ARTICLES',_('Aricles')),
            'link' => tep_href_link(cfg('FILENAME_ARTICLES'))
        ),
        array(
            'code' => cfg('FILENAME_ARTICLES_CONFIG'),
            'title' => __('BOX_ARTICLES_CONFIG',_('Config')),
            'link' => tep_href_link(cfg('FILENAME_ARTICLES_CONFIG'))
        ),
        array(
            'code' => cfg('FILENAME_AUTHORS'),
            'title' => __('BOX_ARTICLES_AUTHORS',_('Authors')),
            'link' => tep_href_link(cfg('FILENAME_AUTHORS'))
        ),
        array(
            'code' =>  cfg('FILENAME_ARTICLES_BLOG_COMMENTS'),
            'title' => __('BOX_ARTICLES_BLOG_COMMENTS',_('Comments')),
            'link' => tep_href_link(cfg('FILENAME_ARTICLES_BLOG_COMMENTS'))
        ),
        array(
            'code' =>  cfg('FILENAME_ARTICLE_REVIEWS'),
            'title' => __('BOX_ARTICLES_REVIEWS',_('Reviews')),
            'link' => tep_href_link(cfg('FILENAME_ARTICLE_REVIEWS'))
        ),
        array(
            'code' =>  cfg('FILENAME_ARTICLES_XSELL'),
            'title' => __('BOX_ARTICLES_XSELL',_('xSell')),
            'link' => tep_href_link(cfg('FILENAME_ARTICLES_XSELL'))
        )
    )
);

