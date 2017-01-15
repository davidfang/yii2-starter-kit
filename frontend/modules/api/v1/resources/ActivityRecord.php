<?php

namespace frontend\modules\api\v1\resources;


class ActivityRecord extends \common\models\ActivityRecord
{
    public function fields()
    {
        return parent::fields();
    }

    public function extraFields()
    {
        return ['ownUser','user','activity','message'];
    }

    /**
     * 用户ID人
     * @return \yii\db\ActiveQuery
     */
    public function getUser(){
        return $this->hasOne(BasicUser::className(),['user_id'=>'user_id']);
    }

    /**
     * 活动发布者用户ID人
     * @return \yii\db\ActiveQuery
     */
    public function getOwnUser(){
        return $this->hasOne(BasicUser::className(),['user_id'=>'own_user_id']);
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
    public function getMessage(){
        return $this->hasMany(Message::className(),['activity_id'=>'activity_id',]);
            //->where(['in','from_user_id',[$this->user_id,$this->own_user_id]])
            //->where(['in','to_user_id',[$this->user_id,$this->own_user_id]]);
    }
}
