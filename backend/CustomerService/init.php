<?php

$autoloadvendor = require 'vendor/autoload.php';
$autoloadvendor->register();
require_once 'lib/control/AutoLoader.php';
spl_autoload_register(array('lib\control\AutoLoader', 'autoload'));
$ini = parse_ini_file('app/config/config.ini', true);
date_default_timezone_set($ini['config']['timezone']);