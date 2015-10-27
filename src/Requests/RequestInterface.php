<?php
namespace Bigbank\DigiDoc\Requests;

interface RequestInterface
{

    /**
     * Make a SOAP request against the mobile ID API
     *
     * @param array $arguments SOAP method call arguments
     *
     * @return array Array of response data from the remote API
     */
    public function send(array $arguments);

    /**
     * Get default arguments and values for the current request
     *
     * The order of the arguments does matter, they must match
     * the SOAP method documentation.
     *
     * @return array
     */
    public function getDefaultArguments();
}
