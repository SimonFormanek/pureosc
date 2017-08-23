<?php

//tady to zacina.....    
    
/*    
    $articles_query = tep_db_query("SELECT pd.language_id, p.articles_id, pd.articles_name, ".$articles_query_select." p2c.topics_id  FROM " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c WHERE p.articles_status = '1' AND p.articles_id = pd.articles_id AND p2c.articles_id=p.articles_id AND p2c.articles_id=pd.articles_id AND p2c.canonical > 0");
*/
    
    $articles_query = tep_db_query("SELECT ad.language_id, a.articles_id, ad.articles_name, a2t.topics_id  FROM articles_description ad, articles a, articles_to_topics a2t WHERE a.articles_status = '1' AND a.articles_id = ad.articles_id AND a2t.articles_id=a.articles_id AND a2t.articles_id=ad.articles_id AND a2t.canonical > 0");

    
    
    $articles_alias='';
    while ($articles = tep_db_fetch_array($articles_query)) {

      if(isset($articles['articles_alias'])){

        if(tep_not_null($articles['articles_alias'])) $articles_alias=$articles['articles_alias'];
        elseif($this->on_empty_custom_alias_auto_create_alias) $articles_alias=$this->create_alias($articles['articles_name'],$create_alias_options);
        else $articles_alias='';//by making it empty tep_href_link will use the osc default urls those with get variables

      }else $articles_alias=$this->create_alias($articles['articles_name'],$create_alias_options);

      $this->articles[$articles['language_id']][$articles['topics_id']][$articles['articles_id']] = $articles_alias;

    }

    if($this->use_default_language_aliases){

      foreach($this->articles as $key => $value){

        if(isset($this->catalog_languages_rev[DEFAULT_LANGUAGE]) && $this->catalog_languages_rev[DEFAULT_LANGUAGE]==$key) continue;

        if($this->on_empty_custom_alias_auto_create_alias){

          foreach($value as $kk => $vv){

            foreach($vv as $k => $v){

              $this->articles[$key][$kk][$k]=$this->articles[$this->catalog_languages_rev[DEFAULT_LANGUAGE]][$kk][$k];

            }

          }

        }

      }

    }

    $topics_query = tep_db_query("SELECT td.language_id, t.topics_id, td.topics_name, t.parent_id FROM topics t, topics_description td WHERE t.topics_id = td.topics_id ORDER BY sort_order, td.topics_name");

    $items = array();
    $topics_alias='';
    while ($topics = tep_db_fetch_array($topics_query)) {

      if(isset($topics['topics_alias'])){

        if(tep_not_null($topics['topics_alias'])) $topics_alias=$topics['topics_alias'];
        elseif($this->on_empty_custom_alias_auto_create_alias) $topics_alias=$this->create_alias($topics['topics_name'],$create_alias_options);
        else $topics_alias='';//by making it empty tep_href_link will use the osc default urls those with get variables

      }else $topics_alias=$this->create_alias($topics['topics_name'],$create_alias_options);

      $items[$topics['language_id']][$topics['topics_id']] = array('name' => $topics['topics_name'], 'alias' => $topics_alias, 'parent_id' => $topics['parent_id'], 'id' => $topics['topics_id']);

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
      elseif($citems==1) $children[] = $items[$clang]; //in case we have one category item without subtopics, rare but possible
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

            if(count($stack)<=0) $this->topics[$clang][$rt.$option['value']['id']]=$path_alias;
            else $this->topics[$clang][$rt.implode('_',$stack)]=$path_alias;

            if(isset($this->articles[$clang][$option['value']['id']])){

              if($this->full_path_aliases) foreach($this->articles[$clang][$option['value']['id']] as $key => $value) $this->articles[$clang][$option['value']['id']][$key]=$value=='' ? '' : $path_alias.'/'.$value;
              else foreach($this->articles[$clang][$option['value']['id']] as $key => $value) $this->articles[$clang][$option['value']['id']][$key]=$value=='' ? '' : $lang_alias.$value;

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

            if(count($stack)<=0) $this->topics[$clang][$rt.$option['value']['id']]=$path_alias;
            else $this->topics[$clang][$rt.implode('_',$stack).'_'.$option['value']['id']]=$path_alias;

            if(isset($this->articles[$clang][$option['value']['id']])){

              if($this->full_path_aliases) foreach($this->articles[$clang][$option['value']['id']] as $key => $value) $this->articles[$clang][$option['value']['id']][$key]=$value=='' ? '' : $path_alias.'/'.$value;
              else foreach($this->articles[$clang][$option['value']['id']] as $key => $value) $this->articles[$clang][$option['value']['id']][$key]=$value=='' ? '' : $lang_alias.$value;

            }

          }
       }

     }

     
//..a tady zatim konci.     
     


?>

