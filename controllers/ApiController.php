<?php
namespace app\controllers;
use app\models\products\Products;
use app\models\products\ProductsCategory;
use Yii;
use yii\rest\Controller;
class ApiController extends Controller{

    public function actionSayHello(){
        return 'Hello';
    }

    public function actionGetCategories(){
        return ProductsCategory::find()->all();
    }

    public function actionAddProduct(){
        $product = new Products();
        if($product->load(Yii::$app->request->post(), '')){
            if($product->validate() && $product->save()) {
                return $product->id;
            }
        }else {
            Yii::$app->response->statusCode = 422;
            return $product->errors;
        }
    }

    public function actionUpdate($product_id){
//        $product = Products::find()->where(['id' => $product_id])->one();
        $product = Products::findOne($product_id);
        if($product->load(Yii::$app->request->post(), '')){
            if($product->validate() && $product->save()) {
                return $product->id;
            }
        }else {
            Yii::$app->response->statusCode = 422;
            return $product->errors;
        }
    }
        public function actionDeleteProduct($id)
        {
            $product = Products::findOne($id);
            if($product->delete()){
                return true;
            }else {
                return $product->errors;
            }
        }
}