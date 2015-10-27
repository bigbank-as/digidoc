<?php
namespace Bigbank\MobileId;

use Bigbank\MobileId\Request\StartSession;
use Bigbank\MobileId\Request\MobileSign;
use Bigbank\MobileId\Request\GetStatusInfo;
use Bigbank\MobileId\Request\GetSignedDoc;
use Bigbank\MobileId\Request\CloseSession;

/**
 * {@inheritdoc}
 */
class SingleFileSigner extends DigiDocServiceAbstract implements SingleFileSignerInterface
{

    /**
     * @var int
     */
    protected $sessCode;

    /**
     * {@inheritdoc}
     */
    public function startSigning($fileData, $idCode, $phoneNumber, $serviceName, $messageToDisplay)
    {

        $this->startSession($fileData);

        $response = $this->sign($idCode, $phoneNumber, $serviceName, $messageToDisplay);

        $response['Sesscode'] = $this->sessCode;

        return $response;
    }

    /**
     * {@inheritdoc}
     */
    public function getStatus($sessCode)
    {

        $this->sessCode = $sessCode;

        $response = $this->fetchStatusInfo();

        if (!$response['StatusCode'] !== 'SIGNATURE') {
            return $response;
        }

        $fileResponse = $this->fetchFile();

        $closeResponse = $this->closeSession();

        return array_merge($response, $fileResponse, $closeResponse);
    }

    /**
     * Start the session request by passing a file
     *
     * @var array $fileData
     *
     * @return void
     */
    protected function startSession($fileData)
    {

        $xml = '<DataFile>'
            . '<Id xsi:type="xsd:string"></Id>'
            . '<Filename xsi:type="xsd:string">%s</Filename>'
            . '<MimeType xsi:type="xsd:string">%s</MimeType>'
            . '<ContentType xsi:type="xsd:string">%s</ContentType>'
            . '<Size xsi:type="xsd:int">%s</Size>'
            . '<DfData xsi:type="xsd:string">%s</DfData>'
            . '</DataFile>';

        $xml = '<DataFile xmlns="http://www.sk.ee/DigiDoc/v1.3.0#" Id="" Filename="%s" MimeType="%s" ContentType="%s" Size="%s">%s</DataFile>';

        $arguments = [
            'datafile' => sprintf(
                $xml,
                $fileData['fileName'],
                $fileData['fileType'],
                'EMBEDDED_BASE64',
                strlen($fileData['fileContent']),
                $fileData['fileContent']
            )
        ];

        $request  = new StartSession;
        $response = $request->factory($this->apiUrl, $this->options)
            ->send($arguments);

        $this->sessCode = $response['Sesscode'];
    }

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
    protected function sign($idCode, $phoneNumber, $serviceName, $messageToDisplay)
    {

        $arguments = [
            'Sesscode'                    => $this->sessCode,
            'SignerIDCode'                => $idCode,
            'SignerPhoneNo'               => $phoneNumber,
            'ServiceName'                 => $serviceName,
            'AdditionalDataToBeDisplayed' => $messageToDisplay,
        ];

        $request  = new MobileSign;
        return $request->factory($this->apiUrl, $this->options)
            ->send($arguments);
    }

    /**
     * Check the state of the signing process
     *
     * @return array String values with the keys Status, StatusCode
     */
    protected function fetchStatusInfo()
    {

        $request  = new GetStatusInfo;
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
        return $request->factory($this->apiUrl, $this->options)
            ->send(['Sesscode' => $this->sessCode]);
    }

    /**
     * End and clear the session
     *
     * @return string
     */
    protected function closeSession()
    {

        $request  = new CloseSession;
        return $request->factory($this->apiUrl, $this->options)
            ->send(['Sesscode' => $this->sessCode]);
    }
}
