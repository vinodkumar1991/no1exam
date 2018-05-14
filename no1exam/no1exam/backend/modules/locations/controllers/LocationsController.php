<?php
namespace app\modules\locations\controllers;

use yii\web\Controller;
use Yii;
use common\components\ExcelComponent;
use yii\helpers\Json;
use backend\modules\locations\models\Locations;

class LocationsController extends Controller
{

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionLocations()
    {
        $arrLocations = Locations::getLocations();
        return $this->render('/locations', [
            'locations' => $arrLocations
        ]);
    }

    public function actionUploadLocations()
    {
        $arrResponse = [];
        $arrFile = $this->uploadFile();
        $objExcelComponent = new ExcelComponent();
        $objExcelComponent->mode = 'import';
        $objExcelComponent->files = [
            'locations' => $arrFile['file_name']
        ];
        $arrLocations = $objExcelComponent->makeImport()['locations'];
        $arrResponse = $this->saveLocations($arrLocations);
        unset($arrLocations, $arrFile);
        echo Json::encode($arrResponse);
    }

    private function uploadFile()
    {
        $arrResponse = [];
        $strUploadPath = Yii::getAlias('@webroot') . '/uploads/' . $_FILES['file']['name'];
        file_exists($strUploadPath) ? unlink($strUploadPath) : NULL;
        $arrResponse['is_upload'] = move_uploaded_file($_FILES['file']['tmp_name'], $strUploadPath);
        $arrResponse['file_name'] = $strUploadPath;
        unset($strUploadPath);
        return $arrResponse;
    }

    private function saveLocations($arrLocations)
    {
        $arrResponse = [];
        if (! empty($arrLocations)) {
            foreach ($arrLocations as $arrLocation) {
                $arrLocationInputs = [];
                $arrLocationInputs = [
                    'category_type' => $arrLocation['location_type'],
                    'country_name' => $arrLocation['country'],
                    'state_name' => $arrLocation['state'],
                    'district_name' => $arrLocation['district'],
                    'mandal_name' => $arrLocation['mandal'],
                    'city_name' => $arrLocation['city'],
                    'village_name' => $arrLocation['village']
                ];
                $objLocations = new Locations();
                $arrDefaults = $objLocations->getDefaults();
                $arrLocationInputs = array_merge($arrLocationInputs, $arrDefaults);
                $objLocations->attributes = $arrLocationInputs;
                if ($objLocations->validate()) {
                    $arrValidatedInputs = $objLocations->getAttributes();
                    unset($arrValidatedInputs['id'], $arrValidatedInputs['last_modified_date']);
                    $arrResponse['new'][] = $arrValidatedInputs;
                } else {
                    $arrResponse['errors'] = $objLocations->errors;
                }
            }
            $arrResponse['inserted_count'] = ! isset($arrResponse['errors']) ? Locations::create($arrResponse['new']) : 0;
            $arrResponse['message'] = 'Locations Uploaded Successfully';
            unset($arrResponse['new'], $arrLocations);
        }
        return $arrResponse;
    }
}
