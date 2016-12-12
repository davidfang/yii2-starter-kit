<?php

namespace frontend\models;

use Yii;
use yii\web\IdentityInterface;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

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
class Activity extends \common\models\Activity
{
    const STATUS_DEFAULT = 1;//默认1通过
    const STATUS_ADMINDEL = 0;//被管理员删除
    const STATUS_ADMINACCESS = 2;//管理员审核通过
    const STATUS_SELFDEL = -1;//用户自己删除
    public $agotime ;
    /**
     * 约会列表
     * @param null $city 城市
     * @param int $sex 性别
     * @param null $route 路由，分页时访问页面使用的路由，默认为当前页
     * @return array 包含两部分['data'=>\yii\db\ActiveRecord,'pagination'=>$pagination->links]
     */
    public static function activityList($city=null,$sex=0,$route=null){
        $total = self::cityActivityCount($city,$sex);
        $pagination = new Pagination([
            'defaultPageSize' => 2,
            'totalCount' => $total,
            'route'=>$route
        ]);
        $query = self::find();
        $fields = ['id','user_id', 'sex', 'title', 'province','city','address','content','img_id','allow_friend','time','created_at'];
        $query->select($fields);
        $query->where(['>' ,'status',self::STATUS_ADMINDEL]);
        /******注意：此处测试，为防止看不到数据，先可以看到所有的约会，后面要删除 ****/
        //if($sex!=0) $query->andWhere(['sex'=>$sex]);
        if(!is_null($city)) $query->andWhere(['city'=>$city]);
        $data = $query->orderBy('created_at desc')
                        ->offset($pagination->offset)
                        ->limit($pagination->limit)
                        ->with(['user','img'])
                        ->all();
        return ['data'=>$data,'pagination'=>$pagination->links];
    }
    /**
     * 城市中约会总数
     * 根据城市和性别，用于分页时算总数
     * @param null $city 城市
     * @param int $sex 性别
     * @return int 约会总数
     */
    public static  function cityActivityCount($city=null,$sex=0){
        $query = self::find();
        $query->where(['>' ,'status' ,self::STATUS_ADMINDEL]);
        /******注意：此处测试，为防止看不到数据，先可以看到所有的约会，后面要删除 ****/
        //if($sex!=0) $query->andWhere(['sex'=>$sex]);
        if(!is_null($city)) $query->andWhere(['city'=>$city]);
        return $query->count();
    }

    /**
     * 根据用户ID获得用户的图片
     * @param $user_id int 用户的ID
     * @param string $type  图片类别 （basic_user|activity） 用户/活动
     * @param bool $self 是否图片上传者
     * @return array|\yii\db\ActiveRecord[]
     */
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
        return $query->orderBy('created_at desc')->with(['user','img'])->asArray()->all();
    }

    /**
     * 根据活动ID访问活动信息
     * @param $id
     * @return null|static
     */
    public static  function activityInfoById($id){
        $activity = self::findOne($id);
        if(empty($activity) or ($activity->status <self::STATUS_ADMINDEL)){//活动没被删除
            return null;
        }
        $activity->clicked_count++;//活动点击次数+1
        $activity->save();
        return $activity;
    }
    /**
     * 用户参与约会活动
     * @param $activity_id 约会活动ID
     * @param $user_id 用户ID
     * @return string|bool 发送的消息内容
     */
    public static function joinActivity($activity_id,$user_id){
        $activity = self::findOne(['id'=>$activity_id,'status>'.Activity::STATUS_ADMIN_DEL]);
        if(empty($activity)){//约会不存在了
            return false;
        }
        $activity->play_count++;//活动参与人数+1
        $activity->save();
        $activity_record_model = new ActivityRecord();
        $activity_record_model->activity_id = $activity_id;
        $activity_record_model->user_id = $user_id;
        $activity_record_model->own_user_id = $activity->user_id;
        if($activity_record_model->save()) {//参与活动成功了
            //给用户发送一条申请加入活动的消息
            $temp_message = array('Hi','约吗？','你好','我想参加你的活动');
            $message_model = new Message();
            $message_model->activity_id = $activity_id;
            $message_model->from_user_id = $user_id;
            $message_model->to_user_id = $activity->user_id;
            $message_model->content = $temp_message[array_rand($temp_message)];
            $message_model->save();
            return $message_model->content;
        }else{
            return false;
        }
    }
}
