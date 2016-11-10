<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Wechat */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="wechat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'token')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'account')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'original')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'type')->textInput() ?>

    <?php echo $form->field($model, 'key')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'secret')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'encoding_aes_key')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'avatar')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'qrcode')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'status')->textInput() ?>

    <?php echo $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
