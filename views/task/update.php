<?php

/* @var $this \yii\web\View */
/* @var $model \app\models\Task */
/* @var $form yii\bootstrap\ActiveForm */

use app\models\User;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Update Task';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to title:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'task-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'executor')->dropdownList(
        User::find()->select(['login', 'id'])->indexBy('id')->column(),
        ['prompt'=>'Select executor']
    );?>

    <?= $form->field($model, 'timeExpectation')->input('text')?>

    <?= $form->field($model, 'deadline')->input('text')?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Update Task', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>