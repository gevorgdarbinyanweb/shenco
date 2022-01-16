<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_type".
 *
 * @property int $id
 * @property string $name
 * @property int $creator_id
 * @property string $created_date
 *
 * @property TblOrderTypeRelation[] $tblOrderTypeRelations
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'created_date'], 'required'],
            [['creator_id'], 'integer'],
            [['created_date'], 'safe'],
            [['name'], 'string', 'max' => 20],
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
        return $this->hasMany(TblOrderTypeRelation::className(), ['type_id' => 'id']);
    }
}
