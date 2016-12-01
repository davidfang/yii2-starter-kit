<?php

namespace frontend\modules\api\wechat\controllers;

use yii\rest\Controller;
use EasyWeChat\Foundation\Application;
/**
 * Default controller for the `wechat` module
 */
class IndexController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {


        $options = [
            /**
             * 账号基本信息，请从微信公众平台/开放平台获取
             */
            'app_id'  => 'wxcbc3a42cab3556f2',         // AppID
            'secret'  => '4002c78a72154a63b9c9770c9a0457f4',     // AppSecret
            'token'   => 'sdfw2zhangx2sfxiang',          // Token
            'aes_key' => '',                    // EncodingAESKey，安全模式下请一定要填写！！！

            // ...
        ];
        $app = new Application($options);

        // 从项目实例中得到服务端应用实例。
        $server = $app->server;
        $server->setMessageHandler(function ($message) {
            // $message->FromUserName // 用户的 openid
            // $message->MsgType // 消息类型：event, text....
            return "您好！欢迎关注我!";
        });
        $response = $server->serve();
        return $response->send(); // Laravel 里请使用：return $response;


        return ['msg'=>'index'];
    }
}
