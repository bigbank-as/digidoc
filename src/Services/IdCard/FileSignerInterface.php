<?php
namespace Bigbank\DigiDoc\Services\IdCard;

/**
 * Put files into a .bdoc container and sign them with ID Card
 */
interface FileSignerInterface
{

    /**
     * Start adding signature with ID Card
     *
     * @param string $certificate
     * @param string $tokenId
     * @param string $role
     * @param string $city
     * @param string $state
     * @param string $postalCode
     * @param string $country
     * @param string $signingProfile
     *
     * @return mixed
     */
    public function prepareSignature(
        $certificate,
        $tokenId = '',
        $role = '',
        $city = '',
        $state = '',
        $postalCode = '',
        $country = '',
        $signingProfile = ''
    );

    /**
     * Finalize the signature adding that was previously started with PrepareSignature
     *
     * @param string $signatureId
     * @param string $signatureValue
     *
     * @return mixed
     */
    public function finalizeSignature($signatureId, $signatureValue);

    /**
     * Returns OK only if all the signatures on the document are valid
     *
     * @return string
     */
    public function getSignatureStatus();

    /**
     * Returns information about container in the session
     *
     * @return object
     */
    public function getSignatureInfo();
}
