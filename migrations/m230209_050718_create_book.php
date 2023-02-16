<?php

use yii\db\Migration;

/**
 * Class m230209_050718_create_book
 */
class m230209_050718_create_book extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'author' => $this->string(255)->notNull(),
            'sale' => $this->boolean(false)->notNull(),
            'description' => $this->string(2550),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%book}}');
    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230209_050718_create_book cannot be reverted.\n";

        return false;
    }
    */
}
