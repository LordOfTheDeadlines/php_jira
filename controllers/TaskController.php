<?php


namespace app\controllers;


use app\models\Comment;
use app\models\Laborcost;
use app\models\Observer;
use app\models\Status;
use app\models\Task;
use app\models\TaskForm;
use app\models\TaskSearchModel;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TaskController extends Controller
{
    /**
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $task = Task::findOne($id);
        if ($task === null) {
            Yii::$app->session->setFlash('error', 'Ошибка. Такое задание не найдено');
            return $this->goHome();
        }
        $comments = Comment::findAll(['task_id'=>$id]);
        $laborcosts = Laborcost::findAll(['task_id'=>$id]);
        $observers = Observer::findAll(['task_id'=>$id]);
        return $this->render('view', ['task' => $task, 'comments'=>$comments,
            'laborcosts'=>$laborcosts, 'observers'=>$observers]);
    }

    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('info', 'Для добавления задания войдите в систему');
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
                $this->saveObservers($task->id, $model->observers);
                Yii::$app->session->setFlash('success', 'Задание добавлено');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Ошибка. Повторите еще раз');
        }
        return $this->render('create', compact('model'));
    }

    public function saveObservers($taskId, $observerIds){
        foreach ($observerIds as $observerId){
            $observer = new Observer();
            $observer->user_id = $observerId;
            $observer->task_id = $taskId;
            $observer->save();
        }
    }

    public function actionUpdate($id){
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $task = Task::findOne($id);
        $model = new TaskForm();
        $model->title = $task->title;
        $model->description = $task->description;
        $model->deadline = $task->stop_date;
//        $model->executor = User::findOne('user_id'==$task->executor_id);
        $model->timeExpectation = $task->timeExpectation;
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $task->title = $model->title;
            $task->description = $model->description;
            $task->stop_date = $model->deadline;
            $task->executor_id = $model->executor;
            $task->timeExpectation = $model->timeExpectation;
            if ($task->save()) {
                $this->editObservers($task->id, $model->observers);
                return $this->goHome();
            }
        }
        return $this->render('update', ['model'=>$model]);
    }

    private function editObservers($taskId, $observerIds)
    {
        Observer::deleteAll('task_id'==$taskId);
        foreach ($observerIds as $observerId){
            $observer = new Observer();
            $observer->user_id = $observerId;
            $observer->task_id = $taskId;
            $observer->save();
        }
    }
    public function actionDelete($id){
        $task = Task::findOne($id);
        $task->delete();
        return $this->redirect('/task/index');
    }

    public function actionIndex(){
        $searchModel = new TaskSearchModel();
        $query = Task::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        $searchModel->load(\Yii::$app->request->getQueryParams());
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

        $query->andWhere('executor_id in (select id from user where login like "%'.$searchModel->executor.'%")');
        $query->andWhere('author_id in (select id from user where login like "%'.$searchModel->author.'%")');
        $query->andWhere('title LIKE "%' . $searchModel->title . '%" ');
        $query->andWhere('status_id LIKE "%' . $searchModel->status . '%" ');
        $query->andWhere('task.creation_date LIKE "%' . $searchModel->creation_date . '%" ');
        $query->andWhere('task.stop_date LIKE "%' . $searchModel->stop_date . '%" ');
        return $this->render('index', ['dataProvider'=>$dataProvider, 'searchModel' => $searchModel]);
    }

}