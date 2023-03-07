<?php

use yii\db\Migration;

/**
 * Class m230307_143532_create_table_plan
 */
class m230307_143532_create_table_plan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('plan',[
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'customer_id' =>$this->string(),
            'form' => $this->integer(),
            'time_start' => $this->dateTime(),
            'time_end' => $this->dateTime(),
            'unit_id' => $this->string(),
            'content' => $this->text(),
            'error' => $this->text(),
            'request' => $this->string(),
            'fix'=> $this->text(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('plan');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230307_143532_create_table_plan cannot be reverted.\n";

        return false;
    }
    */
}
