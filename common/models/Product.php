<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%product}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property integer $price
 * @property string $description
 * @property integer $time_lang
 * @property integer $on_line
 * @property integer $sort
 * @property integer $created_at
 * @property integer $updated_at
 */
class Product extends \yii\db\ActiveRecord
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
        return '{{%product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'price', 'description', 'time_lang', 'on_line', 'sort', 'created_at', 'updated_at'], 'required'],
            [['price', 'time_lang', 'on_line', 'sort', 'created_at', 'updated_at'], 'integer'],
            [['name', 'image', 'description'], 'string', 'max' => 255]
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
            'name' => '产品名称',
            'image' => '产品图片',
            'price' => '产品价格',
            'description' => '产品描述',
            'time_lang' => '时间周期长度（月、季度、年转换成秒）',
            'on_line' => '是否上线（0下线，1上线）',
            'sort' => '排序',
            'created_at' => '建立时间',
            'updated_at' => '更新时间',
        ];
    }
}
