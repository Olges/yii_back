<?php
namespace app\controllers;
use Yii;
use yii\rest\Controller;
class ApiController extends Controller{
    public function actionSayHello(){
        return 'Hello';
    }
}