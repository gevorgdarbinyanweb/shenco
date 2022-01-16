<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ReserveMetals */

$this->title = Yii::t('app', 'Create Reserve Metals');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reserve Metals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reserve-metals-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
