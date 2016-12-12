<?php

namespace frontend\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "{{%friendship}}".
 *
 * @property integer $id
 * @property integer $self_user_id
 * @property integer $friend_user_id
 * @property integer $view
 * @property integer $allow
 * @property integer $created_at
 * @property integer $updated_at
 */
class Friendship extends \common\models\Friendship
{
    /**
     * 获得某人的所有好友
     * 分页获得用户的朋友
     * @param $user_id  用户ID
     * @param int $allow 是否被允许
     * @return array []
     */
    public static function getFrendsByUserId($user_id, $allow = 1)
    {

        $query = self::find();
        $query->where(['self_user_id' => $user_id]);
        $pagination = new Pagination([
            'defaultPageSize' => 1,
            'totalCount' => $query->count(),
        ]);
        $friendship = $query->orderBy('updated_at desc')
            ->with("friendUserInfo")
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $friends = [];
        if (!empty($friendship)) {
            foreach ($friendship as $k => $friend) {
                $friends[$k]['id'] = $friend->friendUserInfo['id'];
                $friends[$k]['friend_user_headimgurl'] = qiniuDownloadUrl($friend->friendUserInfo['headimgurl']);
                $friends[$k]['friend_user_nickname'] = $friend->friendUserInfo['nickname'];
            }
        }

        \Yii::$app->response->format = 'json';
        return ['data' => $friends, 'pagination' => $pagination->links];
    }

    /**
     * 获得一个最新的用户  少城市
     * @param $self_user_id int 自己的用户ID
     * @param $no_bo array 排除不啵的用户ID数组
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function getOneNewUser($self_user_id, $no_bo)
    {
        $query = self::find();
        $friends_user_ids = $query->select('friend_user_id')->orderBy('friend_user_id')->indexBy('friend_user_id')->where(['self_user_id' => $self_user_id])->asArray()->all();
        $user_ids = array_keys($friends_user_ids);
        $user_ids = array_merge($user_ids, $no_bo);
        $sns_user_query = SnsUser::find();
        $user_info = $sns_user_query->select(['id', 'nickname', 'sex', 'age', 'city', 'province', 'headimgurl', 'last_time', 'location_x', 'location_y'])
            ->where(['not in', 'id', $user_ids])
            ->orderBy('last_time desc')->asArray()->one();
        $user_info['headimgurl']= qiniuDownloadUrl($user_info['headimgurl']);
        //echo $sns_user_query->createCommand()->getSql();
        //\yii\helpers\VarDumper::dump($user_info);
        //exit;
        return $user_info;
    }

    /**
     * 添加用户好友关系
     * @param $from_user_id
     * @param $to_user_id
     * @return array
     */
    public function joinFriend($from_user_id, $to_user_id)
    {
        $return = ['status' => false, 'msg' => ''];
        if (self::checkFreind($from_user_id, $to_user_id)) {
            $return['msg'] = '不能重复添加';
        } else {
            $this->self_user_id = $from_user_id;
            $this->friend_user_id = $to_user_id;
            $this->view = 0;
            $this->allow = 0;
            $this->save();
            SnsUser::addFriendCountIncrease($from_user_id); //添加用户数量+1
            SnsUser::beAddFriendCountIncrease($to_user_id); //被添加者被添加用户数量+1
            $return['status'] = true;
            $return['msg'] = '成功添加用户';
        }
        return $return;
    }

    /**
     *  检查用户好友关系
     * @param $from_user_id
     * @param $to_user_id
     * @return static yii\db\ActiveRecord
     */
    public function checkFreind($from_user_id, $to_user_id)
    {
        return self::findOne(['self_user_id' => $from_user_id, 'friend_user_id' => $to_user_id]);
    }
}
