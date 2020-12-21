<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_managment".
 *
 * @property int $id
 * @property string|null $name
 * @property int $category_id
 * @property string|null $product_image
 * @property float $price
 * @property string $created_date
 * @property string|null $updated_date
 */
class ProductManagment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_managment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','category_id', 'price'], 'required'],
            [['category_id'], 'integer'],
            [['price'], 'number'],
            [['created_date', 'updated_date'], 'safe'],
            [['name', 'product_image'], 'string', 'max' => 160],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'category_id' => 'Category Name',
            'product_image' => 'Product Image',
            'price' => 'Price',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }
}
