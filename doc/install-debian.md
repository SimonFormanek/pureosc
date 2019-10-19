# install devel debian

apt install libapache2-mpm-itk locales-all mysql-server php7.1-cli libapache2-mod-php7.1 php7.1 php7.1-intl php7.1-dom php7.1-mbstring php7.1-curl php7.1-mysql php7.1-gettext

apt install libapache2-mpm-itk locales-all mysql-server php5.6-cli libapache2-mod-php5.6 php5.6 php5.6-intl php5.6-dom php5.6-mbstring php5.6-curl php5.6-mysql php5.6-gettext

#php 7.3 
apt install libapache2-mpm-itk locales-all mariadb-server php7.3-cli libapache2-mod-php7.3 php7.3 php7.3-intl php7.3-intl php7.3-dom php7.3-mbstring php7.3-curl php7.3-mysql php7.3-gettext

#apache conf
  a2enmod headers
  a2enmod rewrite
  a2enmod deflate
