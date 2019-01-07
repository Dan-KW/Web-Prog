<?php
/**
 * Created by PhpStorm.
 * User: scorpio
 * Date: 03.01.19
 * Time: 10:01
 */

namespace app\controllers;
use app\models\Category;
use app\models\Product;
use Yii;

class CategoryController extends AppController
{
    public function actionIndex()
    {
        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
        return $this->render('index',compact('hits'));
    }

    public function actionView($cat_id){
        $cat_id = Yii::$app->request->get('cat_id');
        $products = Product::find()->where(['cat_id' => $cat_id])->all();
        return $this->render('view',compact('products'));
    }
}