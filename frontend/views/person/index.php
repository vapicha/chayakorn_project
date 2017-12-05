<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการบุคคล';
$this->params['breadcrumbs'][] = $this->title;

$items =[
    ['class' => 'yii\grid\SerialColumn'],
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
    'birth_date',
    [
        'attribute' => 'countActivity',
        'label' => 'จำนวนที่เข้าร่วมกิจกรรม'
    ],
    [
        'class' => 'yii\grid\ActionColumn',
        'buttonOptions'=>['class'=>'btn btn-default'],
        'template'=>'<div class="btn-group btn-group-sm text-center" role="group"> {view} {update} {delete} </div>',
    ]
];
?>
<div class="person-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('เพิ่มบุคคลใหม่', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
</div>

<div class = "row" style="margin: auto">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4>บุคลทั้งหมด</h4>
        </div>
        <?php
            echo ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $items
                ]);
        ?>
        <div class="panel-body" >
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => $items
            ]); ?>
        </div>
    </div>
</div>