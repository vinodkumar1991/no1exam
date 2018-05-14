<?php
namespace app\modules\events\controllers;

use yii\web\Controller;
use Yii;
use yii\web\Session;
use yii\helpers\Json;

class PlayController extends Controller
{

    public function beforeAction($action)
    {
        // $strAction = Yii::$app->controller->action->id;
        // $objSession = Yii::$app->session;
        // $arrActions = [
        // 'login',
        // 'forgot-password'
        // ];
        // if (! isset($objSession['session_data']) && ! in_array($strAction, $arrActions)) {
        // $this->redirect(Yii::getAlias('@web') . '/login');
        // }
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionPlay()
    {
        return $this->render('/play/home', []);
    }
}
