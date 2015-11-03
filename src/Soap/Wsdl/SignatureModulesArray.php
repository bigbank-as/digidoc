<?php

namespace Bigbank\DigiDoc\Soap\Wsdl;

class SignatureModulesArray
{

    /**
     * @var SignatureModule[] $Modules
     */
    protected $Modules = null;


    public function __construct()
    {

    }

    /**
     * @return SignatureModule[]
     */
    public function getModules()
    {

        return $this->Modules;
    }

    /**
     * @param SignatureModule[] $Modules
     *
     * @return \Bigbank\DigiDoc\Soap\Wsdl\SignatureModulesArray
     */
    public function setModules(array $Modules = null)
    {

        $this->Modules = $Modules;
        return $this;
    }

}
