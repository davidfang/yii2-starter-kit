<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%activity}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $sex
 * @property integer $title
 * @property string $time
 * @property string $province
 * @property string $city
 * @property string $address
 * @property string $content
 * @property integer $img_id
 * @property string $allow_friend
 * @property integer $status
 * @property string $ip
 * @property string $location_x
 * @property string $location_y
 * @property integer $clicked_count
 * @property integer $play_count
 * @property integer $allow_count
 * @property integer $created_at
 * @property integer $updated_at
 */
class Activity extends \yii\db\ActiveRecord
{
    const STATUS_DEFAULT = 1;//状态（默认1通过，）
    const STATUS_ADMIN_DEL = 0;//状态（0被管理员删除）
    const STATUS_ADMIN_ALLOW = 2;//状态（2被管理员通过）
    const STATUS_SELF_DEL = -1;//状态（-1用户自己删除）
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
        return '{{%activity}}';
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
            [['user_id', 'sex', 'title', 'time', 'province', 'city', 'address', 'content', 'ip'], 'required'],
            [['user_id', 'sex', 'status', 'clicked_count', 'play_count', 'allow_count', 'created_at', 'updated_at'], 'integer'],
            [['location_x', 'location_y'], 'number'],
            [['time', 'province', 'city', 'allow_friend'], 'string', 'max' => 20],
            [['address'], 'string', 'max' => 100],
            [['img_id'], 'string', 'max' => 100],
            [['content'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 15]
        ];
    }
    /**
     * 用户信息
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(BasicUser::className(), ['id' => 'user_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImg()
    {
        return $this->hasOne(QiniuImg::className(), ['id' => 'img_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivityRecords()
    {
        return $this->hasMany(ActivityRecord::className(), ['activity_id' => 'id']);
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户ID',
            'sex' => '用户的性别，值为1时是男性，值为2时是女性，值为0时是未知',
            'title' => '标题',
            'time' => '时间',
            'province' => '省份',
            'city' => '城市',
            'address' => '地点',
            'content' => '内容',
            'img_id' => '图片ID',
            'allow_friend' => '是否允许带朋友',
            'status' => '状态（默认1通过，0被管理员删除，2用户自己删除）',
            'ip' => 'IP',
            'location_x' => '经度',
            'location_y' => '纬度',
            'clicked_count' => '活动被查看点击次数',
            'play_count' => '参与人数',
            'allow_count' => '允许人数',
            'created_at' => '建立时间',
            'updated_at' => '修改时间',
        ];
    }

    /**
     * 获得用户的活动
     * @param $user_id 用户ID
     *  状态（默认1通过，0被管理员删除，2管理员审核通过，-1用户自己删除）
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function activitiesByUserId($user_id){
        $query = self::find();
        $query->where(['user_id' => $user_id]);
        $query->andWhere(['>','status',self::STATUS_ADMIN_DEL]);
        return $query->orderBy('created_at desc')->asArray()->all();
    }
}
