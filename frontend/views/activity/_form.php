<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Activity */
/* @var $form yii\widgets\ActiveForm */
if(!isset($model->date_end)){
	$date_start = date('Y-m-d');
	$date_end = date('Y-m-d');
}else{
	$date_start = $model->date_start;
	$date_end = $model->date_end;
}
?>

<div class="enhanced">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<div class = "col-md-6">
		วันเริ่มต้นกิจกรรม
		<div class="input-group drp-container">
			<?= DateRangePicker::widget([
			    'name'=>'date_start',
			    'value'=>$date_start,
			    'useWithAddon'=>true,
			    'pluginOptions'=>[
			        'singleDatePicker'=>true,
			        'showDropdowns'=>true
			    ]
			]) ?>
			<span class="input-group-addon">
				<i class="glyphicon glyphicon-calendar"></i>
			</span>
		</div>
	</div>
	<div class = "col-md-6">
		วันสิ้นสุดกิจกรรม
		<div class="input-group drp-container">
			<?= DateRangePicker::widget([
			    'name'=>'date_end',
			    'value'=>$date_end,
			    'useWithAddon'=>true,
			    'pluginOptions'=>[
			        'singleDatePicker'=>true,
			        'showDropdowns'=>true,
			    ],
			])?>
			<span class="input-group-addon">
				<i class="glyphicon glyphicon-calendar"></i>
			</span>
		</div>
	</div>
	<br />
    <?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
