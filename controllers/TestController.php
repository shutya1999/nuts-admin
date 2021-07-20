<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 09.07.2021
 * Time: 16:52
 */

namespace app\controllers;


use yii\web\Controller;

class TestController extends Controller
{
    public function actionIndex(){
        return $this->render("index");
    }
}