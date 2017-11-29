<?php

namespace common\models;

use Yii;
use \yii\web\UploadedFile;
use yii\helpers\Url;
/**
 * This is the model class for table "photo".
 *
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property integer $person_id
 * @property string $ref
 */
class Photo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $upload_foler = 'uploads';
    const UPLOAD_FOLDER='uploads';

    public static function tableName()
    {
        return 'photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id'], 'integer'],
            [['name', 'surname', 'ref'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'person_id' => 'Person ID',
            'ref' => 'Ref',
        ];
    }

    public static function getUploadPath(){
        return Yii::getAlias('@webroot').'/'.self::UPLOAD_FOLDER.'/';
    }

    public static function getUploadUrl(){
        return Url::base(true).'/'.self::UPLOAD_FOLDER.'/';
    }

    public function getThumbnails($ref,$event_name){
         $uploadFiles   = Photo::find()->where(['ref'=>$ref])->all();
         $preview = [];
        foreach ($uploadFiles as $file) {
            $preview[] = [
                'url'=>self::getUploadUrl(true).$ref.'/'.$file->name,
                'src'=>self::getUploadUrl(true).$ref.'/thumbnail/'.$file->name,
                'options' => ['title' => $event_name]
            ];
        }
        return $preview;
    }
}
