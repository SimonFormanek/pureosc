FROM php:7-fpm-stretch

RUN apt update
RUN apt-get update && apt-get install -my wget gnupg

RUN wget -O - http://v.s.cz/info@vitexsoftware.cz.gpg.key | apt-key add -
RUN echo deb http://v.s.cz/ stable main | tee /etc/apt/sources.list.d/vitexsoftware.list

RUN apt-get update
RUN apt-get -y upgrade

#RUN apt-get update &&     apt-get install -y composer &&     apt-get clean
RUN apt-get -y install htop strace net-tools mc

COPY composer.json /var/www/html/
COPY vendor /var/www/html/vendor
COPY catalog /var/www/html/catalog
COPY admin   /var/www/html/admin
