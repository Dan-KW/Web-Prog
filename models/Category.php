<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $cat_id id
 * @property string $cat_name category name
 * @property string $cat_img image
 * @property int $subcat subcategory number
 * @property string $description description
 *
 * @property Product[] $products
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cat_name', 'cat_img', 'subcat', 'description'], 'required'],
            [['subcat'], 'integer'],
            [['description'], 'string'],
            [['cat_name', 'cat_img'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cat_id' => 'id',
            'cat_name' => 'category name',
            'cat_img' => 'image',
            'subcat' => 'subcategory number',
            'description' => 'description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['cat_id' => 'cat_id']);
    }
}
