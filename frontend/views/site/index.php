<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Invoice Generator';

?>

<div class="site-index">
    <div class="jumbotron">
        <h1>Welcome to the Invoice Generator</h1>
        <p class="lead">Easily create and manage invoices for your customers.</p>
        <p>
            <?= Html::a('Create New Invoice', Yii::$app->user->isGuest ? Url::to(['site/login']) : Url::to(['invoice/index']), ['class' => 'btn btn-primary']) ?>
            <?= Html::a('View Invoices', Url::to(['invoice/view-invoice']), ['class' => 'btn btn-success']) ?>
        </p>
    </div>
</div>