<?php
namespace backend\modules\quiz\models;

use yii\db\ActiveRecord;
use Yii;
use yii\db\Query;

class CompitativeTypeMethods extends ActiveRecord
{

    public static function tableName()
    {
        return 'compitative_methods';
    }

    public function rules()
    {
        return [
            [
                [
                    'compitative_type_name',
                    'name',
                    'status'
                ],
                'required',
                'message' => '{attribute} is required'
            ],
            [
                'name',
                'string',
                'min' => 3,
                'max' => 50
            ],
            [
                'name',
                'match',
                'pattern' => '/^[a-zA-Z0-9 ]+$/',
                'message' => 'Invalid Competitive Method'
            ],
            [
                'name',
                'isValidPair'
            ],
            [
                [
                    'id',
                    'questions_count',
                    'total_levels',
                    'correct_answer_value',
                    'negative_answer_value',
                    'total_players',
                    'total_duration',
                    'is_skip',
                    'sync',
                    'created_date',
                    'created_by',
                    'last_modified_by'
                ],
                'safe'
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'compitative_type_name' => 'Compitative Type',
            'name' => 'Competitive Method'
        ];
    }

    public function create($arrInputs)
    {
        $intInsert = Yii::$app->db->createCommand()
            ->batchInsert('compitative_methods', [
            'compitative_type_name',
            'name',
            'questions_count',
            'total_levels',
            'correct_answer_value',
            'negative_answer_value',
            'total_players',
            'total_duration',
            'is_skip',
            'status',
            'sync',
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
            'sync' => 'false',
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => Yii::$app->session['session_data']['user_id'],
            'last_modified_by' => Yii::$app->session['session_data']['user_id']
        ];
    }

    public function isValidPair($attribute, $params)
    {
        $arrCompetativeMethod = [];
        if (! empty($this->name)) {
            $arrCompetativeMethod = self::getCompetitiveMethods([
                'compitative_type_name' => $this->compitative_type_name,
                'name' => $this->name,
                'id' => $this->id
            ]);
        }
        if (! empty($arrCompetativeMethod)) {
            $this->addError($attribute, 'Competitive method is already exists');
            return false;
        } else {
            return true;
        }
    }

    public static function getCompetitiveMethods($arrInputs = [])
    {
        $objQuery = new Query();
        $objQuery->select([
            'id',
            'compitative_type_name',
            'name',
            'questions_count',
            'total_levels',
            'correct_answer_value',
            'negative_answer_value',
            'total_players',
            'total_duration',
            'is_skip',
            'status',
            'sync'
        ]);
        $objQuery->from('compitative_methods as cm');
        // Competitive Type
        if (isset($arrInputs['compitative_type_name']) && ! empty($arrInputs['compitative_type_name'])) {
            $objQuery = $objQuery->andWhere('cm.compitative_type_name=:competitiveType', [
                ':competitiveType' => $arrInputs['compitative_type_name']
            ]);
        }
        // Id
        if (isset($arrInputs['id']) && ! empty($arrInputs['id'])) {
            $objQuery = $objQuery->andWhere('cm.id!=:Id', [
                ':Id' => $arrInputs['id']
            ]);
        }
        // Compitative Method
        if (isset($arrInputs['name']) && ! empty($arrInputs['name'])) {
            $objQuery = $objQuery->andWhere('cm.name=:name', [
                ':name' => $arrInputs['name']
            ]);
        }
        // Status
        if (isset($arrInputs['status']) && ! empty($arrInputs['status'])) {
            $objQuery = $objQuery->andWhere('cm.status=:status', [
                ':status' => $arrInputs['status']
            ]);
        }
        // Method
        if (isset($arrInputs['method_id']) && ! empty($arrInputs['method_id'])) {
            $objQuery = $objQuery->andWhere('cm.id=:methodId', [
                ':methodId' => $arrInputs['method_id']
            ]);
        }
        $arrResponse = $objQuery->all();
        return $arrResponse;
    }

    public static function updateCompitativeMethod($arrInputs, $arrWhere)
    {
        $objConnection = Yii::$app->db;
        $intUpdate = $objConnection->createCommand()
            ->update('compitative_methods', $arrInputs, $arrWhere)
            ->execute();
        return $intUpdate;
    }
}
