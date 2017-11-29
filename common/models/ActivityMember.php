<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "activity_member".
 *
 * @property integer $id
 * @property integer $activity_list_id
 * @property integer $person_id
 * @property string $detail
 */
class ActivityMember extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity_member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_list_id', 'person_id'], 'required'],
            [['activity_list_id', 'person_id'], 'integer'],
            [['detail'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity_list_id' => 'Activity List ID',
            'person_id' => 'Person ID',
            'detail' => 'Detail',
        ];
    }
}