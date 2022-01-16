<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\ReserveType;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReserveTypeMaterialsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Reserve Type Materials');
$this->params['breadcrumbs'][] = $this->title;


// if (isset($_REQUEST['ReserveTypeMaterialsSearch']['reserve_type_id'])) {
//     $reserveTypeID = $_REQUEST['ReserveTypeMaterialsSearch']['reserve_type_id'];
// }
$reserveTypeID = isset($_REQUEST['ReserveTypeMaterialsSearch']['reserve_type_id']) ? $_REQUEST['ReserveTypeMaterialsSearch']['reserve_type_id'] : '';
?>
<div class="reserve-type-materials-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Reserve Type Materials'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'reserve_type_id',
                'filter' => Html::dropDownList('ReserveTypeMaterialsSearch[reserve_type_id]', $reserveTypeID, ArrayHelper::map(ReserveType::find()->orderBy('name')->asArray()->all(), 'id', 'name'), ['class' => 'form-control', 'prompt' => Yii::t('app','Reserve Type')]),
                'value' => function($data){
                    return $data->reserveType->name;
                }
            ],
            'code',
            'name:ntext',
            'unit',
            'count',
            'price',
            'total',
            'current_count',
            'current_total',
            //'creator_id',
            //'created_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
