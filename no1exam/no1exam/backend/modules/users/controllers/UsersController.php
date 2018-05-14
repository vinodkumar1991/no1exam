<?php
namespace app\modules\users\controllers;

use yii\web\Controller;
use Yii;
use backend\modules\users\models\Users;
use yii\web\Session;
use backend\modules\users\models\Roles;
use backend\modules\users\models\Permissions;
use backend\modules\users\models\Locations;
use yii\helpers\Json;
use backend\modules\users\models\RolePermissions;
use backend\modules\users\models\UserLocations;
use backend\modules\users\models\Tokens;
use common\components\CommonComponent;
use common\components\DataComponent;

class UsersController extends Controller
{

    public function beforeAction($action)
    {
        $strAction = Yii::$app->controller->action->id;
        $objSession = Yii::$app->session;
        $arrActions = [
            'login',
            'forgot-password'
        ];
        if (! isset($objSession['session_data']) && ! in_array($strAction, $arrActions)) {
            $this->redirect(Yii::getAlias('@web') . '/login');
        }
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionLogin()
    {
        $arrInputs = Yii::$app->request->post();
        $arrResponse = isset($arrInputs['do_login']) ? $this->validateCredentials($arrInputs) : [];
        if (isset($arrResponse['user'])) {
            $this->setSession($arrResponse['user']);
            $this->redirect(Yii::getAlias('@web') . '/dashboard');
        }
        return $this->render('/users/login', [
            'errors' => isset($arrResponse['errors']) ? $arrResponse['errors'] : [],
            'fields' => isset($arrResponse['fields']) ? $arrResponse['fields'] : []
        ]);
    }

    private function validateCredentials($arrInputs)
    {
        $arrResponse = [];
        $objUser = new Users();
        $objUser->scenario = 'login';
        $objUser->attributes = $arrInputs;
        if ($objUser->validate()) {
            $arrValidatedInputs = $objUser->getAttributes();
            $arrUser = Users::getUsers([
                'phone' => $arrValidatedInputs['phone']
            ]);
            $arrUser = isset($arrUser[0]) ? $arrUser[0] : [];
            if (! empty($arrUser)) {
                // Validate Password
                if (Yii::$app->getSecurity()->validatePassword($arrValidatedInputs['password'], $arrUser['password'])) {
                    $arrResponse['user'] = $arrUser;
                } else {
                    $arrResponse['errors']['password'] = [
                        'Invalid Password'
                    ];
                }
            } else {
                $arrResponse['errors']['phone'] = [
                    'Invalid Phone'
                ];
            }
            $arrResponse['fields']['phone'] = $objUser->phone;
            unset($arrUser, $arrInputs);
        } else {
            $arrResponse['errors'] = $objUser->errors;
            $arrResponse['fields'] = $objUser->getAttributes();
        }
        return $arrResponse;
    }

    private function setSession($arrUser)
    {
        $objSession = Yii::$app->session;
        $arrSessionData = [
            'fullname' => $arrUser['fullname'],
            'role_id' => $arrUser['role_id'],
            'role_name' => $arrUser['role_name'],
            'email' => $arrUser['email'],
            'phone' => $arrUser['phone'],
            'image' => $arrUser['image'],
            'user_id' => $arrUser['id']
        ];
        $objSession['session_data'] = $arrSessionData;
        unset($arrUser, $arrSessionData);
        return true;
    }

    public function actionLogout()
    {
        $objSession = Yii::$app->session;
        $objSession->remove('session_data');
        $this->redirect(Yii::getAlias('@web') . '/login');
    }

    public function actionRoles()
    {
        $arrRoles = Roles::getRoles();
        return $this->render('/users/roles', [
            'roles' => $arrRoles
        ]);
    }

    public function actionPermissions()
    {
        $arrPermissions = Permissions::getPermissions();
        return $this->render('/users/permissions', [
            'permissions' => $arrPermissions
        ]);
    }

    public function actionUsers()
    {
        $arrStatuses = DataComponent::statuses();
        $arrRoles = Roles::getRoles();
        $arrCountries = Locations::getLocations([
            'category_type' => 'country'
        ]);
        $arrUsers = Users::getUsers();
        return $this->render('/users/users', [
            'users' => $arrUsers,
            'roles' => $arrRoles,
            'countries' => $arrCountries,
            'statuses' => $arrStatuses
        ]);
    }

    public function actionGetLocations()
    {
        $strResponse = '<option value="">--Select Location--</option>';
        $arrInputs = Yii::$app->request->post();
        $arrLocations = Locations::getLocations($arrInputs);
        if (! empty($arrLocations)) {
            switch ($arrInputs['category_type']) {
                case 'city':
                    foreach ($arrLocations as $arrLocation) {
                        if ($arrInputs['selected_city_name'] == $arrLocation['city_name']) {
                            $strResponse .= '<option value="' . $arrLocation['city_name'] . '" selected>' . $arrLocation['city_name'] . '</option>';
                        } else {
                            $strResponse .= '<option value="' . $arrLocation['city_name'] . '">' . $arrLocation['city_name'] . '</option>';
                        }
                    }
                    break;
                default:
                    foreach ($arrLocations as $arrLocation) {
                        if ($arrInputs['selected_state_name'] == $arrLocation['state_name']) {
                            $strResponse .= '<option value="' . $arrLocation['state_name'] . '" selected>' . $arrLocation['state_name'] . '</option>';
                        } else {
                            $strResponse .= '<option value="' . $arrLocation['state_name'] . '">' . $arrLocation['state_name'] . '</option>';
                        }
                    }
            }
        }
        unset($arrInputs, $arrLocations);
        echo $strResponse;
    }

    public function actionCreateUser()
    {
        $arrResponse = [];
        $arrInputs = Yii::$app->request->post();
        $objUser = new Users();
        $objUser->scenario = 'newuser';
        $arrInputs = array_merge($arrInputs, $objUser->getDefaults());
        $objUser->attributes = $arrInputs;
        if ($objUser->validate()) {
            $arrValidatedInputs = $arrInputs;
            // Need to implement transaction concept
            // Create User
            if (! empty($arrValidatedInputs['id'])) {
                unset($arrValidatedInputs['password'], $arrValidatedInputs['created_date'], $arrValidatedInputs['created_by'], $arrValidatedInputs['location_id'], $arrValidatedInputs['role_permission_id'], $arrValidatedInputs['country_name'], $arrValidatedInputs['state_name'], $arrValidatedInputs['city_name'], $arrValidatedInputs['role']);
                Users::updateUser($arrValidatedInputs, [
                    'id' => $arrValidatedInputs['id']
                ]);
                $intUser = $arrValidatedInputs['id'];
            } else {
                $objUser->save();
                $intUser = $objUser->id;
            }
            $arrInputs['user_id'] = $intUser;
            // Role Permissions
            $this->addRolePermissions($arrInputs);
            // User Locations
            $this->addLocations($arrInputs);
            $arrResponse['message'] = empty($arrInputs['id']) ? 'User created successfully' : 'User updated successfully';
        } else {
            $arrResponse['errors'] = $objUser->errors;
        }
        unset($arrInputs);
        echo JSON::encode($arrResponse);
    }

    private function addRolePermissions($arrInputs)
    {
        $arrResponse = [];
        $arrRolePermissions[] = [
            'id' => isset($arrInputs['role_permission_id']) ? $arrInputs['role_permission_id'] : NULL,
            'user_id' => $arrInputs['user_id'],
            'role' => $arrInputs['role'],
            'is_primary' => 'yes',
            'permission' => null,
            'status' => $arrInputs['status'],
            'created_date' => $arrInputs['created_date'],
            'created_by' => $arrInputs['created_by'],
            'last_modified_by' => $arrInputs['created_by']
        ];
        // Role Permissions
        if (! empty($arrRolePermissions[0]['id'])) {
            unset($arrRolePermissions[0]['created_date'], $arrRolePermissions[0]['created_by']);
            $arrResponse['role_permission_id'] = RolePermissions::updateRolePermission($arrRolePermissions[0], [
                'id' => $arrRolePermissions[0]['id']
            ]);
        } else {
            unset($arrRolePermissions[0]['id']);
            $arrResponse['role_permission_id'] = RolePermissions::create($arrRolePermissions);
        }
        unset($arrRolePermissions, $arrInputs);
        return $arrResponse;
    }

    private function addLocations($arrInputs)
    {
        $arrResponse = [];
        $arrUserLocations[] = [
            'id' => isset($arrInputs['location_id']) ? $arrInputs['location_id'] : NULL,
            'user_id' => $arrInputs['user_id'],
            'location_access_category' => $this->decideLocationCategory($arrInputs),
            'country_name' => $arrInputs['country_name'],
            'state_name' => $arrInputs['state_name'],
            'city_name' => $arrInputs['city_name'],
            'status' => $arrInputs['status'],
            'created_date' => $arrInputs['created_date'],
            'created_by' => $arrInputs['created_by']
        ];
        if (! empty($arrUserLocations[0]['id'])) {
            unset($arrUserLocations[0]['created_date'], $arrUserLocations[0]['created_by']);
            $arrUserLocations[0]['last_modified_by'] = Yii::$app->session['session_data']['user_id'];
            $arrResponse['user_location_id'] = UserLocations::updateLocations($arrUserLocations[0], [
                'id' => $arrUserLocations[0]['id']
            ]);
        } else {
            unset($arrUserLocations[0]['id']);
            $arrResponse['user_location_id'] = UserLocations::create($arrUserLocations);
        }
        unset($arrInputs, $arrUserLocations);
        return $arrResponse;
    }

    private function decideLocationCategory($arrInputs)
    {
        $strResponse = null;
        $strResponse = ! empty($arrInputs['city_name']) ? 'city' : (! empty($arrInputs['state_name']) ? 'state' : 'country');
        return $strResponse;
    }

    public function actionRolePermissions()
    {
        $arrRoles = Roles::getRoles();
        $arrPermissions = Permissions::getPermissions();
        return $this->render('/users/role_permissions', [
            'roles' => $arrRoles,
            'permissions' => $arrPermissions
        ]);
    }

    public function actionForgotPassword()
    {
        $arrInputs = Yii::$app->request->post();
        return $this->render('/users/forgot_password', []);
    }

    public function actionSendOtp()
    {
        $arrResponse = [];
        $arrInputs = Yii::$app->request->post();
        if (! empty($arrInputs)) {
            $objUser = new Users();
            $objUser->scenario = 'forgotpassword';
            $objUser->attributes = $arrInputs;
            if ($objUser->validate()) {
                $arrValidatedInputs = $objUser->getAttributes();
                $arrUser = Users::getUsers([
                    'phone' => $arrValidatedInputs['phone']
                ])[0];
                $arrTokenInputs[] = [
                    'category_type' => 'forgotpassword',
                    'user_id' => $arrUser['id'],
                    'token' => CommonComponent::getNumberToken(6),
                    'created_date' => date('Y-m-d H:i:s')
                ];
                // Send Token To MSG91 :: Need to implement
                $arrResponse['token_id'] = Tokens::create($arrTokenInputs);
                $arrResponse['user_id'] = $arrUser['id'];
                $arrResponse['message'] = 'Token sent successfully to your mobile number';
            } else {
                $arrResponse['errors'] = $objUser->errors;
            }
        }
        echo Json::encode($arrResponse);
        exit();
    }

    public function actionChangePassword()
    {
        $arrResponse = [];
        $arrInputs = Yii::$app->request->post();
        if (! empty($arrInputs)) {
            $objUser = new Users();
            $objUser->scenario = 'changepassword';
            $objUser->attributes = $arrInputs;
            if ($objUser->validate()) {
                $arrValidatedInputs = $arrInputs;
                $arrValidatedInputs['password'] = Yii::$app->getSecurity()->generatePasswordHash($arrInputs['new_password']);
                $arrValidatedInputs['last_modified_by'] = Yii::$app->session['session_data']['user_id'];
                unset($arrValidatedInputs['confirm_password'], $arrValidatedInputs['new_password'], $arrValidatedInputs['otp']);
                $arrResponse['is_updated'] = Users::updateUser($arrValidatedInputs, [
                    'id' => $arrValidatedInputs['id']
                ]);
                $arrResponse['message'] = 'Password changed successfully';
                unset($arrValidatedInputs);
            } else {
                $arrResponse['errors'] = $objUser->errors;
            }
        }
        echo Json::encode($arrResponse);
        exit();
    }

    public function actionSaveRolePermissions()
    {
        $arrResponse = [];
        $arrInputs = Yii::$app->request->post();
        $arrPermissions = isset($arrInputs['permissions']) ? $arrInputs['permissions'] : [];
        if (! empty($arrInputs) && ! empty($arrPermissions)) {
            $i = 0;
            foreach ($arrPermissions as $intKey => $strValue) {
                $arrRoleInputs = [];
                $objRolePermissions = new RolePermissions();
                $arrDefaults = $objRolePermissions->getDefaults();
                $arrRoleInputs = array_merge($arrDefaults, [
                    'role' => $arrInputs['role'],
                    'permission' => $strValue
                ]);
                $objRolePermissions->attributes = $arrRoleInputs;
                if ($objRolePermissions->validate()) {
                    $arrValidatedInputs = [];
                    $arrValidatedInputs = $objRolePermissions->getAttributes();
                    unset($arrValidatedInputs['id'], $arrValidatedInputs['last_modified_date']);
                    $arrResponse['new'][] = $arrValidatedInputs;
                } else {
                    $arrResponse['errors'][$i] = $objRolePermissions->errors;
                }
                $i ++;
            }
            if (! isset($arrResponse['errors'])) {
                $arrResponse['inserted_count'] = RolePermissions::create($arrResponse['new']);
                $arrResponse['message'] = 'Role permissions are mapped successfully.';
                unset($arrResponse['new']);
            }
        } else {
            $arrResponse['errors'][0] = [
                'role' => empty($arrInputs['role']) ? 'Role is required' : NULL,
                'permission' => empty($arrPermissions) ? 'Permission is required' : NULL
            ];
        }
        echo Json::encode($arrResponse);
    }

    public function actionGetUser()
    {
        $arrResponse = [];
        $arrInputs = Yii::$app->request->post();
        if (! empty($arrInputs)) {
            $arrResponse = Users::getUsers($arrInputs)[0];
        }
        unset($arrInputs);
        echo Json::encode($arrResponse);
    }

    public function actionGetPermissions()
    {
        $strResponse = NULL;
        $arrInputs = Yii::$app->request->post();
        if (! empty($arrInputs)) {
            // Get Role Permissions
            $arrRolePermissions = RolePermissions::getRolePermissions($arrInputs);
            $arrListOfPermissions = [];
            if (! empty($arrRolePermissions)) {
                foreach ($arrRolePermissions as $arrRolePermission) {
                    $arrListOfPermissions[] = $arrRolePermission['permission'];
                }
                unset($arrRolePermissions);
            }
            // Master Permissions
            $arrPermissions = Permissions::getPermissions();
            foreach ($arrPermissions as $arrPermission) {
                if (in_array($arrPermission['name'], $arrListOfPermissions)) {
                    $strResponse .= "<div class='col-md-3'>
                    <label class='checkbox-inline'> <input type='checkbox'
                        value='" . $arrPermission['name'] . "' name='" . $arrPermission['name'] . "' id='" . $arrInputs['role'] . '-' . $arrPermission['name'] . "' onclick=setPermission('" . $arrInputs['role'] . '-' . $arrPermission['name'] . "') checked>";
                    $strResponse .= $arrPermission['name'];
                    $strResponse .= "</input>
                        </label>
                        </div>";
                } else {
                    $strResponse .= "<div class='col-md-3'>
                    <label class='checkbox-inline'> <input type='checkbox'
                        value='" . $arrPermission['name'] . "' name='" . $arrPermission['name'] . "' id='" . $arrInputs['role'] . '-' . $arrPermission['name'] . "' onclick=setPermission('" . $arrInputs['role'] . '-' . $arrPermission['name'] . "')>";
                    $strResponse .= $arrPermission['name'];
                    $strResponse .= "</input>
                        </label>
                        </div>";
                }
            }
            unset($arrPermissions, $arrInputs);
        }
        echo $strResponse;
    }

    public function actionSetPermission()
    {
        $arrResponse = [];
        $arrInputs = Yii::$app->request->post();
        if (! empty($arrInputs)) {
            $arrInputs['role'] = explode('-', $arrInputs['permission'])[0];
            $arrInputs['permission'] = explode('-', $arrInputs['permission'])[1];
            $arrRolePermission = RolePermissions::getRolePermissions([
                'role' => $arrInputs['role'],
                'permission' => $arrInputs['permission']
            ]);
            $arrPermissionInputs = [];
            if (empty($arrRolePermission)) {
                $arrPermissionInputs[] = [
                    'user_id' => '',
                    'role' => $arrInputs['role'],
                    'is_primary' => '',
                    'permission' => $arrInputs['permission'],
                    'status' => 'active',
                    'created_date' => date('Y-m-d H:i:s'),
                    'created_by' => Yii::$app->session['session_data']['user_id'],
                    'last_modified_by' => Yii::$app->session['session_data']['user_id']
                ];
                $arrResponse['is_updated'] = RolePermissions::create($arrPermissionInputs);
                $arrResponse['message'] = 'Successfully permission added to role';
            } else {
                $arrResponse['is_updated'] = RolePermissions::updateRolePermission([
                    'status' => empty($arrInputs['is_checked']) ? 'inactive' : 'active'
                ], [
                    'role' => $arrInputs['role'],
                    'permission' => $arrInputs['permission']
                ]);
                $arrResponse['message'] = 'Successfully permission updated to role';
            }
        }
        unset($arrInputs);
        echo Json::encode($arrResponse);
    }
}
