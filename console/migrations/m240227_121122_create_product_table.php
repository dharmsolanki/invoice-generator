<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m240227_121122_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'price' => $this->decimal(10, 2)->notNull(),
            'invoice_id' => $this->integer(),
            'user_id' => $this->integer(),
        ]);

        // Add foreign key for invoice_id
        $this->addForeignKey(
            'fk-product-invoice_id',
            '{{%product}}',
            'invoice_id',
            '{{%invoice}}',
            'id',
            'CASCADE'
        );

        // Add foreign key for user_id
        $this->addForeignKey(
            'fk-product-user_id',
            '{{%product}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop foreign key for invoice_id
        $this->dropForeignKey('fk-product-invoice_id', '{{%product}}');
        // Drop foreign key for user_id
        $this->dropForeignKey('fk-product-user_id', '{{%product}}');

        // Drop columns
        $this->dropColumn('{{%product}}', 'invoice_id');
        $this->dropColumn('{{%product}}', 'user_id');

        $this->dropTable('{{%product}}');
    }
}