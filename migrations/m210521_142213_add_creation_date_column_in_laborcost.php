<?php

use yii\db\Migration;

/**
 * Class m210521_142213_add_creation_date_column_in_laborcost
 */
class m210521_142213_add_creation_date_column_in_laborcost extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('laborcost', 'creation_date', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('laborcost', 'creation_date');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210521_142213_add_creation_date_column_in_laborcost cannot be reverted.\n";

        return false;
    }
    */
}
