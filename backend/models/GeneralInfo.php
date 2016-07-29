<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "general_info".
 *
 * @property integer $id
 * @property string $title
 * @property string $header_photo
 * @property string $favicon
 * @property string $youtube_url
 * @property string $facebook_url
 * @property string $google_gps
 * @property string $contact_phone
 * @property string $greeting
 * @property string $address
 * @property string $fax
 * @property string $email
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
            [['header_photo', 'favicon'], 'string'],
            [['title', 'google_gps'], 'string', 'max' => 45],
            [['youtube_url'], 'string', 'max' => 200],
            [['facebook_url', 'greeting', 'address'], 'string', 'max' => 800],
            [['contact_phone', 'fax'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 245]
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
            'header_photo' => 'Header Photo',
            'favicon' => 'Favicon',
            'youtube_url' => 'Youtube Url',
            'facebook_url' => 'Facebook Url',
            'google_gps' => 'Google Gps',
            'contact_phone' => 'Contact Phone',
            'greeting' => 'Greeting',
            'address' => 'Address',
            'fax' => 'Fax',
            'email' => 'Email',
        ];
    }
}
