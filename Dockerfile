FROM jgoerzen/debian-base-minimal:latest

RUN apt update
RUN apt-get update && apt-get install -my wget gnupg

RUN wget -O - http://v.s.cz/info@vitexsoftware.cz.gpg.key | apt-key add -
RUN echo deb http://v.s.cz/ stable main | tee /etc/apt/sources.list.d/vitexsoftware.list

RUN apt-get -y install apt-transport-https lsb-release ca-certificates curl
RUN curl -ssL -o /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN sh -c 'echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list'
RUN apt-get update
RUN apt-get -y upgrade
RUN apt-get -y install bash php7.1-fpm php7.1-mysqli php7.1-mbstring php7.1-curl php7.1-intl php7.1-gd php7.1-xml locales-all ssmtp

#EXPOSE 9000
RUN sed -i '/listen =/c\listen = 9000' /etc/php/7.1/fpm/pool.d/www.conf

#RUN apt-get update &&     apt-get install -y composer &&     apt-get clean
RUN apt-get -y install htop strace net-tools mc 

COPY composer.json /var/www/html/
COPY vendor /var/www/html/vendor
COPY catalog /var/www/html/catalog
COPY admin   /var/www/html/admin
COPY i18n   /var/www/html/i18n
COPY images  /var/www/html/images
RUN chown www-data /var/www/html/images -R
COPY .docker/oscconfig/ /var/www/oscconfig

#CMD /etc/init.d/php7.0-fpm restart
#CMD ["/bin/bash"]


RUN echo "#!/bin/bash\n/etc/init.d/php7.1-fpm start && bash" >> /run.sh
RUN chmod a+x /run.sh


ENTRYPOINT ["/run.sh"]
