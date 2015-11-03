<?php
namespace Bigbank\DigiDoc\Services\MobileId;

use Bigbank\DigiDoc\Exceptions\DigiDocException;
use Bigbank\DigiDoc\Services\AbstractService;
use Bigbank\DigiDoc\Soap\InteractionStatus;
use Bigbank\DigiDoc\Soap\Wsdl\DataFileData;

/**
 * {@inheritdoc}
 */
class DefaultFileSigner extends AbstractService implements FileSigner
{

    /**
     * @var int
     */
    protected $sessionCode;

    /**
     * @var int
     */
    protected $pollingFrequency = 3;

    /**
     * {@inheritdoc}
     */
    public function askStatus()
    {

        return $this->fetchStatusInfo()['StatusCode'];
    }

    /**
     * {@inheritdoc}
     */
    public function waitForSignature(callable $callback)
    {

        $status = InteractionStatus::OUTSTANDING_TRANSACTION;
        while ($status == InteractionStatus::OUTSTANDING_TRANSACTION) {
            $status = $this->askStatus();
            sleep($this->pollingFrequency);
        }

        $fileData = $status === InteractionStatus::SIGNATURE ? $this->fetchFile() : [];
        return call_user_func($callback, $status, $fileData, $this->sessionCode);
    }

    /**
     * {@inheritdoc}
     */
    public function startSession()
    {

        $response = $this->digiDocService->StartSession('', '', true, new DataFileData);

        $this->sessionCode = $response['Sesscode'];

        $this->createSignedDoc();
    }

    /**
     * Call CreateSignedDoc after starting session
     */
    protected function createSignedDoc()
    {

        $this->digiDocService->CreateSignedDoc($this->sessionCode, 'BDOC', '2.1');
    }

    /**
     * {@inheritdoc}
     */
    public function addFile($fileName, $mimeType, $content)
    {

        $this->digiDocService->AddDataFile(
            $this->sessionCode,
            $fileName,
            $mimeType,
            'EMBEDDED_BASE64',
            mb_strlen($content, '8bit'),
            '',
            '',
            $content
        );
    }

    /**
     * {@inheritdoc}
     */
    public function sign($idCode, $phoneNumber, $serviceName, $messageToDisplay)
    {

        $response = $this->digiDocService->MobileSign(
            $this->sessionCode,
            $idCode,
            'EE',
            $phoneNumber,
            $serviceName,
            $messageToDisplay,
            'EST',
            '',
            '',
            '',
            '',
            '',
            '',
            'asynchClientServer',
            null,
            false,
            false
        );

        $response['Sesscode'] = $this->sessionCode;
        return $response;
    }

    /**
     * Check the state of the signing process
     *
     * @return array String values with the keys Status, StatusCode
     */
    protected function fetchStatusInfo()
    {

        return $this->digiDocService->GetStatusInfo($this->sessionCode, false, false);
    }

    /**
     * Get the signed file
     *
     * @return string File contents in base64
     * @throws DigiDocException
     */
    protected function fetchFile()
    {

        $response = $this->digiDocService->GetSignedDoc($this->sessionCode);

        if (!isset($response['SignedDocData'])) {
            throw new DigiDocException('No file to download');
        }
        return html_entity_decode($response['SignedDocData']);
    }

    /**
     * {@inheritdoc}
     */
    public function closeSession()
    {

        return $this->digiDocService->CloseSession($this->sessionCode) === 'OK';
    }

    /**
     * {@inheritdoc}
     */
    public function setSessionCode($code)
    {

        $this->sessionCode = $code;
        return $this;
    }
}
