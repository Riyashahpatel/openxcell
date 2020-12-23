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

   


    public function actionCheckout($id){


        $procutMaster = ProductManagment::find()->where(['id'=>$id])->one();

        // Setup order information array with all items
        $params = [
            'payer'=>["payment_method"=> "paypal"],
            'method'=>'paypal',
            'intent'=>'sale',
            'order'=>[
                'description'=>'Payment description',
                'subtotal'=>$procutMaster->price,
                'shippingCost'=>0,
                'total'=>$procutMaster->price,
                'currency'=>'INR',
                'items'=>[
                    [
                        'name'=>$procutMaster->name,
                        'price'=>$procutMaster->price,
                        'quantity'=>1,
                        'currency'=>'INR',

                    ],
                    
                ]

            ]
        ];
        
        $session = Yii::$app->session;
        $session['procutMaster'] = $procutMaster;

        Yii::$app->PayPalRestApi->checkOut($params);
    }

    public function actionBuyproduct(){

        $session = Yii::$app->session;
       
         $dataProvider = new ActiveDataProvider([
            'query' => ProductManagment::find()->orderby('id DESC'),
        ]); 

         if(isset($session['procutMaster']) && !empty($session['procutMaster'])){
            $details = $session['procutMaster'];
             $id= $details['id'];
             $params = [
            'order'=>[
                'description'=>$details['name'],
                'subtotal'=>$details['price'],
                'shippingCost'=>0,
                'total'=>$details['price'],
                'currency'=>'INR',
            ]
        ];
         }else{
            $id= 1;
            $details = $session['procutMaster'];
             $params = [
            
            ];
         }
       
     
      $getdata =   Yii::$app->PayPalRestApi->processPayment($params);
    
      if(isset($_REQUEST['success']) && $_REQUEST['success'] == 'true'){

           $modelOrder = new OrderManagment();
            $modelOrder->product_id = $id;
            $modelOrder->user_id = yii::$app->user->identity->id;
            $modelOrder->paymentstatus = $_REQUEST['success'];
            $modelOrder->paymentId = $_REQUEST['paymentId'];
            $modelOrder->token = $_REQUEST['token'];
            $modelOrder->PayerID = $_REQUEST['PayerID'];
            if($modelOrder->save()){
            Yii::$app->session->setFlash('success', 'Payment success.');
                return $this->redirect(['index']);
            }

              return $this->render('index',['dataProvider' => $dataProvider,]);
      }else{
        Yii::$app->session->setFlash('error', 'Payment Fail.');
        return $this->render('index',['dataProvider' => $dataProvider,]);
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
