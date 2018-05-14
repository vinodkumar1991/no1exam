<?php
namespace backend\models;

use yii\db\ActiveRecord;
use Yii;

class States extends ActiveRecord
{

    public static function tableName()
    {
        return 'states';
    }

    public function rules()
    {
        return [
            [
                [
                    'name',
                    'short_name'
                ],
                'required'
            ],
            [
                [
                    'id'
                ],
                'safe'
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'State Name',
            'short_name' => 'State Short Name'
        ];
    }

    public static function create($arrInputs)
    {
        $intInsert = Yii::$app->db->createCommand()
            ->batchInsert('states', [
            'name',
            'short_name'
        ], $arrInputs)
            ->execute();
        return $intInsert;
    }
}
