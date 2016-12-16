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


}