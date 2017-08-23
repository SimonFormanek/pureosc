<?php
    $parts = explode("=",$_SERVER['QUERY_STRING']); 
    $getID = end($parts);

    if (! ReadCacheHeaderTags($header_tags_array, basename($_SERVER['SCRIPT_FILENAME']), $getID)) {
        if (isset($parts[0])) {
            $found = false;
            $name = basename($_SERVER['SCRIPT_FILENAME']) . "?" . $parts[0] . "=";
            $pageTags_query = tep_db_query("select page_name from headertags where page_name like '" . tep_db_input($name) . "%' and language_id = '" . (int)$languages_id . "'");
            if (tep_db_num_rows($pageTags_query) > 0) {
                 while($pageTags = tep_db_fetch_array($pageTags_query)) {
                     if ($name . $_GET[$parts[0]] === $pageTags['page_name']) {
                        $header_tags_array = tep_header_tag_page($pageTags['page_name']);
                        WriteCacheHeaderTags($header_tags_array, basename($_SERVER['SCRIPT_FILENAME']), $getID);
                        $found = true;
                        break; 
                     } 
                 } 
             }
             if (! $found) {
                 $found = true;
                 $header_tags_array = tep_header_tag_page(basename($_SERVER['SCRIPT_FILENAME']));
                 WriteCacheHeaderTags($header_tags_array, basename($_SERVER['SCRIPT_FILENAME']), $getID);
            } 
        } else { 
         $header_tags_array = tep_header_tag_page(basename($_SERVER['SCRIPT_FILENAME']));
         WriteCacheHeaderTags($header_tags_array, basename($_SERVER['SCRIPT_FILENAME']), $getID);
        }  
    }