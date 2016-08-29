<?php
namespace Bigbank\DigiDoc\Services\IdCard;

use Bigbank\DigiDoc\Services\BaseFileSigner;
use Bigbank\DigiDoc\Soap\InteractionStatus;

/**
 * {@inheritdoc}
 */
class FileSigner extends BaseFileSigner implements FileSignerInterface
{

    /**
     * {@inheritdoc}
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
    ) {
        return $this->digiDocService->PrepareSignature(
            $this->sessionCode,
            $certificate,
            $tokenId,
            $role,
            $city,
            $state,
            $postalCode,
            $country,
            $signingProfile
        );
    }

    /**
     * {@inheritdoc}
     */
    public function finalizeSignature($signatureId, $signatureValue)
    {
        return $this->digiDocService->FinalizeSignature(
            $this->sessionCode,
            $signatureId,
            $signatureValue
        );
    }

    /**
     * {@inheritdoc}
     */
    public function waitForSignature(callable $callback)
    {
        $status = $this->getSignatureStatus();
        while ($status == InteractionStatus::OUTSTANDING_TRANSACTION) {
            $status = $this->getSignatureStatus();
            sleep($this->pollingFrequency);
        }

        $fileData = $status === InteractionStatus::OK ? $this->downloadContainer() : null;
        return call_user_func($callback, $status, $fileData, $this->sessionCode);
    }

    /**
     * {@inheritdoc}
     */
    public function getSignatureStatus()
    {
        $info = $this->digiDocService->GetSignedDocInfo($this->sessionCode);

        $signature = $info['SignedDocInfo']->getSignatureInfo();

        if (!is_array($signature)) {
            return $signature->getStatus();
        }

        if (!count($signature)) {
            // it is perfectly ok not to have any signatures in a container
            return null;
        }

        foreach ($signature as $signatureItem) {
            $status = $signatureItem->getStatus();
            if ($status != InteractionStatus::OK) {
                return $status;
            }
        }

        return $status;
    }

    /**
     * {@inheritdoc}
     */
    public function getSignatureInfo()
    {
        return $this->digiDocService->GetSignedDocInfo($this->sessionCode);
    }
}
