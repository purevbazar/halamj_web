<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "general_info".
 *
 * @property integer $id
 * @property string $title
 * @property string $youtube_url
 * @property string $facebook_url
 * @property string $google_gps
 * @property string $contact_phone
 * @property string $greeting
 * @property string $address
 */
class GeneralInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'general_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'google_gps'], 'string', 'max' => 45],
            [['youtube_url'], 'string', 'max' => 200],
            [['contact_phone'], 'string', 'max' => 100],
            [['greeting', 'address', 'facebook_url'], 'string', 'max' => 800]
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
            'youtube_url' => 'Youtube Url',
            'facebook_url' => 'Facebook Url',
            'google_gps' => 'Google Gps',
            'contact_phone' => 'Contact Phone',
            'greeting' => 'Greeting',
            'address' => 'Address',
        ];
    }
}
