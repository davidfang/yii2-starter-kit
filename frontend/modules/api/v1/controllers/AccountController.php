<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/12 0012
 * Time: 下午 12:33
 */

namespace frontend\modules\api\v1\controllers;

use common\models\User;
use common\models\UserToken;
use frontend\modules\api\v1\resources\BasicUser;
use frontend\modules\user\models\LoginForm;
use frontend\modules\user\models\PasswordResetRequestForm;
use frontend\modules\user\models\ResetPasswordForm;
use frontend\modules\user\models\SignupForm;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class AccountController extends Controller
{
    public $enableCsrfValidation = false;

    public function init()
    {

        parent::init();
        Yii::$app->response->format = Response::FORMAT_JSON;
    }
    //public $modelClass = 'frontend\modules\api\v1\resources\BasicUser';
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'signup', 'login', 'request-password-reset', 'reset-password', 'login-token'
                        ],
                        'allow' => true,
                        'roles' => ['?']
                    ],
                    [
                        'actions' => [
                            'signup', 'login', 'request-password-reset', 'reset-password', 'login-token'
                        ],
                        'allow' => false,
                        'roles' => ['@'],
                        'denyCallback' => function () {
                            return Yii::$app->controller->redirect(['/user/default/index']);
                        }
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post']
                ]
            ]
        ];
    }

    /**
     * @return array|string|Response
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        //return ['status' => true, 'msg' => '登录成功！','data'=>Yii::$app->request->post(),'post'=>$_POST];
        if ($model->load(Yii::$app->request->post(), '') && $model->login()) {
            $user = Yii::$app->user->identity;
            $basicUser= BasicUser::findOne($user->id);
            return [
                'status' => true,
                'msg' => '登录成功！',
                'data' => [
                    'id' => $user->id,
                    'username' => $user->username,
                    'access-token' => $user->access_token,
                    'avatar' => qiniuDownloadUrl($basicUser->headimgurl ,50 )
                ]
            ];
        } else {
            return ['status' => false, 'msg' => '登录失败!', 'errs' => $model->errors];
        }
    }

    /**
     * @return string|Response
     */
    public function actionSignup()
    {
        $return = ['status' => false, 'msg' => ''];
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post(), '') && $user = $model->signup()) {

            Yii::$app->getUser()->login($user);

            $return = [
                'status' => true,
                'msg' => '登录成功!',
                'data' => [
                    'id' => $user->id,
                    'username' => $user->username,
                    'access-token' => $user->access_token
                ]
            ];
            // return $return;
        } else {
            $return['msg'] = '注册失败';
            $return['errs'] = $model->errors;
        }
        return $return;
    }

    /**
     * @param $token
     * @return string|Response
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post(), '') && $model->validate() && $model->resetPassword()) {
            return [
                'status' => true,
                'msg' => '密码修改成功'
            ];
        } else {
            return [
                'status' => false,
                'msg' => '密码修改失败'
            ];
        }
    }

    /**
     * @return string|Response
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post(), '') && $model->validate()) {
            if ($model->sendEmail()) {
                return [
                    'status' => true,
                    'msg' => Yii::t('frontend', 'Check your email for further instructions.'),
                ];
            } else {
                return [
                    'status' => false,
                    'msg' => Yii::t('frontend', 'Sorry, we are unable to reset password for email provided.'),
                ];
            }
        } else {
            return [
                'status' => false,
                'msg' => '验证失败',
                'errors' => $model->errors
            ];
        }
    }

    public function actionLoginToken()
    {
        $token = Yii::$app->request->post('token');
        if ($token) {
            $user = User::findIdentityByAccessToken($token);
            if ($user) {
                return [
                    'status' => true,
                    'msg' => '登录成功!',
                    'data' => [
                        'id' => $user->id,
                        'username' => $user->username,
                        'access-token' => $user->access_token
                    ]
                ];
            } else {
                return [
                    'status' => false,
                    'msg' => '登录失败!请检查token！',
                ];
            }
        } else {
            return [
                'status' => false,
                'msg' => '缺少token！',
            ];
        }

    }
}