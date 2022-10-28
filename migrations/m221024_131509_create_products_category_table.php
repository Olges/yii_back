<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products_category}}`.
 */
class m221024_131509_create_products_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products_category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products_category}}');
    }
}
