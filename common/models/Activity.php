<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "activity".
 *
 * @property integer $id
 * @property string $name
 * @property string $date_start
 * @property string $date_end
 * @property string $detail
 */
class Activity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_start', 'date_end'], 'safe'],
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
            'name' => 'Name',
            'date_start' => 'Date Start',
            'date_end' => 'Date End',
            'detail' => 'Detail',
        ];
    }
}