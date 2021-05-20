<?php

use app\models\Status;
use app\models\User;
use yii\grid\GridView;

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'title',
        'description',
        'creation_date:datetime',
        'stop_date:datetime',
        [
            'attribute'=>'status_id',
            'value' => function($data){
                return Status::findOne($data)->name;
            },
            'format' => 'text',
        ],
        [
            'attribute'=>'author_id',
            'value' => function($data){
                return User::findOne($data)->login;
            },
            'format' => 'text',
        ],
        [ 'class' => 'yii\grid\ActionColumn',]]
]);
