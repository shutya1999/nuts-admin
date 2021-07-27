<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "banner_main".
 *
 * @property int $id
 * @property string $desktop
 * @property string $tablet
 * @property string $mobile
 */
class BannerMain extends \yii\db\ActiveRecord
{
    public $file_desktop;
    public $file_tablet;
    public $file_mob;

    public static function tableName()
    {
        return 'banner_main';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['desktop', 'tablet', 'mobile'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'desktop' => "Комп'ютер",
            'tablet' => 'Планшет',
            'mobile' => 'Телефон',
        ];
    }

    public function beforeSave($insert)
    {

        if ($file_desktop = UploadedFile::getInstance($this, 'file_desktop')){
            $this->savePhoto('desktop', $file_desktop);
        }

        if ($file_tablet = UploadedFile::getInstance($this, 'file_tablet')){
            $this->savePhoto('tablet', $file_tablet);
        }

        if ($file_mob = UploadedFile::getInstance($this, 'file_mob')){
            $this->savePhoto('mobile', $file_mob);
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

    public function savePhoto($type, $file){
        $conn_id = $this->connectFTP();
        $dir = "/www/nuts-city.yh-web.space/web/img/banner-main/";

        $file_name = $type . "_" . uniqid() . '.' . $file->extension;

        $destination_file = $dir . '/' . $file_name;
        $source_file = $file->tempName;

        if (!ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY)) {
            \Yii::$app->session->setFlash('error', 'Не вдалося завантажити файл');
        }

        $this[$type] = $file_name;

        ftp_close($conn_id);
    }

    public function imagesLinks($file)
    {
        $conn_id = $this->connectFTP();

        $dir = '/www/nuts-city.yh-web.space/web/img/banner-main/' . $file;

        $images = ftp_mlsd($conn_id, $dir);

        if ($file != null){
            $path[] = Yii::$app->components['siteURL'] . "/img/banner-main/" . $file ;
        }else{
            $path = [];
        }

        return $path;
    }

    public function imagesLinksData($file, $id)
    {
        $linkData = [
            [
                'key' => $id,
                'url' => $file,
            ]
        ];
        return $linkData;
    }

}
