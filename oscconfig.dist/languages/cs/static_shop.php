<?php
define('DEFAULT_LANGUAGE', 'cs');
define('DEFAULT_CURRENCY','CZK');
define('SERVER_INSTANCE','shop');
$_SERVER['HTTP_HOST'] = 'osc.local';
define('HTTP_HOST_GENERATED', 'cs.example.com'); //no thirth domain = use default language; en.domain.com, cs.domain.com
define('RSYNC_LOCAL_DEST_PATH','/home/osc/WWW/'); //trailing slash! '/' DEST can be source...
define('RSYNC_REMOTE_DEST_DIR','/home/osc/WWW/');
