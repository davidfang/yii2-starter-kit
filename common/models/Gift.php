<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%gift}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property integer $description
 * @property string $price
 * @property integer $created_at
 * @property integer $updated_at
 */
class Gift extends \yii\db\ActiveRecord
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
        return '{{%gift}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'image', 'description', 'price', 'created_at', 'updated_at'], 'required'],
            [['description', 'created_at', 'updated_at'], 'integer'],
            [['price'], 'number'],
            [['name', 'image'], 'string', 'max' => 255]
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
            'name' => '礼品名称',
            'image' => '礼品图片（采用礼品表中适当大小的图片）',
            'description' => '礼品描述',
            'price' => '价值',
            'created_at' => '建立时间',
            'updated_at' => '更新时间',
        ];
    }
}
