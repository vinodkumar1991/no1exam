<?php
namespace backend\models;

use yii\db\ActiveRecord;
use Yii;

class SeminaryStreams extends ActiveRecord
{

    public static function tableName()
    {
        return 'seminary_streams';
    }

    public function rules()
    {
        return [
            [
                [
                    'seminary_id',
                    'stream_id',
                    'group_id'
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
            'seminary_id' => 'Seminary',
            'stream_id' => 'Stream',
            'group_id' => 'Group'
        ];
    }

    public static function create($arrInputs)
    {
        $intInsert = Yii::$app->db->createCommand()
            ->batchInsert('seminary_streams', [
            'seminary_id',
            'stream_id',
            'group_id',
            'status',
            'sync',
            'created_date'
        ], $arrInputs)
            ->execute();
        return $intInsert;
    }
}
