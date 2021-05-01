<?php


namespace app\controllers;


use app\models\User;
use yii\web\Controller;
use yii\data\Pagination;

class UserController extends Controller
{
    public function actionIndex()
    {
        $query = User::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $users = $query->orderBy('login')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'users' => $users,
            'pagination' => $pagination,
        ]);
    }
}