<?php
namespace backend\modules\quiz\models;

use yii\db\ActiveRecord;
use Yii;
use yii\db\Query;

class CompetitiveTypes extends ActiveRecord
{

    public static function tableName()
    {
        return 'compitative_types';
    }

    public function rules()
    {
        return [
            [
                [
                    'name',
                    'status'
                ],
                'required',
                'message' => '{attribute} is required'
            ],
            [
                [
                    'name'
                ],
                'trim'
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
                'pattern' => '/^[a-zA-Z ]+$/',
                'message' => 'Invalid Competitive Name'
            ],
            [
                'name',
                'isValidName'
            ],
            [
                [
                    'id',
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
            'id' => 'id',
            'name' => 'Competitive Name'
        ];
    }

    public function create($arrInputs)
    {
        $intInsert = Yii::$app->db->createCommand()
            ->batchInsert('compitative_types', [
            'name',
            'status',
            'sync',
            'created_date',
            'created_by'
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

    public function isValidName($attribute, $params)
    {
        $arrCompetativeName = [];
        if (! empty($this->name)) {
            $arrCompetativeName = self::getCompetitiveTypes([
                'name' => $this->name,
                'id' => $this->id
            ]);
        }
        if (! empty($arrCompetativeName)) {
            $this->addError($attribute, 'Competitive name is already exists');
            return false;
        } else {
            return true;
        }
    }

    public static function getCompetitiveTypes($arrInputs = [])
    {
        $objQuery = new Query();
        $objQuery->select([
            'ct.id',
            'ct.name',
            'ct.status',
            'ct.sync'
        ]);
        $objQuery->from('compitative_types as ct');
        // Competitive Name
        if (isset($arrInputs['name']) && ! empty($arrInputs['name'])) {
            $objQuery = $objQuery->andWhere('ct.name=:competitiveName', [
                ':competitiveName' => $arrInputs['name']
            ]);
        }
        // Id
        if (isset($arrInputs['id']) && ! empty($arrInputs['id'])) {
            $objQuery = $objQuery->andWhere('ct.id!=:Id', [
                ':Id' => $arrInputs['id']
            ]);
        }
        // Competitive Id
        if (isset($arrInputs['competitive_id']) && ! empty($arrInputs['competitive_id'])) {
            $objQuery = $objQuery->andWhere('ct.id=:competitiveId', [
                ':competitiveId' => $arrInputs['competitive_id']
            ]);
        }
        $arrResponse = $objQuery->all();
        return $arrResponse;
    }

    public static function updateCompitativeType($arrInputs, $arrWhere)
    {
        $objConnection = Yii::$app->db;
        $intUpdate = $objConnection->createCommand()
            ->update('compitative_types', $arrInputs, $arrWhere)
            ->execute();
        return $intUpdate;
    }
}
