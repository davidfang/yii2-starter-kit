<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Wechat */

$this->title = 'Create Wechat';
$this->params['breadcrumbs'][] = ['label' => 'Wechats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wechat-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
