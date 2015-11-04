<?php

namespace Bigbank\DigiDoc\Soap\Wsdl;

class Error
{

    /**
     * @var int $Code
     */
    protected $Code = null;

    /**
     * @var string $Category
     */
    protected $Category = null;

    /**
     * @var string $Description
     */
    protected $Description = null;

    /**
     * @param int $Code
     */
    public function __construct($Code = null)
    {

        $this->Code = $Code;
    }

    /**
     * @return int
     */
    public function getCode()
    {

        return $this->Code;
    }

    /**
     * @param int $Code
     *
     * @return \Bigbank\DigiDoc\Soap\Wsdl\Error
     */
    public function setCode($Code)
    {

        $this->Code = $Code;
        return $this;
    }

    /**
     * @return string
     */
    public function getCategory()
    {

        return $this->Category;
    }

    /**
     * @param string $Category
     *
     * @return \Bigbank\DigiDoc\Soap\Wsdl\Error
     */
    public function setCategory($Category)
    {

        $this->Category = $Category;
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
     * @return \Bigbank\DigiDoc\Soap\Wsdl\Error
     */
    public function setDescription($Description)
    {

        $this->Description = $Description;
        return $this;
    }

}
