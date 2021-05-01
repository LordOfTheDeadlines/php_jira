<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%status}}`.
 */
class m210430_072117_create_status_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%status}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
        $this->insert('status', [
            'name' => 'in_process',
        ]);
        $this->insert('status', [
            'name' => 'completed',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('status', ['id' => 1]);
        $this->delete('status', ['id' => 2]);
        $this->dropTable('{{%status}}');
    }
}
