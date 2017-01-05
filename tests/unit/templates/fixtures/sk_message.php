<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/23 0023
 * Time: 下午 3:59
 */
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'activity_id'  => $faker->numberBetween(1,800),
    'from_user_id' => $faker->numberBetween(1,202),
    'to_user_id' => $faker->numberBetween(1,202),
    'content' => $faker->text(20),
    'read' => $faker->numberBetween(0,1),
    'created_at' => $faker->time(),
    'updated_at' => $faker->time()
];