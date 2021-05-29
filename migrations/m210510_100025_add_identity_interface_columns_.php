<?php

use yii\db\Migration;

/**
 * Class m210510_100025_add_identity_interface_columns_
 */
class m210510_100025_add_identity_interface_columns_ extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'authKey', $this->string());
        $this->addColumn('user', 'accessToken', $this->string());
        $this->update('user', ['authKey' => 'test1key', 'accessToken' => '1-token'], ['login' => 'admin']);
        $this->update('user', ['authKey' => 'test2key', 'accessToken' => '2-token'], ['login' => 'Kate']);
    }

    public function safeDown()
    {
        $this->dropColumn('user', 'authKey');
        $this->dropColumn('user', 'accessToken');

        return true;
    }

}
