<?php


namespace app\controllers;


use app\models\Task;
use app\models\TaskForm;
use Yii;
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
        $model = Task::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException;
        }

        return $this->render('view');
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
            $task->creation_date = date("Y-m-d");
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
}