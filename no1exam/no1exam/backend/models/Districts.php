<?php
namespace backend\models;

use yii\db\ActiveRecord;
use Yii;

class Districts extends ActiveRecord
{

    public static function tableName()
    {
        return 'districts';
    }

    public function rules()
    {
        return [
            [
                [
                    'state_id',
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
            'state_id' => 'State',
            'name' => 'District Name',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude'
        ];
    }

    public static function create($arrInputs)
    {
        $intInsert = Yii::$app->db->createCommand()
            ->batchInsert('districts', [
            'state_id',
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
