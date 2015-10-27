<?php
namespace Bigbank\MobileId;

use Bigbank\MobileId\Request\GetMobileAuthenticateStatus;
use Bigbank\MobileId\Request\MobileAuthenticate;

/**
 * {@inheritdoc}
 */
class Authenticator extends DigiDocServiceAbstract implements AuthenticatorInterface
{

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

        $request  = new MobileAuthenticate;
        $response = $request->factory($this->apiUrl, $this->options)
            ->send($arguments);

        return $response;
    }

    /**
     * {@inheritdoc}
     */
    public function askStatus($sessionCode)
    {


        $request  = new GetMobileAuthenticateStatus;
        $response = $request->factory($this->apiUrl, $this->options)
            ->send(['Sesscode' => $sessionCode]);
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
