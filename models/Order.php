<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 01.07.2021
 * Time: 18:29
 */

namespace app\models;


use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class Order extends ActiveRecord
{
    public static function tableName()
    {
        return "orders";
    }

    public function getOrderProduct(){
        return $this->hasMany(OrderProduct::class, ['order_id' => 'id']);
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function rules()
    {
        return [
            [['name', 'last_name', 'phone', 'email', 'delivery_type'], 'required'],
            ['note', 'trim'],
            [['city', 'department_np', 'street', 'index_ukr', 'house_number', 'apartment_number', 'payment_type'], 'trim'],
            ['email', 'email'],
            [['created_at', 'update_at'], 'safe'],
            [['qty', 'total'], 'integer'],
            [['status', 'consultation'], 'boolean'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => "Ім'я",
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'last_name' => 'Прізвище',
            'status' => 'Статус',
            'created_at' => 'Додано',
            'updated_at' => 'Оновлено',
            'qty' => 'Кількість',
            'total' => 'Сума',
            'delivery_type' => 'Доставка',
            'payment_type' => 'Оплата',
            'note' => 'Коментар',
            'consultation' => 'Консультація',
            'city' => 'Місто',
            'department_np' => 'Відділення "Нова пошта"',
            'street' => 'Вулиця',
            'index_ukr' => 'Поштовий індекс',
            'house_number' => 'Номер будинку',
            'apartment_number' => 'Номер квартири'
        ];
    }

}