<?php

namespace common\models;

use Yii;
use dosamigos\gallery\Gallery;
use yii\helpers\Url;
use common\models\ActivityMember;

/**
 * This is the model class for table "person".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property string $code
 * @property string $phone_number
 * @property string $birth_date
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $birth_day;
    public $birth_month;
    public $birth_year; 
    public $ref;   

    public static function tableName()
    {
        return 'person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['birth_date'], 'safe'],
            [['firstname', 'lastname', 'code', 'phone_number'], 'string', 'max' => 255],
            [['phone_number'], 'string', 'max' => 15, 'min' => 8],
            [['phone_number'], 'match', 'not' => true, 'pattern' => '/[^0-9#-]/', 'message' => 'เบอร์โทรต้องประกอบด้วยตัวอักษร 0-9 เท่านั้น'],
            [['firstname','lastname'],'validateName'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'ชื่อ',
            'lastname' => 'นามสกุล',
            'code' => 'รหัส',
            'phone_number' => 'เบอร์โทรศัพท์',
            'birth_date' => 'วันเกิด',
        ];
    }

    public function getFullname()
    {
        return $this->firstname. ' '. $this->lastname;
    }
    public function getFullBirthDay(){
        if($this->birth_date == '0000-00-00'){
            return null;
        }else{
            $today = new \DateTime('now');
            $birth_date = new \DateTime($this->birth_date);
            $age = date_diff($today,$birth_date);
            return Yii::$app->formatter->asDate($this->birth_date, 'medium')." อายุ: ".$age->format('%y')." ปี";
        }
    }
    public function getPhoto(){
        $model = Photo::find()->where(['person_id'=>$this->id])->one();
        if(isset($model)){
            return Gallery::widget(['items' => $model->getThumbnails($model->ref,$model->name)]);
        }else{
            return null;
        }
    }
    public function getUrlPhoto(){
        $model = Photo::find()->where(['person_id'=>$this->id])->one();
        if(isset($model)){
            $preview = $model->getThumbnails($model->ref,$model->name);
            return $preview[0]['url'];
        }else{
            return null;
        }   
    }
    public function getQrcode(){
        return '<img src='.Url::to(['person/qrcode', 'text' => $this->code]).' />';
    }
    public function getCountActivity(){
        $model_count = ActivityMember::find()->where(['person_id'=>$this->id])->count();
        return $model_count;
    }
    public function validateName(){
        $model = Person::find()->where(['firstname'=>$this->firstname])->andWhere(['lastname'=>$this->lastname])->one();
        yii::info('fgsdfgsdf');
        if(isset($model)){
            // $this->addError('lastname','มีรายชื่อนี้อยู่ในระบบแล้ว <a href="view?id='.$model->id.'" target="_blank">ตรวจสอบ</a>');
            $page= '
                        <a href="" data-toggle="modal" data-target="#modal-checkname">
                          ตรวจสอบข้อมูล
                        </a>
                        <div class="modal fade" id="modal-checkname" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">'.$model->fullname.'</h4>
                              </div>
                              <div class="modal-body" style = "color:black">
                                '.$model->photo.'
                                <p>วันเกิด : '.$model->fullBirthDay.'</p>
                              </div>
                            </div>
                          </div>
                        </div>
                    ';
            $this->addError('lastname','มีรายชื่อนี้อยู่ในระบบแล้ว '.$page);

        }
    }
}
