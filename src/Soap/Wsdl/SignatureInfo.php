<?php

namespace Bigbank\DigiDoc\Soap\Wsdl;

class SignatureInfo
{

    /**
     * @var string $Id
     */
    protected $Id = null;

    /**
     * @var string $Status
     */
    protected $Status = null;

    /**
     * @var Error $Error
     */
    protected $Error = null;

    /**
     * @var \DateTime $SigningTime
     */
    protected $SigningTime = null;

    /**
     * @var SignerRole[] $SignerRole
     */
    protected $SignerRole = null;

    /**
     * @var SignatureProductionPlace $SignatureProductionPlace
     */
    protected $SignatureProductionPlace = null;

    /**
     * @var SignerInfo $Signer
     */
    protected $Signer = null;

    /**
     * @var ConfirmationInfo $Confirmation
     */
    protected $Confirmation = null;

    /**
     * @var TstInfo[] $Timestamps
     */
    protected $Timestamps = null;

    /**
     * @var CRLInfo $CRLInfo
     */
    protected $CRLInfo = null;

    
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
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignatureInfo
     */
    public function setId($Id)
    {
      $this->Id = $Id;
      return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
      return $this->Status;
    }

    /**
     * @param string $Status
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignatureInfo
     */
    public function setStatus($Status)
    {
      $this->Status = $Status;
      return $this;
    }

    /**
     * @return Error
     */
    public function getError()
    {
      return $this->Error;
    }

    /**
     * @param Error $Error
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignatureInfo
     */
    public function setError($Error)
    {
      $this->Error = $Error;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getSigningTime()
    {
      if ($this->SigningTime == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->SigningTime);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $SigningTime
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignatureInfo
     */
    public function setSigningTime(\DateTime $SigningTime = null)
    {
      if ($SigningTime == null) {
       $this->SigningTime = null;
      } else {
        $this->SigningTime = $SigningTime->format(\DateTime::ATOM);
      }
      return $this;
    }

    /**
     * @return SignerRole[]
     */
    public function getSignerRole()
    {
      return $this->SignerRole;
    }

    /**
     * @param SignerRole[] $SignerRole
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignatureInfo
     */
    public function setSignerRole(array $SignerRole = null)
    {
      $this->SignerRole = $SignerRole;
      return $this;
    }

    /**
     * @return SignatureProductionPlace
     */
    public function getSignatureProductionPlace()
    {
      return $this->SignatureProductionPlace;
    }

    /**
     * @param SignatureProductionPlace $SignatureProductionPlace
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignatureInfo
     */
    public function setSignatureProductionPlace($SignatureProductionPlace)
    {
      $this->SignatureProductionPlace = $SignatureProductionPlace;
      return $this;
    }

    /**
     * @return SignerInfo
     */
    public function getSigner()
    {
      return $this->Signer;
    }

    /**
     * @param SignerInfo $Signer
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignatureInfo
     */
    public function setSigner($Signer)
    {
      $this->Signer = $Signer;
      return $this;
    }

    /**
     * @return ConfirmationInfo
     */
    public function getConfirmation()
    {
      return $this->Confirmation;
    }

    /**
     * @param ConfirmationInfo $Confirmation
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignatureInfo
     */
    public function setConfirmation($Confirmation)
    {
      $this->Confirmation = $Confirmation;
      return $this;
    }

    /**
     * @return TstInfo[]
     */
    public function getTimestamps()
    {
      return $this->Timestamps;
    }

    /**
     * @param TstInfo[] $Timestamps
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignatureInfo
     */
    public function setTimestamps(array $Timestamps = null)
    {
      $this->Timestamps = $Timestamps;
      return $this;
    }

    /**
     * @return CRLInfo
     */
    public function getCRLInfo()
    {
      return $this->CRLInfo;
    }

    /**
     * @param CRLInfo $CRLInfo
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignatureInfo
     */
    public function setCRLInfo($CRLInfo)
    {
      $this->CRLInfo = $CRLInfo;
      return $this;
    }

}
