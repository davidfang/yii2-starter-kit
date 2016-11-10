<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WechatSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="wechat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'name') ?>

    <?php echo $form->field($model, 'token') ?>

    <?php echo $form->field($model, 'access_token') ?>

    <?php echo $form->field($model, 'account') ?>

    <?php // echo $form->field($model, 'original') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'key') ?>

    <?php // echo $form->field($model, 'secret') ?>

    <?php // echo $form->field($model, 'encoding_aes_key') ?>

    <?php // echo $form->field($model, 'avatar') ?>

    <?php // echo $form->field($model, 'qrcode') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'username') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
