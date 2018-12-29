<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $prod_id id
 * @property int $cat_id foreign key
 * @property string $prod_name product id
 * @property string $prod_price product price
 * @property string $prod_priceold old price
 * @property string $prod_img image
 * @property string $description description
 *
 * @property Characteristic[] $characteristics
 * @property Category $cat
 * @property Review[] $reviews
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cat_id', 'prod_name', 'prod_price', 'prod_priceold', 'prod_img', 'description'], 'required'],
            [['cat_id'], 'integer'],
            [['description'], 'string'],
            [['prod_name', 'prod_img'], 'string', 'max' => 128],
            [['prod_price', 'prod_priceold'], 'string', 'max' => 10],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['cat_id' => 'cat_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'prod_id' => 'id',
            'cat_id' => 'foreign key',
            'prod_name' => 'product id',
            'prod_price' => 'product price',
            'prod_priceold' => 'old price',
            'prod_img' => 'image',
            'description' => 'description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacteristics()
    {
        return $this->hasMany(Characteristic::class, ['prod_id' => 'prod_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(Category::class, ['cat_id' => 'cat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::class, ['prod_id' => 'prod_id']);
    }
}
