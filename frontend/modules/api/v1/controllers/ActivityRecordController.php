<?php
namespace frontend\modules\api\v1\controllers;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/23 0023
 * Time: 上午 11:22
 */


use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;

class ActivityRecordController extends  ActiveController
{
    public $modelClass = 'frontend\modules\api\v1\resources\ActivityRecord';
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



    public function actionProcess ($id,$allow){
        return ['msg'=>'hello','status'=>true,'id'=>$id,'allow'=>$allow];
    }

    /**
     * 我参与的约会
     * @return ActiveDataProvider
     */
    public function actionMyJoin()
    {
        $identity = \Yii::$app->user->identity;
        /* @var $modelClass \yii\db\BaseActiveRecord */
        $modelClass = $this->modelClass;

        $query = $modelClass::find()->where(['user_id'=>$identity->id]);

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }

    /**
     * 我的约会的参与者列表
     * @return ActiveDataProvider
     */
    public function actionPlayer($activityId)
    {
        $identity = \Yii::$app->user->identity;
        /* @var $modelClass \yii\db\BaseActiveRecord */
        $modelClass = $this->modelClass;

        $query = $modelClass::find()->where(['own_user_id'=>$identity->id,'activity_id'=>$activityId]);

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }

}