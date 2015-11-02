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
use app\models\Radreply;


use app\search\PaymentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * PaymentsController implements the CRUD actions for Payments model.
 */
class PaymentsController extends Controller
{
    public function behaviors()
    {
        return [
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Payments models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaymentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCollection()
    {
        //                  TEST URL 

        //test/mpesa/?id=152352061&orig=MPESA&dest=254702170201&tstamp=2015-09-03+10%3A41%3A35&text=JI33ZTR59X+Confirmed.+on+3%2F9%2F15+at+10%3A42+AM+Ksh3%2C000.00+received+from+MARK+CHIIRA+254722294820.++Account+Number+0200000656031+New+Utility+balance+is+Ksh3&customer_id=7759&user=default&pass=default&routemethod_id=2&routemethod_name=HTTP&mpesa_code=JI33ZTR59X&mpesa_acc=0200000656031&mpesa_msisdn=254722294820&mpesa_trx_date=3%2F9%2F15&mpesa_trx_time=10%3A42+AM&mpesa_amt=3000.0&mpesa_sender=MARK+CHIIRA&business_number=332500

        $payment = new Payments();

        $payment->mpesa_id      = $_REQUEST['id'];
        $payment->original      = $_REQUEST['orig'];
        $payment->destination   = $_REQUEST['dest'];
        $payment->customer_id   = $_REQUEST['customer_id'];
        $payment->test          = $_REQUEST['text'];
        $payment->mpesa_code    = $_REQUEST['mpesa_code'];
        $payment->mpesa_acc     = $_REQUEST['mpesa_acc'];
        $payment->mpesa_msidn   = $_REQUEST['mpesa_msisdn'];
        $payment->mpesa_amount  = $_REQUEST['mpesa_amt'];
        $payment->mpesa_sender  = $_REQUEST['mpesa_sender'];
        $payment->timestamp     = $_REQUEST['tstamp'];

        try {
            //FIND CUSTOMER RECORDS
            $customer = Clients::findOne(['clientAcc' => $payment->mpesa_acc]);
            //HOW MUCH MONEY CLIENTS SHOULD PAY A MONTH
            $billing = Bills::findOne(['id' => 1]);

            //IF NO CLIENT FOUND, SUBMIT THIS TO SUSPENSE ACCOUNT

            if(count($customer) >= 1){
                // IF A CLIENT IS FOUND, THEN DO THE FOLLOWING AND SAVE
                $payment->save();

                //IS THE CLIENT ACTIVE OR INACTIVE? BASED ON THE PROFILE
                $customer_radreply = Radreply::findOne(['username' => $customer->username]);
                //print_r($customer_radgroup);
                //COLLECT ALL RADGROUPS
                

                if($payment->mpesa_amount >= $billing->monthly_charge){

                    //IF USER WAS DISCONNECTED, AND HAS PAID MORE THAN THE BILLING AMOUNT, SAY: 3000, THEN ACTIVATE THAT USER

                    if(count($customer_radreply) >= 1){
                        if($customer_radreply->username == $customer->username){
                            try {
                                //Yii::$app->db->createCommand()->delete('radusergroup', ['username' => $customer->username])->execute();
                                if($customer_radreply->delete()){
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

            elseif(empty($customer)){
                $suspense = new Suspense();
                $suspense->mpesa_id      = $_REQUEST['id'];
                $suspense->original      = $_REQUEST['orig'];
                $suspense->destination   = $_REQUEST['dest'];
                $suspense->customer_id   = $_REQUEST['customer_id'];
                $suspense->test          = $_REQUEST['text'];
                $suspense->mpesa_code    = $_REQUEST['mpesa_code'];
                $suspense->mpesa_acc     = $_REQUEST['mpesa_acc'];
                $suspense->mpesa_msidn   = $_REQUEST['mpesa_msisdn'];
                $suspense->mpesa_amount  = $_REQUEST['mpesa_amt'];
                $suspense->mpesa_sender  = $_REQUEST['mpesa_sender'];
                $suspense->timestamp     = $_REQUEST['tstamp'];

                try {
                    
                    if($suspense->save()){
                        echo "<hr><pre>";
                        print_r("Records saved in suspense account");
                        echo "</pre>";  
                    }
                    
                } catch (Exception $e) {
                    echo "Suspense not saved";
                    var_dump($errors);exit;
                }
            }

            //return $this->render('collection', ["status"=>"Records saved"] );          
        } catch (Exception $e) {
            //return $this->render('collection', ["status"=>"Records not saved"] );  
        }


        return $this->render('collection');
    }

    /**
     * Displays a single Payments model.
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
     * Creates a new Payments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Payments();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Payments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Payments model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionCronjob()
    {
        $number = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')); // 31
        $billing = Bills::findOne(['id' => 1]);
        $rate = $billing->monthly_charge/$number;


        //ATTRIBUTES NEEDED FOR DIACTIVATION

        $attribute = "Auth-Type";
        $operation = ":=";
        $value = "Reject";

        //BILL ALL THE CLIENTS WHOSE STATUS IS 'yes' THE SYSTEM EXCLUDES THE CLIENTS WITH NO.
        $clients = Clients::find()->where(['status' => 'yes'])->all();

        foreach ($clients as $key => $client) {
                # code...
            //echo $client->clientAcc."<br>";       
            $client = Clients::findOne([$client->id]);
            //IF CLIENT BALANCE IS GREATER THAN THE DAILY BILLING, SUBTRACT THE DAILY FEE.
            if($client->balances > $rate){
                $client->balances =  (string)$client->balances - $rate;
                echo "Client Balance".$client->balances;
                
                $client->save();
            }

            elseif ($rate > $client->balances) {
                //DISCONNECT THE CLIENT
                $customer_radreply = Radreply::findOne(['username' => $client->username]);

                if(count($customer_radreply) >= 1){
                    //DO NOTHING SINCE THE USER IS DEACTIVATED
                }
                else{
                    $victim_client = new Radreply();
                    $victim_client->username    = $client->username;
                    $victim_client->attribute   = $attribute;
                    $victim_client->op          = $operation;
                    $victim_client->value       = $value;
                    $victim_client->save();
                }
            }


            elseif(($billing->monthly_charge*4) > $client->balances && count(Radusergroup::findOne(['username' => $client->username]))==0){
                //SEND SMSES AND EMAILS TO ALERT THE THAT DISCONNECTION IS ABOUT TO TRIGGER
               // $customer_radgroup = Radreply::findOne(['username' => $client->username]);

               // $deactivate = Radgroupcheck::findOne(['id'=>1]);
                $email = Yii::$app->mailer->compose()
                    ->setFrom('accountreceivables@fon.co.ke')
                    ->setTo('kelvinchege@gmail.com')
                    ->setSubject('Message subject')
                    //->setTextBody('Plain text content')
                    ->setHtmlBody('<b>HTML content</b>')
                    ->send();
                    echo "Email sent!";
                
                echo "<pre>";
                print_r($email);
                echo "</pre>";
            }
            //SAVE CHANGES
            
        }    

        return $this->render('cronjob');
    }

    /**
     * Finds the Payments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Payments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Payments::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
