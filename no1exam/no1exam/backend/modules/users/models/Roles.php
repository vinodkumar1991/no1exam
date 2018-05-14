<?php
namespace backend\modules\users\models;

use yii\db\ActiveRecord;
use yii\db\Query;

class Roles extends ActiveRecord
{

    public static function tableName()
    {
        return 'roles';
    }

    public static function getRoles($arrInputs = [])
    {
        $objQuery = new Query();
        $objQuery->select([
            'r.id as role_id',
            'r.name',
            'r.status'
        ]);
        $objQuery->from('roles as r');
        $arrResponse = $objQuery->all();
        return $arrResponse;
    }
}
 