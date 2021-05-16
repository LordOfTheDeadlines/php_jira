<?php

use app\models\Status;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
<h1><?= "{$task->title}"?></h1>
<p><?= $task->description ?></p>
<h4><?= Html::encode("time expectation: {$task->timeExpectation}") ?></h4>
<h4><?= Html::encode("status: ". Status::findOne($task->status_id)->name) ?></h4>
<p><?= Html::encode("created by " . User::findOne($task->author_id)->login . " in {$task->creation_date}") ?></p>
<h4>Comments</h4>
<a href=<?= Url::to(['/comment/create', 'taskId' => $task->id]); ?>>add comment</a>
<?php foreach ($comments as $comment): ?>
    <p><?= Html::encode("created by " . User::findOne($comment->user_id)->login . " in {$comment->creation_date}") ?></p>
    <p><?= "{$comment->text}"?></p>
    <hr/>
<?php endforeach; ?>