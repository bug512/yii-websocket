<?php
$adminDir = __DIR__ . DS_UP . DS;
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local', __DIR__ . DS . 'main-local.php');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
Yii::setPathOfAlias('common', DIR_COMMON);
Yii::setPathOfAlias('admindir', $adminDir);
return [
    'basePath' => __DIR__ . DIRECTORY_SEPARATOR . '..',
    'name' => 'Admin panel',

    // preloading 'log' component
    'preload' => array('log'),

    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'common.models.*',
        'admindir.components.*',
        'admindir.components.forms.*',
        'application.components.*',
    ),

    'defaultController' => 'site',

    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => [
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ),
        'db'=>[
            'connectionString' => 'pgsql:host=app_db;dbname=dbname',
            'emulatePrepare' => true,
            'username' => 'dbuser',
            'password' => 'dbpwd',
            'charset' => 'utf8',
            'tablePrefix' => 'tbl_',
        ],
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                // uncomment the following to show log messages on web pages
                /*
                array(
                    'class'=>'CWebLogRoute',
                ),
                */
            ),
        ),
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => require(dirname(__FILE__) . '/params.php'),
];