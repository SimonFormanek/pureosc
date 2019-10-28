<?php

/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
 */

if (tep_session_is_registered('admin')) {
    $cl_box_groups = array();

    $boxesDir = constant('DIR_FS_ADMIN') . 'includes/boxes';


    if (is_dir($boxesDir)) {
        $dir = dir($boxesDir);
        if ($dir) {
            $files = array();

            while ($file = $dir->read()) {
                if (!is_dir($dir->path . '/' . $file)) {
                    if (substr($file, strrpos($file, '.')) == '.php') {
                        $files[] = $file;
                    }
                }
            }

            $dir->close();

            natcasesort($files);

            foreach ($files as $file) {
                if (file_exists(DIR_FS_ADMIN . 'includes/languages/' . $language . '/modules/boxes/' . $file)) {
                    include(DIR_FS_ADMIN . 'includes/languages/' . $language . '/modules/boxes/' . $file);
                }

                include($dir->path . '/' . $file);
            }
        }
    }

    function tep_sort_admin_boxes($a, $b) {
        return strcasecmp($a['heading'], $b['heading']);
    }

    usort($cl_box_groups, 'tep_sort_admin_boxes');

    function tep_sort_admin_boxes_links($a, $b) {
        return strcasecmp($a['title'], $b['title']);
    }

    foreach ($cl_box_groups as &$group) {
        usort($group['apps'], 'tep_sort_admin_boxes_links');
    }



    $boxesMenu = new \Ease\TWB\Navbar('boxmenu', '', ['id' => 'adminAppMenu', 'class' => 'navbar-fixed-bottom']);
    
    $searchForm = new \Ease\TWB\Form('menusearch', 'search.php', 'post', null, ['class' => 'navbar-form navbar-left', 'role' => 'search']);
    $searchForm->addItem(new \Ease\Html\DivTag(new \Ease\Html\InputSearchTag('navsearch', '', ['placeholder' => _('Search')]), ['class' => 'form-group']));
    $searchForm->addItem(new \Ease\TWB\SubmitButton( new \Ease\TWB\GlyphIcon('search') , 'default'));
    $boxesMenu->addMenuItem($searchForm);

    
    
    foreach ($cl_box_groups as $groups) {
        $apps = [];
        foreach ($groups['apps'] as $app) {
            $apps[$app['link']] = $app['title'];
        }
        $boxesMenu->addDropDownMenu($groups['heading'], $apps);
    }


    echo $boxesMenu;

    \Ease\WebPage::singleton()->addJavaScript('
$("#adminAppMenu").hover(function() {
  $( this ).css( "font-size", "large" );
}).mouseleave( function() {
  $( this ).css( "font-size", "small" );
} ); ');
}    
