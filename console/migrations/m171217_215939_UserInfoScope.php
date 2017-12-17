<?php

use yii\db\Migration;

/**
 * Class m171217_215939_UserInfoScope
 */
class m171217_215939_UserInfoScope extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->alterColumn('{{%user_info}}', 'scope', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->alterColumn('{{%user_info}}', 'scope', $this->string());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171217_215939_UserInfoScope cannot be reverted.\n";

        return false;
    }
    */
}
