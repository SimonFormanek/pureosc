<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Database Backup Manager',true);

define('TABLE_HEADING_TITLE', 'Title',true);
define('TABLE_HEADING_FILE_DATE', 'Date',true);
define('TABLE_HEADING_FILE_SIZE', 'Size',true);
define('TABLE_HEADING_ACTION', 'Action',true);

define('TEXT_INFO_HEADING_NEW_BACKUP', 'New Backup',true);
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Restore Local',true);
define('TEXT_INFO_NEW_BACKUP', 'Do not interrupt the backup process which might take a couple of minutes.',true);
define('TEXT_INFO_UNPACK', '<br /><br />(after unpacking the file from the archive)',true);
define('TEXT_INFO_RESTORE', 'Do not interrupt the restoration process.<br /><br />The larger the backup, the longer this process takes!<br /><br />If possible, use the mysql client.<br /><br />For example:<br /><br /><strong>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </strong> %s',true);
define('TEXT_INFO_RESTORE_LOCAL', 'Do not interrupt the restoration process.<br /><br />The larger the backup, the longer this process takes!',true);
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'The file uploaded must be a raw sql (text) file.',true);
define('TEXT_INFO_DATE', 'Date:',true);
define('TEXT_INFO_SIZE', 'Size:',true);
define('TEXT_INFO_COMPRESSION', 'Compression:',true);
define('TEXT_INFO_USE_GZIP', 'Use GZIP',true);
define('TEXT_INFO_USE_ZIP', 'Use ZIP',true);
define('TEXT_INFO_USE_NO_COMPRESSION', 'No Compression (Pure SQL)',true);
define('TEXT_INFO_DOWNLOAD_ONLY', 'Download only (do not store server side)',true);
define('TEXT_INFO_BEST_THROUGH_HTTPS', 'Best through a HTTPS connection',true);
define('TEXT_DELETE_INTRO', 'Are you sure you want to delete this backup?',true);
define('TEXT_NO_EXTENSION', 'None',true);
define('TEXT_BACKUP_DIRECTORY', 'Backup Directory:',true);
define('TEXT_LAST_RESTORATION', 'Last Restoration:',true);
define('TEXT_FORGET', '(<u>forget</u>)',true);

define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'Error: Backup directory does not exist. Please set this in configure.php.',true);
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'Error: Backup directory is not writeable.',true);
define('ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', 'Error: Download link not acceptable.',true);

define('SUCCESS_LAST_RESTORE_CLEARED', 'Success: The last restoration date has been cleared.',true);
define('SUCCESS_DATABASE_SAVED', 'Success: The database has been saved.',true);
define('SUCCESS_DATABASE_RESTORED', 'Success: The database has been restored.',true);
define('SUCCESS_BACKUP_DELETED', 'Success: The backup has been removed.',true);