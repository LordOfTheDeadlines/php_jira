<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%laborcost}}`.
 */
class m210430_080231_create_laborcost_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%laborcost}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'task_id' => $this->integer()->notNull(),
            'time' => $this->string()->notNull(),
            'comment' => $this->string()
        ]);
        $this->addForeignKey(
            'laborcost_user_id',
            'laborcost',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'laborcost_task_id',
            'laborcost',
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
        $this->dropTable('{{%laborcost}}');
        $this->dropForeignKey(
            'laborcost_user_id',
            'user'
        );
        $this->dropForeignKey(
            'laborcost_task_id',
            'task'
        );
    }
}
