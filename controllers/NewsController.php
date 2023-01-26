<?php

namespace app\controllers;

use app\models\News;
use Yii;
use yii\rest\Controller;

class NewsController extends Controller
{
  /**
   * @return array|\yii\db\ActiveRecord[]
   * this action returns all news that stored in our DB
   */
  public function actionGetNews()
  {
    // SELECT * FROM news
    return News::find()->all();
  }
}