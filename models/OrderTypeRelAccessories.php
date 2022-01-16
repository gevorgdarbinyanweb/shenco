<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_order_type_rel_accessories".
 *
 * @property int $id
 * @property int $order_type_rel_id
 * @property int $reserve_accessory_id
 * @property float $count
 * @property float $price
 * @property int $creator_id
 * @property string $created_date
 *
 * @property OrderTypeRelation $orderTypeRel
 * @property ReserveAccessories $reserveAccessory
 */
class OrderTypeRelAccessories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_order_type_rel_accessories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_type_rel_id', 'reserve_accessory_id', 'count', 'price'], 'required'],
            [['order_type_rel_id', 'reserve_accessory_id', 'creator_id'], 'integer'],
            [['count', 'price'], 'number'],
            [['created_date'], 'safe'],
            [['order_type_rel_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderTypeRelation::className(), 'targetAttribute' => ['order_type_rel_id' => 'id']],
            [['reserve_accessory_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReserveAccessories::className(), 'targetAttribute' => ['reserve_accessory_id' => 'id']],
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
            'reserve_accessory_id' => Yii::t('app', 'Reserve Accessory ID'),
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
     * Gets query for [[ReserveAccessory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReserveAccessory()
    {
        return $this->hasOne(ReserveAccessories::className(), ['id' => 'reserve_accessory_id']);
    }
}
