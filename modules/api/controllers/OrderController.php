<?php

namespace app\modules\api\controllers;
use app\modules\api\models\Order;
use yii\web\Response;

class OrderController extends \yii\web\Controller
{
    public $enableCsrfValidation=false;
    public $modelClass = 'app\modules\models\Order';

    public function actionIndex() {


        return $this->render('index');
    }

    public function actionCreateOrder() {
        \Yii::$app->response->format=Response::FORMAT_JSON;
        $order = new Order();
        $order->scenario = Order::SCENARIO_CREATE;
        $order->attributes=\Yii::$app->request->post();

        if($order->validate()) {
            $order->save();
            return array('status' => true, 'data'=>'Order created successfully');
        }else {
            return array('status'=>false, 'data'=>$order->getErrors());
        }
    }

    public function actionGetOrders() {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $order = Order::find()->all();

        if(count($order)>0){
            return array('status'=>true, 'data'=>$order);
        }
        else{
            return array('status' => false, 'data' => 'No orders found');
        }
    }

    public function actionUpdateOrder()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $attributes = \yii::$app->request->post();

        $order = Order::find()->where(['id' => $attributes['ID']])->one();
        if(count($order) > 0)
        {
            $order->attributes = \yii::$app->request->post();
            $order->save();
            return array('status'=> true, 'data'=>'Order was updated Successfully');
        }
        else
        {
            return array('status'=>false, 'data'=>'No Order with that id Found');
        }
    }

    public  function  actionDeleteOrder()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $attributes = \yii::$app->request->post();
        $order = Order::find()->where(['id' => $attributes['id']])->one();
        if(count($order)>0)
        {
            $order->delete();
            return array('status'=>true, 'data'=>'Order deleted Successfully');
        }
        else{
            return array('status'=>false, 'data' =>'No order with such id was found');
        }
    }

}
