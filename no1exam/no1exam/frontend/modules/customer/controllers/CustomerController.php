<?php
namespace app\modules\customer\controllers;

use yii\web\Controller;
use Yii;
use yii\web\Session;
use yii\helpers\Json;

class CustomerController extends Controller
{

    public function beforeAction($action)
    {
        
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionAccount()
    {
        
       return $this->render('/account', []);
    }
}
