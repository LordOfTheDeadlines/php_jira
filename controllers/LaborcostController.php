<?php
namespace app\controllers;
use app\models\Laborcost;
use app\models\LaborcostForm;
use Yii;
use yii\web\Controller;

class LaborcostController extends Controller
{
    public function actionCreate($taskId)
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('info', 'Для отметки трудозатрат войдите в систему');
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
                Yii::$app->session->setFlash('success', 'Создано');
                return $this->redirect('/task/index');
            }
            Yii::$app->session->setFlash('error', 'Ошибка. Повторите еще раз');
        }
        return $this->render('create', compact('model'));
    }
}