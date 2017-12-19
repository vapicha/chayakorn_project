<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "merit_list".
 *
 * @property integer $id
 * @property string $name
 * @property string $date
 * @property string $detail
 */
class MeritList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'merit_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
            'name' => 'Name',
            'date' => 'Date',
            'detail' => 'Detail',
        ];
    }
}
