<?php

use yii\db\Migration;

/**
 * Class m230209_131446_add_column_icon_table_menu
 */
class m230209_131446_add_column_icon_table_menu extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('menu','icon', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230209_131446_add_column_icon_table_menu cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230209_131446_add_column_icon_table_menu cannot be reverted.\n";

        return false;
    }
    */
}
