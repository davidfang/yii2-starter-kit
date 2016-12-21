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
    'from_user_id' => $faker->numberBetween(1,202),
    'to_user_id' => $faker->numberBetween(1,202),
    'gift_id' => $faker->numberBetween(1,10),
    'created_at' => $faker->time()
];
