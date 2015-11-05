#!/bin/bash
echo 'for security reason skip administrators'
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
aas_calendar \ 
aas_settings \
address_format \
banners \
banners_history \
configuration \
configuration_group \
countries \
currencies \
geo_zones \
information \
languages \
sec_directory_whitelist \
seo_friendly_urls \
tax_class \
tax_rates \
zones \
zones_to_geo_zones \
| gzip  > ${DBNAME}_customers_catalog.sql.gz
