<?php
namespace backend\modules\notification\models;

use yii\db\ActiveRecord;
use yii\db\Query;

class Subjects extends ActiveRecord
{

    public static function tableName()
    {
        return 'senderids';
    }

    public static function getSenderIds($arrInputs = [])
    {
        $objQuery = new Query();
        $objQuery->select([
            's.id',
            's.message_type',
            's.category_type',
            's.subject',
            's.route',
            's.status'
        ]);
        $objQuery->from('senderids as s');
        $arrResponse = $objQuery->all();
        return $arrResponse;
    }
}
