<?php
namespace Bigbank\DigiDoc\Services\MobileId;

/**
 * Authenticate the user with Mobile ID
 *
 * Mobiil-ID is your digital identity card and it is always with you on your mobile phone.
 *
 * This service interacts with the DigiDocService API, Mobile ID endpoint.
 *
 * @see http://id.ee/index.php?id=36882
 */
interface AuthenticatorInterface
{

    /**
     * Authenticate (step 1 of 2) an user using mobile ID
     *
     * This request starts an 'authentication session' during which DigiDocService will notify the user
     * via his phone that an authentication is in progress and ask for approval.
     *
     * This is a slow, manual process (~15 - 240 seconds due to technology and human factors).
     * Use polling (`askStatus` or `waitForAuthentication`) as the next step to find out whether authentication
     * succeeded.
     *
     * @param string $idCode User's personal ID code (~SSN)
     * @param string $phoneNumber User's phone number (must have an active mobile ID contract with the provider)
     * @param string $serviceName The name of your application - this is written in Your contract with DigiDoc provider
     * @param string $messageToDisplay Text to display to the user. Max 40 bytes (byte != character!).
     * @param bool $returnCertData Return certificate data for compliance
     *
     * @return array Raw meta-data response from DigiDoc service
     */
    public function authenticate($idCode, $phoneNumber, $serviceName, $messageToDisplay, $returnCertData = false);

    /**
     * Ask DigiDocService for the status of the authentication
     *
     * This is the 2nd step in the two-step authentication process.
     * The status is `OUTSTANDING_TRANSACTION` after `authenticate` has been called, for as long as a timeout or an
     * error occurs or the user successfully authenticates.
     *
     * See constants in the `\Bigbank\DigiDoc\Soap\InteractionStatus` class.
     *
     * @param string|null $sessionCode Session code from `authenticate` query
     *
     * @return string Status of the authentication. Most often `OUTSTANDING_TRANSACTION` or `USER_AUTHENTICATED`.
     */
    public function askStatus($sessionCode = null);

    /**
     * Wait until the authentication process ends and call a callback function
     *
     * This is a blocking call that waits until the user finishes the authentication
     * (takes his mobile and enters the provided code).
     *
     * DigiDoc API will be polled for authentication status every few seconds. As soon as the status changes
     * (either OK or one of several error codes) the callback will be called.
     *
     * @param callable $callback    Callback function to call once authentication status changes. The function receives
     *                              the authentication status (string) as an argument.
     *
     * @return mixed The return value of the callback function
     */
    public function waitForAuthentication(callable $callback);
}
