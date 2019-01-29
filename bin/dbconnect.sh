#!/bin/sh
H=`cat ../../oscconfig/dbconfigure.php|egrep  "^define\('DB_SERVER'"|sed "s/define('DB_SERVER', '//"|sed "s/');//"`
D=`cat ../../oscconfig/dbconfigure.php|egrep  "^define\('DB_DATABASE'"|sed "s/define('DB_DATABASE', '//"|sed "s/');//"`
U=`cat ../../oscconfig/dbconfigure.php|egrep  "^define\('DB_SERVER_USERNAME'"|sed "s/define('DB_SERVER_USERNAME', '//"|sed "s/');//"`
P=`cat ../../oscconfig/dbconfigure.php|egrep  "^define\('DB_SERVER_PASSWORD'"|sed "s/define('DB_SERVER_PASSWORD', '//"|sed "s/');//"`
if [ $P ];then P="-p${P}";fi
