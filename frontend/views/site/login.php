<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="card mt-5">
                <div class="card-body">
                    <h1 class="card-title"><?= Html::encode($this->title) ?></h1>

                    <p class="card-text">Please fill out the following fields to login:</p>

                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'form-control']) ?>

                    <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control']) ?>

                    <?= $form->field($model, 'rememberMe')->checkbox() ?>

                    <div class="text-center">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                    <div class="mt-3 text-center">
                        <p>If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.</p>
                        <p>Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email']) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>