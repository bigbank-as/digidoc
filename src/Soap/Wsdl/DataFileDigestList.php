<?php

namespace Bigbank\DigiDoc\Soap\Wsdl;

class DataFileDigestList
{

    /**
     * @var DataFileDigest[] $DataFileDigest
     */
    protected $DataFileDigest = null;

    
    public function __construct()
    {
    
    }

    /**
     * @return DataFileDigest[]
     */
    public function getDataFileDigest()
    {
      return $this->DataFileDigest;
    }

    /**
     * @param DataFileDigest[] $DataFileDigest
     * @return \Bigbank\DigiDoc\Soap\Wsdl\DataFileDigestList
     */
    public function setDataFileDigest(array $DataFileDigest = null)
    {
      $this->DataFileDigest = $DataFileDigest;
      return $this;
    }

}
