<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
 */

namespace PureOSC\Admin;

require('includes/application_top.php');

$languages          = tep_get_languages();
$languages_array    = array();
$languages_selected = cfg('DEFAULT_LANGUAGE');
for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
    $languages_array[] = array('id' => $languages[$i]['code'],
        'text' => $languages[$i]['name']);
    if ($languages[$i]['directory'] == $language) {
        $languages_selected = $languages[$i]['code'];
    }
}

$viewer = new ui\UserlogDataTable(new \PureOSC\CustomerLog());

require(DIR_WS_INCLUDES.'template_top.php');
?>
<script lang="javascript">
function stripslashes(str) {
 return str.replace(/\\'/g,'\'').replace(/\"/g,'"').replace(/\\\\/g,'\\').replace(/\\0/g,'\0');
}
</script>
<?php

$viewer->finalize();

echo $viewer;

require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');

