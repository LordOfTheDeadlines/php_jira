<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment}}`.
 */
class m210430_083412_create_comment_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'task_id' => $this->integer()->notNull(),
            'creation_date' => $this->dateTime()->notNull(),
            'text' => $this->text()->notNull()
        ]);
        $this->addForeignKey(
            'comment_user_id',
            'comment',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'comment_task_id',
            'comment',
            'task_id',
            'task',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%comment}}');
        $this->dropForeignKey(
            'comment_user_id',
            'user'
        );
        $this->dropForeignKey(
            'comment_task_id',
            'task'
        );
    }
}
