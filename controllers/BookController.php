<?php

namespace app\controllers;

use app\models\Book;
use app\models\News;
use Yii;
use yii\rest\Controller;

class BookController extends Controller
{
    /**
     * @return array|\yii\db\ActiveRecord[]
     * this action returns all news that stored in our DB
     */
    public function actionGetBook()
    {
        return Book::find()->all();
    }

    public function actionGetOneBook($id){
        return Book::findOne($id);
    }

    public function actionCreate(){
        $postData = Yii::$app->request->post();
        $book = new Book();
        $book->title = $postData['title'];
        $book->author = $postData["author"];
        $book->sale = $postData["sale"];
        $book->description = $postData["description"];
        return $book->save() ? "success" : "bad request";
    }

}