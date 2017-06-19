<?php
/**
* SEO Friendly Urls
*
* SEO Friendly Urls offers search engine optimized URLS for osCommerce
* based applications. Other features include optimized performance and
* automatic redirect script.
* @version 2.0.0
* @link http://www.johnbarounis.com/coding/oscommerce/seo-friendly-urls-addon
* @copyright Copyright 2015-2016, John Barounis
* @author John Barounis
*/
class seo_friendly_urls{

  public $name='SEO Friendly Urls PRO Edition';
  private $website='http://www.johnbarounis.com/coding/oscommerce/seo-friendly-urls-addon';
  private $edition='PRO';
  private $version='2.0.0';
  private $advanced_edition_required=false;

  public $enabled = false;
  public $include_page='';//Which page to include. Used when the page type is 'page' and we have rewrite an osc default php page to something else. For example products_new.php to new-products
  public $page_type='page';

  private $classname='';
  private $CLASSNAME='';
  private $enable_aliases=array('products'=>true,'categories'=>true,'manufacturers'=>true,'pages'=>true);
  private $config=array();
  private $categories=array();
  private $products=array();
  private $manufacturers=array();
  private $pages=array();
  private $catalog_languages=array();
  private $catalog_languages_rev=array();
  private $use_custom_aliases=false;//if true reads from db the custom aliases you have entered in pd.products_alias and cd.categories_alias
  private $on_empty_custom_alias_auto_create_alias=true;//Variable $use_custom_aliases must be true
  private $full_path_aliases = true;
  private $transliterate_characters_to_ascii=true;
  private $lowercase_auto_created_aliases=true;
  private $fix_duplicate_aliases=true;
  private $use_default_language_aliases=false;
  private $hide_default_page_from_urls=false;
  private $display_language_alias=true;
  private $display_default_language_alias=true;
  private $language_alias='';
  private $redirect_not_found_urls_to='';
  private $redirect_to_domain=true;
  private $include_not_found_page='';
  private $not_found_url_handling_method='';
  private $urls_extension_products='';
  private $urls_extension_categories='';
  private $urls_extension_manufacturers='';
  private $urls_extension_pages='';
  private $dont_use_backslash_if_parameters=false;
  private $force_redirect_to_new_urls=true;//If true then the default osc urls will direct to new urls if exist. Useful for seo.
  private $permanent_redirect_to_new_urls;
  private $is_apc_installed = false;
  private $cache_aliases='No';
  private $cache_file_name='';
  private $cache_days=3;
  private $time=0;
  private $filter_short_words=0;
  private $isManufacturersPage=0;
  private $current_page_type='categories';

  /**
  * SEO Friendly Urls class constructor
  * @author John Barounis
  * @param boolean $remove
  */
  public function __construct($remove=false){

    //get class name so to use it next
    $this->classname=get_class($this);
    $this->CLASSNAME=strtoupper($this->classname);

    //REMOVE action called
    if(defined($this->CLASSNAME.'_REMOVE') && !$remove){

      if(constant($this->CLASSNAME.'_REMOVE')=='Yes') $remove=true;

    }

    if($remove){ $this->remove(); return false; }

    //Check if install, if not then install
    if(!$this->check()){//install into configuration

      if($this->install()) $this->redirect(tep_href_link(FILENAME_DEFAULT),false); //need to redirect because we want osc to read the defines from the configuration

    }

    //if versions mismatch then remove.
    if(defined($this->CLASSNAME.'_VERSION')){

      if(constant($this->CLASSNAME.'_VERSION')!=$this->version) { $this->remove(); return false; }

    }else{

      if(isset($this->version)) { $this->remove(); return false; }

    }

    //if editions mismatch then remove.
    if(defined($this->CLASSNAME.'_EDITION')){

      if(constant($this->CLASSNAME.'_EDITION')!=$this->edition) { $this->remove(); return false; }

    }else{

      if(isset($this->edition)) { $this->remove(); return false; }

    }

    $this->enabled = $this->_('_STATUS') == 'True';

    if(!$this->enabled) return false;

    $this->time = time();

    $this->enable_aliases['products'] = $this->_('_ENABLE_ALIASES_FOR_PRODUCTS') == 'Yes';
    $this->enable_aliases['categories'] = $this->_('_ENABLE_ALIASES_FOR_CATEGORIES') == 'Yes';
    $this->enable_aliases['manufacturers'] = $this->_('_ENABLE_ALIASES_FOR_MANUFACTURERS') == 'Yes';
    $this->enable_aliases['pages'] = $this->_('_ENABLE_ALIASES_FOR_PAGES') == 'Yes';

    $this->use_custom_aliases = $this->_('_USE_CUSTOM_ALIASES') == 'True';
    $this->on_empty_custom_alias_auto_create_alias = $this->_('_AUTO_CREATE_ALIASES') == 'True';
    $this->full_path_aliases = $this->_('_FULL_PATH_ALIASES') == 'Yes';
    $this->force_redirect_to_new_urls = $this->_('_FORCE_'.$this->CLASSNAME) == 'True';
    $this->permanent_redirect_to_new_urls = $this->_('_PERMANENT_REDIRECT') == 'Yes';
    $this->redirect_to_domain = $this->_('_REDIRECT_TO_DOMAIN') == 'Yes';

    $this->redirect_not_found_urls_to = $this->_('_REDIRECT_NOT_FOUND_URLS_TO');
    $this->include_not_found_page = $this->_('_INCLUDE_NOT_FOUND_PAGE');

    $this->not_found_url_handling_method = $this->_('_NOT_FOUND_URL_HANDLING_METHOD');

    $this->transliterate_characters_to_ascii=$this->_('_TRANSLITERATE_CHARACTERS_TO_ASCII') == 'True';
    $this->lowercase_auto_created_aliases=$this->_('_LOWERCASE_AUTO_CREATED_ALIASES') == 'Yes';
    $this->use_default_language_aliases=$this->_('_USE_DEFAULT_LANGUAGE_ALIASES') == 'Yes';
    $this->display_language_alias=$this->_('_DISPLAY_LANGUAGE_ALIAS') == 'Yes';
    $this->display_default_language_alias=$this->_('_DISPLAY_DEFAULT_LANGUAGE_ALIAS') == 'Yes';
    $this->cache_aliases = $this->_('_CACHE_ALIASES');

    $this->urls_extension_products = $this->_('_URLS_EXTENSION_PRODUCTS');
    $this->urls_extension_categories = $this->_('_URLS_EXTENSION_CATEGORIES');
    $this->urls_extension_manufacturers = $this->_('_URLS_EXTENSION_MANUFACTURERS');
    $this->urls_extension_pages = $this->_('_URLS_EXTENSION_PAGES');
    $this->dont_use_backslash_if_parameters = $this->_('_DONT_USE_BACKSLASH_IF_PARAMETERS') == 'Yes';
    $this->fix_duplicate_aliases = $this->_('_FIX_DUPLICATE_ALIASES') == 'Yes';
    $this->hide_default_page_from_urls = $this->_('_HIDE_DEFAULT_PAGE_FROM_URLS') == 'Yes';

    if($this->urls_extension_products!=''){

      if($this->urls_extension_products=='/') $this->urls_extension_products=$this->urls_extension_products;// DO NOT ADD DOT BECAUSE WE HAVE BACKSLASH FOR EXTENSION
      else $this->urls_extension_products='.'.$this->urls_extension_products;// ADD EXTENSION

    }
    if($this->urls_extension_categories!=''){

      if($this->urls_extension_categories=='/') $this->urls_extension_categories=$this->urls_extension_categories;// DO NOT ADD DOT BECAUSE WE HAVE BACKSLASH FOR EXTENSION
      else $this->urls_extension_categories='.'.$this->urls_extension_categories;// ADD EXTENSION

    }
    if($this->urls_extension_manufacturers!=''){

      if($this->urls_extension_manufacturers=='/') $this->urls_extension_manufacturers=$this->urls_extension_manufacturers;// DO NOT ADD DOT BECAUSE WE HAVE BACKSLASH FOR EXTENSION
      else $this->urls_extension_manufacturers='.'.$this->urls_extension_manufacturers;// ADD EXTENSION

    }
    if($this->urls_extension_pages!=''){

      if($this->urls_extension_pages=='/') $this->urls_extension_pages=$this->urls_extension_pages;// DO NOT ADD DOT BECAUSE WE HAVE BACKSLASH FOR EXTENSION
      else $this->urls_extension_pages='.'.$this->urls_extension_pages;// ADD EXTENSION

    }

    $this->cache_file_name = DIR_FS_CACHE.$this->classname.'.cache';
    $this->reset_aliases_cache=$this->_('_RESET_ALIASES_CACHE') == 'Yes';
    if($this->reset_aliases_cache) $this->clear_cache();// CLEAR CACHE
    $this->cache_days = (int)$this->_('_CACHE_DAYS');
    if($this->cache_days>0) $this->delete_cache();// AUTO DELETE CACHE
    $this->filter_short_words = (int)$this->_('_FILTER_SHORT_WORDS');
    $this->is_apc_installed=extension_loaded('apc');

    global $languages_id,$language;

    //Class config in db
    $config_query=tep_db_query("select * from ".$this->classname);
    while ($config_row = tep_db_fetch_array($config_query)) $this->config[$config_row[$this->classname.'_key']] = $config_row[$this->classname.'_value'];

    $languages_query = tep_db_query("select languages_id, name, code, image, directory from " . TABLE_LANGUAGES . " order by sort_order");
    while ($languages = tep_db_fetch_array($languages_query)) $this->catalog_languages[$languages['languages_id']] = $languages['code'];

    $this->catalog_languages_rev = array_flip($this->catalog_languages);

    //GET CACHED DATA IF ANY
    $ca=null;
    if($this->cache_aliases=='file' && file_exists($this->cache_file_name)){

      $ca_file = file_get_contents($this->cache_file_name);
      $ca = unserialize($ca_file);

    }else if($this->cache_aliases=='mysql' && isset($this->config['cache_aliases']) && tep_not_null($this->config['cache_aliases'])){

      $ca=unserialize($this->config['cache_aliases']);

    }else if($this->cache_aliases=='apc'){

      if($this->is_apc_installed) $ca = apc_exists($ths->classname.'_cache_aliases') ? unserialize(apc_fetch($ths->classname.'_cache_aliases')) : false;

    }

    //PROCESS categories and products SO TO CREATE ALIASES
    $create_alias_options=array();
    if($this->transliterate_characters_to_ascii) $create_alias_options['transliterate']=true;
    $create_alias_options['lowercase'] = $this->lowercase_auto_created_aliases ? true : false;

    $products_query_select = '';
    $categories_query_select = '';
    $manufacturers_query_select = '';

    if($this->use_custom_aliases){

      $products_query_select = 'pd.products_alias,';
      $categories_query_select = 'cd.categories_alias,';
      $manufacturers_query_select = 'mi.manufacturers_alias,';

    }

    if(isset($ca['manufacturers'])){

      $this->manufacturers=$ca['manufacturers'];

    }else{

      //GET MANUFACTURERS ALIASES
      $manufacturers_query = tep_db_query("SELECT mi.languages_id, m.manufacturers_id, ".$manufacturers_query_select." m.manufacturers_name FROM " . TABLE_MANUFACTURERS . " m, " . TABLE_MANUFACTURERS_INFO . " mi WHERE m.manufacturers_id = mi.manufacturers_id");

      $manufacturers_alias='';
      while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {

        if(isset($manufacturers['manufacturers_alias'])){

          if(tep_not_null($manufacturers['manufacturers_alias'])) $manufacturers_alias=$manufacturers['manufacturers_alias'];
          elseif($this->on_empty_custom_alias_auto_create_alias) $manufacturers_alias=$this->create_alias($manufacturers['manufacturers_name'],$create_alias_options);
          else $manufacturers_alias='';//by making it empty tep_href_link will use the osc default urls those with get variables

        }else $manufacturers_alias=$this->create_alias($manufacturers['manufacturers_name'],$create_alias_options);

        $this->manufacturers[$manufacturers['languages_id']][$manufacturers['manufacturers_id']] = $manufacturers_alias;

      }

      if($this->use_default_language_aliases){//ACTUALLY NO NEED because manufacturer name is not translatable

        foreach($this->manufacturers as $key => $value){

          if(isset($this->catalog_languages_rev[DEFAULT_LANGUAGE]) && $this->catalog_languages_rev[DEFAULT_LANGUAGE]==$key) continue;

          if($this->on_empty_custom_alias_auto_create_alias){

            foreach($value as $kk => $vv){

              $this->manufacturers[$key][$kk]=$this->manufacturers[$this->catalog_languages_rev[DEFAULT_LANGUAGE]][$kk];

            }

          }

        }

      }

    }

    //if we have cached the procced to process without executing rest of code
    if(isset($ca['categories']) && isset($ca['products'])){

      $this->categories=$ca['categories'];
      $this->products=$ca['products'];

      $this->process();
      return false;

    }

    $products_query = tep_db_query("SELECT pd.language_id, p.products_id, pd.products_name, ".$products_query_select." p2c.categories_id  FROM " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c WHERE p.products_status = '1' AND p.products_id = pd.products_id AND p2c.products_id=p.products_id AND p2c.products_id=pd.products_id AND p2c.canonical > 0");

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

    $categories_query = tep_db_query("SELECT cd.language_id, c.categories_id, cd.categories_name, ".$categories_query_select." c.parent_id FROM " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd WHERE c.categories_id = cd.categories_id ORDER BY sort_order, cd.categories_name");

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
    if($this->fix_duplicate_aliases) $this->duplicate_aliases_fix();

    //CACHE ALIASES IF ENABLED
    if($this->cache_aliases=='mysql'){

      $ser=serialize(array('categories'=>$this->categories,'products'=>$this->products));
      tep_db_query("DELETE FROM ".$this->classname." WHERE ".$this->classname."_key='cache_aliases' ");
      tep_db_query("INSERT INTO ".$this->classname." (".$this->classname."_key,".$this->classname."_value,".$this->classname."_date) VALUES ('cache_aliases','".tep_db_input($ser)."','".$this->time."')");

    }else if($this->cache_aliases=='file'){

      file_put_contents($this->cache_file_name,serialize(array('categories'=>$this->categories,'products'=>$this->products,'manufacturers'=>$this->manufacturers)));

    }else if($this->cache_aliases=='apc'){

      if($this->is_apc_installed) apc_store($ths->classname.'_cache_aliases',serialize(array('categories'=>$this->categories,'products'=>$this->products)),$this->cache_days*86400);

    }

     $this->process();

  }

  //AFTER WE CREATED THE PRODUCTS & CATEGORIES TREE ALIASES LETS PROCESS TO FIND OUT WHICH PAGE WE ARE LOCATED IN
  private function process(){

    global $PHP_SELF, $cPath,$cPath_array, $languages_id, $current_category_id, $HTTP_GET_VARS;

    $parsedUrl=parse_url($_SERVER['REQUEST_URI']);
    $queryParts=explode('/',$parsedUrl['path']);

    array_shift($queryParts); // the first element will be empty so we get rid of it

    $ws_catalog = ENABLE_SSL == true ? DIR_WS_HTTPS_CATALOG : DIR_WS_HTTP_CATALOG;
    $ws_strs=array_filter( explode('/',$ws_catalog) );
    $dif = array_diff($queryParts, $ws_strs);
    $qg=implode('/',$dif);//so to get only the part of the url that we want

    $url_extension='';

    //if($this->urls_extension_products!='' || $this->urls_extension_categories!='' || $this->urls_extension_manufacturers!='' || $this->urls_extension_pages!='' ){//if we have an extension or the backslash then remove it from $qg

      $path_parts=pathinfo($qg);

      if(isset($path_parts['extension']) && $path_parts['extension']!='php'){

        $url_extension='.'.$path_parts['extension'];

        $ue=explode('.'.$path_parts['extension'],$qg);
        $qg=$ue[0];

      }else{

        //check if last char is /
        $last_url_char=substr($qg, -1);
        if($last_url_char=='/') $url_extension=$last_url_char;


      }

      if(substr($qg, -1)=='/') $qg = rtrim($qg,'/');

    //}

    $path_parts=pathinfo($qg);

    $lid=$languages_id;

    $qg=rawurldecode($qg);//so to recognize non lating letters

    if($this->display_language_alias){

      $lexp=explode('/',$qg);

      if(isset($this->catalog_languages_rev[$lexp[0]])) $lid=$this->catalog_languages_rev[$lexp[0]];

    }

    //manufacturers NEED SPECIAL TREATMENT
    if(isset($_GET['manufacturers_id']) && $this->enable_aliases['manufacturers']){//redirect to aliased url

      //$rev_manufacturers=array_flip($this->manufacturers[$lid]);//flip manufacturers aliases tree so to use isset instead of searching using a loop or in_array
      if(isset($this->manufacturers[$lid][(int)$_GET['manufacturers_id']])){

        $mparams = tep_get_all_get_params(array('manufacturers_id'));

        $lang_alias='';
        if($this->display_language_alias && isset($this->catalog_languages[$lid])){

          $lang_alias=$this->catalog_languages[$lid].'/';

        }

        if($this->display_default_language_alias){

          if(isset($this->catalog_languages[$lid]) && DEFAULT_LANGUAGE==$this->catalog_languages[$lid]) $lang_alias=$this->catalog_languages[$lid].'/';

        }else{

          if(!$this->display_language_alias) $lang_alias='';
          if(isset($this->catalog_languages[$lid]) && DEFAULT_LANGUAGE==$this->catalog_languages[$lid]) $lang_alias='';

        }

        if($this->dont_use_backslash_if_parameters && $mparams!='' && $this->urls_extension_manufacturers=='/') $this->redirect($this->construct_url($lang_alias.$this->manufacturers[$lid][(int)$_GET['manufacturers_id']].($mparams!=''?'?'.$mparams:'')),301);
        else $this->redirect($this->construct_url($lang_alias.$this->manufacturers[$lid][(int)$_GET['manufacturers_id']].$this->urls_extension_manufacturers.($mparams!=''?'?'.$mparams:'')),301);

      }

    }

    //check to see if last diff item exist in products if so then we have a products page
    if(isset($this->products[$lid])){
      foreach($this->products[$lid] as $key => $value){

        foreach($value as $k => $v){

          if($v===$qg){

            $this->extensions_check('products',$url_extension,$qg);

            $HTTP_GET_VARS['products_id']=$k.'';//needs to be string because of the tep_get_all_get_params
            $this->page_type='product';
            $this->include_page=FILENAME_PRODUCT_INFO;
            $this->current_page_type='products';

            break 2;

          }

        }

      }
    }

    //if there is an aliased product but we have disable the alias for products then redirect to original products page.
    if($this->page_type=='product' && !$this->enable_aliases['products']){

      $this->redirect(tep_href_link(FILENAME_PRODUCT_INFO,tep_get_all_get_params()),301);

    }

    if($this->page_type!='product'){

      $cp='';
      if(isset($this->categories[$lid])){
        $rev_categories=array_flip($this->categories[$lid]);//flip categories aliases tree so to use isset instead of searching using a loop or in_array

        if(isset($rev_categories[$qg])) $cp=$rev_categories[$qg];
        if(tep_not_null($cp) && $this->enable_aliases['categories']){

          $this->extensions_check('categories',$url_extension,$qg,'manufacturers_id');

          $this->page_type='category';
          $this->current_page_type='categories';
          //osCommerce needs those so to identify category page
          $cPath_array=explode('_',$cp);
          $cPath = implode('_', $cPath_array);
          $HTTP_GET_VARS['cPath']=$cPath;
          $current_category_id=(int)end($cPath_array);
          //osCommerce needs those so to identify category page

        }else{//there is a category with emtpy name

          //$this->redirect(tep_href_link($this->redirect_not_found_urls_to),404);
          //die;

        }
      }

    }

    //GET PAGES ALIASES IN AN ARRAY
    $this->getPages();

    //Discover root new pages
    if(defined($this->CLASSNAME.'_DISCOVER_NEW_PAGES') && $this->_('_DISCOVER_NEW_PAGES')=='Yes'){

      $this->discoverRootPages();

    }

    if($this->page_type=='page'){// IF PAGE TYPE == page try to find which page to include

      $this->current_page_type='pages';

      //if language then remove alias from $qc
      if($this->display_language_alias || $this->display_default_language_alias){

        $qg_exp=explode('/',$qg);
        if(isset($qg_exp[0]) && isset($qg_exp[1])) $qg=$qg_exp[1];

      }

      foreach($this->pages as $k => $v){

        if($v===$qg && $k!==FILENAME_DEFAULT && $v!==''){

          $this->include_page=$k;
          break;

        }

      }

      if($this->include_page!='' && !$this->enable_aliases['pages']){

        $this->redirect($this->construct_url($this->include_page),404);

      }

      $isManufacturersPage=false;
      if($this->include_page==''){

        if(!isset($this->pages[$qg]) && $qg!=''){

        $isManufacturersPage=!$this->enable_aliases['manufacturers'] ? true : false;

        //check to see if we have manufacturer
        if(isset($this->manufacturers[$lid]) && $this->enable_aliases['manufacturers']){

          $rev_manufacturers=array_flip($this->manufacturers[$lid]);//flip manufacturers aliases tree so to use isset instead of searching using a loop or in_array
          if(isset($rev_manufacturers[$qg])){

            $this->extensions_check('manufacturers',$url_extension,$qg,'manufacturers_id');

            $isManufacturersPage=true;
            $this->page_type='category';
            $this->current_page_type='manufacturers';
            $this->isManufacturersPage=$rev_manufacturers[$qg];
            //osCommerce needs those so to identify category page
            $HTTP_GET_VARS['manufacturers_id']=$rev_manufacturers[$qg];
            //osCommerce needs those so to identify category page

          }

        }else $isManufacturersPage=false;

          if(!$isManufacturersPage){

            $this->current_page_type='pages';

            if(!isset($this->pages[$PHP_SELF]) || (isset($this->pages[$PHP_SELF]) && $this->pages[$PHP_SELF]=='') || $PHP_SELF==FILENAME_DEFAULT ){

              if(!$this->enable_aliases['pages']) $this->redirect($this->construct_url($this->redirect_not_found_urls_to),404);

              //if(!file_exists(DIR_FS_CATALOG.$PHP_SELF)){// if file exists and not in pages array then it is not indexed by SEO Friendly Urls

              if($PHP_SELF!=FILENAME_DEFAULT && file_exists(DIR_FS_CATALOG.$PHP_SELF)){

              }else{

                if($this->pages[FILENAME_DEFAULT]==$this->redirect_not_found_urls_to) $this->redirect(tep_href_link(FILENAME_DEFAULT),404);
                elseif(isset($this->pages[$this->redirect_not_found_urls_to]) && $qg!=$this->pages[$this->redirect_not_found_urls_to]){

                  //check to see if page we are about to redirect has rewrites
                  if($this->pages[$this->redirect_not_found_urls_to]!='') $this->redirect(tep_href_link($this->pages[$this->redirect_not_found_urls_to]),404);
                  else $this->redirect(tep_href_link($this->redirect_not_found_urls_to),404);

                }

              }


            }

          }

        }

      }

      foreach($this->pages as $k => $v){

        if($v==$qg && $v!=''){

          $this->extensions_check('pages',$url_extension,$qg);

          break;

        }

      }

      if(!$isManufacturersPage && isset($this->pages[$qg]) && $this->pages[$qg]!=''){

        $this->extensions_check('pages',$url_extension,$qg);

      }

    }

    //REDIRECT OLD URLS TO NEW
    if($this->force_redirect_to_new_urls){

      if(isset($this->pages[$PHP_SELF]) && $this->pages[$PHP_SELF]!='' && $PHP_SELF!=FILENAME_DEFAULT && $this->enable_aliases['pages'] ){

        $this->redirect(tep_href_link($this->pages[$PHP_SELF], tep_get_all_get_params()),301);

      }

      if($PHP_SELF==FILENAME_DEFAULT && $qg==FILENAME_DEFAULT){

        if($this->enable_aliases['categories'] && isset($_GET['cPath']) && isset($this->categories[$languages_id][$_GET['cPath']])){

          $rest_params=tep_get_all_get_params(array('cPath'));
          $goTo=$this->categories[$languages_id][$_GET['cPath']].($rest_params!=''?'?'.$rest_params:'');
          $this->redirect($this->construct_url($goTo),301);

        }else{

          if($this->redirect_not_found_urls_to!=FILENAME_DEFAULT){

            $this->redirect($this->construct_url($this->redirect_not_found_urls_to),301);

          }

        }

      }

      //since products page uses special rewrites with the categories included in the path then find the url to go to
      if($PHP_SELF==FILENAME_PRODUCT_INFO && $qg==FILENAME_PRODUCT_INFO && $this->enable_aliases['products']){

        $products_id=$_GET['products_id'];
        //find get variables but not products_id
        $rest_params=tep_get_all_get_params(array('products_id','cPath'));
        $product_alias='';
        foreach($this->products[$lid] as $key => $value){

          foreach($value as $k => $v){

            if($k==$products_id) { $product_alias=$v; break 2; }

          }

        }

        $goTo=$this->redirect_not_found_urls_to;
        if($product_alias!='') $goTo=$product_alias.($rest_params!=''?'?'.$rest_params:'');

        $this->redirect($this->construct_url($goTo),301);

      }

    }

    //redirect index.php to domain
    if($this->redirect_to_domain && $qg==FILENAME_DEFAULT && $PHP_SELF==FILENAME_DEFAULT){

      $params=tep_get_all_get_params();

      if(!tep_not_null($params)){

        $this->redirect($this->construct_url(),301);

      }

    }

  }

  //FUNCTION TO CHECK ABOUT PROPER EXTENSION BASED ON OPTIONS
  private function extensions_check($type='',$url_extension='',$qg='',$parameters=''){

    $suext='';
    if($parameters!='') $parameters=explode(',',$parameters);
    switch($type){
      case'products': $suext=$this->urls_extension_products; break;
      case'categories': $suext=$this->urls_extension_categories; break;
      case'pages': $suext=$this->urls_extension_pages; break;
      case'manufacturers': $suext=$this->urls_extension_manufacturers; break;
      default: return false;
    }

    if($suext!=''){

      if($this->dont_use_backslash_if_parameters && $suext=='/' && $url_extension=='/'){//CHECKED
        $params = tep_get_all_get_params($parameters);
        if($params!='') $this->redirect(tep_href_link($qg.'?'.$params),301);
      }

      if($suext!=$url_extension){

        if($suext=='/' && $url_extension==''){

          if(!$this->dont_use_backslash_if_parameters){

            $params = tep_get_all_get_params($parameters);
            $this->redirect(tep_href_link($qg.$suext.($params!=''?'?'.$params:'')),301);

          }

        }else{

          $params = tep_get_all_get_params($parameters);
          $this->redirect(tep_href_link($qg.$suext.($params!=''?'?'.$params:'')),301);

        }

      }

    }else{

      if($url_extension!=''){

        //if(!$this->dont_use_backslash_if_parameters){

          $params = tep_get_all_get_params($parameters);
          $this->redirect(tep_href_link($qg.$suext.($params!=''?'?'.$params:'')),301);

        //}

      }

    }

  }

  //PUBLIC FUNCTION :: used in application_top.php when we use actions i.e.
  public function process_goto_link(){

    global $languages_id;

    $parsedUrl=parse_url($_SERVER['REQUEST_URI']);
    $queryParts=explode('/',$parsedUrl['path']);

    array_shift($queryParts); // the first element will be empty so we get rid of it

    $ws_catalog = ENABLE_SSL == true ? DIR_WS_HTTPS_CATALOG : DIR_WS_HTTP_CATALOG;
    $ws_strs=array_filter( explode('/',$ws_catalog) );
    $dif = array_diff($queryParts, $ws_strs);
    $qg=implode('/',$dif);//so to get only the part of the url that we want

    //if($this->urls_extension_products!='' || $this->urls_extension_categories!='' || $this->urls_extension_pages!='' ){//if we have an extension or the backslash then remove it from $qg

      $path_parts=pathinfo($qg);
      if(isset($path_parts['extension']) && $path_parts['extension']!='php'){

        $ue=explode('.'.$path_parts['extension'],$qg);
        $qg=$ue[0];

      }

      if(substr($qg, -1)=='/') $qg = rtrim($qg,'/');

    //}

    $lid=$languages_id;

    $qg=rawurldecode($qg);//so to recognize non lating letters

    if($this->display_language_alias){

      $lexp=explode('/',$qg);

      if(isset($this->catalog_languages_rev[$lexp[0]])) $lid=$this->catalog_languages_rev[$lexp[0]];

    }

    //check to see if last diff item exist in products if so then we have a products page
    $isProduct=false;
    foreach($this->products[$lid] as $key => $value){

      foreach($value as $k => $v){

        if($v===$qg){

          $isProduct=true;
          break 2;

        }

      }

    }

    $ccategory='';

    if($isProduct){

      $qwe=explode('/',$qg);
      array_pop($qwe);
      $ccategory=implode('/',$qwe);

    }

    //check to see if we have a manufacturers page
    if($ccategory==''){

      foreach($this->manufacturers as $k => $v){

        if($v==$qg){

          $ccategory=$qg;
          break;

        }

      }

    }

    if($ccategory==''){//check to see if we have a page

      foreach($this->pages as $k => $v){

        if($v==$qg){

          $ccategory=$qg;
          break;

        }

      }

    }

    return $ccategory;

  }

  //PUBLIC FUNCTION :: THIS FUNCTION MUST BE CALLED FROM tep_href_link
  public function process_link($page,$parameters){

    global $languages_id,$PHP_SELF;

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
    if($this->display_language_alias && isset($this->catalog_languages[$languages_id])){

      $lang_alias=$this->catalog_languages[$languages_id].'/';

    }

    if($this->display_default_language_alias){

      if(isset($this->catalog_languages[$languages_id]) && DEFAULT_LANGUAGE==$this->catalog_languages[$languages_id]) $lang_alias=$this->catalog_languages[$languages_id].'/';

    }else{

      if(!$this->display_language_alias) $lang_alias='';
      if(isset($this->catalog_languages[$languages_id]) && DEFAULT_LANGUAGE==$this->catalog_languages[$languages_id]) $lang_alias='';

    }

    if (tep_not_null($parameters)) {

      $separator = '&';
      $eps=array_filter(explode('&',tep_output_string($parameters)));
      $parameter_cPath='';
      $parameter_products_id=0;
      $parameter_manufacturers_id=0;
      $parameter_language='';
      $parameter_rest=array();
      foreach($eps as $ep){

        $get_key=array_filter(explode('=',$ep));

        //if($get_key[0]=='osCsid') continue;

        if($get_key[0]=='cPath' && isset($get_key[1])) $parameter_cPath=$get_key[1];
        //elseif($get_key[0]=='products_id' && isset($get_key[1]) && $page==FILENAME_PRODUCT_INFO){//make sure it is used only in products page
        elseif($get_key[0]=='products_id' && isset($get_key[1])
        && $page!=FILENAME_SHOPPING_CART
        && $page!=FILENAME_PRODUCT_REVIEWS
        && $page!=FILENAME_PRODUCT_REVIEWS_WRITE
        && $page!=FILENAME_PRODUCTS_NEW
        && $page!=FILENAME_SPECIALS
        && $page!=FILENAME_ADVANCED_SEARCH_RESULT
        ){
        //elseif($get_key[0]=='products_id' && isset($get_key[1])){

          $parameter_products_id=(int)$get_key[1];

          if(!is_numeric($get_key[1])){//displaying the users attributes selections in the product_info.php coming for cart products_info.php?products_id=8{4}4

            $parameter_rest[]='atts='.rawurldecode($get_key[1]);

          }

          //if($this->current_page_type=='manufacturers'){
            //$parameter_rest[]='manufacturers_id=1';//.rawurldecode($get_key[1]);
          //}

        }
        //elseif($get_key[0]=='language' && isset($get_key[1])) $parameter_language=$get_key[1];
        elseif($get_key[0]=='manufacturers_id' && isset($get_key[1])){

          $parameter_manufacturers_id=(int)$get_key[1];

        }elseif($this->isManufacturersPage>0){

          $parameter_manufacturers_id=$this->isManufacturersPage;
          $parameter_rest[]=$ep;

        }else{

          $parameter_rest[]=$ep;

        }

      }

      $s_link='';
      $rest_parameters='';
      if(count($parameter_rest)>0){ $rest_parameters='?'.implode('&',$parameter_rest); $separator='&'; }
      else $separator = '?';

      $index_alias='';
      if(isset($this->pages[FILENAME_DEFAULT])) $index_alias=$this->pages[FILENAME_DEFAULT];

      //first check to see if we have alias for a page. We prefer to do that first because its quickier because it will directly give us that page alias and not look into all products and categories first.
      //this assumes that every category or product that has same alias with a page will not be displayed and its position it will be displayed the page.
      if(isset($this->pages[$page]) && $page!=FILENAME_PRODUCT_INFO && $page!=FILENAME_DEFAULT){

        if($this->pages[$page]!='' && $this->enable_aliases['pages']){

          if($this->dont_use_backslash_if_parameters && $this->urls_extension_pages=='/' && $rest_parameters!='') $s_link.=$lang_alias.$this->pages[$page].$rest_parameters;
          else $s_link.=$lang_alias.$this->pages[$page].$this->urls_extension_pages.$rest_parameters;

        }

      }elseif($parameter_products_id>0){//we have a product

        //find product alias
        $product_alias='';
        if($this->enable_aliases['products']){
          if(isset($this->products[$languages_id])){
            foreach($this->products[$languages_id] as $key => $value){

              foreach($value as $k => $v){

                if($k===$parameter_products_id) { $product_alias=$v; break 2; }

              }

            }
          }
        }

        if($product_alias!=''){

          if($this->dont_use_backslash_if_parameters && $this->urls_extension_products=='/' && $rest_parameters!='') $s_link.=$product_alias.$rest_parameters;
          else $s_link.=$product_alias.$this->urls_extension_products.$rest_parameters;

        }else $s_link='';

      }elseif($parameter_manufacturers_id>0 && $this->enable_aliases['manufacturers']){//we have a manufacturer

        if(isset($this->manufacturers[$languages_id][$parameter_manufacturers_id])){

          if($this->dont_use_backslash_if_parameters && $this->urls_extension_manufacturers=='/' && $rest_parameters!='') $s_link.=$lang_alias.$this->manufacturers[$languages_id][$parameter_manufacturers_id].$rest_parameters;
          else $s_link.=$lang_alias.$this->manufacturers[$languages_id][$parameter_manufacturers_id].$this->urls_extension_manufacturers.$rest_parameters;

        }

      }elseif(isset($this->categories[$languages_id][$parameter_cPath]) && $this->enable_aliases['categories']){

        //when we have parameters and extension is set to / do not use the /
        if($this->dont_use_backslash_if_parameters && $this->urls_extension_categories=='/' && $rest_parameters!='') $s_link.=$this->categories[$languages_id][$parameter_cPath].$rest_parameters;
        else $s_link.=$this->categories[$languages_id][$parameter_cPath].$this->urls_extension_categories.$rest_parameters;

      }

      if($this->hide_default_page_from_urls && $s_link=='' && $page==FILENAME_DEFAULT){

        $page='';

      }

      //check to see if we have alias otherwise use osc default urls
      $link .= $s_link!='' ? $s_link : $page. '?' . tep_output_string($parameters);

    }else{

      $pg = $this->enable_aliases['pages'] && isset($this->pages[$page]) && $this->pages[$page]!='' ? $this->pages[$page].$this->urls_extension_pages : $page;
      $link .= $this->hide_default_page_from_urls && $pg==FILENAME_DEFAULT ? '' : $pg;
      $separator = '?';

    }

    return array('seolink'=>$link,'separator'=>$separator);

  }

  private function create_alias($str, $options = array()) {

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

    if($this->enable_aliases['products'] && $this->enable_aliases['categories'] && $this->enable_aliases['categories']){

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
        if(isset($this->products[$k])){
          foreach($this->products[$k] as $pk => $pc){

            foreach($pc as $pcc) $tmpp[]=$pcc;

          }
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

  }

  //HELPER FUNCTION :: return constant based on classname
  private function _($const){

    return constant($this->CLASSNAME.$const);

  }

  private function construct_url($url=''){

    $link='';
    if (ENABLE_SSL == true) {
      $link = HTTPS_SERVER . DIR_WS_HTTPS_CATALOG;
    } else {
      $link = HTTP_SERVER . DIR_WS_HTTP_CATALOG;
    }

    return $link.$url;

  }

  //CUSTOM REDIRECT FUNCTION SO TO INCLUDE 301 HEADER
  private function redirect($url, $status_code=200){

    if ( (strstr($url, "\n") != false) || (strstr($url, "\r") != false) ) {
      $this->redirect(tep_href_link(FILENAME_DEFAULT, '', 'NONSSL', false),$status_code);
    }

    if ( (ENABLE_SSL == true) && (getenv('HTTPS') == 'on') ) { // We are loading an SSL page
      if (substr($url, 0, strlen(HTTP_SERVER . DIR_WS_HTTP_CATALOG)) == HTTP_SERVER . DIR_WS_HTTP_CATALOG) { // NONSSL url
        $url = HTTPS_SERVER . DIR_WS_HTTPS_CATALOG . substr($url, strlen(HTTP_SERVER . DIR_WS_HTTP_CATALOG)); // Change it to SSL
      }
    }

    if ( strpos($url, '&amp;') !== false ) {
      $url = str_replace('&amp;', '&', $url);
    }

    $server_protocol = isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0';

    if($this->permanent_redirect_to_new_urls && $status_code==301) header($server_protocol." 301 Moved Permanently",true,301);

    if($status_code==404){

      switch($this->not_found_url_handling_method){

        case'404 include page':

          header($server_protocol." 404 Not Found",true,404);

          if($this->include_not_found_page!=''){

            include($this->include_not_found_page);
            exit();

          }

        break;

        case'Simple redirect to':

          //simple redirect 404 not work here but we leave just in case
          header($server_protocol." 404 Not Found",true,404);
          header('Location: ' . $url);
          exit();

        break;

      }

    }else{

      header('Location: ' . $url);
      exit();

    }

  }

  //DISCOVER NEW PAGES
  private function discoverRootPages(){

    global $PHP_SELF;

    $pages = $this->getPages();

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

    $indexedPage=array();
    $notIndexedPage=array();

    foreach($files_array as $fa){

      if(!defined($this->CLASSNAME.'_ALIAS_FOR_'.$fa)){

        $notIndexedPage[]=$fa;

      }else{

        $indexedPage[]=$fa;

      }

    }

    //remove pages that do not exist in root but exist in configuration table
    foreach($pages as $page => $val){

      if(!file_exists(DIR_FS_CATALOG.$page)){

        tep_db_query("DELETE FROM ".TABLE_CONFIGURATION." WHERE configuration_key='".($this->CLASSNAME."_ALIAS_FOR_".$page)."' ");

      }

    }

    $max_sort_order=0;
    $cgid_resp=tep_db_query("SELECT configuration_group_id FROM configuration WHERE configuration_key='".$this->CLASSNAME.'_STATUS'."'");
    $group_id=tep_db_fetch_array($cgid_resp);

    if(isset($group_id['configuration_group_id'])){

      $max_sort_order_resp=tep_db_query("SELECT MAX(sort_order) FROM configuration WHERE configuration_group_id='".$group_id['configuration_group_id']."'");
      $max_sort_order=tep_db_fetch_array($max_sort_order_resp);

    }

    //add to configuration table those pages that are not yet exist
    if(count($notIndexedPage)>0){

      $values=array();
      $keys=array();
      $cnt=(int)$max_sort_order['MAX(sort_order)'];
      foreach($notIndexedPage as $nip){

        $values[]="('Alias for: <b>".$nip."</b>', '".$this->CLASSNAME."_ALIAS_FOR_".$nip."', '', 'Input the alias for the ".$nip.". Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>', '".$group_id['configuration_group_id']."', '".(++$cnt)."', now())";

      }

      if(count($values)>0){

        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ".implode(',',$values));

      }

    }

    tep_db_query("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = 'No' WHERE configuration_key = '".$this->CLASSNAME."_DISCOVER_NEW_PAGES' ");

  }

  private function getPages(){

    if(count($this->pages)>0) return $this->pages;

    $gdcs=get_defined_constants();

    foreach($gdcs as $key => $value){

      $page = str_replace($this->CLASSNAME.'_ALIAS_FOR_' , '' , $key, $count);
      if($count==1) $this->pages[$page]=$value;

    }

  }

  private function isEnabled(){
    return $this->enabled;
  }

  private function check(){
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
  private function install(){

    $presult = tep_db_query("SHOW COLUMNS FROM `".TABLE_PRODUCTS_DESCRIPTION."` LIKE 'products_alias'");
    if(!tep_db_num_rows($presult)) tep_db_query("ALTER TABLE  `products_description` ADD  `products_alias` VARCHAR( 255 ) NOT NULL  DEFAULT  '' AFTER  `products_name` ;");

    $cresult = tep_db_query("SHOW COLUMNS FROM `".TABLE_CATEGORIES_DESCRIPTION."` LIKE 'categories_alias'");
    if(!tep_db_num_rows($cresult)) tep_db_query("ALTER TABLE  `categories_description` ADD  `categories_alias` VARCHAR( 255 ) NOT NULL  DEFAULT  '' ;");

    $mresult = tep_db_query("SHOW COLUMNS FROM `".TABLE_MANUFACTURERS_INFO."` LIKE 'manufacturers_alias'");
    if(!tep_db_num_rows($mresult)) tep_db_query("ALTER TABLE `manufacturers_info` ADD  `manufacturers_alias` VARCHAR( 255 ) NOT NULL  DEFAULT  '' ;");

    tep_db_query("CREATE TABLE IF NOT EXISTS `".$this->classname."` (
      `".$this->classname."_id` int(11) NOT NULL AUTO_INCREMENT,
      `".$this->classname."_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
      `".$this->classname."_value` text COLLATE utf8_unicode_ci NOT NULL,
      `".$this->classname."_date` int(11) NOT NULL DEFAULT '0',
      PRIMARY KEY (`".$this->classname."_id`),
      UNIQUE KEY `".$this->classname."_key` (`".$this->classname."_key`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;");

    tep_db_query("insert into " . TABLE_CONFIGURATION_GROUP . " (configuration_group_title, configuration_group_description) values ('".$this->name."', '".$this->name."')");
    $group_id=tep_db_insert_id();

    $advanced_edition_required_text='';
    if($this->advanced_edition_required) $advanced_edition_required_text="&nbsp;&nbsp;<a target=\'_blank\' style=\'color:red;font-style:italic\' href=\'".$this->website."\'>ADVANCED EDITION REQUIRED</a>";

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable SEO Friendly Urls?', '".$this->CLASSNAME.'_STATUS'."', 'False', 'Do you want to enable the SEO Friendly Urls addon?', '".$group_id."', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable aliases for Products?', '".$this->CLASSNAME.'_ENABLE_ALIASES_FOR_PRODUCTS'."', 'Yes', 'Do you want to enable aliases for products?', '".$group_id."', '2', 'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable aliases for Categories?', '".$this->CLASSNAME.'_ENABLE_ALIASES_FOR_CATEGORIES'."', 'Yes', 'Do you want to enable aliases for categories?', '".$group_id."', '3', 'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable aliases for Manufacturers?".$advanced_edition_required_text."', '".$this->CLASSNAME.'_ENABLE_ALIASES_FOR_MANUFACTURERS'."', 'Yes', 'Do you want to enable aliases for manufacturers?', '".$group_id."', '4', 'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable aliases for Pages?".$advanced_edition_required_text."', '".$this->CLASSNAME.'_ENABLE_ALIASES_FOR_PAGES'."', 'Yes', 'Do you want to enable aliases for pages?', '".$group_id."', '5', 'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display language alias (Code) in the urls?".$advanced_edition_required_text."', '".$this->CLASSNAME.'_DISPLAY_LANGUAGE_ALIAS'."', 'Yes', 'Do you want to display the current language alias (Code)?', '".$group_id."', '6', 'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display default language slug (Code) in the urls?".$advanced_edition_required_text."', '".$this->CLASSNAME.'_DISPLAY_DEFAULT_LANGUAGE_ALIAS'."' , 'No', 'Do you want to display the default language slug (Code)? Note: this overrides the above option.', '".$group_id."', '7', 'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Hide ".FILENAME_DEFAULT." from urls?".$advanced_edition_required_text."', '".$this->CLASSNAME.'_HIDE_DEFAULT_PAGE_FROM_URLS'."', 'No', 'While constructing urls, when there is a url that contains ".FILENAME_DEFAULT." it is not added in the url. This is useful when we dont want to display the ugly ".FILENAME_DEFAULT." at all.', '".$group_id."', '8', 'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");

//REDIRECTS

    $redirectLink = ENABLE_SSL == true ? HTTPS_SERVER . DIR_WS_HTTPS_CATALOG : HTTP_SERVER . DIR_WS_HTTP_CATALOG;

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Redirect ".FILENAME_DEFAULT." to ".$redirectLink." ?".$advanced_edition_required_text."', '".$this->CLASSNAME.'_REDIRECT_TO_DOMAIN'."', 'Yes', 'Redirect ".FILENAME_DEFAULT." to ".$redirectLink." when there are no GET parameters?', '".$group_id."', '8', 'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Redirect old url to new alias url?".$advanced_edition_required_text."', '".$this->CLASSNAME.'_FORCE_'.$this->CLASSNAME."', 'True', 'Do you want to force the use of aliases when an old url entered in the address bar?', '".$group_id."', '9', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('301 Permanent Redirect?".$advanced_edition_required_text."', '".$this->CLASSNAME.'_PERMANENT_REDIRECT'."', 'No', 'When redirect old urls to new use 301 permanent direct?', '".$group_id."', '10', 'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Handle not found urls as simple redirect to? (No 404 status code)".$advanced_edition_required_text."', '".$this->CLASSNAME.'_REDIRECT_NOT_FOUND_URLS_TO'."', 'index.php', 'Input in what page user will be directed when there is a not found url. Do not use alias, only the page file such as index.php. Note: that option does not produce a 404 status code. It is just a redirect.', '".$group_id."', '11', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Handle not found urls as 404 include page? (404 status code)".$advanced_edition_required_text."', '".$this->CLASSNAME.'_INCLUDE_NOT_FOUND_PAGE'."', '', 'Input what page will be included when producing the 404 status code. Note: do not input an oscommerce page. Leave empty so to display the home page.', '".$group_id."', '12', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Not found url handling method?".$advanced_edition_required_text."', '".$this->CLASSNAME.'_NOT_FOUND_URL_HANDLING_METHOD'."', '404 include page', 'Select a method for handling the not found pages.', '".$group_id."', '13', 'tep_cfg_select_option(array(\'Simple redirect to\', \'404 include page\'), ', now())");

//ALIASES

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Auto create aliases?', '".$this->CLASSNAME.'_AUTO_CREATE_ALIASES'."', 'True', 'Do you want to auto create aliases? (Applies only in categories and products pages)', '".$group_id."', '14', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Lower case auto created aliases?', '".$this->CLASSNAME.'_LOWERCASE_AUTO_CREATED_ALIASES'."', 'Yes', 'Do you want to make the auto created aliases to lower case? (This applies only to auto created aliases not the custom ones)', '".$group_id."', '15', 'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Transliterate characters to ASCII?', '".$this->CLASSNAME.'_TRANSLITERATE_CHARACTERS_TO_ASCII'."', 'True', 'Do you want to transliterate alias characters to ASCII? (Applies only in categories and products pages)', '".$group_id."', '16', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Use aliases from default language?', '".$this->CLASSNAME.'_USE_DEFAULT_LANGUAGE_ALIASES'."', 'Yes', 'Do you want to use the default language aliases? In the greek language when english is default use: gr/monitors instead of gr/othones', '".$group_id."', '17', 'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Use custom aliases?".$advanced_edition_required_text."', '".$this->CLASSNAME.'_USE_CUSTOM_ALIASES'."', 'False', 'Do you want to use custom aliases? Custom aliases use the values from table fields products_alias, categories_alias and manufacturers_alias.".$pro_version_required."', '".$group_id."', '18', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Fix duplicate aliases?".$advanced_edition_required_text."', '".$this->CLASSNAME.'_FIX_DUPLICATE_ALIASES'."', 'Yes', 'Do you want to fix duplicate aliases. Note: if duplicate alias found then a number will be appended at the end of the url. Note: duplicate fix is ony between pages, products and cateogries not manufacturers".$pro_version_required."', '".$group_id."', '19', 'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Full path aliases?".$advanced_edition_required_text."', '".$this->CLASSNAME.'_FULL_PATH_ALIASES'."', 'Yes', 'For example: http://mystore.com/dvd-movies/action/speed vs http://mystore.com/speed.', '".$group_id."', '20', 'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");

//CACHE ALIASES

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Cache aliases?".$advanced_edition_required_text."', '".$this->CLASSNAME.'_CACHE_ALIASES'."', 'No', 'Cache aliases?.', '".$group_id."', '21', 'tep_cfg_select_option(array(\'No\', \'mysql\', \'apc\',\'file\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Reset Aliases Cache?".$advanced_edition_required_text."', '".$this->CLASSNAME.'_RESET_ALIASES_CACHE'."', 'No', 'Reset aliases cache? Note: <b>this is a must when you make changes to the aliases structure based on the above options.</b>', '".$group_id."', '22', 'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Days to store Cache?".$advanced_edition_required_text."', '".$this->CLASSNAME.'_CACHE_DAYS'."', '3', 'How many days a cache will be kept before auto deleting itself. Set 0 to not auto delete.', '".$group_id."', '23', now())");

//EXTRAS

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Filter Short Words?', '".$this->CLASSNAME.'_FILTER_SHORT_WORDS'."', '1', 'When creating a link from a product name you may want to remove the shorter words like a | or | at | the .. etc. Set 0 for not filtering any short words.', '".$group_id."', '24', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Products Urls extension?', '".$this->CLASSNAME.'_URLS_EXTENSION_PRODUCTS'."', '', 'Input the extension you desire to be appended at the end of the products urls. For example: html<br>Tip: <b>enter the backslash char / if you want your urls to end with /</b>', '".$group_id."', '25', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Categories Urls extension?', '".$this->CLASSNAME.'_URLS_EXTENSION_CATEGORIES'."', '', 'Input the extension you desire to be appended at the end of the categories urls. For example: html<br>Tip: <b>enter the backslash char / if you want your urls to end with /</b>', '".$group_id."', '26', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Manufacturers Urls extension?".$advanced_edition_required_text."', '".$this->CLASSNAME.'_URLS_EXTENSION_MANUFACTURERS'."', '', 'Input the extension you desire to be appended at the end of the manufacturers urls. For example: html<br>Tip: <b>enter the backslash char / if you want your urls to end with /</b>', '".$group_id."', '27', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Pages Urls extension?', '".$this->CLASSNAME.'_URLS_EXTENSION_PAGES'."', '', 'Input the extension you desire to be appended at the end of the pages urls. For example: html<br>Tip: <b>enter the backslash char / if you want your urls to end with /</b>', '".$group_id."', '28', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Do not use / if there are parameters in url. Applies only when extension is set to backslash. (Experimental)', '".$this->CLASSNAME.'_DONT_USE_BACKSLASH_IF_PARAMETERS'."', 'No', 'If we have set as an extension a backslash then if the url has parameters then display the / or not. <b>I.e. drama/?filter=2a vs drama?filter=2a</b>', '".$group_id."', '29','tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Re-index root pages in the root?".$advanced_edition_required_text."', '".$this->CLASSNAME."_DISCOVER_NEW_PAGES', 'No', 'Do you want to discover new pages added in the root so to make it possible to alias them? (This option auto sets to No when finished operation.)', '".$group_id."', '30', 'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Remove ".$this->name." ? :-(', '".$this->CLASSNAME."_REMOVE', 'No', 'Do you want to remove ".$this->name."? Note: it does not delete the ".$this->classname.".php class. By setting Yes the ".$this->name." will be auto removed after a visit on any page in your front store.', '".$group_id."', '31', 'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Version:', '".$this->CLASSNAME."_VERSION', '".$this->version."', 'Current version of ".$this->name." (Do not edit as it is used by the class)', '".$group_id."', '32', 'tep_cfg_select_option(array(\'".$this->version."\'), ', now())");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Edition:', '".$this->CLASSNAME."_EDITION', '".$this->edition."', 'Current edition of ".$this->name." (Do not edit as it is used by the class)', '".$group_id."', '33', 'tep_cfg_select_option(array(\'".$this->edition."\'), ', now())");

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
    $cnt=33;
    foreach($files_array as $fa){

      $values[]="('Alias for: <b>".$fa."</b>".$advanced_edition_required_text."', '".$this->CLASSNAME."_ALIAS_FOR_".$fa."', '', 'Input the alias for the ".$fa.". Leave empty for no alias use.<br><br>If not empty: MAKE SURE YOU CHANGE <b>require(\'includes/application_top.php\');</b> TO <b>require_once(\'includes/application_top.php\');</b> on this page.</b>', '".$group_id."', '".(++$cnt)."', now())";

    }

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ".implode(',',$values));

    return true;

  }

  private function remove() {

    $query=tep_db_query("SELECT configuration_group_id FROM " . TABLE_CONFIGURATION . " WHERE configuration_key='".$this->CLASSNAME."_STATUS' LIMIT 1");
    if(tep_db_num_rows($query)){

      $row=tep_db_fetch_array($query);

      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_group_id = ".(int)$row['configuration_group_id']." ");
      tep_db_query("delete from " . TABLE_CONFIGURATION_GROUP . " where configuration_group_id = ".(int)$row['configuration_group_id']." ");

    }

    tep_db_query("DROP TABLE IF EXISTS ".$this->classname);

    if(file_exists($this->cache_file_name)) @unlink($this->cache_file_name);

  }

  private function delete_cache(){

    if($this->cache_days>0){

      $days_to_secs=$this->cache_days*86400;

      $th=$this->time-$days_to_secs;

      tep_db_query("DELETE FROM ".$this->classname." WHERE ".$this->classname."_key='cache_aliases' AND ".$this->classname."_date>'".$th."' ");
      if(file_exists($this->cache_file_name)){

        $fct=filectime($this->cache_file_name);
        if($fct && $th>$fct) @unlink($this->cache_file_name);

      }
      //APC gets auto removed after certain secs defined on apc_store method
      //if($this->is_apc_installed) apc_delete($ths->classname.'_cache_aliases');

    }

  }

}//CLASS END

//CALL class
$seo_friendly_urls = new seo_friendly_urls();

?>