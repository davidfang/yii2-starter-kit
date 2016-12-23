<?php
namespace frontend\controllers;

use common\models\User;
use frontend\models\BasicUser;
use frontend\modules\user\models\SignupForm;
use Yii;
use frontend\models\ContactForm;
use yii\base\ErrorException;
use yii\web\Controller;
use zc\wechat\models\Wechat;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null
            ],
            'set-locale'=>[
                'class'=>'common\actions\SetLocaleAction',
                'locales'=>array_keys(Yii::$app->params['availableLocales'])
            ]
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->contact(Yii::$app->params['adminEmail'])) {
                Yii::$app->getSession()->setFlash('alert', [
                    'body'=>Yii::t('frontend', 'Thank you for contacting us. We will respond to you as soon as possible.'),
                    'options'=>['class'=>'alert-success']
                ]);
                return $this->refresh();
            } else {
                Yii::$app->getSession()->setFlash('alert', [
                    'body'=>\Yii::t('frontend', 'There was an error sending email.'),
                    'options'=>['class'=>'alert-danger']
                ]);
            }
        }

        return $this->render('contact', [
            'model' => $model
        ]);
    }

    public function actionWechat($id,$scope){
        $session = Yii::$app->session;
        $wechatInfo = Yii::$app->request->get('wechatInfo');
        $user = $session->get('wechatUser_'.$scope);
        // 未登录
        //if(! $session->has('wechatUser')){//session方式验证
        if($wechatInfo == null){//get方式验证
            $callback = \Yii::$app->request->get('callback',$_SERVER['REQUEST_URI']);//回跳地址
            Yii::$app->session->set('target_url',"/site/wechat?id={$id}&scope={$scope}");
            $app = Wechat::getOauthApplication($id,$scope,"/wechat/{$id}/{$scope}/callback?callback=".urlencode($callback));
            $oauth = $app->oauth;
            $oauth->redirect()->send();
            return;
        }
        // 已经登录过
        $getParams = $user['original'];
        $openid = $user['original']['openid'];

        $basic_user = BasicUser::findOne(['fromusername'=>$openid]);
        //var_dump($basic_user);exit;
        if(empty($basic_user)){//没有注册，进行注册操作
            echo '没有注册，进行注册操作<br>';
            $basic_user = new BasicUser();
            //$userModel = new User();
            $signupForm = new SignupForm();


            $signupForm->username = $getParams['openid'];
            $signupForm->email = $getParams['openid'].'@zc.com';
            $signupForm->password = $getParams['openid'];


            $signupUser = $signupForm->signup();

            $basic_user->fromusername = $getParams['openid'];

            if($scope == 'snsapi_userinfo') {
                $basic_user->username = $getParams['openid'];
                $basic_user->nickname = $getParams['nickname'];
                $basic_user->sex = $getParams['sex'];
                $basic_user->city = $getParams['city'];
                $basic_user->country = $getParams['country'];
                $basic_user->province = $getParams['province'];
                $basic_user->headimgurl = $getParams['headimgurl'];
            }

            if($signupUser){
                $basic_user->user_id = $signupUser->id;
                $basic_user->last_ip = \Yii::$app->request->getUserIP();
                $basic_user->created_at =time();
                $basic_user->updated_at =time();
                $basic_user->last_time =time();

                $save_status = $basic_user->save();
            }
            //echo '<pre>';
            //var_dump(['$signupUser'=>$signupUser,'$save_status'=>$save_status,'$basic_user'=>$basic_user]);
            //echo '</pre>';
            //$session['openid'] = $openid;
        }else{
            echo '已经注册，进行登录<br>';
            echo '<pre>';
            //var_dump(['$basic_user'=>$basic_user]);
            $signupUser = User::findOne($basic_user->user_id);
            if($scope == 'snsapi_userinfo') {
                $basic_user->username = $getParams['openid'];
                $basic_user->nickname = $getParams['nickname'];
                $basic_user->sex = $getParams['sex'];
                $basic_user->city = $getParams['city'];
                $basic_user->country = $getParams['country'];
                $basic_user->province = $getParams['province'];
                $basic_user->headimgurl = $getParams['headimgurl'];
            }

            $basic_user->last_ip = \Yii::$app->request->getUserIP();
            $basic_user->last_time =time();
            $basic_user->updated_at =time();
            $basic_user->save();
            //$session['openid'] = $openid;
        }

        var_dump($signupUser->access_token);
        echo  <<<doc
<script type="application/javascript">
        var accessToken = localStorage.setItem('access_token','{$signupUser->access_token}');
        var openId = localStorage.setItem('openId','$wechatInfo');
        //document.getElementById("openId").innerHTML = openId;
        location.href = "/index.html";//JS跳转到静态页面的地址
    </script>
doc;
        //echo 'actionTest var_dump<br>';
        //echo '<pre>$user:';
        //var_dump($user);
        //echo '--------------------<br>$basic_user:';
        //var_dump($basic_user);
    }
}
