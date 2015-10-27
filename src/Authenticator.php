<?php
namespace Bigbank\MobileId;

use Bigbank\MobileId\Request\RequestInterface;

/**
 * {@inheritdoc}
 */
class Authenticator extends AbstractDigiDocService implements AuthenticatorInterface
{

    /**
     * @var RequestInterface
     */
    private $mobileAuthenticate;

    /**
     * @var RequestInterface
     */
    private $getMobileAuthenticateStatus;


    /**
     * @param RequestInterface $mobileAuthenticate
     * @param RequestInterface $getMobileAuthenticateStatus
     */
    public function __construct(
        RequestInterface $mobileAuthenticate,
        RequestInterface $getMobileAuthenticateStatus
    ) {

        $this->mobileAuthenticate          = $mobileAuthenticate;
        $this->getMobileAuthenticateStatus = $getMobileAuthenticateStatus;
    }

    /**
     * {@inheritdoc}
     */
    public function authenticate($idCode, $phoneNumber, $serviceName, $messageToDisplay)
    {

        $arguments = [
            'IDCode'           => $idCode,
            'PhoneNo'          => $phoneNumber,
            'ServiceName'      => $serviceName,
            'MessageToDisplay' => $messageToDisplay
        ];

        $response = $this->mobileAuthenticate->send($arguments);

        return $response;
    }

    /**
     * {@inheritdoc}
     */
    public function askStatus($sessionCode)
    {

        $response = $this->getMobileAuthenticateStatus->send(['Sesscode' => $sessionCode]);
        return $response;
    }

    /**
     * {@inheritdoc}
     */
    public function isAuthenticated($sessionCode)
    {

        $status = $this->askStatus($sessionCode);

        return $status['Status'] === 'USER_AUTHENTICATED';
    }
}
