<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/21 0021
 * Time: 下午 12:01
 */
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'self_user_id' => $faker->numberBetween(1, 202),// int(11)	否		自己的用户ID
    'friend_user_id' => $faker->numberBetween(1, 202),//int(11)	否		朋友的用户ID
    'view' => $faker->numberBetween(0, 1),//tinyint(1)	是	0	朋友是否查看(0表示没看）
    'allow' => $faker->numberBetween(0, 1),//tinyint(1)	是	1	朋友是否允许加好友（默认允许1），此项目暂时不用此功能，后续可以做为收费点开发
    'created_at' => $faker->unixTime,//int(11)	是	NULL	建立时间
    'updated_at' => $faker->unixTime,//int(11)	是	NULL	更新时间（这里主要是用户查看，或者同意）
];
