<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/23 0023
 * Time: 下午 5:01
 */
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'activity_id'  => $faker->numberBetween(1,800),//邀约ID
    'user_id' => $faker->numberBetween(1,202),//用户ID
    'allow' => $faker->randomElement([-1,0,1,2]),
    /*function(){
        $array = ['-1','0','1','2'];
        $key = array_rand($array);
        return $array[$key];
    },*///是否允许参与（-1拒绝，0未读，1允许，2考虑）
    'own_user_id' => $faker->numberBetween(0,202),//活动发布者用户ID
    'created_at' => $faker->time(),
    'updated_at' => $faker->time()
];