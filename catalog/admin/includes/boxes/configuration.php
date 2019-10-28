<?php

/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
 */

$cl_box_groups[] = array(
    'heading' => __('BOX_HEADING_CONFIGURATION', _('Configuration')),
    'apps' => array(
        array(
            'code' => cfg('FILENAME_ADMINISTRATORS'),
            'title' => __('BOX_CONFIGURATION_ADMINISTRATORS',_('Administrators')),
            'link' => tep_href_link(cfg('FILENAME_ADMINISTRATORS'))
        ),
        array(
            'code' => cfg('FILENAME_STORE_LOGO'),
            'title' => cfg('BOX_CONFIGURATION_STORE_LOGO'),
            'link' => tep_href_link(cfg('FILENAME_STORE_LOGO'))
        )
    )
);

$configuration_groups_query = tep_db_query("select configuration_group_id as cgID, configuration_group_title as cgTitle from " . cfg('TABLE_CONFIGURATION_GROUP') . " where visible = '1' order by sort_order");
while ($configuration_groups = tep_db_fetch_array($configuration_groups_query)) {
    $cl_box_groups[sizeof($cl_box_groups) - 1]['apps'][] = array(
        'code' => cfg('FILENAME_CONFIGURATION'),
        'title' => $configuration_groups['cgTitle'],
        'link' => tep_href_link(cfg('FILENAME_CONFIGURATION'),
                'gID=' . $configuration_groups['cgID'])
    );
}

