<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_reserve_metals".
 *
 * @property int $id
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
 */
class ReserveMetals extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_reserve_metals';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'unit', 'count', 'price', 'total', 'current_count', 'current_total', 'created_date'], 'required'],
            [['code', 'creator_id'], 'integer'],
            [['name'], 'string'],
            [['count', 'price', 'total', 'current_count', 'current_total'], 'number'],
            [['created_date'], 'safe'],
            [['unit'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
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
}
