<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
 */

$cl_box_groups[] = array(
    'heading' => __('BOX_HEADING_GV_ADMIN',_('GV Admin')) ,
    'apps' => array(
        array(
            'code' => cfg('FILENAME_COUPON_ADMIN'),
            'title' => __('BOX_COUPON_ADMIN',_('Coupoun Admin')),
            'link' => tep_href_link( cfg('FILENAME_COUPON_ADMIN'))
        ),
        array(
            'code' =>  cfg('FILENAME_GV_QUEUE'),
            'title' => __('BOX_GV_ADMIN_QUEUE',_('Admin Queue')),
            'link' => tep_href_link( cfg('FILENAME_GV_QUEUE'))
        ),
        array(
            'code' =>  cfg('FILENAME_GV_MAIL'),
            'title' => __('BOX_GV_ADMIN_MAIL',_('Admin Email')),
            'link' => tep_href_link( cfg('FILENAME_GV_MAIL'))
        ),
        array(
            'code' =>  cfg('FILENAME_GV_SENT'),
            'title' => __('BOX_GV_ADMIN_SENT',_('Sent')),
            'link' => tep_href_link( cfg('FILENAME_GV_SENT'))
        )
    )
);

