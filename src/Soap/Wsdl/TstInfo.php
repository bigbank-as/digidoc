<?php

namespace Bigbank\DigiDoc\Soap\Wsdl;

class TstInfo
{

    /**
     * @var string $Id
     */
    protected $Id = null;

    /**
     * @var string $Type
     */
    protected $Type = null;

    /**
     * @var string $SerialNumber
     */
    protected $SerialNumber = null;

    /**
     * @var \DateTime $CreationTime
     */
    protected $CreationTime = null;

    /**
     * @var string $Policy
     */
    protected $Policy = null;

    /**
     * @var string $ErrorBound
     */
    protected $ErrorBound = null;

    /**
     * @var boolean $Ordered
     */
    protected $Ordered = null;

    /**
     * @var string $TSA
     */
    protected $TSA = null;

    /**
     * @var CertificateInfo $Certificate
     */
    protected $Certificate = null;

    /**
     * @param boolean $Ordered
     */
    public function __construct($Ordered)
    {
      $this->Ordered = $Ordered;
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
     * @return \Bigbank\DigiDoc\Soap\Wsdl\TstInfo
     */
    public function setId($Id)
    {
      $this->Id = $Id;
      return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
      return $this->Type;
    }

    /**
     * @param string $Type
     * @return \Bigbank\DigiDoc\Soap\Wsdl\TstInfo
     */
    public function setType($Type)
    {
      $this->Type = $Type;
      return $this;
    }

    /**
     * @return string
     */
    public function getSerialNumber()
    {
      return $this->SerialNumber;
    }

    /**
     * @param string $SerialNumber
     * @return \Bigbank\DigiDoc\Soap\Wsdl\TstInfo
     */
    public function setSerialNumber($SerialNumber)
    {
      $this->SerialNumber = $SerialNumber;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreationTime()
    {
      if ($this->CreationTime == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->CreationTime);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $CreationTime
     * @return \Bigbank\DigiDoc\Soap\Wsdl\TstInfo
     */
    public function setCreationTime(\DateTime $CreationTime = null)
    {
      if ($CreationTime == null) {
       $this->CreationTime = null;
      } else {
        $this->CreationTime = $CreationTime->format(\DateTime::ATOM);
      }
      return $this;
    }

    /**
     * @return string
     */
    public function getPolicy()
    {
      return $this->Policy;
    }

    /**
     * @param string $Policy
     * @return \Bigbank\DigiDoc\Soap\Wsdl\TstInfo
     */
    public function setPolicy($Policy)
    {
      $this->Policy = $Policy;
      return $this;
    }

    /**
     * @return string
     */
    public function getErrorBound()
    {
      return $this->ErrorBound;
    }

    /**
     * @param string $ErrorBound
     * @return \Bigbank\DigiDoc\Soap\Wsdl\TstInfo
     */
    public function setErrorBound($ErrorBound)
    {
      $this->ErrorBound = $ErrorBound;
      return $this;
    }

    /**
     * @return boolean
     */
    public function getOrdered()
    {
      return $this->Ordered;
    }

    /**
     * @param boolean $Ordered
     * @return \Bigbank\DigiDoc\Soap\Wsdl\TstInfo
     */
    public function setOrdered($Ordered)
    {
      $this->Ordered = $Ordered;
      return $this;
    }

    /**
     * @return string
     */
    public function getTSA()
    {
      return $this->TSA;
    }

    /**
     * @param string $TSA
     * @return \Bigbank\DigiDoc\Soap\Wsdl\TstInfo
     */
    public function setTSA($TSA)
    {
      $this->TSA = $TSA;
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
     * @return \Bigbank\DigiDoc\Soap\Wsdl\TstInfo
     */
    public function setCertificate($Certificate)
    {
      $this->Certificate = $Certificate;
      return $this;
    }

}
