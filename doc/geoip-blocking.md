edit /etc/apache2/mods-available/geoip.conf
uncomment: 
    GeoIPEnable On
    GeoIPDBFile /usr/share/GeoIP/GeoIP.dat

  a2enmod geoip
  service apache2 restart
  
  
## virtualhost config
  <Directory /home/user/WWW/osc/catalog/>
  
  SetEnvIf GEOIP_COUNTRY_CODE CN BlockCountry
  SetEnvIf GEOIP_COUNTRY_CODE RU BlockCountry
  SetEnvIf GEOIP_COUNTRY_CODE IN BlockCountry
  #SetEnvIf GEOIP_COUNTRY_CODE CZ BlockCountry
  Deny from env=BlockCountry
  </Directory>

## php check
<?php

$country_name = apache_note("GEOIP_COUNTRY_NAME");
print "Country: " . $country_name;
phpinfo();
