<?php
require("includes/application_top.php");
$products_id = $_GET['products_id'];
$parent = $_GET['parent'];
$languages_id = $_GET['languages_id'];
$new_category_name = $_POST['new_category_name'];
if ( $_GET['vstup']==1) {

$cat_exists_q = tep_db_query("SELECT categories.categories_id FROM " . TABLE_CATEGORIES_DESCRIPTION . ", " . TABLE_CATEGORIES . " WHERE language_id = " . $languages_id . " AND categories_name='" . $new_category_name . "' AND categories.categories_id=categories_description.categories_id AND parent_id=" . $parent);
$cat_exists = tep_db_fetch_array($cat_exists_q);
if ($cat_exists['categories_id']){
$p2c_exists_q =   tep_db_query("SELECT products_id FROM " . TABLE_PRODUCTS_TO_CATEGORIES . " WHERE products_id=" . $products_id . " AND categories_id=" . $cat_exists['categories_id']);
if (tep_db_num_rows($p2c_exists_q)) {
	echo 'produkt uz tam je ALT+LEFT go back';
    }else{
	tep_db_query("INSERT INTO " . TABLE_PRODUCTS_TO_CATEGORIES . " VALUES ('" . $products_id . "', '" . $cat_exists['categories_id'] . "')");
	echo 'vlozeno';
	echo '<script language="javascript"><!--
	document.write(history.go(-2));
	//--></script>';
	exit;
    }    
} else {
echo 'kategorie neexistuje vloz! ALT+LEFT go back';
}



		exit;

		}


?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<html>
<body>

<form action="?parent=<?php echo $parent;?>&vstup=1&languages_id=<?php echo $languages_id; ?>&products_id=<?php echo $products_id;?> " method="post" enctype="multipart/form-data">

	<input name=new_category_name type=text  value="">
	  </form>
<br>
HELP: cislo od vyrobce pro parovani + ENTER

</html>