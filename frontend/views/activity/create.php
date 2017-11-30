<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Activity */

$this->title = 'สร้างกิจกรรมใหม่';
$this->params['breadcrumbs'][] = ['label' => 'Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-create">

    <font color=white><h1><?= Html::encode($this->title) ?></h1></font>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
