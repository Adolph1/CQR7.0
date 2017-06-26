<?php

namespace backend\controllers;
use vova07\console\ConsoleRunner;

use backend\models\CaseHistory;
use backend\models\Customer;
use backend\models\Employee;
use backend\models\User;
use common\models\LoginForm;
use Yii;
use backend\models\CustomerCase;
use backend\models\CustomerCaseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\ReferenceIndex;
use backend\models\EmailLog;

/**
 * CustomerCaseController implements the CRUD actions for CustomerCase model.
 */
class CustomerCaseController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all CustomerCase models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(yii::$app->User->can('Level5')) {
            $searchModel = new CustomerCaseSearch();
            $dataProvider = $searchModel->searchPendingByDepartment(Employee::getDepartmentID(Yii::$app->user->identity->emp_id));


            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        elseif (yii::$app->User->can('admin') || yii::$app->User->can('Level0')){
            $searchModel = new CustomerCaseSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }


    public function actionPending()
    {
        if(yii::$app->User->can('Level5')) {

            $searchModel = new CustomerCaseSearch();
            $dataProvider = $searchModel->searchPendingByUser(Yii::$app->user->identity->emp_id);

                return $this->render('pending', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);

        }
        elseif (yii::$app->User->can('Level0')||yii::$app->User->can('admin')){
            $searchModel = new CustomerCaseSearch();
            $dataProvider = $searchModel->searchPending(Yii::$app->request->queryParams);

            return $this->render('pending', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }

    }

    /**
     * Displays a single CustomerCase model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model=$this->findModel($id);
        $casehistory=new CaseHistory();
        $casehistory->maker_id=Yii::$app->user->identity->username;
        $casehistory->maker_time=date('Y-m-d:H:i:s');
        $customer=$this->findCustomer($model->customer_number);

        if($casehistory->load(Yii::$app->request->post()))
        {
            //print_r($casehistory);
            //exit;
            $casehistory->save();
        }
        return $this->render('view', [
            'model' => $this->findModel($id),'customer'=>$customer,'casehistory'=>$casehistory
        ]);
    }

    /**
     * Creates a new CustomerCase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $customer=new Customer();
        $model = new CustomerCase();
        $model->escalation_hours=4;
        $model->escalation_time=date('Y-m-d:H:i:s', strtotime('+4 hours'));
        $model->status=CustomerCase::OPENED;
        $model->assign_status=CustomerCase::ASSIGN;
        $model->delete_status='';
        $model->update_status=0;

        if ($model->load(Yii::$app->request->post()) && $customer->load(Yii::$app->request->post())) {
          $findcustomer=$this->findCustomerNumber($_POST['Customer']['customer_number']);
          if($findcustomer!=null) {
              $customer=$this->findCustomer($findcustomer->id);
              $customer->save();
              $model->customer_number=$customer->id;

              $model->save();
              $flag=1;

          }else{
              $customer->save();
              $model->customer_number=$customer->id;
              $model->save();
              $flag=1;
          }
            if($flag) {
                $email_log = new EmailLog();
                $email_log->from = 'crm@tz.kcbgroup.com';
                $email_log->to = User::getEmailID($model->assigned_to);
                $email_log->title = 'New Case Logged';
                $email_log->subject ='New Case Logged with reference '.$model->case_number;
                $email_log->case_reference_number=$model->case_number;
                $email_log->message=$model->description;
                $email_log->status=0;
                $email_log->save();


                }
            $modelrefid=ReferenceIndex::getIDByRef($model->case_number);
            ReferenceIndex::updateReference($modelrefid);
            Yii::$app->consoleRunner->run('email/send-email');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,'customer'=>$customer
            ]);
        }
    }

    /**
     * Updates an existing CustomerCase model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $customer=$this->findCustomer($model->customer_number);

        if ($model->load(Yii::$app->request->post()) && $customer->load(Yii::$app->request->post())) {

            $findcustomer=$this->findCustomerNumber($customer->customer_number);
            if($findcustomer==null) {
                $customer->save();
            }else{
                $customer=$this->findCustomer($findcustomer->id);
                if($customer->customer_number!=$_POST['Customer']['customer_number']) {
                    $customer->customer_number = $_POST['Customer']['customer_number'];
                    $customer->name = $_POST['Customer']['name'];
                    $customer->phone_1 = $_POST['Customer']['phone_1'];
                    $customer->phone_2 = $_POST['Customer']['phone_2'];
                    $customer->address = $_POST['Customer']['address'];
                    $customer->account_1 = $_POST['Customer']['account_1'];
                    $customer->account_2 = $_POST['Customer']['account_2'];
                    $customer->email = $_POST['Customer']['email'];

                    $customer->save();
                }
                else{
                    $customer->save();
                }
            }
        $model->save();
            return $this->redirect(['view', 'id' => $model->id]);

        } else {
            return $this->render('update', [
                'model' => $model,'customer'=>$customer
            ]);
        }
    }

    /**
     * Deletes an existing CustomerCase model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionClose($id)
    {
        if(!Yii::$app->user->isGuest){
            $model=$this->findModel($id);
            $model->status=CustomerCase::CLOSED;
            $model->save();
            return $this->redirect(['view', 'id' => $id]);
        }
        else{
            $model=new LoginForm();
            return $this->render('site/login',[
                'model'=>$model,
            ]);
        }
    }

    public function actionReopen($id)
    {
        if(!Yii::$app->user->isGuest){
            $model=$this->findModel($id);
            $model->status=CustomerCase::REOPENED;
            $model->save();
            return $this->redirect(['view', 'id' => $id]);
        }
        else{
            $model=new LoginForm();
            return $this->render('site/login',[
                'model'=>$model,
            ]);
        }
    }


    public function actionReassign($id,$id1)
    {
        if($id!=null && $id1!=null){

            CustomerCase::updateAll(['assigned_to'=>$id1],['id'=>$id]);
            $model=$this->findModel($id);
            Yii::$app->session->setFlash('success', 'successfully reassigned to '. $model->employee->first_name. '  '. $model->employee->last_name);
            return $this->redirect(['view', 'id' => $id]);
        }


    }


    public function actionReference($id)
    {
        $reference = ReferenceIndex::find()
            ->where(['product' => 'KCB','status'=>'N'])
            ->one();

        if ($reference!=null) {
            echo $reference->full_reference;
        }
        else {

            $model = new ReferenceIndex();
            $model->index_no = sprintf("%04d", 0001);
            $model->product = 'KCB';
            $model->full_reference = $model->product . date('y').date('m').date('d').$model->index_no;
            $model->status = 'N';
            $model->save();
            echo $model->full_reference;

        }

    }




    /**
     * Finds the CustomerCase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CustomerCase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CustomerCase::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findCustomer($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function findCustomerNumber($id)
    {
        if (($model = Customer::find()->where(['customer_number'=>$id])->one()) !== null) {
            return $model;
        } else {
            return null;
        }
    }



    public function SendEmail()
    {

        $from='crm@tz.kcbgroup.com';
        $to='adolph.cm@gmail.com';
        $message='NEW CASE';
        $body='NEW CASE TESTING';
        Yii::$app->mailer->compose()
            ->setFrom($from)
            ->setTo($to)
            ->setSubject($message)
            ->setTextBody($body)
            ->setHtmlBody('<b>HTML content</b>')
            ->send();
        return 0;
    }
}
