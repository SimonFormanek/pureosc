FROM jgoerzen/debian-base-minimal:latest
ENV DEBIAN_FRONTEND noninteractive
#admin
#TODO shop upravit php disabled


RUN apt-get update && apt-get install -my wget gnupg \
&& wget -O - http://v.s.cz/info@vitexsoftware.cz.gpg.key | apt-key add - \
&& echo deb http://v.s.cz/ stable main | tee /etc/apt/sources.list.d/vitexsoftware.list \
&& apt-get -y install apt-transport-https lsb-release ca-certificates curl \
&& curl -ssL -o /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg \
&& sh -c 'echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list' \
&& apt-get update \
&& apt-get -y install  php7.3-fpm php7.3-mysqli php7.3-mbstring php7.3-curl php7.3-intl php7.3-gd php7.3-xml locales-all ssmtp bash webp \
&& sed -i '/listen =/c\listen = 9000' /etc/php/7.3/fpm/pool.d/www.conf

#RUN apt-get update &&     apt-get install -y composer &&     apt-get clean
#RUN apt-get -y install htop strace net-tools mc 

COPY composer.json /var/www/html/
COPY vendor /var/www/html/vendor
COPY catalog /var/www/html/catalog
COPY i18n   /var/www/html/i18n

COPY .docker/oscconfig/ /var/www/oscconfig

#CMD /etc/init.d/php7.0-fpm restart
#CMD ["/bin/bash"]

RUN chown www-data /var/www/html/catalog/images -R \
&& echo "#!/bin/bash\n/etc/init.d/php7.3-fpm start && bash" >> /run.sh \
&& chmod a+x /run.sh


ENTRYPOINT ["/run.sh"]
