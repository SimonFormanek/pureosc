<?php
/*
  $Id: article-submit.php, v1.0 2003/12/04 12:00:00 ra Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
 */

define('HEADING_ARTICLE_SUBMIT', 'Submit your Article');
define('TEXT_ARTICLE_SUBMIT',
    'Please submit your article here. It will be reviewed within 48 hours and enabled, if approved.');
define('TEXT_MAIN', '');
define('TEXT_ARTICLE_NAME', 'Article Name:');
define('TEXT_ARTICLE_PLACEMENT', 'Placement:');
define('TEXT_ARTICLE_SUBMITTED',
    'Congratulations! Your article has been successfully submitted.');
define('TEXT_ARTICLE_TEXT', 'Article: (below)');
define('TEXT_ARTICLE_UPLOAD_IMAGE', 'Upload an Image:');

define('TEXT_SHORT_DESCRIPTION', 'Short Description:');
define('TEXT_SELECT_TOPIC', 'Choose a Topic');

define('TEXT_AUTHORS_NAME', 'Authors Name:');
define('TEXT_AUTHORS_IMAGE', 'Authors Image:');
define('TEXT_AUTHORS_INFO', 'Authors Info:');

define('IMAGE_BUTTON_SUBMIT', 'Submit');

define('ARTICLES_EMAIL_TEXT_BODY',
    'An article has been submitted by %s with the name of %s in the %s topic.');
define('ARTICLES_EMAIL_TEXT_SUBJECT', 'An article has been submitted for %s');

define('ERROR_ARTICLE_META_DESC', 'A short description is required.');
define('ERROR_ARTICLE_NAME', 'A name for the article is required.');
define('ERROR_ARTICLE_TEXT', 'The body of the article is required.');
define('ERROR_AUTHORS_NAME', 'An authors name is required.');
define('ERROR_INVALID_TOPIC', 'A topic must be selected.');
define('ERROR_FAILED_IMAGE_UPLOAD', 'Image failed to upload.');
define('ERROR_FAILED_IMAGE_INVALID',
    'Invalid image type. Only gif\'s, jpg\'s and png\'s are accepted image types.');