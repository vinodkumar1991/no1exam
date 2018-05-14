<?php
namespace backend\modules\quiz\models;

use yii\db\ActiveRecord;
use Yii;
use yii\db\Query;

class QuestionAnswers extends ActiveRecord
{

    public static function tableName()
    {
        return 'question_answers';
    }

    public static function create($arrInputs)
    {
        $intInsert = Yii::$app->db->createCommand()
            ->batchInsert('question_answers', [
            'question_id',
            'answer',
            'status',
            'is_correct_answer'
        ], $arrInputs)
            ->execute();
        return $intInsert;
    }
}
 