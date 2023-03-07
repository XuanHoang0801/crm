<?php

use yii\db\Migration;

/**
 * Class m230304_032129_create_table_notify
 */
class m230304_032129_create_table_notify extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('notify',[
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'slug' => $this->string(),
            'task_id' => $this->integer(),
            'user_id' => $this->integer(),
            'status' => $this->integer(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropTable('notify');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230304_032129_create_table_notify cannot be reverted.\n";

        return false;
    }
    */
}
