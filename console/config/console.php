<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
Yii::setPathOfAlias('common', dirname(__FILE__) . '/../../common');
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// application components
	'components'=>array(

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
        'cache'=>array(
            'class' => 'common.framework.caching.CMemCache',
            'useMemcached' => extension_loaded('memcached'),
            'servers' => [
                [
                    'host'   => 'app_memcached',
                    'port'   => 11211,
                    'weight' => 60,
                ],
            ],
            'hashKey' => true,
        ),

	),
    'params'=>array(
        'channelServerPort' => 83,
        'websockerPort' => 82,
        'websockerCount' => 4,
        'websockerProtocol' => 'websocket'
    ),
);
