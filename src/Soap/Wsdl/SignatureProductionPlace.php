<?php

namespace Bigbank\DigiDoc\Soap\Wsdl;

class SignatureProductionPlace
{

    /**
     * @var string $City
     */
    protected $City = null;

    /**
     * @var string $StateOrProvince
     */
    protected $StateOrProvince = null;

    /**
     * @var string $PostalCode
     */
    protected $PostalCode = null;

    /**
     * @var string $CountryName
     */
    protected $CountryName = null;


    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getCity()
    {

        return $this->City;
    }

    /**
     * @param string $City
     *
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignatureProductionPlace
     */
    public function setCity($City)
    {

        $this->City = $City;
        return $this;
    }

    /**
     * @return string
     */
    public function getStateOrProvince()
    {

        return $this->StateOrProvince;
    }

    /**
     * @param string $StateOrProvince
     *
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignatureProductionPlace
     */
    public function setStateOrProvince($StateOrProvince)
    {

        $this->StateOrProvince = $StateOrProvince;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {

        return $this->PostalCode;
    }

    /**
     * @param string $PostalCode
     *
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignatureProductionPlace
     */
    public function setPostalCode($PostalCode)
    {

        $this->PostalCode = $PostalCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountryName()
    {

        return $this->CountryName;
    }

    /**
     * @param string $CountryName
     *
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignatureProductionPlace
     */
    public function setCountryName($CountryName)
    {

        $this->CountryName = $CountryName;
        return $this;
    }

}
