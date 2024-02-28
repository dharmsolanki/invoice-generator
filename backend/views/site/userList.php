<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm as YiiActiveForm;

$this->title = 'User List';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="row">
    <div class="col-md-12">
        <?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['site/user-list']]); ?>
        <div class="input-group mb-3">
            <?= Html::textInput('email', Yii::$app->request->get('email'), ['class' => 'form-control', 'placeholder' => 'Search by Email']) ?>
            <div class="input-group-append">
                <?= Html::submitButton('Search', ['class' => 'btn btn-outline-secondary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<div class="row">
    <?php foreach ($dataProvider->models as $model) : ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= Html::encode($model->username) ?></h5>
                    <p class="card-text"><?= Html::encode($model->email) ?></p>
                    <div id="update-form-<?= $model->id ?>" class="update-form" style="display: none;">
                        <?php $form = ActiveForm::begin([
                            'id' => 'update-form',
                            'layout' => 'horizontal',
                            'action' => Url::to(['site/update-user', 'id' => $model->id]),
                            'fieldConfig' => [
                                'horizontalCssClasses' => [
                                    'label' => 'col-sm-2',
                                    'offset' => 'col-sm-offset-2',
                                    'wrapper' => 'col-sm-10',
                                    'error' => '',
                                    'hint' => '',
                                ],
                            ],
                        ]); ?>

                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($model, 'email')->textInput() ?>

                        <div class="form-group">
                            <div class="col-lg-offset-1 col-lg-11">
                                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                            </div>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                    <button class="btn btn-success update" data-userid="<?= $model->id ?>">Update User</button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?= LinkPager::widget(['pagination' => $dataProvider->pagination]) ?>