<?php

use yii\db\Migration;

/**
 * Class m171220_214303_userView
 */
class m171220_214303_userView extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}','views', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}','views');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171220_214303_userView cannot be reverted.\n";

        return false;
    }
    */
}
