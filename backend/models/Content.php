<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "content".
 *
 * @property integer $id
 * @property string $title
 * @property string $date
 * @property string $title_photo
 * @property string $description
 * @property string $media_type
 * @property integer $menu_id
 * @property string $title_photo_th
 * @property integer $view_count
 * @property integer $is_breaking
 */
class Content extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content';
    }
    public $cnt;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['menu_id', 'view_count', 'is_breaking'], 'integer'],
            [['title', 'title_photo_th'], 'string', 'max' => 200],
            [['title_photo'], 'string', 'max' => 245],
            [['description'], 'string', 'max' => 1500],
            [['media_type'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'date' => 'Date',
            'title_photo' => 'Title Photo',
            'description' => 'Description',
            'media_type' => 'Media Type',
            'menu_id' => 'Menu ID',
            'title_photo_th' => 'Title Photo Th',
            'view_count' => 'View Count',
            'is_breaking' => 'Is Breaking',
        ];
    }
}
