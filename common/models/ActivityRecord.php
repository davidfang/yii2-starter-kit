<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%activity_record}}".
 *
 * @property integer $id
 * @property integer $activity_id
 * @property integer $user_id
 * @property integer $alow
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $own_user_id
 */
class ActivityRecord extends \yii\db\ActiveRecord
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
        return '{{%activity_record}}';
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
    public function rules()
    {
        return [
            [['activity_id', 'user_id', 'own_user_id'], 'required'],
            [['activity_id', 'user_id', 'allow', 'created_at', 'updated_at', 'own_user_id'], 'integer']
        ];
    }
    /**
     * 参与用户信息
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(BasicUser::className(), ['id' => 'user_id']);
    }
    /**
     * 活动所有者用户信息
     * @return \yii\db\ActiveQuery
     */
    public function getOwnUser()
    {
        return $this->hasOne(BasicUser::className(), ['id' => 'own_user_id']);
    }
    /**
     * 活动信息
     * @return \yii\db\ActiveQuery
     */
    public function getActivity()
    {
        return $this->hasOne(Activity::className(), ['id' => 'activity_id']);
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity_id' => '邀约ID',
            'user_id' => '用户ID',
            'allow' => '是否允许参与（0拒绝，1允许，2考虑）',
            'created_at' => '建立时间',
            'updated_at' => '更新时间',
            'own_user_id' => '活动发布者用户ID',
        ];
    }
}
