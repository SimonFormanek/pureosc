<?php
/*
  $Id$

  header_tags_tag_cloud Originally Created by: Jack York aka Jack_mcs
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  Copyright (c) 2010 osCommerce
  Portions Copyright 2011 oscommerce-solution.com

  Released under the GNU General Public License
 */

include_once(DIR_WS_FUNCTIONS.'header_tags.php');
$htsTagsArray   = array();
// $maximum is the highest counter for a search term
$hts_tags_query = tep_db_query("select keyword, counter from ".TABLE_HEADERTAGS_KEYWORDS." where keyword is not null and keyword != '' and found = 1 and language_id = ".(int) $languages_id." ORDER BY counter DESC LIMIT 20");

if (tep_db_num_rows($hts_tags_query)) {
    $maximum  = 0;
    while ($hts_tags = tep_db_fetch_array($hts_tags_query)) {
        if ($hts_tags['counter'] > $maximum) {
            $maximum = $hts_tags['counter'];
        }
        $htsTagsArray[] = array('keyword' => $hts_tags['keyword'], 'counter' => $hts_tags['counter']);
    }
    shuffle($htsTagsArray);


    $colCtr  = '';
    $content = '<div id="tagcloud"><div style="text-align:center;">';

    foreach ($htsTagsArray as $kword) {
        // determine the popularity of this term as a percentage
        $percent = floor(($kword['counter'] / $maximum) * 100);

        // determine the size for this term based on the percentage

        if ($percent < 20) {
            $class = 'smallest';
        } elseif ($percent >= 20 and $percent < 40) {
            $class = 'small';
        } elseif ($percent >= 40 and $percent < 60) {
            $class = 'medium';
        } elseif ($percent >= 60 and $percent < 80) {
            $class = 'large';
        } else {
            $class = 'largest';
        }

        if (!tep_not_null(($hstLink = GetHTSTagCloudLink($kword['keyword'],
                $languages_id)))) {
            continue;
        }

        $content .= '<span class="'.$class.'"><a class="'.$class.'" href="'.$hstLink.'">'.ucwords(stripslashes($kword['keyword'])).'</a></span>&nbsp;';
        $colCtr++;

        if ($colCtr >= HEADER_TAGS_TAG_CLOUD_COLUMN_COUNT) {
            $colCtr  = 0;
            $content .= '</div><div  style="text-align:center;">';
        }
    }

    echo '<div class="ui-widget infoBoxContainer">'.' <div class="ui-widget-header ui-corner-top infoBoxHeading"><span class="hts_footer_title">'.BOX_HEADING_HEADERTAGS_TAGCLOUD.'</span></div>'.
    '  <div class="ui-widget-content infoBoxContents" style="padding-top:10px; text-align:center; color:#fff;">'.$content.'</div>'.
    '</div>';
}
?>
