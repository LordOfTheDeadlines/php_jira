<?php


namespace app\models;

use yii\db\ActiveRecord;

class Task extends ActiveRecord
{
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }
    public function getExecutor()
    {
        return $this->hasOne(User::className(), ['id' => 'executor_id']);
    }
    /* Геттер для полного имени человека */
    public function getTitle() {
        return $this->title;
    }

    /* Название атрибута для вывода на экран */
    public function attributeLabels() {
        return [
            /* Другие атрибуты */
            'title' => 'Title'
        ];
    }
}