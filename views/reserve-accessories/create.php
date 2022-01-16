<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ReserveAccessories */

$this->title = Yii::t('app', 'Create Reserve Accessories');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reserve Accessories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reserve-accessories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
