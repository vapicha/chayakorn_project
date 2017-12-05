<?php

namespace frontend\controllers;

use Yii;
use common\models\Activity;
use common\models\Person;
use common\models\ActivityMember;
use common\models\ActivitySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActivityController implements the CRUD actions for Activity model.
 */
class ActivityController extends Controller
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
     * Lists all Activity models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActivitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Activity model.
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
     * Creates a new Activity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Activity();

        if ($model->load(Yii::$app->request->post())) {
            $model->date_start = Yii::$app->request->post('date_start');
            $model->date_end = Yii::$app->request->post('date_end');
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Activity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->date_start = Yii::$app->request->post('date_start');
            $model->date_end = Yii::$app->request->post('date_end');
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }  else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Activity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        ActivityMember::deleteAll(['activity_list_id'=>$model->id]);
        $model->delete();

        return $this->redirect(['index']);
    }

    public function actionScan($activity_id){
        $model = new Person();
        if($model->load(Yii::$app->request->post()))
        {
            $person = Person::find()->where(['code'=>$model->code])->one();
            if(isset($person)){
                $ac_member = ActivityMember::find()->where(['activity_list_id'=>$activity_id])->andWhere(['person_id'=>$person->id])->one();
                if(!isset($ac_member)){
                    $ac_member = new ActivityMember();
                    $ac_member->activity_list_id = $activity_id;
                    $ac_member->person_id = $person->id;
                    if($ac_member->save()){
                        return $this->render('scan_qrcode',['model'=>$model,'person'=>$person]);
                    }else{
                        Yii::$app->getSession()->setFlash('alert',[
                        'body'=>'ระบบขัดข้อง กรุณาติดต่อเจ้าหน้าที่',
                        'options'=>['class'=>'alert-danger']
                        ]);
                        return $this->render('scan_qrcode',['model'=>$model]);
                    }
                }else{
                    return $this->render('scan_qrcode',['model'=>$model,'person'=>$person]);
                }
            }else{
                Yii::$app->getSession()->setFlash('alert',[
                    'body'=>'ไม่พบข้อมูล QR Code รหัส '.$model->code.' ดังกล่าว กรุณาติดต่อเจ้าหน้าที่',
                    'options'=>['class'=>'alert-danger']
                    ]);
                return $this->render('scan_qrcode',['model'=>$model]);
            }
        }
        return $this->render('scan_qrcode',['model'=>$model]);
    }

    public function actionAddMember($activity_list_id){
        $model = new ActivityMember();
        if ($model->load(Yii::$app->request->post())) {
            $member = ActivityMember::find()->where(['activity_list_id'=>$activity_list_id])->andWhere(['person_id'=>$model->person_id])->one();
            $model_activity = Activity::find()->where(['id' => $activity_list_id])->one();
            $model->activity_list_id = $activity_list_id;
            if(isset($member)){
                Yii::$app->getSession()->setFlash('alert',[
                    'body'=>'บุคคลนี้ กัลฯ'.$member->person->fullname.' ได้ลงทะเบียนเรียบร้อยแล้ว',
                    'options'=>['class'=>'alert-warning']
                    ]);
                return $this->redirect(['add-member', 'activity_list_id'=>$activity_list_id]);
            }
            if($model->save()){
                Yii::$app->getSession()->setFlash('alert',[
                    'body'=>'ทำการเพิ่มรายชื่อบุคคล กัลฯ'.$model->person->fullname.'  ลงกิจกรรมเรียบร้อยแล้ว',
                    'options'=>['class'=>'alert-success']
                    ]);
                // return $this->redirect(['view', 'id' => $model->id,'activity_id'=>$model_activity->activity_id]);
                return $this->redirect(['add-member', 'activity_list_id'=>$activity_list_id]);
            }else{
                Yii::$app->getSession()->setFlash('alert',[
                    'body'=>'การเพิ่มรายชื่อบุคคล ไม่สำเร็จ กรุณาเลือกรายชื่อบุคคล!!!',
                    'options'=>['class'=>'alert-danger']
                    ]);
                return $this->redirect(['add-member', 'activity_list_id'=>$activity_list_id]);
            }
            
        } else {
            return $this->render('_form_add_member', [
                'model' => $model,
                'activity_list_id' => $activity_list_id,
            ]);
        }
    }
    public function actionDeleteMember($id,$activity_id){
        $model = ActivityMember::find()->where(['id'=>$id])->one();
        $model->delete();
        return $this->redirect(['view','id'=>$activity_id]);
    }

    /**
     * Finds the Activity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Activity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Activity::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
