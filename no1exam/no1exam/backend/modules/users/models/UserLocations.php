<?php
namespace backend\modules\users\models;

use yii\db\ActiveRecord;
use Yii;

class UserLocations extends ActiveRecord
{

    public static function tableName()
    {
        return 'users_locations';
    }

    public static function create($arrInputs)
    {
        $intInsert = Yii::$app->db->createCommand()
            ->batchInsert('users_locations', [
            'user_id',
            'location_access_category',
            'country_name',
            'state_name',
            'city_name',
            'status',
            'created_date',
            'created_by'
        ], $arrInputs)
            ->execute();
        return $intInsert;
    }

    public static function updateLocations($arrInputs, $arrWhere)
    {
        $objConnection = Yii::$app->db;
        $intUpdate = $objConnection->createCommand()
            ->update('users_locations', $arrInputs, $arrWhere)
            ->execute();
        return $intUpdate;
    }
}
