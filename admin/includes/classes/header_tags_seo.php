<?php
class headertags_seo {

  function headertags_seo(){
  }
  
  function get_cust() {
    $cust_query = tep_db_query("select * from " . TABLE_CUSTOMERS . " where customers_id = 1");
    $cust = tep_db_fetch_array($cust_query);
    return $cust['customers_firstname'];
  }
}