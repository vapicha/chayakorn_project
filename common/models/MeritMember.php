<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "merit_member".
 *
 * @property integer $id
 * @property integer $person_id
 * @property integer $merit_id
 * @property string $name
 * @property string $date
 * @property string $detail
 */
class MeritMember extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'merit_member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id', 'merit_id'], 'required'],
            [['person_id', 'merit_id'], 'integer'],
            [['date'], 'safe'],
            [['detail'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'person_id' => 'Person ID',
            'merit_id' => 'Merit ID',
            'name' => 'Name',
            'date' => 'Date',
            'detail' => 'Detail',
        ];
    }
}
