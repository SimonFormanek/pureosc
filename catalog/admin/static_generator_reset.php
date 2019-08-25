<?php
/*
 */

require('includes/application_top.php');
tep_db_query("update " . TABLE_RESET . " set reset = 1");
tep_redirect(tep_href_link(FILENAME_DEFAULT));

