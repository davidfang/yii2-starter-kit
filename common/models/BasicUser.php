<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%basic_user}}".
 *
 * @property integer $id
 * @property string $fromusername
 * @property integer $subscribe
 * @property string $username
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
 * @property string $income
 * @property string $tag
 * @property string $hope_skill
 * @property string $have_skill
 * @property string $emotion
 * @property string $idcard_number
 * @property string $city
 * @property string $country
 * @property string $province
 * @property string $headimgurl
 * @property string $love_attitude
 * @property string $sex_attitude
 * @property string $intent
 * @property string $introduction
 * @property string $weixin
 * @property string $mobile
 * @property string $in_type
 * @property string $last_ip
 * @property integer $last_time
 * @property double $location_x
 * @property double $location_y
 * @property integer $visited_count
 * @property integer $be_visited_count
 * @property integer $add_friend_count
 * @property integer $allow_add_friend_count
 * @property integer $be_add_friend_count
 * @property integer $allow_be_add_friend_count
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class BasicUser extends \yii\db\ActiveRecord
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
        return '{{%basic_user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fromusername', 'nickname', 'auth_key', 'password_hash'], 'required'],
            [['subscribe', 'sex', 'age', 'height', 'weight', 'last_time', 'visited_count', 'be_visited_count', 'add_friend_count', 'allow_add_friend_count', 'be_add_friend_count', 'allow_be_add_friend_count', 'status', 'created_at', 'updated_at'], 'integer'],
            [['income', 'in_type'], 'string'],
            [['location_x', 'location_y'], 'number'],
            [['fromusername', 'nickname', 'password_hash', 'password_reset_token', 'email', 'tag', 'headimgurl'], 'string', 'max' => 255],
            [['username', 'intent', 'introduction'], 'string', 'max' => 50],
            [['auth_key'], 'string', 'max' => 32],
            [['profession', 'emotion'], 'string', 'max' => 40],
            [['hope_skill', 'have_skill','satisfying_parts'], 'string', 'max' => 500],
            [['idcard_number'], 'string', 'max' => 18],
            [['city', 'country', 'province', 'weixin'], 'string', 'max' => 20],
            [['love_attitude', 'sex_attitude'], 'string', 'max' => 100],
            [['mobile'], 'string', 'max' => 11],
            [['last_ip'], 'string', 'max' => 15]
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
            'fromusername' => '微信ID',
            'subscribe' => '微信是否关注',
            'username' => '用户名',
            'nickname' => '昵称',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => '邮箱',
            'sex' => '用户的性别，值为1时是男性，值为2时是女性，值为0时是未知',
            'age' => '年龄',
            'height' => '身高',
            'weight' => '体重',
            'profession' => '职业',
            'income' => '收入情况（-1为保密，其它为上一档到本档K)',
            'tag' => '个性标签',
            'hope_skill' => '希望学技能（单个技能不超10个字，最多5个技能，每个技能用逗号分隔）',
            'have_skill' => '拥有技能（单个技能不超10个字，最多5个技能，每个技能用逗号分隔）',
            'satisfying_parts'=>'最满意的部位（单个部位不超10个字，最多5个部位，每个部位用逗号分隔）',
            'emotion' => '情感状况（单身，已婚，离异）',
            'idcard_number' => '身份证号',
            'city' => '用户所在城市',
            'country' => '用户所在国家',
            'province' => '用户所在省份',
            'headimgurl' => '用户头像，最后一个数值代表正方形头像大小（有0、46、64、96、132数值可选，0代表640*640正方形头像），用户没有头像时该项为空。若用户更换头像，原有头像URL将失效。',
            'love_attitude' => '爱情看法',
            'sex_attitude' => '对性看法',
            'intent' => '意图、意向、目的（恋爱，结婚，玩伴）',
            'introduction' => '自我介绍（不超过25个字）',
            'weixin' => '微信号，规则同微信注册',
            'mobile' => '手机',
            'in_type' => '产生分类（1前台0后台）',
            'last_ip' => '最后IP',
            'last_time' => '最后登录时间',
            'location_x' => '经度',
            'location_y' => '纬度',
            'visited_count' => '访问别人次数',
            'be_visited_count' => '被别人访问次数',
            'add_friend_count' => '自己加朋友次数',
            'allow_add_friend_count' => '自己加朋友被允许次数',
            'be_add_friend_count' => '自己被朋友加的次数',
            'allow_be_add_friend_count' => '自己被朋友加允许的次数',
            'status' => '状态（默认10）',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
