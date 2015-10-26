<?php
namespace Bigbank\MobileId;


use Bigbank\MobileId\Request\GetMobileAuthenticateStatus;
use Bigbank\MobileId\Request\MobileAuthenticate;

/**
 * {@inheritdoc}
 */
class Authenticator implements AuthenticatorInterface
{

    const URL_PRODUCTION = 'https://digidocservice.sk.ee/?wsdl';
    const URL_TEST = 'https://tsp.demo.sk.ee?WSDL';

    /**
     * @var string
     */
    protected $apiUrl = self::URL_TEST;

    /**
     * @var array
     */
    protected $options = [
        'exceptions' => true,
        'proxy_host' => null,
        'proxy_port' => null
    ];

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

    /**
     * {@inheritdoc}
     */
    public function setOptions(array $options)
    {

        $this->options = array_replace($this->options, $options);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setApiUrl($apiUrl)
    {

        $this->apiUrl = $apiUrl;
        return $this;
    }
}
