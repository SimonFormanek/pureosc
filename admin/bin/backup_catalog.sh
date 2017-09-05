#!/bin/bash
#config
DUMPSET='-uroot'
DBNAME='osc_articles_new'
mysqldump --opt ${DUMPSET} ${DBNAME} \
products \
products_description \
categories \
products_to_categories \
categories_description \
products_attributes \
products_options \
products_options_values  \
products_options_values_to_products_options \
 > ${DBNAME}.sql