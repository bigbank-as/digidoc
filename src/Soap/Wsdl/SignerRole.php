<?php

namespace Bigbank\DigiDoc\Soap\Wsdl;

class SignerRole
{

    /**
     * @var int $Certified
     */
    protected $Certified = null;

    /**
     * @var string $Role
     */
    protected $Role = null;

    /**
     * @param int $Certified
     */
    public function __construct($Certified = null)
    {
      $this->Certified = $Certified;
    }

    /**
     * @return int
     */
    public function getCertified()
    {
      return $this->Certified;
    }

    /**
     * @param int $Certified
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignerRole
     */
    public function setCertified($Certified)
    {
      $this->Certified = $Certified;
      return $this;
    }

    /**
     * @return string
     */
    public function getRole()
    {
      return $this->Role;
    }

    /**
     * @param string $Role
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignerRole
     */
    public function setRole($Role)
    {
      $this->Role = $Role;
      return $this;
    }

}
