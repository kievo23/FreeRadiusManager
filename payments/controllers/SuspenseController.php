<?php

namespace app\controllers;

use Yii;
use app\models\Payments;
use app\models\Clients;
use app\models\Suspense;
use app\models\Bills;
use app\models\Radusergroup;
use app\models\Radgroupcheck;
use app\models\Radcheck;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * SuspenseController implements the CRUD actions for Suspense model.
 */
class SuspenseController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'delete','index'],
                'rules' => [
                    [
                        'allow' => true,
                        //'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Suspense models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Suspense::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Suspense model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Suspense model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Suspense();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Suspense model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->status == 'yes') {
            try {
                //FIND CUSTOMER RECORDS
                $customer = Clients::findOne(['clientAcc' => $model->mpesa_acc]);
                //HOW MUCH MONEY CLIENTS SHOULD PAY A MONTH
                $billing = Bills::findOne(['id' => 1]);

                //IF NO CLIENT FOUND, SUBMIT THIS TO SUSPENSE ACCOUNT

                if(count($customer) >= 1){
                    // IF A CLIENT IS FOUND, THEN DO THE FOLLOWING AND SAVE
                    $payment = new Payments();

                    $payment->mpesa_id      = $model->mpesa_id;
                    $payment->original      = $model->original;
                    $payment->destination   = $model->destination;
                    $payment->customer_id   = $model->customer_id;
                    $payment->test          = $model->test;
                    $payment->mpesa_code    = $model->mpesa_code;
                    $payment->mpesa_acc     = $model->mpesa_acc;
                    $payment->mpesa_msidn   = $model->mpesa_msidn;
                    $payment->mpesa_amount  = $model->mpesa_amount;
                    $payment->mpesa_sender  = $model->mpesa_sender;
                    $payment->timestamp     = $model->timestamp;
                    $payment->save();

                    echo "<pre>";
                    //print_r($payment);
                    echo "</pre>";

                    //IS THE CLIENT ACTIVE OR INACTIVE? BASED ON THE PROFILE
                    $customer_radgroup = Radusergroup::findOne(['username' => $customer->username]);
                    //print_r($customer_radgroup);
                    //COLLECT ALL RADGROUPS
                    $radgroups = Radgroupcheck::find()->all();

                    if($payment->mpesa_amount >= $billing->monthly_charge){

                        //IF USER WAS DISCONNECTED, AND HAS PAID MORE THAN THE BILLING AMOUNT, SAY: 3000, THEN ACTIVATE THAT USER

                        if(count($customer_radgroup) >= 1){
                            if($customer_radgroup->groupname == "daloRADIUS-Disabled-Users"){
                                try {
                                    //Yii::$app->db->createCommand()->delete('radusergroup', ['username' => $customer->username])->execute();
                                    if($customer_radgroup->delete()){
                                        echo "Deleted";
                                    }
                                } catch (Exception $e) {
                                    
                                }                        
                            }
                        }
                        

                        if($customer->arrears < 0 && $customer->balances >= $billing->monthly_charge){

                            $customer->arrears += $payment->mpesa_amount;
                            if($customer->arrears > 0){
                                $customer->balances += $customer->arrears;
                            }
                        }
                        elseif($customer->arrears < 0 && $customer->balances < $billing->monthly_charge){
                            $difference = $billing->monthly_charge - $customer->balances;
                            $topup = $billing->monthly_charge - $customer->balances;
                            //$customer->balances = 2500;
                            //$billing->monthly_charge = 3000;
                            //$difference = 1000;
                            //$payment->mpesa_amount = 2000
                            if($payment->mpesa_amount > $topup){
                                $remainder = $payment->mpesa_amount - $topup;
                                $customer->balances += $billing->monthly_charge;
                                $customer->arrears += $remainder;
                                if($customer->arrears > 0){
                                    $customer->balances += $customer->arrears;
                                }
                            }else{
                                $customer->balances += $payment->mpesa_amount;
                            }                       
                        }else{
                            $customer->balances += $payment->mpesa_amount;
                        }                    
                    }
                    else{
                        if($customer->balances >= $billing->monthly_charge && $customer->arrears < 0){
                            //$customer->balances = 2000;
                            //$billing->monthly_charge = 3000;
                            //$difference = 1000;
                            //$payment->mpesa_amount = 2000
                            $customer->arrears += $payment->mpesa_amount;                       
                            if($customer->arrears > 0){
                                $customer->balances += $customer->arrears;
                            }
                        }elseif($customer->balances <= $billing->monthly_charge && $customer->arrears < 0){
                            if(($payment->mpesa_amount + $customer->balances) > $billing->monthly_charge){
                                $topup = $billing->monthly_charge - $customer->balances;
                                $customer->balances += $topup;
                                //
                                $excess = $payment->mpesa_amount - $topup;
                                $customer->arrears += $excess;
                            }else{
                                $customer->balances += $payment->mpesa_amount;
                            }
                        }
                        if($customer->balances >= $billing->monthly_charge && count($customer_radgroup) >= 1){
                            if($customer_radgroup->groupname == "daloRADIUS-Disabled-Users"){
                                try {
                                    //Yii::$app->db->createCommand()->delete('radusergroup', ['username' => $customer->username])->execute();
                                    if($customer_radgroup->delete()){
                                        echo "Deleted";
                                    }
                                } catch (Exception $e) {
                                    
                                }                        
                            }
                        }                 
                    }
                    try {
                            $customer->balances = (string)$customer->balances;
                            $customer->arrears = (string)$customer->arrears;

                            $customer->save();
                        } catch (Exception $e) {
                            
                        }
                }

                //return $this->render('collection', ["status"=>"Records saved"] );          
            } catch (Exception $e) {
                //return $this->render('collection', ["status"=>"Client Account details not found!"] );  
            }
            if($model->save()){
                //return $this->redirect(['view', 'id' => $model->id]);
                return $this->render('update', [
                'model' => $model,'result'=>$payment,
            ]);
            }
            
        } elseif($model->load(Yii::$app->request->post()) && $model->save() && $model->status == 'no') {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Suspense model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Suspense model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Suspense the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Suspense::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
