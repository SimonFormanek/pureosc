# sql is easy

and we can better understanding your business by queriing directly your database.

## select orders waiting for payment 

assuming orders_status =7:
  select COUNT(orders_id) FROM orders WHERE orders_status =7;

within time range: 
  select COUNT(orders_id) FROM orders WHERE orders_status =7 
  AND date_purchased >=  '2019-09-01 00:00:00' 
  AND date_purchased < '2019-10-01 00:00:00';
