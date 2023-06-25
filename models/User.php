<?php

namespace app\models;

use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property int $role
 * @property string $password
 * @property string $login
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'password', 'login'], 'required'],
            [['role'], 'integer'],
            [['name', 'password', 'login'], 'string', 'max' => 255],
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
            'role' => 'Role',
            'password' => 'Password',
            'login' => 'Login',
        ];
    }


    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }


    public static function findByUsername($username)
    {
        return self::find()->where(['login' => $username])->one();
    }

    public function validateLogin($attr)
    {
        $user = self::find()->where(['login' => $this->login])->one();

        if ($user !== null){
            $this->addError($attr, 'Incorrect username or password');
        }
    }

    public function beforeSave($insert)
    {
        $this->password = md5($this->password);
        return true;
    }
}
