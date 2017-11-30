<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\models\ActivityMember;
use yii\data\ActiveDataProvider;
/* @var $this yii\web\View */
/* @var $model common\models\Activity */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enhanced">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('หน้ากิจกรรมรวม', ['index', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'name',
            'date_start',
            'date_end',
            'detail:ntext',
        ],
    ]) ?>

</div>

$activity_id = $model->id;

<?php 
    $activity_list = ActivityMember::find()->where(['activity_list_id'=>$model->id]);
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
            <h4>รายการผู้เข้าร่วมกิจกรรม</h4>
        </div>
        <div class="panel-body" >
            <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'options' => ['style' => 'max-height:60;','maxwidth:80px;','algin:center; overflow: auto; word-wrap: break-word;'],
            // 'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'person.fullname',
                    'label' => 'ชื่อ',
                ],
                [
                    'attribute' => 'person.phone_number',
                    'label' => 'เบอร์โทรศัพท์',
                ],
                [
                    'attribute' => 'person.birth_date',
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' =>'{view} {delete} ',
                    'buttons'=>[
                        'view' => function($url,$model,$key){
                            return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',
                                            ['person/view','id'=>$model->person->id]
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