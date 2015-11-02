<?php
namespace Bigbank\MobileId;

/**
 * Signing of a DigiDoc file with the mobile ID API
 */
interface FileSignerInterface extends DigiDocServiceInterface
{

    /**
     * Initiate the session of signing a file
     *
     * @return array
     */
    public function startSession();

    /**
     * Send files for signing
     *
     * @param string $fileName
     * @param string $mimeType
     * @param string $content BASE64
     *
     * @return array Returns string value with the key Status
     * and structure of a DigiDoc file with the key SignedDocInfo
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
     * @param int $sessCode
     *
     * @return array
     */
    public function getStatus($sessCode);
}
