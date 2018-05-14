<?php
namespace backend\modules\users\models;

use yii\db\ActiveRecord;
use yii\db\Query;

class Permissions extends ActiveRecord
{

    public static function tableName()
    {
        return 'permissions';
    }

    public static function getPermissions($arrInputs = [])
    {
        $objQuery = new Query();
        $objQuery->select([
            'p.id as permission_id',
            'p.name',
            'p.status'
        ]);
        $objQuery->from('permissions as p');
        $arrResponse = $objQuery->all();
        return $arrResponse;
    }
}
 