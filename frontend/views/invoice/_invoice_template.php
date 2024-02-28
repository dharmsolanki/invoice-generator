<h1 style="text-align: center; margin-bottom: 20px;">Invoice</h1>
<table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
    <tr>
        <th style="padding: 8px; border: 1px solid #ddd; background-color: #f2f2f2;">Customer Name</th>
        <td style="padding: 8px; border: 1px solid #ddd;"><?= $model->customer_name ?></td>
    </tr>
    <tr>
        <th style="padding: 8px; border: 1px solid #ddd; background-color: #f2f2f2;">Customer Email</th>
        <td style="padding: 8px; border: 1px solid #ddd;"><?= $model->customer_email ?></td>
    </tr>
    <tr>
        <th style="padding: 8px; border: 1px solid #ddd; background-color: #f2f2f2;">Invoice Date</th>
        <td style="padding: 8px; border: 1px solid #ddd;"><?= date('d-m-Y', strtotime($model->invoice_date)) ?></td>
    </tr>
</table>

<h2>Products</h2>
<table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
    <tr>
        <th style="padding: 8px; border: 1px solid #ddd; background-color: #f2f2f2;">Product Name</th>
        <th style="padding: 8px; border: 1px solid #ddd; background-color: #f2f2f2;">Price</th>
    </tr>
    <?php
    $totalAmount = 0;
    foreach ($products as $product) :
        $totalAmount += $product->price;
    ?>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;"><?= $product->name ?></td>
            <td style="padding: 8px; border: 1px solid #ddd;">₹. <?= $product->price ?></td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <th style="padding: 8px; border: 1px solid #ddd; background-color: #f2f2f2;">Total Amount</th>
        <td style="padding: 8px; border: 1px solid #ddd;">₹. <?= $totalAmount ?></td>
    </tr>
</table>