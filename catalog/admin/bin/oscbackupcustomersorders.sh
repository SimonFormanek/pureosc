#!/bin/bash
#special for addons (remove on standard osc): coupons*
if [ ! "$1" ] 
then 
    echo 'Missing: $1: "-uuser -ppassword -hhost" and $2: dDBname. You can skip all on localhost :), only dDBname is needed...'
    exit
fi
if [ ! "$2" ] 
then 
    DBNAME=$1 
else
    DBNAME=$2
    DUMPSET=$1
fi
/usr/bin/mysqldump --opt ${DUMPSET} ${DBNAME} \
address_book \
address_format \
coupon_email_track \
coupon_gv_customer \
coupon_gv_queue \
coupon_redeem_track \
customers_info \
orders \
orders_products \
orders_products_attributes \
orders_products_download \
orders_status_history \
orders_total \
products_notifications \
| gzip  > ${DBNAME}_customers_orders.sql.gz