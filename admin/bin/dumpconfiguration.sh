#!/bin/bash
[ $2 ] && mysql $1 -e "SELECT * INTO OUTFILE '/tmp/configuration_orig.sql'  FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\''  LINES TERMINATED BY ');\n' FROM configuration WHERE configuration_group_id=$2 order by configuration_id;" || \
mysql $1 -e "SELECT * INTO OUTFILE '/tmp/configuration_orig.sql'  FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\''  LINES TERMINATED BY ');\n' FROM configuration  order by configuration_id;"
#delete configuration_id
sed 's/^[0-9]*,/INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values (/g' < /tmp/configuration_orig.sql > /tmp/configuration_new.sql
sed 's/\\N/NULL/g' -i /tmp/configuration_new.sql
sed "s/'....-..-.. ..:..:..'/NOW()/g" -i /tmp/configuration_new.sql
