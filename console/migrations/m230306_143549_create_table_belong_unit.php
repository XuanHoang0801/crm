<?php

use yii\db\Migration;

/**
 * Class m230306_143549_create_table_belong_unit
 */
class m230306_143549_create_table_belong_unit extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('belong_unit',[
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('belong_unit');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230306_143549_create_table_belong_unit cannot be reverted.\n";

        return false;
    }
    */
}
