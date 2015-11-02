<?php

namespace Bigbank\DigiDoc\Soap\Wsdl;

class CRLInfo
{

    /**
     * @var string $Issuer
     */
    protected $Issuer = null;

    /**
     * @var \DateTime $LastUpdate
     */
    protected $LastUpdate = null;

    /**
     * @var \DateTime $NextUpdate
     */
    protected $NextUpdate = null;

    /**
     * @var RevokedInfo[] $Revocations
     */
    protected $Revocations = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return string
     */
    public function getIssuer()
    {
      return $this->Issuer;
    }

    /**
     * @param string $Issuer
     * @return \Bigbank\DigiDoc\Soap\Wsdl\CRLInfo
     */
    public function setIssuer($Issuer)
    {
      $this->Issuer = $Issuer;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLastUpdate()
    {
      if ($this->LastUpdate == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->LastUpdate);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $LastUpdate
     * @return \Bigbank\DigiDoc\Soap\Wsdl\CRLInfo
     */
    public function setLastUpdate(\DateTime $LastUpdate = null)
    {
      if ($LastUpdate == null) {
       $this->LastUpdate = null;
      } else {
        $this->LastUpdate = $LastUpdate->format(\DateTime::ATOM);
      }
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getNextUpdate()
    {
      if ($this->NextUpdate == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->NextUpdate);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $NextUpdate
     * @return \Bigbank\DigiDoc\Soap\Wsdl\CRLInfo
     */
    public function setNextUpdate(\DateTime $NextUpdate = null)
    {
      if ($NextUpdate == null) {
       $this->NextUpdate = null;
      } else {
        $this->NextUpdate = $NextUpdate->format(\DateTime::ATOM);
      }
      return $this;
    }

    /**
     * @return RevokedInfo[]
     */
    public function getRevocations()
    {
      return $this->Revocations;
    }

    /**
     * @param RevokedInfo[] $Revocations
     * @return \Bigbank\DigiDoc\Soap\Wsdl\CRLInfo
     */
    public function setRevocations(array $Revocations = null)
    {
      $this->Revocations = $Revocations;
      return $this;
    }

}
