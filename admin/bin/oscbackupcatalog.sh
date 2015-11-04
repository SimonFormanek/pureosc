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
categories \
categories_description \
coupons \
coupons_description \
products \
products_attributes \
products_attributes_download \
products_description \
products_options \
products_options_values  \
products_options_values_to_products_options \
products_to_categories \
specials \
| gzip  > ${DBNAME}_catalog.sql.gz