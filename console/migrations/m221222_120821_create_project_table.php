<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project}}`.
 */
class m221222_120821_create_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $this->createTable('{{%project}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->notNull(),
            'deadline'=>$this->integer()->notNull(),
            'category_id'=>$this->integer()->notNull(),
            'user_id'=>$this->integer()->notNull(),
            'image'=>$this->string(),
            'created_at'=>$this->timestamp()->notNull(),
            'updated_at'=>$this->timestamp()->notNull(),
            'deleted_at'=>$this->timestamp()
        ]);

        // create index
        $this->createIndex(
            'idx-project-category_id',
            'project',
            'category_id'
        );

        //creat forenign key for table categories

        $this->addForeignKey(
            'fk-project-category_id',
            'project',
            'category_id',
            'categories',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-project-user_id',
            'project',
            'user_id'
        );

        $this->addForeignKey(
            'fk-project-user_id',
            'project',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
         // drops foreign key for table `user`
         $this->dropForeignKey(
            'fk-project-category_id',
            'project'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-project-category_id',
            'project'
        );

        // drops foreign key for table `category`
        $this->dropForeignKey(
            'fk-project-user_id',
            'project'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-project-user_id',
            'project'
        );

        $this->dropTable('{{%project}}');
    }
}
