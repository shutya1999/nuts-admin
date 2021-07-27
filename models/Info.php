<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "info".
 *
 * @property int $id
 * @property string $phone1
 * @property string $phone2
 * @property string|null $viber
 * @property string|null $telegram
 * @property string|null $instagram
 * @property string|null $facebook
 * @property string|null $address
 * @property string|null $email
 */
class Info extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone1', 'phone2'], 'required'],
            [['phone1', 'phone2', 'email'], 'string', 'max' => 45],
            [['viber', 'telegram', 'instagram', 'facebook', 'address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone1' => 'Телефон - 1',
            'phone2' => 'Телефон - 2',
            'viber' => 'Viber',
            'telegram' => 'Telegram',
            'instagram' => 'Instagram',
            'facebook' => 'Facebook',
            'address' => 'Адреса',
            'email' => 'E-mail',
        ];
    }
}
