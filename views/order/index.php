<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('@web/js/order/index.js',['position' => View::POS_END, 'depends' => [JqueryAsset::className()]]);

?>
<div class="order-index">

    <div class="alert alert-secondary">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>

    <p>
        <?= Html::a(Yii::t('app', 'Create Order'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'customer:ntext',
            'contact:ntext',
            'area',
            //'real_price',
            [
                'attribute' => 'status',
                'value' => function($data){
                    $status = '';
                    if($data->status == 'new'){
                        $status = Yii::t('app', 'New');
                    }elseif($data->status == 'in_progress'){
                        $status = Yii::t('app', 'In Progress');
                    }elseif($data->status == 'finished'){
                        $status = Yii::t('app', 'Finished');
                    }
                    return $status;
                }
            ],
            //'discount',
            'sell_price',
            //'deposit',
            //'balance',
            //'creator_id',
            //'created_date',

            //['class' => 'yii\grid\ActionColumn'],
            [
                'header' => '',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}{sell}',
                'buttons' => [
                    'sell' => function ($url, $model) {
                        return Html::a('<span class="fa fa-shopping-cart" data></span>', 'javascript:void()', [
                                    'class' => 'shopping-cart',
                                    'title' => 'Sell',
                                    'data-pjax' => '0',
                                    'data-order-id' => $model->id
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>


</div>
