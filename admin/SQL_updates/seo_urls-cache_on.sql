#set all missing cached SEO to cached!
update configuration set configuration_value='true' WHERE configuration_key = 'USE_SEO_CACHE_FAQDESK_CATEGORIES';
update configuration set configuration_value='true' WHERE configuration_key = 'USE_SEO_CACHE_INFO_PAGES';
update configuration set configuration_value='true' WHERE configuration_key = 'USE_SEO_CACHE_LINKS';
update configuration set configuration_value='true' WHERE configuration_key = 'USE_SEO_CACHE_NEWSDESK_ARTICLES';
update configuration set configuration_value='true' WHERE configuration_key = 'USE_SEO_CACHE_NEWSDESK_CATEGORIES';
update configuration set configuration_value='true' WHERE configuration_key = 'USE_SEO_CACHE_POLLBOOTH';
update configuration set configuration_value='true' WHERE configuration_key = 'USE_SEO_CACHE_PAGE_EDITOR';
