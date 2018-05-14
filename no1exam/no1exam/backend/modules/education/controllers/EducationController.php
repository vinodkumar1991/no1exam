<?php
namespace app\modules\education\controllers;

use yii\web\Controller;
use backend\modules\education\models\Streams;
use backend\modules\education\models\Groups;
use Yii;
use yii\helpers\Json;
use common\components\DataComponent;
use backend\modules\education\models\Boards;
use backend\modules\locations\models\Locations;
use backend\modules\education\models\Subjects;
use yii\helpers\ArrayHelper;

class EducationController extends Controller
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

    public function actionStreams()
    {
        $arrStreams = Streams::getStreams();
        $arrLevels = DataComponent::educationLevels();
        $arrStatus = DataComponent::statuses();
        return $this->render('/Streams', [
            'streams' => $arrStreams,
            'levels' => $arrLevels,
            'statuses' => $arrStatus
        ]);
    }

    public function actionGroups()
    {
        $arrGroups = Groups::getGroups();
        $arrLevels = DataComponent::educationLevels();
        $arrStatus = DataComponent::statuses();
        return $this->render('/Groups', [
            'groups' => $arrGroups,
            'levels' => $arrLevels,
            'statuses' => $arrStatus
        ]);
    }

    public function actionBoards()
    {
        $arrBoards = Boards::getBoards();
        $arrStates = Locations::getLocations([
            'category' => 'state'
        ]);
        $arrStatus = DataComponent::statuses();
        $arrBoardCategories = DataComponent::boardCategories();
        return $this->render('/Boards', [
            'states' => $arrStates,
            'boards' => $arrBoards,
            'board_categories' => $arrBoardCategories,
            'statuses' => $arrStatus
        ]);
    }

    public function actionCreateStream()
    {
        $arrResponse = [];
        $arrInputs = Yii::$app->request->post();
        $arrResponse = ! empty($arrInputs) ? $this->saveStream($arrInputs) : [];
        echo Json::encode($arrResponse);
    }

    private function saveStream($arrInputs)
    {
        $arrResponse = [];
        $objStream = new Streams();
        $arrDefaults = $objStream->getDefaults();
        $arrInputs = array_merge($arrInputs, $arrDefaults);
        $objStream->attributes = $arrInputs;
        if ($objStream->validate()) {
            $arrValidatedInputs = $objStream->getAttributes();
            if (! empty($arrValidatedInputs['id'])) {
                unset($arrValidatedInputs['created_date'], $arrValidatedInputs['created_by'], $arrValidatedInputs['last_modified_date']);
                Streams::updateStream($arrValidatedInputs, [
                    'id' => $arrValidatedInputs['id']
                ]);
                $arrResponse['message'] = 'Stream updated successfully';
            } else {
                $objStream->save();
                $arrResponse['stream_id'] = $objStream->id;
                $arrResponse['message'] = 'Stream created Successfully';
            }
        } else {
            $arrResponse['errors'] = $objStream->errors;
        }
        unset($arrInputs);
        return $arrResponse;
    }

    public function actionGetStreams()
    {
        $strResponse = '<option value="">--Select Stream--</option>';
        $arrInputs = Yii::$app->request->post();
        if (! empty($arrInputs)) {
            $arrStreams = Streams::getStreams($arrInputs);
            if (! empty($arrStreams)) {
                foreach ($arrStreams as $arrStream) {
                    if (isset($arrInputs['selected_stream_id']) && ($arrInputs['selected_stream_id'] == $arrStream['id'])) {
                        $strResponse .= '<option value="' . $arrStream['id'] . '" selected>' . $arrStream['name'] . '</option>';
                    } else {
                        $strResponse .= '<option value="' . $arrStream['id'] . '">' . $arrStream['name'] . '</option>';
                    }
                }
            }
            unset($arrStreams, $arrInputs);
        }
        echo $strResponse;
    }

    public function actionCreateGroup()
    {
        $arrResponse = [];
        $arrInputs = Yii::$app->request->post();
        $arrResponse = ! empty($arrInputs) ? $this->saveGroup($arrInputs) : [];
        echo Json::encode($arrResponse);
    }

    private function saveGroup($arrInputs)
    {
        $arrResponse = [];
        $objGroup = new Groups();
        $arrDefaults = $objGroup->getDefaults();
        $arrInputs = array_merge($arrInputs, $arrDefaults);
        $objGroup->attributes = $arrInputs;
        if ($objGroup->validate()) {
            $arrValidatedInputs = $objGroup->getAttributes();
            if ($arrValidatedInputs['id']) {
                unset($arrValidatedInputs['created_date'], $arrValidatedInputs['last_modified_date']);
                Groups::updateGroup($arrValidatedInputs, [
                    'id' => $arrValidatedInputs['id']
                ]);
                $arrResponse['message'] = 'Group Updated Successfully';
            } else {
                $objGroup->save();
                $arrResponse['group_id'] = $objGroup->id;
                $arrResponse['message'] = 'Group Created Successfully';
            }
        } else {
            $arrResponse['errors'] = $objGroup->errors;
        }
        unset($arrInputs);
        return $arrResponse;
    }

    public function actionCreateBoard()
    {
        $arrResponse = [];
        $arrInputs = Yii::$app->request->post();
        $arrResponse = ! empty($arrInputs) ? $this->saveBoard($arrInputs) : [];
        echo Json::encode($arrResponse);
    }

    private function saveBoard($arrInputs)
    {
        $arrResponse = [];
        $objBoard = new Boards();
        $arrDefaults = $objBoard->getDefaults();
        $arrInputs = array_merge($arrInputs, $arrDefaults);
        $objBoard->attributes = $arrInputs;
        if ($objBoard->validate()) {
            $arrValidatedInputs = $objBoard->getAttributes();
            if (! empty($arrValidatedInputs['id'])) {
                unset($arrValidatedInputs['created_date'], $arrValidatedInputs['created_by'], $arrValidatedInputs['last_modified_date']);
                Boards::updateBoard($arrValidatedInputs, [
                    'id' => $arrValidatedInputs['id']
                ]);
                $arrResponse['message'] = 'Board updated successfully';
            } else {
                $objBoard->save();
                $arrResponse['board_id'] = $objBoard->id;
                $arrResponse['message'] = 'Board created Successfully';
            }
        } else {
            $arrResponse['errors'] = $objBoard->errors;
        }
        unset($arrInputs);
        return $arrResponse;
    }

    public function actionGetBoards()
    {
        $arrBoards = [];
        $arrInputs = Yii::$app->request->post();
        if (! empty($arrInputs)) {
            $arrBoards = Boards::getBoards($arrInputs)[0];
        }
        unset($arrInputs);
        echo Json::encode($arrBoards);
    }

    public function actionGetStream()
    {
        $arrStreams = [];
        $arrInputs = Yii::$app->request->post();
        if (! empty($arrInputs)) {
            $arrStreams = Streams::getStreams($arrInputs)[0];
        }
        unset($arrInputs);
        echo Json::encode($arrStreams);
    }

    public function actionGetGroups()
    {
        $arrGroups = [];
        $arrInputs = Yii::$app->request->post();
        if (! empty($arrInputs)) {
            $arrGroups = Groups::getGroups($arrInputs)[0];
        }
        unset($arrInputs);
        echo Json::encode($arrGroups);
    }

    public function actionSubjects()
    {
        $arrBoards = Boards::getBoards();
        $arrGroups = Groups::getGroups();
        $arrYears = DataComponent::getYears();
        $arrSems = DataComponent::getSems();
        return $this->render('/Subjects', [
            'groups' => $arrGroups,
            'boards' => $arrBoards,
            'years' => $arrYears,
            'sems' => $arrSems
        ]);
    }

    public function actionCreateSubject()
    {
        $arrBoards = Boards::getBoards();
        $arrLevels = DataComponent::educationLevels();
        $arrYears = DataComponent::getYears();
        $arrSems = DataComponent::getSems();
        return $this->render('/CreateSubjects', [
            'boards' => $arrBoards,
            'education_levels' => $arrLevels,
            'years' => $arrYears,
            'sems' => $arrSems
        ]);
    }

    public function actionGetGroupsList()
    {
        $strResponse = '<option value="">--Select Group--</option>';
        $arrInputs = Yii::$app->request->post();
        if (! empty($arrInputs)) {
            $arrGroups = Groups::getGroups($arrInputs);
            if (! empty($arrGroups)) {
                foreach ($arrGroups as $arrGroup) {
                    if (isset($arrInputs['selected_group_id']) && ($arrInputs['selected_group_id'] == $arrGroup['id'])) {
                        $strResponse .= '<option value="' . $arrGroup['id'] . '" selected>' . $arrGroup['name'] . '</option>';
                    } else {
                        $strResponse .= '<option value="' . $arrGroup['id'] . '">' . $arrGroup['name'] . '</option>';
                    }
                }
            }
            unset($arrGroups, $arrInputs);
        }
        echo $strResponse;
    }

    public function actionSaveSubjects()
    {
        $arrResponse = [];
        $arrInputs = Yii::$app->request->post();
        if (! empty($arrInputs)) {
            $arrBoards = isset($arrInputs['board_id']) ? $arrInputs['board_id'] : [];
            $arrSubjects = ! empty($arrInputs['subjects'][0]) ? $arrInputs['subjects'] : [];
            
            $arrSubjectsInfo = [];
            if (! empty($arrBoards) && ! empty($arrSubjects)) {
                foreach ($arrBoards as $key => $val) {
                    foreach ($arrSubjects as $subjectKey => $subjectName) {
                        $arrSubjectsInfo[] = [
                            'board_id' => $val,
                            'level' => $arrInputs['level'],
                            'stream' => $arrInputs['stream'],
                            'group_id' => $arrInputs['group_id'],
                            'year' => $arrInputs['year'],
                            'sem' => $arrInputs['sem'],
                            'name' => $subjectName
                        ];
                    }
                }
                $i = 1;
                foreach ($arrSubjectsInfo as $arrInfo) {
                    $objSubjects = new Subjects();
                    $arrDefaults = $objSubjects->getDefaults();
                    $objSubjects->attributes = array_merge($arrDefaults, $arrInfo);
                    if ($objSubjects->validate()) {
                        $arrValidatedInputs = $objSubjects->getAttributes();
                        unset($arrValidatedInputs['id'], $arrValidatedInputs['last_modified_date']);
                        $arrResponse['new'][] = $arrValidatedInputs;
                    } else {
                        $arrResponse['errors'][$i] = $objSubjects->errors;
                    }
                    $i ++;
                }
                if (! isset($arrResponse['errors'])) {
                    $intInserted = Subjects::create($arrResponse['new']);
                    $arrResponse['inserted_count'] = $intInserted;
                    unset($arrResponse['new']);
                    $arrResponse['message'] = 'Subjects are created successfully';
                }
            } else {
                $arrResponse['errors'][0] = [
                    'board_id' => 'Subjects And Boards Are Required'
                ];
            }
        }
        echo JSON::encode($arrResponse);
    }

    public function actionGetSubjects()
    {
        $arrResponse = [];
        $strResponse = null;
        $intSign = 0;
        $arrInputs = Yii::$app->request->post();
        if (! empty($arrInputs)) {
            $arrBoardSubjects = Subjects::getSubjects($arrInputs);
            // unset($arrInputs['board_id']);
            $arrGroupSubjects = Subjects::getSubjects($arrInputs);
            $arrBoardSubjects = ArrayHelper::map($arrBoardSubjects, 'subject_id', 'name');
            
            if (! empty($arrGroupSubjects)) {
                foreach ($arrGroupSubjects as $arrGSubject) {
                    if (! empty($arrBoardSubjects) && in_array($arrGSubject['name'], $arrBoardSubjects) && 'active' == $arrGSubject['status']) {
                        $strResponse .= '<li><label class="control-label">';
                        $strResponse .= '<input type="checkbox"
                        value="" name="subject_' . $arrGSubject['subject_id'] . '" id="subject_' . $arrGSubject['subject_id'] . '" checked onclick="saveOneMoreSubject(' . $arrGSubject['subject_id'] . ')" />';
                        $strResponse .= $arrGSubject['name'];
                        $strResponse .= '</label></li>';
                        $intSign ++;
                    } else {
                        // $arrGSubject['name'] = str_replace(" ", "-", $arrGSubject['name']);
                        $strResponse .= '<li><label class="control-label">';
                        $strResponse .= '<input type="checkbox"
                        value="" name="subject_' . $arrGSubject['subject_id'] . '" id="subject_' . $arrGSubject['subject_id'] . '" onclick="saveOneMoreSubject(' . $arrGSubject['subject_id'] . ')"/>';
                        $strResponse .= $arrGSubject['name'];
                        $strResponse .= '</label></li>';
                    }
                }
            } else {
                $strResponse = 'Subjects are not available';
            }
            unset($arrInputs, $arrBoardSubjects, $arrGroupSubjects);
            $arrResponse['response'] = $strResponse;
            $arrResponse['sign'] = $intSign;
        }
        echo Json::encode($arrResponse);
    }

    public function actionEditSubjects()
    {
        $arrInputs = Yii::$app->request->get();
        $arrBoards = Boards::getBoards();
        $arrYears = DataComponent::getYears();
        $arrSems = DataComponent::getSems();
        $arrLevels = DataComponent::educationLevels();
        $arrSubjects = Subjects::getSubjects($arrInputs);
        $arrBasic = $arrModifiedSubjects = [];
        if (! empty($arrSubjects)) {
            $arrBasic = [
                'subject_id' => $arrSubjects[0]['subject_id'],
                'board_id' => $arrSubjects[0]['board_id'],
                'year' => $arrSubjects[0]['year'],
                'sem' => $arrSubjects[0]['sem']
            ];
            $arrBasic['group_details'] = Groups::getGroups([
                'group_id' => $arrSubjects[0]['group_id']
            ])[0];
            foreach ($arrSubjects as $arrSubject) {
                $arrModifiedSubjects[] = [
                    'subject_id' => $arrSubject['subject_id'],
                    'name' => $arrSubject['name'],
                    'status' => $arrSubject['status']
                ];
            }
            unset($arrSubjects);
        }
        return $this->render('/EditSubjects', [
            'boards' => $arrBoards,
            'years' => $arrYears,
            'sems' => $arrSems,
            'education_levels' => $arrLevels,
            'basic' => $arrBasic,
            'subject_details' => $arrModifiedSubjects
        ]);
    }

    public function actionUpdateSubjects()
    {
        $arrResponse = [];
        $arrInputs = Yii::$app->request->post();
        if (! empty($arrInputs)) {
            $arrSubjectIds = $arrInputs['subject_ids'];
            $arrSubjectNames = $arrInputs['subject_names'];
            unset($arrInputs['subject_ids'], $arrInputs['subject_names']);
            $arrSubjectInputs = [];
            $i = 0;
            foreach ($arrSubjectNames as $key => $strSubjectName) {
                $i ++;
                $objSubjects = new Subjects();
                $arrDefaults = $objSubjects->getDefaults();
                $arrSubjectInputs = array_merge($arrInputs, [
                    'name' => $strSubjectName,
                    'id' => isset($arrSubjectIds[$key]) ? $arrSubjectIds[$key] : ''
                ], $arrDefaults);
                $objSubjects->attributes = $arrSubjectInputs;
                if ($objSubjects->validate()) {
                    $arrValidatedInputs = $objSubjects->getAttributes();
                    if (empty($arrValidatedInputs['id'])) {
                        unset($arrValidatedInputs['last_modified_date'], $arrValidatedInputs['id']);
                        $arrResponse['insert'][] = $arrValidatedInputs;
                    } else {
                        $arrResponse['updates'][] = $arrValidatedInputs;
                    }
                } else {
                    $arrResponse['errors'][$i] = $objSubjects->errors;
                }
            }
            unset($arrSubjectIds, $arrSubjectNames);
            if (! isset($arrResponse['errors'])) {
                $arrUpdates = $arrResponse['updates'];
                foreach ($arrUpdates as $arrUpdate) {
                    unset($arrUpdate['last_modified_date'], $arrUpdate['created_date']);
                    Subjects::updateSubject($arrUpdate, [
                        'id' => $arrUpdate['id']
                    ]);
                }
                isset($arrResponse['insert']) ? Subjects::create($arrResponse['insert']) : NULL;
                $arrResponse['message'] = 'Subjects Updated Successfully';
            }
            unset($arrResponse['updates']);
        }
        echo Json::encode($arrResponse);
    }

    public function actionUpdateSubject()
    {
        $arrResponse = [];
        $arrInputs = Yii::$app->request->post();
        $arrInputs['status'] = (1 == $arrInputs['is_checked']) ? 'active' : 'inactive';
        unset($arrInputs['is_checked']);
        Subjects::updateSubject($arrInputs, [
            'id' => $arrInputs['id']
        ]);
        $arrResponse['message'] = 'Subject Updated Successfully';
        echo Json::encode($arrResponse);
    }

    public function actionGetSubjectsList()
    {
        $strResponse = '<option value="">--Select Subject--</option>';
        $arrInputs = Yii::$app->request->post();
        $arrSubjects = Subjects::getSubjects($arrInputs);
        if (! empty($arrSubjects)) {
            foreach ($arrSubjects as $arrSubject) {
                $strResponse .= "<option value='" . $arrSubject['subject_id'] . "'>" . $arrSubject['name'] . "</option>";
            }
            unset($arrSubjects, $arrInputs);
        }
        return $strResponse;
    }
}
