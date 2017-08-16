<?php
/*
  $Id: header_tags_seo.php,v 1.2 2008/08/08
  header_tags_seo Originally Created by: Jack_mcs
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright 2010 oscommerce-solution.com

  Released under the GNU General Public License
*/
/****************************************************
Module to handle automatic addtion of pseudo topics
and articles in header Tags SEO.
****************************************************/

if (strpos($psedudoPage, ".php") === FALSE || strpos($psedudoPage, "?") === FALSE || strpos($psedudoPage, "=") === FALSE)
{
   $messageStack->add(sprintf(ERROR_INVALID_PSEUDO_FORMAT, $psedudoPage), 'error');
}
else
{
  $parts = explode("?", $psedudoPage);
  $baseFiles = (array)GetBaseFiles();
  if (in_array($parts[0], $baseFiles)) //don't allow pseudo pages for base files
  {
     $messageStack->add(sprintf(ERROR_INVALID_PSEUDO_PAGE, $parts[0]), 'error');
  }

  else if (($result = FileNotUsingHeaderTags($parts[0])) === 'FALSE' || IsTemplate())
  {
      $pageTags_query = tep_db_query("select * from " . TABLE_HEADERTAGS . " where page_name like '" . $psedudoPage . "' and language_id = '" . (int)$language_id. "'");
      $pageTags = tep_db_fetch_array($pageTags_query);

      if (tep_db_num_rows($pageTags_query) == 0)
      {
         $filenameInc = DIR_FS_CATALOG. DIR_WS_INCLUDES . 'header_tags.php';
         $fp = @file($filenameInc);  
        
         if (AddedToHeaderTagsIncludesFilePseudo($psedudoPage, $fp, $languages_id))
         {
            if (WriteHeaderTagsFile($filenameInc, $fp))
            {             
              $pageTags_query = tep_db_query("select * from " . TABLE_HEADERTAGS . " where page_name like '" . $psedudoPage . "' and language_id = '" . (int)$language_id. "'");
              if (tep_db_num_rows($pageTags_query) == 0)
              {
                for ($a=0; $a < count($languages); ++$a)
                {
                   $sql_data_array = array('page_name' => $psedudoPage,
                                           'page_title' => '',
                                           'page_description' => '',
                                           'page_keywords' => '',
                                           'page_logo' => '',
                                           'page_logo_1' => '',
                                           'page_logo_2' => '',
                                           'page_logo_3' => '',
                                           'page_logo_4' => '',
                                           'append_default_title' => 0,
                                           'append_default_description' => 0,
                                           'append_default_keywords' => 0,
                                           'append_default_logo' => 0,
                                           'append_category' =>  0,
                                           'append_manufacturer' =>  0,
                                           'append_product' =>  0,
                                           'append_root' =>  1,
                                           'sortorder_title' =>  0,
                                           'sortorder_description' =>  0,
                                           'sortorder_keywords' =>  0,
                                           'sortorder_logo' =>  0,
                                           'sortorder_logo_1' =>  0,
                                           'sortorder_logo_2' =>  0,
                                           'sortorder_logo_3' =>  0,
                                           'sortorder_logo_4' =>  0,
                                           'sortorder_category' =>  0,
                                           'sortorder_manufacturer' =>  0,
                                           'sortorder_product' =>  0,
                                           'sortorder_root' =>  1,
                                           'sortorder_root_1' =>  0,
                                           'sortorder_root_2' =>  0,
                                           'sortorder_root_3' =>  0,
                                           'sortorder_root_4' =>  0,
                                           'language_id' => $languages[$a]['id']);

                   tep_db_perform(TABLE_HEADERTAGS, $sql_data_array);
                }
                $newfiles = GetFileList($languages_id);
              }
            }
         }
      }
      else
        $messageStack->add(sprintf(ERROR_DUPLICATE_PAGE, $psedudoPage), 'error'); 
  }
  else if ($result != 'TRUE')
   $messageStack->add(sprintf(ERROR_NOT_USING_HEADER_TAGS, $parts[0]), 'error');
}
?>