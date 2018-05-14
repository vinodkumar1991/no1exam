<?php
namespace backend\models;

use yii\db\ActiveRecord;
use Yii;

class Seminaries extends ActiveRecord
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
                    'state_id',
                    'district_id',
                    'city_id',
                    'category',
                    'education_type',
                    'delivery_type',
                    'board_id',
                    'name',
                    'address'
                ],
                'required'
            ],
            [
                [
                    'id',
                    'short_name',
                    'latitude',
                    'longitude',
                    'status' // Need To Remove
                ],
                'safe'
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'state_id' => 'State',
            'district_id' => 'District',
            'city_id' => 'City',
            'category' => 'Category',
            'education_type' => 'Education Type',
            'delivery_type' => 'Delivery Type',
            'board_id' => 'Board',
            'name' => 'Seminary Name',
            'short_name' => 'Seminary Short Name',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'address' => 'Address'
        ];
    }

    public static function create($arrInputs)
    {
        $intInsert = Yii::$app->db->createCommand()
            ->batchInsert('seminary', [
            'state_id',
            'district_id',
            'city_id',
            'category',
            'education_type',
            'delivery_type',
            'board_id',
            'name',
            'short_name',
            'latitude',
            'longitude',
            'address',
            'status'
        ], $arrInputs)
            ->execute();
        return $intInsert;
    }
}
