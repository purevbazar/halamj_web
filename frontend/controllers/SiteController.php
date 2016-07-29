<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\Banner;
use frontend\models\Menu;
use frontend\models\ContactForm;
use frontend\models\Complaint;
use frontend\models\GeneralInfo;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\Pagination;
use app\models\UploadForm;
use yii\web\UploadedFile;



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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $complain = new \app\models\Complaint;
        $captcha = new ContactForm;
        $counter = \app\models\Count::findOne(1);
        $faq = \app\models\Faq::find()->limit(5)->all();
        $banner = \app\models\Banner::findOne(1);
        $general = \app\models\GeneralInfo::findOne(1);
        $link = \app\models\Link::find()->all();
        $tenderContent = \app\models\Content::find()->where(['menu_id'=>92])->orderBy('date desc')->limit(5)->all();
        $tenderResult = \app\models\Content::find()->where(['menu_id'=>136])->orderBy('date desc')->limit(5)->all();
        $specialContent = \app\models\Content::find()->where(['media_type'=>1])->andWhere(['not', ['title_photo' => '']])->orderBy('date desc')->limit(5)->all();
        $latestContent = \app\models\Content::find()->where(['media_type'=>2])->andWhere(['not', ['title' => null]])->orderBy('date desc')->limit(5)->all();
        $mostView = \app\models\Content::find()->andWhere(['not', ['title' => null]])->orderBy('view_count desc')->limit(5)->all();
        $bottomContent = \app\models\Content::find()->where(['media_type'=>1])->andWhere(['not', ['title_photo' => null]])->orderBy('date desc')->limit(6)->offset(5)->all();
        return $this->render('index', [
            'links'=>$link, 'captcha'=>$captcha ,'banner'=>$banner, 'general'=>$general, 'specialContent'=>$specialContent, 'latestContent'=>$latestContent, 'mostView'=>$mostView, 'bottomContent'=>$bottomContent,
            'complain'=>$complain, 'faq'=>$faq, 'counter'=>$counter, 'tenderResult'=>$tenderResult, 'tenderContent'=>$tenderContent]);
    }

    public function actionViewmenu($id)
    {
    $general = \app\models\GeneralInfo::findOne(1);
    $query = $id;
    $childs = \app\models\Menu::find()->where(['parent_id'=>$id])->all();
        foreach ($childs as $child):
            $query.=",".$child->menu_id;
                $childs1 = \app\models\Menu::find()->where(['parent_id'=>$child->menu_id])->all();
                foreach ($childs1 as $child1):
                    $query.=",".$child1->menu_id;
                endforeach;
        endforeach;

        $query = \app\models\Content::find()->where('menu_id in  ('. $query. ')');
        $pagination = new Pagination(['totalCount' => $query->count(), 'pageSize'=>5]);
        $models = $query->offset($pagination->offset)
        ->limit($pagination->limit)
        ->orderBy([
            'date' => SORT_DESC,])
        ->all();
        return $this->render('menu', ['pagination'=>$pagination,
           'general'=>$general, 'contents'=>$models]);
    }

    public function actionSearch()
    {
        $general = \app\models\GeneralInfo::findOne(1);
        $request = Yii::$app->request;
        $query =  \app\models\Content::find()->andWhere('description like '."'".'%'.$request->post('string').'%'."'".' ') ;
        $pagination = new Pagination(['totalCount' => $query->count(), 'pageSize'=>5]);
        $models = $query->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();
        return $this->render('menu', ['pagination'=>$pagination,
        'general'  => $general,  'contents'=>$models]);
    }

    public function actionMenu()
    {
        return $this->render('menu_list');
    }

    public function actionComplainsubmit()
    {
        $model = new ContactForm;
        $model->load(\Yii::$app->request->post());
        if ($model->validate()) {
             $request = Yii::$app->request;
           $model = new \app\models\Complaint;
           $model->last_name = $request->post('T0');
           $model->name = $request->post('T1');
           $model->email = $request->post('T2');
           $model->phone = $request->post('T3');
           $model->complain_type = $request->post('T4');
           $model->complain = $request->post('T5');
           $model->submitted_date = new \yii\db\Expression('NOW()');
           $model->save();
           Yii::$app->session->setFlash('success', 'Амжилттай шинэчлэгдлээ !');
            return Yii::$app->runAction('site/index');
        } else {
            // validation failed: $errors is an array containing error messages
            $errors = $model->errors;
            Yii::$app->session->setFlash('error', 'Алдаа гарлаа!');
            return Yii::$app->runAction('site/index');
        }
    }

    public function actionSitemap()
    {
        return $this->render('sitemap');
    }

    public function actionFaq()
    {
        $models =  \app\models\Faq::find()->all();
        return $this->render('faq', ['faq'=>$models]);
    }

    public function actionContact()
    {
        $captcha = new ContactForm;
        $complain = new \app\models\Complaint;
        return $this->render('contact', ['complain'=>$complain, 'captcha'=>$captcha]);
    }


    public function actionMostvisit()
    {
         $general = \app\models\GeneralInfo::findOne(1);
        $query = \app\models\Content::find()->andWhere(['not', ['title' => null]])->orderBy('view_count desc');
        $pagination = new Pagination(['totalCount' => $query->count(), 'pageSize'=>5]);
        $models = $query->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();
        return $this->render('menu', ['pagination'=>$pagination,
           'general'=>$general, 'contents'=>$models]);
    }

     public function actionLatest()
    {
        $general = \app\models\GeneralInfo::findOne(1);
        $query = \app\models\Content::find()->andWhere(['not', ['title' => null]])->orderBy('date desc');
        $pagination = new Pagination(['totalCount' => $query->count(), 'pageSize'=>5]);
        $models = $query->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();
        return $this->render('menu', ['pagination'=>$pagination,
           'general'=>$general ,'contents'=>$models]);
    }

    public function actionAlbum()
    {
        $albums = \app\models\Album::find()->all();
        return $this->render('album', [
        'albums'=>$albums]);
    }

     public function actionViewalbum($id)
    {
        $model = \app\models\Album::findOne($id);
        return $this->render('view_album', [
            'model'=>$model]);
    }

    public function beforeAction($action) {
  //  $this->enableCsrfValidation = false;
    return parent::beforeAction($action);
    }

    public function actionViewcontent($id)
    {   
        $content = \app\models\Content::findOne($id);
        $general = \app\models\GeneralInfo::findOne(1);
        $view_count = $content->view_count;
        if($view_count==0){
            $view_count = 1;
        }
        $latestContent = \app\models\Content::find()->where(['media_type'=>2])->andWhere(['not', ['title' => null]])->orderBy('date desc')->limit(5)->all();
        return $this->render('view_content', [
         'content'=>$content , 'latestContent'=>$latestContent, 'general'=>$general ,'view_count'=>$view_count]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionGeneral()
    {
        $model = new \app\models\GeneralInfo;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('general', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

     public function actionBanner()
    {
        return $this->render('banner');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
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
    } 
}
