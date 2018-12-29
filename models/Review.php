<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property int $rev_id id
 * @property int $prod_id foreign key
 * @property int $user_id foreign key
 * @property string $text description
 * @property int $rating 5 star rating
 *
 * @property Product $prod
 * @property User $user
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prod_id', 'user_id', 'text', 'rating'], 'required'],
            [['prod_id', 'user_id', 'rating'], 'integer'],
            [['text'], 'string'],
            [['prod_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['prod_id' => 'prod_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rev_id' => 'id',
            'prod_id' => 'foreign key',
            'user_id' => 'foreign key',
            'text' => 'description',
            'rating' => '5 star rating',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProd()
    {
        return $this->hasOne(Product::className(), ['prod_id' => 'prod_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }
}
