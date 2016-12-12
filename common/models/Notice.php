<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
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
class Notice extends \yii\db\ActiveRecord
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
        return '{{%notice}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from_user_id', 'from_user_avatar', 'type', 'to_user_id', 'content', 'created_at', 'updated_at'], 'required'],
            [['from_user_id', 'to_user_id', 'created_at', 'updated_at'], 'integer'],
            [['from_user_avatar', 'type', 'content', 'url'], 'string', 'max' => 255]
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
            'from_user_id' => '发送用户ID',
            'from_user_avatar' => '发送用户的头像',
            'type' => '消息类别（自定义类别）',
            'to_user_id' => '接收用户ID',
            'content' => '通知内容',
            'url' => '链接地址',
            'created_at' => '建立时间',
            'updated_at' => '更新时间',
        ];
    }
}
