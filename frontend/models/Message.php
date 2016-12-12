<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%message}}".
 *
 * @property integer $id
 * @property integer $activity_id
 * @property integer $from_user_id
 * @property integer $to_user_id
 * @property string $content
 * @property integer $read
 * @property integer $updated_at
 * @property integer $created_at
 */
class Message extends \common\models\Message
{

}
