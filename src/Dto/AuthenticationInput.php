<?php
namespace Bigbank\MobileId\Dto;

class AuthenticationInput
{

    /**
     * @var string
     */
    protected $idCode;

    /**
     * @var string
     */
    protected $countryCode = 'EE';

    /**
     * @var string
     */
    protected $phoneNumber;

    /**
     * @var string
     */
    protected $language = 'EST';

    /**
     * @var string
     */
    protected $serviceName;

    /**
     * @var string
     */
    protected $messageToDisplay;

    /**
     * @var string
     */
    protected $challengeToken;

    /**
     * @var string
     */
    protected $messagingMode = 'asynchClientServer';

    /**
     * @var int
     */
    protected $asyncConfiguration;

    /**
     * @var bool
     */
    protected $returnCertData = false;

    /**
     * @var bool
     */
    protected $returnRevocationData = false;

    /**
     * {@inheritdoc}
     */
    public function getIdCode()
    {

        return $this->idCode;
    }

    /**
     * @param string $idCode
     *
     * @return Input
     */
    public function setIdCode($idCode)
    {

        $this->idCode = $idCode;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCountryCode()
    {

        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     *
     * @return Input
     */
    public function setCountryCode($countryCode)
    {

        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPhoneNumber()
    {

        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     *
     * @return Input
     */
    public function setPhoneNumber($phoneNumber)
    {

        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLanguage()
    {

        return $this->language;
    }

    /**
     * @param string $language
     *
     * @return Input
     */
    public function setLanguage($language)
    {

        $this->language = $language;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getServiceName()
    {

        return $this->serviceName;
    }

    /**
     * @param string $serviceName
     *
     * @return Input
     */
    public function setServiceName($serviceName)
    {

        $this->serviceName = $serviceName;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMessageToDisplay()
    {

        return $this->messageToDisplay;
    }

    /**
     * @param string $messageToDisplay
     *
     * @return Input
     */
    public function setMessageToDisplay($messageToDisplay)
    {

        $this->messageToDisplay = $messageToDisplay;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getChallengeToken()
    {

        return $this->challengeToken;
    }

    /**
     * @param string $challengeToken
     *
     * @return Input
     */
    public function setChallengeToken($challengeToken)
    {

        $this->challengeToken = $challengeToken;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMessagingMode()
    {

        return $this->messagingMode;
    }

    /**
     * @param string $messagingMode
     *
     * @return Input
     */
    public function setMessagingMode($messagingMode)
    {

        $this->messagingMode = $messagingMode;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAsyncConfiguration()
    {

        return $this->asyncConfiguration;
    }

    /**
     * @param int $asyncConfiguration
     *
     * @return Input
     */
    public function setAsyncConfiguration($asyncConfiguration)
    {

        $this->asyncConfiguration = $asyncConfiguration;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getReturnCertData()
    {

        return $this->returnCertData;
    }

    /**
     * @param bool $returnCertData
     *
     * @return Input
     */
    public function setReturnCertData($returnCertData)
    {

        $this->returnCertData = $returnCertData;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getReturnRevocationData()
    {

        return $this->returnRevocationData;
    }

    /**
     * @param bool $returnRevocationData
     *
     * @return Input
     */
    public function setReturnRevocationData($returnRevocationData)
    {

        $this->returnRevocationData = $returnRevocationData;
        return $this;
    }

}
