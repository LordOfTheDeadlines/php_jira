<?php


namespace app\models;
use yii\base\Model;

class LaborcostForm extends Model
{
    public $time;
    public $comment;
    public function rules() {
        return [
            [['time','comment'], 'required', 'message' => 'Заполните поле'],
        ];
    }
    public function attributeLabels() {
        return [
            'time' => 'Время',
            'comment' => 'Комментарий',
        ];
    }
}