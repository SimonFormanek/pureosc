clean:
	echo drop database pureosc | mysql -u root -psql pureosc
	echo create database pureosc | mysql -u root -psql

reset:
	cat install/oscommerce.sql | mysql -u root -psql pureosc
	echo drop table phinxlog | mysql -u root -psql pureosc
	phinx migrate

fresh:
	git pull
	composer update
	phinx migrate
