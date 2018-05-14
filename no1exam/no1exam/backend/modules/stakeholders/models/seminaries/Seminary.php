<?php
namespace backend\modules\stakeholders\models\seminaries;

use yii\db\ActiveRecord;
use Yii;
use yii\db\Query;

class Seminary extends ActiveRecord
{

    public static function tableName()
    {
        return 'seminary';
    }

    public function rules()
    {
        return [
            [
                [
                    'location_id',
                    'location_name',
                    'category',
                    'education_type',
                    'delivery_type',
                    'board_id',
                    'name',
                    'latitude',
                    'longitude',
                    'address',
                    'status'
                ],
                'required',
                'message' => '{attribute} is required'
            ],
            [
                [
                    'name',
                    'short_name',
                    'email',
                    'landline',
                    'address'
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
                'message' => 'Invalid Seminary Name'
            ],
            [
                'short_name',
                'string',
                'min' => 2,
                'max' => 8
            ],
            [
                'short_name',
                'match',
                'pattern' => '/^[a-zA-Z0-9]+$/',
                'message' => 'Invalid Seminary Code'
            ],
            [
                'email',
                'email'
            ],
            [
                'email',
                'string',
                'max' => 40
            ],
            [
                'landline',
                'string',
                'min' => 10,
                'max' => 13
            ],
            [
                'landline',
                'match',
                'pattern' => '/^[0-9]+$/',
                'message' => 'Invalid landline number'
            ],
            [
                'location',
                'string',
                'max' => 150
            ],
            [
                [
                    'latitude',
                    'longitude'
                ],
                'double'
            ],
            [
                'name',
                'isValidName'
            ],
            [
                'short_name',
                'isValidShortName'
            ],
            [
                [
                    'id',
                    'short_name',
                    'email',
                    'landline',
                    'sync',
                    'created_by',
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
            'location_id' => 'Location',
            'location_name' => 'Location Name',
            'category' => 'Seminary Type',
            'education_type' => 'Education Type',
            'delivery_type' => 'Delivery Type',
            'board_id' => 'Board',
            'name' => 'Seminary Name',
            'short_name' => 'Seminary Code',
            'email' => 'Email',
            'landline' => 'Landline',
            'location' => 'Location',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'address' => 'Address',
            'status' => 'Status'
        ];
    }

    public function create($arrInputs)
    {
        $intInsert = Yii::$app->db->createCommand()
            ->batchInsert('seminary', [
            'location_id',
            'location_name',
            'category',
            'education_type',
            'delivery_type',
            'board_id',
            'name',
            'short_name',
            'email',
            'landline',
            'location',
            'latitude',
            'longitude',
            'address',
            'status',
            'created_by',
            'created_date'
        ], $arrInputs)
            ->execute();
        return $intInsert;
    }

    public function getDefaults()
    {
        return [
            'created_date' => date('Y-m-d H:i:s')
        ];
    }

    public function isValidName($attribute, $params)
    {
        $arrSeminary = [];
        if (! empty($this->name)) {
            $arrSeminary = self::getSeminaries([
                'name' => $this->name,
                'id' => $this->id
            ]);
        }
        if (! empty($arrSeminary)) {
            $this->addError($attribute, 'Seminary name is already exists');
            return false;
        } else {
            return true;
        }
    }

    public function isValidShortName($attribute, $params)
    {
        $arrSeminary = [];
        if (! empty($this->short_name)) {
            $arrSeminary = self::getSeminaries([
                'short_name' => $this->short_name,
                'id' => $this->id
            ]);
        }
        if (! empty($arrSeminary)) {
            $this->addError($attribute, 'Seminary code is already exists');
            return false;
        } else {
            return true;
        }
    }

    public static function getSeminaries($arrInputs = [])
    {
        $objQuery = new Query();
        $objQuery->select([
            's.id',
            's.category',
            's.education_type',
            's.delivery_type',
            's.name',
            's.short_name',
            's.email',
            's.landline',
            's.latitude',
            's.longitude',
            's.address',
            's.status',
            'b.name as board_name',
            'b.certificate',
            'l.state_name',
            'l.district_name',
            'l.city_name',
            'l.mandal_name',
            'l.village_name'
        ]);
        $objQuery->from('seminary as s');
        $objQuery = $objQuery->innerJoin('boards as b', 'b.id = s.board_id');
        $objQuery = $objQuery->innerJoin('locations as l', 'l.id = s.location_id');
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
        // Short Name
        if (isset($arrInputs['short_name']) && ! empty($arrInputs['short_name'])) {
            $objQuery = $objQuery->andWhere('s.short_name=:seminaryCode', [
                ':seminaryCode' => $arrInputs['short_name']
            ]);
        }
        // Education Type
        if (isset($arrInputs['education_type']) && ! empty($arrInputs['education_type'])) {
            $objQuery = $objQuery->andWhere('s.education_type=:EducationType', [
                ':EducationType' => $arrInputs['education_type']
            ]);
        }
        // Delivery Type
        if (isset($arrInputs['delivery_type']) && ! empty($arrInputs['delivery_type'])) {
            $objQuery = $objQuery->andWhere('s.delivery_type=:DeliveryType', [
                ':DeliveryType' => $arrInputs['delivery_type']
            ]);
        }
        // Board
        if (isset($arrInputs['board_id']) && ! empty($arrInputs['board_id'])) {
            $objQuery = $objQuery->andWhere('s.board_id=:BoardId', [
                ':BoardId' => $arrInputs['board_id']
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
}
 