<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Currencies',true);

define('TABLE_HEADING_CURRENCY_NAME', 'Currency',true);
define('TABLE_HEADING_CURRENCY_CODES', 'Code',true);
define('TABLE_HEADING_CURRENCY_VALUE', 'Value',true);
define('TABLE_HEADING_ACTION', 'Action',true);

define('TEXT_INFO_EDIT_INTRO', 'Please make any necessary changes',true);
define('TEXT_INFO_COMMON_CURRENCIES', '-- Common Currencies --',true);
define('TEXT_INFO_CURRENCY_TITLE', 'Title:',true);
define('TEXT_INFO_CURRENCY_CODE', 'Code:',true);
define('TEXT_INFO_CURRENCY_SYMBOL_LEFT', 'Symbol Left:',true);
define('TEXT_INFO_CURRENCY_SYMBOL_RIGHT', 'Symbol Right:',true);
define('TEXT_INFO_CURRENCY_DECIMAL_POINT', 'Decimal Point:',true);
define('TEXT_INFO_CURRENCY_THOUSANDS_POINT', 'Thousands Point:',true);
define('TEXT_INFO_CURRENCY_DECIMAL_PLACES', 'Decimal Places:',true);
define('TEXT_INFO_CURRENCY_LAST_UPDATED', 'Last Updated:',true);
define('TEXT_INFO_CURRENCY_VALUE', 'Value:',true);
define('TEXT_INFO_CURRENCY_EXAMPLE', 'Example Output:',true);
define('TEXT_INFO_INSERT_INTRO', 'Please enter the new currency with its related data',true);
define('TEXT_INFO_DELETE_INTRO', 'Are you sure you want to delete this currency?',true);
define('TEXT_INFO_HEADING_NEW_CURRENCY', 'New Currency',true);
define('TEXT_INFO_HEADING_EDIT_CURRENCY', 'Edit Currency',true);
define('TEXT_INFO_HEADING_DELETE_CURRENCY', 'Delete Currency',true);
define('TEXT_INFO_SET_AS_DEFAULT', TEXT_SET_DEFAULT . ' (requires a manual update of currency values)',true);
define('TEXT_INFO_CURRENCY_UPDATED', 'The exchange rate for %s (%s) was updated successfully via %s.',true);

define('ERROR_REMOVE_DEFAULT_CURRENCY', 'Error: The default currency can not be removed. Please set another currency as default, and try again.',true);
define('ERROR_CURRENCY_INVALID', 'Error: The exchange rate for %s (%s) was not updated via %s. Is it a valid currency code?',true);
define('WARNING_PRIMARY_SERVER_FAILED', 'Warning: The primary exchange rate server (%s) failed for %s (%s) - trying the secondary exchange rate server.',true);