<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/12 0012
 * Time: 下午 12:33
 */

namespace frontend\modules\api\v1\controllers;

use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use frontend\modules\api\v1\resources\BasicUser;

class OnlineController extends ActiveController
{
    public $modelClass = 'frontend\modules\api\v1\resources\BasicUser';


    public function actionIndex(){

    }
    /**
     * @return ActiveDataProvider
     */
    public function prepareDataProvider()
    {
        return new ActiveDataProvider(array(
            'query' => SnsUser::find()
        ));
    }

    /**
     * @param $id
     * @return array|null|\yii\db\ActiveRecord
     * @throws HttpException
     */
    public function findModel($id)
    {
        $model = SnsUser::find()
            ->andWhere(['id' => (int) $id])
            ->one();
        if (!$model) {
            throw new HttpException(404);
        }
        return $model;
    }
}