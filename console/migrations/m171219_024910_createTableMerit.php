<?php

use yii\db\Migration;

/**
 * Class m171219_024910_createTableMerit
 */
class m171219_024910_createTableMerit extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('merit_list',[
            'id'=> $this->primaryKey(),
            'name' => $this->string(),
            'date' => $this->date(),
            'detail' => $this->text()

        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('merit_list');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171219_024910_createTableMerit cannot be reverted.\n";

        return false;
    }
    */
}
