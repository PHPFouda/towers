<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'en',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
	        'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
	    ],
	    'user' => [
	        //'class' => 'mdm\admin\models\User',
	        'identityClass' => 'mdm\admin\models\User',
	        'loginUrl' => ['admin/user/login'],
	    ],
	    'settings'=> [
			'class' => 'common\components\CSettings',
		],
    ],
    'modules' => [
	    /*'admin' => [
	        'class' => 'mdm\admin\Module',
	    ],*/
	    'admin' => [
			'class' => 'mdm\admin\Module',
			'layout' => 'left-menu', // it can be '@path/to/your/layout'.
			'controllerMap' => [
				'assignment' => [
					'class' => 'mdm\admin\controllers\AssignmentController',
					'userClassName' => 'common\models\User',
					'idField' => 'id'
				],
				//'mainLayout' => '@backend/views/layouts/main.php',
				//'other' => [
				//	'class' => 'path\to\OtherController', // add another controller
				//],
			],
			'menus' => [
				//'assignment' => [
					//'label' => 'Grand Access' // change label
				//],
				//'route' => null, // disable menu route
			],
		],
	],
];
