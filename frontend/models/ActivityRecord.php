<?php

namespace frontend\models;

use Yii;
use yii\data\Pagination;
/**
 * This is the model class for table "{{%activity_record}}".
 *
 * @property integer $id
 * @property integer $activity_id
 * @property integer $user_id
 * @property integer $allow
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $own_user_id
 */
class ActivityRecord extends \common\models\ActivityRecord
{
    /**
     * 获取用户参与的约会申请记录
     * @param $user_id 用户ID
     * @param null $route 路由
     * @return array
     */
    public static  function activitiesByUserId($user_id,$route=null){
        $query = self::find()->where(['user_id'=>$user_id]);
        $clone_query = clone $query;
        $total = $clone_query->count();
        $pagination = new Pagination([
            'defaultPageSize' => 2,
            'totalCount' => $total,
            'route'=>$route
        ]);
        $data = $query->orderBy(['created_at'=>'desc'])
                    ->limit($pagination->limit)
                    ->offset($pagination->offset)
                    ->with(['user','ownUser','activity'])
                    ->asArray()
                    ->all();
        return ['data'=>$data,'pagination'=>$pagination->links];

    }

    /**
     * 约会的参与人员记录
     * @param $activity_id
     */
    public static  function recordsByActivityId($activity_id){
        $query = self::find()->where(['activity_id'=>$activity_id]);
        $data = $query->orderBy(['created_at'=>'desc'])
            ->with('user')
            ->asArray()
            ->all();
        return $data;
    }
}
