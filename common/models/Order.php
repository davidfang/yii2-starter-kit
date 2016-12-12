<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%order}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $product_id
 * @property integer $money
 * @property integer $start_time
 * @property integer $end_time
 * @property integer $created_at
 * @property integer $updated_at
 */
class Order extends \yii\db\ActiveRecord
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
        return '{{%order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id', 'money', 'start_time', 'end_time', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'product_id', 'money', 'start_time', 'end_time', 'created_at', 'updated_at'], 'integer']
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
            'user_id' => '用户ID',
            'product_id' => '产品ID',
            'money' => '订单实际支付金额',
            'start_time' => '开始时间（即下订单时间）',
            'end_time' => '结束时间（即开始时间+产品时长）',
            'created_at' => '建立时间',
            'updated_at' => '更新时间',
        ];
    }
}
