<?php

namespace Bigbank\DigiDoc\Soap\Wsdl;

class CertificateInfo
{

    /**
     * @var string $Issuer
     */
    protected $Issuer = null;

    /**
     * @var string $Subject
     */
    protected $Subject = null;

    /**
     * @var \DateTime $ValidFrom
     */
    protected $ValidFrom = null;

    /**
     * @var \DateTime $ValidTo
     */
    protected $ValidTo = null;

    /**
     * @var string $IssuerSerial
     */
    protected $IssuerSerial = null;

    /**
     * @var CertificatePolicy[] $Policies
     */
    protected $Policies = null;


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
     *
     * @return \Bigbank\DigiDoc\Soap\Wsdl\CertificateInfo
     */
    public function setIssuer($Issuer)
    {

        $this->Issuer = $Issuer;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubject()
    {

        return $this->Subject;
    }

    /**
     * @param string $Subject
     *
     * @return \Bigbank\DigiDoc\Soap\Wsdl\CertificateInfo
     */
    public function setSubject($Subject)
    {

        $this->Subject = $Subject;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getValidFrom()
    {

        if ($this->ValidFrom == null) {
            return null;
        } else {
            try {
                return new \DateTime($this->ValidFrom);
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    /**
     * @param \DateTime $ValidFrom
     *
     * @return \Bigbank\DigiDoc\Soap\Wsdl\CertificateInfo
     */
    public function setValidFrom(\DateTime $ValidFrom = null)
    {

        if ($ValidFrom == null) {
            $this->ValidFrom = null;
        } else {
            $this->ValidFrom = $ValidFrom->format(\DateTime::ATOM);
        }
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getValidTo()
    {

        if ($this->ValidTo == null) {
            return null;
        } else {
            try {
                return new \DateTime($this->ValidTo);
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    /**
     * @param \DateTime $ValidTo
     *
     * @return \Bigbank\DigiDoc\Soap\Wsdl\CertificateInfo
     */
    public function setValidTo(\DateTime $ValidTo = null)
    {

        if ($ValidTo == null) {
            $this->ValidTo = null;
        } else {
            $this->ValidTo = $ValidTo->format(\DateTime::ATOM);
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getIssuerSerial()
    {

        return $this->IssuerSerial;
    }

    /**
     * @param string $IssuerSerial
     *
     * @return \Bigbank\DigiDoc\Soap\Wsdl\CertificateInfo
     */
    public function setIssuerSerial($IssuerSerial)
    {

        $this->IssuerSerial = $IssuerSerial;
        return $this;
    }

    /**
     * @return CertificatePolicy[]
     */
    public function getPolicies()
    {

        return $this->Policies;
    }

    /**
     * @param CertificatePolicy[] $Policies
     *
     * @return \Bigbank\DigiDoc\Soap\Wsdl\CertificateInfo
     */
    public function setPolicies(array $Policies = null)
    {

        $this->Policies = $Policies;
        return $this;
    }

}
