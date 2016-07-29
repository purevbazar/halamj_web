<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "counter_values".
 *
 * @property string $id
 * @property string $day_id
 * @property string $day_value
 * @property string $yesterday_id
 * @property string $yesterday_value
 * @property string $week_id
 * @property string $week_value
 * @property string $month_id
 * @property string $month_value
 * @property string $year_id
 * @property string $year_value
 * @property string $all_value
 * @property string $record_date
 * @property string $record_value
 */
class CounterValues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'counter_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'day_id', 'day_value', 'yesterday_id', 'yesterday_value', 'week_id', 'week_value', 'month_id', 'month_value', 'year_id', 'year_value', 'all_value', 'record_date', 'record_value'], 'required'],
            [['id', 'day_id', 'day_value', 'yesterday_id', 'yesterday_value', 'week_id', 'week_value', 'month_id', 'month_value', 'year_id', 'year_value', 'all_value', 'record_value'], 'integer'],
            [['record_date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'day_id' => 'Day ID',
            'day_value' => 'Day Value',
            'yesterday_id' => 'Yesterday ID',
            'yesterday_value' => 'Yesterday Value',
            'week_id' => 'Week ID',
            'week_value' => 'Week Value',
            'month_id' => 'Month ID',
            'month_value' => 'Month Value',
            'year_id' => 'Year ID',
            'year_value' => 'Year Value',
            'all_value' => 'All Value',
            'record_date' => 'Record Date',
            'record_value' => 'Record Value',
        ];
    }
}
