<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "complaint".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $complain
 * @property string $last_name
 * @property string $phone
 * @property string $submitted_date
 * @property integer $is_seen
 */
class Complaint extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'complaint';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'complain', 'last_name', 'phone'], 'required'],
            [['submitted_date'], 'safe'],
            [['is_seen'], 'integer'],
            [['name', 'email'], 'string', 'max' => 255],
            [['complain'], 'string', 'max' => 800],
            [['last_name', 'phone'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'complain' => 'Complain',
            'last_name' => 'Last Name',
            'phone' => 'Phone',
            'submitted_date' => 'Submitted Date',
            'is_seen' => 'Is Seen',
        ];
    }
}
