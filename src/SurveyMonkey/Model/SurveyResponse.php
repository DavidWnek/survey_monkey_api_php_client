<?php

namespace davidwnek\SurveyMonkey\Model;


class SurveyResponse extends Model
{
    /**
     * @var int
     */
    protected $totalTime;

    /**
     * @var object
     */
    protected $customVariables;

    /**
     * @var string
     */
    protected $ipAddress;

    /**
     * @var object
     */
    protected $logicPath;

    /**
     * @var string
     */
    protected $dateModified;

    /**
     * @var string
     */
    protected $responseStatus;

    /**
     * @var string
     */
    protected $customValue;

    /**
     * @var string
     */
    protected $analyzeUrl;

    /**
     * @var array
     */
    protected $pages;

    /**
     * @var array
     */
    protected $pagePath;

    /**
     * @var string
     */
    protected $recipientId;

    /**
     * @var string
     */
    protected $collectorId;

    /**
     * @var string
     */
    protected $dateCreated;

    /**
     * @var string
     */
    protected $surveyId;

    /**
     * @var string
     */
    protected $collectionMode;

    /**
     * @var string
     */
    protected $editUrl;

    /**
     * @var object
     */
    protected $metaData;

    /**
     * @return int
     */
    public function getTotalTime()
    {
        return $this->totalTime;
    }

    /**
     * @return object
     */
    public function getCustomVariables()
    {
        return $this->customVariables;
    }

    /**
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * @return object
     */
    public function getLogicPath()
    {
        return $this->logicPath;
    }

    /**
     * @return string
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }

    /**
     * @return string
     */
    public function getResponseStatus()
    {
        return $this->responseStatus;
    }

    /**
     * @return string
     */
    public function getCustomValue()
    {
        return $this->customValue;
    }

    /**
     * @return string
     */
    public function getAnalyzeUrl()
    {
        return $this->analyzeUrl;
    }

    /**
     * @return array
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @return array
     */
    public function getPagePath()
    {
        return $this->pagePath;
    }

    /**
     * @return string
     */
    public function getRecipientId()
    {
        return $this->recipientId;
    }

    /**
     * @return string
     */
    public function getCollectorId()
    {
        return $this->collectorId;
    }

    /**
     * @return string
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * @return string
     */
    public function getSurveyId()
    {
        return $this->surveyId;
    }

    /**
     * @return string
     */
    public function getCollectionMode()
    {
        return $this->collectionMode;
    }

    /**
     * @return string
     */
    public function getEditUrl()
    {
        return $this->editUrl;
    }

    /**
     * @return object
     */
    public function getMetaData()
    {
        return $this->metaData;
    }
}