<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use http\Url;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $category_id
 * @property string $title
 * @property string $content
 * @property int $price
 * @property int $old_price
 * @property string|null $description
 * @property string|null $keywords
 * @property string $img
 * @property int $is_offer
 * @property float|null $rating
 * @property string|null $option
 * @property int $number_orders
 * @property string $url
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $files;
    public $main_photo;
    public $sec_photo;

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
            [['category_id', 'title', 'content_lil','content_big', 'url', 'price'], 'required'],
            [['category_id', 'price', 'new_price', 'sale', 'is_offer', 'number_orders'], 'integer'],
            [['content_lil', 'content_big', 'option'], 'string'],
            [['rating'], 'number'],
            [['title', 'description', 'keywords', 'img', 'sec_img', 'url'], 'string', 'max' => 255],
            ['new_price', 'default', 'value' => 0],
            ['sale', 'default', 'value' => 0],
            ['rating', 'default', 'value' => 5],
            ['number_orders', 'default', 'value' => 0],
            ['url', 'unique'],
            //[['files'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Категорія ',
            'title' => 'Назва ',
            'content_lil' => 'Короткий опис товару ',
            'content_big' => 'Довгий опис товару ',
            'price' => 'Ціна ',
            'sale' => 'Знижка',
            'new_price' => 'Нова ціна',
            'description' => 'Опис (SEO)',
            'keywords' => 'Ключові слова (SEO)',
            'img' => 'Фото ',
            'is_offer' => 'Спец.пропозиція',
            'rating' => 'Рейтинг',
            'option' => 'Ціни',
            'number_orders' => 'Кількість замовлень',
            'url' => 'Посилання ',
            'main_photo' => 'Головне фото',
            'sec_photo' => 'Додаткове фото',
            'files' => 'Інші фото',
        ];
    }



    public function beforeSave($insert)
    {
        if ($main_photo = UploadedFile::getInstance($this, 'main_photo')){
            $conn_id = $this->connectFTP();

            $dir = '/www/nuts-city.yh-web.space/web/img/product/' . $this->url;

            $file_name = "main.{$main_photo->extension}";
            $destination_file = $dir . '/' . $file_name;
            $source_file = $main_photo->tempName;

            if(!in_array($dir, ftp_nlist($conn_id, '/www/nuts-city.yh-web.space/web/img/product/'))){
                ftp_mkdir($conn_id, $dir);
            }

            if (!ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY)) {
                \Yii::$app->session->setFlash('error', 'Не вдалося завантажити файл');
            }

            $this->img = $file_name;

            ftp_close($conn_id);
        }

        if ($sec_photo = UploadedFile::getInstance($this, 'sec_photo')){
            $conn_id = $this->connectFTP();

            $dir = '/www/nuts-city.yh-web.space/web/img/product/' . $this->url;

            $file_name = "sec_photo.{$sec_photo->extension}";
            $destination_file = $dir . '/' . $file_name;
            $source_file = $sec_photo->tempName;

            if(!in_array($dir, ftp_nlist($conn_id, '/www/nuts-city.yh-web.space/web/img/product/'))){
                ftp_mkdir($conn_id, $dir);
            }

            if (!ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY)) {
                \Yii::$app->session->setFlash('error', 'Не вдалося завантажити файл');
            }

            $this->sec_img = $file_name;

            ftp_close($conn_id);
        }

        if ($files = UploadedFile::getInstances($this, 'files')){
            $conn_id = $this->connectFTP();

            $dir = '/www/nuts-city.yh-web.space/web/img/product/' . $this->url;


            if(!in_array($dir, ftp_nlist($conn_id, '/www/nuts-city.yh-web.space/web/img/product/'))){
                ftp_mkdir($conn_id, $dir);
            }

            //загрузка всех изображений в папку товара
            foreach ($files as $file){
                $file_name = uniqid() . '_' . $file->baseName . '.' . $file->extension;

                $destination_file = $dir . '/' . $file_name;
                $source_file = $file->tempName;

                if (!ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY)) {
                    \Yii::$app->session->setFlash('error', 'Не вдалося завантажити файл');
                }
            }

            // закрытие соединения
            ftp_close($conn_id);

        }

        if ($this->sale != 0){
            $this->new_price = ( $this->price ) - (($this->price * $this->sale) / 100) ;
        }

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function connectFTP(){
        $ftp_server = 'leaf.cityhost.com.ua';
        $ftp_user_name = 'ch2e38aa18';
        $ftp_user_pass = 'a9c3ec2cc8';
        $conn_id = ftp_connect($ftp_server);
        $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

        return $conn_id;
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }


    public function getImagesLinks()
    {
        $model = $this;

        $dir = '/www/nuts-city.yh-web.space/web/img/product/' . $model->url;

        $ftp_server = 'leaf.cityhost.com.ua';
        $ftp_user_name = 'ch2e38aa18';
        $ftp_user_pass = 'a9c3ec2cc8';
        // установка соединения
        $conn_id = ftp_connect($ftp_server);
        // вход с именем пользователя и паролем
        $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

        $images = ftp_mlsd($conn_id, $dir);


        foreach ($images as $image){
            if ($image['name'] != '.' && $image['name'] != ".."){
                $path[] = Yii::$app->components['siteURL'] . "/img/product/" . $model->url . '/' . $image['name'] ;
            }
        }

        if ($path == null){
            $path = [];
        }

        return $path;
    }

    public function getImagesLinksData()
    {
        $model = $this;

        $dir = '/www/nuts-city.yh-web.space/web/img/product/' . $model->url;

        $ftp_server = 'leaf.cityhost.com.ua';
        $ftp_user_name = 'ch2e38aa18';
        $ftp_user_pass = 'a9c3ec2cc8';
        // установка соединения
        $conn_id = ftp_connect($ftp_server);
        // вход с именем пользователя и паролем
        $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

        $images = ftp_mlsd($conn_id, $dir);

        $test = [];


        foreach ($images as $image){
            if ($image['name'] != '.' && $image['name'] != ".."){

                $test[] = [
                    'key' => $image['name'],
                    'url' => $model->url . '/' . $image['name']
                ];
            }
        }

        return $test;

    }
}
