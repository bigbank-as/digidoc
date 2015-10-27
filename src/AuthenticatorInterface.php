<?php
namespace Bigbank\MobileId;

/**
 * Authenticate against the mobile ID API
 */
interface AuthenticatorInterface extends DigiDocServiceInterface
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
     * @param string $sessionCode
     *
     * @return bool True if the user has been authenticated
     */
    public function isAuthenticated($sessionCode);
}
