<?php

use yii\db\Migration;

/**
 * Class m230107_024516_add_column_request
 */
class m230107_024516_add_column_request extends Migration
{
    // /**
    //  * {@inheritdoc}
    //  */
    // public function safeUp()
    // {

    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function safeDown()
    // {
    //     echo "m230107_024516_add_column_request cannot be reverted.\n";

    //     return false;
    // }

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('request','time_start',$this->date());
        $this->addColumn('request','time_end',$this->date());
    }

    public function down()
    {
        echo "m230107_024516_add_column_request cannot be reverted.\n";

        return false;
    }

}
