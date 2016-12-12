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
use frontend\models\Activity;

class ActivityController extends ActiveController
{
    public $modelClass = 'frontend\models\Activity';
    /**
     * @var array
     */
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items'
    ];

}