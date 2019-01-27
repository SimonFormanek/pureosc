all: 	clean fresh

clean:
	phinx seed:run -s Reset -c ./phinx-adapter.php

adminreset:
	phinx seed:run -s ResetAdmin -c ./phinx-adapter.php
dbreset:
	phinx seed:run -s Oscommerce -c ./phinx-adapter.php
	phinx migrate -c ./phinx-adapter.php

fresh:
	composer update
	phinx migrate -c ./phinx-adapter.php

upgrade:
#	composer update
##ckeditor#####################
		rm -rf admin/ext/ckeditor
		mkdir admin/ext/ckeditor
		cp -r vendor/ckeditor/ckeditor/adapters admin/ext/ckeditor
		cp -r vendor/ckeditor/ckeditor/assets admin/ext/ckeditor
		cp -r vendor/ckeditor/ckeditor/lang admin/ext/ckeditor
		cp -r vendor/ckeditor/ckeditor/plugins admin/ext/ckeditor
		cp -r vendor/ckeditor/ckeditor/skins admin/ext/ckeditor
		cp -r vendor/ckeditor/ckeditor/ckeditor.js admin/ext/ckeditor
		cp -r vendor/ckeditor/ckeditor/config.js admin/ext/ckeditor
		cp -r vendor/ckeditor/ckeditor/contents.css admin/ext/ckeditor
		cp -r vendor/ckeditor/ckeditor/styles.js admin/ext/ckeditor
		cp admin/ext/ckeditor.config/config.js admin/ext/ckeditor/config.js

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

test:
	codecept run

css:
	yui-compressor catalog/ext/bootstrap/css/bootstrap.css > catalog/ext/bootstrap/css/bootstrap.min.css 

drun:
	docker volume create pureosc_config
	docker run -d -p 9999:9000 -v /var/run/docker.sock:/var/run/docker.sock -v pureosc_config:/var/www/oscconfig purehtml/pureosc

dimage:
	composer --no-dev --optimize-autoloader update
	docker build -t purehtml/pureosc -t purehtml/pureosc:`git rev-parse --short HEAD` .
	
	