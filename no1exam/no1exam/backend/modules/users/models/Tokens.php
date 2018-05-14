<?php
namespace backend\modules\users\models;

use yii\db\ActiveRecord;
use Yii;
use yii\db\Query;

class Tokens extends ActiveRecord
{

    public static function tableName()
    {
        return 'tokens';
    }

    public static function create($arrInputs)
    {
        $intInsert = Yii::$app->db->createCommand()
            ->batchInsert('tokens', [
            'category_type',
            'user_id',
            'token',
            'created_date'
        ], $arrInputs)
            ->execute();
        return $intInsert;
    }

    public static function getTokens($arrInputs = [])
    {
        $objQuery = new Query();
        $objQuery->select([
            'id',
            'category_type',
            'user_id',
            'token'
        ]);
        $objQuery->from('tokens as t');
        // User Id
        if (isset($arrInputs['user_id']) && ! empty($arrInputs['user_id'])) {
            $objQuery = $objQuery->andWhere('t.user_id=:userId', [
                ':userId' => $arrInputs['user_id']
            ]);
        }
        // Token
        if (isset($arrInputs['token']) && ! empty($arrInputs['token'])) {
            $objQuery = $objQuery->andWhere('t.token=:Token', [
                ':Token' => $arrInputs['token']
            ]);
        }
        $arrResponse = $objQuery->all();
        return $arrResponse;
    }
}
 