<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 09.07.2021
 * Time: 16:20
 */

namespace app\controllers;


use app\models\Category;
use app\models\Order;
use app\models\Product;

class MainController extends AppAdminController
{
    public function actionIndex(){
        $orders = Order::find()->count();
        $products = Product::find()->count();
        $categories = Category::find()->count();

        return $this->render("index", compact(['orders', 'products', 'categories']));
    }
}