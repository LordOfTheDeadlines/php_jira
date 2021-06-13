<?php


namespace app\models;


use yii\base\Model;

class TaskSearchModel extends Model
{
    /** @var int|int */
    public $id;
    /** @var string */
    public $title;
    /** @var string */
    public $description;
    /** @var int */
    public $status;
    /** @var string */
    public $author;
    /** @var string */
    public $executor;
    public $creation_date;
    public $stop_date;
    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['id', 'status', 'type'], 'integer'],
            [['title', 'description','author','executor'], 'string'],
            [['creation_date', 'stop_date'], 'datetime'],
        ];
    }
}