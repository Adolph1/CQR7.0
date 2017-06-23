<?php

namespace backend\controllers;

use backend\models\Department;
use backend\models\Employee;
use backend\models\ModuleActivity;
use Yii;
use backend\models\DepartmentModuleActivity;
use backend\models\DepartmentModuleActivitySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DepartmentModuleActivityController implements the CRUD actions for DepartmentModuleActivity model.
 */
class DepartmentModuleActivityController extends Controller
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
     * Lists all DepartmentModuleActivity models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DepartmentModuleActivitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DepartmentModuleActivity model.
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
     * Creates a new DepartmentModuleActivity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DepartmentModuleActivity();
        $model->maker_id=Yii::$app->user->identity->username;
        $model->maker_time=date('Y-m-d:H:i:s');

        if ($model->load(Yii::$app->request->post())) {
            $model->related_module=ModuleActivity::getModuleID($_POST['DepartmentModuleActivity']['module_activity_id']);
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing DepartmentModuleActivity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->maker_id=Yii::$app->user->identity->username;
        $model->maker_time=date('Y-m-d:H:i:s');

        if ($model->load(Yii::$app->request->post())) {
            $model->related_module=ModuleActivity::getModuleID($_POST['DepartmentModuleActivity']['module_activity_id']);
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DepartmentModuleActivity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

//gets all employees in which the activity is connected with respect to their departments
    public function actionFilter($id)
    {

        $countActivities = DepartmentModuleActivity::find()
            ->where(['module_activity_id' => $id])
            ->count();

        $activities = DepartmentModuleActivity::find()
            ->where(['module_activity_id' => $id])
            ->all();

        if ($countActivities > 0) {
            foreach ($activities as $activity) {
                $countemployees = Employee::find()
                    ->where(['department_id' => $activity->department_id])
                    ->count();
                $employees = Employee::find()
                    ->where(['department_id' => $activity->department_id])
                    ->all();
                if ($countemployees > 0) {
                    echo "<option value=''>" . "--Select--" . "</option>";
                    foreach ($employees as $employee) {
                        echo "<option value='" . $employee->id . "'>" . $employee->first_name.' '.$employee->last_name . "</option>";
                    }
                }
                else {
                    echo "<option value=''>" . "--Select--" . "</option>";
                }
            }
        } else {
            echo "<option value=''>" . "--Select--" . "</option>";
        }

    }

    public function actionFilterDepartment($id)
    {

        $department = DepartmentModuleActivity::find()
            ->where(['module_activity_id' => $id])
            ->one();

        if ($department!=null) {
            echo Department::getName($department->department_id);
        }

    }

    public function actionDepartment($id)
    {

        $department = DepartmentModuleActivity::find()
            ->where(['module_activity_id' => $id])
            ->one();

        if ($department!=null) {
            echo $department->department_id;
        }

    }

    /**
     * Finds the DepartmentModuleActivity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DepartmentModuleActivity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DepartmentModuleActivity::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
