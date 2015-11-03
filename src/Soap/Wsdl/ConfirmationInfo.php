<?php

namespace Bigbank\DigiDoc\Soap\Wsdl;

class ConfirmationInfo
{

    /**
     * @var string $ResponderID
     */
    protected $ResponderID = null;

    /**
     * @var string $ProducedAt
     */
    protected $ProducedAt = null;

    /**
     * @var CertificateInfo $ResponderCertificate
     */
    protected $ResponderCertificate = null;


    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getResponderID()
    {

        return $this->ResponderID;
    }

    /**
     * @param string $ResponderID
     *
     * @return \Bigbank\DigiDoc\Soap\Wsdl\ConfirmationInfo
     */
    public function setResponderID($ResponderID)
    {

        $this->ResponderID = $ResponderID;
        return $this;
    }

    /**
     * @return string
     */
    public function getProducedAt()
    {

        return $this->ProducedAt;
    }

    /**
     * @param string $ProducedAt
     *
     * @return \Bigbank\DigiDoc\Soap\Wsdl\ConfirmationInfo
     */
    public function setProducedAt($ProducedAt)
    {

        $this->ProducedAt = $ProducedAt;
        return $this;
    }

    /**
     * @return CertificateInfo
     */
    public function getResponderCertificate()
    {

        return $this->ResponderCertificate;
    }

    /**
     * @param CertificateInfo $ResponderCertificate
     *
     * @return \Bigbank\DigiDoc\Soap\Wsdl\ConfirmationInfo
     */
    public function setResponderCertificate($ResponderCertificate)
    {

        $this->ResponderCertificate = $ResponderCertificate;
        return $this;
    }

}
