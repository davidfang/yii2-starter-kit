<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
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
class Message extends \yii\db\ActiveRecord
{
    /**
     * Returns the database connection used by this AR class.
     * By default, the "db" application component is used as the database connection.
     * You may override this method if you want to use a different database connection.
     * @return Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_sk');
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%message}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id', 'from_user_id', 'to_user_id', 'content'], 'required'],
            [['activity_id', 'from_user_id', 'to_user_id', 'read', 'updated_at', 'created_at'], 'integer'],
            [['content'], 'string', 'max' => 255]
        ];
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity_id' => '活动ID',
            'from_user_id' => '消息发送方ID',
            'to_user_id' => '消息接受方ID',
            'content' => '对话内容',
            'read' => '对方是否已经阅读（0未读，1已读）',
            'updated_at' => '更新时间',
            'created_at' => '建立时间',
        ];
    }
}
