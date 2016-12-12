<?php

namespace frontend\modules\api\v1\resources;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class BasicUser extends \common\models\BasicUser
{
    // 过滤掉一些字段，适用于你希望继承父类
//实现同时你想屏蔽掉一些敏感字段
    public function fields()
    {
        $fields = parent::fields();
        $fields['headimgurl'] = function (){
            return qiniuDownloadUrl($this->headimgurl );
        };
        // 删除一些包含敏感信息的字段
        unset($fields['auth_key'], $fields['password_hash'], $fields['password_reset_token']);

        return $fields;
    }


    /*public function extraFields()
    {
        return ['userProfile'];
    }*/
}
