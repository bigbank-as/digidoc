<?php
namespace Bigbank\MobileId\Request;

/**
 * Abstract base class for SOAP requests
 */
interface RequestInterface
{

    /**
     * Make a SOAP request against the mobile ID API
     *
     * @param array $arguments SOAP method call arguments
     *
     * @return array Array of response data from the remote API
     */
    public function send(array $arguments = []);

    /**
     * Get default arguments and values for the current request
     *
     * The order of the arguments does matter, they must match
     * the SOAP method documentation.
     *
     * @return array
     */
    public function getDefaultArguments();

    /**
     * Construct a new SOAP client instance
     *
     * @param string $apiUrl
     * @param array $options
     *
     * @return mixed
     */
    public function factory($apiUrl,array $options =[]);
}
