<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 21.07.2021
 * Time: 17:12
 */

namespace app\controllers;


use app\models\Info;
use yii\base\Model;

class InformationController extends AppAdminController
{
    public function actionIndex(){
        $model = Info::findOne(1);

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->setFlash('success', 'Інформацію оновлено');
            return $this->refresh();
        }

        return $this->render('index', compact('model'));
    }
}