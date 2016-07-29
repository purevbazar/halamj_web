<?php 
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, gif'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/banner/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            $banner = \app\models\Banner::findOne(1);
            $banner->banner_name =  'uploads/banner/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            $banner->save();
            return true;
        } else {
            return false;
        }
    }

    public function uploads()
    {
         if ($this->validate()) {
            $this->imageFile->saveAs('uploads/content_title/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            $content = \app\models\Content::find()->orderBy(['id' => SORT_DESC])->one();
            $content->title_photo =  'uploads/content_title/'. $this->imageFile->baseName . '.' . $this->imageFile->extension;
            $content->save();
            return true;
        } else {
            return false;
        }
    }
}
?>