<?php 

namespace common\components;

use Yii;

use yii\helpers\ArrayHelper;

use common\models\Photo;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\Url;
/**
* URL Helper
*/
class PersonHelper
{
      
    public function tranBirthDate($post){

        if (empty($post['birth_day'])) {
            $post['birth_day'] = '1';
        }
        if (empty($post['birth_month'])) {
            $post['birth_month'] = '01';
        }
        if (empty($post['birth_year'])) {
            $post['birth_year'] = '2500';
        } else {
            $post['birth_year'] -= 543;
        }

        $birthdate = $post['birth_year'] . '-' . $post['birth_month'] . '-' . $post['birth_day'];
        
        return $birthdate;
    }

    public function tranBirthDateToForm($model){
        $birthday = $model->birth_date;
        $birthday_array = explode('-', $birthday);
        $model->birth_day = intval($birthday_array[2]);      
        $model->birth_month = intval($birthday_array[1]);
        $model->birth_year = intval($birthday_array[0])+543;
        return $model;
    }

    static function saveGenerateCode($model){
        $year = intval(date('Y')) + 543;
        $start = $year%2500;
        $main = floor(($model->id)/10000);
        $zero = '';
        for($i=1; $i<(5-$main); $i++){
            $zero = $zero."0";
        }
        $code = $start.$zero.$model->id;
        $model->code = $code;
        $model->save();
        // $model->code = ($model->id)+1000000;
        // $model->save();
    }

    static function uploadPhoto($person_id){
        $images = UploadedFile::getInstancesByName('upload_ajax');
        $Photo = Yii::$app->request->post('Person');
        $ref = $Photo['ref'];
        $have_photo = Photo::find()->where(['ref'=>$ref])->one();
        if($images){
            yii::info("1111");
            if(isset($have_photo)){
                BaseFileHelper::removeDirectory(Photo::getUploadPath().$have_photo->ref);
                Photo::deleteAll(['ref'=>$have_photo->ref]);
            }
            PersonHelper::CreateDir($ref);
            foreach ($images as $file){
                yii::info("222");
                $fileName       = $file->baseName . '.' . $file->extension;
                $realFileName   = md5($file->baseName.time()) . '.' . $file->extension;
                $savePath       = Photo::UPLOAD_FOLDER.'/'.$ref.'/'. $realFileName;
                if($file->saveAs($savePath)){

                    if(PersonHelper::isImage(Url::base(true).'/'.$savePath)){
                         PersonHelper::createThumbnail($ref,$realFileName,125);
                    }
                    
                    $model                  = new Photo();
                    $model->ref             = $ref;
                    $model->surname         = $fileName;
                    $model->name            = $realFileName;
                    $model->person_id       = $person_id;
                    $model->save();
                }
            }
        }
    }

    private function createThumbnail($folderName,$fileName,$width=250){
      $uploadPath   = Photo::getUploadPath().'/'.$folderName.'/';
      $file         = $uploadPath.$fileName;
      //yii::info($file);
      $image        = Yii::$app->image->load($file);
      $image->resize($width);
      $image->save($uploadPath.'thumbnail/'.$fileName);
      return;
    }

    public function isImage($filePath){
            return @is_array(getimagesize($filePath)) ? true : false;
    }

    private function CreateDir($folderName){
        if($folderName != NULL){
            $basePath = Photo::getUploadPath();
            if(BaseFileHelper::createDirectory($basePath.$folderName,0777)){
                BaseFileHelper::createDirectory($basePath.$folderName.'/thumbnail',0777);
            }
        }
        return;
    }
}