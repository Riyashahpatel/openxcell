<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order_managment".
 *
 * @property int $id
 * @property int $product_id
 * @property int $user_id
 * @property string $created_date
 * @property string $updated_date
 */
class OrderManagment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_managment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
          
            [['id', 'product_id', 'user_id'], 'integer'],
             [['created_date', 'updated_date','paymentstatus','paymentId','token','PayerID'], 'safe'],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'user_id' => 'User ID',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }
     public function getProduct() {
        return $this->hasOne(ProductManagment::className(), ['product_id' => 'id']);
    }
}
