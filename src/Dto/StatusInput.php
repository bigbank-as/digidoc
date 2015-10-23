<?php
namespace Bigbank\MobileId\Dto;

class StatusInput
{

    protected $sessionId;
    protected $wait;

    /**
     * {@inheritdoc}
     */
    public function getSessionId()
    {

        return $this->sessionId;
    }

    /**
     * @param mixed $sessionId
     *
     * @return $this
     */
    public function setSessionId($sessionId)
    {

        $this->sessionId = $sessionId;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getWait()
    {

        return $this->wait;
    }

    /**
     * @param mixed $wait
     *
     * @return $this
     */
    public function setWait($wait)
    {

        $this->wait = $wait;
        return $this;
    }


}
