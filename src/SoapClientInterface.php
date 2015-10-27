<?php
namespace Bigbank\MobileId;

interface SoapClientInterface {

    /**
     * @param array $options
     *
     * @return $this
     */
    public function setOptions(array $options);

    /**
     * @param string $apiUrl
     *
     * @return $this
     */
    public function setApiUrl($apiUrl);
}
