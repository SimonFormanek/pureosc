#!/bin/bash
sudo sed -i 's/display_errors = On/display_errors = Off/' /etc/php/7.3/apache2/php.ini
sudo service apache2 restart
