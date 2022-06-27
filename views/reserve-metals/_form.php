<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $model app\models\ReserveMetals */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile('@web/js/reserve-metals.js',['position' => View::POS_END, 'depends' => [JqueryAsset::className()]]);
?>

<div class="reserve-metals-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput() ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'unit')->dropdownLIst(['մետր'=>'մետր','հատ'=>'հատ'],['prompt'=>'Միավոր'])?>

    <?= $form->field($model, 'count')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'total')->textInput() ?>

    <?= $form->field($model, 'current_count')->textInput() ?>

    <?= $form->field($model, 'current_total')->textInput() ?>

    <?= $form->field($model, 'creator_id')->hiddenInput()->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
