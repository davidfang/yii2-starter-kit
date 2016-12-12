<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%qiniu_img}}".
 *
 * @property integer $id
 * @property string $img
 * @property integer $img_size
 * @property string $img_1
 * @property string $img_2
 * @property string $img_3
 * @property integer $user_id
 * @property string $type
 * @property integer $type_id
 * @property integer $check
 * @property integer $created_at
 * @property integer $updated_at
 */
class QiniuImg extends \yii\db\ActiveRecord
{
    const TYPE_USER = "basic_user";
    const TYPE_ACTIVITY = "activity";
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
        return '{{%qiniu_img}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['img', 'user_id'], 'required'],
            [['img_size', 'user_id', 'type_id', 'check', 'created_at', 'updated_at'], 'integer'],
            [['type'], 'string'],
            [['img'], 'string', 'max' => 1000]
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
            'img' => '原始图像',
            'img_size' => '原始图片大小（设计不超过20M即：20兆字节(mb)=20971520字节(b)）',
            'user_id' => '用户ID',
            'type' => '类别（用途）',
            'type_id' => '对应用途表中的ID，可以根据ID查相应的应用',
            'check' => '审核',
            'created_at' => '建立时间',
            'updated_at' => '更新时间',
        ];
    }
}
