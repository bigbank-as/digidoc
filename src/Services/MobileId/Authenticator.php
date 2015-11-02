<?php
namespace Bigbank\DigiDoc\Services\MobileId;

use Bigbank\DigiDoc\Services\DigiDocServiceInterface;

/**
 * Authenticate against the mobile ID API
 */
interface Authenticator extends DigiDocServiceInterface
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
     * @param string $sessionCode DigiDoc service session code that is returned by `authenticate` method
     * @param callable $callback Callback function to call once authentication status changes
     *
     * @return mixed
     */
    public function waitForAuthentication($sessionCode, callable $callback);
}
