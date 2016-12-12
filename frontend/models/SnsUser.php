<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
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
class SnsUser extends \common\models\BasicUser
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;//用户状态10为正常用户
    const ROLE_USER = 10;


    /**
     * 城市中异性用户列表
     * @param $user_id array|string 用户ID（排除这些）
     * @param null $city 城市
     * @param int $sex 性别
     * @param int $offset 偏移量
     * @param int $limit 分页条数
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function cityUserList($city=null,$sex=0,$route=null, $limit=18){
        $total = self::cityUserCount($city,$sex);
        $pagination = new Pagination([
            'defaultPageSize' => $limit,
            'totalCount' => $total,
            'route'=>$route
        ]);
        $query = self::find();
        $fields = ['id','username', 'nickname', 'sex', 'age','headimgurl','last_time','location_x','location_y'];
        $query->select($fields);
        $query->where(['status' =>self::STATUS_ACTIVE]);
        if($sex!=0) $query->andWhere(['sex'=>$sex]);
        if(!is_null($city)) $query->andWhere(['city'=>$city]);
        $data =  $query->orderBy('last_time desc')//根据最后登录时间排序
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->asArray()
            ->all();
        foreach($data as $k => $v){
            $data[$k]['headimgurl']=qiniuDownloadUrl($v['headimgurl'],80);
        }
        return['data'=>$data,'pagination'=>$pagination->links];
    }
    /**
     * 城市中用户总数
     * 根据城市和性别，用于分页时算总数
     * @param null $city 城市
     * @param int $sex 性别
     * @return int 用户总数
     */
    public static  function cityUserCount($city=null,$sex=0){
        $query = self::find();
        $query->where(['status' =>self::STATUS_ACTIVE]);
        if($sex!=0) $query->andWhere(['sex'=>$sex]);
        if(!is_null($city)) $query->andWhere(['city'=>$city]);
        return $query->count();
    }

    /**
     * 根据用户ID获得用户信息
     * @param $id string 用户ID
     * @return null|\yii\db\ActiveRecord[]
     */
    public static function userinfoById($id){
        $user_info = self::findOne($id);
        if(empty($user_info) or ($user_info->status!=self::STATUS_ACTIVE)){//用户不存在或者不可访问
            return null;
        }
        $user_info->be_visited_count++;//用户被访问次数+1
        $user_info->save();
        $user_info->headimgurl = qiniuDownloadUrl($user_info->headimgurl,80);
        return $user_info;
    }

    /**
     * 用户访问次数+1
     * 一般用于用户自己访问别人的次数+1
     * @param \yii\web\IdentityInterface $identity
     * @return mixed
     */

    public static function visitedCountIncrease(\yii\web\IdentityInterface $identity){
        $identity->visited_count++;//用户访问次数+1
        return $identity->save();
    }
    /**
     * 添加用户好友次数+1
     * @param $user_id
     */
    public static function addFriendCountIncrease($user_id){
        $user_info = self::findOne($user_id);
        $user_info->add_friend_count ++;
        $user_info->save();
    }
    /**
     * 被添加用户好友次数+1
     * @param $user_id
     */
    public static function beAddFriendCountIncrease($user_id){
        $user_info = self::findOne($user_id);
        $user_info->be_add_friend_count ++;
        $user_info->save();
    }
    /**
     * 允许添加用户好友次数+1
     * @param $user_id
     */
    public static function allowAddFriendCountIncrease($user_id){
        $user_info = self::findOne($user_id);
        $user_info->allow_add_friend_count ++;
        $user_info->save();
    }
    /**
     * 允许被添加用户好友次数+1
     * @param $user_id
     */
    public static function allowBeAddFriendCountIncrease($user_id){
        $user_info = self::findOne($user_id);
        $user_info->allow_be_add_friend_count ++;
        $user_info->save();
    }
}
