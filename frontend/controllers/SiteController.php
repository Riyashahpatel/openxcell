<?php
namespace frontend\controllers;


use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

use app\models\FrontendUser;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
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
       if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new FrontendUser();
       
        if ($model->load(Yii::$app->request->post()) ) {

             if (isset($_FILES['FrontendUser']['name']['profile_pic']) && $_FILES['FrontendUser']['name']['profile_pic'] != '') {
                $uploadfile3 = \yii\web\UploadedFile::getInstances($model, 'profile_pic');
               
                //p($uploadfile3);

                if (isset($uploadfile3)) {

                    foreach ($uploadfile3 as $keys => $file) {
                        $expload = explode(".", $file->name);
                        $ext = end($expload);
                        $img = "Profile" . Yii::$app->security->generateRandomString() . ".{$ext}";
                        $original_file_path = PROFILE_PICTURE_ORIGINAL  . $img;
                        $upload_pic = $file->saveAs($original_file_path);
                        $model->profile_pic = $img;
                    }
                }
            }
            $model->password = md5($model->password);
// p($_FILES,0);p($model);
            if($model->save(false)){
                Yii::$app->session->setFlash('success', 'You have successfully registered.');
                return $this->render('index', [
                'model' => $model,
            ]);
            }else{
                // p($model->getErrors());
                Yii::$app->session->setFlash('error', 'Something went wrong!');
                return $this->render('index', [
                'model' => $model,
            ]);
            }
        //$model->login();
            
        } else {
           
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }

 public function actionFrontlogin()
 {
    $model = new LoginForm();
      
    if ($model->load(Yii::$app->request->post())) {
        $model->is_admin = 0;
        if($model->login()){
          

                return $this->redirect(['productlist/index']);
        }else{
            // p('out');
            // Yii::$app->session->setFlash('error', 'Something went wrong!');
            return $this->render('login', [
                'model' => $model,
            ]); 
        }

            return $this->goBack();
        } else {
            $model->password = '';

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
        $model = new LoginForm();
          return $this->render('login', [
                'model' => $model,
            ]);
    }

   

}
