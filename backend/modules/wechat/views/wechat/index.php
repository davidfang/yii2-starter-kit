<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\WechatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wechats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wechat-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Wechat', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'token',
            'access_token',
            'account',
            // 'original',
            // 'type',
            // 'key',
            // 'secret',
            // 'encoding_aes_key',
            // 'avatar',
            // 'qrcode',
            // 'address',
            // 'description',
            // 'username',
            // 'status',
            // 'password',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
