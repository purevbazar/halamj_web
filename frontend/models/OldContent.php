<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "old_content".
 *
 * @property integer $old_content_id
 * @property string $old_content_title
 * @property string $old_content_date
 * @property string $old_content_pic
 * @property string $old_content_body
 * @property string $youtube_url
 * @property integer $old_content_type_id
 * @property integer $ishomepage
 * @property integer $menu_id
 */
class OldContent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'old_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['old_content_date'], 'safe'],
            [['old_content_pic', 'old_content_body'], 'string'],
            [['old_content_type_id', 'ishomepage', 'menu_id'], 'integer'],
            [['old_content_title'], 'string', 'max' => 425],
            [['youtube_url'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'old_content_id' => 'Old Content ID',
            'old_content_title' => 'Old Content Title',
            'old_content_date' => 'Old Content Date',
            'old_content_pic' => 'Old Content Pic',
            'old_content_body' => 'Old Content Body',
            'youtube_url' => 'Youtube Url',
            'old_content_type_id' => 'Old Content Type ID',
            'ishomepage' => 'Ishomepage',
            'menu_id' => 'Menu ID',
        ];
    }
}
