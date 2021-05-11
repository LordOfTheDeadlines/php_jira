<?php

use yii\db\Migration;

/**
 * Class m210510_103353_add_time_expectation_column_to_task
 */
class m210510_103353_add_time_expectation_column_to_task extends Migration
{
    public function safeUp()
    {
        $this->addColumn('task', 'timeExpectation', $this->string());
    }

    public function safeDown()
    {
        $this->dropColumn('task', 'timeExpectation');

        return true;
    }
}
