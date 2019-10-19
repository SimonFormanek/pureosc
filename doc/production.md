# sercurity and performance notes

While switching to production environement ensure to coorect settings.

## disable debugging

  # MYSQL_DEBUG = off  
  sed -i "s/'MYSQL_DEBUG', 'on'/'MYSQL_DEBUG', 'off'/" configure.php

  