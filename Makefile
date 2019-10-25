all: 	 fresh dbreset upgrade

clean:
	vendor/bin/phinx seed:run -s Reset -c ./phinx-adapter.php

adminreset:
	vendor/bin/phinx seed:run -s ResetAdmin -c ./phinx-adapter.php
dbreset:
	vendor/bin/phinx seed:run -s Oscommerce -c ./phinx-adapter.php
	vendor/bin/phinx migrate -c ./phinx-adapter.php

demodata: dbreset
	cd bin ; ./import_catalog.sh
	
newphinx:
	read -p "Enter CamelCase migration name : " migname ; vendor/bin/phinx create $$migname -c ./phinx-adapter.php

fresh:
	composer update
	vendor/bin/phinx migrate -c ./phinx-adapter.php

production:
	composer update -a -o --no-dev

autoload:
	composer dumpautoload -a -o --no-dev

upgrade:
#	composer update
##ckeditor#####################
		rm -rf catalog/admin/ext/ckeditor
		mkdir catalog/admin/ext/ckeditor
		cp -r vendor/ckeditor/ckeditor/adapters catalog/admin/ext/ckeditor
		cp -r vendor/ckeditor/ckeditor/lang catalog/admin/ext/ckeditor
		cp -r vendor/ckeditor/ckeditor/plugins catalog/admin/ext/ckeditor
		cp -r vendor/ckeditor/ckeditor/skins catalog/admin/ext/ckeditor
		cp -r vendor/ckeditor/ckeditor/ckeditor.js catalog/admin/ext/ckeditor
		cp -r vendor/ckeditor/ckeditor/config.js catalog/admin/ext/ckeditor
		cp -r vendor/ckeditor/ckeditor/contents.css catalog/admin/ext/ckeditor
		cp -r vendor/ckeditor/ckeditor/styles.js catalog/admin/ext/ckeditor
		cp catalog/admin/ext/ckeditor.config/config.js catalog/admin/ext/ckeditor/config.js
#		cp -r vendor/ckeditor/ckeditor/assets catalog/admin/ext/ckeditor

lang:
	find . -iname "*.php" | xargs xgettext --from-code=utf-8  -n  --language=PHP --add-comments=TRANSLATORS --add-comments=translators: --force-po -o i18n/pureosc.pot
	find . -iname "*.php" | xargs xgettext --from-code=utf-8  -n  --language=PHP --add-comments=TRANSLATORS --add-comments=translators: --force-po -j -o i18n/cs_CZ/LC_MESSAGES/pureosc.po
	find . -iname "*.php" | xargs xgettext --from-code=utf-8  -n  --language=PHP --add-comments=TRANSLATORS --add-comments=translators: --force-po -j -o i18n/sk_SK/LC_MESSAGES/pureosc.po
	find . -iname "*.php" | xargs xgettext --from-code=utf-8  -n  --language=PHP --add-comments=TRANSLATORS --add-comments=translators: --force-po -j -o i18n/en_US/LC_MESSAGES/pureosc.po
	find . -iname "*.php" | xargs xgettext --from-code=utf-8  -n  --language=PHP --add-comments=TRANSLATORS --add-comments=translators: --force-po -j -o i18n/pl_PL/LC_MESSAGES/pureosc.po
	msgfmt -o i18n/cs_CZ/LC_MESSAGES/pureosc.mo i18n/cs_CZ/LC_MESSAGES/pureosc.po
	msgfmt -o i18n/en_US/LC_MESSAGES/pureosc.mo i18n/en_US/LC_MESSAGES/pureosc.po
	msgfmt -o i18n/sk_SK/LC_MESSAGES/pureosc.mo i18n/sk_SK/LC_MESSAGES/pureosc.po
	msgfmt -o i18n/pl_PL/LC_MESSAGES/pureosc.mo i18n/pl_PL/LC_MESSAGES/pureosc.po

doc:
	apigen generate --source catalog --destination docs --title "PureOSC" --charset UTF-8 --access-levels public --access-levels protected --php --tree

phpunit:
	./vendor/bin/phpunit --colors --log-junit /tmp/nb-phpunit-log.xml --bootstrap tests/bootstrap.php --configuration /home/vitex/Projects/PureHTML/pureosc/tests/configuration.xml --coverage-clover /tmp/nb-phpunit-coverage.xml /usr/share/netbeans/php/phpunit/NetBeansSuite.php -- tests

test:
	codecept run

css:
	yui-compressor catalog/ext/bootstrap/css/bootstrap.css > catalog/ext/bootstrap/css/bootstrap.min.css 

drun:
	docker volume create pureosc_config
	docker run -d -p 9999:9000 -v /var/run/docker.sock:/var/run/docker.sock -v pureosc_config:/var/www/oscconfig purehtml/admintst

dimage:
	docker build -t purehtml/admintst -t purehtml/admintst:`git rev-parse --short HEAD` .

	
	
