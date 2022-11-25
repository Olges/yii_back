<?php

namespace app\controllers;

use app\models\products\Products;
use app\models\products\ProductsCategory;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\Controller;

class ApiController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // remove authentication filter
        $auth = $behaviors['authenticator'] = [
            'class' => CompositeAuth::class,
            'authMethods' => [
//                HttpBasicAuth::class,
                HttpBearerAuth::class,
//                QueryParamAuth::class,
            ],
        ];
        unset($behaviors['authenticator']);

        // re-add authentication filter
        $behaviors['authenticator'] = $auth;
        // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)

        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'allow' => true,
                    'actions' => ['say-hello', 'get-user'],
                    'roles' => ['admin', 'moderator'],
                ],
                [
                    'allow' => true,
                    'actions' => ['get-roles'],
                    'roles' => ['admin'],
                ],
            ],
        ];
        return $behaviors;
    }

    public function actionSayHello()
    {
        return 'Hello';
    }

    public function actionGetUsers(){
        return User::findAll();
    }

    public function actionGetCategories()
    {
        return ProductsCategory::find()->all();
    }

    public function actionAddProduct()
    {
        $product = new Products();
        if ($product->load(Yii::$app->request->post(), '')) {
            if ($product->validate() && $product->save()) {
                return $product->id;
            }
        } else {
            Yii::$app->response->statusCode = 422;
            return $product->errors;
        }
    }

    public function actionUpdate($product_id)
    {
//        $product = Products::find()->where(['id' => $product_id])->one();
        $product = Products::findOne($product_id);
        if ($product->load(Yii::$app->request->post(), '')) {
            if ($product->validate() && $product->save()) {
                return $product->id;
            }
        } else {
            Yii::$app->response->statusCode = 422;
            return $product->errors;
        }
    }

    public function actionDeleteProduct($id)
    {
        $product = Products::findOne($id);
        if ($product->delete()) {
            return true;
        } else {
            return $product->errors;
        }
    }
}