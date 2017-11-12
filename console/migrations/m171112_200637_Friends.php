<?php

use yii\db\Migration;

/**
 * Class m171112_200637_Friends
 */
class m171112_200637_Friends extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%friends}}',[
            'friend_from' => $this->integer()->notNull(),
            'friend_to' => $this->integer()->notNull(),
            'status' => $this->integer(),
            'created_at' => $this->dateTime()->notNull(),
        ]);

        $this->addPrimaryKey('friends_pk', '{{%friends}}', ['friend_from', 'friend_to']);
        $this->addForeignKey('friends_friend_from_fkey', 'friends', 'friend_from', 'user', 'id');
        $this->addForeignKey('friends_friend_to_fkey', 'friends', 'friend_to', 'user', 'id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%friends}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171112_200637_Friends cannot be reverted.\n";

        return false;
    }
    */
}
