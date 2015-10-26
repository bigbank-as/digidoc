<?php
namespace Bigbank\MobileId\Request;

use Bigbank\MobileId\IdException;
use Bigbank\MobileId\SoapClient;

/**
 * Abstract base class for SOAP requests
 */
abstract class AbstractRequest implements RequestInterface
{

    /**
     * @var SoapClient
     */
    protected $client;

    /**
     * {@inheritdoc}
     */
    public function send(array $arguments)
    {

        $arguments = array_replace($this->getDefaultArguments(), $arguments);
        $arguments = array_values($arguments);

        try {
            $response = call_user_func_array([$this->client, $this->getRequestName()], array_values($arguments));
        } catch (\SoapFault $fault) {
            throw new IdException(
                $fault->faultcode,
                $fault->faultstring
            );
        }
        return $response;
    }

    /**
     * {@inheritdoc}
     */
    public function factory($apiUrl, array $options = [])
    {

        $this->client = new SoapClient($apiUrl, $options);
        return $this;
    }


    /**
     * @return string Returns the SOAP method name for the request
     */
    protected function getRequestName()
    {

        $reflectionClass = new \ReflectionClass($this);
        return $reflectionClass->getShortName();
    }
}
