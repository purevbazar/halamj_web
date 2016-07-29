<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "complain_solved".
 *
 * @property integer $id
 * @property string $solution
 * @property integer $is_solved
 * @property integer $complain_id
 */
class ComplainSolved extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'complain_solved';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_solved', 'complain_id'], 'integer'],
            [['solution'], 'string', 'max' => 800]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'solution' => 'Solution',
            'is_solved' => 'Is Solved',
            'complain_id' => 'Complain ID',
        ];
    }
}
