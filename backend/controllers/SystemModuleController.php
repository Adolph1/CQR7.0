<?php

namespace backend\controllers;

use backend\models\ModuleActivity;
use Yii;
use backend\models\SystemModule;
use backend\models\SystemModuleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SystemModuleController implements the CRUD actions for SystemModule model.
 */
class SystemModuleController extends Controller
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
     * Lists all SystemModule models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SystemModuleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SystemModule model.
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
     * Creates a new SystemModule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SystemModule();
        $model->maker_id = Yii::$app->user->identity->username;
        $model->maker_time = date('Y-m-d:H:i:s');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SystemModule model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->maker_id = Yii::$app->user->identity->username;
        $model->maker_time = date('Y-m-d:H:i:s');


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SystemModule model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionFilter($id)
    {

            $countActivities = ModuleActivity::find()
                ->where(['module_id' => $id])
                ->count();

            $activities = ModuleActivity::find()
                ->where(['module_id' => $id])
                ->orderBy('activity_name ASC')
                ->all();

            if ($countActivities > 0) {
                echo "<option value=''>" . "--Select--" . "</option>";
                foreach ($activities as $activity) {

                    echo "<option value='" . $activity->id . "'>" .$activity->activity_name."</option>";
                }
            } else {
                echo "<option value=''>" . "--Select--" . "</option>";
            }

    }

    /**
     * Finds the SystemModule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SystemModule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SystemModule::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
