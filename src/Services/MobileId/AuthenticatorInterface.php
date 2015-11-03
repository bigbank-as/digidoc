<?php
namespace Bigbank\DigiDoc\Services\MobileId;

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
     * @return string
     */
    public function askStatus($sessionCode);

    /**
     * Wait until the authentication process ends and call a callback function
     *
     * This is a blocking call that waits until the user finishes the authentication
     * (takes his mobile and enters the provided code).
     *
     * DigiDoc API will be polled for authentication status every few seconds. As soon as the status changes
     * (either OK or one of several error codes) the callback will be called.
     *
     * @param string   $sessionCode DigiDoc service session code that is returned by `authenticate` method
     * @param callable $callback    Callback function to call once authentication status changes
     *
     * @return mixed The return value of the callback function
     */
    public function waitForAuthentication($sessionCode, callable $callback);
}
