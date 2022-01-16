<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_order_type_rel_metals".
 *
 * @property int $id
 * @property int $order_type_rel_id
 * @property int $reserve_metal_id
 * @property float $count
 * @property float $price
 * @property int $creator_id
 * @property string $created_date
 *
 * @property OrderTypeRelation $orderTypeRel
 * @property ReserveMetals $reserveMetal
 */
class OrderTypeRelMetals extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_order_type_rel_metals';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_type_rel_id', 'reserve_metal_id', 'count', 'price'], 'required'],
            [['order_type_rel_id', 'reserve_metal_id', 'creator_id'], 'integer'],
            [['count', 'price'], 'number'],
            [['created_date'], 'safe'],
            [['order_type_rel_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderTypeRelation::className(), 'targetAttribute' => ['order_type_rel_id' => 'id']],
            [['reserve_metal_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReserveMetals::className(), 'targetAttribute' => ['reserve_metal_id' => 'id']],
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
            'reserve_metal_id' => Yii::t('app', 'Reserve Metal ID'),
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
     * Gets query for [[ReserveMetal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReserveMetal()
    {
        return $this->hasOne(ReserveMetals::className(), ['id' => 'reserve_metal_id']);
    }
}
