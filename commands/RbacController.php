<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
//        $auth->removeAll();

        $adminPermission = $auth->createPermission('moderatorPermission');
        $adminPermission->description = 'Access full actions';
        $auth->add($adminPermission);

        // add "author" role and give this role the "createPost" permission
        $admin = $auth->createRole('moderator');
        $auth->add($admin);
        $auth->addChild($admin, $adminPermission);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($admin, 2);
    }
}