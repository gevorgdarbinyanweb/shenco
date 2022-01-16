<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ReserveTypeMaterials */

$this->title = Yii::t('app', 'Create Reserve Type Materials');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reserve Type Materials'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reserve-type-materials-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
