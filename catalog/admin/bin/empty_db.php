<?php
//upd:2:120913
//require('includes/application_top.php');
//root login
chdir('../../');
require('includes/application_top.php');

if (!isset($_POST['del'])) $_POST['del'] = '';

if (($_POST['del'] == 'products') || ($_POST['del'] == 'all')) {

//truncate products & category tables:
    mysql_query('truncate products');
    mysql_query('truncate products_description');
    mysql_query('truncate products_description_versions');
    mysql_query('truncate categories_description');
    mysql_query('truncate categories');
    mysql_query('truncate products_to_categories');
    mysql_query('truncate products_images');

//reviews
    mysql_query('truncate reviews');
    mysql_query('truncate reviews_description');
//options
    mysql_query('truncate products_options');
    mysql_query('truncate products_options_values');
    mysql_query('truncate products_options_values_to_products_options');
//attributes
    mysql_query('truncate products_attributes');
    mysql_query('truncate products_attributes_download');

//specials (discounts)
    mysql_query('truncate specials');

//manufacturers
    mysql_query('truncate manufacturers');
    mysql_query('truncate  manufacturers_info');

//components
    mysql_query('truncate products_components');
    mysql_query('truncate products_components2p');

// static catalog stored data
    mysql_query('truncate images_stored');

//delete stored pages but keep scripts
    mysql_query("delete from static_catalog_data where script_name =''");
    mysql_query('truncate  static_generator_history');
}

if (($_POST['del'] == 'customers') || ($_POST['del'] == 'all')) {
//truncate customers
    mysql_query('truncate customers');
    mysql_query('truncate customers_real');
    mysql_query('truncate customers_info');
    mysql_query('truncate address_book');
    mysql_query('truncate address_book_real');
    mysql_query('truncate products_notifications');
}


if (($_POST['del'] == 'orders') || ($_POST['del'] == 'all')) {
// orders
    mysql_query('truncate orders');
    mysql_query('truncate orders_real');
    mysql_query('truncate orders_products');
    mysql_query('truncate orders_products_attributes');
    mysql_query('truncate orders_products_download');
    mysql_query('truncate orders_status_history');
    mysql_query('truncate orders_total');
}

if (($_POST['del'] == 'sessions') || ($_POST['del'] == 'all'))
        mysql_query('truncate sessions');

if (($_POST['del'] == 'customers_basket') || ($_POST['del'] == 'all'))
        mysql_query('truncate customers_basket');
if (($_POST['del'] == 'whos_online') || ($_POST['del'] == 'all'))
        mysql_query('truncate whos_online');

if (($_POST['del'] == 'banners') || ($_POST['del'] == 'all')) {
    mysql_query('truncate banners');
    mysql_query('truncate banners_history');
}

if (($_POST['del'] == 'phpids') || ($_POST['del'] == 'all')) {
    mysql_query('truncate banned_ip');
    mysql_query('truncate phpids_intrusions');
}
if (($_POST['del'] == 'administrators') || ($_POST['del'] == 'all'))
        mysql_query('truncate administrators');
if (($_POST['del'] == 'action_recorder') || ($_POST['del'] == 'all'))
        mysql_query('truncate action_recorder');
?>
<style>
    input{width:50%}
    body{text-align:center}
</style>

<form action="?" method="post">
    <input type="hidden" name="del" value="products">
    <input type="submit" value="delete testing products">
</form>

<form action="?" method="post">
    <input type="hidden" name="del" value="customers">
    <input type="submit" value="delete customers">
</form>

<form action="?" method="post">
    <input type="hidden" name="del" value="orders">
    <input type="submit" value="delete orders">
</form>


<form action="?" method="post">
    <input type="hidden" name="del" value="customers_basket">
    <input type="submit" value="delete customers_basket">
</form>

<form action="?" method="post">
    <input type="hidden" name="del" value="sessions">
    <input type="submit" value="delete sessions">
</form>

<form action="?" method="post">
    <input type="hidden" name="del" value="whos_online">
    <input type="submit" value="delete whos_online">
</form>

<form action="?" method="post">
    <input type="hidden" name="del" value="banners">
    <input type="submit" value="delete banners">
</form>

<form action="?" method="post">
    <input type="hidden" name="del" value="phpids">
    <input type="submit" value="delete phpids">
</form>

<form action="?" method="post">
    <input type="hidden" name="del" value="action_recorder">
    <input type="submit" value="delete action_recorder">
</form>

<!--
<form action="?" method="post">
<input type="hidden" name="del" value="administrators">
<input type="submit" value="delete administrators">
</form>


<form action="?" method="post">
<input type="hidden" name="del" value="all">
<input type="submit" value="delete all" style="background:red;color:yellow">
</form>
-->