<?php
/*
  $Id: header_tags_seo.php,v 1.0 2008/04/04 22:50:52 hpdl Exp $
  Originally Created by: Jack York - http://www.oscommerce-solution.com
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright 2009 oscommerce-solution.com

  Released under the GNU General Public License
*/

function AddMissingPages($languages_id = 1, $languages) {
    ($dir = opendir(DIR_FS_CATALOG)) || die(sprintf(ERROR_FAILED_DIR_OPEN, DIR_FS_CATALOG));
    $newfiles = array();
    $fileList = array();
    $existingInDB = array();

    $pageTags_query = tep_db_query("select page_name from " . TABLE_HEADERTAGS . ' where language_id = ' . (int)$languages_id);
    while ($pageTags = tep_db_fetch_array($pageTags_query)) {
        if (! in_array($pageTags['page_name'], $existingInDB)) {
            $existingInDB[] = $pageTags['page_name'];
        }
    }
    
    $excludeFilesList = array();
    $excludeFilesList[] = 'account.php';
    $excludeFilesList[] = 'account_edit.php';
    $excludeFilesList[] = 'account_history.php';
    $excludeFilesList[] = 'account_history_info.php';
    $excludeFilesList[] = 'account_newsletters.php';
    $excludeFilesList[] = 'account_notifications.php';
    $excludeFilesList[] = 'account_password.php';
    $excludeFilesList[] = 'address_book.php';
    $excludeFilesList[] = 'address_book_process.php';
    $excludeFilesList[] = 'advanced_search_result.php';
    $excludeFilesList[] = 'checkout_confirmation.php';
    $excludeFilesList[] = 'checkout_payment.php';
    $excludeFilesList[] = 'checkout_payment_address.php';
    $excludeFilesList[] = 'checkout_process.php';
    $excludeFilesList[] = 'checkout_shipping.php';
    $excludeFilesList[] = 'checkout_shipping_address.php';
    $excludeFilesList[] = 'checkout_success.php';
    $excludeFilesList[] = 'create_account.php';
    $excludeFilesList[] = 'create_account_success.php';
    $excludeFilesList[] = 'headertags_seo_install.php';
    $excludeFilesList[] = 'headertags_seo_uninstall.php';
    $excludeFilesList[] = 'login.php';
    $excludeFilesList[] = 'logoff.php';
    $excludeFilesList[] = 'opensearch.php';        
    $excludeFilesList[] = 'password_forgotten.php';
    $excludeFilesList[] = 'popup_image.php';
    $excludeFilesList[] = 'popup_search_help.php';
    $excludeFilesList[] = 'product_reviews_info.php';
    $excludeFilesList[] = 'ssl_check.php';
    
    $extra_excludes = 'includes/headertags_seo_excludes.txt';
    if (file_exists($extra_excludes)) {
        $extra = file($extra_excludes, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $excludeFilesList = array_merge($excludeFilesList, $extra);        
    }
        
    $fileAdded = false;
    $fileSaved = false;
    $filenameInc = DIR_FS_CATALOG. DIR_WS_INCLUDES . 'header_tags.php';
    $fp = @file($filenameInc);
    $isTemplate = IsTemplate();

    if ($fp) {
        while(false !== ($file = readdir($dir))) {
            if(! is_dir($file) && substr($file, -4, 4) === ".php") { //only look at php files
                if (($result = FileNotUsingHeaderTags($file)) === 'FALSE' || $isTemplate) { //header tags title code is in file
                    $presentInDB = in_array($file, $existingInDB);
                    $notDuplicatePage = NotDuplicatePage($fp, $file);
                    $excludedFile = in_array($file, $excludeFilesList);
                    
                    if (($presentInDB && $notDuplicatePage) || (! $presentInDB && ! $excludedFile)) {
                      if (($addResult = AddedToHeaderTagsIncludesFile($file, $fp, $languages_id, $notDuplicatePage))) { //the new file was added to includes/header_tags.php
                        $fileAdded = true;                      //OK to write file
                      }
                    }

                    if (! $excludedFile) {
                        if ($presentInDB || $addResult) {      //file was added to the includes/header_tags.php file so add to the database
                            $newfiles[] = $file;
                        } else if (! $presentInDB && ! $addResult) { //file was already in the includes/header_tags.php file but not in the DB so add to the DB
                             $newfiles[] = $file;
                        }
                    }
                } else if ($result !== 'TRUE') {
                    echo $result;
                }
            }
        }

        if ($fileAdded) {
            $fileSaved = WriteHeaderTagsFile($filenameInc, $fp);
        }
    }

    $cntNewFiles = count($newfiles);
    
    if (($fileSaved && $cntNewFiles) || (! $fileSaved && (count($existingFiles) != $cntNewFiles))) {     
        for ($i = 0; $i < $cntNewFiles; ++$i) {
            if (! in_array($newfiles[$i], $existingInDB)) {
                for ($t = 0; $t < count($languages); ++$t) {
                    $sql_data_array = array('page_name' => $newfiles[$i],
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
                                            'append_model' =>  0,
                                            'append_product' =>  1,
                                            'append_root' =>  1,
                                            'sortorder_title' =>  0,
                                            'sortorder_description' =>  0,
                                            'sortorder_keywords' =>  0,
                                            'sortorder_logo' =>  0,
                                            'sortorder_category' =>  0,
                                            'sortorder_manufacturer' =>  0,
                                            'sortorder_model' =>  0,
                                            'sortorder_product' =>  10,
                                            'sortorder_root' =>  1,
                                            'sortorder_root_1' =>  1,
                                            'sortorder_root_2' =>  1,
                                            'sortorder_root_3' =>  1,
                                            'sortorder_root_4' =>  1,
                                            'language_id' => $languages[$t]['id']);

                    tep_db_perform(TABLE_HEADERTAGS, $sql_data_array);
                }
            }
        }  
    }

    /************ Rebuild the pseudo file code if they are present in the database ************/    
    $pseudoFiles = array();
    $db_query = tep_db_query("select page_name from " . TABLE_HEADERTAGS . " where page_name LIKE '%?%'");
    if (tep_db_num_rows($db_query)) {
        while ($db = tep_db_fetch_array($db_query)) {  //only existing pseudo pages are returned
            $pos = strpos($db['page_name'], '=') + 1;  //remove the ID
            $name = substr($db['page_name'], 0, $pos);
            if (! in_array($name, $pseudoFiles)) {
                $pseudoFiles[] = $name;                //only use once
            }
        }   
        
        foreach ($pseudoFiles as $file) {
            $fp = @file($filenameInc);
           
                if (AddedToHeaderTagsIncludesFilePseudo($file, $fp, $languages_id)) {
                    WriteHeaderTagsFile($filenameInc, $fp);
                }
        }
    }
    
    return GetFileList($languages_id);
}

function AddedToHeaderTagsIncludesFile($file, &$fp, $languages_id, $notDuplicatePage) { //add a new entry to the includes/header_tags.php file if not present
   if (! $fp) {
      echo sprintf(ERROR_FAILED_FILE_OPEN, $file);
      return false;     //needed for testing failure - bool won't work
   }

   if ($notDuplicatePage) {
      $insertPoint = 0;
      $markPoint = count($fp) - 1;
      $path = DIR_FS_CATALOG . 'includes/filenames.php';
      $lines = array();
      $lines = @file($path);  //load in the filenames file

      for ($idx = 0; $idx < count($fp); ++$idx) { //find where to insert the new page
         $section = GetSectionName($fp[$idx]);

         if (! empty($section)) {
            if (strcasecmp($section, $file) < 0) {
               $lastSection = $section;
               $markPoint = $idx;
            } else if (strcasecmp($section, $file) > 0) {
               if ($insertPoint == 0)
                 $insertPoint = $idx;
            }
         } else if (strpos($fp[$idx], "// ALL OTHER PAGES NOT DEFINED ABOVE") !== FALSE) {
            $insertPoint = $idx;
            break;
         }
      }

      if ($insertPoint != count($fp))              //backup one line for appearance
        $insertPoint--;

      /*************** VERIFY THE DEFINED FILENAME IS THE SAME AS THE FILE ******************/
      $fileMatch = false;
      foreach ($lines as $name) {
         $definedFileName = explode("'", $name);

         
         if (isset($definedFileName[count($definedFileName) - 2])) { //save some loops
            if ($definedFileName[count($definedFileName) - 2] === $file) { //actual filenames match
               $fileUpper = substr(strtoupper($definedFileName[1]), strlen('FILENAME_')); //so save the defined name
               $fileMatch = true;
               break;
            }
         }
      }
      
      if ($fileMatch && strpos($file, " ") !== FALSE) {  //filename contains an illegal space
          $fileMatch = false;
      }         

      if (! $fileMatch) {                     //couldn't find a match
         global $messageStack;
         $fix = '<a href="' . tep_href_link('headertags_seo_exclude.php', 'exclude=' . $file) . '"><span style="color:#00dd00; font-size:10ps;">' . ERROR_INVALID_FILENAME_EXCLUDE . '</span></a>&nbsp;&nbsp;&nbsp;&nbsp;';
         $fix .= '<a href="' . tep_href_link('headertags_seo_exclude.php', 'delete=' . $file) . '"><span style="color:#00dd00; font-size:10ps;">' . ERROR_INVALID_FILENAME_DELETE . '</span></a>';
         $messageStack->add(sprintf(ERROR_INVALID_FILENAME, $file . ' ' . $fix), 'error');
         return false;
      } 

      $fileUpper = strtoupper(substr($file, 0, -4));   //it looks like the name is valid 
      $fileUpper = str_replace('-', '_',$fileUpper);   //for file names with hyphes
      $spaces = 10;
      $incArray = array();
      $incArray['page'] = sprintf("\n// %s\n", $file);  
      $incArray['case'] = sprintf("  case (basename(\$_SERVER['SCRIPT_FILENAME']) === FILENAME_%s):\n",$fileUpper, $fileUpper);
      $incArray['line'] .= "    if (! ReadCacheHeaderTags(\$header_tags_array, basename(\$_SERVER['SCRIPT_FILENAME']), '')) {". "\n";
      $incArray['line'] .= sprintf("      \$header_tags_array = tep_header_tag_page(FILENAME_%s);\n",$fileUpper );
      $incArray['line'] .= "      WriteCacheHeaderTags(\$header_tags_array, basename(\$_SERVER['SCRIPT_FILENAME']), '');\n    }\n  break;\n";

      array_splice($fp, (int)$insertPoint, 0, $incArray);
      return true;  
   }
   return false;
}

function AddedToHeaderTagsIncludesFilePseudo($file, &$fp, $languages_id) { //add a new entry to the includes/header_tags.php file if not present
    if (! $fp) {
        echo sprintf(ERROR_FAILED_FILE_OPEN, $file);
        return false; 
    }     

    $beginSection = '';
    $firstLine = true;     //needs to be here for a larger scope
    $parts = explode("?", $file);
    $cnt = count($fp);

    if (NotDuplicatePage($fp, $parts[0])) {
        $insertPoint = 0;
        $markPoint = count($fp) - 1;
        
        for ($idx = 0; $idx < $cnt; ++$idx) { //find where to insert the new page
            $section = GetSectionName($fp[$idx]);   

            if (! empty($section)) {
                if (strcasecmp($section, $file) < 0) {         
                    $lastSection = $section;    
                    $markPoint = $idx;       
                } else if (strcasecmp($section, $file) > 0) {
                    if ($insertPoint == 0) {
                        $insertPoint = $idx;
                    } 
                }                  
            } else if (strpos($fp[$idx], "// ALL OTHER PAGES NOT DEFINED ABOVE") !== FALSE) { 
                $insertPoint = $idx;
                break;
            }    
        }
        if ($insertPoint != $cnt) {             //backup one line for appearance
            $insertPoint--;      
        }  
        $beginSection = $insertPoint;       
    } else { // the main page exists so just add after it
        $addPseudoCode = true;
        $insertPoint = '';
        $beginSection = '';

        for ($idx = 0; $idx < $cnt; ++$idx) {
            if (! $firstLine) {
                if (strpos($fp[$idx], "header_tags_array =") !== FALSE) {
                    if (empty($insertPoint)) {
                      $insertPoint = $idx; //find the line to add before
                    }  
                } else if (strpos($fp[$idx], "page =") !== FALSE && ($idx - $beginSection < 4) ) {
                    $addPseudoCode = false; //pseudo code exists so just leave
                    break;
                }
            } else if (strcasecmp(GetSectionName($fp[$idx]), $parts[0]) === 0) {
                $firstLine = false; //find the main page name
                $beginSection = $idx;       
            }
        }
    }

    $fileUpper = strtoupper(substr($parts[0], 0, -4));   //so assume name is valid since it exists
    $fileUpper = str_replace('-', '_',$fileUpper);   //for file names with hyphes
    $spaces = 10;
    $incArray = array();

    if ($firstLine) { //the line already exists
        $incArray['page'] = sprintf("\n// %s\n", $parts[0]); 
        $incArray['case'] = sprintf("  case (basename(\$_SERVER['SCRIPT_FILENAME']) === FILENAME_%s):\n",$fileUpper, $fileUpper);
    }

    if ($addPseudoCode) {  //pseudo code already exists so don't add again
    
        $endLine = '';
        for ($e = $beginSection; ; ++$e) {
            if (strpos($fp[$e], 'break') !== FALSE) {
             //echo 'end line '.$e;
             $endLine = $e;
             break;
            } 
        }  
    
        for ($d = $endLine; $d > $beginSection + 1; --$d) {
            unset($fp[$d]);
        }    

        $incArray['pseudo'] .= "    include(DIR_WS_MODULES . 'header_tags_pseudo.php');" . "\n";
        $incArray['pseudo'] .= "  break;" . "\n";
    }
 
    array_splice($fp, ((int)$beginSection + 2), 0, $incArray);
    return true;  
}

function BuildGenericString($set, &$addComma, $field, $name, $option, $text, $allowNull = false) {
  if ($allowNull || tep_not_null($text))
  {
    $findArray = array("UPPER_ITEMNAME", "ITEMNAME");
    $replaceArray = array(strtoupper($name), $name);

    if (isset($option) && $option == 'on') 
    {          
      $str = str_replace($findArray, $replaceArray, $text);
      $set .= $addComma . ' '. $field . '="' . addslashes($str). '"';
      $addComma = ',';  
    }
  } 
  return $set;
}

function CheckForMissingTags($fullList = false, $checkDesc = false, &$justAmt = array()) {
  /***************** Check Products ***************/
  $missingStr = '';
  $products_query = tep_db_query("select p.products_id, pd.products_name, pd.language_id from " . TABLE_PRODUCTS . " p left join " .  TABLE_PRODUCTS_DESCRIPTION . " pd on (p.products_id = pd.products_id) where p.products_status = 1 and (pd.products_head_title_tag = '' or pd.products_head_title_tag IS NULL or pd.products_head_desc_tag = '' or pd.products_head_desc_tag IS NULL or pd.products_head_keywords_tag = '' or pd.products_head_keywords_tag IS NULL )");
  if (tep_db_num_rows($products_query) > 0)   {
    if ($fullList) {
      $missingStr = '<tr><td>&nbsp;</td></tr><tr><td class="smalltext" style="font-weight: bold;">Products</td></tr>';
      while ($products = tep_db_fetch_array($products_query)) {
        $missingStr .= '<tr class=smallText">';
        $missingStr .= '<td><a class="htc_Link" href="' . tep_href_link(FILENAME_CATEGORIES, 'action=new_product&pID=' . $products['products_id']) . '">' . (tep_not_null($products['products_name']) ? $products['products_name'] : ERROR_NO_NAME) . '</a></td>';
        $missingStr .= '</tr>';
      }
    } else {
      $missingStr .= sprintf(ERROR_MISSING_TAGS_TYPE, 'Products', tep_db_num_rows($products_query));
      $justAmt['products'] = tep_db_num_rows($products_query);
    }  
  }

  /***************** Check Categories ***************/  
  $desc = ($checkDesc) ? " or categories_htc_description = '' or categories_htc_description IS NULL " : '';   
  $categories_query = tep_db_query("select categories_id, categories_name, language_id from " . TABLE_CATEGORIES_DESCRIPTION . " where (categories_htc_title_tag = '' or categories_htc_title_tag IS NULL or categories_htc_desc_tag = '' or categories_htc_desc_tag IS NULL or categories_htc_keywords_tag = '' or categories_htc_keywords_tag IS NULL $desc)");
  if (tep_db_num_rows($categories_query) > 0) {
    if ($fullList) {
      if (tep_not_null($missingStr))
        $missingStr .= '<tr><td height="6"></td></tr>';
      $missingStr .= '<tr><td class="smalltext" style="font-weight: bold;">Categories</td></tr>';

      while ($categories = tep_db_fetch_array($categories_query)) {
        $missingStr .= '<tr class=smallText">';
        $missingStr .= '<td><a class="htc_Link" href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=&cID=' . $categories['categories_id']) . '">' . (tep_not_null($categories['categories_name']) ? $categories['categories_name'] : ERROR_NO_NAME) . '</a></td>';
        $missingStr .= '</tr>';      
      }
    } else { 
      $missingStr .= sprintf(ERROR_MISSING_TAGS_TYPE, 'Categories', tep_db_num_rows($categories_query));
      $justAmt['cats'] = tep_db_num_rows($categories_query);
    }  
  }  

  /***************** Check Manufacturers ***************/  
  $desc = ($checkDesc) ? " or manufacturers_htc_description = '' or manufacturers_htc_description IS NULL " : '';   
  $manufacturers_query = tep_db_query("select mi.manufacturers_id, mi.languages_id, m.manufacturers_name from " . TABLE_MANUFACTURERS_INFO . " mi left join " . TABLE_MANUFACTURERS . " m on (mi.manufacturers_id = m.manufacturers_id) where (mi.manufacturers_htc_title_tag = '' or mi.manufacturers_htc_title_tag IS NULL or mi.manufacturers_htc_desc_tag = '' or mi.manufacturers_htc_desc_tag IS NULL or mi.manufacturers_htc_keywords_tag = '' or mi.manufacturers_htc_keywords_tag IS NULL $desc)");
  if (tep_db_num_rows($manufacturers_query) > 0) {
    if ($fullList) {
      if (tep_not_null($missingStr))
        $missingStr .= '<tr><td height="6"></td></tr>';
      $missingStr .= '<tr><td class="smalltext" style="font-weight: bold;">Manufacturers</td></tr>';

      while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
        $missingStr .= '<tr class=smallText">';
        $missingStr .= '<td><a class="htc_Link" href="' . tep_href_link(FILENAME_MANUFACTURERS, 'page=1&mID=' . $manufacturers['manufacturers_id']) . '">' . (tep_not_null($manufacturers['manufacturers_name']) ? $manufacturers['manufacturers_name'] : ERROR_NO_NAME) . '</a></td>';
        $missingStr .= '</tr>';       
      }
    } else {
      $missingStr .= sprintf(ERROR_MISSING_TAGS_TYPE, 'Manufacturers', tep_db_num_rows($manufacturers_query));
      $justAmt['manu'] = tep_db_num_rows($manufacturers_query);
    }
 }   

  return $missingStr;  
}

function DeletePage($page_to_delete) {
   $path = DIR_FS_CATALOG . 'includes/header_tags.php';
   $lines = array();
   //$lines = GetFileArray(DIR_FS_CATALOG . 'includes/header_tags.php'); /fails due to permissions
   $lines = @file($path);  //use this instead 
   $found = false; 
   $delStart = 0;
   $delStop = 0;

   for ($idx = 0; $idx < count($lines); ++$idx) {
      if (! $found && (strpos($lines[$idx], $page_to_delete) !== FALSE || strpos($lines[$idx], strtoupper($page_to_delete))) !== FALSE) {
         $delStart = $idx; // + 1;  //adjust for 0 start
         $found = true;
      } else if ($found && ( strpos($lines[$idx], "ALL OTHER PAGES NOT DEFINED ABOVE") === FALSE && strpos($lines[$idx], "//") === FALSE && strpos($lines[$idx], ".php") === FALSE)) {
         $delStop++;
      } else if ($found && (strpos($lines[$idx], "ALL OTHER PAGES NOT DEFINED ABOVE") !== FALSE  || (strpos($lines[$idx], "//") !== FALSE && strpos($lines[$idx], ".php") !== FALSE))) {
         $delStop++; 
         break;
      }                  
   }     

   if ($found == true) {         //page entry may not be present
      array_splice($lines, $delStart, $delStop);
      return WriteHeaderTagsFile($path, $lines);
   }   
   return true;   //file wasn't present
}
 
function FileNotUsingHeaderTags($file) {
  $file = DIR_FS_CATALOG . $file;

  if (($fp = @file($file))) {
    for ($i = 0; $i < count($fp); ++$i) {
      if (strpos($fp[$i], "DIR_WS_INCLUDES . 'header_tags.php'") !== FALSE) {
        return 'FALSE';
      }  
    }
    return 'TRUE';
  }
  else
   return sprintf(ERROR_FAILED_FILE_OPEN, $file);

  return 'TRUE'; 
}

/*******************************************************************
Finds the actual position of the language in the languages array
/******************************************************************/
function IsValidLanguage($id, $languages) {
    for ($i = 0; $i < count($languages); ++$i) {
        if ($languages[$i]['id'] == $id) {
            return $i;  //return the position in the array
        }    
    }    
    return FALSE;
}

function RemoveSymbols($string) {
  $symbols = array('/','\\','"',',','.','<','>','?',';',':','[',']','{','}','|','=','+','-','_',')','(','*','&','^','%','$','#','@','!','~','`','nbsp'	); //this will remove punctuation
  for ($i = 0; $i < sizeof($symbols); $i++) {
  	  $string = trim(str_replace($symbols[$i],' ',$string));
  }
  return $string;
}

function in_array_nocase($search, &$array) {
  $search = strtolower($search);
  foreach ($array as $item)
    if (strtolower($item) == $search)
      return TRUE;
  return FALSE;
} 

function GetBaseFiles() {
  $baseFiles = array();
  $baseFiles = array(0 => 'index.php', 
                     1 => 'product_info.php',
                     2 => 'product_reviews.php',
                     3 => 'product_reviews_info.php',
                     4 => 'product_reviews_write.php',
                     5 => 'products_new.php',
                     6 => 'specials.php');
  return $baseFiles;
}

function GetKeywordsFromSite($pageName) { //attempts to figure out the best keywords to use from the page on the site based on keyword density
  $path = HTTP_SERVER . DIR_WS_CATALOG . $pageName;
  $path = str_replace("https:", "http:", $path);
  $lines = array();
  $lines = GetFileArray($path);

  if (count($lines) > 1) {
    $ignoreWords = array();
    $ignoreWords = @file('includes/header_tags_seo_words.txt');

    if (count($ignoreWords) > 1) {
      for ($t=0; $t<count($ignoreWords); ++$t) {
       $ignoreWords[$t] = trim($ignoreWords[$t]);
      } 

      $lineArray = array(); 
      $singleWords = array();  
      $startCnt = false;
      $wordCnt = 0;
      list($kd_limitBot, $kd_limitTop) = explode(",", HEADER_TAGS_KEYWORD_DENSITY_RANGE);

      for ($i = 0; $i < count($lines); ++$i) {
        if (! $startCnt && strpos($lines[$i], "<!-- body_text //-->") === FALSE)
          continue;

        $startCnt = true;

        $lines[$i] = strip_tags($lines[$i]);
        if (! tep_not_null($lines[$i]))
          continue;

        $words = explode(" ", $lines[$i]);    //break this line into words

        for ($w = 0; $w < count($words); ++$w) { //go through the words and add to the list
          $words[$w] = RemoveSymbols($words[$w]);  
          if (in_array_nocase($words[$w], $ignoreWords) || is_numeric($words[$w]) || $words[$w] === '')
            continue;

          $singleWords[$words[$w]] = isset($singleWords[$words[$w]]) ? $singleWords[$words[$w]] + 1 : 1;
          $wordCnt++;                      
        }

        if (! $startCnt && strpos($lines[$i], "<!-- body_text_eof //-->") === FALSE) 
          break; 
      }

      $keywordsList = ''; 
      foreach ($singleWords as $key => $data) {
        $kd = (float)($data / $wordCnt);

        if ($kd > $kd_limitBot && $kd < $kd_limitTop) { //KD for word is between that set in admin
          if (tep_not_null($keywordList))
           $keywordList .= ',';
          $keywordList .= $key;
        }  
      }
      return (tep_not_null($keywordList) ? $keywordList: sprintf(ERROR_FAILED_NO_KEYWORDS_FOUND, $pageName));      
    }
    else
     return (sprintf(ERROR_FAILED_WORDS, 'includes/header_tags_seo_words.txt'));
  }
  else
    return (sprintf(ERROR_FAILED_PAGE_LOAD, $path));  
}

if (! function_exists('GetFileArray')) {
  function GetFileArray($path) {
    $lines = array();

    if (function_exists('curl_init')) {
       $ch = curl_init();
       $timeout = 5; // set to zero for no timeout
       curl_setopt ($ch, CURLOPT_URL, $path);
       curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
       $file_contents = curl_exec($ch);
       curl_close($ch);
       $lines = explode("\n", $file_contents);
    }
    else
       $lines = @file($path); 

    return $lines;  
  }
}

function GetFileList($languages_id = 1) {
    $newfiles = array();

    SetBaseFilesToDefaultLanguage($languages_id); //make sure the default language matches the default files

    if ($handle = @opendir(DIR_FS_CATALOG)) {
         $found = false;
         $newfiles = array();
         $newfilesHdr = array();
         $newfilesHdr[] = array('id' => SELECT_A_FILE, 'text' => SELECT_A_FILE);
         $newfilesHdr[] = array('id' => SHOW_ALL_FILES, 'text' => SHOW_ALL_FILES);
         $newfilesHdr[] = array('id' => ADD_MISSING_PAGES, 'text' => ADD_MISSING_PAGES);
         $isTemplate = IsTemplate(); 

         while (false !== ($file = readdir($handle))) { 
             if (strpos($file, '.php') === FALSE) {
                 continue;       
             }   

             if (($result = FileNotUsingHeaderTags($file)) === 'FALSE' || $isTemplate) {
                 $pageTags_query = tep_db_query("select * from " . TABLE_HEADERTAGS . " where page_name like '" . tep_db_input($file) . "' and language_id = '" . (int)$languages_id . "'");
                 $pageTags = tep_db_fetch_array($pageTags_query);
                 if (tep_db_num_rows($pageTags_query)) {
                    $newfiles[] = array('id' => $file, 'text' => $file);
                 }  
             }
             else if ($result !== 'TRUE') {
                echo $result;
             }  
         }
         closedir($handle); 

         /************** Add the pseudo pages ***************/    
         $pageTags_query = tep_db_query("select * from " . TABLE_HEADERTAGS . " where page_name like '%?%' and language_id = '" . (int)$languages_id . "'");
         while ($pageTags = tep_db_fetch_array($pageTags_query)) {
             $newfiles[] = array('id' => $pageTags['page_name'], 'text' => $pageTags['page_name']);
         }  
    }  else {
         echo sprintf(ERROR_FAILED_DIR_OPEN, DIR_FS_CATALOG);
    }   

    $newfiles = SortFileList($newfiles, array(array('key'=>'text')));

    return array_merge($newfilesHdr, (array)$newfiles);
}  

function GetFilesWithHeaderTagsInclude($dir) { //returns all files in the root dir that calls includes/header_tags.php
  $newfiles = array();
  if ($handle = @opendir($dir)) {
    while (false !== ($file = readdir($handle))) { 
       if (strpos($file, '.php') === FALSE)
          continue;       

       if (($result = FileNotUsingHeaderTags($file)) === 'FALSE') {
         $newfiles[] = $file;
       }
       else if ($result !== 'TRUE')
         echo $result;
    }
    closedir($handle);
  }
  return $newfiles;   
}

/********************************************************************************
Language ID's may not be contiguous and the array is not sorted so this
returns the highest ID
********************************************************************************/
function GetHighestLanguageID($languages) {
    $highestID = 0;

    for ($i = 0; $i < count($languages); ++$i) {
        if ($languages[$i]['id'] > $highestID) {
            $highestID = $languages[$i]['id'];
        }
    }
    return $highestID;
}

/********************************************************************************
Return the key of the file array for the selected item
********************************************************************************/
function GetKey($fileList, $file) { 
   for ($i = 0; $i < count($fileList); ++$i) {
      if ($fileList[$i]['text'] === $file) {         
         if ($i == 0) 
           return SELECT_A_FILE;
         else if ($i == 1) 
           return SHOW_ALL_FILES;
         else if ($i == 2) 
           return ADD_MISSING_PAGES;
         else  
           return $i;
      }   
   }
} 

/********************************************************************************
Returns an array suitable for a dropdown
********************************************************************************/
function GetkeywordsHTS($keywordsArray, $language_id) {
    $listArray = array();

    if (tep_not_null($keywordsArray)) {
        $listArray[] = array('id' => TEXT_KEYWORD_SELECT, 'text' => TEXT_KEYWORD_SELECT);
        foreach ($keywordsArray as $kw) {
            if ($kw['language_id'] == $language_id) {
                $listArray[] = array('id' => $kw['keyword'], 'text' => $kw['keyword']);
            }
        }
    }
    return $listArray;
}

/********************************************************************************
Return an array of stats for the top of Page Control
********************************************************************************/
function GetQuickStats($missingArray) {
    $statsArray  = array();
    
    $db_query = tep_db_query("select count(*) as ttl from categories_description where ( categories_htc_description IS NULL or categories_htc_description = '')");
    $db = tep_db_fetch_array($db_query);
    $statsArray['cat_desc'] = ($db['ttl'] ? $db['ttl'] : '0');

    $db_query = tep_db_query("select count(*) as ttl from manufacturers_info where ( manufacturers_htc_description IS NULL or manufacturers_htc_description = '')");
    $db = tep_db_fetch_array($db_query);
    $statsArray['manu_desc'] = ($db['ttl'] ? $db['ttl'] : '0');
    
    $kwords = GetSearchCounts();
    $statsArray['keywords_not_found'] = $kwords['notfound_words']; 
    $statsArray['keywords_searched'] = $kwords['ttl_words']; 
    
    $statsArray['missing_p'] = ($missingArray['products'] > 0 ? $missingArray['products'] : 0);  //already ran above so don't redo      
    $statsArray['missing_c'] = ($missingArray['cats'] > 0 ? $missingArray['cats'] : 0);        
    $statsArray['missing_m'] = ($missingArray['manu'] > 0 ? $missingArray['manu'] : 0);     
    
    return $statsArray;    
}

function GetMetaInfo($pageName) {
    $metaInfo = array();

    if (substr_count($pageName, '?') > 1) { // this is a pseudo page
        $parts = explode('?', $pageName);
        $lang = substr($parts[2], strpos($parts[2], '=') + 1);
        $lang_query = tep_db_query("select languages_id from " . TABLE_LANGUAGES . " where code = '" . tep_db_input($lang) . "'");
        $lang = tep_db_fetch_array($lang_query);
        $name = $parts[0] . '?' . $parts[1];
        $tags_query = tep_db_query("select page_title as title, page_description as description, page_keywords as keywords from " . TABLE_HEADERTAGS . " where page_name = '" . tep_db_input($name) . "' and language_id = " . (int)$lang['languages_id']);
        if (tep_db_num_rows($tags_query)) {
            $tags = tep_db_fetch_array($tags_query);
            return $tags;
        }
    } else {
        $path = HTTP_SERVER . DIR_WS_CATALOG . $pageName;
        $path = str_replace("https:", "http:", $path);
        $lines = array();
        $lines = GetFileArray($path);
        $matches = array();

        foreach((array)$lines as $line_num => $line) {
            if (preg_match('/<title>(.*)<\/title>/i', $line, $matches))                         $metaInfo['title'] = $matches[1];
            if (preg_match('/<meta name=\"Description\" content=\"(.*)\"/i', $line, $matches))  $metaInfo['description'] = $matches[1];
            if (preg_match('/<meta name=\"Keywords\" content=\"(.*)\"/i', $line, $matches))     $metaInfo['keywords'] = $matches[1];

            if (tep_not_null($metaInfo['keywords']))
               break;
        }
    }

    return $metaInfo;
}

function GetPermissions($locn) {
  return (sprintf("%d", substr(sprintf('%o', @fileperms($locn)), -3)));
}

function GetPopupText($section) {
  switch ($section) {
    case 'option':
    $optionPopup = array();
    $optionPopup[] = POPUP_OPTION_CAT;
    $optionPopup[] = POPUP_OPTION_MANU;
    $optionPopup[] = POPUP_OPTION_MODEL;    
    $optionPopup[] = POPUP_OPTION_PROD;    
    $optionPopup[] = POPUP_OPTION_ROOT;    
    $optionPopup[] = POPUP_OPTION_TITLE; 
    $optionPopup[] = POPUP_OPTION_DESC; 
    $optionPopup[] = POPUP_OPTION_KYWRDS; 
    $optionPopup[] = POPUP_OPTION_LOGO;
    $optionPopup[] = POPUP_OPTION_CHECKBOX_CAT;
    $optionPopup[] = POPUP_OPTION_CHECKBOX_MANU; 
    $optionPopup[] = POPUP_OPTION_CHECKBOX_MODEL; 
    $optionPopup[] = POPUP_OPTION_CHECKBOX_PROD;     
    $optionPopup[] = POPUP_OPTION_CHECKBOX_ROOT;    
    $optionPopup[] = POPUP_OPTION_CHECKBOX_TITLE; 
    $optionPopup[] = POPUP_OPTION_CHECKBOX_DESC; 
    $optionPopup[] = POPUP_OPTION_CHECKBOX_KYWRDS; 
    $optionPopup[] = POPUP_OPTION_CHECKBOX_LOGO;
    $optionPopup[] = POPUP_OPTION_SORT_CAT;
    $optionPopup[] = POPUP_OPTION_SORT_MANU; 
    $optionPopup[] = POPUP_OPTION_SORT_MODEL; 
    $optionPopup[] = POPUP_OPTION_SORT_PROD;              
    $optionPopup[] = POPUP_OPTION_SORT_ROOT;          
    $optionPopup[] = POPUP_OPTION_SORT_TITLE; 
    $optionPopup[] = POPUP_OPTION_SORT_DESC; 
    $optionPopup[] = POPUP_OPTION_SORT_KYWRDS; 
    $optionPopup[] = POPUP_OPTION_SORT_LOGO;
    return $optionPopup;

    case 'common':
    $commonPopup = array();
    $commonPopup['delete'] = POPUP_COMMON_DELETE;
    $commonPopup['title'] = POPUP_COMMON_TITLE;
    $commonPopup['def_title'] = POPUP_DEFAULT_TITLE;
    $commonPopup['def_desc'] = POPUP_DEFAULT_DESC;
    $commonPopup['def_keywords'] = POPUP_DEFAULT_KYWRDS;
    $commonPopup['def_logo'] = POPUP_DEFAULT_LOGO;       
    $commonPopup['def_home_text'] = POPUP_DEFAULT_HOME_TEXT;       
    $commonPopup['desc'] = POPUP_COMMON_DESC;
    $commonPopup['keywords'] = POPUP_COMMON_KYWRDS;
    $commonPopup['keywords_live'] = POPUP_COMMON_KYWRDS_LIVE;
    $commonPopup['logo'] = POPUP_COMMON_LOGO;
    $commonPopup['logo_extra'] = POPUP_COMMON_LOGO_EXTRA;
    $commonPopup['view'] = POPUP_COMMON_VIEW;    
    $commonPopup['view_title_A'] = POPUP_COMMON_VIEW_TITLE_A;
    $commonPopup['view_title_B'] = POPUP_COMMON_VIEW_TITLE_B;
    $commonPopup['view_desc_A'] = POPUP_COMMON_VIEW_DESC_A;
    $commonPopup['view_desc_B'] = POPUP_COMMON_VIEW_DESC_B;
    $commonPopup['view_keywords_A'] = POPUP_COMMON_VIEW_KEYWORDS_A;
    $commonPopup['view_keywords_B'] = POPUP_COMMON_VIEW_KEYWORDS_B;
    $commonPopup['pseudo_add'] = POPUP_COMMON_PSEUDO_ADD;
    return $commonPopup;

    case 'default':
    $defaultPopup = array();
    $defaultPopup[] = POPUP_DEFAULT_ALL;  
    $defaultPopup[] = POPUP_DEFAULT_CAT;  
    $defaultPopup[] = POPUP_DEFAULT_MANU;  
    $defaultPopup[] = POPUP_DEFAULT_PROD;   
    return $defaultPopup;

    case 'filltags':
    $filltagsPopup = array();    
    $filltagsPopup['clear'] = POPUP_FILTAGS_CLEAR;
    $filltagsPopup['filldesc_yes'] = POPUP_FILTAGS_DESC_YES;
    $filltagsPopup['filldesc_no'] = POPUP_FILTAGS_DESC_NO;
    $filltagsPopup['filldesc_size'] = POPUP_FILTAGS_SIZE;
    $filltagsPopup['fillkeywords_yes'] = POPUP_FILTAGS_KEYWORDS_YES;
    $filltagsPopup['fillkeywords_no'] = POPUP_FILTAGS_KEYWORDS_NO;    
    $filltagsPopup['full'] = POPUP_FILTAGS_FULL;
    $filltagsPopup['empty'] = POPUP_FILTAGS_EMPTY;
    $filltagsPopup['skipall'] = POPUP_FILTAGS_SKIPALL;
    $filltagsPopup['show_missing_tags'] = POPUP_FILTAGS_SHOW_MISSING_TAGS;
    $filltagsPopup['include_missing_description'] = POPUP_FILTAGS_INCLUDE_MISSING_DESCRIPTION;
    $filltagsPopup['enable_sleep'] = POPUP_FILTAGS_ENABLE_SLEEP;
    $filltagsPopup['enable_sleep_interval'] = POPUP_FILTAGS_ENABLE_SLEEP_INTERVAL;
    return $filltagsPopup;

    case 'metatags':    
    $metatagsPopup = array();        
    $metatagsPopup[] = POPUP_METATAGS_GOOGLE;
    $metatagsPopup[] = POPUP_METATAGS_LANG;
    $metatagsPopup[] = POPUP_METATAGS_NOODP;
    $metatagsPopup[] = POPUP_METATAGS_NOYDIR;
    $metatagsPopup[] = POPUP_METATAGS_REPLY;
    $metatagsPopup[] = POPUP_METATAGS_REVIST;
    $metatagsPopup[] = POPUP_METATAGS_ROBOTS;
    $metatagsPopup[] = POPUP_METATAGS_UNSPAM;
    $metatagsPopup[] = POPUP_METATAGS_CANONICAL;
    $metatagsPopup[] = POPUP_METATAGS_OG;
    return $metatagsPopup;
  }  
}

/***********************************************************************
Return the product ID is a kewword is in the search table
***********************************************************************/
function GetProductID($words, $keyword, $languageID) {
    foreach ($words as $data) {
        if ($data['language_id'] == $languageID && $data['keyword'] == $keyword) {
            return $data['product_id'];
        }
    }
    return '';
}

/***********************************************************************
Return an array with the number of keywords, both found and not found
***********************************************************************/
function GetSearchCounts() {
    global $languages_id;
    $words = array('ttl_words', 'found_words', 'notfound_words');
    $db_query = tep_db_query("select count(*) as ttl_words, SUM(found=1) as found_words, SUM(found=0) as notfound_words from " . TABLE_HEADERTAGS_KEYWORDS . " where language_id = '" . (int)$languages_id . "'");
    
    if (tep_db_num_rows($db_query)) {
        return tep_db_fetch_array($db_query);
    }
    return $words; 
}

function GetSectionName($line) {
  if (tep_not_null($line)) {
    $name = explode(" ", $line);

    $cnt = count($name);

    if ($cnt > 1) {  
      $section = strtolower(trim($name[$cnt - 1]));

      if (trim($name[$cnt - 2]) == "//") {   //section name starts with //
        if ((strpos($section, '.php')) !== FALSE) {    //section name contains .php
          return $section;
        }  
      }
    }
  }
  return '';
}

/********************************************************************************
Returns an array if social bookmark icons
********************************************************************************/
function GetSocialIconsArray() {
  $allicons = glob(DIR_FS_CATALOG . DIR_WS_IMAGES . 'socialbookmark/*.png');
  $icons = array();

  foreach ((array)$allicons as $icon) {
      
      switch ($icon) {
         case (strpos($icon, '16x16') !== FALSE): 
          $parts = explode('/', $icon);
          $name = end($parts);
          $parts = explode('-', $name);
          $name = $parts[0];
          $icons[TEXT_SIZE_16][] = $name;
         break;
         
         case (strpos($icon, '24x24') !== FALSE): 
          $parts = explode('/', $icon);
          $name = end($parts);
          $parts = explode('-', $name);
          $name = $parts[0];          
          $icons[TEXT_SIZE_24][] = $name; 
         break;

         case (strpos($icon, '32x32') !== FALSE): 
          $parts = explode('/', $icon);
          $name = end($parts);
          $parts = explode('-', $name);
          $name = $parts[0];
          $icons[TEXT_SIZE_32][] = $name; 
         break;
         
         case (strpos($icon, '48x48') !== FALSE): 
          $parts = explode('/', $icon);
          $name = end($parts);
          $parts = explode('-', $name);
          $name = $parts[0];
          $icons[TEXT_SIZE_48][] = $name; 
         break;
         
         default:
      }   
  }
 
  return $icons;
}

/**********************************************************************
Returns true if the given option is set.
**********************************************************************/
function IsOptionSet($option) {
    $db_query = tep_db_query("select 1 from " . TABLE_HEADERTAGS_DEFAULT . " where " . $option . " = 1");
    return tep_db_num_rows($db_query);
}
 
function IsTemplate() { //return if BTS or STS is enabled, or not
  if (HEADER_TAGS_BYPASS_ISTEMPLATE == 'true' || defined('DIR_WS_TEMPLATES') || defined('DIR_WS_TEMPLATES_DEFAULT'))   //BTS is installed
   return true;

  $configuration_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key like 'MODULE_STS_DEFAULT_STATUS'");
  $config = tep_db_fetch_array($configuration_query);

  if ($config['configuration_value'] == 'true')
   return true;                    //STS is installed

  if (strpos(PROJECT_VERSION, 'osCommerce Online Merchant v2.3') !== FALSE) //Version of oscommerce greater than RC2A
      return true;

  return false;
}

/**********************************************************************
return false if the name entered is already present in the 
includes/header_tags.php file
**********************************************************************/
function NotDuplicatePage($fp, $pagename) {
    for ($idx = 0; $idx < count($fp); ++$idx) {
        $section = GetSectionName($fp[$idx]);
        if (tep_not_null($section)) {
            if (strcasecmp($section, $pagename) === 0)
                return false;
        }
    }
    return true;
}

function ResetCache_HeaderTags($name, $id, $deleteAll = false) {
    $gzip = ( HEADER_TAGS_ENABLE_CACHE == 'GZip' ? true : false );
    $cache_query = tep_db_query("select title from " . TABLE_HEADERTAGS_CACHE);

    while ($cache = tep_db_fetch_array($cache_query)) {
        $languages = tep_get_languages();

        for ($j=0, $k=sizeof($languages); $j<$k; $j++) {
            $cacheFileName = 'header_tags_' . $name . '_' . strtolower($languages[$j]['name']) . '_cache_id_' . $id;
            $cname = serialize($cacheFileName);
            $cname = ( $gzip ? base64_encode(gzdeflate($cname, 1)) : $cname );

            if ($deleteAll) {
                $cacheExt = ( $gzip == 1 ? @gzinflate(base64_decode($cache['title'])) : stripslashes($cache['title']) );
                $cacheExt = unserialize($cacheExt);

                if (strpos($cacheExt, $cacheFileName) !== FALSE && (tep_not_null($id) ? strpos($cacheExt, $id) !== FALSE : true)) {
                    tep_db_query("delete from " . TABLE_HEADERTAGS_CACHE . " where title = '" . $cache['title'] . "'");
                }
            } else {
                if ($cache['title'] === $cname) {
                    tep_db_query("delete from " . TABLE_HEADERTAGS_CACHE . " where title = '" . $cache['title'] . "'");
                    return;
                }
            }
        }
    }
}

function SetBaseFilesToDefaultLanguage($languages_id = 1) { //switch the headertags language settings in the original
  $baseFiles = (array)GetBaseFiles();                       //database upload to the default one, in case it is not 1 

  for ($i = 0; $i < count($baseFiles); ++$i) {
    $pageTags_query = tep_db_query("select page_name from " . TABLE_HEADERTAGS . " where page_name like '" . $baseFiles[$i] . "' and language_id = '" . (int)$languages_id . "' LIMIT 1");

    if (tep_db_num_rows($pageTags_query) == 0) { 
      $pageTags_query = tep_db_query("select page_name from " . TABLE_HEADERTAGS . " where page_name like '" . $baseFiles[$i] . "' and language_id = '1' LIMIT 1");
      if (tep_db_num_rows($pageTags_query) > 0) {
        tep_db_query("update " . TABLE_HEADERTAGS . " set language_id = '" . $languages_id . "' where page_name like '" . $baseFiles[$i] . "'"); 
      }
    }
  }
}

function SortFileList($data, $keys) { 
  // List As Columns 
  foreach ($data as $key => $row) { 
    foreach ($keys as $k) { 
      $cols[$k['key']][$key] = $row[$k['key']]; 
    } 
  } 

  // List original keys 
  $idkeys=array_keys($data); 
  // Sort Expression 
  $i=0; 
  $sort = '(array)';
  foreach ($keys as $k){ 
    if($i>0){$sort.=',';} 
    $sort.='$cols[\''.$k['key'].'\']';
    if(isset($k['sort'])){$sort.=',SORT_'.strtoupper($k['sort']);}
    if(isset($k['type'])){$sort.=',SORT_'.strtoupper($k['type']);}    
    $i++; 
  } 
  $sort.=',$idkeys'; 
  $sort='array_multisort('.$sort.');';   // Sort Funct 

  eval($sort); 
  foreach($idkeys as $idkey){           // Rebuild Full Array 
    $result[$idkey]=$data[$idkey]; 
  } 
  return $result; 
} 

function StripPunctuation($text) {
  $urlbrackets    = '\[\]\(\)';
  $urlspacebefore = ':;\'_\*%@&?!' . $urlbrackets;
  $urlspaceafter  = '\.,:;\'\-_\*@&\/\\\\\?!#' . $urlbrackets;
  $urlall         = '\.,:;\'\-_\*%@&\/\\\\\?!#' . $urlbrackets;

  $specialquotes  = '\'"\*<>';

  $fullstop       = '\x{002E}\x{FE52}\x{FF0E}';
  $comma          = '\x{002C}\x{FE50}\x{FF0C}';
  $arabsep        = '\x{066B}\x{066C}';
  $numseparators  = $fullstop . $comma . $arabsep;

  $numbersign     = '\x{0023}\x{FE5F}\x{FF03}';
  $percent        = '\x{066A}\x{0025}\x{066A}\x{FE6A}\x{FF05}\x{2030}\x{2031}';
  $prime          = '\x{2032}\x{2033}\x{2034}\x{2057}';
  $nummodifiers   = $numbersign . $percent . $prime;

  return preg_replace(
      array(
      // Remove separator, control, formatting, surrogate,
      // open/close quotes.
          '/[\p{Z}\p{Cc}\p{Cf}\p{Cs}\p{Pi}\p{Pf}]/u',
      // Remove other punctuation except special cases
          '/\p{Po}(?<![' . $specialquotes .
              $numseparators . $urlall . $nummodifiers . '])/u',
      // Remove non-URL open/close brackets, except URL brackets.
          '/[\p{Ps}\p{Pe}](?<![' . $urlbrackets . '])/u',
      // Remove special quotes, dashes, connectors, number
      // separators, and URL characters followed by a space
          '/[' . $specialquotes . $numseparators . $urlspaceafter .
              '\p{Pd}\p{Pc}]+((?= )|$)/u',
      // Remove special quotes, connectors, and URL characters
      // preceded by a space
          '/((?<= )|^)[' . $specialquotes . $urlspacebefore . '\p{Pc}]+/u',
      // Remove dashes preceded by a space, but not followed by a number
          '/((?<= )|^)\p{Pd}+(?![\p{N}\p{Sc}])/u',
      // Remove consecutive spaces
          '/ +/',
      ),
      ' ',
      $text );
}

function WriteHeaderTagsFile($filename, $fp) {
  if (!is_writable($filename)) {
     if (!chmod($filename, 0666)) {
        echo sprintf(ERROR_CANT_CHMOD, $filename);
        return false;
     }
  }
  $fpOut = @fopen($filename, "w");

  if (! $fpOut) {
     echo sprintf(ERROR_FAILED_FILE_OPEN, $filename);
     return false;
  }

  for ($idx = 0; $idx < count($fp); ++$idx) {
    if (fwrite($fpOut, $fp[$idx]) === FALSE) {
       echo sprintf(ERROR_FAILED_FILE_WRITE, $filename);
       return false;
    }
  }   
  fclose($fpOut);   
  return true;
}

// Output a form muliple select menu
function SMMultiSelectMenu($name, $values, $selected_vals, $params = '', $required = false) {
  $field = '<select name="' . $name . '"';
  if ($params) $field .= ' ' . $params;
  $field .= ' multiple="multiple">';
  for ($i=0; $i<sizeof($values); ++$i)
  {
    if ($values[$i]['id'])
    {
      $field .= '<option value="' . $values[$i]['id'] . '"';
      if ( ((strlen($values[$i]['id']) > 0) && ($name == $values[$i]['id'])) )
      {
        $field .= '  selected="selected"';
      }
      else if (tep_not_null($selected_vals))
      {
  	    for ($j=0; $j<sizeof($selected_vals); ++$j)
        {
	   	    if ($selected_vals[$j]['id'] == $values[$i]['id'])
		      {
	          $field .= ' selected="selected"';
		      }
	      }
      }
    }

    $field .= '>' . $values[$i]['text'] . '</option>';
  }
  $field .= '</select>';

  if ($required) $field .= TEXT_FIELD_REQUIRED;

  return $field;
}