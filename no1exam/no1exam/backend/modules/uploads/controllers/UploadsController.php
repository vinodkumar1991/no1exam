<?php
namespace app\modules\uploads\controllers;

use yii\web\Controller;
use common\components\ExcelComponent;
use Yii;
use yii\helpers\ArrayHelper;

class UploadsController extends Controller
{

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionStates()
    {
        $arrFiles = [
            'states' => Yii::getAlias('@webroot') . '/uploads/States.xlsx'
        ];
        $arrStates = $this->response($arrFiles)['states'];
        $arrResponse = $this->validate($arrStates, 'States');
        print_r($arrResponse);
        die();
    }

    public function actionBoards()
    {
        $arrFiles = [
            'boards' => Yii::getAlias('@webroot') . '/uploads/Boards.xlsx'
        ];
        $arrBoards = $this->response($arrFiles)['boards'];
        $arrStates = $this->getData('States');
        $arrStates = ArrayHelper::map($arrStates, 'short_name', 'id');
        foreach ($arrBoards as $arrBoard) {
            $arrBoard['state_id'] = $arrStates[$arrBoard['statecode']];
            $arrModifiedBoards[] = $arrBoard;
        }
        $arrResponse = $this->validate($arrModifiedBoards, 'Boards');
        print_r($arrResponse);
        die();
    }

    public function actionSeminaries()
    {
        $arrFiles = [
            'seminaries' => Yii::getAlias('@webroot') . '/uploads/Seminaries.xlsx'
        ];
        $arrSeminaries = $this->response($arrFiles)['seminaries'];
        // States
        $arrStates = $this->getData('States');
        $arrStates = ArrayHelper::map($arrStates, 'short_name', 'id');
        // Districts
        $arrDistricts = $this->getData('Districts');
        $arrDistricts = ArrayHelper::map($arrDistricts, 'name', 'id');
        // Cities
        $arrCities = $this->getData('Cities');
        $arrCities = ArrayHelper::map($arrCities, 'name', 'id');
        // Boards
        $arrBoards = $this->getData('Boards');
        $arrBoards = ArrayHelper::map($arrBoards, 'name', 'id');
        foreach ($arrSeminaries as $arrSeminary) {
            $arrSeminary['statecode'] = $arrStates[$arrSeminary['statecode']];
            $arrSeminary['district'] = $arrDistricts[$arrSeminary['district']];
            $arrSeminary['city'] = $arrCities[$arrSeminary['city']];
            $arrSeminary['board'] = $arrBoards[$arrSeminary['board']];
            $arrModifiedSeminaries[] = $arrSeminary;
        }
        $arrResponse = $this->validate($arrModifiedSeminaries, 'Seminaries');
        print_r($arrResponse);
        die();
    }

    public function actionStreams()
    {
        $arrFiles = [
            'streams' => Yii::getAlias('@webroot') . '/uploads/Streams.xlsx'
        ];
        $arrStreams = $this->response($arrFiles);
        $arrResponse = $this->validate($arrStreams['streams'], 'Streams');
        print_r($arrResponse);
        die();
    }

    public function actionGroups()
    {
        $arrFiles = [
            'groups' => Yii::getAlias('@webroot') . '/uploads/Groups.xlsx'
        ];
        $arrGroups = $this->response($arrFiles);
        $arrGroups = $arrGroups['groups'];
        $arrStreams = $this->getData('Streams');
        $arrStreams = ArrayHelper::map($arrStreams, 'short_name', 'id');
        foreach ($arrGroups as $arrGroup) {
            $arrGroup['stream_id'] = $arrStreams[$arrGroup['streamcode']];
            $arrModifiedGroups[] = $arrGroup;
        }
        $arrResponse = $this->validate($arrModifiedGroups, 'Groups');
        print_r($arrResponse);
        die();
    }

    public function actionNextRoutes()
    {
        $arrFiles = [
            'nextroutes' => Yii::getAlias('@webroot') . '/uploads/NextRoute.xlsx'
        ];
        $arrNextRoutes = $this->response($arrFiles);
        $arrNextRoutes = $arrNextRoutes['nextroutes'];
        $arrStreams = $this->getData('Streams');
        $arrStreams = ArrayHelper::map($arrStreams, 'short_name', 'id');
        foreach ($arrNextRoutes as $arrNextRoute) {
            $arrNextRoute['parentstream'] = $arrStreams[$arrNextRoute['parentstream']];
            $arrNextRoute['childstream'] = $arrStreams[$arrNextRoute['childstream']];
            $arrNextRoute['suggested'] = ('yes' == $arrNextRoute['suggested']) ? 1 : 2;
            $arrModifiedRoutes[] = $arrNextRoute;
        }
        $arrResponse = $this->validate($arrModifiedRoutes, 'NextRoute');
        print_r($arrResponse);
        die();
    }

    public function actionDistricts()
    {
        $arrFiles = [
            'districts' => Yii::getAlias('@webroot') . '/uploads/Districts.xlsx'
        ];
        $arrDistricts = $this->response($arrFiles);
        $arrDistricts = $arrDistricts['districts'];
        $arrStates = $this->getData('States');
        $arrStates = ArrayHelper::map($arrStates, 'short_name', 'id');
        foreach ($arrDistricts as $arrDistrict) {
            $arrDistrict['statecode'] = $arrStates[$arrDistrict['statecode']];
            $arrModifiedDistricts[] = $arrDistrict;
        }
        $arrResponse = $this->validate($arrModifiedDistricts, 'Districts');
        print_r($arrResponse);
        die();
    }

    public function actionCities()
    {
        $arrFiles = [
            'cities' => Yii::getAlias('@webroot') . '/uploads/Cities.xlsx'
        ];
        $arrCities = $this->response($arrFiles);
        $arrCities = $arrCities['cities'];
        $arrDistricts = $this->getData('Districts');
        $arrDistricts = ArrayHelper::map($arrDistricts, 'name', 'id');
        foreach ($arrCities as $arrCity) {
            $arrCity['district'] = $arrDistricts[$arrCity['district']];
            $arrModifiedCities[] = $arrCity;
        }
        $arrResponse = $this->validate($arrModifiedCities, 'Cities');
        print_r($arrResponse);
        die();
    }

    public function response($strMode, $arrFiles)
    {
        $objExcelComponent = new ExcelComponent();
        $objExcelComponent->mode = $strMode;
        $objExcelComponent->files = $arrFiles;
        switch ($strMode) {
            case 'export':
                
                break;
            default:
                $arrResponse = $objExcelComponent->makeImport();
        }
        return $arrResponse;
    }

    private function validate($arrData, $strClass)
    {
        $arrResponse = [];
        $i = 0;
        $strModel = '\\backend\\models\\' . $strClass;
        foreach ($arrData as $arrEle) {
            $arrEle = $this->modifyKeys($arrEle);
            $objModel = new $strModel();
            $arrEle = array_merge($arrEle, [
                'status' => 1,
                'sync' => 2,
                'created_date' => date('Y-m-d H:i:s')
            ]);
            $objModel->attributes = $arrEle;
            if ($objModel->validate()) {
                $arrValidatedInputs = [];
                $arrValidatedInputs = $objModel->getAttributes();
                unset($arrValidatedInputs['id'], $arrValidatedInputs['last_modified_date']);
                $arrResponse['new'][] = array_values($arrValidatedInputs);
            } else {
                $arrResponse['errors'][$i] = $objModel->errors;
            }
            $i ++;
        }
        $objModel = new $strModel();
        $intInserted = isset($arrResponse['new']) ? $objModel->create($arrResponse['new']) : 0;
        unset($arrResponse['new'], $arrData, $strClass);
        $arrResponse['inserted_count'] = $intInserted;
        return $arrResponse;
    }

    private function keyStore()
    {
        return [
            'shortname' => 'short_name',
            'parentstream' => 'parent_stream',
            'childstream' => 'child_stream',
            'suggested' => 'is_suggested',
            'statecode' => 'state_id',
            'district' => 'district_id',
            'city' => 'city_id',
            'educationtype' => 'education_type',
            'board' => 'board_id',
            'deliverytype' => 'delivery_type',
            'seminary' => 'seminary_id',
            'stream' => 'stream_id',
            'group' => 'group_id'
        ];
    }

    private function modifyKeys($arrData)
    {
        $arrResponse = [];
        $arrKeys = $this->keyStore();
        foreach ($arrData as $strKey => $strValue) {
            isset($arrKeys[$strKey]) ? ($arrResponse[$arrKeys[$strKey]] = $strValue) : ($arrResponse[$strKey] = $strValue);
        }
        unset($arrData, $arrKeys);
        return $arrResponse;
    }

    private function getData($strModel)
    {
        $strModel = '\\backend\\models\\' . $strModel;
        $objModel = new $strModel();
        $objModel = $objModel->find();
        // Add where condition if need
        // For example do filter for streams like get only seconeary education streams
        $objModel = $objModel->asArray();
        $arrResult = $objModel->all();
        unset($strModel);
        return $arrResult;
    }

    public function actionSeminaryStreams()
    {
        $arrFiles = [
            'seminarystreams' => Yii::getAlias('@webroot') . '/uploads/SeminaryStreams.xlsx'
        ];
        $arrSeminaryStreams = $this->response($arrFiles)['seminarystreams'];
        // Seminaries
        $arrSeminaries = $this->getData('Seminaries');
        $arrSeminaries = ArrayHelper::map($arrSeminaries, 'name', 'id');
        // Streams
        $arrStreams = $this->getData('Streams');
        $arrStreams = ArrayHelper::map($arrStreams, 'short_name', 'id');
        // Groups
        $arrGroups = $this->getData('Groups');
        $arrGroups = ArrayHelper::map($arrGroups, 'short_name', 'id');
        foreach ($arrSeminaryStreams as $arrSeminaryStream) {
            $arrSeminaryStream['seminary'] = $arrSeminaries[$arrSeminaryStream['seminary']];
            $arrSeminaryStream['stream'] = $arrStreams[$arrSeminaryStream['stream']];
            $arrSeminaryStream['group'] = $arrGroups[$arrSeminaryStream['group']];
            $arrModifiedSeminaryStreams[] = $arrSeminaryStream;
        }
        $arrResponse = $this->validate($arrModifiedSeminaryStreams, 'SeminaryStreams');
        print_r($arrResponse);
        die();
    }

    public function actionDownloadExcel()
    {}
}
