<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 09.07.2021
 * Time: 16:35
 */

namespace app\controllers;
use Yii;
use app\models\LoginForm;


class AuthController extends AppAdminController
{
    public $layout = "auth";

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            $this->redirect("/");
            //return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $this->redirect("/");
            //return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect("/");
        //return $this->goHome();
    }
}