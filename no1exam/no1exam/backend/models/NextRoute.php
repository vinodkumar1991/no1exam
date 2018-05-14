<?php
namespace backend\models;

use yii\db\ActiveRecord;
use Yii;

class NextRoute extends ActiveRecord
{

    public static function tableName()
    {
        return 'next_route';
    }

    public function rules()
    {
        return [
            [
                [
                    'parent_stream',
                    'child_stream',
                    'is_suggested'
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
            'parent_stream' => 'Parent Stream',
            'child_stream' => 'Child Stream',
            'is_suggested' => 'Is Suggested'
        ];
    }

    public static function create($arrInputs)
    {
        $intInsert = Yii::$app->db->createCommand()
            ->batchInsert('next_route', [
            'parent_stream',
            'child_stream',
            'is_suggested',
            'status',
            'sync',
            'created_date'
        ], $arrInputs)
            ->execute();
        return $intInsert;
    }
}
