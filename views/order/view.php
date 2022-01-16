<?php

use app\models\OrderTypeRelMaterials;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = $model->customer.'/'.$model->contact;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'customer:ntext',
            'contact:ntext',
            'area',
            'real_price',
            'discount',
            'sell_price',
            'deposit',
            'balance',
            'creator_id',
            'created_date',
        ],
    ]) ?>
    <h4><?=Yii::t('app','Types')?></h4>
    <?php foreach($relModel as $rel):?>
        <?= DetailView::widget([
        'model' => $rel,
        'attributes' => [
            'id',
            'width',
            'height',
            [
                'attribute' => 'type_id',
                'value' => function($data){
                    return $data->type->name;
                }
            ],
            'working_area',
            'other_expenses',
            'area',
            'real_price'
        ],
    ]);
    ?>
    <?php $orderTypeRelMaterialModel = OrderTypeRelMaterials::find()->where(['order_type_rel_id'=>$rel->id])->all();?>
    <table class="table">
        <tr>
            <td colspan="10"><?=$orderTypeRelMaterialModel[0]->reserveType->name;?></td>
        </tr>
        <tr>
            <th><?=Yii::t('app','Code');?></th>
            <th><?=Yii::t('app','Name');?></th>
            <th><?=Yii::t('app','Unit');?></th>
            <th><?=Yii::t('app','Count');?></th>
            <th><?=Yii::t('app','Price');?></th>
            <th><?=Yii::t('app','Total');?></th>
            <th><?=Yii::t('app','Used Count');?></th>
            <th><?=Yii::t('app','Used Total');?></th>
            <th><?=Yii::t('app','Current Count');?></th>
            <th><?=Yii::t('app','Current Total');?></th>
        </tr>
        <?php foreach($orderTypeRelMaterialModel as $orderTypeRelMaterial):?>
            <tr>
                <td><?=$orderTypeRelMaterial->reserveTypeMaterial->code;?></td>
                <td><?=$orderTypeRelMaterial->reserveTypeMaterial->name;?></td>
                <td><?=$orderTypeRelMaterial->reserveTypeMaterial->unit;?></td>
                <td class="text-info"><?=$orderTypeRelMaterial->reserveTypeMaterial->count;?></td>
                <td class="text-info"><?=$orderTypeRelMaterial->reserveTypeMaterial->price;?></td>
                <td class="text-info"><?=$orderTypeRelMaterial->reserveTypeMaterial->total;?></td>
                <td class="text-warning"><?=$orderTypeRelMaterial->count;?></td>
                <td class="text-warning"><?=$orderTypeRelMaterial->price;?></td>
                <td class="text-danger"><?=$orderTypeRelMaterial->reserveTypeMaterial->current_count;?></td>
                <td class="text-danger"><?=$orderTypeRelMaterial->reserveTypeMaterial->current_total;?></td>
            </tr>
        <?php endforeach;?>

    </table>
    <?php endforeach;?>

</div>
