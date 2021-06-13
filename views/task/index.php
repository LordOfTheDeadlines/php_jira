<a href="/task/create"><h4>Create task</h4></a>
<?php

use app\models\Status;
use kartik\datetime\DateTimePicker;
use yii\grid\GridView;use yii\helpers\ArrayHelper;

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'title',
        [
            'attribute'=>'creation_date',
            'filter' => DateTimePicker::widget([
                'model' => $searchModel,
                'value' => $searchModel->creation_date,
                'attribute' => 'creation_date',
                'type' => 1,
                'pluginOptions' => [
                'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                ]
            ]),
        ],
        [
            'attribute'=>'stop_date',
            'filter' => DateTimePicker::widget([
                'model' => $searchModel,
                'value' => $searchModel->stop_date,
                'attribute' => 'stop_date',
                'type' => 1,
                'pluginOptions' => [
                    'autoclose' => true, 'format' => 'yyyy-mm-dd'
                ]
            ]),
        ],
//        ['attribute' => 'status','label' => 'Status', 'value'=>'status.name'],
        [
            'attribute' => 'status',
            'value'=>'status.name',
            'filter' => ArrayHelper::map(Status::find()->all(), 'id', 'name'),
            'filterInputOptions' => ['class' => 'form-control form-control-sm']
        ],
        ['attribute' => 'author','label' => 'Author', 'value'=>'author.login'],
        ['attribute' => 'executor','label' => 'Executor', 'value'=>'executor.login'],
        [ 'class' => 'yii\grid\ActionColumn',]]
]);
