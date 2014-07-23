<?php


define('DS', DIRECTORY_SEPARATOR);
defined('YII_ENABLE_EXCEPTION_HANDLER') or define('YII_ENABLE_EXCEPTION_HANDLER', false);
defined('YII_ENABLE_ERROR_HANDLER') or define('YII_ENABLE_ERROR_HANDLER', false);
defined('YII_DEBUG') or define('YII_DEBUG', true);

$_SERVER['SCRIPT_NAME']     = '/' . basename(__FILE__);
$_SERVER['SCRIPT_FILENAME'] = __FILE__;


define('ROOT', realpath(dirname(__FILE__).DS.'..'));

require ROOT.'/vendor/yiisoft/yii/framework/yii.php';
require ROOT.'/vendor/phpunit/phpunit/PHPUnit/Framework/TestCase.php';
require ROOT.'/Batch.php';

require 'TestApplication.php';
Yii::import('system.test.*');


$config = require 'config.php';
$local  = require 'config-local.php';

$config = CMap::mergeArray($config, $local);

new TestApplication($config);