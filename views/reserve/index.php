<?php
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-sm-4">
    <div class="thumbnail">
        <div class="caption text-center">
        <div class="position-relative">
            
        </div>
        <h3 id="thumbnail-label">
            <?= Html::a(\Yii::t('app','Reserve Type Materials'), ['/reserve-type-materials/index'], ['target' => '_blank']); ?>
        </h3>
        <div class="thumbnail-description smaller">
            <h5</h5>
        </div>
        </div>
    </div>
    </div>
    <div class="col-sm-4">
    <div class="thumbnail">
        <div class="caption text-center">
        <div class="position-relative">
        </div>
        <h3 id="thumbnail-label"><?= Html::a(\Yii::t('app','Reserve Type'), ['/reserve-type/index'], ['target' => '_blank']); ?></h3>
        <div class="thumbnail-description smaller">
            <h5></h5>
        </div>
        </div>
    </div>
    </div>
    <div class="col-sm-4">
    <div class="thumbnail">
        <div class="caption text-center">
        <div class="position-relative">

        </div>
        <h3 id="thumbnail-label"><?= Html::a(\Yii::t('app','Types'), ['/type/index'], ['target' => '_blank']); ?></h3>
        <h4></h4>
        <div class="thumbnail-description smaller">
            <h5></h5>
        </div>
        </div>
    </div>
    </div>
</div>

<div class="row" style="margin-top:15px;">
    <div class="col-sm-4">
        <div class="thumbnail">
            <div class="caption text-center">
                <div class="position-relative">

                </div>
                <h3 id="thumbnail-label"><?= Html::a(\Yii::t('app','Metal'), ['/reserve-metals/index'], ['target' => '_blank']); ?></h3>
                <h4></h4>
                <div class="thumbnail-description smaller">
                <h5></h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="thumbnail">
            <div class="caption text-center">
                <div class="position-relative">

                </div>
                <h3 id="thumbnail-label"><?= Html::a(\Yii::t('app','Accessories'), ['/reserve-accessories/index'], ['target' => '_blank']); ?></h3>
                <h4></h4>
                <div class="thumbnail-description smaller">
                <h5></h5>
                </div>
            </div>
        </div>
    </div>
</div>