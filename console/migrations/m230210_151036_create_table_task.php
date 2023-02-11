<?php

use yii\db\Migration;

/**
 * Class m230210_151036_create_table_task
 */
class m230210_151036_create_table_task extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('task',[
            'id'=> $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->text(),
            'url' => $this->string(),
            'database' => $this->string(),
            'table' => $this->string(),
            'status' => $this->integer(),
            'note' => $this->text(),
            'image' => $this->string(),
            'created_at'=> $this->timestamp(),
            'updated_at'=> $this->timestamp(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('task');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230210_151036_create_table_task cannot be reverted.\n";

        return false;
    }
    */
}
