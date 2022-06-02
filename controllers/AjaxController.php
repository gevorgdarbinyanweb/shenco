<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Response;
use app\models\ReserveTypeMaterials;
use app\models\ReserveMetals;
use app\models\ReserveAccessories;
use app\models\Calculator;
use app\models\OrderTypeRelation;
use app\models\OrderTypeRelMaterials;

class AjaxController extends Controller {

    public $enableCsrfValidation = false;

    public function beforeAction($action) {

        if (parent::beforeAction($action)) {
            Yii::$app->getResponse()->format = Response::FORMAT_JSON;
            return true;
        }
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_HTML;
    }

    /**
     * gets reserve type materials
     */
    public function actionGetReserveTypeMaterials()
    {
        $reserveTypeID = Yii::$app->request->post('reserve_type_id');
        $reserveTypeMaterials = ReserveTypeMaterials::find()->where(['reserve_type_id'=>$reserveTypeID])->all();
        return ['success' => true, 'result' => $reserveTypeMaterials];
    }

    /**
     * gets reserve metals
     */
    public function actionGetReserveMetals()
    {
        $reserveMetals = ReserveMetals::find()->all();
        return ['success' => true, 'result' => $reserveMetals];
    }

    /**
     * gets reserve accessories
     */
    public function actionGetReserveAccessories()
    {
        $reserveAccessories = ReserveAccessories::find()->all();
        return ['success' => true, 'result' => $reserveAccessories];
    }

    public function actionCalculate()
    {
        $width = $this->request->post('width');
        $height = $this->request->post('height');
        $calc = new Calculator($width, $height);
        $area = $calc->getArea()->area;
        $workingArea = $calc->getArea()->getWorkingArea()->working_area;
        $otherExpenses = $calc->getArea()->getWorkingArea()->getOtherExpenses()->other_expenses;
        return ['success' => true, 'result' => ['area'=>$area,'working_area'=>$workingArea,'other_expenses'=>$otherExpenses]];
    }

    public function actionCalculateMaterials(){
        $width = $this->request->post('width');
        $height = $this->request->post('height');
        $leafCount = $this->request->post('leaf_count');
        $price = $this->request->post('price');
        $function = $this->request->post('func');
        $prop = $this->request->post('prop');
        $calc = new Calculator($width, $height, $leafCount);
        $count = $calc->$function()->$prop;
        $total = number_format($count * $price, 1, '.', '');
        return ['success' => true, 'result' => ['count'=>$count,'total'=>$total]];
    }

    public function actionSell()
    {
        $id = $this->request->post('id');
        $orderRelList = OrderTypeRelation::find()->where(['order_id'=>$id])->all();
        foreach($orderRelList as $orderRel){
            $orderTypeRelMaterials = OrderTypeRelMaterials::find()->where(['order_type_rel_id'=>$orderRel->id])->all();
            foreach($orderTypeRelMaterials as $orderRelMaterial){
                $reserveTypeMaterial = ReserveTypeMaterials::findOne($orderRelMaterial->reserve_type_material_id);
                $currentCount = ($reserveTypeMaterial->current_count == 0) ? $reserveTypeMaterial->count - $orderRelMaterial->count : $reserveTypeMaterial->current_count - $orderRelMaterial->count;
                $reserveTypeMaterial->current_count = $currentCount;
                $reserveTypeMaterial->current_total = $currentCount * $reserveTypeMaterial->price;
                $reserveTypeMaterial->save();
            }
        }
    } 
}
