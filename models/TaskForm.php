<?php

namespace app\models;

use yii\base\Model;


class TaskForm extends Model
{
    public $title;
    public $description;
    public $deadline;
    public $executor;
    public $observers;
    public $timeExpectation;

    public function rules()
    {
        return [
            [['title', 'description', 'deadline','executor', 'observers', 'timeExpectation'], 'required', 'message' => 'Заполните поле'],
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
