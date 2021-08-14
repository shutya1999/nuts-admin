<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string|null $auth_key
 * @property string $name
 * @property string|null $surname
 * @property string|null $patronymic
 * @property string $phone
 * @property string|null $delivery_type
 * @property string|null $city
 * @property string|null $department_np
 * @property string|null $street
 * @property string|null $index_ukr
 * @property string|null $house_number
 * @property string|null $apartment_number
 * @property string|null $secret_key
 */
class Clients extends \yii\db\ActiveRecord
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
            [['username', 'password', 'name', 'phone'], 'required'],
            [['username', 'password', 'auth_key', 'city', 'department_np', 'street', 'index_ukr', 'house_number', 'apartment_number', 'secret_key'], 'string', 'max' => 255],
            [['name', 'surname', 'patronymic', 'phone', 'delivery_type'], 'string', 'max' => 45],
            [['username'], 'unique'],
            [['secret_key'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Пошта',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'name' => "Ім'я",
            'surname' => 'Прізвище',
            'patronymic' => 'По батькові',
            'phone' => 'Телефон',
            'delivery_type' => 'Варіант доставки',
            'city' => 'Місто',
            'department_np' => 'Відділення Нової Пошти',
            'street' => 'Вулиця',
            'index_ukr' => 'Поштовий Індекс (Укрпошта)',
            'house_number' => 'Номер будинку',
            'apartment_number' => 'Номер квартири',
            'secret_key' => 'Secret Key',
        ];
    }
}
