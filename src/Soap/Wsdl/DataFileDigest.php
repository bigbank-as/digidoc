<?php

namespace Bigbank\DigiDoc\Soap\Wsdl;

class DataFileDigest
{

    /**
     * @var string $Id
     */
    protected $Id = null;

    /**
     * @var string $DigestType
     */
    protected $DigestType = null;

    /**
     * @var string $DigestValue
     */
    protected $DigestValue = null;

    /**
     * @var string $MimeType
     */
    protected $MimeType = null;

    
    public function __construct()
    {
    
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
     * @return \Bigbank\DigiDoc\Soap\Wsdl\DataFileDigest
     */
    public function setId($Id)
    {
      $this->Id = $Id;
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
     * @return \Bigbank\DigiDoc\Soap\Wsdl\DataFileDigest
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
     * @return \Bigbank\DigiDoc\Soap\Wsdl\DataFileDigest
     */
    public function setDigestValue($DigestValue)
    {
      $this->DigestValue = $DigestValue;
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
     * @return \Bigbank\DigiDoc\Soap\Wsdl\DataFileDigest
     */
    public function setMimeType($MimeType)
    {
      $this->MimeType = $MimeType;
      return $this;
    }

}
