<?php

namespace Bigbank\DigiDoc\Soap\Wsdl;

class SignatureModule
{

    /**
     * @var string $Name
     */
    protected $Name = null;

    /**
     * @var string $Type
     */
    protected $Type = null;

    /**
     * @var string $Location
     */
    protected $Location = null;

    /**
     * @var string $ContentType
     */
    protected $ContentType = null;

    /**
     * @var string $Content
     */
    protected $Content = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return string
     */
    public function getName()
    {
      return $this->Name;
    }

    /**
     * @param string $Name
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignatureModule
     */
    public function setName($Name)
    {
      $this->Name = $Name;
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
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignatureModule
     */
    public function setType($Type)
    {
      $this->Type = $Type;
      return $this;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
      return $this->Location;
    }

    /**
     * @param string $Location
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignatureModule
     */
    public function setLocation($Location)
    {
      $this->Location = $Location;
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
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignatureModule
     */
    public function setContentType($ContentType)
    {
      $this->ContentType = $ContentType;
      return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
      return $this->Content;
    }

    /**
     * @param string $Content
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignatureModule
     */
    public function setContent($Content)
    {
      $this->Content = $Content;
      return $this;
    }

}
