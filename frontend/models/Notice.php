<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%notice}}".
 *
 * @property integer $id
 * @property integer $from_user_id
 * @property string $from_user_avatar
 * @property string $type
 * @property integer $to_user_id
 * @property string $content
 * @property string $url
 * @property integer $created_at
 * @property integer $updated_at
 */
class Notice extends \common\models\Notice
{

}
