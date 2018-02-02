<?php

namespace davidwnek\SurveyMonkey\Model;

class PageQuestion extends Model
{
    /**
     * @var string
     */
    protected $heading;

    /**
     * @var int
     */
    protected $position;

    /**
     * @var string
     */
    protected $family;

    /**
     * @var string
     */
    protected $subType;

    /**
     * @var object
     */
    protected $answers;

    /**
     * @return string
     */
    public function getHeading()
    {
        return $this->heading;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return string
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * @return string
     */
    public function getSubType()
    {
        return $this->subType;
    }

    /**
     * @return object
     */
    public function getAnswers()
    {
        return $this->answers;
    }
}