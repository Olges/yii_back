<?php
namespace app\commands;
use app\models\User;
use yii\console\Controller;
class ConsoleApiController extends Controller{
    public function actionAddUser(){
        $user = new User();
        $user->username = 'jhon.a';
        $user->lastname = 'jhon';
        $user->firstname = 'alex';
        $user->access_token = $user->generateAuthKey();
        $user->password_hash = $user->setPassword('hello123');
        $user->created_at = time();
        $user->save();
    }
}