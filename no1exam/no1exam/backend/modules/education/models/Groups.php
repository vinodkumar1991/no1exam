<?php
namespace backend\modules\education\models;

use yii\db\ActiveRecord;
use Yii;
use yii\db\Query;

class Groups extends ActiveRecord
{

    public $education_level;

    public static function tableName()
    {
        return 'groups';
    }

    public function rules()
    {
        return [
            [
                [
                    'education_level',
                    'stream_id',
                    'name',
                    'short_name',
                    'status'
                ],
                'required',
                'message' => '{attribute} is required'
            ],
            [
                [
                    'name',
                    'short_name',
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
                'pattern' => '/^[a-zA-Z \']+$/',
                'message' => 'Invalid Group Name'
            ],
            [
                'short_name',
                'string',
                'min' => 2,
                'max' => 7
            ],
            [
                'short_name',
                'match',
                'pattern' => '/^[a-zA-Z0-9]+$/',
                'message' => 'Invalid Group Short Name'
            ],
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
            'education_level' => 'Education Level',
            'stream_id' => 'Stream',
            'name' => 'Group Name',
            'short_name' => 'Group Short Name'
        ];
    }

    public function create($arrInputs)
    {
        $intInsert = Yii::$app->db->createCommand()
            ->batchInsert('groups', [
            'stream_id',
            'name',
            'short_name',
            'status',
            'sync',
            'created_date'
        ], $arrInputs)
            ->execute();
        return $intInsert;
    }

    public function getDefaults()
    {
        $arrDefaults = [];
        $arrDefaults = [
            'sync' => 'false',
            'created_date' => date('Y-m-d H:i:s')
        ];
        return $arrDefaults;
    }

    public function isValidName($attribute, $params)
    {
        $arrStream = [];
        if (! empty($this->name)) {
            $arrStream = self::getGroups([
                'stream_id' => $this->stream_id,
                'name' => $this->name,
                'id' => $this->id
            ]);
        }
        if (! empty($arrStream)) {
            $this->addError($attribute, 'Group name is already exists');
            return false;
        } else {
            return true;
        }
    }

    public static function getGroups($arrInputs = [])
    {
        $objQuery = new Query();
        $objQuery->select([
            'g.id',
            's.name as stream_name',
            's.id as stream_id',
            'g.name',
            'g.short_name',
            'g.status',
            'g.sync',
            's.category as education_level'
        ]);
        $objQuery->from('groups as g');
        $objQuery = $objQuery->innerJoin('streams as s', 's.id = g.stream_id');
        // Stream
        if (isset($arrInputs['stream_id']) && ! empty($arrInputs['stream_id'])) {
            $objQuery = $objQuery->andWhere('g.stream_id=:Stream', [
                ':Stream' => $arrInputs['stream_id']
            ]);
        }
        // Name
        if (isset($arrInputs['name']) && ! empty($arrInputs['name'])) {
            $objQuery = $objQuery->andWhere('g.name=:Name', [
                ':Name' => $arrInputs['name']
            ]);
        }
        // Id
        if (isset($arrInputs['id']) && ! empty($arrInputs['id'])) {
            $objQuery = $objQuery->andWhere('g.id!=:Id', [
                ':Id' => $arrInputs['id']
            ]);
        }
        // Group Id
        if (isset($arrInputs['group_id']) && ! empty($arrInputs['group_id'])) {
            $objQuery = $objQuery->andWhere('g.id=:groupId', [
                ':groupId' => $arrInputs['group_id']
            ]);
        }
        $arrResponse = $objQuery->all();
        return $arrResponse;
    }

    public static function updateGroup($arrInputs, $arrWhere)
    {
        $objConnection = Yii::$app->db;
        $intUpdate = $objConnection->createCommand()
            ->update('groups', $arrInputs, $arrWhere)
            ->execute();
        return $intUpdate;
    }
}
