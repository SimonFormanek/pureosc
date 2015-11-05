#!/bin/bash
#todo add TABLE phpids
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
action_recorder \
| gzip  > ${DBNAME}_customers_catalog.sql.gz
