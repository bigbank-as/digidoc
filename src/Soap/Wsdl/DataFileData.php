<?php

namespace Bigbank\DigiDoc\Soap\Wsdl;

class DataFileData
{

    /**
     * @var string $Id
     */
    protected $Id = null;

    /**
     * @var string $Filename
     */
    protected $Filename = null;

    /**
     * @var string $MimeType
     */
    protected $MimeType = null;

    /**
     * @var string $ContentType
     */
    protected $ContentType = null;

    /**
     * @var string $DigestType
     */
    protected $DigestType = null;

    /**
     * @var string $DigestValue
     */
    protected $DigestValue = null;

    /**
     * @var int $Size
     */
    protected $Size = null;

    /**
     * @var DataFileAttribute[] $Attributes
     */
    protected $Attributes = null;

    /**
     * @var string $DfData
     */
    protected $DfData = null;

    /**
     * @param int $Size
     */
    public function __construct($Size = null)
    {
      $this->Size = $Size;
    }

    /**
     * @return string
     */
    public function getId()
    {
      return $this->Id;
    }

    /**
     * @param string $Id
     * @return \Bigbank\DigiDoc\Soap\Wsdl\DataFileData
     */
    public function setId($Id)
    {
      $this->Id = $Id;
      return $this;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
      return $this->Filename;
    }

    /**
     * @param string $Filename
     * @return \Bigbank\DigiDoc\Soap\Wsdl\DataFileData
     */
    public function setFilename($Filename)
    {
      $this->Filename = $Filename;
      return $this;
    }

    /**
     * @return string
     */
    public function getMimeType()
    {
      return $this->MimeType;
    }

    /**
     * @param string $MimeType
     * @return \Bigbank\DigiDoc\Soap\Wsdl\DataFileData
     */
    public function setMimeType($MimeType)
    {
      $this->MimeType = $MimeType;
      return $this;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
      return $this->ContentType;
    }

    /**
     * @param string $ContentType
     * @return \Bigbank\DigiDoc\Soap\Wsdl\DataFileData
     */
    public function setContentType($ContentType)
    {
      $this->ContentType = $ContentType;
      return $this;
    }

    /**
     * @return string
     */
    public function getDigestType()
    {
      return $this->DigestType;
    }

    /**
     * @param string $DigestType
     * @return \Bigbank\DigiDoc\Soap\Wsdl\DataFileData
     */
    public function setDigestType($DigestType)
    {
      $this->DigestType = $DigestType;
      return $this;
    }

    /**
     * @return string
     */
    public function getDigestValue()
    {
      return $this->DigestValue;
    }

    /**
     * @param string $DigestValue
     * @return \Bigbank\DigiDoc\Soap\Wsdl\DataFileData
     */
    public function setDigestValue($DigestValue)
    {
      $this->DigestValue = $DigestValue;
      return $this;
    }

    /**
     * @return int
     */
    public function getSize()
    {
      return $this->Size;
    }

    /**
     * @param int $Size
     * @return \Bigbank\DigiDoc\Soap\Wsdl\DataFileData
     */
    public function setSize($Size)
    {
      $this->Size = $Size;
      return $this;
    }

    /**
     * @return DataFileAttribute[]
     */
    public function getAttributes()
    {
      return $this->Attributes;
    }

    /**
     * @param DataFileAttribute[] $Attributes
     * @return \Bigbank\DigiDoc\Soap\Wsdl\DataFileData
     */
    public function setAttributes(array $Attributes = null)
    {
      $this->Attributes = $Attributes;
      return $this;
    }

    /**
     * @return string
     */
    public function getDfData()
    {
      return $this->DfData;
    }

    /**
     * @param string $DfData
     * @return \Bigbank\DigiDoc\Soap\Wsdl\DataFileData
     */
    public function setDfData($DfData)
    {
      $this->DfData = $DfData;
      return $this;
    }

}
