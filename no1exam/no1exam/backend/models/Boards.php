<?php
namespace backend\models;

use yii\db\ActiveRecord;
use Yii;

class Boards extends ActiveRecord
{

    public static function tableName()
    {
        return 'boards';
    }

    public function rules()
    {
        return [
            [
                [
                    'state_id',
                    'category',
                    'name',
                    'certificate'
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
            'state_id' => 'State',
            'category' => 'Category',
            'name' => 'Board Name',
            'certificate' => 'Certificate'
        ];
    }

    public static function create($arrInputs)
    {
        $intInsert = Yii::$app->db->createCommand()
            ->batchInsert('boards', [
            'state_id',
            'category',
            'name',
            'certificate',
            'status',
            'sync',
            'created_date'
        ], $arrInputs)
            ->execute();
        return $intInsert;
    }
}
