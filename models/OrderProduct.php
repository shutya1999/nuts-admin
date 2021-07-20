<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_product".
 *
 * @property int $id
 * @property int|null $order_id
 * @property int|null $product_id
 * @property string|null $title
 * @property int|null $volume
 * @property int|null $price
 * @property int|null $qty
 * @property string|null $total
 * @property string|null $volume_type
 */
class OrderProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_product';
    }

    public function getOrderProduct(){
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'volume', 'price', 'qty'], 'integer'],
            [['title', 'total'], 'string', 'max' => 255],
            [['volume_type'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'product_id' => 'Product ID',
            'title' => 'Title',
            'volume' => 'Volume',
            'price' => 'Price',
            'qty' => 'Qty',
            'total' => 'Total',
            'volume_type' => 'Volume Type',
        ];
    }
}
