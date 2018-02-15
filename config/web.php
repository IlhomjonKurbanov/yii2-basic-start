<?php

use yii\helpers\ArrayHelper;

$params = ArrayHelper::merge(
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

/**
 * This CSS Themes Bootstrap
 * ------------
 * cerulean
 * cosmo
 * cyborg
 * darkly
 * default
 * flatly
 * journal
 * lumen
 * paper
 * readable
 * sandstone
 * simplex
 * slate
 * spacelab
 * superhero
 * united
 * yeti
 * ------------
 * @package /app/assets/bootstrap
 * @var string
 */
$css_theme = 'default';

$config = [
    'id' => 'app',
    'name' => 'Yii2-basic-start',
    'language' => 'ru',
    'components' => [
        'request' => [
            'baseUrl' => '',
        ],
        'user' => [
            'identityClass' => 'modules\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['user/default/login'],
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => '@app/assets/bootstrap',
                    'css' => [
                        YII_ENV_DEV ? $css_theme . '/bootstrap.css' : $css_theme . '/bootstrap.min.css',
                    ]
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
        ],
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
