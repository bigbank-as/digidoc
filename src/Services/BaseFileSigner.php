<?php
namespace Bigbank\DigiDoc\Services;

use Bigbank\DigiDoc\Exceptions\DigiDocException;
use Bigbank\DigiDoc\Soap\InteractionStatus;

/**
 * {@inheritdoc}
 */
class BaseFileSigner extends AbstractService implements BaseFileSignerInterface
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

        $fileData = $status === InteractionStatus::SIGNATURE ? $this->downloadContainer() : [];
        return call_user_func($callback, $status, $fileData, $this->sessionCode);
    }

    /**
     * {@inheritdoc}
     */
    public function startSession($sigDocXML = '')
    {
        $response = $this->digiDocService->StartSession('', $sigDocXML, true);

        $this->sessionCode = $response['Sesscode'];

        if (empty($sigDocXML)) {
            $this->createSignedDoc();
        }
    }

    /**
     * @return int
     */
    public function getSession()
    {
        return $this->sessionCode;
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
        $response = $this->digiDocService->AddDataFile(
            $this->sessionCode,
            $fileName,
            $mimeType,
            'EMBEDDED_BASE64',
            mb_strlen($content, '8bit'),
            '',
            '',
            $content
        );
        return $response['Status'] === 'OK';
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
     * {@inheritdoc}
     */
    public function downloadContainer()
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
