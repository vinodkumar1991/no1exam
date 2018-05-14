<?php
namespace backend\modules\users\models;

use yii\db\ActiveRecord;
use Yii;
use yii\db\Query;

class RolePermissions extends ActiveRecord
{

    public static function tableName()
    {
        return 'role_permissions';
    }

    public function rules()
    {
        return [
            [
                [
                    'role',
                    'status'
                ],
                'required',
                'message' => '{attribute} is required'
            ],
            [
                'role',
                'isValidPermission'
            ],
            [
                [
                    'id',
                    'user_id',
                    'is_primary',
                    'permission',
                    'created_date',
                    'created_by',
                    'last_modified_by'
                ],
                'safe'
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'user_id' => 'User',
            'role' => 'Role',
            'is_primary' => 'Is Primary',
            'permission' => 'Permission',
            'status' => 'Status'
        ];
    }

    public static function create($arrInputs)
    {
        $intInsert = Yii::$app->db->createCommand()
            ->batchInsert('role_permissions', [
            'user_id',
            'role',
            'is_primary',
            'permission',
            'status',
            'created_date',
            'created_by',
            'last_modified_by'
        ], $arrInputs)
            ->execute();
        return $intInsert;
    }

    public function isValidPermission($attribute, $params)
    {
        if (! empty($this->role)) {
            $arrRolePermission = RolePermissions::getRolePermissions([
                'role' => $this->role
            ]);
            if (! empty($arrRolePermission)) {
                $this->addError('role', 'Permissions are already existed to this role');
                return false;
            } else {
                return true;
            }
        }
    }

    public static function getRolePermissions($arrInputs = [])
    {
        $objQuery = new Query();
        $objQuery->select([
            'rp.id',
            'rp.user_id',
            'rp.role',
            'rp.is_primary',
            'rp.permission',
            'rp.status'
        ]);
        $objQuery->from('role_permissions as rp');
        // Role
        if (isset($arrInputs['role']) && ! empty($arrInputs['role'])) {
            $objQuery = $objQuery->andWhere('rp.role=:roleName and rp.permission !=""', [
                ':roleName' => $arrInputs['role']
            ]);
        }
        // Permission
        if (isset($arrInputs['permission']) && ! empty($arrInputs['permission'])) {
            $objQuery = $objQuery->andWhere('rp.permission =:permission', [
                ':permission' => $arrInputs['permission']
            ]);
        }
        // Status
        if (isset($arrInputs['status']) && ! empty($arrInputs['status'])) {
            $objQuery = $objQuery->andWhere('rp.status =:status', [
                ':status' => $arrInputs['status']
            ]);
        }
        $arrResponse = $objQuery->all();
        return $arrResponse;
    }

    public function getDefaults()
    {
        return [
            'status' => 'active',
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => Yii::$app->session['session_data']['user_id'],
            'last_modified_by' => Yii::$app->session['session_data']['user_id']
        ];
    }

    public static function updateRolePermission($arrInputs, $arrWhere)
    {
        $objConnection = Yii::$app->db;
        $intUpdate = $objConnection->createCommand()
            ->update('role_permissions', $arrInputs, $arrWhere)
            ->execute();
        return $intUpdate;
    }
}
