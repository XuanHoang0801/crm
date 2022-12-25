<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%request}}`.
 */
class m221224_022620_create_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $this->createTable('{{%request}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->notNull(),
            'detail'=>$this->text()->notNull(),
            'deadline'=>$this->integer()->notNull(),
            'project_id'=>$this->integer()->notNull(),
            'user_id'=>$this->integer()->notNull(),
            'status_id'=>$this->integer()->notNull(),
            'level_id'=>$this->integer()->notNull(),
            'image'=>$this->string(),
            'created_at'=>$this->timestamp()->notNull(),
            'updated_at'=>$this->timestamp()->notNull(),
            'deleted_at'=>$this->timestamp(),

        ]);

        // create index
        $this->createIndex(
            'idx-request-project_id',
            'request',
            'project_id'
        );

        //creat forenign key for table categories

        $this->addForeignKey(
            'fk-request-project_id',
            'request',
            'project_id',
            'project',
            'id',
            'CASCADE'
        );
        // create index
        $this->createIndex(
            'idx-request-user_id',
            'request',
            'user_id'
        );

        //creat forenign key for table categories

        $this->addForeignKey(
            'fk-request-user_id',
            'request',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        // create index
        $this->createIndex(
            'idx-request-status_id',
            'request',
            'status_id'
        );

        //creat forenign key for table categories

        $this->addForeignKey(
            'fk-request-status_id',
            'request',
            'status_id',
            'status',
            'id',
            'CASCADE'
        );
        // create index
        $this->createIndex(
            'idx-request-level_id',
            'request',
            'level_id'
        );

        //creat forenign key for table categories

        $this->addForeignKey(
            'fk-request-level_id',
            'request',
            'level_id',
            'level',
            'id',
            'CASCADE'
        );



    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
        $this->dropTable('{{%request}}');
    }
}
