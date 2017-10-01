<?php

use yii\db\Migration;

class m170923_171452_init extends Migration
{
    public function safeUp()
    {
        $this->addColumn(\common\models\User::tableName(), 'ref',$this->string());
        $this->addColumn(\common\models\User::tableName(), 'first_name',$this->string());
        $this->addColumn(\common\models\User::tableName(), 'last_name',$this->string());
        $this->addColumn(\common\models\User::tableName(), 'parent',$this->integer());
        $this->addColumn(\common\models\User::tableName(), 'role',$this->string());
        $this->addColumn(\common\models\User::tableName(), 'phone',$this->string());
        $this->addColumn(\common\models\User::tableName(), 'birthday',$this->dateTime());

        $this->dropColumn('user', 'created_at');
        $this->dropColumn('user', 'updated_at');
        $this->addColumn('user', 'last_visit', $this->dateTime());
        $this->addColumn('user', 'created_at', $this->dateTime()->notNull());
        $this->addColumn('user', 'updated_at', $this->dateTime());

        $this->createTable('{{%user_info}}',[
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->unique(),
            'avatar' => $this->string(),
            'about' => $this->text(),
            'gender' => $this->integer(),
            'scope' => $this->string(),
        ]);

        $this->addForeignKey('user_info_user_id_fkey', 'user_info', 'user_id', 'user', 'id');
        $this->createIndex('user_info_unique', 'user_info' , ['user_id'], true);

        $this->createTable('{{%company}}',[
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'link' => $this->string(),
            'user_id' => $this->integer()->unique(),
            'scope' => $this->string(),
            'avatar' => $this->string(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);
        $this->createIndex('company_unique', 'company' , ['user_id'], true);

        $this->createTable('{{%company_like}}',[
            'id' => $this->primaryKey(),
            'created_at' => $this->dateTime()->notNull(),
            'company_id' => $this->integer()->notNull(),
            'user_id' => $this->integer(),
        ]);

        $this->addForeignKey('company_like_company_id_fkey', 'company_like', 'company_id', 'company', 'id');
        $this->addForeignKey('company_like_user_id_fkey', 'company_like', 'user_id', 'user', 'id');
        $this->createIndex('company_like_unique', 'company_like' , ['company_id', 'user_id'], false);

        $this->createTable('{{%company_suggest}}',[
            'id' => $this->primaryKey(),
            'created_at' => $this->dateTime()->notNull(),
            'company_id' => $this->integer()->notNull(),
            'user_id' => $this->integer(),
        ]);

        $this->addForeignKey('company_suggest_company_id_fkey', 'company_suggest', 'company_id', 'company', 'id');
        $this->addForeignKey('company_suggest_user_id_fkey', 'company_suggest', 'user_id', 'user', 'id');
        $this->createIndex('company_suggest_unique', 'company_suggest' , ['company_id', 'user_id'], false);



    }

    public function safeDown()
    {
        $this->dropColumn(\common\models\User::tableName(), 'ref');
        $this->dropColumn(\common\models\User::tableName(), 'parent');
        $this->dropColumn(\common\models\User::tableName(), 'type');



        $this->dropColumn('user', 'created_at');
        $this->dropColumn('user', 'updated_at');
        $this->dropColumn('user', 'last_visit');
        $this->addColumn('user', 'created_at', $this->integer()->notNull());
        $this->addColumn('user', 'updated_at', $this->integer());

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170923_171452_init cannot be reverted.\n";

        return false;
    }
    */
}
