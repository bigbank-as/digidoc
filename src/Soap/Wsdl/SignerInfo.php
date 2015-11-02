<?php

namespace Bigbank\DigiDoc\Soap\Wsdl;

class SignerInfo
{

    /**
     * @var string $CommonName
     */
    protected $CommonName = null;

    /**
     * @var string $IDCode
     */
    protected $IDCode = null;

    /**
     * @var CertificateInfo $Certificate
     */
    protected $Certificate = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return string
     */
    public function getCommonName()
    {
      return $this->CommonName;
    }

    /**
     * @param string $CommonName
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignerInfo
     */
    public function setCommonName($CommonName)
    {
      $this->CommonName = $CommonName;
      return $this;
    }

    /**
     * @return string
     */
    public function getIDCode()
    {
      return $this->IDCode;
    }

    /**
     * @param string $IDCode
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignerInfo
     */
    public function setIDCode($IDCode)
    {
      $this->IDCode = $IDCode;
      return $this;
    }

    /**
     * @return CertificateInfo
     */
    public function getCertificate()
    {
      return $this->Certificate;
    }

    /**
     * @param CertificateInfo $Certificate
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignerInfo
     */
    public function setCertificate($Certificate)
    {
      $this->Certificate = $Certificate;
      return $this;
    }

}
