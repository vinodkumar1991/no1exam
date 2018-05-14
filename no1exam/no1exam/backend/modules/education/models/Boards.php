<?php
namespace backend\modules\education\models;

use yii\db\ActiveRecord;
use Yii;
use yii\db\Query;

class Boards extends ActiveRecord
{

    public static function tableName()
    {
        return 'boards';
    }

    public function rules()
    {
        return [
            [
                [
                    'state_name',
                    'category',
                    'name',
                    // 'certificate',
                    'status'
                ],
                'required',
                'message' => '{attribute} is required'
            ],
            [
                [
                    'name',
                    // 'certificate',
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
                'message' => 'Invalid Board Name'
            ],
            // [
            // 'certificate',
            // 'string',
            // 'min' => 2,
            // 'max' => 5
            // ],
            // [
            // 'certificate',
            // 'match',
            // 'pattern' => '/^[a-zA-Z0-9]+$/',
            // 'message' => 'Invalid Certificate Name'
            // ],
            [
                'name',
                'isValidName'
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
            'state_name' => 'State',
            'category' => 'Board Category',
            'name' => 'Board Name'
            // 'certificate' => 'Board Certificate'
        ];
    }

    public function create($arrInputs)
    {
        $intInsert = Yii::$app->db->createCommand()
            ->batchInsert('boards', [
            'state_name',
            'category',
            'name',
            // 'certificate',
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
            'sync' => 'false',
            'created_date' => date('Y-m-d H:i:s'),
            'last_modified_by' => Yii::$app->session['session_data']['user_id']
        ];
    }

    public function isValidName($attribute, $params)
    {
        $arrBoard = [];
        if (! empty($this->name)) {
            $arrBoard = self::getBoards([
                'board_name' => $this->name,
                'category' => $this->category,
                'id' => $this->id
            ]);
        }
        if (! empty($arrBoard)) {
            $this->addError($attribute, 'Board name is already exists');
            return false;
        } else {
            return true;
        }
    }

    public static function getBoards($arrInputs = [])
    {
        $objQuery = new Query();
        $objQuery->select([
            'b.id',
            'b.state_name',
            'b.category',
            'b.name',
            // 'b.certificate',
            'b.status',
            'b.sync'
        ]);
        $objQuery->from('boards as b');
        // Board Name
        if (isset($arrInputs['board_name']) && ! empty($arrInputs['board_name'])) {
            $objQuery = $objQuery->andWhere('b.name=:boardName', [
                ':boardName' => $arrInputs['board_name']
            ]);
        }
        // Board Category
        if (isset($arrInputs['category']) && ! empty($arrInputs['category'])) {
            $objQuery = $objQuery->andWhere('b.category=:Category', [
                ':Category' => $arrInputs['category']
            ]);
        }
        // Id
        if (isset($arrInputs['id']) && ! empty($arrInputs['id'])) {
            $objQuery = $objQuery->andWhere('b.id!=:Id', [
                ':Id' => $arrInputs['id']
            ]);
        }
        // Board Id
        if (isset($arrInputs['board_id']) && ! empty($arrInputs['board_id'])) {
            $objQuery = $objQuery->andWhere('b.id=:boardId', [
                ':boardId' => $arrInputs['board_id']
            ]);
        }
        $arrResponse = $objQuery->orderBy([
            'name' => SORT_ASC,
            'id' => SORT_ASC
        ]);
        $arrResponse = $objQuery->all();
        return $arrResponse;
    }

    public static function updateBoard($arrInputs, $arrWhere)
    {
        $objConnection = Yii::$app->db;
        $intUpdate = $objConnection->createCommand()
            ->update('boards', $arrInputs, $arrWhere)
            ->execute();
        return $intUpdate;
    }
}
