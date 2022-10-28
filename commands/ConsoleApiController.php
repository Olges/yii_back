<?php
namespace app\commands;
use app\models\User;
use yii\console\Controller;
class ConsoleApiController extends Controller{
    public function actionAddUser(){
        $user = new User();
        $user->username = 'zhaksylyk.n';
        $user->lastname = 'Zhaksylyk';
        $user->firstname = 'Nurkhan';
        $user->access_token = $user->generateAuthKey();
        $user->password_hash = $user->setPassword('123456');
        $user->created_at = time();
        $user->save();
    }
}