<?php
namespace backend\modules\users\models;

use yii\db\ActiveRecord;
use yii\db\Query;

class Locations extends ActiveRecord
{

    public static function tableName()
    {
        return 'locations';
    }

    public static function getLocations($arrInputs = [])
    {
        $objQuery = new Query();
        $objQuery->select([
            'l.id as location_id',
            'l.category_type',
            'l.country_name',
            'l.state_name',
            'l.district_name',
            'l.city_name',
            'l.mandal_name',
            'l.village_name',
            'l.latitude',
            'l.longitude',
            'l.status'
        ]);
        $objQuery->from('locations as l');
        // Location Category
        if (isset($arrInputs['category_type']) && ! empty($arrInputs['category_type'])) {
            $objQuery = $objQuery->andWhere('l.category_type=:categoryType', [
                ':categoryType' => $arrInputs['category_type']
            ]);
        }
        // Country
        if (isset($arrInputs['country_name']) && ! empty($arrInputs['country_name'])) {
            $objQuery = $objQuery->andWhere('l.country_name=:countryName', [
                ':countryName' => $arrInputs['country_name']
            ]);
        }
        // State
        if (isset($arrInputs['state_name']) && ! empty($arrInputs['state_name'])) {
            $objQuery = $objQuery->andWhere('l.state_name=:stateName', [
                ':stateName' => $arrInputs['state_name']
            ]);
        }
        $arrResponse = $objQuery->all();
        return $arrResponse;
    }
}
 