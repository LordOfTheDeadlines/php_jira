<?php

use yii\db\Migration;

/**
 * Class m210510_121559_add_default_value_for_creation_date
 */
class m210510_121559_add_default_value_for_creation_date extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn(
            '{{%user}}',
            'creation_date',
            $this->dateTime()
                ->defaultExpression('NOW()')
                ->append('ON UPDATE NOW()')
        );
        $this->alterColumn(
            '{{%task}}',
            'creation_date',
            $this->dateTime()
                ->defaultExpression('NOW()')
                ->append('ON UPDATE NOW()')
        );
        $this->alterColumn(
            '{{%comment}}',
            'creation_date',
            $this->dateTime()
                ->defaultExpression('NOW()')
                ->append('ON UPDATE NOW()')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210510_121559_add_default_value_for_creation_date cannot be reverted.\n";

        return false;
    }

}
