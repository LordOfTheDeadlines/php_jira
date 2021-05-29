<?php

use yii\grid\GridView;

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'title',
        'creation_date:datetime',
        'stop_date:datetime',
        ['attribute' => 'status','label' => 'Status', 'value'=>'status.name'],
        ['attribute' => 'author','label' => 'Author', 'value'=>'author.login'],
        ['attribute' => 'executor','label' => 'Executor', 'value'=>'executor.login'],
        [ 'class' => 'yii\grid\ActionColumn',]]
]);
