<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;
use common\models\Activity;
use common\models\Person;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;	
use yii\helpers\Url;
use common\widgets\Alert;

if (Yii::$app->session->hasFlash('alert')) {
    echo \yii\bootstrap\Alert::widget([
                    'body'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
                    'options'=>ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
    ]);
}

$model_activity_list = Activity::find()->where(['id'=>$activity_list_id])->one();
?>
<h3><?= "กิจกรรม : ".$model_activity_list->name." ".$model_activity_list->date_start ?></h3>
<div class = "enhanced">
	<?php $form = ActiveForm::begin(); ?>

	<div class = "row">
        <div class = "col-md-6">
            <?php
                $person = Person::find()->orderBy('firstname')->all();
                $data_person = ArrayHelper::map($person, 'id', 'fullName');
            ?>
            <label class="control-label">ชื่อบุคคล</label>
            <div>
                <?=  Select2::widget([
                        'model' => $model,
                        'attribute' => 'person_id',
                        'data' => $data_person,
                        'options' => [
                            'placeholder' => 'Select Address ...',
                            'data' => $model->person_id
                        ],
                    ]);
                ?>
                
            </div>
            
        </div>

    </div><br>
    <div class="form-group">
        <?= Html::submitButton('เพิ่มสมาชิก',['activity_list_id'=>$activity_list_id,'class' =>'btn btn-success', 'onclick' => "this.form.submit(); this.disabled=true; this.value='Sending…';"]) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>