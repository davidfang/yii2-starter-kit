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
        $fields['img50'] = function (){
            return qiniuDownloadUrl($this->headimgurl ,50 );
        };
        $fields['img100'] = function (){
            return qiniuDownloadUrl($this->headimgurl ,100 );
        };
        $fields['img500'] = function (){
            return qiniuDownloadUrl($this->headimgurl,500 );
        };
        // 删除一些包含敏感信息的字段
        unset($fields['auth_key'], $fields['password_hash'], $fields['password_reset_token']);

        return $fields;
    }


    public function extraFields()
    {
        return ['openImgs','privateImgs','activity','inPackage','outPackage'];
    }

    /**
     * 公开照片
     * @return $this
     */
    public function getOpenImgs(){
        //return $this->hasMany(QiniuImg::className(),['user_id'=>'id'])->where(['type'=>'basic_user','check'=>2])->orderBy(['created_at' => SORT_ASC])->all();
        return $this->hasMany(QiniuImg::className(),['user_id'=>'id'])->orderBy(['created_at' => SORT_ASC]);
    }

    /**
     * 私密照片
     * @return $this
     */
    public function getPrivateImgs(){
        //return $this->hasMany(QiniuImg::className(),['user_id'=>'id'])->where(['type'=>'basic_user','check'=>2])->orderBy(['created_at' => SORT_ASC])->all();
        return $this->hasMany(QiniuImg::className(),['user_id'=>'id'])->orderBy(['created_at' => SORT_ASC]);
    }

    /**
     * 拥有的活动
     * @return $this
     */
    public function getActivity(){
        return $this->hasMany(Activity::className(),['user_id'=>'id'])->orderBy(['created_at' => SORT_ASC]);
    }

    /**
     * 发送的礼物
     * @return $this
     */
    public function getOutPackage(){
        return $this->hasMany(Package::className(),['from_user_id'=>'id'])->select(['gift_id','count(id) AS outCount'])->groupBy('gift_id')->asArray(true);
    }

    /**
     * 接受的礼物
     * @return $this
     */
    public function getInPackage(){
        return $this->hasMany(Package::className(),['to_user_id'=>'id'])->select(['gift_id','count(id) AS inCount'])->groupBy('gift_id')->asArray(true);
    }
}
