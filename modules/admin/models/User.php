<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id id
 * @property string $fullname Names
 * @property string $email email
 * @property string $phone phone number
 * @property string $region region
 * @property string $city city
 * @property string $username username
 * @property string $password password
 * @property string $auth_key key
 *
 * @property Cart[] $carts
 * @property Order[] $orders
 * @property Review[] $reviews
 * @property WishList[] $wishLists
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
            [['fullname', 'email', 'phone', 'region', 'city', 'username', 'password'], 'required'],
            [['fullname', 'email'], 'string', 'max' => 128],
            [['phone'], 'string', 'max' => 15],
            [['region', 'city', 'username'], 'string', 'max' => 30],
            [['password', 'auth_key'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'fullname' => 'Names',
            'email' => 'email',
            'phone' => 'phone number',
            'region' => 'region',
            'city' => 'city',
            'username' => 'username',
            'password' => 'password',
            'auth_key' => 'key',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWishLists()
    {
        return $this->hasMany(WishList::className(), ['user_id' => 'id']);
    }
}
