#admin
truncate administrators;
truncate action_recorder;

#truncate products & category tables:
truncate products;
truncate products_description;
#truncate products_description_versions;
truncate categories_description;
truncate categories;
truncate products_to_categories;
truncate products_images;

#reviews
truncate reviews;
truncate reviews_description;
#options
truncate products_options;
truncate products_options_values;
truncate products_options_values_to_products_options;
#attributes
truncate products_attributes;
truncate products_attributes_download;

#specials (discounts)
truncate specials;

#manufacturers
truncate manufacturers;
truncate  manufacturers_info;


#truncate customers
truncate customers;
#truncate customers_real;
truncate customers_info;
truncate address_book;
#truncate address_book_real;
truncate products_notifications;



# orders
truncate orders;
#truncate orders_real;
truncate orders_products;
truncate orders_products_attributes;
truncate orders_products_download;
truncate orders_status_history;
truncate orders_total;


truncate sessions;

truncate customers_basket;
truncate whos_online;

truncate banners;
truncate banners_history;


#truncate banned_ip;
#truncate phpids_intrusions;

truncate administrators;
truncate action_recorder;
