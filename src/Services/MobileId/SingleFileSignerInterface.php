<?php
namespace Bigbank\DigiDoc\Services\MobileId;

use Bigbank\DigiDoc\Services\DigiDocServiceInterface;
/**
 * Authenticate against the mobile ID API
 */
interface SingleFileSignerInterface extends DigiDocServiceInterface
{

    /**
     * Initiate the signing of a file
     *
     * @param array  $fileData Containing the following keys with string values:
     *                         fileName, fileType, fileContent (Base64 encoded)
     * @param string $idCode
     * @param string $phoneNumber
     * @param string $serviceName
     * @param string $messageToDisplay
     *
     * @return array
     */
    public function startSigning($fileData, $idCode, $phoneNumber, $serviceName, $messageToDisplay);


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
