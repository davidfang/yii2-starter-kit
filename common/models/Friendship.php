<?php

namespace common\models;

use app\models\SnsUser;
use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%friendship}}".
 *
 * @property integer $id
 * @property integer $self_user_id
 * @property integer $friend_user_id
 * @property integer $view
 * @property integer $allow
 * @property integer $created_at
 * @property integer $updated_at
 */
class Friendship extends \yii\db\ActiveRecord
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
        return '{{%friendship}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['self_user_id', 'friend_user_id'], 'required'],
            [['self_user_id', 'friend_user_id', 'view', 'allow', 'created_at', 'updated_at'], 'integer']
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
     * 自己的用户信息
     * @return \yii\db\ActiveQuery
     */
    public function getSelfUserInfo()
    {
        return $this->hasOne(BasicUser::className(), ['id' => 'self_user_id']);
    }


    /**
     * 朋友的用户信息
     * @return \yii\db\ActiveQuery
     */
    public function getFriendUserInfo()
    {
        return $this->hasOne(BasicUser::className(), ['id' => 'friend_user_id']);
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'self_user_id' => '自己的用户ID',
            'friend_user_id' => '朋友的用户ID',
            'view' => '朋友是否查看(0表示没看）',
            'allow' => '朋友是否允许加好友（默认允许1），此项目暂时不用此功能，后续可以做为收费点开发',
            'created_at' => '建立时间',
            'updated_at' => '更新时间（这里主要是用户查看，或者同意）',
        ];
    }
}
