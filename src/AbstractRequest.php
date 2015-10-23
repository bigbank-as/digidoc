<?php
namespace Bigbank\MobileId;

abstract class AbstractRequest
{

    /**
     * @var string
     */
    protected $apiUrl = 'https://tsp.demo.sk.ee?WSDL';

    /**
     * @var array
     */
    protected $options = [
        'exceptions' => true
    ];

    /**
     * @param string $apiUrl
     * @param array  $options
     */
    public function __construct($apiUrl, array $options = [])
    {

        $this->apiUrl  = $apiUrl;
        $this->options = array_replace($this->options, $options);
    }


    protected function clientFactory()
    {

        return new SoapClient($this->apiUrl, $this->options);

    }
}
