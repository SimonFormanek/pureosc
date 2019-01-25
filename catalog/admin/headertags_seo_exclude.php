<?php
require('includes/application_top.php');

if (isset($_GET['exclude'])) {
    $file = tep_db_prepare_input($_GET['exclude']);

    if (file_exists(DIR_FS_CATALOG.$file)) {  //cheap way to verify the input wasn't altered by a hacker
        file_put_contents('includes/headertags_seo_excludes.txt', $file."\n",
            FILE_APPEND);
        tep_db_query("delete from ".TABLE_HEADERTAGS." where page_name = '".$file."'");
    }
} else if (isset($_GET['delete'])) {
    $file = tep_db_prepare_input($_GET['delete']);

    if (file_exists(DIR_FS_CATALOG.$file)) {  //cheap way to verify the input wasn't altered by a hacker
        unlink(DIR_FS_CATALOG.$file);
        tep_db_query("delete from ".TABLE_HEADERTAGS." where page_name = '".$file."'");
    }
}

tep_redirect(tep_href_link('header_tags_seo.php'));
exit();
