<?php
require('includes/application_top.php');
require_once(DIR_WS_FUNCTIONS.'header_tags.php');
require(DIR_WS_LANGUAGES.$language.'/'.FILENAME_HEADER_TAGS_SOCIAL);

if (isset($_POST[0])) {

    switch ($_POST[0]) {

        case $_POST[0] == 'submit_twitter':
            $storename = tep_db_prepare_input($_POST[1]);
            $creator   = tep_db_prepare_input($_POST[2]);

            $db_query = tep_db_query("select unique_id from ".TABLE_HEADERTAGS_SOCIAL." where section = 'twitter'");

            if ($_POST[3] == 'delete' && tep_db_num_rows($db_query) > 0) {
                tep_db_query("delete from ".TABLE_HEADERTAGS_SOCIAL." where section = 'twitter'");
                echo RESULT_SUCCESS_REMOVED_TWITTER;
            } else {
                if (tep_db_num_rows($db_query) < 1) {
                    $result = tep_db_query("insert into ".TABLE_HEADERTAGS_SOCIAL." (section, groupname, url, data) values('twitter', '".tep_db_input($storeName)."', '".''."', '".tep_db_input($creator)."')");
                    $status = RESULT_SUCCESS_INSERTED;
                } else {
                    $db     = tep_db_fetch_array($db_query);
                    $result = tep_db_query("update ".TABLE_HEADERTAGS_SOCIAL." set groupname = '".tep_db_input($storename)."', data = '".tep_db_input($creator)."' where section = '".'twitter'."' and unique_id = ".(int) $db['unique_id']);
                    $status = RESULT_SUCCESS_UPDATED;
                }

                $db = tep_db_fetch_array($db_query);
                echo RESULT_SUCCESS_INSERTED;
            }
            break;


        /*         * ** BEGIN RADIO BUTTON SIZES *** */
        case $_POST[0] == 'sizechange':
            $enabledArray = array();
            $iconsArray   = GetSocialIconsArray();
            $db_query     = tep_db_query("select data, groupname from ".TABLE_HEADERTAGS_SOCIAL." where section = 'socialicons'"); //all will be the same size

            while ($db = tep_db_fetch_array($db_query)) {
                $enabledArray[] = $db['groupname'];
                $width          = $height         = substr($db['data'], 0, 2) + 1.'px';
                $name           = $db['data'];
            }

            $col    = 1;
            $maxCol = 55;

            switch ($name) {
                case TEXT_SIZE_16: $maxCol = 55;
                    break;
                case TEXT_SIZE_24: $maxCol = 35;
                    break;
                case TEXT_SIZE_32: $maxCol = 25;
                    break;
                case TEXT_SIZE_48: $maxCol = 15;
                    break;
            }

            foreach ($iconsArray as $group => $key) {
                if ($_POST[1] == 'saved' || $group == $_POST[1]) {

                    if ($group == $_POST[1]) { //othrwise load from the db - initial load only
                        $width  = $height = substr($group, 0, 2) + 1.'px';
                        $name   = $group;

                        switch ($name) {
                            case TEXT_SIZE_16: $maxCol = 55;
                                break;
                            case TEXT_SIZE_24: $maxCol = 35;
                                break;
                            case TEXT_SIZE_32: $maxCol = 25;
                                break;
                            case TEXT_SIZE_48: $maxCol = 15;
                                break;
                        }
                    }

                    $arry          = array();
                    $arry['group'] = $name;
                    $arry['div']   .= '<div class="container">';
                    $path          = HTTPS_SERVER.DIR_WS_CATALOG_IMAGES.'socialbookmark/';
                    $slash         = substr(DIR_FS_CATALOG, -1) == '/' ? '' : '/';
                    $pathLocal     = DIR_FS_CATALOG.$slash.DIR_WS_IMAGES.'socialbookmark/';

                    foreach ($key as $icon) {

                        if (file_exists($pathLocal.$icon.'-'.$name.'.png')) {
                            $block = (in_array($icon, $enabledArray) ? 'block' : 'none');

                            $arry['div'] .= '<div class="logo-box" style="padding-bottom:15px;  width:'.$width.'; height:'.$height.';">'.
                                '<input type="image" id="notused" name="'.$icon.'" src="'.$path.$icon.'-'.$name.'.png"  alt="'.$icon.'" title="'.$icon.'" onclick="javascript:return ChangeStatus(\''.$name.'\', \''.$icon.'\')" /><br />'.
                                '<div style="text-align:center;" id="mark"><input id="'.$name.'_'.$icon.'" type="image" name="'.$icon.'" value="'.$icon.'" src="images/mark_check.jpg" style="display:'.$block.';"/></div>';

                            if (($col % $maxCol) == 0) {
                                $arry['div'] .= '</div>';
                                $arry['div'] .= '<div class="logo-box" style="clear:both;"></div>';
                                $col         = 0;
                            } else {
                                $arry['div'] .= '</div>';
                            }

                            $col++;
                        }
                    }
                    $arry['div'] .= '</div>';

                    echo json_encode($arry);
                    break;
                }
            }
            return;
            break;
        /*         * ** END RADIO BUTTON SIZES *** */


        /*         * ** BEGIN CONFIG CHANGE *** */
        case $_POST[0] == 'configchange':
            $active_state = $_POST[1];
            $cfg          = 'HEADER_TAGS_DISPLAY_SOCIAL_BOOKMARKS';
            $db_query     = tep_db_query("update ".TABLE_CONFIGURATION." set configuration_value = '".tep_db_input($active_state)."' where configuration_key ='".$cfg."'");
            return;
            break;
        /*         * ** END CONFIG CHANGE *** */

        /*         * ** BEGIN SUBMIT *** */
        case $_POST[0] == 'submit':

            $postArray = $_POST;

            unset($postArray[0]);  //remove submit flag 
            $postArray = array_values($postArray);

            $imgSize   = tep_db_prepare_input($postArray[0]);
            unset($postArray[0]);   //remove the group name
            $postArray = array_values($postArray);

            $active_state = ($postArray[0] == 1 ? 'true' : 'false');
            unset($postArray[0]);                  //remove the disabled flag
            $postArray    = array_values($postArray);

            $cfg      = 'HEADER_TAGS_DISPLAY_SOCIAL_BOOKMARKS';
            $db_query = tep_db_query("update ".TABLE_CONFIGURATION." set configuration_value = '".tep_db_input($active_state)."' where configuration_key ='".$cfg."'");

            if (!is_array($postArray[0])) {      //array will only exist if image is selected and a url for it is present
                echo RESULT_FAILED_NO_SELECTION;
                return false;
            }

            $section  = 'socialicons';
            $db_query = tep_db_query("delete from ".TABLE_HEADERTAGS_SOCIAL." where section = '".$section."'");

            foreach ($postArray as $post) {
                foreach ($post as $arry) {
                    $data = $arry[0];
                    $url  = $arry[1];

                    tep_db_query("insert into ".TABLE_HEADERTAGS_SOCIAL." (section, groupname, url, data) values('".tep_db_input($section)."', '".tep_db_input($data)."', '".tep_db_input($url)."', '".tep_db_input($imgSize)."')");
                }
            }

            echo RESULT_SUCCESS_INSERTED;

            break;
        /*         * ** END SUBMIT *** */

        /*         * ** BEGIN KEYWORDS PAGINATION *** */
        case $_POST[0] == 'pagination':
            require_once(DIR_WS_FUNCTIONS.'headertags_seo_position_google.php');
            require(DIR_WS_LANGUAGES.$language.'/'.FILENAME_HEADER_TAGS_KEYWORDS);

            $page        = (isset($_POST['page']) ? $_POST['page'] : $_POST[1]);
            $page_number = filter_var($page, FILTER_SANITIZE_NUMBER_INT,
                    FILTER_FLAG_STRIP_HIGH) - 1; //sanitize post value

            if (!is_numeric($page_number)) {
                die('Invalid page number!');
            } //validate page number is really numaric

            $position       = ($page_number * MAX_DISPLAY_SEARCH_RESULTS); //get current starting point of records
            $orderBy        = (tep_not_null($_POST[3]) ? $_POST[3].', language_id ASC '
                    : ' language_id ASC ');
            $where          = $_POST[4];
            $keywords_query = tep_db_query("select * from ".TABLE_HEADERTAGS_KEYWORDS.$where." order by ".$orderBy." LIMIT $position, ".MAX_DISPLAY_SEARCH_RESULTS);

            if (tep_db_num_rows($keywords_query) > 0) {

                $arry        = array();
                $arry['div'] .= '<form action="header_tags_seo_keywords.php" method="post" name="keywords_form"><tr><td><table border="1" class="smallText">
                              <tr>
                                <th>'.TEXT_LANGUAGE.'</th>       
                                <th>'.'<input type="hidden" name="delete_words"><a href="javascript:handlesubmit(\'delete_words\');">'.TEXT_DELETE_WORD.'</a></th>                                   
                                <th>'.TEXT_KEYWORD.'</th>    
                                <th>'.TEXT_KEYWORD_COUNT.'</th>                    
                                <th>'.TEXT_KEYWORD_LAST_MODIFIED.'</th>                    
                                <th>'.TEXT_KEYWORD_POSITION_GOOGLE_LAST_DATE.'</th>                    
                                <th>'.TEXT_KEYWORD_POSITION_GOOGLE.'</th>     
                                <th>'.TEXT_KEYWORD_POSITION_GET_POSITION.'</th>  
                                <th>'.'<input type="hidden" name="search_site"><a href="javascript:handlesubmit(\'search_site\');">'.TEXT_KEYWORD_SEARCH_SITE.'</a></th>                                
                              </tr>';

                $searchWords = $_POST[5];

                while ($keywords = tep_db_fetch_array($keywords_query)) {
                    $assignedID    = (tep_not_null($searchWords) ? GetProductID($searchWords,
                            $keyword, $keywords['language_id']) : '');
                    $keyword       = $keywords['keyword'];
                    $keyword_color = $keywords['found'] ? '#0000FF' : ($assignedID
                            ? '#A54BFF' : '#808000');
                    $lastChecked   = tep_date_short($keywords['google_date_position_check']);
                    $lastChecked   = ($lastChecked ? $lastChecked : '&nbsp;');
                    $lastSearched  = tep_date_short($keywords['last_search']);
                    $lastSearched  = ($lastSearched ? $lastSearched : '&nbsp;');

                    $arry['div'] .= '<input type="hidden"  name="goolast_'.$keywords['id'].'" value="'.$keywords['google_last_position'].'" id="goolast_'.$keywords['id'].'">';

                    $arry['div'] .= '<tr>
                                   <td>'.GetLanguageName($keywords['language_id']).'</td>
                                   <td>'.'<input type="checkbox" name="delete_word_'.$keywords['id'].'" value="'.$keywords['id'].'"></td>
                                   <td>'.'<span style="color:'.$keyword_color.'; font-weight:bold;">'.$keyword.'</span></td>
                                   <td>'.$keywords['counter'].'</td>
                                   <td>'.$lastSearched.'</td>
                                   <td>'.$lastChecked.'</td>
                                   <td>'.'<div id="'.$keywords['id'].'">'.$keywords['google_last_position'].'</div></td>
                                   <td>'.'<input type="button" value="'.$keyword.'" onclick="ShowKeyword(\''.$keyword.'\', \''.$keywords['id'].'\');" style="text-align:left">
                                   <td>'.'<input type="radio" name="searchgroup_'.$keywords['id'].'" value="'.TEXT_KEYWORD_SEARCH_SITE_YES.'_'.$keyword.'_'.$keywords['id'].'_'.$keywords['language_id'].'">'.TEXT_KEYWORD_SEARCH_SITE_YES.
                        '<input type="radio" name="searchgroup_'.$keywords['id'].'" value="'.TEXT_KEYWORD_SEARCH_SITE_NO.'_'.$keyword.'_'.$keywords['id'].'_'.$keywords['language_id'].'">'.TEXT_KEYWORD_SEARCH_SITE_NO.
                        '<input type="text"  name="searchpid_'.$keywords['id'].'" value="'.$assignedID.'" size="2">'.TEXT_KEYWORD_SEARCH_SITE_PID.'</td>
                                  </tr>';
                }

                $arry['div'] .= '</table></td></tr></form>';
            }

            echo json_encode($arry);

            break;
        /*         * ** END KEYWORDS PAGINATION *** */
    }
}   
       