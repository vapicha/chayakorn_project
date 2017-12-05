<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
/* @var $this yii\web\View */
/* @var $model common\models\Person */
/* @var $form yii\widgets\ActiveForm */
$days = [];
for($dayNum = 1; $dayNum <= 31; $dayNum++){
    $days[$dayNum] = $dayNum;
}

// month
$months = [
    '1' => Yii::$app->formatter->asDate('2016-01-01', 'MMMM'),
    '2' => Yii::$app->formatter->asDate('2016-02-01', 'MMMM'),
    '3' => Yii::$app->formatter->asDate('2016-03-01', 'MMMM'),
    '4' => Yii::$app->formatter->asDate('2016-04-01', 'MMMM'),
    '5' => Yii::$app->formatter->asDate('2016-05-01', 'MMMM'),
    '6' => Yii::$app->formatter->asDate('2016-06-01', 'MMMM'),
    '7' => Yii::$app->formatter->asDate('2016-07-01', 'MMMM'),
    '8' => Yii::$app->formatter->asDate('2016-08-01', 'MMMM'),
    '9' => Yii::$app->formatter->asDate('2016-09-01', 'MMMM'),
    '10' => Yii::$app->formatter->asDate('2016-10-01', 'MMMM'),
    '11' => Yii::$app->formatter->asDate('2016-11-01', 'MMMM'),
    '12' => Yii::$app->formatter->asDate('2016-12-01', 'MMMM'),
];

$years = [];
$start = intval(date('Y', strtotime('-100 years'))) + 543;
$end = intval(date('Y')) + 543;
for ($i=$end; $i >= $start; $i--) { 
    $years[$i] = $i;
}
?>
<div class = "enhanced">
    <div class="person-form">

        <?php $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data'],
                'enableAjaxValidation'      => true, //เปิดการ validate ด้วย AJAX
                'enableClientValidation'    => false, // validate ฝั่ง client เมื่อ submit หรือ เปลี่ยนค่า
                'validateOnChange'          => true,// validate เมื่อมีการเปลี่ยนค่า
                'validateOnSubmit'          => true,// validate เมื่อ submit ข้อมูล
                'validateOnBlur'            => false,// validate เมื่อเปลี่ยนตำแหน่ง cursor 
        ]); ?>
        <div class = "col-md-6">
            <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>        
        </div>
        <div class = "col-md-6">
            <?= $form->field($model, 'lastname', ['errorOptions' => ['class' => 'help-block' ,'encode' => false]])->textInput(['maxlength' => true]) ?>        
        </div>
        <div class = "col-md-6">
            <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class = "col-md-6">
            <div class="col-md-3">
                <?= $form->field($model, 'birth_day')->dropdownList($days, [
                    'prompt' => 'เลือก'
                ])->label("วันเกิด") ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'birth_month')->dropdownList($months, [
                    'prompt' => 'เลือก'
                ])->label("เดือนเกิด") ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'birth_year')->dropdownList($years, [
                    'prompt' => 'เลือก'
                ])->label("ปีเกิด") ?>
            </div>
        </div>
        <div class = "col-md-12" id = "ddl-photo">
            <?= $form->field($model, 'ref')->hiddenInput(['maxlength' => 50])->label(false); ?>
            <div class="form-group field-upload_files">
              <label class="control-label" for="upload_files[]"> ภาพถ่าย </label>
              <div>
              <?= FileInput::widget([
                             'name' => 'upload_ajax[]',
                             'options' => ['multiple' => false,'accept' => 'image/*'], //'accept' => 'image/*' หากต้องเฉพาะ image
                              'pluginOptions' => [
                                  'browseClass' => 'btn btn-success',
                                  'uploadClass' => 'btn btn-info',
                                  'removeClass' => 'btn btn-danger',
                                  'showPreview' => true,
                                  'showCaption' => true,
                                  'showRemove' => false,
                                  'showUpload' => false,
                                  'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> ',
                                  'overwriteInitial'=>true,
                                  'initialPreviewShowDelete'=>true,
                                  'initialPreview'=> $initialPreview,
                                  'initialPreviewConfig'=> $initialPreviewConfig,
                                  // 'uploadUrl' => Url::to(['/photo/upload-ajax']),
                                  'uploadExtraData' => [
                                      'ref' => $model->ref,
                                  ],
                                  'maxFileCount' => 100,
                                  'maxFileSize'=>2000
                              ]
                          ]);
              ?>
              <h5>**ขนาดภาพถ่ายไม่เกิน 2mb</h5>
              </div>
            </div>
        </div>

        <div class="form-group" style="text-align:center;">
            <?= Html::submitButton($model->isNewRecord ? 'สร้าง' : 'แก้ไข', ['class' => $model->isNewRecord ? 'btn-lg btn-success' : 'btn-lg btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>