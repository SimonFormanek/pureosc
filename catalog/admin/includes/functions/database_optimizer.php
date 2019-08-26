<?php
/*
  $Id: database_optimizer_cron.php,v 1.0 2011/02/02
  database_optimizer_cron.php Originally Created by: Jack_mcs - http://www.oscommerce-solution.com
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright 2011 oscommerce-solution.com

  Released under the GNU General Public License
*/

function Get_DB_Size($database) {
    $result = tep_db_query("SHOW TABLE STATUS FROM `" . $database . "`");
    $dbsize = 0;
    while( $row = tep_db_fetch_array( $result ) ) {
        $dbsize += $row[ "Data_length" ] + $row[ "Index_length" ];
    }
    return $dbsize;
}

function GetConvertedSize($bytes, $precision = 2) {
    if ($bytes > pow(1024,3)) return round($bytes / pow(1024,3), $precision)." GB";
    else if ($bytes > pow(1024,2)) return round($bytes / pow(1024,2), $precision)." MB";
    else if ($bytes > 1024) return round($bytes / 1024, $precision)." KB";
    else return ($bytes)." B";
}