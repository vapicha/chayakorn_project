<?php

use yii\db\Migration;

/**
 * Class m171124_085217_createTableActivityMember
 */
class m171124_085217_createTableActivityMember extends Migration
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
        
        $this->createTable('activity_member',[
            'id'=> $this->primaryKey(),
            'activity_list_id' => $this->integer()->notNull(),
            'person_id' => $this->integer()->notNull(),
            'detail' => $this->text()

        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('activity_member');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171124_085217_createTableActivityMember cannot be reverted.\n";

        return false;
    }
    */
}
