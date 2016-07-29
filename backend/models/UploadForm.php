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
    public $favicon;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'extensions' => 'png, jpg, gif, jpeg'],
            [['favicon'], 'file', 'extensions' => 'png, jpg, gif, jpeg'],
        ];
    }

    public function upload()
    {

        if ($this->validate()) {
            $length = 10;
            $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
            $this->imageFile->saveAs('uploads/banner/' . $randomString . '.' . $this->imageFile->extension);
            $banner = \app\models\Banner::findOne(1);
            if(sizeof($banner)==0){
                $banner = new \app\models\Banner;
            }
            $banner->banner_name =  'uploads/banner/' . $randomString . '.' . $this->imageFile->extension;
            $banner->save();
            return true;
        } else {
            return false;
        }
    }

    public function uploads()
    {

         if ($this->validate()) {
            $length = 10;
            $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
            $this->imageFile->saveAs('uploads/content_title/' . $randomString . '.' . $this->imageFile->extension);
            $content = \app\models\Content::find()->orderBy(['id' => SORT_DESC])->one();
            $content->title_photo =  '/uploads/content_title/'. $randomString . '.' . $this->imageFile->extension;
            $content->title_photo_th =   $randomString . '.' . $this->imageFile->extension;
            $content->save();
            return true;
        } else {
            return false;
        }
    }

     public function upload_link()
    {
         if ($this->validate()) {
            $length = 10;
            $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
            $this->imageFile->saveAs('uploads/link/' . $randomString . '.' . $this->imageFile->extension);
            $link = \app\models\Link::find()->orderBy(['link_id' => SORT_DESC])->one();
            $link->link_pic =  '/uploads/link/'. $randomString . '.' . $this->imageFile->extension;
            $link->save();
            return true;
        } else {
            return false;
        }
    }
    public function upload_general()
    {
         if ($this->validate()) {
            $length = 10;
            $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
            $this->imageFile->saveAs('uploads/general/' . $randomString . '.' . $this->imageFile->extension);
            // if(!empty($this->favicon)){
            // $this->favicon->saveAs('uploads/general/' . $this->favicon->baseName . '.' . $this->favicon->extension);    
            // }
            
            $info = \app\models\GeneralInfo::findOne(1);
            $info->header_photo =  '/uploads/general/'. $randomString . '.' . $this->imageFile->extension;
            //   if(!empty($this->favicon)){
            // $info->favicon =  '/uploads/general/'. $this->favicon->baseName . '.' . $this->favicon->extension;
            // }
            $info->save();
                return true;
            } else {
                return false;
        }
    }
}
?>