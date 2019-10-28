<?php
/*
  Module: Information Pages Unlimited
  File date: 2007/02/17
  Based on the FAQ script of adgrafics
  Adjusted by Joeri Stegeman (joeri210 at yahoo.com), The Netherlands
  Modified by SLiCK_303@hotmail.com for OSC v2.3.1

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
 */

$cl_box_groups[] = array(
    'heading' => __('BOX_HEADING_INFORMATION',_('Information')),
    'apps' => array()
);

$information_groups_query = tep_db_query("SELECT information_group_id AS igID, information_group_title AS igTitle FROM ".cfg('TABLE_INFORMATION_GROUP')." WHERE visible='1' ORDER BY sort_order");
while ($information_groups       = tep_db_fetch_array($information_groups_query)) {
    $cl_box_groups[sizeof($cl_box_groups) - 1]['apps'][] = array(
        'code' => cfg('FILENAME_INFORMATION_MANAGER'),
        'title' => $information_groups['igTitle'],
        'link' => tep_href_link(cfg('FILENAME_INFORMATION_MANAGER'),
            'gID='.$information_groups['igID'])
    );
}

