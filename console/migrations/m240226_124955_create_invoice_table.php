<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%invoice}}`.
 */
class m240226_124955_create_invoice_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%invoice}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'customer_name' => $this->string()->notNull(),
            'customer_email' => $this->string()->notNull(),
            'invoice_date' => $this->date()->notNull(),
            'amount' => $this->decimal(10, 2)->notNull(),
            'description' => $this->text()->notNull(),
        ]);

        // Add foreign key constraint
        $this->addForeignKey(
            'fk-invoice-user_id',
            'invoice',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop foreign key constraint
        $this->dropForeignKey(
            'fk-invoice-user_id',
            'invoice'
        );

        $this->dropTable('{{%invoice}}');
    }
}
