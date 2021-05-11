<?php


namespace app\models;


use yii\base\Model;

class SignupForm extends Model{

    public $login;
    public $password;

    public function rules() {
        return [
            [['login', 'password'], 'required', 'message' => 'Заполните поле'],
            ['login', 'unique', 'targetClass' => User::className(),  'message' => 'Этот логин уже занят'],
        ];
    }

    public function attributeLabels() {
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
        ];
    }

}