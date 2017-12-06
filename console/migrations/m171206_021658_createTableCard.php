<?php

use yii\db\Migration;

/**
 * Class m171206_021658_createTableCard
 */
class m171206_021658_createTableCard extends Migration
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
        
        $this->createTable('card',[
            'id'=> $this->primaryKey(),
            'person_id' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),

        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('card');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171206_021658_createTableCard cannot be reverted.\n";

        return false;
    }
    */
}
