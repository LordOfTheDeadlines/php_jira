<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<h1>Tasks</h1>
<ul>
    <?php foreach ($tasks as $task): ?>
        <li>
            <?= Html::encode("{$task->title}: {$task->description}") ?>
        </li>
    <?php endforeach; ?>
</ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>

