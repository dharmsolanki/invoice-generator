<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Admin Dashboard';
// $this->params['breadcrumbs'][] = $this->title;
?>

<div class="admin-default-index">
    <div class="jumbotron">
        <h1><?= Html::encode($this->title) ?></h1>
        <p class="lead">Welcome to the admin dashboard.</p>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text"><?= $usersCount ?></p>
                    <a href="<?= Url::to(['site/user-list']) ?>" class="btn btn-success">Show More>></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <p>
                <button class="btn btn-success create">Create User</button>
            </p>
        </div>
    </div>
</div>

<div class="user-create" style="display: none;">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Create User</div>
                    <div class="card-body">
                        <?php $form = ActiveForm::begin(['id' => 'create-user-form', 'action' => Url::to(['site/create-user'])]); ?>

                        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
                        
                        <?= $form->field($model, 'showPassword')->checkbox() ?>

                        <div class="form-group">
                            <?= Html::submitButton('Create', ['class' => 'btn btn-success', 'id' => 'create-user-btn']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>