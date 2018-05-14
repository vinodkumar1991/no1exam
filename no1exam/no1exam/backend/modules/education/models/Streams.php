<?php
namespace backend\modules\education\models;

use yii\db\ActiveRecord;
use Yii;
use yii\db\Query;

class Streams extends ActiveRecord
{

    public static function tableName()
    {
        return 'streams';
    }

    public function rules()
    {
        return [
            [
                [
                    'category',
                    'name',
                    'short_name',
                    // 'years',
                    'status'
                ],
                'required',
                'message' => '{attribute} is required'
            ],
            [
                [
                    'category',
                    'name',
                    'short_name',
                    'status'
                    // 'years'
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
                'pattern' => '/^[a-zA-Z0-9 \']+$/',
                'message' => 'Invalid Stream Name'
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
                'message' => 'Invalid Stream Short Name'
            ],
            // [
            // 'years',
            // 'integer'
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
            'category' => 'Category',
            'name' => 'Stream Name',
            'short_name' => 'Stream Short Name'
            // 'years' => 'Years'
        ];
    }

    public function create($arrInputs)
    {
        $intInsert = Yii::$app->db->createCommand()
            ->batchInsert('streams', [
            'category',
            'name',
            'short_name',
            // 'years',
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
        $arrStream = [];
        if (! empty($this->name)) {
            $arrStream = self::getStreams([
                'category' => $this->category,
                'name' => $this->name,
                'id' => $this->id
            ]);
        }
        if (! empty($arrStream)) {
            $this->addError($attribute, 'Stream name is already exists');
            return false;
        } else {
            return true;
        }
    }

    public static function getStreams($arrInputs = [])
    {
        $objQuery = new Query();
        $objQuery->select([
            's.id',
            's.category',
            's.name',
            's.short_name',
            // 's.years',
            's.status',
            's.sync'
        ]);
        $objQuery->from('streams as s');
        // Category
        if (isset($arrInputs['category']) && ! empty($arrInputs['category'])) {
            $objQuery = $objQuery->andWhere('s.category=:Category', [
                ':Category' => $arrInputs['category']
            ]);
        }
        // Name
        if (isset($arrInputs['name']) && ! empty($arrInputs['name'])) {
            $objQuery = $objQuery->andWhere('s.name=:Name', [
                ':Name' => $arrInputs['name']
            ]);
        }
        // Id
        if (isset($arrInputs['id']) && ! empty($arrInputs['id'])) {
            $objQuery = $objQuery->andWhere('s.id!=:Id', [
                ':Id' => $arrInputs['id']
            ]);
        }
        // Stream Id
        if (isset($arrInputs['stream_id']) && ! empty($arrInputs['stream_id'])) {
            $objQuery = $objQuery->andWhere('s.id=:streamId', [
                ':streamId' => $arrInputs['stream_id']
            ]);
        }
        $arrResponse = $objQuery->all();
        return $arrResponse;
    }

    public static function updateStream($arrInputs, $arrWhere)
    {
        $objConnection = Yii::$app->db;
        $intUpdate = $objConnection->createCommand()
            ->update('streams', $arrInputs, $arrWhere)
            ->execute();
        return $intUpdate;
    }
}
 