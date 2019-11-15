<?php
/*
  $Id: header_tags_seo_keywords.php,v 1.2 2011/07/24
  header_tags_keywords Originally Created by: Jack_mcs
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright 2009 oscommerce-solution.com

  Released under the GNU General Public License
 */

function GetLanguageName($id)
{
    $languages = tep_get_languages();
    for ($i = 0; $i < count($languages); ++$i) {
        if ($languages[$i]['id'] == $id) {
            return $languages[$i]['name'];
        }
    }
    return '';
}

function GetGooglePosition($searchquery, $id, $searchurl, $pageCnt)
{
    $query         = str_replace(" ", "+", $searchquery);
    $query         = str_replace("%26", "&", $query);
    $position      = 0;  // This will be the index position in the listings  	
    $real_position = 0; // This is the index position minus the duplicates 
    $found         = '';
    $lastURL       = '';
    $siteresults   = array();
    $out           = array();
    $hits_per_page = 10;
    $siteName      = 'Google';
    $cnt           = 0;
    $showlinks     = true;

    for ($i = 0, $page = 0; $i < $pageCnt; ++$i, $page += $hits_per_page) {
        switch ($siteName) {
            case "Google": $filename = "http://www.google.com/search?q=$query&hl=en&biw=1280&bih=520&num=10&start=$page&lr=&ft=i&cr=&safe=images&tbs=";
                break;

            case "msn": $filename = "http://search.msn.com/results.aspx?q=$query&FORM=MSNH&first=$i&count=".$hits_per_page;
                break;

            case "Yahoo": $filename = "http://search.yahoo.com/search?_adv_prop=web&x=op&ei=UTF-8".
                    "&prev_vm=p&va=$query&va_vt=any&vp=&vp_vt=any&vo=&vo_vt=any".
                    "&ve=&ve_vt=any&vd=all&vst=0&vs=&vf=all&vm=p".
                    "&vc=&fl=0&n={$hits_per_page}&b=$page_var";
                break;

            default: echo 'Bad case '.$siteName;
                exit;
        }

        if ($siteName == 'Google') {

            if (function_exists('curl_init')) {
                $ch            = curl_init();
                $timeout       = 5; // set to zero for no timeout
                curl_setopt($ch, CURLOPT_URL, $filename);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                $file_contents = curl_exec($ch);
                curl_close($ch);
            } else {
                $file_contents = @file_get_contents($filename);
            }


            $tmp = explode('Shopping results for', $file_contents);

            if (!isset($tmp[1])) {
                $tmp = explode('Places for', $file_contents);

                if (!isset($tmp[1])) {
                    $tmp = explode('Ads</h2>', $file_contents);
                }
            }
            $code = (isset($tmp[1])) ? $tmp[1] : $file_contents;


            $lines = explode('class="r"><a', $code);

            $searchurl_www = $searchurl;
            if (($pos           = strpos($searchurl, "www")) === FALSE) {
                $searchurl_www = "www.".$searchurl;
            } else {
                $searchurl_www   = $searchurl;
                $searchurl_nowww = strpos($searchurl, $pos + 4);
            }

            $ar = array();

            for ($s = 0; $s < count($lines); ++$s) {
                if ($showlinks) { // if set, record the links for viewing
                    $pStart        = strpos($lines[$s], "://") + 3;
                    $pStop         = strpos($lines[$s], ">");
                    $siteresults[] = substr($lines[$s], $pStart,
                        $pStop - $pStart);
                }


                if (@preg_match("/".$searchurl_www."/", $lines[$s], $out)) {
                    $locn  = $s + $cnt;
                    $found = $locn;
                    break;
                }
            }

            $cnt += $hits_per_page;
        }

        if ($found) break;
    }

    return ($found > 0 ? $found : 'Not Found');
}