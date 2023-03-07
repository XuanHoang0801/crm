<?php

use yii\db\Migration;

/**
 * Class m230306_145959_create_table_type_customer
 */
class m230306_145959_create_table_type_customer extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('type_customer',[
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('type_customer');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230306_145959_create_table_type_customer cannot be reverted.\n";

        return false;
    }
    */
}
