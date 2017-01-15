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
use frontend\modules\api\v1\resources\Friendship;

class FriendShipController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\v1\resources\Friendship';
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

    /**
     * 喜欢我的
     * @return ActiveDataProvider
     */
    public function actionLoveMe()
    {
        $identity = \Yii::$app->user->identity;
        /* @var $modelClass \yii\db\BaseActiveRecord */
        $modelClass = $this->modelClass;

        $query = $modelClass::find()->where(['friend_user_id'=>$identity->id]);

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }

    /**
     * 我喜欢的
     * @return ActiveDataProvider
     */
    public function actionMyLove(){
        $identity = \Yii::$app->user->identity;
        /* @var $modelClass \yii\db\BaseActiveRecord */
        $modelClass = $this->modelClass;

        $query = $modelClass::find()->where(['self_user_id'=>$identity->id]);

        return new ActiveDataProvider([
            'query' => $query,//$modelClass::find(),
        ]);
    }

}