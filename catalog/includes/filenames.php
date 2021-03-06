<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2012 osCommerce

  Edited by 2014 Newburns Design and Technology
 * ************************************************
 * *********** New addon definitions **************
 * ***********        Below          **************
 * ************************************************
  SEO Header Tags Reloaded added -- http://addons.oscommerce.com/info/8864
  Credit Class, Gift Vouchers & Discount Coupons osC2.3.3.4 (CCGV) added -- http://addons.oscommerce.com/info/9020

  Released under the GNU General Public License
 */

// define the filenames used in the project
define('FILENAME_ACCOUNT', 'account.php');
define('FILENAME_ACCOUNT_EDIT', 'account_edit.php');
define('FILENAME_ACCOUNT_HISTORY', 'account_history.php');
define('FILENAME_ACCOUNT_HISTORY_INFO', 'account_history_info.php');
define('FILENAME_ACCOUNT_NEWSLETTERS', 'account_newsletters.php');
define('FILENAME_ACCOUNT_NOTIFICATIONS', 'account_notifications.php');
define('FILENAME_ACCOUNT_PASSWORD', 'account_password.php');
define('FILENAME_ADDRESS_BOOK', 'address_book.php');
define('FILENAME_ADDRESS_BOOK_PROCESS', 'address_book_process.php');
define('FILENAME_ADVANCED_SEARCH', 'advanced_search.php');
define('FILENAME_ADVANCED_SEARCH_RESULT', 'advanced_search_result.php');
define('FILENAME_ALSO_PURCHASED_PRODUCTS', 'also_purchased_products.php');
define('FILENAME_CHECKOUT_CONFIRMATION', 'checkout_confirmation.php');
define('FILENAME_CHECKOUT_PAYMENT', 'checkout_payment.php');
define('FILENAME_CHECKOUT_PAYMENT_ADDRESS', 'checkout_payment_address.php');
define('FILENAME_CHECKOUT_PROCESS', 'checkout_process.php');
define('FILENAME_CHECKOUT_SHIPPING', 'checkout_shipping.php');
define('FILENAME_CHECKOUT_SHIPPING_ADDRESS', 'checkout_shipping_address.php');
define('FILENAME_CHECKOUT_SUCCESS', 'checkout_success.php');
define('FILENAME_CONTACT_US', 'contact_us.php');
define('FILENAME_CONDITIONS', 'conditions.php');
define('FILENAME_COOKIE_USAGE', 'cookie_usage.php');
define('FILENAME_CREATE_ACCOUNT', 'create_account.php');
define('FILENAME_CREATE_ACCOUNT_SUCCESS', 'create_account_success.php');
define('FILENAME_DB_ERROR','db_error.html');
define('FILENAME_DB_ERROR_PHP','db_error.php');
define('FILENAME_DEFAULT', 'index.php');
define('FILENAME_DOWNLOAD', 'download.php');
define('FILENAME_INFO_SHOPPING_CART', 'info_shopping_cart.php');
define('FILENAME_LOGIN', 'login.php');
define('FILENAME_LOGOFF', 'logoff.php');
define('FILENAME_MANUFACTURERS_INDEX','manufacturers_index.php');
define('FILENAME_MODULES', 'modules.php');
define('FILENAME_NEW_PRODUCTS', 'new_products.php');
define('FILENAME_PASSWORD_FORGOTTEN', 'password_forgotten.php');
define('FILENAME_PASSWORD_RESET', 'password_reset.php');
define('FILENAME_POPUP_IMAGE', 'popup_image.php');
define('FILENAME_POPUP_SEARCH_HELP', 'popup_search_help.php');
define('FILENAME_PRIVACY', 'privacy.php');
define('FILENAME_PRODUCT_INFO', 'product_info.php');
define('FILENAME_PRODUCT_LISTING', 'product_listing.php');
define('FILENAME_PRODUCT_REVIEWS', 'product_reviews.php');
define('FILENAME_PRODUCT_REVIEWS_INFO', 'product_reviews_info.php');
define('FILENAME_PRODUCT_REVIEWS_WRITE', 'product_reviews_write.php');
define('FILENAME_PRODUCTS_NEW', 'products_new.php');
define('FILENAME_REDIRECT', 'redirect.php');
define('FILENAME_REVIEWS', 'reviews.php');
define('FILENAME_SHIPPING', 'shipping.php');
define('FILENAME_SHOPPING_CART', 'shopping_cart.php');
define('FILENAME_SPECIALS', 'specials.php');
define('FILENAME_SSL_CHECK', 'ssl_check.php');
define('FILENAME_TELL_A_FRIEND', 'tell_a_friend.php');
define('FILENAME_UPCOMING_PRODUCTS', 'upcoming_products.php');
/*
 * ***********************************************************************
 * ************* Custom Filenames can be defined below here **************
 * *************               Raymond Burns                **************
 * ***********************************************************************
 */
// SEO Header Tags Reloaded
define('FILENAME_TESTIMONIALS', 'testimonials.php');
// CCGV
define('FILENAME_GV_FAQ', 'gv_faq.php');
define('FILENAME_GV_REDEEM', 'gv_redeem.php');
define('FILENAME_GV_SEND', 'gv_send.php');

/* * ** BEGIN ARTICLE MANAGER *** */
define('FILENAME_ARTICLE_BLOG', 'article_blog.php');
define('FILENAME_ARTICLES_BLOG_COMMENTS', 'article_manager_blog_comments.php');
define('FILENAME_ARTICLE_INFO', 'article_info.php');
define('FILENAME_ARTICLE_LISTING', 'article_listing.php');
define('FILENAME_ARTICLE_MANAGER_SEARCH_RESULT',
    'article_manager_search_result.php');
define('FILENAME_ARTICLE_REVIEWS', 'article_reviews.php');
define('FILENAME_ARTICLE_REVIEWS_INFO', 'article_reviews_info.php');
define('FILENAME_ARTICLE_REVIEWS_WRITE', 'article_reviews_write.php');
define('FILENAME_ARTICLE_SUBMIT', 'article-submit.php');
define('FILENAME_ARTICLE_TOPICS', 'article-topics.php');
define('FILENAME_ARTICLES', 'articles.php');
define('FILENAME_ARTICLES_NEW', 'articles_new.php');
define('FILENAME_ARTICLES_RSS', 'article_rss.php');
define('FILENAME_ARTICLES_UPCOMING', 'articles_upcoming.php');
define('FILENAME_ARTICLES_XSELL', 'articles_xsell.php');
define('FILENAME_ARTICLES_PXSELL', 'articles_pxsell.php');
define('FILENAME_NEW_ARTICLES', 'new_articles.php');
/* * ** END ARTICLE MANAGER *** */

// BOF: Information Pages Unlimited
define('FILENAME_INFORMATION', 'information.php');
// EOF: Information Pages Unlimited