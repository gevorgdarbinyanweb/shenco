<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_reserve_type".
 *
 * @property int $id
 * @property string $name
 * @property int $creator_id
 * @property string $created_date
 *
 * @property OrderTypeRelation[] $orderTypeRelations
 * @property ReserveTypeMaterial[] $reserveTypeMaterials
 */
class ReserveType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_reserve_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['creator_id'], 'integer'],
            [['created_date'], 'safe'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'creator_id' => Yii::t('app', 'Creator ID'),
            'created_date' => Yii::t('app', 'Created Date'),
        ];
    }

    /**
     * Gets query for [[TblOrderTypeRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblOrderTypeRelations()
    {
        return $this->hasMany(OrderTypeRelation::className(), ['reserve_type_id' => 'id']);
    }

    /**
     * Gets query for [[TblReserveTypeMaterials]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblReserveTypeMaterials()
    {
        return $this->hasMany(ReserveTypeMaterials::className(), ['reserve_type_id' => 'id']);
    }
}
