<?php
namespace Bigbank\DigiDoc\Services\MobileId;

use Bigbank\DigiDoc\Services\AbstractDigiDocService;
use Bigbank\DigiDoc\Soap\Wsdl\DataFileData;

/**
 * {@inheritdoc}
 */
class DefaultFileSigner extends AbstractDigiDocService implements FileSigner
{

    /**
     * @var int
     */
    protected $sessCode;

    /**
     * {@inheritdoc}
     */
    public function getStatus($sessCode)
    {

        $this->sessCode = $sessCode;

        $response = $this->fetchStatusInfo();

        if ($response['StatusCode'] !== 'SIGNATURE') {
            return $response;
        }

        $fileResponse = $this->fetchFile();

        return array_merge($response, $fileResponse);
    }

    /**
     * {@inheritdoc}
     */
    public function startSession()
    {

        // StartSession's 4th parameter is typehinted
        $fileData = new DataFileData(null);
        $response = $this->digiDocService->StartSession('', '', true, $fileData);

        $this->sessCode = $response['Sesscode'];

        $this->createSignedDoc();
    }

    /**
     * Call CreateSignedDoc after starting session
     */
    protected function createSignedDoc()
    {

        $this->digiDocService->CreateSignedDoc($this->sessCode, 'BDOC', '2.1');
    }

    /**
     * {@inheritdoc}
     */
    public function addFile($fileName, $mimeType, $content, $fileSize)
    {

        $this->digiDocService->AddDataFile(
            $this->sessCode,
            $fileName,
            $mimeType,
            'EMBEDDED_BASE64',
            $fileSize,
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
            $this->sessCode,
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

        $response['Sesscode'] = $this->sessCode;
        return $response;
    }

    /**
     * Check the state of the signing process
     *
     * @return array String values with the keys Status, StatusCode
     */
    protected function fetchStatusInfo()
    {

        return $this->digiDocService->GetStatusInfo($this->sessCode, false, false);
    }

    /**
     * Get the signed file data
     *
     * @return array String values with the keys Status, SignedDocData
     */
    protected function fetchFile()
    {

        $response = $this->digiDocService->GetSignedDoc($this->sessCode);

        if (isset($response['SignedDocData'])) {
            $response['SignedDocData'] = html_entity_decode($response['SignedDocData']);
        }

        return $response;
    }
}
