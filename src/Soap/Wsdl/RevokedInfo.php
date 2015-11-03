<?php

namespace Bigbank\DigiDoc\Soap\Wsdl;

class RevokedInfo
{

    /**
     * @var int $Sequence
     */
    protected $Sequence = null;

    /**
     * @var string $SerialNumber
     */
    protected $SerialNumber = null;

    /**
     * @var \DateTime $RevocationDate
     */
    protected $RevocationDate = null;

    /**
     * @param int $Sequence
     */
    public function __construct($Sequence)
    {
      $this->Sequence = $Sequence;
    }

    /**
     * @return int
     */
    public function getSequence()
    {
      return $this->Sequence;
    }

    /**
     * @param int $Sequence
     * @return \Bigbank\DigiDoc\Soap\Wsdl\RevokedInfo
     */
    public function setSequence($Sequence)
    {
      $this->Sequence = $Sequence;
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
     * @return \Bigbank\DigiDoc\Soap\Wsdl\RevokedInfo
     */
    public function setSerialNumber($SerialNumber)
    {
      $this->SerialNumber = $SerialNumber;
      return $this;
    }

    /**
     * @return \DateTime
     */
    public function getRevocationDate()
    {
      if ($this->RevocationDate == null) {
        return null;
      } else {
        try {
          return new \DateTime($this->RevocationDate);
        } catch (\Exception $e) {
          return false;
        }
      }
    }

    /**
     * @param \DateTime $RevocationDate
     * @return \Bigbank\DigiDoc\Soap\Wsdl\RevokedInfo
     */
    public function setRevocationDate(\DateTime $RevocationDate = null)
    {
      if ($RevocationDate == null) {
       $this->RevocationDate = null;
      } else {
        $this->RevocationDate = $RevocationDate->format(\DateTime::ATOM);
      }
      return $this;
    }

}
