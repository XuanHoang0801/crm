<?php

use yii\db\Migration;

/**
 * Class m230306_150147_create_table_unit
 */
class m230306_150147_create_table_unit extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('unit',[
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'type_unit_id' =>$this->string()->notNull(),
            'belong_unit_id' => $this->string()->notNull(),
            'link' => $this->string(),
            'type_customer_id' => $this->string(),
            'status' => $this->integer(),
            'province_id' => $this->string()->notNull(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('unit');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230306_150147_create_table_unit cannot be reverted.\n";

        return false;
    }
    */
}
