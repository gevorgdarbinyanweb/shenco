<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = 'Shen Co';
?>

<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4"><?=\Yii::t('app','welcome');?>!</h1>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="thumbnail">
                    <div class="caption text-center">
                        <div class="position-relative">
                        
                        </div>
                        <h3 id="thumbnail-label">
                        <?= Html::a(\Yii::t('app','Orders'), ['/order/index'], []); ?>
                        </h3>
                        <div class="thumbnail-description smaller">
                        <h5</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12" style="margin-top:15px;">
                <div class="thumbnail">
                    <div class="caption text-center">
                        <div class="position-relative">
                        
                        </div>
                        <h3 id="thumbnail-label">
                        <?= Html::a(\Yii::t('app','Reserve'), ['/reserve/index'], []); ?>
                        </h3>
                        <div class="thumbnail-description smaller">
                        <h5</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
