<?php
namespace backend\models;

use yii\db\ActiveRecord;
use Yii;

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
                    'years'
                ],
                'required'
            ],
            [
                [
                    'id',
                    'status', // Need To Remove
                    'sync', // Need To Remove
                    'created_date' // Need To Remove
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
            'short_name' => 'Stream Short Name',
            'years' => 'Years'
        ];
    }

    public static function create($arrInputs)
    {
        $intInsert = Yii::$app->db->createCommand()
            ->batchInsert('streams', [
            'category',
            'name',
            'short_name',
            'years',
            'status',
            'sync',
            'created_date'
        ], $arrInputs)
            ->execute();
        return $intInsert;
    }
}
