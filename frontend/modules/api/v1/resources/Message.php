<?php

namespace frontend\modules\api\v1\resources;


/**
 * Class Message
 * @package frontend\modules\api\v1\resources
 */
class Message extends \common\models\Message
{
    public function fields()
    {
        return parent::fields();
    }

    public function extraFields()
    {
        return ['fromUser','toUser','activity','activityRecord'];
    }

    /**
     * 发信人
     * @return \yii\db\ActiveQuery
     */
    public function getFromUser(){
        return $this->hasOne(BasicUser::className(),['user_id'=>'from_user_id']);
    }

    /**
     * 收信人
     * @return \yii\db\ActiveQuery
     */
    public function getToUser(){
        return $this->hasOne(BasicUser::className(),['user_id'=>'to_user_id']);
    }

    /**
     * 约会信息
     * @return \yii\db\ActiveQuery
     */
    public function getActivity(){
        return $this->hasOne(Activity::className(),['id'=>'activity_id']);
    }

    /**
     * 约会参与信息
     * @return \yii\db\ActiveQuery
     */
    public function getActivityRecord(){
        //return $this->hasOne(ActivityRecord::className(),['activity_id'=>'activity_id','user_id'=>'from_user_id']);
        return $this->hasOne(ActivityRecord::className(),['activity_id'=>'activity_id','user_id'=>'from_user_id']);
    }
}
