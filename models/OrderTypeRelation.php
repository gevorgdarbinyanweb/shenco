<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_order_type_relation".
 *
 * @property int $id
 * @property int $order_id
 * @property int $type_id
 * @property float $width
 * @property float $height
 * @property float $value
 * @property float $working_area
 * @property float $other_expenses
 * @property float $area
 * @property float $real_price
 * @property int $creator_id
 * @property string $created_date
 *
 * @property OrderTypeRelAccessories[] $orderTypeRelAccessories
 * @property OrderTypeRelMaterials[] $orderTypeRelMaterials
 * @property OrderTypeRelMetals[] $orderTypeRelMetals
 */
class OrderTypeRelation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_order_type_relation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'type_id', 'width', 'height', 'working_area', 'other_expenses', 'area', 'real_price'], 'required'],
            [['order_id', 'type_id','leaf_count','creator_id'], 'integer'],
            [['width', 'height','working_area', 'other_expenses', 'area', 'real_price'], 'number'],
            [['created_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_id' => Yii::t('app', 'Order'),
            'type_id' => Yii::t('app', 'Type'),
            'width' => Yii::t('app', 'Width'),
            'height' => Yii::t('app', 'Height'),
            'leaf_count' => Yii::t('app', 'Leaf Count'),
            'working_area' => Yii::t('app', 'Working area'),
            'other_expenses' => Yii::t('app', 'Other Expenses'),
            'area' => Yii::t('app', 'Area'),
            'real_price' => Yii::t('app', 'Real Price'),
            'creator_id' => Yii::t('app', 'Creator ID'),
            'created_date' => Yii::t('app', 'Created Date'),
        ];
    }

    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }

    /**
     * Gets query for [[OrderTypeRelAccessories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderTypeRelAccessories()
    {
        return $this->hasMany(OrderTypeRelAccessories::className(), ['order_type_rel_id' => 'id']);
    }

    /**
     * Gets query for [[OrderTypeRelMaterials]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderTypeRelMaterials()
    {
        return $this->hasMany(OrderTypeRelMaterials::className(), ['order_type_rel_id' => 'id']);
    }

    /**
     * Gets query for [[OrderTypeRelMetals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderTypeRelMetals()
    {
        return $this->hasMany(OrderTypeRelMetals::className(), ['order_type_rel_id' => 'id']);
    }
}
