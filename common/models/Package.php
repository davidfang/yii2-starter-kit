<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%package}}".
 *
 * @property integer $id
 * @property integer $from_user_id
 * @property integer $to_user_id
 * @property integer $gift_id
 * @property integer $created_at
 */
class Package extends \yii\db\ActiveRecord
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
        return '{{%package}}';
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
            [['from_user_id', 'to_user_id', 'gift_id', 'created_at'], 'required'],
            [['from_user_id', 'to_user_id', 'gift_id', 'created_at'], 'integer']
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGift()
    {
        return $this->hasOne(Gift::className(), ['id' => 'gift_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFromUser()
    {
        return $this->hasOne(BasicUser::className(), ['id' => 'from_user_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToUser()
    {
        return $this->hasOne(BasicUser::className(), ['id' => 'to_user_id']);
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from_user_id' => '送礼人ID',
            'to_user_id' => '收礼人ID',
            'gift_id' => '礼物ID',
            'created_at' => '建立时间',
        ];
    }
}
