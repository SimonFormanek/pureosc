<?php
/**
* SEO Friendly Urls
*
* SEO Friendly Urls offers search engine optimized URLS for osCommerce
* based applications. Other features include optimized performance and
* automatic redirect script.
* @version 1.0.0
* @link http://www.johnbarounis.com/coding/oscommerce/seo-friendly-urls-addon-v1-0-0
* @copyright Copyright 2015-2016, John Barounis
* @author John Barounis
*/
class seo_friendly_urls{

  public $name='SEO Friendly Urls FREE';
  public $enabled = true;
  public $include_page='';//Which page to include. Used when the page type is 'page' and we have rewrite an osc default php page to something else. For example products_new.php to new-products
  public $page_type='page';

  private $website='http://www.johnbarounis.com/coding/oscommerce/seo-friendly-urls-addon-v1-0-0';

  private $classname='';
  private $CLASSNAME='';

  private $config=array();
  private $categories=array();
  private $products=array();
  private $pages=array();
  private $catalog_languages=array();
  private $catalog_languages_rev=array();

  private $use_custom_aliases=false;//if true reads from db the custom aliases you have entered in pd.products_alias and cd.categories_alias
  private $on_empty_custom_alias_auto_create_alias=true;//Variable $use_custom_aliases must be true
  private $full_path_aliases = true;
  private $transliterate_characters_to_ascii=true;

  private $use_default_language_aliases=false;

  private $display_language_alias=true;
  private $display_default_language_alias=true;
  private $language_alias='';

  private $redirect_not_found_pages_to='index.php';
  private $urls_extension='';

  private $force_redirect_to_new_urls=true;//If true then the default osc urls will direct to new urls if exist. Useful for seo.
  private $permanent_redirect_to_new_urls;

  private $is_apc_installed = false;

  private $cache_aliases = 'No';
  private $cache_file_name='';
  private $cache_days=3;
  private $time=0;

  private $filter_short_words=0;

  /**
  * SEO Friendly Urls class constructor
  * @author John Barounis
  * @version 1.0.0
  * @param boolean $remove
  */
  public function __construct($remove=false){

    //get class name so to use it next
    $this->classname=get_class($this);
    $this->CLASSNAME=strtoupper($this->classname);

    //Remove action called
    if(defined($this->CLASSNAME.'_REMOVE') && !$remove){

      if(constant($this->CLASSNAME.'_REMOVE')=='Yes') $remove=true;

    }

    if($remove){ $this->remove(); return false; }

    //Check if install, if not then install
    if(!$this->check()){//install into configuration

      if($this->install()) $this->redirect(tep_href_link(FILENAME_DEFAULT),false); //need to redirect because we want osc to read the defines from the configuration

    }

    $this->enabled = $this->_('_STATUS') == 'True';

    if(!$this->enabled) return false;

    $this->time = time();

    $this->use_custom_aliases = $this->_('_USE_CUSTOM_ALIASES') == 'True';
    $this->on_empty_custom_alias_auto_create_alias = $this->_('_AUTO_CREATE_ALIASES') == 'True';
    $this->full_path_aliases = $this->_('_FULL_PATH_ALIASES') == 'Yes';
    $this->force_redirect_to_new_urls = $this->_('_FORCE_'.$this->CLASSNAME) == 'True';
    $this->permanent_redirect_to_new_urls = $this->_('_PERMANENT_REDIRECT') == 'Yes';
    $this->transliterate_characters_to_ascii=$this->_('_TRANSLITERATE_CHARACTERS_TO_ASCII') == 'True';
    $this->use_default_language_aliases=$this->_('_USE_DEFAULT_LANGUAGE_ALIASES') == 'Yes';
    $this->display_language_alias=$this->_('_DISPLAY_LANGUAGE_ALIAS') == 'Yes';
    $this->display_default_language_alias=$this->_('_DISPLAY_DEFAULT_LANGUAGE_ALIAS') == 'Yes';
    $this->cache_aliases = $this->_('_CACHE_ALIASES');
    $this->urls_extension = $this->_('_URLS_EXTENSION');
    if($this->urls_extension!='') $this->urls_extension='.'.$this->urls_extension;// ADD EXTENSION
    $this->cache_file_name = DIR_FS_CACHE.$this->classname.'.cache';
    $this->reset_aliases_cache=$this->_('_RESET_ALIASES_CACHE') == 'Yes';
    if($this->reset_aliases_cache) $this->clear_cache();// CLEAR CACHE
    $this->cache_days = (int)$this->_('_CACHE_DAYS');
    $this->filter_short_words = (int)$this->_('_FILTER_SHORT_WORDS');
    $this->is_apc_installed=extension_loaded('apc');

    global $languages_id,$language;

    //Class config in db
    $config_query=tep_db_query("select * from ".$this->classname);
    while ($config_row = tep_db_fetch_array($config_query)) $this->config[$config_row[$this->classname.'_key']] = $config_row[$this->classname.'_value'];

    $languages_query = tep_db_query("select languages_id, name, code, image, directory from " . TABLE_LANGUAGES . " order by sort_order");
    while ($languages = tep_db_fetch_array($languages_query)) $this->catalog_languages[$languages['languages_id']] = $languages['code'];

    $this->catalog_languages_rev = array_flip($this->catalog_languages);

    //PROCESS categories and products SO TO CREATE ALIASES
    $create_alias_options=array();
    if($this->transliterate_characters_to_ascii) $create_alias_options=array('transliterate'=>true);

    $products_query_select = '';
    $categories_query_select = '';

    if($this->use_custom_aliases){

      $products_query_select = 'pd.products_alias,';
      $categories_query_select = 'cd.categories_alias,';

    }

    $products_query = tep_db_query("SELECT pd.language_id, p.products_id, pd.products_name, ".$products_query_select." p2c.categories_id  FROM " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c WHERE p.products_status = '1' AND p.products_id = pd.products_id AND p2c.products_id=p.products_id AND p2c.products_id=pd.products_id");

   $products_alias='';
    while ($products = tep_db_fetch_array($products_query)) {

      if(isset($products['products_alias'])){

        if(tep_not_null($products['products_alias'])) $products_alias=$products['products_alias'];
        elseif($this->on_empty_custom_alias_auto_create_alias) $products_alias=$this->create_alias($products['products_name'],$create_alias_options);
        else $products_alias='';//by making it empty tep_href_link will use the osc default urls those with get variables

      }else $products_alias=$this->create_alias($products['products_name'],$create_alias_options);

      $this->products[$products['language_id']][$products['categories_id']][$products['products_id']] = $products_alias;

    }

    if($this->use_default_language_aliases){

      foreach($this->products as $key => $value){

        if(isset($this->catalog_languages_rev[DEFAULT_LANGUAGE]) && $this->catalog_languages_rev[DEFAULT_LANGUAGE]==$key) continue;

        if($this->on_empty_custom_alias_auto_create_alias){

          foreach($value as $kk => $vv){

            foreach($vv as $k => $v){

              $this->products[$key][$kk][$k]=$this->products[$this->catalog_languages_rev[DEFAULT_LANGUAGE]][$kk][$k];

            }

          }

        }

      }

    }

    $categories_query = tep_db_query("select cd.language_id, c.categories_id, cd.categories_name, ".$categories_query_select." c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = cd.categories_id order by sort_order, cd.categories_name");

    $items = array();
    $categories_alias='';
    while ($categories = tep_db_fetch_array($categories_query)) {

      if(isset($categories['categories_alias'])){

        if(tep_not_null($categories['categories_alias'])) $categories_alias=$categories['categories_alias'];
        elseif($this->on_empty_custom_alias_auto_create_alias) $categories_alias=$this->create_alias($categories['categories_name'],$create_alias_options);
        else $categories_alias='';//by making it empty tep_href_link will use the osc default urls those with get variables

      }else $categories_alias=$this->create_alias($categories['categories_name'],$create_alias_options);

      $items[$categories['language_id']][$categories['categories_id']] = array('name' => $categories['categories_name'], 'alias' => $categories_alias, 'parent_id' => $categories['parent_id'], 'id' => $categories['categories_id']);

    }

    if($this->use_default_language_aliases){

      //$items_copy=$items;
      foreach($items as $key => $value){

        if(isset($this->catalog_languages_rev[DEFAULT_LANGUAGE]) && $this->catalog_languages_rev[DEFAULT_LANGUAGE]==$key) continue;

        if($this->on_empty_custom_alias_auto_create_alias){

          foreach($value as $k => $v) $items[$key][$k]['alias']=$items[$this->catalog_languages_rev[DEFAULT_LANGUAGE]][$k]['alias'];

        }

      }
      //$items_copy = null;

    }

    $clangs=array_keys($items);

    foreach($clangs as $clang){

      $citems=count($items[$clang]);
      $root_id=0;
      if($citems<=0) ;
      elseif($citems==1) $children[] = $items[$clang]; //in case we have one category item without subcategories, rare but possible
      else foreach( $items[$clang] as $item ) $children[$item['parent_id']][] = $item;
        $loop = !empty( $children[$root_id] );
        $parent = $root_id;
        $parent_stack = array();
        $stack=array();//helper array so to know the current level
        $stack_alias=array();

        while ( $loop && ( ( $option = each( $children[$parent] ) ) || ( $parent > $root_id ) ) ){
          if ( $option === false ){
            $parent = array_pop( $parent_stack );
            array_pop( $stack );
            array_pop( $stack_alias );
          }elseif ( !empty( $children[$option['value']['id']] ) ){
            $stack[]=$option['value']['id'];

            $stack_alias[]=$option['value']['alias'];

            $rt=$root_id>0 ? $root_id.'_' : '';

            if($this->full_path_aliases) $path_alias = count($stack)<=0 ? $option['value']['alias'] : implode('/',$stack_alias);
            else $path_alias = implode('/',$stack_alias);

            $lang_alias='';

            if($option['value']['alias']=='') $path_alias='';
            else{

              if(isset($this->catalog_languages[$clang]) && $this->catalog_languages[$clang]==DEFAULT_LANGUAGE){

                if($this->display_default_language_alias){

                  $lang_alias=$this->catalog_languages[$clang].'/';
                  $path_alias=$lang_alias.$path_alias;

                }

              }else{

                if($this->display_language_alias){

                  $lang_alias=$this->catalog_languages[$clang].'/';
                  $path_alias=$lang_alias.$path_alias;

                }

              }

            }

            if(count($stack)<=0) $this->categories[$clang][$rt.$option['value']['id']]=$path_alias;
            else $this->categories[$clang][$rt.implode('_',$stack)]=$path_alias;

            if(isset($this->products[$clang][$option['value']['id']])){

              if($this->full_path_aliases) foreach($this->products[$clang][$option['value']['id']] as $key => $value) $this->products[$clang][$option['value']['id']][$key]=$value=='' ? '' : $path_alias.'/'.$value;
              else foreach($this->products[$clang][$option['value']['id']] as $key => $value) $this->products[$clang][$option['value']['id']][$key]=$value=='' ? '' : $lang_alias.$value;

            }

            $parent_stack[]=$option['value']['parent_id'];
            $parent = $option['value']['id'];

          }else{

            $rt=$root_id>0 ? $root_id.'_' : '';

            if($this->full_path_aliases) $path_alias = count($stack)<=0 ? $option['value']['alias'] : implode('/',$stack_alias).'/'.$option['value']['alias'];
            else $path_alias = $option['value']['alias'];

            $lang_alias='';

            if($option['value']['alias']=='') $path_alias='';
            else{

              if(isset($this->catalog_languages[$clang]) && $this->catalog_languages[$clang]==DEFAULT_LANGUAGE){

                if($this->display_default_language_alias){

                  $lang_alias=$this->catalog_languages[$clang].'/';
                  $path_alias=$lang_alias.$path_alias;

                 }

              }else{

                if($this->display_language_alias){

                  $lang_alias=$this->catalog_languages[$clang].'/';
                  $path_alias=$lang_alias.$path_alias;

                }

              }

            }

            if(count($stack)<=0) $this->categories[$clang][$rt.$option['value']['id']]=$path_alias;
            else $this->categories[$clang][$rt.implode('_',$stack).'_'.$option['value']['id']]=$path_alias;

            if(isset($this->products[$clang][$option['value']['id']])){

              if($this->full_path_aliases) foreach($this->products[$clang][$option['value']['id']] as $key => $value) $this->products[$clang][$option['value']['id']][$key]=$value=='' ? '' : $path_alias.'/'.$value;
              else foreach($this->products[$clang][$option['value']['id']] as $key => $value) $this->products[$clang][$option['value']['id']][$key]=$value=='' ? '' : $lang_alias.$value;

            }

          }
       }

     }

    //FIXES DUPLICATE ALIASES
    $this->duplicate_aliases_fix();

    $this->process();

  }

  //AFTER WE CREATED THE PRODUCTS & CATEGORIES TREE ALIASES LETS PROCESS TO FIND OUT WHICH PAGE WE ARE LOCATED IN
  public function process(){

    global $PHP_SELF, $cPath,$cPath_array, $languages_id, $current_category_id, $HTTP_GET_VARS;

    $parsedUrl=parse_url($_SERVER['REQUEST_URI']);
    $queryParts=explode('/',$parsedUrl['path']);

    array_shift($queryParts); // the first element will be empty so we get rid of it

    $ws_catalog = ENABLE_SSL == true ? DIR_WS_HTTPS_CATALOG : DIR_WS_HTTP_CATALOG;
    $ws_strs=array_filter( explode('/',$ws_catalog) );
    $dif = array_diff($queryParts, $ws_strs);
    $qg=implode('/',$dif);//so to get only the part of the url that we want

    if($this->urls_extension!=''){//since we have an extension then remove it from $qg

        $ue=explode($this->urls_extension,$qg);
        $qg=$ue[0];

    }

    $lid=$languages_id;

    $qg=rawurldecode($qg);//so to recognize non lating letters

    //check to see if last diff item exist in products if so then we have a products page
    foreach($this->products[$lid] as $key => $value){

      foreach($value as $k => $v){

        if($v===$qg){

          $HTTP_GET_VARS['products_id']=$k.'';//needs to be string because of the tep_get_all_get_params
          $this->page_type='product';
          $this->include_page='product_info.php';
          break 2;

        }

      }

    }

    if($this->page_type!='product'){

      $cp='';
      $rev_categories=array_flip($this->categories[$lid]);//flip categories aliases tree so to use isset instead of searching using a loop or in_array
      if(isset($rev_categories[$qg])) $cp=$rev_categories[$qg];
      if(tep_not_null($cp)){

        $this->page_type='category';
        //osCommerce needs those so to identify category page
        $cPath_array=explode('_',$cp);
        $cPath = implode('_', $cPath_array);
        $HTTP_GET_VARS['cPath']=$cPath;
        $current_category_id=(int)end($cPath_array);
        //osCommerce needs those so to identify category page

      }

    }

    //GET PAGES ALIASES IN AN ARRAY
    $this->getPages();

    if($this->page_type=='page'){

      foreach($this->pages as $k => $v){

        if($v===$qg && $k!=='index.php' && $v!==''){

          $this->include_page=$k;
          break;

        }

      }

    }


  }

  //THIS FUNCTION MUST BE CALLED FROM tep_href_link

  public function process_link($page,$parameters){

    global $languages_id;

    $link='';

    if(!$this->enabled){//use default urls

      if (tep_not_null($parameters)) {

        $link .= $page . '?' . tep_output_string($parameters);
        $separator = '&';

      }else{

        $link .= $page;
        $separator = '?';

      }

      return array('seolink'=>urlencode($link),'separator'=>$separator);

    }

    $lang_alias='';

    if (tep_not_null($parameters)) {

      $separator = '&';
      $eps=array_filter(explode('&',tep_output_string($parameters)));
      $parameter_cPath='';
      $parameter_products_id='';
      $parameter_language='';
      $parameter_rest=array();
      foreach($eps as $ep){

        $get_key=array_filter(explode('=',$ep));
        if($get_key[0]=='cPath' && isset($get_key[1])) $parameter_cPath=$get_key[1];
        elseif($get_key[0]=='products_id' && isset($get_key[1])) $parameter_products_id=(int)$get_key[1];
        //elseif($get_key[0]=='language' && isset($get_key[1])) $parameter_language=$get_key[1];
        else $parameter_rest[]=$ep;

      }

      $s_link='';
      $rest_parameters='';
      if(count($parameter_rest)>0) $rest_parameters='?'.implode('&',$parameter_rest);

      $index_alias='';
      if(isset($this->pages['index.php'])) $index_alias=$this->pages['index.php'];

      if($parameter_products_id!=''){//we have a product

        //find product alias
        $product_alias='';
        if(isset($this->products[$languages_id])){
          foreach($this->products[$languages_id] as $key => $value){

            foreach($value as $k => $v){

              if($k===$parameter_products_id) { $product_alias=$v; break 2; }

            }

          }
        }

        if($product_alias!=''){

          $s_link.=$product_alias.$this->urls_extension.$rest_parameters;

        }else $s_link='';

      }elseif(isset($this->categories[$languages_id][$parameter_cPath])){

        $s_link.=$this->categories[$languages_id][$parameter_cPath].$this->urls_extension.$rest_parameters;

      }

      //check to see if we have alias otherwise use osc default urls
      $link .= $s_link!='' ? $s_link : $page. '?' . tep_output_string($parameters);

    }else{

      $link .= isset($this->pages[$page]) && $this->pages[$page]!='' ? $lang_alias.$this->pages[$page].$this->urls_extension : $page;
      $separator = '?';

    }

    return array('seolink'=>$link,'separator'=>$separator);

  }

  public function create_alias($str, $options = array()) {

    // Make sure string is in UTF-8 and strip invalid UTF-8 characters
    $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());

    if($this->filter_short_words>0){

      $str_array=explode(' ',$str);
      $str_temp=array();
      foreach($str_array as $stra){

        if(mb_strlen($stra)<=$this->filter_short_words) continue;
        $str_temp[]=$stra;

      }

      if(count($str_temp)>0) $str=implode(',',$str_temp);

    }

    $defaults = array(
      'delimiter' => '-',
      'limit' => null,
      'lowercase' => true,
      'replacements' => array(),
      'transliterate' => false,
    );

    // Merge options
    $options = array_merge($defaults, $options);

    // Make custom replacements
    $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);

    // Transliterate characters to ASCII
    if ($options['transliterate']) {

      $char_map = array(
        // Latin
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
        'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
        'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
        'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
        'ß' => 'ss',
        'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
        'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
        'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
        'ÿ' => 'y',

        // Latin symbols
        '©' => '(c)',

        // Greek
        'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => 'TH',
        'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
        'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
        'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
        'Ϋ' => 'Y',
        'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => 'th',
        'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
        'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
        'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
        'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',

        // Turkish
        'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
        'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',

        // Russian
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
        'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
        'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
        'Я' => 'Ya',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
        'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
        'я' => 'ya',

        // Ukrainian
        'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
        'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',

        // Czech
        'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
        'Ž' => 'Z',
        'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
        'ž' => 'z',

        // Polish
        'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
        'Ż' => 'Z',
        'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
        'ż' => 'z',

        // Latvian
        'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
        'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
        'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
        'š' => 's', 'ū' => 'u', 'ž' => 'z'
      );

      $str = str_replace(array_keys($char_map), $char_map, $str);

    }

    // Replace non-alphanumeric characters with our delimiter
    $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);

    // Remove duplicate delimiters
    $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);

    // Truncate slug to max. characters
    $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');

    // Remove delimiter from ends
    $str = trim($str, $options['delimiter']);

    return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
  }

  private function getLanguageAlias(){

    global $languages_id;

    $lang_alias='';
    if($this->display_language_alias && isset($this->catalog_languages[$languages_id])){

      $lang_alias=$this->catalog_languages[$languages_id].'/';

    }

    if($this->display_default_language_alias){

      if(isset($this->catalog_languages[$languages_id]) && DEFAULT_LANGUAGE==$this->catalog_languages[$languages_id]) $lang_alias=$this->catalog_languages[$languages_id].'/';

    }else{

      if(!$this->display_language_alias) $lang_alias='';

    }

    return $lang_alias;

  }

  //DUPLICATE ALIASES CHECK & FIX
  private function duplicate_aliases_fix(){

    //STEP 1 :: fix duplicates between pages and categories and products // On duplicate appends an incremented value
    $lang_alias=$this->getLanguageAlias();
    $this->getPages();
    $fpages=array_filter($this->pages);
    $cnt=0;
    foreach($fpages as $fpKey => $fpValue){

      foreach($this->categories as $k => $v){

        foreach($v as $ck => $cv){

          if($lang_alias.$fpValue===$cv) $this->categories[$k][$ck].=$cnt++;

        }

      }

      foreach($this->products as $k => $v){

        foreach($v as $pk => $pv){

          foreach($pv as $ppk => $ppv){

            if($lang_alias.$fpValue===$ppv) $this->products[$k][$pk][$ppk].= $cnt++;

          }

        }

      }

    }

    //STEP 2 :: fix duplicates between categories // On duplicate appends a decremented number which is calculated from the sum of duplicates found
    foreach($this->categories as $k => $v){

      $tmp=array_count_values($v);
      $duplicates=array();
      foreach($tmp as $tk => $tv){

        if($tv>1) $duplicates[$tk]=$tv;

      }

      foreach($v as $ck => $cv){

        if(isset($duplicates[$cv])){//we found duplicate

          $append = --$duplicates[$cv];
          if($append>0) $this->categories[$k][$ck].= $append;//so not to append 0 number at the end

        }

      }

    }
    //STEP 3 :: fix duplicates between products // On duplicate appends a decremented number which is calculated from the sum of duplicates found
    foreach($this->products as $k => $v){

      $duplicates=array();//this is set outside from the foreach because we want to check for duplicate products globally in all categories

      foreach($v as $pk => $pv){

        $tmp=array_count_values($pv);
        foreach($tmp as $tk => $tv){

           if($tv>1) $duplicates[$tk]=$tv;

        }

        foreach($pv as $ppk => $ppv){

          if(isset($duplicates[$ppv])){//we found duplicate

            $append = --$duplicates[$ppv];
            if($append>0) $this->products[$k][$pk][$ppk].= $append;//so not to append 0 number at the end

          }

        }

      }

    }

    //STEP 4 :: fix duplicates between  categories and products // On duplicate appends 0 to products url
    foreach($this->categories as $k => $c){

      $tmpp=array();
      foreach($this->products[$k] as $pk => $pc){

        foreach($pc as $pcc) $tmpp[]=$pcc;

      }

      $a_intersect=array_intersect($c, $tmpp);
      foreach($a_intersect as $ai){

        foreach($this->products[$k] as $pk => $pv){

          foreach($pv as $ppk => $ppv){

            if($ppv===$ai){//we found duplicate

              $append = '0';
              $this->products[$k][$pk][$ppk].= $append;

            }

          }

        }

      }

    }

  }

  //HELPER FUNCTION :: return constant based on classname
  private function _($const){

    return constant($this->CLASSNAME.$const);

  }

  //CUSTOM REDIRECT FUNCTION SO TO INCLUDE 301 HEADER
  private function redirect($url, $permanent=true){

    if ( (strstr($url, "\n") != false) || (strstr($url, "\r") != false) ) {
      $this->redirect(tep_href_link(FILENAME_DEFAULT, '', 'NONSSL', false));
    }

    if ( (ENABLE_SSL == true) && (getenv('HTTPS') == 'on') ) { // We are loading an SSL page
      if (substr($url, 0, strlen(HTTP_SERVER . DIR_WS_HTTP_CATALOG)) == HTTP_SERVER . DIR_WS_HTTP_CATALOG) { // NONSSL url
        $url = HTTPS_SERVER . DIR_WS_HTTPS_CATALOG . substr($url, strlen(HTTP_SERVER . DIR_WS_HTTP_CATALOG)); // Change it to SSL
      }
    }

    if ( strpos($url, '&amp;') !== false ) {
      $url = str_replace('&amp;', '&', $url);
    }

    if($this->permanent_redirect_to_new_urls && $permanent) header("HTTP/1.1 301 Moved Permanently");

    header('Location: ' . $url);

    exit();

  }

  private function getPages(){

    return array();

  }

  private function isEnabled(){
    return $this->enabled;
  }

  function check(){
    return defined($this->_('_STATUS'));
  }

  private function clear_cache(){

     tep_db_query("DELETE FROM ".$this->classname." WHERE ".$this->classname."_key='cache_aliases' ");
     if(file_exists($this->cache_file_name)) @unlink($this->cache_file_name);
     if($this->is_apc_installed) apc_delete($ths->classname.'_cache_aliases');
     //Update value to No so not to execute clear cache once.
     tep_db_query("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = 'No' WHERE configuration_key = '".$this->CLASSNAME."_RESET_ALIASES_CACHE' ");

  }

  //make sure it rus only once
  private function install() {

    $presult = tep_db_query("SHOW COLUMNS FROM `".TABLE_PRODUCTS_DESCRIPTION."` LIKE 'products_alias'");
    if(!tep_db_num_rows($presult)) tep_db_query("ALTER TABLE  `products_description` ADD  `products_alias` VARCHAR( 255 ) NOT NULL AFTER  `products_name` ;");

    $cresult = tep_db_query("SHOW COLUMNS FROM `".TABLE_CATEGORIES_DESCRIPTION."` LIKE 'categories_alias'");
    if(!tep_db_num_rows($cresult)) tep_db_query("ALTER TABLE  `categories_description` ADD  `categories_alias` VARCHAR( 255 ) NOT NULL ;");

    tep_db_query("CREATE TABLE IF NOT EXISTS `".$this->classname."` (
      `".$this->classname."_id` int(11) NOT NULL AUTO_INCREMENT,
      `".$this->classname."_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
      `".$this->classname."_value` text COLLATE utf8_unicode_ci NOT NULL,
      `".$this->classname."_date` int(11) NOT NULL DEFAULT '0',
      PRIMARY KEY (`".$this->classname."_id`),
      UNIQUE KEY `".$this->classname."_key` (`".$this->classname."_key`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;");

    $pro_version_required="&nbsp;&nbsp;<a target=\'_blank\' style=\'color:red;font-style:italic\' href=\'".$this->website."\'>PRO VERSION REQUIRED</a>";

    tep_db_query("insert into " . TABLE_CONFIGURATION_GROUP . " (configuration_group_title, configuration_group_description) values ('".$this->name."', '".$this->name."')");
    $group_id=tep_db_insert_id();

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable SEO Friendly Urls?', '".$this->CLASSNAME.'_STATUS'."', 'False', 'Do you want to enable the SEO Friendly Urls addon?', '".$group_id."', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display language slug (Code) in the urls?".$pro_version_required."', '".$this->CLASSNAME.'_DISPLAY_LANGUAGE_ALIAS'."', 'Yes', 'Do you want to display the current language slug (Code)?', '".$group_id."', '2', 'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display default language slug (Code) in the urls?".$pro_version_required."', '".$this->CLASSNAME.'_DISPLAY_DEFAULT_LANGUAGE_ALIAS'."' , 'No', 'Do you want to display the default language slug (Code)? Note: this overrides the above option.', '".$group_id."', '3', 'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");

//REDIRECTS

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Redirect old url to new alias url?".$pro_version_required."', '".$this->CLASSNAME.'_FORCE_'.$this->CLASSNAME."', 'True', 'Do you want to force the use of aliases when an old url entered in the address bar?', '".$group_id."', '4', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('301 Permanent Redirect?".$pro_version_required."', '".$this->CLASSNAME.'_PERMANENT_REDIRECT'."', 'No', 'When redirect old urls to new use 301 permanent direct?', '".$group_id."', '5', 'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Redirect not found pages to?".$pro_version_required."', '".$this->CLASSNAME.'_REDIRECT_NOT_FOUND_PAGES_TO'."', 'index.php', 'Input in what page user will be directed when he hits a not found page. Can also use the alias of a page', '".$group_id."', '6', now())");


//ALIASES

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Auto create aliases?', '".$this->CLASSNAME.'_AUTO_CREATE_ALIASES'."', 'True', 'Do you want to auto create aliases? (Applies only in categories and products pages)', '".$group_id."', '7', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Transliterate characters to ASCII?', '".$this->CLASSNAME.'_TRANSLITERATE_CHARACTERS_TO_ASCII'."', 'True', 'Do you want to transliterate alias characters to ASCII? (Applies only in categories and products pages)', '".$group_id."', '7', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Use aliases from default language?', '".$this->CLASSNAME.'_USE_DEFAULT_LANGUAGE_ALIASES'."', 'Yes', 'Do you want to use the default language aliases? In the greek language when english is default use: gr/monitors instead of gr/othones', '".$group_id."', '8', 'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Use custom aliases?".$pro_version_required."', '".$this->CLASSNAME.'_USE_CUSTOM_ALIASES'."', 'False', 'Do you want to use custom aliases? Custom aliases use the values form table fields products_alias and categories_alias.', '".$group_id."', '9', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Full path aliases?', '".$this->CLASSNAME.'_FULL_PATH_ALIASES'."', 'Yes', 'For example: http://mystore.com/dvd-movies/action/speed vs http://mystore.com/speed.', '".$group_id."', '10', 'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");

//CACHE ALIASES

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Cache aliases?".$pro_version_required."', '".$this->CLASSNAME.'_CACHE_ALIASES'."', 'No', 'Cache aliases?.', '".$group_id."', '11', 'tep_cfg_select_option(array(\'No\', \'mysql\', \'apc\',\'file\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Reset Aliases Cache?".$pro_version_required."', '".$this->CLASSNAME.'_RESET_ALIASES_CACHE'."', 'No', 'Reset aliases cache? Note: <b>this is a must when you make changes to the aliases structure based on the above options.</b>', '".$group_id."', '12', 'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Days to store Cache?".$pro_version_required."', '".$this->CLASSNAME.'_CACHE_DAYS'."', '3', 'How many days a cache will be kept before auto deleting itself. Set 0 to not auto delete.', '".$group_id."', '13', now())");

//EXTRAS

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Filter Short Words?', '".$this->CLASSNAME.'_FILTER_SHORT_WORDS'."', '1', 'When creating a link from a product name you may want to remove the shorter words like a | or | at | the .. etc. Set 0 for not filtering any short words.', '".$group_id."', '14', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Urls extension?', '".$this->CLASSNAME.'_URLS_EXTENSION'."', '', 'Input the extension you desire to be appended at the end of the urls. For example: html', '".$group_id."', '15', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Remove ".$this->name." ? :-(', '".$this->CLASSNAME."_REMOVE', 'No', 'Do you want to remove ".$this->name." (does not delete ".$this->classname.".php class)? By setting Yes the ".$this->name." will be auto removed after a visit on any page in your front store. Another way to remove it is by setting true in the constructor of the ".$this->classname." class. for example: \$".$this->classname." = new ".$this->classname."(true); NOTE: if you visit a page on the front store ".$this->name." will be auto install again. So make sure to remove the ".$this->classname.".php include from application_top.php.', '".$group_id."', '16', 'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");

    global $PHP_SELF;

    $file_extension = substr($PHP_SELF, strrpos($PHP_SELF, '.'));
    $files_array = array();
    if ($dir = @dir(DIR_FS_CATALOG)) {
      while ($file = $dir->read()) {
        if (!is_dir(DIR_FS_CATALOG . $file)) {
          if (substr($file, strrpos($file, '.')) == $file_extension) {
            $files_array[] = $file;
          }
        }
      }
      sort($files_array);
      $dir->close();
    }
    $values=array();
    $keys=array();
    $cnt=15;
    foreach($files_array as $fa){

      $values[]="('Alias for: <b>".$fa."</b>".$pro_version_required."', '".$this->CLASSNAME."_ALIAS_FOR_".$fa."', '', 'Input the alias for the ".$fa.". Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>', '".$group_id."', '".(++$cnt)."', now())";

    }

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ".implode(',',$values));

    return true;

  }

  private function remove() {

    $query=tep_db_query("SELECT configuration_group_id FROM " . TABLE_CONFIGURATION . " WHERE configuration_key='".$this->CLASSNAME."_STATUS' LIMIT 1");
    if(tep_db_num_rows($query)){

      $row=tep_db_fetch_array($query);
      $group_id=$row['configuration_group_id'];

      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_group_id = ".(int)$group_id." ");
      tep_db_query("delete from " . TABLE_CONFIGURATION_GROUP . " where configuration_group_id = ".(int)$group_id." ");

    }

    tep_db_query("DROP TABLE IF EXISTS ".$this->classname);

    if(file_exists($this->cache_file_name)) @unlink($this->cache_file_name);

  }

}//CLASS END

//CALL class
$seo_friendly_urls = new seo_friendly_urls(false);

?>
