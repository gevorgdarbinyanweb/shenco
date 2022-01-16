<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_reserve_type_materials".
 *
 * @property int $id
 * @property int $reserve_type_id
 * @property int $code
 * @property string $name
 * @property string $unit
 * @property float $count
 * @property float $price
 * @property float $total
 * @property float $current_count
 * @property float $current_total
 * @property int $creator_id
 * @property string $created_date
 *
 * @property ReserveType $reserveType
 */
class ReserveTypeMaterials extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_reserve_type_materials';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reserve_type_id', 'code', 'name', 'unit', 'count', 'price', 'total', 'current_count', 'current_total'], 'required'],
            [['reserve_type_id', 'creator_id'], 'integer'],
            [['name','code'], 'string'],
            [['count', 'price', 'total', 'current_count', 'current_total'], 'number'],
            [['created_date'], 'safe'],
            [['unit'], 'string', 'max' => 10],
            [['reserve_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReserveType::className(), 'targetAttribute' => ['reserve_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'reserve_type_id' => Yii::t('app', 'Reserve Type'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Name'),
            'unit' => Yii::t('app', 'Unit'),
            'count' => Yii::t('app', 'Count'),
            'price' => Yii::t('app', 'Price'),
            'total' => Yii::t('app', 'Total'),
            'current_count' => Yii::t('app', 'Current Count'),
            'current_total' => Yii::t('app', 'Current Total'),
            'creator_id' => Yii::t('app', 'Creator ID'),
            'created_date' => Yii::t('app', 'Created Date'),
        ];
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
}
