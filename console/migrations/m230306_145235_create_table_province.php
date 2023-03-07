<?php

use yii\db\Migration;

/**
 * Class m230306_145235_create_table_province
 */
class m230306_145235_create_table_province extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('provice',[
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('province');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230306_145235_create_table_province cannot be reverted.\n";

        return false;
    }
    */
}
