<?php

namespace backend\modules\locations\forms\Locations;

use yii\base\Model;

class LocationsForm extends Model {

    public $name;
    public $code;
    public $description;
    public $status;

    public function rules() {
        return [

            [['name', 'code', 'description', 'status'], 'required', 'message' => '{attribute} is required'],
        ];
    }

}

?>