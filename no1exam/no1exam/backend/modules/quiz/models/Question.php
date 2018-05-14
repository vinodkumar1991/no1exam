<?php
namespace backend\modules\quiz\models;

use yii\db\ActiveRecord;
use Yii;
use yii\db\Query;

class Question extends ActiveRecord
{

    public $education_level;

    public $stream;

    public $board_id;

    public $group;

    public $year;

    public $sem;

    public $answer_1;

    public $answer_2;

    public $answer_3;

    public $answer_4;

    public $is_answer_1;

    public $is_answer_2;

    public $is_answer_3;

    public $is_answer_4;

    public static function tableName()
    {
        return 'questions';
    }

    public function rules()
    {
        return [
            [
                [
                    'question_type',
                    'question_level',
                    'subject_id',
                    'question',
                    'status',
                    'education_level',
                    'stream',
                    'board_id',
                    'group',
                    'year',
                    'sem',
                    'answer_1',
                    'answer_2',
                    'answer_3',
                    'answer_4',
                    'is_answer_1',
                    'is_answer_2',
                    'is_answer_3',
                    'is_answer_4'
                ],
                'required',
                'message' => '{attribute} is required'
            ],
            [
                [
                    'question'
                ],
                'trim'
            ],
            [
                [
                    'id',
                    'file_name',
                    'created_date',
                    'created_by',
                    'last_modified_by'
                ],
                'safe'
            ],
            [
                [
                    'is_answer_1',
                    'is_answer_2',
                    'is_answer_3',
                    'is_answer_4'
                ],
                'isValidAnswer'
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'question_type' => 'Question Type',
            'question_level' => 'Question Level',
            'subject_id' => 'Subject',
            'question' => 'Question',
            'file_name' => 'File Name',
            'status' => 'Status',
            'answer' => 'Answer'
        ];
    }

    public static function create($arrInputs)
    {
        $intInsert = Yii::$app->db->createCommand()
            ->batchInsert('questions', [
            'question_type',
            'question_level',
            'subject_id',
            'question',
            'file_name',
            'status',
            'created_date',
            'created_by',
            'last_modified_by'
        ], $arrInputs)
            ->execute();
        return $intInsert;
    }

    public function getDefaults()
    {
        return [
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => Yii::$app->session['session_data']['user_id'],
            'last_modified_by' => Yii::$app->session['session_data']['user_id']
        ];
    }

    public static function getQuestions($arrInputs = [])
    {
        $objQuery = new Query();
        $objQuery->select([
            'q.id',
            'q.question_type',
            'q.question_level',
            'q.subject_id',
            'q.question',
            'q.file_name',
            'q.status',
            // 'qa.answer',
            // 'qa.status as answer_status',
            // 'qa.is_correct_answer',
            'b.state_name',
            'b.category as board_category',
            'b.name as board_name',
            'g.name as group_name',
            'sm.category as education_level',
            'sm.name as stream_name',
            's.year',
            's.sem',
            's.name as subject_name'
        ]);
        $objQuery->from('questions as q');
        // $objQuery->innerJoin('question_answers as qa', 'qa.question_id = q.id');
        $objQuery->innerJoin('subjects as s', 's.id = q.subject_id');
        $objQuery->innerJoin('boards as b', 'b.id = s.board_id');
        $objQuery->innerJoin('groups as g', 'g.id = s.group_id');
        $objQuery->innerJoin('streams as sm', 'sm.id = g.stream_id');
        // Question
        if (isset($arrInputs['question_id']) && ! empty($arrInputs['question_id'])) {
            $objQuery = $objQuery->andWhere('q.id=:questionId', [
                ':questionId' => $arrInputs['question_id']
            ]);
        }
        $arrResponse = $objQuery->all();
        return $arrResponse;
    }

    public static function updateQuestion($arrInputs, $arrWhere)
    {
        $objConnection = Yii::$app->db;
        $intUpdate = $objConnection->createCommand()
            ->update('questions', $arrInputs, $arrWhere)
            ->execute();
        return $intUpdate;
    }

    public function isValidAnswer($attribute, $params)
    {
        if ("false" == $this->is_answer_1 && "false" == $this->is_answer_2 && "false" == $this->is_answer_3 && "false" == $this->is_answer_4) {
            $this->addError('answer_1', 'Check at least one correct answer');
            return false;
        } else {
            return true;
        }
    }

    public static function questionAnswers($arrInputs)
    {
        $objQuery = new Query();
        $objQuery->select([
            'qa.answer',
            'q.question',
            'qa.is_correct_answer',
            'qa.status',
            'qa.id as answer_id',
            'q.id as question_id',
            'q.question_type',
            'q.question_level',
            'q.subject_id',
            'q.file_name',
            'q.status as question_status',
            'b.state_name',
            'b.category as board_category',
            'b.name as board_name',
            'g.name as group_name',
            'sm.category as education_level',
            'sm.name as stream_name',
            's.year',
            's.sem',
            's.name as subject_name'
        ]);
        $objQuery->from('questions as q');
        $objQuery->innerJoin('question_answers as qa', 'qa.question_id = q.id');
        $objQuery->innerJoin('subjects as s', 's.id = q.subject_id');
        $objQuery->innerJoin('boards as b', 'b.id = s.board_id');
        $objQuery->innerJoin('groups as g', 'g.id = s.group_id');
        $objQuery->innerJoin('streams as sm', 'sm.id = g.stream_id');
        // Question
        if (isset($arrInputs['question_id']) && ! empty($arrInputs['question_id'])) {
            $objQuery = $objQuery->andWhere('q.id=:questionId', [
                ':questionId' => $arrInputs['question_id']
            ]);
        }
        $arrResponse = $objQuery->all();
        return $arrResponse;
    }
}
 