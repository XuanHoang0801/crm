<?php

use yii\db\Migration;

/**
 * Class m230307_145844_create_table_package
 */
class m230307_145844_create_table_package extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('package', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'detail' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230307_145844_create_table_package cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230307_145844_create_table_package cannot be reverted.\n";

        return false;
    }
    */
}
