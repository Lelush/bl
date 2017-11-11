<?php

use yii\db\Migration;

/**
 * Class m171111_184237_UserInfoProfInerests
 */
class m171111_184237_UserInfoProfInerests extends Migration
{
    public $tableName = '{{%user_info}}';
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName,'prof',$this->string());
        $this->addColumn($this->tableName,'interests',$this->string());
        $this->addColumn($this->tableName,'state',$this->string());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName,'prof');
        $this->dropColumn($this->tableName,'interests');
        $this->dropColumn($this->tableName,'state');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171111_184237_UserInfoProfInerests cannot be reverted.\n";

        return false;
    }
    */
}
