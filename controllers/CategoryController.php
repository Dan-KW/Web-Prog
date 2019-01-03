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


class CategoryController extends AppController
{
    public function actionIndex()
    {
        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
        return $this->render('index',compact('hits'));
    }

    public function actionView($id){
        $id = Yii::$app->request->get('cat_id');
        debug($id);
    }
}