<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/21 0021
 * Time: 下午 12:25
 */
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'name' => $faker->name,	//varchar(255)	否		礼品名称
'image'	 => $faker->numberBetween(1,10).'.jpg',//varchar(255)	否		礼品图片（采用礼品表中适当大小的图片）
'description'	 => $faker->text(10),//int(255)	否		礼品描述
'price'	 => $faker->biasedNumberBetween(10,100),//decimal(11,0)	否		价值
'created_at'	 => time(),//int(11)	否		建立时间
'updated_at'	 => time(),//int(11)	否		更新时间
];