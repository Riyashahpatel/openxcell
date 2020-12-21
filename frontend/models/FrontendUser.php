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
 * @property string $created_date
 * @property string $updated_date
 */
class FrontendUser extends \yii\db\ActiveRecord 
{
    /**
     * {@inheritdoc}
     */
    public $rememberMe = true;
     private $_user = false;
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
            [[ 'first_name', 'email', 'password'], 'required'],
          
            ['email','email'],
            ['email','unique'],
            [['password'], 'match', 'pattern' => '((?=.*\\d)(?=.*[A-Z])(?=.*[@#$%!~^&*]).{6,20})', 'message' => 'Password must contain Aphanumeric and special character and should be 6 character long.'],
            [['id'], 'integer'],
            ['rememberMe', 'boolean'],
            [['created_date', 'updated_date'], 'safe'],
            [['first_name', 'last_name', 'email', 'password', 'profile_pic'], 'string', 'max' => 160],
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
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',
            'profile_pic' => 'Profile Pic',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }
      /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
            return Yii::$app->user->login($this->getUser(), $duration);
        }
        
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {

        if ($this->_user === null) {
           p($this->email);
            $this->_user = User::findByUsername($this->email);
        }


        return $this->_user;
    }


}
