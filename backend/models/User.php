<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $profile_pic
 * @property int $is_admin
 * @property string $created_date
 * @property string $updated_date
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['last_name', 'email', 'password', 'profile_pic'], 'required'],
            [['is_admin'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['first_name', 'last_name', 'email', 'password', 'profile_pic'], 'string', 'max' => 160],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',
            'profile_pic' => 'Profile Pic',
            'is_admin' => 'Is Admin',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }
}
