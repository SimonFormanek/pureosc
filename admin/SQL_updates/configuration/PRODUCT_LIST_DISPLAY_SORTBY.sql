INSERT INTO configuration 
(configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) 
VALUES 
('CONFIG_TITLE_PRODUCT_LIST_DISPLAY_SORTBY', 'PRODUCT_LIST_DISPLAY_SORTBY', 'true', 'CONFIG_DESCRIPTION_PRODUCT_LIST_DISPLAY_SORTBY', '8', '14', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now());
