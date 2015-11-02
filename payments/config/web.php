<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name'=>'FON automatic Payments',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Fr0nt!3r0pt!c@ln3tw0rks',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'mail.google.com',
                'username' => 'kelvinchege@gmail.com',
                'password' => 'kelvinjohn@50',
                'port' => '587',
            ],

            'useFileTransport' => failse,
        ],
        'urlManager' => [                                                
                    'enablePrettyUrl' => true,
                    'showScriptName' => false,
                    'enableStrictParsing' => false,
                    'suffix' => '.fon',
                    'rules' => [
                        // ...
                          '<controller:\w+>/<id:\d+>' => '<controller>/view',
                          '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                          '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                    ],                                 
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
