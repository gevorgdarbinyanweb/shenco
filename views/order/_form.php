<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use yii\web\JqueryAsset;
use yii\helpers\ArrayHelper;
use app\models\Type;
use app\models\ReserveType;
use app\models\ReserveTypeMaterials;
use app\models\OrderTypeRelMaterials;
use app\models\OrderTypeRelMetals;
use app\models\OrderTypeRelAccessories;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile("@web/css/order.css", ['depends' => [yii\bootstrap4\BootstrapAsset::className()]]);
$this->registerJsFile('@web/js/order/form.js',['position' => View::POS_END, 'depends' => [JqueryAsset::className()]]);

$hiddenTypeList = ArrayHelper::map(Type::find()->all(),'id','name');
$hiddenReserveTypeList = ArrayHelper::map(ReserveType::find()->all(),'id','name');
?>

<div class="order-form">
    <div id="hidden-order-type-container" style="display:none;">
        <div class="card" style="margin-bottom:5px;">
            <div class="card-body">
            <div>
                <i class="fas fa-times btn btn-link remove-order-type text-danger float-right"></i>
            </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for=""><?=Yii::t('app','Type');?></label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?=Html::dropDownList('OrderTypeRelation[type_id][]','',$hiddenTypeList,['prompt'=>Yii::t('app','Type'),'class'=>'form-control order-type-id-class']);?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for=""><?=Yii::t('app','Width');?></label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?=Html::textInput('OrderTypeRelation[width][]','',['class'=>'form-control width-class']);?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for=""><?=Yii::t('app','Height');?></label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?=Html::textInput('OrderTypeRelation[height][]','',['class'=>'form-control height-class']);?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for=""><?=Yii::t('app','Leaf Count');?></label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?=Html::textInput('OrderTypeRelation[leaf_count][]',1,['class'=>'form-control leaf-count-class']);?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-container">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for=""><?=Yii::t('app','Reserve Type');?></label>
                            </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <?=Html::dropDownList('OrderTypeRelation[reserve_type_id][]','',$hiddenReserveTypeList,['prompt'=>Yii::t('app','Reserve Type'),'class'=>'form-control reserve-type-id-class']);?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-container">
                        <table class="table reserve-type-materials-table">
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-metal-container">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <label for=""><?=Yii::t('app','Metal');?></label>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <?=Html::checkbox('OrderTypeRelation[has_metal][]','',['class'=>'has-metal-class']);?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-metal-container">
                        <table class="table reserve-metals-table">

                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-accessories-container">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <label for=""><?=Yii::t('app','Accessories');?></label>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <?=Html::checkbox('OrderTypeRelation[has_accessories][]','',['class'=>'has-accessories-class']);?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-accessories-container">
                        <table class="table reserve-accessories-table">

                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for=""><?=Yii::t('app','Working area');?></label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?=Html::textInput('OrderTypeRelation[working_area][]','',['class'=>'form-control working-area-class']);?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for=""><?=Yii::t('app','Other Expenses');?></label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?=Html::textInput('OrderTypeRelation[other_expenses][]','',['class'=>'form-control other-expenses-class']);?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for=""><?=Yii::t('app','Area');?></label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?=Html::textInput('OrderTypeRelation[area][]','',['class'=>'form-control area-class']);?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for=""><?=Yii::t('app','Real Price');?></label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <?=Html::textInput('OrderTypeRelation[real_price][]','',['class'=>'form-control order-type-real-price-class']);?>
                            <?=Html::hiddenInput('OrderTypeRelation[belongs_to][]','',['class'=>'belongs-to-class']);?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <? //Yii::getVersion();?>
    <?php $form = ActiveForm::begin(); ?>

    <div>
        <i class="fas fa-plus btn btn-link add-order-type"><?=Yii::t('app', 'Add');?></i>
    </div>

    <div id="order-type-container">
        <?php //out($orderTypeRels);?>
        <?php if(!empty($orderTypeRels)): ?>
        <?php $current = 1;?>
        <?php foreach($orderTypeRels as $orderTypeRel):?>
            <?php 
                $orderTypeRelMaterials = OrderTypeRelMaterials::find()->where(['order_type_rel_id'=>$orderTypeRel->id])->all();
                //out($orderTypeRelMaterials);
                $orderTypeRelMaterialRows = [];
                foreach($orderTypeRelMaterials as $orderTypeRelMaterial){
                    $orderTypeRelMaterialRows[$orderTypeRelMaterial['order_type_rel_id']][$orderTypeRelMaterial['reserve_type_material_id']] = $orderTypeRelMaterial;
                }
                $reserveTypeID = $orderTypeRelMaterials[0]['reserve_type_id'];
                $reserveTypeMaterials = ReserveTypeMaterials::find()->where(['reserve_type_id'=>$reserveTypeID])->all();
                //out($reserveTypeMaterials);//die;
            ?>
            <?php 
                //out($orderTypeRelMaterials);
                //out($orderTypeRelMaterialRows);
                //$orderTypeRelMaterials[0]->reserver_type_id;
                // out($orderTypeRelMaterials[0]['reserve_type_id']);
            ?>
            <?php $orderTypeRelMetals = OrderTypeRelMetals::find()->where(['order_type_rel_id'=>$orderTypeRel->id])->all();?>
            <?php $orderTypeRelAccessories = OrderTypeRelAccessories::find()->where(['order_type_rel_id'=>$orderTypeRel->id])->all();?>
            <div class="card" style="margin-bottom:5px;" rel="<?=$current;?>">
                <div class="card-body">
                    <div>
                        <i class="fas fa-times btn btn-link remove-order-type text-danger float-right"></i>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for=""><?=Yii::t('app','Type');?></label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <?=Html::dropDownList('OrderTypeRelation[type_id][]',$orderTypeRel->type_id,$hiddenTypeList,['prompt'=>Yii::t('app','Type'),'class'=>'form-control order-type-id-class']);?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for=""><?=Yii::t('app','Width');?></label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <?=Html::textInput('OrderTypeRelation[width][]',$orderTypeRel->width,['class'=>'form-control width-class']);?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for=""><?=Yii::t('app','Height');?></label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <?=Html::textInput('OrderTypeRelation[height][]',$orderTypeRel->height,['class'=>'form-control height-class']);?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for=""><?=Yii::t('app','Leaf Count');?></label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <?=Html::textInput('OrderTypeRelation[leaf_count][]',$orderTypeRel->leaf_count,['class'=>'form-control leaf-count-class']);?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-container">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for=""><?=Yii::t('app','Reserve Type');?></label>
                                </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <?=Html::dropDownList('OrderTypeRelation[reserve_type_id][]',$orderTypeRelMaterials[0]['reserve_type_id'],$hiddenReserveTypeList,['prompt'=>Yii::t('app','Reserve Type'),'class'=>'form-control reserve-type-id-class']);?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-container" style="height:300px;overflow-y:scroll">
                            <table class="table reserve-type-materials-table">
                                <tr>
                                    <td colspan="8">
                                        <input type="text" class="form-control search-reserve-metal-input" />
                                    </td>
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th>Կոդ</th>
                                    <th>Անվանում</th>
                                    <th>Միավոր</th>
                                    <th> Քանակ</th>
                                    <th> Գին</th>
                                    <th>Արժեք</th>
                                    <th>Անհրաժեշտ քանակ</th>
                                    <th>Ստացված Գին</th>
                                </tr>
                                <?php foreach($reserveTypeMaterials as $reserveTypeMaterial) :?>
                                    <?php $orderTypeRelMaterialRowItem = isset($orderTypeRelMaterialRows[$orderTypeRel->id][$reserveTypeMaterial['id']]) ? $orderTypeRelMaterialRows[$orderTypeRel->id][$reserveTypeMaterial['id']] : []; ?>
                                    <?php //out($reserveTypeMaterial['id'])?>
                                    <?php //out($orderTypeRel);?>
                                    <?php //out($orderTypeRelMaterialRows[12][1]);?>
                                    <?php //out(isset($orderTypeRelMaterialRows[12][2]));?>
                                    <?php //out($orderTypeRelMaterialRows[$orderTypeRel->id][$reserveTypeMaterial['id']]);?>
                                    <?php $checked = isset($orderTypeRelMaterialRows[$orderTypeRel->id][$reserveTypeMaterial['id']]) ? ' checked="checked"' : '';?>
                                    <?php $disabled = !empty($checked) ? '' : 'disabled="disabled"';?>
                                    <?php //$checked = ' checked="checked"';?>
                                    <tr>
                                        <td><input type="checkbox" class="check-material-class" <?=$checked;?> data-price="<?=$reserveTypeMaterial->price;?>" data-function="<?=$reserveTypeMaterial->function;?>" data-prop="<?=$reserveTypeMaterial->prop;?>"></td>
                                        <td><?=$reserveTypeMaterial->code;?></td>
                                        <td><?=$reserveTypeMaterial->name;?></td>
                                        <td><?=$reserveTypeMaterial->unit;?></td>
                                        <td><?=$reserveTypeMaterial->count;?></td>
                                        <td><?=$reserveTypeMaterial->price;?></td>
                                        <td><?=$reserveTypeMaterial->total;?></td>
                                        <td><input name="OrderTypeRelMaterials[count][]" type="text" value="<?=!empty($orderTypeRelMaterialRowItem) ? $orderTypeRelMaterialRowItem['count'] : '';?>" class="form-control material-count-class" <?=$disabled;?>></td>
                                        <td>
                                            <input name="OrderTypeRelMaterials[id][]" type="hidden" class="material-id-class" value="<?=!empty($orderTypeRelMaterialRowItem) ? $orderTypeRelMaterialRowItem['id'] : '';?>" <?=$disabled;?>>
                                            <input name="OrderTypeRelMaterials[price][]" type="text" class="form-control material-price-class" value="<?=!empty($orderTypeRelMaterialRowItem) ? $orderTypeRelMaterialRowItem['price'] : '';?>" <?=$disabled;?>>
                                            <input name="OrderTypeRelMaterials[reserve_type_material_id][]" type="hidden" class="reserve-material-id-class" value="<?=$reserveTypeMaterial['id'];?>" <?=$disabled;?>>
                                            <input name="OrderTypeRelMaterials[belongs_to][]" type="hidden" class="material-belongs_to-class" value="<?=$current;?>" <?=$disabled;?>>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-metal-container">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <label for=""><?=Yii::t('app','Metal');?></label>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <?=Html::checkbox('OrderTypeRelation[has_metal][]','',['class'=>'has-metal-class']);?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-metal-container">
                            <table class="table reserve-metals-table">

                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-accessories-container">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <label for=""><?=Yii::t('app','Accessories');?></label>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <?=Html::checkbox('OrderTypeRelation[has_accessories][]','',['class'=>'has-accessories-class']);?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-accessories-container">
                            <table class="table reserve-accessories-table">

                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for=""><?=Yii::t('app','Working area');?></label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <?=Html::textInput('OrderTypeRelation[working_area][]',$orderTypeRel->working_area,['class'=>'form-control working-area']);?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for=""><?=Yii::t('app','Other Expenses');?></label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <?=Html::textInput('OrderTypeRelation[other_expenses][]',$orderTypeRel->other_expenses,['class'=>'form-control']);?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for=""><?=Yii::t('app','Area');?></label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <?=Html::textInput('OrderTypeRelation[area][]',$orderTypeRel->area,['class'=>'form-control area-class']);?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for=""><?=Yii::t('app','Real Price');?></label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <?=Html::textInput('OrderTypeRelation[real_price][]',$orderTypeRel->real_price,['class'=>'form-control order-type-real-price-class']);?>
                                <?=Html::hiddenInput('OrderTypeRelation[belongs_to][]',$current,['class'=>'belongs-to-class']);?>
                                <?=Html::hiddenInput('OrderTypeRelation[id][]',$orderTypeRel->id,[]);?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $current++;?>
        <?php endforeach;?>
        <?php endif;?>


    </div>

    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="form-group">
                <label for=""><?=Yii::t('app','Customer');?></label>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="form-group">
                <?= $form->field($model, 'customer')->textarea(['rows' => 6])->label(false); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="form-group">
                <label for=""><?=Yii::t('app','Contact');?></label>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="form-group">
                <?= $form->field($model, 'contact')->textarea(['rows' => 6])->label(false); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="form-group">
                <label for=""><?=Yii::t('app','Status');?></label>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="form-group">
                <?= $form->field($model, 'status')->dropDownList(['new'=>Yii::t('app','New'),'in_progress'=>Yii::t('app','In Progress'),'finished'=>Yii::t('app','Finished')],['class'=>'form-control status-class'])->label(false); ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="form-group">
                <label for=""><?=Yii::t('app','Area');?></label>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="form-group">
                <?= $form->field($model, 'area')->textInput()->label(false); ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="form-group">
                <label for=""><?=Yii::t('app','Real Price');?></label>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="form-group">
                <?= $form->field($model, 'real_price')->textInput()->label(false); ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="form-group">
                <label for=""><?=Yii::t('app','Discount');?></label>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="form-group">
                <?= $form->field($model, 'discount')->textInput()->label(false); ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="form-group">
                <label for=""><?=Yii::t('app','Sell Price');?></label>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="form-group">
                <?= $form->field($model, 'sell_price')->textInput()->label(false); ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="form-group">
                <label for=""><?=Yii::t('app','Deposit');?></label>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="form-group">
                <?= $form->field($model, 'deposit')->textInput()->label(false); ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="form-group">
                <label for=""><?=Yii::t('app','Balance');?></label>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="form-group">
                <?= $form->field($model, 'balance')->textInput()->label(false); ?>
            </div>
        </div>
    </div>

    <?= $form->field($model, 'creator_id')->hiddenInput()->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success float-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
