<?php
namespace Bigbank\MobileId;


/**
 * Authenticate against the mobile ID API
 */
interface AuthenticatorInterface
{

    /**
     * @param string $idCode
     * @param string $phoneNumber
     * @param string $serviceName
     * @param string $messageToDisplay
     *
     * @return array
     */
    public function authenticate($idCode, $phoneNumber, $serviceName, $messageToDisplay);

    /**
     * @param string $sessionCode
     *
     * @return array
     */
    public function askStatus($sessionCode);

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

    /**
     * @param string $sessionCode
     *
     * @return bool True if the user has been authenticated
     */
    public function isAuthenticated($sessionCode);
}
