<?php

namespace app\controllers;

use Yii;
use app\models\Radusergroup;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class RadusergroupController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
