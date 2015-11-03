<?php

namespace Bigbank\DigiDoc\Soap\Wsdl;

class CertificatePolicy
{

    /**
     * @var string $OID
     */
    protected $OID = null;

    /**
     * @var string $URL
     */
    protected $URL = null;

    /**
     * @var string $Description
     */
    protected $Description = null;


    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getOID()
    {

        return $this->OID;
    }

    /**
     * @param string $OID
     *
     * @return \Bigbank\DigiDoc\Soap\Wsdl\CertificatePolicy
     */
    public function setOID($OID)
    {

        $this->OID = $OID;
        return $this;
    }

    /**
     * @return string
     */
    public function getURL()
    {

        return $this->URL;
    }

    /**
     * @param string $URL
     *
     * @return \Bigbank\DigiDoc\Soap\Wsdl\CertificatePolicy
     */
    public function setURL($URL)
    {

        $this->URL = $URL;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {

        return $this->Description;
    }

    /**
     * @param string $Description
     *
     * @return \Bigbank\DigiDoc\Soap\Wsdl\CertificatePolicy
     */
    public function setDescription($Description)
    {

        $this->Description = $Description;
        return $this;
    }

}
