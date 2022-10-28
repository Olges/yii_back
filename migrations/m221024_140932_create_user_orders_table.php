<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_orders}}`.
 */
class m221024_140932_create_user_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_orders}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11),
            'product_id' => $this->integer(11),
            'created_at' => $this->integer(11)
        ]);

        $this->createIndex(
            'idx-user_orders-user_id',
            'user_orders',
            'user_id'
        );

        $this->addForeignKey(
            'fk-products-user_id',
            'user_orders',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-user_orders-product_id',
            'user_orders',
            'product_id'
        );

        $this->addForeignKey(
            'fk-products-product_id',
            'user_orders',
            'product_id',
            'products',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-products-user_id',
            'user_orders'
        );
        $this->dropForeignKey(
            'fk-products-product_id',
            'user_orders'
        );

        $this->dropIndex(
            'idx-user_orders-user_id',
            'user_orders'
        );
        $this->dropIndex(
            'idx-user_orders-product_id',
            'user_orders'
        );

        $this->dropTable('{{%user_orders}}');
    }
}
