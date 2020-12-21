<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "category_managment".
 *
 * @property int $id
 * @property string|null $name
 * @property string $created_date
 * @property string $updated_date
 */
class CategoryManagment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_managment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
           
            [['created_date', 'updated_date'], 'safe'],
            [['name'], 'string', 'max' => 160],
           
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
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }
}
