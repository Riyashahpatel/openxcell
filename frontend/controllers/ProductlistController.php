<?php

namespace frontend\controllers;

use Yii;
use backend\models\ProductManagment;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\OrderManagment;
/**
 * ProductlistController implements the CRUD actions for ProductManagment model.
 */
class ProductlistController extends Controller
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

    /**
     * Lists all ProductManagment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ProductManagment::find()->orderby('id DESC'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionBuynow($id){
       // $product = ProductManagment::find()->where(['id'=>$id])->one();

     $dataProvider = new ActiveDataProvider([
            'query' => ProductManagment::find()->orderby('id DESC'),
        ]);     
        $modelOrder = new OrderManagment();
        $modelOrder->product_id = $id;
        $modelOrder->user_id = yii::$app->user->identity->id;
        if($modelOrder->save()){
            return $this->render('index',['dataProvider' => $dataProvider,]);
            }else{
                p($modelOrder->getErrors());
            } 
        



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

   
    protected function findModel($id)
    {
        if (($model = ProductManagment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
