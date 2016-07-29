<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "album_images".
 *
 * @property integer $id
 * @property string $file_name
 * @property string $album_id
 */
class AlbumImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'album_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file_name', 'album_id'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file_name' => 'File Name',
            'album_id' => 'Album ID',
        ];
    }
}
