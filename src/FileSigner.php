<?php
namespace Bigbank\MobileId;

use Bigbank\MobileId\Request\AddDataFile;
use Bigbank\MobileId\Request\CreateSignedDoc;
use Bigbank\MobileId\Request\StartSession;
use Bigbank\MobileId\Request\MobileSign;
use Bigbank\MobileId\Request\GetStatusInfo;
use Bigbank\MobileId\Request\GetSignedDoc;

/**
 * {@inheritdoc}
 */
class FileSigner extends AbstractDigiDocService implements FileSignerInterface
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

        $request  = new StartSession;
        $response = $request->factory($this->apiUrl, $this->options)->send();

        $this->sessCode = $response['Sesscode'];

        $request2 = new CreateSignedDoc;
        $request2->factory($this->apiUrl, $this->options)->send(['Sesscode' => $this->sessCode]);
    }

    /**
     * {@inheritdoc}
     */
    public function addFile($fileName, $mimeType, $content)
    {

        $arguments = [
            'Sesscode' => $this->sessCode,
            'Filename' => $fileName,
            'MimeType' => $mimeType,
            'Size'     => strlen($content),
            'Content'  => $content
        ];

        $request = new AddDataFile;
        return $request->factory($this->apiUrl, $this->options)
            ->send($arguments);
    }

    /**
     * {@inheritdoc}
     */
    public function sign($idCode, $phoneNumber, $serviceName, $messageToDisplay)
    {

        $arguments = [
            'Sesscode'                    => $this->sessCode,
            'SignerIDCode'                => $idCode,
            'SignerPhoneNo'               => $phoneNumber,
            'ServiceName'                 => $serviceName,
            'AdditionalDataToBeDisplayed' => $messageToDisplay,
        ];

        $request  = new MobileSign;
        $response = $request->factory($this->apiUrl, $this->options)
            ->send($arguments);

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

        $request = new GetStatusInfo;
        return $request->factory($this->apiUrl, $this->options)
            ->send(['Sesscode' => $this->sessCode]);
    }

    /**
     * Get the signed file data
     *
     * @return array String values with the keys Status, SignedDocData
     */
    protected function fetchFile()
    {

        $request  = new GetSignedDoc;
        $response = $request->factory($this->apiUrl, $this->options)
            ->send(['Sesscode' => $this->sessCode]);

        if (isset($response['SignedDocData'])) {
            $response['SignedDocData'] = html_entity_decode($response['SignedDocData']);
        }

        return $response;
    }
}
