<?php

use yii\db\Migration;

/**
 * Class m221222_042914_creat_table_level
 */
class m221222_042914_creat_table_level extends Migration
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
    //     echo "m221222_042914_creat_table_level cannot be reverted.\n";

    //     return false;
    // }

    public function up()
    {
        $this->createTable('level',[
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
        $this->dropTable('level');
        return false;
    }
}
