#!/bin/bash
#config
DUMPSET='-uroot'
DBNAME='osc_articles_new'
mysqldump --opt --no-data ${DUMPSET} ${DBNAME} > ${DBNAME}.sql
mysqldump --opt ${DUMPSET} ${DBNAME} \
aas_settings \
address_format \
configuration \
countries \
currencies \
geo_zones \
headertags \
headertags_default \
headertags_social \
information \
information_group \
languages \
mm_newsletters \
mm_responsemail \
mm_responsemail_backup \
mm_responsemail_reset \
mm_templates \
orders_status \
product_templates \
sec_directory_whitelist \
tax_class \
tax_rates \
zones \
zones_to_geo_zones \
 >> ${DBNAME}.sql