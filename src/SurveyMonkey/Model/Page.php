<?php

namespace davidwnek\SurveyMonkey\Model;

class Page extends Model
{
    /**
     * @var array
     */
    protected $title;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var int
     */
    protected $questionCount;

    /**
     * @var int
     */
    protected $position;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getQuestionCount()
    {
        return $this->questionCount;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }
}