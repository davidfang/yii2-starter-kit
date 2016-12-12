<?php

namespace frontend\models;

use Yii;
use yii\base\Model;


class ActivityForm extends Model
{
    public $title;
    public $time;
    public $province;
    public $city;
    public $address;
    public $content;
    public $img_id;

    public function rules(){
        return [
            [[ 'title', 'time', 'province', 'city', 'address', 'content'], 'required'],
            [['time', 'province', 'city'], 'string', 'max' => 20],
            [['title'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 100],
            [['content'], 'string', 'max' => 255]
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => '标题',
            'time' => '时间',
            'province' => '省份',
            'city' => '城市',
            'address' => '地点',
            'content' => '内容',
            'img_id' => '图片ID'
        ];
    }

    /**
     * 建立约会活动
     * @param $user_info
     * @param $parms
     * @return Activity|bool
     */
    public function create( $user_info,$parms){
        if(!$this->validate($parms)){
            return false;
        }
        $parms['user_id']=$user_info['id'];
        $parms['sex']=$user_info['sex'];
        $parms['ip']=Yii::$app->request->userIP;
        $parms['location_x']=$user_info['location_x'];
        $parms['location_y']=$user_info['location_y'];
        $activity = new Activity();
        if($activity->load($parms,'') and $activity->save()){
            return $activity;
        }else{
            //\yii\helpers\BaseVarDumper::dump($activity->hasErrors());
            //\yii\helpers\BaseVarDumper::dump($activity->getErrors());
            return false;
        }
    }

}
