<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%order_detail}}".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $user_id
 * @property integer $gift_id
 * @property integer $amount
 * @property integer $start_time
 * @property integer $end_time
 * @property integer $created_at
 * @property integer $updated_at
 */
class OrderDetail extends \yii\db\ActiveRecord
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
        return '{{%order_detail}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'user_id', 'gift_id', 'amount', 'start_time', 'end_time', 'created_at', 'updated_at'], 'required'],
            [['order_id', 'user_id', 'gift_id', 'amount', 'start_time', 'end_time', 'created_at', 'updated_at'], 'integer']
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
            'order_id' => '订单ID',
            'user_id' => '用户ID',
            'gift_id' => '礼品ID',
            'amount' => '礼品数量（0代表不限数量，其它代表每天个数）',
            'start_time' => '开始时间',
            'end_time' => '结束时间',
            'created_at' => '建立时间',
            'updated_at' => '更新时间',
        ];
    }
}
