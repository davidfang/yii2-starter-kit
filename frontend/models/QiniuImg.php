<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%img}}".
 *
 * @property integer $id
 * @property string $img
 * @property integer $img_size
 * @property integer $user_id
 * @property string $type
 * @property integer $type_id
 * @property integer $check
 * @property integer $created_at
 * @property integer $updated_at
 */
class QiniuImg extends \common\models\QiniuImg
{
    /**
     * 根据用户ID获得用户的图片
     * @param $user_id int 用户的ID
     * @param string $type  图片类别 （basic_user|activity） 用户/活动
     * @param bool $self 是否图片上传者
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function imgsByUserId($user_id,$type=self::TYPE_USER,$self=false){
        $query = self::find();
        $query->where(['user_id' => $user_id,'type'=>$type]);
        if($self){
            $query->andWhere(['>','check',0]);
        }else{
            $query->andWhere(['>','check',1]);
        }
        return $query->orderBy('created_at desc')->asArray()->all();
    }
    /**
     * 根据ID取得图片信息
     * @param $id
     * @return null|static
     */
    public static function imgById($id){
        $img =  self::findOne($id);
        if(empty($img) or $img->check <2){
            return null;
        }else{
            return $img;
        }
    }
}
