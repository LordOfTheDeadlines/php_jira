<?php
namespace app\controllers;
use app\models\Comment;
use app\models\Laborcost;
use app\models\LaborcostForm;
use app\models\Status;
use app\models\Task;
use app\models\User;
use Yii;
use yii\base\BaseObject;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class LaborcostController extends Controller
{
    public function actionCreate($taskId)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LaborcostForm();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $laborcost = new Laborcost();
            $laborcost->comment = $model->comment;
            $laborcost->time = $model->time;
            $laborcost->creation_date = date("Y-m-d H:i:s");
            $laborcost->user_id = Yii::$app->user->getId();
            $laborcost->task_id = $taskId;
            if($laborcost->save()){
                return $this->goHome();
            }
        }
        return $this->render('create', compact('model'));
    }
}