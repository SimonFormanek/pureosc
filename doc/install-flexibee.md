# install flexibee
Install [modified Flexbee](https://github.com/VitexSoftware/flexibee-server-deb) without grapical librairies.

This installer is part of Makefile, run:
	cd /projectRootDir
	make flexibee

	wget -O - http://v.s.cz/info@vitexsoftware.cz.gpg.key | sudo apt-key add -
	echo deb http://v.s.cz/ stable main | sudo tee /etc/apt/sources.list.d/vitexsoftware.list
	sudo apt update
	apt install flexibee
