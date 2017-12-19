<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MeritMember */

$this->title = 'Create Merit Member';
$this->params['breadcrumbs'][] = ['label' => 'Merit Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="merit-member-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
