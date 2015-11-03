<?php
namespace Bigbank\DigiDoc\Services;

use Bigbank\DigiDoc\Soap\DigiDocService;

/**
 * {@inheritdoc}
 */
abstract class AbstractDigiDocService
{

    /**
     * @var DigiDocService
     */
    protected $digiDocService;

    /**
     * @param DigiDocService $digiDocService
     */
    public function __construct(DigiDocService $digiDocService)
    {

        $this->digiDocService = $digiDocService;
    }
}
