<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MeritList */

$this->title = 'Create Merit List';
$this->params['breadcrumbs'][] = ['label' => 'Merit Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="merit-list-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
