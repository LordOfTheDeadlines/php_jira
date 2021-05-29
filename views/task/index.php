<?php

use app\models\Status;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
<h1>Tasks</h1>
<?php foreach ($tasks as $task): ?>
    <h2><?= "{$task->title}"?></h2>
    <h4><?= Html::encode("time expectation: {$task->timeExpectation}") ?></h4>
    <h4><?= Html::encode("status: ". Status::findOne($task->status_id)->name) ?></h4>
    <p><?= Html::encode("created by " . User::findOne($task->author_id)->login . " in {$task->creation_date}") ?></p>
    <a href=<?= Url::to(['/task/view', 'id' => $task->id]); ?>>view details</a>
    <hr/>
<?php endforeach; ?>

<?= LinkPager::widget(['pagination' => $pagination]) ?>

