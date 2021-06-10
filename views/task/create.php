<?php

/* @var $this \yii\web\View */
/* @var $model \app\models\Task */
/* @var $form yii\bootstrap\ActiveForm */

use app\models\User;
use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Новая задача';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Заполните следующие поля:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'task-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-10\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'title')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'description')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'executor')->dropdownList(
        User::find()->select(['login', 'id'])->indexBy('id')->column(),
        ['prompt'=>'Выберите исполнителя']
        );?>

        <?= $form->field($model, 'observers')->dropdownList(
            User::find()->select(['login', 'id'])->indexBy('id')->column(),
            ['prompt'=>'Выберите наблюдателей','multiple' => 'true']
        );?>

         <?= $form->field($model, 'timeExpectation')->input('text')?>

        <?=$form->field($model, 'deadline')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => 'Enter Value'],
        'pluginOptions' => [
        'autoclose' => true,
            'format' => 'yyyy-mm-dd hh:ii:ss',
        'startDate' => date('yyyy-mm-dd hh:ii:ss')
        ]
        ]);?>
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Создать', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
