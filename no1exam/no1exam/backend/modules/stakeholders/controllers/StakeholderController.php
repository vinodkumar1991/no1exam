<?php
namespace app\modules\stakeholders\controllers;

use yii\web\Controller;
use backend\modules\stakeholders\models\seminaries\Seminary;

class StakeholderController extends Controller
{

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionSeminaries()
    {
        $arrSeminaries = Seminary::getSeminaries();
        $this->render('/seminaries/Seminary', [
            'seminaries' => $arrSeminaries
        ]);
    }
}
