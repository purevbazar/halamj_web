<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\imagine\Image;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', ],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'complain', 'link', 'general', 'generalsubmit', 
                                    'banner', 'content', 'menu', 'upload', 'lists', 'addmenu', 'viewmenu', 'menuedit',
                                    'menudelete', 'addcontent', 'viewcontent', 'addlink', 'viewlink', 'editlink', 
                                    'linkdelete', 'solvecomplain', 'viewcomplain', 'editcontent', 'contentdelete', 'album', 'albumupload',
                                    'addalbum', 'viewalbum', 'deleteimage', 'faq', 'addfaq', 'editfaq', 'deletefaq', 'viewfaq', 'staticmenu',
                                    'addstaticmenu', 'changepwd', 'chngpwd', 'deletealbum', 'usermanual'
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */

    public function beforeAction($action) {
    $this->enableCsrfValidation = false;
    return parent::beforeAction($action);
    }       
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $mostView = \app\models\Content::find()->andWhere(['not', ['title' => null]])->orderBy('view_count desc')->limit(5)->all();
        $general = \app\models\GeneralInfo::findOne(1);
        $counter = \app\models\CounterValues::findOne(1);
        $special = \app\models\Content::find()->andWhere(['media_type'=>1])->count();
        $typical = \app\models\Content::find()->andWhere(['media_type'=>2])->count();
        $album = \app\models\Album::find()->count();
        $faq = \app\models\Faq::find()->count();
        $complain = \app\models\Complaint::find()->count();
        $solved = \app\models\ComplainSolved::find()->count();
        $link = \app\models\Link::find()->count();
        $unsolved = $complain - $solved;
        $count = \app\models\Content::find()
        ->select(['menu_id, COUNT(menu_id) AS cnt'])
        ->groupBy(['menu_id'])
        ->orderBy(['COUNT(menu_id)' => SORT_DESC])
        ->limit(10)
        ->all();

        $countEq = \app\models\Content::find()
        ->select(['menu_id, COUNT(menu_id) AS cnt'])
        ->groupBy(['menu_id'])
        ->orderBy(['COUNT(menu_id)' => SORT_DESC])
        ->count();

        $totalCount = \app\Models\Content::find()->count();
        return $this->render('index', ['special'=>$special, 'typical'=>$typical, 'album'=>$album, 'faq'=>$faq, 'unsolved'=>$unsolved,
            'link'=>$link, 'general'=>$general, 'countEq'=>$countEq,'counter'=>$counter, 'count'=>$count, 'totalCount'=>$totalCount ,'mostView'=>$mostView] );
    }


    public function actionGeneral()
    {
        $models = new \app\models\UploadForm();

        if(is_null(\app\models\GeneralInfo::findOne(1)))
        {
            $model = new \app\models\GeneralInfo;    
        }
        else{
            $model = \app\models\GeneralInfo::findOne(1);     
        }
            return $this->render('general', [
                'model' => $model, 'models' => $models,
            ]);
        
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */



    // public function actionAbout()
    // {

    // }
    public function actionFaq()
    {
        $model = new \app\models\Faq;
        $models =  \app\models\Faq::find()->all();
        return $this->render('faq', ['model'=>$model, 'models'=>$models]);
    }

    public function actionStaticmenu()
    {
        return $this->render('static_menu');
    }

    public function actionAddfaq()
    {
        $request = Yii::$app->request;
        $model = new \app\models\Faq;
        $model->question = $request->post('question');
        $model->answer = $request->post('answer');
        $model->save();
        $models =  \app\models\Faq::find()->all();
        return $this->render('faq', ['model'=>$model, 'models'=>$models]);
    }

    public function actionViewfaq($id)
    {
        $model = \app\models\Faq::findOne($id);
        return $this->render('edit_faq', ['model'=>$model]);
    }

    public function actionUsermanual()
    {
        return $this->render('user_manual');
    }

     public function actionEditfaq()
    {
        $request = Yii::$app->request;
        $model = \app\models\Faq::findOne($request->post('id'));
        $model->question = $request->post('question');
        $model->answer = $request->post('answer');
        $model->save();
        $models =  \app\models\Faq::find()->all();
        return $this->render('faq', ['model'=>$model, 'models'=>$models]);

    }

    public function actionDeletefaq($id)
    {
        $model = \app\models\Faq::findOne($id);
        $model->delete();
        $models =  \app\models\Faq::find()->all();
        return $this->render('faq', ['model'=>$model, 'models'=>$models]);
    }

    public function actionAlbum()
    {   
        $model = new \app\models\Album;
        $albums = \app\models\Album::find()->all();
        $count = \app\models\Album::find()->count();
        return $this->render('album', [
            'count'=>$count,'model'=>$model, 'albums'=>$albums]);
    }

    public function actionAlbumupload()
    {
        $fileName = 'file';
        $uploadPath = 'uploads/album';

        if (isset($_FILES[$fileName])) {
            $file = \yii\web\UploadedFile::getInstanceByName($fileName);

            //Print file data
            //print_r($file);

            if ($file->saveAs($uploadPath . '/' . $file->name)) {

                $obj = new \app\models\AlbumImages;
                $obj->file_name = $file->name;
                $obj->album_id = $_POST['album_id'];
                $obj->save();
              //  $obj->album_id
                //Now save file data to database

                echo \yii\helpers\Json::encode($file);
            }
            else{
                return $this->render('album');
            }
        }
           return false;    
    }

    public function actionAddalbum()
    {
        $model = new \app\models\Album;
        $request = Yii::$app->request;
        $model->name = $request->post('title');
        $model->description = $request->post('description');
        $model->date =new \yii\db\Expression('NOW()');
        $model->save();
        return Yii::$app->runAction('site/album');
    }

    public function actionViewalbum($id)
    {   
        $models = \app\models\Album::findOne($id);
        $model = \app\models\AlbumImages::find()->where(['album_id'=>$id])->all();
        return $this->render('view_album', ['model'=>$model,
          'models'=>$models]);
    }

    public function actionDeleteimage($id)
    {
        $model = \app\models\AlbumImages::findOne($id);
        $parent = $model->album_id;
        unlink(Yii::$app->basePath. '/web/uploads/album/'.$model->file_name);
        $model->delete();
        return $this->redirect('index.php?r=site%2Fviewalbum&id='.$parent, [
        'model' => $model]);
    }

    public function actionDeletealbum($id)
    {
        $album = \app\models\Album::findOne($id);
        $images = \app\models\AlbumImages::find()->andWhere(['album_id'=>$id])->all();
        foreach($images as $image){
            unlink(Yii::$app->basePath. '/web/uploads/album/'.$image->file_name);
            $image->delete();
        }
        $album->delete();
        return $this->redirect('index.php?r=site%2Falbum');
    }
    /**
     * Signs user up.
     *
     * @return mixed
     */
    // public function actionSignup()
    // {
    //     $model = new SignupForm();
    //     if ($model->load(Yii::$app->request->post())) {
    //         if ($user = $model->signup()) {
    //             if (Yii::$app->getUser()->login($user)) {
    //                 return $this->goHome();
    //             }
    //         }
    //     }

    //     return $this->render('signup', [
    //         'model' => $model,
    //     ]);
    // }

    // /**
    //  * Requests password reset.
    //  *
    //  * @return mixed
    //  */
    // public function actionRequestPasswordReset()
    // {
    //     $model = new PasswordResetRequestForm();
    //     if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    //         if ($model->sendEmail()) {
    //             Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

    //             return $this->goHome();
    //         } else {
    //             Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
    //         }
    //     }

    //     return $this->render('requestPasswordResetToken', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
   /* public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }*/

    public function actionChangepwd()
    {
       $modeluser = new \app\models\User;
       $errorMessage = "";   
        return $this->render('changepwd', [
            'modeluser'=>$modeluser, 'errorMessage'=>$errorMessage]);
    }

    public function actionChngpwd()
    {
        $request = Yii::$app->request;
        $existing = \app\models\User::find()->where([
            'username'=>Yii::$app->user->identity->username
        ])->one();
        if( Yii::$app->getSecurity()->validatePassword($request->post('current_pwd'),$existing->password_hash)){
            $existing->password_hash = Yii::$app->security->generatePasswordHash($request->post('new_pwd'));
            $existing->save();
            $errorMessage="";
        }
        else {
            $errorMessage = "Одоогийн нууц үг буруу байна!";   
        }

       
       

        $modeluser = new \app\models\User;
        return $this->render('changepwd', [
            'modeluser'=>$modeluser, 'errorMessage'=>$errorMessage]);

    }

    public function actionGeneralsubmit()
    {
        $request = Yii::$app->request;
        if(sizeof(\app\models\GeneralInfo::findOne(1))==0){
            $model = new \app\models\GeneralInfo;    
        }
        else{
            $model = \app\models\GeneralInfo::findOne(1);     
        }
        $model->title = $request->post('title');
        $model->facebook_url = $request->post('facebook');
        $model->google_gps = $request->post('google');
        $model->youtube_url = $request->post('youtube');
        $model->contact_phone = $request->post('phone');
        $model->address = $request->post('address');
        $model->greeting = $request->post('greeting');  
        $model->fax = $request->post('fax');
        $model->email = $request->post('email');    
        $model->save(); 
       
        $model =new \app\models\UploadForm();
         if(sizeof(UploadedFile::getInstance($model, 'imageFile'))!=0){
            if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
          //  $model->favicon =  UploadedFile::getInstance($model, 'favicon');
            if ($model->upload_general()) {
               
            }
            else{
                $info = \app\models\GeneralInfo::findOne(1);
                $info->header_photo = '/images/hlj.png';
                $info->save();
            }
       }   
         };
        
         $models = new \app\models\UploadForm();

        if(sizeof(\app\models\GeneralInfo::findOne(1))==0)
        {
            $model = new \app\models\GeneralInfo;    
        }
        else{
            $model = \app\models\GeneralInfo::findOne(1);     
        }
            return $this->redirect('index.php?r=site%2Fgeneral', [
        'model' => $model]);
    }
    public function actionBanner()
    {
        $models = \app\models\Banner::findone(1);
        $model =new \app\models\UploadForm();

        return $this->render('banner', [
            'model' => $model, 'models'=>$models
        ]);
    }

    public function actionContent()
    {
        $models =new \app\models\UploadForm();
        $model = new \app\models\Content;
        $content = \app\models\Content::find()->all();;
        return $this->render('content', [
            'model' => $model,  'models' => $models, 'content' => $content
        ]);
    }

     public function actionMenu()
    {
      return $this->render('menu');
    }

     public function actionUpload()
    {
       
        $model = new \app\models\UploadForm();
        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
              // file is uploaded successfully
              //  Yii::$app->session->setFlash('success', 'Амжилттай шинэчлэгдлээ !');
            }
            else{
              //   Yii::$app->session->setFlash('fail', 'Алдаа гарлаа. Оруулсан зураг тань [.jpg, .jpeg, .png, .gif] өргөтгөлтэй байхаас гадна латин нэртэй байна гэдгийг анхаарна уу!');
            }
       }
    $models = \app\models\Banner::findOne(1);
     return $this->render('banner', [
        'model' => $model, 'models' => $models]);
    }
    public function actionLists($id)
    {
      $countSubMenu = \app\models\Menu::find()
      ->where(['sort'=>$id])
      ->count();

       $obj = \app\models\Menu::find()
      ->where(['sort'=>$id])
      ->all();

      if($id!=0&&$countSubMenu > 0){
        foreach($obj as $ob){
          echo "<option value='".$ob->menu_id." '>".$ob->menu_name."</option>";
        }
      }
        else{
          echo "<option value='0'>-</option>";
        }
    }

    public function actionAddmenu()
    {
        $request = Yii::$app->request;
        $model = new \app\models\Menu;
        $model->menu_name = $request->post('title_name');
        $model->sort = $request->post('sort_level');

        if(is_null($request->post('parent_level'))){
            $model->parent_id = 0;
        }
        else{
            $model->parent_id = $request->post('parent_level');
        }
        
        $model->save();
        return Yii::$app->runAction('site/menu');
    }

     public function actionAddstaticmenu()
    {
        $request = Yii::$app->request;
        $model = new \app\models\Menu;
        $model->menu_name = $request->post('title_name');
        $model->sort = $request->post('root_level');
        $model->url = $request->post('url');
        $model->is_static = 1;
        if(is_null($request->post('parent_level'))){
            $model->parent_id = 0;
        }
        else{
            $model->parent_id = $request->post('parent_level');
        }
        
        $model->save();
       return $this->render('static_menu');
    }
    
    public function actionViewmenu($id)
    {
        $model = \app\models\Menu::findOne($id);
        return $this->render('view_menu', [
          'model'=>$model]);
    }

    public function actionMenuedit()
    {
        $request = Yii::$app->request;
        $id=$request->post('id');
        $model = \app\models\Menu::findOne($id);
        $model->menu_name = $request->post('title');
        $model->sort = $request->post('root_level');
        $model->parent_id = $request->post('parent_level');
        $model->save();
         return $this->redirect('index.php?r=site%2Fmenu');
    }

    public function actionMenudelete($id)
    {
        $model = \app\models\Menu::findOne($id);
        $model->delete();
        \app\models\Menu::deleteAll(['parent_id'=>$id]);
        return Yii::$app->runAction('site/menu');
    }

    public function actionAddcontent()
    {
        $request = Yii::$app->request;
        $model = new \app\models\Content;
        $model->title = $request->post('content_title');
        $model->date = $request->post('content_date');
        $model->description = $request->post('content');
        $model->media_type = $request->post('content_type');
        $model->menu_id = $request->post('content_menu');
        $model->is_breaking = $request->post('breaking');
        $model->save();

        if(strlen($request->post('p1'))!=0){
            $model =new \app\models\UploadForm();
            if (Yii::$app->request->isPost) {
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

                if ($model->uploads()) {
               
                   $content = \app\models\Content::find()->orderBy(['id' => SORT_DESC])->one();
                     if($content->media_type==1){
                         Image::thumbnail(substr($content->title_photo,1), 100, 75)
                  ->save('uploads/content_title/thumbnail/'.$content->title_photo_th, ['quality' => 80]);}    
                }
                    
                else
                {
                    $content = \app\models\Content::find()->orderBy(['id' => SORT_DESC])->one();
                    $content->title_photo = 'images/hlj.png';
                    $content->save();
                }
           }
       }
        
        $models =new \app\models\UploadForm();
        $model = new \app\models\Content;
        return $this->redirect('index.php?r=site%2Fcontent', [
            'model' => $model,  'models' => $models
        ]);
    }

    public function actionViewcontent($id)
    {   
        $models =new \app\models\UploadForm();
        $model = \app\models\Content::findOne($id);
        return $this->render('view_content', [
          'models'=>$models,'model'=>$model]);
    }
    
    public function actionLink()
    {
        $models = new \app\models\UploadForm();
        return $this->render('link', [
            'models' => $models,
        ]);
    }
    
    public function actionAddlink()
    {
        $request = Yii::$app->request;
        $model = new \app\models\Link;
        $model->link_url = $request->post('T1');
        $model->save();
        $model =new \app\models\UploadForm();
        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload_link()) {
                //Yii::$app->session->setFlash('success', 'Амжилттай шинэчлэгдлээ !');
                // file is uploaded successfully
            }
       }
     return $this->redirect('index.php?r=site%2Flink', [
        'model' => $model]);
    }

    public function actionViewlink($id)
    {
        $models =new \app\models\UploadForm();
        $model = \app\models\Link::findOne($id);
        return $this->render('view_link', [
          'models'=>$models,'model'=>$model]);
    }

    public function actionEditlink()
    {
        $request = Yii::$app->request;
        $id=$request->post('id');
        $model = \app\models\Link::findOne($id);
        $model->link_url = $request->post('content_title');
        $model->save();
        $model =new \app\models\UploadForm();
        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload_link()) {
                // file is uploaded successfully
            }
       }
        $models =new \app\models\UploadForm();
        $model = new \app\models\Content;
        $content = \app\models\Content::find()->all();;
        return $this->render('Content', [
            'model' => $model,  'models' => $models, 'content' => $content
        ]);
    }

    public function actionLinkdelete($id)
    {
        $model = \app\models\Link::findOne($id);
        $model->delete();
        return Yii::$app->runAction('site/link');
    }

    public function actionComplain()
    {
       return $this->render('complain');
    }

    public function actionViewcomplain($id)
    {   
        $model = \app\models\Complaint::findOne($id);
        return $this->render('view_complain', [
            'model'=>$model]);
    }

    private $from = 'purevbazar@halamj.gov.mn';


     public function actionSolvecomplain()
    {   
        $request = Yii::$app->request;
        $name = mb_convert_case($request->post('T3'), MB_CASE_TITLE, 'UTF-8');
        $complain = $request->post('T4');
        $date = $request->post('T5');
        $email = $request->post('T6');
        $solution = $request->post('T1');
        $complain_id= $request->post('T0');
        $general = \app\models\GeneralInfo::findOne(1);
        $contact_phone = $general->contact_phone;
        $contact_email = $general->email;
        $contact_fax = $general->fax;
        $contact_address = $general->address;
        $contact_facebook = $general->facebook_url;
        $initial = \app\models\ComplainSolved::find()->where(['complain_id'=>$complain_id])->one();

                 if(is_null($initial)){
                    $model = new \app\models\ComplainSolved;
                }
                else{
                        $model = $initial;
                }

        $model->solution = $request->post('T1');
        $model->is_solved = $request->post('T2');
        $model->complain_id = $request->post('T0');
        $model->save();
                 Yii::$app->mailer->compose()
                    ->setFrom($this->from)
                    ->setTo($email)
                    ->setSubject('Нийгмийн халамжийн хэлтсээс.. ')
                    ->sethtmlBody('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width">
        <style>#outlook a{padding:0;}body{width:100%!important;min-width:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;margin:0;Margin:0;padding:0;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box;}.ExternalClass{width:100%;}.ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div{line-height:100%;}#backgroundTable{margin:0;Margin:0;padding:0;width:100%!important;line-height:100%!important;}img{outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;width:auto;max-width:100%;clear:both;display:block;}center{width:100%;min-width:580px;}a img{border:none;}p{margin:0 0 0 10px;Margin:0 0 0 10px;}table{border-spacing:0;border-collapse:collapse;}td{word-wrap:break-word;-webkit-hyphens:auto;-moz-hyphens:auto;hyphens:auto;border-collapse:collapse!important;}table,tr,td{padding:0;vertical-align:top;text-align:left;}html{min-height:100%;background:#f3f3f3;}table.body{background:#f3f3f3;height:100%;width:100%;}table.container{background:#fefefe;width:580px;margin:0 auto;Margin:0 auto;text-align:inherit;}table.row{padding:0;width:100%;position:relative;}table.container table.row{display:table;}td.columns,td.column,th.columns,th.column{margin:0 auto;Margin:0 auto;padding-left:16px;padding-bottom:16px;}td.columns.last,td.column.last,th.columns.last,th.column.last{padding-right:16px;}td.columns table,td.column table,th.columns table,th.column table{width:100%;}td.large-1,th.large-1{width:32.33333px;padding-left:8px;padding-right:8px;}td.large-1.first,th.large-1.first{padding-left:16px;}td.large-1.last,th.large-1.last{padding-right:16px;}.collapse>tbody>tr>td.large-1,.collapse>tbody>tr>th.large-1{padding-right:0;padding-left:0;width:48.33333px;}.collapse td.large-1.first,.collapse th.large-1.first,.collapse td.large-1.last,.collapse th.large-1.last{width:56.33333px;}td.large-2,th.large-2{width:80.66667px;padding-left:8px;padding-right:8px;}td.large-2.first,th.large-2.first{padding-left:16px;}td.large-2.last,th.large-2.last{padding-right:16px;}.collapse>tbody>tr>td.large-2,.collapse>tbody>tr>th.large-2{padding-right:0;padding-left:0;width:96.66667px;}.collapse td.large-2.first,.collapse th.large-2.first,.collapse td.large-2.last,.collapse th.large-2.last{width:104.66667px;}td.large-3,th.large-3{width:129px;padding-left:8px;padding-right:8px;}td.large-3.first,th.large-3.first{padding-left:16px;}td.large-3.last,th.large-3.last{padding-right:16px;}.collapse>tbody>tr>td.large-3,.collapse>tbody>tr>th.large-3{padding-right:0;padding-left:0;width:145px;}.collapse td.large-3.first,.collapse th.large-3.first,.collapse td.large-3.last,.collapse th.large-3.last{width:153px;}td.large-4,th.large-4{width:177.33333px;padding-left:8px;padding-right:8px;}td.large-4.first,th.large-4.first{padding-left:16px;}td.large-4.last,th.large-4.last{padding-right:16px;}.collapse>tbody>tr>td.large-4,.collapse>tbody>tr>th.large-4{padding-right:0;padding-left:0;width:193.33333px;}.collapse td.large-4.first,.collapse th.large-4.first,.collapse td.large-4.last,.collapse th.large-4.last{width:201.33333px;}td.large-5,th.large-5{width:225.66667px;padding-left:8px;padding-right:8px;}td.large-5.first,th.large-5.first{padding-left:16px;}td.large-5.last,th.large-5.last{padding-right:16px;}.collapse>tbody>tr>td.large-5,.collapse>tbody>tr>th.large-5{padding-right:0;padding-left:0;width:241.66667px;}.collapse td.large-5.first,.collapse th.large-5.first,.collapse td.large-5.last,.collapse th.large-5.last{width:249.66667px;}td.large-6,th.large-6{width:274px;padding-left:8px;padding-right:8px;}td.large-6.first,th.large-6.first{padding-left:16px;}td.large-6.last,th.large-6.last{padding-right:16px;}.collapse>tbody>tr>td.large-6,.collapse>tbody>tr>th.large-6{padding-right:0;padding-left:0;width:290px;}.collapse td.large-6.first,.collapse th.large-6.first,.collapse td.large-6.last,.collapse th.large-6.last{width:298px;}td.large-7,th.large-7{width:322.33333px;padding-left:8px;padding-right:8px;}td.large-7.first,th.large-7.first{padding-left:16px;}td.large-7.last,th.large-7.last{padding-right:16px;}.collapse>tbody>tr>td.large-7,.collapse>tbody>tr>th.large-7{padding-right:0;padding-left:0;width:338.33333px;}.collapse td.large-7.first,.collapse th.large-7.first,.collapse td.large-7.last,.collapse th.large-7.last{width:346.33333px;}td.large-8,th.large-8{width:370.66667px;padding-left:8px;padding-right:8px;}td.large-8.first,th.large-8.first{padding-left:16px;}td.large-8.last,th.large-8.last{padding-right:16px;}.collapse>tbody>tr>td.large-8,.collapse>tbody>tr>th.large-8{padding-right:0;padding-left:0;width:386.66667px;}.collapse td.large-8.first,.collapse th.large-8.first,.collapse td.large-8.last,.collapse th.large-8.last{width:394.66667px;}td.large-9,th.large-9{width:419px;padding-left:8px;padding-right:8px;}td.large-9.first,th.large-9.first{padding-left:16px;}td.large-9.last,th.large-9.last{padding-right:16px;}.collapse>tbody>tr>td.large-9,.collapse>tbody>tr>th.large-9{padding-right:0;padding-left:0;width:435px;}.collapse td.large-9.first,.collapse th.large-9.first,.collapse td.large-9.last,.collapse th.large-9.last{width:443px;}td.large-10,th.large-10{width:467.33333px;padding-left:8px;padding-right:8px;}td.large-10.first,th.large-10.first{padding-left:16px;}td.large-10.last,th.large-10.last{padding-right:16px;}.collapse>tbody>tr>td.large-10,.collapse>tbody>tr>th.large-10{padding-right:0;padding-left:0;width:483.33333px;}.collapse td.large-10.first,.collapse th.large-10.first,.collapse td.large-10.last,.collapse th.large-10.last{width:491.33333px;}td.large-11,th.large-11{width:515.66667px;padding-left:8px;padding-right:8px;}td.large-11.first,th.large-11.first{padding-left:16px;}td.large-11.last,th.large-11.last{padding-right:16px;}.collapse>tbody>tr>td.large-11,.collapse>tbody>tr>th.large-11{padding-right:0;padding-left:0;width:531.66667px;}.collapse td.large-11.first,.collapse th.large-11.first,.collapse td.large-11.last,.collapse th.large-11.last{width:539.66667px;}td.large-12,th.large-12{width:564px;padding-left:8px;padding-right:8px;}td.large-12.first,th.large-12.first{padding-left:16px;}td.large-12.last,th.large-12.last{padding-right:16px;}.collapse>tbody>tr>td.large-12,.collapse>tbody>tr>th.large-12{padding-right:0;padding-left:0;width:580px;}.collapse td.large-12.first,.collapse th.large-12.first,.collapse td.large-12.last,.collapse th.large-12.last{width:588px;}td.large-1 center,th.large-1 center{min-width:0.33333px;}td.large-2 center,th.large-2 center{min-width:48.66667px;}td.large-3 center,th.large-3 center{min-width:97px;}td.large-4 center,th.large-4 center{min-width:145.33333px;}td.large-5 center,th.large-5 center{min-width:193.66667px;}td.large-6 center,th.large-6 center{min-width:242px;}td.large-7 center,th.large-7 center{min-width:290.33333px;}td.large-8 center,th.large-8 center{min-width:338.66667px;}td.large-9 center,th.large-9 center{min-width:387px;}td.large-10 center,th.large-10 center{min-width:435.33333px;}td.large-11 center,th.large-11 center{min-width:483.66667px;}td.large-12 center,th.large-12 center{min-width:532px;}.body .columns td.large-1,.body .column td.large-1,.body .columns th.large-1,.body .column th.large-1{width:8.33333%;}.body .columns td.large-2,.body .column td.large-2,.body .columns th.large-2,.body .column th.large-2{width:16.66667%;}.body .columns td.large-3,.body .column td.large-3,.body .columns th.large-3,.body .column th.large-3{width:25%;}.body .columns td.large-4,.body .column td.large-4,.body .columns th.large-4,.body .column th.large-4{width:33.33333%;}.body .columns td.large-5,.body .column td.large-5,.body .columns th.large-5,.body .column th.large-5{width:41.66667%;}.body .columns td.large-6,.body .column td.large-6,.body .columns th.large-6,.body .column th.large-6{width:50%;}.body .columns td.large-7,.body .column td.large-7,.body .columns th.large-7,.body .column th.large-7{width:58.33333%;}.body .columns td.large-8,.body .column td.large-8,.body .columns th.large-8,.body .column th.large-8{width:66.66667%;}.body .columns td.large-9,.body .column td.large-9,.body .columns th.large-9,.body .column th.large-9{width:75%;}.body .columns td.large-10,.body .column td.large-10,.body .columns th.large-10,.body .column th.large-10{width:83.33333%;}.body .columns td.large-11,.body .column td.large-11,.body .columns th.large-11,.body .column th.large-11{width:91.66667%;}.body .columns td.large-12,.body .column td.large-12,.body .columns th.large-12,.body .column th.large-12{width:100%;}td.large-offset-1,td.large-offset-1.first,td.large-offset-1.last,th.large-offset-1,th.large-offset-1.first,th.large-offset-1.last{padding-left:64.33333px;}td.large-offset-2,td.large-offset-2.first,td.large-offset-2.last,th.large-offset-2,th.large-offset-2.first,th.large-offset-2.last{padding-left:112.66667px;}td.large-offset-3,td.large-offset-3.first,td.large-offset-3.last,th.large-offset-3,th.large-offset-3.first,th.large-offset-3.last{padding-left:161px;}td.large-offset-4,td.large-offset-4.first,td.large-offset-4.last,th.large-offset-4,th.large-offset-4.first,th.large-offset-4.last{padding-left:209.33333px;}td.large-offset-5,td.large-offset-5.first,td.large-offset-5.last,th.large-offset-5,th.large-offset-5.first,th.large-offset-5.last{padding-left:257.66667px;}td.large-offset-6,td.large-offset-6.first,td.large-offset-6.last,th.large-offset-6,th.large-offset-6.first,th.large-offset-6.last{padding-left:306px;}td.large-offset-7,td.large-offset-7.first,td.large-offset-7.last,th.large-offset-7,th.large-offset-7.first,th.large-offset-7.last{padding-left:354.33333px;}td.large-offset-8,td.large-offset-8.first,td.large-offset-8.last,th.large-offset-8,th.large-offset-8.first,th.large-offset-8.last{padding-left:402.66667px;}td.large-offset-9,td.large-offset-9.first,td.large-offset-9.last,th.large-offset-9,th.large-offset-9.first,th.large-offset-9.last{padding-left:451px;}td.large-offset-10,td.large-offset-10.first,td.large-offset-10.last,th.large-offset-10,th.large-offset-10.first,th.large-offset-10.last{padding-left:499.33333px;}td.large-offset-11,td.large-offset-11.first,td.large-offset-11.last,th.large-offset-11,th.large-offset-11.first,th.large-offset-11.last{padding-left:547.66667px;}td.expander,th.expander{visibility:hidden;width:0;padding:0!important;}.block-grid{width:100%;max-width:580px;}.block-grid td{display:inline-block;padding:8px;}.up-2 td{width:274px!important;}.up-3 td{width:177px!important;}.up-4 td{width:129px!important;}.up-5 td{width:100px!important;}.up-6 td{width:80px!important;}.up-7 td{width:66px!important;}.up-8 td{width:56px!important;}table.text-center,td.text-center,h1.text-center,h2.text-center,h3.text-center,h4.text-center,h5.text-center,h6.text-center,p.text-center,span.text-center{text-align:center;}h1.text-left,h2.text-left,h3.text-left,h4.text-left,h5.text-left,h6.text-left,p.text-left,span.text-left{text-align:left;}h1.text-right,h2.text-right,h3.text-right,h4.text-right,h5.text-right,h6.text-right,p.text-right,span.text-right{text-align:right;}span.text-center{display:block;width:100%;text-align:center;}@media only screen and (max-width: 596px) {.small-float-center{margin:0 auto!important;float:none!important;text-align:center!important;}.small-text-center{text-align:center!important;}.small-text-left{text-align:left!important;}.small-text-right{text-align:right!important;}}img.float-left{float:left;text-align:left;}img.float-right{float:right;text-align:right;}img.float-center,img.text-center{margin:0 auto;Margin:0 auto;float:none;text-align:center;}table.float-center,td.float-center,th.float-center{margin:0 auto;Margin:0 auto;float:none;text-align:center;}table.body table.container .hide-for-large{display:none;width:0;mso-hide:all;overflow:hidden;max-height:0px;font-size:0;width:0px;line-height:0;}@media only screen and (max-width: 596px) {table.body table.container .hide-for-large{display:block!important;width:auto!important;overflow:visible!important;}}table.body table.container .hide-for-large *{mso-hide:all;}@media only screen and (max-width: 596px) {table.body table.container .row.hide-for-large,table.body table.container .row.hide-for-large{display:table!important;width:100%!important;}}@media only screen and (max-width: 596px) {table.body table.container .show-for-large{display:none!important;width:0;mso-hide:all;overflow:hidden;}}body,table.body,h1,h2,h3,h4,h5,h6,p,td,th,a{color:#0a0a0a;font-family:Helvetica,Arial,sans-serif;font-weight:normal;padding:0;margin:0;Margin:0;text-align:left;line-height:1.3;}h1,h2,h3,h4,h5,h6{color:inherit;word-wrap:normal;font-family:Helvetica,Arial,sans-serif;font-weight:normal;margin-bottom:10px;Margin-bottom:10px;}h1{font-size:34px;}h2{font-size:30px;}h3{font-size:28px;}h4{font-size:24px;}h5{font-size:20px;}h6{font-size:18px;}body,table.body,p,td,th{font-size:16px;line-height:19px;}p{margin-bottom:10px;Margin-bottom:10px;}p.lead{font-size:20px;line-height:1.6;}p.subheader{margin-top:4px;margin-bottom:8px;Margin-top:4px;Margin-bottom:8px;font-weight:normal;line-height:1.4;color:#8a8a8a;}small{font-size:80%;color:#cacaca;}a{color:#2199e8;text-decoration:none;}a:hover{color:#147dc2;}a:active{color:#147dc2;}a:visited{color:#2199e8;}h1 a,h1 a:visited,h2 a,h2 a:visited,h3 a,h3 a:visited,h4 a,h4 a:visited,h5 a,h5 a:visited,h6 a,h6 a:visited{color:#2199e8;}pre{background:#f3f3f3;margin:30px 0;Margin:30px 0;}pre code{color:#cacaca;}pre code span.callout{color:#8a8a8a;font-weight:bold;}pre code span.callout-strong{color:#ff6908;font-weight:bold;}hr{max-width:580px;height:0;border-right:0;border-top:0;border-bottom:1px solid #cacaca;border-left:0;margin:20px auto;Margin:20px auto;clear:both;}.stat{font-size:40px;line-height:1;}p+.stat{margin-top:-16px;Margin-top:-16px;}table.button{width:auto!important;margin:0 0 16px 0;Margin:0 0 16px 0;}table.button table td{width:auto!important;text-align:left;color:#fefefe;background:#2199e8;border:2px solid #2199e8;}table.button table td.radius{border-radius:3px;}table.button table td.rounded{border-radius:500px;}table.button table td a{font-family:Helvetica,Arial,sans-serif;font-size:16px;font-weight:bold;color:#fefefe;text-decoration:none;display:inline-block;padding:8px 16px 8px 16px;border:0px solid #2199e8;border-radius:3px;}table.button:hover table tr td a,table.button:active table tr td a,table.button table tr td a:visited,table.button.tiny:hover table tr td a,table.button.tiny:active table tr td a,table.button.tiny table tr td a:visited,table.button.small:hover table tr td a,table.button.small:active table tr td a,table.button.small table tr td a:visited,table.button.large:hover table tr td a,table.button.large:active table tr td a,table.button.large table tr td a:visited{color:#fefefe;}table.button.tiny table td,table.button.tiny table a{padding:4px 8px 4px 8px;}table.button.tiny table a{font-size:10px;font-weight:normal;}table.button.small table td,table.button.small table a{padding:5px 10px 5px 10px;font-size:12px;}table.button.large table a{padding:10px 20px 10px 20px;font-size:20px;}table.expand,table.expanded{width:100%!important;}table.expand table,table.expanded table{width:100%;}table.expand table a,table.expanded table a{width:calc(100% - 20px);text-align:center;}table.expand center,table.expanded center{min-width:0;}table.button:hover table td,table.button:visited table td,table.button:active table td{background:#147dc2;color:#fefefe;}table.button:hover table a,table.button:visited table a,table.button:active table a{border:0px solid #147dc2;}table.button.secondary table td{background:#777777;color:#fefefe;border:2px solid #777777;}table.button.secondary table a{color:#fefefe;border:0px solid #777777;}table.button.secondary:hover table td{background:#919191;color:#fefefe;}table.button.secondary:hover table a{border:0px solid #919191;}table.button.secondary:hover table td a{color:#fefefe;}table.button.secondary:active table td a{color:#fefefe;}table.button.secondary table td a:visited{color:#fefefe;}table.button.success table td{background:#3adb76;border:2px solid #3adb76;}table.button.success table a{border:0px solid #3adb76;}table.button.success:hover table td{background:#23bf5d;}table.button.success:hover table a{border:0px solid #23bf5d;}table.button.alert table td{background:#ec5840;border:2px solid #ec5840;}table.button.alert table a{border:0px solid #ec5840;}table.button.alert:hover table td{background:#e23317;}table.button.alert:hover table a{border:0px solid #e23317;}table.callout{margin-bottom:16px;Margin-bottom:16px;}th.callout-inner{width:100%;border:1px solid #cbcbcb;padding:10px;background:#fefefe;}th.callout-inner.primary{background:#def0fc;border:1px solid #444444;color:#0a0a0a;}th.callout-inner.secondary{background:#ebebeb;border:1px solid #444444;color:#0a0a0a;}th.callout-inner.success{background:#e1faea;border:1px solid #1b9448;color:#fefefe;}th.callout-inner.warning{background:#fff3d9;border:1px solid #996800;color:#fefefe;}th.callout-inner.alert{background:#fce6e2;border:1px solid #b42912;color:#fefefe;}.thumbnail{border:solid 4px #fefefe;box-shadow:0 0 0 1px rgba(10,10,10,0.2);display:inline-block;line-height:0;max-width:100%;transition:box-shadow 200ms ease-out;border-radius:3px;margin-bottom:16px;}.thumbnail:hover,.thumbnail:focus{box-shadow:0 0 6px 1px rgba(33,153,232,0.5);}table.menu{width:580px;}table.menu td.menu-item,table.menu th.menu-item{padding:10px;padding-right:10px;}table.menu td.menu-item a,table.menu th.menu-item a{color:#2199e8;}table.menu.vertical td.menu-item,table.menu.vertical th.menu-item{padding:10px;padding-right:0;display:block;}table.menu.vertical td.menu-item a,table.menu.vertical th.menu-item a{width:100%;}table.menu.vertical td.menu-item table.menu.vertical td.menu-item,table.menu.vertical td.menu-item table.menu.vertical th.menu-item,table.menu.vertical th.menu-item table.menu.vertical td.menu-item,table.menu.vertical th.menu-item table.menu.vertical th.menu-item{padding-left:10px;}table.menu.text-center a{text-align:center;}body.outlook p{display:inline!important;}@media only screen and (max-width: 596px) {table.body img{width:auto!important;height:auto!important;}table.body center{min-width:0!important;}table.body .container{width:95%!important;}table.body .columns,table.body .column{height:auto!important;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box;padding-left:16px!important;padding-right:16px!important;}table.body .columns .column,table.body .columns .columns,table.body .column .column,table.body .column .columns{padding-left:0!important;padding-right:0!important;}table.body .collapse .columns,table.body .collapse .column{padding-left:0!important;padding-right:0!important;}td.small-1,th.small-1{display:inline-block!important;width:8.33333%!important;}td.small-2,th.small-2{display:inline-block!important;width:16.66667%!important;}td.small-3,th.small-3{display:inline-block!important;width:25%!important;}td.small-4,th.small-4{display:inline-block!important;width:33.33333%!important;}td.small-5,th.small-5{display:inline-block!important;width:41.66667%!important;}td.small-6,th.small-6{display:inline-block!important;width:50%!important;}td.small-7,th.small-7{display:inline-block!important;width:58.33333%!important;}td.small-8,th.small-8{display:inline-block!important;width:66.66667%!important;}td.small-9,th.small-9{display:inline-block!important;width:75%!important;}td.small-10,th.small-10{display:inline-block!important;width:83.33333%!important;}td.small-11,th.small-11{display:inline-block!important;width:91.66667%!important;}td.small-12,th.small-12{display:inline-block!important;width:100%!important;}.columns td.small-12,.column td.small-12,.columns th.small-12,.column th.small-12{display:block!important;width:100%!important;}.body .columns td.small-1,.body .column td.small-1,td.small-1 center,.body .columns th.small-1,.body .column th.small-1,th.small-1 center{display:inline-block!important;width:8.33333%!important;}.body .columns td.small-2,.body .column td.small-2,td.small-2 center,.body .columns th.small-2,.body .column th.small-2,th.small-2 center{display:inline-block!important;width:16.66667%!important;}.body .columns td.small-3,.body .column td.small-3,td.small-3 center,.body .columns th.small-3,.body .column th.small-3,th.small-3 center{display:inline-block!important;width:25%!important;}.body .columns td.small-4,.body .column td.small-4,td.small-4 center,.body .columns th.small-4,.body .column th.small-4,th.small-4 center{display:inline-block!important;width:33.33333%!important;}.body .columns td.small-5,.body .column td.small-5,td.small-5 center,.body .columns th.small-5,.body .column th.small-5,th.small-5 center{display:inline-block!important;width:41.66667%!important;}.body .columns td.small-6,.body .column td.small-6,td.small-6 center,.body .columns th.small-6,.body .column th.small-6,th.small-6 center{display:inline-block!important;width:50%!important;}.body .columns td.small-7,.body .column td.small-7,td.small-7 center,.body .columns th.small-7,.body .column th.small-7,th.small-7 center{display:inline-block!important;width:58.33333%!important;}.body .columns td.small-8,.body .column td.small-8,td.small-8 center,.body .columns th.small-8,.body .column th.small-8,th.small-8 center{display:inline-block!important;width:66.66667%!important;}.body .columns td.small-9,.body .column td.small-9,td.small-9 center,.body .columns th.small-9,.body .column th.small-9,th.small-9 center{display:inline-block!important;width:75%!important;}.body .columns td.small-10,.body .column td.small-10,td.small-10 center,.body .columns th.small-10,.body .column th.small-10,th.small-10 center{display:inline-block!important;width:83.33333%!important;}.body .columns td.small-11,.body .column td.small-11,td.small-11 center,.body .columns th.small-11,.body .column th.small-11,th.small-11 center{display:inline-block!important;width:91.66667%!important;}table.body td.small-offset-1,table.body th.small-offset-1{margin-left:8.33333%!important;Margin-left:8.33333%!important;}table.body td.small-offset-2,table.body th.small-offset-2{margin-left:16.66667%!important;Margin-left:16.66667%!important;}table.body td.small-offset-3,table.body th.small-offset-3{margin-left:25%!important;Margin-left:25%!important;}table.body td.small-offset-4,table.body th.small-offset-4{margin-left:33.33333%!important;Margin-left:33.33333%!important;}table.body td.small-offset-5,table.body th.small-offset-5{margin-left:41.66667%!important;Margin-left:41.66667%!important;}table.body td.small-offset-6,table.body th.small-offset-6{margin-left:50%!important;Margin-left:50%!important;}table.body td.small-offset-7,table.body th.small-offset-7{margin-left:58.33333%!important;Margin-left:58.33333%!important;}table.body td.small-offset-8,table.body th.small-offset-8{margin-left:66.66667%!important;Margin-left:66.66667%!important;}table.body td.small-offset-9,table.body th.small-offset-9{margin-left:75%!important;Margin-left:75%!important;}table.body td.small-offset-10,table.body th.small-offset-10{margin-left:83.33333%!important;Margin-left:83.33333%!important;}table.body td.small-offset-11,table.body th.small-offset-11{margin-left:91.66667%!important;Margin-left:91.66667%!important;}table.body table.columns td.expander,table.body table.columns th.expander{display:none!important;}table.body .right-text-pad,table.body .text-pad-right{padding-left:10px!important;}table.body .left-text-pad,table.body .text-pad-left{padding-right:10px!important;}table.menu{width:100%!important;}table.menu td,table.menu th{width:auto!important;display:inline-block!important;}table.menu.vertical td,table.menu.vertical th,table.menu.small-vertical td,table.menu.small-vertical th{display:block!important;}table.button.expand{width:100%!important;}}</style>
        <style>.header{background:#8a8a8a;}.header p{color:#ffffff;margin:0;}.header .columns{padding-bottom:0;}.header .container{background:#8a8a8a;padding-top:16px;padding-bottom:16px;}.header .container td{padding-top:16px;padding-bottom:16px;}</style>
        </head>
        <body>
         
        <table class="body" data-made-with-foundation="">

        <table class="container text-center">
        <tbody>
        <tr>
        <td>
        <table class="row">
        <tbody>
        <tr>
        <th class="small-12 large-12 columns first last">
        <table>
        <tr>
        <th> <br>
        <center data-parsed=""> <img src="http://202.131.238.116/xxcah/hlj.png" align="center" class="text-center"> </center> <br>
        <h1>Сайн байна уу, '.$name.'</h1>
        <p class="lead">Таны '.$date.' өдөр ирүүлсэн дараах асуултанд халамжийн мэргэжилтэн хариулсан байна.</p>
        <p><b>Асуулт :</b>'.$complain.'</p>
        <table class="callout">
        <tr>
        <td class="callout-inner primary">
        <p><b>Хариулт :</b>'.$solution.'</p>
        </td>
        <td class="expander"></td>
        </tr>
        </table>
        <table class="callout">
        <tr>
        <td class="callout-inner secondary">
        <table class="row">
        <tbody>
        <tr>
        <th class="small-12 large-6 columns first">
        <table>
        <tr>
        <th>
        <h5>Бидэнтэй нэгдэх:</h5>
        <table class="button facebook expand">
        <tr>
        <td>
        <table>
        <tr>
        <td>
        <center data-parsed=""><a href="'.$contact_facebook.'" align="center" class="text-center">Facebook</a></center>
        </td>
        <td class="expander"></td>
        </tr>
        </table>
        </td>
        </tr>
        </table>
        </th>
        </tr>
        </table>
        </th>
        <th class="small-12 large-6 columns last">
        <table>
        <tr>
        <th>
        <h5>Холбоо барих:</h5>
        <p>Утас: '.$contact_phone.'</p>
        <p>Факс: '.$contact_fax.'</p>
        <p>Цахим хаяг: <a href="mailto:'.$contact_email.'">'.$contact_email.'</a></p>
        <p>Хаяг: '.$contact_address.'</p>
        </th>
        </tr>
        </table>
        </th>
        </tr>
        </tbody>
        </table>
        </td>
        <td class="expander"></td>
        </tr>
        </table>
        </th>
        </tr>
        </table>
        </th>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        </center>
        </td>
        </tr>
        </table>
        </body>
        </html>')
                    ->send();
        return $this->redirect('index.php?r=site%2Fcomplain');
    }

    public function actionEditcontent()
    {
        $request = Yii::$app->request;
        $id = $request->post('T0');
        $model = \app\models\Content::findOne($id);
        $model->title = $request->post('T1');
        $model->date = $request->post('T3');
        $model->description = $request->post('T6');
        $model->menu_id = $request->post('T4');
        $model->media_type = $request->post('T5');
        $model->save();
            if(strlen($request->post('T2'))!=0){
            $model = new \app\models\UploadForm();
            if (Yii::$app->request->isPost) {
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                if ($model->uploads()) {
                    // file is uploaded successfully
                }
           }
       }
     return $this->redirect('index.php?r=site%2Fcontent', [
        'model' => $model]);
    }

    public function actionContentdelete($id)
    {
        $model = \app\models\Content::findOne($id);
        $model->delete();
        return Yii::$app->runAction('site/content');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return Yii::$app->runAction('site/index');
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
