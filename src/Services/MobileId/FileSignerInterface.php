<?php
namespace Bigbank\DigiDoc\Services\MobileId;

/**
 * Put files into a .bdoc container and sign them with Mobile ID
 */
interface FileSignerInterface
{

    /**
     * Initiate the signing request
     *
     * @var string $idCode Personal ID code of the signer
     * @var string $phoneNumber Phone number of the signer
     * @var string $serviceName The name of the current service (from contract with DigiDocService operator)
     * @var string $messageToDisplay 40-byte arbitrary message to show to the signer
     *
     * @return array Returns string values with the keys Status, StatusCode, ChallengeID
     */
    public function sign($idCode, $phoneNumber, $serviceName, $messageToDisplay);
}
