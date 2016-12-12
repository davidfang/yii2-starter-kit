<?php

namespace frontend\models;

use Yii;
use common\models\User;
/**
 * This is the model class for table "{{%basic_user}}".
 *
 * @property integer $id
 * @property string $nickname
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $sex
 * @property integer $age
 * @property integer $height
 * @property integer $weight
 * @property string $profession
 * @property string $emotion
 * @property string $idcard_number
 * @property string $city
 * @property string $country
 * @property string $province
 * @property string $headimgurl
 * @property string $love_attitude
 * @property string $sex_attitude
 * @property string $in_type
 * @property string $last_ip
 * @property integer $last_time
 * @property integer $created_at
 * @property integer $updated_at
 */
class BasicUser extends User
{

    const IN_TYPE_USER = '1';
    const IN_TYPE_ADMIN = '0';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%basic_user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            ['in_type', 'default', 'value' => self::IN_TYPE_USER],
            ['in_type', 'in', 'range' => [self::IN_TYPE_USER, self::IN_TYPE_ADMIN]],
            [['nickname', 'auth_key', 'password_hash'], 'required'],
            ['email','email'],
            [['sex', 'age', 'height', 'weight', 'last_time', 'created_at', 'updated_at'], 'integer'],
            [['in_type'], 'string'],
            [['nickname', 'password_hash', 'password_reset_token', 'email', 'headimgurl'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['profession', 'emotion'], 'string', 'max' => 40],
            [['idcard_number'], 'string', 'max' => 18],
            [['city', 'country', 'province'], 'string', 'max' => 20],
            [['love_attitude', 'sex_attitude'], 'string', 'max' => 100],
            [['last_ip'], 'string', 'max' => 15]
        ];
    }

    /**
     * 根据昵称查用户
     * @param $nickname
     * @return static|null
     */
    public function findByNickName($nickname){
        return static::findOne(['nickname'=>$nickname,'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nickname' => '昵称',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'sex' => '用户的性别，值为1时是男性，值为2时是女性，值为0时是未知',
            'age' => '年龄',
            'height' => '身高',
            'weight' => '体重',
            'profession' => '职业',
            'emotion' => '情感状况',
            'idcard_number' => '身份证号',
            'city' => '用户所在城市',
            'country' => '用户所在国家',
            'province' => '用户所在省份',
            'headimgurl' => '用户头像，最后一个数值代表正方形头像大小（有0、46、64、96、132数值可选，0代表640*640正方形头像），用户没有头像时该项为空。若用户更换头像，原有头像URL将失效。',
            'love_attitude' => '爱情看法',
            'sex_attitude' => '对性看法',
            'in_type' => '产生分类（1前台0后台）',
            'last_ip' => '最后IP',
            'last_time' => '最后登录时间',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
