<?php

  /*
    $Id: cm_fp_carousel.php, v1.0.2 20160322 Kymation$

    osCommerce, Open Source E-Commerce Solutions
    http://www.oscommerce.com

    Copyright (c) 2016 James C Keebaugh

    Released under the GNU General Public License v2.0 or later
   */

  class cm_fp_carousel {
    public $version = '1.0.2';
    public $code;
    public $group;
    public $title;
    public $description;
    public $sort_order;
    public $enabled = false;

    public function __construct() {
      $this->code = get_class($this);
      $this->group = basename(dirname(__FILE__));

      $this->title = MODULE_CONTENT_FRONT_PAGE_CAROUSEL_TITLE;
      $this->description = MODULE_CONTENT_FRONT_PAGE_CAROUSEL_DESCRIPTION;

      if (defined('MODULE_CONTENT_FRONT_PAGE_CAROUSEL_STATUS')) {
        $this->sort_order = MODULE_CONTENT_FRONT_PAGE_CAROUSEL_SORT_ORDER;
        $this->enabled = (MODULE_CONTENT_FRONT_PAGE_CAROUSEL_STATUS == 'True');
      }
    }

    public function execute() {
      global $oscTemplate;
      
      $this->set_css();
      $this->set_javascript();

      $banners_data = $this->get_banner_data();
      if ( $banners_data !== false && count( $banners_data ) > 0 ) {
        
        ob_start();
        include(DIR_WS_MODULES . 'content/' . $this->group . '/templates/' . basename(__FILE__));
        $template = ob_get_clean();

        $oscTemplate->addContent($template, $this->group);
      }
    }

    public function isEnabled() {
      return $this->enabled;
    }

    public function check() {
      return defined('MODULE_CONTENT_FRONT_PAGE_CAROUSEL_STATUS');
    }

    public function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Module Version', 'MODULE_CONTENT_FRONT_PAGE_CAROUSEL_VERSION', '" . $this->version . "', 'The version of this module that you are running.', '6', '0', 'tep_cfg_disabled(', now() ) ");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Banner Rotator', 'MODULE_CONTENT_FRONT_PAGE_CAROUSEL_STATUS', 'True', 'Do you want to show the banner rotator?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_FRONT_PAGE_CAROUSEL_SORT_ORDER', '80', 'Sort order of display. Lowest is displayed first.', '6', '2', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Width', 'MODULE_CONTENT_FRONT_PAGE_CAROUSEL_CONTENT_WIDTH', '12', 'What width container should the content be shown in?', '6', '3', 'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Banner Order', 'MODULE_CONTENT_FRONT_PAGE_CAROUSEL_BANNER_ORDER', 'Asc', 'Order that the Banner Rotator uses to show the banners.', '6', '4', 'tep_cfg_select_option(array(\'Asc\', \'Desc\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Banner Rotator Group', 'MODULE_CONTENT_FRONT_PAGE_CAROUSEL_GROUP', 'rotator', 'Name of the banner group that the Banner Rotator uses to show the banners.', '6', '5', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Banner Rotator Max Banners', 'MODULE_CONTENT_FRONT_PAGE_CAROUSEL_MAX_DISPLAY', '4', 'Maximum number of banners that the Banner Rotator will show', '6', '6', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Align Banners', 'MODULE_CONTENT_FRONT_PAGE_CAROUSEL_ALIGN', 'center', 'Align the banners to the left, center, or right?', '6', '7', 'tep_cfg_select_option(array(\'left\', \'center\', \'right\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Automatic Carousel', 'MODULE_CONTENT_FRONT_PAGE_CAROUSEL_AUTOPLAY', 'true', 'Do you want the carousel to run automatically?', '6', '8', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Start Delay', 'MODULE_CONTENT_FRONT_PAGE_CAROUSEL_START_DELAY', '0', 'Delay the start of the carousel (1000 = 1 second).', '6', '9', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Hold Time', 'MODULE_CONTENT_FRONT_PAGE_CAROUSEL_HOLD_TIME', '4000', 'The time each banner is shown (1000 = 1 second).', '6', '10', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Transition Time', 'MODULE_CONTENT_FRONT_PAGE_CAROUSEL_TRANSITION_TIME', '500', 'The time to transition between banners (1000 = 1 second).', '6', '11', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Easing', 'MODULE_CONTENT_FRONT_PAGE_CAROUSEL_EASING', 'swing', 'How the carousel transitions between banners.', '6', '12', 'tep_cfg_pull_down_easing_list(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Loop Around', 'MODULE_CONTENT_FRONT_PAGE_CAROUSEL_LOOP', 'true', 'Do you want the carousel to start again after showing all of the banners?', '6', '13', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
      }

    public function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    public function keys() {
      $keys = array();
      $keys[] = 'MODULE_CONTENT_FRONT_PAGE_CAROUSEL_VERSION';
      $keys[] = 'MODULE_CONTENT_FRONT_PAGE_CAROUSEL_STATUS';
      $keys[] = 'MODULE_CONTENT_FRONT_PAGE_CAROUSEL_SORT_ORDER';
      $keys[] = 'MODULE_CONTENT_FRONT_PAGE_CAROUSEL_CONTENT_WIDTH';
      $keys[] = 'MODULE_CONTENT_FRONT_PAGE_CAROUSEL_BANNER_ORDER';
      $keys[] = 'MODULE_CONTENT_FRONT_PAGE_CAROUSEL_GROUP';
      $keys[] = 'MODULE_CONTENT_FRONT_PAGE_CAROUSEL_MAX_DISPLAY';
      $keys[] = 'MODULE_CONTENT_FRONT_PAGE_CAROUSEL_ALIGN';
      $keys[] = 'MODULE_CONTENT_FRONT_PAGE_CAROUSEL_AUTOPLAY';
      $keys[] = 'MODULE_CONTENT_FRONT_PAGE_CAROUSEL_START_DELAY';
      $keys[] = 'MODULE_CONTENT_FRONT_PAGE_CAROUSEL_HOLD_TIME';
      $keys[] = 'MODULE_CONTENT_FRONT_PAGE_CAROUSEL_TRANSITION_TIME';
      $keys[] = 'MODULE_CONTENT_FRONT_PAGE_CAROUSEL_EASING';
      $keys[] = 'MODULE_CONTENT_FRONT_PAGE_CAROUSEL_LOOP';
      return $keys;
    }

    private function get_banner_data() {
      $banner_query_raw = "
        select
          banners_id,
          banners_url,
          banners_image,
          banners_html_text
        from
          " . TABLE_BANNERS . "
        where
          banners_group = '" . MODULE_CONTENT_FRONT_PAGE_CAROUSEL_GROUP . "'
          and status = '1'
        order by 
          banners_id " . MODULE_CONTENT_FRONT_PAGE_CAROUSEL_BANNER_ORDER . "
        limit
          " . MODULE_CONTENT_FRONT_PAGE_CAROUSEL_MAX_DISPLAY;

      $banner_query = tep_db_query($banner_query_raw);

      if( tep_db_num_rows($banner_query) > 0 ) {
        $banners_data = array();
        while( $banners = tep_db_fetch_array($banner_query) ) {
          $banners_data[] = array(
            'banners_id' => $banners['banners_id'],
            'banners_url' => $banners['banners_url'],
            'banners_image' => $banners['banners_image'],
            'banners_html_text' => $banners['banners_html_text']
          );
        }
        return $banners_data;
      }
      return false;
    }
    
    private function set_css() {
      global $oscTemplate;
      
      // Set the CSS to load in the footer
      $add_css = '  <link rel="stylesheet" href="ext/jquery/slideshow/slideshow.css" />' . PHP_EOL;
      $add_css .= '  <style type="text/css">
        .slideshow {
          position: relative;
          width: 100%;
        }

        .slideshow .slide figure {
          position: relative;
          margin: 0;
        }

        .slideshow .slide figure img {
          width: 100%;
          vertical-align: top;
        }			

        .slideshow .slideTabs {
          text-align: center;
          position: absolute;
          bottom: 2%;
          width: 100%;
          z-index: 10;
        }

        .slideshow .slideTabs a {
          padding: 10px;				
          margin: 0 5px;	
          line-height: 2em;				
          background: url(images/slideshow/dot_white.png) no-repeat center center;
          opacity: 0.6;	
        }

        .slideshow .slideTabs a.selected {
          opacity: 1;		
        }	

        .slideshow .prev, 
        .slideshow .next {
          position: absolute;
          cursor: pointer;	
          padding: 10px 3px;
          background-color: rgba(0,0,0,0.1);
        }

        .slideshow .prev {
          left: 0;
        }
        
        .slideshow .next {
          right: 0;
			  }
	    </style>' . PHP_EOL;

      $oscTemplate->addBlock($add_css, 'footer_scripts');
    }
    
    private function set_javascript() {
      global $oscTemplate;
      
      // Set the JavaScript to load in the footer
      $add_scripts = '  <script src="ext/jquery/slideshow/jquery.easing.1.3.js"></script>' . PHP_EOL;
      $add_scripts .= '  <script src="ext/jquery/slideshow/jquery.imagesloaded.js"></script>' . PHP_EOL;
      $add_scripts .= '  <script src="ext/jquery/slideshow/slideshow.js"></script>' . PHP_EOL;
      $add_scripts .= '	 <script type="text/javascript">
        $(document).ready(function() {
          var slideshow_tabs = new Slideshow({
            align: \'' . MODULE_CONTENT_FRONT_PAGE_CAROUSEL_ALIGN . '\',
            id: \'rotator\',
            autoplay: ' . MODULE_CONTENT_FRONT_PAGE_CAROUSEL_AUTOPLAY . ',
            autoplay_start_delay: ' . MODULE_CONTENT_FRONT_PAGE_CAROUSEL_START_DELAY . ',
            displayTime: ' . MODULE_CONTENT_FRONT_PAGE_CAROUSEL_HOLD_TIME . ',
            transition_delay: ' . MODULE_CONTENT_FRONT_PAGE_CAROUSEL_TRANSITION_TIME . ',
            easing: \'' . MODULE_CONTENT_FRONT_PAGE_CAROUSEL_EASING . '\',
            loop: ' . MODULE_CONTENT_FRONT_PAGE_CAROUSEL_LOOP . ',
            loader_image: \'images/slideshow/loader.gif\'
				  });    
			  });
		  </script>' . PHP_EOL;
    $add_scripts .= '		<script type="text/javascript">
      window.onload = function() { 
        $(\'#rotator\').addClass("visible")
      }
		</script>' . PHP_EOL;
//       $(window).on("load",  $(\'#rotator\').addClass("visible")) ;

      $oscTemplate->addBlock($add_scripts, 'footer_scripts');
    }

  }// End class
 
  
  ////////////////////////////////////////////////////////////////////////////
  //                                                                        //
  //  This is the end of the module class.                                  //
  //  Everything past this point is an independent function, not a method.  //
  //                                                                        //
  ////////////////////////////////////////////////////////////////////////////


  ////
  // Function to show a disabled entry (Value is shown but cannot be changed)
  if (!function_exists('tep_cfg_disabled')) {

    function tep_cfg_disabled($value) {
      return tep_draw_input_field('configuration_value', $value, ' disabled');
    }

  }

	////
	// Generate a pulldown menu of the available easing methods
	if (!function_exists('tep_cfg_pull_down_easing_list')) {
		function tep_cfg_pull_down_easing_list( $easing_type, $key = '' ) {
      $name = ( ( $key ) ? 'configuration[' . $key . ']' : 'configuration_value' );

      $easing_array = array();
      $easing_array[] = array('id'=>'linear','text'=>'linear');
      $easing_array[] = array('id'=>'swing','text'=>'swing');
      $easing_array[] = array('id'=>'jswing','text'=>'jswing');
      $easing_array[] = array('id'=>'easeInQuad','text'=>'easeInQuad');
      $easing_array[] = array('id'=>'easeInCubic','text'=>'easeInCubic'); 
      $easing_array[] = array('id'=>'easeInQuart','text'=>'easeInQuart');
      $easing_array[] = array('id'=>'easeInQuint','text'=>'easeInQuint');
      $easing_array[] = array('id'=>'easeInSine','text'=>'easeInSine');
      $easing_array[] = array('id'=>'easeInExpo','text'=>'easeInExpo');
      $easing_array[] = array('id'=>'easeInCirc','text'=>'easeInCirc');
      $easing_array[] = array('id'=>'easeInElastic','text'=>'easeInElastic');
      $easing_array[] = array('id'=>'easeInBack','text'=>'easeInBack');
      $easing_array[] = array('id'=>'easeInBounce','text'=>'easeInBounce');
      $easing_array[] = array('id'=>'easeOutQuad','text'=>'easeOutQuad');
      $easing_array[] = array('id'=>'easeOutCubic','text'=>'easeOutCubic');
      $easing_array[] = array('id'=>'easeOutQuart','text'=>'easeOutQuart');
      $easing_array[] = array('id'=>'easeOutQuint','text'=>'easeOutQuint');
      $easing_array[] = array('id'=>'easeOutSine','text'=>'easeOutSine');
      $easing_array[] = array('id'=>'easeOutExpo','text'=>'easeOutExpo');
      $easing_array[] = array('id'=>'easeOutCirc','text'=>'easeOutCirc');
      $easing_array[] = array('id'=>'easeOutElastic','text'=>'easeOutElastic');
      $easing_array[] = array('id'=>'easeOutBack','text'=>'easeOutBack');
      $easing_array[] = array('id'=>'easeInOutQuad','text'=>'easeInOutQuad');
      $easing_array[] = array('id'=>'easeInOutCubic','text'=>'easeInOutCubic');
      $easing_array[] = array('id'=>'easeInOutQuart','text'=>'easeInOutQuart');
      $easing_array[] = array('id'=>'easeInOutQuint','text'=>'easeInOutQuint');
      $easing_array[] = array('id'=>'easeInOutSine','text'=>'easeInOutSine');
      $easing_array[] = array('id'=>'easeInOutCirc','text'=>'easeInOutCirc');
      $easing_array[] = array('id'=>'easeInOutCirc','text'=>'easeInOutCirc');
      $easing_array[] = array('id'=>'easeInOutElastic','text'=>'easeInOutElastic');
      $easing_array[] = array('id'=>'easeInOutBack','text'=>'easeInOutBack');
      $easing_array[] = array('id'=>'easeInOutBounce','text'=>'easeInOutBounce');

			return tep_draw_pull_down_menu( $name, $easing_array, $easing_type );
		}
	}
