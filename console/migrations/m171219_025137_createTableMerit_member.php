<?php

use yii\db\Migration;

/**
 * Class m171219_025137_createTableMerit_member
 */
class m171219_025137_createTableMerit_member extends Migration
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
        
        $this->createTable('merit_member',[
            'id'=> $this->primaryKey(),
            'person_id' => $this->integer()->notNull(),
            'merit_id' => $this->integer()->notNull(),
            'name' => $this->string(),
            'date' => $this->date(),
            'detail' => $this->text()

        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('merit_member');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171219_025137_createTableMerit_member cannot be reverted.\n";

        return false;
    }
    */
}
