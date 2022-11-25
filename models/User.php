<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

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
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
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

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::find()->andWhere(['access_token'=>$token])->one();
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->access_token;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
}
