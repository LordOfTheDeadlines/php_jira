<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m210430_045524_create_user_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'login' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'email' => $this->string(),
            'creation_date' => $this->date()
        ]);
        $this->insert('user', [
            'login' => 'admin',
            'password' => 'admin',
            'email' => 'admin1@mail.ru',
            'creation_date' => '2021-04-30'
        ]);
        $this->insert('user', [
            'login' => 'Kate',
            'password' => 'dino123',
            'email' => 'dino@gmail.ru',
            'creation_date' => '2021-04-30'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('user', ['id' => 1]);
        $this->delete('user', ['id' => 2]);
        $this->dropTable('{{%user}}');
    }
}
