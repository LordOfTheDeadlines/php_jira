<?php


namespace app\controllers;


use app\models\Comment;
use app\models\Laborcost;
use app\models\Status;
use app\models\Task;
use app\models\TaskForm;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TaskController extends Controller
{
    public function actionIndex()
    {
        $query = Task::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $tasks = $query->orderBy('title')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'tasks' => $tasks,
            'pagination' => $pagination,
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $task = Task::findOne($id);
        if ($task === null) {
            throw new NotFoundHttpException;
        }
        $comments = Comment::findAll(['task_id'=>$id]);
        $laborcosts = Laborcost::findAll(['task_id'=>$id]);
        return $this->render('view', ['task' => $task, 'comments'=>$comments, 'laborcosts'=>$laborcosts]);
    }

    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new TaskForm();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $task = new Task();
            $task->title = $model->title;
            $task->description = $model->description;
            $task->stop_date = $model->deadline;
            $task->creation_date = date("Y-m-d H:i:s");
            $task->status_id = 1;
            $task->author_id = Yii::$app->user->getId();
            $task->executor_id = $model->executor;
            $task->timeExpectation = $model->timeExpectation;
            if($task->save()){
                return $this->goHome();
            }
        }
        return $this->render('create', compact('model'));
    }

    public function actionUpdate($id){
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $task = Task::findOne($id);
        $model = new TaskForm();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $task->title = $model->title;
            $task->description = $model->description;
            $task->stop_date = $model->deadline;
//            $task->creation_date = date("Y-m-d H:i:s");
//            $task->status_id = 1;
//            $task->author_id = Yii::$app->user->getId();
            $task->executor_id = $model->executor;
            $task->timeExpectation = $model->timeExpectation;
            if($task->save()){
                return $this->goHome();
            }
        }
        return $this->render('update', ['model'=>$model]);
    }

    public function actionDelete($id){
        $task = Task::findOne($id);
        $task->delete();
        return $this->redirect('/task/tasks');
    }

    public function actionTasks(){
        $query = Task::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        $query->joinWith(['status']);
        $dataProvider->sort->attributes['status'] = [
            'asc' => [Status::tableName().'.name' => SORT_ASC],
            'desc' => [Status::tableName().'.name' => SORT_DESC],
        ];

        $query->joinWith(['author']);
        $dataProvider->sort->attributes['author'] = [
            'asc' => [User::tableName().'.login' => SORT_ASC],
            'desc' => [User::tableName().'.login' => SORT_DESC],
        ];

        $query->joinWith(['executor']);
        $dataProvider->sort->attributes['executor'] = [
            'asc' => [User::tableName().'.login' => SORT_ASC],
            'desc' => [User::tableName().'.login' => SORT_DESC],
        ];
        return $this->render('tasks', ['dataProvider'=>$dataProvider]);
    }
}