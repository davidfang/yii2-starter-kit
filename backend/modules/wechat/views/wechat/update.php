<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Wechat */

$this->title = 'Update Wechat: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Wechats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="wechat-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
