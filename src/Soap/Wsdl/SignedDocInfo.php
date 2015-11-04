<?php

namespace Bigbank\DigiDoc\Soap\Wsdl;

class SignedDocInfo
{

    /**
     * @var string $Format
     */
    protected $Format = null;

    /**
     * @var string $Version
     */
    protected $Version = null;

    /**
     * @var DataFileInfo[] $DataFileInfo
     */
    protected $DataFileInfo = null;

    /**
     * @var SignatureInfo[] $SignatureInfo
     */
    protected $SignatureInfo = null;


    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getFormat()
    {

        return $this->Format;
    }

    /**
     * @param string $Format
     *
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignedDocInfo
     */
    public function setFormat($Format)
    {

        $this->Format = $Format;
        return $this;
    }

    /**
     * @return string
     */
    public function getVersion()
    {

        return $this->Version;
    }

    /**
     * @param string $Version
     *
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignedDocInfo
     */
    public function setVersion($Version)
    {

        $this->Version = $Version;
        return $this;
    }

    /**
     * @return DataFileInfo[]
     */
    public function getDataFileInfo()
    {

        return $this->DataFileInfo;
    }

    /**
     * @param DataFileInfo[] $DataFileInfo
     *
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignedDocInfo
     */
    public function setDataFileInfo(array $DataFileInfo = null)
    {

        $this->DataFileInfo = $DataFileInfo;
        return $this;
    }

    /**
     * @return SignatureInfo[]
     */
    public function getSignatureInfo()
    {

        return $this->SignatureInfo;
    }

    /**
     * @param SignatureInfo[] $SignatureInfo
     *
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignedDocInfo
     */
    public function setSignatureInfo(array $SignatureInfo = null)
    {

        $this->SignatureInfo = $SignatureInfo;
        return $this;
    }

}
