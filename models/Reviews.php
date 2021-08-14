<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property int|null $product_id
 * @property string $name
 * @property float $rating
 * @property string $text
 * @property string $phone
 * @property string|null $created_at
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id'], 'integer'],
            [['name', 'rating', 'text', 'phone'], 'required'],
            [['rating'], 'number'],
            [['text'], 'string'],
            [['created_at'], 'safe'],
            [['name', 'phone'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Назва товару',
            'name' => "Ім'я",
            'rating' => 'Рейтинг',
            'text' => 'Відгук',
            'phone' => 'Телефон',
            'created_at' => 'Дата',
        ];
    }

    public function getProduct(){
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }
}
