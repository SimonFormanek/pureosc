<?php

require_once('includes/application_top.php');

//require(DIR_WS_LANGUAGES.$language.'/'.FILENAME_MANUFACTURERS_INDEX);

require(DIR_WS_INCLUDES.'template_top.php');

//-----------------------------------------------------------------------------------------

$producers_query = tep_db_query("SELECT distinct m.manufacturers_id AS id, m.manufacturers_name AS name FROM " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES . " using(categories_id), " . TABLE_MANUFACTURERS . " m WHERE p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and p.products_id = p2c.products_id ORDER BY m.manufacturers_name"); 
        
while($producer = tep_db_fetch_array($producers_query)){
    $producers[mb_substr($producer['name'],0,1,'UTF-8') ][$producer['name']] = $producer['id'];
}

echo '<div class="page-header">';
echo '<h1>' . MANUFACTURERS . '</h1>';

echo '</div>';
echo '<div>';
echo MANUFACTURERS_LIST . ' ';

foreach($producers as $pK => $pA) {
  echo '<a href="/#' . $pK . '">' . $pK . '</a>&nbsp; ';
}
echo '</div>';
?>
    <div class="contentContainer">
        <div class="contentText columns3">

<?php
foreach($producers as $pK => $pA) {

  echo '<br><h2 class="h2ml" id="' . $pK . '">' . $pK . "</h2><div>\n"; 
  
  foreach($pA as $an => $aid) {
  
    echo '<a href="' . tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $aid) . '">' . $an . '</a>' . "\n"; 
  
  }
echo '</div>';
}
?>
<div class="clearfix"><br/></div>
  </div>
</div>

<?php
require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');

?>

