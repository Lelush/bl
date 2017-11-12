<?php

use yii\db\Migration;

/**
 * Class m171112_141926_UserInfoSocial
 */
class m171112_141926_UserInfoSocial extends Migration
{
    public $tableName = '{{%user_info}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName,'vk',$this->string());
        $this->addColumn($this->tableName,'fb',$this->string());
        $this->addColumn($this->tableName,'tw',$this->string());
        $this->addColumn($this->tableName,'inst',$this->string());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName,'vk');
        $this->dropColumn($this->tableName,'fb');
        $this->dropColumn($this->tableName,'tw');
        $this->dropColumn($this->tableName,'inst');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171112_141926_UserInfoSocial cannot be reverted.\n";

        return false;
    }
    */
}
