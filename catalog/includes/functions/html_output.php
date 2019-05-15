<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Edited by 2014 Newburns Design and Technology
 * ************************************************
 * *********** New addon definitions **************
 * ***********        Below          **************
 * ************************************************
  KISS Image Thumbnailer added -- http://addons.oscommerce.com/info/8492

  Released under the GNU General Public License
 */

/**
 * The HTML href link wrapper function ORIGINAL (unmodified)
 * 
 * @global string  $request_type
 * @global boolean $session_started
 * @global string  $SID
 * 
 * @param string  $page
 * @param string  $parameters
 * @param string  $connection
 * @param boolean $add_session_id
 * @param boolean $search_engine_safe
 * 
 * @return string
 */
function tep_href_link_original($page = '', $parameters = '',
                                $connection = 'NONSSL', $add_session_id = true,
                                $search_engine_safe = true)
{
    global $request_type, $session_started;

    $page = tep_output_string($page);

    if (!tep_not_null($page)) {
        die('</td></tr></table></td></tr></table><br /><br /><font color="#ff0000"><strong>Error!</strong></font><br /><br /><strong>Unable to determine the page link!<br /><br />');
    }

    if ($connection == 'NONSSL') {
        $link = HTTP_SERVER.DIR_WS_HTTP_CATALOG;
    } elseif ($connection == 'SSL') {
        if (ENABLE_SSL === true) {
            $link = HTTPS_SERVER.DIR_WS_HTTPS_CATALOG;
        } else {
            $link = HTTP_SERVER.DIR_WS_HTTP_CATALOG;
        }
    } else {
        die('</td></tr></table></td></tr></table><br /><br /><font color="#ff0000"><strong>Error!</strong></font><br /><br /><strong>Unable to determine connection method on a link!<br /><br />Known methods: NONSSL SSL</strong><br /><br />');
    }

    if (tep_not_null($parameters)) {
        $link      .= $page.'?'.tep_output_string($parameters);
        $separator = '&';
    } else {
        $link      .= $page;
        $separator = '?';
    }

    while ((substr($link, -1) == '&') || (substr($link, -1) == '?'))
        $link = substr($link, 0, -1);

// Add the session ID when moving from different HTTP and HTTPS servers, or when SID is defined
    if (($add_session_id === true) && ($session_started === true) && (SESSION_FORCE_COOKIE_USE
        == 'False')) {
        if (tep_not_null($SID)) {
            $_sid = $SID;
        } elseif (( ($request_type == 'NONSSL') && ($connection == 'SSL') && (ENABLE_SSL
            === true) ) || ( ($request_type == 'SSL') && ($connection == 'NONSSL') )) {
            if (HTTP_COOKIE_DOMAIN != HTTPS_COOKIE_DOMAIN) {
                $_sid = tep_session_name().'='.tep_session_id();
            }
        }
    }

    if (isset($_sid)) {
        $link .= $separator.tep_output_string($_sid);
    }

    while (strpos($link, '&&') !== false)
        $link = str_replace('&&', '&', $link);

    if ((SEARCH_ENGINE_FRIENDLY_URLS == 'true') && ($search_engine_safe === true)) {
        $link = str_replace('?', '/', $link);
        $link = str_replace('&', '/', $link);
        $link = str_replace('=', '/', $link);
    } else {
        $link = str_replace('&', '&amp;', $link);
    }

    return $link;
}

/**
 * The HTML href link wrapper function
 * 
 * @global SEO_URL $seo_urls
 * @global int $languages_id
 * 
 * @param string  $page
 * @param string  $parameters
 * @param string  $connection
 * @param boolean $add_session_id
 * @param boolean $search_engine_safe
 * 
 * @return string
 */
function tep_href_link($page = '', $parameters = '', $connection = 'NONSSL',
                       $add_session_id = true, $search_engine_safe = true)
{
    global $seo_urls, $languages_id;
    if (!is_object($seo_urls)) {



        global $languages_id;
        $seo_urls = new SEO_URL($languages_id);
    }
    if ($page == constant('FILENAME_PRODUCT_INFO') && defined('PRODUCTS_CANONICAL_TYPE')
        && constant('PRODUCTS_CANONICAL_TYPE') == 'manufacturer') {
        preg_match('~products_id=(\d+)~', $parameters, $myid);
        $products_id              = str_replace('products_id=', '', $myid[0]);
        $manufacturers_id_query   = tep_db_query("SELECT manufacturers_id FROM ".TABLE_PRODUCTS." WHERE products_id=".$products_id);
        $manufacturers_id         = tep_db_fetch_array($manufacturers_id_query);
        $manufacturers_name_query = tep_db_query("SELECT manufacturers_name from ".TABLE_MANUFACTURERS." WHERE manufacturers_id = ".$manufacturers_id['manufacturers_id']);
        $manufacturers_name       = tep_db_fetch_array($manufacturers_name_query);
        $manufacturer             = preg_replace('/(-[a-z])*$/', '',
            remove_accents($manufacturers_name['manufacturers_name']));
        $newlink                  = '/'.$manufacturer.'/'.preg_replace('~.*/~',
                '',
                preg_replace('~.*xslashx~', '',
                    $seo_urls->href_link($page, $parameters, $connection,
                        $add_session_id)));
    } else {
        $newlink = preg_replace('~.*/~', '/',
            preg_replace('~.*xslashx~', '/',
                $seo_urls->href_link($page, $parameters, $connection,
                    $add_session_id)));
    }
    //ORIG:   return $seo_urls->href_link($page, $parameters, $connection, $add_session_id);
    return str_replace('xslashx', '/',
        preg_replace('/-[p|c|m|pi|a|au|by|f|fc|fri|fra|i|links|n|nc|nri|nra|pm|po|pr|pri|t]-[0-9|_]*\.html/',
            '', $newlink
    ));
}

////
// The HTML image wrapper function
/* * * Altered for KISS Image Thumbnailer **
  function tep_image($src, $alt = '', $width = '', $height = '', $parameters = '', $responsive = true, $bootstrap_css = '') {
 */
// New HTML image wrapper function modified for KISS Image Thumbnailer by FWR Media
function tep_image($src, $alt = '', $width = '', $height = '', $parameters = '',
                   $responsive = true, $bootstrap_css = '')
{
    // Include the Database installation file if executed for the first time.
    if (!defined('KISSIT_THUMBS_MAIN_DIR'))
            require_once DIR_WS_MODULES.'kiss_image_thumbnailer/db_install.php';
    // If width and height are not numeric then we can't do anything with it
    if (!is_numeric($width) || !is_numeric($height)) {
        return tep_image_legacy($src, $alt, $width, $height, $parameters,
            $responsive, $bootstrap_css);
    }

    if (strstr($src, '.svg')) {
        $image_assembled = '<img src="'.$src.'" class="img-responsive">';
    } else {

        // Create thumbs sub dirs and .htaccess.	
        $thumbs_dir_path  = str_replace(DIR_WS_IMAGES,
            DIR_WS_IMAGES.KISSIT_THUMBS_MAIN_DIR.$width.'_'.$height.'/',
            dirname($src).'/');
        $thumbs_dir       = '';
        $thumbs_dir_paths = explode("/", $thumbs_dir_path);
        for ($i = 0, $n = sizeof($thumbs_dir_paths); $i < $n; $i++) {
            $thumbs_dir .= $thumbs_dir_paths[$i].'/';
            if (!is_dir($thumbs_dir)) {
                if (!mkdir($thumbs_dir, 0777)) {
                    echo $thumbs_dir;
                }
            }
            // create .htacces protection like in main image dir
            if (($i == $n - 1) && (!is_file($thumbs_dir.'.htaccess'))) {
                $hpname  = $thumbs_dir.'.htaccess';
                //define .htaccess content
                $htacces = '
<FilesMatch "\.(php([0-9]|s)?|s?p?html|cgi|pl|exe)$">
   Order Deny,Allow
   Deny from all
</FilesMatch>';
                if ($hp      = fopen($hpname, 'w')) {
                    fwrite($hp, $htacces);
                    fclose($hp);
                }
            }
        } // end for
        // End create subdirectory and .htaccess.	


        $attributes = array('alt' => $alt, 'width' => $width, 'height' => $height);
        $image      = '';
        if (tep_not_null($width) && tep_not_null($height)) {
            $image .= ' width="'.tep_output_string($width).'" height="'.tep_output_string($height).'"';
        }

        $bs_parameters = ' class="';

        if (tep_not_null($responsive) && ($responsive === true)) {
            $bs_parameters .= 'img-responsive';
        }

        if (tep_not_null($bootstrap_css)) $bs_parameters .= ' '.$bootstrap_css;

        $bs_parameters .= '"';

        if (tep_not_null($parameters)) {
            $bs_parameters .= ' '.$parameters;
        }

        $imager          = new Image_Helper(array('src' => $src,
            'attributes' => $attributes,
            'parameters' => $bs_parameters,
            'default_missing_image' => DIR_WS_IMAGES.'no_image_available_150_150.gif',
            'isXhtml' => true,
            'thumbs_dir_path' => $thumbs_dir_path,
            'thumb_quality' => 75,
            'thumb_background_rgb' => array('red' => 255,
                'green' => 255,
                'blue' => 255)));
        if (false === $image_assembled = $imager->assemble()) {
            return tep_image_legacy($src, $alt, $width, $height, $parameters,
                $responsive, $bootstrap_css);
        }
    }


    return $image_assembled;
}

// end function
////
// The HTML image wrapper function
function tep_image_legacy($src, $alt = '', $width = '', $height = '',
                          $parameters = '', $responsive = true,
                          $bootstrap_css = '')
{
    /*     * * EOF Alteration for KISS Image Thumbnailer ** */

    if ((empty($src) || ($src == DIR_WS_IMAGES)) && (IMAGE_REQUIRED == 'false')) {
        return false;
    }

// alt is added to the img tag even if it is null to prevent browsers from outputting
// the image filename as default
    $image = '<img src="'.tep_output_string($src).'" alt="'.tep_output_string($alt).'"';

    if (tep_not_null($alt)) {
        $image .= ' title="'.tep_output_string($alt).'"';
    }

    if ((CONFIG_CALCULATE_IMAGE_SIZE == 'true') && (empty($width) || empty($height))) {
        if ($image_size = @getimagesize($src)) {
            if (empty($width) && tep_not_null($height)) {
                $ratio = $height / $image_size[1];
                $width = (int) ($image_size[0] * $ratio);
            } elseif (tep_not_null($width) && empty($height)) {
                $ratio  = $width / $image_size[0];
                $height = (int) ($image_size[1] * $ratio);
            } elseif (empty($width) && empty($height)) {
                $width  = $image_size[0];
                $height = $image_size[1];
            }
        } elseif (IMAGE_REQUIRED == 'false') {
            return false;
        }
    }

    if (tep_not_null($width) && tep_not_null($height)) {
        $image .= ' width="'.tep_output_string($width).'" height="'.tep_output_string($height).'"';
    }

    $image .= ' class="';

    if (tep_not_null($responsive) && ($responsive === true)) {
        $image .= 'img-responsive';
    }

    if (tep_not_null($bootstrap_css)) $image .= ' '.$bootstrap_css;

    $image .= '"';

    if (tep_not_null($parameters)) $image .= ' '.$parameters;

    $image .= ' />';

    return $image;
}

////
// The HTML form submit button wrapper function
// Outputs a button in the selected language
function tep_image_submit($image, $alt = '', $parameters = '')
{
    global $language;

    $image_submit = '<input type="image" src="'.tep_output_string(DIR_WS_LANGUAGES.$language.'/images/buttons/'.$image).'" alt="'.tep_output_string($alt).'"';

    if (tep_not_null($alt))
            $image_submit .= ' title=" '.tep_output_string($alt).' "';

    if (tep_not_null($parameters)) $image_submit .= ' '.$parameters;

    $image_submit .= ' />';

    return $image_submit;
}

////
// Output a function button in the selected language
function tep_image_button($image, $alt = '', $parameters = '')
{
    global $language;

    return tep_image(DIR_WS_LANGUAGES.$language.'/images/buttons/'.$image, $alt,
        '', '', $parameters);
}

////
// Output a separator either through whitespace, or with an image
function tep_draw_separator($image = 'pixel_black.gif', $width = '100%',
                            $height = '1')
{
    return tep_image(DIR_WS_IMAGES.$image, '', $width, $height);
}

////
// Output a form
function tep_draw_form($name, $action, $method = 'post', $parameters = '',
                       $tokenize = false)
{
    global $sessiontoken;

    $form = '<form name="'.tep_output_string($name).'" action="'.tep_output_string($action).'" method="'.tep_output_string($method).'"';

    if (tep_not_null($parameters)) $form .= ' '.$parameters;

    $form .= '>';

    if (($tokenize === true) && isset($sessiontoken)) {
        $form .= '<input type="hidden" name="formid" value="'.tep_output_string($sessiontoken).'" />';
    }

    return $form;
}

////
// Output a form input field
function tep_draw_input_field($name, $value = '', $parameters = '',
                              $type = 'text', $reinsert_value = true,
                              $class = 'class="form-control"')
{
    global $_GET, $_POST;

    $field = '<input type="'.tep_output_string($type).'" name="'.tep_output_string($name).'"';

    if (($reinsert_value === true) && ( (isset($_GET[$name]) && is_string($_GET[$name]))
        || (isset($_POST[$name]) && is_string($_POST[$name])) )) {
        if (isset($_GET[$name]) && is_string($_GET[$name])) {
            $value = stripslashes($_GET[$name]);
        } elseif (isset($_POST[$name]) && is_string($_POST[$name])) {
            $value = stripslashes($_POST[$name]);
        }
    }

    if (tep_not_null($value)) {
        $field .= ' value="'.tep_output_string($value).'"';
    }

    if (tep_not_null($parameters)) $field .= ' '.$parameters;

    if (tep_not_null($class)) $field .= ' '.$class;

    $field .= ' />';

    return $field;
}
/*
  ////
  // Output a form password field
  // DEPRECATED AS OF 12 June 2015
  function tep_draw_password_field($name, $value = '', $parameters = '') {
  return tep_draw_input_field($name, $value, $parameters, 'password', false);
  }
 */

////
// Output a selection field - alias function for tep_draw_checkbox_field() and tep_draw_radio_field()
function tep_draw_selection_field($name, $type, $value = '', $checked = false,
                                  $parameters = '')
{
    global $_GET, $_POST;

    $selection = '<input type="'.tep_output_string($type).'" name="'.tep_output_string($name).'"';

    if (tep_not_null($value))
            $selection .= ' value="'.tep_output_string($value).'"';

    if (($checked === true) || (isset($_GET[$name]) && is_string($_GET[$name]) && (($_GET[$name]
        == 'on') || (stripslashes($_GET[$name]) == $value))) || (isset($_POST[$name])
        && is_string($_POST[$name]) && (($_POST[$name] == 'on') || (stripslashes($_POST[$name])
        == $value)))) {
        $selection .= ' checked="checked"';
    }

    if (tep_not_null($parameters)) $selection .= ' '.$parameters;

    $selection .= ' />';

    return $selection;
}

////
// Output a form checkbox field
function tep_draw_checkbox_field($name, $value = '', $checked = false,
                                 $parameters = '')
{
    return tep_draw_selection_field($name, 'checkbox', $value, $checked,
        $parameters);
}

////
// Output a form radio field
function tep_draw_radio_field($name, $value = '', $checked = false,
                              $parameters = '')
{
    return tep_draw_selection_field($name, 'radio', $value, $checked,
        $parameters);
}

////
// Output a form textarea field
// The $wrap parameter is no longer used in the core xhtml template
function tep_draw_textarea_field($name, $wrap, $width, $height, $text = '',
                                 $parameters = '', $reinsert_value = true)
{
    global $_GET, $_POST;

    $field = '<textarea class="form-control" name="'.tep_output_string($name).'" cols="'.tep_output_string($width).'" rows="'.tep_output_string($height).'"';

    if (tep_not_null($parameters)) $field .= ' '.$parameters;

    $field .= '>';

    if (($reinsert_value === true) && ( (isset($_GET[$name]) && is_string($_GET[$name]))
        || (isset($_POST[$name]) && is_string($_POST[$name])) )) {
        if (isset($_GET[$name]) && is_string($_GET[$name])) {
            $field .= tep_output_string_protected(stripslashes($_GET[$name]));
        } elseif (isset($_POST[$name]) && is_string($_POST[$name])) {
            $field .= tep_output_string_protected(stripslashes($_POST[$name]));
        }
    } elseif (tep_not_null($text)) {
        $field .= tep_output_string_protected($text);
    }

    $field .= '</textarea>';

    return $field;
}

////
// Output a form hidden field
function tep_draw_hidden_field($name, $value = '', $parameters = '')
{
    global $_GET, $_POST;

    $field = '<input type="hidden" name="'.tep_output_string($name).'"';

    if (tep_not_null($value)) {
        $field .= ' value="'.tep_output_string($value).'"';
    } elseif ((isset($_GET[$name]) && is_string($_GET[$name])) || (isset($_POST[$name])
        && is_string($_POST[$name]))) {
        if ((isset($_GET[$name]) && is_string($_GET[$name]))) {
            $field .= ' value="'.tep_output_string(stripslashes($_GET[$name])).'"';
        } elseif ((isset($_POST[$name]) && is_string($_POST[$name]))) {
            $field .= ' value="'.tep_output_string(stripslashes($_POST[$name])).'"';
        }
    }

    if (tep_not_null($parameters)) $field .= ' '.$parameters;

    $field .= ' />';

    return $field;
}

////
// Hide form elements
function tep_hide_session_id()
{
    global $session_started, $SID;

    if (($session_started === true) && tep_not_null($SID)) {
        return tep_draw_hidden_field(tep_session_name(), tep_session_id());
    }
}

////
// Output a form pull down menu
function tep_draw_pull_down_menu($name, $values, $default = '',
                                 $parameters = '', $required = false)
{
    global $_GET, $_POST;

    $field = '<select name="'.tep_output_string($name).'"';

    if (tep_not_null($parameters)) $field .= ' '.$parameters;

    $field .= ' class="form-control">';

    if (empty($default) && ( (isset($_GET[$name]) && is_string($_GET[$name])) || (isset($_POST[$name])
        && is_string($_POST[$name])) )) {
        if (isset($_GET[$name]) && is_string($_GET[$name])) {
            $default = stripslashes($_GET[$name]);
        } elseif (isset($_POST[$name]) && is_string($_POST[$name])) {
            $default = stripslashes($_POST[$name]);
        }
    }

    for ($i = 0, $n = sizeof($values); $i < $n; $i++) {
        $field .= '<option value="'.tep_output_string($values[$i]['id']).'"';
        if ($default == $values[$i]['id']) {
            $field .= ' selected="selected"';
        }

        $field .= '>'.tep_output_string($values[$i]['text'],
                array('"' => '&quot;', '\'' => '&#039;', '<' => '&lt;', '>' => '&gt;')).'</option>';
    }
    $field .= '</select>';

    if ($required === true) $field .= TEXT_FIELD_REQUIRED;

    return $field;
}

////
// Creates a pull-down list of countries
function tep_get_country_list($name, $selected = '', $parameters = '')
{
    if (strlen($selected) == 0) $selected        = STORE_COUNTRY;
    $countries_array = array(array('id' => '', 'text' => PULL_DOWN_DEFAULT));
    $countries       = tep_get_countries();

    for ($i = 0, $n = sizeof($countries); $i < $n; $i++) {
        $countries_array[] = array('id' => $countries[$i]['countries_id'], 'text' => $countries[$i]['countries_name']);
    }

    return tep_draw_pull_down_menu($name, $countries_array, $selected,
        $parameters);
}

////
// Output a jQuery UI Button
function tep_draw_button($title = null, $icon = null, $link = null,
                         $priority = null, $params = null, $style = null)
{
    static $button_counter = 1;

    $types = array('submit', 'button', 'reset');

    if (!isset($params['type'])) {
        $params['type'] = 'submit';
    }

    if (!in_array($params['type'], $types)) {
        $params['type'] = 'submit';
    }

    if (($params['type'] == 'submit') && isset($link)) {
        $params['type'] = 'button';
    }

    if (!isset($priority)) {
        $priority = 'secondary';
    }

    $button = NULL;

    if (($params['type'] == 'button') && isset($link)) {
        $button .= '<a id="btn'.$button_counter.'" href="'.$link.'"';

        if (isset($params['newwindow'])) {
            $button .= ' target="_blank"';
        }
    } else {
        $button .= '<button ';
        $button .= ' type="'.tep_output_string($params['type']).'"';
    }

    if (isset($params['params'])) {
        $button .= ' '.$params['params'];
    }

    $button .= ' class="btn ';

    $button .= (isset($style)) ? $style : 'btn-default';

    $button .= '">';

    if (isset($icon) && tep_not_null($icon)) {
        $button .= ' <span class="'.$icon.'"></span> ';
    }

    $button .= $title;

    if (($params['type'] == 'button') && isset($link)) {
        $button .= '</a>';
    } else {
        $button .= '</button>';
    }

    $button_counter++;

    return $button;
}

// review stars
function tep_draw_stars($rating = 0, $meta = false)
{
    $stars = str_repeat('<span class="fa fa-star"></span>', (int) $rating);
    $stars .= str_repeat('<span class="fa fa-star-o"></span>', 5 - (int) $rating);
    if ($meta !== false)
            $stars .= '<meta itemprop="rating" content="'.(int) $rating.'" />';

    return $stars;
}

function tep_navbar_search($btnclass = 'btn-default', $description = true)
{
    global $request_type;

    $search_link = '<div class="searchbox-margin">';
    $search_link .= tep_draw_form('quick_find',
        tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', $request_type, false),
        'get', 'class="form-horizontal"');
    $search_link .= '    <div class="input-group">'.
        tep_draw_input_field('keywords', '',
            'required placeholder="'.TEXT_SEARCH_PLACEHOLDER.'"', 'search').
        '        <span class="input-group-btn"><button type="submit" class="btn '.$btnclass.'"><i class="fa fa-search"></i></button></span>'.
        '    </div>';
    $search_link .= '</div>';
    if (tep_not_null($description) && ($description === true)) {
        $search_link .= tep_draw_hidden_field('search_in_description', '1');
    }
    $search_link .= tep_hide_session_id().'</form>';

    return $search_link;
}

// strip paragraph ckeditor fix
function strip_p($txt)
{
    $txt = str_replace('</P>', '',
        (str_replace('<P>', '',
            (str_replace('</p>', '', str_replace('<p>', '', $txt))))));
    return $txt;
}

//european accented chars
$accented .= '¡¿';
$accented .= 'ÄäÀàÁáÂâÃãÅåǍǎĄąĂăÆæĀā';
$accented .= 'ÇçĆćĈĉČč';
$accented .= 'ĎđĐďð';
$accented .= 'ÈèÉéÊêËëĚěĘęĖėĒē';
$accented .= 'ĜĝĢģĞğ';
$accented .= 'Ĥĥ';
$accented .= 'ÌìÍíÎîÏïıĪīĮį';
$accented .= 'Ĵĵ';
$accented .= 'Ķķ';
$accented .= 'ĹĺĻļŁłĽľ';
$accented .= 'ÑñŃńŇňŅņ';
$accented .= 'ÖöÒòÓóÔôÕõŐőØøŒœ';
$accented .= 'ŔŕŘř';
$accented .= 'ẞßŚśŜŝŞşŠšȘș';
$accented .= 'ŤťŢţÞþȚț';
$accented .= 'ÜüÙùÚúÛûŰűŨũŲųŮůŪū';
$accented .= 'Ŵŵ';
$accented .= 'ÝýŸÿŶŷ';
$accented .= 'ŹźŽžŻż';
$european_accented_chars = $accented;
$safe_search_whitelisted_chars = '/[^A-Za-z0-9_ -' . $european_accented_chars . ']/;
