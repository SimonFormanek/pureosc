#!/bin/bash
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
customers_info \
orders \
orders_products \
orders_products_attributes \
orders_products_download \
orders_status_history \
orders_total \
| gzip  > ${DBNAME}_customers_orders.sql.gz
