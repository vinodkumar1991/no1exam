<?php
namespace app\modules\quiz\controllers;

use yii\web\Controller;
use Yii;
use yii\helpers\Json;
use common\components\DataComponent;
use backend\modules\quiz\models\CompetitiveTypes;
use backend\modules\quiz\models\CompitativeTypeMethods;
use yii\helpers\ArrayHelper;
use backend\modules\locations\models\Locations;
use backend\modules\education\models\Boards;
use backend\modules\quiz\models\Question;
use backend\modules\quiz\models\QuestionAnswers;

class QuizController extends Controller
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

    public function actionCompetitiveTypes()
    {
        $arrStatuses = DataComponent::getStatuses();
        $arrCompetitiveTypes = CompetitiveTypes::getCompetitiveTypes();
        return $this->render('/CompetitiveTypes', [
            'statuses' => $arrStatuses,
            'competitive_types' => $arrCompetitiveTypes
        ]);
    }

    public function actionSaveCompetitiveType()
    {
        $arrResponse = [];
        $arrInputs = Yii::$app->request->post();
        if (! empty($arrInputs)) {
            $objCompetitiveType = new CompetitiveTypes();
            $arrDefaults = $objCompetitiveType->getDefaults();
            $arrInputs = array_merge($arrInputs, $arrDefaults);
            $objCompetitiveType->attributes = $arrInputs;
            if ($objCompetitiveType->validate()) {
                $arrValidatedInputs = $objCompetitiveType->getAttributes();
                if (empty($arrValidatedInputs['id'])) {
                    $objCompetitiveType->save();
                    $arrResponse['competitive_type_id'] = $objCompetitiveType->id;
                    $arrResponse['message'] = 'Competitive Name Created Successfully.';
                } else {
                    unset($arrValidatedInputs['created_date'], $arrValidatedInputs['last_modified_date'], $arrValidatedInputs['created_by']);
                    $arrResponse['is_updated'] = CompetitiveTypes::updateCompitativeType($arrValidatedInputs, [
                        'id' => $arrValidatedInputs['id']
                    ]);
                    $arrResponse['message'] = 'Competitive Name Updated Successfully.';
                }
                unset($arrValidatedInputs);
            } else {
                $arrResponse['errors'] = $objCompetitiveType->errors;
            }
        }
        echo Json::encode($arrResponse);
    }

    public function actionGetCompetitiveType()
    {
        $arrResponse = [];
        $arrInputs = Yii::$app->request->post();
        $arrResponse = CompetitiveTypes::getCompetitiveTypes($arrInputs)[0];
        unset($arrInputs);
        echo Json::encode($arrResponse);
    }

    public function actionCompetitiveMethods()
    {
        $arrSkip = DataComponent::getSkipOptions();
        $arrStatuses = DataComponent::getStatuses();
        $arrCompetitiveMethods = CompitativeTypeMethods::getCompetitiveMethods();
        return $this->render('/CompetitiveMethods', [
            'competitive_methods' => $arrCompetitiveMethods,
            'statuses' => $arrStatuses,
            'skip_options' => $arrSkip
        ]);
    }

    public function actionGetCompitativeMethods()
    {
        $strResponse = NULL;
        $arrInputs = Yii::$app->request->post();
        $arrCompitativeMethods = DataComponent::getCompetitiveMethods();
        $arrExisted = CompitativeTypeMethods::getCompetitiveMethods($arrInputs);
        $arrExisted = ArrayHelper::map($arrExisted, 'id', 'name');
        if (! empty($arrInputs)) {
            foreach ($arrCompitativeMethods as $strKey => $strValue) {
                if (in_array($strKey, $arrExisted)) {
                    $strResponse .= "<div class='col-md-3'>
                    <label class='checkbox-inline'> <input type='checkbox'
                        value='" . $arrInputs['compitative_type_name'] . '-' . $strKey . "' name='" . $strKey . "' id='" . $strKey . "' onclick=setMethod('" . $strKey . "') checked>";
                    $strResponse .= $strValue;
                    $strResponse .= "</input>
                        </label>
                        </div>";
                } else {
                    $strResponse .= "<div class='col-md-3'>
                    <label class='checkbox-inline'> <input type='checkbox'
                        value='" . $arrInputs['compitative_type_name'] . '-' . $strKey . "' name='" . $strKey . "' id='" . $strKey . "' onclick=setMethod('" . $strKey . "')>";
                    $strResponse .= $strValue;
                    $strResponse .= "</input>
                        </label>
                        </div>";
                }
            }
            unset($arrCompitativeMethods, $arrInputs);
        }
        echo $strResponse;
    }

    public function actionSaveCompitativeMethods()
    {
        $arrResponse = [];
        $arrInputs = Yii::$app->request->post();
        if (! empty($arrInputs)) {
            $objCompitativeTypeMethods = new CompitativeTypeMethods();
            $arrDefaults = $objCompitativeTypeMethods->getDefaults();
            $arrExtract = explode('-', $arrInputs['compitative_method']);
            $arrInputs['compitative_type_name'] = $arrExtract[0];
            $arrInputs['name'] = $arrExtract[1];
            unset($arrExtract, $arrInputs['compitative_method']);
            $arrInputs = array_merge($arrInputs, $arrDefaults);
            $objCompitativeTypeMethods->attributes = $arrInputs;
            if ($objCompitativeTypeMethods->validate()) {
                $objCompitativeTypeMethods->save();
                $arrResponse['compitative_id'] = $objCompitativeTypeMethods->id;
                $arrResponse['message'] = 'Compitative Type Methods added successfully';
            } else {
                $arrInputs['status'] = (1 == $arrInputs['is_checked']) ? 'active' : 'inactive';
                unset($arrInputs['created_date'], $arrInputs['created_by'], $arrInputs['is_checked']);
                $arrResponse['is_updated'] = CompitativeTypeMethods::updateCompitativeMethod($arrInputs, [
                    'name' => $arrInputs['name'],
                    'compitative_type_name' => $arrInputs['compitative_type_name']
                ]);
                $arrResponse['message'] = 'Compitative Type Methods updated successfully';
            }
            unset($arrInputs, $arrDefaults);
        }
        echo Json::encode($arrResponse);
    }

    public function actionCreateQuery()
    {
        $arrYears = DataComponent::getYears();
        $arrSems = DataComponent::getSems();
        $arrQuestionTypes = DataComponent::getQuestionTypes();
        $arrStates = Locations::getLocations([
            'category_type' => 'state'
        ]);
        $arrQuestionLevels = DataComponent::getQuestionLevels();
        $arrEducationLevels = DataComponent::educationLevels();
        $arrBoards = Boards::getBoards();
        return $this->render('/CreateQueryForm', [
            'states' => $arrStates,
            'years' => $arrYears,
            'sems' => $arrSems,
            'question_types' => $arrQuestionTypes,
            'question_levels' => $arrQuestionLevels,
            'education_levels' => $arrEducationLevels,
            'boards' => $arrBoards
        ]);
    }

    public function actionCreateQuizSettings()
    {
        $arrCompetitiveTypes = CompetitiveTypes::getCompetitiveTypes();
        $arrSkipOptions = DataComponent::getSkipOptions();
        $arrStatuses = DataComponent::getStatuses();
        return $this->render('/QuizSettings', [
            'competitive_types' => $arrCompetitiveTypes,
            'statuses' => $arrStatuses,
            'skip_options' => $arrSkipOptions
        ]);
    }

    public function actionSaveSettings()
    {
        $arrResponse = [];
        $arrInputs = Yii::$app->request->post();
        if (! empty($arrInputs)) {
            $arrMethods = $arrInputs['name'];
            unset($arrInputs['name']);
            foreach ($arrMethods as $intKey => $strMethodName) {
                $arrInputs['name'] = $strMethodName;
                $arrInputs['sync'] = false;
                $arrInputs['last_modified_by'] = Yii::$app->session['session_data']['user_id'];
                CompitativeTypeMethods::updateCompitativeMethod($arrInputs, [
                    'name' => $arrInputs['name'],
                    'compitative_type_name' => $arrInputs['compitative_type_name']
                ]);
            }
            unset($arrInputs, $arrMethods);
            $arrResponse['message'] = 'Settings Updated Successfully';
        }
        unset($arrInputs);
        echo Json::encode($arrResponse);
    }

    public function actionGetMethods()
    {
        $strResponse = null;
        $arrInputs = Yii::$app->request->post();
        $arrMethods = CompitativeTypeMethods::getCompetitiveMethods($arrInputs);
        if (! empty($arrMethods)) {
            if (! isset($arrInputs['sign'])) {
                foreach ($arrMethods as $arrMethod) {
                    $strResponse .= '<option value="' . $arrMethod['name'] . '">' . $arrMethod['name'] . '</option>';
                }
            } else {
                $strResponse = Json::encode($arrMethods[0]);
            }
            unset($arrMethods, $arrInputs);
        }
        echo $strResponse;
    }

    public function actionUpdateSettings()
    {
        $arrResponse = [];
        $arrInputs = Yii::$app->request->post();
        CompitativeTypeMethods::updateCompitativeMethod($arrInputs, [
            'id' => $arrInputs['id']
        ]);
        unset($arrInputs);
        $arrResponse['message'] = 'Settings Updated Successfully';
        echo Json::encode($arrResponse);
    }

    public function actionSaveQuery()
    {
        $arrResponse = [];
        $arrInputs = Yii::$app->request->post();
        if (! empty($arrInputs)) {
            // print_r($_FILES);die();
            $objQuestion = new Question();
            $arrDefaults = $objQuestion->getDefaults();
            $arrInputs = array_merge($arrInputs, $arrDefaults);
            $objQuestion->attributes = $arrInputs;
            if ($objQuestion->validate()) {
                $objQuestion->save();
                $intQuestion = $objQuestion->id;
                $arrValidatedInputs = $arrInputs;
                $arrQuestion = [
                    [
                        'question_id' => $intQuestion,
                        'answer' => $arrValidatedInputs['answer_1'],
                        'status' => $arrValidatedInputs['status'],
                        'is_correct_answer' => $arrValidatedInputs['is_answer_1']
                    ],
                    [
                        'question_id' => $intQuestion,
                        'answer' => $arrValidatedInputs['answer_2'],
                        'status' => $arrValidatedInputs['status'],
                        'is_correct_answer' => $arrValidatedInputs['is_answer_2']
                    ],
                    [
                        'question_id' => $intQuestion,
                        'answer' => $arrValidatedInputs['answer_3'],
                        'status' => $arrValidatedInputs['status'],
                        'is_correct_answer' => $arrValidatedInputs['is_answer_3']
                    ],
                    [
                        'question_id' => $intQuestion,
                        'answer' => $arrValidatedInputs['answer_4'],
                        'status' => $arrValidatedInputs['status'],
                        'is_correct_answer' => $arrValidatedInputs['is_answer_4']
                    ]
                ];
                // Question Answers
                QuestionAnswers::create($arrQuestion);
                $arrResponse['message'] = 'Question Created Successfully';
                $arrResponse['question_id'] = $intQuestion;
                unset($arrInputs, $arrValidatedInputs, $arrQuestion);
            } else {
                $arrResponse['errors'] = $objQuestion->errors;
            }
        }
        echo Json::encode($arrResponse);
    }

    public function actionQueries()
    {
        $arrQuestions = Question::getQuestions();
        return $this->render('/Questions', [
            'questions' => $arrQuestions
        ]);
    }

    public function actionGetAnswers()
    {
        $strResponse = null;
        $arrInputs = Yii::$app->request->post();
        $arrAnswers = Question::questionAnswers($arrInputs);
        if (! empty($arrAnswers)) {
            foreach ($arrAnswers as $arrAnswer) {
                if ('true' == $arrAnswer['is_correct_answer']) {
                    $strResponse .= '<p><input type="checkbox" checked/>' . $arrAnswer['answer'] . '</p>';
                } else {
                    $strResponse .= '<p><input type="checkbox"/>' . $arrAnswer['answer'] . '</p>';
                }
            }
            unset($arrAnswers, $arrInputs);
        } else {
            $strResponse = 'No Answer Is Available';
        }
        echo $strResponse;
    }

    public function actionUploadQuestionFile()
    {
        $arrResponse = [];
        $arrInputs = Yii::$app->request->post();
        $strUploadPath = Yii::getAlias('@webroot') . '/uploads/questions/' . $_FILES['file']['name'];
        file_exists($strUploadPath) ? unlink($strUploadPath) : NULL;
        $arrResponse['is_upload'] = move_uploaded_file($_FILES['file']['tmp_name'], $strUploadPath);
        $arrResponse['file_name'] = $_FILES['file']['name'];
        unset($strUploadPath);
        Question::updateQuestion([
            'file_name' => $arrResponse['file_name']
        ], [
            'id' => $arrInputs['question_id']
        ]);
        echo JSON::encode($arrResponse);
    }

    public function actionEditQuestion()
    {
        $arrInputs = Yii::$app->request->get();
        $arrYears = DataComponent::getYears();
        $arrSems = DataComponent::getSems();
        $arrQuestionTypes = DataComponent::getQuestionTypes();
        $arrStates = Locations::getLocations([
            'category_type' => 'state'
        ]);
        $arrQuestionLevels = DataComponent::getQuestionLevels();
        $arrEducationLevels = DataComponent::educationLevels();
        $arrBoards = Boards::getBoards();
        $arrQuestion = Question::questionAnswers([
            'question_id' => $arrInputs['question_id']
        ]);
        print_r($arrQuestion);
        return $this->render('/EditQueryForm', [
            'questions' => $arrQuestion,
            'states' => $arrStates,
            'years' => $arrYears,
            'sems' => $arrSems,
            'question_types' => $arrQuestionTypes,
            'question_levels' => $arrQuestionLevels,
            'education_levels' => $arrEducationLevels,
            'boards' => $arrBoards
        ]);
    }
}
