mysql $1 -e "SELECT * INTO OUTFILE '/tmp/configuration_group_orig.sql'  FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\''  LINES TERMINATED BY ');\n' FROM configuration_group order by configuration_group_id;"

sed 's/^/INSERT INTO configuration_group VALUES (/g' < /tmp/configuration_group_orig.sql > /tmp/configuration_group_new.sql
sed 's/\\N/NULL/g' -i /tmp/configuration_group_new.sql
