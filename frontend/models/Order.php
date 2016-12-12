<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $product_id
 * @property integer $money
 * @property integer $start_time
 * @property integer $end_time
 * @property integer $created_at
 * @property integer $updated_at
 */
class Order extends \common\models\Order
{

}
