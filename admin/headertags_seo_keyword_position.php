<?php
 require('includes/application_top.php');
 require_once(DIR_WS_CLASSES . FILENAME_HEADER_TAGS_SEO);
 require_once(DIR_WS_LANGUAGES . $language . '/' . FILENAME_HEADER_TAGS_KEYWORDS);
 require_once(DIR_WS_FUNCTIONS . 'headertags_seo_position_google.php');

 if (isset($_GET['section']) && $_GET['section'] == 'get_kword') { 
     $kwrd = (isset($_GET['keyword']) ? tep_db_input(strip_tags($_GET['keyword'])) : ''); 
     $url = (isset($_GET['url']) ? tep_db_input(strip_tags($_GET['url'])) : ''); 
     $pageCnt = (isset($_GET['page_cnt']) ? (int)$_GET['page_cnt'] : '');

     $googleLast = (isset($_GET['googleLast']) ? (int)$_GET['googleLast'] : '');

     $keywords_query = tep_db_query("select * from " . TABLE_HEADERTAGS_KEYWORDS . " where keyword = '" . tep_db_input($kwrd) . "' order by language_id");


     if (tep_db_num_rows($keywords_query) > 0 ) {
         while ($keywords = tep_db_fetch_array($keywords_query)) {
             $keyword = $keywords['keyword'];

             if (tep_not_null($url)) {
                 $position = GetGooglePosition($keyword, $keywords['id'], $url, $pageCnt);
                 echo $googleLast .' / ' . ($position > 0 ? $position : TEXT_NOT_FOUND);
                 tep_db_query("update " . TABLE_HEADERTAGS_KEYWORDS . " set google_last_position = " . (int)$position . ", google_date_position_check = now() where id = " . (int)$keywords['id']);
             } else {
                 echo TEXT_NO_URL;
             }                   
         }           
     } else {
         echo TEXT_INVALID_KEYWORD;
     }
 }

     //echo '&nbsp;&nbsp;Sorry. Position checking not enabled.';    

