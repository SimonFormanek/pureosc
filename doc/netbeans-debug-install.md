# netbeans debug install

Instalovat https://www.vitexsoftware.cz/package.php?package=netbeans-php-tools
asociovat v browseru s /usr/bin/nbxdebug:
	#!/bin/bash
	url=$1
	file=${url#*//}
	file=${file%?line=*}
	line=${url#*line=}
	netbeans --open $file:$line
