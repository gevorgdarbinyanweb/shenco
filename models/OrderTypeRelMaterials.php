<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_order_type_rel_materials".
 *
 * @property int $id
 * @property int $order_type_rel_id
 * @property int $reserve_type_id
 * @property int $reserve_type_material_id
 * @property float $count
 * @property float $price
 * @property int $creator_id
 * @property string $created_date
 *
 * @property OrderTypeRelation $orderTypeRel
 * @property ReserveType $reserveType
 * @property ReserveTypeMaterials $reserveTypeMaterial
 */
class OrderTypeRelMaterials extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_order_type_rel_materials';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_type_rel_id', 'reserve_type_id', 'reserve_type_material_id', 'count', 'price'], 'required'],
            [['order_type_rel_id', 'reserve_type_id', 'reserve_type_material_id', 'creator_id'], 'integer'],
            [['count', 'price'], 'number'],
            [['created_date'], 'safe'],
            [['reserve_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReserveType::className(), 'targetAttribute' => ['reserve_type_id' => 'id']],
            [['reserve_type_material_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReserveTypeMaterials::className(), 'targetAttribute' => ['reserve_type_material_id' => 'id']],
            [['order_type_rel_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderTypeRelation::className(), 'targetAttribute' => ['order_type_rel_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_type_rel_id' => Yii::t('app', 'Order Type Rel ID'),
            'reserve_type_id' => Yii::t('app', 'Reserve Type ID'),
            'reserve_type_material_id' => Yii::t('app', 'Reserve Type Material ID'),
            'count' => Yii::t('app', 'Count'),
            'price' => Yii::t('app', 'Price'),
            'creator_id' => Yii::t('app', 'Creator ID'),
            'created_date' => Yii::t('app', 'Created Date'),
        ];
    }

    /**
     * Gets query for [[OrderTypeRel]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderTypeRel()
    {
        return $this->hasOne(OrderTypeRelation::className(), ['id' => 'order_type_rel_id']);
    }

    /**
     * Gets query for [[ReserveType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReserveType()
    {
        return $this->hasOne(ReserveType::className(), ['id' => 'reserve_type_id']);
    }

    /**
     * Gets query for [[ReserveTypeMaterial]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReserveTypeMaterial()
    {
        return $this->hasOne(ReserveTypeMaterials::className(), ['id' => 'reserve_type_material_id']);
    }
}
