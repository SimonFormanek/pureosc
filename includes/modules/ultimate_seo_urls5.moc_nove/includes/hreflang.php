<?php

  class FWR_hreflang {

    protected $page;
    protected $mode;
    protected $get;
    protected $lng;
    protected $language;
    protected $root_path;
    protected $language_image_width = '24';
    protected $language_image_height = '15';
    protected $session_started;
    protected $language_code_array = array();
    protected $links_icons;
    protected $links_list;
    protected $alternate_hreflang;
    protected $lang_array;

    public function __construct( navigationHistory $navigation, $language, $lng = false, $session_started = false ) {
      $navigation_data = array_pop( $navigation->path );
      $this->page = $navigation_data['page'];
      $this->mode = $navigation_data['mode'];
      $this->get =  $navigation_data['get'];
      $this->setLanguage( $lng );
      $this->language = $language;
      $this->root_path = realpath( dirname( __FILE__ ) . '/../../' ) . '/';
      $this->session_started = $session_started;
      $this->getLanguageSelectionHtml();
    }

    // Returns an unordered list of links to the
    public function __toString() {
      return $this->links_icons;
    }
    // Returns an array containing data of all alternate languages (other than current language)
    public function lang_array() {
      return $this->lang_array;
    }
    // Returns an array containing data of all alternate languages (other than current language)
    public function links_list() {
      return $this->links_list;
    }
    public function hreflang_tags() {
    // Returns a string containing all the hreflang tags pertinent to this page (other than current language)
      return $this->alternate_hreflang;
    }

    protected function setLanguage( $lng ) {
      if ( ( false === $lng ) || ( !$lng instanceof language ) ) {
        include_once 'includes/classes/language.php';
        $this->lng = new language();
        $this->setLanguageArray();
        return $this->lng;
      }
      $this->lng = $lng;
      $this->setLanguageArray();
    }

    protected function setLanguageArray() {
      foreach ( $this->lng->catalog_languages as $code => $unused ) {
        $this->language_code_array[] = $code;
      }
    }

    protected function getLanguageSelectionHtml() {
      global $languages_id,$language;
      $alternate = $links_icons = $links_list = "";
      $output = '<ul style="list-style-type:none; padding:0; margin:0;">';
      foreach ( $this->lng->catalog_languages as $code => $data ) {

        // Sets USU language to the current selection
        Usu_Main::i()->initiate( array(), $data['id'],  $data['directory'], true );

        $language_image_path = 'includes/languages/' . $data['directory'] . '/images/icon.gif';
        if ( $data['directory'] == $this->language ) continue;

        $this_link= $this->buildLink( $default = ( $code === DEFAULT_LANGUAGE ), $code );

        $hr [$data['id']]['id']=$data['id'];
        $hr [$data['id']]['name']=$data['name'];
        $hr [$data['id']]['image']=$data['image'];
        $hr [$data['id']]['directory']=$data['directory'];
        $hr [$data['id']]['href']=$this_link ;

        $alternate .= '<link rel="alternate" hreflang="' . $code . '" href="' . $this_link . '" />' . PHP_EOL;
        $links_icons .= ' <a href="' . $this_link . '">' . tep_image($language_image_path, $data['name'], NULL, NULL, NULL, false) . '</a>';
        $links_list .= '      <li style="display:inline;"><a href="' . $this_link . '">' . tep_image($language_image_path, $data['name'], NULL, NULL, NULL, false) . '&nbsp;' . $data['name'] . '</a></li>' . PHP_EOL;
      }
      $this->links_list = $links_list;
      $this->links_icons = $links_icons;
      $this->alternate_hreflang = $alternate;
      $this->lang_array =$hr;
        // Resets USU language to the current language for the rest of the links on the page
      Usu_Main::i()->initiate( array(), $languages_id, $language, true );
    }

    protected function buildLink($default = false, $code ) {
      if ( false === $this->session_started ) {
        return  $this->multiLanguage( tep_href_link( 'index.php', '', 'NONSSL' ), $default, $code );
      }
      return $this->multiLanguage( tep_href_link( $this->page, $this->getQuery(), $this->mode ), $default, $code );
    }

    protected function getQuery() {
      if ( tep_not_null( $this->get ) ) {
        if ( array_key_exists( tep_session_name(), $this->get ) ) {
          unset( $this->get[tep_session_name()] );
        }
        return http_build_query( $this->get );
      }
      return '';
    }

    protected function removeQueryString( $target ) {
      if ( false === strpos( $target, '?' ) ) {
        return $target;
      }
      return substr( $target, 0, strpos( $target, '?' ) );
    }

    protected function removeLanguageMarkers( $target, $cookie_path ) {
      $return = preg_replace( '@' . $cookie_path . '(' . implode( '|', $this->language_code_array ) . ')/@', $cookie_path, $target );
      $return = preg_replace( '@' . $this->page . '/(' . implode( '|', $this->language_code_array ) . ')@', $this->page, $return );
      return $return;
    }

    protected function multiLanguage( $link, $default, $code ) {
      $server = ( $this->mode == 'NONSSL' ) ? HTTP_SERVER : HTTPS_SERVER;
      $cookie_path = ( $this->mode == 'NONSSL' ) ? HTTP_COOKIE_PATH : HTTPS_COOKIE_PATH;
      $server = $server . $cookie_path;
      $link = $this->removeLanguageMarkers( $link, $cookie_path );
      if ( false !== $default ) {
        $no_querystring = $this->removeQueryString( $link );
        // Is the page FILENAME_DEFAULT and after the querystring is removed is FILENAME_DEFAULT the ending characters of the URL, if so we chop it off leaving just the domain
        if ( ( $this->page == 'index.php' ) && ( substr( $no_querystring, ( strlen( $no_querystring ) - strlen( $this->page ) ), strlen( $no_querystring ) ) == $this->page ) ) {
          return str_replace( $this->page, '', $link );
        }
        return $link;
      }
      // If the .php filename is present in the link
      if ( false !== strpos( $link, $this->page ) ) {
        return str_replace( $this-> page, $this->page . '/' . $code, $link );
      }
      return str_replace( $server, $server . $code . '/', $link );
    }

  }