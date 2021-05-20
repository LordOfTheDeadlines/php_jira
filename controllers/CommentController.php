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
                return $this->goHome();
            }
        }
        return $this->render('create', compact('model'));
    }
}