<?php
namespace backend\models;

use yii\db\ActiveRecord;
use Yii;

class Groups extends ActiveRecord
{

    public static function tableName()
    {
        return 'groups';
    }

    public function rules()
    {
        return [
            [
                [
                    'stream_id',
                    'name',
                    'short_name'
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
            'stream_id' => 'Stream Id',
            'name' => 'Group Name',
            'short_name' => 'Group Short Name'
        ];
    }

    public static function create($arrInputs)
    {
        $intInsert = Yii::$app->db->createCommand()
            ->batchInsert('groups', [
            'stream_id',
            'name',
            'short_name',
            'status',
            'sync',
            'created_date'
        ], $arrInputs)
            ->execute();
        return $intInsert;
    }
}
