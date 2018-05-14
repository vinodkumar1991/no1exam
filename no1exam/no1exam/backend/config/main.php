<?php
$params = array_merge(require (__DIR__ . '/../../common/config/params.php'), require (__DIR__ . '/../../common/config/params-local.php'), require (__DIR__ . '/params.php'), require (__DIR__ . '/params-local.php'), require (__DIR__ . '/GlobalParams/Patterns.php'), require (__DIR__ . '/GlobalParams/Common.php'));

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'defaultRoute' => 'users/users/login',
    'bootstrap' => [
        'log'
    ],
    'modules' => [
        'users' => [
            'class' => 'app\modules\users\users_module'
        ],
        'locations' => [
            'class' => 'app\modules\locations\locations_module'
        ],
        'uploads' => [
            'class' => 'app\modules\uploads\uploads_module'
        ],
        'education' => [
            'class' => 'app\modules\education\education_module'
        ],
        'quiz' => [
            'class' => 'app\modules\quiz\quiz_module'
        ],
        'notification' => [
            'class' => 'app\modules\notification\notification_module'
        ]
    ],
    'language' => 'en',
    'components' => [
        'db' => require (__DIR__ . '/database.php'),
        'i18n' => [
            'translations' => [
                'roles' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-US',
                    'basePath' => '@app/messages'
                ],
                'devices' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-US',
                    'basePath' => '@app/messages'
                ]
            ]
        ],
        'request' => [
            'class' => 'common\components\Request',
            'web' => '/backend/web',
            'adminUrl' => '/admin',
            'csrfParam' => '_csrf-backend'
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_identity-backend',
                'httpOnly' => true
            ]
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend'
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => [
                        'error',
                        'warning'
                    ]
                ]
            ]
        ],
        'errorHandler' => [
            'errorAction' => 'site/error'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                'locations-list' => 'locations/locations/locations',
                'streams' => 'education/education/streams',
                'groups' => 'education/education/groups',
                'login' => 'users/users/login',
                'dashboard' => 'users/dashboard/dashboard',
                'logout' => 'users/users/logout',
                'boards' => 'education/education/boards',
                'roles' => 'users/users/roles',
                'permissions' => 'users/users/permissions',
                'users' => 'users/users/users',
                'subjects' => 'education/education/subjects',
                'create-subject' => 'education/education/create-subject',
                'role-permissions' => 'users/users/role-permissions',
                'forgot-password' => 'users/users/forgot-password',
                'locations' => 'locations/locations/locations',
                'competitive-type' => 'quiz/quiz/competitive-types',
                'competitive-methods' => 'quiz/quiz/competitive-methods',
                'competitive-type-methods' => 'quiz/quiz/competitive-type-methods',
                'create-question' => 'quiz/quiz/create-query',
                'create-quiz-settings' => 'quiz/quiz/create-quiz-settings',
                'questions' => 'quiz/quiz/queries',
                'sender-ids' => 'notification/notification/sender-ids',
                'templates' => 'notification/notification/templates',
                'create-template' => 'notification/notification/create-template'
            ]
        ]
    ],
    'params' => $params
];
