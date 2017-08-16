<?php
/*
  $Id: header_tags_seo_cron.php,v 1.2 2013/12/08
  header_tags_seo Originally Created by: Jack York - http://www.oscommerce-solution.com
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright 2013 oscommerce-solution.com

  Released under the GNU General Public License
*/
 
  require('includes/application_top.php');
   
  $str = 'Begin Header Tags SEO Cron Update - ' . date('l jS \of F Y h:i:s A') . "<br /><br />\n\n";

  /********** UPDATE THE CATEGORIES **********/
  $changedStr = "<br />\n\n";
  $res = tep_db_query("UPDATE categories_description SET categories_htc_title_tag = categories_name where categories_htc_title_tag = ''");
  if (defined("tep_db_affected_rows")) $changedStr .= sprintf("Changed %d category titles<br />\n", tep_db_affected_rows());                                                       
  $res = tep_db_query("UPDATE categories_description SET categories_htc_desc_tag = categories_name where categories_htc_desc_tag = ''");  
  if (defined("tep_db_affected_rows")) $changedStr .= sprintf("Changed %d category descriptions<br />\n", tep_db_affected_rows());                                                       
  $res = tep_db_query("UPDATE categories_description SET categories_htc_keywords_tag = categories_name where categories_htc_keywords_tag = ''"); 
  if (defined("tep_db_affected_rows")) $changedStr .= sprintf("Changed %d category keywords<br />\n", tep_db_affected_rows());                                                       
  $str .= ($res ? 'All Categories have been updated.' . $changedStr : 'Categories failed to update properly.') . "<br /><br />\n\n";

  /********** UPDATE THE MANUFACTURERS **********/
  $changedStr = "<br />\n\n";
  $res = tep_db_query("update manufacturers_info mi set manufacturers_htc_title_tag = ( select manufacturers_name FROM manufacturers m where m.manufacturers_id = mi.manufacturers_id) where manufacturers_htc_title_tag = ''");
  if (defined("tep_db_affected_rows")) $changedStr .= sprintf("Changed %d manufacturer titles<br />\n", tep_db_affected_rows());                                                       
  $res = tep_db_query("update manufacturers_info mi set manufacturers_htc_desc_tag = ( select manufacturers_name FROM manufacturers m where m.manufacturers_id = mi.manufacturers_id) where manufacturers_htc_desc_tag = ''");
  if (defined("tep_db_affected_rows")) $changedStr .= sprintf("Changed %d manufacturer descriptions<br />\n", tep_db_affected_rows());                                                       
  $res = tep_db_query("update manufacturers_info mi set manufacturers_htc_keywords_tag = ( select manufacturers_name FROM manufacturers m where m.manufacturers_id = mi.manufacturers_id) where manufacturers_htc_keywords_tag = ''");
  if (defined("tep_db_affected_rows")) $changedStr .= sprintf("Changed %d manufacturer keywords<br />\n", tep_db_affected_rows());                                                       
  $str .= ($res ? 'All Manufacturers have been updated.' . $changedStr : 'Manufacturers failed to update properly.') . "<br /><br />\n\n";

  /********** UPDATE THE PRODUCTS **********/  
  $changedStr = "<br />\n\n";
  $res = tep_db_query("UPDATE products_description SET products_head_title_tag = products_name where products_head_title_tag = ''");
  if (defined("tep_db_affected_rows")) $changedStr .= sprintf("Changed %d product titles<br />\n", tep_db_affected_rows());                                                       
  $res = tep_db_query("UPDATE products_description SET products_head_desc_tag = products_name where products_head_desc_tag = ''");
  if (defined("tep_db_affected_rows")) $changedStr .= sprintf("Changed %d product descriptions<br />\n", tep_db_affected_rows());                                                       
  $res = tep_db_query("UPDATE products_description SET products_head_keywords_tag = products_name where products_head_keywords_tag = ''");
  if (defined("tep_db_affected_rows")) $changedStr .= sprintf("Changed %d product keywords<br />\n", tep_db_affected_rows());                                                       
  $str .= ($res ? 'All Products have been updated.' . $changedStr : 'Products failed to update properly.') . "<br /><br />\n\n";

  
  $str .= 'End Header Tags SEO Cron Update' . "<br />\n";
  //echo $str;  
  tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, 'Header Tags SEO Cron Update Report', $str, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

  

