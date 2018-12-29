<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "characteristic".
 *
 * @property int $ch_id id
 * @property int $prod_id foreign key
 * @property string $ch_name name
 * @property string $text text
 *
 * @property Product $prod
 */
class Characteristic extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'characteristic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prod_id', 'ch_name', 'text'], 'required'],
            [['prod_id'], 'integer'],
            [['ch_name'], 'string', 'max' => 128],
            [['text'], 'string', 'max' => 256],
            [['prod_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['prod_id' => 'prod_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ch_id' => 'id',
            'prod_id' => 'foreign key',
            'ch_name' => 'name',
            'text' => 'text',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProd()
    {
        return $this->hasOne(Product::className(), ['prod_id' => 'prod_id']);
    }
}
