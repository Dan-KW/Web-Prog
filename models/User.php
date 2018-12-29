<?php

namespace app\models;

use yii\db\ActiveRecord;



class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    public static function tableName()
    {
        return 'user';
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
      //return static::findOne(['access_token'=> $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
       // return $this->password === $password;
        return \Yii::$app->security->validatePassword($password,$this->password);
    }

    public function generateAuthKey(){
        $this->auth_key = \Yii::$app->security->generateRandomString();
    }


    /**
     * {@inheritdoc}
     */
    /*public function rules()
    {
        return [
            [['fullname', 'email', 'phone', 'region', 'city'], 'required'],
            [['fullname', 'email'], 'string', 'max' => 128],
            [['phone'], 'string', 'max' => 15],
            [['region', 'city'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    /*public function attributeLabels()
    {
        return [
            'user_id' => 'id',
            'fullname' => 'Names',
            'email' => 'email',
            'phone' => 'phone number',
            'region' => 'region',
            'city' => 'city',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getCarts()
    {
        return $this->hasMany(Cart::class, ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getReviews()
    {
        return $this->hasMany(Review::class, ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getWishLists()
    {
        return $this->hasMany(WishList::class(), ['user_id' => 'user_id']);
    }*/
}
