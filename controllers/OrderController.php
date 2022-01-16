<?php

namespace app\controllers;
use Yii;
use app\models\Order;
use app\models\OrderSearch;
use app\models\OrderTypeRelation;
use app\models\OrderTypeRelMaterials;
use app\models\OrderTypeRelMetals;
use app\models\OrderTypeRelAccessories;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'relModel' => OrderTypeRelation::find()->where(['order_id'=>$id])->all()
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();
        $orderTypeRelMetalModel = new OrderTypeRelMetals();
        $orderTypeRelAccessoryModel = new OrderTypeRelAccessories();

        if ($this->request->isPost) {
            $post = $this->request->post();
            $orderPost = $post['Order'];
            $orderTypeRelationPost = isset($post['OrderTypeRelation']) ? $post['OrderTypeRelation'] : [];
            $orderTypeRelMaterialsPost = isset($post['OrderTypeRelMaterials']) ? $post['OrderTypeRelMaterials'] : [];
            $orderTypeRelMetalsPost = isset($post['OrderTypeRelMetals']) ? $post['OrderTypeRelMetals'] : [];
            $orderTypeRelAccessoriesPost = isset($post['OrderTypeRelAccessories']) ? $post['OrderTypeRelAccessories'] : [];
            
            //echo "<pre>";print_r($orderTypeRelationPost);
            //echo "<pre>";print_r($orderTypeRelMaterialsPost);
            //die;
            //echo "<pre>";print_r($orderTypeRelationPost['type_id']);
            //echo "<pre>";print_r(count($orderTypeRelationPost['type_id']));
            
            //echo "<pre>";print_r($orderTypeRelMetalsPost);
            
            // $model->customer = $orderPost['customer'];
            // $model->contact = $orderPost['contact'];
            // $model->area = $orderPost['area'];
            // $model->real_price = $orderPost['real_price'];
            // $model->sell_price = $orderPost['sell_price'];
            // $model->deposit = $orderPost['deposit'];
            // $model->balance = $orderPost['balance'];
            // $model->creator_id = 0;
            // echo "<pre>";print_r($model);
            // $model->save();
            // var_dump($model->errors);
            //die;

            if ($model->load($post) && $model->save()) {
                $orderID = $model->id;
                $relCount = count($orderTypeRelationPost['type_id']);
                $relMaterialCount = count($orderTypeRelMaterialsPost['count']);
                $relMetalCount = !empty($orderTypeRelMetalsPost) ? count($orderTypeRelMetalsPost['count']) : 0;
                $relAccessoryCount = !empty($orderTypeRelAccessoriesPost) ? count($orderTypeRelAccessoriesPost['count']) : 0;
                for($i = 0; $i < $relCount; ++$i) {
                    $orderTypeRelModel = new OrderTypeRelation();
                    $orderTypeRelModel->type_id = $orderTypeRelationPost['type_id'][$i];
                    $orderTypeRelModel->width = $orderTypeRelationPost['width'][$i];
                    $orderTypeRelModel->height = $orderTypeRelationPost['height'][$i];
                    $orderTypeRelModel->leaf_count = $orderTypeRelationPost['leaf_count'][$i];
                    $orderTypeRelModel->working_area = $orderTypeRelationPost['working_area'][$i];
                    $orderTypeRelModel->other_expenses = $orderTypeRelationPost['other_expenses'][$i];
                    $orderTypeRelModel->area = $orderTypeRelationPost['area'][$i];
                    $orderTypeRelModel->real_price = $orderTypeRelationPost['real_price'][$i];
                    $orderTypeRelModel->order_id = $orderID;
                    if($orderTypeRelModel->save()){
                        $orderRelTypeID = $orderTypeRelModel->id;
                        if(!empty($orderTypeRelMaterialsPost)){
                            for($j = 0; $j < $relMaterialCount; ++$j) {
                                if($orderTypeRelationPost['belongs_to'][$i] == $orderTypeRelMaterialsPost['belongs_to'][$j]){
                                    $orderTypeRelMaterialModel = new OrderTypeRelMaterials();
                                    $orderTypeRelMaterialModel->order_type_rel_id = $orderRelTypeID;
                                    $orderTypeRelMaterialModel->reserve_type_id = $orderTypeRelationPost['reserve_type_id'][$i];
                                    $orderTypeRelMaterialModel->reserve_type_material_id = $orderTypeRelMaterialsPost['reserve_type_material_id'][$j];
                                    $orderTypeRelMaterialModel->count = $orderTypeRelMaterialsPost['count'][$j];
                                    $orderTypeRelMaterialModel->price = $orderTypeRelMaterialsPost['price'][$j];
                                    $orderTypeRelMaterialModel->save();
                                }
                            }
                        }

                        if(!empty($orderTypeRelMetalsPost)){
                            for($k = 0; $k < $relMetalCount; ++$k) {
                                if($orderTypeRelationPost['belongs_to'][$i] == $orderTypeRelMetalsPost['belongs_to'][$k]){
                                    $orderTypeRelMetalModel = new OrderTypeRelMetals();
                                    $orderTypeRelMetalModel->order_type_rel_id = $orderRelTypeID;
                                    $orderTypeRelMetalModel->reserve_metal_id = $orderTypeRelMetalsPost['reserve_metal_id'][$k];
                                    $orderTypeRelMetalModel->count = $orderTypeRelMetalsPost['count'][$k];
                                    $orderTypeRelMetalModel->price = $orderTypeRelMetalsPost['price'][$k];
                                    $orderTypeRelMetalModel->save();
                                }
                            }
                        }

                        if(!empty($orderTypeRelAccessoriesPost)){
                            for($z = 0; $z < $relAccessoryCount; ++$z) {
                                if($orderTypeRelationPost['belongs_to'][$i] == $orderTypeRelAccessoriesPost['belongs_to'][$z]){
                                    $orderTypeRelAccessoryModel = new OrderTypeRelAccessories();
                                    $orderTypeRelAccessoryModel->order_type_rel_id = $orderRelTypeID;
                                    $orderTypeRelAccessoryModel->reserve_accessory_id = $orderTypeRelAccessoriesPost['reserve_accessory_id'][$z];
                                    $orderTypeRelAccessoryModel->count = $orderTypeRelAccessoriesPost['count'][$z];
                                    $orderTypeRelAccessoryModel->price = $orderTypeRelAccessoriesPost['price'][$z];
                                    $orderTypeRelAccessoryModel->save();
                                }
                            }
                        }
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $orderTypeRels = OrderTypeRelation::find()->where(['order_id'=>$id])->all();

        $post = $this->request->post();
        $orderTypeRelationPost = isset($post['OrderTypeRelation']) ? $post['OrderTypeRelation'] : [];
        $orderTypeRelMaterialsPost = isset($post['OrderTypeRelMaterials']) ? $post['OrderTypeRelMaterials'] : [];
        $orderTypeRelMetalsPost = isset($post['OrderTypeRelMetals']) ? $post['OrderTypeRelMetals'] : [];
        $orderTypeRelAccessoriesPost = isset($post['OrderTypeRelAccessories']) ? $post['OrderTypeRelAccessories'] : [];

        if ($this->request->isPost) {
            out($orderTypeRelationPost);
            out($orderTypeRelMaterialsPost);die;
            if($model->load($post) && $model->save()){
                $orderID = $model->id;
                $relCount = count($orderTypeRelationPost['type_id']);
                //dump($relCount);
                $relMaterialCount = count($orderTypeRelMaterialsPost['count']);
                //dump($relMaterialCount);
                $relMetalCount = !empty($orderTypeRelMetalsPost) ? count($orderTypeRelMetalsPost['count']) : 0;
                $relAccessoryCount = !empty($orderTypeRelAccessoriesPost) ? count($orderTypeRelAccessoriesPost['count']) : 0;
                for($i = 0; $i < $relCount; ++$i) {
                    if($orderTypeRelationPost['id'][$i] > 0){
                        //update model
                        $orderTypeRelModel = $this->findOrderTypeRelationModel($orderTypeRelationPost['id'][$i]);
                        $orderTypeRelModel->type_id = $orderTypeRelationPost['type_id'][$i];
                        $orderTypeRelModel->width = $orderTypeRelationPost['width'][$i];
                        $orderTypeRelModel->height = $orderTypeRelationPost['height'][$i];
                        $orderTypeRelModel->leaf_count = $orderTypeRelationPost['leaf_count'][$i];
                        $orderTypeRelModel->working_area = $orderTypeRelationPost['working_area'][$i];
                        $orderTypeRelModel->other_expenses = $orderTypeRelationPost['other_expenses'][$i];
                        $orderTypeRelModel->area = $orderTypeRelationPost['area'][$i];
                        $orderTypeRelModel->real_price = $orderTypeRelationPost['real_price'][$i];
                        $orderTypeRelModel->order_id = $orderID;
                    }else{
                        $orderTypeRelModel = new OrderTypeRelation();
                        $orderTypeRelModel->type_id = $orderTypeRelationPost['type_id'][$i];
                        $orderTypeRelModel->width = $orderTypeRelationPost['width'][$i];
                        $orderTypeRelModel->height = $orderTypeRelationPost['height'][$i];
                        $orderTypeRelModel->leaf_count = $orderTypeRelationPost['leaf_count'][$i];
                        $orderTypeRelModel->working_area = $orderTypeRelationPost['working_area'][$i];
                        $orderTypeRelModel->other_expenses = $orderTypeRelationPost['other_expenses'][$i];
                        $orderTypeRelModel->area = $orderTypeRelationPost['area'][$i];
                        $orderTypeRelModel->real_price = $orderTypeRelationPost['real_price'][$i];
                        $orderTypeRelModel->order_id = $orderID;
                    }

                    if($orderTypeRelModel->save()){
                        $orderRelTypeID = $orderTypeRelModel->id;
                        //dump($orderRelTypeID);
                        if(!empty($orderTypeRelMaterialsPost)){
                            for($j = 0; $j < $relMaterialCount; ++$j) {
                                if($orderTypeRelationPost['belongs_to'][$i] == $orderTypeRelMaterialsPost['belongs_to'][$j]){
                                    if($orderTypeRelMaterialsPost['id'][$j] > 0){
                                        //update model
                                        $orderTypeRelMaterialModel = $this->findOrderTypeRelMaterialsModel($orderTypeRelMaterialsPost['id'][$j]);
                                        $orderTypeRelMaterialModel->order_type_rel_id = $orderRelTypeID;
                                        $orderTypeRelMaterialModel->reserve_type_id = $orderTypeRelationPost['reserve_type_id'][$i];
                                        $orderTypeRelMaterialModel->reserve_type_material_id = $orderTypeRelMaterialsPost['reserve_type_material_id'][$j];
                                        $orderTypeRelMaterialModel->count = $orderTypeRelMaterialsPost['count'][$j];
                                        $orderTypeRelMaterialModel->price = $orderTypeRelMaterialsPost['price'][$j];
                                        $orderTypeRelMaterialModel->save();
                                    }else{
                                        // $orderTypeRelMaterialModel = $this->findOrderTypeRelMaterialsModel($orderTypeRelMaterialsPost['id'][$j]);
                                        // if(!empty($orderTypeRelMaterialModel)){
                                        //     // here check condition where id is in db but not in post, then remove that row
                                        //     $this->findOrderTypeRelMaterialsModel($id)->delete();
                                        // }else{
                                            out($orderTypeRelMaterialsPost);
                                            $orderTypeRelMaterialModel = new OrderTypeRelMaterials();
                                            $orderTypeRelMaterialModel->order_type_rel_id = $orderRelTypeID;
                                            $orderTypeRelMaterialModel->reserve_type_id = $orderTypeRelationPost['reserve_type_id'][$i];
                                            $orderTypeRelMaterialModel->reserve_type_material_id = $orderTypeRelMaterialsPost['reserve_type_material_id'][$j];
                                            $orderTypeRelMaterialModel->count = $orderTypeRelMaterialsPost['count'][$j];
                                            $orderTypeRelMaterialModel->price = $orderTypeRelMaterialsPost['price'][$j];
                                            $orderTypeRelMaterialModel->save();
                                        // }
                                    }
                                }
                            }
                        }

                        // if(!empty($orderTypeRelMetalsPost)){
                        //     for($k = 0; $k < $relMetalCount; ++$k) {
                        //         if($orderTypeRelationPost['belongs_to'][$i] == $orderTypeRelMetalsPost['belongs_to'][$k]){
                        //             $orderTypeRelMetalModel = new OrderTypeRelMetals();
                        //             $orderTypeRelMetalModel->order_type_rel_id = $orderRelTypeID;
                        //             $orderTypeRelMetalModel->reserve_metal_id = $orderTypeRelMetalsPost['reserve_metal_id'][$k];
                        //             $orderTypeRelMetalModel->count = $orderTypeRelMetalsPost['count'][$k];
                        //             $orderTypeRelMetalModel->price = $orderTypeRelMetalsPost['price'][$k];
                        //             $orderTypeRelMetalModel->save();
                        //         }
                        //     }
                        // }

                        // if(!empty($orderTypeRelAccessoriesPost)){
                        //     for($z = 0; $z < $relAccessoryCount; ++$z) {
                        //         if($orderTypeRelationPost['belongs_to'][$i] == $orderTypeRelAccessoriesPost['belongs_to'][$z]){
                        //             $orderTypeRelAccessoryModel = new OrderTypeRelAccessories();
                        //             $orderTypeRelAccessoryModel->order_type_rel_id = $orderRelTypeID;
                        //             $orderTypeRelAccessoryModel->reserve_accessory_id = $orderTypeRelAccessoriesPost['reserve_accessory_id'][$z];
                        //             $orderTypeRelAccessoryModel->count = $orderTypeRelAccessoriesPost['count'][$z];
                        //             $orderTypeRelAccessoryModel->price = $orderTypeRelAccessoriesPost['price'][$z];
                        //             $orderTypeRelAccessoryModel->save();
                        //         }
                        //     }
                        // }
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'orderTypeRels' => $orderTypeRels
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Finds the Order Type Relation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findOrderTypeRelationModel($id)
    {
        if (($model = OrderTypeRelation::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Finds the Order Type Relation Material model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findOrderTypeRelMaterialsModel($id)
    {
        if (($model = OrderTypeRelMaterials::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Finds the Order Type Relation Metal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findOrderTypeRelMetalsModel($id)
    {
        if (($model = OrderTypeRelMetals::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    /**
     * Finds the Order Type Relation Accessory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findOrderTypeRelAccessoryModel($id)
    {
        if (($model = OrderTypeRelAccessories::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
