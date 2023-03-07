<?php

use yii\db\Migration;

/**
 * Class m230306_145436_create_table_staff
 */
class m230306_145436_create_table_staff extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('staff',[
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'province_id' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('staff');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230306_145436_create_table_staff cannot be reverted.\n";

        return false;
    }
    */
}
