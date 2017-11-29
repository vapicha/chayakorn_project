<?php

use yii\db\Migration;

/**
 * Class m171124_084946_createTablePhoto
 */
class m171124_084946_createTablePhoto extends Migration
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
        
        $this->createTable('photo',[
            'id'=> $this->primaryKey(),
            'name' => $this->string(),
            'surname' => $this->string(),
            'person_id' => $this->integer(),
            'ref' => $this->string(),

        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('photo');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171124_084946_createTablePhoto cannot be reverted.\n";

        return false;
    }
    */
}
