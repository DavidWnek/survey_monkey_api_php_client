<?php

namespace davidwnek\SurveyMonkey\Model;


class SurveyResponse extends Model
{
    protected $totalTime;
    protected $customVariables;
    protected $ipAddress;
    protected $logicPath;
    protected $dateModified;
    protected $responseStatus;
    protected $customValue;
    protected $analyzeUrl;
    protected $pages;
    protected $pagePath;
    protected $recipientId;
    protected $collectorId;
    protected $dateCreated;
    protected $surveyId;
    protected $collectionMode;
    protected $editUrl;
    protected $metaData;

    /**
     * @return mixed
     */
    public function getTotalTime()
    {
        return $this->totalTime;
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
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * @return mixed
     */
    public function getLogicPath()
    {
        return $this->logicPath;
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
    public function getResponseStatus()
    {
        return $this->responseStatus;
    }

    /**
     * @return mixed
     */
    public function getCustomValue()
    {
        return $this->customValue;
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
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @return mixed
     */
    public function getPagePath()
    {
        return $this->pagePath;
    }

    /**
     * @return mixed
     */
    public function getRecipientId()
    {
        return $this->recipientId;
    }

    /**
     * @return mixed
     */
    public function getCollectorId()
    {
        return $this->collectorId;
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
    public function getSurveyId()
    {
        return $this->surveyId;
    }

    /**
     * @return mixed
     */
    public function getCollectionMode()
    {
        return $this->collectionMode;
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
    public function getMetaData()
    {
        return $this->metaData;
    }
}