<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
 */

$cl_box_groups[] = array(
    'heading' => __('BOX_HEADING_AAS',_('AAS')),
    'apps' => array(
        array(
            'code' => cfg('FILENAME_AAS'),
            'title' => '<b>'.__('BOX_AAS_ACCESS_AAS',_('Access AAS')).'</b>',
            'link' => tep_href_link(cfg('FILENAME_AAS'))
        ),
        array(
            'code' => cfg('FILENAME_AAS'),
            'title' => __('BOX_AAS_SUPPORT',_('ASS support')),
            'link' => 'http://www.alternative-administration-system.com/support'
        ),
        array(
            'code' => cfg('FILENAME_AAS'),
            'title' => __('BOX_AAS_DISCUSSION_BOARD',_('Discussion board')),
            'link' => 'http://www.alternative-administration-system.com/discussion-board'
        ),
        array(
            'code' => cfg('FILENAME_AAS'),
            'title' => __('BOX_AAS_DONATIONS',_('Donations')),
            'link' => 'http://www.alternative-administration-system.com/donations'
        )
    )
);

