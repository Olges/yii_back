<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $firstname
 * @property string $lastname
 * @property string $password_hash
 * @property string $access_token
 * @property int|null $created_at
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
            [['username', 'firstname', 'lastname', 'password_hash', 'access_token'], 'required'],
            [['created_at'], 'integer'],
            [['username', 'firstname', 'lastname', 'password_hash', 'access_token'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'password_hash' => 'Password Hash',
            'access_token' => 'Access Token',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return string
     * @throws \yii\base\Exception
     * Generate token
     */
    public function generateAuthKey(){
        return Yii::$app->security->generateRandomString(255);
    }

    /**
     * @param $password
     * @return string
     * @throws \yii\base\Exception
     * Generate password
     */
    public function setPassword($password){
        return Yii::$app->security->generatePasswordHash($password);
    }
}
