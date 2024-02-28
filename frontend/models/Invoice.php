<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "invoice".
 *
 * @property int $id
 * @property string $customer_name
 * @property string $customer_email
 * @property string $invoice_date
 * @property float $amount
 * @property string $description
 */
class Invoice extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'customer_name', 'invoice_date'], 'required'],
            [['invoice_date', 'customer_email'], 'safe'],
            [['amount'], 'number'],
            [['description'], 'string'],
            [['customer_name', 'customer_email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_name' => 'Customer Name',
            'customer_email' => 'Customer Email',
            'invoice_date' => 'Invoice Date',
            'amount' => 'Amount',
        ];
    }
}
