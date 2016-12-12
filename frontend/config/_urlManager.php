<?php
return [
    'class'=>'yii\web\UrlManager',
    'enablePrettyUrl'=>true,
    'showScriptName'=>false,
    'rules'=> [
        // Pages
        ['pattern'=>'page/<slug>', 'route'=>'page/view'],

        // Articles
        ['pattern'=>'article/index', 'route'=>'article/index'],
        ['pattern'=>'article/attachment-download', 'route'=>'article/attachment-download'],
        ['pattern'=>'article/<slug>', 'route'=>'article/view'],

        // Api
        ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/article', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/user', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/activity', 'only' => ['index', 'view','create', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/online', 'only' => ['index', 'view','create', 'options']],

        //wechat
        ['pattern'=>'wechat/<id:\d+>', 'route'=>'wechat'],//公众后台对接请求URL：/wechat/{wechatId}
        ['pattern'=>'wechat/<id:\d+>/<scope:(snsapi_base|snsapi_userinfo)>/<action:\w+>', 'route'=>'wechat/auth/<action>'],//网页授权路由

    ]
];
