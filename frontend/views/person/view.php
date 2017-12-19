<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use common\models\ActivityMember;

/* @var $this yii\web\View */
/* @var $model common\models\Person */

$this->title = $model->fullname;
$this->params['breadcrumbs'][] = ['label' => 'People', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enhanced">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('ไปหน้ารายการบุคคล', ['index'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-print"></span> พิมพ์บัตรสมาชิก', ['pdf', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> เพิ่มบุคคลใหม่', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            [
                'attribute' =>'photo',
                'format' => 'raw',
                'label' => 'รูป'
            ],
            'firstname',
            'lastname',
            'code',
            'phone_number',
            [
                'attribute'=>'fullBirthday',
                'label' =>'วันเกิด/อายุ'
            ],
            [
                'attribute' => 'qrcode',
                'format' => 'raw',
                'label' => 'คิวอาร์โค้ด'
            ]
        ],
    ]) ?>
</div>
<?php 
    $activity_list = ActivityMember::find()->where(['person_id'=>$model->id]);
    $dataProvider = new ActiveDataProvider([
        'query' => $activity_list,
        'pagination' => [
            'pageSize' => 20,
        ],
    ]);
?>

<div class = "row" style="margin: auto">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4>รายการกิจกรรมที่เข้าร่วม</h4>
        </div>
        <div class="panel-body" >
            <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'options' => ['style' => 'max-height:60;','maxwidth:80px;','algin:center; overflow: auto; word-wrap: break-word;'],
            // 'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'activity.name',
                    'label' => 'ชื่อกิจกรรม',
                ],
                [
                    'attribute' => 'activity.date_start',
                    'label' => 'วันที่',
                ],
                [
                    'attribute' => 'activity.date_end',
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' =>'{view} {delete} ',
                    'buttons'=>[
                        'view' => function($url,$model,$key){
                            if(isset($model->person->id)){
                                $id = $model->person->id;
                            }else{
                                $id = '';
                            }
                            return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',
                                            ['activity/view','id'=>$model->activity_list_id]
                                );
                        },
                        'delete' => function($url,$model,$key){
                            return Html::a('<i class="glyphicon glyphicon-trash"></i>',
                                            ['activity/delete-member','id'=>$model->id,'activity_id'=>$model->activity_list_id],
                                            [
                                                'data' => [
                                                    'confirm' => 'Are you sure you want to delete this item?',
                                                    'method' => 'post',
                                                ],
                                            ]);
                          },
                        ]
                ],
            ],
        ]); ?>
        </div>
    </div>
</div>