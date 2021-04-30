<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task}}`.
 */
class m210430_072545_create_task_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%task}}', [
            'id' => $this->primaryKey(),
            'creation_date' => $this->date()->notNull(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'status_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'executor_id' => $this->integer()->notNull(),
            'stop_date' => $this->date()->notNull()
        ]);
        $this->addForeignKey(
            'status_id',  //"условное имя" ключа
            'task', //название текущей таблицы
            'status_id', //имя поля в текущей таблице, которое будет ключом
            'status', //имя таблицы, с которой хотим связаться
            'id', //поле таблицы, с которым хотим связаться
            'CASCADE'
        );
        $this->addForeignKey(
            'author_id',
            'task',
            'author_id',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'executor_id',
            'task',
            'executor_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%task}}');
        $this->dropForeignKey(
            'status_id',
            'status'
        );
        $this->dropForeignKey(
            'author_id',
            'user'
        );
        $this->dropForeignKey(
            'executor_id',
            'user'
        );
    }
}
