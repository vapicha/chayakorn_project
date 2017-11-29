<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Person;
use common\models\PersonSearch;
use common\models\Photo;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseFileHelper;

use common\components\PersonHelper as PeH;
/**
 * PersonController implements the CRUD actions for Person model.
 */
class PersonController extends Controller
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
     * Lists all Person models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersonSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Person model.
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
     * Creates a new Person model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Person();
        $post = Yii::$app->request->post();
        if ($model->load($post)) {
            $model->birth_date = Peh::tranBirthDate($post['Person']);
            if($model->save()){
                Peh::saveGenerateCode($model);
                Peh::uploadPhoto($model->id);
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            $model->ref = substr(Yii::$app->getSecurity()->generateRandomString(),10);
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Person model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model = PeH::tranBirthDateToForm($model);
        $photo = Photo::find()->where(['person_id'=>$id])->one();
        $post = Yii::$app->request->post();
        if(isset($photo)){
            list($initialPreview,$initialPreviewConfig) = $this->getInitialPreview($photo->ref);
            $model->ref = $photo->ref;
        }else{
            $initialPreview=[];
            $initialPreviewConfig=[];
            $model->ref = substr(Yii::$app->getSecurity()->generateRandomString(),10);
        }
        if ($model->load($post)) {
            $model->birth_date = Peh::tranBirthDate($post['Person']);
            if($model->save()){
                // Peh::saveGenerateCode($model);
                Peh::uploadPhoto($model->id);
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'initialPreview'=>$initialPreview,
                'initialPreviewConfig'=>$initialPreviewConfig
            ]);
        }
    }

    /**
     * Deletes an existing Person model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = Photo::find()->where(['person_id'=>$id])->one();
        $this->findModel($id)->delete();
        if(isset($model)){
            BaseFileHelper::removeDirectory(Photo::getUploadPath().$model->ref);
            Photo::deleteAll(['ref'=>$model->ref]);
        }
        return $this->redirect(['person/index']);
    }

    private function getInitialPreview($ref) {
            $datas = Photo::find()->where(['ref'=>$ref])->all();
            $initialPreview = [];
            $initialPreviewConfig = [];
            foreach ($datas as $key => $value) {
                array_push($initialPreview, $this->getTemplatePreview($value));
                array_push($initialPreviewConfig, [
                    'caption'=> $value->surname,
                    'width'  => '120px',
                    'url'    => Url::to(['/photo/deletefile-ajax']),
                    'key'    => $value->id
                ]);
            }
            return  [$initialPreview,$initialPreviewConfig];
    }
    public function isImage($filePath){
            return @is_array(getimagesize($filePath)) ? true : false;
    }

    private function getTemplatePreview(Photo $model){
            $filePath = Photo::getUploadUrl().$model->ref.'/thumbnail/'.$model->name;
            $isImage  = $this->isImage($filePath);
            if($isImage){
                $file = Html::img($filePath,['class'=>'file-preview-image', 'alt'=>$model->surname, 'title'=>$model->surname]);
            }else{
                $file =  "<div class='file-preview-other'> " .
                         "<h2><i class='glyphicon glyphicon-file'></i></h2>" .
                         "</div>";
            }
            return $file;
    }

    /**
     * Finds the Person model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Person the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Person::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
