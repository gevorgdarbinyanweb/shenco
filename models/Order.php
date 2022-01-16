<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_orders".
 *
 * @property int $id
 * @property string $customer
 * @property string $contact
 * @property float $area
 * @property float $real_price
 * @property float $discount
 * @property float $sell_price
 * @property float $deposit
 * @property float $balance
 * @property int $creator_id
 * @property string $created_date
 *
 * @property OrderTypeRelation[] $tblOrderTypeRelations
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer', 'contact', 'area', 'real_price', 'discount', 'sell_price', 'deposit', 'balance'], 'required'],
            [['customer', 'contact','status'], 'string'],
            [['area', 'real_price', 'discount', 'sell_price', 'deposit', 'balance'], 'number'],
            [['creator_id'], 'integer'],
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
            'customer' => Yii::t('app', 'Customer'),
            'contact' => Yii::t('app', 'Contact'),
            'status' => Yii::t('app', 'Status'),
            'area' => Yii::t('app', 'Area'),
            'real_price' => Yii::t('app', 'Real Price'),
            'discount' => Yii::t('app', 'Discount'),
            'sell_price' => Yii::t('app', 'Sell Price'),
            'deposit' => Yii::t('app', 'Deposit'),
            'balance' => Yii::t('app', 'Balance'),
            'creator_id' => Yii::t('app', 'Creator ID'),
            'created_date' => Yii::t('app', 'Created Date'),
        ];
    }

    /**
     * Gets query for [[OrderTypeRelations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderTypeRelations()
    {
        return $this->hasMany(OrderTypeRelation::className(), ['order_id' => 'id']);
    }
}
