<?php

namespace app\controllers;

use Yii;
use app\models\Radgroupcheck;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class RadgroupcheckController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
