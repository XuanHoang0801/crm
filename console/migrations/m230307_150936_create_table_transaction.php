<?php

use yii\db\Migration;

use function PHPSTORM_META\map;

/**
 * Class m230307_150936_create_table_transaction
 */
class m230307_150936_create_table_transaction extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('transaction',[
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'unit_id' => $this->string()->notNull(),
            'time_start' => $this->dateTime(),
            'time_end' => $this->dateTime(),
            'package_id' => $this->string(),
            'total' => $this->integer(),
            'status' => $this->integer(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230307_150936_create_table_transaction cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230307_150936_create_table_transaction cannot be reverted.\n";

        return false;
    }
    */
}
