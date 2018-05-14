<?php
namespace app\modules\notification\controllers;

use yii\web\Controller;
use Yii;
use backend\modules\notification\models\Subjects;

class NotificationController extends Controller
{

    public function beforeAction($action)
    {
        $objSession = Yii::$app->session;
        if (! isset($objSession['session_data'])) {
            $this->redirect(Yii::getAlias('@web') . '/login');
        }
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionSenderIds()
    {
        $arrSenderIds = Subjects::getSenderIds();
        return $this->render('/SenderIds', [
            'sender_ids' => $arrSenderIds
        ]);
    }

    public function actionTemplates()
    {
        $arrTemplates = [];
        return $this->render('/Templates', [
            'templates' => $arrTemplates
        ]);
    }
	
	public function actionCreateTemplate(){
        return $this->render('/CreateTemplate', [
        ]);
	}
}
