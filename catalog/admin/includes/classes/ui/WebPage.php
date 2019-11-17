<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PureOSC\Admin\ui;

/**
 * Description of WebPage
 *
 * @author vitex
 */
class WebPage extends \Ease\TWB\WebPage {
    /**
     * Saves obejct instace (singleton...).
     */
    private static $instance = null;

    /**
     *
     * @var   \Ease\TWB\Container
     */
    public $container = null;
    
    
    public function __construct($pageTitle = null) {
        parent::__construct($pageTitle);
        $this->addItem($this->getTopMenu());
        $this->container = $this->addItem( new \Ease\TWB\Container() );
    }

    public function finalize() {
        $this->addItem($this->getBottomMenu());
        parent::finalize();
    }

    public function getTopMenu() {
        $pageTop = new \Ease\TWB\Navbar('topmenu', new \Ease\Html\ImgTag(cfg('DIR_WS_IMAGES') . 'store_logo.png', _('Store logo'), ['height' => 20]), ['class' => 'navbar-inverse']);

        $pageTop->addMenuItem(new \Ease\TWB\LinkButton('./', _('Administration'), 'inverse'));

        $pageTop->addMenuItem(new \Ease\TWB\LinkButton('..', _('Catalog'), 'inverse'));

        $pageTop->addMenuItem(new \Ease\TWB\LinkButton('static_generator_reset.php', _('Static generator reset'), 'inverse'));

        if (array_key_exists('admin', $_SESSION)) {

            if (cfg('USE_FLEXIBEE')) {
                $pageTop->addMenuItem(new \FlexiPeeHP\ui\TWB\StatusInfoBox(), 'right');
            }

            $pageTop->addDropDownMenu(sprintf(_('Logged in as: %s'), $_SESSION['admin']['username']), [cfg('FILENAME_LOGIN') . '?action=logoff' => _('Logoff')], 'right');
        }

        return $pageTop;
    }

    public function getBottomMenu() {
        $cl_box_groups = array();
// initialize configuration modules
        $cfgModules = new \cfg_modules();
        $boxesDir = cfg('DIR_FS_ADMIN') . 'includes/boxes';
        $language = $_SESSION['language'];

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
                    if (file_exists(cfg('DIR_FS_ADMIN') . 'includes/languages/' . $language . '/modules/boxes/' . $file)) {
                        include(cfg('DIR_FS_ADMIN') . 'includes/languages/' . $language . '/modules/boxes/' . $file);
                    }
                    if (file_exists($dir->path . '/' . $file)) {
                        include($dir->path . '/' . $file);
                    }
                }
            }
        }

        usort($cl_box_groups, [$this, 'tep_sort_admin_boxes']);

        foreach ($cl_box_groups as &$group) {
            usort($group['apps'], [$this, 'tep_sort_admin_boxes_links']);
        }

        $boxesMenu = new \Ease\TWB\Navbar('boxmenu', '', ['id' => 'adminAppMenu', 'class' => 'navbar-fixed-bottom']);

        $searchForm = new \Ease\TWB\Form('menusearch', 'search.php', 'post', null, ['class' => 'navbar-form navbar-left', 'role' => 'search']);
        $searchForm->addItem(new \Ease\Html\DivTag(new \Ease\Html\InputSearchTag('navsearch', \Ease\WebPage::getRequestValue('navsearch'), ['placeholder' => _('Search')]), ['class' => 'form-group']));
        $searchForm->addItem(new \Ease\TWB\SubmitButton(new \Ease\TWB\GlyphIcon('search'), 'default'));
        $boxesMenu->addMenuItem($searchForm);



        foreach ($cl_box_groups as $groups) {
            $apps = [];
            foreach ($groups['apps'] as $app) {
                $apps[$app['link']] = $app['title'];
            }
            $boxesMenu->addDropDownMenu($groups['heading'], $apps);
        }

        $this->addJavaScript('
$("#adminAppMenu").hover(function() {
  $( this ).css( "font-size", "large" );
}).mouseleave( function() {
  $( this ).css( "font-size", "small" );
} ); ');

        return $boxesMenu;
    }

    public static function tep_sort_admin_boxes($a, $b) {
        return strcasecmp($a['heading'], $b['heading']);
    }

    public static function tep_sort_admin_boxes_links($a, $b) {
        return strcasecmp($a['title'], $b['title']);
    }

    /**
     * @return WebPage
     */
    public static function singleton($webPage = null)
    {
        if (!isset(self::$instance)) {
            self::$instance = is_object($webPage) ? $webPage : new self();
        }
        return self::$instance;
    }
}
