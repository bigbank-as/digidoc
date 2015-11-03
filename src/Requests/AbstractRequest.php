<?php
namespace Bigbank\DigiDoc\Requests;

use Bigbank\DigiDoc\Exceptions\DigiDocException;
use Bigbank\DigiDoc\Soap\SoapClient;

/**
 * {@inheritdoc}
 */
abstract class AbstractRequest implements RequestInterface
{

    /**
     * @var SoapClient
     */
    protected $client;

    public function __construct(SoapClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param SoapClient $client
     */
    public function __construct(SoapClient $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function send(array $arguments = [])
    {

        $arguments = array_replace($this->getDefaultArguments(), $arguments);
        $arguments = array_values($arguments);

        try {
            return $this->callSoapMethod(array_values($arguments));
        } catch (\SoapFault $fault) {
            throw new DigiDocException(
                $fault->faultcode,
                $fault->faultstring
            );
        }
    }

    /**
     * @return string Returns the SOAP method name for the request
     */
    protected function getRequestName()
    {

        $reflectionClass = new \ReflectionClass($this);
        return $reflectionClass->getShortName();
    }

    /**
     * @param array $arguments
     *
     * @return array
     */
    private function callSoapMethod(array $arguments)
    {

        return call_user_func_array([$this->client, $this->getRequestName()], $arguments);
    }
}
