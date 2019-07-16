#!/bin/bash
rm -rf ../../oscconfig/
cp -r ../oscconfig.dist ../../oscconfig


DIRFSMASTERROOTDIR="/home/`whoami`/WWW"
read -e -i "$DIRFSMASTERROOTDIR" -p "Root Dir (NO final slash): " input
DIRFSMASTERROOTDIR="${input:-$DIRFSMASTERROOTDIR}"
echo -n "Admin Domain: "; read ADMINDOMAIN
echo -n "Catalog CS Domain: "; read CSDOMAIN
echo -n "Catalog EN Domain: "; read ENDOMAIN
REQUESTSCHEME="https"
read -e -i "$REQUESTSCHEME" -p "Request Scheme: " input
REQUESTSCHEME="${input:-$REQUESTSCHEME}"


sed -i  "s:XDIRFSMASTERROOTDIRX:${DIRFSMASTERROOTDIR}:" ../../oscconfig/configure.php
sed -i  "s:XDIRFSMASTERROOTDIRX:${DIRFSMASTERROOTDIR}:" ../../oscconfig/static.php
sed -i  "s:XDIRFSMASTERROOTDIRX:${DIRFSMASTERROOTDIR}:" ../../oscconfig/languages/cs/static_shop.php
sed -i  "s:XDIRFSMASTERROOTDIRX:${DIRFSMASTERROOTDIR}:" ../../oscconfig/languages/en/static_shop.php
sed -i  "s:XDIRFSMASTERROOTDIRX:${DIRFSMASTERROOTDIR}:" ../../oscconfig/admin/configure.php

sed -i  "s:XADMINDOMAINX:${ADMINDOMAIN}:" ../../oscconfig/languages/cs/static_shop.php
sed -i  "s:XADMINDOMAINX:${ADMINDOMAIN}:" ../../oscconfig/languages/en/static_shop.php
sed -i "s/XADMINDOMAINX/${ADMINDOMAIN}/" ../../oscconfig/admin/configure.php
#TODO: select default language provisorium
sed -i "s/XCSDOMAINX/${CSDOMAIN}/" ../../oscconfig/admin/configure.php

sed -i  "s:XCSDOMAINX:${CSDOMAIN}:" ../../oscconfig/languages/cs/static_shop.php
sed -i  "s:XENDOMAINX:${ENDOMAIN}:" ../../oscconfig/languages/en/static_shop.php

sed -i "s/XREQUESTSCHEMEX/${REQUESTSCHEME}/" ../../oscconfig/static.php

echo -n "Db server: "; read DBSERVER
sed -i "s/XDBSERVERX/${DBSERVER}/" ../../oscconfig/dbconfigure.php
echo -n "Database: "; read DBDATABASE
sed -i "s/XDBDATABASEX/${DBDATABASE}/" ../../oscconfig/dbconfigure.php
echo -n "DB Username: "; read DBSERVERUSERNAME
sed -i "s/XDBSERVERUSERNAMEX/${DBSERVERUSERNAME}/" ../../oscconfig/dbconfigure.php

echo -n "DB Password: "; read DBSERVERPASSWORD
sed -i "s/XDBSERVERPASSWORDX/${DBSERVERPASSWORD}/" ../../oscconfig/dbconfigure.php


echo "* * * * * cd ${DIRFSMASTERROOTDIR}admin/ && /usr/bin/nice -n 10 /usr/bin/ionice -c2 -n7 ./croncache.php css"|crontab
