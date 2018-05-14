<?php
namespace backend\modules\education\models;

use yii\db\ActiveRecord;
use Yii;
use yii\db\Query;

class Subjects extends ActiveRecord
{

    public $level;

    public $stream;

    public static function tableName()
    {
        return 'subjects';
    }

    public function rules()
    {
        return [
            [
                [
                    'board_id',
                    'level',
                    'stream',
                    'group_id',
                    'year',
                    'sem',
                    'name',
                    'status'
                ],
                'required',
                'message' => '{attribute} is required'
            ],
            [
                [
                    'name',
                    'status'
                ],
                'trim'
            ],
            [
                'name',
                'string',
                'min' => 3,
                'max' => 75
            ],
            [
                'name',
                'match',
                'pattern' => '/^[a-zA-Z ]+$/',
                'message' => 'Invalid Subject Name'
            ],
            [
                'name',
                'isValidSubject'
            ],
            [
                [
                    'id',
                    'sync',
                    'created_date'
                ],
                'safe'
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'level' => 'level',
            'stream' => 'stream',
            'board_id' => 'Board',
            'group_id' => 'Group',
            'year' => 'Year',
            'sem' => 'Semester',
            'name' => 'Subject',
            'status' => 'Status'
        ];
    }

    public static function create($arrInputs)
    {
        $intInsert = Yii::$app->db->createCommand()
            ->batchInsert('subjects', [
            'board_id',
            'group_id',
            'year',
            'sem',
            'name',
            'status',
            'sync',
            'created_date'
        ], $arrInputs)
            ->execute();
        return $intInsert;
    }

    public function getDefaults()
    {
        return [
            'status' => 'active',
            'sync' => 'false',
            'created_date' => date('Y-m-d H:i:s')
        ];
    }

    public function isValidSubject($attribute, $params)
    {
        $arrSubject = [];
        if (! empty($this->name)) {
            $arrSubject = self::getSubjects([
                'subject' => $this->name,
                'id' => $this->id,
                'group_id' => $this->group_id,
                'year' => $this->year,
                'sem' => $this->sem,
                'board_id' => $this->board_id
            ]);
        }
        if (! empty($arrSubject)) {
            $this->addError($attribute, 'Subject is already exists');
            return false;
        } else {
            return true;
        }
    }

    public static function getSubjects($arrInputs = [])
    {
        $objQuery = new Query();
        $objQuery->select([
            's.id as subject_id',
            's.board_id',
            's.group_id',
            's.name',
            's.status',
            's.sync',
            's.year',
            's.sem'
        ]);
        $objQuery->from('subjects as s');
        // Subject
        if (isset($arrInputs['subject']) && ! empty($arrInputs['subject'])) {
            $objQuery = $objQuery->andWhere('s.name=:subject', [
                ':subject' => $arrInputs['subject']
            ]);
        }
        // Group
        if (isset($arrInputs['group_id']) && ! empty($arrInputs['group_id'])) {
            $objQuery = $objQuery->andWhere('s.group_id=:groupId', [
                ':groupId' => $arrInputs['group_id']
            ]);
        }
        // Year
        if (isset($arrInputs['year']) && ! empty($arrInputs['year'])) {
            $objQuery = $objQuery->andWhere('s.year=:year', [
                ':year' => $arrInputs['year']
            ]);
        }
        // Semester
        if (isset($arrInputs['sem']) && ! empty($arrInputs['sem'])) {
            $objQuery = $objQuery->andWhere('s.sem=:sem', [
                ':sem' => $arrInputs['sem']
            ]);
        }
        // Board
        if (isset($arrInputs['board_id']) && ! empty($arrInputs['board_id'])) {
            $objQuery = $objQuery->andWhere('s.board_id=:boardId', [
                ':boardId' => $arrInputs['board_id']
            ]);
        }
        // Id
        if (isset($arrInputs['id']) && ! empty($arrInputs['id'])) {
            $objQuery = $objQuery->andWhere('s.id!=:Id', [
                ':Id' => $arrInputs['id']
            ]);
        }
        $arrResponse = $objQuery->all();
        return $arrResponse;
    }

    public static function updateSubject($arrInputs, $arrWhere)
    {
        $objConnection = Yii::$app->db;
        $intUpdate = $objConnection->createCommand()
            ->update('subjects', $arrInputs, $arrWhere)
            ->execute();
        return $intUpdate;
    }
}
