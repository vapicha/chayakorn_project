<?php

use yii\db\Migration;

/**
 * Class m171124_085114_createTableActivity
 */
class m171124_085114_createTableActivity extends Migration
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
        
        $this->createTable('activity',[
            'id'=> $this->primaryKey(),
            'name' => $this->string(),
            'date_start' => $this->date(),
            'date_end' => $this->date(),
            'detail' => $this->text(),

        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('activity');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171124_085114_createTableActivity cannot be reverted.\n";

        return false;
    }
    */
}
