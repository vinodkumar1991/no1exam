<?php
namespace backend\modules\locations\models;

use yii\db\ActiveRecord;
use Yii;
use yii\db\Query;

class Locations extends ActiveRecord
{

    public static function tableName()
    {
        return 'locations';
    }

    public function rules()
    {
        return [
            [
                [
                    'category_type',
                    'country_name',
                    'status',
                    'sync'
                ],
                'required',
                'message' => '{attribute} is required'
            ],
            [
                [
                    'id',
                    'state_name',
                    'district_name',
                    'city_name',
                    'mandal_name',
                    'village_name',
                    'latitude',
                    'longitude',
                    'created_date'
                ],
                'safe'
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'category_type' => 'Location Category',
            'country_name' => 'Country',
            'state_name' => 'State',
            'district_name' => 'District',
            'city_name' => 'City',
            'mandal_name' => 'Mandal',
            'village_name' => 'Village',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'status' => 'Status',
            'sync' => 'Sync'
        ];
    }

    public static function getLocations($arrInputs = [])
    {
        $objQuery = new Query();
        $objQuery->select([
            'l.id',
            'l.category_type',
            'l.country_name',
            'l.state_name',
            'l.district_name',
            'l.city_name',
            'l.mandal_name',
            'l.village_name',
            'l.latitude',
            'l.longitude',
            'l.status',
            'l.sync'
        ]);
        $objQuery->from('locations as l');
        // Location Category
        if (isset($arrInputs['category']) && ! empty($arrInputs['category'])) {
            $objQuery = $objQuery->andWhere('l.category_type=:Category', [
                ':Category' => $arrInputs['category']
            ]);
        }
        $arrResponse = $objQuery->all();
        return $arrResponse;
    }

    public static function create($arrInputs)
    {
        $intInsert = Yii::$app->db->createCommand()
            ->batchInsert('locations', [
            'category_type',
            'country_name',
            'state_name',
            'district_name',
            'city_name',
            'mandal_name',
            'village_name',
            'latitude',
            'longitude',
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
}
