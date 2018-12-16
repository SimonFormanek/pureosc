all: 	clean fresh

clean:
	phinx seed:run -s Reset -c ./phinx-adapter.php

dbreset:
	phinx seed:run -s Oscommerce -c ./phinx-adapter.php
	phinx migrate -c ./phinx-adapter.php

fresh:
	composer update
	phinx migrate -c ./phinx-adapter.php


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
