<?php

namespace frontend\modules\api\v1\resources;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class Package extends \common\models\Package
{
    // 过滤掉一些字段，适用于你希望继承父类
//实现同时你想屏蔽掉一些敏感字段
    public function fields()
    {
        $fields = parent::fields();

        // 删除一些包含敏感信息的字段
        //$fields['inCount'] ;

        return $fields;
    }


    /*public function extraFields()
    {
        return [];
    }*/
}
