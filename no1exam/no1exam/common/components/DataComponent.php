<?php
namespace common\components;

use Yii;

class DataComponent
{

    public static function educationLevels()
    {
        return [
            'Primary Education' => 'Primary Education',
            'Secondary Education' => 'Secondary Education',
            'Higher Secondary Education' => 'Higher Secondary Education',
            'Pre University' => 'Pre University',
            'Under Graduation' => 'Under Graducation',
            'Post Graduation' => 'Post Graduation'
        ];
    }

    public static function boardCategories()
    {
        return [
            'board' => 'Board',
            'university' => 'University'
        ];
    }

    public static function statuses()
    {
        return [
            'active' => 'Active',
            'inactive' => 'Inactive'
        ];
    }

    public static function getMessageTypes()
    {
        return [
            'sms' => 'SMS',
            'email' => 'E-MAIL'
        ];
    }

    public static function getMessageCategoryTypes()
    {
        return [
            'transactional' => 'Transactional',
            'promotional' => 'Promotional'
        ];
    }

    public static function getRoutes()
    {
        return [
            'sms' => [
                'transactional' => 4,
                'promotional' => 1
            ]
        ];
    }

    public static function getFileTypes()
    {
        return [
            'image' => 'Image',
            'video' => 'Video'
        ];
    }

    public static function getStatuses()
    {
        return [
            'active' => 'Active',
            'inactive' => 'Inactive'
        ];
    }

    public static function getRoleIds()
    {
        $arrRoles = [];
        $intRole = Yii::$app->session['session_data']['role_id'];
        switch ($intRole) {
            case '2':
                $arrRoles = [
                    1,
                    2
                ];
                break;
            default:
                $arrRoles = [
                    1
                ];
        }
        return $arrRoles;
    }

    public static function getSlotTypes()
    {
        return [
            'audition' => 'Audition',
            'preview' => 'Preview'
        ];
    }

    public static function getNotificationCodes()
    {
        return [
            'sms' => [
                'forgotpwd' => 'FGPWD'
            ],
            'email' => []
        ];
    }

    public static function getCompetitiveMethods()
    {
        return [
            'uservsuser' => 'User Vs User',
            'uservsmultiple' => 'User Vs Multiple',
            'uservssystem' => 'User Vs System'
        ];
    }

    public static function getSkipOptions()
    {
        return [
            'yes' => 'Yes',
            'no' => 'no'
        ];
    }

    public static function getYears()
    {
        return [
            1 => 'First Year',
            2 => 'Second Year',
            3 => 'Third Year',
            4 => 'Fourh Year',
            5 => 'Fifth Year'
        ];
    }

    public static function getSems()
    {
        return [
            'semester-1' => 'Semester-1',
            'semester-2' => 'Semester-2',
            'semester-3' => 'Semester-3',
            'semester-4' => 'Semester-4',
            'semester-5' => 'Semester-5',
            'semester-6' => 'Semester-6'
        
        ];
    }

    public static function getQuestionTypes()
    {
        return [
            'text' => 'Text',
            // 'video' => 'Video',
            'image' => 'Image'
        ];
    }

    public static function getQuestionLevels()
    {
        return [
            'easy' => 'Easy',
            'medium' => 'Medium',
            'heard' => 'Hard'
        ];
    }
}
