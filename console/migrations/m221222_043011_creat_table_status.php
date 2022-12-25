<?php

use yii\db\Migration;

/**
 * Class m221222_043011_creat_table_status
 */
class m221222_043011_creat_table_status extends Migration
{
    /**
     * {@inheritdoc}
     */
    // public function safeUp()
    // {

    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function safeDown()
    // {
    //     echo "m221222_043011_creat_table_status cannot be reverted.\n";

    //     return false;
    // }

    public function up()
    {
        $this->createTable('status',[
            'id'=> $this->primaryKey(),
            'name'=>$this->string()->notNull(),
            'color'=>$this->string()->notNull(),
            'created_at'=>$this->timestamp()->notNull(),
            'updated_at'=>$this->timestamp()->notNull(),
            'deleted_at'=>$this->timestamp()
        ]);
    }

    public function down()
    {
        $this->dropTable('status');
        return false;
    }
}
