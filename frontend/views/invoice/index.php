<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

// Determine if it's a new invoice or an edit
$isEdit = isset($_GET['id']);
$actionUrl = $isEdit ? ['invoice/edit', 'id' => $_GET['id']] : ['invoice/create-invoice'];
$title = $isEdit ? 'Edit Invoice' : 'New Invoice';

$this->title = $title;
?>

<div class="invoice-generator">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['id' => 'invoice-generator-form', 'action' => Url::to($actionUrl)]); ?>

    <div class="form-group">
        <?= $form->field($model, 'customer_name')->textInput(['class' => 'form-control', 'placeholder' => 'Customer Name'])->label(false) ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'customer_email')->textInput(['class' => 'form-control', 'placeholder' => 'Customer Email'])->label(false) ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'invoice_date')->textInput(['type' => 'date', 'class' => 'form-control'])->label(false) ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'amount')->textInput(['type' => 'number', 'step' => '0.01', 'class' => 'form-control', 'id' => 'amount', 'placeholder' => 'Amount'])->label(false) ?>
    </div>
    <div id="product-fields-container" class="row mb-3">
        <?php if ($isEdit) { ?>
            <?php foreach ($products as $index => $product) : ?>
                <div class="col-md-6">
                    <input type="hidden" name="Product[id][]" value="<?= $product->id ?>">
                    <input type="text" class="form-control product-name" name="Product[name][]" value="<?= $product->name ?>" placeholder="Product Name">
                </div>
                <div class="col-md-6">
                    <input type="number" step="0.01" class="form-control price" name="Product[price][]" value="<?= $product->price ?>" placeholder="Price">
                </div>
            <?php endforeach; ?>
        <?php } ?>
    </div>


    <!-- Add Product Button -->
    <div class="form-group">
        <?= Html::button('Add Product', ['class' => 'btn btn-primary', 'id' => 'add-product-button']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary btn-block', 'name' => 'generate-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>