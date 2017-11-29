<?php

use yii\db\Migration;

/**
 * Class m171124_084443_createTablePerson
 */
class m171124_084443_createTablePerson extends Migration
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
        
        $this->createTable('person',[
            'id'=> $this->primaryKey(),
            'firstname' => $this->string(),
            'lastname' => $this->string(),
            'code' => $this->string(),
            'phone_number' => $this->string(),
            'birth_date' => $this->date() 

        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('person');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171124_084443_createTablePerson cannot be reverted.\n";

        return false;
    }
    */
}
