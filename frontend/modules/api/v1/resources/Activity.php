<?php

namespace frontend\modules\api\v1\resources;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class Activity extends \common\models\Activity
{
    // 过滤掉一些字段，适用于你希望继承父类
//实现同时你想屏蔽掉一些敏感字段
    public function fields()
    {
        $fields = parent::fields();
        $fields['img50'] = function (){
            return qiniuDownloadUrl($this->img_id .'.jpg',50 );
        };
        $fields['img100'] = function (){
            return qiniuDownloadUrl($this->img_id .'.jpg',100 );
        };
        $fields['img500'] = function (){
            return qiniuDownloadUrl($this->img_id .'.jpg',500 );
        };
        // 删除一些包含敏感信息的字段
        //unset();

        return $fields;
    }


    public function extraFields()
    {
        return ['user','activityRecords'];
    }
    /**
     * 用户信息
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(BasicUser::className(), ['id' => 'user_id']);
    }

}
