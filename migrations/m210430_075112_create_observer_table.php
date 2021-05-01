<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%observer}}`.
 */
class m210430_075112_create_observer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%observer}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'task_id' => $this->integer()->notNull()
        ]);
        $this->addForeignKey(
            'observer_user_id',  //"условное имя" ключа
            'observer', //название текущей таблицы
            'user_id', //имя поля в текущей таблице, которое будет ключом
            'user', //имя таблицы, с которой хотим связаться
            'id', //поле таблицы, с которым хотим связаться
            'CASCADE'
        );
        $this->addForeignKey(
            'observer_task_id',  //"условное имя" ключа
            'observer', //название текущей таблицы
            'task_id', //имя поля в текущей таблице, которое будет ключом
            'task', //имя таблицы, с которой хотим связаться
            'id', //поле таблицы, с которым хотим связаться
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%observer}}');
        $this->dropForeignKey(
            'observer_user_id',
            'user'
        );
        $this->dropForeignKey(
            'observer_task_id',
            'task'
        );
    }
}
