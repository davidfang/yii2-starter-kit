<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/12 0012
 * Time: 下午 12:33
 */

namespace frontend\modules\api\v1\controllers;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use frontend\modules\api\v1\resources\BasicUser;

class OnlineController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\v1\resources\BasicUser';
    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                [
                    'class' => HttpBasicAuth::className(),
                    'auth' => function ($username, $password) {
                        $user = User::findByLogin($username);
                        return $user->validatePassword($password)
                            ? $user
                            : null;
                    }
                ],
                HttpBearerAuth::className(),
                QueryParamAuth::className()
            ]
        ];

        return $behaviors;
    }

}