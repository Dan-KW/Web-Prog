<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wish_list".
 *
 * @property int $wish_id id
 * @property int $user_id foreign key
 * @property string $arrayprod arrey of products in wishlist
 *
 * @property User $user
 */
class WishList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wish_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'arrayprod'], 'required'],
            [['user_id'], 'integer'],
            [['arrayprod'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'wish_id' => 'id',
            'user_id' => 'foreign key',
            'arrayprod' => 'arrey of products in wishlist',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class(), ['user_id' => 'user_id']);
    }
}
