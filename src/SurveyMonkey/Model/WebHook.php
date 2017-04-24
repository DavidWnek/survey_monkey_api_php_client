<?php

namespace davidwnek\SurveyMonkey\Model;

use davidwnek\SurveyMonkey\HTTPMethod;

class WebHook extends Model
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $eventType;

    /**
     * @var string
     */
    protected $objectType;

    /**
     * @var array
     */
    protected $objectIds;

    /**
     * @var string
     */
    protected $subscriptionUrl;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getEventType()
    {
        return $this->eventType;
    }

    /**
     * @return mixed
     */
    public function getObjectType()
    {
        return $this->objectType;
    }

    /**
     * @return mixed
     */
    public function getObjectIds()
    {
        return $this->objectIds;
    }

    /**
     * @return mixed
     */
    public function getSubscriptionUrl()
    {
        return $this->subscriptionUrl;
    }

    /**
     * Deletes this object from Survey Monkey
     */
    public function delete()
    {
        $this->getClient()->runUrl($this->getHref(), HTTPMethod::DELETE);
    }
}