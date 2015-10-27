<?php
namespace Bigbank\MobileId;

/**
 * Interact with DigiDoc mobile ID API
 */
interface DigiDocServiceInterface
{

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
