<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m221024_140643_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'price' => $this->float(),
            'category_id' => $this->integer(11)
        ]);

        $this->addForeignKey(
            'fk-products-category_id',
            'products',
            'category_id',
            'products_category',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-products-category_id',
            'products',
            'category_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-products-category_id',
            'products'
        );

        $this->dropIndex(
            'idx-products-category_id',
            'products'
        );

        $this->dropTable('{{%products}}');
    }
}

