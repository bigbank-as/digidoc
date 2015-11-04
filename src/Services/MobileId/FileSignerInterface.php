<?php
namespace Bigbank\DigiDoc\Services\MobileId;

use Bigbank\DigiDoc\Exceptions\DigiDocException;

/**
 * Put files into a .bdoc container and sign them
 */
interface FileSignerInterface
{

    /**
     * Initiate the session of signing a file
     *
     * @return array
     */
    public function startSession();

    /**
     * Add a file to the container for signing
     *
     * @param string $fileName The filename of the file, including the extension
     * @param string $mimeType The [media type](https://en.wikipedia.org/wiki/Media_type) of the file
     * @param string $content  The contents of the file as a base64-encoded string
     *
     * @return bool True if the file was uploaded successfully
     */
    public function addFile($fileName, $mimeType, $content);

    /**
     * Initiate the signing request
     *
     * @var string $idCode
     * @var string $phoneNumber
     * @var string $serviceName
     * @var string $messageToDisplay
     *
     * @return array Returns string values with the keys Status, StatusCode, ChallengeID
     */
    public function sign($idCode, $phoneNumber, $serviceName, $messageToDisplay);

    /**
     * Check if the signed file is available
     *
     * Returns status and if signed also the file
     *
     * @return array
     */
    public function askStatus();

    /**
     * @param callable $callback
     *
     * @return mixed
     */
    public function waitForSignature(callable $callback);

    /**
     * @param int $code
     *
     * @return $this
     */
    public function setSessionCode($code);

    /**
     * @return bool True if the session was closed
     */
    public function closeSession();

    /**
     * Get the signed container, containing added files and signatures
     *
     * @return string The contents of a .bdoc signed container in base64
     * @throws DigiDocException
     */
    public function downloadContainer();
}
