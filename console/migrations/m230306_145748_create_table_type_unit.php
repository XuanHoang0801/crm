<?php

use yii\db\Migration;

/**
 * Class m230306_145748_create_table_type_unit
 */
class m230306_145748_create_table_type_unit extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('type_unit',[
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropTable('type_unit');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230306_145748_create_table_type_unit cannot be reverted.\n";

        return false;
    }
    */
}
