<?php

namespace backend\controllers;

use Yii;
use backend\models\ProductManagment;
use backend\models\ProductManagmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductmanagmentController implements the CRUD actions for ProductManagment model.
 */
class ProductmanagmentController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
     public function beforeAction($action) {
        
        if(isset(yii::$app->user->identity->id) && !empty(yii::$app->user->identity->id)){
            return true;
        }else{
            return $this->redirect(['//site/login']);
        }
        
    }

    /**
     * Lists all ProductManagment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductManagmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductManagment model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductManagment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductManagment();

        if ($model->load(Yii::$app->request->post()) ) {
           // p($model,0);p($_FILES);
            if (isset($_FILES['ProductManagment']['name']['product_image']) && $_FILES['ProductManagment']['name']['product_image'] != '') {
                $uploadfile3 = \yii\web\UploadedFile::getInstances($model, 'product_image');
               
                //p($uploadfile3);

                if (isset($uploadfile3)) {

                    foreach ($uploadfile3 as $keys => $file) {
                        $expload = explode(".", $file->name);
                        $ext = end($expload);
                        $img = "product" . Yii::$app->security->generateRandomString() . ".{$ext}";
                        $original_file_path = UPLOAD_DIR_PATH  . $img;
                        $upload_pic = $file->saveAs($original_file_path);
                        $model->product_image = $img;
                    }
                }
            }

            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProductManagment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldimg = $model->product_image;
        if ($model->load(Yii::$app->request->post()) ) {
             if (isset($_FILES['ProductManagment']['name']['product_image']) && $_FILES['ProductManagment']['name']['product_image'] != '') {
                $uploadfile3 = \yii\web\UploadedFile::getInstances($model, 'product_image');
               
                //p($uploadfile3);

                if (isset($uploadfile3)) {

                    foreach ($uploadfile3 as $keys => $file) {
                        $expload = explode(".", $file->name);
                        $ext = end($expload);
                        $img = "product" . Yii::$app->security->generateRandomString() . ".{$ext}";
                        $original_file_path = UPLOAD_DIR_PATH  . $img;
                        $upload_pic = $file->saveAs($original_file_path);
                        $model->product_image = $img;
                    }
                }
            }else{
                $model->product_image = $oldimg;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProductManagment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductManagment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductManagment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductManagment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
