
#truncate products & category tables:
mysql_query('truncate products');
mysql_query('truncate products_description');
mysql_query('truncate products_description_versions');
mysql_query('truncate categories_description');
mysql_query('truncate categories');
mysql_query('truncate products_to_categories');
mysql_query('truncate products_images');

#reviews
mysql_query('truncate reviews');
mysql_query('truncate reviews_description');
#options
mysql_query('truncate products_options');
mysql_query('truncate products_options_values');
mysql_query('truncate products_options_values_to_products_options');
#attributes
mysql_query('truncate products_attributes');
mysql_query('truncate products_attributes_download');

#specials (discounts)
mysql_query('truncate specials');

#manufacturers
mysql_query('truncate manufacturers');
mysql_query('truncate  manufacturers_info');


#truncate customers
mysql_query('truncate customers');
mysql_query('truncate customers_real');
mysql_query('truncate customers_info');
mysql_query('truncate address_book');
mysql_query('truncate address_book_real');
mysql_query('truncate products_notifications');



# orders
mysql_query('truncate orders');
mysql_query('truncate orders_real');
mysql_query('truncate orders_products');
mysql_query('truncate orders_products_attributes');
mysql_query('truncate orders_products_download');
mysql_query('truncate orders_status_history');
mysql_query('truncate orders_total');


mysql_query('truncate sessions');

mysql_query('truncate customers_basket');
mysql_query('truncate whos_online');

mysql_query('truncate banners');
mysql_query('truncate banners_history');


mysql_query('truncate banned_ip');
mysql_query('truncate phpids_intrusions');

mysql_query('truncate administrators');
mysql_query('truncate action_recorder');
