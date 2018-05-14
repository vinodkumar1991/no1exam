<?php
namespace backend\modules\users\models;

use yii\db\ActiveRecord;
use yii\db\Query;
use Yii;
use common\components\CommonComponent;
use backend\modules\users\models\Tokens;

class Users extends ActiveRecord
{

    public $role;

    public $country_name;

    public $state_name;

    public $city_name;

    public $new_password;

    public $confirm_password;

    public $otp;

    public static function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
            [
                [
                    'phone',
                    'password'
                ],
                'required',
                'on' => 'login',
                'message' => '{attribute} is required'
            ],
            [
                [
                    'role',
                    'country_name',
                    'fullname',
                    'password',
                    'email',
                    'phone',
                    'status'
                ],
                'required',
                'on' => 'newuser',
                'message' => '{attribute} is required'
            ],
            [
                [
                    'phone'
                ],
                'required',
                'on' => 'forgotpassword',
                'message' => '{attribute} is required'
            ],
            [
                [
                    'id',
                    'new_password',
                    'confirm_password',
                    'otp'
                ],
                'required',
                'on' => 'changepassword',
                'message' => '{attribute} is required'
            ],
            [
                [
                    'phone'
                ],
                'trim'
            ],
            [
                [
                    'state_name',
                    'city_name'
                ],
                'safe',
                'on' => 'newuser'
            ],
            [
                'phone',
                'string',
                'min' => 10,
                'max' => 10
            ],
            [
                'password',
                'string',
                'max' => 100
            ],
            [
                'phone',
                'isValidPhone',
                'on' => 'newuser'
            ],
            [
                'email',
                'isValidEmail',
                'on' => 'newuser'
            ],
            [
                'phone',
                'validatePhone',
                'on' => 'forgotpassword'
            ],
            [
                [
                    'new_password',
                    'confirm_password',
                    'otp'
                ],
                'string',
                'min' => 6,
                'max' => 6,
                'on' => 'changepassword'
            ],
            [
                [
                    'confirm_password'
                ],
                'compare',
                'compareAttribute' => 'new_password',
                'on' => 'changepassword'
            ],
            [
                'otp',
                'validateOTP',
                'on' => 'changepassword'
            ]
        ];
    }

    public function scenarios()
    {
        $arrScenarios = parent::scenarios();
        $arrScenarios['login'] = [
            'phone',
            'password'
        ];
        $arrScenarios['newuser'] = [
            'role',
            'country_name',
            'state_name',
            'city_name',
            'fullname',
            'password',
            'email',
            'phone',
            'status',
            'sync',
            'created_date',
            'created_by',
            'id'
        ];
        $arrScenarios['forgotpassword'] = [
            'phone'
        ];
        $arrScenarios['changepassword'] = [
            'otp',
            'new_password',
            'confirm_password',
            'id'
        ];
        return $arrScenarios;
    }

    public function attributeLabels()
    {
        return [
            'phone' => 'Phone Number',
            'password' => 'Password',
            'fullname' => 'Fullname',
            'email' => 'Email',
            'phone' => 'Phone',
            'status' => 'Status',
            'sync' => 'Sync',
            'otp' => 'OTP',
            'new_password' => 'New Password',
            'confirm_password' => 'Confirm Password',
            'id' => 'Id'
        ];
    }

    public static function getUsers($arrInputs = [])
    {
        $objQuery = new Query();
        $objQuery->select([
            'u.id',
            'u.fullname',
            'r.id as role_id',
            'rp.role as role_name',
            'u.password',
            'u.email',
            'u.phone',
            'u.image',
            'u.status',
            'ul.location_access_category',
            'ul.country_name',
            'ul.state_name',
            'ul.city_name',
            'ul.id as location_id',
            'rp.id as role_permission_id'
        ]);
        $objQuery->from('users as u');
        $objQuery->leftJoin('role_permissions as rp', 'rp.user_id = u.id and rp.is_primary = "yes"');
        $objQuery->leftJoin('roles as r', 'r.name = rp.role');
        $objQuery->leftJoin('users_locations ul', 'ul.user_id = u.id');
        // Phone
        if (isset($arrInputs['phone']) && ! empty($arrInputs['phone'])) {
            $objQuery = $objQuery->andWhere('u.phone=:Phone', [
                ':Phone' => $arrInputs['phone']
            ]);
        }
        // Password
        if (isset($arrInputs['password']) && ! empty($arrInputs['password'])) {
            $objQuery = $objQuery->andWhere('u.password=:Password', [
                ':Password' => $arrInputs['password']
            ]);
        }
        // Id
        if (isset($arrInputs['id']) && ! empty($arrInputs['id'])) {
            $objQuery = $objQuery->andWhere('u.id!=:Id', [
                ':Id' => $arrInputs['id']
            ]);
        }
        // Email
        if (isset($arrInputs['email']) && ! empty($arrInputs['email'])) {
            $objQuery = $objQuery->andWhere('u.email=:Email', [
                ':Email' => $arrInputs['email']
            ]);
        }
        // User Id
        if (isset($arrInputs['user_id']) && ! empty($arrInputs['user_id'])) {
            $objQuery = $objQuery->andWhere('u.id=:UserId', [
                ':UserId' => $arrInputs['user_id']
            ]);
        }
        // echo $objQuery->createCommand()->rawSql; die;
        $arrResponse = $objQuery->all();
        return $arrResponse;
    }

    public function isValidEmail($attribute, $params)
    {
        if (! empty($this->email)) {
            $arrUser = self::getUsers([
                'email' => $this->email,
                'id' => $this->id
            ]);
            if (! empty($arrUser)) {
                $this->addError('email', 'Email is already exists');
                return false;
            } else {
                return true;
            }
        }
    }

    public function isValidPhone($attribute, $params)
    {
        if (! empty($this->phone)) {
            $arrUser = self::getUsers([
                'phone' => $this->phone,
                'id' => $this->id
            ]);
            if (! empty($arrUser)) {
                $this->addError('phone', 'Phone is already exists');
                return false;
            } else {
                return true;
            }
        }
    }

    public function getDefaults()
    {
        return [
            'sync' => 'false',
            'created_date' => date("Y-m-d H:i:s"),
            'created_by' => Yii::$app->session['session_data']['user_id'],
            'password' => $this->getPassword()
        ];
    }

    private function getPassword()
    {
        $strPassword = CommonComponent::generatePassword(6);
        $strPassword = Yii::$app->getSecurity()->generatePasswordHash($strPassword);
        return $strPassword;
    }

    public function validatePhone($attributes, $params)
    {
        if (! empty($this->phone)) {
            $arrUser = self::getUsers([
                'phone' => $this->phone,
                'id' => $this->id
            ]);
            if (empty($arrUser)) {
                $this->addError('phone', 'Invalid phone number is given');
                return false;
            } else {
                return true;
            }
        }
    }

    public function validateOTP($attributes, $params)
    {
        if (! empty($this->otp)) {
            $arrToken = Tokens::getTokens([
                'user_id' => $this->id,
                'token' => $this->otp
            ]);
            if (empty($arrToken)) {
                $this->addError('otp', 'Invalid OTP is given');
                return false;
            } else {
                return true;
            }
        }
    }

    public static function updateUser($arrInputs, $arrWhere)
    {
        $objConnection = Yii::$app->db;
        $intUpdate = $objConnection->createCommand()
            ->update('users', $arrInputs, $arrWhere)
            ->execute();
        return $intUpdate;
    }
}
 