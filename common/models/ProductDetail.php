<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%product_detail}}".
 *
 * @property integer $product_id
 * @property integer $gift_id
 * @property integer $amount
 * @property integer $sort
 * @property integer $created_at
 */
class ProductDetail extends \yii\db\ActiveRecord
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
        return '{{%product_detail}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'gift_id', 'amount', 'sort', 'created_at'], 'required'],
            [['product_id', 'gift_id', 'amount', 'sort', 'created_at'], 'integer']
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
            'product_id' => '产品ID',
            'gift_id' => '礼品ID',
            'amount' => '礼品数量（0为不限制数量，其它为每天数量）',
            'sort' => '排序',
            'created_at' => '建立时间',
        ];
    }
}
