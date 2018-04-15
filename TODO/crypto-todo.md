# crypto todo

session consistency and privacy checks
--------------------------------------------------------------
* tep_recreate_session - delat vzdy, po kazdem dotazu?
* check_user_ip, check_user_agent ????
* encrypt all session?

testing needed topics:
-------------------------------------------
* reserve of empty new customers
* display all decryption errors in debug mode, log errors in production


zasifrovat nezapomenout:
-----------------------------------------------------------------------------
* !!! date of birdth zasifrovat
* ! date of birdth chytre anonymizovat hash (?) dosazeno 18 let

### customers_email_address
* zasifrovat nebo zahashovat

user grant todo
------------------------------------------------------------------------------------------------------------

## testing usage _REAL tables
		password_funcs.php:137     
		$keys_query = tep_db_query("SELECT private_key_customer FROM " . constant('TABLE_KEYS_CUSTOMER_REAL') . " WHERE customers  ...")

## NEW tables to create row-level security policy
to be considered:
* customers_info
* orders_products, orders_total
* coupon_*, coupons