<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 12.06.2021
 * Time: 14:40
 */

namespace app\models;


use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii\behaviors\SluggableBehavior;
use yii\helpers\Inflector;

class Category extends ActiveRecord
{
    public $file;

    public static function tableName()
    {
        return "category";
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['is_main'], 'integer'],
            [['is_main'], 'default', 'value' => 1],
            [['name'], 'string', 'max' => 100],
            [['url'], 'string', 'max' => 45],
            [['description', 'keywords', 'img'], 'string', 'max' => 255],
            ['url', 'safe'],
            //[['file'], 'image']
        ];
    }

//    public function behaviors()
//    {
//        return [
//            'slug' => [
//                'class' => 'common\behaviors\Slug',
//                'in_attribute' => 'name',
//                'out_attribute' => 'url',
//                'translit' => true
//            ]
//        ];
//    }

    protected function generateSlug($slugParts)
    {
        return Inflector::slug(implode('-', $slugParts));
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Назва',
            'url' => 'Посилання',
            'description' => 'Опис (SEO)',
            'keywords' => 'Ключові слова (SEO)',
            'img' => 'Зображення',
            'is_main' => 'Показувати на головній?',
            'file' => 'Фото'
        ];
    }

    public function beforeSave($insert)
    {

        if ($file = UploadedFile::getInstance($this, 'file')){
            $file_name = uniqid() . '_' . $file->baseName . '.' . $file->extension;


            $destination_file = '/www/nuts-city.yh-web.space/web/img/index/' . $file_name;
            $source_file = $file->tempName;

            $ftp_server = 'leaf.cityhost.com.ua';
            $ftp_user_name = 'ch2e38aa18';
            $ftp_user_pass = 'a9c3ec2cc8';

            // установка соединения
            $conn_id = ftp_connect($ftp_server);

            // вход с именем пользователя и паролем
            $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);


            if (!ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY)) {
                \Yii::$app->session->setFlash('error', 'Не вдалося завантажити файл');
            }

            $this->img = $file_name;


            // закрытие соединения
            ftp_close($conn_id);

        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

}