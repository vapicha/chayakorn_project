<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

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
            'fullBirthday',
        ],
    ]) ?>

</div>
