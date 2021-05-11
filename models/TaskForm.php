<?php

namespace app\models;

use Yii;
use yii\base\Model;


class TaskForm extends Model
{
    public $title;
    public $description;
    public $deadline;
    public $executor;
    public $timeExpectation;

    public function rules()
    {
        return [
            [['title', 'description', 'deadline','executor', 'timeExpectation'], 'required', 'message' => 'Заполните поле'],
//            ['deadline', 'format' => 'php:Y-m-d'],
        ];
    }

    public function attributeLabels() {
        return [
            'title' => 'Название',
            'description' => 'Пояснение',
        ];
    }
}
