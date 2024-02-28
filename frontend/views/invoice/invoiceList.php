<div class="container mt-5">
    <h1 class="mb-4">Invoices</h1>

    <?php

use yii\helpers\Url;

 if (empty($model)) : ?>
        <p>No records found.</p>
    <?php else : ?>
        <!-- <a href="#" class="btn btn-primary mb-4">Create New Invoice</a> -->
        <table class="table">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Date Created</th>
                    <th>Total Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($model as $invoice) { ?>
                    <tr>
                        <td><?= $invoice->customer_name ?></td>
                        <td><?= date('d-m-Y', strtotime($invoice->invoice_date)) ?></td>
                        <td><?= $invoice->amount ?></td>

                        <td>
                            <a href="<?= Url::to(['invoice/print', 'id' => $invoice->id]) ?>" class="btn btn-sm btn-info" target="_blank"><i class="fas fa-print"></i></a>
                            <a href="<?= Url::to(['invoice/edit', 'id' => $invoice->id]) ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                            <a href="<?= Url::to(['invoice/delete', 'id' => $invoice->id]) ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
