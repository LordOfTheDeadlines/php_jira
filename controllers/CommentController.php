<?php


namespace app\controllers;


use app\models\Comment;
use app\models\ComForm;
use Yii;
use yii\web\Controller;

class CommentController extends Controller
{
    public function actionCreate($taskId)
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('info', 'Для добавления комментария войдите в систему');
            return $this->goHome();
        }
        $model = new ComForm();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $comment = new Comment();
            $comment->text = $model->text;
            $comment->creation_date = date("Y-m-d H:i:s");
            $comment->user_id = Yii::$app->user->getId();
            $comment->task_id = $taskId;
            if($comment->save()){
                Yii::$app->session->setFlash('success', 'Комментарий добавлен');
                return $this->redirect('/task/index');
            }
            Yii::$app->session->setFlash('error', 'Ошибка. Повторите еще раз');
        }
        return $this->render('create', compact('model'));
    }
}