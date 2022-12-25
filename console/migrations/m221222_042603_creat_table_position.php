<?php

use yii\db\Migration;

/**
 * Class m221222_042603_creat_table_position
 */
class m221222_042603_creat_table_position extends Migration
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
    //     echo "m221222_042603_creat_table_position cannot be reverted.\n";

    //     return false;
    // }

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('position',[
            'id'=> $this->primaryKey(),
            'name'=>$this->string()->notNull(),
            'created_at'=>$this->timestamp()->notNull(),
            'updated_at'=>$this->timestamp()->notNull(),
            'deleted_at'=>$this->timestamp()
        ]);
    }

    public function down()
    {
        $this->dropTable('position');
        return false;
    }
    
}
