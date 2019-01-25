<?php
/*
  $Id: header_tags_keywordsseo.php,v 3.0 2011/07/21 by Jack_mcs - http://www.oscommerce-solution.com

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright 2009 oscommerce-solution.com

  Released under the GNU General Public License
 */

include_once(DIR_WS_FUNCTIONS.'header_tags.php');

$keyword = tep_db_prepare_input(strip_tags(trim($keywords)));
$keyword = preg_replace('/[^a-z0-9 ]/i', '', $keyword);

if (isset($keyword[1])) { //ignore one character searches
    $found = (GetHTSTagCloudLink($keyword, $languages_id) === false ? 0 : 1); //keyword is in products, categories or manufacturers tables

    $keyword_query = tep_db_query("select 1 FROM ".TABLE_HEADERTAGS_KEYWORDS." where keyword = '".tep_db_input($keyword)."' and language_id = ".(int) $languages_id);

    if (tep_db_num_rows($keyword_query) > 0) {
        tep_db_query("update ".TABLE_HEADERTAGS_KEYWORDS." set counter = counter+1, last_search = now(), found = ".(int) $found." WHERE keyword = '".tep_db_input($keyword)."'");
    } else {         // the keyword does not exist so add it
        tep_db_query("insert into ".TABLE_HEADERTAGS_KEYWORDS."  (keyword, last_search, found, language_id) VALUES ('".tep_db_input($keyword)."', now(), ".(int) $found.", ".(int) $languages_id.")");
    }
}