<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/23 0023
 * Time: 下午 5:21
 */

namespace tests\unit\fixtures;

use yii\test\ActiveFixture;

class sk_activity_recordFixture extends ActiveFixture
{
    public $db = 'db_sk';
    public $modelClass = 'common\models\ActivityRecord';
}