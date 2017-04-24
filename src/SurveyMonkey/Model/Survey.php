<?php

namespace davidwnek\SurveyMonkey\Model;

use Datetime;

class Survey extends Model
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $nickname;

    /**
     * @var string
     */
    protected $category;

    /**
     * @var string
     */
    protected $language;

    /**
     * @var int
     */
    protected $questionCount;

    /**
     * @var int
     */
    protected $pageCount;

    /**
     * @var Datetime
     */
    protected $dateCreated;

    /**
     * @var Datetime
     */
    protected $dateModified;

    /**
     * @var array
     */
    protected $buttonText;

    /**
     * @var array
     */
    protected $customVariables;

    /**
     * @var boolean
     */
    protected $footer;

    /**
     * @var string
     */
    protected $preview;

    /**
     * @var string
     */
    protected $editUrl;

    /**
     * @var string
     */
    protected $collectUrl;

    /**
     * @var string
     */
    protected $analyzeUrl;

    /**
     * @var string
     */
    protected $summaryUrl;

    /**
     * @var int
     */
    protected $responseCount;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return mixed
     */
    public function getQuestionCount()
    {
        return $this->questionCount;
    }

    /**
     * @return mixed
     */
    public function getPageCount()
    {
        return $this->pageCount;
    }

    /**
     * @return mixed
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * @return mixed
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }

    /**
     * @return mixed
     */
    public function getButtonText()
    {
        return $this->buttonText;
    }

    /**
     * @return mixed
     */
    public function getCustomVariables()
    {
        return $this->customVariables;
    }

    /**
     * @return mixed
     */
    public function getFooter()
    {
        return $this->footer;
    }

    /**
     * @return mixed
     */
    public function getPreview()
    {
        return $this->preview;
    }

    /**
     * @return mixed
     */
    public function getEditUrl()
    {
        return $this->editUrl;
    }

    /**
     * @return mixed
     */
    public function getCollectUrl()
    {
        return $this->collectUrl;
    }

    /**
     * @return mixed
     */
    public function getAnalyzeUrl()
    {
        return $this->analyzeUrl;
    }

    /**
     * @return mixed
     */
    public function getSummaryUrl()
    {
        return $this->summaryUrl;
    }
}