<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 27.07.2021
 * Time: 12:46
 */

namespace app\controllers;

use Yii;
use app\models\BannerCatalog;
use yii\data\ActiveDataProvider;
use app\controllers\AppAdminController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;


class BannerCatalogController extends AppAdminController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all BannerCatalog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => BannerCatalog::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BannerCatalog model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BannerCatalog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BannerCatalog();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing BannerCatalog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing BannerCatalog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $slides = $this->findModel($id);

        $dir = '/www/nuts-city.yh-web.space/web/img/banner-catalog/';

        if (ftp_delete($this->connectFTP(), $dir . $slides->desktop) &&
            ftp_delete($this->connectFTP(), $dir . $slides->tablet) &&
            ftp_delete($this->connectFTP(), $dir . $slides->mobile)){
            $this->findModel($id)->delete();
            Yii::$app->session->setFlash('success', '?????????? ????????????????');
        }else{
            Yii::$app->session->setFlash('error', '?????????????? ?????????????? ?????? ?????????????????? ????????????');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the BannerCatalog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BannerCatalog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BannerCatalog::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function connectFTP(){
        $ftp_server = 'leaf.cityhost.com.ua';
        $ftp_user_name = 'ch2e38aa18';
        $ftp_user_pass = 'a9c3ec2cc8';
        $conn_id = ftp_connect($ftp_server);
        $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

        return $conn_id;
    }

    public function delPhoto($file){
        $tmp = '/www/nuts-city.yh-web.space/web/img/banner-catalog/' . $file;
        ftp_delete($this->connectFTP(), $tmp);
    }

    public function actionDelImg($file, $id){
        $dir = '/www/nuts-city.yh-web.space/web/img/banner-catalog/' . $file;

        $conn_id = $this->connectFTP();
        if (ftp_delete($conn_id, $dir)){
            $banner = BannerCatalog::findOne($id);

            if ($banner->desktop == $file){
                $banner->desktop = null;
            }elseif($banner->tablet == $file){
                $banner->tablet = null;
            }elseif($banner->mobile == $file){
                $banner->mobile = null;
            }

            $banner->save();

            return Json::encode('success');
        }else{
            return Json::encode('Error');
        }

    }
}