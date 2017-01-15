<?php

namespace frontend\modules\api\v1\resources;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class Friendship extends \common\models\Friendship
{
    // 过滤掉一些字段，适用于你希望继承父类
//实现同时你想屏蔽掉一些敏感字段
    public function fields()
    {
        $fields = parent::fields();

        // 删除一些包含敏感信息的字段
        unset($fields['created_at'], $fields['updated_at']);

        return $fields;
    }


    public function extraFields()
    {
        return ['selfUserInfo','friendUserInfo'];
    }

    /**
     * 自己的用户信息
     * @return \yii\db\ActiveQuery
     */
    public function getSelfUserInfo()
    {
        return $this->hasOne(BasicUser::className(), ['id' => 'self_user_id']);
    }


    /**
     * 朋友的用户信息
     * @return \yii\db\ActiveQuery
     */
    public function getFriendUserInfo()
    {
        return $this->hasOne(BasicUser::className(), ['id' => 'friend_user_id']);
    }

}
