<?php

define('DS', DIRECTORY_SEPARATOR);
define('DS_UP', DS . '..');
define('PUBLIC_PATH', __DIR__);
define('DIR_ROOT', PUBLIC_PATH . DS_UP . DS_UP . DS_UP . DS);
define('DIR_COMMON', DIR_ROOT . 'common' . DS);
define('DIR_FRAMEWORK', DIR_COMMON . 'framework' . DS);
define('AUTOLOAD_PATH', DIR_COMMON . 'vendor' . DS . 'autoload.php');
define('YII_FILE', DIR_FRAMEWORK . 'yii.php');
define('RELATIVE_CONFIG', __DIR__ . DS_UP . DS . 'config' . DS . 'main.php');
defined('YII_DEBUG') or define('YII_DEBUG',true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

// front https://docs.angularjs.org/tutorial/step_12
// api https://www.yiiframework.com/wiki/175/how-to-create-a-rest-api

require_once(AUTOLOAD_PATH);
require_once(YII_FILE);
Yii::createWebApplication(RELATIVE_CONFIG)->run();
