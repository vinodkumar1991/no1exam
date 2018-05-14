<?php
namespace backend\models;

use yii\db\ActiveRecord;
use Yii;

class Cities extends ActiveRecord
{

    public static function tableName()
    {
        return 'cities';
    }

    public function rules()
    {
        return [
            [
                [
                    'district_id',
                    'name'
                ],
                'required'
            ],
            [
                [
                    'id',
                    'latitude',
                    'longitude',
                    'status', // Need To Remove
                    'sync', // Need To Remove
                    'created_date' // Need To Remove,
                ],
                'safe'
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'district_id' => 'District',
            'name' => 'City Name',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude'
        ];
    }

    public static function create($arrInputs)
    {
        $intInsert = Yii::$app->db->createCommand()
            ->batchInsert('cities', [
            'district_id',
            'name',
            'latitude',
            'longitude',
            'status',
            'sync',
            'created_date'
        ], $arrInputs)
            ->execute();
        return $intInsert;
    }
}
