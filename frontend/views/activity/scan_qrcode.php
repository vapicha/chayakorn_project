<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\widgets\Alert;
use yii\helpers\ArrayHelper;

if (Yii::$app->session->hasFlash('alert')) {
    echo \yii\bootstrap\Alert::widget([
                    'body'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
                    'options'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
    ]);
}
	$model->code ="";
?>

<div class = "enhanced">
    <?php $form = ActiveForm::begin(); ?>
        <h3>สแกน QR Code ของท่าน / พิมพ์รหัสประจำของท่าน</h3>
        <div class="input-group">
	      <?= Html::activeTextInput($model, 'code',['class'=>'form-control','placeholder'=>'ค้นหาข้อมูล...','autofocus' => 'autofocus','tabindex' => '1']) ?>
	      <span class="input-group-btn">
	        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i> ค้นหา</button>
	      </span>
	    </div>   
    <?php ActiveForm::end(); ?>
</div>
<?php if(isset($person)):?>
	<div class="enhanced">
		<div class="row">
		  <div class="col-sm-6 col-md-4" style="left:33%; text-align: center;">
		    <div class="thumbnail">
		      <?= $person->photo ?>
		      <div class="caption">
		        <h3>กัลฯ <?=$person->fullname?></h3>
		        <p>รหัส : <?= $person->code?></p>
		        <p>วันเกิด : <?= $person->birth_date?></p>
		        <p>เบอร์โทรศัพท์ : <?= $person->phone_number?></p>
		      </div>
		    </div>
		  </div>
		</div>
		<div style="text-align: center">
			<font color=green><h1>ลงทะเบียนกิจกรรมเรียบร้อย !!!</h1></font>
		</div>
	</div>
<?php endif ?>